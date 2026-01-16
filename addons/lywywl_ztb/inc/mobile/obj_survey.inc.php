<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "draw", "register", "join");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 19;
$token = $_GPC["token"];
$origin_id = intval($_GPC["origin_id"]);
if (getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_shareborrow")) {
    if ($config["is_share_borrow"] == 1 && !empty($config["share_borrow_uniacid"][$activityTables[$activity_types]])) {
        $account_api = WeAccount::createByUniacid($config["share_borrow_uniacid"][$activityTables[$activity_types]]);
        $_W["account"]["jssdkconfig"] = $account_api->getJssdkConfig();
    }
}
$plug_rebate2 = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_twoinvite");
$plug_appad = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_appad");
if ($plug_appad) {
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_survey");
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
$object = pdo_get(ztbNopreTable("obj_survey"), array("deltime" => 0, "activity_id" => $activity["id"]));
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
        isetcookie("join_id_survey_" . $object["id"], $_GET["join_id"], 3600 * 24);
    } else {
        $join_id = $_GPC["join_id_survey_" . $object["id"]];
    }
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_survey_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_survey_" . $object["id"], "ad", 3600 * 24 * 365);
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
    if ($object["banner_types"] == 0) {
        $object["multi_banner_url"] = explode(",", $object["multi_banner_url"]);
    }
    $joinUserList = pdo_fetchall("SELECT nickname,headurl FROM " . ztbTable("obj_survey_join") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id order by id desc LIMIT 14 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $activity["id"]));
    if (count($joinUserList) < 14 && intval($activity["bogus_join_num"]) > 0) {
        $bogusJoinCount = 14 - count($joinUserList);
        if (14 > count($joinUserList) + intval($activity["bogus_join_num"])) {
            $bogusJoinCount = intval($activity["bogus_join_num"]);
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
    if ($object["is_show_winners"] > 0) {
        $drawUserList = pdo_getall(ztbNopreTable("user_draw"), array("deltime" => 0, "activity_id" => $object["activity_id"]), array("nickname", "headurl", "name", "createtime"), '', "id desc", 20);
        $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1), array("name", "odds"), '', "sort asc");
        if (count($drawUserList) < 20 && intval($activity["bogus_get_num"]) > 0 && count($prizeList) > 0) {
            $bogusDrawCount = 20 - count($drawUserList);
            if (20 > count($drawUserList) + intval($activity["bogus_get_num"])) {
                $bogusDrawCount = intval($activity["bogus_get_num"]);
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
                    $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"], "name" => $prize["name"], "createtime" => $activity["start_time"]);
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
    }
    $topUserList = pdo_getall(ztbTable("obj_survey_join", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"]), array("nickname", "headurl", "invite", "money", "bogus_invite", "bogus_money"), '', "invite`+`bogus_invite desc,money`+`bogus_money desc", array(10));
    foreach ($topUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $isShowTopUserMoney = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("lywywl_ztb_obj_prize") . " where `uniacid`=:uniacid and store_id=:store_id and activity_id=:activity_id and status=1 and types in(2,3) and place=1 and deltime=0 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"])) > 0;
    $questionList = pdo_getall(ztbNopreTable("obj_survey_question"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1), array("id", "title", "types"), '', "sort asc");
    if (count($questionList) > 0) {
        foreach ($questionList as &$question) {
            if ($question["types"] == 0 || $question["types"] == 1) {
                $optionList = pdo_fetchall("SELECT `id`,`content`,`is_custom` FROM " . ztbTable("obj_survey_option") . " where `deltime`=0 and `question_id`=:question_id  order by sort asc , id asc ", array(":question_id" => $question["id"]));
                $question["options"] = $optionList;
            }
            unset($question);
        }
    }
    $userDraw = pdo_get("lywywl_ztb_user_draw", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "openid" => $openid), array("id"));
    $isShareDraw = false;
    if ($object["force_share"] == 1 && empty($userDraw)) {
        $isShareDraw = true;
    }
    $share_id = 0;
    $join_model = pdo_get("lywywl_ztb_obj_survey_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "openid" => $openid));
    if ($join_model) {
        $share_id = $join_model["id"];
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        if ($object["is_register"] <= 0) {
            $join_user_model = pdo_get(ztbNopreTable("obj_survey_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "id" => $join_id));
            $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "register_data" => '', "answer_data" => '', "status" => 0, "origin_id" => $origin_id, "origin_team_id" => $originModel["team_id"], "createtime" => TIMESTAMP, "share_openid" => empty($join_user_model) ? '' : $join_user_model["openid"], "share_nickname" => empty($join_user_model) ? '' : $join_user_model["nickname"], "share_headurl" => empty($join_user_model) ? '' : $join_user_model["headurl"], "invite" => 0, "money" => 0);
            $result = pdo_insert("lywywl_ztb_obj_survey_join", $insert_join_model);
            if (!empty($result)) {
                $share_id = pdo_insertid();
                pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $activity["id"]));
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
    $registerData = $_GPC["reg_objsurvey_" . $object["id"]];
    $userJoin = pdo_get("lywywl_ztb_obj_survey_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "openid" => $openid));
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["activity_id"], $user["id"]);
    pdo_update(ztbNopreTable("obj_activity"), array("click_num +=" => 1), array("id" => $object["activity_id"]));
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
    $userTeamModel = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "status" => 1, "openid" => $openid));
    if (!empty($userTeamModel)) {
        $is_marketing = true;
    }
    $template = pdo_get(ztbNopreTable("sys_tmp"), array("deltime" => 0, "id" => $activity["tmp_id"]));
    $resource = $template["resource"];
    $tmpDir = "tmp/" . $resource;
    include $this->template("{$tmpDir}/index");
    exit;
}
if ($act == "register" && $request_method == "post") {
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
    isetcookie("reg_objsurvey_" . $object["id"], base64_encode(serialize($registerFields)), 3600 * 24);
    exit(json_encode(array("status" => 1, "msg" => "登记成功，开始答题！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "join" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["area_limit"]) {
        $areaArr = explode(",", $object["area_limit"]);
        $longitude = $_GPC["longitude"];
        $latitude = $_GPC["latitude"];
        if (empty($longitude) || empty($latitude)) {
            thread_unlock($openid);
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
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "亲，您所在的区域不在本次活动范围！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $register_data = $_GPC["reg_objsurvey_" . $object["id"]];
    if (empty($register_data) && $object["is_register"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，请先登记后在参与问卷！"), JSON_UNESCAPED_UNICODE));
    }
    $joinModel = pdo_get(ztbNopreTable("obj_survey_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $openid));
    if ($joinModel && $joinModel["status"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "您已参与问卷，可以邀请好友参与哦！"), JSON_UNESCAPED_UNICODE));
    }
    $answerList = $_GPC["question"];
    if (empty($answerList) || count($answerList) == 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 1, "msg" => "请提交您的问卷！"), JSON_UNESCAPED_UNICODE));
    }
    $questionList = pdo_getall(ztbNopreTable("obj_survey_question"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1), array("id", "title", "types"), '', "sort asc");
    $questions = [];
    foreach ($questionList as $question) {
        $questions[$question["id"]] = $question;
    }
    unset($questionList);
    $optionList = pdo_getall(ztbNopreTable("obj_survey_option"), array("deltime" => 0, "activity_id" => $object["activity_id"]), array("id", "content", "is_custom"), '', "id asc");
    $options = [];
    foreach ($optionList as $option) {
        $options[$option["id"]] = $option;
    }
    unset($optionList);
    $answer_data = [];
    foreach ($answerList as $index => $answer) {
        $question = $questions[$answer["id"]];
        if (empty($question)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 1, "msg" => "您提交的信息有误，请刷新页面重新提交问卷！"), JSON_UNESCAPED_UNICODE));
        }
        $answer_data[$index]["question"] = $question["title"];
        if ($question["types"] == 0) {
            $option = $options[$answer["option"]];
            $answer_data[$index]["answer"] = $option["content"];
            if ($option["is_custom"] == 1) {
                $answer_data[$index]["answer"] .= ":" . $answer["custom"] . ";";
            }
            pdo_update(ztbNopreTable("obj_survey_option"), array("select_num +=" => 1), array("id" => $option["id"]));
        } else {
            if ($question["types"] == 1) {
                $option_ids = $answer["option"];
                foreach ($option_ids as $option_id) {
                    $option = $options[$option_id];
                    if ($option["is_custom"] == 1) {
                        $answer_data[$index]["answer"] .= $option["content"] . ":";
                        $answer_data[$index]["answer"] .= $answer["custom"][$option["id"]] . ";";
                    } else {
                        $answer_data[$index]["answer"] .= $option["content"] . ";";
                    }
                    pdo_update(ztbNopreTable("obj_survey_option"), array("select_num +=" => 1), array("id" => $option["id"]));
                }
            } else {
                if ($question["types"] == 2) {
                    $answer_data[$index]["answer"] = $answer["content"];
                } else {
                    if ($question["types"] == 3) {
                        $answer_data[$index]["answer"] = $answer["content"];
                    }
                }
            }
        }
    }
    $register_data = $object["is_register"] == 1 ? base64_decode($register_data) : '';
    $share_id = 0;
    if (empty($joinModel)) {
        if (!empty($_GET["join_id"])) {
            $join_id = $_GET["join_id"];
        } else {
            $join_id = $_GPC["join_id_survey_" . $object["id"]];
        }
        $join_user_model = pdo_get(ztbNopreTable("obj_survey_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "id" => $join_id));
        $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "register_data" => $register_data, "answer_data" => json_encode($answer_data, JSON_UNESCAPED_UNICODE), "status" => 0, "origin_id" => $origin_id, "origin_team_id" => $originModel["team_id"], "createtime" => TIMESTAMP, "share_openid" => empty($join_user_model) ? '' : $join_user_model["openid"], "share_nickname" => empty($join_user_model) ? '' : $join_user_model["nickname"], "share_headurl" => empty($join_user_model) ? '' : $join_user_model["headurl"], "invite" => 0, "money" => 0);
        $result = pdo_insert("lywywl_ztb_obj_survey_join", $insert_join_model);
        if (empty($result)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
        }
        $share_id = pdo_insertid();
        pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $activity["id"]));
        if (!empty($origin_id)) {
            pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
        }
    } else {
        $share_id = $joinModel["id"];
        pdo_update(ztbNopreTable("obj_survey_join"), array("register_data" => $register_data, "answer_data" => json_encode($answer_data, JSON_UNESCAPED_UNICODE)), array("id" => $share_id));
    }
    if ($object["force_share"] == 0) {
        $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
        $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 0), array(), '', "sort asc");
        if (!empty($prizeList)) {
            $prizeModel = null;
            foreach ($prizeList as $key => $val) {
                if (!(intval($val["surplus"]) <= 0)) {
                    if (!(intval($val["odds"]) <= 0)) {
                        if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                $arr[$key] = $val["odds"];
                            } else {
                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
                                if (!($count >= intval($val["limitnum"]))) {
                                    $arr[$key] = $val["odds"];
                                } else {
                                }
                            }
                        } else {
                            $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $openid), "count(*)");
                            if (!($count >= intval($val["limitnum"]))) {
                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                    $arr[$key] = $val["odds"];
                                } else {
                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
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
            if (empty($prizeModel) && !empty($arr)) {
                $rid = getRand($arr);
                $prizeModel = $prizeList[$rid];
            }
            if (!empty($prizeModel)) {
                $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "register_data" => $register_data, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data);
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
                    $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"] . "个";
                    pdo_update(ztbNopreTable("user_account"), array("score +=" => intval($prizeModel["score"])), array("id" => $userModel["id"]));
                    $userScoreModel = array();
                    $userScoreModel["uniacid"] = $uniacid;
                    $userScoreModel["store_id"] = $store_id;
                    $userScoreModel["openid"] = $userModel["openid"];
                    $userScoreModel["nickname"] = $userModel["nickname"];
                    $userScoreModel["headurl"] = $userModel["headurl"];
                    $userScoreModel["types"] = 1;
                    $userScoreModel["activity_types"] = $activity_types;
                    $userScoreModel["detail_id"] = $draw_id;
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
                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                        if ($storeModel["money"] >= $prizeModel["sys"]) {
                            pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("id" => $userModel["id"]));
                            $userBillModel = array();
                            $userBillModel["uniacid"] = $uniacid;
                            $userBillModel["store_id"] = $store_id;
                            $userBillModel["openid"] = $userModel["openid"];
                            $userBillModel["nickname"] = $userModel["nickname"];
                            $userBillModel["headurl"] = $userModel["headurl"];
                            $userBillModel["types"] = 3;
                            $userBillModel["detail_id"] = $draw_id;
                            $userBillModel["money"] = $prizeModel["sys"];
                            $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $userModel["openid"]), "money");
                            $userBillModel["note"] = $note;
                            $userBillModel["createtime"] = TIMESTAMP;
                            pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                            pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["sys"])), array("id" => $store_id));
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
                        } else {
                            $sysReissueModel = array();
                            $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                            $sysReissueModel["store_id"] = $prizeModel["store_id"];
                            $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                            $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                            $sysReissueModel["draw_id"] = $draw_id;
                            $sysReissueModel["types"] = 2;
                            $sysReissueModel["openid"] = $userModel["openid"];
                            $sysReissueModel["nickname"] = $userModel["nickname"];
                            $sysReissueModel["headurl"] = $userModel["headurl"];
                            $sysReissueModel["status"] = 0;
                            $sysReissueModel["money"] = $prizeModel["sys"];
                            $sysReissueModel["desc"] = $prizeModel["name"];
                            $sysReissueModel["is_store_sell"] = 0;
                            $sysReissueModel["updatetime"] = TIMESTAMP;
                            $sysReissueModel["createtime"] = TIMESTAMP;
                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                        }
                        pdo_update(ztbNopreTable("user_draw"), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                    } else {
                        if (intval($prizeModel["types"]) == 3) {
                            if (intval($prizeModel["create_types"]) == 1) {
                                list($min, $max) = explode("-", $prizeModel["money"]);
                                $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                            }
                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
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
                                $result = sendWeixinMchPay($userModel["openid"], floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
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
                                        $sysReissueModel["openid"] = $userModel["openid"];
                                        $sysReissueModel["nickname"] = $userModel["nickname"];
                                        $sysReissueModel["headurl"] = $userModel["headurl"];
                                        $sysReissueModel["status"] = 0;
                                        $sysReissueModel["money"] = $prizeModel["money"];
                                        $sysReissueModel["desc"] = $prizeModel["name"];
                                        $sysReissueModel["is_store_sell"] = 1;
                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                    } else {
                                        pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $userModel["openid"]));
                                        $userBillModel = array();
                                        $userBillModel["uniacid"] = $uniacid;
                                        $userBillModel["store_id"] = $store_id;
                                        $userBillModel["openid"] = $userModel["openid"];
                                        $userBillModel["nickname"] = $userModel["nickname"];
                                        $userBillModel["headurl"] = $userModel["headurl"];
                                        $userBillModel["types"] = 3;
                                        $userBillModel["detail_id"] = $draw_id;
                                        $userBillModel["money"] = $prizeModel["money"];
                                        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $userModel["openid"]), "money");
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
                                $sysReissueModel["openid"] = $userModel["openid"];
                                $sysReissueModel["nickname"] = $userModel["nickname"];
                                $sysReissueModel["headurl"] = $userModel["headimgurl"];
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
                                $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                if (!empty($storeCard)) {
                                    pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                }
                            }
                        }
                    }
                }
                pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                pdo_update(ztbNopreTable("obj_survey_join"), array("status" => 1), array("id" => $share_id));
                if (!empty($origin_id)) {
                    pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                }
                $drawModel = pdo_get(ztbNopreTable("user_draw"), array("id" => $draw_id));
                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                    if (!empty($prizeModel["sms_tmp"])) {
                        if (!empty($userModel["mobile"])) {
                            $sms_uid = $config["sms_uid"];
                            $sms_key = $config["sms_key"];
                            $mobile = $userModel["mobile"];
                            $sms_content = $prizeModel["sms_tmp"];
                            $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                            $sms_content = str_replace("{PRIZE}", $drawModel["name"], $sms_content);
                            $sms_content = str_replace("{WRITEOFFCODE}", $drawModel["writecode"], $sms_content);
                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
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
                            if (!empty($userModel["mobile"])) {
                                $sms_uid = $config["sms_uid"];
                                $sms_key = $config["sms_key"];
                                $mobile = $userModel["mobile"];
                                $sms_content = $object["sms_tmp"];
                                $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                                $sms_content = str_replace("{PRIZE}", $drawModel["name"], $sms_content);
                                $sms_content = str_replace("{WRITEOFFCODE}", $drawModel["writecode"], $sms_content);
                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
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
                $result_data = array("status" => 2, "prize_name" => $drawModel["name"], "prize_picurl" => tomedia($drawModel["prize_pic_url"]));
            }
        }
        if (!empty($result_data)) {
            if ($object["or_open_invite"] == 1) {
                $joinModel = pdo_get(ztbNopreTable("obj_survey_join"), array("id" => $share_id));
                if (!empty($joinModel["share_openid"])) {
                    $share_join_model = pdo_get(ztbNopreTable("obj_survey_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $joinModel["share_openid"]));
                    if (!empty($share_join_model) && $share_join_model["openid"] != $openid) {
                        pdo_update(ztbTable("obj_survey_join", false), array("invite +=" => 1), array("id" => $share_join_model["id"]));
                        $joinUserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $share_join_model["openid"]));
                        if (isset($object["or_open_rebate2"])) {
                            $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 1, "or_rebate2" => 0), array(), '', "sort asc");
                        } else {
                            $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 1), array(), '', "sort asc");
                        }
                        if (!empty($prizeList)) {
                            $prizeModel = null;
                            foreach ($prizeList as $key => $val) {
                                if (!(intval($val["surplus"]) <= 0)) {
                                    if (!(intval($val["odds"]) <= 0)) {
                                        if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                $arr[$key] = $val["odds"];
                                            } else {
                                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                                if (!($count >= intval($val["limitnum"]))) {
                                                    $arr[$key] = $val["odds"];
                                                } else {
                                                }
                                            }
                                        } else {
                                            $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $joinUserModel["openid"]), "count(*)");
                                            if (!($count >= intval($val["limitnum"]))) {
                                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                    $arr[$key] = $val["odds"];
                                                } else {
                                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
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
                            if (empty($prizeModel) && !empty($arr)) {
                                $rid = getRand($arr);
                                $prizeModel = $prizeList[$rid];
                            }
                            if (!empty($prizeModel)) {
                                $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinUserModel["openid"], "nickname" => $joinUserModel["nickname"], "headurl" => $joinUserModel["headurl"], "register_data" => $share_join_model["register_data"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                                $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data);
                                $writecode = '';
                                if (!empty($result)) {
                                    $draw_id = pdo_insertid();
                                    $hashids = Hashids::instance(6, "lywyztb", '');
                                    $encode_id = $hashids->encode($draw_id);
                                    $join_draw_data = array("writecode" => $encode_id);
                                    pdo_update(ztbNopreTable("user_draw", false), $join_draw_data, array("id" => $draw_id));
                                    $writecode = $encode_id;
                                }
                                if (intval($prizeModel["types"]) == 1) {
                                    if (intval($prizeModel["create_types"]) == 1) {
                                        list($min, $max) = explode("-", $prizeModel["score"]);
                                        $prizeModel["score"] = mt_rand($min, $max);
                                    }
                                    $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"];
                                    pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("id" => $joinUserModel["id"]));
                                    $userScoreModel = array();
                                    $userScoreModel["uniacid"] = $uniacid;
                                    $userScoreModel["store_id"] = $store_id;
                                    $userScoreModel["openid"] = $joinUserModel["openid"];
                                    $userScoreModel["nickname"] = $joinUserModel["nickname"];
                                    $userScoreModel["headurl"] = $joinUserModel["headurl"];
                                    $userScoreModel["types"] = 1;
                                    $userScoreModel["activity_types"] = $activity_types;
                                    $userScoreModel["detail_id"] = $draw_id;
                                    $userScoreModel["score"] = $prizeModel["score"];
                                    $userScoreModel["note"] = $note;
                                    $userScoreModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                                    pdo_update(ztbNopreTable("user_draw"), array("score" => $prizeModel["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                } else {
                                    if (intval($prizeModel["types"]) == 2) {
                                        if (intval($prizeModel["create_types"]) == 1) {
                                            list($min, $max) = explode("-", $prizeModel["sys"]);
                                            $prizeModel["sys"] = mt_rand($min * 100, $max * 100) / 100;
                                        }
                                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                                        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                        if ($storeModel["money"] >= $prizeModel["sys"]) {
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
                                            $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]), "money");
                                            $userBillModel["note"] = $note;
                                            $userBillModel["createtime"] = TIMESTAMP;
                                            pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                            pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["sys"])), array("id" => $store_id));
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
                                        pdo_update(ztbNopreTable("user_draw"), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                        pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prizeModel["sys"])), array("id" => $share_join_model["id"]));
                                    } else {
                                        if (intval($prizeModel["types"]) == 3) {
                                            if (intval($prizeModel["create_types"]) == 1) {
                                                list($min, $max) = explode("-", $prizeModel["money"]);
                                                $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                                            }
                                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
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
                                                $sysReissueModel["headurl"] = $joinUserModel["headimgurl"];
                                                $sysReissueModel["status"] = 0;
                                                $sysReissueModel["money"] = $prizeModel["money"];
                                                $sysReissueModel["desc"] = $prizeModel["name"];
                                                $sysReissueModel["is_store_sell"] = 0;
                                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                                $sysReissueModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                            }
                                            pdo_update(ztbNopreTable("user_draw"), array("money" => $prizeModel["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                            pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prizeModel["money"])), array("id" => $share_join_model["id"]));
                                        } else {
                                            if (intval($prizeModel["types"]) == 5) {
                                                $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                                if (!empty($storeCard)) {
                                                    pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                }
                                            }
                                        }
                                    }
                                }
                                pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                                pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                                if (!empty($origin_id)) {
                                    pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                                }
                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                                    if (!empty($prizeModel["sms_tmp"])) {
                                        if (!empty($joinUserModel["mobile"])) {
                                            $sms_uid = $config["sms_uid"];
                                            $sms_key = $config["sms_key"];
                                            $mobile = $joinUserModel["mobile"];
                                            $sms_content = $prizeModel["sms_tmp"];
                                            $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                                            $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                            $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                            if (empty($storeModel["zucp_ext"])) {
                                                $sms_content .= "【{$config["name"]}】";
                                            } else {
                                                $sms_content .= "【{$storeModel["name"]}】";
                                            }
                                            $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                            if ($result === true) {
                                                pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
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
                                                $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                if (empty($storeModel["zucp_ext"])) {
                                                    $sms_content .= "【{$config["name"]}】";
                                                } else {
                                                    $sms_content .= "【{$storeModel["name"]}】";
                                                }
                                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                if ($result === true) {
                                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if ($plug_rebate2) {
                        if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                            $share2_join_model = pdo_get(ztbTable("obj_survey_join", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $share_join_model["share_openid"]));
                            if (!empty($share2_join_model)) {
                                if ($share2_join_model["openid"] != $openid && $share2_join_model["openid"] != $share_join_model["openid"]) {
                                    pdo_update(ztbTable("obj_survey_join", false), array("invite +=" => 1), array("id" => $share2_join_model["id"]));
                                    $join2UserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $share2_join_model["openid"]));
                                    $prize2List = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 1, "or_rebate2" => 1), array(), '', "sort asc");
                                    if (!empty($prize2List)) {
                                        $prize2Model = null;
                                        foreach ($prize2List as $key => $val) {
                                            if (!(intval($val["surplus"]) <= 0)) {
                                                if (!(intval($val["odds"]) <= 0)) {
                                                    if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                                        if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                            $arr2[$key] = $val["odds"];
                                                        } else {
                                                            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                            if (!($count >= intval($val["limitnum"]))) {
                                                                $arr2[$key] = $val["odds"];
                                                            } else {
                                                            }
                                                        }
                                                    } else {
                                                        $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $join2UserModel["openid"]), "count(*)");
                                                        if (!($count >= intval($val["limitnum"]))) {
                                                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                                $arr2[$key] = $val["odds"];
                                                            } else {
                                                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                                if (!($count >= intval($val["limitnum"]))) {
                                                                    $arr2[$key] = $val["odds"];
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
                                        if (empty($prize2Model) && !empty($arr2)) {
                                            $rid2 = getRand($arr2);
                                            $prize2Model = $prize2List[$rid2];
                                        }
                                        if (!empty($prize2Model)) {
                                            $join_draw_data2 = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prize2Model["id"], "types" => $prize2Model["types"], "name" => $prize2Model["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prize2Model["picurl"], "writeoff_types" => $prize2Model["writeoff_types"], "openid" => $join2UserModel["openid"], "nickname" => $join2UserModel["nickname"], "headurl" => $join2UserModel["headurl"], "register_data" => '', "or_rebate2" => 1, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                                            $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data2);
                                            $writecode = '';
                                            if (!empty($result)) {
                                                $draw_id = pdo_insertid();
                                                $hashids = Hashids::instance(6, "lywyztb", '');
                                                $encode_id = $hashids->encode($draw_id);
                                                $join_draw_data2 = array("writecode" => $encode_id);
                                                pdo_update(ztbNopreTable("user_draw", false), $join_draw_data2, array("id" => $draw_id));
                                                $writecode = $encode_id;
                                            }
                                            if (intval($prize2Model["types"]) == 1) {
                                                if (intval($prize2Model["create_types"]) == 1) {
                                                    list($min, $max) = explode("-", $prize2Model["score"]);
                                                    $prize2Model["score"] = mt_rand($min, $max);
                                                }
                                                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prize2Model["score"];
                                                pdo_update(ztbNopreTable("user_account"), array("score +=" => $prize2Model["score"]), array("id" => $join2UserModel["id"]));
                                                $userScoreModel = array();
                                                $userScoreModel["uniacid"] = $uniacid;
                                                $userScoreModel["store_id"] = $store_id;
                                                $userScoreModel["openid"] = $join2UserModel["openid"];
                                                $userScoreModel["nickname"] = $join2UserModel["nickname"];
                                                $userScoreModel["headurl"] = $join2UserModel["headurl"];
                                                $userScoreModel["types"] = 1;
                                                $userScoreModel["activity_types"] = $activity_types;
                                                $userScoreModel["detail_id"] = $draw_id;
                                                $userScoreModel["score"] = $prize2Model["score"];
                                                $userScoreModel["note"] = $note;
                                                $userScoreModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                                                pdo_update(ztbNopreTable("user_draw"), array("score" => $prize2Model["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                            } else {
                                                if (intval($prize2Model["types"]) == 2) {
                                                    if (intval($prize2Model["create_types"]) == 1) {
                                                        list($min, $max) = explode("-", $prize2Model["sys"]);
                                                        $prize2Model["sys"] = mt_rand($min * 100, $max * 100) / 100;
                                                    }
                                                    $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prize2Model["sys"] . "元";
                                                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                    if ($storeModel["money"] >= $prize2Model["sys"]) {
                                                        pdo_update(ztbNopreTable("user_account"), array("money +=" => $prize2Model["sys"]), array("id" => $join2UserModel["id"]));
                                                        $userBillModel = array();
                                                        $userBillModel["uniacid"] = $uniacid;
                                                        $userBillModel["store_id"] = $store_id;
                                                        $userBillModel["openid"] = $join2UserModel["openid"];
                                                        $userBillModel["nickname"] = $join2UserModel["nickname"];
                                                        $userBillModel["headurl"] = $join2UserModel["headurl"];
                                                        $userBillModel["types"] = 3;
                                                        $userBillModel["detail_id"] = $draw_id;
                                                        $userBillModel["money"] = $prize2Model["sys"];
                                                        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]), "money");
                                                        $userBillModel["note"] = $note;
                                                        $userBillModel["createtime"] = TIMESTAMP;
                                                        pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                        pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["sys"])), array("id" => $store_id));
                                                        $storeBillModel = array();
                                                        $storeBillModel["uniacid"] = $uniacid;
                                                        $storeBillModel["store_id"] = $store_id;
                                                        $storeBillModel["types"] = 11;
                                                        $storeBillModel["detail_id"] = $draw_id;
                                                        $storeBillModel["money"] = $prize2Model["sys"];
                                                        $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                        $storeBillModel["note"] = $note;
                                                        $storeBillModel["createtime"] = TIMESTAMP;
                                                        pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                                    } else {
                                                        $sysReissueModel = array();
                                                        $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                        $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                        $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                        $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                        $sysReissueModel["draw_id"] = $draw_id;
                                                        $sysReissueModel["types"] = 2;
                                                        $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                        $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                        $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                        $sysReissueModel["status"] = 0;
                                                        $sysReissueModel["money"] = $prize2Model["sys"];
                                                        $sysReissueModel["desc"] = $prize2Model["name"];
                                                        $sysReissueModel["is_store_sell"] = 0;
                                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                    }
                                                    pdo_update(ztbNopreTable("user_draw"), array("sys" => $prize2Model["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                    pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prize2Model["sys"])), array("id" => $share2_join_model["id"]));
                                                } else {
                                                    if (intval($prize2Model["types"]) == 3) {
                                                        if (intval($prize2Model["create_types"]) == 1) {
                                                            list($min, $max) = explode("-", $prize2Model["money"]);
                                                            $prize2Model["money"] = mt_rand($min * 100, $max * 100) / 100;
                                                        }
                                                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prize2Model["money"] . "元";
                                                        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                        if ($storeModel["money"] >= $prize2Model["money"]) {
                                                            pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["money"])), array("id" => $store_id));
                                                            $storeBillModel = array();
                                                            $storeBillModel["uniacid"] = $uniacid;
                                                            $storeBillModel["store_id"] = $store_id;
                                                            $storeBillModel["types"] = 11;
                                                            $storeBillModel["detail_id"] = $draw_id;
                                                            $storeBillModel["money"] = $prize2Model["money"];
                                                            $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                            $storeBillModel["note"] = $note;
                                                            $storeBillModel["createtime"] = TIMESTAMP;
                                                            pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                                            $result = sendWeixinMchPay($join2UserModel["openid"], floatval($prize2Model["money"]) * 100, $prize2Model["name"], true, $uniacid, $config);
                                                            if (!($result === true)) {
                                                                $store_config = iunserializer($storeModel["config"]);
                                                                $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                                                                if ($is_mchpayfail_usermoney == 0) {
                                                                    $sysReissueModel = array();
                                                                    $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                                    $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                                    $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                                    $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                                    $sysReissueModel["draw_id"] = $draw_id;
                                                                    $sysReissueModel["types"] = 1;
                                                                    $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                                    $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                                    $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                                    $sysReissueModel["status"] = 0;
                                                                    $sysReissueModel["money"] = $prize2Model["money"];
                                                                    $sysReissueModel["desc"] = $prize2Model["name"];
                                                                    $sysReissueModel["is_store_sell"] = 1;
                                                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                                } else {
                                                                    pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]));
                                                                    $userBillModel = array();
                                                                    $userBillModel["uniacid"] = $uniacid;
                                                                    $userBillModel["store_id"] = $store_id;
                                                                    $userBillModel["openid"] = $join2UserModel["openid"];
                                                                    $userBillModel["nickname"] = $join2UserModel["nickname"];
                                                                    $userBillModel["headurl"] = $join2UserModel["headurl"];
                                                                    $userBillModel["types"] = 3;
                                                                    $userBillModel["detail_id"] = $draw_id;
                                                                    $userBillModel["money"] = $prizeModel["money"];
                                                                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]), "money");
                                                                    $userBillModel["note"] = $note;
                                                                    $userBillModel["createtime"] = TIMESTAMP;
                                                                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                                }
                                                            }
                                                        } else {
                                                            $sysReissueModel = array();
                                                            $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                            $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                            $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                            $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                            $sysReissueModel["draw_id"] = $draw_id;
                                                            $sysReissueModel["types"] = 1;
                                                            $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                            $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                            $sysReissueModel["headurl"] = $join2UserModel["headimgurl"];
                                                            $sysReissueModel["status"] = 0;
                                                            $sysReissueModel["money"] = $prize2Model["money"];
                                                            $sysReissueModel["desc"] = $prize2Model["name"];
                                                            $sysReissueModel["is_store_sell"] = 0;
                                                            $sysReissueModel["updatetime"] = TIMESTAMP;
                                                            $sysReissueModel["createtime"] = TIMESTAMP;
                                                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                        }
                                                        pdo_update(ztbNopreTable("user_draw"), array("money" => $prize2Model["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                        pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prize2Model["money"])), array("id" => $share2_join_model["id"]));
                                                    } else {
                                                        if (intval($prize2Model["types"]) == 5) {
                                                            $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prize2Model["card_id"], "status" => 1));
                                                            if (!empty($storeCard)) {
                                                                pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prize2Model["id"]));
                                            pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                                            if (!empty($origin_id)) {
                                                pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                                            }
                                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                            if ($prize2Model["is_sms"] == 1 && $storeModel["sms"] > 0) {
                                                if (!empty($prize2Model["sms_tmp"])) {
                                                    if (!empty($join2UserModel["mobile"])) {
                                                        $sms_uid = $config["sms_uid"];
                                                        $sms_key = $config["sms_key"];
                                                        $mobile = $join2UserModel["mobile"];
                                                        $sms_content = $prize2Model["sms_tmp"];
                                                        $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                        $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                        $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                        $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                        if (empty($storeModel["zucp_ext"])) {
                                                            $sms_content .= "【{$config["name"]}】";
                                                        } else {
                                                            $sms_content .= "【{$storeModel["name"]}】";
                                                        }
                                                        $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                        if ($result === true) {
                                                            pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                            pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                        }
                                                    }
                                                }
                                            } else {
                                                if (intval($object["is_sms"]) == 1 && $storeModel["sms"] > 0) {
                                                    if (!empty($object["sms_tmp"])) {
                                                        if (!empty($join2UserModel["mobile"])) {
                                                            $sms_uid = $config["sms_uid"];
                                                            $sms_key = $config["sms_key"];
                                                            $mobile = $join2UserModel["mobile"];
                                                            $sms_content = $object["sms_tmp"];
                                                            $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                            $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                            $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                            if (empty($storeModel["zucp_ext"])) {
                                                                $sms_content .= "【{$config["name"]}】";
                                                            } else {
                                                                $sms_content .= "【{$storeModel["name"]}】";
                                                            }
                                                            $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                            if ($result === true) {
                                                                pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                                pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if (empty($prizeList)) {
                $result_data = array("status" => 1, "msg" => "恭喜您提交答题成功！", JSON_UNESCAPED_UNICODE);
            } else {
                $result_data = array("status" => 3, "msg" => "对不起，您来晚了，奖品已发完！", JSON_UNESCAPED_UNICODE);
            }
        }
        thread_unlock($openid);
        exit(json_encode($result_data, JSON_UNESCAPED_UNICODE));
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 3, "msg" => "感谢参与，分享朋友或朋友圈领红包！"), JSON_UNESCAPED_UNICODE));
    }
    thread_unlock($openid);
    exit(json_encode(array("status" => 1, "msg" => "恭喜您提交答题成功！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "draw" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["force_share"] == 1) {
        $joinModel = pdo_get(ztbNopreTable("obj_survey_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $openid));
        if ($joinModel && $joinModel["status"] == 0) {
            $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
            $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 0), array(), '', "sort asc");
            if (!empty($prizeList)) {
                $prizeModel = null;
                foreach ($prizeList as $key => $val) {
                    if (!(intval($val["surplus"]) <= 0)) {
                        if (!(intval($val["odds"]) <= 0)) {
                            if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                    $arr[$key] = $val["odds"];
                                } else {
                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
                                    if (!($count >= intval($val["limitnum"]))) {
                                        $arr[$key] = $val["odds"];
                                    } else {
                                    }
                                }
                            } else {
                                $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $openid), "count(*)");
                                if (!($count >= intval($val["limitnum"]))) {
                                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                        $arr[$key] = $val["odds"];
                                    } else {
                                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
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
                if (empty($prizeModel) && !empty($arr)) {
                    $rid = getRand($arr);
                    $prizeModel = $prizeList[$rid];
                }
                if (!empty($prizeModel)) {
                    $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "register_data" => $joinModel["register_data"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                    $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data);
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
                        $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"] . "个";
                        pdo_update(ztbNopreTable("user_account"), array("score +=" => intval($prizeModel["score"])), array("id" => $userModel["id"]));
                        $userScoreModel = array();
                        $userScoreModel["uniacid"] = $uniacid;
                        $userScoreModel["store_id"] = $store_id;
                        $userScoreModel["openid"] = $userModel["openid"];
                        $userScoreModel["nickname"] = $userModel["nickname"];
                        $userScoreModel["headurl"] = $userModel["headurl"];
                        $userScoreModel["types"] = 1;
                        $userScoreModel["activity_types"] = $activity_types;
                        $userScoreModel["detail_id"] = $draw_id;
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
                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                            if ($storeModel["money"] >= $prizeModel["sys"]) {
                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("id" => $userModel["id"]));
                                $userBillModel = array();
                                $userBillModel["uniacid"] = $uniacid;
                                $userBillModel["store_id"] = $store_id;
                                $userBillModel["openid"] = $userModel["openid"];
                                $userBillModel["nickname"] = $userModel["nickname"];
                                $userBillModel["headurl"] = $userModel["headurl"];
                                $userBillModel["types"] = 3;
                                $userBillModel["detail_id"] = $draw_id;
                                $userBillModel["money"] = $prizeModel["sys"];
                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $userModel["openid"]), "money");
                                $userBillModel["note"] = $note;
                                $userBillModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["sys"])), array("id" => $store_id));
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
                            } else {
                                $sysReissueModel = array();
                                $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                $sysReissueModel["draw_id"] = $draw_id;
                                $sysReissueModel["types"] = 2;
                                $sysReissueModel["openid"] = $userModel["openid"];
                                $sysReissueModel["nickname"] = $userModel["nickname"];
                                $sysReissueModel["headurl"] = $userModel["headurl"];
                                $sysReissueModel["status"] = 0;
                                $sysReissueModel["money"] = $prizeModel["sys"];
                                $sysReissueModel["desc"] = $prizeModel["name"];
                                $sysReissueModel["is_store_sell"] = 0;
                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                $sysReissueModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                            }
                            pdo_update(ztbNopreTable("user_draw"), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                        } else {
                            if (intval($prizeModel["types"]) == 3) {
                                if (intval($prizeModel["create_types"]) == 1) {
                                    list($min, $max) = explode("-", $prizeModel["money"]);
                                    $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                                }
                                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
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
                                    $result = sendWeixinMchPay($userModel["openid"], floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
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
                                            $sysReissueModel["openid"] = $userModel["openid"];
                                            $sysReissueModel["nickname"] = $userModel["nickname"];
                                            $sysReissueModel["headurl"] = $userModel["headurl"];
                                            $sysReissueModel["status"] = 0;
                                            $sysReissueModel["money"] = $prizeModel["money"];
                                            $sysReissueModel["desc"] = $prizeModel["name"];
                                            $sysReissueModel["is_store_sell"] = 1;
                                            $sysReissueModel["updatetime"] = TIMESTAMP;
                                            $sysReissueModel["createtime"] = TIMESTAMP;
                                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                        } else {
                                            pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $userModel["openid"]));
                                            $userBillModel = array();
                                            $userBillModel["uniacid"] = $uniacid;
                                            $userBillModel["store_id"] = $store_id;
                                            $userBillModel["openid"] = $userModel["openid"];
                                            $userBillModel["nickname"] = $userModel["nickname"];
                                            $userBillModel["headurl"] = $userModel["headurl"];
                                            $userBillModel["types"] = 3;
                                            $userBillModel["detail_id"] = $draw_id;
                                            $userBillModel["money"] = $prizeModel["money"];
                                            $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $userModel["openid"]), "money");
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
                                    $sysReissueModel["openid"] = $userModel["openid"];
                                    $sysReissueModel["nickname"] = $userModel["nickname"];
                                    $sysReissueModel["headurl"] = $userModel["headimgurl"];
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
                                    $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                    if (!empty($storeCard)) {
                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                    }
                                }
                            }
                        }
                    }
                    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                    pdo_update(ztbNopreTable("obj_survey_join"), array("status" => 1), array("id" => $joinModel["id"]));
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                    }
                    $drawModel = pdo_get(ztbNopreTable("user_draw"), array("id" => $draw_id));
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                    if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                        if (!empty($prizeModel["sms_tmp"])) {
                            if (!empty($userModel["mobile"])) {
                                $sms_uid = $config["sms_uid"];
                                $sms_key = $config["sms_key"];
                                $mobile = $userModel["mobile"];
                                $sms_content = $prizeModel["sms_tmp"];
                                $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                                $sms_content = str_replace("{PRIZE}", $drawModel["name"], $sms_content);
                                $sms_content = str_replace("{WRITEOFFCODE}", $drawModel["writecode"], $sms_content);
                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
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
                                if (!empty($userModel["mobile"])) {
                                    $sms_uid = $config["sms_uid"];
                                    $sms_key = $config["sms_key"];
                                    $mobile = $userModel["mobile"];
                                    $sms_content = $object["sms_tmp"];
                                    $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                                    $sms_content = str_replace("{PRIZE}", $drawModel["name"], $sms_content);
                                    $sms_content = str_replace("{WRITEOFFCODE}", $drawModel["writecode"], $sms_content);
                                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
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
                    $result_data = array("status" => 2, "prize_name" => $drawModel["name"], "prize_picurl" => tomedia($drawModel["prize_pic_url"]));
                }
            }
            if (!empty($result_data)) {
                if ($object["or_open_invite"] == 1) {
                    if (!empty($joinModel["share_openid"])) {
                        $share_join_model = pdo_get(ztbNopreTable("obj_survey_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $joinModel["share_openid"]));
                        if (!empty($share_join_model) && $share_join_model["openid"] != $openid) {
                            pdo_update(ztbTable("obj_survey_join", false), array("invite +=" => 1), array("id" => $share_join_model["id"]));
                            $joinUserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $share_join_model["openid"]));
                            if (isset($object["or_open_rebate2"])) {
                                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 1, "or_rebate2" => 0), array(), '', "sort asc");
                            } else {
                                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 1), array(), '', "sort asc");
                            }
                            if (!empty($prizeList)) {
                                $prizeModel = null;
                                foreach ($prizeList as $key => $val) {
                                    if (!(intval($val["surplus"]) <= 0)) {
                                        if (!(intval($val["odds"]) <= 0)) {
                                            if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                    $arr[$key] = $val["odds"];
                                                } else {
                                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                                    if (!($count >= intval($val["limitnum"]))) {
                                                        $arr[$key] = $val["odds"];
                                                    } else {
                                                    }
                                                }
                                            } else {
                                                $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $joinUserModel["openid"]), "count(*)");
                                                if (!($count >= intval($val["limitnum"]))) {
                                                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                        $arr[$key] = $val["odds"];
                                                    } else {
                                                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
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
                                if (empty($prizeModel) && !empty($arr)) {
                                    $rid = getRand($arr);
                                    $prizeModel = $prizeList[$rid];
                                }
                                if (!empty($prizeModel)) {
                                    $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinUserModel["openid"], "nickname" => $joinUserModel["nickname"], "headurl" => $joinUserModel["headurl"], "register_data" => $share_join_model["register_data"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                                    $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data);
                                    $writecode = '';
                                    if (!empty($result)) {
                                        $draw_id = pdo_insertid();
                                        $hashids = Hashids::instance(6, "lywyztb", '');
                                        $encode_id = $hashids->encode($draw_id);
                                        $join_draw_data = array("writecode" => $encode_id);
                                        pdo_update(ztbNopreTable("user_draw", false), $join_draw_data, array("id" => $draw_id));
                                        $writecode = $encode_id;
                                    }
                                    if (intval($prizeModel["types"]) == 1) {
                                        if (intval($prizeModel["create_types"]) == 1) {
                                            list($min, $max) = explode("-", $prizeModel["score"]);
                                            $prizeModel["score"] = mt_rand($min, $max);
                                        }
                                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"];
                                        pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("id" => $joinUserModel["id"]));
                                        $userScoreModel = array();
                                        $userScoreModel["uniacid"] = $uniacid;
                                        $userScoreModel["store_id"] = $store_id;
                                        $userScoreModel["openid"] = $joinUserModel["openid"];
                                        $userScoreModel["nickname"] = $joinUserModel["nickname"];
                                        $userScoreModel["headurl"] = $joinUserModel["headurl"];
                                        $userScoreModel["types"] = 1;
                                        $userScoreModel["activity_types"] = $activity_types;
                                        $userScoreModel["detail_id"] = $draw_id;
                                        $userScoreModel["score"] = $prizeModel["score"];
                                        $userScoreModel["note"] = $note;
                                        $userScoreModel["createtime"] = TIMESTAMP;
                                        pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                                        pdo_update(ztbNopreTable("user_draw"), array("score" => $prizeModel["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                    } else {
                                        if (intval($prizeModel["types"]) == 2) {
                                            if (intval($prizeModel["create_types"]) == 1) {
                                                list($min, $max) = explode("-", $prizeModel["sys"]);
                                                $prizeModel["sys"] = mt_rand($min * 100, $max * 100) / 100;
                                            }
                                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                            if ($storeModel["money"] >= $prizeModel["sys"]) {
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
                                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]), "money");
                                                $userBillModel["note"] = $note;
                                                $userBillModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["sys"])), array("id" => $store_id));
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
                                            pdo_update(ztbNopreTable("user_draw"), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                            pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prizeModel["sys"])), array("id" => $share_join_model["id"]));
                                        } else {
                                            if (intval($prizeModel["types"]) == 3) {
                                                if (intval($prizeModel["create_types"]) == 1) {
                                                    list($min, $max) = explode("-", $prizeModel["money"]);
                                                    $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                                                }
                                                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
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
                                                    $sysReissueModel["headurl"] = $joinUserModel["headimgurl"];
                                                    $sysReissueModel["status"] = 0;
                                                    $sysReissueModel["money"] = $prizeModel["money"];
                                                    $sysReissueModel["desc"] = $prizeModel["name"];
                                                    $sysReissueModel["is_store_sell"] = 0;
                                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                }
                                                pdo_update(ztbNopreTable("user_draw"), array("money" => $prizeModel["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prizeModel["money"])), array("id" => $share_join_model["id"]));
                                            } else {
                                                if (intval($prizeModel["types"]) == 5) {
                                                    $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                                    if (!empty($storeCard)) {
                                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                                    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                                    if (!empty($origin_id)) {
                                        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                                    }
                                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                    if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                                        if (!empty($prizeModel["sms_tmp"])) {
                                            if (!empty($joinUserModel["mobile"])) {
                                                $sms_uid = $config["sms_uid"];
                                                $sms_key = $config["sms_key"];
                                                $mobile = $joinUserModel["mobile"];
                                                $sms_content = $prizeModel["sms_tmp"];
                                                $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                                                $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                if (empty($storeModel["zucp_ext"])) {
                                                    $sms_content .= "【{$config["name"]}】";
                                                } else {
                                                    $sms_content .= "【{$storeModel["name"]}】";
                                                }
                                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                if ($result === true) {
                                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
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
                                                    $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                    if (empty($storeModel["zucp_ext"])) {
                                                        $sms_content .= "【{$config["name"]}】";
                                                    } else {
                                                        $sms_content .= "【{$storeModel["name"]}】";
                                                    }
                                                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                    if ($result === true) {
                                                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($plug_rebate2) {
                            if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                                $share2_join_model = pdo_get(ztbTable("obj_survey_join", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $activity["id"], "openid" => $share_join_model["share_openid"]));
                                if (!empty($share2_join_model)) {
                                    if ($share2_join_model["openid"] != $openid && $share2_join_model["openid"] != $share_join_model["openid"]) {
                                        pdo_update(ztbTable("obj_survey_join", false), array("invite +=" => 1), array("id" => $share2_join_model["id"]));
                                        $join2UserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $share2_join_model["openid"]));
                                        $prize2List = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "place" => 1, "or_rebate2" => 1), array(), '', "sort asc");
                                        if (!empty($prize2List)) {
                                            $prize2Model = null;
                                            foreach ($prize2List as $key => $val) {
                                                if (!(intval($val["surplus"]) <= 0)) {
                                                    if (!(intval($val["odds"]) <= 0)) {
                                                        if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                                $arr2[$key] = $val["odds"];
                                                            } else {
                                                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                                if (!($count >= intval($val["limitnum"]))) {
                                                                    $arr2[$key] = $val["odds"];
                                                                } else {
                                                                }
                                                            }
                                                        } else {
                                                            $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $join2UserModel["openid"]), "count(*)");
                                                            if (!($count >= intval($val["limitnum"]))) {
                                                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                                    $arr2[$key] = $val["odds"];
                                                                } else {
                                                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                                    if (!($count >= intval($val["limitnum"]))) {
                                                                        $arr2[$key] = $val["odds"];
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
                                            if (empty($prize2Model) && !empty($arr2)) {
                                                $rid2 = getRand($arr2);
                                                $prize2Model = $prize2List[$rid2];
                                            }
                                            if (!empty($prize2Model)) {
                                                $join_draw_data2 = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prize2Model["id"], "types" => $prize2Model["types"], "name" => $prize2Model["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prize2Model["picurl"], "writeoff_types" => $prize2Model["writeoff_types"], "openid" => $join2UserModel["openid"], "nickname" => $join2UserModel["nickname"], "headurl" => $join2UserModel["headurl"], "register_data" => '', "or_rebate2" => 1, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                                                $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data2);
                                                $writecode = '';
                                                if (!empty($result)) {
                                                    $draw_id = pdo_insertid();
                                                    $hashids = Hashids::instance(6, "lywyztb", '');
                                                    $encode_id = $hashids->encode($draw_id);
                                                    $join_draw_data2 = array("writecode" => $encode_id);
                                                    pdo_update(ztbNopreTable("user_draw", false), $join_draw_data2, array("id" => $draw_id));
                                                    $writecode = $encode_id;
                                                }
                                                if (intval($prize2Model["types"]) == 1) {
                                                    if (intval($prize2Model["create_types"]) == 1) {
                                                        list($min, $max) = explode("-", $prize2Model["score"]);
                                                        $prize2Model["score"] = mt_rand($min, $max);
                                                    }
                                                    $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prize2Model["score"];
                                                    pdo_update(ztbNopreTable("user_account"), array("score +=" => $prize2Model["score"]), array("id" => $join2UserModel["id"]));
                                                    $userScoreModel = array();
                                                    $userScoreModel["uniacid"] = $uniacid;
                                                    $userScoreModel["store_id"] = $store_id;
                                                    $userScoreModel["openid"] = $join2UserModel["openid"];
                                                    $userScoreModel["nickname"] = $join2UserModel["nickname"];
                                                    $userScoreModel["headurl"] = $join2UserModel["headurl"];
                                                    $userScoreModel["types"] = 1;
                                                    $userScoreModel["activity_types"] = $activity_types;
                                                    $userScoreModel["detail_id"] = $draw_id;
                                                    $userScoreModel["score"] = $prize2Model["score"];
                                                    $userScoreModel["note"] = $note;
                                                    $userScoreModel["createtime"] = TIMESTAMP;
                                                    pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                                                    pdo_update(ztbNopreTable("user_draw"), array("score" => $prize2Model["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                } else {
                                                    if (intval($prize2Model["types"]) == 2) {
                                                        if (intval($prize2Model["create_types"]) == 1) {
                                                            list($min, $max) = explode("-", $prize2Model["sys"]);
                                                            $prize2Model["sys"] = mt_rand($min * 100, $max * 100) / 100;
                                                        }
                                                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prize2Model["sys"] . "元";
                                                        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                        if ($storeModel["money"] >= $prize2Model["sys"]) {
                                                            pdo_update(ztbNopreTable("user_account"), array("money +=" => $prize2Model["sys"]), array("id" => $join2UserModel["id"]));
                                                            $userBillModel = array();
                                                            $userBillModel["uniacid"] = $uniacid;
                                                            $userBillModel["store_id"] = $store_id;
                                                            $userBillModel["openid"] = $join2UserModel["openid"];
                                                            $userBillModel["nickname"] = $join2UserModel["nickname"];
                                                            $userBillModel["headurl"] = $join2UserModel["headurl"];
                                                            $userBillModel["types"] = 3;
                                                            $userBillModel["detail_id"] = $draw_id;
                                                            $userBillModel["money"] = $prize2Model["sys"];
                                                            $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]), "money");
                                                            $userBillModel["note"] = $note;
                                                            $userBillModel["createtime"] = TIMESTAMP;
                                                            pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                            pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["sys"])), array("id" => $store_id));
                                                            $storeBillModel = array();
                                                            $storeBillModel["uniacid"] = $uniacid;
                                                            $storeBillModel["store_id"] = $store_id;
                                                            $storeBillModel["types"] = 11;
                                                            $storeBillModel["detail_id"] = $draw_id;
                                                            $storeBillModel["money"] = $prize2Model["sys"];
                                                            $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                            $storeBillModel["note"] = $note;
                                                            $storeBillModel["createtime"] = TIMESTAMP;
                                                            pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                                        } else {
                                                            $sysReissueModel = array();
                                                            $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                            $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                            $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                            $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                            $sysReissueModel["draw_id"] = $draw_id;
                                                            $sysReissueModel["types"] = 2;
                                                            $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                            $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                            $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                            $sysReissueModel["status"] = 0;
                                                            $sysReissueModel["money"] = $prize2Model["sys"];
                                                            $sysReissueModel["desc"] = $prize2Model["name"];
                                                            $sysReissueModel["is_store_sell"] = 0;
                                                            $sysReissueModel["updatetime"] = TIMESTAMP;
                                                            $sysReissueModel["createtime"] = TIMESTAMP;
                                                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                        }
                                                        pdo_update(ztbNopreTable("user_draw"), array("sys" => $prize2Model["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                        pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prize2Model["sys"])), array("id" => $share2_join_model["id"]));
                                                    } else {
                                                        if (intval($prize2Model["types"]) == 3) {
                                                            if (intval($prize2Model["create_types"]) == 1) {
                                                                list($min, $max) = explode("-", $prize2Model["money"]);
                                                                $prize2Model["money"] = mt_rand($min * 100, $max * 100) / 100;
                                                            }
                                                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prize2Model["money"] . "元";
                                                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                            if ($storeModel["money"] >= $prize2Model["money"]) {
                                                                pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["money"])), array("id" => $store_id));
                                                                $storeBillModel = array();
                                                                $storeBillModel["uniacid"] = $uniacid;
                                                                $storeBillModel["store_id"] = $store_id;
                                                                $storeBillModel["types"] = 11;
                                                                $storeBillModel["detail_id"] = $draw_id;
                                                                $storeBillModel["money"] = $prize2Model["money"];
                                                                $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                                $storeBillModel["note"] = $note;
                                                                $storeBillModel["createtime"] = TIMESTAMP;
                                                                pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                                                $result = sendWeixinMchPay($join2UserModel["openid"], floatval($prize2Model["money"]) * 100, $prize2Model["name"], true, $uniacid, $config);
                                                                if (!($result === true)) {
                                                                    $store_config = iunserializer($storeModel["config"]);
                                                                    $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                                                                    if ($is_mchpayfail_usermoney == 0) {
                                                                        $sysReissueModel = array();
                                                                        $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                                        $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                                        $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                                        $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                                        $sysReissueModel["draw_id"] = $draw_id;
                                                                        $sysReissueModel["types"] = 1;
                                                                        $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                                        $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                                        $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                                        $sysReissueModel["status"] = 0;
                                                                        $sysReissueModel["money"] = $prize2Model["money"];
                                                                        $sysReissueModel["desc"] = $prize2Model["name"];
                                                                        $sysReissueModel["is_store_sell"] = 1;
                                                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                                    } else {
                                                                        pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]));
                                                                        $userBillModel = array();
                                                                        $userBillModel["uniacid"] = $uniacid;
                                                                        $userBillModel["store_id"] = $store_id;
                                                                        $userBillModel["openid"] = $join2UserModel["openid"];
                                                                        $userBillModel["nickname"] = $join2UserModel["nickname"];
                                                                        $userBillModel["headurl"] = $join2UserModel["headurl"];
                                                                        $userBillModel["types"] = 3;
                                                                        $userBillModel["detail_id"] = $draw_id;
                                                                        $userBillModel["money"] = $prizeModel["money"];
                                                                        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]), "money");
                                                                        $userBillModel["note"] = $note;
                                                                        $userBillModel["createtime"] = TIMESTAMP;
                                                                        pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                                    }
                                                                }
                                                            } else {
                                                                $sysReissueModel = array();
                                                                $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                                $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                                $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                                $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                                $sysReissueModel["draw_id"] = $draw_id;
                                                                $sysReissueModel["types"] = 1;
                                                                $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                                $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                                $sysReissueModel["headurl"] = $join2UserModel["headimgurl"];
                                                                $sysReissueModel["status"] = 0;
                                                                $sysReissueModel["money"] = $prize2Model["money"];
                                                                $sysReissueModel["desc"] = $prize2Model["name"];
                                                                $sysReissueModel["is_store_sell"] = 0;
                                                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                                                $sysReissueModel["createtime"] = TIMESTAMP;
                                                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                            }
                                                            pdo_update(ztbNopreTable("user_draw"), array("money" => $prize2Model["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                            pdo_update(ztbTable("obj_survey_join", false), array("money +=" => floatval($prize2Model["money"])), array("id" => $share2_join_model["id"]));
                                                        } else {
                                                            if (intval($prize2Model["types"]) == 5) {
                                                                $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prize2Model["card_id"], "status" => 1));
                                                                if (!empty($storeCard)) {
                                                                    pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prize2Model["id"]));
                                                pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                                                if (!empty($origin_id)) {
                                                    pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                                                }
                                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                if ($prize2Model["is_sms"] == 1 && $storeModel["sms"] > 0) {
                                                    if (!empty($prize2Model["sms_tmp"])) {
                                                        if (!empty($join2UserModel["mobile"])) {
                                                            $sms_uid = $config["sms_uid"];
                                                            $sms_key = $config["sms_key"];
                                                            $mobile = $join2UserModel["mobile"];
                                                            $sms_content = $prize2Model["sms_tmp"];
                                                            $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                            $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                            $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                            if (empty($storeModel["zucp_ext"])) {
                                                                $sms_content .= "【{$config["name"]}】";
                                                            } else {
                                                                $sms_content .= "【{$storeModel["name"]}】";
                                                            }
                                                            $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                            if ($result === true) {
                                                                pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                                pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    if (intval($object["is_sms"]) == 1 && $storeModel["sms"] > 0) {
                                                        if (!empty($object["sms_tmp"])) {
                                                            if (!empty($join2UserModel["mobile"])) {
                                                                $sms_uid = $config["sms_uid"];
                                                                $sms_key = $config["sms_key"];
                                                                $mobile = $join2UserModel["mobile"];
                                                                $sms_content = $object["sms_tmp"];
                                                                $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                                $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                                if (empty($storeModel["zucp_ext"])) {
                                                                    $sms_content .= "【{$config["name"]}】";
                                                                } else {
                                                                    $sms_content .= "【{$storeModel["name"]}】";
                                                                }
                                                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                                if ($result === true) {
                                                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if (empty($prizeList)) {
                    $result_data = array("status" => 1, "msg" => "恭喜您提交答题成功！", JSON_UNESCAPED_UNICODE);
                } else {
                    $result_data = array("status" => 3, "msg" => "对不起，您来晚了，奖品已发完！", JSON_UNESCAPED_UNICODE);
                }
            }
            thread_unlock($openid);
            exit(json_encode($result_data, JSON_UNESCAPED_UNICODE));
        }
    }
    thread_unlock($openid);
    exit(json_encode(array("status" => 1, "msg" => "执行完成！"), JSON_UNESCAPED_UNICODE));
}