<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "join", "share", "click", "draw", "register");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 4;
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
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_praise");
}
if (empty($token)) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "活动标识错误，请从正常渠道进入活动！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("活动标识错误，请从正常渠道进入活动！");
    }
}
$model = pdo_get(ztbNopreTable("obj_activity"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "token" => $token));
if (empty($model)) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动不存在！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("对不起，您参与的活动不存在！");
    }
}
if (intval($model["status"]) != 1) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动已被下架！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("对不起，您参与的活动已被下架！");
    }
}
if (intval($model["check_status"]) != 2) {
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
$model2 = pdo_get(ztbNopreTable("obj_praise"), array("deltime" => 0, "activity_id" => $model["id"]));
unset($model2["id"]);
$object = array_merge($model, $model2);
if ($plug_appad && $plug_appad_act == 1 && $object["is_open_appad"] == 1) {
    $object["appad_types"] = explode(",", $object["appad_types"]);
}
$tmp = pdo_get(ztbNopreTable("sys_tmp"), array("deltime" => 0, "id" => $object["tmp_id"]));
if (!empty($origin_id)) {
    $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $object["id"], "uniacid" => $_W["uniacid"]));
    if (empty($originModel)) {
        tip_redirect("对不起,您访问的活动链接不合法！");
    }
    $is_marketing_Model = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $object["id"], "status" => 1, "openid" => $openid));
    if (!empty($is_marketing_Model)) {
        $originModel = $is_marketing_Model;
        $origin_id = $is_marketing_Model["id"];
        $origin_name = $is_marketing_Model["name"];
    }
} else {
    $originModel = pdo_get("lywywl_ztb_marketing_user", array("deltime" => 0, "uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_id" => $object["id"], "status" => 1, "openid" => $openid));
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
    jumpDieDomain($config, $_W["siteurl"], $user["id"], $object["id"], $user["id"]);
    if ($config["is_incoming_road"] == 1) {
        if (getCache($token . "_" . $user["id"], 30) == "ztb") {
            isetcookie("road", "ztb", 3600 * 24 * 365);
        } else {
            if (empty($_GPC["road"]) || $_GPC["road"] != "ztb") {
                tip_redirect("活动链接生成错误，请重新向邀请者获取！");
            }
        }
    }
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
    }
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_praise_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_praise_" . $object["id"], "ad", 3600 * 24);
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
    $registerJoinFields = unserialize($object["register_field"]);
    foreach ($registerJoinFields as &$item) {
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
    $isDraw = 0;
    if (!empty($_GET["join_id"])) {
        $join_id = intval($_GET["join_id"]);
        $joinModel = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_id));
        if (empty($joinModel)) {
            tip_redirect("对不起，活动参与信息不存在！");
        }
        $clickUserCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_praise_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel["openid"]));
        if ($clickUserCount >= intval($object["winer_num"])) {
            if ($joinModel["openid"] == $openid) {
                $isDraw = 1;
                $userdrawList = pdo_fetchall("SELECT name FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
                $userDrawCount = count($userdrawList);
                if ($userDrawCount > 0) {
                    $isDraw = 2;
                }
            }
        }
        $clickUserList = pdo_fetchall("SELECT praise_nickname,praise_headurl,createtime FROM " . ztbTable("obj_praise_click") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid  order by id desc LIMIT 14 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel["openid"]));
    }
    $joinUserList = pdo_fetchall("SELECT nickname,headurl FROM " . ztbTable("obj_praise_join") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id order by id desc LIMIT 14 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    if (count($joinUserList) < 14 && intval($object["bogus_join_num"]) > 0) {
        $bogusJoinCount = 14 - count($joinUserList);
        if (14 > count($joinUserList) + intval($object["bogus_join_num"])) {
            $bogusJoinCount = intval($object["bogus_join_num"]);
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
                $bogusJoinCount = $bogusJoinCount - 1;
                if ($bogusJoinCount <= 0) {
                    break;
                }
            }
        }
    }
    foreach ($joinUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $drawUserTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid  and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    $drawUserList = pdo_getall(ztbTable("user_draw", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"]), array("nickname", "headurl", "name", "createtime"), '', "id desc", 20);
    $prizeList = pdo_getall(ztbTable("obj_prize", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1), array(), '', "sort asc");
    if (empty($prizeList)) {
        tip_redirect("对不起， 您参与的活动暂未设置奖品！");
    }
    $prizeNumberTotal = array_sum(array_column($prizeList, "number"));
    $prizeSurplusTotal = array_sum(array_column($prizeList, "surplus"));
    if (count($drawUserList) < 20 && intval($object["bogus_get_num"]) > 0 && count($prizeList) > 0) {
        $bogusDrawCount = 20 - count($drawUserList);
        if (20 > count($drawUserList) + intval($object["bogus_get_num"])) {
            $bogusDrawCount = intval($object["bogus_get_num"]);
        }
        $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 10,41");
        foreach ($prizeList as $value) {
            if ($value["odds"] > 0) {
                $odds[] = $value["odds"];
            } else {
                $odds[] = 1;
            }
        }
        foreach ($userList as $user) {
            $is_insert = true;
            foreach ($drawUserList as $drawUser) {
                if ($drawUser["nickname"] == $user["nickname"] || $user["nickname"] == $userinfo["nickname"]) {
                    $is_insert = false;
                }
            }
            if ($is_insert) {
                $prize = $prizeList[getRand($odds)];
                $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"], "name" => $prize["name"], "createtime" => $model["start_time"]);
                array_push($drawUserList, $insertUser);
                $bogusDrawCount = $bogusDrawCount - 1;
                if ($bogusDrawCount <= 0) {
                    break;
                }
            }
        }
    }
    foreach ($drawUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $topUserList = pdo_getall(ztbTable("obj_praise_join", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"]), array("nickname", "headurl", "praise", "bogus_praise"), '', "praise`+`bogus_praise desc", array(10));
    foreach ($topUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $share_id = 0;
    $join_model = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if ($join_model) {
        $share_id = $join_model["id"];
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        if (empty($object["area_limit"]) && $object["is_register"] <= 0) {
            $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "register_data" => '', "praise" => 0, "createtime" => TIMESTAMP);
            $result = pdo_insert("lywywl_ztb_obj_praise_join", $insert_join_model);
            if (!empty($result)) {
                $share_id = pdo_insertid();
                pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $object["id"]));
                if (!empty($origin_id)) {
                    pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
                }
                $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $share_id), false, TRUE);
            } else {
                $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
            }
        } else {
            $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
        }
    }
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    pdo_update(ztbTable("obj_activity", false), array("click_num +=" => 1), array("id" => $object["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("click_num +=" => 1), array("id" => $origin_id));
    }
    $store_map_list = unserialize($object["store_map_list"]);
    if (!empty($store_map_list) && is_array($store_map_list)) {
        foreach ($store_map_list as $key => $value) {
            $map_lat_lng = Convert_BD09_To_GCJ02($value["lat"], $value["lng"]);
            $store_map_list[$key]["lat"] = $map_lat_lng["lat"];
            $store_map_list[$key]["lng"] = $map_lat_lng["lng"];
        }
    }
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    $userJoinModel = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
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
    $is_marketing = false;
    $userTeamModel = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $object["id"], "status" => 1, "openid" => $openid));
    if (!empty($userTeamModel)) {
        $is_marketing = true;
    }
    include $this->template("tmp/" . $tmp["resource"] . "/index");
    exit;
}
if ($act == "join" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
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
            pdo_update(ztbTable("user_account", false), array("mobile" => $_GPC[$item["Name"]]), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
        }
    }
    unset($item);
    $join_model = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if ($join_model) {
        exit(json_encode(array("status" => 1, "msg" => "参与成功，邀请好友参与可获得奖励哦！"), JSON_UNESCAPED_UNICODE));
    }
    $registerFields = serialize($registerFields);
    $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "register_data" => $registerFields, "praise" => 0, "createtime" => TIMESTAMP);
    $result = pdo_insert(ztbNopreTable("obj_praise_join"), $insert_join_model);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $object["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
    }
    exit(json_encode(array("status" => 1, "msg" => "参与成功，邀请好友参与可获得奖励哦！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "share" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if (empty($join_model)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，请参与活动后查看专属二维码！"), JSON_UNESCAPED_UNICODE));
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
            $file_path = MODULE_URL . "/resource/data/qrcode/{$object["id"]}/join/{$openid}.jpg";
            $outpath = MODULE_ROOT . "/resource/data/qrcode/{$object["id"]}/join/";
        } else {
            $file_path = "lywywl_ztb/{$object["id"]}/join/{$openid}.jpg";
            $file_path = tomedia($file_path);
            $outpath = ATTACHMENT_ROOT . "lywywl_ztb/{$object["id"]}/join/";
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
        $scanurl = __MURL("scan", array("token" => $token, "\$origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
        $scanurl = replaceDieDomain($config, $scanurl, $user["id"], $object["id"], $user["id"]);
        $qr = poster($isroot, $scanurl, $outfile, $qrcode_level, $qrcode_size, 2, false, $object["qr_url"], $qr_content, $userinfo);
        if ($qr !== false) {
            pdo_update(ztbTable("obj_praise_join", false), array("qrcode_url" => $file_path), array("id" => $join_model["id"]));
            exit(json_encode(array("status" => 1, "msg" => "恭喜您,专属海报创建成功！", "path" => $file_path), JSON_UNESCAPED_UNICODE));
        } else {
            exit(json_encode(array("status" => 0, "msg" => "二维码生成失败，请稍后重试！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        exit(json_encode(array("status" => 1, "msg" => "恭喜您，专属海报创建成功！", "path" => $join_model["qrcode_url"]), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "click" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = intval($_POST["join_id"]);
    if (empty($join_id)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，活动参与信息不存在！"), JSON_UNESCAPED_UNICODE));
    }
    $joinModel = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_id));
    if (empty($joinModel)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，活动参与信息不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if ($joinModel["openid"] != $openid) {
        $result = pdo_get(ztbNopreTable("obj_praise_click"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $joinModel["openid"], "praise_openid" => $openid));
        if (!empty($result)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "您已经帮TA点过了，感谢您的支持！"), JSON_UNESCAPED_UNICODE));
        }
        $limit_clicks = intval($object["limit_clicks"]);
        if ($limit_clicks > 0) {
            $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_praise_click") . " where `uniacid`=:uniacid  and `store_id`=:store_id and `deltime`=0 and `activity_id`=:activity_id and `praise_openid`=:praise_openid", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $object["id"], ":praise_openid" => $openid));
            if ($clicks_count >= $limit_clicks) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "本场活动限制每人只能点赞{$limit_clicks}次，感谢您的支持！"), JSON_UNESCAPED_UNICODE));
            }
        }
        $data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $joinModel["openid"], "praise_openid" => $openid, "praise_nickname" => $userinfo["nickname"], "praise_headurl" => $userinfo["headimgurl"], "ip" => $_W["clientip"], "createtime" => TIMESTAMP);
        $result = pdo_insert(ztbNopreTable("obj_praise_click"), $data);
        pdo_update(ztbTable("obj_praise_join", false), array("praise +=" => 1), array("id" => $join_id));
        if (!empty($origin_id)) {
            pdo_update(ztbNopreTable("marketing_user"), array("praise_click_num +=" => 1), array("id" => $origin_id));
        }
        thread_unlock($openid);
        exit(json_encode(array("status" => 1, "msg" => "点赞成功，感谢您的支持！"), JSON_UNESCAPED_UNICODE));
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，请邀请好友帮忙点击！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "draw" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = $_GPC["join_id"];
    $joinModel = pdo_get(ztbNopreTable("obj_praise_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_id));
    if (empty($joinModel)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，活动参与信息不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if ($joinModel["openid"] != $openid) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，活动参与信息错误！"), JSON_UNESCAPED_UNICODE));
    }
    $userDrawCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid  and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userDrawCount > 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "您已经领过奖了，不要重复领取！"), JSON_UNESCAPED_UNICODE));
    }
    $clickUserCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_praise_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel["openid"]));
    if (intval($object["winer_num"]) > $clickUserCount) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动点击人数还没有达到" . $object["winer_num"] . "人，邀请您的好友来点击吧！"), JSON_UNESCAPED_UNICODE));
    }
    $joinUserModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $joinModel["openid"]));
    $prizeList = pdo_getall(ztbTable("obj_prize", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1), array(), '', "sort asc");
    if (empty($prizeList)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动未设置奖品！"), JSON_UNESCAPED_UNICODE));
    }
    $prizeModel = null;
    foreach ($prizeList as $key => $val) {
        if (!(intval($val["odds"]) <= 0)) {
            if (!(intval($val["surplus"]) <= 0)) {
                if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                        $arr[$key] = $val["odds"];
                    } else {
                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE deltime = 0 AND prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                        if (!($count >= intval($val["limitnum"]))) {
                            $arr[$key] = $val["odds"];
                        } else {
                        }
                    }
                } else {
                    $count = pdo_getcolumn(ztbTable("user_draw", false), array("deltime" => 0, "prize_id" => $val["id"], "openid" => $joinUserModel["openid"]), "count(*)");
                    if (!($count >= intval($val["limitnum"]))) {
                        if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                            $arr[$key] = $val["odds"];
                        } else {
                            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE deltime = 0 AND prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                            if (!($count >= intval($val["limitnum"]))) {
                                $arr[$key] = $val["odds"];
                            } else {
                            }
                        }
                    } else {
                    }
                }
            } else {
            }
        } else {
        }
    }
    if (empty($prizeModel)) {
        $rid = getRand($arr);
        $prizeModel = $prizeList[$rid];
    }
    if (!empty($prizeModel)) {
        $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinUserModel["openid"], "nickname" => $joinUserModel["nickname"], "headurl" => $joinUserModel["headurl"], "register_data" => $joinModel["register_data"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
        $result = pdo_insert(ztbTable("user_draw", false), $join_draw_data);
        $writecode = '';
        if (!empty($result)) {
            $draw_id = pdo_insertid();
            $hashids = Hashids::instance(6, "lywyztb", '');
            $encode_id = $hashids->encode($draw_id);
            $join_draw_data = array("writecode" => $encode_id);
            pdo_update(ztbTable("user_draw", false), $join_draw_data, array("id" => $draw_id));
            $writecode = $encode_id;
        }
        if (intval($prizeModel["types"]) == 1) {
            if (intval($prizeModel["create_types"]) == 1) {
                list($min, $max) = explode("-", $prizeModel["score"]);
                $prizeModel["score"] = mt_rand($min, $max);
            }
            $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $object["title"] . "，获得积分：" . $prizeModel["score"] . "个";
            pdo_update(ztbNopreTable("user_account"), array("score +=" => intval($prizeModel["score"])), array("id" => $joinUserModel["id"]));
            $userScoreModel = array();
            $userScoreModel["uniacid"] = $uniacid;
            $userScoreModel["store_id"] = $store_id;
            $userScoreModel["openid"] = $joinUserModel["openid"];
            $userScoreModel["nickname"] = $joinUserModel["nickname"];
            $userScoreModel["headurl"] = $joinUserModel["headurl"];
            $userScoreModel["types"] = 1;
            $userScoreModel["activity_types"] = $activity_types;
            $userScoreModel["detail_id"] = $object["id"];
            $userScoreModel["score"] = $prizeModel["score"];
            $userScoreModel["note"] = $note;
            $userScoreModel["createtime"] = TIMESTAMP;
            pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
            pdo_update(ztbTable("user_draw", false), array("score" => $prizeModel["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
        } else {
            if (intval($prizeModel["types"]) == 2) {
                if (intval($prizeModel["create_types"]) == 1) {
                    list($min, $max) = explode("-", $prizeModel["sys"]);
                    $prizeModel["sys"] = mt_rand($min * 100, $max * 100) / 100;
                }
                $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $object["title"] . "，获得零钱：" . $prizeModel["sys"] . "元";
                if ($storeModel["money"] >= $prizeModel["sys"]) {
                    pdo_update(ztbNopreTable("store_account"), array("money -=" => $prizeModel["sys"]), array("id" => $store_id));
                    $storeBillModel = array();
                    $storeBillModel["uniacid"] = $uniacid;
                    $storeBillModel["store_id"] = $store_id;
                    $storeBillModel["types"] = 11;
                    $storeBillModel["detail_id"] = $draw_id;
                    $storeBillModel["money"] = $prizeModel["sys"];
                    $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                    $storeBillModel["note"] = $note;
                    $storeBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                    pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("id" => $joinUserModel["id"]));
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $joinUserModel["openid"];
                    $userBillModel["nickname"] = $joinUserModel["nickname"];
                    $userBillModel["headurl"] = $joinUserModel["headurl"];
                    $userBillModel["types"] = 3;
                    $userBillModel["detail_id"] = $draw_id;
                    $userBillModel["money"] = $prizeModel["sys"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("id" => $joinUserModel["id"]), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                } else {
                    $sysReissueModel = array();
                    $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                    $sysReissueModel["store_id"] = $prizeModel["store_id"];
                    $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                    $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                    $sysReissueModel["draw_id"] = $draw_id;
                    $sysReissueModel["types"] = 2;
                    $sysReissueModel["openid"] = $joinUserModel["openid"];
                    $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                    $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                    $sysReissueModel["status"] = 0;
                    $sysReissueModel["money"] = $prizeModel["sys"];
                    $sysReissueModel["desc"] = $prizeModel["name"];
                    $sysReissueModel["is_store_sell"] = 0;
                    $sysReissueModel["updatetime"] = TIMESTAMP;
                    $sysReissueModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                }
                pdo_update(ztbTable("user_draw", false), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
            } else {
                if (intval($prizeModel["types"]) == 3) {
                    if (intval($prizeModel["create_types"]) == 1) {
                        list($min, $max) = explode("-", $prizeModel["money"]);
                        $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                    }
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                    $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $object["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                    if ($storeModel["money"] >= $prizeModel["money"]) {
                        pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["money"])), array("id" => $store_id));
                        $storeBillModel = array();
                        $storeBillModel["uniacid"] = $uniacid;
                        $storeBillModel["store_id"] = $store_id;
                        $storeBillModel["types"] = 11;
                        $storeBillModel["detail_id"] = $draw_id;
                        $storeBillModel["money"] = $prizeModel["money"];
                        $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                        $storeBillModel["note"] = $note;
                        $storeBillModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                        $result = sendWeixinMchPay($joinUserModel["openid"], floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                        if (!($result === true)) {
                            $store_config = iunserializer($storeModel["config"]);
                            $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                            if ($is_mchpayfail_usermoney == 0) {
                                $sysReissueModel = array();
                                $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                $sysReissueModel["draw_id"] = $draw_id;
                                $sysReissueModel["types"] = 1;
                                $sysReissueModel["openid"] = $joinUserModel["openid"];
                                $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                $sysReissueModel["status"] = 0;
                                $sysReissueModel["money"] = $prizeModel["money"];
                                $sysReissueModel["desc"] = $prizeModel["name"];
                                $sysReissueModel["is_store_sell"] = 1;
                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                $sysReissueModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                            } else {
                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]));
                                $userBillModel = array();
                                $userBillModel["uniacid"] = $uniacid;
                                $userBillModel["store_id"] = $store_id;
                                $userBillModel["openid"] = $joinUserModel["openid"];
                                $userBillModel["nickname"] = $joinUserModel["nickname"];
                                $userBillModel["headurl"] = $joinUserModel["headurl"];
                                $userBillModel["types"] = 3;
                                $userBillModel["detail_id"] = $draw_id;
                                $userBillModel["money"] = $prizeModel["money"];
                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]), "money");
                                $userBillModel["note"] = $note;
                                $userBillModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                            }
                        }
                    } else {
                        $sysReissueModel = array();
                        $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                        $sysReissueModel["store_id"] = $prizeModel["store_id"];
                        $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                        $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                        $sysReissueModel["draw_id"] = $draw_id;
                        $sysReissueModel["types"] = 1;
                        $sysReissueModel["openid"] = $joinUserModel["openid"];
                        $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                        $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                        $sysReissueModel["status"] = 0;
                        $sysReissueModel["money"] = $prizeModel["money"];
                        $sysReissueModel["desc"] = $prizeModel["name"];
                        $sysReissueModel["is_store_sell"] = 0;
                        $sysReissueModel["updatetime"] = TIMESTAMP;
                        $sysReissueModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                    }
                    pdo_update(ztbNopreTable("user_draw"), array("money" => $prizeModel["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                } else {
                    if (intval($prizeModel["types"]) == 5) {
                        $storeCard = pdo_get(ztbNopreTable("store_card"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                        if (!empty($storeCard)) {
                            pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                        }
                    }
                }
            }
        }
        pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
        pdo_update(ztbTable("obj_activity", false), array("get_num +=" => 1), array("id" => $object["id"]));
        if (!empty($origin_id)) {
            pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
        }
        $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id), array("money", "sms", "name", "zucp_ext"));
        if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
            if (!empty($prizeModel["sms_tmp"])) {
                if (!empty($joinUserModel["mobile"])) {
                    $sms_uid = $config["sms_uid"];
                    $sms_key = $config["sms_key"];
                    $mobile = $joinUserModel["mobile"];
                    $sms_content = $prizeModel["sms_tmp"];
                    $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                    $sms_content = str_replace("{PRIZE}", $join_draw_data["name"], $sms_content);
                    $sms_content = str_replace("{WRITEOFFCODE}", $join_draw_data["writecode"], $sms_content);
                    $sms_content = str_replace("{OBJ}", $object["title"], $sms_content);
                    if (empty($storeModel["zucp_ext"])) {
                        $sms_content .= "【{$config["name"]}】";
                    } else {
                        $sms_content .= "【{$storeModel["name"]}】";
                    }
                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                    if ($result === true) {
                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                    }
                }
            }
        } else {
            if (intval($object["is_sms"]) == 1 && $storeModel["sms"] > 0) {
                if (!empty($object["sms_tmp"])) {
                    if (!empty($joinUserModel["mobile"])) {
                        $sms_uid = $config["sms_uid"];
                        $sms_key = $config["sms_key"];
                        $mobile = $joinUserModel["mobile"];
                        $sms_content = $object["sms_tmp"];
                        $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                        $sms_content = str_replace("{PRIZE}", $join_draw_data["name"], $sms_content);
                        $sms_content = str_replace("{WRITEOFFCODE}", $join_draw_data["writecode"], $sms_content);
                        $sms_content = str_replace("{OBJ}", $object["title"], $sms_content);
                        if (empty($storeModel["zucp_ext"])) {
                            $sms_content .= "【{$config["name"]}】";
                        } else {
                            $sms_content .= "【{$storeModel["name"]}】";
                        }
                        $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                        if ($result === true) {
                            pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                            pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                        }
                    }
                }
            }
        }
        thread_unlock($openid);
        resultMsg(["status" => 1, "msg" => "恭喜您，获得奖品“" . $prizeModel["name"] . "”！"]);
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动奖品已发完！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "register" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
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
        if ($item["Name"] == "Mobile") {
            pdo_update(ztbTable("user_account", false), array("mobile" => $_GPC[$item["Name"]]), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
        }
    }
    unset($item);
    $userJoinTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_praise_join") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userJoinTotal > 0) {
        exit(json_encode(array("status" => 0, "tip" => "follow", "msg" => "对不起，请不要重复参与活动哦！"), JSON_UNESCAPED_UNICODE));
    }
    isetcookie("reg_objpraise_" . $object["id"], base64_encode(serialize($registerFields)), 3600 * 24 * 365);
    exit(json_encode(array("status" => 1, "msg" => "登记成功！"), JSON_UNESCAPED_UNICODE));
}