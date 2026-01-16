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
	// $sql = "SELECT * FROM " . tablename('slwl_aicard_adsp'). ' WHERE 1 ' . $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	// $list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('slwl_aicard_adsp') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);


} elseif ($operation == 'delete') {
	$id = intval($_GPC['id']);

	$rst = pdo_delete('slwl_aicard_adsp', array('id' => $id));
	if ($rst !== false) {
		iajax(0, '成功');
	} else {
		iajax(1, '不存在或已删除');
	}


} elseif ($operation == 'search') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND enabled='1' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,title FROM " . tablename('slwl_aicard_news'). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('slwl_aicard_news') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(1, '没有查到数据！');
	}


} elseif ($operation == 'search_adact') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND enabled='1' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,title FROM " . tablename('slwl_aicard_adact'). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('slwl_aicard_adact') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(2, '没有查到数据！');
	}


} elseif ($operation == 'search_wxapp') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND enabled='1' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,title,appid FROM " . tablename('slwl_aicard_mod_wxapp'). ' WHERE 1 '
		. $condition . " ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('slwl_aicard_adact') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(2, '没有查到数据！');
	}


// 课程体系
} elseif ($operation == 'search_course_sys') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND `name` like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`name` FROM " . tablename('bozutung_jsfmd_course_system'). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bozutung_jsfmd_course_system') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(2, '没有查到数据！');
	}
	exit;


// 课程列表
} elseif ($operation == 'search_course_list') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND `name` like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`name` FROM " . tablename('bozutung_jsfmd_course'). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bozutung_jsfmd_course') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(2, '没有查到数据！');
	}


// 视频分类
} elseif ($operation == 'search_video_category') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND `name` like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`name` FROM " . tablename('bozutung_jsfmd_category'). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bozutung_jsfmd_category') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(2, '没有查到数据！');
	}
	exit;


// 视频课程
} elseif ($operation == 'search_video_course') {
	$keyword = $_GPC['keyword'];

	$condition = " AND uniacid=:uniacid AND `delete`='0' AND title like :keyword ";
	$params = array(':uniacid' => $_W['uniacid'], ':keyword'=>'%'.$keyword.'%');
	$pindex = max(1, intval($_GPC['page']));
	$psize = 100;
	$sql = "SELECT id,`title` FROM " . tablename('bozutung_jsfmd_course_video'). ' WHERE 1 '
		. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

	$list = pdo_fetchall($sql, $params);
	// $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bozutung_jsfmd_course_video') . ' WHERE 1 ' . $condition, $params);
	// $pager = pagination($total, $pindex, $psize);

	if ($list) {
		iajax(0, $list);
	} else {
		iajax(2, '没有查到数据！');
	}


} else {
	message('请求方式不存在');
}

include $this->template('web/system/dialoglink');

?>
