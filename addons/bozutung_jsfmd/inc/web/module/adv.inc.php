<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {
	$keyword = $_GPC['keyword'];

	$condition = ' AND uniacid=:uniacid ';
	$params = array(':uniacid' => $_W['uniacid']);
	$pindex = max(1, intval($_GPC['page']));
	$psize = 10;
	if ($keyword != '') {
		$condition .= ' AND (advname LIKE :advname) ';
		$params[':advname'] = '%'.$keyword.'%';
	}

	$sql = "SELECT * FROM " . sl_table_name('adv',true). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	if ($list) {
		foreach ($list as $key => $value) {
			$list[$key]['enabled_format'] = ($value['enabled']) ? '启用':'禁用';
		}
	}

	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('adv',true)
		. ' WHERE 1 ' . $condition, $params);
	$pager = pagination($total, $pindex, $psize);

	// 所有门店
	$where = [
		'uniacid' => $_W['uniacid'],
		'delete'  => 0,
	];
	$list_store = pdo_getall(sl_table_name('store'), $where);


} else if ($operation == 'post') {
	$id = intval($_GPC['id']);

	if ($_W['ispost']) {
		$store_ids = $_GPC['store']; // 门店ID
		if (empty($store_ids)) {
			sl_ajax(1, '门店必需选择一个');
		}

		$data = array(
			'uniacid'      => $_W['uniacid'],
			'displayorder' => $_GPC['displayorder'],
			'advname'      => $_GPC['advname'],
			'enabled'      => intval($_GPC['enabled']),
			'page_url'     => $_GPC['page_url'],
			'thumb'        => $_GPC['thumb'],
			'store_info'   => json_encode($store_ids),
		);
		if ($id) {
			pdo_update(sl_table_name('adv'), $data, array('id' => $id));
		} else {
			$data['addtime'] = $_W['slwl']['datetime']['now'];
			pdo_insert(sl_table_name('adv'), $data);
			$id = pdo_insertid();
		}
		sl_ajax(0, '保存成功');
	}
	$condition = " AND uniacid=:uniacid AND id=:id ";
	$params = array(':uniacid' => $_W['uniacid'], ':id' => $id);
	$one = pdo_fetch("SELECT * FROM " . sl_table_name('adv',true) . " where 1 " . $condition, $params);

	// 所有门店
	$where = [
		'uniacid' => $_W['uniacid'],
		'delete'  => 0,
	];
	$list_store = pdo_getall(sl_table_name('store'), $where);

	// 门店-当前门店
	$one_store = json_decode($one['store_info'], TRUE);

	if ($one_store && $list_store) {
		foreach ($list_store as $key => $value) {
			$list_store[$key]['checked'] = '0';
			foreach ($one_store as $k => $v) {
				if ($value['id'] == $v) {
					$list_store[$key]['checked'] = '1';
					break;
				}
			}
		}
	}


} else if ($operation == 'delete') {
	$id = intval($_GPC['id']);

	$rst = pdo_delete('bozutung_jsfmd_adv', array('id' => $id));
	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else {
	message('请求方法不存在');
}

include $this->template('web/module/adv');

?>
