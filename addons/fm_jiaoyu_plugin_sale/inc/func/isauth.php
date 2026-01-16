<?php
/**
 * By it猿工
 */
load()->model('mc');
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://'; 
$url = $http_type.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
$check = false;
if (!empty($_W['fans'])) {
	$check = false;
	$_SESSION['authurl'] = "";
}else{
	$check = true;
	$_SESSION['authurl'] = $url;
}

if($_W['schooltype'] === true || $_W['schooltype'] === false){
	
}else{
	$_W['schooltype']  = GetSchoolType($_GPC['schoolid'],$_W['uniacid']);
}
var_dump($_W['schooltype']);
// 跳转到授权页面
if($check){
	echo "<script>window.location.href = '".$_W['siteroot'].'app/'.substr($this->createMobileUrls('auth'),2)."';</script>";
	exit();
}
?>