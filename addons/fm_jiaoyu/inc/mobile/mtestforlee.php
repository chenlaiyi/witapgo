<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
global $_W, $_GPC;
 
$weid = $_W['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
$schooltype = $_W['schooltype'];
$userss = intval($_GPC['userid']);
$obid = 1;
 
	$item = pdo_fetch("SELECT * FROM " . tablename ( 'mc_members' ) . " where uniacid=:uniacid AND uid=:uid ", array(':uid' => $it['uid'], ':uniacid' => $weid));  $userinfo = iunserializer($it['userinfo']);
	$this->checkobjiect($schoolid, $student['id'], $obid);
	include $this->template('mtestforlee');
        
?>