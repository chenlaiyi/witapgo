<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
include MODULE_ROOT . "/inc/permission.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("index", "getJsonList");
if (!in_array($act, $allow_acts)) {
    $act = "index";
}
$title = "已购应用";
$authWarring = checkLywywlAuth($_W["uniacid"], $config["appid"]);

if ($act == "index") {
    load()->func("communication");
    load()->func("file");
    $uniacid = $_W["uniacid"];
    if (file_exists(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt")) {
        $fileContent = file_get_contents(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt");
        $fileArr = explode(",", $fileContent);
        if (count($fileArr) == 5 || count($fileArr) == 6) {
            $objectCode = IN_MODULE;
            $contacts = $fileArr[2];
            $tel = $fileArr[3];
            $authCode = $fileArr[1];
            $domain = $_SERVER["HTTP_HOST"];
            $ip = $_SERVER["SERVER_ADDR"];
            $wxAppID = $config["appid"];
            $types = intval($fileArr[5]);
            $timer = TIMESTAMP;
            $signStr = "ObjectCode=" . $objectCode . "&Contacts=" . $contacts . "&Tel=" . $tel . "&AuthCode=" . $authCode . "&Domain=" . $domain . "&IP=" . $ip . "&WxAppID=" . $wxAppID . "-" . $uniacid . "&Power=www.lywywl.com";
            $signStr = strtolower($signStr);
            $sign = strtoupper(md5($signStr));
            $posturl = "http://auth.lywywl.com/api";
            $post = array("ObjectCode" => $objectCode, "Contacts" => $contacts, "Tel" => $tel, "AuthCode" => $authCode, "Domain" => $domain, "IP" => $ip, "WxAppID" => $wxAppID . "-" . $uniacid, "Sign" => $sign, "Timer" => $timer);
$BackTime = strtoupper(md5($timer . ",www.lywywl.com"));
$content = array("status" => 1, "list" => array("AuthTimer" => $BackTime, "CustomerTypes" => 2, "Domain" => $domain, "IP" => $ip, "Plugins"=>'lywywl_ztb_plugin_storeinvite,lywywl_ztb_plugin_wholegroup,lywywl_ztb_plugin_10second,lywywl_ztb_plugin_appad,lywywl_ztb_plugin_rategroup,lywywl_ztb_plugin_adcheck,lywywl_ztb_plugin_twoinvite,lywywl_ztb_plugin_allinpay,lywywl_ztb_plugin_vaptcha,lywywl_ztb_plugin_shareborrow,lywywl_ztb_plugin_voice,lywywl_ztb_plugin_home,lywywl_ztb_plugin_refundtool,lywywl_ztb_plugin_ladderinvite,lywywl_ztb_plugin_texttoaudio,lywywl_ztb_plugin_bigscreen', "WxAppID" => $wxAppID, "StartTime" => '1973-12-12 00:00:00'));
$content = json_encode($content);
$response = array('code' => '200', 'content' => $content);
            if ($response["code"] == "200") {
                $result = (array) json_decode($response["content"], true);
                if ($result["list"]["CustomerTypes"] != $types) {
                    $authWarring = "pirateError";
                }
                if ($result["status"] == 1) {
                    $BackTime = $result["list"]["AuthTimer"];
                    $AuthTimer = strtoupper(md5($timer . ",www.lywywl.com"));
                    if ($BackTime == $AuthTimer) {
                        cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                        cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                        $auth_plugin_list = $result["list"]["Plugins"];
                    } else {
                        $authWarring = "pirateError";
                    }
                } else {
                    if ($result["status"] == -2) {
                        cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                        cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                        $authWarring = "statusError";
                    } else {
                        if ($result["status"] == 0) {
                            $authWarring = "paraError";
                        } else {
                            if ($result["status"] == 2) {
                                cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                                cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                                $authWarring = "renewError";
                            } else {
                                $authWarring = "pirateError";
                            }
                        }
                    }
                }
            } else {
                $authWarring = "networkError";
            }
        } else {
            $authWarring = "fileError";
        }
    } else {
        $authWarring = "waitError";
    }

    $buyid_list = array();
    $plugin_list = pdo_getall("modules", array("name like" => "lywywl_ztb_plugin_%"));
    foreach ($plugin_list as $key => $plugin) {
        if (!pdo_fieldexists("modules_recycle", "modulename")) {
            if (strpos($auth_plugin_list, $plugin["name"]) !== false) {
                $modules = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin["name"], "uniacid" => $_W["uniacid"], "deltime" => 0));
                if (empty($modules)) {
                    $result = pdo_insert("lywywl_ztb_sys_plugins", array("uniacid" => $_W["uniacid"], "name" => $plugin["name"], "status" => 0, "config" => '', "createtime" => TIMESTAMP, "updatetime" => TIMESTAMP));
                    if (!empty($result)) {
                        $buyid = pdo_insertid();
                        array_push($buyid_list, $buyid);
                    }
                } else {
                    array_push($buyid_list, $modules["id"]);
                }
            }
        } else {
            $recycle = pdo_get("modules_recycle", array("modulename" => $plugin["name"]), array("id", "modulename"));
            if (empty($recycle)) {
                if (strpos($auth_plugin_list, $plugin["name"]) !== false) {
                    $modules = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin["name"], "uniacid" => $_W["uniacid"], "deltime" => 0));
                    if (empty($modules)) {
                        $result = pdo_insert("lywywl_ztb_sys_plugins", array("uniacid" => $_W["uniacid"], "name" => $plugin["name"], "status" => 0, "config" => '', "createtime" => TIMESTAMP, "updatetime" => TIMESTAMP));
                        if (!empty($result)) {
                            $buyid = pdo_insertid();
                            array_push($buyid_list, $buyid);
                        }
                    } else {
                        array_push($buyid_list, $modules["id"]);
                    }
                }
            }
        }
    }
    if (!empty($buyid_list)) {
        pdo_query("UPDATE " . ztbTable("sys_plugins") . " SET deltime = :deltime WHERE uniacid = :uniacid and id NOT IN (" . implode(",", $buyid_list) . ")", array(":deltime" => TIMESTAMP, ":uniacid" => $_W["uniacid"]));
    }
    include $this->template("web/plugins_owner/index");
    exit;
}
if (!($act == "getJsonList")) {
    exit;
}
$pindex = max(1, intval($_GPC["page"]));
$psize = max(10, intval($_GPC["pageSize"]));
$where = " where `uniacid`=:uniacid  and `deltime`=0 ";
$params = array(":uniacid" => $_W["uniacid"]);
$key = trim($_GPC["key"]) ? trim($_GPC["key"]) : '';
if ($key) {
    $where = $where . " and (`name` like :key or `id`=:keyid )";
    $params[":key"] = "%" . $key . "%";
    $params[":keyid"] = intval($key);
}
$status = trim($_GPC["status"]);
if ($status !== '') {
    $where = $where . " and `status` = :status ";
    $params[":status"] = $status;
}
$timer = trim($_GPC["timer"]) ? trim($_GPC["timer"]) : '';
if ($timer) {
    $timeArr = explode("-", $timer);
    $where = $where . " and  `createtime`>=:starttime and `createtime` <=:endtime ";
    $params[":starttime"] = strtotime($timeArr[0] . "00:00:00");
    $params[":endtime"] = strtotime($timeArr[1] . "23:59:59");
}
$orderby = sprintf(" ORDER BY %s %s ", $_GPC["sortName"], $_GPC["sortOrder"]);
$sql = "SELECT * FROM " . ztbTable("sys_plugins") . $where . $orderby . "  LIMIT " . ($pindex - 1) * $psize . "," . $psize;
$list = pdo_fetchall($sql, $params);
$countSql = "SELECT COUNT(*) FROM " . ztbTable("sys_plugins") . $where;
$total = pdo_fetchcolumn($countSql, $params);
$listData = array();
$listData["total"] = $total;
$listData["rows"] = [];
$arrlength = count($list);
$i = 0;
while ($i < $arrlength) {
    $modules = module_fetch($list[$i]["name"]);
    if (empty($modules)) {
        $modules["title"] = str_replace("lywywl_ztb_plugin_", '', $list[$i]["name"]);
        $modules["version"] = "1.0.0";
        $modules["description"] = "暂无描述";
        $modules["logo"] = tomedia(MODULE_URL . "/resource/web/images/nopic.png");
    }
    $listData["rows"][] = ["id" => $list[$i]["id"], "uniacid" => $list[$i]["uniacid"], "name" => $list[$i]["name"], "title" => $modules["title"], "version" => $modules["version"], "description" => $modules["description"], "logo" => $modules["logo"], "status" => $list[$i]["status"], "updatetime" => date("Y-m-d H:i:s", $list[$i]["updatetime"]), "createtime" => date("Y-m-d H:i:s", $list[$i]["createtime"])];
    $i++;
}
resultMsg($listData);