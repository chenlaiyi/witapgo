<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {


} else if ($operation == 'display_table') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid ";
	$params = array(':uniacid' => $_W['uniacid']);
	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	if ($keyword != '') {
		$condition .= ' AND (title LIKE :title) ';
		$params[':title'] = '%'.$keyword.'%';
	}

	$sql = "SELECT * FROM " . sl_table_name('mod_wxapp',TRUE). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);

	if ($list) {
		foreach ($list as $k => $v) {
			$list[$k]['enabled_format'] = $v['enabled'] ? '启用':'禁用';
		}
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('mod_wxapp',TRUE) . ' WHERE 1 ' . $condition, $params);
		// $pager = pagination($total, $pindex, $psize);

	}
	$data_return = array(
		'code' => '0',
		'msg' => '',
		'count' => $total,
		'data' => $list,
	);
	echo json_encode($data_return);
	exit;


} else if ($operation == 'post') {
	$id = intval($_GPC['id']);

	if ($_W['ispost']) {
		$data = array(
			'uniacid'      => $_W['uniacid'],
			'displayorder' => $_GPC['displayorder'],
			'title'        => $_GPC['title_val'],
			'page_url'     => $_GPC['page_url'],
			'appid'        => $_GPC['appid'],
			'page_page'    => $_GPC['page_page'],
			'enabled'      => intval($_GPC['enabled']),
		);
		if ($id) {
			pdo_update(sl_table_name('mod_wxapp'), $data, array('id' => $id));
		} else {
			$data['addtime'] = $_W['slwl']['datetime']['now'];
			pdo_insert(sl_table_name('mod_wxapp'), $data);
			$id = pdo_insertid();
		}
		sl_ajax(0, '保存成功');
		exit;
	}
	$condition = " AND uniacid=:uniacid AND id=:id ";
	$params = array(':uniacid' => $_W['uniacid'], ':id' => $id);
	$one = pdo_fetch('SELECT * FROM ' . sl_table_name('mod_wxapp', TRUE) . ' WHERE 1 ' . $condition, $params);


} else if ($operation == 'delete') {
	$post = file_get_contents('php://input');
	if (!$post) { sl_ajax(1, '参数不存在'); }

	$params = @json_decode($post, TRUE);
	if (!$params) { sl_ajax(1, '参数解析出错'); }

	$ids = isset($params['ids']) ? $params['ids'] : '';
	if (!$ids) { sl_ajax(1, 'ID为空'); }

	foreach ($ids as $k => $v) {
		$flags .= $v . ',';
	}
	$flags = substr($flags, 0, strlen($flags)-1);
	$where = ' id IN(' . $flags . ')';

	$rst = @pdo_delete(sl_table_name('mod_wxapp'), $where);

	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else {
	message('请求方法不存在');
}

include $this->template('web/module/wxapp');
