<?php
require '../../framework/bootstrap.inc.php';
require './inc/class/AllinpayService.class.php';
require './inc/function/functions.php';

header('Content-type:text/html; Charset=utf-8');

if(empty($_GET['reqsn'])){
    echo "订单号不能为空";
    exit();
}

$paynumber = $_GET['reqsn'];
$recharge = pdo_get('lywywl_ztb_sys_pay', array('deltime' => 0, 'paynumber' => $paynumber));
if (empty($recharge)) {
    echo '订单不存在';
    exit();
}

//通联支付插件
$plug_allinpay = getPluginStatus($recharge['uniacid'], 'lywywl_ztb_plugin_allinpay');
if(!$plug_allinpay){
    echo "未开启支付处理";
    exit();
}

$module = pdo_get('uni_account_modules', array('module'=>'lywywl_ztb','uniacid'=>$recharge['uniacid']));
if (empty($module)) {
    echo '模块配置信息错误';
    exit();
}
$config = iunserializer($module['settings']);
$config = $config['ztb'];

$appkey = getPluginConfig($recharge['uniacid'], 'lywywl_ztb_plugin_allinpay', 'appkey');

//验签
if(AllinPayService::ValidSign($_GET, $appkey)){
     $paymoney = intval($_GET['trxamt']) / 100;
    $domain = substr($_W['siteroot'], 0, -19);
    if($recharge['types'] == 3){
        $dataarr = explode(",", $recharge['data']);
        $token = $dataarr[0];
        $store_id = $recharge['store_id'];
        $uniacid = $recharge['uniacid'];

        $activity = pdo_get(ztbNopreTable('obj_activity'), array('deltime' => 0, 'status' => 1, 'uniacid' => $uniacid, 'store_id' => $store_id, 'token' => $token));
        if(!empty($activity)){
            if ($activity['activity_types'] == 2) {
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];

                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_soliciting&m=lywywl_ztb";
                $url = replaceDieDomain($config, $url, 0, 0, 0);

                $act_url = "{$domain}/app/index.php?i={$uniacid}&c=entry&token={$token}&do=scan&m=lywywl_ztb";
                $act_url = replaceDieDomain($config, $act_url, 0, 0, 0);
            }
            else if($activity['activity_types'] == 3){
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];

                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_union&m=lywywl_ztb";
                $url = replaceDieDomain($config, $url, 0, 0, 0);
            }
            else if($activity['activity_types'] == 15){
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];

                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_cut&m=lywywl_ztb";
                $url = replaceDieDomain($config, $url, 0, 0, 0);
                $act_url = "{$domain}/app/index.php?i={$uniacid}&c=entry&token={$token}&do=scan&m=lywywl_ztb";
                $act_url = replaceDieDomain($config, $act_url, 0, 0, 0);
            }
            else if($activity['activity_types'] == 16){
                $join_id = $dataarr[1];
                $origin_id = $dataarr[4];
                $pay_types = $dataarr[2];

                if($pay_types == 1){
                    //参团支付
                    $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkJoinPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_collage&m=lywywl_ztb";
                    $url = replaceDieDomain($config, $url, 0, 0, 0);
                }
                else if($pay_types == 0){
                    //购买支付
                    $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_collage&m=lywywl_ztb";
                    $url = replaceDieDomain($config, $url, 0, 0, 0);
                    $act_url = "{$domain}/app/index.php?i={$uniacid}&c=entry&token={$token}&do=scan&m=lywywl_ztb";
                    $act_url = replaceDieDomain($config, $act_url, 0, 0, 0);
                }
            }
            else if($activity['activity_types'] == 17){
                $join_id = $dataarr[1];
                $pay_types = $dataarr[2];
                if($pay_types == 1){
                    //参团支付
                    $origin_id = $dataarr[4];
                    $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkJoinPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_ladder&m=lywywl_ztb";
                    $url = replaceDieDomain($config, $url, 0, 0, 0);
                }
                else if($pay_types == 0)
                {
                    //购买支付
                    $origin_id = $dataarr[3];
                    $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_ladder&m=lywywl_ztb";
                    $url = replaceDieDomain($config, $url, 0, 0, 0);
                    $act_url = "{$domain}/app/index.php?i={$uniacid}&c=entry&token={$token}&do=scan&m=lywywl_ztb";
                    $act_url = replaceDieDomain($config, $act_url, 0, 0, 0);
                }
            }
            else if($activity['activity_types'] == 18){
                $origin_id = intval($dataarr[4]);
                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&pay_number={$paynumber}&incoming=pay&do=obj_vote&m=lywywl_ztb";
                $url = replaceDieDomain($config, $url, 0, 0, 0);
            }
            else if($activity['activity_types'] == 20){
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];

                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_enroll&m=lywywl_ztb";
                $url = replaceDieDomain($config, $url, 0, 0, 0);

                $act_url = "{$domain}/app/index.php?i={$uniacid}&c=entry&token={$token}&do=scan&m=lywywl_ztb";
                $act_url = replaceDieDomain($config, $act_url, 0, 0, 0);
            }
            else if($activity['activity_types'] == 21){
                $join_id = $dataarr[1];
                $origin_id = $dataarr[3];

                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=checkPay&token={$token}&origin_id={$origin_id}&join_id={$join_id}&pay_number={$paynumber}&incoming=pay&do=obj_whole&m=lywywl_ztb";
                $url = replaceDieDomain($config, $url, 0, 0, 0);

                $act_url = "{$domain}/app/index.php?i={$uniacid}&c=entry&token={$token}&do=scan&m=lywywl_ztb";
                $act_url = replaceDieDomain($config, $act_url, 0, 0, 0);
            }

        }
    }
}
else{
    echo "验签失败";
    exit();
}

?>

<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="email=no"/>
    <title>支付结果</title>
    <style type="text/css">
        *{padding:0;margin:0;border:0;outline:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;-webkit-touch-callout:none;-webkit-appearance:none !important;-webkit-tap-highlight-color:transparent;}html,body{position:relative;max-width:640px;height:100%;min-height:100%;margin:0px auto;font-size:16px;font-family:-apple-system-font,Helvetica Neue,Helvetica,sans-serif;color:#111;background-color:#fff;}.btn-get {width: 100%;height: 40px;line-height: 40px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              -moz-border-radius: 3px;border-radius: 3px;font-size: 15px;color: #f4fff7;text-align: center;background-color: #309FE6;border: none;outline: 0;}.btn-get2 {width: 40%;height: 40px;line-height: 40px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              -moz-border-radius: 3px;border-radius: 3px;font-size: 15px;color: #f4fff7;text-align: center;background-color: #309FE6;border: none;outline: 0;margin-right: 10px;}.order_msg{padding-top:4.375rem;text-align:center;}.order_text_area{margin-bottom:1.6rem;padding:0 1.3rem;}.order_msg_title{line-height:1.6;margin-bottom:0.4rem;font-weight:bold;font-size:1.4rem;color:#098AE1;}.order_msg_success,{line-height:1.6;font-size:1rem;color:#999;}.order_items_area{margin:1.3rem 2.3rem;padding:1.4rem 0;border-top:1px solid #f7f7f7;}.order_item_area{display:-webkit-box;display:-webkit-flex;display:flex;line-height:1.875rem;font-size:1.1rem;text-align:left;}.order_item_hd{width:7rem;color:#666;}.order_item_bd{-webkit-box-flex:1;-webkit-flex:1;flex:1;color:#333;}@media screen and (min-height:0px) and (max-height:449px){html{font-size:9px;}}@media screen and (min-height:450px) and (max-height:499px){html{font-size:10px;}}@media screen and (min-height:500px) and (max-height:549px){html{font-size:11px;}}@media screen and (min-height:550px) and (max-height:599px){html{font-size:12px;}}@media screen and (min-height:600px) and (max-height:649px){html{font-size:13px;}}@media screen and (min-height:650px) and (max-height:699px){html{font-size:14.5px;}}@media screen and (min-height:700px) and (max-height:749px){html{font-size:16px;}}@media screen and (min-height:750px) and (max-height:799px){html{font-size:16.5px;}}@media screen and (min-height:800px) and (max-height:849px){html{font-size:17.5px;}}@media screen and (min-height:850px) and (max-height:899px){html{font-size:18.5px;}}@media screen and (min-height:900px) and (max-height:949px){html{font-size:19.5px;}}@media screen and (min-height:950px) and (max-height:999px){html{font-size:20.5px;}}@media screen and (min-height:1000px) and (max-height:1280px){html{font-size:21px;}}@media (min-height:1281px){html{font-size:22px;}}
    </style>

    <script type="text/javascript" charset="UTF-8" src="https://wx.gtimg.com/pay_h5/goldplan/js/jgoldplan-1.0.0.js"></script>
    <script type="text/javascript">
        let mchData ={action:'onIframeReady',displayStyle:'SHOW_CUSTOM_PAGE'};//显示当前商家结果页
        //let mchData ={action:'onIframeReady',displayStyle:'SHOW_CUSTOM_PAGE',height:900};//显示当前商家结果页 自定义结果页高度
        //let mchData ={action:'onIframeReady',displayStyle:'SHOW_OFFICIAL_PAGE'};//显示微信官方结果页
        let postData = JSON.stringify(mchData);
        parent.postMessage(postData,'https://payapp.weixin.qq.com');

        //跳到外部页
        function jupout(){
            let mchData ={action:'jumpOut', jumpOutUrl:'<?php echo $url ?>'};
            let postData = JSON. stringify(mchData);
            parent.postMessage(postData,'https://payapp.weixin.qq.com');
        }

        //跳转活动链接
        function jupact(){
            let mchData ={action:'jumpOut', jumpOutUrl:'<?php echo $act_url ?>'};
            let postData = JSON. stringify(mchData);
            parent.postMessage(postData,'https://payapp.weixin.qq.com');
        }
    </script>
</head>
<body>
<div class="order_msg">
    <div class="order_text_area">
        <h2 class="order_msg_title order_msg_success">订单支付成功</h2>
    </div>
    <div class="order_items_area">
        <div class="order_item_area">
            <div class="order_item_hd">订单编号</div>
            <div class="order_item_bd"><?php echo $paynumber; ?></div>
        </div>
        <div class="order_item_area">
            <div class="order_item_hd">订单金额</div>
            <div class="order_item_bd">¥<?php echo $paymoney; ?></div>
            <div class="order_item_bd"></div>

        </div>
    </div>
    <?php if($activity['activity_types'] == 2){ ?>
    <button class="btn-get2" onclick="jupact()">返回活动</button>
    <button class="btn-get2" onclick="jupout()">查看订单</button>
    <?php } else if($activity['activity_types'] == 3) {?>
        <button class="btn-get" onclick="jupout()">返回活动</button>
    <?php } else if($activity['activity_types'] == 15) {?>
        <button class="btn-get2" onclick="jupact()">返回活动</button>
        <button class="btn-get2" onclick="jupout()">查看订单</button>
    <?php } else if($activity['activity_types'] == 16 && $pay_types == 1) {?>
        <button class="btn-get" onclick="jupout()">返回活动</button>
    <?php } else if($activity['activity_types'] == 16 && $pay_types == 0) {?>
        <button class="btn-get2" onclick="jupact()">返回活动</button>
        <button class="btn-get2" onclick="jupout()">查看订单</button>
    <?php } else if($activity['activity_types'] == 17 && $pay_types == 1) {?>
        <button class="btn-get" onclick="jupout()">返回活动</button>
    <?php } else if($activity['activity_types'] == 17 && $pay_types == 0) {?>
        <button class="btn-get2" onclick="jupact()">返回活动</button>
        <button class="btn-get2" onclick="jupout()">查看订单</button>
    <?php } else if($activity['activity_types'] == 18) {?>
        <button class="btn-get" onclick="jupout()">返回活动</button>
    <?php } else if($activity['activity_types'] == 20) {?>
        <button class="btn-get2" onclick="jupact()">返回活动</button>
        <button class="btn-get2" onclick="jupout()">查看订单</button>
    <?php } else if($activity['activity_types'] == 21) {?>
        <button class="btn-get2" onclick="jupact()">返回活动</button>
        <button class="btn-get2" onclick="jupout()">查看订单</button>
    <?php } ?>
</div>
</body>
</html>
