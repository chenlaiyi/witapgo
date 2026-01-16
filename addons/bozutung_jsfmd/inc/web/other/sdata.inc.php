<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = ($_GPC['op']) ? $_GPC['op'] : 'display';

if ($_W['ispost']) {
	$agreement = intval($_GPC['agreement']);
	if ($agreement != '1') {
		sl_ajax(1, '请勾选协议！');
	}

	$ws_data_history_update = intval($_GPC['ws_data_history_update']); // 官网模块-历史数据升级
	$dy_data_history_update = intval($_GPC['dy_data_history_update']); // 动态模块-历史数据升级
	$ai_data_history_update = intval($_GPC['ai_data_history_update']); // AI助手-历史数据升级
	$store_class_transfer = intval($_GPC['store_class_transfer']); // 商城模块-分类-旧版转到新版

	$sys_users_clear = intval($_GPC['sys_users_clear']); // 系统-清空-客户数据表
	$sys_mycard_clear = intval($_GPC['sys_mycard_clear']); // 系统-清空-我的卡片数据表
	$sys_formid_clear = intval($_GPC['sys_formid_clear']); // 清空-放心清-表单ID表
	$sys_oplog_clear = intval($_GPC['sys_oplog_clear']); // 清空-放心清-操作日志表


	// 官网模块-文章
	if ($ws_data_history_update == '1')
	{
		$condition_act_news = " AND uniacid=:uniacid AND title='' ";
		$params_act_news = array(':uniacid' => $_W['uniacid']);
		$sql_act_news = "SELECT * FROM " . sl_table_name('website_act_news',true). ' WHERE 1 ' . $condition_act_news;
		$list_act_news = pdo_fetchall($sql_act_news, $params_act_news);

		if ($list_act_news) {
			foreach ($list_act_news as $k => $v) {
				if ((isset($v['newsname'])) && ($v['newsname'] != '')) {
					$data_act_news = array(
						'title'=>$v['newsname'],
					);
					@pdo_update(sl_table_name('website_act_news'), $data_act_news, array('id'=>$v['id']));
				}
			}
		}
	}
	// 动态模块-文章
	if ($dy_data_history_update == '1')
	{
		$condition_act_news = " AND uniacid=:uniacid AND title='' ";
		$params_act_news = array(':uniacid' => $_W['uniacid']);
		$sql_act_news = "SELECT * FROM " . sl_table_name('dynamic_act',true). ' WHERE 1 ' . $condition_act_news;
		$list_act_news = pdo_fetchall($sql_act_news, $params_act_news);

		if ($list_act_news) {
			foreach ($list_act_news as $k => $v) {
				if ((isset($v['dy_title'])) && ($v['dy_title'] != '')) {
					$data_act_news = array(
						'title'=>$v['dy_title'],
					);
					@pdo_update(sl_table_name('dynamic_act'), $data_act_news, array('id'=>$v['id']));
				}
			}
		}
	}
	// 发送手机号到AI 助手
	if ($ai_data_history_update == '1')
	{
		$condition_sync = " AND uniacid=:uniacid AND mobile<>'' ";
		$params_sync = array(':uniacid' => $_W['uniacid']);
		$sql_sync = "SELECT openid AS user_id,mobile FROM " . sl_table_name('user',true). ' WHERE 1 ' . $condition_sync;
		$list_sync = pdo_fetchall($sql_sync, $params_sync);

		if ($list_sync) {
			$rst = set_sync_user_mobile($list_sync);
			if ($rst['errcode'] != '0') {
				sl_ajax(1, $rst['errmsg'].'-'.$rst['data']);
			}
		}
	}

	// 客户数据表
	if ($sys_users_clear == '1') {
		$rst_users = pdo_delete(sl_table_name('users'), array('uniacid' => $_W['uniacid']));
		if ($rst_users === false) {
			sl_ajax(1, '清除客户数据表失败');
		}
	}
	// 我的卡片数据表
	if ($sys_mycard_clear == '1') {
		$rst_mycard = pdo_delete(sl_table_name('mycard'), array('uniacid' => $_W['uniacid']));
		if ($rst_mycard === false) {
			sl_ajax(1, '清除客户数据表失败');
		}
	}
	// 表单ID表
	if ($sys_formid_clear == '1') {
		$rst_formid = pdo_delete(sl_table_name('formid'), array('uniacid' => $_W['uniacid']));
		if ($rst_formid === false) {
			sl_ajax(1, '清除客户数据表失败');
		}
	}
	// 操作日志表
	if ($sys_oplog_clear == '1') {
		$rst_oplog = pdo_delete(sl_table_name('oplog'), array('uniacid' => $_W['uniacid']));
		if ($rst_oplog === false) {
			sl_ajax(1, '清除客户数据表失败');
		}
	}

	sl_ajax(0, '操作成功！');
}

include $this->template('web/other/sdata');

?>
