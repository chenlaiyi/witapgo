<?php

namespace app\index\controller;

use think\Controller;

class Teacher extends Controller
{
    
    /**
     * 讲师列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=teacher_list
     * @param
     *         is_recommend  是否推荐  1-推荐  2-不推荐
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function teacher_list(){
        global $_W,$_GPC;
    
        $pindex = max(1, intval($_GPC['page']));
        $psize = empty($_GPC['psize']) ? 10 : intval($_GPC['psize']);

        $is_recommend = input('is_recommend');
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
    
        if(!empty($is_recommend)){
            $condition .= " AND is_recommend = :is_recommend";
            $params[':is_recommend'] = $is_recommend;
        }
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_teacher') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_teacher')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
        }else{
            $list = array();
        }
    
        
        $totalPage = ceil($total / $psize);
    
        return result(0, 'success', array(
            'list' => $list,
            'total' => $total,
            'pindex' => $pindex,
            'psize' => $psize,
            'totalPage' => $totalPage
        ));
    
    
    }
    
    /**
     * 关注
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=focus
     * @param
     *            id  讲师id
     */
    public function focus(){
        global $_W,$_GPC;
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $id = input('id');
        
        $flag = pdo_get('wjyk_zqds_focus',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'teacherid' => $id,
        ));
        
        if(!empty($flag)){
            return result(-1,'已关注！');
        }else{
    
            $data = array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
                'teacherid' => $id,
                'createtime' => time()
            );
        
            $result = pdo_insert("wjyk_zqds_focus",$data);
            if($result){
                return result(0,'关注成功');
            }else{
                return result(-1,'关注失败');
            }
        }
    
    }
    
    /**
     * 取消关注
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=unfocus
     * @param
     *            id  讲师id
     */
    public function unfocus(){
        global $_W,$_GPC;
    
        $id = input('id');
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $result = pdo_delete('wjyk_zqds_focus',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'teacherid' => $id,
        ));
    
        if($result){
            return result(0,'取消成功');
        }else{
            return result(-1,'取消失败');
        }
    
    }
    
    /**
     * 申请讲师
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=apply_teacher
     * @param
     *            name  姓名
     * @param
     *            telphone  手机号码
     * @param
     *            introduction    个人介绍
     * @param
     *            pic_url    资料图片   字符串  用,隔开            
     *            
     */
    public function apply_teacher(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $user = pdo_get('wjyk_zqds_user',array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
        ));
        
        $data = array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'name' => input('name'),
            'is_status' => 1,
            'telphone' => input('telphone'),
            'introduction' => input('introduction'),
            'pic_url' => input('pic_url'),
            'avatar' => $user['avatar'],
            'createtime' => time()
        );
        
        $result = pdo_insert('wjyk_zqds_teacher',$data);
        
        if($result){
            return result(0,'申请成功');
        }else{
            return result(-1,'申请失败');
        }
    }
    
    /**
     * 讲师中心
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=teacher_index
     * @param
     *            teacherid  讲师id                             
     */
    public function teacher_index(){
        global $_W,$_GPC;
        
        $teacher = pdo_get('wjyk_zqds_teacher',array(
            'id' => $_GPC['teacherid'],
            'uniacid' => $_W['uniacid']
        ));
        
        $fans = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_focus"). " WHERE teacherid = :teacherid AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid'],
            'teacherid' => $_GPC['teacherid'],
        ));
        
        $teacher['fans'] = $fans;
        
        
        $course = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_course"). " WHERE teacherid = :teacherid AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid'],
            'teacherid' => $_GPC['teacherid'],
        ));
        
        $teacher['course'] = $course;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $focus = pdo_get('wjyk_zqds_focus',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'teacherid' => $teacher['id']
        ));
        
        if(!empty($focus)){
            $teacher['focus'] = 1;
        }else{
            $teacher['focus'] = 0;
        }
        
        
        return result(0,'success',$teacher);
    
    }
    
    /**
     * 编辑
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=update_info
     * @param
     *            teacherid  讲师id 
     * @param
     *            introduction    个人介绍
     */
    public function update_info(){
        global $_W,$_GPC;
    
        pdo_update("wjyk_zqds_teacher",array(
            'introduction' => input('introduction'),
        ),array(
            'id' => input('teacherid'),
            'uniacid' => $_W['uniacid']
        ));
    
        return result(0, '修改成功');
    }
    
    
    
    /**
     * 直播设置
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=live_set
     */
    public function live_set(){
        global $_W;
        
        $set = pdo_get("wjyk_zqds_live_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(empty($set)){
            $set = [];
        }
        
        return result(0, 'success',$set);
    }

    /**
     * 申请直播
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=apply_live
     * @param
     *            teacherid  讲师id 
     * @param
     *            realname  真实姓名
     * @param
     *            idno  身份证号          
     */
    public function apply_live(){
        global $_W,$_GPC;
    
        $data = array(
            'live_status' => 1,
            'realname' => input('realname'),
            'idno' => input('idno')
        );
    
        $result = pdo_update('wjyk_zqds_teacher',$data,array(
            'uniacid' => $_W['uniacid'],
            'id' => input('teacherid'),
        ));
    
        if($result){
            return result(0,'申请成功');
        }else{
            return result(-1,'申请失败');
        }
    }
    
    /**
     * 直播列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=live_list
     * @param
     *         teacherid  讲师id
     */
    public function live_list(){
        global $_W,$_GPC;
        
        $set = pdo_get('wjyk_zqds_live_set',array(
            'uniacid' => $_W['uniacid']
        ));
        
        $config = [
            'accessKeyId' => $set['keyId'],
            'accessKeySecret' => $set['keySecret'],
            'signName' => '',
            'templateCode'=> '',
        ];
        
        include 'Sms.php';
        
        $sms = new \Sms($config);
        
        $liveList = pdo_getall('wjyk_zqds_live',array(
            'uniacid' => $_W['uniacid']
        ));
        foreach ($liveList as $k => $v) {
        
            if(!empty($v['aly_play_domain'])){
        
                $online = $sms->get_online($v['aly_play_domain']);
        
                if (!empty($online['LiveStreamOnlineInfo'])) {
        
                    $onlineList = $online['LiveStreamOnlineInfo'];
        
                    foreach ($onlineList as $key => $value) {
        
                        if($value['AppName'] == $v['app_name'] && $value['StreamName'] == $v['stream_name']){
        
        
                            pdo_update('wjyk_zqds_live',array(
                                'is_status' => 2
                            ),array(
                                'uniacid' => $_W['uniacid'],
                                'id' => $v['id']
                            ));
                        }
                    }
                }
        
            }
        
        }
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];

        if(!empty(input('teacherid'))){
            $condition .= " AND teacherid = :teacherid";
            $params[':teacherid'] = input('teacherid');
        }
    
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_live') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_live')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
            
            foreach ($list as $k => $v) {
            
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['teacherName'] = $teacher['name'];
                $list[$k]['teacherAvatar'] = $teacher['avatar'];
            
            }
            
            
        }else{
            $list = array();
        }
    
    
        return result(0, 'success', $list);
    
    
    }
    
    /**
     * 创建直播预告/立即开播
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=add_live
     * @param
     *            teacherid  讲师id
     * @param
     *            name  课程名称
     * @param
     *            starttime  开播时间  立即开播不填
     * @param
     *            detail  课程介绍 
     * @param
     *            cover  封面 
     * @param
     *            pic_url  详情图片                               
     */
    public function add_live(){
        global $_W,$_GPC;
        
        $set = pdo_get("wjyk_zqds_live_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        $push_domain = $set['aly_push_domain'];
        // 推流域名配置的鉴权Key
        // 配置过期时间为1小时
        $expireTime = 3600;
        // 播放域名
        $play_domain = $set['aly_play_domain'];
        
        $appName= get_app_name(1);
        $streamName=get_app_name(2);
        $aly_push_stream=push_url($push_domain,"","",$appName,$streamName);
        $aly_play_stream=play_url($play_domain,"","",$appName,$streamName);
        
        
    
        $data = array(
            'uniacid' => $_W['uniacid'],
            'name' => input('name'),
            'teacherid' => input('teacherid'),
            'detail' => input('detail'),
            'cover' => input('cover'),
            'pic_url' => input('pic_url'),
            'aly_push_domain' => $set['aly_push_domain'],
            'aly_play_domain' => $set['aly_play_domain'],
            'aly_push_stream' => $aly_push_stream,
            'aly_play_stream' => $aly_play_stream,
            'app_name' => $appName,
            'stream_name' => $streamName,
            'createtime' => time()
        );
        
        if(!empty(input('starttime'))){
            $data['starttime'] = strtotime(input('starttime'));
        }else{
            $data['starttime'] = time();
        }
        
        $result = pdo_insert('wjyk_zqds_live',$data);
    
        if($result){
            $id = pdo_insertid();
            return result(0,'创建成功',$id);
        }else{
            return result(-1,'创建失败');
        }
    }
    
    /**
     * 删除直播
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=del_live
     * @param
     *            id  直播id
     */
    public function del_live(){
        global $_W,$_GPC;
    
        $result = pdo_delete('wjyk_zqds_live',array(
            'uniacid' => $_W['uniacid'],
            'id' => $_GPC['id'],
        ));
    
        if($result){
            return result(0,'删除成功');
        }else{
            return result(-1,'删除失败');
        }
    }
    
    
    /**
     * 礼物记录
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=gift_log
     * @param
     *            teacherid  讲师id
     */
    public function gift_log(){
        global $_W,$_GPC;
        
        if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        }
    
        $condition = " l.uniacid = :uniacid AND l.teacherid = :teacherid AND l.is_status = 1 ";
        $params[':uniacid'] = $_W['uniacid'];
        $params[':teacherid'] = input('teacherid');
        
        $condition .= "  GROUP BY l.giftid ORDER BY createtime DESC ";
        
        $sql = "SELECT l.giftid,SUM(l.count) AS count FROM " . tablename('wjyk_zqds_gift_log') . " AS l  WHERE  " . $condition;
        $giftLogList = pdo_fetchall($sql, $params);
    
        $price = 0;
        foreach ($giftLogList as $k => $v) {
            
            $gift = pdo_get('wjyk_zqds_gift',array(
                'id' => $v['giftid'],
                'uniacid' => $_W['uniacid']
            ));
            $giftLogList[$k]['giftName'] = $gift['name'];
            $giftLogList[$k]['giftPrice'] = $gift['price'];
            $giftLogList[$k]['giftPic'] = $gift['pic_url'];
            
            $price += $gift['price']*$v['count'];
        }
    
        return result(0, 'success',array(
            'price' => $price,
            'giftLogList' => $giftLogList
        ));
    }
    
    /**
     * 礼物提现设置
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=gift_set
     */
    public function gift_set(){
        global $_W;
        
        $set = pdo_get("wjyk_zqds_gift_commission_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(empty($set)){
            $set = [];
        }
        
        return result(0, 'success',$set);
    }
    
    
    /**
     * 礼物折现
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=teacher&tp_a=gift_tocash
     * @param
     *        commission_wait 申请佣金 
     * @param
     *        teacherid  讲师id 
     * @param
     *        cash_type 1-余额，2-线上提现到微信        
     */
    public function gift_tocash(){
        global $_W;

        $data = array(
            'teacherid' => input('teacherid'),
            'uniacid' => $_W['uniacid'],
            'is_status' => 1,
            'cash_type' => input('cash_type'),
            'commission_wait' => input('commission_wait'),
            'createtime' => time()
        );
        
        $set = pdo_get("wjyk_zqds_gift_commission_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if ($set['cash_charge'] != '' || $set['cash_charge'] != 0) {
            $data['cash_charge'] = $set['cash_charge'];
            $data['service_charge'] = round(input('commission_wait') * $set['cash_charge'] / 100, 2);
            $data['commission_actual'] = input('commission_wait') - $data['service_charge'];
        } else {
            $data['service_charge'] = 0;
            $data['commission_actual'] = input('commission_wait');
        }
        
        $result = pdo_insert('wjyk_zqds_gift_commission',$data);
        
        if ($result) {
            
            
            pdo_update('wjyk_zqds_gift_log',array(
                'is_status' => 2
            ),array(
                'teacherid' => input('teacherid'),
                'uniacid' => $_W['uniacid'],
            ));
            
            return result(0,'申请成功');
        } else {
            return result(-1,'申请失败');
        }
    }
    
}

