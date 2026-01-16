<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

if(!defined('IN_IA')) { exit('Access Denied'); }

global $_GPC, $_W;

if (!function_exists('dump'))
{
	function dump()
	{
		$args = func_get_args();
		foreach ($args as $val)
		{
			echo '<pre style="color: red">';
			var_dump($val);
			echo "</pre>";
		}
	}
}

// 当前时间
$time = time();
$_W['slwl']['datetime']['timestamp'] = $time;
$_W['slwl']['datetime']['time'] = date('H:i:s', $time);
$_W['slwl']['datetime']['date'] = date('Y-m-d', $time);
$_W['slwl']['datetime']['now'] = date('Y-m-d H:i:s', $time);
$_W['slwl']['datetime']['now000000'] = date('Y-m-d 00:00:00', $time);
$_W['slwl']['datetime']['now235959'] = date('Y-m-d 23:59:59', $time);
$_W['slwl']['datetime']['nowYmdHis'] = date('YmdHis', $time);

$ver_mysql = pdo_fetchcolumn("SELECT VERSION() as version");
$ver_mysql = empty($ver_mysql)?'未知':$ver_mysql;

$_W['slwl']['system']['ver_php'] = PHP_VERSION;
$_W['slwl']['system']['ver_mysql'] = $ver_mysql;

// 检测环境
if(version_compare(PHP_VERSION, '5.4.0', '<')) { die('系统需要 PHP 5.4+'); };
if(version_compare($ver_mysql, '5.1.0', '<')) { die('系统需要 MYSQL 5.1+'); };

// 支付方式
// $_W['slwl']['pay_way'] = [
//     ['way' => 0, 'name' => '微信或余额支付'],
//     ['way' => 1, 'name' => '时间卡'],
//     ['way' => 2, 'name' => '次卡'],
//     ['way' => 3, 'name' => '课程次卡'],
//     ['way' => 5, 'name' => '限时次卡']
// ];

$_W['slwl']['pay_way'] = [
	['id'=>'0', 'way'=>'balance', 'name'=>'微信或余额支付'],
	['id'=>'1', 'way'=>'count', 'name'=>'剩余约课次数'],
	['id'=>'2', 'way'=>'card', 'name'=>'记次卡'],
	['id'=>'3', 'way'=>'unlimited', 'name'=>'无限次约课权'],
];

// 模板消息-类型
$_W['slwl']['tpl']['tpl_type'] = [
	['id'=>0, 'sl_title'=>'课程排队通知', 'type'=>'course_queue'],
	['id'=>1, 'sl_title'=>'课程预约通知', 'type'=>'course_reserve'],
	['id'=>2, 'sl_title'=>'购买私教-视频通知', 'type'=>'buy_coach_video'],
];

// site_settings = 基本设置

// 配置
$condition_setting = " AND uniacid=:uniacid OR uniacid='0' ";
$params_setting = array(':uniacid' => $_W['uniacid']);
$list_setting = @pdo_fetchall("SELECT * FROM " . tablename(SLWL_PREFIX.'settings') . ' WHERE 1 '
	. $condition_setting, $params_setting);
if ($list_setting) {
	foreach ($list_setting as $k => $v) {
		$tmp_name = $v['setting_name'];
		$_W['slwl']['set'][$tmp_name] = json_decode($v['setting_value'], TRUE);
	}
}

// 系统名
$_W['slwl']['lang']['sys_name'] = $_W['account']['name'];

// 版权信息
$_W['slwl']['copyright']['web'] = '@ '. $_W['slwl']['lang']['sys_name'] .' 版权所有';
if ($_W['slwl']['set']['cpright_site_settings']['copyright']) {
	$_W['slwl']['copyright']['web'] = $_W['slwl']['set']['cpright_site_settings']['copyright'];
}

// https域名
// https://c003.com/
$is_https = stripos($_W['siteroot'], 'https');
if ($is_https !== false) {
	$siteroot = $_W['siteroot'];
} else {
	$siteroot = preg_replace('/http/', 'https', $_W['siteroot'], 1);
}
$_W['slwl']['domain']['https_url'] = $siteroot;

