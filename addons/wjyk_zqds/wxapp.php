<?php
defined('IN_IA') or exit('Access Denied');

class wjyk_zqdsModuleWxapp extends WeModuleWxapp
{
    
    /**
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=onlineOrder&m=wjyk_zqds
     */
    public function doPageOnlineOrder()
    {
        global $_GPC, $_W;
        
        include $this->template('index');
    }

    /**
     * 跳转在线点餐
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=toOnline&m=wjyk_zqds
     * @param
     *            sid
     * @param
     *            type  1-肯德基  2-麦当劳  3-百果园  4-奈雪的茶  5-瑞幸   6-星巴克  7-喜茶            
     */
    public function doPageToOnline()
    {
        global $_GPC, $_W;
        $type = $_GPC['type'];
        $sid = $_GPC['sid'];
        
        $set = pdo_get('wjyk_zqds_jtk_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        switch ($type){
            case 1;
            $url = "http://api.jutuike.com/tq_kfc/act";
            break;
            case 2;
            $url = "http://api.jutuike.com/mcdonald/act";
            break;
            case 3;
            $url = "http://api.jutuike.com/pagoda/act";
            break;
            case 4;
            $url = "http://api.jutuike.com/nayuki/act";
            break;
            case 5;
            $url = "http://api.jutuike.com/luckin/act";
            break;
            case 6;
            $url = "http://api.jutuike.com/spk/act";
            break;
            case 7;
            $url = "http://api.jutuike.com/heytea/act";
            break;
        }
    
        $data = array(
            'apikey' => $set['apikey'],
            'sid' =>  $sid
        );
        
        $return = json_decode($this->httpPost($url,$data),true);
        
        $redirect_uri = "";
        if($return['code'] == 1){
            $redirect_uri = $return['data']['h5_url'];
        }
        return self::result(0, 'success',$redirect_uri);
    }
    
    
    
    
    public function doPageManor()
    {
        $this->__app("manor");
    }
    
    public function doPageJdgoods()
    {        
        $this->__app("jdgoods");
    }

    public function doPageGoods()
    {
        $this->__app("goods");
    }

    public function doPageAddress()
    {
        $this->__app("address");
    }

    public function doPageUser()
    {
        global $_W, $_GPC;
        $t = time();
        pdo_update("wjyk_zqds_user", array(
            'is_member' => 0,
        ), array(
            'maturity_time <' => $t
        ));
        
        $this->__app("user");
    }

    public function doPageCommission()
    {
        $this->__app("commission");
    }

    public function doPageBrokerage()
    {
        $this->__app("brokerage");
    }
    
    public function doPageNews()
    {
        $this->__app("news");
    }
    
    public function doPageDigital()
    {
        $this->__app("digital");
    }
    
    public function doPageFilm()
    {        
        $this->__app("film");
    }
    
    public function doPageMember()
    {
        $this->__app("member");
    }
    
    public function doPageJtk()
    {
        $this->__app("jtk");
    }
    
    public function doPageTask()
    {
        $this->__app("task");
    }
    
    public function doPageCps()
    {
        $this->__app("cps");
    }
    
    public function __app($action)
    {
        require 'inc/app/' . $action . '.inc.php';
    }

    /**
     * 助通云-短信验证
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=sendMobile&m=wjyk_zqds
     *
     * @param
     *            integer telphone(电话号码)
     */
    public function doPageSendMobile()
    {
        global $_W, $_GPC;
        
        $note = pdo_get('wjyk_zqds_note', array(
            'uniacid' => $_W['uniacid']
        ));
        if ($note) {
            $smsapi = "http://api.mix2.zthysms.com/v2/sendSms"; // 短信网关
            $user = $note['user']; // 短信平台帐号
            $pass = $note['pass']; // 短信平台密码
            $message = $note['message']; // 短信模板
        } else {
            return self::result(- 1, '请在管理平台设置短信有关信息！');
        }
        
        $number = self::getRandNumber(1, 9, 6);
        
        if ($note['type'] == 1) {
            
            $message = str_replace("******", $number, $message);
            
            $url = $smsapi;
            $tKey = time();
            $password = md5(md5($pass) . $tKey);
            
            $data = array(
                'content' => $message, // 要发送的短信内容
                'mobile' => $_GPC['telphone'],
                'username' => $user, // 用户名
                'password' => $password, // 密码
                'tKey' => $tKey
            );
            $ret = $this->httpPost($url, $data);
            $json = json_decode($ret, true);
            if ($json['code'] == 200) {
                return self::result(0, 'success', $number);
            } else {
                return self::result(- 1, $json);
            }
        } elseif ($note['type'] == 2) {
            $config = [
                'accessKeyId' => $note['keyId'],
                'accessKeySecret' => $note['keySecret'],
                'signName' => $note['signName'],
                'templateCode' => $note['templateCode']
            ];
            
            include 'Sms.php';
            
            $sms = new \Sms($config);
            $phone = $_GPC['telphone'];
            
            $status = $sms->send_verify($phone, $number);
            if ($sms->error == 'OK') {
                return self::result(0, 'success', $number);
            } else {
                return self::result(- 1, $sms->error);
            }
        }
    }
    
    /**
     * 定时任务 庄园生成金币任务
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=timing&m=wjyk_zqds
     */
    public function doPageTiming()
    {
        global $_GPC, $_W;
        
        
        $userList = pdo_getall('wjyk_zqds_user_manor', array(
            'uniacid' => $_W['uniacid']
        ));
        $levelList = pdo_getall('wjyk_zqds_manor_level',array(
            'uniacid' => $_W['uniacid']
        ), array(), '', array('need desc'));

        for ($i = 0; $i < count($userList); $i ++) {
            for ($j = 0; $j < count($levelList); $j ++) {

                if ($levelList[$j]['need'] <= $userList[$i]['already']) {
                    $userList[$i]['level'] = $levelList[$j]['name'];
                    $userList[$i]['is_open'] = $levelList[$j]['is_open'];
                    $userList[$i]['count'] = $levelList[$j]['count'];
                    $userList[$i]['max_integral'] = $levelList[$j]['max_integral'];
                    $userList[$i]['min_integral'] = $levelList[$j]['min_integral'];
                    break;
                }
            }
        }
        
        

        $nowtime = date('Y-m-d', time());
        
        foreach ($userList as $k => $v) {
            
            $before = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_manor_log') . " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y-%m-%d') != '{$nowtime}'  AND uid = :uid  AND uniacid = :uniacid AND remain > 0", array(
                ':uniacid' => $_W['uniacid'],
                ':uid' => $v['uid']
            ));
            
            
            if($v['is_open'] == 1 && $before ==  0){
                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_manor_log') . " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y-%m-%d') = '{$nowtime}'  AND  uid = :uid  AND uniacid = :uniacid ", array(
                    ':uniacid' => $_W['uniacid'],
                    ':uid' => $v['uid']
                ));
                
                if($count < $v['count'] ){
                    
                    $all_integral = mt_rand($v['min_integral'],$v['max_integral']);
                    
                    $userList[$k]['all_integral'] = $all_integral;
                    
                    if($all_integral >  0){
                        pdo_insert('wjyk_zqds_manor_log', array(
                            'uniacid' => $_W['uniacid'],
                            'uid' => $v['uid'],
                            'remain' => $all_integral,
                            'createtime' => time()
                        ));
                    } 
                    
                }
            }
        }
      
    }

    /**
     * 系统设置
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=system&m=wjyk_zqds
     */
    public function doPageSystem()
    {
        global $_GPC, $_W;
        
        copy(IA_ROOT . '/addons/wjyk_zqds/notify.php',IA_ROOT . '/web/notify.php');
        
        $system = pdo_get('wjyk_zqds_system', array(
            'uniacid' => $_W['uniacid']
        ));
        
        if (empty($system)) {
            $system = [];
        }
        
        if($system['person'] == 0 ){
            $person = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_integral_log') . " AS l WHERE l.uniacid = :uniacid AND l.type = 1 AND l.condition = 1", array(
                ':uniacid' => $_W['uniacid']
            ));
            $system['person'] = $person;
            
        }
        
        if($system['sent'] == 0){
            $sent = pdo_fetchcolumn("SELECT IFNULL(SUM(money),0.00) FROM " . tablename('wjyk_zqds_integral_log') . " AS l WHERE l.uniacid = :uniacid AND l.type = 1 AND l.condition = 1", array(
                ':uniacid' => $_W['uniacid']
            ));
            $system['sent'] = $sent;
        }
        
        $take = pdo_get('wjyk_zqds_takeout_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $system['index_meituan'] = $take['index_meituan'];
        $system['index_elm'] = $take['index_elm'];
        
        
        $brokerage = pdo_get('wjyk_zqds_brokerage_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $system['brokerage_open'] = $brokerage['is_open'];
        
        
        $takePlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 1
        ));
        
        $system['take_open'] = $takePlugin['is_open'];
        
        $manorPlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 2
        ));
        
        $system['manor_open'] = $manorPlugin['is_open'];
        
        
        
        $commission = pdo_get('wjyk_zqds_commission_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $system['commission_open'] = $commission['is_open'];
        
        $task = pdo_get('wjyk_zqds_task_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $system['task_open'] = $task['is_open'];
        
        $set = pdo_get('wjyk_zqds_signin_set',array(
            'uniacid' => $_W['uniacid'],
        ));
        
        $system['signin_open'] = $set['is_open'];
        
        $digitalSet = pdo_get('wjyk_zqds_digital_set',array(
            'uniacid' => $_W['uniacid'],
        ));
        
        $system['digital_index'] = $digitalSet['index_pic'];
        
        return self::result(0, 'success', $system);
    }
    
    /**
     * 底部菜单
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=bottom&m=wjyk_zqds
     */
    public function doPageBottom(){
        global $_GPC, $_W;
    
        $result = array();
        
        $bottom = pdo_get('wjyk_recycle_bottom', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $index = array(
            'name' => '首页',
            'icon' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/hone.png" ,
            'icon_checked' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/hones.png" ,
            'url' => '/wjyk_zqds/pages/index/index'
        );
        
        array_push($result, $index);
        
        $digital = array(
            'name' => '权益',
            'icon' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/quanyi.png" ,
            'icon_checked' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/quanyis.png" ,
            'url' => '/wjyk_zqds/pages/rightsNterests/rightsNterestsa/rightsNterests'
        );
        
        $digitalPlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 4
        ));
        
        if ($digitalPlugin['is_open'] == 1) {
            array_push($result, $digital);
        }
        
        $cps = array(
            'name' => '自购返',
            'icon' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/shop.png" ,
            'icon_checked' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/shops.png" ,
            'url' => '/wjyk_zqds/pages/shang/shang'
        );
        
        $cpsPlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 6
        ));
        
        if (!empty($cpsPlugin) && $cpsPlugin['is_open'] == 1) {
            array_push($result, $cps);
        }else{
            array_push($result, array(
                'name' => '自购返',
                'icon' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/shop.png" ,
                'icon_checked' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/shops.png" ,
                'url' => '/wjyk_zqds/pages/shang/shangs'
            ));
        }
        
        
        $chwl = array(
            'name' => '吃喝玩乐',
            'icon' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/lvyou.png" ,
            'icon_checked' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/lvyous.png" ,
            'url' => '/packages/drinkPlay/index/index'
        );
        
        $chwlPlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 7
        ));
        
        if ($chwlPlugin['is_open'] == 1) {
            array_push($result, $chwl);
        }
        
        $my = array(
            'name' => '我的',
            'icon' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/my.png" ,
            'icon_checked' => $_W['siteroot'] . "addons/wjyk_zqds/public/static/index/tabbar/mys.png" ,
            'url' => '/wjyk_zqds/pages/mian/mian2'
        );
        
        array_push($result, $my);
        
        
        return self::result(0, 'success', $result);
    }
    
    
    /**
     * 首页导航
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=navigation&m=wjyk_zqds
     */
    public function doPageNavigation(){
        global $_GPC, $_W;
        
        $condition = " uniacid = :uniacid AND is_display = 1 ";
        $params['uniacid'] = $_W['uniacid'];
        
        $list = pdo_fetchall( "SELECT  * FROM " . tablename('wjyk_zqds_navigation') . "WHERE ".$condition." order by sort desc ", $params);
        if(empty($list)){
            $list = [];
        }
        return self::result(0, 'success', $list);
    }
    
    /**
     * 首页活动
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=popular&m=wjyk_zqds
     */
    public function doPagePopular(){
        global $_GPC, $_W;
    
        $condition = " uniacid = :uniacid AND is_display = 1 ";
        $params['uniacid'] = $_W['uniacid'];
        
        $list = pdo_fetchall( "SELECT  * FROM " . tablename('wjyk_zqds_popular') . "WHERE ".$condition." order by sort desc ", $params);
        if(empty($list)){
            $list = [];
        }
        return self::result(0, 'success', $list);
    }
    
    /**
     * 首页热门
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=hot&m=wjyk_zqds
     * @param
     *            b_type  1-首页  2-cps  3-吃喝玩乐导航
     */
    public function doPageHot(){
        global $_GPC, $_W;
    
        $condition = " uniacid = :uniacid AND is_display = 1 ";
        $params['uniacid'] = $_W['uniacid'];
        
        if (! empty($_GPC['b_type'])) {
            $b_type = $_GPC['b_type'];
            $condition .= " AND b_type = {$b_type} ";
        }
    
        $list = pdo_fetchall( "SELECT  * FROM " . tablename('wjyk_zqds_hot') . "WHERE ".$condition." order by sort desc ", $params);
        if(empty($list)){
            $list = [];
        }
        return self::result(0, 'success', $list);
    }
    
    
    /**
     * 首页分类
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=home&m=wjyk_zqds
     */
    public function doPageHome()
    {
        global $_GPC, $_W;
        $set = pdo_get('wjyk_zqds_home', array(
            'uniacid' => $_W['uniacid']
        ));
    
        if (empty($set)) {
            $set = [
                'popular_pic' => '',              
            ];
        }
        
        if(!empty($set['popular_pic'])){
            $set['popular_pic'] = explode(",",$set['popular_pic']);
        }
    
        return self::result(0, 'success', $set);
    }
    
    /**
     * 插件列表
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=pluginList&m=wjyk_zqds
     */
    public function doPagePluginList(){
        global $_GPC, $_W;
        $data = pdo_fetchall("SELECT a.name,a.identifie,a.is_open,a.id FROM ".tablename('wjyk_zqds_plugin')." as a WHERE 1 order by a.id desc ");
        $module_plugin=pdo_getall("wjyk_zqds_module_plugin",array('uniacid'=>$_W['uniacid']),array(),'pid');
        
        foreach ($data as $k=>$v){
            if(!empty($module_plugin[$v['id']])){
                $data[$k]['is_open']=intval($module_plugin[$v['id']]['is_open']);
            }else{
                $data[$k]['is_open']=0;
            }
        }
        return self::result(0, 'success', $data);
    }
    
    /**
     * 签到设置
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=signSet&m=wjyk_zqds
     * @param
     *            uid
     */
    public function doPageSignSet(){
        global $_GPC, $_W;
        $user = pdo_get('wjyk_zqds_user', array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['uid']
        ),array(
            'sign_time',
            'sign_day'
        ));
        
        if(empty($user['sign_day'])){
            $user['sign_day'] = 0;
        }
        
        
        $set = pdo_get('wjyk_zqds_signin_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        
        if (strtotime(date('Y-m-d', strtotime("+2 day", $user['sign_time']))) < time()) {
            $user['sign_day'] = 0;
        }
        
        return self::result(0, 'success', array(
            'set' => $set,
            'user' => $user
        ));
    }
    
    /**
     * 任务中心
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=taskCenter&m=wjyk_zqds
     * @param
     *            uid
     */
    public function doPageTaskCenter(){
        global $_GPC, $_W;
        
        $user = pdo_get('wjyk_zqds_user', array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['uid']
        ),array(
            'sign_time',
            'sign_day'
        ));
        
        if(empty($user['sign_day'])){
            $user['sign_day'] = 0;
        }
        
        
        $set = pdo_get('wjyk_zqds_signin_set', array(
            'uniacid' => $_W['uniacid']
        ));

        
        if (strtotime(date('Y-m-d', strtotime("+2 day", $user['sign_time']))) < time()) {
            $user['sign_day'] = 0;
        }
        
        
        $result = array();
        
        $task = pdo_get('wjyk_zqds_task_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $system = pdo_get('wjyk_zqds_system', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $date = date('Y-m-d', time());
        
        $todayAdvertCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_integral_log') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.uid = :uid  AND l.uniacid = :uniacid AND l.type = 1 AND l.condition = 1", array(
            ':uniacid' => $_W['uniacid'],
            ':uid' => $_GPC['uid']
        ));
        
        $advert = array(
            'icon' => $task['advert_icon'],
            'name' => $task['advert_name'],
            'count' => $system['video_count'],
            'integral' => $task['advert_integral'],
            'url' => '',
            'type' => 1,
            'already' => $todayAdvertCount,
        );
        
        array_push($result, $advert);
        
        $todayInviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_user') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.pid = :uid  AND l.uniacid = :uniacid ", array(
            ':uniacid' => $_W['uniacid'],
            ':uid' => $_GPC['uid']
        ));
        
        
        $invite = array(
            'icon' => $task['invite_icon'],
            'name' => $task['invite_name'],
            'count' => $task['invite_count'],
            'integral' => $task['invite_integral'],
            'url' => '/wjyk_zqds/pages/promoteteam/promoteteam',
            'type' => 3,
            'already' => $todayInviteCount,
        );
        
        array_push($result, $invite);
        
        $huafei = pdo_get('wjyk_zqds_huafei_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        if($huafei['is_open'] == 1){
            $todayHuafeiCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_huafei_log') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.uid = :uid  AND l.uniacid = :uniacid AND is_status = 2", array(
                ':uniacid' => $_W['uniacid'],
                ':uid' => $_GPC['uid']
            ));
            
            
            $huafei = array(
                'icon' => $task['huafei_icon'],
                'name' => $task['huafei_name'],
                'count' => $task['huafei_count'],
                'integral' => $task['huafei_integral'],
                'url' => '/wjyk_zqds/pages/huafei/huafei',
                'type' => 3,
                'already' => $todayHuafeiCount,
            );
            
            array_push($result, $huafei);
        }
        
        $newsPlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 3
        ));
        
        
        if($newsPlugin['is_open'] == 1){
        
            $todayNewsCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_integral_log') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.uid = :uid  AND l.uniacid = :uniacid AND l.type = 1 AND l.condition = 8", array(
                ':uniacid' => $_W['uniacid'],
                ':uid' => $_GPC['uid']
            ));
        
            $news = array(
                'icon' => $task['news_icon'],
                'name' => $task['news_name'],
                'count' => $task['news_count'],
                'integral' => $task['news_integral'],
                'url' => '/wjyk_zqds/pages/new/new',
                'type' => 3,
                'already' => $todayNewsCount,
            );
        
            array_push($result, $news);
             
        }
                
        $manorPlugin = pdo_get('wjyk_zqds_module_plugin', array(
            'uniacid' => $_W['uniacid'],
            'pid' => 2
        ));
                
        if($manorPlugin['is_open'] == 1){
            
            $todayManorCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_user_manor_log') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.uid = :uid  AND l.uniacid = :uniacid", array(
                ':uniacid' => $_W['uniacid'],
                ':uid' => $_GPC['uid']
            ));
            
            $manor = array(
                'icon' => $task['manor_icon'],
                'name' => $task['manor_name'],
                'count' => $task['manor_count'],
                'integral' => $task['manor_integral'],
                'url' => '/wjyk_zqds/pages/index/manor/manor',
                'type' => 3,
                'already' => $todayManorCount,
            );
            
            array_push($result, $manor);
           
        }
        
        $set = pdo_get('wjyk_zqds_task_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        return self::result(0, 'success', array(
            'set' => $set,
            'task' => $result,
            'user' => $user
        ));
        
    }

    
    /**
     * 判断首页已看视频数量
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=judgeCount&m=wjyk_zqds
     * @param
     *            uid
     */
    public function doPageJudgeCount(){
        global $_GPC, $_W;
        $system = pdo_get('wjyk_zqds_system', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $date = date("Y-m-d", time());
        
        
        $today = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_integral_log') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.uid = :uid  AND l.uniacid = :uniacid AND l.type = 1 AND l.condition = 1", array(
            ':uniacid' => $_W['uniacid'],
            ':uid' => $_GPC['uid']
        ));
        
        $flag = 0;
        if($today >= $system['video_count']){
            $flag = 1;
        }
        
        return self::result(0, 'success', $flag);
    }
    
    public function  editBalance($uid,$type,$balance,$text,$order_number='',$uniacid=''){
        
        global $_GPC, $_W;
        
        $uniacid = empty($uniacid) ? $_W['uniacid'] : $uniacid;

        pdo_insert('wjyk_zqds_integral_log', array(
            'uniacid' => $uniacid,
            'order_number' => $order_number,
            'uid' => $uid,
            'money' => $balance,
            'text' => $text,
            'type' => $type,
            'condition' => 2,
            'createtime' => time()
        ));
        
        if($type == 1){//收入
            pdo_update('wjyk_zqds_user', array(
                'balance +=' => $balance
            ), array(
                'id' => $uid,
                'uniacid' => $uniacid
            ));
        }else{
            pdo_update('wjyk_zqds_user', array(
                'balance -=' => $balance
            ), array(
                'id' => $uid,
                'uniacid' => $uniacid
            ));
        }
    }
    

    /**
     * 看视频后加积分
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=addBalance&m=wjyk_zqds
     *
     * @param
     *            uid
     */
    public function doPageAddBalance()
    {
        global $_GPC, $_W;
        
        $system = pdo_get('wjyk_zqds_system', array(
            'uniacid' => $_W['uniacid']
        ));

        $date = date("Y-m-d", time());
        
        $today = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wjyk_zqds_integral_log') . " AS l WHERE DATE_FORMAT(FROM_UNIXTIME(l.createtime),'%Y-%m-%d') = '{$date}'  AND  l.uid = :uid  AND l.uniacid = :uniacid AND l.type = 1 AND l.condition = 1", array(
            ':uniacid' => $_W['uniacid'],
            ':uid' => $_GPC['uid']
        ));
        
        
        if($today >= $system['video_count']){
            return self::result(- 2, $system['video_notice']);
            exit();
        }

        
        $all_integral = 0; // 总金币
        $brokerage_integral = 0; // 分销金币
        
        $all_integral = mt_rand($system['min_integral'],$system['max_integral']);
        
        pdo_update('wjyk_zqds_system', array(
            'sent +=' => $all_integral,
            'person +='=> 1
        ), array(
            'uniacid' => $_W['uniacid']
        ));
        // 分销
        $setting = pdo_get("wjyk_zqds_brokerage_set", array(
            'uniacid' => $_W['uniacid']
        ));
        
        if ($setting['is_open'] == 1) { // 分销开启
            
            switch ($setting['is_level']) {
                case 1:
                    $commission[0] = $all_integral * $setting['oneLevel'];
                    break;
                case 2:
                    $commission[0] = $all_integral * $setting['oneLevel'];
                    $commission[1] = $all_integral * $setting['twoLevel'];
                    break;
                default:
                    $commission = array();
                    break;
            }
            
            $pid[0] = pdo_getcolumn("wjyk_zqds_user", array(
                'id' => $_GPC['uid']
            ), 'pid', 1);
            if (! empty($pid[0])) {
                $pid[1] = pdo_getcolumn("wjyk_zqds_user", array(
                    'id' => $pid[0]
                ), 'pid', 1);
            }
            
            if (! empty($commission) && ! empty($pid)) {
                
                
                $t = time();
                $sql = " INSERT INTO " . tablename('wjyk_zqds_brokerage_log') . " (uid,uniacid,pid,total,money,type,createtime) VALUES ";
                foreach ($commission as $k => $v) {
                    
                    $brokerage_integral += $v;
                
                    if ($v < 0.01 || empty($pid[$k])) {
                        continue;
                    }
                    pdo_update("wjyk_zqds_user", array(
                        'balance +=' => $v
                    ), array(
                        'id' => $pid[$k]
                    ));
                    
                    pdo_insert('wjyk_zqds_integral_log', array(
                        'uniacid' => $_W['uniacid'],
                        'uid' => $pid[$k],
                        'cid' => $_GPC['uid'],
                        'money' => $v,
                        'text' => '观看视频广告',
                        'type' => 1,
                        'condition' => 2,
                        'createtime' => $t
                    ));
                    
                    
                    $sql .= "(" . $_GPC['uid'] . "," . $_W['uniacid'] . "," . $pid[$k] . "," . $all_integral . "," . $v . ",1," . $t . "),";
                }
                $sql = substr($sql, 0, - 1);
                $sql .= ";";
                $res = pdo_query($sql);
            }
        }
        
        $user_integral = $all_integral - $brokerage_integral;
        if($user_integral > 0 ){
            $log = array(
                'uniacid' => $_W['uniacid'],
                'uid' => $_GPC['uid'],
                'money' => $user_integral,
                'text' => '观看视频广告',
                'type' => 1,
                'condition' => 1,
                'createtime' => time()
            );
            pdo_insert('wjyk_zqds_integral_log', $log);
        }

        $result = pdo_update('wjyk_zqds_user', array(
            'balance +=' => $user_integral
        ), array(
            'id' => $_GPC['uid'],
            'uniacid' => $_W['uniacid']
        ));
        
        $taskSet = pdo_get('wjyk_zqds_task_set', array(
            'uniacid' => $_W['uniacid']
        ));
        $flag = 0;
        
        if($taskSet['is_open'] == 1){//任务中心开启
            if($today + 1 == $system['video_count']){
                
                $user_integral = $taskSet['advert_integral'];
                $flag = 1;
                
                pdo_update("wjyk_zqds_user", array(
                    'balance +=' => $taskSet['advert_integral']
                ), array(
                    'id' => $_GPC['uid']
                ));
        
                pdo_insert('wjyk_zqds_integral_log', array(
                    'uniacid' => $_W['uniacid'],
                    'uid' => $_GPC['uid'],
                    'money' => $taskSet['advert_integral'],
                    'text' => '看广告'.$system['video_count']."次",
                    'type' => 1,
                    'condition' => 7,
                    'createtime' => time()
                ));
            }
        }

        if (! empty($result)) {
            return self::result(0, '操作成功', array(
                'integral' => $user_integral,
                'flag' => $flag
            ));
        } else {
            return self::result(- 1, '操作失败');
        }

    }

    /**
     * 轮播图列表
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=banner&m=wjyk_zqds
     * @param
     *            b_type  1-首页轮播图  2-商城轮播图  3-电影轮播图  4-cps轮播图
     */
    public function doPageBanner()
    {
        global $_GPC, $_W;
        
        $condition = " uniacid = :uniacid AND is_display = 1 ";
        $params['uniacid'] = $_W['uniacid'];
        
        if (! empty($_GPC['b_type'])) {
            $b_type = $_GPC['b_type'];
            $condition .= " AND b_type = {$b_type} ";
        }

        $list = pdo_fetchall( "SELECT  * FROM " . tablename('wjyk_zqds_banner') . "WHERE " . $condition. " order by sort desc ", $params);
        if(empty($list)){
            $list = [];
        }else{
            foreach ($list as $k => $v) {
                $list[$k]['image'] = $v['pic_url'];
            }
        }
        return self::result(0, 'success', $list);
    }
    
    /**
     * 首页图片列表
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=picture&m=wjyk_zqds
     * @param
     *            b_type  1-首页轮播图  2-cps轮播图
     */
    public function doPagePicture()
    {
        global $_GPC, $_W;
    
        $condition = " uniacid = :uniacid AND is_display = 1 ";
        $params['uniacid'] = $_W['uniacid'];
    
        if (! empty($_GPC['b_type'])) {
            $b_type = $_GPC['b_type'];
            $condition .= " AND b_type = {$b_type} ";
        }
    
        $list = pdo_fetchall( "SELECT  * FROM " . tablename('wjyk_zqds_picture') . "WHERE " . $condition. " order by sort desc ", $params);
        if(empty($list)){
            $list = [];
        }
        return self::result(0, 'success', $list);
    }
    

    /**
     * 首页推荐分类
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=recommendCategory&m=wjyk_zqds
     */
    public function doPageRecommendCategory()
    {
        global $_GPC, $_W;
        $sql = "SELECT  * FROM " . tablename('wjyk_zqds_category') . "as c  WHERE c.uniacid = :uniacid AND c.is_display = 1  AND c.is_recommend = 1 order by c.sort desc ";
        $list = pdo_fetchall($sql, array(
            'uniacid' => $_W['uniacid']
        ));
        return self::result(0, 'success', $list);
    }


    /**
     * 淘宝渠道
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=userRelation&m=wjyk_zqds
     * @param
     *            uid 
     * @param
     *            relation_id  不为空时编辑
     */
    public function doPageUserRelation()
    {
        global $_GPC, $_W;
        
        $uid = $_GPC['uid'];
        
        $user = pdo_get('wjyk_zqds_user', array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['uid']
        ));
        
        if(!empty($_GPC['relation_id'])){
            pdo_update("wjyk_zqds_user", array(
                'relation_id' => $_GPC['relation_id']
            ), array(
                'id' => $user['id']
            ));
            $user['relation_id'] = $_GPC['relation_id'];
        }
        
        $url = $_W['siteroot'] . "app/index.php?i={$_W['uniacid']}&c=entry&a=wxapp&do=userRelation&m=wjyk_zqds&uid={$uid}";
        
        $user['url'] = $url;
        
        return self::result(0, 'success', $user);
    }
    
    /**
     * 热门兑换
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=hot&m=wjyk_zqds
     */
    /*public function doPageHot()
    {
        global $_GPC, $_W;
    
        $sql = "SELECT  * FROM " . tablename('wjyk_zqds_goods') . "as c  WHERE c.uniacid = :uniacid AND c.is_display = 1  ORDER BY c.sold desc LIMIT 0,3";
        $list = pdo_fetchall($sql, array(
            'uniacid' => $_W['uniacid']
        ));
    
        foreach ($list as $k => $v) {
    
            if (! empty($v['pic_url'])) {
                $list[$k]['pic_url'] = explode(",", $v['pic_url'])[0];
            }
            $list[$k]['actual'] = $v['price'] - $v['deduction'];
        }
        return self::result(0, 'success', $list);
    }*/
    
    public function get_qrcode($id,$toUrl, $folder){
        global $_GPC, $_W;
    
        $config = pdo_get('account_wxapp', array(
            'uniacid' => $_W['uniacid']
        ));
    
        $appid = $config['key'];
        $secret = $config['secret'];
    
        $url_access_token = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $secret;
        $json_access_token = $this->sendCmd($url_access_token, array());
        $arr_access_token = json_decode($json_access_token, true);
        $access_token = $arr_access_token['access_token'];
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=' . $access_token;
        $qrcode = array(
            'scene'			=> $id,
            'width'			=> 320,
            'page'=> $toUrl,
        );
        $result = $this->sendCmd($url, json_encode($qrcode));

        $name = time().$id;
    
        $set = pdo_get('wjyk_zqds_upload',array(
            'uniacid' => $_W['uniacid']
        ));
        
    
        if(empty($set) || $set['type'] == 1){
    
            $u_time=date("Y-m-d",time());
    
            $path = IA_ROOT.'/addons/wjyk_zqds/qr_code/'.$folder.'/'.$u_time;
            
            if (!is_dir($path)){
                mkdir(iconv("UTF-8", "GBK", $path),0777,true);
            }
            file_put_contents(IA_ROOT.'/addons/wjyk_zqds/qr_code/'.$folder.'/'.$u_time.'/code-' . $name. '.jpg', $result);
            //存储二维码路径
            $arr =$_W['siteroot'].'addons/wjyk_zqds/qr_code/'.$folder.'/'.$u_time.'/code-' . $name. '.jpg';
    
            return $arr;
    
        }else if($set['type'] == 2){
            require_once(IA_ROOT . '/framework/library/qiniu/autoload.php');
            $auth = new Qiniu\Auth($set['accesskey'], $set['secretkey']);
            $token = $auth->uploadToken($set['bucket']);

            $key = time() . rand(999, 9999) .$name. ".jpg";
            // 初始化 UploadManager 对象并进行文件的上传
            $uploadMgr = new Qiniu\Storage\UploadManager();
            // 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->put($token, $key, $result);
            if ($err !== null) {
                return "";
            } else {
                return $set['url'] ."/". $ret['key'];
            }
        }
    
    }

    /**
     * 上传图片
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=upload&m=wjyk_zqds
     *
     * @param
     *            file
     */
    public function doPageUpload()
    {
        global $_W, $_GPC;
        
        $set = pdo_get('wjyk_zqds_upload', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $myfile = $_FILES['file'];
        $filePath = $myfile['tmp_name'];
        
        if ($myfile['type'] == 'video/mp4') {
            $key = 'video' . time() . random(4) . '.mp4';
        } elseif ($myfile['type'] == 'audio/mp3') {
            $key = 'audio' . time() . random(4) . '.mp3';
        } else {
            $key = 'png' . time() . random(4) . '.png';
        }
        
        if (empty($set) || $set['type'] == 1) {
            
            $path = IA_ROOT . "/attachment/images/" . $_W['uniacid'] . "/uploads/";
            // 判断目录存在否，存在给出提示，不存在则创建目录
            if (! is_dir($path)) {
                mkdir(iconv("UTF-8", "GBK", $path), 0777, true);
            }
            
            $res = move_uploaded_file($filePath, $path . $key);
            if ($res) {
                $data = $_W['siteroot'] . "attachment/images/" . $_W['uniacid'] . "/uploads/" . $key;
                
                return self::result(0, "上传成功", $data);
            } else {
                return self::result(- 1, "上传失败");
            }
        } else if ($set['type'] == 2) {
            require_once (IA_ROOT . '/framework/library/qiniu/autoload.php');
            
            $auth = new Qiniu\Auth($set['accesskey'], $set['secretkey']);
            $bucket = $set['bucket'];
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new Qiniu\Storage\UploadManager();
            
            list ($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            if ($err !== null) {
                return self::result(- 1, "上传失败");
            } else {
                $str = $set['url'] . '/' . $ret['key'];
                return self::result(0, "上传成功", $str);
            }
        }
    }
    
    /**
     * 话费充值
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=huafei&m=wjyk_zqds
     * @param
     *            uid
     * @param
     *            type 1-慢充  2-快充                    
     * @param
     *            price 支付金额            
     * @param
     *            money 充值金额
     * @param
     *            is_member 0-非会员   1-会员            
     * @param
     *            mobile 电话          
     */
    public function doPageHuafei()
    {
        global $_W, $_GPC;
    
        $money = $_GPC['money'];
        $mobile = $_GPC['mobile'];

        if (empty($money)) {
            return self::result(- 1, "金额为空");
            exit();
        }
        
        $system = pdo_get('wjyk_zqds_system', array(
            'uniacid' => $_W['uniacid']
        ));
        if (empty($system['integral_name'])) {
            $name = '金币';
        } else {
            $name = $system['integral_name'];
        }
        
        $user = pdo_get('wjyk_zqds_user',array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['uid']
        ));
        
        if ($_GPC['integral'] > $user['balance']) {
            return self::result(- 1, $name.'不足');
            exit();
        }

        
        $payno = $this->getPayNo("HF");
        
        $config = pdo_get('wjyk_zqds_huafei_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        if($user['is_member'] == 0){
            
            if($_GPC['type'] == 1){
                $price = round($money * $config['not_discount'],2);
            }else if($_GPC['type'] == 2){
                $price = round($money * $config['not_quick_discount'],2);
            }
            
        }else{
            if($_GPC['type'] == 1){
                $price = round($money * $config['discount'],2);
            }else if($_GPC['type'] == 2){
                $price = round($money * $config['quick_discount'],2);
            }
        }
        
        
        $set = pdo_get('wjyk_zqds_commission_set', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $integral = $_GPC['integral'];
        
        if(!empty($integral)){
            $deduction = round($integral / $set['exchange'],2);
            
            
            if($deduction >= $price){
                $integral = round($price * $set['exchange'],2);
                
                $price = 0.01;
                
            }else{
                $price = $price - $deduction;
            }
        }
        
        $data = array(
            'uniacid' => $_W['uniacid'],
            'uid' => $_GPC['uid'],
            'price' => $price,
            'money' => $money,
            'mobile' => $mobile,
            'orderid' => $payno,
            'way' => $config['way'],
            'is_status' => 0,
            'pay_status' => 1,
            'type' => $_GPC['type'],
            'is_member' => $user['is_member'],
            'integral' => $integral,
            'exchange' => $set['exchange'],
            'createtime' =>time()
        );
        
        pdo_insert('wjyk_zqds_huafei_log',$data);
        
        return self::result(0, '下单成功',$payno);
            
    }
    
    public function update_huafei($log_no,$price,$uniacid){
                
        $order = pdo_get('wjyk_zqds_huafei_log',array(
            'uniacid' => $uniacid,
            'orderid' => $log_no
        ));
        
        if($order['pay_status'] == 2){
            exit();
        }
        
        if($order['price'] != $price){
            pdo_update('wjyk_zqds_huafei_log',array(
                'is_status' => 4,
                'fail_msg' => '交易异常'
            ),array(
                'uniacid' => $uniacid,
                'id' => $order['id']
            ));
            exit();
        }
        
        pdo_update('wjyk_zqds_huafei_log',array(
            'pay_status' => 2,
            'is_status' => 1
        ),array(
            'uniacid' => $uniacid,
            'id' => $order['id']
        ));
        
        $config = pdo_get('wjyk_zqds_huafei_set', array(
            'uniacid' => $uniacid
        ));
        
        if($order['way'] == 1){
        
            if($order['type'] == 1){
                $url = "https://api.36duojing.com/v1/mobile/sloworder";
            }else{
                $url = "https://api.36duojing.com/v1/mobile/order";
            }
        
            $nonce_str = $this->getNonceStr(32);
        
            $send_data = array(
                'appKey' => $config['app_key'],
                'orderId' => $log_no,
                'mobile' => $order['mobile'],
                'amount' =>  $order['money'],
                'notifyUrl' => $GLOBALS['_W']['siteroot'] . "app/index.php?i={$uniacid}&c=entry&a=wxapp&do=huafeiResult&m=wjyk_zqds",
            );
            $sign = $this->MakeSign($send_data, $config['app_secret']);
        
            $send_data['sign'] = $sign;
        
            $result = $this->sendPost($url,$send_data);
            $result = json_decode($result,true);
        
            if($result['return_code'] == 0 && $result['result_code'] == 'SUCCESS'){
        
                pdo_update('wjyk_zqds_huafei_log',array(
                    'is_status' => 1,
                ),array(
                    'uniacid' => $uniacid,
                    'id' => $order['id']
                ));
        
        
                if(!empty($order['integral'])){
                    $this->editBalance($order['uid'],2,$order['integral'],$order['money']."元话费抵扣",$order['orderid'],$uniacid);
                }

            }else{
        
                pdo_update('wjyk_zqds_huafei_log',array(
                    'is_status' => 3,
                    'fail_msg' => $result['return_msg']
                ),array(
                    'uniacid' => $uniacid,
                    'id' => $order['id']
                ));
        
                $res = $this->wxRefund($log_no,$order['price']);
        
                if($res == 0){
                    pdo_update('wjyk_zqds_huafei_log',array(
                        'is_status' => 4,
                    ),array(
                        'uniacid' => $uniacid,
                        'id' => $order['id']
                    ));
                }
            }
        }else if($order['way'] == 2 ){
            if(!empty($order['integral'])){
                $this->editBalance($order['uid'],2,$order['integral'],$order['money']."元话费抵扣",$order['orderid'],$uniacid);
            }
        }else if($order['way'] == 3 ){
        
            if(empty($config['appid']) || empty($config['appsecret'])){
                return self::result(- 1, '请检查后台话费设置');
            }
        
            $url = "http://c1.admin168.net/index/index/judge?appid=" . $config['appid'] . "&appsecret=" . $config['appsecret'];
        
            $return = json_decode($this->httpGet($url),true);
        
            if($return['errno'] == 0){
                $agencyid = $return['data']['id'];
                $balance = $return['data']['balance'];
            }else{
                return self::result(- 1, $return['message']);
            }
        
            $url = "http://c1.admin168.net/index/huafei/addOrder";
        
            $order['agencyid'] = $agencyid;
            $order['notifyUrl'] = $GLOBALS['_W']['siteroot'] . "app/index.php?i={$uniacid}&c=entry&a=wxapp&do=huafeiResult&m=wjyk_zqds";
        
            $return = json_decode($this->httpPost($url,$order),true);
        
            if(!empty($return['message'])){
                if($return['errno'] == 0){
        
                    if(!empty($_GPC['integral'])){
                        $this->editBalance($order['uid'],2,$order['integral'],$order['money']."元话费抵扣",$order['orderid'],$uniacid);
                    }
        
                    return self::result(0, 'success');
                }else{
                    pdo_update('wjyk_zqds_huafei_log',array(
                        'is_status' => 3,
                        'fail_msg' => $return['message']
                    ),array(
                        'uniacid' => $uniacid,
                        'id' => $order['id']
                    ));
                }
            }else{
                pdo_update('wjyk_zqds_huafei_log',array(
                    'is_status' => 3
                ),array(
                    'uniacid' => $uniacid,
                    'id' => $order['id']
                ));
            }
        }
    }
    
    
    /**
     * 话费支付回调
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=huafeiResult&m=wjyk_zqds
     */
    public function doPageHuafeiResult()
    {
        global $_W, $_GPC;

        $orderId = $_GPC['orderId'];
        $status = $_GPC['status'];
        $flag = $_GPC['flag'];
        $agency_price = $_GPC['agency_price'];
        
        $order = pdo_get('wjyk_zqds_huafei_log',array(
            'uniacid' => $_W['uniacid'],
            'orderid' => $orderId
        ));
        
        if($status == 'SUCCESS'){
            $result = pdo_update('wjyk_zqds_huafei_log',array(
                'is_status' => 2
            ),array(
                'uniacid' => $_W['uniacid'],
                'orderid' => $orderId
            ));
            
            if(!empty($order['way']) && $order['way'] != 2){
                
                if($order['way'] == 1){//自动充值
                    
                    $url = "http://c1.admin168.net/index/huafei/set";
                    
                    $return = json_decode($this->httpGet($url),true);
                    
                    if($return['errno'] != 0){
                        $discount = $return['data']['discount'];
                        $quick_discount = $return['data']['quick_discount'];
                    }else{
                        $discount = "0.92";
                        $quick_discount = "0.968";
                    }
                    $count = $order['type'] == 1 ? $discount : $quick_discount;
                    
                    $price = $order['money'] * $count; //自动充值实际扣款
                    
                    $rebate = round($order['price'] - $price ,2);
                    
                    
                }else if($order['way'] == 3){//代理充值
                    $rebate = round($order['price'] - $agency_price,2);
                }
                $this->commission($order['uid'],$rebate,"充值".$order['money']."元话费",$order['orderid'],5);
                
            }
            
        }else{
            $result = pdo_update('wjyk_zqds_huafei_log',array(
                'is_status' => 3
            ),array(
                'uniacid' => $_W['uniacid'],
                'orderid' => $orderId
            ));
            
            if(empty($flag)){
                $res = $this->wxRefund($order['orderid'],$order['price']);
                
                if(!empty($order['integral'])){
                    $this->editBalance($order['uid'],1,$order['integral'],$order['money']."元话费退款",$order['orderid'],$_W['uniacid']);
                }
                
                if($res == 0){
                    pdo_update('wjyk_zqds_huafei_log',array(
                        'is_status' => 4,
                    ),array(
                        'uniacid' => $_W['uniacid'],
                        'orderid' => $orderId
                    ));
                }
            }
        }

        
        
        if(!empty($result)){
            return "SUCCESS";
        }
    }
    function commission($uid, $price,$member_name,$order_number,$type,$uniacid=''){
        
        global $_GPC, $_W;
        
        $uniacid = empty($uniacid) ? $_W['uniacid'] : $uniacid;
        
        
        if($type == 5){
            $setting = pdo_get("wjyk_zqds_huafei_set", array(
                'uniacid' => $uniacid
            ), array(
                'huafei_rebate'
            ));
            
            $commission = $price * $setting['huafei_rebate'];
        }else if($type == 3){
            $digitalSet = pdo_get("wjyk_zqds_digital_set", array(
                'uniacid' => $uniacid
            ), array(
                'digital_rebate'
            ));
            
            $commission = $price * $digitalSet['digital_rebate'];
        }
        
        
        $commissionSet = pdo_get("wjyk_zqds_commission_set", array(
            'uniacid' => $uniacid
        ));
        
        $commission = $commission * $commissionSet['exchange'];
    
        $pid = pdo_getcolumn("wjyk_zqds_user", array(
            'id' => $uid,
            'uniacid' => $uniacid
        ), 'pid', 1);
    
        if(!empty($pid) && $commission >= 0.01){
    
            $log = pdo_get('wjyk_zqds_brokerage_log',array(
                'uniacid' => $uniacid,
                'order_number' => $order_number,
                'uid' => $uid,
                'pid' => $pid,
            ));
            
            if(empty($log)){
                pdo_insert('wjyk_zqds_brokerage_log', array(
                    'uniacid' => $uniacid,
                    'order_number' => $order_number,
                    'type' => $type,
                    'pid' => $pid,
                    'uid' => $uid,
                    'desc' => $member_name,
                    'total' => $price,
                    'money' => $commission,
                    'createtime' => time()
                ));
                
                pdo_insert('wjyk_zqds_integral_log', array(
                    'uniacid' => $uniacid,
                    'uid' => $pid,
                    'cid' => $uid,
                    'money' => $commission,
                    'text' => $member_name,
                    'type' => 1,
                    'condition' => 2,
                    'createtime' => time()
                ));
                
                pdo_update("wjyk_zqds_user", array(
                    'balance +=' => $commission,
                ), array(
                    'id' => $pid,
                    'uniacid' => $uniacid
                ));
                
            }
        }
    }
    
    public function update_digital($log_no,$price,$uniacid){
                
        $url = "http://c1.admin168.net/index/digital/update_order?log_no=" . $log_no."&price=" .$price;
        
        $return = json_decode($this->httpGet($url),true);
        
        if(!empty($return)){
            if($return['errno'] == 0){
            
                $order = $return['data'];
            
                if(!empty($order['integral'])){
                    $this->editBalance($order['uid'],2,$order['integral'],$order['goods_name']."抵扣",$order['log_no'],$uniacid);
                }
                
                $rebate = round($order['pay_price'] - $order['agency_price'],2);
                
                $this->commission($order['uid'],$rebate,$order['goods_name'],$order['log_no'],3,$uniacid);
            
            }else{
            
                $this->wxRefund($order['log_no'],$price);
            
                $id = $return['data'];
                $url = "http://c1.admin168.net/index/digital/updateRefundStatus?id=" . $id;
            
                $this->httpGet($url);
            }
        }
    }
    
    public function update_film($log_no,$price,$uniacid){
    
        $url = "http://c1.admin168.net/index/film/update_order?log_no=" . $log_no."&price=" .$price;
    
        $return = json_decode($this->httpGet($url),true);
    
        if(!empty($return)){
            if($return['errno'] == 0){
    
                $order = $return['data'];
    
                if(!empty($order['integral'])){
                    $this->editBalance($order['uid'],2,$order['integral'],$order['film_name']."抵扣",$order['log_no'],$uniacid);
                }
    
                $rebate = round($order['pay_price'] - $order['agency_price'],2);
    
                $this->commission($order['uid'],$rebate,$order['film_name'],$order['log_no'],3,$uniacid);
    
            }else{
    
                $this->wxRefund($order['log_no'],$price);
    
                $id = $return['data'];
                $url = "http://c1.admin168.net/index/film/updateRefundStatus?id=" . $id;
    
                $this->httpGet($url);
            }
        }
    }

    /**
     * 微信支付
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=pay&m=wjyk_zqds
     * @param
     *            openid
     * @param
     *            money 支付金额    
     * @param
     *            payno  订单返回                       
     */
    public function doPagePay()
    {
        global $_W, $_GPC;

        $data = json_decode(file_get_contents("php://input"), true);
        $money = $data['money'];
        $openid = $data['openid'];
        
        if (empty($money)) {
            return self::result(- 1, "金额为空");
        }
        
        $payconfig = pdo_get('wjyk_zqds_payconfig', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $payno = $data['payno'];
        
        if(empty($payno)){
            $payno = $this->getPayNo('LC');
        }
        
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $nonce_str = $this->getNonceStr(32);
        if ($_W['ispost']) {
            
            if($payconfig['type'] == 2){//子商户支付
                $send_data = array(
                    'appid' => $payconfig['service_appid'],
                    'mch_id' => $payconfig['service_mchid'],
                    'sub_appid' => $payconfig['appid'],
                    'sub_mch_id' => $payconfig['mchid'],
                    'nonce_str' => $nonce_str,
                    'body' => "支付",
                    'out_trade_no' => $payno,
                    'total_fee' => $money * 100,
                    'notify_url' =>  $_W['siteroot'] . 'web/notify.php',
                    'spbill_create_ip' => $_W['clientip'],
                    'trade_type' => 'JSAPI',
                    'attach' => $_W['uniacid'],
                    'sub_openid' => $openid,
                    'profit_sharing' => 'Y'
                );
            }else{
                $send_data = array(
                    'appid' => $payconfig['appid'],
                    'mch_id' => $payconfig['mchid'],
                    'nonce_str' => $nonce_str,
                    'body' => "支付",
                    'out_trade_no' => $payno,
                    'total_fee' => $money * 100,
                    'notify_url' => $_W['siteroot'] . "web/notify.php",
                    'spbill_create_ip' => $_W['clientip'],
                    'trade_type' => 'JSAPI',
                    'attach' => $_W['uniacid'],
                    'openid' => $openid
                );
            }
            
            
            $sign = $this->MakeSign($send_data, $payconfig['api_key']);
            
            $send_data['sign'] = $sign;
            
            $result = $this->FromXml($this->wtw_request($url, $this->ToXml($send_data)));
            
            if ($result['return_code'] == 'SUCCESS') {
                
                if($payconfig['type'] == 2){
                    $paysign = $this->sign_pay($result, $send_data['sub_appid'], $payconfig['api_key']);
                }else{
                    $paysign = $this->sign_pay($result, $send_data['appid'], $payconfig['api_key']);
                }
                
                $paysign['out_trade_no'] = $payno;
                return self::result(0, 'success', $paysign);
            } else {
                return self::result(- 1, $result);
            }
            
        }
    }
    
    public function doPageDd(){
        $setting = pdo_getall('core_settings');
        
        $site = unserialize($setting['site']);
        print_r($GLOBALS['_W']);
        exit();
    }
    
    /**
     * 查询订单
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=payResult&m=wjyk_zqds
     */
    public function  payDetail($out_trade_no){
        
        global $_W, $_GPC;
                
        $url = "https://api.mch.weixin.qq.com/pay/orderquery";
        
        $payconfig = pdo_get('wjyk_zqds_payconfig', array(
            'uniacid' => $_W['uniacid']
        ));
                
        $nonce_str = $this->getNonceStr(32);
        
        $send_data = array(
            'appid' => $payconfig['appid'],
            'mch_id' => $payconfig['mchid'],
            'nonce_str' => $nonce_str,
            'out_trade_no' => $out_trade_no,
        );
        
        $sign = $this->MakeSign($send_data, $payconfig['api_key']);
            
        $send_data['sign'] = $sign;
        
        $result = $this->FromXml($this->postXmlCurl($this->ToXml($send_data),$url));

        if($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
            if(strpos($result['out_trade_no'],'HF') !== false){
                $this->update_huafei($result['out_trade_no'], $result['total_fee'] * 0.01,$_W['uniacid']);
            }
        } 
        
    }
    
    public function postXmlCurl($xml, $url, $second = 60)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        set_time_limit(0);
    
    
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        }
    }

    /**
     * 取消支付
     * https://b81.admin168.net/app/index.php?i=2&c=entry&a=wxapp&do=payCancel&m=wjyk_zqds
     ** @param
     *            out_trade_no 订单返回
     */
    public function  doPagePayCancel(){
        global $_W, $_GPC;
        
        $out_trade_no = $_GPC['out_trade_no'];
        
        if(strpos($out_trade_no,'HF') !== false){
            pdo_delete('wjyk_zqds_huafei_log',array(
                'uniacid' => $_W['uniacid'],
                'orderid' => $out_trade_no
            ));
        }
        
        if(strpos($out_trade_no,'SZ') !== false){
            $url = "http://c1.admin168.net/index/digital/del_order?log_no=" . $out_trade_no;
            
            $this->httpGet($url);
        }
        
        if(strpos($out_trade_no,'FM') !== false){
            $url = "http://c1.admin168.net/index/film/del_order?log_no=" . $out_trade_no;
        
            $this->httpGet($url);
        }
        
        return self::result(0, '取消成功');
    }
    
    
    function wxRefund($orderno, $money)
    {
        global $_W, $_GPC;
    
        $payconfig = pdo_get('wjyk_zqds_payconfig', array(
            'uniacid' => $_W['uniacid']
        ));

        $url = "https://api.mch.weixin.qq.com/secapi/pay/refund";
        $send_data = array(
            'appid' => $payconfig['appid'],
            'mch_id' => $payconfig['mchid'],
            'nonce_str' => $this->getNonceStr(32),
            'out_trade_no' => $orderno,
            'out_refund_no' => $this->getPayNo('RE'),
            'total_fee' => $money * 100,
            'refund_fee' => $money * 100
        );
    
        $sign = $this->MakeSign($send_data, $payconfig['api_key']);
    
        $send_data['sign'] = $sign;
    
        $result = $this->FromXml($this->refund_request($url, $this->ToXml($send_data), true));
        
        if (empty($result)) {
            return - 1;
            exit();
        }
    
        if ($result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
            return 0;
            exit();
        } else {
            return - 1;
            exit();
        }
    }

    public function sign_pay($arr,$appId,$api_key)
    {
        global $_W, $_GPC;
        $payconfig = pdo_get('wjyk_zqds_payconfig', array(
            'uniacid' => $_W['uniacid']
        ));
        $package = "prepay_id=" . $arr['prepay_id'];
        $signType = "MD5";
        $time = (int) time();
        $array = array(
            'appId' => $appId,
            'nonceStr' => $arr['nonce_str'],
            'package' => $package,
            'signType' => $signType,
            'timeStamp' => (string) $time
        );
        $sign_str = $this->MakeSign($array, $api_key);
        
        $array['sign'] = $sign_str;
        return $array;
    }
    
    // 创建随机字符串
    public function createNoncestr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     *
     * 产生随机字符串，不长于32位
     *
     * @param int $length            
     * @return 产生的随机字符串
     */
    public static function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public function FromXml($xml)
    {
        // 将XML转为array
        // 禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $arr;
    }

    public function ToXml($array)
    {
        $xml = "<xml>";
        foreach ($array as $key => $val) {
            if ($key != 'body') {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    public function MakeSign($array, $key)
    {
        // 签名步骤一：按字典序排序参数
        ksort($array);
        $string = $this->ToUrlParams($array);
        // 签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $key;
        // 签名步骤三：MD5加密
        $string = md5($string);
        // 签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    public function ToUrlParams($arr)
    {
        $buff = "";
        foreach ($arr as $k => $v) {
            if ($k != "sign" && $v != "" && ! is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
        
        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * [wtw_request description]模版请求
     *
     * @param [type] $url
     *            [description]
     * @param [type] $data
     *            [description]
     * @return [type] [description]
     */
    public function wtw_request($url, $data = null)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        if ($data != null) {
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $info = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            // echo 'Errno:'.curl_getinfo($curl);//捕抓异常
            // dump(curl_getinfo($curl));
        }
        return $info;
    }
    
    public function sendPost($url, $data = NULL)
    {
        // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_HTTPHEADER, 0); // 类型为json
        $result = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Error POST' . curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $result; // 返回数据
    }
    
    public function httpPost($url, $data = NULL)
    {
        // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8'
        )); // 类型为json
        $result = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Error POST' . curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $result; // 返回数据
    }

    function sendCmd($url, $data)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Expect:'
        )); // 解决数据包大不能提交
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $tmpInfo; // 返回数据
    }

    function getRandNumber($start, $end, $length)
    {
        // 初始化变量为0
        $connt = 0;
        // 建一个新数组
        $temp = array();
        while ($connt < $length) {
            $temp[] = mt_rand($start, $end);
            $data = array_flip(array_flip($temp));
            $connt = count($data);
        }
        shuffle($data);
        $str = implode(",", $data);
        $number = str_replace(',', '', $str);
        return $number;
    }

    public function getPayNo($text)
    {
        return $text . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    public function bd_encrypt($gg_lon, $gg_lat)
    {
        $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $gg_lon;
        $y = $gg_lat;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $bd_lon = $z * cos($theta) + 0.0065;
        $bd_lat = $z * sin($theta) + 0.006;
        // 保留小数点后六位
        $data['bd_lon'] = round($bd_lon, 6);
        $data['bd_lat'] = round($bd_lat, 6);
        return $data;
    }
    
    // BD-09(百度)坐标转换成GCJ-02(火星，高德)坐标
    // @param $longitude 百度经度
    // @param $latitude 百度纬度
    public function gd_encrypt($longitude, $latitude)
    {
        $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $longitude - 0.0065;
        $y = $latitude - 0.006;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $longitude = $z * cos($theta);
        $latitude = $z * sin($theta);
        $data['lng'] = round($longitude, 6);
        $data['lat'] = round($latitude, 6);
        return $data;
    }

    public function refund_request($url, $data = null, $useCert = false)
    {
        global $_W;
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        if ($data != null) {
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        if ($useCert) {

            
            curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($curl, CURLOPT_SSLCERT, IA_ROOT. '/addons/wjyk_zqds/cert/' . $_W['uniacid'].'/apiclient_cert.pem');
            
            curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($curl, CURLOPT_SSLKEY, IA_ROOT. '/addons/wjyk_zqds/cert/' . $_W['uniacid'].'/apiclient_key.pem');
        }
        
        $info = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            $error = curl_errno($curl);
            echo "curl出错，错误码:$error" . "<br>"; // 捕抓异常
            curl_close($curl);
            return false;
        }
        return $info;
    }

    public function getAccessToken()
    {
        global $_W;
        $wechat_config = pdo_get('account_wxapp', array(
            'uniacid' => $_W['uniacid']
        ));
        
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $wechat_config['key'] . "&secret=" . $wechat_config['secret'];
        
        $res = json_decode($this->wtw_request($url));
        
        $access_token = $res->access_token;
        return $access_token;
    }

    function httpGet($url)
    {
        // 初始化
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        // 执行后不直接打印出来
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 不从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        // 执行并获取HTML文档内容
        $output = curl_exec($ch);
        
        // 释放curl句柄
        curl_close($ch);
        
        return $output;
    }
    
    function payGet($url)
    {
        // 初始化
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        // 执行后不直接打印出来
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 不从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        // 执行并获取HTML文档内容
        $output = curl_exec($ch);
    
        // 释放curl句柄
        curl_close($ch);
    
        return $output;
    }
    
    // 排序ksort
    public function paramOrder($params)
    {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v)) {
                $v = $this->characet($v, 'utf-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "$v";
                } else {
                    $stringToBeSigned .= "$k" . "$v";
                }
                $i ++;
            }
        }
        unset($k, $v);
        return $stringToBeSigned;
    }
    // 为空检查
    protected function checkEmpty($value)
    {
        if (! isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    // 编码设置
    public function characet($data, $targetCharset)
    {
        if (! empty($data)) {
            $fileType = 'utf-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    // 签名
    public function paramSign($secretkey,$params)
    {
        $str = $secretkey . $params . $secretkey;
        $sign = md5($str);
        return strtoupper($sign);
    }
    
    public function apiSign($param)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://router.jd.com/api");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}