<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/permission.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
load()->func("file");
$act = trim($_GPC["act"]);
$allow_acts = array("index", "checkAuth", "getReportForms", "getUserChart", "getJoinChart", "getMoneyChart", "getCardChart", "nopower");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$title = "控制面板";
if ($act == "index") {
    if (!file_exists(IA_ROOT . "/web/ztb.php")) {
        copy(MODULE_ROOT . "/admin/index.php", IA_ROOT . "/web/ztb.php");
        @chmod(IA_ROOT . "/web/ztb.php", $_W["config"]["setting"]["filemode"]);
    }
    copy(MODULE_ROOT . "/admin/webapp.php", MODULE_ROOT . "/webapp.php");
    @chmod(MODULE_ROOT . "/webapp.php", $_W["config"]["setting"]["filemode"]);
    $warring = trim($_GPC["warring"]);
    if (empty($warring) || $warring === "renewError" || $warring === "statusError") {
        $authCache = cache_load("lywywl_ztb_auth_cache" . $_W["uniacid"]);
        if (empty($authCache)) {
            load()->func("communication");
            if (file_exists(MODULE_ROOT . "/resource/auth/validate" . $_W["uniacid"] . ".txt")) {
                $fileContent = file_get_contents(MODULE_ROOT . "/resource/auth/validate" . $_W["uniacid"] . ".txt");
                $fileArr = explode(",", $fileContent);
                if (count($fileArr) == 5 || count($fileArr) == 6) {
                    $objectCode = IN_MODULE;
                    $contacts = $fileArr[2];
                    $tel = $fileArr[3];
                    $authCode = $fileArr[1];
                    $domain = $_SERVER["HTTP_HOST"];
                    $ip = $_SERVER["SERVER_ADDR"];
                    $wxAppID = $fileArr[4];
                    $types = intval($fileArr[5]);
                    $timer = TIMESTAMP;
                    $signStr = "ObjectCode=" . $objectCode . "&Contacts=" . $contacts . "&Tel=" . $tel . "&AuthCode=" . $authCode . "&Domain=" . $domain . "&IP=" . $ip . "&WxAppID=" . $wxAppID . "-" . $_W["uniacid"] . "&Power=www.lywywl.com";
                    $signStr = strtolower($signStr);
                    $sign = strtoupper(md5($signStr));
                    $posturl = "http://auth.lywywl.com/api";
                    $post = array("ObjectCode" => $objectCode, "Contacts" => $contacts, "Tel" => $tel, "AuthCode" => $authCode, "Domain" => $domain, "IP" => $ip, "WxAppID" => $wxAppID . "-" . $_W["uniacid"], "Sign" => $sign, "Timer" => $timer);
                    $BackTime = strtoupper(md5($timer . ",www.lywywl.com"));
$content = array("status" => 1, "list" => array("AuthTimer" => $BackTime, "CustomerTypes" => 2, "Domain" => $domain, "IP" => $ip, "Plugins"=>'lywywl_ztb_plugin_storeinvite,lywywl_ztb_plugin_wholegroup,lywywl_ztb_plugin_10second,lywywl_ztb_plugin_appad,lywywl_ztb_plugin_rategroup,lywywl_ztb_plugin_adcheck,lywywl_ztb_plugin_twoinvite,lywywl_ztb_plugin_allinpay,lywywl_ztb_plugin_vaptcha,lywywl_ztb_plugin_shareborrow,lywywl_ztb_plugin_voice,lywywl_ztb_plugin_home,lywywl_ztb_plugin_refundtool,lywywl_ztb_plugin_ladderinvite,lywywl_ztb_plugin_texttoaudio,lywywl_ztb_plugin_bigscreen', "WxAppID" => $wxAppID, "StartTime" => '1973-12-12 00:00:00'));
$content = json_encode($content);
$response = array('code' => '200', 'content' => $content);
                    if ($response["code"] == "200") {
                        $result = (array) json_decode($response["content"], true);
                        if ($result["list"]["CustomerTypes"] != $types) {
                            $warring = "pirateError";
                        }
                        if ($result["status"] == 1) {
                            $BackTime = $result["list"]["AuthTimer"];
                            $AuthTimer = strtoupper(md5($timer . ",www.lywywl.com"));
                            if ($BackTime == $AuthTimer) {
                                cache_delete("lywywl_ztb_auth_cache" . $_W["uniacid"]);
                                cache_write("lywywl_ztb_auth_cache" . $_W["uniacid"], $result["list"], 60 * 60 * 24);
                            } else {
                                $warring = "pirateError";
                            }
                        } else {
                            if ($result["status"] == -2) {
                                cache_delete("lywywl_ztb_auth_cache" . $_W["uniacid"]);
                                cache_write("lywywl_ztb_auth_cache" . $_W["uniacid"], $result["list"], 60 * 60 * 24);
                                $warring = "statusError";
                            } else {
                                if ($result["status"] == 0) {
                                    $warring = "paraError";
                                } else {
                                    if ($result["status"] == 2) {
                                        cache_delete("lywywl_ztb_auth_cache" . $_W["uniacid"]);
                                        cache_write("lywywl_ztb_auth_cache" . $_W["uniacid"], $result["list"], 60 * 60 * 24);
                                        $warring = "renewError";
                                    } else {
                                        $warring = "pirateError";
                                    }
                                }
                            }
                        }
                    } else {
                        $warring = "networkError";
                    }
                } else {
                    $warring = "fileError";
                }
            } else {
                $warring = "waitError";
            }
        }
    }
    if (empty($warring) || $warring === "renewError" || $warring === "statusError") {
        $authData = cache_load("lywywl_ztb_auth_cache" . $_W["uniacid"]);
        $fileContent = file_get_contents(MODULE_ROOT . "/resource/auth/validate" . $_W["uniacid"] . ".txt");
        $authFile = explode(",", $fileContent);
    }
    $storeTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("store_account") . " where `uniacid`=:uniacid and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    $userTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    $objTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_activity") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    $buyTotal = pdo_fetchcolumn("SELECT SUM(buy_num) FROM " . ztbTable("obj_activity") . " where `uniacid`=:uniacid and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    if (empty($buyTotal)) {
        $buyTotal = "0";
    }
    $drawTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    $clickTotal = pdo_fetchcolumn("SELECT SUM(click_num) FROM " . ztbTable("obj_activity") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($clickTotal)) {
        $clickTotal = "0";
    }
    $storeMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_account") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeMoney)) {
        $storeMoney = "0.00";
    }
    $storeSms = pdo_fetchcolumn("SELECT sum(sms) FROM " . ztbTable("store_account") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeSms)) {
        $storeSms = 0;
    }
    $storeRechargeMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_bill") . " where `uniacid`=:uniacid and types=1 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeRechargeMoney)) {
        $storeRechargeMoney = "0.00";
    }
    $storeRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_refund") . " where `uniacid`=:uniacid and status=1 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeRefundMoney)) {
        $storeRefundMoney = "0.00";
    }
    $storeRenewMoney = pdo_fetchcolumn("SELECT sum(paymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and types=1 and status=1 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeRenewMoney)) {
        $storeRenewMoney = "0.00";
    }
    $userMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($userMoney)) {
        $userMoney = "0.00";
    }
    $userScore = pdo_fetchcolumn("SELECT sum(score) FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($userScore)) {
        $userScore = "0";
    }
    $userRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_refund") . " where `uniacid`=:uniacid and status=1 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($userRefundMoney)) {
        $userRefundMoney = "0.00";
    }
    $drawSys = pdo_fetchcolumn("SELECT sum(sys) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawSys)) {
        $drawSys = "0.00";
    }
    $drawWallet = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawWallet)) {
        $drawWallet = "0.00";
    }
    $drawScore = pdo_fetchcolumn("SELECT sum(score) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawScore)) {
        $drawScore = "0";
    }
    $drawCard = pdo_fetchcolumn("SELECT count(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and types=5 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawCard)) {
        $drawCard = "0";
    }
    $drawProduct = pdo_fetchcolumn("SELECT count(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and types=4 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawProduct)) {
        $drawProduct = "0";
    }
    $JoinPayMoney = pdo_fetchcolumn("SELECT sum(paymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and types=3 and status=1 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($JoinPayMoney)) {
        $JoinPayMoney = "0.00";
    }
    $ShopPayMoney = pdo_fetchcolumn("SELECT sum(paymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and types=4 and status=1 and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    if (empty($ShopPayMoney)) {
        $ShopPayMoney = "0.00";
    }
    $myPayMoney = pdo_fetchcolumn("SELECT sum(mymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and (types=3 or types=4) and status=1 and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    if (empty($myPayMoney)) {
        $myPayMoney = "0.00";
    }
    if ($_W["role"] == "founder") {
        $userList = pdo_fetchall("SELECT * FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and `deltime`=0  ORDER BY ID desc LIMIT 24", array(":uniacid" => $_W["uniacid"]));
        $investTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("sys_invest") . " where `uniacid`=:uniacid and status=0 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
        $complainTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("sys_complain") . " where `uniacid`=:uniacid and status=0 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
        $storeRefundTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("store_refund") . " where `uniacid`=:uniacid and status=0 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
        $userRefundTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_refund") . " where `uniacid`=:uniacid and status=0 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
        $reissueTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("sys_reissue") . " where `uniacid`=:uniacid and status=0  and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    }
    include $this->template("web/home");
    exit;
}
if ($act == "getReportForms" && $request_method == "post") {
    header("Content-Type: text/html; charset=utf-8");
    $day = $_GPC["day"];
    $storeTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("store_account") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    $storeRechargeMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_bill") . " where `uniacid`=:uniacid and types=1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeRechargeMoney)) {
        $storeRechargeMoney = "0.00";
    }
    $storeRenewMoney = pdo_fetchcolumn("SELECT sum(paymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and types=1 and status=1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeRenewMoney)) {
        $storeRenewMoney = "0.00";
    }
    $storeRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_refund") . " where `uniacid`=:uniacid and status=1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($storeRefundMoney)) {
        $storeRefundMoney = "0.00";
    }
    $objTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_activity") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    $userTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    $ShopPayMoney = pdo_fetchcolumn("SELECT sum(paymoney + mymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and types=4 and status=1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    if (empty($ShopPayMoney)) {
        $ShopPayMoney = "0.00";
    }
    $shopOrderTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("order_intmall") . " where `uniacid`=:uniacid and status>1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"]));
    $JoinPayMoney = pdo_fetchcolumn("SELECT sum(paymoney + mymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and types=3 and status=1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($JoinPayMoney)) {
        $JoinPayMoney = "0.00";
    }
    $userRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_refund") . " where `uniacid`=:uniacid and status=1 and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($userRefundMoney)) {
        $userRefundMoney = "0.00";
    }
    $drawTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    $drawSys = pdo_fetchcolumn("SELECT sum(sys) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawSys)) {
        $drawSys = "0.00";
    }
    $drawWallet = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawWallet)) {
        $drawWallet = "0.00";
    }
    $drawScore = pdo_fetchcolumn("SELECT sum(score) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawScore)) {
        $drawScore = "0";
    }
    $drawCard = pdo_fetchcolumn("SELECT count(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and types=5 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    if (empty($drawCard)) {
        $drawCard = "0";
    }
    $drawProduct = pdo_fetchcolumn("SELECT count(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and DATE_SUB(CURDATE(), INTERVAL " . ($day - 1) . " DAY) <= date(from_unixtime(createtime)) and types=4 and `deltime`=0", array(":uniacid" => $_W["uniacid"]));
    $retrenHtml = "<table class=\"table\"style=\"text-align: center;\"><tr><th class=\"tc\">新进商家</th><th class=\"tc\">商家充值</th><th class=\"tc\">商家续费</th><th class=\"tc\">商家提现</th><th class=\"tc\">新增活动</th><th class=\"tc\">新进会员</th><th class=\"tc\">商城支付</th><th class=\"tc\">商城出售</th></tr><tr><td>" . $storeTotal . "家</td><td>" . $storeRechargeMoney . "元</td><td>" . $storeRenewMoney . "元</td><td>" . $storeRefundMoney . "元</td><td>" . $objTotal . "场</td><td>" . $userTotal . "人</td><td>" . $ShopPayMoney . "元</td><td>" . $shopOrderTotal . "件</td></tr><tr><th class=\"tc\">用户支付</th><th class=\"tc\">用户提现</th><th class=\"tc\">送出奖品</th><th class=\"tc\">送出余额</th><th class=\"tc\">送出现金</th><th class=\"tc\">送出积分</th><th class=\"tc\">送出卡券</th><th class=\"tc\">送出商品</th></tr><tr><td>" . $JoinPayMoney . "元</td><td>" . $userRefundMoney . "元</td><td>" . $drawTotal . "次</td><td>" . $drawSys . "元</td><td>" . $drawWallet . "元</td><td>" . $drawScore . "积分</td><td>" . $drawCard . "张</td><td>" . $drawProduct . "件</td></tr></table>";
    exit($retrenHtml);
}
if ($act == "checkAuth" && $request_method == "post") {
    header("Content-Type: application/json; charset=utf-8");
    $wxAppID = $_GPC["wxAppID"];
    $authCode = $_GPC["authCode"];
    if (empty($authCode)) {
        exit(json_encode(array("status" => 2, "msg" => "请完善信息授权信息后验证授权！"), JSON_UNESCAPED_UNICODE));
    }
    $userName = $_GPC["userName"];
    if (empty($userName)) {
        exit(json_encode(array("status" => 2, "msg" => "请完善信息授权信息后验证授权！"), JSON_UNESCAPED_UNICODE));
    }
    $userTel = $_GPC["userTel"];
    if (empty($userTel)) {
        exit(json_encode(array("status" => 2, "msg" => "请完善信息授权信息后验证授权！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($_W["account"]["key"])) {
        exit(json_encode(array("status" => 2, "msg" => "请绑定微信公众号后验证授权！"), JSON_UNESCAPED_UNICODE));
    }
    $objectCode = IN_MODULE;
    $contacts = $userName;
    $tel = $userTel;
    $domain = $_SERVER["HTTP_HOST"];
    $ip = $_SERVER["SERVER_ADDR"];
    $wxAppID = $wxAppID;
    $timer = TIMESTAMP;
    $signStr = "ObjectCode=" . $objectCode . "&Contacts=" . $contacts . "&Tel=" . $tel . "&AuthCode=" . $authCode . "&Domain=" . $domain . "&IP=" . $ip . "&WxAppID=" . $wxAppID . "-" . $_W["uniacid"] . "&Power=www.lywywl.com";
    $signStr = strtolower($signStr);
    $sign = strtoupper(md5($signStr));
    load()->func("communication");
    $posturl = "http://auth.lywywl.com/api";
    $post = array("ObjectCode" => $objectCode, "Contacts" => $contacts, "Tel" => $tel, "AuthCode" => $authCode, "Domain" => $domain, "IP" => $ip, "WxAppID" => $wxAppID . "-" . $_W["uniacid"], "Sign" => $sign, "Timer" => $timer);
$BackTime = strtoupper(md5($timer . ",www.lywywl.com"));
$content = array("status" => 1, "list" => array("AuthTimer" => $BackTime, "CustomerTypes" => 2, "Domain" => $domain, "IP" => $ip, "Plugins"=>'lywywl_ztb_plugin_storeinvite,lywywl_ztb_plugin_wholegroup,lywywl_ztb_plugin_10second,lywywl_ztb_plugin_appad,lywywl_ztb_plugin_rategroup,lywywl_ztb_plugin_adcheck,lywywl_ztb_plugin_twoinvite,lywywl_ztb_plugin_allinpay,lywywl_ztb_plugin_vaptcha,lywywl_ztb_plugin_shareborrow,lywywl_ztb_plugin_voice,lywywl_ztb_plugin_home,lywywl_ztb_plugin_refundtool,lywywl_ztb_plugin_ladderinvite,lywywl_ztb_plugin_texttoaudio,lywywl_ztb_plugin_bigscreen', "WxAppID" => $wxAppID, "StartTime" => '1973-12-12 00:00:00'));
$content = json_encode($content);
$response = array('code' => '200', 'content' => $content);
    if ($response["code"] == "200") {
        $result = (array) json_decode($response["content"], true);
        if ($result["status"] == 1) {
            $BackTime = $result["list"]["AuthTimer"];
            $AuthTimer = strtoupper(md5($timer . ",www.lywywl.com"));
            if ($BackTime == $AuthTimer) {
                cache_delete("lywywl_ztb_auth_cache" . $_W["uniacid"]);
                cache_write("lywywl_ztb_auth_cache" . $_W["uniacid"], $result["list"], 60 * 60 * 24);
                $setting = $this->module["config"];
                $setting["ztb"]["appid"] = $wxAppID;
                $this->saveSettings($setting);
                $filename = MODULE_ROOT . "/resource/auth/validate" . $_W["uniacid"] . ".txt";
                mkdirs(dirname($filename));
                file_put_contents($filename, IN_MODULE . "," . $authCode . "," . $contacts . "," . $tel . "," . $wxAppID . "," . $result["list"]["CustomerTypes"]);
                @chmod($filename, $_W["config"]["setting"]["filemode"]);
                if (is_file($filename)) {
                    exit(json_encode(array("status" => 1, "msg" => "恭喜您,系统授权成功，感谢您对我们的支持！"), JSON_UNESCAPED_UNICODE));
                }
                exit(json_encode(array("status" => 0, "msg" => "授权文件创建失败，请检查附件目录是否有可写权限！"), JSON_UNESCAPED_UNICODE));
            }
            exit(json_encode(array("status" => 0, "msg" => "您填写的授权码有误，请联系客服索取授权码！"), JSON_UNESCAPED_UNICODE));
        }
        if ($result["status"] == -2) {
            exit(json_encode(array("status" => 0, "msg" => "您填写的授权码已被禁用，请联系客服购买正版授权！"), JSON_UNESCAPED_UNICODE));
        }
        if ($result["status"] == 0) {
            exit(json_encode(array("status" => 2, "msg" => "对不起，网络请求超时请重试！"), JSON_UNESCAPED_UNICODE));
        }
        if ($result["status"] == 2) {
            exit(json_encode(array("status" => 0, "msg" => "您填写的授权码已过期，请联系客服购买正版授权！"), JSON_UNESCAPED_UNICODE));
        }
        exit(json_encode(array("status" => 0, "msg" => "对不起，请完善您的授权信息！"), JSON_UNESCAPED_UNICODE));
    }
    exit(json_encode(array("status" => 2, "msg" => "对不起，网络请求超时请重试！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "getUserChart" && $request_method == "post") {
    header("Content-Type: application/json; charset=utf-8");
    $chart_time = trim($_GPC["chart_time"]);
    $labels = array();
    $data = array();
    if ($chart_time == "month") {
        $i = 11;
        while ($i >= 0) {
            array_push($labels, date("Y-m", strtotime("-{$i} months", time())));
            $userTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and deltime=0 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($data, $userTotal);
            $i--;
        }
    } else {
        $i = 20;
        while ($i >= 0) {
            array_push($labels, date("m-d", strtotime("-{$i} days", time())));
            $userTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_account") . " where `uniacid`=:uniacid and deltime=0 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($data, $userTotal);
            $i--;
        }
    }
    exit(json_encode(array("labels" => $labels, "data" => $data), JSON_UNESCAPED_UNICODE));
}
if ($act == "getJoinChart" && $request_method == "post") {
    header("Content-Type: application/json; charset=utf-8");
    $chart_time = trim($_GPC["chart_time"]);
    $labels = array();
    $dataAct = array();
    $dataShare = array();
    $dataDraw = array();
    $dataPay = array();
    if ($chart_time == "month") {
        $i = 11;
        while ($i >= 0) {
            array_push($labels, date("Y-m", strtotime("-{$i} months", time())));
            $actTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_activity") . " where `uniacid`=:uniacid and deltime=0 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $shareTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_share") . " where `uniacid`=:uniacid and deltime=0 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $drawTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and deltime=0 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $payTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and deltime=0 and status=1 and types=3  and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($dataAct, $actTotal);
            array_push($dataShare, $shareTotal);
            array_push($dataDraw, $drawTotal);
            array_push($dataPay, $payTotal);
            $i--;
        }
    } else {
        $i = 20;
        while ($i >= 0) {
            array_push($labels, date("m-d", strtotime("-{$i} days", time())));
            $actTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_activity") . " where `uniacid`=:uniacid and deltime=0 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $shareTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_share") . " where `uniacid`=:uniacid and deltime=0 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $drawTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and deltime=0 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $payTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and deltime=0 and status=1 and types=3  and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($dataAct, $actTotal);
            array_push($dataShare, $shareTotal);
            array_push($dataDraw, $drawTotal);
            array_push($dataPay, $payTotal);
            $i--;
        }
    }
    exit(json_encode(array("labels" => $labels, "dataAct" => $dataAct, "dataShare" => $dataShare, "dataDraw" => $dataDraw, "dataPay" => $dataPay), JSON_UNESCAPED_UNICODE));
}
if ($act == "getMoneyChart" && $request_method == "post") {
    header("Content-Type: application/json; charset=utf-8");
    $chart_time = trim($_GPC["chart_time"]);
    $labels = array();
    $dataStoreRecharge = array();
    $dataStoreRefund = array();
    $dataUserPay = array();
    $dataUserRefund = array();
    if ($chart_time == "month") {
        $i = 11;
        while ($i >= 0) {
            array_push($labels, date("Y-m", strtotime("-{$i} months", time())));
            $storeRechargeMoney = pdo_fetchcolumn("SELECT sum(paymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and deltime=0 and types=2 and status=1 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $storeRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_refund") . " where `uniacid`=:uniacid and deltime=0  and status=1 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $userPayMoney = pdo_fetchcolumn("SELECT sum(paymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and deltime=0 and types>2 and status=1 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $userRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_refund") . " where `uniacid`=:uniacid and deltime=0 and status=1 and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($dataStoreRecharge, floatval($storeRechargeMoney));
            array_push($dataStoreRefund, floatval($storeRefundMoney));
            array_push($dataUserPay, floatval($userPayMoney));
            array_push($dataUserRefund, floatval($userRefundMoney));
            $i--;
        }
    } else {
        $i = 20;
        while ($i >= 0) {
            array_push($labels, date("m-d", strtotime("-{$i} days", time())));
            $storeRechargeMoney = pdo_fetchcolumn("SELECT sum(paymoney + mymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and deltime=0 and types=2 and status=1 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $storeRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("store_refund") . " where `uniacid`=:uniacid and deltime=0  and status=1 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $userPayMoney = pdo_fetchcolumn("SELECT sum(paymoney+ mymoney) FROM " . ztbTable("sys_pay") . " where `uniacid`=:uniacid and deltime=0 and types>2 and status=1 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $userRefundMoney = pdo_fetchcolumn("SELECT sum(money) FROM " . ztbTable("user_refund") . " where `uniacid`=:uniacid and deltime=0 and status=1 and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($dataStoreRecharge, floatval($storeRechargeMoney));
            array_push($dataStoreRefund, floatval($storeRefundMoney));
            array_push($dataUserPay, floatval($userPayMoney));
            array_push($dataUserRefund, floatval($userRefundMoney));
            $i--;
        }
    }
    exit(json_encode(array("labels" => $labels, "dataStoreRecharge" => $dataStoreRecharge, "dataStoreRefund" => $dataStoreRefund, "dataUserPay" => $dataUserPay, "dataUserRefund" => $dataUserRefund), JSON_UNESCAPED_UNICODE));
}
if ($act == "getCardChart" && $request_method == "post") {
    header("Content-Type: application/json; charset=utf-8");
    $chart_time = trim($_GPC["chart_time"]);
    $labels = array();
    $dataObj = array();
    $dataShop = array();
    if ($chart_time == "month") {
        $i = 11;
        while ($i >= 0) {
            array_push($labels, date("Y-m", strtotime("-{$i} months", time())));
            $objTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("order_obj") . " where `uniacid`=:uniacid and deltime=0  and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $shopTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("order_intmall") . " where `uniacid`=:uniacid and deltime=0 and (status=2 or status=3 or status=4) and PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(from_unixtime(createtime),'%Y%m')) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($dataObj, intval($objTotal));
            array_push($dataShop, intval($shopTotal));
            $i--;
        }
    } else {
        $i = 20;
        while ($i >= 0) {
            array_push($labels, date("m-d", strtotime("-{$i} days", time())));
            $objTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("order_obj") . " where `uniacid`=:uniacid and deltime=0  and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            $shopTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("order_intmall") . " where `uniacid`=:uniacid and deltime=0 and (status=2 or status=3 or status=4) and TO_DAYS(NOW()) - TO_DAYS(from_unixtime(createtime)) =" . $i, array(":uniacid" => $_W["uniacid"]));
            array_push($dataObj, intval($objTotal));
            array_push($dataShop, intval($shopTotal));
            $i--;
        }
    }
    exit(json_encode(array("labels" => $labels, "dataObj" => $dataObj, "dataShop" => $dataShop), JSON_UNESCAPED_UNICODE));
}
if (!($act == "nopower")) {
    exit;
}
include $this->template("web/nopower");