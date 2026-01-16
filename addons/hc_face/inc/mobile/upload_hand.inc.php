<?php
defined('IN_IA') or exit('Access Denied');
require_once IA_ROOT."/addons/hc_face/inc/model/account.php"; 
global $_GPC, $_W;

$weid = $_W['uniacid'];
$uid = $_COOKIE['uid'];
$pid = empty($_GPC['pid'])?0:trim($_GPC['pid']);
$account = new Account($pid);
$account->redirect();
$account->account();
$forward = $account->share();
if($account->unseal()){
    include $this->template('appeal/list');die;
}
$openid = $_COOKIE['openid'];
$pay = json_decode(pdo_getcolumn('hcface_setting',array('only'=>'pay'.$weid),array('value')),'true');
$hand = pdo_getcolumn('hcface_hand_report',array('uid'=>$uid,'unlock'=>1),array('count(id)'));
$face = pdo_getcolumn('hcface_report',array('uid'=>$uid,'unlock'=>1),array('count(id)'));
$num = $hand+$face;
//用户在setting表中的 自定义
$customize = json_decode(pdo_getcolumn('hcface_setting',array('only'=>'customize'.$weid),array('value')),'true');
//判断是否开启关注公众号解锁
$lock = json_decode(pdo_getcolumn('hcface_setting',array('only'=>'lock'.$weid),array('value')),'true');
$lock['qrcode'] = tomedia($lock['qrcode']);
if($lock[app]==1 && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
	//判断当前用户是否关注公众号
	$account_api = WeAccount::create();
	$access_token = $account_api->getAccessToken();
	$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";

	$res = ihttp_get($url);
	$res = json_decode($res['content'],true);
	$subscribe = $res['subscribe'];
	if($subscribe==0 && $num==0){
		$wxapp = 1;
	}
}


include $this->template('upload_hand');