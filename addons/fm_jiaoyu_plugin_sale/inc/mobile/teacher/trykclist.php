<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
//查询是否用户登录
$it = pdo_fetch("SELECT id,tid,is_allowmsg FROM " . GetTableName('user') . " where schoolid = :schoolid And openid = :openid And sid = :sid ", array(':schoolid' => $schoolid,':openid' => $openid,':sid' => 0));
if(!empty($it)){
	mload()->model('kc');
	$school = pdo_fetch("SELECT style3,headcolor FROM " . GetTableName('index') . " where id = :id ", array(':id' => $schoolid));
	$teacher = pdo_fetch("SELECT tname,thumb FROM " . GetTableName('teachers') . " where id = :id ", array(':id' => $it['tid']));
	$list = GetProTeamByKc(array('tid'=>$it['tid'],'kcid'=>null));
	//var_dump($list);
	$allcont = $list['allcont']>0?$list['allcont']:1;$allsucnub = $list['allsucnub'];$zscont = $list['zscont']>0?$list['zscont']:1;$zssuccont = $list['zssuccont'];$stcont = $list['stcont']>0?$list['stcont']:1;$stsuccont = $list['stsuccont'];
	//3大圆形表
	$allbili = intval(100*($allsucnub/$allcont));
	$allbilis = round($allsucnub/$allcont,2);
	$zsbili = intval(100*($zssuccont/$zscont));
	$zsbilis = round($zssuccont/$zscont,2);
	$stbili = intval(100*($stsuccont/$stcont));
	$stbilis = round($stsuccont/$stcont,2);
	include $this->template('teacher/trykclist');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}
?>