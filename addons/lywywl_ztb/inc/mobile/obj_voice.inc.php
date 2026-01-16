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
$allow_acts = array("index", "storeJoin", "share", "join", "invest", "drawexplain", "invite_draw", "register", "store", "voicedraw", "voiceupload", "storeBosses", "ajaxStore", "apply", "writeOff", "getUserDrawJsonList", "getUserDrawInfo", "confirmWrite", "writeOffCard", "getCardJsonList", "getCardInfo", "cardConfirmWrite");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$activity_types = 24;
$token = $_GPC["token"];
$origin_id = intval($_GPC["origin_id"]);
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$plug_appad = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_appad");
if ($plug_appad) {
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_voice");
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
$storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
$store_config = iunserializer($storeAccount["config"]);
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
$model2 = pdo_get(ztbNopreTable("obj_voice"), array("deltime" => 0, "activity_id" => $model["id"]));
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
    if (!empty($_GET["join_id"])) {
        $join_id = $_GET["join_id"];
        isetcookie("join_id_voice_" . $object["id"], $_GET["join_id"], 3600 * 24);
    } else {
        $join_id = $_GPC["join_id_voice_" . $object["id"]];
    }
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_voice_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_voice_" . $object["id"], "ad", 3600 * 24);
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
    $industryList = pdo_fetchall("SELECT * FROM " . ztbTable("sys_industry") . " where `status`=1 and `deltime`=0 and `status`=1 order by sort asc ", array(":uniacid" => $_W["uniacid"]));
    $storeArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_voice_store") . "where `deltime`=0 and `uniacid`=:uniacid and `activity_types`=:activity_types and `activity_id`=:activity_id and `store_id`=:store_id and `status`=1 and `auditing`=1 order by sort asc , id desc ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"]));
    $prizeTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_prize") . " where `uniacid`=:uniacid and `activity_types`=:activity_types and `activity_id`=:activity_id and `voice_store_id`>0 and `types`>0 and `status`=1 ", array(":uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"]));
    if ($object["is_show_store"] == 0) {
        $storeprizeArr = array();
        $arrlength = count($storeArr);
        $i = 0;
        while ($i < $arrlength) {
            $prizelistarr = getstoreprizelist($storeArr[$i]["id"], $activity_types, $object["id"]);
            $prizetotal_num = 0;
            foreach ($prizelistarr as $key => $val) {
                if ($val["surplus"] > 0) {
                    $prizetotal_num++;
                }
            }
            if (!empty($prizelistarr)) {
                $storeprizeArr[$i]["storeinfo"] = $storeArr[$i];
                $storeprizeArr[$i]["prizelist"]["countnum"] = count($prizelistarr);
                $storeprizeArr[$i]["prizelist"]["surplusnum"] = $prizetotal_num;
            }
            $i++;
        }
    } else {
        $storeprizeArr = array();
        $arrlength = count($storeArr);
        $i = 0;
        while ($i < $arrlength) {
            $prizelistarr = getstoreprizelist($storeArr[$i]["id"], $activity_types, $object["id"]);
            if (!empty($prizelistarr)) {
                $storeprizeArr[$i]["storeinfo"] = $storeArr[$i];
                foreach ($industryList as $keys => $value) {
                    if ($value["id"] == $storeArr[$i]["industry_id"]) {
                        $storeprizeArr[$i]["storeinfo"]["industry_name"] = $value["name"];
                    }
                }
                if (empty($storeprizeArr[$i]["storeinfo"]["industry_name"])) {
                    $storeprizeArr[$i]["storeinfo"]["industry_name"] = "未知";
                }
                $storeprizeArr[$i]["prizelist"]["countnum"] = count($prizelistarr);
                $countisprize = 0;
                $storeprizeArr[$i]["prizelist"]["prizeinfo"] = $prizelistarr;
            }
            $i++;
        }
    }
    $userDrawModel = pdo_fetchcolumn("SELECT * FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and `store_id`=:store_id and `deltime`=0 and `activity_types`=:activity_types and `activity_id`=:activity_id and `openid`=:openid and `types`!=-1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], "openid" => $openid));
    $share_id = 0;
    $join_model = pdo_get(ztbNopreTable("obj_voice_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid, "activity_types" => $activity_types, "activity_id" => $object["id"]));
    if ($join_model) {
        $share_id = $join_model["id"];
        $_share["link"] = __MURL("scan", array("token" => $token, "join_id" => $join_model["id"], "origin_id" => $origin_id), false, TRUE);
    } else {
        if ($object["join_is_register"] > 0) {
            $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
        } else {
            $insert_join_model = array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "invite" => 0, "createtime" => TIMESTAMP);
            if ($userDrawModel) {
                $insert_join_model["register_data"] = $userDrawModel["register_data"];
            } else {
                $insert_join_model["register_data"] = '';
            }
            if ($join_id > 0) {
                $share_join_model = pdo_get("lywywl_ztb_obj_voice_join", array("store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_id, "uniacid" => $_W["uniacid"]));
                $insert_join_model["is_share"] = 1;
                $insert_join_model["share_openid"] = $share_join_model["openid"];
                $insert_join_model["share_nickname"] = $share_join_model["nickname"];
                $insert_join_model["share_headurl"] = $share_join_model["headurl"];
            }
            $result = pdo_insert("lywywl_ztb_obj_voice_join", $insert_join_model);
            if (!empty($result)) {
                $share_id = pdo_insertid();
                pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("store_id" => $store_id, "id" => $object["id"]));
                if ($join_id > 0) {
                    pdo_update(ztbTable("obj_voice_join", false), array("invite +=" => 1), array("store_id" => $store_id, "id" => $join_id));
                }
                if (!empty($originModel)) {
                    pdo_update(ztbTable("marketing_user", false), array("join_num +=" => 1), array("id" => $origin_id));
                }
                $_share["link"] = __MURL("scan", array("token" => $token, "join_id" => $share_id, "origin_id" => $origin_id), false, TRUE);
            } else {
                $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
            }
        }
    }
    $joinUserList = pdo_fetchall("SELECT nickname,headurl FROM " . ztbTable("obj_voice_join") . "where `activity_types`=:activity_types and `activity_id`=:activity_id and `store_id`=:store_id  order by id desc LIMIT 30 ", array("activity_types" => $activity_types, "activity_id" => $object["id"], ":store_id" => $store_id));
    if (count($joinUserList) < 30 && intval($object["bogus_join_num"]) > 0) {
        $bogusJoinCount = 30 - count($joinUserList);
        if (30 > count($joinUserList) + intval($object["bogus_join_num"])) {
            $bogusJoinCount = intval($object["bogus_join_num"]);
        }
        if (intval($object["bogus_join_gender"]) > 0) {
            $userList = pdo_fetchall("SELECT nickname,avatar FROM " . tablename("mc_members") . " where avatar<>\"\" and `gender`=" . $object["bogus_join_gender"] . " order by uid desc LIMIT 29");
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
    $drawsql = "SELECT * FROM " . ztbTable("user_draw") . " WHERE `uniacid` = :uniacid AND `activity_types` = :activity_types AND `activity_id` = :activity_id AND `store_id`=:store_id AND `types`!=-1 order by id desc limit 20";
    $drawparams = array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":store_id" => $store_id);
    $drawUserList = pdo_fetchall($drawsql, $drawparams);
    foreach ($drawUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $total_drawsql = "SELECT count(id) FROM " . ztbTable("user_draw") . " WHERE `uniacid` = :uniacid AND `activity_types` = :activity_types AND `activity_id` = :activity_id AND `store_id`=:store_id AND `types`!=-1 order by id desc";
    $total_drawparams = array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":store_id" => $store_id);
    $total_drawUserList = pdo_fetchcolumn($total_drawsql, $total_drawparams);
    $topUserList = pdo_getall(ztbTable("obj_voice_join", false), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"]), array("nickname", "headurl", "invite"), '', "invite desc", array(10));
    foreach ($topUserList as &$d_user) {
        $d_user["nickname"] = substr_replace($d_user["nickname"], "*", 3, -3);
    }
    unset($d_user);
    $top_one = array("nickname" => $topUserList[0]["nickname"], "headurl" => $topUserList[0]["headurl"], "invite" => $topUserList[0]["invite"]);
    $top_two = array("nickname" => $topUserList[1]["nickname"], "headurl" => $topUserList[1]["headurl"], "invite" => $topUserList[1]["invite"]);
    $top_three = array("nickname" => $topUserList[2]["nickname"], "headurl" => $topUserList[2]["headurl"], "invite" => $topUserList[2]["invite"]);
   
    if (!empty($originModel)) {
        $_share["title"] = "【客服:" . $originModel["name"] . "】" . replaceShareInfo($object["share_title"]);
    } else {
        $_share["title"] = replaceShareInfo($object["share_title"]);
    }
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    pdo_update(ztbTable("obj_activity", false), array("click_num +=" => 1), array("uniacid" => $_W["uniacid"], "id" => $object["id"]));
    if (!empty($originModel)) {
        pdo_update(ztbTable("marketing_user", false), array("click_num +=" => 1), array("uniacid" => $_W["uniacid"], "id" => $origin_id));
    }
    $share_number = $object["repost_num"] + $object["bogus_repost_num"];
    $click_number = $object["bogus_click_num"] + $object["click_num"];
    $partake_number = $object["bogus_join_num"] + $object["join_num"];
    $shop_number = count($storeArr);
    $draw_number = $total_drawUserList;
    if ($object["banner_types"] == 1) {
        $object["multi_banner_url"] = explode(",", $object["multi_banner_url"]);
    }
    if ($object["get_types"] != 0) {
        if ($join_id > 0) {
            $joinModel = pdo_get("lywywl_ztb_obj_voice_join", array("uniacid" => $_W["uniacid"], "activity_id" => $object["id"], "activity_types" => $activity_types, "id" => $join_id));
            if ($joinModel["openid"] != $openid) {
                $result = pdo_get(ztbTable("obj_voice_click", false), array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $joinModel["openid"], "visit_openid" => $openid));
                if (empty($result)) {
                    $limit_clicks = intval($object["limit_clicks"]);
                    $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and `visit_openid`=:visit_openid", array(":uniacid" => $uniacid, ":activity_id" => $object["id"], ":visit_openid" => $openid));
                    $data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $joinModel["openid"], "visit_openid" => $openid, "visit_nickname" => $userinfo["nickname"], "visit_headurl" => $userinfo["headimgurl"], "ip" => $_W["clientip"], "createtime" => TIMESTAMP);
                    if ($object["winer_num"] > 0) {
                        if ($limit_clicks == 0) {
                            $result = pdo_insert(ztbTable("obj_voice_click", false), $data);
                            pdo_update(ztbTable("obj_voice_join", false), array("visit +=" => 1), array("id" => $join_id));
                        } else {
                            if ($clicks_count < $limit_clicks) {
                                $result = pdo_insert(ztbTable("obj_voice_click", false), $data);
                                pdo_update(ztbTable("obj_voice_join", false), array("visit +=" => 1), array("id" => $join_id));
                            }
                        }
                    }
                }
            }
        }
    }
    if ($object["is_draw_types"] == 1) {
        if ($join_id > 0) {
            $joinModel_parent = pdo_get(ztbNopreTable("obj_voice_join"), array("activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_id, "uniacid" => $_W["uniacid"]));
            if (!empty($joinModel_parent)) {
                $prizeList = pdo_getall(ztbNopreTable("obj_prize", false), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "voice_store_id" => 0, "deltime" => 0, "status" => 1), array(), '', "sort asc");
                if (!empty($prizeList)) {
                    $isdrawprize = false;
                    if (intval($object["get_types"]) == 1) {
                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND activity_types = :activity_types AND activity_id = :activity_id AND openid = :openid AND is_receive_types=1", array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel_parent["openid"]));
                        if ($count < intval($object["limit_num"])) {
                            $isdrawprize = true;
                        }
                    }
                    if (intval($object["get_types"]) == 2) {
                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND activity_types = :activity_types AND activity_id = :activity_id AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid  AND is_receive_types=1 ", array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel_parent["openid"]));
                        if ($count < intval($object["limit_num"])) {
                            $isdrawprize = true;
                        }
                    }
                    if (intval($object["get_types"]) == 3) {
                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND activity_types = :activity_types AND activity_id = :activity_id AND openid = :openid AND is_receive_types=1 ", array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel_parent["openid"]));
                        $isdrawprize = true;
                    }
                    if ($isdrawprize == true) {
                        if (intval($object["get_types"]) == 1 || intval($object["get_types"]) == 3) {
                            $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and activity_types = :activity_types and `openid`=:openid  and `status`=:status ", array(":uniacid" => $uniacid, "activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel_parent["openid"], ":status" => 0));
                        }
                        if (intval($object["get_types"]) == 2) {
                            $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and activity_types = :activity_types and `openid`=:openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') and `status`=:status ", array(":uniacid" => $uniacid, "activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $joinModel_parent["openid"], ":status" => 0));
                        }
                        if ($clicks_count / $object["winer_num"] >= 1) {
                            $prizeModel = null;
                            foreach ($prizeList as $key => $val) {
                                if (!(intval($val["surplus"]) <= 0)) {
                                    if (!(intval($val["odds"]) <= 0)) {
                                        if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                $arr[$key] = $val["odds"];
                                            } else {
                                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND is_receive_types=1 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
                                                if (!($count >= intval($val["limitnum"]))) {
                                                    $arr[$key] = $val["odds"];
                                                } else {
                                                }
                                            }
                                        } else {
                                            $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $openid, "is_receive_types" => 1), "count(*)");
                                            if (!($count >= intval($val["limitnum"]))) {
                                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                    $arr[$key] = $val["odds"];
                                                } else {
                                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND is_receive_types=1 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
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
                                $userinfo = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "openid" => $joinModel_parent["openid"]));
                                $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinModel_parent["openid"], "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headurl"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP, "is_receive_types" => 1);
                                $result = pdo_insert(ztbNopreTable("user_draw", false), $draw_data);
                                $writecode = '';
                                if (!empty($result)) {
                                    $draw_id = pdo_insertid();
                                    $hashids = Hashids::instance(6, "lywyztb", '');
                                    $encode_id = $hashids->encode($draw_id);
                                    $draw_data = array("writecode" => $encode_id);
                                    pdo_update(ztbTable("user_draw", false), $draw_data, array("id" => $draw_id));
                                    $writecode = $encode_id;
                                }
                                if (intval($prizeModel["types"]) == 0) {
                                    pdo_update(ztbNopreTable("user_draw"), array("status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                } else {
                                    if (intval($prizeModel["types"]) == 1) {
                                        if (intval($prizeModel["create_types"]) == 1) {
                                            list($min, $max) = explode("-", $prizeModel["score"]);
                                            $prizeModel["score"] = mt_rand($min, $max);
                                        }
                                        $note = "抽奖获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"];
                                        pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("store_id" => $store_id, "openid" => $openid));
                                        $userScoreModel = array();
                                        $userScoreModel["uniacid"] = $uniacid;
                                        $userScoreModel["store_id"] = $store_id;
                                        $userScoreModel["openid"] = $openid;
                                        $userScoreModel["nickname"] = $userinfo["nickname"];
                                        $userScoreModel["headurl"] = $userinfo["headimgurl"];
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
                                            $note = "抽奖获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                                            $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                                            if ($storeAccount["money"] >= $prizeModel["sys"]) {
                                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("store_id" => $store_id, "openid" => $openid));
                                                $userBillModel = array();
                                                $userBillModel["uniacid"] = $uniacid;
                                                $userBillModel["store_id"] = $store_id;
                                                $userBillModel["openid"] = $openid;
                                                $userBillModel["nickname"] = $userinfo["nickname"];
                                                $userBillModel["headurl"] = $userinfo["headimgurl"];
                                                $userBillModel["types"] = 3;
                                                $userBillModel["detail_id"] = $draw_id;
                                                $userBillModel["money"] = $prizeModel["sys"];
                                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
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
                                                $sysReissueModel["openid"] = $openid;
                                                $sysReissueModel["nickname"] = $userinfo["nickname"];
                                                $sysReissueModel["headurl"] = $userinfo["headimgurl"];
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
                                                $note = "抽奖获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                                                $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                                                if ($storeAccount["money"] >= $prizeModel["money"]) {
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
                                                    $result = sendWeixinMchPay($openid, floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                                                    if (!($result === true)) {
                                                        $store_config = iunserializer($storeAccount["config"]);
                                                        $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                                                        if ($is_mchpayfail_usermoney == 0) {
                                                            $sysReissueModel = array();
                                                            $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                                            $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                                            $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                                            $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                                            $sysReissueModel["draw_id"] = $draw_id;
                                                            $sysReissueModel["types"] = 1;
                                                            $sysReissueModel["openid"] = $openid;
                                                            $sysReissueModel["nickname"] = $userinfo["nickname"];
                                                            $sysReissueModel["headurl"] = $userinfo["headimgurl"];
                                                            $sysReissueModel["status"] = 0;
                                                            $sysReissueModel["money"] = $prizeModel["money"];
                                                            $sysReissueModel["desc"] = $prizeModel["name"];
                                                            $sysReissueModel["is_store_sell"] = 1;
                                                            $sysReissueModel["updatetime"] = TIMESTAMP;
                                                            $sysReissueModel["createtime"] = TIMESTAMP;
                                                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                        } else {
                                                            pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $openid));
                                                            $userBillModel = array();
                                                            $userBillModel["uniacid"] = $uniacid;
                                                            $userBillModel["store_id"] = $store_id;
                                                            $userBillModel["openid"] = $openid;
                                                            $userBillModel["nickname"] = $userinfo["nickname"];
                                                            $userBillModel["headurl"] = $userinfo["headimgurl"];
                                                            $userBillModel["types"] = 3;
                                                            $userBillModel["detail_id"] = $draw_id;
                                                            $userBillModel["money"] = $prizeModel["money"];
                                                            $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
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
                                                    $sysReissueModel["openid"] = $openid;
                                                    $sysReissueModel["nickname"] = $userinfo["nickname"];
                                                    $sysReissueModel["headurl"] = $userinfo["headimgurl"];
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
                                                if (!(intval($prizeModel["types"]) == 4)) {
                                                    if (intval($prizeModel["types"]) == 5) {
                                                        $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                                        if (empty($storeCard)) {
                                                            thread_unlock($openid);
                                                            exit(json_encode(array("status" => 0, "msg" => "商家卡券不存在或已被禁用"), JSON_UNESCAPED_UNICODE));
                                                        }
                                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                                if ($prizeModel["is_sms"] == 1 && $storeAccount["sms"] > 0) {
                                    if (!empty($prizeModel["sms_tmp"])) {
                                        if (!empty($userinfo["mobile"])) {
                                            $sms_uid = $config["sms_uid"];
                                            $sms_key = $config["sms_key"];
                                            $mobile = $userinfo["mobile"];
                                            $sms_content = $prizeModel["sms_tmp"];
                                            $sms_content = str_replace("{NICKNAME}", $userinfo["nickname"], $sms_content);
                                            $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                            $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                            if (empty($storeAccount["zucp_ext"])) {
                                                $sms_content .= "【{$config["name"]}】";
                                            } else {
                                                $sms_content .= "【{$storeAccount["name"]}】";
                                            }
                                            $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeAccount["zucp_ext"], '', '');
                                            if ($result === true) {
                                                pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                            }
                                        }
                                    }
                                } else {
                                    if (intval($object["is_sms"]) == 1 && $storeAccount["sms"] > 0) {
                                        if (!empty($object["sms_tmp"])) {
                                            if (!empty($userinfo["mobile"])) {
                                                $sms_uid = $config["sms_uid"];
                                                $sms_key = $config["sms_key"];
                                                $mobile = $userinfo["mobile"];
                                                $sms_content = $object["sms_tmp"];
                                                $sms_content = str_replace("{NICKNAME}", $userinfo["nickname"], $sms_content);
                                                $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                if (empty($storeAccount["zucp_ext"])) {
                                                    $sms_content .= "【{$config["name"]}】";
                                                } else {
                                                    $sms_content .= "【{$storeAccount["name"]}】";
                                                }
                                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeAccount["zucp_ext"], '', '');
                                                if ($result === true) {
                                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                }
                                            }
                                        }
                                    }
                                }
                                pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                                pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["id"]));
                                if (!empty($originModel)) {
                                    pdo_update(ztbTable("marketing_user", false), array("get_num +=" => 1), array("uniacid" => $uniacid, "id" => $origin_id));
                                }
                                pdo_update(ztbTable("obj_voice_join", false), array("get_num +=" => 1), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $userinfo["openid"]));
                                if (intval($object["get_types"]) == 1 || intval($object["get_types"]) == 3) {
                                    pdo_query("UPDATE " . ztbTable("obj_voice_click") . " SET status = 1 WHERE uniacid=:uniacid and activity_types = :activity_types AND activity_id=:activity_id AND openid=:openid AND status=0 limit " . $object["winer_num"], array(":uniacid" => $_W["uniacid"], ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $userModel["openid"]));
                                }
                                if (intval($object["get_types"]) == 2) {
                                    pdo_query("UPDATE " . ztbTable("obj_voice_click") . " SET status = 1 WHERE uniacid=:uniacid and activity_types = :activity_types AND activity_id=:activity_id AND openid=:openid AND status=0 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') limit " . $object["winer_num"], array(":uniacid" => $_W["uniacid"], ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $userModel["openid"]));
                                }
                            }
                        }
                    }
                }
            }
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
    $userTeamModel = pdo_get(ztbNopreTable("marketing_user"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $object["id"], "status" => 1, "openid" => $openid));
    if (!empty($userTeamModel)) {
        $is_marketing = true;
    }
    include $this->template("tmp/" . $tmp["resource"] . "/index");
    exit;
}
if ($act == "join" && $request_method == "post") {
    $join_id = $_GPC["join_id"];
    $v_store_id = intval($_GPC["v_store_id"]);
    if (empty($object)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的联盟拓客活动不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($object["status"]) != 1) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的联盟拓客活动已失效！"), JSON_UNESCAPED_UNICODE));
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
    $registerFields = serialize($registerFields);
    $join_model = pdo_get("lywywl_ztb_obj_voice_join", array("store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
    if ($join_model) {
        if ($object["join_is_register"] > 0 && empty($join_model["register_data"])) {
            pdo_update(ztbTable("obj_voice_join", false), array("register_data" => $registerFields), array("uniacid" => $uniacid, "store_id" => $store_id, "id" => $join_model["id"]));
            isetcookie("reg_objvoice_" . $object["id"], base64_encode($registerFields), 3600 * 24);
        }
        exit(json_encode(array("status" => 1, "msg" => "参与成功，邀请好友参与可获得奖励哦！"), JSON_UNESCAPED_UNICODE));
    }
    $insert_join_model = array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "origin_id" => $origin_id, "origin_team_id" => $originModel["team_id"], "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "qrcode_url" => '', "invite" => 0, "createtime" => TIMESTAMP);
    $insert_join_model["register_data"] = $registerFields;
    if ($join_id > 0) {
        $share_join_model = pdo_get("lywywl_ztb_obj_voice_join", array("store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_id, "uniacid" => $_W["uniacid"]));
        $insert_join_model["is_share"] = 1;
        $insert_join_model["share_openid"] = $share_join_model["openid"];
        $insert_join_model["share_nickname"] = $share_join_model["nickname"];
        $insert_join_model["share_headurl"] = $share_join_model["headurl"];
    }
    $result = pdo_insert("lywywl_ztb_obj_voice_join", $insert_join_model);
    if (!empty($result)) {
        if ($join_id > 0) {
            pdo_update(ztbTable("obj_voice_join", false), array("invite +=" => 1), array("uniacid" => $uniacid, "id" => $join_id));
        }
        pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $object["id"]));
        if (!empty($originModel)) {
            pdo_update(ztbTable("marketing_user", false), array("join_num +=" => 1), array("uniacid" => $uniacid, "id" => $origin_id));
        }
        isetcookie("reg_objvoice_" . $object["id"], base64_encode($registerFields), 3600 * 24);
        exit(json_encode(array("status" => 1, "v_store_id" => $v_store_id, "msg" => "参与成功，赶快去领福利吧！"), JSON_UNESCAPED_UNICODE));
    } else {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因参与失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "share" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get(ztbNopreTable("obj_voice_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
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
            pdo_update(ztbTable("obj_voice_join", false), array("qrcode_url" => $file_path), array("id" => $join_model["id"]));
            exit(json_encode(array("status" => 1, "msg" => "恭喜您,专属海报创建成功！", "path" => $file_path), JSON_UNESCAPED_UNICODE));
        } else {
            exit(json_encode(array("status" => 0, "msg" => "二维码生成失败，请稍后重试！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        exit(json_encode(array("status" => 1, "msg" => "恭喜您，专属海报创建成功！", "path" => $join_model["qrcode_url"]), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "drawexplain" && $request_method == "post") {
    thread_unlock($openid);
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($object)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包活动不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($object["status"]) != 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包活动已失效！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($object["get_types"]) == 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包邀请返利机制已关闭，请敬请关注最新动态！"), JSON_UNESCAPED_UNICODE));
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
    $joinModel = pdo_get("lywywl_ztb_obj_voice_join", array("activity_types" => $activity_types, "store_id" => $store_id, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
    if (empty($joinModel)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "请先参与后领奖！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = $_GPC["reg_objvoice_" . $object["id"]];
    if ($object["join_is_register"] == 1) {
        if (empty($joinModel["register_data"]) && empty($register_data)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "register", "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if (empty($register_data) && $object["join_is_register"] == 1) {
        return false;
    }
    $prizeList = pdo_getall(ztbTable("obj_prize", false), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "voice_store_id" => 0), array(), '', "sort asc");
    if (empty($prizeList)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "活动太火爆！奖品已被领完了亲，商家正在补充奖品，请稍后重试！"), JSON_UNESCAPED_UNICODE));
    } else {
        $prize_num_surplus = 0;
        foreach ($prizeList as $key => $val) {
            if ($val["surplus"] > 0) {
                $prize_num_surplus++;
            }
        }
        if ($prize_num_surplus == 0) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "活动太火爆！奖品已被领完了亲，商家正在补充奖品，请稍后重试！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if (intval($object["get_types"]) == 1) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND `store_id`=:store_id AND activity_types = :activity_types AND activity_id = :activity_id AND openid = :openid AND is_receive_types=1", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
        if ($count >= intval($object["limit_num"])) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "亲，您参与本次活动已达到抽奖上限，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if (intval($object["get_types"]) == 2) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND `store_id`=:store_id AND activity_types = :activity_types AND activity_id = :activity_id AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid  AND is_receive_types=1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
        if ($count >= intval($object["limit_num"])) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "亲，系统每日限制抽奖" . $object["limit_num"] . "次，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if (intval($object["get_types"]) == 3) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND `store_id`=:store_id AND activity_types = :activity_types AND activity_id = :activity_id AND openid = :openid AND is_receive_types=1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    }
    if (intval($object["get_types"]) == 1 || intval($object["get_types"]) == 3) {
        $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and activity_types = :activity_types and `openid`=:openid  and `status`=:status ", array(":uniacid" => $uniacid, ":store_id" => $store_id, "activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid, ":status" => 0));
    }
    if (intval($object["get_types"]) == 2) {
        $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and activity_types = :activity_types and `openid`=:openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') and `status`=:status ", array(":uniacid" => $uniacid, ":store_id" => $store_id, "activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid, ":status" => 0));
    }
    $need_click_num = 0;
    if ($clicks_count / $object["winer_num"] < 1) {
        $need_click_num = $object["winer_num"] - $clicks_count % $object["winer_num"];
    }
    $result_data = array("need_click_num" => $need_click_num, "visit" => $joinModel["visit"], "store_id" => $store_id, "count" => $count ? $count : 0, "limit_num" => $object["limit_num"], "is_draw_types" => $object["is_draw_types"], "get_types" => $object["get_types"]);
    thread_unlock($openid);
    exit(json_encode(array("status" => 1, "is_voice_click" => 1, "result_data" => $result_data), JSON_UNESCAPED_UNICODE));
}
if ($act == "invite_draw" && $request_method == "post") {
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($object)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包活动不存在！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($object["status"]) != 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包活动已失效！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($object["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($object["get_types"]) == 0) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包邀请返利机制已关闭，请敬请关注最新动态！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["is_draw_types"] == 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，此中奖模式只支持手动中奖，您现在是自动中奖模式！"), JSON_UNESCAPED_UNICODE));
    }
    if (intval($object["get_types"]) == 1) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND store_id = :store_id AND activity_types = :activity_types AND activity_id = :activity_id AND openid = :openid AND is_receive_types=1", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
        if ($count >= intval($object["limit_num"])) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "亲，您参与本次活动已达到抽奖上限，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if (intval($object["get_types"]) == 2) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND store_id = :store_id AND activity_types = :activity_types AND activity_id = :activity_id AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid  AND is_receive_types=1 ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
        if ($count >= intval($object["limit_num"])) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "亲，系统每日限制抽奖" . $object["limit_num"] . "次，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if (intval($object["get_types"]) == 3) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid = :uniacid AND store_id = :store_id AND activity_types = :activity_types AND activity_id = :activity_id AND openid = :openid", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
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
    $joinModel = pdo_get("lywywl_ztb_obj_voice_join", array("activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "store_id" => $store_id, "uniacid" => $_W["uniacid"]));
    if (empty($joinModel)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "请先参与后领奖！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = base64_decode($_GPC["reg_objvoice_" . $object["id"]]);
    if ($object["join_is_register"] == 1) {
        if (empty($joinModel["register_data"]) && empty($register_data)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "register", "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
        } else {
            if (!empty($joinModel["register_data"]) && empty($register_data)) {
                $register_data = $joinModel["register_data"];
            }
        }
    }
    if (intval($object["get_types"]) == 3) {
        $object["winer_num"] = 1;
    }
    if (intval($object["get_types"]) == 1 || intval($object["get_types"]) == 3) {
        $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid AND store_id = :store_id and `activity_id`=:activity_id and activity_types = :activity_types and `openid`=:openid  and `status`=:status ", array(":uniacid" => $uniacid, ":store_id" => $store_id, "activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid, ":status" => 0));
    }
    if (intval($object["get_types"]) == 2) {
        $clicks_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_click") . " where `uniacid`=:uniacid AND store_id = :store_id and `activity_id`=:activity_id and activity_types = :activity_types and `openid`=:openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') and `status`=:status ", array(":uniacid" => $uniacid, ":store_id" => $store_id, "activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid, ":status" => 0));
    }
    if ($clicks_count / $object["winer_num"] < 1) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "您尚未达到中奖条件！"), JSON_UNESCAPED_UNICODE));
    }
    $prizeList = pdo_getall(ztbTable("obj_prize", false), array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "voice_store_id" => 0), array(), '', "sort asc");
    if (!empty($prizeList)) {
        $prizeModel = null;
        foreach ($prizeList as $key => $val) {
            if (!(intval($val["surplus"]) <= 0)) {
                if (!(intval($val["odds"]) <= 0)) {
                    if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                        if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                            $arr[$key] = $val["odds"];
                        } else {
                            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND is_receive_types = 1 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
                            if (!($count >= intval($val["limitnum"]))) {
                                $arr[$key] = $val["odds"];
                            } else {
                            }
                        }
                    } else {
                        $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $openid, "is_receive_types" => 1), "count(*)");
                        if (!($count >= intval($val["limitnum"]))) {
                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                $arr[$key] = $val["odds"];
                            } else {
                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND is_receive_types = 1 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $openid));
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
        if (empty($prizeModel)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "您来晚了，奖品已被领完。"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "prize_no" => 1, "msg" => "活动太火爆！奖品已被领完了亲，商家正在补充奖品，请稍后重试！"), JSON_UNESCAPED_UNICODE));
    }
    $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP, "is_receive_types" => 1);
    if (intval($object["join_is_register"]) == 1 && !empty($register_data)) {
        $draw_data["register_data"] = $register_data;
    }
    $result = pdo_insert(ztbNopreTable("user_draw", false), $draw_data);
    $writecode = '';
    if (!empty($result)) {
        $draw_id = pdo_insertid();
        $hashids = Hashids::instance(6, "lywyztb", '');
        $encode_id = $hashids->encode($draw_id);
        $draw_data = array("writecode" => $encode_id);
        pdo_update(ztbTable("user_draw", false), $draw_data, array("id" => $draw_id));
        $writecode = $encode_id;
    }
    if (intval($prizeModel["types"]) == 0) {
        pdo_update(ztbNopreTable("user_draw"), array("status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
    } else {
        if (intval($prizeModel["types"]) == 1) {
            if (intval($prizeModel["create_types"]) == 1) {
                list($min, $max) = explode("-", $prizeModel["score"]);
                $prizeModel["score"] = mt_rand($min, $max);
            }
            $note = "抽奖获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"];
            pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("store_id" => $store_id, "openid" => $openid));
            $userScoreModel = array();
            $userScoreModel["uniacid"] = $uniacid;
            $userScoreModel["store_id"] = $store_id;
            $userScoreModel["openid"] = $openid;
            $userScoreModel["nickname"] = $userinfo["nickname"];
            $userScoreModel["headurl"] = $userinfo["headimgurl"];
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
                $note = "抽奖获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                if ($storeAccount["money"] >= $prizeModel["sys"]) {
                    pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("store_id" => $store_id, "openid" => $openid));
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $openid;
                    $userBillModel["nickname"] = $userinfo["nickname"];
                    $userBillModel["headurl"] = $userinfo["headimgurl"];
                    $userBillModel["types"] = 3;
                    $userBillModel["detail_id"] = $draw_id;
                    $userBillModel["money"] = $prizeModel["sys"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
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
                    $sysReissueModel["openid"] = $openid;
                    $sysReissueModel["nickname"] = $userinfo["nickname"];
                    $sysReissueModel["headurl"] = $userinfo["headimgurl"];
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
                    $note = "抽奖获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                    if ($storeAccount["money"] >= $prizeModel["money"]) {
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
                        $result = sendWeixinMchPay($openid, floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                        if (!($result === true)) {
                            $store_config = iunserializer($storeAccount["config"]);
                            $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                            if ($is_mchpayfail_usermoney == 0) {
                                $sysReissueModel = array();
                                $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                $sysReissueModel["draw_id"] = $draw_id;
                                $sysReissueModel["types"] = 1;
                                $sysReissueModel["openid"] = $openid;
                                $sysReissueModel["nickname"] = $userinfo["nickname"];
                                $sysReissueModel["headurl"] = $userinfo["headimgurl"];
                                $sysReissueModel["status"] = 0;
                                $sysReissueModel["money"] = $prizeModel["money"];
                                $sysReissueModel["desc"] = $prizeModel["name"];
                                $sysReissueModel["is_store_sell"] = 1;
                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                $sysReissueModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                            } else {
                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $openid));
                                $userBillModel = array();
                                $userBillModel["uniacid"] = $uniacid;
                                $userBillModel["store_id"] = $store_id;
                                $userBillModel["openid"] = $openid;
                                $userBillModel["nickname"] = $userinfo["nickname"];
                                $userBillModel["headurl"] = $userinfo["headimgurl"];
                                $userBillModel["types"] = 3;
                                $userBillModel["detail_id"] = $draw_id;
                                $userBillModel["money"] = $prizeModel["money"];
                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
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
                        $sysReissueModel["openid"] = $openid;
                        $sysReissueModel["nickname"] = $userinfo["nickname"];
                        $sysReissueModel["headurl"] = $userinfo["headimgurl"];
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
                    if (!(intval($prizeModel["types"]) == 4)) {
                        if (intval($prizeModel["types"]) == 5) {
                            $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                            if (empty($storeCard)) {
                                thread_unlock($openid);
                                exit(json_encode(array("status" => 0, "msg" => "商家卡券不存在或已被禁用"), JSON_UNESCAPED_UNICODE));
                            }
                            pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                        }
                    }
                }
            }
        }
    }
    $user_account = pdo_get("lywywl_ztb_user_account", array("uniacid" => $_W["uniacid"], "openid" => $openid));
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    if ($prizeModel["is_sms"] == 1 && $storeAccount["sms"] > 0) {
        if (!empty($prizeModel["sms_tmp"])) {
            if (!empty($user_account["mobile"])) {
                $sms_uid = $config["sms_uid"];
                $sms_key = $config["sms_key"];
                $mobile = $user_account["mobile"];
                $sms_content = $prizeModel["sms_tmp"];
                $sms_content = str_replace("{NICKNAME}", $user_account["nickname"], $sms_content);
                $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                if (empty($storeAccount["zucp_ext"])) {
                    $sms_content .= "【{$config["name"]}】";
                } else {
                    $sms_content .= "【{$storeAccount["name"]}】";
                }
                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeAccount["zucp_ext"], '', '');
                if ($result === true) {
                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                }
            }
        }
    } else {
        if (intval($object["is_sms"]) == 1 && $storeAccount["sms"] > 0) {
            if (!empty($object["sms_tmp"])) {
                if (!empty($user_account["mobile"])) {
                    $sms_uid = $config["sms_uid"];
                    $sms_key = $config["sms_key"];
                    $mobile = $user_account["mobile"];
                    $sms_content = $object["sms_tmp"];
                    $sms_content = str_replace("{NICKNAME}", $user_account["nickname"], $sms_content);
                    $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                    if (empty($storeAccount["zucp_ext"])) {
                        $sms_content .= "【{$config["name"]}】";
                    } else {
                        $sms_content .= "【{$storeAccount["name"]}】";
                    }
                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeAccount["zucp_ext"], '', '');
                    if ($result === true) {
                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                    }
                }
            }
        }
    }
    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["id"]));
    if (!empty($originModel)) {
        pdo_update(ztbTable("marketing_user", false), array("get_num +=" => 1), array("uniacid" => $uniacid, "id" => $origin_id));
    }
    pdo_update(ztbTable("obj_voice_join", false), array("get_num +=" => 1), array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $user_account["openid"]));
    if (!empty($joinModel) && empty($joinModel["register_data"]) && $register_data) {
        pdo_update(ztbTable("obj_voice_join", false), array("register_data" => $register_data), array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
    }
    if (intval($object["get_types"]) == 1 || intval($object["get_types"]) == 3) {
        pdo_query("UPDATE " . ztbTable("obj_voice_click") . " SET status = 1 WHERE uniacid=:uniacid and store_id=:store_id and activity_types = :activity_types AND activity_id=:activity_id AND openid=:openid AND status=0 limit " . $object["winer_num"], array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    }
    if (intval($object["get_types"]) == 2) {
        pdo_query("UPDATE " . ztbTable("obj_voice_click") . " SET status = 1 WHERE uniacid=:uniacid  and store_id=:store_id and activity_types = :activity_types AND activity_id=:activity_id AND openid=:openid AND status=0 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') limit " . $object["winer_num"], array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid));
    }
    $drawModel = pdo_get(ztbTable("user_draw", false), array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "id" => $draw_id));
    $result_data = array("status" => 1, "rid" => $rid + 1, "draw_id" => $draw_id, "prize_id" => $prizeModel["id"], "prize_types" => $prizeModel["types"], "prize_name" => $prizeModel["name"], "prize_picurl" => tomedia($prizeModel["picurl"]), "score" => $prizeModel["score"], "sys" => $prizeModel["sys"], "money" => $prizeModel["money"], "card_id" => $prizeModel["card_id"], "join_is_register" => $object["join_is_register"], "writecode" => $writecode, "writeoff_types" => $prizeModel["writeoff_types"]);
    thread_unlock($openid);
    exit(json_encode($result_data, JSON_UNESCAPED_UNICODE));
}
if ($act == "register" && $request_method == "post") {
    $istype = $_GPC["istype"];
    $v_store_id = intval($_GPC["v_store_id"]);
    if (empty($object)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的语音红包活动不存在！"), JSON_UNESCAPED_UNICODE));
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
    isetcookie("reg_objvoice_" . $object["id"], base64_encode(serialize($registerFields)), 3600 * 24);
    if (intval($object["join_is_register"]) == 1) {
        $join_model = pdo_get("lywywl_ztb_obj_voice_join", array("activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
        if ($join_model && empty($join_model["register_data"])) {
            pdo_update(ztbTable("obj_voice_join", false), array("register_data" => serialize($registerFields)), array("uniacid" => $uniacid, "id" => $join_model["id"]));
        }
        exit(json_encode(array("status" => 1, "v_store_id" => $v_store_id, "msg" => "登记成功,赶快去领奖吧！"), JSON_UNESCAPED_UNICODE));
    } else {
        exit(json_encode(array("status" => 1, "v_store_id" => $v_store_id, "msg" => "登记成功,点击领奖吧！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "ajaxStore" && $request_method == "post") {
    $v_store_id = intval($_GPC["v_store_id"]);
    if (empty($object)) {
        tip_redirect("对不起，您参与的语音红包活动不存在！");
    }
    if (intval($object["status"]) != 1) {
        tip_redirect("对不起，您参与的语音红包活动已失效！");
    }
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
    }
    $store = pdo_get("lywywl_ztb_obj_voice_store", array("activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $v_store_id, "store_id" => $store_id, "status" => 1, "auditing" => 1, "uniacid" => $_W["uniacid"]));
    if (!$store) {
        exit("对不起，您查看的店铺不存在或已被删除！");
    }
    $join_model = pdo_get("lywywl_ztb_obj_voice_join", array("store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
    if (empty($join_model)) {
        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "请先登记参与活动！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = base64_decode($_GPC["reg_objvoice_" . $object["id"]]);
    if ($object["join_is_register"] == 1) {
        if (empty($join_model["register_data"]) && empty($register_data)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "register", "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
        } else {
            if (!empty($join_model["register_data"]) && empty($register_data)) {
                $register_data = $join_model["register_data"];
            }
        }
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
    exit(json_encode(array("status" => 1, "v_store_id" => $v_store_id), JSON_UNESCAPED_UNICODE));
}
if ($act == "store") {
    $v_store_id = $_GPC["v_store_id"];
    if (empty($object)) {
        tip_redirect("对不起，您参与的语音红包活动不存在！");
    }
    if (intval($object["status"]) != 1) {
        tip_redirect("对不起，您参与的语音红包活动已失效！");
    }
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
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
    $join_model = pdo_get("lywywl_ztb_obj_voice_join", array("store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
    $isjoinregister = 1;
    if (empty($join_model)) {
        $isjoinregister = 0;
    } else {
        if (intval($object["join_is_register"]) == 1) {
            $register_data = $_GPC["reg_objvoice_" . $object["id"]];
            if (empty($register_data) && empty($join_model["register_data"])) {
                $isjoinregister = 0;
            } else {
                $isjoinregister = 1;
            }
        }
    }
    $store_voice = pdo_get("lywywl_ztb_obj_voice_store", array("activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $v_store_id, "store_id" => $store_id, "status" => 1, "auditing" => 1, "uniacid" => $_W["uniacid"]));
    if (!$store_voice) {
        exit("对不起，您查看的店铺不存在或已被删除！");
    }
    $industry = pdo_get("lywywl_ztb_sys_industry", array("id" => $store_voice["industry_id"], "status" => 1));
    $prizeTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_prize") . " where `uniacid`=:uniacid and activity_types=:activity_types and activity_id=:activity_id and voice_store_id=:voice_store_id and types>0 and status=1 ", array(":uniacid" => $_W["uniacid"], ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":voice_store_id" => $store_voice["id"]));
    $storeprizeArr = array();
    $prizelistarr = getstoreprizelist($store_voice["id"], $activity_types, $object["id"]);
    $storeprizeArr["storeinfo"] = $store_voice;
    $storeprizeArr["storeinfo"]["industry_name"] = $industry["name"];
    if (empty($storeprizeArr["storeinfo"]["industry_name"])) {
        $storeprizeArr["storeinfo"]["industry_name"] = "未知";
    }
    $storeprizeArr["prizelist"]["countnum"] = count($prizelistarr);
    $storeprizeArr["prizelist"]["prizeinfo"] = $prizelistarr;
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
    $dateYear = intval(date("Y")) + 2;
    $Mars_coordinates = iunserializer($store_voice["store_map_list"]);
    if ($Mars_coordinates) {
        foreach ($Mars_coordinates as $keys => $val) {
            $map_lat_lng = Convert_BD09_To_GCJ02($val["lat"], $val["lng"]);
            $Mars_coordinates[$keys]["lat"] = $map_lat_lng["lat"];
            $Mars_coordinates[$keys]["lng"] = $map_lat_lng["lng"];
        }
    }
    if ($store_voice["is_show_ads"] == 1) {
        if (empty($_GPC["ad_store_" . $store_voice["id"]])) {
            $store_voice["is_show_ads"] = 1;
            isetcookie("ad_store_" . $store_voice["id"], "ad", 3600 * 24);
        } else {
            $store_voice["is_show_ads"] = 0;
        }
    }
    $store_voice["banner_url"] = explode(",", $store_voice["banner_url"]);
    $jion_log_sql = "SELECT * FROM " . ztbTable("obj_voice_join_log") . " WHERE uniacid = :uniacid AND activity_types = :activity_types AND activity_id = :activity_id AND store_voice_id=:store_voice_id order by id desc limit 20";
    $jionlogparams = array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":store_voice_id" => $store_voice["id"]);
    $jionLogUserList = pdo_fetchall($jion_log_sql, $jionlogparams);
    $total_jion_log_sql = "SELECT count(id) FROM " . ztbTable("obj_voice_join_log") . " WHERE uniacid = :uniacid AND activity_types = :activity_types AND activity_id = :activity_id AND store_voice_id=:store_voice_id order by id desc ";
    $total_jjionlogparams = array(":uniacid" => $uniacid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":store_voice_id" => $store_voice["id"]);
    $total_jionLogUserList = pdo_fetchcolumn($total_jion_log_sql, $total_jjionlogparams);
    $draw_number = $total_jionLogUserList;
    $userDrawTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " where `uniacid`=:uniacid and activity_types=:activity_types and activity_id=:activity_id and openid=:openid and store_id=:store_id and types>0 and types!=-1 and is_receive_types=2 ", array(":uniacid" => $_W["uniacid"], ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":openid" => $openid, ":store_id" => $store_id));
    pdo_update(ztbTable("obj_voice_store", false), array("click_num +=" => 1), array("uniacid" => $uniacid, "id" => $store_voice["id"]));
    if (!empty($originModel)) {
        $_share["title"] = "【客服:" . $originModel["name"] . "】" . replaceShareInfo($object["share_title"]);
    } else {
        $_share["title"] = replaceShareInfo($object["share_title"]);
    }
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $join_model = pdo_get("lywywl_ztb_obj_voice_join", array("activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
    if ($join_model) {
        $share_id = $join_model["id"];
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "join_id" => $join_model["id"]), false, TRUE);
    } else {
        $share_id = 0;
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    }
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $object["id"], $user["id"]);
    if (strpos("," . $store_voice["openid"] . ",", "," . $openid . ",") === false) {
        $store_isadmins = 0;
    } else {
        $store_isadmins = 1;
    }
    if (strpos("," . $store_voice["bosses"] . ",", "," . $openid . ",") === false) {
        $store_isbosses = 0;
    } else {
        $store_isbosses = 1;
    }
    include $this->template("tmp/" . $tmp["resource"] . "/store");
    exit;
}
if ($act == "voicedraw") {
    $voice = $_GPC["voice"];
    $v_store_id = $_GPC["v_store_id"];
    $voicered = $_GPC["voicered"];
    if (empty($object)) {
        tip_redirect("对不起，您参与的语音红包活动不存在！");
    }
    if (intval($object["status"]) != 1) {
        tip_redirect("对不起，您参与的语音红包活动已失效！");
    }
    if ($object["start_time"] > TIMESTAMP) {
        tip_redirect("亲，不要着急，活动在：" . timeToStr($object["start_time"]) . "开始！", 1);
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
    if (empty($voicered)) {
        if (empty($voice)) {
            exit(json_encode(array("status" => 0, "msg" => "语音识别失败，请重新尝试！"), JSON_UNESCAPED_UNICODE));
        }
        if (empty($store_id)) {
            exit(json_encode(array("status" => 0, "msg" => "系统出错，请联系管理员！"), JSON_UNESCAPED_UNICODE));
        }
    }
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
    $store_voice = pdo_get("lywywl_ztb_obj_voice_store", array("activity_types" => $activity_types, "activity_id" => $object["id"], "store_id" => $store_id, "id" => $v_store_id, "status" => 1, "auditing" => 1, "uniacid" => $_W["uniacid"]));
    if (!$store_voice) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您查看的店铺不存在或已被删除！"), JSON_UNESCAPED_UNICODE));
    }
    $join_model = pdo_get("lywywl_ztb_obj_voice_join", array("activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid, "uniacid" => $_W["uniacid"]));
    if (empty($join_model)) {
        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "请先登记参与活动！"), JSON_UNESCAPED_UNICODE));
    }
    $register_data = base64_decode($_GPC["reg_objvoice_" . $object["id"]]);
    if ($object["join_is_register"] == 1) {
        if (empty($join_model["register_data"]) && empty($register_data)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "register", "msg" => "对不起，请先登记后在参与活动！"), JSON_UNESCAPED_UNICODE));
        } else {
            if (!empty($join_model["register_data"]) && empty($register_data)) {
                $register_data = $join_model["register_data"];
            }
        }
    }
    if ($store_voice["limit_num"] > 0) {
        if ($store_voice["get_types"] == 0) {
            $receive_log_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_join_log") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and `activity_types`=:activity_types  and `openid`=:openid and store_voice_id=:store_voice_id and draw_id>0 and status>0", array(":uniacid" => $_W["uniacid"], ":activity_id" => $object["id"], ":activity_types" => $activity_types, ":openid" => $openid, ":store_voice_id" => $v_store_id));
        }
        if ($store_voice["get_types"] == 1) {
            $receive_log_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_join_log") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and `activity_types`=:activity_types  and `openid`=:openid and store_voice_id=:store_voice_id and draw_id>0 and status>0 and FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":uniacid" => $_W["uniacid"], ":activity_id" => $object["id"], ":activity_types" => $activity_types, ":openid" => $openid, ":store_voice_id" => $v_store_id));
        }
        if ($receive_log_count >= $store_voice["limit_num"]) {
            exit(json_encode(array("status" => 0, "msg" => "您参与商家的语音领奖已达到领取上限！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if ($store_voice["join_limit_num"] > 0) {
        if ($store_voice["get_types"] == 0) {
            $join_log_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_join_log") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and `activity_types`=:activity_types  and `openid`=:openid and store_voice_id=:store_voice_id", array(":uniacid" => $_W["uniacid"], ":activity_id" => $object["id"], ":activity_types" => $activity_types, ":openid" => $openid, ":store_voice_id" => $v_store_id));
        }
        if ($store_voice["get_types"] == 1) {
            $join_log_count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_voice_join_log") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and `activity_types`=:activity_types  and `openid`=:openid and store_voice_id=:store_voice_id and FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":uniacid" => $_W["uniacid"], ":activity_id" => $object["id"], ":activity_types" => $activity_types, ":openid" => $openid, ":store_voice_id" => $v_store_id));
        }
        if ($join_log_count >= $store_voice["join_limit_num"]) {
            exit(json_encode(array("status" => 0, "msg" => "您参与商家的语音领奖已达到参与上限！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["id"], "status" => 1, "voice_store_id" => $store_voice["id"]), array(), '', "sort asc");
    if (!empty($prizeList)) {
        $prizeModel = null;
        foreach ($prizeList as $key => $val) {
            if (!(intval($val["surplus"]) <= 0)) {
                if (!(intval($val["odds"]) <= 0)) {
                    if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                        if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                            $arr[$key] = $val["odds"];
                        } else {
                            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid=:uniacid AND prize_id = :prize_id AND openid = :openid AND is_receive_types=2 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":uniacid" => $uniacid, ":prize_id" => $val["id"], ":openid" => $openid));
                            if (!($count >= intval($val["limitnum"]))) {
                                $arr[$key] = $val["odds"];
                            } else {
                            }
                        }
                    } else {
                        $count = pdo_getcolumn(ztbTable("user_draw", false), array("uniacid" => $uniacid, "prize_id" => $val["id"], "openid" => $openid, "is_receive_types" => 2), "count(*)");
                        if (!($count >= intval($val["limitnum"]))) {
                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                $arr[$key] = $val["odds"];
                            } else {
                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE uniacid=:uniacid AND prize_id = :prize_id AND openid = :openid AND is_receive_types=2 AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":uniacid" => $uniacid, ":prize_id" => $val["id"], ":openid" => $openid));
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
        if (empty($prizeModel)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "您来晚了，奖品已被领完。"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "活动太火爆！奖品已被领完了亲，商家正在补充奖品，请稍后重试！"), JSON_UNESCAPED_UNICODE));
    }
    if (!empty($voicered)) {
        thread_unlock($openid);
        if ($voicered == "feach") {
            exit(json_encode(array("status" => 1, "msg" => "识别成功，请稍等！"), JSON_UNESCAPED_UNICODE));
        }
        if ($voicered == "getisjoin") {
            exit(json_encode(array("status" => 1, "msg" => "效验成功，赶紧参与活动领奖吧！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $voice_str = getSpecialChars($voice);
    $word_password = getSpecialChars($store_voice["word_password"]);
    $strlen_total = strlen($word_password);
    $result_len = similar_text($word_password, $voice_str);
    $matching_degree = $result_len / $strlen_total * 100;
    if ($matching_degree >= $object["speech_matching"]) {
        $draw_data = array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "origin_id" => $origin_id, "origin_team_id" => $originModel["team_id"], "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "is_receive_types" => 2, "store_id" => $store_id, "voice_store_id" => $v_store_id, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
        if (intval($object["join_is_register"]) == 1) {
            $draw_data["register_data"] = $register_data;
        }
        $result = pdo_insert(ztbNopreTable("user_draw", false), $draw_data);
        $writecode = '';
        if (!empty($result)) {
            $draw_id = pdo_insertid();
            $hashids = Hashids::instance(6, "lywyztb", '');
            $encode_id = $hashids->encode($draw_id);
            $draw_data = array("writecode" => $encode_id);
            pdo_update(ztbNopreTable("user_draw", false), $draw_data, array("uniacid" => $uniacid, "id" => $draw_id));
            $writecode = $encode_id;
        }
        $voice_join_note = '';
        if (intval($prizeModel["types"]) == 0) {
            pdo_update(ztbNopreTable("user_draw"), array("status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
            $voice_join_note = "参与语音红包活动：“" . $object["title"] . "”，参与商家：" . $store_voice["name"] . ",获得“谢谢参与”";
        } else {
            if (intval($prizeModel["types"]) == 1) {
                if (intval($prizeModel["create_types"]) == 1) {
                    list($min, $max) = explode("-", $prizeModel["score"]);
                    $prizeModel["score"] = mt_rand($min, $max);
                }
                $note = "参与语音红包活动获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $object["title"] . "，活动商家：" . $store_voice["name"] . "，获得积分：" . $prizeModel["score"] . "个";
                $voice_join_note = "参与语音红包活动：“" . $object["title"] . "”，参与商家：" . $store_voice["name"] . ",获得积分：" . $prizeModel["score"] . "个";
                pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("store_id" => $store_id, "openid" => $openid));
                $userScoreModel = array();
                $userScoreModel["uniacid"] = $uniacid;
                $userScoreModel["store_id"] = $store_id;
                $userScoreModel["openid"] = $openid;
                $userScoreModel["nickname"] = $userinfo["nickname"];
                $userScoreModel["headurl"] = $userinfo["headimgurl"];
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
                    $note = "参与语音红包活动获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $object["title"] . "，参与活动商家：" . $store_voice["name"] . "，获得金额：" . $prizeModel["sys"] . "元";
                    $voice_join_note = "参与语音红包活动：“" . $object["title"] . "”，参与商家：" . $store_voice["name"] . ",获得金额：“" . $prizeModel["sys"] . "元奖励”";
                    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                    if ($storeAccount["money"] >= $prizeModel["sys"]) {
                        pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("store_id" => $store_id, "openid" => $openid));
                        $userBillModel = array();
                        $userBillModel["uniacid"] = $uniacid;
                        $userBillModel["store_id"] = $store_id;
                        $userBillModel["openid"] = $openid;
                        $userBillModel["nickname"] = $userinfo["nickname"];
                        $userBillModel["headurl"] = $userinfo["headimgurl"];
                        $userBillModel["types"] = 3;
                        $userBillModel["detail_id"] = $draw_id;
                        $userBillModel["money"] = $prizeModel["sys"];
                        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
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
                        $sysReissueModel["openid"] = $openid;
                        $sysReissueModel["nickname"] = $userinfo["nickname"];
                        $sysReissueModel["headurl"] = $userinfo["headimgurl"];
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
                        $note = "参与语音红包活动获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $object["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                        $voice_join_note = "参与语音红包活动：“" . $object["title"] . "”，参与商家：" . $store_voice["name"] . ",获得红包：" . $prizeModel["money"] . "元”";
                        $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
                        if ($storeAccount["money"] >= $prizeModel["money"]) {
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
                            $result = sendWeixinMchPay($openid, floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                            if (!($result === true)) {
                                $store_config = iunserializer($storeAccount["config"]);
                                $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                                if ($is_mchpayfail_usermoney == 0) {
                                    $sysReissueModel = array();
                                    $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                    $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                    $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                    $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                    $sysReissueModel["draw_id"] = $draw_id;
                                    $sysReissueModel["types"] = 1;
                                    $sysReissueModel["openid"] = $openid;
                                    $sysReissueModel["nickname"] = $userinfo["nickname"];
                                    $sysReissueModel["headurl"] = $userinfo["headimgurl"];
                                    $sysReissueModel["status"] = 0;
                                    $sysReissueModel["money"] = $prizeModel["money"];
                                    $sysReissueModel["desc"] = $prizeModel["name"];
                                    $sysReissueModel["is_store_sell"] = 1;
                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                } else {
                                    pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("store_id" => $store_id, "openid" => $openid));
                                    $userBillModel = array();
                                    $userBillModel["uniacid"] = $uniacid;
                                    $userBillModel["store_id"] = $store_id;
                                    $userBillModel["openid"] = $openid;
                                    $userBillModel["nickname"] = $userinfo["nickname"];
                                    $userBillModel["headurl"] = $userinfo["headimgurl"];
                                    $userBillModel["types"] = 3;
                                    $userBillModel["detail_id"] = $draw_id;
                                    $userBillModel["money"] = $prizeModel["money"];
                                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
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
                            $sysReissueModel["openid"] = $openid;
                            $sysReissueModel["nickname"] = $userinfo["nickname"];
                            $sysReissueModel["headurl"] = $userinfo["headimgurl"];
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
                        if (intval($prizeModel["types"]) == 4) {
                            $voice_join_note = "参与语音红包活动：“" . $object["title"] . "”，参与商家：" . $store_voice["name"] . ",获得奖品：“" . $prizeModel["name"] . "”";
                        } else {
                            if (intval($prizeModel["types"]) == 5) {
                                $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                if (empty($storeCard)) {
                                    thread_unlock($openid);
                                    exit(json_encode(array("status" => 0, "msg" => "商家卡券不存在或已被禁用"), JSON_UNESCAPED_UNICODE));
                                }
                                $voice_join_note = "参与语音红包活动：“" . $object["title"] . "”获得奖品：“" . $storeCard["name"] . "商家卡卷”";
                                pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                            }
                        }
                    }
                }
            }
        }
        $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
        if ($prizeModel["is_sms"] == 1 && $storeAccount["sms"] > 0) {
            if (!empty($prizeModel["sms_tmp"])) {
                if (!empty($userAccount["mobile"])) {
                    $sms_uid = $config["sms_uid"];
                    $sms_key = $config["sms_key"];
                    $mobile = $userAccount["mobile"];
                    $sms_content = $prizeModel["sms_tmp"];
                    $sms_content = str_replace("{NICKNAME}", $userAccount["nickname"], $sms_content);
                    $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                    if (empty($storeAccount["zucp_ext"])) {
                        $sms_content .= "【{$config["name"]}】";
                    } else {
                        $sms_content .= "【{$storeAccount["name"]}】";
                    }
                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeAccount["zucp_ext"], '', '');
                    if ($result === true) {
                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                    }
                }
            }
        } else {
            if (intval($object["is_sms"]) == 1 && $storeAccount["sms"] > 0) {
                if (!empty($object["sms_tmp"])) {
                    if (!empty($userAccount["mobile"])) {
                        $sms_uid = $config["sms_uid"];
                        $sms_key = $config["sms_key"];
                        $mobile = $userAccount["mobile"];
                        $sms_content = $object["sms_tmp"];
                        $sms_content = str_replace("{NICKNAME}", $userAccount["nickname"], $sms_content);
                        $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                        $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                        $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                        if (empty($storeAccount["zucp_ext"])) {
                            $sms_content .= "【{$config["name"]}】";
                        } else {
                            $sms_content .= "【{$storeAccount["name"]}】";
                        }
                        $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeAccount["zucp_ext"], '', '');
                        if ($result === true) {
                            pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                            pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                        }
                    }
                }
            }
        }
        $insert_join_log = array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "store_id" => $store_id, "store_voice_id" => $store_voice["id"], "voice_join_id" => $join_model["id"], "voice_password_res" => $voice, "voice_matching_degree" => $matching_degree, "draw_id" => $draw_id, "prize_pic_url" => $prizeModel["picurl"], "draw_name" => $prizeModel["name"], "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "origin_id" => $origin_id, "origin_team_id" => $originModel["team_id"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "note" => $voice_join_note, "status" => 1, "ip" => $_W["clientip"], "createtime" => TIMESTAMP, "updatetime" => TIMESTAMP);
        if (intval($object["join_is_register"]) == 1) {
            if (!empty($register_data)) {
                $insert_join_log["register_data"] = $register_data;
            } else {
                if (!empty($join_model["register_data"])) {
                    $insert_join_log["register_data"] = $join_model["register_data"];
                }
            }
        }
        if (intval($prizeModel["types"]) < 4) {
            $insert_join_log["is_verification"] = 1;
        } else {
            $insert_join_log["is_verification"] = 0;
        }
        $resultlog = pdo_insert(ztbNopreTable("obj_voice_join_log", false), $insert_join_log);
        if (!empty($resultlog)) {
            $join_log_id = pdo_insertid();
        }
        pdo_update(ztbNopreTable("obj_prize", false), array("surplus -=" => 1), array("uniacid" => $uniacid, "id" => $prizeModel["id"]));
        pdo_update(ztbNopreTable("obj_activity", false), array("get_num +=" => 1), array("uniacid" => $uniacid, "id" => $object["id"]));
        pdo_update(ztbNopreTable("obj_voice_store", false), array("get_num +=" => 1, "join_num +=" => 1), array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $store_voice["id"]));
        if (!empty($originModel)) {
            pdo_update(ztbNopreTable("marketing_user", false), array("get_num +=" => 1), array("uniacid" => $uniacid, "id" => $origin_id));
        }
        pdo_update(ztbNopreTable("obj_voice_join", false), array("get_num +=" => 1, "join_yes_num +=" => 1), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
        if (!empty($join_model) && empty($join_model["register_data"]) && $register_data) {
            pdo_update(ztbNopreTable("obj_voice_join", false), array("register_data" => $register_data), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
        }
        $drawModel = pdo_get(ztbNopreTable("user_draw", false), array("uniacid" => $_W["uniacid"], "id" => $draw_id));
        $result_data = array("status" => 1, "activity_id" => $object["id"], "activity_types" => $activity_types, "obj_title" => $object["title"], "join_log_id" => $join_log_id, "types" => $prizeModel["types"], "draw_id" => $draw_id, "prize_id" => $prizeModel["id"], "prize_types" => $prizeModel["types"], "prize_name" => $prizeModel["name"], "prize_picurl" => tomedia($prizeModel["picurl"]), "score_name" => "积分", "score" => $drawModel["score"], "sys" => $drawModel["sys"], "money" => $drawModel["money"], "card_id" => $drawModel["card_id"], "red" => $drawModel["red"], "join_is_register" => $object["join_is_register"], "writecode" => $writecode, "writeoff_types" => $prizeModel["writeoff_types"]);
        thread_unlock($openid);
        exit(json_encode($result_data, JSON_UNESCAPED_UNICODE));
    } else {
        $insert_join_log = array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "store_voice_id" => $store_voice["id"], "voice_join_id" => $join_model["id"], "voice_password_res" => $voice, "voice_matching_degree" => $matching_degree, "draw_id" => 0, "draw_name" => "未中奖", "origin_id" => $origin_id, "origin_team_id" => $originModel["team_id"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "is_verification" => 1, "status" => 0, "note" => "匹配度不满足抽奖条件", "ip" => $_W["clientip"], "createtime" => TIMESTAMP, "updatetime" => TIMESTAMP);
        if (intval($object["join_is_register"]) == 1) {
            $insert_join_log["register_data"] = $register_data;
        }
        $resultlog = pdo_insert(ztbNopreTable("obj_voice_join_log", false), $insert_join_log);
        if (!empty($resultlog)) {
            $join_log_id = pdo_insertid();
        }
        pdo_update(ztbNopreTable("obj_voice_join", false), array("join_no_num +=" => 1), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "openid" => $openid));
        pdo_update(ztbNopreTable("obj_voice_store", false), array("join_num +=" => 1), array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $store_voice["id"]));
        thread_unlock($openid);
        exit(json_encode(array("status" => 2, "join_log_id" => $join_log_id, "msg" => "匹配失败，请用普通话再次尝试！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "voiceupload") {
    $serverId = $_GPC["serverId"];
    $join_log_id = $_GPC["join_log_id"];
    if (!empty($serverId) && !empty($join_log_id)) {
        $account_api = WeAccount::create();
        $filename = $account_api->downloadMedia($serverId, true);
        pdo_update(ztbNopreTable("obj_voice_join_log", false), array("voice_password_url" => $filename), array("uniacid" => $_W["uniacid"], "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $join_log_id));
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
    $model = pdo_get("lywywl_ztb_obj_voice_store", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $object["id"], "openid" => $openid, "deltime" => 0));
    if ($model) {
        exit(json_encode(array("status" => 0, "msg" => "您已提交申请，请勿重复操作！"), JSON_UNESCAPED_UNICODE));
    }
    $store["uniacid"] = $uniacid;
    $store["store_id"] = $store_id;
    $store["activity_types"] = $activity_types;
    $store["activity_id"] = $object["id"];
    $store["logo_url"] = $_GPC["logo_url"];
    $store["is_show_ads"] = 0;
    $store["ads_url"] = '';
    $store["ads_link"] = '';
    $store["show_ads_time"] = 10;
    $store["openid"] = $openid;
    $store["sort"] = 4000;
    $store["status"] = 0;
    $store["auditing"] = 0;
    $store["cause"] = '';
    $store["updatetime"] = TIMESTAMP;
    $store["createtime"] = TIMESTAMP;
    $result = pdo_insert("lywywl_ztb_obj_voice_store", $store);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因提交失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id, "deltime" => 0));
    if ($config["objstorepushtmp"] && $storeModel["openid"]) {
        if (isFollow($storeModel["openid"], $uniacid)) {
            $postdata = array("first" => array("value" => "{$object["title"]}，您的活动有新的商家申请入驻，请及时处理。", "color" => "#173177"), "keyword1" => array("value" => date("Y-m-d H:i", TIMESTAMP), "color" => "#173177"), "keyword2" => array("value" => "入驻商家名称：{$store["name"]}，联系电话：{$store["tel"]}", "color" => "#173177"), "remark" => array("value" => "点击查看入驻商家详情", "color" => "#173177"));
            $url = replaceDieDomain($config, __MURL("store.obj_voice_store_wait", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
            $template_id = $config["objstorepushtmp"];
            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
        }
    }
    if ($config["objstorepushtmp_sub"] && $storeModel["openid"]) {
        $touser = $storeModel["openid"];
        $template_id = $config["objstorepushtmp_sub"];
        $postdata = array("thing3" => array("value" => $store["name"]), "time2" => array("value" => date("Y-m-d H:i", TIMESTAMP)), "phone_number4" => array("value" => $store["tel"]), "thing5" => array("value" => "入驻活动：{$object["title"]}"));
        $url = replaceDieDomain($config, __MURL("store.obj_voice_store_wait", array("act" => "index", "aid" => $object["id"]), true, true), 0, 0, 0);
        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
    }
    exit(json_encode(array("status" => 1, "msg" => "提交成功，请耐心等待审核！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "writeOff" || $act == "getUserDrawJsonList" || $act == "getUserDrawInfo" || $act == "confirmWrite") {
    $v_store_id = intval($_GPC["v_store_id"]);
    $writecode = $_GPC["writecode"];
    $storeModel = pdo_get(ztbNopreTable("obj_voice_store"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $v_store_id, "status" => 1));
    if (empty($storeModel)) {
        if ($request_method == "post") {
            resultMsg(["status" => 0, "msg" => "对不起，商家信息不存在或已禁用！"]);
        } else {
            tip_redirect("对不起，商家信息不存在或已禁用！");
        }
    } else {
        if (strpos("," . $storeModel["openid"] . ",", "," . $openid . ",") === false) {
            if ($request_method == "post") {
                resultMsg(["status" => 0, "msg" => "对不起,商家信息不存在或已禁用"]);
            } else {
                tip_redirect("对不起,您不是活动商家“" . $storeModel["name"] . "”的核销员！");
            }
        }
    }
    if ($act == "writeOff") {
        $title = $storeModel["name"] . "-核销管理";
        $storePrizeList = pdo_getall(ztbNopreTable("obj_prize"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "voice_store_id" => $v_store_id, "types" => 4));
        include $this->template("other/voice_writeoff/index");
        exit;
    }
    if ($act == "getUserDrawJsonList") {
        $pindex = max(1, intval($_GPC["page"]));
        $psize = max(10, intval($_GPC["pageSize"]));
        $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `admins`=:admins and `activity_types`=:activity_types and `activity_id`=:activity_id and `voice_store_id`=:voice_store_id and `deltime`=0 and `types`=4";
        $params = array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":admins" => $openid, ":activity_types" => $activity_types, ":activity_id" => $object["id"], ":voice_store_id" => $v_store_id);
        $orderby = sprintf(" ORDER BY %s %s ", "updatetime", " desc");
        $sql = "SELECT * FROM " . ztbTable("user_draw") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
        $list = pdo_fetchall($sql, $params);
        $listData = array();
        $listData["rows"] = [];
        $arrlength = count($list);
        $i = 0;
        while ($i < $arrlength) {
            $listData["rows"][] = ["id" => $list[$i]["id"], "activity_types" => $list[$i]["activity_types"], "activity_id" => $list[$i]["activity_id"], "activity_name" => getDataById(ztbNopreTable("obj_activity"), $list[$i]["activity_id"], "title", "未知活动"), "prize_id" => $list[$i]["prize_id"], "types" => $list[$i]["types"], "name" => $list[$i]["name"], "prize_pic_url" => tomedia($list[$i]["prize_pic_url"]), "status" => $list[$i]["status"], "headurl" => tomedia($list[$i]["headurl"]), "nickname" => $list[$i]["nickname"], "writeoff_types" => $list[$i]["writeoff_types"], "writecode" => $list[$i]["writecode"], "updatetime" => date("Y-m-d H:i:s", $list[$i]["updatetime"]), "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
            $i++;
        }
        resultMsg($listData);
    }
    if ($act == "getUserDrawInfo" && $request_method == "post") {
        $writecode = $_GPC["writecode"];
        if (mb_strlen($writecode) == 0) {
            resultMsg(["status" => 0, "msg" => "对不起,请填写核销码！"]);
        }
        $userDrawModel = pdo_get(ztbNopreTable("user_draw"), array("uniacid" => $uniacid, "store_id" => $store_id, "writecode" => $writecode, "voice_store_id" => $v_store_id, "deltime" => 0));
        if (empty($userDrawModel)) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if ($userDrawModel["types"] == -1 || $userDrawModel["types"] == 4) {
            if ($userDrawModel["writeoff_types"] == 1) {
                resultMsg(["status" => 0, "msg" => "对不起,该商品请在线上核销！"]);
            }
            if ($userDrawModel["status"] == 1) {
                resultMsg(["status" => 0, "msg" => "对不起,该商品已核销！"]);
            }
            $is_expires = 0;
            if ($userDrawModel["expires_time"] > 0 && TIMESTAMP > $userDrawModel["expires_time"]) {
                $is_expires = 1;
            }
            resultMsg(["status" => 1, "prize_name" => $userDrawModel["name"], "prize_pic_url" => tomedia($userDrawModel["prize_pic_url"]), "is_expires" => $is_expires, "expires_time" => date("Y-m-d H:i:s", $userDrawModel["expires_time"])]);
        } else {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
    }
    if ($act == "confirmWrite" && $request_method == "post") {
        $writecode = $_GPC["writecode"];
        if (!thread_lock("draw_write_lock_" . $writecode)) {
            exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
        }
        if (mb_strlen($writecode) == 0) {
            thread_unlock("draw_write_lock_" . $writecode);
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        $userDrawModel = pdo_get(ztbNopreTable("user_draw"), array("uniacid" => $uniacid, "store_id" => $store_id, "writecode" => $writecode, "voice_store_id" => $v_store_id, "deltime" => 0));
        if (empty($userDrawModel)) {
            thread_unlock("draw_write_lock_" . $writecode);
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if ($userDrawModel["types"] == 4) {
            if ($userDrawModel["writeoff_types"] == 1) {
                thread_unlock("draw_write_lock_" . $writecode);
                resultMsg(["status" => 0, "msg" => "对不起,该商品请在线上核销！"]);
            }
            if ($userDrawModel["status"] == 1) {
                thread_unlock("draw_write_lock_" . $writecode);
                resultMsg(["status" => 0, "msg" => "对不起,该商品已核销！"]);
            }
            $userDrawUpdateModel = array("status" => 1, "admins" => $openid, "updatetime" => TIMESTAMP);
            pdo_update(ztbNopreTable("user_draw"), $userDrawUpdateModel, array("id" => $userDrawModel["id"]));
            if ($activity_types == 24 && $v_store_id > 0 && !empty($storeModel)) {
                $join_log = pdo_get(ztbNopreTable("obj_voice_join_log"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "draw_id" => $userDrawModel["id"], "types" => $userDrawModel["types"], "openid" => $userDrawModel["openid"], "store_voice_id" => $v_store_id));
                if (!empty($join_log)) {
                    $insert_voicered = array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "store_id" => $store_id, "v_store_id" => $v_store_id, "draw_id" => $userDrawModel["id"], "draw_name" => $userDrawModel["name"], "join_log_id" => $join_log["id"], "openid" => $userDrawModel["openid"], "nickname" => $userDrawModel["nickname"], "headurl" => $userDrawModel["headurl"], "admins" => $openid, "createtime" => TIMESTAMP);
                    $resultlog = pdo_insert(ztbNopreTable("obj_voice_store_writeoff", false), $insert_voicered);
                    $userVoiceredUpdateModel = array("is_verification" => 1, "admins" => $openid, "updatetime" => TIMESTAMP);
                    pdo_update(ztbNopreTable("obj_voice_join_log"), $userVoiceredUpdateModel, array("id" => $join_log["id"], "uniacid" => $uniacid));
                } else {
                    resultMsg(["status" => 0, "msg" => "对不起,用户参与信息已不存在，请联系管理员反馈！"]);
                }
            }
            thread_unlock("draw_write_lock_" . $writecode);
            resultMsg(["status" => 1, "msg" => "核销成功！"]);
        } else {
            thread_unlock("draw_write_lock_" . $writecode);
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
    }
}
if ($act == "writeOffCard" || $act == "getCardJsonList" || $act == "getCardInfo" || $act == "cardConfirmWrite") {
    $v_store_id = intval($_GPC["v_store_id"]);
    $writeopenid = $_GPC["writeopenid"];
    $writetime = $_GPC["writetime"];
    $writecode = $_GPC["writecode"];
    $storeModel = pdo_get(ztbNopreTable("obj_voice_store"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "id" => $v_store_id, "status" => 1));
    if (empty($storeModel)) {
        if ($request_method == "post") {
            resultMsg(["status" => 0, "msg" => "对不起，商家信息不存在或已禁用！"]);
        } else {
            tip_redirect("对不起，商家信息不存在或已禁用！");
        }
    } else {
        if (strpos("," . $storeModel["openid"] . ",", "," . $openid . ",") === false) {
            if ($request_method == "post") {
                resultMsg(["status" => 0, "msg" => "对不起,商家信息不存在或已禁用"]);
            } else {
                tip_redirect("对不起,您不是活动商家“" . $storeModel["name"] . "”的核销员！");
            }
        }
    }
    if ($act == "writeOffCard") {
        $title = $storeModel["name"] . "-卡卷核销管理";
        $storePrizeCardList = pdo_getall(ztbNopreTable("obj_prize"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "activity_types" => $activity_types, "activity_id" => $object["id"], "status" => 1, "voice_store_id" => $v_store_id, "types" => 5));
        include $this->template("other/voice_card/index");
        exit;
    }
    if ($act == "getCardJsonList") {
        $pindex = max(1, intval($_GPC["page"]));
        $psize = max(10, intval($_GPC["pageSize"]));
        $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `admins`=:admins and `voice_store_id` =:voice_store_id and `activity_types`=:activity_types and `activity_id`=:activity_id and `deltime`=0 ";
        $params = array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":admins" => $openid, ":voice_store_id" => $v_store_id, ":activity_types" => $activity_types, ":activity_id" => $object["id"]);
        $orderby = sprintf(" ORDER BY %s %s ", "id", " desc");
        $sql = "SELECT * FROM " . ztbTable("store_card_writeoff") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
        $list = pdo_fetchall($sql, $params);
        $listData = array();
        $listData["rows"] = [];
        $arrlength = count($list);
        $i = 0;
        while ($i < $arrlength) {
            $listData["rows"][] = ["id" => $list[$i]["id"], "voice_store_id" => $list[$i]["voice_store_id"], "card_name" => getDataById(ztbNopreTable("store_card"), $list[$i]["card_id"], "name", "未知卡券"), "headurl" => tomedia($list[$i]["headurl"]), "nickname" => $list[$i]["nickname"], "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
            $i++;
        }
        resultMsg($listData);
    }
    if ($act == "getCardInfo" && $request_method == "post") {
        $writeopenid = $_GPC["writeopenid"];
        $writetime = max(0, intval($_GPC["writetime"]));
        if (mb_strlen($writeopenid) == 0) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if (time() - $writetime > 30 * 60) {
            resultMsg(["status" => 0, "msg" => "对不起,二维码超时,请重新生成！"]);
        }
        $writecode = $_GPC["writecode"];
        if (mb_strlen($writecode) == 0) {
            resultMsg(["status" => 0, "msg" => "对不起,请填写核销码！"]);
        }
        $userDrawModel = pdo_get(ztbNopreTable("user_draw"), array("uniacid" => $uniacid, "store_id" => $store_id, "writecode" => $writecode, "deltime" => 0));
        if (empty($userDrawModel)) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if ($userDrawModel["types"] != 5) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if ($userDrawModel["status"] == 1) {
            resultMsg(["status" => 0, "msg" => "对不起,该奖品已核销！"]);
        }
        $cardInfo = array();
        $cardInfo["card_id"] = $userDrawModel["card_id"];
        $cardInfo["card_use_num"] = $userDrawModel["card_use_num"];
        $cardInfo["card_writeoff_num"] = $userDrawModel["card_writeoff_num"];
        $cardInfo["card_money"] = $userDrawModel["card_money"];
        $cardInfo["card_use_limit"] = $userDrawModel["card_use_limit"];
        $cardInfo["card_end_time"] = date("Y-m-d H:i:s", $userDrawModel["card_end_time"]);
        $cardInfo["card_pic_url"] = tomedia($userDrawModel["card_pic_url"]);
        $cardInfo["card_name"] = getDataById(ztbNopreTable("store_card"), $userDrawModel["card_id"], "name", "未知卡券");
        $cardInfo["store_name"] = getDataById(ztbNopreTable("store_account"), $userDrawModel["store_id"], "name", "未知商家");
        resultMsg(["status" => 1, "cardInfo" => $cardInfo]);
    }
    if ($act == "cardConfirmWrite" && $request_method == "post") {
        $writeopenid = $_GPC["writeopenid"];
        $writetime = max(0, intval($_GPC["writetime"]));
        if (mb_strlen($writeopenid) == 0) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if (time() - $writetime > 30 * 60) {
            resultMsg(["status" => 0, "msg" => "对不起,核销超时,请重新扫描！"]);
        }
        $writecode = $_GPC["writecode"];
        if (mb_strlen($writecode) == 0) {
            resultMsg(["status" => 0, "msg" => "对不起,请填写核销码！"]);
        }
        $userDrawModel = pdo_get(ztbNopreTable("user_draw"), array("uniacid" => $uniacid, "store_id" => $store_id, "writecode" => $writecode, "deltime" => 0));
        if (empty($userDrawModel)) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if ($userDrawModel["types"] != 5) {
            resultMsg(["status" => 0, "msg" => "对不起,核销信息错误！"]);
        }
        if ($userDrawModel["status"] == 1) {
            resultMsg(["status" => 0, "msg" => "对不起,该奖品已核销！"]);
        }
        if ($userDrawModel["card_use_num"] <= 0) {
            resultMsg(["status" => 0, "msg" => "对不起,卡券无可核销次数！"]);
        }
        if ($userDrawModel["card_end_time"] < time()) {
            resultMsg(["status" => 0, "msg" => "对不起,卡券已过期！"]);
        }
        $userCardUpdateModel = array("card_use_num -=" => 1, "card_writeoff_num +=" => 1, "card_end_time" => $userDrawModel["card_end_time"]);
        if ($userDrawModel["card_writeoff_num"] == 0) {
            $card_Info = getDataById(ztbNopreTable("store_card"), $userDrawModel["card_id"]);
            if ($card_Info["activity_types"] == 2) {
                $userCardUpdateModel["card_end_time"] = time() + intval($card_Info["time_day"]) * 24 * 60 * 60;
            }
        }
        pdo_update(ztbNopreTable("user_draw"), $userCardUpdateModel, array("id" => $userDrawModel["id"]));
        $storeCardWriteoffModel = array("uniacid" => $userDrawModel["uniacid"], "store_id" => $userDrawModel["store_id"], "voice_store_id" => $v_store_id, "activity_types" => $userDrawModel["activity_types"], "activity_id" => $userDrawModel["activity_id"], "card_id" => $userDrawModel["card_id"], "draw_id" => $userDrawModel["id"], "openid" => $userDrawModel["openid"], "nickname" => $userDrawModel["nickname"], "headurl" => $userDrawModel["headurl"], "admins" => $openid, "createtime" => time());
        pdo_insert(ztbNopreTable("store_card_writeoff"), $storeCardWriteoffModel);
        $cardUseNum = pdo_getcolumn(ztbNopreTable("user_draw"), array("id" => $userDrawModel["id"]), "card_use_num", 1);
        if ($cardUseNum == 0) {
            $userDrawUpdateModel = array("status" => 1, "admins" => $openid, "updatetime" => TIMESTAMP);
            pdo_update(ztbNopreTable("user_draw"), $userDrawUpdateModel, array("id" => $userDrawModel["id"]));
            if ($v_store_id > 0 && !empty($storeModel)) {
                $join_log = pdo_get(ztbNopreTable("obj_voice_join_log"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["id"], "draw_id" => $userDrawModel["id"], "types" => $userDrawModel["types"], "openid" => $userDrawModel["openid"], "store_voice_id" => $v_store_id));
                if (!empty($join_log)) {
                    $insert_voicered = array("uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $object["id"], "v_store_id" => $v_store_id, "store_id" => $store_id, "draw_id" => $userDrawModel["id"], "draw_name" => $userDrawModel["name"], "join_log_id" => $join_log["id"], "openid" => $userDrawModel["openid"], "nickname" => $userDrawModel["nickname"], "headurl" => $userDrawModel["headurl"], "admins" => $openid, "createtime" => TIMESTAMP);
                    $resultlog = pdo_insert(ztbNopreTable("obj_voice_store_writeoff", false), $insert_voicered);
                    $userVoiceredUpdateModel = array("is_verification" => 1, "admins" => $openid, "updatetime" => TIMESTAMP);
                    pdo_update(ztbNopreTable("obj_voice_join_log"), $userVoiceredUpdateModel, array("id" => $join_log["id"], "uniacid" => $uniacid));
                } else {
                    resultMsg(["status" => 0, "msg" => "对不起,用户参与信息已不存在，请联系管理员反馈！"]);
                }
            }
        }
        resultMsg(["status" => 1, "msg" => "核销成功！"]);
    }
}