<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/permission.php";
global $_GPC, $_W, $config;
$title = "系统配置";
$authWarring = checkLywywlAuth($_W["uniacid"], $config["appid"]);

if (!checksubmit()) {
    load()->func("communication");
    load()->func("file");
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

    $buyid_list = array();
    $buyname_list = array();
    $setconfig = array();
    $plugin_list = pdo_getall("modules", array("name like" => "lywywl_ztb_plugin_%"));
    foreach ($plugin_list as $key => $plugin) {
        if (!pdo_fieldexists("modules_recycle", "modulename")) {
            if (strpos($auth_plugin_list, $plugin["name"]) !== false) {
                $modules = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin["name"], "uniacid" => $_W["uniacid"], "deltime" => 0));
                if (empty($modules)) {
                    $result = pdo_insert("lywywl_ztb_sys_plugins", array("uniacid" => $_W["uniacid"], "name" => $plugin["name"], "status" => 0, "config" => '', "createtime" => TIMESTAMP, "updatetime" => TIMESTAMP));
                    if (!empty($result)) {
                        $buyid = pdo_insertid();
                        array_push($buyid_list, $buyid);
                    }
                } else {
                    array_push($buyid_list, $modules["id"]);
                }
                array_push($buyname_list, $plugin["name"]);
                $model = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin["name"], "uniacid" => $_W["uniacid"], "deltime" => 0));
                $model["config"] = iunserializer($model["config"]);
                $setconfig[$plugin["name"]] = $model;
            }
        } else {
            $recycle = pdo_get("modules_recycle", array("modulename" => $plugin["name"]), array("id", "modulename"));
            if (empty($recycle)) {
                if (strpos($auth_plugin_list, $plugin["name"]) !== false) {
                    $modules = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin["name"], "uniacid" => $_W["uniacid"], "deltime" => 0));
                    if (empty($modules)) {
                        $result = pdo_insert("lywywl_ztb_sys_plugins", array("uniacid" => $_W["uniacid"], "name" => $plugin["name"], "status" => 0, "config" => '', "createtime" => TIMESTAMP, "updatetime" => TIMESTAMP));
                        if (!empty($result)) {
                            $buyid = pdo_insertid();
                            array_push($buyid_list, $buyid);
                        }
                    } else {
                        array_push($buyid_list, $modules["id"]);
                    }
                    array_push($buyname_list, $plugin["name"]);
                    $model = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin["name"], "uniacid" => $_W["uniacid"], "deltime" => 0));
                    $model["config"] = iunserializer($model["config"]);
                    $setconfig[$plugin["name"]] = $model;
                }
            }
        }
    }
    if (!empty($buyid_list)) {
        pdo_query("UPDATE " . ztbTable("sys_plugins") . " SET deltime = :deltime WHERE uniacid = :uniacid and id NOT IN (" . implode(",", $buyid_list) . ")", array(":deltime" => TIMESTAMP, ":uniacid" => $_W["uniacid"]));
    }
    if (count($buyname_list) <= 0) {
        header("Location: " . $this->createWebUrl("plugins_market"));
        exit;
    }
    if (in_array("lywywl_ztb_plugin_storeinvite", $buyname_list) && empty($setconfig["lywywl_ztb_plugin_storeinvite"]["config"])) {
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["or_open_rebate2"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["is_show_share"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["is_show_promoter"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["is_show_team"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["is_show_ranking"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["is_show_draw"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["is_show_refund"] = "1";
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["invite_qr_types"] = "0";
    }
    if (is_null($setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["new_store_invite"]) || $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["new_store_invite"] == '') {
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["new_store_invite"] = "1";
    }
    if (in_array("lywywl_ztb_plugin_storeinvite", $buyname_list) && empty($setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["invite_binding_types"])) {
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["invite_binding_types"] = "0";
    }
    if (!empty($setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["qr_content"])) {
        $setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["qr_content"] = json_decode(htmlspecialchars_decode($setconfig["lywywl_ztb_plugin_storeinvite"]["config"]["qr_content"]), true);
    }
    if (in_array("lywywl_ztb_plugin_appad", $buyname_list) && empty($setconfig["lywywl_ztb_plugin_appad"]["config"])) {
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_9box"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_bag"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_eggs"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_fish"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_opencard"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_poker"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_praise"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_scratch"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_shake"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_share"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_soliciting"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_tiger"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_union"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_wheel"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_cut"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_collage"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_ladder"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_vote"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_survey"] = "1";
        $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_enroll"] = "1";
        if (in_array("lywywl_ztb_plugin_wholegroup", $buyname_list)) {
            $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_whole"] = "1";
        }
        if (in_array("lywywl_ztb_plugin_10second", $buyname_list)) {
            $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_10second"] = "1";
        }
        if (in_array("lywywl_ztb_plugin_laddercm", $buyname_list)) {
            $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_laddercm"] = "1";
        }
        if (in_array("lywywl_ztb_plugin_voice", $buyname_list)) {
            $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_voice"] = "1";
        }
        if (in_array("lywywl_ztb_plugin_laddergg", $buyname_list)) {
            $setconfig["lywywl_ztb_plugin_appad"]["config"]["is_open_laddergg"] = "1";
        }
    }
    if (in_array("lywywl_ztb_plugin_home", $buyname_list) && empty($setconfig["lywywl_ztb_plugin_home"]["config"])) {
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_user"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_nav"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_rec"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_attr"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_slide"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_user_draw"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_user_score"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_user_money"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_user_product"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_user_card"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["activity_show_types"] = "0";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_activity"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_nearby"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_store"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_join"] = "1";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_activity_name"] = "首页";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_activity_icon"] = MODULE_URL . "resource/template/pluginhome/home.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_activity_onicon"] = MODULE_URL . "resource/template/pluginhome/homeOn.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_nearby_name"] = "周边";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_nearby_icon"] = MODULE_URL . "resource/template/pluginhome/nearby.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_nearby_onicon"] = MODULE_URL . "resource/template/pluginhome/nearbyOn.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_store_name"] = "商家";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_store_icon"] = MODULE_URL . "resource/template/pluginhome/store.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_store_onicon"] = MODULE_URL . "resource/template/pluginhome/storeOn.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_join_name"] = "我的";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_join_icon"] = MODULE_URL . "resource/template/pluginhome/join.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["footer_join_onicon"] = MODULE_URL . "resource/template/pluginhome/joinOn.png";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["is_show_ads"] = "0";
        $setconfig["lywywl_ztb_plugin_home"]["config"]["show_ads_time"] = "10";
    }
    if (in_array("lywywl_ztb_plugin_vaptcha", $buyname_list) && empty($setconfig["lywywl_ztb_plugin_vaptcha"]["config"])) {
        $setconfig["lywywl_ztb_plugin_vaptcha"]["config"]["is_vaptcha_share"] = "1";
        $setconfig["lywywl_ztb_plugin_vaptcha"]["config"]["is_vaptcha_vote"] = "1";
    }
    if (in_array("lywywl_ztb_plugin_shareborrow", $buyname_list)) {
          $setconfig["lywywl_ztb_plugin_shareborrow"]["status"] = $setconfig["lywywl_ztb_plugin_shareborrow"]["status"];
    }
    include $this->template("web/plugins_config/index");
    exit;
}
header("Content-Type: application/json; charset=utf-8");
$id = intval($_GPC["id"]);
$plugin = trim($_GPC["plugin"]);
$model = $_GPC["model"];
$oldModel = pdo_get("lywywl_ztb_sys_plugins", array("id" => $id, "name" => $plugin, "uniacid" => $_W["uniacid"], "deltime" => 0));
if (empty($oldModel)) {
    exit(json_encode(array("status" => 0, "msg" => "对不起,配置的信息不存在！"), JSON_UNESCAPED_UNICODE));
}
if (!empty($model["config"])) {
    $model["config"] = iserializer($model["config"]);
}
$result = pdo_update("lywywl_ztb_sys_plugins", $model, array("id" => $id));
cache_delete("lywywl_ztb_plugin_cache_" . $_W["uniacid"] . "_" . $plugin);
cache_delete("lywywl_ztb_plugin_config_" . $_W["uniacid"] . "_" . $plugin);
exit(json_encode(array("status" => 1, "msg" => "恭喜您,表单填写信息编辑成功！"), JSON_UNESCAPED_UNICODE));