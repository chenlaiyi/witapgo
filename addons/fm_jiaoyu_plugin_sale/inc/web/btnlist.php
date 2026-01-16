<?php
/**
 * [Fmoons System] Copyright (c) 2015 fmoons.com
 * Fmoons is NOT a free software, it under the license terms, visited http://www.fmoons.com/ for more details.
 */
define('IN_API', true);
require_once '../framework/bootstrap.inc.php';
require IA_ROOT. '/update/addons/fm_jiaoyu/inc/version.php';
load()->model('reply');
load()->app('common');
load()->classs('wesession');
load()->func('file');

$oauthurl = $_GPC['oauthurl'];
$visitorsip = $_GPC['visitorsip'];
$hostip = $_GPC['hostip'];
$fmauthtoken = $_GPC['fmauthtoken'];
$filename = date('ymdhis',time());
$ip = getip();

if (empty($oauthurl)) {
	echo 'error';
	exit;
}
$host = $_GPC['host'];
$sql = 'SELECT * FROM ' . tablename('wx_school_hostlist') . ' WHERE `host`=:oauthurl ';
$pars = array();
$pars[':oauthurl'] = 'http://' . $oauthurl;
$oauth = pdo_fetch($sql, $pars);
//$oauth = pdo_fetch("SELECT * FROM " . tablename('wx_school_hostlist') . " where weid = :weid And host = :host",array(':weid' => 1,':host' => $host));
$urls = "http://www.daren007.com/attachment/";
if ($oauth) {
	if($oauth['is_allow'] == 1){
		if($_GPC['type'] == 'amr'){
			if($_FILES){
				$result = 1;
				$files_amr = $_FILES["upload"]["tmp_name"];
				$path = "images/bjq/vioce/".$host."/";
				if (!is_dir(ATTACHMENT_ROOT."/".$path)) {
					mkdirs(ATTACHMENT_ROOT."/".$path, "0777");
				}
				$name = random(30);
				$name1 = $name;
				$amr = $path.$name.".amr";
				file_move($_FILES["upload"]["tmp_name"], ATTACHMENT_ROOT."/$amr");
				chmod(ATTACHMENT_ROOT."/$amr",0777);
				$mp3 = $path.$name1.".mp3";
				$command = "ffmpeg -i ".ATTACHMENT_ROOT."/$amr -b:a 128k ".ATTACHMENT_ROOT."/$mp3";
				system($command,$error);
				$mp3url = $urls.$mp3;
				chmod(ATTACHMENT_ROOT."/$mp3",0777);
			}else{
				$result = 2;
			}
			$fmdata = array(
				"result" => $result,
				"name" => $name,
				"mp3" => $mp3url
			);	
			die (json_encode($fmdata));
			exit();	
		}
		if($_GPC['type'] == 'delamr'){
			if($_GPC['mp3name']){
				$name = $_GPC['mp3name'];
				$amr = "images/bjq/vioce/".$oauthurl."/".$name.".amr";
				$mp3 = "images/bjq/vioce/".$oauthurl."/".$name.".mp3";
				file_delete($amr);
				file_delete($mp3);
			}
		}
		if($_GPC['type'] == 'delcheckpic'){
			if($_GPC['checkpic']){
				$name = trim($_GPC['checkpic']);
				$picname = str_replace('http://wmpickq.oss-cn-shenzhen.aliyuncs.com/','',$name);
				$filename = trim($picname);
				file_remote_delete($filename);		
			}
		}
	}	
}else{
	$caozuo = "音频操作";
	if($_GPC['mp3name'] == 'schoolid'){
		$caozuo = "基本设置";
	}
	if($_GPC['mp3name'] == 'manager'){
		$caozuo = "二维码管理";
	}	
	if($_GPC['mp3name'] == 'school'){
		$caozuo = "学校管理页面";
	}	
	pdo_insert('wx_school_illegal_url', array('host'=>$oauthurl, 'weid'=>1, 'visitorsip'=>$_GPC['host'], 'ip'=>$ip, 'caozuo'=>$caozuo, 'createtime'=>time()));
	$fmdata = array(
		"result" => 0,
		"s" => 0,
		"m" => '未授权！ 请联系官方客服，进行授权，否则出现问题自负！联系qq：332035136',
	);
	echo json_encode($fmdata);
	exit();
}