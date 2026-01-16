<?php
require '../../framework/bootstrap.inc.php';
require './inc/class/AlipayService.class.php';
require './inc/function/functions.php';
header('Content-type:text/html; Charset=utf-8');

$paynumber = $_GET['out_trade_no'];
$recharge = pdo_get('lywywl_ztb_sys_pay', array('deltime' => 0, 'paynumber' => $paynumber));
if (empty($recharge)) {
    echo '信息错误';exit();
}

$module = pdo_get('uni_account_modules', array('module'=>'lywywl_ztb','uniacid'=>$recharge['uniacid']));
if (empty($module)) {
    echo '信息错误';exit();
}
$config = iunserializer($module['settings']);
$config = $config['ztb'];

//支付宝公钥，账户中心->密钥管理->开放平台密钥，找到添加了支付功能的应用，根据你的加密类型，查看支付宝公钥
$alipayPublicKey = $config['alipublickey'];
$aliPay = new AlipayService($alipayPublicKey);
//验证签名
$result = $aliPay->rsaCheck($_GET,$_GET['sign_type']);
if($result === true){
    //同步回调一般不处理业务逻辑，显示一个付款成功的页面，或者跳转到用户的财务记录页面即可。
    $domain = substr($_W['siteroot'],0,-19);
    $domain = str_replace("maxiang.vaiwan.com:8081/we7", "we7.com:8089", $domain); //todo:上线可以去掉
    if($recharge['types'] == 1){
        header('Location: ' . $domain . '/app/index.php?i='.$recharge['uniacid'].'&c=entry&a=webapp&do=store_renew&act=success&m=lywywl_ztb&paynumber=' . $_GET['out_trade_no']);
    }
    else{
        header('Location: ' . $domain . '/app/index.php?i='.$recharge['uniacid'].'&c=entry&a=webapp&do=alipay&act=success&m=lywywl_ztb&paynumber=' . $_GET['out_trade_no']);
    }
    exit();
}
echo '不合法的请求';exit();