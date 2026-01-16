<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
include MODULE_ROOT . "/inc/class/WxpayService.class.php";
include MODULE_ROOT . "/inc/class/AllinpayService.class.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "join", "help", "share", "register", "pay", "wxPay", "offlinepay", "getPayNumber", "checkPay", "detail");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 15;
$token = $_GPC["token"];
$origin_id = intval($_GPC["origin_id"]);
if (getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_shareborrow")) {
    if ($config["is_share_borrow"] == 1 && !empty($config["share_borrow_uniacid"][$activityTables[$activity_types]])) {
        $account_api = WeAccount::createByUniacid($config["share_borrow_uniacid"][$activityTables[$activity_types]]);
        $_W["account"]["jssdkconfig"] = $account_api->getJssdkConfig();
    }
}
$plug_vaptcha = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_vaptcha");
$is_vaptcha_cut = 0;
if ($plug_vaptcha) {
    $is_vaptcha_cut = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_vaptcha", "is_vaptcha_cut");
    $vaptcha_vid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_vaptcha", "vid");
}
$plug_rebate2 = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_twoinvite");
$plug_appad = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_appad");
if ($plug_appad) {
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_cut");
}
$plug_allinpay = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_allinpay");
$plug_ladder = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_ladderinvite");
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
$rategroup = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_rategroup");
$storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
$store_config = iunserializer($storeAccount["config"]);
if ($rategroup && $storeAccount["rate_group_id"] != 0) {
    $rate_group = pdo_get(ztbTable("sys_rategroup", false), array("uniacid" => $uniacid, "id" => $storeAccount["rate_group_id"]));
    if ($rate_group["status"] == 1) {
        $config["pay_rate"] = $rate_group["pay_rate"];
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
$object = pdo_get(ztbNopreTable("obj_cut"), array("deltime" => 0, "activity_id" => $activity["id"]));
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
if (!empty($originModel)) {
    $Contact_tel = $originModel["mobile"];
} else {
    if (!empty($activity["tel"])) {
        $Contact_tel = $activity["tel"];
    } else {
        if (!empty($store_config["tel"])) {
            $Contact_tel = $store_config["tel"];
        } else {
            $Contact_tel = $storeAccount["mobile"];
        }
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
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_cut_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_cut_" . $object["id"], "ad", 3600 * 24);
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
    $registerBuyFields = unserialize($object["buy_register_field"]);
    foreach ($registerBuyFields as &$item) {
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
    $registerJoinFields = unserialize($object["join_register_field"]);
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
    $registerHelpFields = unserialize($object["help_register_field"]);
    foreach ($registerHelpFields as &$item) {
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
    $store_map_list = unserialize($object["store_map_list"]);
    if (!empty($store_map_list) && is_array($store_map_list)) {
        foreach ($store_map_list as $key => $value) {
            $map_lat_lng = Convert_BD09_To_GCJ02($value["lat"], $value["lng"]);
            $store_map_list[$key]["lat"] = $map_lat_lng["lat"];
            $store_map_list[$key]["lng"] = $map_lat_lng["lng"];
        }
    }
    $joinUserList = pdo_fetchall("SELECT nickname,headurl FROM " . ztbTable("obj_cut_join") . "where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `deltime`=0  order by id desc LIMIT 14 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    if (count($joinUserList) < 14 && intval($activity["bogus_join_num"]) > 0) {
        $bogusJoinCount = 14 - count($joinUserList);
        if (14 > count($joinUserList) + intval($activity["bogus_join_num"])) {
            $bogusJoinCount = intval($activity["bogus_join_num"]);
        }
        if (intval($activity["bogus_join_gender"]) > 0) {
            $userList = pdo_fetchall("SELECT nickname,avatar FROM " . tablename("mc_members") . " where avatar<>\"\" and gender=" . $activity["bogus_join_gender"] . " order by uid desc LIMIT 29");
        } else {
            $userList = pdo_fetchall("SELECT nickname,avatar FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 29");
        }
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
    $buyUserList = pdo_getall(ztbTable("user_draw", false), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "types" => -1, "deltime" => 0), array("nickname", "headurl", "paymoney", "mymoney", "createtime"), '', "id desc", array(20));
    if (count($buyUserList) < 20 && intval($activity["bogus_buy_num"]) > 0) {
        $bogusBuyCount = 20 - count($buyUserList);
        if (20 > count($buyUserList) + intval($activity["bogus_buy_num"])) {
            $bogusBuyCount = intval($activity["bogus_buy_num"]);
        }
        if (intval($activity["bogus_buy_gender"]) > 0) {
            $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" and gender=" . $activity["bogus_buy_gender"] . " order by uid desc LIMIT 10,41");
        } else {
            $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 10,41");
        }
        foreach ($userList as $user) {
            $is_insert = true;
            foreach ($buyUserList as $buyUser) {
                if (!($buyUser["nickname"] == $user["nickname"])) {
                    if ($user["nickname"] == $userinfo["nickname"]) {
                        $is_insert = false;
                    }
                }
                $is_insert = false;
            }
            if ($is_insert) {
                $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"], "paymoney" => $object["base_price"], "mymoney" => 0, "createtime" => $activity["start_time"]);
                array_push($buyUserList, $insertUser);
                $bogusBuyCount = $bogusBuyCount - 1;
                if ($bogusBuyCount <= 0) {
                    break;
                }
            }
        }
    }
    foreach ($buyUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    if ($object["is_show_ranking"] == 1) {
        $topUserList2 = pdo_getall(ztbTable("obj_cut_join", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"]), array("nickname", "headurl", "invite", "money", "bogus_invite", "bogus_money"), '', "invite`+`bogus_invite desc,money`+`bogus_money desc", array(10));
        foreach ($topUserList2 as &$d_user) {
            $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
        }
        unset($d_user);
    }
    $isShowTopUserMoney = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("lywywl_ztb_obj_prize") . " where `uniacid`=:uniacid and store_id=:store_id and activity_id=:activity_id and status=1 and types in(2,3) and deltime=0 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"])) > 0;
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_id = $_GET["join_id"];
    $show_join_id = $join_id;
    if ($join_id) {
        $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "id" => $join_id));
        $show_join_model = $join_model;
    } else {
        $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "openid" => $openid));
    }
    if ($join_model) {
        $join_id = $join_model["id"];
        $isOwner = $join_model["openid"] == $openid;
        if ($isOwner) {
            if ($join_model["pay_status"] == 1) {
                $join_model["status"] = 1;
            }
            if ($join_model["pay_status"] == 1) {
                $drawModel = pdo_get("lywywl_ztb_user_draw", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "types" => -1, "openid" => $openid), array("id", "ordernumber", "status"));
                if ($drawModel["status"] == 1) {
                    $join_model["status"] = 2;
                }
            }
        } else {
            $my_join = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "openid" => $openid), array("id"));
        }
        $total_cut = $object["cost_price"] - $object["base_price"];
        $current_cut = $object["cost_price"] - $join_model["price"];
        $percentage = round($current_cut / ($total_cut / 100), 2);
        $helpUserList = pdo_getall(ztbTable("obj_cut_help", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $activity["id"], "join_id" => $join_model["id"]), array("openid", "nickname", "headurl", "cut_price", "createtime"), '', "id asc", array(20));
        $my_help = array_filter($helpUserList, function ($item) use($openid) {
            return $item["openid"] == $openid;
        });
        if ($my_help) {
            $object["help_is_register"] = 0;
        }
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
    if ($object["goods_num"] <= 0) {
        exit(json_encode(array("status" => 0, "msg" => "亲，您参与的活动已售尽！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["join_is_register"]) {
        $registerFields = unserialize($object["join_register_field"]);
        foreach ($registerFields as &$item) {
            if ($item["Type"] == "checkbox") {
                $item["Value"] = implode(",", $_GPC[$item["Name"]]);
            } else {
                $item["Value"] = $_GPC[$item["Name"]];
            }
            if ($item["Name"] == "Mobile" && $object["join_is_register"] != 0) {
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
    }
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $object["activity_id"], "openid" => $openid, "deltime" => 0));
    if ($join_model) {
        exit(json_encode(array("status" => 0, "msg" => "您已报名成功，邀请好友参与可获得奖励哦！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = $_GPC["join_id"];
    $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "pid" => empty($join_id) ? 0 : $join_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "price" => $object["cost_price"], "helps" => 0, "status" => 0, "invite" => 0, "money" => 0, "createtime" => TIMESTAMP);
    if ($object["join_is_register"]) {
        $registerFields = serialize($registerFields);
        $insert_join_model["register_data"] = $registerFields;
    }
    $result = pdo_insert("lywywl_ztb_obj_cut_join", $insert_join_model);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = pdo_insertid();
    $join_link = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_id), false, TRUE);
    $join_link = replaceDieDomain($config, $join_link, $user["id"], $activity["id"], $user["id"]);
    pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $activity["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
    }
    exit(json_encode(array("status" => 1, "msg" => "报名成功，即将进入专属砍价页面！", "url" => $join_link), JSON_UNESCAPED_UNICODE));
}
if ($act == "help" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if ($plug_vaptcha && $is_vaptcha_cut == 1 && $object["help_is_register"] == 0) {
        $verify_token = trim($_GPC["verify_token"]);
        if (empty($verify_token)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "请通过人机验证后帮TA砍价！"), JSON_UNESCAPED_UNICODE));
        }
        if (!vaptcha_verify($verify_token, 3)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "请通过人机验证后帮TA砍价！"), JSON_UNESCAPED_UNICODE));
        }
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
    if ($object["help_is_register"]) {
        $registerFields = unserialize($object["help_register_field"]);
        foreach ($registerFields as &$item) {
            if ($item["Type"] == "checkbox") {
                $item["Value"] = implode(",", $_GPC[$item["Name"]]);
            } else {
                $item["Value"] = $_GPC[$item["Name"]];
            }
            if ($item["Name"] == "Mobile" && $object["help_is_register"] != 0) {
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
    }
    $join_id = $_GPC["join_id"];
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_id, "deltime" => 0));
    if (empty($join_model)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "帮助的砍价信息不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if ($join_model["status"]) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "已经完成任务，无须减价。"), JSON_UNESCAPED_UNICODE));
    }
    if ($join_model["pay_status"]) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "已经支付，无须减价。"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["cutmaxnum"] > 0) {
        $help_count = pdo_count(ztbNopreTable("obj_cut_help"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
        if ($help_count > $object["cutmaxnum"]) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "您帮助的人数已经达到上限了！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $help_model = pdo_get("lywywl_ztb_obj_cut_help", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "join_id" => $join_model["id"], "openid" => $openid, "deltime" => 0));
    if ($help_model) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "tip" => "share", "msg" => "您已经减价过了！"), JSON_UNESCAPED_UNICODE));
    }
    if ($join_model["price"] <= $object["base_price"]) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "减价已经达到底价！"), JSON_UNESCAPED_UNICODE));
    }
    $object["cut_rule"] = unserialize($object["cut_rule"]);
    $cut_rule = get_random_cut_rule($join_model["price"], $object["cut_rule"]);
    $cut = $cut_rule["money"];
    if ($cut > $join_model["price"] - $object["base_price"]) {
        $cut = $join_model["price"] - $object["base_price"];
    }
    $cut = round($cut, 2);
    $insert_help_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "join_id" => $join_model["id"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "sex" => $userinfo["sex"], "area" => $userinfo["country"] . "," . $userinfo["province"] . "," . $userinfo["city"], "ip" => $_W["clientip"], "join_openid" => $join_model["openid"], "join_nickname" => $join_model["nickname"], "join_headurl" => $join_model["headurl"], "cut_price" => $cut, "createtime" => TIMESTAMP);
    if ($object["help_is_register"]) {
        $registerFields = serialize($registerFields);
        $insert_help_model["register_data"] = $registerFields;
    }
    $result = pdo_insert("lywywl_ztb_obj_cut_help", $insert_help_model);
    if (empty($result)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因砍价失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $update_data = array("price -=" => $cut, "helps +=" => 1);
    if (round(($join_model["price"] - $object["base_price"]) * 100) == round($cut * 100)) {
        $update_data["status"] = 1;
    }
    pdo_update(ztbTable("obj_cut_join", false), $update_data, array("id" => $join_model["id"], "price >" => $object["base_price"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("cut_help_num +=" => 1), array("id" => $origin_id));
    }
    thread_unlock($openid);
    exit(json_encode(array("status" => 1, "msg" => "砍价成功！", "cut_price" => $cut), JSON_UNESCAPED_UNICODE));
}
if ($act == "share" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if (empty($join_model)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，请参与活动后查看专属二维码！"), JSON_UNESCAPED_UNICODE));
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
            pdo_update(ztbTable("obj_cut_join", false), array("qrcode_url" => $file_path), array("id" => $join_model["id"]));
            exit(json_encode(array("status" => 1, "msg" => "恭喜您,专属海报创建成功！", "path" => $file_path), JSON_UNESCAPED_UNICODE));
        } else {
            exit(json_encode(array("status" => 0, "msg" => "二维码生成失败，请稍后重试！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        exit(json_encode(array("status" => 1, "msg" => "恭喜您，专属海报创建成功！", "path" => $join_model["qrcode_url"]), JSON_UNESCAPED_UNICODE));
    }
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
    $registerFields = unserialize($object["buy_register_field"]);
    foreach ($registerFields as &$item) {
        if ($item["Type"] == "checkbox") {
            $item["Value"] = implode(",", $_GPC[$item["Name"]]);
        } else {
            $item["Value"] = $_GPC[$item["Name"]];
        }
        if ($item["Name"] == "Mobile" && $object["buy_is_register"] != 0) {
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
    if ($object["goods_num"] <= 0) {
        exit(json_encode(array("status" => 0, "msg" => "亲，您参与的活动已售尽！"), JSON_UNESCAPED_UNICODE));
    }
    isetcookie("reg_objcut_" . $object["id"], base64_encode(serialize($registerFields)), 3600 * 24);
    exit(json_encode(array("status" => 1, "msg" => "登记成功！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "pay") {
    $join_id = $_GPC["join_id"];
    if ($activity["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！", 1);
    }
    if ($activity["end_time"] < TIMESTAMP) {
        tip_redirect("亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！", 1);
    }
    $register_data = $_GPC["reg_objcut_" . $object["id"]];
    if (empty($register_data) && $object["buy_is_register"] == 1) {
        tip_redirect("对不起，请先登记后在参与活动！");
    }
    $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "deltime" => 0));
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($join_model) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/pay");
    exit;
}
if ($act == "wxPay") {
    $pay_number = $_GPC["pay_number"];
    $payModel = pdo_get(ztbTable("sys_pay", false), array("paynumber" => $pay_number, "openid" => $openid, "uniacid" => $uniacid, "deltime" => 0));
    if ($plug_allinpay) {
        $plug_allinpay_cusid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "cusid");
        $plug_allinpay_appid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "appid");
        $plug_allinpay_appkey = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "appkey");
        $allinPay = new AllinPayService(["cusid" => $plug_allinpay_cusid, "appid" => $plug_allinpay_appid, "appkey" => $plug_allinpay_appkey]);
        $order = array();
        $order["openid"] = $_W["openid"];
        $order["trxamt"] = $payModel["paymoney"];
        $order["reqsn"] = $payModel["paynumber"];
        $order["body"] = (strlen($activity["title"]) > 90 ? mb_strcut($activity["title"], 0, 90, "utf-8") . "..." : $activity["title"]) . "[电话]" . $Contact_tel;
        $order["body"] = str_replace("+", " ", $order["body"]);
        $order["remark"] = '';
        $order["front_url"] = $_W["siteroot"] . "addons/lywywl_ztb/allinpay_return.php";
        $order["notify_url"] = $_W["siteroot"] . "addons/lywywl_ztb/wxpay_notify.php";
        $jsApiParameters = $allinPay->WechatJsapiPay($order);
    } else {
        $appid = $config["appid"];
        $mchid = $config["mchid"];
        $apiKey = $config["password"];
        $wxPay = new WxpayService($mchid, $appid, $apiKey);
        $outTradeNo = $payModel["paynumber"];
        $payAmount = $payModel["paymoney"];
        $orderName = (strlen($activity["title"]) > 90 ? mb_strcut($activity["title"], 0, 90, "utf-8") . "..." : $activity["title"]) . "[电话]" . $Contact_tel;
        $notifyUrl = $_W["siteroot"] . "addons/lywywl_ztb/wxpay_notify.php";
        $payTime = time();
        $jsApiParameters = $wxPay->createJsBizPackage_JSAPI($_W["openid"], $payAmount, $outTradeNo, $orderName, $notifyUrl, $payTime);
        $jsApiParameters = json_encode($jsApiParameters);
    }
    include $this->template("tmp/" . $tmp["resource"] . "/wxPay");
    exit;
}
if ($act == "offlinepay" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = $_GPC["join_id"];
    $use_sys_Money = $_GPC["use_sys_Money"];
    if ($activity["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = $_GPC["reg_objcut_" . $object["id"]];
    if (empty($register_data) && $object["buy_is_register"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["goods_num"] <= 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，您参与的活动已售尽！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_id, "deltime" => 0));
    if (empty($join_model)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "参与信息不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if ($join_model["pay_status"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "商品已购买，无需重复购买！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["is_base_price_pay"] == 1 && $join_model["price"] != $object["base_price"]) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "未到底价不能支付！"), JSON_UNESCAPED_UNICODE));
    }
    $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $storeConfig = getStoreConfig($uniacid, $store_id);
    if ($join_model["pid"] > 0) {
        $joinModel = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_model["pid"], "deltime" => 0));
    }
    $origin_buy_types = 0;
    if (!empty($origin_id)) {
        if ($joinModel["openid"] == $originModel["openid"]) {
            $origin_buy_types = 1;
            pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => 1), array("id" => $origin_id));
        }
    }
    $expires_time = 0;
    if ($object["expires_types"] == 1) {
        $expires_time = $object["expires_day"] * 24 * 60 * 60 + time();
    } else {
        if ($object["expires_types"] == 2) {
            $expires_time = $object["expires_time"];
        }
    }
    $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "origin_buy_types" => $origin_buy_types, "prize_id" => 0, "types" => -1, "name" => $activity["title"], "pay_openid" => $joinModel["openid"], "pay_nickname" => $joinModel["nickname"], "pay_headurl" => $joinModel["headurl"], "pay_number" => getOrderNumber(), "paymoney" => 0, "mymoney" => 0, "endmoney" => 0, "is_settlement" => 1, "prize_pic_url" => $activity["pic_url"], "writeoff_types" => $object["is_fedex"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
    isetcookie("reg_objcut_" . $object["id"], '', -3600 * 24);
    $result = pdo_insert(ztbTable("user_draw", false), $draw_data);
    $writecode = '';
    if (!empty($result)) {
        $draw_id = pdo_insertid();
        $hashids = Hashids::instance(6, "lywyztb", '');
        $encode_id = $hashids->encode($draw_id);
        $code_draw_data = array("writecode" => $encode_id);
        pdo_update(ztbTable("user_draw", false), $code_draw_data, array("id" => $draw_id));
        $writecode = $encode_id;
    }
    pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => 1), array("id" => $activity["id"]));
    pdo_update(ztbTable("obj_cut", false), array("goods_num -=" => 1), array("id" => $object["id"]));
    pdo_update(ztbTable("obj_cut_join", false), array("pay_status" => 1), array("id" => $join_model["id"]));
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
    if (intval($object["buy_is_sms"]) == 1 && $storeModel["sms"] > 0) {
        if (!empty($object["buy_sms_tmp"])) {
            if (!empty($userModel["mobile"])) {
                $sms_uid = $config["sms_uid"];
                $sms_key = $config["sms_key"];
                $mobile = $userModel["mobile"];
                $sms_content = $object["buy_sms_tmp"];
                $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                $sms_content = str_replace("{PRIZE}", $draw_data["name"], $sms_content);
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
                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "购买通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                }
            }
        }
    }
    if ($config["orderpushtmp"] && $storeModel["openid"]) {
        if (isFollow($storeModel["openid"], $uniacid)) {
            $postdata = array("first" => array("value" => "{$storeModel["name"]}，您的活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword2" => array("value" => $activity["title"], "color" => "#173177"), "keyword3" => array("value" => $join_model["price"] . "元", "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看订单详情", "color" => "#173177"));
            $url = replaceDieDomain($config, __MURL("store.obj_cut_pay", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
            $template_id = $config["orderpushtmp"];
            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
        }
    }
    if ($config["orderpushtmp_sub"] && $storeModel["openid"]) {
        $touser = $storeModel["openid"];
        $template_id = $config["orderpushtmp_sub"];
        $postdata = array("thing13" => array("value" => $activity["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $join_model["price"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
        $url = replaceDieDomain($config, __MURL("store.obj_cut_pay", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
    }
    if ($config["originpushtmp"] && !empty($origin_id)) {
        if (isFollow($originModel["openid"], $uniacid)) {
            $postdata = array("first" => array("value" => "{$originModel["name"]}，您参与的溯源活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $join_model["price"] . "元", "color" => "#173177"), "keyword2" => array("value" => $activity["title"], "color" => "#173177"), "keyword3" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看溯源统计数据", "color" => "#173177"));
            $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
            $template_id = $config["originpushtmp"];
            $result = sendTplNotice($uniacid, $originModel["openid"], $postdata, $template_id, $url);
        }
    }
    if ($config["orderpushtmp_sub"] && !empty($origin_id)) {
        $touser = $originModel["openid"];
        $template_id = $config["orderpushtmp_sub"];
        $postdata = array("thing13" => array("value" => $activity["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $join_model["price"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
        $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
    }
    thread_unlock($openid);
    resultMsg(["status" => 1, "ispay" => 0, "pay_number" => $draw_data["pay_number"], "pay_price" => $join_model["price"], "msg" => "请求成功！"]);
}
if ($act == "getPayNumber" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = $_GPC["join_id"];
    $use_sys_Money = $_GPC["use_sys_Money"];
    if ($activity["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = $_GPC["reg_objcut_" . $object["id"]];
    if (empty($register_data) && $object["buy_is_register"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["goods_num"] <= 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，您参与的活动已售尽！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_id, "deltime" => 0));
    if (empty($join_model)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "参与信息不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if ($join_model["pay_status"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "商品已购买，无需重复购买！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["is_base_price_pay"] == 1 && $join_model["price"] != $object["base_price"]) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "未到底价不能支付！"), JSON_UNESCAPED_UNICODE));
    }
    $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $storeConfig = getStoreConfig($uniacid, $store_id);
    $is_pay = true;
    if (floatval($object["base_price"]) <= 0 && $object["base_price"] == $join_model["price"]) {
        $is_pay = false;
    }
    $user_money = $userModel["money"];
    if ($use_sys_Money === "true" && $join_model["price"] <= $user_money) {
        $is_pay = false;
    }
    if ($storeConfig["is_money_obj"] == 0 && $use_sys_Money === "true") {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与活动不可使用账户余额！"), JSON_UNESCAPED_UNICODE));
    }
    if ($is_pay) {
        $payModel = array();
        $payModel["uniacid"] = $uniacid;
        $payModel["store_id"] = $store_id;
        $payModel["pay_method"] = 1;
        $payModel["terminal"] = 1;
        $payModel["types"] = 3;
        $payModel["data"] = "{$token},{$join_id},{$origin_id}";
        $payModel["openid"] = $openid;
        $payModel["nickname"] = $userinfo["nickname"];
        $payModel["headurl"] = $userinfo["headimgurl"];
        $payModel["paynumber"] = getOrderNumber();
        if ($use_sys_Money == true) {
            if ($use_sys_Money === "true") {
                $payModel["paymoney"] = floatval($join_model["price"] - $user_money);
                $payModel["mymoney"] = $user_money;
            } else {
                $payModel["paymoney"] = floatval($join_model["price"]);
                $payModel["mymoney"] = 0;
            }
        } else {
            $payModel["paymoney"] = floatval($join_model["price"]);
            $payModel["mymoney"] = 0;
        }
        $payModel["endmoney"] = $payModel["paymoney"] + $payModel["mymoney"] - round($payModel["paymoney"] * $config["pay_rate"] / 100, 2);
        $payModel["note"] = $register_data;
        $payModel["status"] = 0;
        $payModel["updatetime"] = TIMESTAMP;
        $payModel["createtime"] = TIMESTAMP;
        $payModel["activity_id"] = $activity["id"];
        pdo_insert(ztbTable("sys_pay", false), $payModel);
        if (empty($config["pay_domain"])) {
            if ($plug_allinpay) {
                $plug_allinpay_cusid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "cusid");
                $plug_allinpay_appid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "appid");
                $plug_allinpay_appkey = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "appkey");
                $allinPay = new AllinPayService(["cusid" => $plug_allinpay_cusid, "appid" => $plug_allinpay_appid, "appkey" => $plug_allinpay_appkey]);
                $order = array();
                $order["openid"] = $_W["openid"];
                $order["trxamt"] = $payModel["paymoney"];
                $order["reqsn"] = $payModel["paynumber"];
                $order["body"] = (strlen($activity["title"]) > 90 ? mb_strcut($activity["title"], 0, 90, "utf-8") . "..." : $activity["title"]) . "[电话]" . $Contact_tel;
                $order["body"] = str_replace("+", " ", $order["body"]);
                $order["remark"] = '';
                $order["front_url"] = $_W["siteroot"] . "addons/lywywl_ztb/allinpay_return.php";
                $order["notify_url"] = $_W["siteroot"] . "addons/lywywl_ztb/wxpay_notify.php";
                $jsApiParameters = $allinPay->WechatJsapiPay($order);
            } else {
                $appid = $config["appid"];
                $mchid = $config["mchid"];
                $apiKey = $config["password"];
                $wxPay = new WxpayService($mchid, $appid, $apiKey);
                $outTradeNo = $payModel["paynumber"];
                $payAmount = $payModel["paymoney"];
                $orderName = (strlen($activity["title"]) > 90 ? mb_strcut($activity["title"], 0, 90, "utf-8") . "..." : $activity["title"]) . "[电话]" . $Contact_tel;
                $notifyUrl = $_W["siteroot"] . "addons/lywywl_ztb/wxpay_notify.php";
                $payTime = time();
                $jsApiParameters = $wxPay->createJsBizPackage_JSAPI($_W["openid"], $payAmount, $outTradeNo, $orderName, $notifyUrl, $payTime);
                $jsApiParameters = json_encode($jsApiParameters);
            }
        }
        thread_unlock($openid);
        resultMsg(["status" => 1, "ispay" => 1, "jsApiData" => $jsApiParameters, "pay_number" => $payModel["paynumber"], "pay_price" => $payModel["paymoney"], "msg" => "请求成功！"]);
    } else {
        if ($join_model["pid"] > 0) {
            $joinModel = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_model["pid"], "deltime" => 0));
        }
        $origin_buy_types = 0;
        if (!empty($origin_id)) {
            if ($joinModel["openid"] == $originModel["openid"]) {
                $origin_buy_types = 1;
                pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => 1), array("id" => $origin_id));
            }
        }
        $payModel = array();
        $payModel["uniacid"] = $uniacid;
        $payModel["store_id"] = $store_id;
        $payModel["pay_method"] = 0;
        $payModel["terminal"] = 1;
        $payModel["types"] = 3;
        $payModel["data"] = "{$token},{$join_id},{$origin_id}";
        $payModel["openid"] = $openid;
        $payModel["nickname"] = $userinfo["nickname"];
        $payModel["headurl"] = $userinfo["headimgurl"];
        $payModel["paynumber"] = getOrderNumber();
        $payModel["paymoney"] = 0;
        $payModel["mymoney"] = $join_model["price"];
        $payModel["endmoney"] = $join_model["price"];
        $payModel["note"] = '';
        $payModel["status"] = 1;
        $payModel["updatetime"] = TIMESTAMP;
        $payModel["createtime"] = TIMESTAMP;
        $payModel["activity_id"] = $activity["id"];
        pdo_insert(ztbTable("sys_pay", false), $payModel);
        $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "origin_buy_types" => $origin_buy_types, "prize_id" => 0, "types" => -1, "name" => $activity["title"], "pay_openid" => $joinModel["openid"], "pay_nickname" => $joinModel["nickname"], "pay_headurl" => $joinModel["headurl"], "pay_number" => $payModel["paynumber"], "paymoney" => 0, "mymoney" => $join_model["price"], "endmoney" => $join_model["price"], "is_settlement" => $config["store_settlement_types"] == 1 ? 0 : 1, "prize_pic_url" => $activity["pic_url"], "writeoff_types" => $object["is_fedex"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
        if ($object["models"] != 3) {
            if ($object["expires_types"] == 1) {
                $expires_time = $object["expires_day"] * 24 * 60 * 60 + time();
            } else {
                if ($object["expires_types"] == 2) {
                    $expires_time = $object["expires_time"];
                }
            }
            $draw_data["expires_time"] = $expires_time;
        }
        if ($object["models"] == 2) {
            $models_qr_content = unserialize($object["models_qr_content"]);
            if ($object["models_qr_types"] == 0) {
                foreach ($models_qr_content as $key => $val) {
                    if ($val["Count"] == -1 || $val["Count"] > $val["Use"]) {
                        $draw_data["group_name"] = $val["Name"];
                        $draw_data["group_qrcode"] = $val["Pic"];
                        $models_qr_content[$key]["Use"] = intval($val["Use"]) + 1;
                        pdo_update(ztbNopreTable("obj_cut"), array("models_qr_content" => iserializer($models_qr_content)), array("id" => $object["id"]));
                    }
                }
            } else {
                $opt_qr_content = array();
                foreach ($models_qr_content as $key => $val) {
                    if ($val["Count"] == -1 || $val["Count"] > $val["Use"]) {
                        $val["index"] = $key;
                        $opt_qr_content[] = $val;
                    }
                }
                $opt_key = array_rand($opt_qr_content);
                $draw_data["group_name"] = $opt_qr_content[$opt_key]["Name"];
                $draw_data["group_qrcode"] = $opt_qr_content[$opt_key]["Pic"];
                $models_qr_content[$opt_qr_content[$opt_key]["index"]]["Use"] = intval($opt_qr_content[$opt_key]["Use"]) + 1;
                pdo_update(ztbNopreTable("obj_cut"), array("models_qr_content" => iserializer($models_qr_content)), array("id" => $object["id"]));
            }
        }
        if ($object["models"] == 3) {
            $draw_data["status"] = 1;
            $draw_data["is_settlement"] = 1;
        }
        isetcookie("reg_objcut_" . $object["id"], '', -3600 * 24);
        $result = pdo_insert(ztbTable("user_draw", false), $draw_data);
        $writecode = '';
        if (!empty($result)) {
            $draw_id = pdo_insertid();
            $hashids = Hashids::instance(6, "lywyztb", '');
            $encode_id = $hashids->encode($draw_id);
            $code_draw_data = array("writecode" => $encode_id);
            pdo_update(ztbTable("user_draw", false), $code_draw_data, array("id" => $draw_id));
            $writecode = $encode_id;
        }
        pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => 1), array("id" => $activity["id"]));
        pdo_update(ztbTable("obj_cut", false), array("goods_num -=" => 1), array("id" => $object["id"]));
        pdo_update(ztbTable("obj_cut_join", false), array("pay_status" => 1), array("id" => $join_model["id"]));
        if (!empty($origin_id)) {
            pdo_update(ztbNopreTable("marketing_user"), array("marketing_num +=" => 1), array("id" => $origin_id));
        }
        pdo_update(ztbTable("user_account", false), array("money -=" => $join_model["price"]), array("id" => $userModel["id"]));
        $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，支付金额：" . floatval($join_model["price"]) . "元";
        $userBillModel = array();
        $userBillModel["uniacid"] = $uniacid;
        $userBillModel["store_id"] = $store_id;
        $userBillModel["openid"] = $openid;
        $userBillModel["nickname"] = $userinfo["nickname"];
        $userBillModel["headurl"] = $userinfo["headimgurl"];
        $userBillModel["types"] = 2;
        $userBillModel["detail_id"] = $draw_id;
        $userBillModel["money"] = $join_model["price"];
        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
        $userBillModel["note"] = $note;
        $userBillModel["createtime"] = TIMESTAMP;
        pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
        if ($config["store_settlement_types"] != 1 || $object["models"] == 3) {
            pdo_update(ztbNopreTable("store_account"), array("money +=" => floatval($join_model["price"])), array("id" => $store_id));
            $storeBillModel = array();
            $storeBillModel["uniacid"] = $uniacid;
            $storeBillModel["store_id"] = $store_id;
            $storeBillModel["types"] = 12;
            $storeBillModel["detail_id"] = $draw_id;
            $storeBillModel["money"] = $join_model["price"];
            $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
            $storeBillModel["note"] = $note;
            $storeBillModel["createtime"] = TIMESTAMP;
            pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
        }
        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
        if (intval($object["buy_is_sms"]) == 1 && $storeModel["sms"] > 0) {
            if (!empty($object["buy_sms_tmp"])) {
                if (!empty($userModel["mobile"])) {
                    $sms_uid = $config["sms_uid"];
                    $sms_key = $config["sms_key"];
                    $mobile = $userModel["mobile"];
                    $sms_content = $object["buy_sms_tmp"];
                    $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                    $sms_content = str_replace("{PRIZE}", $draw_data["name"], $sms_content);
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
                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "购买通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                    }
                }
            }
        }
        if ($config["orderpushtmp"] && $storeModel["openid"]) {
            if (isFollow($storeModel["openid"], $uniacid)) {
                $postdata = array("first" => array("value" => "{$storeModel["name"]}，您的活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword2" => array("value" => $activity["title"], "color" => "#173177"), "keyword3" => array("value" => $join_model["price"] . "元", "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看订单详情", "color" => "#173177"));
                $url = replaceDieDomain($config, __MURL("store.obj_cut_pay", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
                $template_id = $config["orderpushtmp"];
                $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
            }
        }
        if ($config["orderpushtmp_sub"] && $storeModel["openid"]) {
            $touser = $storeModel["openid"];
            $template_id = $config["orderpushtmp_sub"];
            $postdata = array("thing13" => array("value" => $activity["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $join_model["price"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
            $url = replaceDieDomain($config, __MURL("store.obj_cut_pay", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
            $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
        }
        if ($config["originpushtmp"] && !empty($origin_id)) {
            if (isFollow($originModel["openid"], $uniacid)) {
                $postdata = array("first" => array("value" => "{$originModel["name"]}，您参与的溯源活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $join_model["price"] . "元", "color" => "#173177"), "keyword2" => array("value" => $activity["title"], "color" => "#173177"), "keyword3" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看溯源统计数据", "color" => "#173177"));
                $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
                $template_id = $config["originpushtmp"];
                $result = sendTplNotice($uniacid, $originModel["openid"], $postdata, $template_id, $url);
            }
        }
        if ($config["orderpushtmp_sub"] && !empty($origin_id)) {
            $touser = $originModel["openid"];
            $template_id = $config["orderpushtmp_sub"];
            $postdata = array("thing13" => array("value" => $activity["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $join_model["price"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
            $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
            $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
        }
        if ($join_model["pid"] > 0) {
            if ($joinModel["openid"] != $openid) {
                $params = ["uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "origin_id" => $origin_id, "object" => $object, "originModel" => $originModel, "userModel" => $userModel, "activity" => isset($activity) ? $activity : $object, "objJoinTableName" => "obj_cut_join"];
                pdo_update(ztbTable("obj_cut_join", false), array("invite +=" => 1), array("id" => $joinModel["id"]));
                $joinUserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $joinModel["openid"]));
                $whereArray = array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1);
                if (isset($object["or_open_ladder"])) {
                    $whereArray["or_ladder"] = 0;
                }
                if (isset($object["or_open_rebate2"])) {
                    $whereArray["or_rebate2"] = 0;
                }
                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), $whereArray, array(), '', "sort asc");
                $params["joinModel"] = $joinModel;
                $params["joinUserModel"] = $joinUserModel;
                $params["prizeList"] = $prizeList;
                $params["rebateMethod"] = "rebate";
                rebatePrize($params);
                if ($plug_ladder) {
                    if (isset($object["or_open_ladder"]) && $object["or_open_ladder"] == 1) {
                        $joinInvite = intval($joinModel["invite"]) + 1;
                        $or_open_unfixed = trim($object["or_open_unfixed"]);
                        $ladder_fixed_num = intval($object["ladder_fixed_num"]);
                        $is_ladder = false;
                        if ($or_open_unfixed == 0) {
                            if ($joinInvite > 0 && $ladder_fixed_num > 0 && $joinInvite % $ladder_fixed_num == 0) {
                                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_ladder" => 1), array(), '', "sort asc");
                                $is_ladder = true;
                            }
                        } else {
                            if ($joinInvite > 0) {
                                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_ladder" => 1, "ladder_num" => $joinInvite), array(), '', "sort asc");
                                $is_ladder = true;
                            }
                        }
                        if ($is_ladder == true) {
                            $params["prizeList"] = $prizeList;
                            $params["rebateMethod"] = "ladder";
                            rebatePrize($params);
                        }
                    }
                }
            }
            if ($plug_rebate2) {
                if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                    $draw2Model = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "uniacid" => $uniacid, "activity_id" => $activity["id"], "pay_openid" => $joinModel["openid"], "or_rebate2" => 0, "types >" => 0));
                    if (!empty($draw2Model)) {
                        $join2Model = pdo_get(ztbTable("obj_cut_join", false), array("uniacid" => $uniacid, "activity_id" => $activity["id"], "openid" => $draw2Model["openid"]));
                        if (!empty($join2Model)) {
                            if ($join2Model["openid"] != $openid && $join2Model["openid"] != $joinModel["openid"]) {
                                pdo_update(ztbTable("obj_cut_join", false), array("invite +=" => 1), array("id" => $join2Model["id"]));
                                $join2UserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $join2Model["openid"]));
                                $prize2List = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_rebate2" => 1), array(), '', "sort asc");
                                $params["joinModel"] = $join2Model;
                                $params["joinUserModel"] = $join2UserModel;
                                $params["prizeList"] = $prize2List;
                                $params["rebateMethod"] = "rebate2";
                                rebatePrize($params);
                            }
                        }
                    }
                }
            }
        }
        thread_unlock($openid);
        resultMsg(["status" => 1, "ispay" => 0, "pay_number" => $draw_data["pay_number"], "pay_price" => $join_model["price"], "msg" => "请求成功！"]);
    }
}
if ($act == "checkPay") {
    $pay_number = $_GPC["pay_number"];
    $payModel = pdo_get(ztbTable("sys_pay", false), array("paynumber" => $pay_number, "openid" => $openid, "uniacid" => $uniacid, "deltime" => 0));
    if (!empty($payModel)) {
        cache_write("lywywl_ztb_checkpay_cache" . $_W["uniacid"], "true");
        if (intval($payModel["status"]) == 0) {
            if ($plug_allinpay) {
                $plug_allinpay_cusid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "cusid");
                $plug_allinpay_appid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "appid");
                $plug_allinpay_appkey = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_allinpay", "appkey");
                $allinPay = new AllinPayService(["cusid" => $plug_allinpay_cusid, "appid" => $plug_allinpay_appid, "appkey" => $plug_allinpay_appkey]);
                $result = $allinPay->QueryOrder($payModel["paynumber"]);
                $success = !empty($result);
                $paymoney = intval($result["trxamt"]);
            } else {
                $appid = $config["appid"];
                $mchid = $config["mchid"];
                $apiKey = $config["password"];
                $outTradeNo = $payModel["paynumber"];
                $wxPay = new WxpayService($mchid, $appid, $apiKey);
                $result = $wxPay->orderquery($outTradeNo);
                $success = intval($result["code"]) == 0;
                $paymoney = intval($result["paymoney"]);
            }
            if ($success && intval(strval($payModel["paymoney"] * 100)) == $paymoney) {
                $register_data = $payModel["note"];
                $dataarr = explode(",", $payModel["data"]);
                $payToken = $dataarr[0];
                $join_id = $dataarr[1];
                $origin_id = intval($dataarr[2]);
                if ($payToken == $token) {
                    pdo_update(ztbTable("sys_pay", false), array("status" => 1, "note" => json_encode($result), "updatetime" => time()), array("id" => $payModel["id"]));
                    $userModel = pdo_get(ztbtable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
                    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_id, "deltime" => 0));
                    if (empty($join_model)) {
                        tip_redirect("对不起，没有查询到您的支付信息！");
                    }
                    if ($join_model["pid"] > 0) {
                        $joinModel = pdo_get(ztbTable("obj_cut_join", false), array("uniacid" => $uniacid, "id" => $join_model["pid"]));
                    }
                    $origin_buy_types = 0;
                    if (!empty($origin_id)) {
                        if ($joinModel["openid"] == $originModel["openid"]) {
                            $origin_buy_types = 1;
                            pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => 1), array("id" => $origin_id));
                        }
                    }
                    $expires_time = 0;
                    if ($object["models"] != 3) {
                        if ($object["expires_types"] == 1) {
                            $expires_time = $object["expires_day"] * 24 * 60 * 60 + time();
                        } else {
                            if ($object["expires_types"] == 2) {
                                $expires_time = $object["expires_time"];
                            }
                        }
                    }
                    $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "origin_buy_types" => $origin_buy_types, "prize_id" => 0, "types" => -1, "name" => $activity["title"], "pay_openid" => $joinModel["openid"], "pay_nickname" => $joinModel["nickname"], "pay_headurl" => $joinModel["headurl"], "pay_number" => $payModel["paynumber"], "paymoney" => $payModel["paymoney"], "mymoney" => $payModel["mymoney"], "endmoney" => $payModel["endmoney"], "is_settlement" => $config["store_settlement_types"] == 1 ? 0 : 1, "prize_pic_url" => $activity["pic_url"], "writeoff_types" => $object["is_fedex"], "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                    if ($object["models"] == 2) {
                        $models_qr_content = unserialize($object["models_qr_content"]);
                        if ($object["models_qr_types"] == 0) {
                            foreach ($models_qr_content as $key => $val) {
                                if ($val["Count"] == -1 || $val["Count"] > $val["Use"]) {
                                    $draw_data["group_name"] = $val["Name"];
                                    $draw_data["group_qrcode"] = $val["Pic"];
                                    $models_qr_content[$key]["Use"] = intval($val["Use"]) + 1;
                                    pdo_update(ztbNopreTable("obj_cut"), array("models_qr_content" => iserializer($models_qr_content)), array("id" => $object["id"]));
                                }
                            }
                        } else {
                            $opt_qr_content = array();
                            foreach ($models_qr_content as $key => $val) {
                                if ($val["Count"] == -1 || $val["Count"] > $val["Use"]) {
                                    $val["index"] = $key;
                                    $opt_qr_content[] = $val;
                                }
                            }
                            $opt_key = array_rand($opt_qr_content);
                            $draw_data["group_name"] = $opt_qr_content[$opt_key]["Name"];
                            $draw_data["group_qrcode"] = $opt_qr_content[$opt_key]["Pic"];
                            $models_qr_content[$opt_qr_content[$opt_key]["index"]]["Use"] = intval($opt_qr_content[$opt_key]["Use"]) + 1;
                            pdo_update(ztbNopreTable("obj_cut"), array("models_qr_content" => iserializer($models_qr_content)), array("id" => $object["id"]));
                        }
                    }
                    if ($object["models"] == 3) {
                        $draw_data["status"] = 1;
                        $draw_data["is_settlement"] = 1;
                    }
                    isetcookie("reg_objcut_" . $object["id"], '', -3600 * 24);
                    $result = pdo_insert(ztbTable("user_draw", false), $draw_data);
                    $writecode = '';
                    if (!empty($result)) {
                        $draw_id = pdo_insertid();
                        $hashids = Hashids::instance(6, "lywyztb", '');
                        $encode_id = $hashids->encode($draw_id);
                        $code_draw_data = array("writecode" => $encode_id);
                        pdo_update(ztbTable("user_draw", false), $code_draw_data, array("id" => $draw_id));
                        $writecode = $encode_id;
                    }
                    pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => 1), array("id" => $activity["id"]));
                    pdo_update(ztbTable("obj_cut", false), array("goods_num -=" => 1), array("id" => $object["id"]));
                    pdo_update(ztbTable("obj_cut_join", false), array("pay_status" => 1), array("id" => $join_model["id"]));
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable("marketing_user"), array("marketing_num +=" => 1), array("id" => $origin_id));
                    }
                    pdo_update(ztbTable("user_account", false), array("money +=" => $payModel["paymoney"]), array("id" => $userModel["id"]));
                    $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，充值金额：" . floatval($payModel["paymoney"]) . "元";
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $userModel["openid"];
                    $userBillModel["nickname"] = $userModel["nickname"];
                    $userBillModel["headurl"] = $userModel["headurl"];
                    $userBillModel["types"] = 1;
                    $userBillModel["detail_id"] = $draw_id;
                    $userBillModel["money"] = $payModel["paymoney"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                    pdo_update(ztbTable("user_account", false), array("money -=" => $join_model["price"]), array("id" => $userModel["id"]));
                    $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，支付金额：" . floatval($join_model["price"]) . "元";
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $userModel["openid"];
                    $userBillModel["nickname"] = $userModel["nickname"];
                    $userBillModel["headurl"] = $userModel["headurl"];
                    $userBillModel["types"] = 2;
                    $userBillModel["detail_id"] = $draw_id;
                    $userBillModel["money"] = $join_model["price"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                    if ($config["store_settlement_types"] != 1 || $object["models"] == 3) {
                        pdo_update(ztbNopreTable("store_account"), array("money +=" => floatval($payModel["endmoney"])), array("id" => $store_id));
                        $storeBillModel = array();
                        $storeBillModel["uniacid"] = $uniacid;
                        $storeBillModel["store_id"] = $store_id;
                        $storeBillModel["types"] = 12;
                        $storeBillModel["detail_id"] = $draw_id;
                        $storeBillModel["money"] = $payModel["endmoney"];
                        $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                        $storeBillModel["note"] = $note;
                        $storeBillModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                    }
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                    if (intval($object["buy_is_sms"]) == 1 && $storeModel["sms"] > 0) {
                        if (!empty($object["buy_sms_tmp"])) {
                            if (!empty($userModel["mobile"])) {
                                $sms_uid = $config["sms_uid"];
                                $sms_key = $config["sms_key"];
                                $mobile = $userModel["mobile"];
                                $sms_content = $object["buy_sms_tmp"];
                                $sms_content = str_replace("{NICKNAME}", $userModel["nickname"], $sms_content);
                                $sms_content = str_replace("{PRIZE}", $draw_data["name"], $sms_content);
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
                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "购买通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                }
                            }
                        }
                    }
                    if ($config["orderpushtmp"] && $storeModel["openid"]) {
                        if (isFollow($storeModel["openid"], $uniacid)) {
                            $postdata = array("first" => array("value" => "{$storeModel["name"]}，您的活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword2" => array("value" => $activity["title"], "color" => "#173177"), "keyword3" => array("value" => $join_model["price"] . "元", "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看订单详情", "color" => "#173177"));
                            $url = replaceDieDomain($config, __MURL("store.obj_cut_pay", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
                            $template_id = $config["orderpushtmp"];
                            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
                        }
                    }
                    if ($config["orderpushtmp_sub"] && $storeModel["openid"]) {
                        $touser = $storeModel["openid"];
                        $template_id = $config["orderpushtmp_sub"];
                        $postdata = array("thing13" => array("value" => $activity["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $join_model["price"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
                        $url = replaceDieDomain($config, __MURL("store.obj_cut_pay", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    if ($config["originpushtmp"] && !empty($origin_id)) {
                        if (isFollow($originModel["openid"], $uniacid)) {
                            $postdata = array("first" => array("value" => "{$originModel["name"]}，您参与的溯源活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $join_model["price"] . "元", "color" => "#173177"), "keyword2" => array("value" => $activity["title"], "color" => "#173177"), "keyword3" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看溯源统计数据", "color" => "#173177"));
                            $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
                            $template_id = $config["originpushtmp"];
                            $result = sendTplNotice($uniacid, $originModel["openid"], $postdata, $template_id, $url);
                        }
                    }
                    if ($config["orderpushtmp_sub"] && !empty($origin_id)) {
                        $touser = $originModel["openid"];
                        $template_id = $config["orderpushtmp_sub"];
                        $postdata = array("thing13" => array("value" => $activity["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $join_model["price"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
                        $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    if ($join_model["pid"] > 0) {
                        if ($joinModel["openid"] != $payModel["openid"]) {
                            $params = ["uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "origin_id" => $origin_id, "object" => $object, "originModel" => $originModel, "userModel" => $userModel, "activity" => isset($activity) ? $activity : $object, "objJoinTableName" => "obj_cut_join"];
                            pdo_update(ztbTable("obj_cut_join", false), array("invite +=" => 1), array("id" => $joinModel["id"]));
                            $joinUserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $joinModel["openid"]));
                            $whereArray = array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1);
                            if (isset($object["or_open_ladder"])) {
                                $whereArray["or_ladder"] = 0;
                            }
                            if (isset($object["or_open_rebate2"])) {
                                $whereArray["or_rebate2"] = 0;
                            }
                            $prizeList = pdo_getall(ztbNopreTable("obj_prize"), $whereArray, array(), '', "sort asc");
                            $params["joinModel"] = $joinModel;
                            $params["joinUserModel"] = $joinUserModel;
                            $params["prizeList"] = $prizeList;
                            $params["rebateMethod"] = "rebate";
                            rebatePrize($params);
                            if ($plug_ladder) {
                                if (isset($object["or_open_ladder"]) && $object["or_open_ladder"] == 1) {
                                    $joinInvite = intval($joinModel["invite"]) + 1;
                                    $or_open_unfixed = trim($object["or_open_unfixed"]);
                                    $ladder_fixed_num = intval($object["ladder_fixed_num"]);
                                    $is_ladder = false;
                                    if ($or_open_unfixed == 0) {
                                        if ($joinInvite > 0 && $ladder_fixed_num > 0 && $joinInvite % $ladder_fixed_num == 0) {
                                            $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_ladder" => 1), array(), '', "sort asc");
                                            $is_ladder = true;
                                        }
                                    } else {
                                        if ($joinInvite > 0) {
                                            $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_ladder" => 1, "ladder_num" => $joinInvite), array(), '', "sort asc");
                                            $is_ladder = true;
                                        }
                                    }
                                    if ($is_ladder == true) {
                                        $params["prizeList"] = $prizeList;
                                        $params["rebateMethod"] = "ladder";
                                        rebatePrize($params);
                                    }
                                }
                            }
                            if ($plug_rebate2) {
                                if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                                    $draw2Model = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "uniacid" => $uniacid, "activity_id" => $activity["id"], "pay_openid" => $joinModel["openid"], "or_rebate2" => 0, "types >" => 0));
                                    if (!empty($draw2Model)) {
                                        $join2Model = pdo_get(ztbTable("obj_cut_join", false), array("uniacid" => $uniacid, "activity_id" => $activity["id"], "openid" => $draw2Model["openid"]));
                                        if (!empty($join2Model)) {
                                            if ($join2Model["openid"] != $payModel["openid"] && $join2Model["openid"] != $joinModel["openid"]) {
                                                pdo_update(ztbTable("obj_cut_join", false), array("invite +=" => 1), array("id" => $join2Model["id"]));
                                                $join2UserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $join2Model["openid"]));
                                                $prize2List = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_rebate2" => 1), array(), '', "sort asc");
                                                $params["joinModel"] = $join2Model;
                                                $params["joinUserModel"] = $join2UserModel;
                                                $params["prizeList"] = $prize2List;
                                                $params["rebateMethod"] = "rebate2";
                                                rebatePrize($params);
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
        tip_redirect("对不起，没有查询到您的支付信息！");
    }
    if ($object["models"] == 3) {
        header("Location: " . $object["models_link"]);
        exit;
    } else {
        header("Location: " . __MURL("obj_cut", array("act" => "detail", "pay_number" => $pay_number, "token" => $activity["token"], "origin_id" => $origin_id, "incoming" => "pay")));
        exit;
    }
}
if ($act == "detail") {
    $pay_number = $_GPC["pay_number"];
    $incoming = $_GPC["incoming"];
    if ($object["models"] == 3) {
        header("Location: " . $object["models_link"]);
        exit;
    }
    $drawModel = pdo_get(ztbTable("user_draw", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "pay_number" => $pay_number));
    if (empty($drawModel)) {
        tip_redirect("对不起，没有查询到您的购买信息！");
    }
    $buyUserList = pdo_getall(ztbTable("user_draw", false), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "types" => -1, "deltime" => 0), array("nickname", "headurl", "createtime"), '', "id desc", array(14));
    if (count($buyUserList) < 14 && intval($activity["bogus_buy_num"]) > 0) {
        $bogusBuyCount = 14 - count($buyUserList);
        if (14 > count($buyUserList) + intval($activity["bogus_buy_num"])) {
            $bogusBuyCount = intval($activity["bogus_buy_num"]);
        }
        if (intval($activity["bogus_buy_gender"]) > 0) {
            $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" and gender=" . $activity["bogus_buy_gender"] . " order by uid desc LIMIT 10,41");
        } else {
            $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 10,41");
        }
        foreach ($userList as $user) {
            $is_insert = true;
            foreach ($buyUserList as $buyUser) {
                if (!($buyUser["nickname"] == $user["nickname"])) {
                    if ($user["nickname"] == $userinfo["nickname"]) {
                        $is_insert = false;
                    }
                }
                $is_insert = false;
            }
            if ($is_insert) {
                $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"], "createtime" => $activity["start_time"]);
                array_push($buyUserList, $insertUser);
                $bogusBuyCount = $bogusBuyCount - 1;
                if ($bogusBuyCount <= 0) {
                    break;
                }
            }
        }
        foreach ($userList as &$d_user) {
            $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
        }
        unset($d_user);
    }
    $store_map_list = unserialize($object["store_map_list"]);
    if (!empty($store_map_list) && is_array($store_map_list)) {
        foreach ($store_map_list as $key => $value) {
            $map_lat_lng = Convert_BD09_To_GCJ02($value["lat"], $value["lng"]);
            $store_map_list[$key]["lat"] = $map_lat_lng["lat"];
            $store_map_list[$key]["lng"] = $map_lat_lng["lng"];
        }
    }
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_model = pdo_get("lywywl_ztb_obj_cut_join", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($join_model) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    include $this->template("tmp/" . $tmp["resource"] . "/detail");
    exit;
}