<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {
	// $condition = ' AND uniacid=:uniacid ';
	// $params = array(':uniacid' => $_W['uniacid']);
	// $pindex = max(1, intval($_GPC['page']));
	// $psize = 10;
	// $sql = "SELECT * FROM " . sl_table_name('adsp',true). ' WHERE 1 ' . $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	// $list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('adsp',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);


} else if ($operation == 'delete') {
	$id = intval($_GPC['id']);

	$rst = pdo_delete('bozutung_jsfmd_adsp', array('id' => $id));
	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else if ($operation == 'search') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND enabled='1' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,title FROM " . sl_table_name('news',true). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('news',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(1, '没有查到数据！');
	}


} else if ($operation == 'search_adact') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND enabled='1' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,title FROM " . sl_table_name('adact',true). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('adact',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(2, '没有查到数据！');
	}


} else if ($operation == 'search_wxapp') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND enabled='1' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,title,appid FROM " . sl_table_name('mod_wxapp',true). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('adact',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(2, '没有查到数据！');
	}


// 课程列表
} else if ($operation == 'search_course_list') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND `name` like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`name` FROM " . sl_table_name('course',true). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('course',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(2, '没有查到数据！');
	}


// 视频分类
} else if ($operation == 'search_video_category') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND `name` like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`name` FROM " . sl_table_name('category',true). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('category',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(2, '没有查到数据！');
	}
	exit;


// 视频课程
} else if ($operation == 'search_video_course') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND `name` like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`name` FROM " . sl_table_name('video_course',true). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . sl_table_name('course_video',true) . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(2, '没有查到数据！');
	}


} else {
	message('请求方式不存在');
}

include $this->template('web/system/dialoglink');

?>
