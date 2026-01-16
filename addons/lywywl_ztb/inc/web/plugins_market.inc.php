<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/permission.php";
global $_GPC, $_W, $config;
$title = "应用市场";
load()->func("communication");
load()->func("file");
$auth_plugin_list = '';
$authWarring = '';
$uniacid = $_W["uniacid"];
if (file_exists(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt")) {
    $fileContent = file_get_contents(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt");
    $fileArr = explode(",", $fileContent);
    if (count($fileArr) == 5 || count($fileArr) == 6) {
        $objectCode = IN_MODULE;
        $contacts = $fileArr[2];
        $tel = $fileArr[3];
        $authCode = $fileArr[1];
        $domain = $_SERVER["HTTP_HOST"];
        $ip = $_SERVER["SERVER_ADDR"];
        $wxAppID = $config["appid"];
        $types = intval($fileArr[5]);
        $timer = TIMESTAMP;
        $signStr = "ObjectCode=" . $objectCode . "&Contacts=" . $contacts . "&Tel=" . $tel . "&AuthCode=" . $authCode . "&Domain=" . $domain . "&IP=" . $ip . "&WxAppID=" . $wxAppID . "-" . $uniacid . "&Power=www.lywywl.com";
        $signStr = strtolower($signStr);
        $sign = strtoupper(md5($signStr));
        $posturl = "http://auth.lywywl.com/api";
        $post = array("ObjectCode" => $objectCode, "Contacts" => $contacts, "Tel" => $tel, "AuthCode" => $authCode, "Domain" => $domain, "IP" => $ip, "WxAppID" => $wxAppID . "-" . $uniacid, "Sign" => $sign, "Timer" => $timer);
$BackTime = strtoupper(md5($timer . ",www.lywywl.com"));
$content = array("status" => 1, "list" => array("AuthTimer" => $BackTime, "CustomerTypes" => 2, "Domain" => $domain, "IP" => $ip, "Plugins"=>'lywywl_ztb_plugin_storeinvite,lywywl_ztb_plugin_wholegroup,lywywl_ztb_plugin_10second,lywywl_ztb_plugin_appad,lywywl_ztb_plugin_rategroup,lywywl_ztb_plugin_adcheck,lywywl_ztb_plugin_twoinvite,lywywl_ztb_plugin_allinpay,lywywl_ztb_plugin_vaptcha,lywywl_ztb_plugin_shareborrow,lywywl_ztb_plugin_voice,lywywl_ztb_plugin_home,lywywl_ztb_plugin_refundtool,lywywl_ztb_plugin_ladderinvite,lywywl_ztb_plugin_texttoaudio,lywywl_ztb_plugin_bigscreen', "WxAppID" => $wxAppID, "StartTime" => '1973-12-12 00:00:00'));
$content = json_encode($content);
$response = array('code' => '200', 'content' => $content);
        if ($response["code"] == "200") {
            $result = (array) json_decode($response["content"], true);
            if ($result["list"]["CustomerTypes"] != $types) {
                $authWarring = "pirateError";
            }
            if ($result["status"] == 1) {
                $BackTime = $result["list"]["AuthTimer"];
                $AuthTimer = strtoupper(md5($timer . ",www.lywywl.com"));
                if ($BackTime == $AuthTimer) {
                    cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                    cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                    $auth_plugin_list = $result["list"]["Plugins"];
                } else {
                    $authWarring = "pirateError";
                }
            } else {
                if ($result["status"] == -2) {
                    cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                    cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                    $authWarring = "statusError";
                } else {
                    if ($result["status"] == 0) {
                        $authWarring = "paraError";
                    } else {
                        if ($result["status"] == 2) {
                            cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                            cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                            $authWarring = "renewError";
                        } else {
                            $authWarring = "pirateError";
                        }
                    }
                }
            }
        } else {
            $authWarring = "networkError";
        }
    } else {
        $authWarring = "fileError";
    }
} else {
    $authWarring = "waitError";
}

$buy_list = array();
$plugin_list = pdo_getall("modules", array("name like" => "lywywl_ztb_plugin_%"));
foreach ($plugin_list as $key => $plugin) {
    if (!pdo_fieldexists("modules_recycle", "modulename")) {
        if (strpos($auth_plugin_list, $plugin["name"]) !== false) {
            array_push($buy_list, $plugin["name"]);
        }
    } else {
        $recycle = pdo_get("modules_recycle", array("modulename" => $plugin["name"]), array("id", "modulename"));
        if (empty($recycle)) {
            if (strpos($auth_plugin_list, $plugin["name"]) !== false) {
                array_push($buy_list, $plugin["name"]);
            }
        }
    }
}
include $this->template("web/plugins_market/index");
exit;