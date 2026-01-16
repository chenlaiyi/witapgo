<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$kcid = intval($_GPC['kcid']);
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];

//查询是否用户登录
$it = pdo_fetch("SELECT id,tid,is_allowmsg FROM " . GetTableName('user') . " where schoolid = :schoolid And openid = :openid And sid = :sid ", array(':schoolid' => $schoolid, ':openid' => $openid, ':sid' => 0 ));		
if(!empty($it)){
	$school = pdo_fetch("SELECT style3,headcolor,is_stuewcode,spic FROM " . GetTableName('index') . " where id = :id ", array(':id' => $schoolid));
	$ertype = true;
	if($school['is_stuewcode'] == 2){
		$ertype = false;
	}
	$allstu = pdo_fetchall("SELECT distinct sid FROM " . GetTableName('order') . " where kcid = :kcid ", array(':kcid' => $kcid));

	if(!empty($allstu)){
		$mystudents = pdo_fetch("SELECT id,sex,s_name,icon,mobile,ouserid,muserid,duserid,otheruserid,qrcode_id FROM " . GetTableName('students') . " where id = :id And superior_tid = :superior_tid ", array(':id' => $row['sid'],':superior_tid' => $it['tid']));
	}
	include $this->template('teacher/kcbmlist');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}
?>