<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');
$operation = ($_GPC['op']) ? $_GPC['op'] : 'display';

if ($operation == 'display') {
	header('location: ' . webUrl('',['do'=>'module/tpl_msg','op'=>'rss']));


} else if ($operation == 'rss') {


} else if ($operation == 'rss_list') {
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
	$order_by = ['id DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('tpl_rss'), $where, '', '', $order_by, $limit);
	$total = pdo_count(sl_table_name('tpl_rss'), $where);

	if ($list) {
		foreach ($list as $key => $value) {
			if ($value['status'] == '1') {
				// 启用
				$list[$key]['status_format'] = $_W['slwl']['lang']['enabled'];
			} else {
				// 禁用
				$list[$key]['status_format'] = $_W['slwl']['lang']['disabled'];
			}
		}
	}

	$data_return = [
		'code'  => '0',
		'msg'   => '',
		'count' => $total,
		'data'  => $list,
	];
	echo json_encode($data_return);
	exit;


} else if ($operation == 'rss_post') {
	$id = intval($_GPC['id']);

	$list_tpl_type = []; // 订阅消息-类型
	if ($_W['slwl']['tpl']['tpl_type']) {
		$list_tpl_type = $_W['slwl']['tpl']['tpl_type'];
	}

	if ($_W['ispost']) {
		$options = $_GPC['options'];

		$tpl_type = trim($options['tpl_type']);
		$mark = trim($options['mark']);

		if (empty($tpl_type)) {
			sl_ajax(1, '参数-模板类型为空');
		}
		if (empty($list_tpl_type)) {
			sl_ajax(1, '消息通知类型为空');
		}

		$title = '无';
		$in = false;
		foreach ($list_tpl_type as $key => $value) {
			if ($value['type'] == $tpl_type) {
				$title = $value['sl_title'];
				$in = true;
				break;
			}
		}

		if (!$in) {
			sl_ajax(1, '不存在的消息通知类型');
		}

		if ($tpl_type == 'course_queue') {
			$rst = sl_rss_add($tpl_type); // 添加-课程排队通知

		} else if ($tpl_type == 'course_reserve') {
			$rst = sl_rss_add($tpl_type); // 添加-课程预约通知

		} else if ($tpl_type == 'buy_coach_video') {
			$rst = sl_rss_add($tpl_type); // 添加-购买私教-视频通知

		} else {
			sl_ajax(1, '消息类型不存在');
		}

		if ($rst && $rst['code'] == 0) {
			$data = [
				'uniacid'     => $_W['uniacid'],
				'sl_title'    => $title,
				'tpl_id'      => $rst['data']['template_id'],
				'tpl_type'    => $tpl_type,
				'mark'        => $mark,
				'create_time' => $_W['slwl']['datetime']['now'],
			];
			$rst = pdo_insert(sl_table_name('tpl_rss'), $data);

			if ($rst !== FALSE) {
				sl_ajax(0, "添加成功");
			} else {
				sl_ajax(1, "添加失败");
			}
		} else {
			sl_ajax(1, "添加失败-{$rst['msg']}");
		}
	}

	$where = [
		'uniacid' => $_W['uniacid'],
		'id'      => $id,
	];
	$one = pdo_get(sl_table_name('tpl_rss'), $where);


} else if ($operation == 'rss_delete') {
	$post = file_get_contents('php://input');

	if (empty($post)) {
		sl_ajax(1, '参数不存在');
	}
	$params = @json_decode($post, true);
	if (!$params) {
		sl_ajax(1, '参数解析出错');
	}
	$ids = isset($params['ids']) ? $params['ids'] : '';

	if ($ids) {
		foreach ($ids as $key => $value) {
			$rst = sl_rss_delete($value);

			if ($rst && $rst['code'] == 0) {
				sl_delete(sl_table_name('tpl_rss'), $post);
			} else {
				sl_ajax(1, '删除ID不存在');
			}
		}

		log_op('删除订阅消息', $rst); // 日志删除
		sl_ajax(0, $_W['slwl']['lang']['tips_success']);
	} else {
		sl_ajax(1, 'ID不存在');
	}


} else if ($operation == 'sync') {
	if ($_W['ispost']) {

		$rst = sl_tpl_list();

		if ($rst) {
			$where = [
				'uniacid' => $_W['uniacid'],
			];
			$list_my = pdo_getall(sl_table_name('tplwx'), $where);

			if ($rst['errcode'] == '0') {
				$list = $rst['list'];

				if ($list) {
					foreach ($list as $key => $value) {
						if ($list_my) {
							foreach ($list_my as $k => $v) {
								if ($value['template_id'] == $v['tpl_id']) {
									unset($list[$key]); // 删除本地有的
									break;
								}
							}
						}
					}
					if ($list) {
						$rst = [];
						foreach ($list as $key => $value) {
							$data = [
								'uniacid'        => $_W['uniacid'],
								'title'          => '无',
								'tpl_base_id'    => '无',
								'tpl_base_title' => '无',
								'tpl_id'         => $value['template_id'],
								'mark'           => $_W['slwl']['datetime']['now'].'-同步',
								'create_time'    => $_W['slwl']['datetime']['now'],
							];
							$rst[] = @pdo_insert(sl_table_name('tplwx'), $data);
						}
						$count_list = count($list);
						$count_rst = count($rst);
						if ($count_list == $count_rst) {
							sl_ajax(0, "同步记录-{$count_rst}-条");
						} else {
							sl_ajax(1, '同步出错');
						}
					} else {
						sl_ajax(1, '和地本无差异');
					}
				} else {
					sl_ajax(1, '没有要同步的内容');
				}
			} else {
				sl_ajax(1, $rst['errmsg']);
			}
		} else {
			sl_ajax(1, '获取出错');
		}
	}


} else {
	message('请求方式不存在');
}

include $this->template('web/module/tpl_msg');

