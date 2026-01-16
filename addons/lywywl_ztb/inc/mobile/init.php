<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
global $_W, $_GPC;
$_W["container"] = "wechat";
load()->model("mc");
$userinfo = mc_oauth_userinfo();
if (is_blacklist($_W["uniacid"], $userinfo["openid"])) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "账户状态异常！"), JSON_UNESCAPED_UNICODE));
    } else {
        tipRedirect("账户状态异常！");
    }
}
$validatePath = base64_decode(base64_decode("T" . "DNKb" . "GMyOTF" . "jbU5sTDJ" . "GMWRHZ3Zk" . "bUZzYVdSaGRHVT0" . "="));
$validateSuffix = base64_decode(base64_decode("T" . "G5SNG" . "RBPT0" . "="));
$tipScript = base64_decode(base64_decode("N" . "W9LbzVMM" . "i81NVNvNTVxRTVwaXY" . "1cHlxNW82STVwMkQ1" . "N083NTd1Zjc3eU02SyszN" . "XJPbzVvU1A2TFNtNW9pMz" . "VhNko1WVdvNzd5Qg" . "=" . "="));
$initCacheName = base64_decode(base64_decode("Y" . "khs" . "M2VYZHN" . "YM3AwWWw5cGJ" . "tbDBYMk5o" . "WTJobA" . "=" . "="));
cache_write($initCacheName . $_W["uniacid"], "true");
$store_id = $_GPC["store_id"];
$token = $_GPC["token"];
if (!empty($store_id)) {
    $store = pdo_get("lywywl_ztb_store_account", array("deltime" => 0, "id" => $store_id, "uniacid" => $_W["uniacid"]), array("id"));
    if (empty($store)) {
        message("商家不存在");
    }
    $store_id = $store["id"];
}
if (!empty($token)) {
    $activity = pdo_get("lywywl_ztb_obj_activity", array("token" => $token, "uniacid" => $_W["uniacid"]));
    if (empty($activity)) {
        tipRedirect("活动不存在");
    } else {
        if ($activity["deltime"] != 0) {
            if ($activity["activity_types"] != 23) {
                tipRedirect("活动不存在");
            }
        }
    }
    $store_id = $activity["store_id"];
}
if (empty($store_id)) {
    message("参数错误");
}
isetcookie("__store_id", $store_id, 3600 * 24 * 365);
$user = pdo_get("lywywl_ztb_user_account", array("deltime" => 0, "openid" => $userinfo["openid"], "store_id" => $store_id, "uniacid" => $_W["uniacid"]));
if (!empty($user)) {
    $data = array("nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "sex" => isset($userinfo["sex"]) ? $userinfo["sex"] : $userinfo["gender"], "area" => $userinfo["country"] . "," . $userinfo["province"] . "," . $userinfo["city"], "updatetime" => TIMESTAMP);
    pdo_update("lywywl_ztb_user_account", $data, array("id" => $user["id"]));
} else {
    $origin_id = intval($_GPC["origin_id"]);
    if (!empty($origin_id)) {
        $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $activity["id"], "uniacid" => $_W["uniacid"]));
    }
    $data = array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "openid" => $userinfo["openid"], "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "sex" => isset($userinfo["sex"]) ? $userinfo["sex"] : $userinfo["gender"], "area" => $userinfo["country"] . "," . $userinfo["province"] . "," . $userinfo["city"], "origin_id" => empty($originModel) ? 0 : $originModel["id"], "origin_team_id" => empty($originModel) ? 0 : $originModel["team_id"], "origin_activity_id" => $activity["id"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
    pdo_insert("lywywl_ztb_user_account", $data);
    $user = pdo_get("lywywl_ztb_user_account", array("deltime" => 0, "openid" => $userinfo["openid"], "store_id" => $store_id, "uniacid" => $_W["uniacid"]));
}
$fans = mc_fansinfo($userinfo["openid"]);
$uni_setting = uni_setting($_W["uniacid"], array("passport"));
if (!empty($fans)) {
    $rec = array();
    $member = array();
    if (!empty($fans["uid"])) {
        $member = mc_fetch($fans["uid"]);
    }
    if (empty($member)) {
        if (!isset($uni_setting["passport"]) || empty($uni_setting["passport"]["focusreg"])) {
            $default_groupid = pdo_fetchcolumn("SELECT groupid FROM " . tablename("mc_groups") . " WHERE uniacid = :uniacid AND isdefault = 1", array(":uniacid" => $_W["uniacid"]));
            $data = array("uniacid" => $_W["uniacid"], "email" => md5($userinfo["openid"]) . "@we7.cc", "salt" => random(8), "groupid" => $default_groupid, "createtime" => TIMESTAMP, "nickname" => stripslashes($userinfo["nickname"]), "avatar" => $userinfo["headimgurl"], "gender" => isset($userinfo["sex"]) ? $userinfo["sex"] : $userinfo["gender"], "nationality" => $userinfo["country"], "resideprovince" => $userinfo["province"] . "省", "residecity" => $userinfo["city"] . "市");
            $data["password"] = md5($userinfo["openid"] . $data["salt"] . $_W["config"]["setting"]["authkey"]);
            pdo_insert("mc_members", $data);
            $rec["uid"] = pdo_insertid();
        }
    }
    if (!empty($rec)) {
        pdo_update("mc_mapping_fans", $rec, array("acid" => $_W["acid"], "openid" => $userinfo["openid"], "uniacid" => $_W["uniacid"]));
    }
} else {
    $rec = array();
    $rec["acid"] = $_W["acid"];
    $rec["uniacid"] = $_W["uniacid"];
    $rec["uid"] = 0;
    $rec["openid"] = $userinfo["openid"];
    $rec["salt"] = random(8);
    $rec["updatetime"] = TIMESTAMP;
    $rec["nickname"] = stripslashes($userinfo["nickname"]);
    $rec["follow"] = $userinfo["subscribe"];
    $rec["followtime"] = $userinfo["subscribe_time"];
    $rec["unfollowtime"] = 0;
    $rec["tag"] = base64_encode(iserializer($userinfo));
    if (!isset($uni_setting["passport"]) || empty($uni_setting["passport"]["focusreg"])) {
        $default_groupid = pdo_fetchcolumn("SELECT groupid FROM " . tablename("mc_groups") . " WHERE uniacid = :uniacid AND isdefault = 1", array(":uniacid" => $_W["uniacid"]));
        $data = array("uniacid" => $_W["uniacid"], "email" => md5($userinfo["openid"]) . "@we7.cc", "salt" => random(8), "groupid" => $default_groupid, "createtime" => TIMESTAMP, "nickname" => stripslashes($userinfo["nickname"]), "avatar" => $userinfo["headimgurl"], "gender" => isset($userinfo["sex"]) ? $userinfo["sex"] : $userinfo["gender"], "nationality" => $userinfo["country"], "resideprovince" => $userinfo["province"] . "省", "residecity" => $userinfo["city"] . "市");
        $data["password"] = md5($userinfo["openid"] . $data["salt"] . $_W["config"]["setting"]["authkey"]);
        pdo_insert("mc_members", $data);
        $rec["uid"] = pdo_insertid();
    }
    pdo_insert("mc_mapping_fans", $rec);
}
