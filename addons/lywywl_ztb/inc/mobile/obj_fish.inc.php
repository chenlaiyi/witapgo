<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
include_once MODULE_ROOT . "/inc/function/app.tpl.func.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "join", "share", "apply", "store", "extWinner", "winner", "writeOff");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 5;
$token = $_GPC["token"];
$origin_id = intval($_GPC["origin_id"]);
if (getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_shareborrow")) {
    if ($config["is_share_borrow"] == 1 && !empty($config["share_borrow_uniacid"][$activityTables[$activity_types]])) {
        $account_api = WeAccount::createByUniacid($config["share_borrow_uniacid"][$activityTables[$activity_types]]);
        $_W["account"]["jssdkconfig"] = $account_api->getJssdkConfig();
    }
}
$plug_appad = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_appad");
if ($plug_appad) {
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_fish");
}
if (empty($token)) {
    tip_redirect("活动标识错误，请从正常渠道进入活动！");
}
$activity = pdo_get(ztbNopreTable("obj_activity"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "token" => $token));
if (empty($activity)) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动不存在！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("对不起，您参与的活动不存在！");
    }
}
if (intval($activity["status"]) != 1) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动已被下架！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("对不起，您参与的活动已被下架！");
    }
}
if (getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_laddercm")) {
    if ($activity["is_join"] > 0) {
        checkIsjoin($openid, $store_id, $activity["is_join"]);
    }
}
if (getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_laddergg")) {
    if ($activity["is_join"] > 0) {
        checkIsjoin($openid, $store_id, $activity["is_join"]);
    }
}
if (intval($activity["check_status"]) != 2) {
    $is_preview_act = false;
    $is_examine_act = false;
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    if ($storeAccount["openid"] == $openid) {
        $is_preview_act = true;
    } else {
        $store_config = iunserializer($storeAccount["config"]);
        if (stripos($store_config["preview_openid"], $openid) !== false) {
            $is_preview_act = true;
        }
    }
    if ($config["check_notify_openid"] == $openid) {
        $is_preview_act = true;
        $is_examine_act = true;
    }
    if ($is_preview_act == false) {
        if ($_W["isajax"]) {
            exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动未审核通过！"), JSON_UNESCAPED_UNICODE));
        } else {
            tip_redirect("对不起，您参与的活动未审核通过！");
        }
    }
    if ($act == "index" && $is_examine_act == true) {
        include $this->template("other/examine/index");
    }
}
$object = pdo_get(ztbNopreTable("obj_fish"), array("deltime" => 0, "activity_id" => $activity["id"]));
$tmp = pdo_get(ztbNopreTable("sys_tmp"), array("deltime" => 0, "id" => $activity["tmp_id"]));
if ($plug_appad && $plug_appad_act == 1 && $object["is_open_appad"] == 1) {
    $object["appad_types"] = explode(",", $object["appad_types"]);
}
if (!empty($origin_id)) {
    $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $activity["id"], "uniacid" => $_W["uniacid"]));
    if (empty($originModel)) {
        tip_redirect("对不起,您访问的活动链接不合法！");
    }
    $is_marketing_Model = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "status" => 1, "openid" => $openid));
    if (!empty($is_marketing_Model)) {
        $originModel = $is_marketing_Model;
        $origin_id = $is_marketing_Model["id"];
        $origin_name = $is_marketing_Model["name"];
    }
} else {
    $originModel = pdo_get("lywywl_ztb_marketing_user", array("deltime" => 0, "uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_id" => $activity["id"], "status" => 1, "openid" => $openid));
    if (!empty($originModel)) {
        $origin_id = $originModel["id"];
        $origin_name = $originModel["name"];
    }
}
$user_nick_name = $userinfo["nickname"];
if (!empty($config["user_black_key"])) {
    $user_blacj_key_array = preg_split("/,/", $config["user_black_key"]);
    foreach ($user_blacj_key_array as $key => $values) {
        if (strpos($user_nick_name, $values) !== false) {
            if ($config["user_black_type"] == 1) {
                if (!empty($config["user_black_to_url"])) {
                    header("Location: " . $config["user_black_to_url"]);
                    exit;
                } else {
                    tip_redirect("对不起，转跳的链接不存在！");
                }
            } else {
                tip_redirect("对不起，您参与的活动已经被下架！");
            }
        }
    }
}
if ($act == "index") {
    jumpDieDomain($config, $_W["siteurl"], $user["id"], $activity["id"], $user["id"]);
    if ($config["is_incoming_road"] == 1) {
        if (getCache($token . "_" . $user["id"], 30) == "ztb") {
            isetcookie("road", "ztb", 3600 * 24 * 365);
        } else {
            if (empty($_GPC["road"]) || $_GPC["road"] != "ztb") {
                tip_redirect("活动链接生成错误，请重新向邀请者获取！");
            }
        }
    }
    if (!empty($_GET["join_id"])) {
        $join_id = $_GET["join_id"];
        isetcookie("join_id_fish_" . $object["id"], $_GET["join_id"], 3600 * 24);
    } else {
        $join_id = $_GPC["join_id_fish_" . $object["id"]];
    }
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_fish_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_fish_" . $object["id"], "ad", 3600 * 24);
        } else {
            $object["is_show_ads"] = 0;
        }
    }
    if ($object["effect_id"] > 0) {
        $effect = pdo_get(ztbNopreTable("sys_effect"), array("deltime" => 0, "status" => 1, "id" => $object["effect_id"]));
        $effectList = explode(",", $effect["pic_url"]);
        foreach ($effectList as $key => $value) {
            if (strpos($value, "resource/template/effect") === false) {
                $effectList[$key] = tomedia($value);
            } else {
                $effectList[$key] = $_W["siteroot"] . $value;
            }
        }
        $effect["pic_url"] = implode(",", $effectList);
    }
    if ($activity["end_time"] < TIMESTAMP) {
        if (empty($object["winer_code"])) {
            $total = pdo_fetchcolumn("SELECT COUNT(distinct openid) FROM " . ztbTable("obj_fish_code") . "where `uniacid`=:uniacid and `activity_id`=:activity_id and deltime=0", array(":activity_id" => $activity["id"], ":uniacid" => $_W["uniacid"]));
            if ($total > 0) {
                $winer_count = $object["winer_num"];
                if ($total < intval($object["winer_num"])) {
                    $winer_count = $total;
                }
                $winer_code = '';
                $winer_code_arr = array();
                while (true) {
                    $result = pdo_fetch("SELECT * FROM " . ztbTable("obj_fish_code") . " WHERE  activity_id=:activity_id and uniacid=:uniacid and deltime=0  ORDER BY RAND() LIMIT 1  ", array(":activity_id" => $activity["id"], ":uniacid" => $_W["uniacid"]));
                    if (!empty($result)) {
                        $isin = false;
                        foreach ($winer_code_arr as $wincode) {
                            if ($wincode["openid"] == $result["openid"]) {
                                $isin = true;
                            }
                        }
                        if (!$isin) {
                            $winer_code_arr[] = $result;
                        }
                        if (count($winer_code_arr) >= $winer_count) {
                            break;
                        }
                    }
                }
                $storeWinnerInfo = array();
                foreach ($winer_code_arr as $key => $code) {
                    $joinModel = pdo_get("lywywl_ztb_obj_fish_join", array("openid" => $code["openid"], "uniacid" => $uniacid, "deltime" => 0, "activity_id" => $activity["id"]));
                    $winer_code = $winer_code . "," . $code["writecode"];
                    $storeWinnerInfo[$key]["openid"] = $code["openid"];
                    $storeWinnerInfo[$key]["nickname"] = $code["nickname"];
                    $storeWinnerInfo[$key]["headurl"] = $code["headurl"];
                    $storeWinnerInfo[$key]["writecode"] = $code["writecode"];
                    $storeWinnerInfo[$key]["register_data"] = $joinModel["register_data"];
                    $storeWinnerInfo[$key]["writeoff_status"] = 0;
                    $storeWinnerInfo[$key]["writeoff_time"] = TIMESTAMP;
                }
                if (!empty($winer_code)) {
                    $winer_code = trim($winer_code, ",");
                }
                $object["winer_code"] = $winer_code;
                pdo_update(ztbTable("obj_fish", false), array("winer_code =" => $winer_code), array("id" => $object["id"]));
                pdo_update("lywywl_ztb_obj_fish_store", array("writeoff_content" => iserializer($storeWinnerInfo)), array("activity_id" => $activity["id"], "uniacid" => $uniacid));
                if ($object["is_sms_send"] == 0 && $object["is_sms"] == 1) {
                    foreach ($winer_code_arr as $code) {
                        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "store_id" => $activity["store_id"]));
                        if ($storeModel["sms"] > 0 && !empty($object["sms_tmp"])) {
                            $userModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "openid" => $openid));
                            $sms_uid = $config["sms_uid"];
                            $sms_key = $config["sms_key"];
                            $mobile = $userModel["mobile"];
                            $sms_content = $object["sms_tmp"];
                            $sms_content = str_replace("{NICKNAME}", $code["nickname"], $sms_content);
                            $sms_content = str_replace("{PRIZE}", "锦鲤", $sms_content);
                            $sms_content = str_replace("{WRITEOFFCODE}", $code["writecode"], $sms_content);
                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                            if (empty($storeModel["zucp_ext"])) {
                                $sms_content .= "【{$config["name"]}】";
                            } else {
                                $sms_content .= "【{$storeModel["name"]}】";
                            }
                            $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                            if ($result === true) {
                                pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $activity["store_id"]));
                                pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $activity["store_id"], "mobile" => $mobile, "reason" => "购买通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                            }
                        }
                    }
                    pdo_update(ztbTable("obj_fish", false), array("is_sms_send" => 1), array("id" => $object["id"]));
                }
            }
        }
        $show_winner_code = explode(",", $object["winer_code"]);
    }
    $registerFields = unserialize($object["register_field"]);
    foreach ($registerFields as &$item) {
        if ($item["Type"] == "radio" || $item["Type"] == "checkbox" || $item["Type"] == "select") {
            if (!empty($item["Tips"])) {
                $arrTip = explode(",", $item["Tips"]);
                foreach ($arrTip as $dic) {
                    $item["items"][] = array("key" => $dic, "value" => $dic);
                }
            }
        }
    }
    unset($item);
    $joinUserList = pdo_fetchall("SELECT nickname,headurl FROM " . ztbTable("obj_fish_join") . "where `uniacid`=:uniacid and store_id=:store_id and activity_id=:activity_id and deltime=0  order by id desc LIMIT 14 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    if (count($joinUserList) < 14 && intval($activity["bogus_join_num"]) > 0) {
        $bogusCount = 14 - count($joinUserList);
        if (14 > count($joinUserList) + intval($activity["bogus_join_num"])) {
            $bogusCount = intval($activity["bogus_join_num"]);
        }
        $userList = pdo_fetchall("SELECT nickname,avatar FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 29");
        foreach ($userList as $user) {
            $is_insert = true;
            foreach ($joinUserList as $joinUser) {
                if ($joinUser["nickname"] == $user["nickname"] && $user["nickname"] == $userinfo["nickname"]) {
                    $is_insert = false;
                }
            }
            if ($is_insert) {
                $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"]);
                array_push($joinUserList, $insertUser);
                $bogusCount = $bogusCount - 1;
                if ($bogusCount <= 0) {
                    break;
                }
            }
        }
    }
    foreach ($joinUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $userWritecodeList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_fish_code") . "where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `openid`=:openid and `deltime`=0 order by id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], ":openid" => $openid));
    $joinWriteCodeList = array();
    $shareWriteCodeList = array();
    $iswiner = false;
    foreach ($userWritecodeList as $item) {
        if ($item["is_share"] == 0) {
            $joinWriteCodeList[] = $item;
        } else {
            $shareWriteCodeList[] = $item;
        }
        if ($activity["end_time"] < TIMESTAMP) {
            if (strpos($object["winer_code"], $item["writecode"]) !== false) {
                $iswiner = true;
            }
        }
    }
    $industryList = pdo_fetchall("SELECT * FROM " . ztbTable("sys_industry") . " where status=1 and deltime=0 order by sort asc ", array());
    $storeList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_fish_store") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and status=1 and auditing=1 and deltime=0 order by sort asc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    foreach ($industryList as $index => $item) {
        $isexist = true;
        foreach ($storeList as $store) {
            if ($item["id"] == $store["industry_id"]) {
                $industryList[$index]["storelist"][] = $store;
                $isexist = false;
            }
        }
        if ($isexist) {
            $industryList[$index]["storelist"] = array();
        }
    }
    foreach ($storeList as $store) {
        if (strpos($store["openid"], $openid) !== false) {
            $storeWriteoffModel = $store;
        }
    }
    $totalMoney = 0;
    foreach ($storeList as $store) {
        $totalMoney += $store["money"];
    }
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_model = pdo_get("lywywl_ztb_obj_fish_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($join_model) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    pdo_update(ztbTable("obj_activity", false), array("click_num +=" => 1), array("id" => $activity["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("click_num +=" => 1), array("id" => $origin_id));
    }
    if (!empty($object["audio_url"]) && strpos($object["audio_url"], "/addons/lywywl_ztb/") !== false) {
        $object["audio_url"] = substr($object["audio_url"], strpos($object["audio_url"], "/addons/lywywl_ztb/"));
    }
    $checkInUrl = $this->createMobileUrl("store.login");
    if (getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_storeinvite")) {
        if (getPluginConfig($uniacid, "lywywl_ztb_plugin_storeinvite", "invite_binding_types") == 1) {
            if (!empty($origin_id)) {
                $promoter = pdo_get(ztbNopreTable("store_promoter"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $originModel["store_id"], "openid" => $originModel["openid"]));
                if (!empty($promoter)) {
                    $checkInUrl = $this->createMobileUrl("store.login", array("invite_sid" => $store_id, "invite_pid" => $promoter["id"]));
                } else {
                    $checkInUrl = $this->createMobileUrl("store.login", array("invite_sid" => $store_id));
                }
            } else {
                $checkInUrl = $this->createMobileUrl("store.login", array("invite_sid" => $store_id));
            }
        }
    }
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $is_marketing = false;
    $userTeamModel = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "status" => 1, "openid" => $openid));
    if (!empty($userTeamModel)) {
        $is_marketing = true;
    }
    include $this->template("tmp/" . $tmp["resource"] . "/index");
    exit;
}
if ($act == "join" && $request_method == "post") {
    $join_id = $_GPC["join_id"];
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["area_limit"]) {
        $areaArr = explode(",", $object["area_limit"]);
        $longitude = $_GPC["longitude"];
        $latitude = $_GPC["latitude"];
        if (empty($longitude) || empty($latitude)) {
            exit(json_encode(array("status" => 0, "tip" => "area", "msg" => "亲，请同意授权获取地理位置后，再参与活动！"), JSON_UNESCAPED_UNICODE));
        }
        $content = getCityNameByLongitudeAndLatitude($longitude, $latitude);
        $is_in_area = false;
        foreach ($areaArr as $area) {
            if (strpos($content, $area) !== false) {
                $is_in_area = true;
            }
        }
        if ($is_in_area === false) {
            exit(json_encode(array("status" => 0, "msg" => "亲，您所在的区域不在本次活动范围！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $registerFields = unserialize($object["register_field"]);
    foreach ($registerFields as &$item) {
        if ($item["Type"] == "checkbox") {
            $item["Value"] = implode(",", $_GPC[$item["Name"]]);
        } else {
            $item["Value"] = $_GPC[$item["Name"]];
        }
        if ($item["Name"] == "Mobile" && $object["is_register"] != 0) {
            if ($item["IsSmsCk"] == 1) {
                $ckResult = smsCkMobile($_GPC[$item["Name"]], $_GPC[$item["Name"] . "_Code"], $token, $openid);
                if ($ckResult !== true) {
                    return $ckResult;
                }
            }
            pdo_update(ztbTable("user_account", false), array("mobile" => $_GPC[$item["Name"]]), array("openid" => $openid, "store_id" => $store_id));
        }
    }
    unset($item);
    $join_model = pdo_get("lywywl_ztb_obj_fish_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($join_model) {
        exit(json_encode(array("status" => 0, "msg" => "亲，请不要重复参与活动！"), JSON_UNESCAPED_UNICODE));
    }
    if (!empty($join_id)) {
        $shareModel = pdo_get("lywywl_ztb_obj_fish_join", array("uniacid" => $uniacid, "store_id" => $store_id, "id" => $join_id, "deltime" => 0));
        if (empty($shareModel)) {
            exit(json_encode(array("status" => 0, "msg" => "对不起,请核对邀请人信息！"), JSON_UNESCAPED_UNICODE));
        }
        $shareWritecodeCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_fish_code") . "where `uniacid`=:uniacid and store_id=:store_id and activity_id=:activity_id and openid=:openid and is_share=1 and deltime=0 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], "openid" => $shareModel["openid"]));
        if ($shareWritecodeCount < intval($object["max_invite"])) {
            $insert_share_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $shareModel["openid"], "nickname" => $shareModel["nickname"], "headurl" => $shareModel["headurl"], "is_share" => 1, "writecode" => '', "share_openid" => $openid, "share_nickname" => $userinfo["nickname"], "share_headurl" => $userinfo["headimgurl"], "createtime" => TIMESTAMP);
            $result = pdo_insert("lywywl_ztb_obj_fish_code", $insert_share_model);
            if (empty($result)) {
                exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
            }
            $inid = pdo_insertid();
            $hashids = Hashids::instance(6, "lywyztb", '');
            $encode_id = $hashids->encode($inid);
            pdo_update(ztbTable("obj_fish_code", false), array("writecode" => $encode_id), array("id" => $inid));
            if (!empty($origin_id)) {
                pdo_update(ztbNopreTable("marketing_user"), array("fish_code_num +=" => 1), array("id" => $origin_id));
            }
        }
    }
    $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "register_data" => serialize($registerFields), "share_openid" => $shareModel["openid"], "share_nickname" => $shareModel["nickname"], "share_headurl" => $shareModel["headurl"], "createtime" => TIMESTAMP);
    $result = pdo_insert("lywywl_ztb_obj_fish_join", $insert_join_model);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $insert_code_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "is_share" => 0, "writecode" => '', "share_openid" => $shareModel["openid"], "share_nickname" => $shareModel["nickname"], "share_headurl" => $shareModel["headurl"], "createtime" => TIMESTAMP);
    $result = pdo_insert("lywywl_ztb_obj_fish_code", $insert_code_model);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $inid = pdo_insertid();
    $hashids = Hashids::instance(6, "lywyztb", '');
    $encode_id = $hashids->encode($inid);
    pdo_update(ztbTable("obj_fish_code", false), array("writecode" => $encode_id), array("id" => $inid));
    pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $activity["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1, "fish_code_num +=" => 1), array("id" => $origin_id));
    }
    if (intval($object["max_invite"]) <= 0) {
        exit(json_encode(array("status" => 1, "msg" => "参与成功，快邀请好友一起参与吧！"), JSON_UNESCAPED_UNICODE));
    } else {
        exit(json_encode(array("status" => 1, "msg" => "参与成功，邀请好友参与可额外获取抽奖码！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "share" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get("lywywl_ztb_obj_fish_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if (empty($join_model)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，请参与活动后在分享赢取抽奖码！"), JSON_UNESCAPED_UNICODE));
    }
    if (!empty($originModel)) {
        if ($originModel["openid"] == $openid) {
            $join_model["qrcode_url"] = '';
        }
    }
    if (empty($join_model["qrcode_url"])) {
        load()->func("file");
        $qr_content = json_decode(htmlspecialchars_decode($object["qr_content"]), true);
        $isroot = 1;
        if (!empty($_W["setting"]["remote"]["type"])) {
            $isroot = 0;
        }
        if ($isroot == 1) {
            $file_path = MODULE_URL . "/resource/data/qrcode/{$activity["id"]}/join/{$openid}.jpg";
            $outpath = MODULE_ROOT . "/resource/data/qrcode/{$activity["id"]}/join/";
        } else {
            $file_path = "lywywl_ztb/{$activity["id"]}/join/{$openid}.jpg";
            $file_path = tomedia($file_path);
            $outpath = ATTACHMENT_ROOT . "lywywl_ztb/{$activity["id"]}/join/";
        }
        mkdirs($outpath);
        $filename = "{$openid}.jpg";
        $outfile = $outpath . $filename;
        $qrcode_size = $config["qrcode_size"];
        if (empty($qrcode_size)) {
            $qrcode_size = 5;
        }
        $qrcode_level = $config["qrcode_level"];
        if (empty($qrcode_level)) {
            $qrcode_level = "L";
        }
        $scanurl = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
        $scanurl = replaceDieDomain($config, $scanurl, $user["id"], $activity["id"], $user["id"]);
        $qr = poster($isroot, $scanurl, $outfile, $qrcode_level, $qrcode_size, 2, false, $object["qr_url"], $qr_content, $userinfo);
        if ($qr !== false) {
            pdo_update(ztbTable("obj_fish_join", false), array("qrcode_url" => $file_path), array("id" => $join_model["id"]));
            exit(json_encode(array("status" => 1, "msg" => "恭喜您,专属海报创建成功！", "path" => $file_path), JSON_UNESCAPED_UNICODE));
        } else {
            exit(json_encode(array("status" => 0, "msg" => "二维码生成失败，请稍后重试！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        exit(json_encode(array("status" => 1, "msg" => "恭喜您，专属海报创建成功！", "path" => $join_model["qrcode_url"]), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "apply" && $request_method == "get") {
    $industrySql = "SELECT * FROM " . ztbTable("sys_industry") . " where `status`=1 and `deltime`=0 order by sort asc , id asc ";
    $industryList = pdo_fetchall($industrySql);
    include $this->template("tmp/" . $tmp["resource"] . "/apply");
    exit;
}
if ($act == "apply" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $store = $_GPC["store"];
    if ($activity["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["name"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入您的门店名称！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["tel"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入门店联系电话！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["money"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入提供奖品金额！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["prize"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入提供奖品内容！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($_GPC["logo_url"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入门店LOGO图片！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["content"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入商家简介！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($_GPC["banner_url"])) {
        exit(json_encode(array("status" => 2, "msg" => "请上传商家门店外拍图片！"), JSON_UNESCAPED_UNICODE));
    }
    $store["banner_url"] = implode(",", $_GPC["banner_url"]);
    if (!empty($store["store_map_list"])) {
        if (is_array($store["store_map_list"]) || is_object($store["store_map_list"])) {
            foreach ($store["store_map_list"] as $value) {
                if (empty($value["name"])) {
                    exit(json_encode(array("status" => 2, "msg" => "请填写活动门店名称！"), JSON_UNESCAPED_UNICODE));
                }
                if (empty($value["lng"])) {
                    exit(json_encode(array("status" => 2, "msg" => "请选择门店地理经度！"), JSON_UNESCAPED_UNICODE));
                }
                if (empty($value["lat"])) {
                    exit(json_encode(array("status" => 2, "msg" => "请选择门店地理纬度！"), JSON_UNESCAPED_UNICODE));
                }
                if (empty($value["address"])) {
                    exit(json_encode(array("status" => 2, "msg" => "请填写商家门店地址！"), JSON_UNESCAPED_UNICODE));
                }
                if (empty($value["tel"])) {
                    exit(json_encode(array("status" => 2, "msg" => "请填写商家联系电话！"), JSON_UNESCAPED_UNICODE));
                }
            }
            $store["store_map_list"] = iserializer($store["store_map_list"]);
        }
    }
    $model = pdo_get("lywywl_ztb_obj_fish_store", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($model) {
        exit(json_encode(array("status" => 0, "msg" => "您已提交申请，请勿重复操作！"), JSON_UNESCAPED_UNICODE));
    }
    $store["uniacid"] = $uniacid;
    $store["store_id"] = $store_id;
    $store["activity_types"] = $activity_types;
    $store["activity_id"] = $activity["id"];
    $store["logo_url"] = $_GPC["logo_url"];
    $store["openid"] = $openid;
    $store["sort"] = 4000;
    $store["status"] = 0;
    $store["auditing"] = 0;
    $store["updatetime"] = TIMESTAMP;
    $store["createtime"] = TIMESTAMP;
    $result = pdo_insert("lywywl_ztb_obj_fish_store", $store);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因提交失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id, "deltime" => 0));
    if ($config["objstorepushtmp"] && $storeModel["openid"]) {
        if (isFollow($storeModel["openid"], $uniacid)) {
            $postdata = array("first" => array("value" => "{$activity["title"]}，您的活动有新的商家申请入驻，请及时处理。", "color" => "#173177"), "keyword1" => array("value" => date("Y-m-d H:i", TIMESTAMP), "color" => "#173177"), "keyword2" => array("value" => "入驻商家名称：{$store["name"]}，联系电话：{$store["tel"]}", "color" => "#173177"), "remark" => array("value" => "点击查看入驻商家详情", "color" => "#173177"));
            $url = replaceDieDomain($config, __MURL("store.obj_fish_store_wait", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
            $template_id = $config["objstorepushtmp"];
            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
        }
    }
    if ($config["objstorepushtmp_sub"] && $storeModel["openid"]) {
        $touser = $storeModel["openid"];
        $template_id = $config["objstorepushtmp_sub"];
        $postdata = array("thing3" => array("value" => $store["name"]), "time2" => array("value" => date("Y-m-d H:i", TIMESTAMP)), "phone_number4" => array("value" => $store["tel"]), "thing5" => array("value" => "入驻活动：{$activity["title"]}"));
        $url = replaceDieDomain($config, __MURL("store.obj_fish_store_wait", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
    }
    exit(json_encode(array("status" => 1, "msg" => "提交成功，请耐心等待审核！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "store") {
    $fish_store_id = $_GPC["fish_store_id"];
    $store = pdo_get("lywywl_ztb_obj_fish_store", array("activity_id" => $activity["id"], "id" => $fish_store_id, "status" => 1, "auditing" => 1, "deltime" => 0, "uniacid" => $_W["uniacid"]));
    if (!$store) {
        exit("对不起，您查看的店铺不存在或已被删除！");
    }
    $store_map_list = unserialize($store["store_map_list"]);
    if (!empty($store_map_list) && is_array($store_map_list)) {
        foreach ($store_map_list as $key => $value) {
            $map_lat_lng = Convert_BD09_To_GCJ02($value["lat"], $value["lng"]);
            $store_map_list[$key]["lat"] = $map_lat_lng["lat"];
            $store_map_list[$key]["lng"] = $map_lat_lng["lng"];
        }
    }
    $store["banner_url"] = explode(",", $store["banner_url"]);
    $join_model = pdo_get("lywywl_ztb_obj_fish_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    if (empty($join_model)) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/store");
    exit;
}
if ($act == "extWinner" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，活动未结束请耐心等待开奖！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($object["winer_code"])) {
        $total = pdo_fetchcolumn("SELECT COUNT(distinct openid) FROM " . ztbTable("obj_fish_code") . "where `uniacid`=:uniacid and `activity_id`=:activity_id and deltime=0", array(":activity_id" => $activity["id"], ":uniacid" => $_W["uniacid"]));
        if ($total > 0) {
            $winer_count = $object["winer_num"];
            if ($total < intval($object["winer_num"])) {
                $winer_count = $total;
            }
            $winer_code = '';
            $winer_code_arr = array();
            while (true) {
                $result = pdo_fetch("SELECT * FROM " . ztbTable("obj_fish_code") . " WHERE activity_id=:activity_id and uniacid=:uniacid and deltime=0  ORDER BY RAND() LIMIT 1 ", array(":activity_id" => $activity["id"], ":uniacid" => $_W["uniacid"]));
                if (!empty($result)) {
                    $isin = false;
                    foreach ($winer_code_arr as $wincode) {
                        if ($wincode["openid"] == $result["openid"]) {
                            $isin = true;
                        }
                    }
                    if (!$isin) {
                        $winer_code_arr[] = $result;
                    }
                    if (count($winer_code_arr) >= $winer_count) {
                        break;
                    }
                }
            }
            $storeWinnerInfo = array();
            foreach ($winer_code_arr as $key => $code) {
                $joinModel = pdo_get("lywywl_ztb_obj_fish_join", array("openid" => $code["openid"], "uniacid" => $uniacid, "deltime" => 0, "activity_id" => $activity["id"]));
                $winer_code = $winer_code . "," . $code["writecode"];
                $storeWinnerInfo[$key]["openid"] = $code["openid"];
                $storeWinnerInfo[$key]["nickname"] = $code["nickname"];
                $storeWinnerInfo[$key]["headurl"] = $code["headurl"];
                $storeWinnerInfo[$key]["writecode"] = $code["writecode"];
                $storeWinnerInfo[$key]["register_data"] = $joinModel["register_data"];
                $storeWinnerInfo[$key]["writeoff_status"] = 0;
                $storeWinnerInfo[$key]["writeoff_time"] = TIMESTAMP;
            }
            if (!empty($winer_code)) {
                $winer_code = trim($winer_code, ",");
            }
            $object["winer_code"] = $winer_code;
            pdo_update(ztbTable("obj_fish", false), array("winer_code =" => $winer_code), array("id" => $object["id"]));
            pdo_update("lywywl_ztb_obj_fish_store", array("writeoff_content" => iserializer($storeWinnerInfo)), array("activity_id" => $activity["id"], "uniacid" => $uniacid));
            if ($object["is_sms_send"] == 0 && $object["is_sms"] == 1) {
                foreach ($winer_code_arr as $code) {
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "store_id" => $activity["store_id"]));
                    if ($storeModel["sms"] > 0 && !empty($object["sms_tmp"])) {
                        $userModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "openid" => $openid));
                        $sms_uid = $config["sms_uid"];
                        $sms_key = $config["sms_key"];
                        $mobile = $userModel["mobile"];
                        $sms_content = $object["sms_tmp"];
                        $sms_content = str_replace("{NICKNAME}", $code["nickname"], $sms_content);
                        $sms_content = str_replace("{PRIZE}", "锦鲤", $sms_content);
                        $sms_content = str_replace("{WRITEOFFCODE}", $code["writecode"], $sms_content);
                        $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                        if (empty($storeModel["zucp_ext"])) {
                            $sms_content .= "【{$config["name"]}】";
                        } else {
                            $sms_content .= "【{$storeModel["name"]}】";
                        }
                        $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                        if ($result === true) {
                            pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $activity["store_id"]));
                            pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $activity["store_id"], "mobile" => $mobile, "reason" => "购买通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                        }
                    }
                }
                pdo_update(ztbTable("obj_fish", false), array("is_sms_send" => 1), array("id" => $object["id"]));
            }
        }
    }
    exit(json_encode(array("status" => 1, "writecode" => $object["winer_code"]), JSON_UNESCAPED_UNICODE));
}
if ($act == "winner") {
    if ($activity["end_time"] > TIMESTAMP || empty($object["winer_code"])) {
        tip_redirect("亲，活动未结束请耐心等待开奖！");
    }
    $storeList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_fish_store") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and status=1 and auditing=1 and deltime=0 order by sort asc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    foreach ($storeList as $item) {
        if (strpos($item["openid"], $openid) !== false) {
            $store = $item;
        }
    }
    if (!$store) {
        exit("对不起，您查看的店铺不存在或已被删除！");
    }
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    include $this->template("other/fish_writeoff/index");
    exit;
}
if ($act == "writeOff" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $fish_store_id = $_GPC["fish_store_id"];
    $index_id = $_GPC["index_id"];
    if ($activity["end_time"] > TIMESTAMP || empty($object["winer_code"])) {
        exit(json_encode(array("status" => 0, "msg" => "亲，请在活动结束后核销用户奖品！"), JSON_UNESCAPED_UNICODE));
    }
    $store = pdo_get("lywywl_ztb_obj_fish_store", array("activity_id" => $activity["id"], "id" => $fish_store_id, "status" => 1, "auditing" => 1, "deltime" => 0, "uniacid" => $_W["uniacid"]));
    if (empty($store)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您要核销的店铺不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if (strpos($store["openid"], $openid) === false) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您没有权限核销店铺奖品！"), JSON_UNESCAPED_UNICODE));
    }
    $writeoff_content = iunserializer($store["writeoff_content"]);
    $writeoff_content[$index_id]["writeoff_status"] = 1;
    $writeoff_content[$index_id]["writeoff_time"] = TIMESTAMP;
    pdo_update(ztbTable("obj_fish_store", false), array("writeoff_content" => iserializer($writeoff_content)), array("id" => $fish_store_id));
    exit(json_encode(array("status" => 1, "writeofftime" => date("Y-m-d H:i:s", TIMESTAMP)), JSON_UNESCAPED_UNICODE));
}