<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;

load()->func('tpl');
$operation = ($_GPC['op']) ? $_GPC['op'] : 'display';

if ($operation == 'display') {


} else if ($operation == 'display_table') {


} else if ($operation == 'post') {
	$id = intval($_GPC['id']);

	if ($_W['ispost']) {
		$data = array(
			'displayorder' => $_GPC['displayorder'],
			'title'        => $_GPC['title_val'],
			'enabled'      => intval($_GPC['enabled']),
			'page_url'     => $_GPC['page_url'],
			'thumb'        => $_GPC['thumb'],
		);
		if ($id) {
			pdo_update(sl_table_name('course'), $data, array('id' => $id));
		} else {
			$data['uniacid'] = $_W['uniacid'];
			$data['create_time'] = $_W['slwl']['datetime']['now'];
			pdo_insert(sl_table_name('course'), $data);
			$id = pdo_insertid();
		}
		sl_ajax(0, '保存成功');
	}

	$condition = " AND uniacid=:uniacid AND id=:id ";
	$params = array(':uniacid' => $_W['uniacid'], ':id' => $id);
	$one = pdo_fetch('SELECT * FROM ' . sl_table_name('course',true) . ' WHERE 1 ' . $condition, $params);


} else if ($operation == 'delete') {

	$post = file_get_contents('php://input');
	if (!$post) { sl_ajax(1, '参数不存在'); }

	$params = @json_decode($post, true);
	if (!$params) { sl_ajax(1, '参数解析出错'); }

	$ids = isset($params['ids']) ? $params['ids'] : '';
	if (!$ids) { sl_ajax(1, 'ID为空'); }

	$where = [];
	$where['id IN'] = $ids;

	$rst = @pdo_delete(sl_table_name('course'), $where);

	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else {
	message('请求方式不存在');
}


include $this->template('web/course/timetable');

?>
