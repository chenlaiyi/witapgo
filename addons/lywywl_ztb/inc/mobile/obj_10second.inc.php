<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "check", "challenge", "draw", "register");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 22;
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
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_10second");
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
$object = pdo_get(ztbNopreTable("obj_10second"), array("deltime" => 0, "activity_id" => $activity["id"]));
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
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    if ($object["is_show_ads"] == 1) {
        if (empty($_GPC["ad_10second_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_10second_" . $object["id"], "ad", 3600 * 24);
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
    $inviteCount = 0;
    if (intval($object["models"]) == 0 && intval($object["is_invite_friend"]) > 0) {
        if (intval($object["get_types"]) == 0) {
            $inviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND share_openid = :share_openid AND is_share = 1", array(":activity_id" => $object["activity_id"], ":share_openid" => $openid));
            if (intval($object["invite_limit_num"]) > 0) {
                $inviteCount = min(intval($object["invite_limit_num"]), $inviteCount);
            }
        } else {
            $inviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND share_openid = :share_openid AND is_share = 1", array(":activity_id" => $object["activity_id"], ":share_openid" => $openid));
            if (intval($object["invite_limit_num"]) > 0) {
                $inviteCount = min(intval($object["invite_limit_num"]), $inviteCount);
            }
        }
    }
    if (intval($object["get_types"]) == 0) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
        $surplusCount = $count >= $object["limit_num"] + $inviteCount ? 0 : $object["limit_num"] + $inviteCount - $count;
    }
    if (intval($object["get_types"]) == 1) {
        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id  AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
        $surplusCount = $count >= $object["limit_num"] + $inviteCount ? 0 : $object["limit_num"] + $inviteCount - $count;
    }
    $winerModel = pdo_get(ztbNopreTable("obj_10second_join"), array("deltime" => 0, "activity_id" => $object["activity_id"], "openid" => $openid, "is_winer" => 1, "uniacid" => $_W["uniacid"]));
    $registerTipShow = 0;
    if (intval($object["is_register"]) > 0) {
        $registerTipShow = 1;
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
        $register_data = $_GPC["reg_obj10second_" . $object["id"]];
        if (!empty($register_data)) {
            $registerTipShow = 0;
        }
    }
    if ($object["banner_types"] == 0) {
        $object["multi_banner_url"] = explode(",", $object["multi_banner_url"]);
    }
    if ($object["is_show_join"] > 0) {
        $joinUserList = pdo_getall(ztbNopreTable("obj_10second_join"), array("deltime" => 0, "activity_id" => $object["activity_id"], "activity_types" => $activity_types), array("nickname", "headurl", "times", "createtime"), '', "id desc", 20);
        if (count($joinUserList) < 20 && intval($activity["bogus_join_num"]) > 0) {
            $bogusJoinCount = 20 - count($joinUserList);
            if (20 > count($joinUserList) + intval($activity["bogus_join_num"])) {
                $bogusJoinCount = intval($activity["bogus_join_num"]);
            }
            $userCache = cache_load("lywywl_ztb_10second_bogus_join_" . $openid);
            if (!empty($configCache)) {
                return $configCache[$config];
            } else {
                $userList = pdo_fetchall("SELECT nickname,avatar,createtime FROM " . tablename("mc_members") . " where avatar<>\"\" order by uid desc LIMIT 10,41");
                foreach ($userList as $key => $user) {
                    $userList[$key]["times"] = rand($object["winner_starttime"] - 1000, $object["winner_endtime"] + 1000);
                }
                cache_write("lywywl_ztb_10second_bogus_join_" . $openid, $userList);
            }
            foreach ($userList as $user) {
                $is_insert = true;
                foreach ($joinUserList as $joinUser) {
                    if (!($joinUser["nickname"] == $user["nickname"])) {
                        if ($user["nickname"] == $userinfo["nickname"]) {
                            $is_insert = false;
                        }
                    }
                    $is_insert = false;
                }
                if ($is_insert) {
                    $insertUser = array("nickname" => $user["nickname"], "headurl" => $user["avatar"], "times" => $user["times"], "createtime" => $activity["start_time"]);
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
    }
    if ($object["is_show_winners"] > 0) {
        $drawUserList = pdo_getall(ztbNopreTable("user_draw"), array("deltime" => 0, "activity_id" => $object["activity_id"], "types >" => 0), array("nickname", "headurl", "name", "createtime"), '', "id desc", 20);
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
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    if (intval($object["models"]) == 0 && intval($object["is_invite_friend"]) > 0) {
        $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "i_openid" => $openid), false, TRUE);
        if (!empty($_GET["i_openid"])) {
            $i_openid = $_GET["i_openid"];
            isetcookie("i_openid_10second_" . $object["id"], $_GET["i_openid"], 3600 * 24);
        } else {
            $i_openid = $_GPC["i_openid_10second_" . $object["id"]];
        }
    }
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $object["activity_id"], $user["id"]);
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
if ($act == "check" && $request_method == "post") {
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
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    if (intval($object["models"]) == 0 && intval($object["is_invite_friend"]) > 0) {
        $inviteCount = 0;
        if (intval($object["get_types"]) == 0) {
            $inviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND share_openid = :share_openid AND is_share = 1", array(":activity_id" => $object["activity_id"], ":share_openid" => $openid));
            if (intval($object["invite_limit_num"]) > 0) {
                $inviteCount = min(intval($object["invite_limit_num"]), $inviteCount);
            }
            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
            if ($count >= intval($object["limit_num"]) + $inviteCount) {
                thread_unlock($openid);
                if (intval($object["invite_limit_num"]) > 0) {
                    if (intval($object["invite_limit_num"]) <= $inviteCount) {
                        exit(json_encode(array("status" => 0, "msg" => "亲，您本次活动的挑战次数已用完！"), JSON_UNESCAPED_UNICODE));
                    } else {
                        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，您参与本次活动已达到挑战上限，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                    }
                } else {
                    exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，您参与本次活动已达到挑战上限，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                }
            }
        }
        if (intval($object["get_types"]) == 1) {
            $inviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND share_openid = :share_openid AND is_share = 1", array(":activity_id" => $object["activity_id"], ":share_openid" => $openid));
            if (intval($object["invite_limit_num"]) > 0) {
                $inviteCount = min(intval($object["invite_limit_num"]), $inviteCount);
            }
            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id  AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
            if ($count >= intval($object["limit_num"]) + $inviteCount) {
                thread_unlock($openid);
                if (intval($object["invite_limit_num"]) > 0) {
                    if (intval($object["invite_limit_num"]) <= $inviteCount) {
                        exit(json_encode(array("status" => 0, "msg" => "亲，您今天的挑战次数已用完！"), JSON_UNESCAPED_UNICODE));
                    } else {
                        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，系统每日限制挑战" . $object["limit_num"] . "次，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                    }
                } else {
                    exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，系统每日限制挑战" . $object["limit_num"] . "次，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                }
            }
        }
    } else {
        if (intval($object["models"]) == 1) {
            if (intval($userAccount["score"]) < intval($object["cost_score"])) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "您的账户积分不足,无法进行挑战"), JSON_UNESCAPED_UNICODE));
            }
        } else {
            if (intval($object["get_types"]) == 0) {
                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
                if ($count >= intval($object["limit_num"])) {
                    thread_unlock($openid);
                    exit(json_encode(array("status" => 0, "msg" => "亲，您参与本次活动已达到挑战上限，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
                }
            }
            if (intval($object["get_types"]) == 1) {
                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id  AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
                if ($count >= intval($object["limit_num"])) {
                    thread_unlock($openid);
                    exit(json_encode(array("status" => 0, "msg" => "亲，系统每日限制挑战" . $object["limit_num"] . "次，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
                }
            }
        }
    }
    if ($object["area_limit"]) {
        $areaArr = explode(",", $object["area_limit"]);
        $longitude = $_GPC["longitude"];
        $latitude = $_GPC["latitude"];
        if (empty($longitude) || empty($latitude)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "area", "msg" => "亲，请同意授权获取地理位置后，再进行挑战！"), JSON_UNESCAPED_UNICODE));
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
    if (intval($object["is_register"]) == 1) {
        $register_data = $_GPC["reg_obj10second_" . $object["id"]];
        if (empty($register_data)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "register", "msg" => "请先登记后再挑战"), JSON_UNESCAPED_UNICODE));
        }
    }
    cache_write("lywywl_ztb_obj10second_check_cache_" . $user["id"] . "_" . $object["id"], "start");
    $startCache = cache_load("lywywl_ztb_obj10second_check_cache_" . $user["id"] . "_" . $object["id"]);
    thread_unlock($openid);
    exit(json_encode(array("status" => 1, "msg" => "验证通过,开始跑秒！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "challenge" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $startCache = cache_load("lywywl_ztb_obj10second_check_cache_" . $user["id"] . "_" . $object["id"]);
    if (empty($startCache)) {
        exit(json_encode(array("status" => 0, "msg" => "请不要进行非法挑战！"), JSON_UNESCAPED_UNICODE));
    }
    cache_delete("lywywl_ztb_obj10second_check_cache_" . $user["id"] . "_" . $object["id"]);
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
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "deltime" => 0));
    $is_invate_draw = false;
    if (intval($object["models"]) == 0 && intval($object["is_invite_friend"]) > 0) {
        $inviteCount = 0;
        if (intval($object["get_types"]) == 0) {
            $inviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND share_openid = :share_openid AND is_share = 1", array(":activity_id" => $object["activity_id"], ":share_openid" => $openid));
            if (intval($object["invite_limit_num"]) > 0) {
                $inviteCount = min(intval($object["invite_limit_num"]), $inviteCount);
            }
            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
            if ($count >= intval($object["limit_num"]) + $inviteCount) {
                thread_unlock($openid);
                if (intval($object["invite_limit_num"]) > 0) {
                    if (intval($object["invite_limit_num"]) <= $inviteCount) {
                        exit(json_encode(array("status" => 0, "msg" => "亲，您本次活动的挑战次数已用完！"), JSON_UNESCAPED_UNICODE));
                    } else {
                        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，您参与本次活动已达到挑战上限，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                    }
                } else {
                    exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，您参与本次活动已达到挑战上限，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                }
            }
            if (intval($object["invite_limit_num"]) > 0) {
                if ($count >= intval($object["limit_num"]) && $count < intval($object["limit_num"]) + intval($object["invite_limit_num"])) {
                    $is_invate_draw = true;
                }
            } else {
                if ($count >= intval($object["limit_num"])) {
                    $is_invate_draw = true;
                }
            }
        }
        if (intval($object["get_types"]) == 1) {
            $inviteCount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND share_openid = :share_openid AND is_share = 1", array(":activity_id" => $object["activity_id"], ":share_openid" => $openid));
            if (intval($object["invite_limit_num"]) > 0) {
                $inviteCount = min(intval($object["invite_limit_num"]), $inviteCount);
            }
            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id  AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
            if ($count >= intval($object["limit_num"]) + $inviteCount) {
                thread_unlock($openid);
                if (intval($object["invite_limit_num"]) > 0) {
                    if (intval($object["invite_limit_num"]) <= $inviteCount) {
                        exit(json_encode(array("status" => 0, "msg" => "亲，您今天的挑战次数已用完！"), JSON_UNESCAPED_UNICODE));
                    } else {
                        exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，系统每日限制挑战" . $object["limit_num"] . "次，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                    }
                } else {
                    exit(json_encode(array("status" => 0, "tip" => "join", "msg" => "亲，系统每日限制挑战" . $object["limit_num"] . "次，分享朋友圈邀请好友参与可获得一次挑战机会！"), JSON_UNESCAPED_UNICODE));
                }
            }
            if (intval($object["invite_limit_num"]) > 0) {
                if ($count >= intval($object["limit_num"]) && $count < intval($object["limit_num"]) + intval($object["invite_limit_num"])) {
                    $is_invate_draw = true;
                }
            } else {
                if ($count >= intval($object["limit_num"])) {
                    $is_invate_draw = true;
                }
            }
        }
    } else {
        if (intval($object["models"]) == 1) {
            if (intval($userAccount["score"]) < intval($object["cost_score"])) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "您的账户积分不足,此次挑战无效！"), JSON_UNESCAPED_UNICODE));
            }
        } else {
            if (intval($object["get_types"]) == 0) {
                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
                if ($count >= intval($object["limit_num"])) {
                    thread_unlock($openid);
                    exit(json_encode(array("status" => 0, "msg" => "亲，您参与本次活动已达到挑战上限，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
                }
            }
            if (intval($object["get_types"]) == 1) {
                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_10second_join") . " WHERE deltime = 0 AND activity_id = :activity_id  AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d') AND openid = :openid", array(":activity_id" => $object["activity_id"], ":openid" => $openid));
                if ($count >= intval($object["limit_num"])) {
                    thread_unlock($openid);
                    exit(json_encode(array("status" => 0, "msg" => "亲，系统每日限制挑战" . $object["limit_num"] . "次，叫朋友一起参与吧！"), JSON_UNESCAPED_UNICODE));
                }
            }
        }
    }
    if ($object["area_limit"]) {
        $areaArr = explode(",", $object["area_limit"]);
        $longitude = $_GPC["longitude"];
        $latitude = $_GPC["latitude"];
        if (empty($longitude) || empty($latitude)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "area", "msg" => "亲，请同意授权获取地理位置后，再进行挑战！"), JSON_UNESCAPED_UNICODE));
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
    if (intval($object["is_register"]) == 1) {
        $register_data = $_GPC["reg_obj10second_" . $object["id"]];
        if (empty($register_data)) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "tip" => "register", "msg" => "请先登记后再挑战"), JSON_UNESCAPED_UNICODE));
        }
    }
    $millisecond = intval($_GPC["millisecond"]);
    $is_winer = 0;
    if ($object["winner_types"] == 0) {
        if ($object["winner_starttime"] <= $millisecond && $millisecond <= $object["winner_endtime"]) {
            $is_winer = 1;
        }
    } else {
        if ($object["winner_starttime"] == $millisecond && $millisecond == $object["winner_endtime"]) {
            $is_winer = 1;
        }
        if ($object["set_interval"] == 4) {
            $is_winer = 0;
        }
    }
    if ($is_invate_draw) {
        if (intval($object["get_types"]) == 0) {
            $inviteModel = pdo_get(ztbNopreTable("obj_10second_join"), array("deltime" => 0, "activity_id" => $object["activity_id"], "share_openid" => $openid, "is_share" => 1, "share_status" => 0), array("id"));
        }
        if (intval($object["get_types"]) == 1) {
            $inviteModel = pdo_get(ztbNopreTable("obj_10second_join"), array("deltime" => 0, "activity_id" => $object["activity_id"], "share_openid" => $openid, "is_share" => 1, "share_status" => 0, "createtime >" => strtotime(date("Y-m-d"))), array("id"));
        }
        if (!empty($inviteModel)) {
            pdo_update(ztbNopreTable("obj_10second_join"), array("share_status" => 1), array("id" => $inviteModel["id"]));
        }
    }
    if (intval($object["models"]) == 1) {
        $note = "挑战支付：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，支付积分：" . $object["cost_score"];
        $cost_score = intval($object["cost_score"]);
        pdo_update(ztbNopreTable("user_account"), array("score -=" => $cost_score), array("store_id" => $store_id, "openid" => $openid));
        $userScoreModel = array();
        $userScoreModel["uniacid"] = $uniacid;
        $userScoreModel["store_id"] = $store_id;
        $userScoreModel["openid"] = $openid;
        $userScoreModel["nickname"] = $userinfo["nickname"];
        $userScoreModel["headurl"] = $userinfo["headimgurl"];
        $userScoreModel["types"] = 6;
        $userScoreModel["activity_types"] = $activity_types;
        $userScoreModel["detail_id"] = $object["activity_id"];
        $userScoreModel["score"] = $cost_score;
        $userScoreModel["note"] = $note;
        $userScoreModel["createtime"] = TIMESTAMP;
        pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
    }
    pdo_update(ztbNopreTable("obj_activity"), array("join_num +=" => 1), array("id" => $object["activity_id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
    }
    $data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "times" => $millisecond, "is_share" => 0, "share_openid" => '', "share_nickname" => '', "share_headurl" => '', "is_winer" => $is_winer, "share_status" => 0, "createtime" => TIMESTAMP);
    if (intval($object["is_register"]) == 1) {
        $data["register_data"] = base64_decode($register_data);
    }
    $i_openid = $_GPC["i_openid"];
    if (!empty($i_openid) && $i_openid != $openid) {
        $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $i_openid, "deltime" => 0));
        $data["share_openid"] = $userModel["openid"];
        $data["share_nickname"] = $userModel["nickname"];
        $data["share_headurl"] = $userModel["headurl"];
        $objInvite = pdo_get(ztbNopreTable("obj_10second_join"), array("uniacid" => $uniacid, "activity_id" => $object["activity_id"], "openid" => $openid, "share_openid" => $i_openid, "is_share" => 1));
        if (empty($objInvite)) {
            $data["is_share"] = 1;
        }
    }
    $result = pdo_insert(ztbNopreTable("obj_10second_join", false), $data);
    if (!empty($result)) {
        $join_id = pdo_insertid();
        thread_unlock($openid);
        exit(json_encode(array("status" => 1, "join_id" => $join_id, "is_winer" => $is_winer, "msg" => "参与成功！"), JSON_UNESCAPED_UNICODE));
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起,系统错误请稍后挑战！"), JSON_UNESCAPED_UNICODE));
    }
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
    $verify = trim($_GPC["verify_code"]);
    if (empty($verify)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "请输入有效兑换码！"), JSON_UNESCAPED_UNICODE));
    }
    $result = $_GPC["__code"] == md5(strtolower($verify) . $_W["config"]["setting"]["authkey"]);
    if (empty($result)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "请确认兑换码有否有效！"), JSON_UNESCAPED_UNICODE));
    }
    $join_id = intval($_GPC["join_id"]);
    $joinModel = pdo_get(ztbNopreTable("obj_10second_join"), array("deltime" => 0, "id" => $join_id, "openid" => $openid, "is_winer" => 1, "uniacid" => $_W["uniacid"]));
    if (empty($joinModel)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，请在挑战成功后领取奖品！"), JSON_UNESCAPED_UNICODE));
    }
    $userAccount = pdo_get(ztbNopreTable("user_account"), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "deltime" => 0));
    $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1), array(), '', "sort asc");
    if (!empty($prizeList)) {
        $prizeModel = null;
        foreach ($prizeList as $key => $val) {
            if (!(intval($val["surplus"]) <= 0)) {
                if (!(intval($val["odds"]) <= 0)) {
                    if (!(intval($val["types"]) > 0)) {
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
                        $max_draw = intval($object["max_draw"]);
                        if (!($max_draw > 0)) {
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
                            $userDrawCount = pdo_getcolumn(ztbNopreTable("user_draw"), array("deltime" => 0, "activity_id" => $object["activity_id"], "openid" => $openid, "types >" => "0"), "count(*)");
                            if (!($userDrawCount >= $max_draw)) {
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
            exit(json_encode(array("status" => 0, "msg" => "您来晚了，奖品已被抽完！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "您来晚了，奖品已被抽完！"), JSON_UNESCAPED_UNICODE));
    }
    $draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $joinModel["origin_team_id"], "origin_id" => $joinModel["origin_id"], "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "project_id" => $joinModel["id"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
    if (intval($object["is_register"]) == 1) {
        $draw_data["register_data"] = $joinModel["register_data"];
    }
    $result = pdo_insert(ztbNopreTable("user_draw"), $draw_data);
    $writecode = '';
    if (!empty($result)) {
        $draw_id = pdo_insertid();
        $hashids = Hashids::instance(6, "lywyztb", '');
        $encode_id = $hashids->encode($draw_id);
        $draw_data = array("writecode" => $encode_id);
        pdo_update(ztbNopreTable("user_draw"), $draw_data, array("id" => $draw_id));
        $writecode = $encode_id;
    }
    if (intval($prizeModel["types"]) == 1) {
        if (intval($prizeModel["create_types"]) == 1) {
            list($min, $max) = explode("-", $prizeModel["score"]);
            $prizeModel["score"] = mt_rand($min, $max);
        }
        $note = "挑战获得：" . timeToStr(TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"];
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
    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
    if (!empty($joinModel["origin_id"])) {
        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $joinModel["origin_id"]));
    }
    pdo_update(ztbNopreTable("obj_10second_join"), array("is_winer" => 2), array("id" => $joinModel["id"]));
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
    if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
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
        if (intval($object["draw_is_sms"]) == 1 && $storeModel["sms"] > 0) {
            if (!empty($object["draw_sms_tmp"])) {
                if (!empty($userAccount["mobile"])) {
                    $sms_uid = $config["sms_uid"];
                    $sms_key = $config["sms_key"];
                    $mobile = $userAccount["mobile"];
                    $sms_content = $object["draw_sms_tmp"];
                    $sms_content = str_replace("{NICKNAME}", $userAccount["nickname"], $sms_content);
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
                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "中奖通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                    }
                }
            }
        }
    }
    $result_data = array("status" => 1, "draw_id" => $draw_id, "prize_id" => $prizeModel["id"], "prize_types" => $prizeModel["types"], "prize_name" => $prizeModel["name"], "prize_picurl" => tomedia($prizeModel["picurl"]), "score" => $prizeModel["score"], "sys" => $prizeModel["sys"], "money" => $prizeModel["money"], "card_id" => $prizeModel["card_id"], "is_register" => $object["is_register"], "writecode" => $writecode, "writeoff_types" => $prizeModel["writeoff_types"]);
    thread_unlock($openid);
    exit(json_encode($result_data, JSON_UNESCAPED_UNICODE));
}
if ($act == "register" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
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
            pdo_update(ztbNopreTable("user_account"), array("mobile" => $item["Value"]), array("store_id" => $store_id, "openid" => $openid));
        }
    }
    unset($item);
    isetcookie("reg_obj10second_" . $object["id"], base64_encode(serialize($registerFields)), 3600 * 24 * 365);
    exit(json_encode(array("status" => 1, "msg" => "登记成功,开始挑战吧！"), JSON_UNESCAPED_UNICODE));
}