<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;

load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {


} else if ($operation == 'admin_list') {
	$keyword = $_GPC['keyword'];

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid']];
	if ($keyword != '') {
		$where['title LIKE'] = '%'.$keyword.'%';
	}
	$order_by = ['sort DESC', 'id DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('admin'), $where, '', '', $order_by, $limit);

	if ($list) {
		foreach ($list as $key => $value) {
			$list[$key]['status_format'] = $value['status'] ? '启用':'禁用';
		}
		$total = pdo_count(sl_table_name('admin'), $where);

		// 补充-平台用户名.start
		$ids_users = sl_array_column($list, 'mp_user_id');
		if ($ids_users) {
			$where_users = [
				'uid IN' => $ids_users,
			];
			$list_users = pdo_getall('users', $where_user, ['uid','username']);

			if ($list_users) {
				foreach ($list as $key => $value) {
					foreach ($list_users as $k => $v) {
						if ($value['mp_user_id'] == $v['uid']) {
							$list[$key]['user_name'] = $v['username'];
							break;
						}
					}
				}
			}
		}
		// 补充-平台用户名.end

		// 补充-角色.start
		$ids_role = sl_array_column($list, 'group_id');

		if ($ids_role) {
			$where_role = [
				'uniacid' => $_W['uniacid'],
				'id IN'   => $ids_role,
			];
			$list_role = pdo_getall(sl_table_name('admin_role'), $where_role, ['id','title']);

			if ($list_role) {
				foreach ($list as $key => $value) {
					foreach ($list_role as $k => $v) {
						if ($value['group_id'] == $v['id']) {
							$list[$key]['role'] = $v['title'];
							break;
						}
					}
				}
			}
		}
		// 补充-角色.end
	}

	$data_return = [
		'code'  => 0,
		'msg'   => '',
		'count' => $total,
		'data'  => $list,
	];
	echo json_encode($data_return);
	exit;


} else if ($operation == 'admin_post') {
	$id = intval($_GPC['id']);

	if ($_W['ispost']) {
		$data = [
			'uniacid'    => $_W['uniacid'],
			'sort'       => $_GPC['sort'],
			'mp_user_id' => $_GPC['mp_user_id'],
			'group_id'   => $_GPC['group_id'],
			'status'     => intval($_GPC['status']),
			'mark'       => trim($_GPC['mark']),
		];
		if ($id) {
			pdo_update(sl_table_name('admin'), $data, ['id'=>$id]);
		} else {
			$data['create_time'] = $_W['slwl']['datetime']['now'];
			pdo_insert(sl_table_name('admin'), $data);
			$id = pdo_insertid();
		}
		sl_ajax(0, '保存成功');
	}

	$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id];
	$one = pdo_get(sl_table_name('admin'), $where);

	$where_role = ['uniacid'=>$_W['uniacid']];
	$role_list = pdo_getall(sl_table_name('admin_role'), $where_role);

	if ($one) {
		$where_user = ['uid'=>$one['uid']];
		$one_user = pdo_get('users', $where_user,['uid','username']);

		if ($one_user) {
			$where_user_profile = ['uid'=>$one['uid']];
			$fields_profile = ['id','uid','realname','avatar','mobile'];
			$one_user_profile = pdo_get('users', $where_user_profile, $fields_profile);

			if ($one_user_profile) {
				$one_user['realname'] = $one_user_profile['realname'];
				$one_user['avatar'] = $one_user_profile['avatar'];
				$one_user['mobile'] = $one_user_profile['mobile'];
			}
		}
	}


} else if ($operation == 'admin_delete') {

	$post = file_get_contents('php://input');
	if (!$post) { sl_ajax(1, '参数不存在'); }

	$params = @json_decode($post, true);
	if (!$params) { sl_ajax(1, '参数解析出错'); }

	$ids = isset($params['ids']) ? $params['ids'] : '';
	if (!$ids) { sl_ajax(1, 'ID为空'); }

	$where = [];
	$where['id IN'] = $ids;

	$rst = @pdo_delete(sl_table_name('admin'), $where);

	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else if ($operation == 'role') {
} else if ($operation == 'role_list') {
	$keyword = $_GPC['keyword'];

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid']];
	if ($keyword != '') {
		$where['title LIKE'] = '%'.$keyword.'%';
	}
	$order_by = ['sort DESC','id DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('admin_role'), $where, '', '', $order_by, $limit);

	if ($list) {
		foreach ($list as $key => $value) {
			$list[$key]['status_format'] = $value['status'] ? '启用':'禁用';
		}
		$total = pdo_count(sl_table_name('admin_role'), $where);
	}
	$data_return = [
		'code'  => 0,
		'msg'   => '',
		'count' => $total,
		'data'  => $list,
	];
	echo json_encode($data_return);
	exit;


} else if ($operation == 'role_post') {
	$id = intval($_GPC['id']);

	if ($_W['ispost']) {
		$data = [
			'uniacid' => $_W['uniacid'],
			'sort'    => $_GPC['sort'],
			'title'   => $_GPC['title_val'],
			'desc'    => $_GPC['desc'],
			'status'  => intval($_GPC['status']),
		];
		if ($id) {
			pdo_update(sl_table_name('admin_role'), $data, ['id'=>$id]);
		} else {
			$data['create_time'] = $_W['slwl']['datetime']['now'];
			pdo_insert(sl_table_name('admin_role'), $data);
			$id = pdo_insertid();
		}
		sl_ajax(0, '保存成功');
	}

	$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id];
	$one = pdo_get(sl_table_name('admin_role'), $where);


} else if ($operation == 'role_delete') {

	$post = file_get_contents('php://input');
	if (!$post) { sl_ajax(1, '参数不存在'); }

	$params = @json_decode($post, true);
	if (!$params) { sl_ajax(1, '参数解析出错'); }

	$ids = isset($params['ids']) ? $params['ids'] : '';
	if (!$ids) { sl_ajax(1, 'ID为空'); }

	$where = [];
	$where['id IN'] = $ids;

	$rst = @pdo_delete(sl_table_name('admin_role'), $where);

	if ($rst !== false) {
		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, '不存在或已删除');
	}


} else if ($operation == 'authorize') {
	$id = intval($_GPC['id']);

	$sys_menu = $_W['menus_array']['left'];
	unset($sys_menu['other']);

	$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id];
	$one = pdo_get(sl_table_name('admin_role'), $where);

	if (empty($one)) {
		sl_ajax(1, 'ID不存在');
	}

	if ($_W['ispost']) {
		$options = $_GPC['options'];

		$data_opt = [];
		if ($options) {
			foreach ($options as $key => $value) {
				foreach ($value as $k => $v) {
					$data_opt[] = $k;
				}
			}
		}

		if ($data_opt) {
			$data = [];
			$data['auth_menu'] = json_encode($data_opt); // 压缩

			$rst = pdo_update(sl_table_name('admin_role'), $data, $where);
			if ($rst !== false) {
				sl_ajax(0, '成功');
			} else {
				sl_ajax(1, '失败');
			}
		} else {
			sl_ajax(1, '数据为空');
		}
	}

	if ($one['auth_menu']) {
		$my_auth = json_decode($one['auth_menu'], TRUE);
		if ($sys_menu && $my_auth) {
			foreach ($sys_menu as $key => $value) {
				foreach ($value['items'] as $k => $v) {
					$sys_menu[$key]['items'][$k]['checked'] = '0';

					foreach ($my_auth as $index => $item) {
						if ($k == $item) {
							$sys_menu[$key]['items'][$k]['checked'] = '1';
							break;
						}
					}
				}
			}
		}
	}


} else {
	message('请求方式不存在');
}

include $this->template('web/other/group');

