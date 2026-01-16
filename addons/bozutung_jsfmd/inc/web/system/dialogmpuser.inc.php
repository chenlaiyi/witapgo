<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {


// 平台用户
} else if ($operation == 'search_user') {
	$keyword = trim($_GPC['keyword']);

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(100, intval($_GPC['limit']));
	$where = ['status'=>2, 'founder_groupid !='=>1];
	if ($keyword != '') {
		$where['username LIKE'] = '%'.$keyword.'%';
	}
	$fields = ['uid','username'];
	$order_by = ['uid DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall('users', $where, $fields, '', $order_by, $limit);

	if ($list) {
		$ids = sl_array_column($list, 'uid');

		if ($ids) {
			$where_profile = [
				'uid IN' => $ids,
			];
			$fields_profile = ['id','uid','realname','avatar','mobile'];
			$list_profile = pdo_getall('users_profile', $where_profile, $fields_profile);

			if ($list_profile) {
				foreach ($list as $key => $value) {
					foreach ($list_profile as $k => $v) {
						if ($value['uid'] == $v['uid']) {
							$list[$key]['realname'] = $v['realname'];
							$list[$key]['avatar'] = $v['avatar'];
							$list[$key]['mobile'] = $v['mobile'];
							break;
						}
					}
				}
			}
		}
	}

	if ($list) {
		sl_ajax(0, $list);
	} else {
		sl_ajax(2, '没有查到数据！');
	}


} else {
	message('请求方式不存在');
}

include $this->template('web/system/dialogmpuser');
