<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/mobile/init.php";
global $_GPC, $_W, $config;
$user = pdo_get(ztbNopreTable("user_account"), array("deltime" => 0, "openid" => $userinfo["openid"], "store_id" => $store_id, "uniacid" => $_W["uniacid"]));
if ($user["status"] == 0) {
    tip_redirect("对不起，用户存在违规操作已被禁用！");
}
cache_write("lywywl_ztb_scan_cache" . $_W["uniacid"], "true");
$token = $_GPC["token"];
$join_id = $_GPC["join_id"];
$i_openid = $_GPC["i_openid"];
$origin_id = $_GPC["origin_id"];
$act = empty($_GPC["act"]) ? "index" : $_GPC["act"];
$params = urldecode($_GPC["params"]);
if (!empty($token)) {
    $activity = pdo_get(ztbNopreTable("obj_activity"), array("deltime" => 0, "token" => $token, "uniacid" => $_W["uniacid"]));
    $obj_name = $activityTables[$activity["activity_types"]];
    $url = replaceDieDomain2($config, __MURL($obj_name, array("act" => $act, "token" => $token, "join_id" => $join_id, "i_openid" => $i_openid, "origin_id" => $origin_id), true, true) . $params, $user["id"], $activity["id"], $user["id"]);
    setCache($token . "_" . $user["id"], "ztb", 30);
    header("Location: " . $url);
    exit;
}
tip_redirect("参数错误");