<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
include MODULE_ROOT . "/inc/class/Hashids.class.php";
include MODULE_ROOT . "/inc/class/WxpayService.class.php";
include_once MODULE_ROOT . "/inc/function/app.tpl.func.php";
include MODULE_ROOT . "/inc/class/AllinpayService.class.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "detail", "ranking", "search", "getJsonList", "signup", "vote", "player", "share", "owner", "getOwnerJsonList", "getPayNumber", "wxPay", "checkPay", "payOk", "check_signup");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$activity_types = 18;
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
    $plug_appad_act = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_appad", "is_open_vote");
}
$plug_allinpay = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_allinpay");
$plug_vaptcha = getPluginStatus($_W["uniacid"], "lywywl_ztb_plugin_vaptcha");
$is_vaptcha_vote = 0;
if ($plug_vaptcha) {
    $is_vaptcha_vote = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_vaptcha", "is_vaptcha_vote");
    $vaptcha_vid = getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_vaptcha", "vid");
}
if (empty($token)) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "活动标识错误，请从正常渠道进入活动！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("活动标识错误，请从正常渠道进入活动！");
    }
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
$object = pdo_get(ztbNopreTable("obj_vote"), array("deltime" => 0, "activity_id" => $activity["id"]));
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
    $Contact_tel .= $originModel["mobile"];
} else {
    if (!empty($activity["tel"])) {
        $Contact_tel = $activity["tel"];
    } else {
        $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
        $store_config = iunserializer($storeAccount["config"]);
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
        if (empty($_GPC["ad_vote_" . $object["id"]])) {
            $object["is_show_ads"] = 1;
            isetcookie("ad_vote_" . $object["id"], "ad", 3600 * 24);
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
    if (!empty($object["group_content"])) {
        $groupList = explode(",", $object["group_content"]);
    }
    $playerList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_vote_player") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and status=1 and auditing=1 and deltime=0 order by sort asc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    $chartjs = pdo_fetch("SELECT sum(get_num + bogus_get_num) as get_num,sum(buy_num + bogus_buy_num) as buy_num,sum(gift_num) as gift_num,sum(gift_money) as gift_money  FROM " . ztbTable("obj_vote_player") . " where `uniacid`=:uniacid and `activity_id`=:activity_id and `store_id`=:store_id and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":activity_id" => $activity["id"], ":store_id" => $store_id));
    $get_num = empty($chartjs["get_num"]) ? 0 : $chartjs["get_num"];
    $buy_num = empty($chartjs["buy_num"]) ? 0 : $chartjs["buy_num"];
    $gift_num = empty($chartjs["gift_num"]) ? 0 : $chartjs["gift_num"];
    $gift_money = empty($chartjs["gift_money"]) ? 0 : $chartjs["gift_money"];
    $player_num = count($playerList);
    $store_map_list = unserialize($object["store_map_list"]);
    if (!empty($store_map_list) && is_array($store_map_list)) {
        foreach ($store_map_list as $key => $value) {
            $map_lat_lng = Convert_BD09_To_GCJ02($value["lat"], $value["lng"]);
            $store_map_list[$key]["lat"] = $map_lat_lng["lat"];
            $store_map_list[$key]["lng"] = $map_lat_lng["lng"];
        }
    }
    foreach ($playerList as $player) {
        if (strpos($player["openid"], $openid) !== false) {
            $playerModel = $player;
        }
    }
    
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
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
if ($act == "detail") {
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    include $this->template("tmp/" . $tmp["resource"] . "/detail");
    exit;
}
if ($act == "ranking") {
    if (!empty($object["group_content"])) {
        $groupList = explode(",", $object["group_content"]);
    }
    $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `deltime`=0 and status=1 and auditing=1";
    $params = array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]);
    $group_id = trim($_GPC["group_id"]) == '' ? "-1" : trim($_GPC["group_id"]);
    if ($group_id > -1) {
        $where = $where . " and `group_id` = :group_id ";
        $params[":group_id"] = $group_id;
    }
    $rankingList = pdo_fetchall("SELECT *,(get_num + bogus_get_num + buy_num + bogus_buy_num) as vote_num FROM " . ztbTable("obj_vote_player") . $where . " order by  vote_num desc, fulltime asc, id desc " . "  LIMIT " . $object["ranking_count"], $params);
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    include $this->template("tmp/" . $tmp["resource"] . "/ranking");
    exit;
}
if ($act == "search") {
    if (!empty($object["group_content"])) {
        $groupList = explode(",", $object["group_content"]);
    }
    $key = trim($_GPC["key"]) ? trim($_GPC["key"]) : '';
    $group_id = trim($_GPC["group_id"]) == '' ? "-1" : trim($_GPC["group_id"]);
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
    $store_config = iunserializer($storeAccount["config"]);
    include $this->template("tmp/" . $tmp["resource"] . "/search");
    exit;
}
if ($act == "getJsonList") {
    $pindex = max(1, intval($_GPC["page"]));
    $psize = max(1, intval($_GPC["pageSize"]));
    $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `deltime`=0 and status=1 and auditing=1";
    $params = array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]);
    $key = trim($_GPC["key"]) ? trim($_GPC["key"]) : '';
    if ($key) {
        $where = $where . " and (`name` like :key or `number` like :key or `id`=:keyid )";
        $params[":key"] = "%" . $key . "%";
        $params[":keyid"] = intval($key);
    }
    $group = trim($_GPC["group"]);
    if ($group > -1) {
        $where = $where . " and `group_id` = :group_id ";
        $params[":group_id"] = $group;
    }
    $sort = trim($_GPC["sort"]);
    if (empty($sort)) {
        $orderby = sprintf(" ORDER BY %s , %s ", "sort asc", "vote_num desc");
    } else {
        if ($sort == "vote") {
            $orderby = sprintf(" ORDER BY %s , %s ", "vote_num desc, fulltime asc", "id desc");
        } else {
            if ($sort == "number") {
                $orderby = sprintf(" ORDER BY %s , %s ", "number+0 asc", "id desc");
            }
        }
    }
    $sql = "SELECT * ,(CONVERT(get_num,SIGNED) \r\n    + CONVERT(bogus_get_num,SIGNED)  + CONVERT(buy_num,SIGNED)  + CONVERT(bogus_buy_num,SIGNED) ) as vote_num  \r\n    FROM " . ztbTable("obj_vote_player") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
    $list = pdo_fetchall($sql, $params);
    $listData = array();
    $listData["rows"] = [];
    $arrlength = count($list);
    $i = 0;
    while ($i < $arrlength) {
        $listData["rows"][] = ["id" => $list[$i]["id"], "name" => $list[$i]["name"], "number" => $list[$i]["number"], "attr_data" => iunserializer($list[$i]["attr_data"]), "register_data" => iunserializer($list[$i]["register_data"]), "pic_url" => empty($list[$i]["pic_url"]) ? tomedia(MODULE_URL . "resource/web/images/nopic-small.jpg") : tomedia($list[$i]["pic_url"]), "content" => utf8_strcut(strip_tags(htmlspecialchars_decode($list[$i]["content"])), 0, 100), "get_num" => $list[$i]["get_num"], "bogus_get_num" => $list[$i]["bogus_get_num"], "buy_num" => $list[$i]["buy_num"], "bogus_buy_num" => $list[$i]["bogus_buy_num"], "repost_num" => $list[$i]["repost_num"], "click_num" => $list[$i]["click_num"], "gift_money" => $list[$i]["gift_money"], "gift_num" => $list[$i]["gift_num"], "vote_num" => $list[$i]["vote_num"], "updatetime" => date("Y-m-d H:i:s", $list[$i]["updatetime"]), "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
        $i++;
    }
    resultMsg($listData);
}
if ($act == "check_signup" && $request_method == "get") {
    if ($object["is_signup"] != 1) {
        tip_redirect("对不起，本投票活动禁止报名！");
    }
    if ($object["signup_start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，报名在：" . timeToStr($object["signup_start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["signup_end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，报名在：" . timeToStr($object["signup_end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $record = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($record) {
        if ($record["auditing"] == 0) {
            exit(json_encode(array("status" => 0, "msg" => "您已提交申请，正在审核中,请勿重复操作!"), JSON_UNESCAPED_UNICODE));
        } else {
            exit(json_encode(array("status" => 2, "msg" => "您已报名成功，即将进入专属页面!"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        exit(json_encode(array("status" => 1, "msg" => "检验通过, 正在转跳至报名页面!"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "signup" && $request_method == "get") {
    if ($object["is_signup"] != 1) {
        tip_redirect("对不起，本投票活动禁止报名！");
    }
    if ($object["signup_start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，报名在：" . timeToStr($object["signup_start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["signup_end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，报名在：" . timeToStr($object["signup_end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if (!empty($object["group_content"])) {
        $groupList = explode(",", $object["group_content"]);
    }
    if (!empty($object["attr_register_field"])) {
        $attrFields = unserialize($object["attr_register_field"]);
        foreach ($attrFields as &$item) {
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
    $registerFields = unserialize($object["player_register_field"]);
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
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = replaceShareInfo($object["share_desc"]);
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id), false, TRUE);
    $copyLink = replaceDieDomain2($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/signup");
    exit;
}
if ($act == "signup" && $request_method == "post") {
    if (!checksubmit("submit")) {
        exit(json_encode(array("status" => 0, "msg" => "Token错误！"), JSON_UNESCAPED_UNICODE));
    }
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $model = $_GPC["model"];
    if ($object["is_signup"] != 1) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，本投票活动禁止报名！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["signup_start_time"] > TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，报名在：" . timeToStr($object["signup_start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["signup_end_time"] < TIMESTAMP) {
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，报名在：" . timeToStr($object["signup_start_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($model["name"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入参与选手名称！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["is_video"] == 0) {
        if (isset($model["pic_url"])) {
            if (empty($model["pic_url"])) {
                exit(json_encode(array("status" => 2, "msg" => "请上传选手封面图片！"), JSON_UNESCAPED_UNICODE));
            }
        }
        $banner_url = $_GPC["banner_url"];
        if (empty($banner_url)) {
            exit(json_encode(array("status" => 2, "msg" => "请上传选手展示组图！"), JSON_UNESCAPED_UNICODE));
        }
        if (!isset($model["pic_url"])) {
            $model["pic_url"] = $banner_url[0];
        }
        $model["banner_url"] = implode(",", $banner_url);
    } else {
        if (empty($model["pic_url"])) {
            exit(json_encode(array("status" => 2, "msg" => "请上传选手封面图片！"), JSON_UNESCAPED_UNICODE));
        }
        $video_url = $_GPC["video_url"];
        if (empty($video_url)) {
            exit(json_encode(array("status" => 2, "msg" => "请上传选手展示视频！"), JSON_UNESCAPED_UNICODE));
        }
        $model["video_url"] = $video_url;
        if (!empty($banner_url)) {
            $model["banner_url"] = implode(",", $banner_url);
        }
    }
    if (empty($model["content"])) {
        exit(json_encode(array("status" => 2, "msg" => "请输入选手简介内容！"), JSON_UNESCAPED_UNICODE));
    }
    $model["group_id"] = intval($model["group_id"]);
    if (empty($model["declaration"])) {
        exit(json_encode(array("status" => 2, "msg" => "请填写选手参赛宣言！"), JSON_UNESCAPED_UNICODE));
    }
    if (!empty($object["attr_register_field"])) {
        $attrFields = unserialize($object["attr_register_field"]);
        foreach ($attrFields as &$item) {
            if ($item["Type"] == "checkbox") {
                $item["Value"] = implode(",", $_GPC["attr_" . $item["Name"]]);
            } else {
                $item["Value"] = $_GPC["attr_" . $item["Name"]];
            }
            if (empty($item["Value"])) {
                exit(json_encode(array("status" => 2, "msg" => "请填写" . $item["Explain"] . "！"), JSON_UNESCAPED_UNICODE));
            }
        }
        unset($item);
        $model["attr_data"] = serialize($attrFields);
    }
    if ($object["player_is_register"] == 1) {
        $registerFields = unserialize($object["player_register_field"]);
        foreach ($registerFields as &$item) {
            if ($item["Type"] == "checkbox") {
                $item["Value"] = implode(",", $_GPC["reg_" . $item["Name"]]);
            } else {
                $item["Value"] = $_GPC["reg_" . $item["Name"]];
            }
            if ($item["Name"] == "Mobile") {
                if ($item["IsSmsCk"] == 1) {
                    $ckResult = smsCkMobile($_GPC["reg_" . $item["Name"]], $_GPC["reg_" . $item["Name"] . "_Code"], $token, $openid);
                    if ($ckResult !== true) {
                        return $ckResult;
                    }
                }
                pdo_update(ztbTable("user_account", false), array("mobile" => $_GPC["reg_" . $item["Name"]]), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
            }
        }
        unset($item);
        $model["register_data"] = serialize($registerFields);
    }
    $record = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($record) {
        exit(json_encode(array("status" => 0, "msg" => "您已提交申请，请勿重复操作！"), JSON_UNESCAPED_UNICODE));
    }
    $model["uniacid"] = $uniacid;
    $model["store_id"] = $store_id;
    $model["activity_types"] = $activity_types;
    $model["activity_id"] = $activity["id"];
    $model["origin_team_id"] = $originModel["team_id"];
    $model["origin_id"] = $origin_id;
    $model["number"] = 0;
    $model["openid"] = $openid;
    $model["qrcode_url"] = '';
    $model["sort"] = 4000;
    $model["status"] = 0;
    $model["auditing"] = 0;
    $model["updatetime"] = TIMESTAMP;
    $model["createtime"] = TIMESTAMP;
    $result = pdo_insert("lywywl_ztb_obj_vote_player", $model);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因提交失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    pdo_update(ztbTable("obj_activity", false), array("join_num +=" => 1), array("id" => $activity["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("join_num +=" => 1), array("id" => $origin_id));
    }
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id, "deltime" => 0));
    if ($config["objstorepushtmp"] && $storeModel["openid"]) {
        if (isFollow($storeModel["openid"], $uniacid)) {
            $postdata = array("first" => array("value" => "您的投票活动有新的入驻报名申请，请及时处理。", "color" => "#173177"), "keyword1" => array("value" => date("Y-m-d H:i", TIMESTAMP), "color" => "#173177"), "keyword2" => array("value" => "报名活动:{$activity["title"]}，", "color" => "#173177"), "remark" => array("value" => "点击查看入驻报名申请详情", "color" => "#173177"));
            $url = replaceDieDomain($config, __MURL("store.obj_vote_player_wait", array("act" => "index", "aid" => $activity["id"]), true, true), 0, 0, 0);
            $template_id = $config["objstorepushtmp"];
            $result = sendTplNotice($uniacid, $storeModel["openid"], $postdata, $template_id, $url);
        }
    }
    exit(json_encode(array("status" => 1, "msg" => "提交成功，请耐心等待审核！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "vote" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    $player_id = intval($_GPC["player_id"]);
    if ($object["is_verification"] == 1) {
        if ($plug_vaptcha && $is_vaptcha_vote == 1) {
            $verify_code = trim($_GPC["verify_code"]);
            if (empty($verify_code)) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "请通过人机验证后参与活动！"), JSON_UNESCAPED_UNICODE));
            }
            if (!vaptcha_verify($verify_code, 2)) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "请通过人机验证后参与活动！"), JSON_UNESCAPED_UNICODE));
            }
        } else {
            $verify = trim($_GPC["verify_code"]);
            if (empty($verify)) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "请输入有效验证码！"), JSON_UNESCAPED_UNICODE));
            }
            $result = $_GPC["__code"] == md5(strtolower($verify) . $_W["config"]["setting"]["authkey"]);
            if (empty($result)) {
                thread_unlock($openid);
                exit(json_encode(array("status" => 0, "msg" => "验证码输入有误！"), JSON_UNESCAPED_UNICODE));
            }
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
    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
    if (empty($player)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "对不起，没有获取到选手信息！"), JSON_UNESCAPED_UNICODE));
    }
    $blacklist = pdo_get("lywywl_ztb_obj_vote_blacklist", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    if ($blacklist) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "您的账号因刷票行为，已被禁止投票！"), JSON_UNESCAPED_UNICODE));
    }
    if ($object["player_get_click"] > 0) {
        $player_num = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id  and `player_id`=:player_id and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id));
        if ($player_num >= $object["player_get_click"]) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "选手获票已达上限" . $object["player_get_click"] . "票！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if ($object["toady_player_get_click"] > 0) {
        $today_player_num = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id  and `player_id`=:player_id and DATE_SUB(CURDATE(), INTERVAL 0 DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id));
        if ($today_player_num >= $object["toady_player_get_click"]) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "选手今日获票已达上限" . $object["toady_player_get_click"] . "票！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if ($object["user_give_max_click"] > 0) {
        $today_give_player_num = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id  and `player_id`=:player_id and `openid`=:openid and DATE_SUB(CURDATE(), INTERVAL 0 DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id, ":openid" => $openid));
        if ($today_give_player_num >= $object["user_give_max_click"]) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "您今日为该选手投票已达上限" . $object["user_give_max_click"] . "票！"), JSON_UNESCAPED_UNICODE));
        }
    }
    if ($object["max_click_types"] == 0) {
        $today_user_max_num = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id  and `openid`=:openid and DATE_SUB(CURDATE(), INTERVAL 0 DAY) <= date(from_unixtime(createtime)) and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_id" => $activity["id"], ":openid" => $openid));
        if ($today_user_max_num >= $object["max_click"]) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "您今日投票已达上限" . $object["max_click"] . "票！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        $total_user_max_num = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id  and `openid`=:openid and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_id" => $activity["id"], ":openid" => $openid));
        if ($total_user_max_num >= $object["max_click"]) {
            thread_unlock($openid);
            exit(json_encode(array("status" => 0, "msg" => "本次活动投票已达上限" . $object["max_click"] . "票！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $result = pdo_insert("lywywl_ztb_obj_vote_click", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "player_id" => $player_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "createtime" => TIMESTAMP));
    if (empty($result)) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因投票失败请重试！"), JSON_UNESCAPED_UNICODE));
    }
    $fans = pdo_get("lywywl_ztb_obj_vote_fans", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "deltime" => 0));
    if (empty($fans)) {
        pdo_insert("lywywl_ztb_obj_vote_fans", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "get_num" => 1, "gift_num" => 0, "createtime" => TIMESTAMP));
    } else {
        pdo_update(ztbTable("obj_vote_fans", false), array("get_num +=" => 1), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "deltime" => 0));
    }
    pdo_update(ztbTable("obj_activity", false), array("get_num +=" => 1), array("id" => $activity["id"]));
    pdo_update(ztbTable("obj_vote_player", false), array("get_num +=" => 1), array("id" => $player_id));
    if ($object["player_get_click"] > 0) {
        $player_num = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id  and `player_id`=:player_id and `deltime`=0 ", array(":uniacid" => $_W["uniacid"], ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id));
        if ($player_num == $object["player_get_click"]) {
            pdo_update(ztbTable("obj_vote_player", false), array("fulltime" => TIMESTAMP), array("id" => $player_id));
        }
    }
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
    }
    if ($object["is_show_success_ads"] > 0) {
        $object["success_ads_content"] = iunserializer($object["success_ads_content"]);
        $success_ads = $object["success_ads_content"][array_rand($object["success_ads_content"], 1)];
        $success_ads["Pic"] = tomedia($success_ads["Pic"]);
        thread_unlock($openid);
        exit(json_encode(array("status" => 1, "ads" => $success_ads, "msg" => "恭喜您，投票成功！"), JSON_UNESCAPED_UNICODE));
    } else {
        thread_unlock($openid);
        exit(json_encode(array("status" => 1, "ads" => '', "msg" => "恭喜您，投票成功！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "player") {
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
    $player_id = intval($_GPC["player_id"]);
    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
    if (empty($player)) {
        tip_redirect("对不起，没有找到您要查看的选手信息！");
    }
    if (!empty($object["group_content"])) {
        $groupList = explode(",", $object["group_content"]);
        $groupName = $groupList[$player["group_id"]];
    }
    $attrFields = unserialize($player["attr_data"]);
    $previous = 0;
    $playerList = pdo_fetchall("SELECT *,(get_num + bogus_get_num + buy_num + bogus_buy_num) as vote_num  FROM " . ztbTable("obj_vote_player") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and status=1 and auditing=1 and deltime=0 order by vote_num desc, fulltime asc, id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    foreach ($playerList as $key => $value) {
        if ($value["id"] == $player_id) {
            $previous = $key;
        }
    }
    $disparity = 0;
    if ($previous > 0) {
        $disparity = $playerList[$previous - 1]["vote_num"] - $playerList[$previous]["vote_num"];
    }
    if ($object["is_show_fans"] == 1) {
        $fansList = pdo_fetchall("SELECT *,(get_num + gift_num) as vote_num FROM " . ztbTable("obj_vote_fans") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `player_id`=:player_id and deltime=0 order by vote_num desc,id desc " . "  LIMIT 3", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id));
    }
    if ($object["is_show_click"] == 1) {
        $clickList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_vote_click") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `player_id`=:player_id and deltime=0 order by id desc " . "  LIMIT 20", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id));
        if ($object["gift_id"] > 0) {
            $giveList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_vote_gift") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `player_id`=:player_id and deltime=0 order by id desc " . "  LIMIT 20", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player_id));
        }
    }
    if ($object["gift_id"] > 0) {
        $giftSql = "SELECT * FROM " . ztbTable("sys_gift") . " where `deltime`=0 and status=1 and class_id=:class_id order by sort asc , id asc ";
        $giftList = pdo_fetchall($giftSql, array(":class_id" => $object["gift_id"]));
        $storeAccount = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id));
        $store_config = iunserializer($storeAccount["config"]);
        $userAccount = pdo_get(ztbNopreTable("user_account"), array("store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    }
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = $player["declaration"];
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "act" => "player", "params" => urlencode("&player_id=" . $player["id"])), false, TRUE);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    pdo_update(ztbTable("obj_activity", false), array("click_num +=" => 1), array("id" => $activity["id"]));
    pdo_update(ztbTable("obj_vote_player", false), array("click_num +=" => 1), array("id" => $player_id));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("click_num +=" => 1), array("id" => $origin_id));
    }
    include $this->template("tmp/" . $tmp["resource"] . "/player");
    exit;
}
if ($act == "share" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $player_id = intval($_GPC["player_id"]);
    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
    if (empty($player)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起,没有找到您要查看的选手信息！"), JSON_UNESCAPED_UNICODE));
    }
    if (!empty($originModel)) {
        if ($originModel["openid"] == $openid) {
            $player["qrcode_url"] = '';
        }
    }
    if (empty($player["qrcode_url"])) {
        load()->func("file");
        $qr_content = json_decode(htmlspecialchars_decode($object["qr_content"]), true);
        $isroot = 1;
        if (!empty($_W["setting"]["remote"]["type"])) {
            $isroot = 0;
        }
        if ($isroot == 1) {
            $file_path = MODULE_URL . "/resource/data/qrcode/{$activity["id"]}/player/{$player["id"]}.jpg";
            $outpath = MODULE_ROOT . "/resource/data/qrcode/{$activity["id"]}/player/";
        } else {
            $file_path = "lywywl_ztb/{$activity["id"]}/player/{$player["id"]}.jpg";
            $file_path = tomedia($file_path);
            $outpath = ATTACHMENT_ROOT . "lywywl_ztb/{$activity["id"]}/player/";
        }
        mkdirs($outpath);
        $filename = "{$player["id"]}.jpg";
        $outfile = $outpath . $filename;
        $qrcode_size = $config["qrcode_size"];
        if (empty($qrcode_size)) {
            $qrcode_size = 5;
        }
        $qrcode_level = $config["qrcode_level"];
        if (empty($qrcode_level)) {
            $qrcode_level = "L";
        }
        $scanurl = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "act" => "player", "params" => urlencode("&player_id=" . $player["id"])), false, TRUE);
        $scanurl = replaceDieDomain($config, $scanurl, $user["id"], $activity["id"], $user["id"]);
        $qr = poster($isroot, $scanurl, $outfile, $qrcode_level, $qrcode_size, 2, false, $object["qr_url"], $qr_content, $player);
        if ($qr !== false) {
            pdo_update(ztbTable("obj_vote_player", false), array("qrcode_url" => $file_path, "repost_num +=" => 1), array("id" => $player["id"]));
            exit(json_encode(array("status" => 1, "msg" => "恭喜您,专属海报创建成功！", "path" => $file_path), JSON_UNESCAPED_UNICODE));
        } else {
            exit(json_encode(array("status" => 0, "msg" => "二维码生成失败，请稍后重试！"), JSON_UNESCAPED_UNICODE));
        }
    } else {
        pdo_update(ztbNopreTable("obj_vote_player"), array("repost_num +=" => 1), array("id" => $player["id"]));
        exit(json_encode(array("status" => 1, "msg" => "恭喜您，专属海报创建成功！", "path" => $player["qrcode_url"]), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "owner") {
    $playerList = pdo_fetchall("SELECT * FROM " . ztbTable("obj_vote_player") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and status=1 and auditing=1 and deltime=0 order by sort asc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    foreach ($playerList as $item) {
        if (strpos($item["openid"], $openid) !== false) {
            $player = $item;
        }
    }
    if (!$player) {
        tip_redirect("对不起，没有查询到您的报名参赛信息！");
    }
    $previous = 0;
    $playerList = pdo_fetchall("SELECT *,(get_num + bogus_get_num + buy_num + bogus_buy_num) as vote_num FROM " . ztbTable("obj_vote_player") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and status=1 and auditing=1 and deltime=0 order by vote_num desc, fulltime asc,id desc ", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"]));
    foreach ($playerList as $key => $value) {
        if ($value["id"] == $player["id"]) {
            $previous = $key;
        }
    }
    $disparity = 0;
    if ($previous > 0) {
        $disparity = $playerList[$previous - 1]["vote_num"] - $playerList[$previous]["vote_num"];
    }
    if ($object["is_show_fans"] == 1) {
        $fansList = pdo_fetchall("SELECT *,(get_num + gift_num) as vote_num FROM " . ztbTable("obj_vote_fans") . " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `player_id`=:player_id and deltime=0 order by vote_num desc,id desc " . "  LIMIT 3", array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player["id"]));
    }
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = $player["declaration"];
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "act" => "player", "params" => urlencode("&player_id=" . $player["id"])), false, TRUE);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/owner");
}
if ($act == "getOwnerJsonList") {
    $player_id = intval($_GPC["player_id"]);
    $type = trim($_GPC["type"]);
    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
    if (empty($player)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，没有找到您要查看的选手信息！"), JSON_UNESCAPED_UNICODE));
    }
    if (strpos($player["openid"], $openid) === false) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您没有权限获取选手信息！"), JSON_UNESCAPED_UNICODE));
    }
    $pindex = max(1, intval($_GPC["page"]));
    $psize = max(1, intval($_GPC["pageSize"]));
    $where = " where `uniacid`=:uniacid and `store_id`=:store_id and `activity_id`=:activity_id and `player_id`=:player_id and `deltime`=0 ";
    $params = array(":uniacid" => $uniacid, ":store_id" => $store_id, ":activity_id" => $activity["id"], ":player_id" => $player["id"]);
    $orderby = sprintf(" ORDER BY %s ", "id desc");
    if ($type == "click") {
        $sql = "SELECT * FROM " . ztbTable("obj_vote_click") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
    } else {
        $sql = "SELECT * FROM " . ztbTable("obj_vote_gift") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
    }
    $list = pdo_fetchall($sql, $params);
    $listData = array();
    $listData["rows"] = [];
    $arrlength = count($list);
    $i = 0;
    while ($i < $arrlength) {
        if (!($type == "click")) {
            $listData["rows"][] = ["id" => $list[$i]["id"], "store_id" => $list[$i]["store_id"], "store_name" => getDataById(ztbNopreTable("store_account"), $list[$i]["store_id"], "name", "未知商家"), "activity_id" => $list[$i]["activity_id"], "activity_types" => $list[$i]["activity_types"], "activity_name" => getDataById(ztbNopreTable("obj_activity"), $list[$i]["activity_id"], "title", "未知活动"), "player_id" => $list[$i]["player_id"], "player_name" => getDataById(ztbNopreTable("obj_vote_player"), $list[$i]["player_id"], "name", "未知选手"), "gift_id" => $list[$i]["gift_id"], "num" => $list[$i]["num"], "openid" => $list[$i]["openid"], "nickname" => $list[$i]["nickname"], "headurl" => tomedia($list[$i]["headurl"]), "pay_number" => $list[$i]["pay_number"], "name" => $list[$i]["name"], "icon_url" => tomedia($list[$i]["icon_url"]), "paymoney" => $list[$i]["paymoney"], "endmoney" => $list[$i]["endmoney"], "vote" => $list[$i]["vote"], "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
        } else {
            $listData["rows"][] = ["id" => $list[$i]["id"], "store_id" => $list[$i]["store_id"], "store_name" => getDataById(ztbNopreTable("store_account"), $list[$i]["store_id"], "name", "未知商家"), "activity_id" => $list[$i]["activity_id"], "activity_types" => $list[$i]["activity_types"], "activity_name" => getDataById(ztbNopreTable("obj_activity"), $list[$i]["activity_id"], "title", "未知活动"), "player_id" => $list[$i]["player_id"], "player_name" => !empty($playerModel) ? $playerModel["name"] : "未知选手", "player_number" => !empty($playerModel) ? $playerModel["number"] : "未知编号", "openid" => $list[$i]["openid"], "nickname" => $list[$i]["nickname"], "headurl" => tomedia($list[$i]["headurl"]), "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
        }
        $i++;
    }
    resultMsg($listData);
}
if ($act == "getPayNumber" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if (!thread_lock($openid)) {
        exit(json_encode(array("status" => 0, "msg" => "当前请求速度过快，请稍后访问！"), JSON_UNESCAPED_UNICODE));
    }
    $player_id = intval($_GPC["player_id"]);
    $gift_id = intval($_GPC["giftid"]);
    $num = intval($_GPC["num"]);
    $use_sys_Money = $_GPC["use_sys_Money"];
    if ($activity["start_time"] > TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，不要着急，活动在：" . timeToStr($activity["start_time"]) . "开始！"), JSON_UNESCAPED_UNICODE));
    }
    if ($activity["end_time"] < TIMESTAMP) {
        thread_unlock($openid);
        exit(json_encode(array("status" => 0, "msg" => "亲，非常遗憾，活动在：" . timeToStr($activity["end_time"]) . "已经结束！"), JSON_UNESCAPED_UNICODE));
    }
    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
    if (empty($player)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，没有找到您要打赏的选手信息！"), JSON_UNESCAPED_UNICODE));
    }
    $gift = pdo_get("lywywl_ztb_sys_gift", array("id" => $gift_id, "status" => 1, "deltime" => 0));
    if (empty($player)) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，没有找到您要打赏的礼物信息！"), JSON_UNESCAPED_UNICODE));
    }
    $userModel = pdo_get(ztbtable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
    $storeConfig = getStoreConfig($uniacid, $store_id);
    $is_pay = true;
    if (floatval($gift["paymoney"] * $num) <= 0) {
        $is_pay = false;
    }
    $user_money = $userModel["money"];
    if ($use_sys_Money === "true" && $gift["paymoney"] * $num <= $user_money) {
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
        $payModel["data"] = "{$token},{$player_id},{$gift_id},{$num},{$origin_id}";
        $payModel["openid"] = $openid;
        $payModel["nickname"] = $userinfo["nickname"];
        $payModel["headurl"] = $userinfo["headimgurl"];
        $payModel["paynumber"] = getOrderNumber();
        if ($use_sys_Money == true) {
            if ($use_sys_Money === "true") {
                $payModel["paymoney"] = floatval($gift["paymoney"] * $num - $user_money);
                $payModel["mymoney"] = $user_money;
            } else {
                $payModel["paymoney"] = floatval($gift["paymoney"] * $num);
                $payModel["mymoney"] = 0;
            }
        } else {
            $payModel["paymoney"] = floatval($gift["paymoney"] * $num);
            $payModel["mymoney"] = 0;
        }
        $payModel["endmoney"] = $gift["endmoney"] * $num;
        $payModel["note"] = '';
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
        $payModel = array();
        $payModel["uniacid"] = $uniacid;
        $payModel["store_id"] = $store_id;
        $payModel["pay_method"] = 0;
        $payModel["terminal"] = 1;
        $payModel["types"] = 3;
        $payModel["data"] = "{$token},{$player_id},{$gift_id},{$num},{$origin_id}";
        $payModel["openid"] = $openid;
        $payModel["nickname"] = $userinfo["nickname"];
        $payModel["headurl"] = $userinfo["headimgurl"];
        $payModel["paynumber"] = getOrderNumber();
        $payModel["paymoney"] = 0;
        $payModel["mymoney"] = $gift["paymoney"] * $num;
        $payModel["endmoney"] = $gift["endmoney"] * $num;
        $payModel["note"] = '';
        $payModel["status"] = 1;
        $payModel["updatetime"] = TIMESTAMP;
        $payModel["createtime"] = TIMESTAMP;
        $payModel["activity_id"] = $activity["id"];
        pdo_insert(ztbTable("sys_pay", false), $payModel);
        $gift_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "player_id" => $player_id, "gift_id" => $gift_id, "num" => $num, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "pay_number" => $payModel["paynumber"], "name" => $gift["name"], "icon_url" => $gift["icon_url"], "cartoon_url" => $gift["cartoon_url"], "paymoney" => $gift["paymoney"] * $num, "endmoney" => $gift["endmoney"] * $num, "vote" => $gift["vote"] * $num, "createtime" => TIMESTAMP);
        $result = pdo_insert(ztbTable("obj_vote_gift", false), $gift_data);
        if (!empty($result)) {
            $gift_data_id = pdo_insertid();
        }
        pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => $gift["vote"] * $num), array("id" => $activity["id"]));
        pdo_update(ztbTable("obj_vote_player", false), array("buy_num +=" => $gift["vote"] * $num, "gift_money +=" => $gift["endmoney"] * $num, "gift_num +=" => $num), array("id" => $player["id"]));
        if (!empty($origin_id)) {
            pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => $gift["vote"] * $num), array("id" => $origin_id));
        }
        $fans = pdo_get("lywywl_ztb_obj_vote_fans", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "deltime" => 0));
        if (empty($fans)) {
            pdo_insert("lywywl_ztb_obj_vote_fans", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "get_num" => 0, "gift_num" => $gift["vote"] * $num, "createtime" => TIMESTAMP));
        } else {
            pdo_update(ztbTable("obj_vote_fans", false), array("gift_num +=" => $gift["vote"] * $num), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "deltime" => 0));
        }
        pdo_update(ztbTable("user_account", false), array("money -=" => $gift["paymoney"] * $num), array("id" => $userModel["id"]));
        $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userinfo["nickname"] . "】参与活动：" . $activity["title"] . "，赠送礼物" . $gift["name"] . "×" . $num . " 支付金额：" . floatval($gift["paymoney"] * $num) . "元";
        $userBillModel = array();
        $userBillModel["uniacid"] = $uniacid;
        $userBillModel["store_id"] = $store_id;
        $userBillModel["openid"] = $openid;
        $userBillModel["nickname"] = $userinfo["nickname"];
        $userBillModel["headurl"] = $userinfo["headimgurl"];
        $userBillModel["types"] = 2;
        $userBillModel["detail_id"] = $gift_data_id;
        $userBillModel["money"] = $gift["paymoney"] * $num;
        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
        $userBillModel["note"] = $note;
        $userBillModel["createtime"] = TIMESTAMP;
        pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
        pdo_update(ztbNopreTable("store_account"), array("money +=" => floatval($gift["endmoney"] * $num)), array("id" => $store_id));
        $storeBillModel = array();
        $storeBillModel["uniacid"] = $uniacid;
        $storeBillModel["store_id"] = $store_id;
        $storeBillModel["types"] = 12;
        $storeBillModel["detail_id"] = $gift_data_id;
        $storeBillModel["money"] = $gift["endmoney"] * $num;
        $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
        $storeBillModel["note"] = $note;
        $storeBillModel["createtime"] = TIMESTAMP;
        pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
        thread_unlock($openid);
        resultMsg(["status" => 1, "ispay" => 0, "pay_number" => $gift_data["pay_number"], "pay_price" => $gift["paymoney"] * $num, "msg" => "请求成功！"]);
    }
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
if ($act == "checkPay") {
    $pay_number = $_GPC["pay_number"];
    $payModel = pdo_get(ztbTable("sys_pay", false), array("paynumber" => $pay_number, "openid" => $openid, "uniacid" => $uniacid, "deltime" => 0));
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
                $dataarr = explode(",", $payModel["data"]);
                $payToken = $dataarr[0];
                $player_id = $dataarr[1];
                $gift_id = $dataarr[2];
                $num = $dataarr[3];
                $origin_id = intval($dataarr[4]);
                if ($payToken == $token) {
                    pdo_update(ztbTable("sys_pay", false), array("status" => 1, "note" => json_encode($result), "updatetime" => time()), array("id" => $payModel["id"]));
                    $userModel = pdo_get(ztbtable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "openid" => $openid));
                    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
                    $gift = pdo_get("lywywl_ztb_sys_gift", array("id" => $gift_id, "status" => 1, "deltime" => 0));
                    $gift_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "player_id" => $player_id, "gift_id" => $gift_id, "num" => $num, "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "pay_number" => $payModel["paynumber"], "name" => $gift["name"], "icon_url" => $gift["icon_url"], "cartoon_url" => $gift["cartoon_url"], "paymoney" => $gift["paymoney"] * $num, "endmoney" => $gift["endmoney"] * $num, "vote" => $gift["vote"] * $num, "createtime" => TIMESTAMP);
                    $result = pdo_insert(ztbTable("obj_vote_gift", false), $gift_data);
                    if (!empty($result)) {
                        $gift_data_id = pdo_insertid();
                    }
                    pdo_update(ztbTable("obj_activity", false), array("buy_num +=" => $gift["vote"] * $num), array("id" => $activity["id"]));
                    pdo_update(ztbTable("obj_vote_player", false), array("buy_num +=" => $gift["vote"] * $num, "gift_money +=" => $gift["endmoney"] * $num, "gift_num +=" => $num), array("id" => $player["id"]));
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable("marketing_user"), array("buy_num +=" => $gift["vote"] * $num), array("id" => $origin_id));
                    }
                    $fans = pdo_get("lywywl_ztb_obj_vote_fans", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "deltime" => 0));
                    if (empty($fans)) {
                        pdo_insert("lywywl_ztb_obj_vote_fans", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $userModel["openid"], "nickname" => $userModel["nickname"], "headurl" => $userModel["headurl"], "get_num" => 0, "gift_num" => $gift["vote"] * $num, "createtime" => TIMESTAMP));
                    } else {
                        pdo_update(ztbTable("obj_vote_fans", false), array("gift_num +=" => $gift["vote"] * $num), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "player_id" => $player_id, "openid" => $openid, "deltime" => 0));
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
                    $userBillModel["detail_id"] = $gift_data_id;
                    $userBillModel["money"] = $payModel["paymoney"];
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                    pdo_update(ztbTable("user_account", false), array("money -=" => $gift["paymoney"] * $num), array("id" => $userModel["id"]));
                    $note = "参与活动：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $activity["title"] . "，赠送礼物" . $gift["name"] . "×" . $num . " 支付金额：" . floatval($gift["paymoney"] * $num) . "元";
                    $userBillModel = array();
                    $userBillModel["uniacid"] = $uniacid;
                    $userBillModel["store_id"] = $store_id;
                    $userBillModel["openid"] = $userModel["openid"];
                    $userBillModel["nickname"] = $userModel["nickname"];
                    $userBillModel["headurl"] = $userModel["headurl"];
                    $userBillModel["types"] = 2;
                    $userBillModel["detail_id"] = $gift_data_id;
                    $userBillModel["money"] = $gift["paymoney"] * $num;
                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $openid), "money");
                    $userBillModel["note"] = $note;
                    $userBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                    pdo_update(ztbNopreTable("store_account"), array("money +=" => floatval($gift["endmoney"] * $num)), array("id" => $store_id));
                    $storeBillModel = array();
                    $storeBillModel["uniacid"] = $uniacid;
                    $storeBillModel["store_id"] = $store_id;
                    $storeBillModel["types"] = 12;
                    $storeBillModel["detail_id"] = $gift_data_id;
                    $storeBillModel["money"] = $gift["endmoney"] * $num;
                    $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                    $storeBillModel["note"] = $note;
                    $storeBillModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                }
            }
        }
    } else {
        tip_redirect("对不起，没有查询到您的支付信息！");
    }
    header("Location: " . __MURL("obj_vote", array("act" => "payOk", "pay_number" => $pay_number, "token" => $activity["token"], "origin_id" => $origin_id, "incoming" => "pay")));
    exit;
}
if ($act == "payOk") {
    $pay_number = $_GPC["pay_number"];
    $incoming = $_GPC["incoming"];
    $giftModel = pdo_get(ztbTable("obj_vote_gift", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "pay_number" => $pay_number));
    if (empty($giftModel)) {
        tip_redirect("对不起，没有查询到您的购买信息！");
    }
    $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $giftModel["player_id"], "auditing" => 1, "status" => 1, "deltime" => 0));
    $_share["title"] = replaceShareInfo($object["share_title"]) . (empty($origin_name) ? '' : "【" . $origin_name . "】");
    $_share["imgUrl"] = $object["share_thumb"] ? tomedia($object["share_thumb"]) : getMemberAvatar();
    $_share["desc"] = $player["declaration"];
    $_share["link"] = __MURL("scan", array("token" => $token, "origin_id" => $origin_id, "act" => "player", "params" => urlencode("&player_id=" . $player["id"])), false, TRUE);
    $_share["link"] = replaceDieDomain($config, $_share["link"], $user["id"], $activity["id"], $user["id"]);
    include $this->template("tmp/" . $tmp["resource"] . "/payOk");
    exit;
}