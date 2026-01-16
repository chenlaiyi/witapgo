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

	$condition = " AND uniacid=:uniacid AND `delete`='0' ";
	$params = array(':uniacid' => $_W['uniacid']);
	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	if ($keyword != '') {
		$condition .= ' AND (title LIKE :title) ';
		$params[':title'] = '%'.$keyword.'%';
	}

	$sql = "SELECT * FROM " . sl_table_name('store',true). ' WHERE 1 '
		. $condition . " ORDER BY sort DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);

	if ($list) {
		foreach ($list as $k => $v) {
			$list[$k]['image_format'] = tomedia($v['image']);
		}
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('store',true) . ' WHERE 1 ' . $condition, $params);
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

		$subwayDistance = intval($_GPC['subway_distance']);
		if ($subwayDistance < 1) {
			$subwayDistance = 0;
			// message(($edit ? '编辑' : '添加') . '门店失败，地铁步行距离是正整数', '', 'error');
		}
		$busStopDistance = intval($_GPC['bus_stop_distance']);
		if ($busStopDistance < 1) {
			sl_ajax(1, ($edit ? '编辑' : '添加') . '门店失败，公交步行距离是正整数');
		}
		$map = $_GPC['map'];
		$coordinate = '';
		if ($map['lng'] && $map['lat']) {
			$map_baidu = array('lng'=>$map['lng'], 'lat'=>$map['lat']);
			$map_qq = Convert_BD09_To_GCJ02($map['lat'], $map['lng']);
			$coordinate = array(
				'baidu' => $map_baidu,
				'qq'    => $map_qq,
			);
		}

		$data = [];
		$data = [
			'uniacid'              => $_W['uniacid'],
			'name'                 => trim($_GPC['store']),
			'sort'                 => intval($_GPC['sort']),
			'image'                => $_GPC['image'],
			'address'              => $_GPC['address'],
			'subway_name'          => $_GPC['subway_name'],
			'subway_distance'      => $subwayDistance,
			'subway_description'   => $_GPC['subway_description'],
			'bus_stop_name'        => $_GPC['bus_stop_name'],
			'bus_stop_distance'    => $busStopDistance,
			'bus_stop_description' => $_GPC['bus_stop_description'],
			'drive_place'          => $_GPC['drive_place'],
			'drive_description'    => $_GPC['drive_description'],
			'way'                  => $_GPC['way'],
			'coordinate'           => json_encode($coordinate, JSON_UNESCAPED_UNICODE),
			'lng'                  => $_GPC['lng'],
			'lat'                  => $_GPC['lat'],
		];

		if ($id) {
			$rst = pdo_update(sl_table_name('store'), $data, array('id' => $id));
		} else {
			$data['create_time'] = $_W['slwl']['datetime']['now'];
			$rst = pdo_insert(sl_table_name('store'), $data);
			$id = pdo_insertid();
		}

		if ($rst !== false) {
			sl_ajax(0, '成功');
		} else {
			sl_ajax(1, '失败-'.$rst);
		}
	}

	$condition = " AND uniacid=:uniacid AND id=:id ";
	$params = array(':uniacid' => $_W['uniacid'], ':id' => $id);
	$one = pdo_fetch('SELECT * FROM ' . sl_table_name('store',true) . ' WHERE 1 ' . $condition, $params);

	if ($one && $one['coordinate']) {
		$one_coordinate = json_decode($one['coordinate'], true);
		$tmp_map = [
			'lng'=>$one_coordinate['baidu']['lng'],
			'lat'=>$one_coordinate['baidu']['lat'],
		];
	}


} else if ($operation == 'delete') {

	$post = file_get_contents('php://input');
	if (!$post) { sl_ajax(1, '参数不存在'); }

	$params = @json_decode($post, true);
	if (!$params) { sl_ajax(1, '参数解析出错'); }

	$ids = isset($params['ids']) ? $params['ids'] : '';
	if (!$ids) { sl_ajax(1, 'ID为空'); }

	$where = [];
	$where['id IN'] = $ids;

	$rst = @pdo_delete(sl_table_name('store'), $where);

	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else {
	message('请求方式不存在');
}

include $this->template('web/content/store');

