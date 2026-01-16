<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');

if ($_W['ispost']) {
	$options = $_GPC['options'];

	$data = array();
	$photo = array();
	$tmp_pic = array();

	if ($options) {
		foreach ($options['attachment'] as $k => $v) {
			$tmp_pic[$k]['attachment'] = $v;
		}
		foreach ($options['pic_highlight'] as $k => $v) {
			$tmp_pic[$k]['pic_highlight'] = $v;
		}
		foreach ($options['icon'] as $k => $v) {
			$tmp_pic[$k]['icon'] = $v;
		}
		foreach ($options['title'] as $k => $v) {
			$tmp_pic[$k]['title'] = $v;
		}
		foreach ($options['page_url'] as $k => $v) {
			$tmp_pic[$k]['page_url'] = $v;
		}
		foreach ($tmp_pic as $k=>$v){
			$photo['items'][] = $v;
		}
	}
	$photo['enabled'] = $_GPC['enabled'];

	$data['uniacid'] = $_W['uniacid'];
	$data['setting_value'] = json_encode($photo); // 压缩

	if ($_W['slwl']['set']['set_menus']) {
		$where['uniacid'] = $_W['uniacid'];
		$where['setting_name'] = 'set_menus';
		pdo_update(sl_table_name('settings'), $data, $where);
	} else {
		$data['uniacid'] = $_W['uniacid'];
		$data['setting_name'] = 'set_menus';
		$data['addtime'] = $_W['slwl']['datetime']['now'];
		pdo_insert(sl_table_name('settings'), $data);
	}
	sl_ajax(0, '保存成功');
}

if ($_W['slwl']['set']['set_menus']) {
	$smeta = $_W['slwl']['set']['set_menus'];
}

include $this->template('web/basic/menus');

