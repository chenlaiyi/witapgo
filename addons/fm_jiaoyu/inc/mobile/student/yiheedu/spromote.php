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
$school = pdo_fetch("SELECT title FROM ".GetTableName('index')." WHERE id = {$schoolid} ");
//查询是否用户登录
$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where id = :id And openid = :openid", array(':id' => $_SESSION['user'],':openid' => $openid));
if(!empty($it)){
    //协议
    $deal = pdo_fetch("SELECT deal FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}' AND kc_id = 0")['deal'];
    $promote_status = pdo_fetch("SELECT promote_status FROM ".GetTableName('students')." WHERE schoolid = '{$schoolid}' AND id = '{$it['sid']}' ")['promote_status'];
    if($promote_status == 0){
        $showPage = false;
    }else{
        $showPage = true;
    }
    //是否已经申请
    $hasApplication = pdo_fetch("SELECT status FROM ".GetTableName('yiheedu_form')." WHERE schoolid = '{$schoolid}' AND sid = '{$it['sid']}' ");
    //推广员id
    $pu_id = pdo_fetch("SELECT id FROM ".GetTableName('yiheedu_promote_user')." WHERE schoolid = '{$schoolid}' AND sid = '{$it['sid']}' ")['id'];
    //查询所有课程
    mload()->model('stu');
    $list = getHasSyksStu($schoolid,$it['sid']);
    foreach ($list as $key => $value) {
        $tcourse = pdo_fetch("SELECT * FROM ".GetTableName('tcourse')." WHERE id = '{$value['kcid']}' ");
        $list[$key]['name'] = $tcourse['name'];
        $list[$key]['start'] = $tcourse['start'];
        $list[$key]['end'] = $tcourse['end'];
        $list[$key]['is_try'] = $tcourse['is_try'];
        $list[$key]['thumb'] = $tcourse['thumb'];
        $list[$key]['kc_type'] = $tcourse['kc_type'];
    }
	include $this->template('students/yiheedu/spromote');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}
?>