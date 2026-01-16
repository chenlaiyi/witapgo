<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

// sys
if(!defined('IN_IA')) { exit('Access Denied'); }

// 测试
function sl_sys_test()
{
	global $_GPC, $_W;

	dump($_W);
	echo "<hr>";
	dump($_GPC);
}

// sys-配置
function sl_sys_config()
{
	global $_GPC, $_W;


}

// 首页
function sl_index_data()
{
	global $_GPC, $_W;

	// 快捷菜单
	$list_index['quick'] = array();
	if ($_W['slwl']['set']['set_menu_quick']) {
		$set_menu_quick = $_W['slwl']['set']['set_menu_quick'];

		$settings['quick']['items'] = $set_menu_quick['items'];
		$settings['quick']['enabled'] = $set_menu_quick['enabled'];
	} else {
		$settings['quick']['items'] = array();
		$settings['quick']['enabled'] = 0;
	}

	// banner
	$condition_adv = " AND uniacid=:uniacid AND enabled='1' ";
	$params_adv = array(':uniacid' => $_W['uniacid']);
	$psize_adv = 10;

	$list_adv = pdo_fetchall('SELECT * FROM ' . sl_table_name('adv',true) . ' WHERE 1 '
		. $condition_adv . ' ORDER BY displayorder DESC, id DESC limit 0,' . $psize_adv, $params_adv);

	if ($list_adv) {
		foreach ($list_adv as $k => $v) {
			$list_adv[$k]['thumb_url'] = tomedia($v['thumb']);
		}
	}
	$list_index['banner'] = $list_adv;

	sl_ajax(0, $list_index);
}

// 直播列表
function sys_live()
{
	global $_GPC, $_W;

	$post = $_GPC['__input']; // 参数
	if (empty($post)) {
		sl_ajax(1, '参数内容不能为空');
	}

	$operation = isset($post['op']) ? trim($post['op']) : ''; // 操作
	// 	{id: 1, status: 101},
	$list_live = isset($post['listLive']) ? $post['listLive'] : ''; // 列表
	$page      = isset($post['page']) ? trim($post['page']) : '';    // 分页

	if ($operation) {
		if ($operation == 'update_status') {
			if ($list_live['id'] && $list_live['status']) {
				$update_data = [
					'live_status' => $list_live['status'],
				];
				$rst = pdo_update(
					sl_table_name('live'),
					['live_status' => $list_live['status']],
					['id'=>$list_live['id']]
				);
				if ($rst !== false) {
					sl_ajax(0, 'ok');
				} else {
					sl_ajax(1, '更新失败');
				}
			}
		} else {
			sl_ajax(1, '操作不存在');
		}

	} else {
		// 获取订阅数
		$where = [
			'uniacid'       => $_W['uniacid'],
			'delete_status' => 0
		];
		$pindex = max(1, intval($page));
		$psize = 5;
		$order_by = ['live_status ASC', 'id DESC'];
		$limit = [$pindex, $psize];
		$list = pdo_getall(sl_table_name('live'), $where, '', '', $order_by, $limit);

		if ($list) {
			foreach ($list as $key => $value) {
				$list[$key]['goods'] = json_decode($value['goods'], true);

				$list[$key]['cover_img'] = tomedia($value['cover_img']);
				$list[$key]['share_img'] = tomedia($value['share_img']);
				$list[$key]['anchor_img'] = tomedia($value['anchor_img']);

				if ($value['live_status'] == '101') {
					$list[$key]['live_status_format'] = '直播中';

				} else if ($value['live_status'] == '102') {
					$list[$key]['live_status_format'] = '未开始';

				} else if ($value['live_status'] == '103') {
					$list[$key]['live_status_format'] = '已结束';

				} else if ($value['live_status'] == '104') {
					$list[$key]['live_status_format'] = '禁播';

				} else if ($value['live_status'] == '105') {
					$list[$key]['live_status_format'] = '暂停中';

				} else if ($value['live_status'] == '106') {
					$list[$key]['live_status_format'] = '异常';

				} else if ($value['live_status'] == '107') {
					$list[$key]['live_status_format'] = '已过期';

				} else {
					$list[$key]['live_status_format'] = '未知';
				}
			}
		}

		$data_bak = [
			'list' => $list
		];

		sl_ajax(0, $data_bak);
	}
}


