<?php 
require "../framework/bootstrap.inc.php";
define("IN_MOBILE", true);
$_GPC["i"] = $_GPC["u"];
$_W["container"] = "wechat";
require IA_ROOT."/app/common/bootstrap.app.inc.php";
load()->app("common");
load()->app("template");
$op = $_GPC["a"];
if (empty($op)) $op = "index";
$method = "doMobile".$op;
$site = WeUtility::createModuleSite("hc_face");
if(!is_error($site)) {
	$site->$method($op);
}