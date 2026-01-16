<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

if ($operation == 'display') {


} else if ($operation == 'list') {
	$keyword = trim($_GPC['keyword']);

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = [
		'uniacid'       => $_W['uniacid'],
		'delete_status' => 0
	];
	if ($keyword != '') {
		$where['sl_title LIKE'] = '%'. $keyword .'%';
	}
	$order_by = ['live_status ASC', 'roomid ASC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('live'), $where, '', '', $order_by, $limit);
	$total = pdo_count(sl_table_name('live'), $where);

	if ($list) {
		foreach ($list as $key => $value) {
			$list[$key]['cover_img'] = tomedia($value['cover_img']);
			$list[$key]['share_img'] = tomedia($value['share_img']);

			if ($value['live_status'] == '101') {
				$list[$key]['live_status'] = '直播中';

			} else if ($value['live_status'] == '102') {
				$list[$key]['live_status'] = '未开始';

			} else if ($value['live_status'] == '103') {
				$list[$key]['live_status'] = '已结束';

			} else if ($value['live_status'] == '104') {
				$list[$key]['live_status'] = '禁播';

			} else if ($value['live_status'] == '105') {
				$list[$key]['live_status'] = '暂停中';

			} else if ($value['live_status'] == '106') {
				$list[$key]['live_status'] = '异常';

			} else if ($value['live_status'] == '107') {
				$list[$key]['live_status'] = '已过期';

			} else {
				$list[$key]['live_status'] = '未知';
			}
		}
	}

	$data_return = [
		'code'  => 0,
		'msg'   => '',
		'count' => $total,
		'data'  => $list,
	];
	echo json_encode($data_return);
	exit;


} else if ($operation == 'sync') {

	if ($_W['ispost']) {
		// $agreement = intval($_GPC['agreement']);

		// if ($agreement != '1') {
		// 	sl_ajax(1, '为了您的数据安全，请备份好再操作');
		// }

		$wx_appid  = @$_W['account']['key'];
		$wx_secret = @$_W['account']['secret'];

		require_once MODULE_ROOT . "/lib/sdk/jssdk.php";
		$jssdk = new JSSDK($wx_appid, $wx_secret);

		$rst = $jssdk->get_room();

		if ($rst) {
			if ($rst['errcode'] == 0) {
				$rs = sync_live($rst['room_info']);
				if ($rs['code'] == 0) {
					sl_ajax(0, '成功');
				} else {
					sl_ajax(1, '失败-'.$rst['msg']);
				}
			} else {
				sl_ajax(1, '失败-'.$rst['errmsg']);
			}
		} else {
			sl_ajax(1, '失败-微信返回未知错误');
		}
		exit;
	}


} else if ($operation == 'delete') {
	$post = file_get_contents('php://input');

	// 获取日志删除标题
	$log_title = @get_log_op_delete_title(sl_table_name('live'), $post);

	$rst = sl_delete(sl_table_name('live'), $post);

	if ($rst && $rst['code'] == 0) {
		$op_title = '删除直播房间;' . $log_title;
		@log_op($op_title, $post); // 日志删除

		sl_ajax(0, '成功');
	} else {
		sl_ajax(1, $rst['msg']);
	}


} else {
	message('请求方法不存在');
}

function sync_live($data)
{
	global $_GPC, $_W;

	if (empty($data)) {
		sl_ajax(1, '数据不能为空');
	}

	$ids = sl_array_column($data, 'roomid');

	$where = [
		'uniacid'       => $_W['uniacid'],
		'delete_status' => 0,
		'roomid IN'     => $ids
	];
	$field = ['id', 'roomid'];
	$order_by = ['live_status ASC', 'id ASC'];
	$limit = 100;
	$list = pdo_getall(sl_table_name('live'), $where, $field, '', $order_by, $limit);

	// 事务
	pdo_begin();

	if ($list) {
		foreach ($data as $key => $value) {
			foreach ($list as $k => $v) {
				if ($value['roomid'] == $v['roomid']) {
					$up_data = [
						'sl_title'    => $value['name'],
						'cover_img'   => $value['cover_img'],
						'start_time'  => date('Y-m-d H:i:s', $value['start_time']),
						'end_time'    => date('Y-m-d H:i:s', $value['end_time']),
						'anchor_name' => $value['anchor_name'],
						'anchor_img'  => $value['anchor_img'],
						'goods'       => json_encode($value['goods']),
						'live_status' => $value['live_status'],
						'share_img'   => $value['share_img'],
					];

					$rst = pdo_update(sl_table_name('live'), $up_data, ['id'=>$v['id']]);
					if ($rst === false) {
						pdo_rollback();
						$data_bak = [
							'code' => 1,
							'msg'  => '更新失败，请重试',
						];
						return $data_bak;
					}

					unset($data[$key]);
					break;
				}
			}
		}
	}

	if ($data) {
		foreach ($data as $key => $value) {
			$ins_data = [
				'uniacid'     => $_W['uniacid'],
				'sl_title'    => $value['name'],
				'cover_img'   => $value['cover_img'],
				'start_time'  => date('Y-m-d H:i:s', $value['start_time']),
				'end_time'    => date('Y-m-d H:i:s', $value['end_time']),
				'anchor_name' => $value['anchor_name'],
				'anchor_img'  => $value['anchor_img'],
				'roomid'      => $value['roomid'],
				'goods'       => json_encode($value['goods']),
				'live_status' => $value['live_status'],
				'share_img'   => $value['share_img'],
				'create_time' => date('Y-m-d H:i:s'),
			];
			$rst = pdo_insert(sl_table_name('live'), $ins_data);

			if ($rst === false) {
				pdo_rollback();
				$data_bak = [
					'code' => 1,
					'msg'  => '同步失败-添加记录失败',
				];
				return $data_bak;
			}
		}
	}

	pdo_commit();
	$data_bak = [
		'code' => 0,
		'msg'  => '成功',
	];
	return $data_bak;
}

include $this->template('web/module/live');

