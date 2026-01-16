<?php
/**
 * Comment: 小程序方法类
 * Author: ZZW
 * Date: 2018/9/5
 * Time: 17:03
 */
defined('IN_IA') or exit('Access Denied');

class WeChat {
    /**
     * Comment: 验证是否为一卡通会员
     * Author: zzw
     * Date: 2019/8/29 17:11
     * @param      $mid
     * @param bool $state
     * @return bool|int|mixed
     */
    static function VipVerification($mid,$state = false) {
        global $_W;
        $wlsetting = pdo_get(PDO_NAME . "setting", array('uniacid' => $_W['uniacid'], 'key' => 'halfcard'));
        $wlsetting['value'] = unserialize($wlsetting['value']);
        $now = time();
        if ($wlsetting['value']['halfcardtype'] == 2) {
            $halfcardflag = pdo_fetch("SELECT id,levelid,username FROM " . tablename('wlmerchant_halfcardmember') . "WHERE uniacid = {$_W['uniacid']} AND mid = {$mid} AND aid = {$_W['aid']} AND expiretime > {$now} AND disable != 1");
        } else {
            $halfcardflag = pdo_fetch("SELECT id,levelid,username FROM " . tablename('wlmerchant_halfcardmember') . "WHERE uniacid = {$_W['uniacid']} AND mid = {$mid} AND expiretime > {$now} AND disable != 1");
        }
        //判断state返回内容
        if($state) return is_array($halfcardflag) && count($halfcardflag) > 0 && $halfcardflag['id'] > 0 ? $halfcardflag['id'] : 0 ;
        return $halfcardflag;
    }
    /**
     * Comment: 获取头条信息列表
     * Author: zzw
     * Date: 2019/8/29 17:11
     * @param bool $shop_id
     * @param int  $page
     * @param int  $pageNum
     * @return array
     */
    static function getHeadline($shop_id = false, $page = 1, $pageNum = 10) {
        global $_W;
        if ($shop_id) {
            $where['sid'] = $shop_id;
        }
        $where['uniacid'] = $_W['uniacid'];
        $where['aid'] = $_W['aid'] ? $_W['aid'] : 0;
        $list = Util::paging('headline_content', $page, $pageNum, $where
            , array('id', 'title', 'summary', 'display_img', 'author', 'author_img', 'browse', 'one_id', 'two_id'), array('release_time DESC'));
        foreach ($list as $k => &$v) {
            $v['display_img'] = tomedia($v['display_img']);
            $v['author_img'] = tomedia($v['author_img']);
            $v['one_name'] = implode(pdo_get(PDO_NAME . 'headline_class', array('id' => $v['one_id']), array('name')));
            $v['two_name'] = implode(pdo_get(PDO_NAME . 'headline_class', array('id' => $v['two_id']), array('name')));
            unset($v['one_id']);
            unset($v['two_id']);
        }
        return $list;
    }
    /**
     * Comment: 获取某个店铺销量最好的商品
     * Author: zzw
     * Date: 2019/8/29 17:12
     * @param $Atable   string  商品表
     * @param $Btable   string  订单表
     * @param $field    string  查询的字段信息
     * @param $where    string  查询条件
     * @param $group    string  分组信息
     * @param $relation string  两表之间的关联信息
     * @param $SpareW   string  备用条件，如果没有销量最好的商品时 查询任意一条本店铺的商品
     * @param $SpareF   string  备用查询字段
     * @return string
     */
    static function getSalesChampion($Atable, $Btable, $field, $where, $group, $relation, $SpareW, $SpareF) {
        $info = pdo_fetchall("SELECT {$field} FROM "
            . tablename(PDO_NAME . $Atable)
            . " a LEFT JOIN "
            . tablename(PDO_NAME . $Btable)
            . " b ON {$relation} "
            . " WHERE {$where} GROUP BY {$group}");
        array_multisort(array_column($info, 'num'), SORT_DESC, $info);
        $info = $info[0];
        //$info 不存在，则当前店铺当前种类商品暂时没有销售 直接获取一个商品
        if (!$info) {
            $info = pdo_fetchall("SELECT {$SpareF} FROM "
                . tablename(PDO_NAME . $Atable)
                . " WHERE {$SpareW}");
            $info = $info[0];
        }
        return $info ? $info : '';
    }
    /**
     * Comment: 通过店铺列表 获取店铺每种类型的商品中销量最好的一个
     * Author: zzw
     * Date: 2019/8/29 17:13
     * @param $shopList
     * @return mixed
     */
    static function getStoreList($shopList) {
        global $_W, $_GPC;
        foreach ($shopList as $k => &$v) {
            $id = $v['id'];
            //获取店铺的头条信息
            $headline = WeChat::getHeadline($id, 1, 1);
            $headline = $headline[0] ? $headline[0] : '';
            if ($headline) {
                unset($headline['summary']);
                unset($headline['display_img']);
                unset($headline['author']);
                unset($headline['author_img']);
                unset($headline['browse']);
                unset($headline['one_name']);
                unset($headline['two_name']);
                $headline['jump_link'] = h5_url('pages/mainPages/headline/headlineDetail',['headline_id'=>$headline['id']]);
            }
            $v['headline'] = $headline;
            //获取店铺每种商品中销量最好的一件商品的详细信息
            #1、抢购信息
            $goods['active'] = self::getSalesChampion('rush_activity', 'rush_order', 'a.id,a.name,count(b.activityid) as num', "a.sid = {$id} AND a.status IN (1,2) ", 'b.activityid', "a.id = b.activityid", " sid = {$id} AND status IN (1,2) ", "id,name");
            $goods['active']['jump_link'] = h5_url('pages/mainPages/goods/index',['type'=>1,'id'=>$goods['active']['id']]);
            #2、团购信息
            $goods['groupon'] = self::getSalesChampion('groupon_activity', 'order', 'a.id,a.name,count(b.fkid) as num', "a.sid = {$id} AND a.status IN (1,2) AND b.plugin = 'groupon' ", 'b.fkid', "a.id = b.fkid", " sid = {$id} AND status IN (1,2) ", "id,name");
            $goods['groupon']['jump_link'] = h5_url('pages/mainPages/goods/index',['type'=>2,'id'=>$goods['groupon']['id']]);
            #3、折扣信息
            $goods['halfcard'] = self::getSalesChampion('halfcardlist', 'timecardrecord', 'a.id,a.title as name,count(b.activeid) as num ', "a.uniacid = {$_W['uniacid']} AND a.aid = {$_W['aid']} AND a.status = 1 AND b.type = 1 AND b.merchantid = {$id}", 'b.activeid', "a.id = b.activeid", " uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND status = 1  AND merchantid = {$id} ", "id,title as name");
            $goods['halfcard']['jump_link'] = h5_url('pages/mainPages/store/buyOrder', array('id' => $id));
            #4、礼包信息
            $goods['packages'] = self::getSalesChampion('package', 'timecardrecord', 'a.id,a.title as name,count(b.activeid) as num ', "a.uniacid = {$_W['uniacid']} AND a.aid = {$_W['aid']} AND a.status = 1 AND b.type = 2 AND b.merchantid = {$id}", 'b.activeid', "a.id = b.activeid", " uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND status = 1  AND merchantid = {$id} ", "id,title as name");
            $goods['packages']['jump_link'] = h5_url('pages/mainPages/memberCard/memberCard');
            #5、优惠券信息
            $goods['coupon'] = self::getSalesChampion('couponlist', 'order', 'a.id,a.title as name,count(b.fkid) as num ', "a.uniacid = {$_W['uniacid']} AND a.aid = {$_W['aid']} AND a.merchantid = {$id} AND a.status = 1 AND b.plugin = 'coupon'", 'b.fkid', "a.id = b.fkid", " uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND merchantid = {$id} AND status = 1 ", "id,title as name");
            $goods['coupon']['jump_link'] = h5_url('pages/mainPages/goods/index',['type'=>5,'id'=>$goods['coupon']['id']]);
            #6、拼团信息
            $goods['fightgroup'] = self::getSalesChampion('fightgroup_goods', 'order', 'a.id,a.name,count(b.fkid) as num ', "a.uniacid = {$_W['uniacid']} AND a.aid = {$_W['aid']} AND a.merchantid = {$id} AND a.status = 1 AND b.plugin = 'wlfightgroup'", 'b.fkid', "a.id = b.fkid", " uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND merchantid = {$id} AND status = 1 ", "id,name");
            $goods['fightgroup']['jump_link'] = h5_url('pages/mainPages/goods/index',['type'=>3,'id'=>$goods['fightgroup']['id']]);
            #7、砍价信息
            $goods['bargain'] = self::getSalesChampion('bargain_activity', 'order', 'a.id,a.name,count(b.fkid) as num ', " a.uniacid = {$_W['uniacid']} AND a.aid = {$_W['aid']} AND a.merchantid = {$id} AND a.status IN (1,2) AND b.plugin = 'bargain'", 'b.fkid', "a.id = b.fkid", " uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND merchantid = {$id} AND status IN (1,2) ", "id,name");
            $goods['bargain']['jump_link'] = h5_url('pages/mainPages/goods/index',['type'=>7,'id'=>$goods['bargain']['id']]);
            //删除多余的数据
            unset($v['location']);
            unset($v['url']);
            unset($v['cate']);
            if (!is_array($goods['active'])) unset($goods['active']);
            if (!is_array($goods['groupon'])) unset($goods['groupon']);
            if (!is_array($goods['halfcard'])) unset($goods['halfcard']);
            if (!is_array($goods['packages'])) unset($goods['packages']);
            if (!is_array($goods['coupon'])) unset($goods['coupon']);
            if (!is_array($goods['fightgroup'])) unset($goods['fightgroup']);
            if (!is_array($goods['bargain'])) unset($goods['bargain']);





            $v['goods'] = $goods;
        }
        return $shopList;
    }
    /**
     * Comment: 图片上传到远程服务器
     * Author: zzw
     * Date: 2019/8/29 17:14
     * @param      $filename
     * @param bool $auto_delete_local
     * @return bool|string
     * @throws Exception
     */
    static function file_remote_upload($filename, $auto_delete_local = true) {
        global $_W;
        if (empty($_W['setting']['remote']['type'])) {
            return false;
        }
        if ($_W['setting']['remote']['type'] == '1') {
            load()->library('ftp');
            $ftp_config = array(
                'hostname' => $_W['setting']['remote']['ftp']['host'],
                'username' => $_W['setting']['remote']['ftp']['username'],
                'password' => $_W['setting']['remote']['ftp']['password'],
                'port'     => $_W['setting']['remote']['ftp']['port'],
                'ssl'      => $_W['setting']['remote']['ftp']['ssl'],
                'passive'  => $_W['setting']['remote']['ftp']['pasv'],
                'timeout'  => $_W['setting']['remote']['ftp']['timeout'],
                'rootdir'  => $_W['setting']['remote']['ftp']['dir'],
            );
            $ftp = new Ftp($ftp_config);
            if (true === $ftp->connect()) {
                $response = $ftp->upload(ATTACHMENT_ROOT . '/' . $filename, $filename);
                if ($auto_delete_local) {
                    self::file_delete($filename);
                }
                if (!empty($response)) {
                    return true;
                } else {
                    return '远程附件上传失败，请检查配置并重新上传';
                }
            } else {
                return '远程附件上传失败，请检查配置并重新上传';
            }
        } elseif ($_W['setting']['remote']['type'] == '2') {
            load()->library('oss');
            load()->model('attachment');
            $buckets = attachment_alioss_buctkets($_W['setting']['remote']['alioss']['key'], $_W['setting']['remote']['alioss']['secret']);
            $endpoint = 'http://' . $buckets[$_W['setting']['remote']['alioss']['bucket']]['location'] . '.aliyuncs.com';
            try {
                $ossClient = new \OSS\OssClient($_W['setting']['remote']['alioss']['key'], $_W['setting']['remote']['alioss']['secret'], $endpoint);
                $ossClient->uploadFile($_W['setting']['remote']['alioss']['bucket'], $filename, ATTACHMENT_ROOT . $filename);
            } catch (\OSS\Core\OssException $e) {
                return $e->getMessage();
            }
            if ($auto_delete_local) {
                self::file_delete($filename);
            }
        } elseif ($_W['setting']['remote']['type'] == '3') {
            load()->library('qiniu');
            $auth = new Qiniu\Auth($_W['setting']['remote']['qiniu']['accesskey'], $_W['setting']['remote']['qiniu']['secretkey']);
            $config = new Qiniu\Config();
            $uploadmgr = new Qiniu\Storage\UploadManager($config);
            $putpolicy = Qiniu\base64_urlSafeEncode(json_encode(array(
                'scope' => $_W['setting']['remote']['qiniu']['bucket'] . ':' . $filename,
            )));
            $uploadtoken = $auth->uploadToken($_W['setting']['remote']['qiniu']['bucket'], $filename, 3600, $putpolicy);
            list($ret, $err) = $uploadmgr->putFile($uploadtoken, $filename, ATTACHMENT_ROOT . '/' . $filename);
            if ($auto_delete_local) {
                self::file_delete($filename);
            }
            if ($err !== null) {
                return '远程附件上传失败，请检查配置并重新上传';
            } else {
                return true;
            }
        } elseif ($_W['setting']['remote']['type'] == '4') {
            if (!empty($_W['setting']['remote']['cos']['local'])) {
                load()->library('cos');
                qcloudcos\Cosapi::setRegion($_W['setting']['remote']['cos']['local']);
                $uploadRet = qcloudcos\Cosapi::upload($_W['setting']['remote']['cos']['bucket'], ATTACHMENT_ROOT . $filename, '/' . $filename, '', 3 * 1024 * 1024, 0);
            } else {
                load()->library('cosv3');
                $uploadRet = \Qcloud_cos\Cosapi::upload($_W['setting']['remote']['cos']['bucket'], ATTACHMENT_ROOT . $filename, '/' . $filename, '', 3 * 1024 * 1024, 0);
            }
            if ($uploadRet['code'] != 0) {
                switch ($uploadRet['code']) {
                    case -62:
                        $message = '输入的appid有误';
                        break;
                    case -79:
                        $message = '输入的SecretID有误';
                        break;
                    case -97:
                        $message = '输入的SecretKEY有误';
                        break;
                    case -166:
                        $message = '输入的bucket有误';
                        break;
                }

                return $message;
            }
            if ($auto_delete_local) {
                self::file_delete($filename);
            }
        }
    }
    /**
     * Comment: 图片上传后删除本地图片
     * Author: zzw
     * Date: 2019/8/29 17:14
     * @param $file
     * @return bool
     */
    private function file_delete($file) {
        if (empty($file)) {
            return false;
        }
        if (file_exists($file)) {
            @unlink($file);
        }
        if (file_exists(ATTACHMENT_ROOT . '/' . $file)) {
            @unlink(ATTACHMENT_ROOT . '/' . $file);
        }
        return true;
    }
    /**
     * Comment: 获取已购买当前商品的用户信息   已参与的人数
     * Author: zzw
     * Date: 2019/8/29 17:15
     * @param $state    int  状态：代表商品类型  1=抢购商品   2=团购商品  3=拼团商品  5=优惠卷
     * @param $id       int  商品id
     * @return mixed
     */
    static function PurchaseUser($state, $id) {
        global $_W, $_GPC;
        $limit = 5;
        //条件拼装
        $where = " a.uniacid = {$_W['uniacid']} AND a.aid = {$_W['aid']}";//条件
        $table = 'order';//表
        switch ($state) {
            case 1:
                $table = 'rush_order';
                $where .= " AND `activityid` = {$id} ";
                break;//抢购商品
            case 2:
                $where .= " AND a.plugin = 'groupon' AND a.fkid = {$id} ";
                break;//团购商品
            case 3:
                $where .= " AND a.plugin = 'wlfightgroup' AND a.fkid = {$id} ";
                break;//拼团商品
            case 5:
                $where .= " AND a.plugin = 'coupon' AND a.fkid = {$id} ";
                break;//优惠卷
            case 7:
                $where .= " AND a.plugin = 'bargain' AND a.fkid = {$id} ";
                break;//砍价商品
        }
        //获取内容
        $info = pdo_fetchall("SELECT b.id,b.nickname,b.avatar FROM " . tablename(PDO_NAME . $table)
            . " a LEFT JOIN "
            . tablename(PDO_NAME . "member")
            . " b ON a.mid = b.id WHERE {$where} AND b.nickname <> '' GROUP BY a.mid ORDER BY a.id DESC  LIMIT {$limit} ");//GROUP BY a.mid
        $count = pdo_fetchall("SELECT * FROM " . tablename(PDO_NAME . $table)
            . " a LEFT JOIN "
            . tablename(PDO_NAME . "member")
            . " b ON a.mid = b.id WHERE {$where} AND b.nickname <> '' GROUP BY a.mid ");
        //信息拼装
        $data['info'] = $info;
        $data['count'] = count($count);

        return $data;
    }
    /**
     * Comment: 获取商品多规格信息列表
     * Author: zzw
     * Date: 2019/8/29 17:16
     * @param $id
     * @param $type
     * @return array
     */
    static function getSpec($id, $type) {
        global $_W;
        #1、根据商品类型判断获取条件
        # 商品type：1=抢购  2=团购  3=拼团 4=大礼包(无佣金) 5=优惠卷 6=折扣卡(无佣金) 7=砍价商品
        # 规格type：1抢购 2拼团 3团购
        $where = " WHERE uniacid = {$_W['uniacid']} AND goodsid = {$id} ";
        switch ($type){
            case 1:$where .= " AND type = 1";break;//抢购
            case 2:$where .= " AND type = 3";break;//团购
            case 3:$where .= " AND type = 2";break;//拼团
            default:return [];break;//当前商品不支持多规格
        }
        #2、获取规格信息
        $list = pdo_fetchall("SELECT title,content FROM ".tablename(PDO_NAME."goods_spec").$where." ORDER BY displayorder ASC ");
        foreach($list as $key => &$val){
            //生成规格参数查询条件
            $idList = unserialize($val['content']);
            if(is_array($idList) && count($idList) > 1){
                $ids = implode($idList,',');
                $itemWhere = " WHERE id in ({$ids}) ";
            }else{
                $itemWhere = " WHERE id = {$idList[0]} ";
            }
            //获取规格参数信息
            $val['item'] = pdo_fetchall(" SELECT id,title,thumb FROM ".tablename(PDO_NAME."goods_spec_item").$itemWhere." ORDER BY displayorder ASC ");
            foreach($val['item'] as $index => &$item){
                $item['thumb'] = tomedia($item['thumb']);
            }
            unset($val['content']);
        }
        #3、获取规格组合后的销售信息
        $info = pdo_fetchall("SELECT id,specs,stock,price,vipprice FROM ".tablename(PDO_NAME."goods_option").$where." ORDER BY id ASC ");
        #4、循环处理数据
        foreach($info as $infoK => &$infoV){
            $discount_price = ($infoV['price'] - $infoV['vipprice']);
            $infoV['discount_price'] = sprintf("%.2f", $discount_price);
        }
        #5、数据拼装
        $data['list'] = $list;//规格信息列表
        $data['info'] = $info;//规格参数列表

        return $data;
    }
    /**
     * Comment: 小程序首页商品信息查询
     * Author: zzw
     * Date: 2019/8/29 17:17
     * @param $plugin
     * @param $id
     * @return bool
     */
    static function getHomeGoods($plugin, $id,$storeflag = 0) {
        global $_W;
        #商品类型：1=抢购  2=团购  3=拼团 4=大礼包 5=优惠卷 6=折扣卡 7=砍价商品 8=积分商品
        #1、获取商品信息
        switch ($plugin) {
            case 1:
                $goods = pdo_fetch("SELECT a.communityid,'1' as type,b.logo as shop_logo,a.op_one_limit as buy_limit,a.status,a.id,a.thumb as logo,a.name as goods_name,a.price,a.oldprice,a.num as totalnum,b.storename,b.id as sid,a.starttime,a.endtime,a.vipprice,a.vipstatus,a.allsalenum,b.address FROM "
                    . tablename(PDO_NAME . "rush_activity")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . " b ON a.sid = b.id WHERE a.id = {$id} ");
                $goods['plugin'] = 'rush';
                $goods['postertype'] = '3';
                break;//抢购商品
            case 2:
                $goods = pdo_fetch("SELECT a.communityid,'2' as type,b.logo as shop_logo,a.op_one_limit as buy_limit,b.address,a.status,a.id,a.thumb as logo,a.name as goods_name,a.price,a.oldprice,a.num as totalnum,b.storename,b.id as sid,a.starttime,a.endtime,a.vipprice,a.vipstatus,a.falsesalenum as allsalenum FROM "
                    . tablename(PDO_NAME . "groupon_activity")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . " b ON a.sid = b.id WHERE a.id = {$id} ");
                $goods['plugin'] = $pluginType = 'groupon';
                $goods['postertype'] = '4';
                break;//团购商品
            case 3:
                $goods = pdo_fetch("SELECT a.communityid,'3' as type,b.logo as shop_logo,a.buylimit as buy_limit,b.address,a.status,a.id,a.logo,a.name as goods_name,a.price,a.aloneprice as oldprice,stock as totalnum,a.peoplenum,b.storename,b.id as sid,a.vipdiscount as discount_price,a.realsalenum,a.falsesalenum as allsalenum FROM "
                    . tablename(PDO_NAME . "fightgroup_goods")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . " b ON a.merchantid = b.id WHERE a.id = {$id} ");
                $goods['plugin'] = $pluginType = 'wlfightgroup';
                $goods['postertype'] = '6';
                break;//拼团商品
            case 4:
                //获取礼包信息
                $goods = pdo_fetch("SELECT '1' as is_link,a.type as exttype,a.extlink,a.extinfo,'4' as type,b.logo as shop_logo,
a.id,a.limit,a.datestatus,a.title as `name`,a.price,a.usetimes,a.usetimes as surplus,b.storename,
b.logo,b.id as sid,REPLACE('table','table','package') as `plugin`,a.datestatus,allnum,resetswitch  FROM "
                    . tablename(PDO_NAME . "package")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . "b ON a.merchantid = b.id WHERE a.id = {$id} ");
                $goods['logo'] = tomedia($goods['logo']);
                $goods['shop_logo'] = tomedia($goods['shop_logo']);
                //获取已被使用的数量礼包库存
                $hasUsed = pdo_fetchcolumn("SELECT COUNT(*) as stk FROM " . tablename(PDO_NAME . "timecardrecord") . " WHERE `type` = 2 AND activeid = {$id}");
                $goods['stk'] = $goods['allnum'];
                if ($goods['allnum'] > 0) {
                    $goods['stk'] = $goods['allnum'] - $hasUsed;
                }
                //查看用户剩余次数
                if ($_W['mid']) {
                    //获取查询条件及可以使用的总次数
                    $where = " WHERE `type` = 2 AND activeid = {$id} AND mid = {$_W['mid']} ";
                    //判断是否开启周期使用
                    if($goods['datestatus'] > 1) {
                        switch ($goods['datestatus']) {
                            case 2:
                                $startTime = strtotime("-1 week");
                                break;//每周
                            case 3:
                                $startTime = strtotime("-1 month");
                                break;//每月
                            case 4:
                                $startTime = strtotime("-1 year");
                                break;//每年
                        }
                        //判断是否开启续卡重置功能
                        if ($goods['resetswitch'] == 1) {
                            //获取用户最近续卡时间
                            $time = pdo_fetchcolumn("SELECT paytime FROM " . tablename(PDO_NAME . "halfcard_record")
                                                    . " WHERE uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND mid = {$_W['mid']} AND cardid > 0 ORDER BY paytime DESC");
                            if ($startTime < $time) $startTime = $time;//续卡重置礼包使用时间
                        }
                        //生成周期时间条件
                        switch ($goods['datestatus']) {
                            case 2:
                                $where .= " AND usetime >= " . $startTime;
                                break;//每周
                            case 3:
                                $where .= " AND usetime >= " . $startTime;
                                break;//每月
                            case 4:
                                $where .= " AND usetime >= " . $startTime;
                                break;//每年
                        }
                    }
                    //获取已使用数量
                    $surplus = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename(PDO_NAME . "timecardrecord") . $where);
                    $goods['surplus'] = ($goods['usetimes'] - $surplus) > 0 ? ($goods['usetimes'] - $surplus) : 0;
                    //判断用户是否为一卡通会员 并且获取一卡通的id
                    $goods['card'] = self::VipVerification($_W['mid'],true);
                }
                //外链礼包的信息处理
                if ($goods['exttype'] == 1) {
                    $setInfo = unserialize($goods['extinfo']);
                    $goods['url']        = $goods['extlink'];
                    $goods['storename']  = $setInfo['storename'];
                    $goods['shop_logo']  = tomedia($setInfo['storelogo']);
                    $goods['is_link']    = intval(0);//0=外链礼包
                }
                unset($goods['extinfo']);
                unset($goods['extlink']);
                unset($goods['storelogo']);

                return $goods;
                break;//大礼包
            case 5:
                $goods = pdo_fetch("SELECT a.pv,a.extflag,a.extlink,a.extinfo,'5' as type,b.logo as shop_logo,a.get_limit as buy_limit,a.status,a.id,a.logo,a.title as goods_name,a.price,a.vipstatus,a.vipprice,quantity as totalnum,b.storename,b.id as sid,a.surplus,a.is_charge FROM "
                    . tablename(PDO_NAME . "couponlist")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . " b ON a.merchantid = b.id WHERE a.id = {$id} ");
                $goods['plugin'] = $pluginType = 'coupon';
                //外链卡卷的信息处理
                if($goods['extflag'] == 1){
                    $extInfo = unserialize($goods['extinfo']);
                    $goods['storename'] = $extInfo['storename'];
                }
                $goods['postertype'] = '5';
                break;//优惠卷
            case 6:
                $goods = pdo_fetch("SELECT '1' as is_link,a.type as exttype,a.extlink,a.extinfo,'6' as type,
b.logo as shop_logo,a.timeslimit as buy_limit,a.id,a.title as `name`,a.limit,a.datestatus,a.week,a.day,a.activediscount,
a.discount,a.daily,b.id as sid,b.storename,b.logo,a.level,b.payonline FROM "
                    . tablename(PDO_NAME . "halfcardlist")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . " b ON a.merchantid = b.id WHERE a.id = {$id} ");
                $goods['plugin'] = $pluginType = 'halfcard';
                $goods['logo'] = tomedia($goods['logo']);
                $goods['shop_logo'] = tomedia($goods['shop_logo']);
                //判断用户是否为一卡通会员 并且获取一卡通的id
                if ($_W['mid']){
                    $vipInfo = self::VipVerification($_W['mid']);
                    $goods['card'] = $vipInfo['id'];
                }
                //判断等级限制  获取折扣信息
                $lvevl = unserialize($goods['level']);
                if(!in_array($vipInfo['levelid'],$lvevl) && count($lvevl) > 0 && $vipInfo['levelid'] > 0){
                    $goods['discount'] = 10;
                }else{
                    //获取当前折扣卡今天的折扣情况
                    $weekflag = date('w', time());//星期
                    $dayflag2 = date('j', time());//日期
                    switch ($goods['datestatus']) {
                        case 1:
                            //日期格式：星期
                            $goods['week'] = unserialize($goods['week']);
                            if (in_array($weekflag, $goods['week'])) {
                                $goods['discount'] = $goods['activediscount'];
                            }
                            break;
                        case 2:
                            //日期格式：日期
                            $goods['day'] = unserialize($goods['day']);
                            if (in_array($dayflag2, $goods['day'])) {
                                $goods['discount'] = $goods['activediscount'];
                            }
                            break;
                    }
                }
                //外链折扣卡的信息处理
                if ($goods['exttype'] == 1) {
                    $setInfo = unserialize($goods['extinfo']);
                    $goods['storename'] = $setInfo['storename'];
                    $goods['logo']      = tomedia($setInfo['storelogo']);
                    $goods['url']       = $goods['extlink'];
                    $goods['is_link']   = intval(0);//0=外链折扣卡
                }
                unset($goods['extinfo']);
                unset($goods['extlink']);
                unset($goods['exttype']);
                unset($goods['week']);
                unset($goods['day']);
                unset($goods['activediscount']);
                unset($goods['daily']);
                unset($goods['datestatus']);

                return $goods;
                break;//折扣卡
            case 7:
                $goods = pdo_fetch("SELECT a.communityid,'7' as type,b.logo as shop_logo,b.address,a.status,a.id,a.thumb as logo,a.name as goods_name,stock as totalnum,b.storename,b.id as sid,a.starttime,a.endtime,a.vipprice,a.vipstatus,a.oldprice,a.price FROM "
                    . tablename(PDO_NAME . "bargain_activity")
                    . " a LEFT JOIN " . tablename(PDO_NAME . "merchantdata")
                    . " b ON a.sid = b.id WHERE a.id = {$id} ");
                $goods['plugin'] = 'bargain';
                $goods['postertype'] = '7';
                break;//砍价商品
            case 8:
                #2、判断用户是否为会员
                $cardid = WeChat::VipVerification($_W['mid'],true);
                #3、获取商品详细信息
                $field = " id,advs,title,thumb,old_price,description,pv,stock,community_id,`describe`,
                    CASE WHEN {$cardid} > 0 AND vipstatus = 1 THEN vipcredit1 
                         ELSE  use_credit1
                    END as use_credit1,
                    CASE WHEN {$cardid} > 0 AND vipstatus = 1 THEN vipcredit2 
                         ELSE use_credit2
                    END as price ";
                $info = pdo_fetch("SELECT {$field} FROM " . tablename(PDO_NAME . "consumption_goods") . " WHERE id = {$id} ");
                if (!$info) Commons::sRenderError('商品不存在!');
                $info['thumb']       = tomedia($info['thumb']);
                $info['description'] = htmlspecialchars_decode($info['description']);
                $info['is_vip']      = $cardid;
                #4、幻灯片处理
                $info['advs'] = unserialize($info['advs']);
                if (is_array($info['advs']) && count($info['advs']) > 0) {
                    foreach ($info['advs'] as $key => &$val) {
                        $val = tomedia($val);
                    }
                }
                #5、浏览量添加
                $pv = $info['pv'] + 1;
                pdo_update(PDO_NAME . "consumption_goods" , [ 'pv' => $pv ] , [ 'id' => $id ]);
                #6、获取销量
                $info['total'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename(PDO_NAME . "order") . " WHERE plugin = 'consumption' AND fkid = {$id} ");
                #7、获取社群设置
                if ($info['community_id'] > 0) {
                    $community                 = pdo_get(PDO_NAME . "community" , [ 'id' => $info['community_id'] ]
                        , [ 'communname' , 'commundesc' , 'communimg' , 'communqrcode' ]);
                    $community['name']    = $community['communname'];//社群名称
                    $community['desc']    = $community['commundesc'];//社群描述
                    $community['icon']    = tomedia($community['communimg']);//社群图标
                    $community['qr_code'] = tomedia($community['communqrcode']);//社群二维码
                }
                $info['community'] = $community;
                #8、获取购买人头像信息
                $member              = pdo_fetchall("SELECT b.avatar FROM " . tablename(PDO_NAME . "order")
                                                    . " as a LEFT JOIN " . tablename(PDO_NAME . "member")
                                                    . " as b ON a.mid = b.id WHERE a.plugin = 'consumption' AND a.fkid = {$id} GROUP BY b.id LIMIT 5");
                $info['avatar_list'] = is_array($member) && count($member) > 0 ? array_column($member , 'avatar') : [];
                #9、一卡通文本信息获取
                $info['halfcard_text'] = !empty($_W['wlsetting']['halfcard']['text']['halfcardtext']) ? $_W['wlsetting']['halfcard']['text']['halfcardtext'] : '一卡通';
                #10、分销助手，获取当前用户分享最高可以获得的佣金
                if($_W['wlmember']['distributorid'] > 0 ){
                    $disWhere = [ 'id' => $_W['wlmember']['distributorid']];
                }else{
                    $disWhere = [ 'isdefault' => 1];
                }
                $proportion = pdo_getcolumn(PDO_NAME . "dislevel" , $disWhere , ['onecommission']);
                $proportion = sprintf("%.2f",$proportion ? $proportion/100 : 0);
                $sql = "SELECT 	CASE 
                            WHEN onedismoney > (`use_credit2`*{$proportion}) THEN onedismoney
                            ELSE (`use_credit2`*{$proportion})
                        END as commission FROM ".tablename(PDO_NAME."consumption_goods")." WHERE id = {$id}";
                $info['dis_assistant']['max_commission'] = sprintf("%.2f",pdo_fetchcolumn($sql));
                //判断是否为分销商
                $dis = pdo_getcolumn(PDO_NAME."distributor",['disflag'=>1,'mid'=>$_W['mid']],'id');
                $info['dis_assistant']['is_dis'] = $dis > 0 ? 1 : 0 ;//是否为分销商1=是；0=不是
                #10、修改商品的人气（浏览量）信息
                $pv = intval($info['pv']) + 1;
                pdo_update(PDO_NAME."consumption_goods",['pv'=>$pv],['id'=>$id]);

                return $info;
                break;//积分商品
        }
        #2、获取商品销量
        $goods['logo'] = tomedia($goods['logo']);
        $goods['shop_logo'] = tomedia($goods['shop_logo']);
        if ($plugin == 1) {
            //抢购商品的销量
            $stopBuyNum = implode(pdo_fetch("SELECT sum(num) FROM " . tablename(PDO_NAME . "rush_order") . " WHERE activityid = {$goods['id']} AND uniacid = {$_W['uniacid']} AND status IN (0,1,2,3,6,9,4,8) AND aid = {$_W['aid']}"));
        } else if ($plugin == 5) {
            //卡卷的销量  虚拟销量 无
            //$stopBuyNum = pdo_fetchcolumn('SELECT count(id) FROM '.tablename('wlmerchant_member_coupons')." WHERE aid = {$_W['aid']} AND uniacid = {$_W['uniacid']} AND parentid = {$id}");
            $stopBuyNum = $goods['surplus'];
        } /*else if ($plugin == 3) {
            //拼团的销量等于realsalenum
            $stopBuyNum = $goods['realsalenum'];
        }*/ else if ($plugin == 7) {
            $stopBuyNum = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('wlmerchant_order') . " WHERE uniacid = {$_W['uniacid']} AND  fkid = {$id} AND plugin = 'bargain' AND status IN (1,2,3,4,8,6,7,9) ");
        } else {
            $stopBuyNum = implode(pdo_fetch("SELECT sum(num) FROM " . tablename(PDO_NAME . "order") . " WHERE  fkid = {$goods['id']} AND plugin = '{$pluginType}'  AND uniacid = {$_W['uniacid']} AND status IN (0,1,2,3,6,7,9,4,8) AND aid = {$_W['aid']} "));
        }
        #3、加上虚拟销量
        if ($goods['allsalenum'] && empty($storeflag)) {
            $stopBuyNum = intval($stopBuyNum) + intval($goods['allsalenum']);
            $goods['totalnum'] = $goods['totalnum'] + $goods['allsalenum'];
        }
        $purchaseUser = WeChat::PurchaseUser($plugin, $goods['id']);
        $goods['user_list'] = array_column($purchaseUser['info'], 'avatar');//购买当前商品的用户的头像
        $goods['user_num'] = $purchaseUser['count'];//已参与人数
        $goods['buy_num'] = $stopBuyNum ? $stopBuyNum : 0;//获取已售数量
        #4、已销售数量的百分比
        if($goods['buy_num'] > 0 && $goods['totalnum'] > 0){
            $goods['buy_percentage'] = sprintf("%.2f", ($goods['buy_num'] / $goods['totalnum']) * 100);
        }else{
            $goods['buy_percentage'] = 0.00;
        }
        $goods['stk'] = $goods['totalnum'] - $stopBuyNum;
        #6、判断用户会员信息 获取商品基础价格
        $goods['pay_state'] = 0;//购买状态 0=可以购买
        if($_W['mid']){
            $goods['is_vip'] = WeChat::VipVerification($_W['mid'],true);//获取当前用户的会员卡id  等于0则不是会员
            if($goods['vipstatus'] > 0){
                if($goods['vipstatus'] == 2 && ($goods['is_vip'] <= 0 || empty($goods['is_vip']))){
                    $goods['pay_state'] = 1;//购买状态 1=会员特供，用户不是会员，不可购买
                }
            }
        }
        #7、判断用户购买限制
        if ($goods['buy_limit'] > 0) {
            //获取用户已购买的商品数量  商品类型：1=抢购  2=团购  3=拼团 4=大礼包 5=优惠卷 6=折扣卡 7=砍价商品
            switch ($plugin){
                case 1:
                    $userBuyNum = implode(pdo_fetch('SELECT sum(num) FROM '
                                                    .tablename(PDO_NAME . "rush_order")
                                                    ." WHERE activityid = {$id} AND status IN (0,1,2,3,6,9,4,8) AND mid = {$_W['mid']} "));
                    break;//抢购
                default:
                    $userBuyNum = pdo_fetchcolumn('SELECT sum(num) FROM '
                                                  . tablename(PDO_NAME.'order')
                                                  . " WHERE fkid = {$id} AND plugin = '{$goods['plugin']}' AND status IN (1,2,3,4,8,6,7,9) AND mid = {$_W['mid']} ");
                    break;//团购、大礼包、折扣卡、拼团、砍价、卡卷
            }
            $goods['user_limit_num'] = $goods['buy_limit'] - $userBuyNum;//当前用户还能购买的数量
        }
        return $goods;
    }
    /**
     * Comment: 小程序首页获取头条信息
     * Author: zzw
     * Date: 2019/8/29 17:18
     * @param $id
     * @return bool
     */
    static function getHomeLine($id) {
        $line = pdo_fetch("SELECT id,title,summary,display_img,author,author_img,browse,one_id,two_id FROM "
            . tablename(PDO_NAME . "headline_content")
            . " WHERE id = {$id} ");
        if(!$line) return '';
        $line['display_img'] = tomedia($line['display_img']);
        $line['author_img'] = tomedia($line['author_img']);
        $line['one_name'] = pdo_getcolumn(PDO_NAME . 'headline_class', ['id' => $line['one_id']], 'name');
        $line['two_name'] = pdo_getcolumn(PDO_NAME . 'headline_class',['id' => $line['two_id']], 'name');
        unset($line['one_id']);
        unset($line['two_id']);
        return $line;
    }
    /**
     * Comment: 搜索内容 店铺，头条，商品(抢购，团购，拼团,卡卷，砍价)
     * Author: zzw
     * Date: 2019/8/29 17:18
     * @param $page     int     页数
     * @param $search   string  搜索内容
     * @param $lng      float   经度
     * @param $lat      float   纬度
     * @return mixed
     */
    static function getSearch($page, $search, $lng, $lat) {
        global $_W;
        $pageNum = 10;
        $startLine = $page * $pageNum - $pageNum;
        #1、商品搜索：商品名称  商品价格   商品仅搜索抢购商品，团购商品，拼团商品,卡卷商品，砍价商品，
        $where = "uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND (`name` LIKE '%{$search}%' OR price LIKE '%{$search}%')";
        $goodsList = pdo_fetchall('SELECT id,price,thumb as logo,`name`,oldprice,sid,levelnum, "peoplenum",REPLACE("type",\'type\',\'rush\') as \'type\',REPLACE("group",\'group\',\'抢购\') as \'group\'  FROM '
            . tablename(PDO_NAME . "rush_activity")
            . " WHERE {$where} AND status IN (1,2) "
            . ' UNION ALL SELECT id,price,thumb as logo,`name`,oldprice,sid,levelnum,  "peoplenum","groupon","团购" FROM '
            . tablename(PDO_NAME . "groupon_activity")
            . " WHERE {$where} AND status IN (1,2) "
            . ' UNION ALL SELECT id,price,logo,`name`,aloneprice as oldprice,merchantid as sid,stock as levelnum,peoplenum, "fightgroup","拼团" FROM '
            . tablename(PDO_NAME . "fightgroup_goods")
            . " WHERE {$where} AND status = 1 "
            . ' UNION ALL SELECT id,price,logo,`name`,"oldprice",merchantid as sid,quantity as levelnum,"peoplenum", "coupon","卡券" FROM '
            . tablename(PDO_NAME . "couponlist")
            . " WHERE {$where} AND status = 1 "
            . ' UNION ALL SELECT id,price,thumb as logo,`name`,oldprice,sid,stock as levelnum,  "peoplenum","bargain","砍价" FROM '
            . tablename(PDO_NAME . "bargain_activity")
            . " WHERE {$where} AND status IN (1,2) "
        );
        $data['count']['goodsList'] = count($goodsList);
        $goodsList = array_slice($goodsList, $startLine, $pageNum);
        //循环获取商品关联的店铺名称 店铺距离 购买人数
        foreach ($goodsList as $k => &$v) {
            $v['logo'] = tomedia($v['logo']);
            //店铺名称 店铺距离
            $shopInfo = pdo_get(PDO_NAME . "merchantdata", array("id" => $v['sid']), array('storename', 'location'));
            $location = unserialize($shopInfo['location']);
            $distance = Store::getdistance($location['lng'], $location['lat'], $lng, $lat);
            if ($distance) {
                if ($distance > 1000) {
                    $distance = (floor(($distance / 1000) * 10) / 10) . "km";
                } else {
                    $distance = round($distance) . "m";
                }
            }
            $v['store_name'] = $shopInfo['storename'];
            $v['distance'] = $distance;
            //购买人数
            $buyW = " uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} ";
            if ($v['type'] == 'rush') {
                $buyNum = pdo_fetch("SELECT count(*) as num FROM " . tablename(PDO_NAME . "rush_order") . " WHERE {$buyW} AND activityid = {$v['id']} AND status IN (1,2,3,4,5,6)");
                $jumpLink = h5_url('pages/mainPages/goods/index',['type'=>1,'id'=>$v['id']]);
            } else if ($v['type'] == 'groupon') {
                $buyNum = pdo_fetch("SELECT count(*) as num FROM " . tablename(PDO_NAME . "order") . " WHERE {$buyW} AND plugin = 'groupon' AND fkid = {$v['id']} AND status IN (1,2,3,4,5,6)");
                $jumpLink = h5_url('pages/mainPages/goods/index',['type'=>2,'id'=>$v['id']]);
            } else if ($v['type'] == 'fightgroup') {
                $buyNum = pdo_fetch("SELECT count(*) as num FROM " . tablename(PDO_NAME . "order") . " WHERE {$buyW} AND plugin = 'wlfightgroup' AND fkid = {$v['id']} AND status IN (1,2,3,4,5,6)");
                $jumpLink = h5_url('pages/mainPages/goods/index',['type'=>3,'id'=>$v['id']]);
            } else if ($v['type'] == 'coupon') {
                $buyNum = pdo_fetch("SELECT count(*) as num FROM " . tablename(PDO_NAME . "order") . " WHERE {$buyW} AND plugin = 'coupon' AND fkid = {$v['id']} AND status IN (1,2,3,4,5,6)");
                $jumpLink = h5_url('pages/mainPages/goods/index',['type'=>5,'id'=>$v['id']]);
            } else if ($v['type'] == 'bargain') {
                $buyNum = pdo_fetch("SELECT count(*) as num FROM " . tablename(PDO_NAME . "order") . " WHERE {$buyW} AND plugin = 'bargain' AND fkid = {$v['id']} AND status IN (1,2,3,4,5,6)");
                $jumpLink = h5_url('pages/mainPages/goods/index',['type'=>7,'id'=>$v['id']]);
                $v['is_charge'] = pdo_getcolumn(PDO_NAME.'couponlist',array('id'=>$v['id']),'is_charge');
            }
            $v['jump_link'] = $jumpLink;
            $v['buyNum'] = 0;
            if ($buyNum) {
                $v['buyNum'] = intval(implode($buyNum));
            }
            unset($v['sid']);
        }
        #2、头条搜索：头条标题
        $headlineList = pdo_fetchall("SELECT id,display_img,title,browse FROM " . tablename(PDO_NAME . "headline_content")
            . " WHERE uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND title LIKE '%{$search}%' ORDER BY release_time DESC");
        $data['count']['headlineList'] = count($headlineList);
        $headlineList = array_slice($headlineList, $startLine, $pageNum);
        foreach ($headlineList as $k => &$v) {
            $v['display_img'] = tomedia($v['display_img']);
            $v['jump_link'] = h5_url('pages/mainPages/headline/headlineDetail',['headline_id'=>$v['id']]);//头条详情链接
        }
        #3、店铺搜索：店铺名称 店铺地址
        $shopList = pdo_fetchall("SELECT id,storename,logo,address,location,storehours,pv,score FROM " . tablename(PDO_NAME . "merchantdata")
            . " WHERE uniacid = {$_W['uniacid']} AND aid = {$_W['aid']} AND status = 2 AND enabled = 1 AND storename LIKE '%{$search}%'");
        $shopList = Store::getstores($shopList, $lng, $lat, 4);
        $shopList = self::getStoreList($shopList);
        $data['count']['shopList'] = count($shopList);
        $shopList = array_slice($shopList, $startLine, $pageNum);
        foreach ($shopList as $k => &$v) {
            $v['jump_link'] = h5_url('pages/mainPages/store/index',['sid'=>$v['id']]);
        }
        #4、数据拼装
        $data['goodsList'] = $goodsList;
        $data['headlineList'] = $headlineList;
        $data['shopList'] = $shopList;

        return $data;
    }
    /**
     * Comment: 根据信息获取页面信息，菜单信息，广告信息
     * Author: zzw
     * Date: 2019/8/29 17:21
     * @param $pageInfo
     * @param $menuid
     * @param $advid
     * @return mixed
     */
    static function getPageInfo($pageInfo, $menuid, $advid) {
        global $_W, $_GPC;
        $page['title'] = $pageInfo['title'];
        $page['background'] = $pageInfo['background'];
        $page['share_title'] = $pageInfo['share_title'];
        $page['share_image'] = tomedia($pageInfo['share_image']);
        if ($menuid > 0) {
            $menudata = Diy::getMenu($menuid)['data'];
        }
        if ($advid > 0) {
            $advdata = Diy::BeOverdue($advid, false)['data'];
        }
        //信息拼装
        $data['page'] = $page;//本页面配置信息
        $data['menu'] = $menudata;//菜单配置信息
        $data['adv'] = $advdata;//广告配置信息
        return $data;
    }
    /**
     * Comment: 验证码发送组一
     * Author: zzw
     * Date: 2019/8/29 17:22
     * @param $code
     * @param $mobile
     * @return array
     */
    static function smsSF($code, $mobile) {
        global $_W;
        $smsset = unserialize(pdo_getcolumn(PDO_NAME . "setting", array('key' => 'smsset'), 'value'));
        $baseset = unserialize(pdo_getcolumn(PDO_NAME . "setting", array('key' => 'base'), 'value'));
        $smses = pdo_get(PDO_NAME . "smstpl", array('uniacid' => $_W['uniacid'], 'id' => $smsset['dy_sf']));
        $param = unserialize($smses['data']);
        $datas = array(
            array('name' => '系统名称', 'value' => $baseset['name']),
            array('name' => '版权信息', 'value' => $baseset['copyright']),
            array('name' => '验证码', 'value' => $code)
        );
        foreach ($param as $d) {
            $params[$d['data_temp']] = self::replaceTemplate($d['data_shop'], $datas);
        }
        return self::sendSms($smses, $params, $mobile);
    }
    /**
     * Comment: 验证码发送组二
     * Author: zzw
     * Date: 2019/8/29 17:22
     * @param       $str
     * @param array $datas
     * @return mixed
     */
    static function replaceTemplate($str, $datas = array()) {
        foreach ($datas as $d) {
            $str = str_replace('【' . $d['name'] . '】', $d['value'], $str);
        }
        return $str;
    }
    /**
     * Comment: 验证码发送组三
     * Author: zzw
     * Date: 2019/8/29 17:22
     * @param        $smstpl
     * @param        $param
     * @param        $mobile
     * @param string $mid
     * @return array
     */
    static function sendSms($smstpl, $param, $mobile, $mid = '') {
        global $_W;
        $smsset = unserialize(pdo_getcolumn(PDO_NAME . "setting", array('key' => 'sms'), 'value'));
        if ($smstpl['type'] == 'aliyun') {
            include PATH_CORE . 'library/aliyun/Config.php';
            $profile = DefaultProfile::getProfile("cn-hangzhou", $smsset['note_appkey'], $smsset['note_secretKey']);
            DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Dysmsapi", "dysmsapi.aliyuncs.com");
            $acsClient = new DefaultAcsClient($profile);
            m('aliyun/sendsmsrequest')->setSignName($smsset['note_sign']);
            m('aliyun/sendsmsrequest')->setTemplateParam(json_encode($param));
            m('aliyun/sendsmsrequest')->setTemplateCode($smstpl['smstplid']);
            m('aliyun/sendsmsrequest')->setPhoneNumbers($mobile);
            $resp = $acsClient->getAcsResponse(m('aliyun/sendsmsrequest'));
            $res = Util::object_array($resp);
            if ($res['Code'] == 'OK') {
                self::create_apirecord(-1, '', $mid, $mobile, 1, '阿里云身份验证');
                $recode = array("result" => 1);
            } else {
                $recode = array("result" => 2, "msg" => $res['Message']);
            }
        } else {
            m('alidayu/topclient')->appkey = $smsset['note_appkey'];
            m('alidayu/topclient')->secretKey = $smsset['note_secretKey'];
            m('alidayu/smsnum')->setSmsType("normal");
            m('alidayu/smsnum')->setSmsFreeSignName($smsset['note_sign']);
            m('alidayu/smsnum')->setSmsParam(json_encode($param));
            m('alidayu/smsnum')->setRecNum($mobile);
            m('alidayu/smsnum')->setSmsTemplateCode($smstpl['smstplid']);
            $resp = m('alidayu/topclient')->execute(m('alidayu/smsnum'), '6100e23657fb0b2d0c78568e55a3031134be9a3a5d4b3a365753805');
            $res = Util::object_array($resp);
            if ($res['result']['success'] == 1) {
                self::create_apirecord(-1, '', $mid, $mobile, 1, '阿里大于身份验证');
                $recode = array("result" => 1);
            } else {
                $recode = array("result" => 2, "msg" => $res['sub_msg']);
            }
        }


        return $recode;
    }
    /**
     * Comment: 验证码发送组四
     * Author: zzw
     * Date: 2019/8/29 17:22
     * @param        $sendmid
     * @param string $sendmobile
     * @param        $takemid
     * @param        $takemobile
     * @param        $type
     * @param        $remark
     */
    static function create_apirecord($sendmid, $sendmobile = '', $takemid, $takemobile, $type, $remark) {
        global $_W;
        $data = array(
            'uniacid'    => $_W['uniacid'],
            'sendmid'    => $sendmid,
            'sendmobile' => $sendmobile,
            'takemid'    => $takemid,
            'takemobile' => $takemobile,
            'type'       => $type,
            'remark'     => $remark,
            'createtime' => time()
        );
        pdo_insert(PDO_NAME . 'apirecord', $data);
    }
    /**
     * Comment: 获取推荐商品信息列表
     * Author: zzw
     * Date: 2019/8/13 17:11
     * @param string $num  获取的数量
     * @param int $type 当前商品类型：1=抢购  2=团购  3=拼团 4=大礼包 5=优惠卷 6=折扣卡 7=砍价商品
     * @param int $id   当前商品id，存在时不会获取该商品
     * @return mixed
     */
    public static function getRecommendGoods($num,$type = 0,$id = 0){
        global $_W,$_GPC;
        #1、表
        $rush = tablename(PDO_NAME."rush_activity");//抢购商品表         1
        $group = tablename(PDO_NAME."groupon_activity");//团购商品表     2
        $fight = tablename(PDO_NAME."fightgroup_goods");//拼团商品表     3
        $bargain = tablename(PDO_NAME."bargain_activity");//砍价商品表   7
        $where = " WHERE aid ={$_W['aid']} AND uniacid = {$_W['uniacid']} ";
        $noId  = " AND id != {$id} ";
        #2、获取商品信息
        //抢购商品信息
        if($type == 1) $rushList = pdo_fetchall("SELECT id,'1' as type FROM ".$rush.$where.$noId." AND status = 2 ");
            else $rushList = pdo_fetchall("SELECT id,'1' as type FROM ".$rush.$where." AND status = 2 LIMIT 100");
        //团购商品信息
        if($type == 2) $groupList = pdo_fetchall("SELECT id,'2' as type FROM ".$group.$where.$noId." AND status = 2 ");
            else $groupList = pdo_fetchall("SELECT id,'2' as type FROM ".$group.$where." AND status = 2 LIMIT 100");
        //拼团商品信息
        if($type == 3) $fightList = pdo_fetchall("SELECT id,'3' as type FROM ".$fight.$where.$noId." AND status = 1 ");
            else $fightList = pdo_fetchall("SELECT id,'3' as type FROM ".$fight.$where." AND status = 1 LIMIT 100");
        //砍价商品信息
        if($type == 7) $bargainList = pdo_fetchall("SELECT id,'7' as type FROM ".$bargain.$where.$noId." AND status = 2 ");
            else $bargainList = pdo_fetchall("SELECT id,'7' as type FROM ".$bargain.$where." AND status = 2 LIMIT 100");
        #3、随机获取商品信息
        $list = array_merge($rushList,$groupList,$fightList,$bargainList);
        if(is_array($list) && count($list) > 0){
            for($i=0;$i<$num;$i++){
                if(count($list) > 0){
                    $key = array_rand($list);
                    $newList[$i] = self::getHomeGoods($list[$key]['type'], $list[$key]['id']);$list[$key];
                    unset($list[$key]);
                    unset($newList[$i]['user_list']);
                    unset($newList[$i]['user_num']);
                    unset($newList[$i]['stk']);
                    unset($newList[$i]['buy_percentage']);
                    unset($newList[$i]['is_vip']);
                    unset($newList[$i]['address']);
                    unset($newList[$i]['status']);
                    unset($newList[$i]['totalnum']);
                    unset($newList[$i]['storename']);
                    unset($newList[$i]['sid']);
                    unset($newList[$i]['starttime']);
                    unset($newList[$i]['endtime']);
                    unset($newList[$i]['vipprice']);
                    unset($newList[$i]['vipstatus']);
                    unset($newList[$i]['buy_limit']);
                    unset($newList[$i]['peoplenum']);
                    unset($newList[$i]['discount_price']);
                    unset($newList[$i]['realsalenum']);
                    unset($newList[$i]['allsalenum']);
                    unset($newList[$i]['buy_num']);
                    unset($newList[$i]['user_limit_num']);
                }else{
                    continue;
                }
            }
        }


        return $newList;
    }
    /**
     * Comment: 开启事务处理
     * Author: zzw
     * Date: 2019/8/15 11:47
     * @return bool
     */
    public static function startTrans(){
        return pdo_query(" BEGIN ");
    }
    /**
     * Comment: 提交事务处理
     * Author: zzw
     * Date: 2019/8/15 11:47
     * @return bool
     */
    public static function commit(){
        return pdo_query(" COMMIT ");
    }
    /**
     * Comment: 事务回滚
     * Author: zzw
     * Date: 2019/8/15 11:47
     * @return bool
     */
    public static function rollback(){
        return pdo_query(" ROLLBACK ");
    }
    /**
     * Comment: 获取二维码图片base64格式
     * Author: zzw
     * Date: 2019/8/20 18:09
     * @param $url
     * @return string
     */
    public static function getQrCode($url){
        global $_W,$_GPC;
        #1、长链接转短连接
        $result = Util::long2short($url);
        if (!is_error($result)) $url = $result['short_url'];
        #2、生成二维码
        require_once '../library/qrcode/QRcode.lib.php';
        ob_start();
        QRcode::png($url, false, QR_ECLEVEL_L, 16, 1,false,true);
        $image_data = base64_encode(ob_get_contents());
        ob_end_clean();
        $image_data = "data:image/png;base64," . $image_data;

        return $image_data;
    }
}



