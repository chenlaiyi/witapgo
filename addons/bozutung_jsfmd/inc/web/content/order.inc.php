<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;

load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {
} else if ($operation == 'order_list') {
	$keyword = trim($_GPC['keyword']);
	$type = trim($_GPC['type']);

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid'], 'delete'=>0];
	// if ($keyword) {
	// 	$where['title LIKE'] = '%'.$keyword.'%';
	// }
	if ($type != '') {
		$where['type'] = $type;
	}
	$order_by = ['id DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('order'), $where, '', '', $order_by, $limit);

	if ($list) {
		$array_week = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
		foreach ($list as $key => $value) {
			$order_info = json_decode($value['order_info'],TRUE);

			if ($order_info && $order_info['user']) {
				$order_info['user']['nickname'] = sl_nickname($order_info['user']['nickname']);
			}

			$list[$key]['order_info'] = $order_info;
			$list[$key]['create_time_format'] = date('Y-m-d H:i:s', $value['create_time']);

			if ($value['type'] == 0) {
				$list[$key]['course_time_format'] = $array_week[date('w',$order_info['start'])]
					. ' ' . date('Y-m-d H:i:s', $order_info['start']);
			}

			if ($value['status'] == 1) {
				$list[$key]['status_format'] = '已付款';

			} else if ($value['status'] == 2) {
				$list[$key]['status_format'] = '已完成';

			} else if ($value['status'] == 3) {
				$list[$key]['status_format'] = '请求取消订单';

			} else if ($value['status'] == 4) {
				$list[$key]['status_format'] = '已取消';

			} else if ($value['status'] == 5) {
				$list[$key]['status_format'] = '已拒绝退款';
			}
		}
		$total = pdo_count(sl_table_name('order'), $where);
	}
	$data_return = array(
		'code'  => '0',
		'msg'   => '',
		'count' => $total,
		'data'  => $list,
	);
	echo json_encode($data_return);
	exit;


} else if ($operation == 'refund') {
} else if ($operation == 'refund_list') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid']];
	$order_by = ['id DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('log_refund'), $where, '', '', $order_by, $limit);

	if ($list) {
		$ids_user = sl_array_column($list, 'id_user');
		if ($ids_user) {
			$where_user = [
				'uniacid' => $_W['uniacid'],
				'id IN'   => $ids_user,
			];
			$list_user = pdo_getall(sl_table_name('user'), $where_user);
		}

		foreach ($list as $key => $value) {
			$list[$key]['price_format'] = number_format($value['price'] / 100, 2);
			foreach ($list_user as $k => $v) {
				if ($value['id_user'] == $v['id']) {
					$list[$key]['nickname'] = sl_nickname($v['nickname']);
				}
			}
		}
		$total = pdo_count(sl_table_name('order'), $where);
	}
	$data_return = array(
		'code'  => '0',
		'msg'   => '',
		'count' => $total,
		'data'  => $list,
	);
	echo json_encode($data_return);
	exit;


// 手动退款-余额
} else if ($operation == 'refund_post') {
	$id = $_GPC['id'];

	if ($_W['ispost']) {
		// $ohtn = sl_table_name('order');
		$order = pdo_get(sl_table_name('order'), ['id'=>$id]);

		if (empty($order)) {
			sl_ajax(1, '退款失败，订单不存在');
		}
		if ($order['status'] != 3) {
			sl_ajax(1, '退款失败，订单状态不正确');
		}

		$money = $order['paid_money'] * 100; // 单位分
		$money_format = $order['paid_money']; // 单位元

		try {
			pdo_begin();

			if ($order['type'] == '0') {
				pdo_update(sl_table_name('course_plan'), ['booked_number -='=>1], ['id'=>$order['plan_id']]);
			}
			if ($order['subtype'] == '0') {
				pdo_update(sl_table_name('user'), ['balance +='=>$money_format], ['id'=>$order['user_id']]);
			}

			pdo_update(sl_table_name('order'), ['refund_money'=>$money_format,'status'=>4], ['id'=>$id]);

			$data_ins = [
				'uniacid'     => $_W['uniacid'],
				'id_user'     => $order['user_id'],
				'price'       => $money,
				'txt'         => "同意退款到余额-{$money_format}元",
				'create_time' => $_W['slwl']['datetime']['now'],
			];

			$rst = pdo_insert(sl_table_name('log_refund'), $data_ins);

			if ($rst !== FALSE) {
				pdo_commit();
				sl_ajax(0, '退款成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '退款失败-添加退款日志失败');
			}
		} catch (Exception $e) {
			pdo_rollback();
			sl_ajax(1, '退款失败-'.$e->getMessage());
		}
	}
	sl_ajax(1, '失败');


// 拒绝退款
} else if ($operation == 'refuse_refund_post') {
	$id = $_GPC['id'];

	if ($_W['ispost']) {
		$order = pdo_get(sl_table_name('order'), ['id'=>$id]);
		if (empty($order)) {
			sl_ajax(1, '拒绝退款失败，订单不存在');
		}

		if ($order['status'] != 3) {
			sl_ajax(1, '拒绝退款失败，订单状态不正确');
		}

		$res = pdo_update(sl_table_name('order'), ['status'=>5], ['id'=>$id]);
		if ($res !== FALSE) {
			sl_ajax(0, '拒绝退款成功');
		} else {
			sl_ajax(1, '拒绝退款失败');
		}
	}
	sl_ajax(1, '失败');


} else {
	message('请求方式不存在');
}

include $this->template('web/content/order');

