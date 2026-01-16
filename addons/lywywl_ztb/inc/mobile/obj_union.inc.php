<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
include MODULE_ROOT . "/inc/class/WxpayService.class.php";
include MODULE_ROOT . "/inc/class/AllinpayService.class.php";
include_once MODULE_ROOT . "/inc/function/app.tpl.func.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "join", "share", "apply", "register", "pay", "wxPay", "getPayNumber", "checkPay", "store", "getCard", "getStoreAllCard", "myCard", "qrCode", "writeStore", "writeOff", "getWriteCardJsonList", "getUserWriteCard", "confirmWrite");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 3;
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
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_union");
}
$plug_allinpay = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_allinpay");
$plug_ladder = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_ladderinvite");
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
$storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
$store_config = iunserializer($storeAccount["config"]);
$rategroup = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_rategroup");
if ($rategroup && $storeAccount["rate_group_id"] != 0) {
    $rate_group = pdo_get(ztbTable("sys_rategroup", false), array("uniacid" => $uniacid, "id" => $storeAccount["rate_group_id"]));
    if ($rate_group["status"] == 1) {
        $config["pay_rate"] = $rate_group["pay_rate"];
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
$model2 = pdo_get(ztbNopreTable("obj_union"), array("deltime" => 0, "activity_id" => $model["id"]));
unset($model2["id"]);
$object = array_merge($model, $model2);
$tmp = pdo_get(ztbNopreTable("sys_tmp"), array("deltime" => 0, "id" => $object["tmp_id"]));
if ($plug_appad && $plug_appad_act == 1 && $object["is_open_appad"] == 1) {
    $object["appad_types"] = explode(",", $object["appad_types"]);
}
if (!empty($origin_id)) {
    $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $object["id"], "uniacid" => $_W["uniacid"]));
    if (empty($originModel)) {
        tip_redirect("对不起,您访问的活动链接不合法！");
    }
    $is_marketing_Model = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $model["id"], "status" => 1, "openid" => $openid));
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
if (!empty($originModel)) {
    $Contact_tel = $originModel["mobile"];
} else {
    if (!empty($model["tel"])) {
        $Contact_tel = $model["tel"];
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
    $show_join_id = $_GET["join_id"];
    if ($show_join_id) {
        $show_join_model = pdo_get("lywywl_ztb_obj_union_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_id" => $object["id"], "id" => $show_join_id));
    }
    if (!empty($_GET["join_id"])) {
        $join_id = $_GET["join_id"];
        isetcookie("join_id_union_" . $object["id"], $_GET["join_id"], 3600 * 24);
    } else {
        $join_id = $_GPC["join_id_union_" . $object["id"]];
    }
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_union_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_union_" . $object["id"], "ad", 3600 * 24);
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
    $ispay = $_GPC["ispay"];
    if (!empty($object["buy_register_field"])) {
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
    }
    if (!empty($object["join_register_field"])) {
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
    }
    $share_id = 0;
    $join_model = pdo_get("lywywl_ztb_obj_union_join", array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if (!empty($join_model)) {
        $share_id = $join_model["id"];
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        if ($object["join_is_register"] <= 0) {
            $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "invite" => 0, "money" => 0, "register_data" => '', "createtime" => TIMESTAMP);
            $result = pdo_insert("lywywl_ztb_obj_union_join", $insert_join_model);
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
    $storeArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_store") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1 order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    if ($object["is_single_store"] == 1) {
        if (!empty($storeArr)) {
            $store = $storeArr[0];
            $storeArr = array_slice($storeArr, 0, 1);
            $store_map_list = unserialize($store["store_map_list"]);
            if (!empty($store_map_list) && is_array($store_map_list)) {
                foreach ($store_map_list as $key => $value) {
                    $map_lat_lng = Convert_BD09_To_GCJ02($value["lat"], $value["lng"]);
                    $store_map_list[$key]["lat"] = $map_lat_lng["lat"];
                    $store_map_list[$key]["lng"] = $map_lat_lng["lng"];
                }
            }
        }
    }
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], "openid" => $openid));
    $usercardArr = array();
    if ($userPayTotal > 0) {
        $usercardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_cardbag") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid order by  id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], "openid" => $openid));
    }
    $cardTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_union_card") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0 or `time_types`=2) or (`time_types`=1  and `time_end`>" . strtotime("now") . ")) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    $cardList = array();
    foreach ($cardArr as $index => $card) {
        $cardList[$index] = $card;
        $isdraw = false;
        foreach ($usercardArr as $usercard) {
            if ($usercard["u_store_id"] == $card["u_store_id"] && $usercard["card_id"] == $card["id"]) {
                $isdraw = true;
            }
        }
        if ($isdraw) {
            $cardList[$index]["isdraw"] = 1;
        } else {
            $cardList[$index]["isdraw"] = 0;
        }
    }
    $storeCardList = array();
    foreach ($storeArr as $index => $store) {
        $storeCardList[$index] = $store;
        $u_store_id = $store["id"];
        $storeCardList[$index]["cardlist"] = array_values(array_filter($cardList, function ($item) use($u_store_id) {
            return $item["u_store_id"] == $u_store_id;
        }));
        $storeCardList[$index]["carddrawnum"] = count(array_filter($cardList, function ($item) use($u_store_id) {
            return $item["u_store_id"] == $u_store_id && $item["isdraw"] == 1;
        }));
    }
    $joinUserList = pdo_fetchall("SELECT nickname,headurl FROM " . ztbTable("obj_union_join") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id order by id desc LIMIT 14 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    if (count($joinUserList) < 16 && intval($object["bogus_join_num"]) > 0) {
        $bogusJoinCount = 16 - count($joinUserList);
        if (16 > count($joinUserList) + intval($object["bogus_join_num"])) {
            $bogusJoinCount = intval($object["bogus_join_num"]);
        }
        if (intval($object["bogus_join_gender"]) > 0) {
            $userList = pdo_fetchall("SELECT nickname,avatar FROM " . tablename("mc_members") . " where avatar<>\"\" and gender=" . $object["bogus_join_gender"] . " order by uid desc LIMIT 29");
        } else {
            $userList = pdo_fetchall("SELECT nickname,avatar FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 29");
        }
        foreach ($userList as $user) {
            $is_insert = true;
            foreach ($joinUserList as $joinUser) {
                if ($joinUser["nickname"] == $user["nickname"] || $user["nickname"] == $userinfo["nickname"]) {
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
    $buyUserList = pdo_getall(ztbTable("user_draw", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "types" => -1), array("nickname", "headurl", "createtime"), '', "id desc", array(20));
    if (count($buyUserList) < 20 && intval($object["bogus_buy_num"]) > 0) {
        $bogusBuyCount = 20 - count($buyUserList);
        if (20 > count($buyUserList) + intval($object["bogus_buy_num"])) {
            $bogusBuyCount = intval($object["bogus_buy_num"]);
        }
        if (intval($object["bogus_buy_gender"]) > 0) {
            $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" and gender=" . $object["bogus_buy_gender"] . " order by uid desc LIMIT 10,41");
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
                $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"], "createtime" => $model["start_time"]);
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
    $topUserList = pdo_getall(ztbTable("obj_union_join", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"]), array("nickname", "headurl", "invite", "money", "bogus_invite", "bogus_money"), '', "invite`+`bogus_invite desc,money`+`bogus_money desc", array(10));
    foreach ($topUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $isShowTopUserMoney = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("lywywl_ztb_obj_prize") . " where `uniacid`=:uniacid and store_id=:store_id and activity_id=:activity_id and status=1 and types in(2,3) and deltime=0 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $object["id"])) > 0;
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    pdo_update(ztbTable("obj_activity", false), array("click_num +=" => 1), array("id" => $object["id"]));
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
            pdo_update(ztbTable("user_account", false), array("mobile" => $_GPC[$item["Name"]]), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
        }
    }
    unset($item);
    $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if ($join_model) {
        exit(json_encode(array("status" => 1, "msg" => "参与成功，邀请好友参与可获得奖励哦！"), JSON_UNESCAPED_UNICODE));
    }
    $registerFields = serialize($registerFields);
    $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "invite" => 0, "money" => 0, "register_data" => $registerFields, "createtime" => TIMESTAMP);
    $result = pdo_insert(ztbNopreTable("obj_union_join"), $insert_join_model);
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
    $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
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
        $scanurl = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
        $scanurl = replaceDieDomain($config, $scanurl, $user["id"], $object["id"], $user["id"]);
        $qr = poster($isroot, $scanurl, $outfile, $qrcode_level, $qrcode_size, 2, false, $object["qr_url"], $qr_content, $userinfo);
        if ($qr !== false) {
            pdo_update(ztbTable("obj_union_join", false), array("qrcode_url" => $file_path), array("id" => $join_model["id"]));
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
            pdo_update(ztbTable("user_account", false), array("mobile" => $_GPC[$item["Name"]]), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
        }
    }
    unset($item);
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userPayTotal > 0) {
        exit(json_encode(array("status" => 0, "tip" => "follow", "msg" => "对不起，请不要重复参与活动哦！"), JSON_UNESCAPED_UNICODE));
    }
    isetcookie("reg_objunion_" . $object["id"], base64_encode(serialize($registerFields)), 3600 * 24);
    exit(json_encode(array("status" => 1, "msg" => "登记成功！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "pay") {
    $join_id = $_GPC["join_id"];
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
    }
    if ($object["end_time"] < TIMESTAMP) {
        tip_redirect("亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！", 1);
    }
    $register_data = $_GPC["reg_objunion_" . $object["id"]];
    if (empty($register_data) && $object["buy_is_register"] == 1) {
        tip_redirect("对不起，请先登记后再参与活动！");
    }
    $userModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $share_id = 0;
    $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if ($join_model) {
        $share_id = $join_model["id"];
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
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
        $order["body"] = (strlen($model["title"]) > 90 ? mb_strcut($model["title"], 0, 90, "utf-8") . "..." : $model["title"]) . "[电话]" . $Contact_tel;
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
        $orderName = $model["title"];
        $orderName = (strlen($model["title"]) > 90 ? mb_strcut($model["title"], 0, 90, "utf-8") . "..." : $model["title"]) . "[电话]" . $Contact_tel;
        $notifyUrl = $_W["siteroot"] . "addons/lywywl_ztb/wxpay_notify.php";
        $payTime = time();
        $jsApiParameters = $wxPay->createJsBizPackage_JSAPI($_W["openid"], $payAmount, $outTradeNo, $orderName, $notifyUrl, $payTime);
        $jsApiParameters = json_encode($jsApiParameters);
    }
    include $this->template("tmp/" . $tmp["resource"] . "/wxPay");
    exit;
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
    if ($object["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = $_GPC["reg_objunion_" . $object["id"]];
    if (empty($register_data) && $object["buy_is_register"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
    }
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userPayTotal > 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，请不要重复参与活动哦！"), JSON_UNESCAPED_UNICODE));
    }
    $userModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id, "deltime" => 0));
    $storeConfig = getStoreConfig($uniacid, $store_id);
    $is_pay = true;
    if (floatval($object["money"]) <= 0) {
        $is_pay = false;
    }
    $user_money = $userModel["money"];
    if ($use_sys_Money === "true" && $object["money"] <= $user_money) {
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
                $payModel["paymoney"] = floatval($object["money"] - $user_money);
                $payModel["mymoney"] = floatval($user_money);
            } else {
                $payModel["paymoney"] = floatval($object["money"]);
                $payModel["mymoney"] = 0;
            }
        } else {
            $payModel["paymoney"] = floatval($object["money"]);
            $payModel["mymoney"] = 0;
        }
        $payModel["endmoney"] = $payModel["paymoney"] + $payModel["mymoney"] - round($payModel["paymoney"] * $config["pay_rate"] / 100, 2);
        $payModel["note"] = $register_data;
        $payModel["status"] = 0;
        $payModel["updatetime"] = TIMESTAMP;
        $payModel["createtime"] = TIMESTAMP;
        $payModel["activity_id"] = $model["id"];
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
                $order["body"] = (strlen($model["title"]) > 90 ? mb_strcut($model["title"], 0, 90, "utf-8") . "..." : $model["title"]) . "[电话]" . $Contact_tel;
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
                $orderName = (strlen($model["title"]) > 90 ? mb_strcut($model["title"], 0, 90, "utf-8") . "..." : $model["title"]) . "[电话]" . $Contact_tel;
                $notifyUrl = $_W["siteroot"] . "addons/lywywl_ztb/wxpay_notify.php";
                $payTime = time();
                $jsApiParameters = $wxPay->createJsBizPackage_JSAPI($_W["openid"], $payAmount, $outTradeNo, $orderName, $notifyUrl, $payTime);
                $jsApiParameters = json_encode($jsApiParameters);
            }
        }
        thread_unlock($openid);
        resultMsg(["status" => 1, "ispay" => 1, "jsApiData" => $jsApiParameters, "paynumber" => $payModel["paynumber"], "paymoney" => $payModel["paymoney"], "msg" => "请求成功！"]);
    } else {
        if (!empty($join_id)) {
            $joinModel = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "id" => $join_id));
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
        $payModel["mymoney"] = $object["money"];
        $payModel["endmoney"] = $object["money"];
        $payModel["note"] = $register_data;
        $payModel["status"] = 1;
        $payModel["updatetime"] = TIMESTAMP;
        $payModel["createtime"] = TIMESTAMP;
        $payModel["activity_id"] = $model["id"];
        pdo_insert(ztbTable("sys_pay", false), $payModel);
        $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "origin_buy_types" => $origin_buy_types, "prize_id" => 0, "types" => -1, "name" => $object["title"], "pay_openid" => $joinModel["openid"], "pay_nickname" => $joinModel["nickname"], "pay_headurl" => $joinModel["headurl"], "pay_number" => $payModel["paynumber"], "paymoney" => 0, "mymoney" => $object["money"], "endmoney" => $object["money"], "is_settlement" => $config["store_settlement_types"] == 1 ? 0 : 1, "prize_pic_url" => $object["pic_url"], "writeoff_types" => $object["is_fedex"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "status" => 1, "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
        isetcookie("reg_objunion_" . $object["id"], '', -3600 * 24);
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
        $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
        if (empty($join_model)) {
            $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "invite" => 0, "money" => 0, "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "createtime" => TIMESTAMP);
            pdo_insert(ztbNopreTable("obj_union_join"), $insert_join_model);
            pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $object["id"]));
            if (!empty($origin_id)) {
                pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
            }
        }
        pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => 1), array("id" => $object["id"]));
        if (!empty($origin_id)) {
            pdo_update(ztbNopreTable("marketing_user"), array("marketing_num +=" => 1), array("id" => $origin_id));
        }
        $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $object["title"] . "，支付金额：" . floatval($object["money"]) . "元";
        if ($config["store_settlement_types"] != 1) {
            pdo_update(ztbNopreTable("store_account"), array("money +=" => $object["money"]), array("id" => $store_id));
            $storeBillModel = array();
            $storeBillModel["uniacid"] = $uniacid;
            $storeBillModel["store_id"] = $store_id;
            $storeBillModel["types"] = 12;
            $storeBillModel["detail_id"] = $draw_id;
            $storeBillModel["money"] = $object["money"];
            $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
            $storeBillModel["note"] = $note;
            $storeBillModel["createtime"] = TIMESTAMP;
            pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
        }
        pdo_update(ztbNopreTable("user_account"), array("money -=" => $object["money"]), array("id" => $userModel["id"]));
        $userBillModel = array();
        $userBillModel["uniacid"] = $uniacid;
        $userBillModel["store_id"] = $store_id;
        $userBillModel["openid"] = $userModel["openid"];
        $userBillModel["nickname"] = $userModel["nickname"];
        $userBillModel["headurl"] = $userModel["headurl"];
        $userBillModel["types"] = 2;
        $userBillModel["detail_id"] = $draw_id;
        $userBillModel["money"] = $object["money"];
        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("id" => $userModel["id"]), "money");
        $userBillModel["note"] = $note;
        $userBillModel["createtime"] = TIMESTAMP;
        pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
        if ($object["is_card_get"] == 0) {
            if ($object["is_single_store"] == 0) {
                $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0) or (`time_types`=1 and `time_end`>" . strtotime("now") . ") or(`time_types`=2 and `time_day`>0)) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
            } else {
                $storeArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_store") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1 order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
                $cardArr = array();
                if (!empty($storeArr)) {
                    $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `u_store_id`=:u_store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0) or (`time_types`=1 and `time_end`>" . strtotime("now") . ") or(`time_types`=2 and `time_day`>0)) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":u_store_id" => $storeArr[0]["id"], ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
                }
            }
            foreach ($cardArr as $index => $card) {
                $storeModel = pdo_get(ztbNopreTable("obj_union_store"), array("id" => $card["u_store_id"], "status" => 1, "uniacid" => $uniacid));
                if (!empty($storeModel)) {
                    $card_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $card["u_store_id"], "card_id" => $card["id"], "name" => $card["name"], "use_num" => $card["writeoff_num"], "writeoff_num" => 0, "money" => $card["money"], "pay_money" => $card["pay_money"], "use_limit" => $card["use_limit"], "end_time" => $card["time_types"] == 0 ? time() + intval($card["time_day"]) * 24 * 60 * 60 : ($card["time_types"] == 2 ? time() + 365 * 24 * 60 * 60 : $card["time_end"]), "begin_time" => $card["time_begin"], "pic_url" => $card["pic_url"], "openid" => $openid, "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "createtime" => TIMESTAMP);
                    $result = pdo_insert(ztbNopreTable("obj_union_cardbag"), $card_data);
                    if (!empty($result)) {
                        if ($card["is_open_stock"] == 1) {
                            pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1, "stock -=" => 1), array("id" => $card["id"]));
                        } else {
                            pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1), array("id" => $card["id"]));
                        }
                    }
                }
            }
        }
        $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
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
                    $sms_content = str_replace("{OBJ}", $object["title"], $sms_content);
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
                $postdata = array("first" => array("value" => "{$storeModel["name"]}，您的活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword2" => array("value" => $object["title"], "color" => "#173177"), "keyword3" => array("value" => $object["money"] . "元", "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看订单详情", "color" => "#173177"));
                $url = replaceDieDomain($config, __MURL("store.obj_union_pay", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
                $template_id = $config["orderpushtmp"];
                $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
            }
        }
        if ($config["orderpushtmp_sub"] && $storeModel["openid"]) {
            $touser = $storeModel["openid"];
            $template_id = $config["orderpushtmp_sub"];
            $postdata = array("thing13" => array("value" => $object["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $object["money"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
            $url = replaceDieDomain($config, __MURL("store.obj_union_pay", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
            $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
        }
        if ($config["originpushtmp"] && !empty($origin_id)) {
            if (isFollow($originModel["openid"], $uniacid)) {
                $postdata = array("first" => array("value" => "{$originModel["name"]}，您参与的溯源活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $object["money"] . "元", "color" => "#173177"), "keyword2" => array("value" => $object["title"], "color" => "#173177"), "keyword3" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看溯源统计数据", "color" => "#173177"));
                $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
                $template_id = $config["originpushtmp"];
                $result = sendTplNotice($uniacid, $originModel["openid"], $postdata, $template_id, $url);
            }
        }
        if ($config["orderpushtmp_sub"] && !empty($origin_id)) {
            $touser = $originModel["openid"];
            $template_id = $config["orderpushtmp_sub"];
            $postdata = array("thing13" => array("value" => $object["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $object["money"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
            $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
            $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
        }
        if (!empty($join_id)) {
            if ($joinModel["openid"] != $openid) {
                $params = ["uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "origin_id" => $origin_id, "object" => $object, "originModel" => $originModel, "userModel" => $userModel, "activity" => isset($activity) ? $activity : $object, "objJoinTableName" => "obj_union_join"];
                pdo_update(ztbTable("obj_union_join", false), array("invite +=" => 1), array("id" => $join_id));
                $joinUserModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $joinModel["openid"]));
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
                    $draw2Model = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "uniacid" => $uniacid, "activity_id" => $object["id"], "pay_openid" => $joinModel["openid"], "or_rebate2" => 0, "types >" => 0));
                    if (!empty($draw2Model)) {
                        $join2Model = pdo_get(ztbTable("obj_union_join", false), array("uniacid" => $uniacid, "activity_id" => $object["id"], "openid" => $draw2Model["openid"]));
                        if (!empty($join2Model)) {
                            if ($join2Model["openid"] != $openid && $join2Model["openid"] != $joinModel["openid"]) {
                                pdo_update(ztbTable("obj_union_join", false), array("invite +=" => 1), array("id" => $join2Model["id"]));
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
        resultMsg(["status" => 1, "ispay" => 0, "pay_number" => $draw_data["pay_number"], "paymoney" => $object["money"], "msg" => "请求成功！"]);
    }
}
if ($act == "checkPay") {
    $pay_number = $_GPC["pay_number"];
    $incoming = $_GPC["incoming"];
    $payModel = pdo_get(ztbTable("sys_pay", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "paynumber" => $pay_number, "openid" => $openid));
    if ($payModel) {
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
                    $userModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id, "deltime" => 0));
                    if (!empty($join_id)) {
                        $joinModel = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "id" => $join_id));
                    }
                    $origin_buy_types = 0;
                    if (!empty($origin_id)) {
                        if ($joinModel["openid"] == $originModel["openid"]) {
                            $origin_buy_types = 1;
                            pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => 1), array("id" => $origin_id));
                        }
                    }
                    $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "origin_buy_types" => $origin_buy_types, "prize_id" => 0, "types" => -1, "name" => $object["title"], "pay_openid" => $joinModel["openid"], "pay_nickname" => $joinModel["nickname"], "pay_headurl" => $joinModel["headurl"], "pay_number" => $payModel["paynumber"], "paymoney" => $payModel["paymoney"], "mymoney" => $payModel["mymoney"], "endmoney" => $payModel["endmoney"], "is_settlement" => $config["store_settlement_types"] == 1 ? 0 : 1, "prize_pic_url" => $object["pic_url"], "writeoff_types" => $object["is_fedex"], "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "status" => 1, "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                    isetcookie("reg_objunion_" . $object["id"], '', -3600 * 24);
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
                    $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $userModel["openid"]));
                    if (empty($join_model)) {
                        $insert_join_model = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "qrcode_url" => '', "invite" => 0, "money" => 0, "register_data" => $object["buy_is_register"] == 1 ? base64_decode($register_data) : '', "createtime" => TIMESTAMP);
                        pdo_insert(ztbNopreTable("obj_union_join"), $insert_join_model);
                        pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $object["id"]));
                        if (!empty($origin_id)) {
                            pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
                        }
                    }
                    pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => 1), array("id" => $object["id"]));
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable("marketing_user"), array("marketing_num +=" => 1), array("id" => $origin_id));
                    }
                    if ($config["store_settlement_types"] != 1) {
                        $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $object["title"] . "，支付金额：" . floatval($object["money"]) . "元";
                        pdo_update(ztbNopreTable("store_account"), array("money +=" => $payModel["endmoney"]), array("id" => $store_id));
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
                    pdo_update(ztbNopreTable("user_account"), array("money +=" => $payModel["paymoney"]), array("id" => $userModel["id"]));
                    $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $object["title"] . "，充值金额：" . floatval($payModel["paymoney"]) . "元";
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $userModel["openid"];
                    $userBillModel["nickname"] = $userModel["nickname"];
                    $userBillModel["headurl"] = $userModel["headurl"];
                    $userBillModel["types"] = 1;
                    $userBillModel["detail_id"] = $draw_id;
                    $userBillModel["money"] = $payModel["paymoney"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("id" => $userModel["id"]), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                    pdo_update(ztbNopreTable("user_account"), array("money -=" => $object["money"]), array("id" => $userModel["id"]));
                    $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $object["title"] . "，支付金额：" . floatval($object["money"]) . "元";
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $userModel["openid"];
                    $userBillModel["nickname"] = $userModel["nickname"];
                    $userBillModel["headurl"] = $userModel["headurl"];
                    $userBillModel["types"] = 2;
                    $userBillModel["detail_id"] = $draw_id;
                    $userBillModel["money"] = $object["money"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("id" => $userModel["id"]), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                    if ($object["is_card_get"] == 0) {
                        if ($object["is_single_store"] == 0) {
                            $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0) or (`time_types`=1 and `time_end`>" . strtotime("now") . ") or(`time_types`=2 and `time_day`>0)) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
                        } else {
                            $storeArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_store") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1 order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
                            $cardArr = array();
                            if (!empty($storeArr)) {
                                $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `u_store_id`=:u_store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0) or (`time_types`=1 and `time_end`>" . strtotime("now") . ") or(`time_types`=2 and `time_day`>0)) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":u_store_id" => $storeArr[0]["id"], ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
                            }
                        }
                        foreach ($cardArr as $index => $card) {
                            $storeModel = pdo_get(ztbNopreTable("obj_union_store"), array("id" => $card["u_store_id"], "status" => 1, "uniacid" => $uniacid));
                            if (!empty($storeModel)) {
                                $card_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $card["u_store_id"], "card_id" => $card["id"], "name" => $card["name"], "use_num" => $card["writeoff_num"], "writeoff_num" => 0, "money" => $card["money"], "pay_money" => $card["pay_money"], "use_limit" => $card["use_limit"], "end_time" => $card["time_types"] == 0 ? time() + intval($card["time_day"]) * 24 * 60 * 60 : ($card["time_types"] == 2 ? time() + 365 * 24 * 60 * 60 : $card["time_end"]), "begin_time" => $card["time_begin"], "pic_url" => $card["pic_url"], "openid" => $openid, "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "createtime" => TIMESTAMP);
                                $result = pdo_insert(ztbNopreTable("obj_union_cardbag"), $card_data);
                                if (!empty($result)) {
                                    if ($card["is_open_stock"] == 1) {
                                        pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1, "stock -=" => 1), array("id" => $card["id"]));
                                    } else {
                                        pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1), array("id" => $card["id"]));
                                    }
                                }
                            }
                        }
                    }
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
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
                                $sms_content = str_replace("{OBJ}", $object["title"], $sms_content);
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
                            $postdata = array("first" => array("value" => "{$storeModel["name"]}，您的活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword2" => array("value" => $object["title"], "color" => "#173177"), "keyword3" => array("value" => $object["money"] . "元", "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看订单详情", "color" => "#173177"));
                            $url = replaceDieDomain($config, __MURL("store.obj_union_pay", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
                            $template_id = $config["orderpushtmp"];
                            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
                        }
                    }
                    if ($config["orderpushtmp_sub"] && $storeModel["openid"]) {
                        $touser = $storeModel["openid"];
                        $template_id = $config["orderpushtmp_sub"];
                        $postdata = array("thing13" => array("value" => $object["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $object["money"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
                        $url = replaceDieDomain($config, __MURL("store.obj_union_pay", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    if ($config["originpushtmp"] && !empty($origin_id)) {
                        if (isFollow($originModel["openid"], $uniacid)) {
                            $postdata = array("first" => array("value" => "{$originModel["name"]}，您参与的溯源活动有新的订单", "color" => "#173177"), "keyword1" => array("value" => $object["money"] . "元", "color" => "#173177"), "keyword2" => array("value" => $object["title"], "color" => "#173177"), "keyword3" => array("value" => $payModel["paynumber"], "color" => "#173177"), "keyword4" => array("value" => "【{$userModel["nickname"]}】" . $userModel["mobile"], "color" => "#173177"), "remark" => array("value" => "点击查看溯源统计数据", "color" => "#173177"));
                            $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
                            $template_id = $config["originpushtmp"];
                            $result = sendTplNotice($uniacid, $originModel["openid"], $postdata, $template_id, $url);
                        }
                    }
                    if ($config["orderpushtmp_sub"] && !empty($origin_id)) {
                        $touser = $originModel["openid"];
                        $template_id = $config["orderpushtmp_sub"];
                        $postdata = array("thing13" => array("value" => $object["title"]), "character_string10" => array("value" => $payModel["paynumber"]), "amount1" => array("value" => $object["money"]), "time12" => array("value" => date("Y-m-d H:i:s", $payModel["createtime"])), "thing9" => array("value" => "购买用户：{$userModel["nickname"]}"));
                        $url = replaceDieDomain($config, __MURL("user.admins_marketing", array("store_id" => $originModel["store_id"], "activity_id" => $originModel["activity_id"]), true, true), 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    if (!empty($join_id)) {
                        if ($joinModel["openid"] != $openid) {
                            $params = ["uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "origin_id" => $origin_id, "object" => $object, "originModel" => $originModel, "userModel" => $userModel, "activity" => isset($activity) ? $activity : $object, "objJoinTableName" => "obj_union_join"];
                            pdo_update(ztbTable("obj_union_join", false), array("invite +=" => 1), array("id" => $join_id));
                            $joinUserModel = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $joinModel["openid"]));
                            if (!empty($origin_id)) {
                                if ($joinModel["openid"] == $originModel["openid"]) {
                                    pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => 1), array("id" => $origin_id));
                                }
                            }
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
                                        $params["rebateMethod"] = "ladder";
                                        $params["prizeList"] = $prizeList;
                                        rebatePrize($params);
                                    }
                                }
                            }
                        }
                        if ($plug_rebate2) {
                            if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                                $draw2Model = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "uniacid" => $uniacid, "activity_id" => $object["id"], "pay_openid" => $joinModel["openid"], "or_rebate2" => 0, "types >" => 0));
                                if (!empty($draw2Model)) {
                                    $join2Model = pdo_get(ztbTable("obj_union_join", false), array("uniacid" => $uniacid, "activity_id" => $object["id"], "openid" => $draw2Model["openid"]));
                                    if (!empty($join2Model)) {
                                        if ($join2Model["openid"] != $openid && $join2Model["openid"] != $joinModel["openid"]) {
                                            pdo_update(ztbTable("obj_union_join", false), array("invite +=" => 1), array("id" => $join2Model["id"]));
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
    } else {
        tip_redirect("对不起，没有查询到您的支付信息！");
    }
    header("Location: " . __MURL("obj_union", array("act" => "index", "token" => $object["token"], "origin_id" => $origin_id, "ispay" => $incoming)));
    exit;
}
if ($act == "store") {
    $token = $_GPC["token"];
    $u_store_id = $_GPC["u_store_id"];
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
    }
    $store = pdo_get(ztbNopreTable("obj_union_store"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $u_store_id, "status" => 1));
    if (empty($store)) {
        tip_redirect("对不起，您查看的店铺不存在或已被删除！");
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
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    $usercardArr = array();
    if ($userPayTotal > 0) {
        $usercardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_cardbag") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `u_store_id`=:u_store_id and `openid`=:openid order by  id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":u_store_id" => $u_store_id, ":openid" => $openid));
    }
    $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `u_store_id`=:u_store_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0) or (`time_types`=1 and `time_end`>" . strtotime("now") . ") or(`time_types`=2 and `time_day`>0)) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":u_store_id" => $u_store_id));
    $cardList = array();
    foreach ($cardArr as $index => $card) {
        $cardList[$index] = $card;
        $isdraw = false;
        foreach ($usercardArr as $usercard) {
            if ($usercard["u_store_id"] == $card["u_store_id"] && $usercard["card_id"] == $card["id"]) {
                $isdraw = true;
            }
        }
        if ($isdraw) {
            $cardList[$index]["isdraw"] = 1;
        } else {
            $cardList[$index]["isdraw"] = 0;
        }
    }
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if ($join_model) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/store");
    exit;
}
if ($act == "getCard" && $request_method == "post") {
    $token = $_GPC["token"];
    $card_id = intval($_GPC["card_id"]);
    if ($object["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $cardModel = pdo_get(ztbNopreTable("obj_union_card"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $card_id));
    if (empty($cardModel)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您领取的优惠券不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($cardModel["status"]) != 1) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您领取的优惠券已失效！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($cardModel["is_open_stock"]) == 1 && intval($cardModel["stock"]) <= 0) {
        exit(json_encode(array("status" => 0, "msg" => "您来晚了，优惠券已被抢空！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($cardModel["time_types"]) == 1 && $cardModel["time_end"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "您来晚了，优惠券已失效！"), JSON_UNESCAPED_UNICODE));
    }
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userPayTotal == 0) {
        exit(json_encode(array("status" => 0, "tip" => "follow", "msg" => "对不起，请参与活动后领取卡券！"), JSON_UNESCAPED_UNICODE));
    }
    $userCardTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_union_cardbag") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and `card_id`=:card_id ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid, ":card_id" => $card_id));
    if ($userCardTotal > 0) {
        exit(json_encode(array("status" => 0, "tip" => "follow", "msg" => "对不起，您已经领取过卡券了！"), JSON_UNESCAPED_UNICODE));
    }
    $card_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $cardModel["u_store_id"], "card_id" => $cardModel["id"], "name" => $cardModel["name"], "use_num" => $cardModel["writeoff_num"], "writeoff_num" => 0, "money" => $cardModel["money"], "pay_money" => $cardModel["pay_money"], "use_limit" => $cardModel["use_limit"], "end_time" => $cardModel["time_types"] == 0 ? time() + intval($cardModel["time_day"]) * 24 * 60 * 60 : ($cardModel["time_types"] == 2 ? time() + 365 * 24 * 60 * 60 : $cardModel["time_end"]), "begin_time" => $cardModel["time_begin"], "pic_url" => $cardModel["pic_url"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "createtime" => TIMESTAMP);
    $result = pdo_insert(ztbNopreTable("obj_union_cardbag"), $card_data);
    if (!empty($result)) {
        if ($cardModel["is_open_stock"] == 1) {
            pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1, "stock -=" => 1), array("id" => $card_id));
        } else {
            pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1), array("id" => $card_id));
        }
        exit(json_encode(array("status" => 1, "msg" => "领取成功！"), JSON_UNESCAPED_UNICODE));
    } else {
        exit(json_encode(array("status" => 0, "msg" => "领取失败，请稍后重试！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "getStoreAllCard" && $request_method == "post") {
    $token = $_GPC["token"];
    $u_store_id = intval($_GPC["u_store_id"]);
    if ($object["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $storeModel = pdo_get(ztbNopreTable("obj_union_store"), array("id" => $u_store_id, "status" => 1, "uniacid" => $uniacid));
    if (empty($storeModel)) {
        exit(json_encode(array("status" => 0, "msg" => "店铺不存在！"), JSON_UNESCAPED_UNICODE));
    }
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userPayTotal == 0) {
        exit(json_encode(array("status" => 0, "tip" => "follow", "msg" => "对不起，请参与活动后领取卡券！"), JSON_UNESCAPED_UNICODE));
    }
    $cardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_card") . "where (`uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `u_store_id`=:u_store_id and `status`=1) and ((`is_open_stock`=0 and `stock`=0) or (`is_open_stock`=1 and `stock`>0)) and ((`time_types`=0) or (`time_types`=1 and `time_end`>" . strtotime("now") . ") or(`time_types`=2 and `time_day`>0) ) order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":u_store_id" => $u_store_id));
    $userCardList = pdo_fetchall("SELECT card_id FROM " . ztbTable("obj_union_cardbag") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `u_store_id`=:u_store_id  and `openid`=:openid ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":u_store_id" => $u_store_id, ":openid" => $openid));
    foreach ($cardArr as $index => $card) {
        if (!in_array($card["id"], array_column($userCardList, "card_id"))) {
            $card_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $card["u_store_id"], "card_id" => $card["id"], "name" => $card["name"], "use_num" => $card["writeoff_num"], "writeoff_num" => 0, "money" => $card["money"], "pay_money" => $card["pay_money"], "use_limit" => $card["use_limit"], "end_time" => $card["time_types"] == 0 ? time() + intval($card["time_day"]) * 24 * 60 * 60 : ($card["time_types"] == 2 ? time() + 365 * 24 * 60 * 60 : $card["time_end"]), "begin_time" => $card["time_begin"], "pic_url" => $card["pic_url"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "createtime" => TIMESTAMP);
            $result = pdo_insert(ztbNopreTable("obj_union_cardbag"), $card_data);
            if (!empty($result)) {
                if ($card["is_open_stock"] == 1) {
                    pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1, "stock -=" => 1), array("id" => $card["id"]));
                } else {
                    pdo_update(ztbTable("obj_union_card", false), array("get_num +=" => 1), array("id" => $card["id"]));
                }
            }
        } else {
        }
    }
    exit(json_encode(array("status" => 1, "msg" => "领取成功！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "myCard") {
    $token = $_GPC["token"];
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
    }
    $userPayTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and types=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    if ($userPayTotal == 0) {
        exit(json_encode(array("status" => 0, "tip" => "follow", "msg" => "对不起，请参与活动后领取卡券！"), JSON_UNESCAPED_UNICODE));
    }
    $storeArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_store") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `status`=1 order by sort asc , id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]));
    $usercardArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_union_cardbag") . "where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid order by  id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    $storeCardList = array();
    foreach ($storeArr as $index => $store) {
        $storeCardList[$index] = $store;
        $u_store_id = $store["id"];
        $storeCardList[$index]["cardlist"] = array_values(array_filter($usercardArr, function ($item) use($u_store_id) {
            return $item["u_store_id"] == $u_store_id;
        }));
        $newCardList = array();
        foreach ($storeCardList[$index]["cardlist"] as $cardindex => $card) {
            $newCard = array("id" => $card["id"], "uniacid" => $card["uniacid"], "store_id" => $card["store_id"], "activity_types" => $card["activity_types"], "activity_id" => $card["activity_id"], "u_store_id" => $card["u_store_id"], "card_id" => $card["card_id"], "name" => $card["name"], "use_num" => $card["use_num"], "writeoff_num" => $card["writeoff_num"], "money" => $card["money"], "pay_money" => $card["pay_money"], "use_limit" => $card["use_limit"], "end_time" => $card["end_time"], "begin_time" => $card["begin_time"], "pic_url" => $card["pic_url"], "openid" => $card["openid"], "nickname" => $card["nickname"], "headurl" => $card["headurl"], "createtime" => $card["createtime"], "deltime" => $card["deltime"], "time_types" => getDataById("lywywl_ztb_obj_union_card", $card["card_id"], "time_types", -1), "time_day" => getDataById("lywywl_ztb_obj_union_card", $card["card_id"], "time_day", -1));
            $newCardList[$cardindex] = $newCard;
        }
        $storeCardList[$index]["cardlist"] = $newCardList;
    }
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_model = pdo_get(ztbNopreTable("obj_union_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    if ($join_model) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/myCard");
    exit;
}
if ($act == "qrCode") {
    $token = $_GPC["token"];
    $longurl = replaceDieDomain($config, __MURL("obj_union", array("act" => "writeStore", "token" => $token, "writeopenid" => $openid, "writetime" => TIMESTAMP), true, true), $user["id"], $object["id"], $user["id"]);
    $qr = qrcode(0, $longurl, false, "L", 5, 2);
    exit;
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
    if ($object["start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["name"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入您的门店名称！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($store["tel"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入门店联系电话！"), JSON_UNESCAPED_UNICODE));
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
    $model = pdo_get("lywywl_ztb_obj_union_store", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $object["id"], "openid" => $openid, "deltime" => 0));
    if ($model) {
        exit(json_encode(array("status" => 0, "msg" => "您已提交申请，请勿重复操作！"), JSON_UNESCAPED_UNICODE));
    }
    $store["uniacid"] = $uniacid;
    $store["store_id"] = $store_id;
    $store["activity_types"] = $activity_types;
    $store["activity_id"] = $object["id"];
    $store["logo_url"] = $_GPC["logo_url"];
    $store["openid"] = $openid;
    $store["sort"] = 4000;
    $store["status"] = 0;
    $store["auditing"] = 0;
    $store["updatetime"] = TIMESTAMP;
    $store["createtime"] = TIMESTAMP;
    $result = pdo_insert("lywywl_ztb_obj_union_store", $store);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因提交失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id, "deltime" => 0));
    if ($config["objstorepushtmp"] && $storeModel["openid"]) {
        if (isFollow($storeModel["openid"], $uniacid)) {
            $postdata = array("first" => array("value" => "{$object["title"]}，您的活动有新的商家申请入驻，请及时处理。", "color" => "#173177"), "keyword1" => array("value" => date("Y-m-d H:i", TIMESTAMP), "color" => "#173177"), "keyword2" => array("value" => "入驻商家名称：{$store["name"]}，联系电话：{$store["tel"]}", "color" => "#173177"), "remark" => array("value" => "点击查看入驻商家详情", "color" => "#173177"));
            $url = replaceDieDomain($config, __MURL("store.obj_union_store_wait", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
            $template_id = $config["objstorepushtmp"];
            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
        }
    }
    if ($config["objstorepushtmp_sub"] && $storeModel["openid"]) {
        $touser = $storeModel["openid"];
        $template_id = $config["objstorepushtmp_sub"];
        $postdata = array("thing3" => array("value" => $store["name"]), "time2" => array("value" => date("Y-m-d H:i", TIMESTAMP)), "phone_number4" => array("value" => $store["tel"]), "thing5" => array("value" => "入驻活动：{$object["title"]}"));
        $url = replaceDieDomain($config, __MURL("store.obj_union_store_wait", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
    }
    exit(json_encode(array("status" => 1, "msg" => "提交成功，请耐心等待审核！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "writeStore" || $act == "writeOff" || $act == "getWriteCardJsonList" || $act == "getUserWriteCard" || $act == "confirmWrite") {
    $storeList = array();
    $storeAllList = pdo_getall(ztbNopreTable("obj_union_store"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1));
    if (empty($storeAllList)) {
        if ($request_method == "post") {
            resultMsg(["status" => 0, "msg" => "对不起，商家信息不存在或已禁用！"]);
        } else {
            tip_redirect("对不起，商家信息不存在或已禁用！");
        }
    } else {
        $j = 0;
        $i = 0;
        while ($i < count($storeAllList)) {
            if (strpos("," . $storeAllList[$i]["openid"] . ",", "," . $openid . ",") !== false) {
                $storeList[$j] = $storeAllList[$i];
                $j++;
            }
            $i++;
        }
    }
    if (empty($storeList)) {
        if ($request_method == "post") {
            resultMsg(["status" => 0, "msg" => "对不起，您不是商家核销员！"]);
        } else {
            tip_redirect("对不起，您不是商家核销员！");
        }
    }
    if ($act == "writeStore") {
        $title = "选择核销商家";
        $writeopenid = $_GPC["writeopenid"];
        $writetime = $_GPC["writetime"];
        $u_store_id = $_GPC["u_store_id"];
        if (!empty($u_store_id)) {
            $url = __MURL("obj_union", array("act" => "writeOff", "token" => $token, "u_store_id" => $u_store_id, "writeopenid" => $writeopenid, "writetime" => $writetime), true, false);
            header("Location:" . $url);
            exit;
        }
        if (count($storeList) == 1) {
            $url = __MURL("obj_union", array("act" => "writeOff", "token" => $token, "u_store_id" => $storeList[0]["id"], "writeopenid" => $writeopenid, "writetime" => $writetime), true, false);
            header("Location:" . $url);
            exit;
        }
        include $this->template("other/union_writeoff/writeStore");
        exit;
    }
    $u_store_id = $_GPC["u_store_id"];
    $storeModel = array();
    if (empty($u_store_id)) {
        if ($request_method == "post") {
            resultMsg(["status" => 0, "msg" => "对不起，参数错误！"]);
        } else {
            tip_redirect("对不起，参数错误！");
        }
    } else {
        $storeModel = pdo_get(ztbNopreTable("obj_union_store"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "id" => $u_store_id));
        if (empty($storeModel)) {
            if ($request_method == "post") {
                resultMsg(["status" => 0, "msg" => "对不起，商家信息不存在或已禁用！"]);
            } else {
                tip_redirect("对不起，商家信息不存在或已禁用！");
            }
        }
    }
    if ($act == "writeOff") {
        $title = $storeModel["name"] . "-核销管理";
        $storeCardList = pdo_getall(ztbNopreTable("obj_union_card"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "u_store_id" => $u_store_id));
        $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `u_store_id`=:u_store_id";
        $params = array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":u_store_id" => $u_store_id);
        $countSql = "SELECT COUNT(*) FROM " . ztbTable("obj_union_cardbag") . $where;
        $receiveTotal = pdo_fetchcolumn($countSql, $params);
        $countSql = "SELECT COUNT(*) FROM " . ztbTable("obj_union_writeoff") . $where;
        $writeoffTotal = pdo_fetchcolumn($countSql, $params);
        $writeopenid = $_GPC["writeopenid"];
        $writetime = $_GPC["writetime"];
        include $this->template("other/union_writeoff/writeOff");
        exit;
    }
    if ($act == "getWriteCardJsonList") {
        $pindex = max(1, intval($_GPC["page"]));
        $psize = max(10, intval($_GPC["pageSize"]));
        $writeopenid = $_GPC["writeopenid"];
        $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `u_store_id`=:u_store_id \r\n        and `openid`=:openid";
        $params = array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":u_store_id" => $u_store_id, ":openid" => $writeopenid);
        $orderby = sprintf(" ORDER BY createtime desc ");
        $sql = "SELECT * FROM " . ztbTable("obj_union_writeoff") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
        $list = pdo_fetchall($sql, $params);
        $listData = array();
        $listData["rows"] = [];
        $arrlength = count($list);
        $i = 0;
        while ($i < $arrlength) {
            $userCardModel = pdo_get(ztbNopreTable("obj_union_cardbag"), array("id" => $list[$i]["user_card_id"]));
            $listData["rows"][] = ["nickname" => $list[$i]["nickname"], "headurl" => tomedia($list[$i]["headurl"]), "card_name" => $userCardModel["name"], "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
            $i++;
        }
        resultMsg($listData);
    }
    if ($act == "getUserWriteCard" && $request_method == "post") {
        $writeopenid = $_GPC["writeopenid"];
        $writetime = max(0, intval($_GPC["writetime"]));
        if (mb_strlen($writeopenid) == 0) {
            resultMsg(["status" => 0, "msg" => "对不起，核销信息错误！"]);
        }
        if (time() - $writetime > 30 * 60) {
            resultMsg(["status" => 0, "msg" => "对不起，核销二维码超时，请重新生成！"]);
        }
        $userCardList = pdo_getall(ztbNopreTable("obj_union_cardbag"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $u_store_id, "openid" => $writeopenid, "use_num >" => 0, "end_time >" => time()));
        if (empty($userCardList)) {
            resultMsg(["status" => 0, "msg" => "对不起，用户无可用卡券！"]);
        }
        $cardList = array();
        $i = 0;
        while ($i < count($userCardList)) {
            $cardList[$i]["user_card_id"] = $userCardList[$i]["id"];
            $cardList[$i]["card_id"] = $userCardList[$i]["card_id"];
            $cardList[$i]["name"] = $userCardList[$i]["name"];
            $cardList[$i]["use_num"] = $userCardList[$i]["use_num"];
            $cardList[$i]["writeoff_num"] = $userCardList[$i]["writeoff_num"];
            $cardList[$i]["money"] = $userCardList[$i]["money"];
            $cardList[$i]["use_limit"] = $userCardList[$i]["use_limit"];
            $cardList[$i]["end_time"] = date("Y-m-d H:i", $userCardList[$i]["end_time"]);
            $cardList[$i]["pic_url"] = tomedia($userCardList[$i]["pic_url"]);
            $cardList[$i]["store_name"] = $storeModel["name"];
            $storeList = unserialize($storeModel["store_map_list"]);
            if (count($storeList) > 1) {
                $cardList[$i]["store_name"] = $storeModel["name"] . "(" . count($storeList) . "店通用)";
            }
            $i++;
        }
        resultMsg(["status" => 1, "cardList" => $cardList]);
    }
    if ($act == "confirmWrite" && $request_method == "post") {
        $writeopenid = $_GPC["writeopenid"];
        $writetime = max(0, intval($_GPC["writetime"]));
        $user_card_id = intval($_GPC["user_card_id"]);
        if (!thread_lock("union_write_lock_" . $writeopenid)) {
            exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
        }
        if (mb_strlen($writeopenid) == 0) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，核销信息错误！"]);
        }
        if (time() - $writetime > 30 * 60) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，核销超时，请重新扫描！"]);
        }
        if ($user_card_id <= 0) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，核销信息错误！"]);
        }
        $userCardModel = pdo_get(ztbNopreTable("obj_union_cardbag"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $u_store_id, "openid" => $writeopenid, "id" => $user_card_id));
        if (empty($userCardModel)) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，卡券不存在！"]);
        }
        if ($userCardModel["use_num"] <= 0) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，卡券无可核销次数！"]);
        }
        if ($userCardModel["end_time"] < time()) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，卡券已过期！"]);
        }
        if ($userCardModel["begin_time"] > time()) {
            thread_unlock("union_write_lock_" . $writeopenid);
            resultMsg(["status" => 0, "msg" => "对不起，卡券没有到可用时间！"]);
        }
        $userCardUpdateModel = array("use_num -=" => 1, "writeoff_num +=" => 1);
        $draw = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "store_id" => $store_id, "uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $writeopenid, "types" => -1));
        if (!empty($draw)) {
            if ($draw["is_settlement"] == 0) {
                pdo_update(ztbNopreTable("store_account"), array("money +=" => floatval($draw["endmoney"])), array("id" => $draw["store_id"]));
                $note = "参与活动：" . date("Y-m-d H:i:s", time()) . " 会员【" . $draw["nickname"] . "】参与活动：" . $object["title"] . "，支付金额：" . (floatval($draw["paymoney"]) + floatval($draw["mymoney"])) . "元";
                $storeBillModel = array();
                $storeBillModel["uniacid"] = $_W["uniacid"];
                $storeBillModel["store_id"] = $draw["store_id"];
                $storeBillModel["types"] = 12;
                $storeBillModel["detail_id"] = $draw["id"];
                $storeBillModel["money"] = $draw["endmoney"];
                $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $draw["store_id"]), "money");
                $storeBillModel["note"] = $note;
                $storeBillModel["createtime"] = time();
                pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                pdo_update(ztbNopreTable("user_draw"), array("is_settlement" => 1, "admins" => $openid), array("id" => $draw["id"]));
            }
        }
        if ($userCardModel["writeoff_num"] == 0) {
            $card_Info = getDataById(ztbNopreTable("obj_union_card"), $userCardModel["card_id"]);
            if ($card_Info["time_types"] == 2) {
                $userCardUpdateModel["end_time"] = time() + intval($card_Info["time_day"]) * 24 * 60 * 60;
            }
        }
        pdo_update(ztbNopreTable("obj_union_cardbag"), $userCardUpdateModel, array("id" => $userCardModel["id"]));
        $recordUnionWriteoffModel = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "u_store_id" => $u_store_id, "card_id" => $userCardModel["card_id"], "user_card_id" => $userCardModel["id"], "openid" => $userCardModel["openid"], "nickname" => $userCardModel["nickname"], "headurl" => $userCardModel["headurl"], "admins" => $openid, "createtime" => time());
        pdo_insert(ztbNopreTable("obj_union_writeoff"), $recordUnionWriteoffModel);
        thread_unlock("union_write_lock_" . $writeopenid);
        resultMsg(["status" => 1, "msg" => "核销成功！"]);
    }
}