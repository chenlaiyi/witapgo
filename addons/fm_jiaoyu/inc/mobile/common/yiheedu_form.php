<?php
/**
 * 微教育模块
 *
 * @author CC
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
$id = $_GPC['id'];
$school = pdo_fetch("SELECT title FROM ".GetTableName('index')." WHERE id = {$schoolid} ");
$userid = pdo_fetchAll("SELECT id FROM ".GetTableName('user')." WHERE openid = '{$openid}' AND schoolid = '{$schoolid}' ");
if($userid){
    $deal = pdo_fetch("SELECT deal FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}'")['deal'];
    $relationInfo = pdo_fetch("SELECT r.kc_id,r.id,u.name,t.name as kcname,r.pu_id FROM ".GetTableName('yiheedu_promote_relation')." as r LEFT JOIN ".GetTableName('tcourse')." as t ON t.id = r.kc_id LEFT JOIN ".GetTableName('yiheedu_promote_user')." as u ON u.id = r.pu_id WHERE r.schoolid = '{$schoolid}' AND r.kc_id = '{$_GPC['kc_id']}' AND r.pu_id = '{$_GPC['shareuserid']}' ");
    //当前学校的老师
    $teacher = pdo_fetch("SELECT t.id,t.tname,t.mobile FROM ".GetTableName('user')." as u LEFT JOIN ".GetTableName('teachers')." as t ON t.id = u.tid WHERE u.openid = '{$openid}' AND u.schoolid = '{$schoolid}' AND u.sid = 0 ");
    $msg = '';
    $allow = 1;
    //我当前的身份是老师还是学生申请
    $tid = pdo_fetch("SELECT id FROM ".GetTableName('teachers')." WHERE schoolid = '{$schoolid}' AND openid = '{$openid}' ")['id'];
    if($teacher['id']){ //是老师--判断当前用户当前课程是否已经注册成功
        //查询当前老师是否已经有当前课程的推广父亲
        $own_pu_id = pdo_fetch("SELECT id FROM ".GetTableName('yiheedu_promote_user')." WHERE schoolid = '{$_GPC['schoolid']}' AND tid = '{$teacher['id']}' ")['id'];
        $own_pu_id = $own_pu_id > 0 ? $own_pu_id : -1;
        $hasPrev = pdo_fetch("SELECT id FROM ".GetTableName('yiheedu_promote_relation')." WHERE schoolid = '{$_GPC['schoolid']}' AND pu_id = '{$own_pu_id}' AND kc_id = '{$relationInfo['kc_id']}' AND f_id !=0 ");
        if($hasPrev){ //表示当前注册已经成功了
            $allow = 0;
            $msg = '您在当前课程已有上级，请勿重复绑定';
        }
    }
    //查询是否提交过申请
    $hasForm = pdo_fetchAll("SELECT pu_id FROM ".GetTableName('yiheedu_form')." WHERE schoolid = '{$_GPC['schoolid']}' AND openid = '{$openid}' AND kc_id = '{$relationInfo['kc_id']}' AND sid = 0");
    if($hasForm){ 
        $pu_id_arr = array_column($hasForm,'pu_id');
        /**
         * 有提交过,分两种情况
         * pu_id相同,代表是同一条申请，推广员课程都一样,无须在次写入数据库
         * pu_id不相同,代表之前有过申请，但是推广员不同
         **/
        if(in_array($relationInfo['pu_id'],$pu_id_arr)){ //同样的推广不允许操作
            $allow = 0;
            $msg = '您已经提交过申请了,不能再次提交了!';
        }else{
            $allow = 1;
            $msg = '您在其他推广员已经申请,是否再次提交申请!';
        }
    }
    if($own_pu_id == $relationInfo['pu_id']){
        $allow = 0;
        $msg = '不能自己申请自己!';
    }
    include $this->template('greencom/yiheedu_form');
}else{
    session_destroy();
    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
    header("location:$stopurl");
    exit;
}
?>