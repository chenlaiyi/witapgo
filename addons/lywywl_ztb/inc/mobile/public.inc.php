<?php
defined("IN_IA") or exit("Access Denied");
include MODULE_ROOT . "/inc/common.php";
global $_GPC, $_W, $config;
$request_method = strtolower($_SERVER["REQUEST_METHOD"]);
$act = trim($_GPC["act"]);
$allow_acts = array("addShare", "invest", "sendObjSms", "captcha", "checkActivity");
if ($act == "captcha") {
    load()->classs("captcha");
    session_start();
    $captcha = new Captcha();
    $captcha->build(150, 40);
    $hash = md5(strtolower($captcha->phrase) . $_W["config"]["setting"]["authkey"]);
    isetcookie("__code", $hash);
    $_SESSION["__code"] = $hash;
    $captcha->output();
}
include MODULE_ROOT . "/inc/mobile/init.php";
$uniacid = $_W["uniacid"];
$openid = $userinfo["openid"];
$token = $_GPC["token"];
if (empty($token)) {
    tip_redirect("活动标识错误，请从正常渠道进入活动！");
}
$activity = pdo_get(ztbNopreTable("obj_activity"), array("deltime" => 0, "uniacid" => $uniacid, "store_id" => $store_id, "token" => $token));
if (empty($activity)) {
    if ($_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动不存在！"), JSON_UNESCAPED_UNICODE));
    } else {
        tip_redirect("对不起，您参与的活动不存在！");
    }
}
if ($act == "checkActivity") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    if ($config["check_notify_openid"] == $openid) {
        if ($activity["check_status"] == 1) {
            $status = intval($_GPC["status"]);
            if ($status == 2) {
                $result = pdo_update(ztbNopreTable("obj_activity"), array("check_status" => $status, "updatetime" => TIMESTAMP), array("id" => $activity["id"]));
                if (!empty($result)) {
                    pdo_update(ztbNopreTable("obj_activity_location"), array("activity_check_status" => $status), array("activity_id" => $activity["id"]));
                    if ($config["check_notify_pushtmp"] && intval($config["activity_check"]) == 1) {
                        $store = pdo_get(ztbNopreTable("store_account"), array("id" => $activity["store_id"]));
                        if (!empty($store) && isFollow($store["openid"])) {
                            $postdata = array("first" => array("value" => "尊敬的商家用户，您发布的活动已审核。", "color" => "#173177"), "keyword1" => array("value" => "审核通过", "color" => "#173177"), "keyword2" => array("value" => date("Y-m-d H:i:s", TIMESTAMP), "color" => "#173177"), "remark" => array("value" => "活动名称【{$activity["title"]}】", "color" => "#173177"));
                            $template_id = $config["check_notify_pushtmp"];
                            $result = sendTplNotice($_W["uniacid"], $store["openid"], $postdata, $template_id);
                        }
                    }
                    if ($config["checknotifypushtmp_sub"] && intval($config["activity_check"]) == 1) {
                        $store = pdo_get(ztbNopreTable("store_account"), array("id" => $activity["store_id"]));
                        if ($store["openid"]) {
                            $touser = $store["openid"];
                            $template_id = $config["checknotifypushtmp_sub"];
                            $postdata = array("thing6" => array("value" => $activity["title"]), "phrase1" => array("value" => "审核通过"), "date3" => array("value" => date("Y-m-d H:i:s", TIMESTAMP)));
                            $result = sendWeixinTemplate($touser, $template_id, $postdata, '');
                        }
                    }
                    exit(json_encode(array("status" => 1, "msg" => "恭喜您,活动已通过审核！"), JSON_UNESCAPED_UNICODE));
                } else {
                    exit(json_encode(array("status" => 0, "msg" => "对不起,由于系统原因审核失败！"), JSON_UNESCAPED_UNICODE));
                }
            } else {
                if ($status == 3) {
                    $refuse = "不符合活动规范！";
                    $result = pdo_update(ztbNopreTable("obj_activity"), array("check_status" => $status, "updatetime" => TIMESTAMP, "check_note" => $refuse), array("id" => $activity["id"]));
                    if (!empty($result)) {
                        pdo_update(ztbNopreTable("obj_activity_location"), array("activity_check_status" => $status), array("activity_id" => $activity["id"]));
                        if ($config["check_notify_pushtmp"] && intval($config["activity_check"]) == 1) {
                            $store = pdo_get(ztbNopreTable("store_account"), array("id" => $activity["store_id"]));
                            if (!empty($store) && isFollow($store["openid"])) {
                                $postdata = array("first" => array("value" => "尊敬的商家用户，您发布的活动未通过审核，请根据驳回原因进行修改！", "color" => "#173177"), "keyword1" => array("value" => "驳回审核", "color" => "#173177"), "keyword2" => array("value" => date("Y-m-d H:i:s", TIMESTAMP), "color" => "#173177"), "remark" => array("value" => "活动名称【{$activity["title"]}】", "color" => "#173177"));
                                $template_id = $config["check_notify_pushtmp"];
                                $result = sendTplNotice($_W["uniacid"], $store["openid"], $postdata, $template_id);
                            }
                        }
                        if ($config["checknotifypushtmp_sub"] && intval($config["activity_check"]) == 1) {
                            $store = pdo_get(ztbNopreTable("store_account"), array("id" => $activity["store_id"]));
                            if ($store["openid"]) {
                                $touser = $store["openid"];
                                $template_id = $config["checknotifypushtmp_sub"];
                                $postdata = array("thing6" => array("value" => $activity["title"]), "phrase1" => array("value" => "驳回审核"), "date3" => array("value" => date("Y-m-d H:i:s", TIMESTAMP)));
                                $result = sendWeixinTemplate($touser, $template_id, $postdata, '');
                            }
                        }
                        exit(json_encode(array("status" => 1, "msg" => "恭喜您,活动已驳回审核！"), JSON_UNESCAPED_UNICODE));
                    } else {
                        exit(json_encode(array("status" => 0, "msg" => "对不起,由于系统原因审核失败！"), JSON_UNESCAPED_UNICODE));
                    }
                } else {
                    exit(json_encode(array("status" => 0, "msg" => "对不起，活动审核状态未知！"), JSON_UNESCAPED_UNICODE));
                }
            }
        } else {
            if ($activity["check_status"] == 2) {
                exit(json_encode(array("status" => 0, "msg" => "对不起，活动审核已通过！"), JSON_UNESCAPED_UNICODE));
            } else {
                if ($activity["check_status"] == 3) {
                    exit(json_encode(array("status" => 0, "msg" => "对不起，活动审核已驳回！"), JSON_UNESCAPED_UNICODE));
                } else {
                    exit(json_encode(array("status" => 0, "msg" => "对不起，活动审核状态未知！"), JSON_UNESCAPED_UNICODE));
                }
            }
        }
    } else {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
} else {
    if (intval($activity["status"]) != 1) {
        if ($_W["isajax"]) {
            exit(json_encode(array("status" => 0, "msg" => "对不起，您参与的活动已被下架！"), JSON_UNESCAPED_UNICODE));
        } else {
            tip_redirect("对不起，您参与的活动已被下架！");
        }
    }
}
if ($act == "addShare") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $origin_id = intval($_GPC["origin_id"]);
    if (!empty($origin_id)) {
        $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $activity["id"], "uniacid" => $_W["uniacid"]));
        if (empty($originModel)) {
            exit(json_encode(array("status" => 0, "msg" => "对不起,您访问的活动链接不合法！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $player_id = intval($_GPC["player_id"]);
    if (!empty($player_id)) {
        $player = pdo_get("lywywl_ztb_obj_vote_player", array("uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $player_id, "auditing" => 1, "status" => 1, "deltime" => 0));
        if (empty($player)) {
            exit(json_encode(array("status" => 0, "msg" => "对不起,您访问的活动链接不合法！"), JSON_UNESCAPED_UNICODE));
        }
    }
    $data = array("uniacid" => $activity["uniacid"], "store_id" => $activity["store_id"], "activity_types" => $activity["activity_types"], "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "ip" => $_W["clientip"], "createtime" => TIMESTAMP);
    if ($activity["activity_types"] == 1) {
        $object = pdo_get(ztbNopreTable("obj_share"), array("activity_id" => $activity["id"], "models" => 1, "is_register" => 1), array("id"));
        if ($object) {
            $register_data = $_GPC["reg_objshare_" . $object["id"]];
            if (!empty($register_data)) {
                $data["note"] = base64_decode($register_data);
            }
        }
    }
    pdo_insert(ztbNopreTable("user_share"), $data);
    pdo_update(ztbNopreTable("obj_activity"), array("repost_num +=" => 1), array("id" => $activity["id"]));
    if (!empty($origin_id)) {
        pdo_update(ztbNopreTable("marketing_user"), array("repost_num +=" => 1), array("id" => $origin_id));
    }
    if (!empty($player_id)) {
        pdo_update(ztbNopreTable("obj_vote_player"), array("repost_num +=" => 1), array("id" => $player_id));
    }
    exit(json_encode(array("status" => 1, "msg" => "恭喜您，转发成功！"), JSON_UNESCAPED_UNICODE));
}
if ($act == "invest" && $request_method == "post") {
    if (!$_W["isajax"]) {
        exit(json_encode(array("status" => 0, "msg" => "请不要非法请求数据！"), JSON_UNESCAPED_UNICODE));
    }
    $username = $_GPC["username"];
    $mobile = $_GPC["mobile"];
    if (empty($username)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，请输入您的称呼！"), JSON_UNESCAPED_UNICODE));
    }
    if (empty($mobile)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，请输入您的手机号码！"), JSON_UNESCAPED_UNICODE));
    }
    if (!preg_match("/^(1[3,4,5,6,7,8,9]{1}\\d{9})\$/", $mobile)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，请输入正确的手机号码！"), JSON_UNESCAPED_UNICODE));
    }
    $sysInvestModel = array("uniacid" => $activity["uniacid"], "store_id" => $activity["store_id"], "activity_types" => $activity["activity_types"], "activity_id" => $activity["id"], "openid" => $openid, "nickname" => $userinfo["nickname"], "headurl" => $userinfo["headimgurl"], "username" => $username, "mobile" => $mobile, "status" => 0, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
    $result = pdo_insert(ztbNopreTable("sys_invest"), $sysInvestModel);
    if (empty($result)) {
        exit(json_encode(array("status" => 0, "msg" => "亲，由于系统原因提交失败请重试！"), JSON_UNESCAPED_UNICODE));
    } else {
        if ($config["openid"] && $config["invitepushtmp"]) {
            $typename = $activityTypes[$activity["activity_types"]];
            if (isFollow($config["openid"], $_W["uniacid"])) {
                $postdata = array("first" => array("value" => "客户通过{$typename}活动发起了咨询服务，请及时处理。", "color" => "#173177"), "keyword1" => array("value" => $username, "color" => "#173177"), "keyword2" => array("value" => $mobile, "color" => "#173177"), "keyword3" => array("value" => date("Y-m-d H:i", TIMESTAMP), "color" => "#173177"), "remark" => array("value" => "请到平台后台招商咨询里面查看详情。", "color" => "#173177"));
                $template_id = $config["invitepushtmp"];
                $result = sendTplNotice($_W["uniacid"], $config["openid"], $postdata, $template_id);
            }
        }
        if ($config["invitepushtmp_sub"] && $config["openid"]) {
            $touser = $config["openid"];
            $template_id = $config["invitepushtmp_sub"];
            $typename = $activityTypes[$activity["activity_types"]];
            $postdata = array("name1" => array("value" => $username), "phone_number5" => array("value" => $mobile), "time2" => array("value" => date("Y-m-d H:i", TIMESTAMP)), "thing3" => array("value" => "客户通过{$typename}活动发起了咨询服务。"));
            $result = sendWeixinTemplate($touser, $template_id, $postdata, '');
        }
        exit(json_encode(array("status" => 1, "msg" => "提交成功，我们会尽快联系您的哦！"), JSON_UNESCAPED_UNICODE));
    }
}
if ($act == "sendObjSms" && $request_method == "post") {
    $mobile = $_GPC["mobile"];
    if (empty($mobile)) {
        resultMsg(["status" => 0, "msg" => "请输入手机号码！"]);
    }
    if (!preg_match("/^(1[3,4,5,6,7,8,9]{1}\\d{9})\$/", $mobile)) {
        resultMsg(["status" => 0, "msg" => "手机号码格式错误！"]);
    }
    session_start();
    $session_name = "public_sendObjSms_code_" . $token . "_" . $openid;
    $code = $_SESSION[$session_name];
    if (!empty($code)) {
        $code_arr = explode(",", $code);
        if (is_array($code_arr)) {
            if (time() - $code_arr[2] <= 120) {
                resultMsg(["status" => 0, "msg" => "对不起，发送频繁，请" . (120 - (time() - $code_arr[2])) . "秒后再试！"]);
            }
        }
    }
    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $activity["uniacid"], "id" => $activity["store_id"], "deltime" => 0));
    if (empty($storeModel) || $storeModel["sms"] <= 0) {
        resultMsg(["status" => 0, "msg" => "对不起，发送失败，请重试！"]);
    }
    $sms_code = random(6, true);
    if (intval($config["sms_types"]) == 0) {
        $sn = $config["sms_uid"];
        $pwd = $config["sms_key"];
        $sms_content = "您的验证码：" . $sms_code . ",请于10分钟内输入短信验证码，请勿将验证码告知他人！";
        if (empty($storeModel["zucp_ext"])) {
            $sms_content .= "【{$config["name"]}】";
        } else {
            $sms_content .= "【{$storeModel["name"]}】";
        }
        $result = zucp_mt($sn, $pwd, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
        $res = $result === true;
    } else {
        $ali_accesskeyid = $config["ali_accesskeyid"];
        $ali_accesskeysecret = $config["ali_accesskeysecret"];
        $sign = $config["ali_sign"];
        $templatecode = $config["ali_tmpid"];
        $sms_content = "通过阿里大鱼模板ID：" . $templatecode . "，签名：" . $sign . "，短信验证码：" . $sms_code . "，发送成功！";
        $param = ["code" => $sms_code];
        $result = dysms_send($ali_accesskeyid, $ali_accesskeysecret, $mobile, $sign, $templatecode, $param);
        $res = $result->Message == "OK";
    }
    if ($res === true) {
        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $activity["store_id"]));
        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $activity["uniacid"], "store_id" => $activity["store_id"], "mobile" => $mobile, "reason" => "手机验证", "note" => $sms_content, "createtime" => TIMESTAMP));
        $_SESSION[$session_name] = $mobile . "," . $sms_code . "," . time();
        resultMsg(["status" => 1, "msg" => "发送成功！"]);
    } else {
        resultMsg(["status" => 0, "msg" => "对不起，发送失败，请重试！"]);
    }
}