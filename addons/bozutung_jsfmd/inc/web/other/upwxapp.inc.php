<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = ($_GPC['op']) ? $_GPC['op'] : 'display';

$sys_id = $_W['uniacid'];
$account = uni_fetch($sys_id);
$app_id = $account['key'];
// $secret = $account['secret'];
unset($account);

if ($operation == 'display') {
	$where = ['uniacid'=>$_W['uniacid'], 'enabled'=>'1'];
	$total = pdo_count(sl_table_name('mod_wxapp'),$where);


} else if ($operation == 'post') {
	if ($_W['ispost']) {

		// 查出所有跳转小程序appid
		$where = ['uniacid'=>$_W['uniacid'], 'enabled'=>'1'];
		$order_by = [];
		$limit = [10];
		$list_appid = pdo_getall(sl_table_name('mod_wxapp'), $where, '', '', $order_by, $limit);

		$app_id_list = sl_array_column($list_appid, 'appid');

		$domain_https = substr($_GPC['siteroot'], 0, 5);
		if ($domain_https != 'https') {
			sl_ajax(1, '域名必需为https');
		}
		$set_auth = [];
		if ($_W['slwl']['set']['auth_settings']) {
			$set_auth = $_W['slwl']['set']['auth_settings'];
		}

		$param = [];
		$param['app_id']      = trim($_GPC['app_id']);
		$param['plugin']      = trim($_GPC['plugin']);
		$param['ver']         = trim($_GPC['ver']);
		$param['version']     = trim($_GPC['version']);
		$param['desc']        = trim($_GPC['desc']);
		$param['uniacid']     = trim($_GPC['uniacid']);
		$param['siteroot']    = trim($_GPC['siteroot']);
		$param['liveplayer']  = intval($_GPC['liveplayer']);
		$param['app_id_list'] = $app_id_list;

		$param['host'] = $set_auth['domain'];
		$param['code'] = $set_auth['code'];

		$resp = ihttp_request(SLWL_AUTH_URL . 'Index/sl_upload_wxapp', $param);
		$rst = @json_decode($resp['content'], true);

		// dump($resp);
		// dump($rst);
		// exit;

		if ($rst && $rst['code'] == 0) {
			sl_ajax(0, $rst['data']);
		} else {
			if (empty($rst['msg'])) {
				sl_ajax(1, '未知错误或返回为空');
			}
			sl_ajax(1, $rst['msg']);
		}
	}
	exit;


} else if ($operation == 'sl_check_login_code') {
	if ($_W['ispost']) {
		$resp = ihttp_request(SLWL_AUTH_URL . 'Index/sl_check_login_code');
		$rst = @json_decode($resp['content'], true);

		// dump($resp);
		// dump($rst);
		// exit;

		if ($rst['code'] == '0') {
			sl_ajax(0, $rst['data']);

		} else {
			sl_ajax(1, $rst['msg']);
		}
	}


} else if ($operation == 'sl_check_login_ok') {
	if ($_W['ispost']) {
		$resp = ihttp_request(SLWL_AUTH_URL . 'Index/sl_check_login_ok');
		$rst = @json_decode($resp['content'], true);

		// dump($resp);
		// dump($rst);
		// exit;

		if ($rst['code'] == '0') {
			sl_ajax(0, $rst['data']);

		} else {
			sl_ajax(1, $rst['msg']);
		}
	}


} else if ($operation == 'sl_check_preview_code') {
	if ($_W['ispost']) {
		$resp = ihttp_request(SLWL_AUTH_URL . 'Index/sl_check_preview_code');
		$rst = @json_decode($resp['content'], true);

		// dump($resp);
		// dump($rst);
		// exit;

		if ($rst['code'] == '0') {
			sl_ajax(0, $rst['data']);

		} else {
			sl_ajax(1, $rst['msg']);
		}
	}


} else {
	message('请求方法不存在');
}

include $this->template('web/other/upwxapp');

