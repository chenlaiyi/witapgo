<?php
global $_W, $_GPC;
$openid = $_SESSION['openid'];
$cservicename = $_SESSION['cservicename'];
$cservicavatar = $_SESSION['cservicavatar'];
if(!empty($openid)){
	$url = $this->createMobileUrl('kefucenter');
	header("Location:".$url);
}else{
	if(!empty($_COOKIE["openid"])){
		$_SESSION['openid'] = $_COOKIE["openid"];
		$_SESSION['cservicename'] = $_COOKIE["cservicename"];
		$_SESSION['cservicavatar'] = $_COOKIE["cservicavatar"];
		$url = $this->createMobileUrl('kefucenter');
		header("Location:".$url);
	}
}
$op = trim($_GPC['op']);
if($op == 'login'){
	$username = trim($_GPC['username']);
	$pwd = trim($_GPC['password']);
	if(empty($username) || empty($pwd)){
		$resArr['error'] = 1;
		$resArr['msg'] = '用户名和密码不得为空！';
		echo json_encode($resArr);
		exit;
	}
	$pwd = sha1($pwd);
	$cservice = pdo_fetch("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE weid = '{$_W['uniacid']}' AND username= '{$username}' AND pwd = '{$pwd}' AND ctype = 1");
	if(empty($cservice)){
		$resArr['error'] = 1;
		$resArr['msg'] = '用户名或密码错误！';
		echo json_encode($resArr);
		exit;
	}
	setcookie("openid",$cservice['content'],time()+3600*24*7);
	setcookie("cservicename",$cservice['name'],time()+3600*24*7);
	setcookie("cservicavatar",tomedia($cservice['thumb']),time()+3600*24*7);
	$_SESSION['openid'] = $cservice['content'];
	$_SESSION['cservicename'] = $cservice['name'];
	$_SESSION['cservicavatar'] = tomedia($cservice['thumb']);
	if($cservice['iszx'] == 1){
		$data['isrealzx'] = 1;
		$data['ispczx'] = 1;
		pdo_update(BEST_CSERVICE,$data,array('id'=>$cservice['id']));
	}
	$resArr['error'] = 0;
	$resArr['msg'] = '登录成功！';
	echo json_encode($resArr);
	exit;
}else{
	include $this->template('kefulogin');
}
?>