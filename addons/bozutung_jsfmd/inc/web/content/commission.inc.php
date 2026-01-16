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
	$keyword = $_GPC['keyword'];

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid'], 'delete'=>'0'];

	if ($keyword != '') {
		$keyword = trim($keyword);
		$where['nickname like'] = '%'.$keyword.'%';
	}

	$order_by = ['id DESC'];
	$limit = [$pindex, $psize];
	$list_user = pdo_getall(sl_table_name('user'), $where, '', '', $order_by, $limit);

	if ($list_user) {
		/** 分销表信息.start */
		$ids_com = sl_array_column($list_user, 'id');
		if ($ids_com) {
			$where_com = [
				'uniacid'    => $_W['uniacid'],
				'id_user IN' => $ids_com,
			];
			$list_com = pdo_getall(sl_table_name('commission'), $where_com);

			/** 获取用户的上级用户信息.start */
			$ids_superior = sl_array_column($list_com, 'id_com_1');
			$where_superior = [
				'uniacid' => $_W['uniacid'],
				'id IN'   => $ids_superior,
			];
			$list_user_superior = pdo_getall(sl_table_name('user'), $where_superior, ['id','avatar','nickname','real_name']);
			foreach ($list_user_superior as $key => $value) {
				$list_user_superior[$key]['avatar_url'] = tomedia($value['avatar']);
				$list_user_superior[$key]['name'] = $value['real_name']?$value['real_name']:json_decode($value['nickname']);
			}
			foreach ($list_user as $key => $value) {
				$list_user[$key]['id_com'] = 0;
				$list_user[$key]['status_format'] = '未审核';
				foreach ($list_com as $k => $v) {
					if ($value['id'] == $v['id_user']) {
						$list_user[$key]['id_com'] = $v['id_com_1'];
						// 状态
						$list_user[$key]['status_commission'] = $v['status'];
						$list_user[$key]['status_format'] = $v['status']==1?'已审核':'未审核';
						// 加入时间
						$list_user[$key]['time_add_format'] = $v['create_time'];
						break;
					}
				}
			}
			/** 获取用户的上级用户信息.end */
		}
		/** 分销表信息.end */

		/** 我的下线-汇总.start */
		$tb_user = sl_table_name('user', TRUE);
		$tb_com = sl_table_name('commission', TRUE);

		$ids_user = sl_array_column($list_user, 'id');
		if ($ids_user) {
			$flags = implode(',', $ids_user);

			$field = " u.id,u.nickname, ";
			$field .= " (SELECT COUNT(*) FROM {$tb_com} AS c ";
			$field .= " WHERE u.id=c.id_com_1 OR u.id=c.id_com_2 OR u.id=c.id_com_3 ) AS u_count ";
			$sql = "SELECT {$field} FROM {$tb_user} AS u WHERE id IN({$flags}) ";
			$list_my_downline = pdo_fetchall($sql);
		}

		foreach ($list_user as $key => $value) {
			foreach ($list_my_downline as $k => $v) {
				if ($value['id'] == $v['id']) {
					$list_user[$key]['count_downline'] = $v['u_count'];
					break;
				}
			}
		}
		/** 我的下线-汇总.end */

		// 列表信息-拼接
		foreach ($list_user as $k => $v) {
			$list_user[$k]['avatar_url'] = tomedia($v['avatar']);

			/** 用户信息.start */
			$nickname = is_json($v['nickname'])?json_decode($v['nickname']):$v['nickname'];
			$mobile = $v['mobile']?$v['mobile']:'暂无';
			$list_user[$k]['nickname_format'] = $nickname;
			$list_user[$k]['tel_format'] = $mobile;
			/** 用户信息.end */

			/** 上级.start */
			if ($_W['slwl']['set']['site_settings']) {
				$settings = $_W['slwl']['set']['site_settings'];

				$avatar_url = MODULE_URL.'template/public/image/nopic.png';
				if ($settings['logo']) {
					$avatar_url = tomedia($settings['logo']);
				}
			}
			$list_user[$k]['userSuperior'] = ['id'=>0,'nickname'=>'总店','avatar_url'=>$avatar_url];
			foreach ($list_user_superior as $key => $value) {
				if ($v['id_com'] == $value['id']) {
					$tmp_nickname = is_json($value['nickname']);
					$value['nickname'] = $tmp_nickname?json_decode($value['nickname']):$value['nickname'];
					$list_user[$k]['userSuperior'] = $value;
					break;
				}
			}
			/** 上级.end */
		}
		$total = pdo_getcolumn(sl_table_name('user'), $where, 'COUNT(*)');

	}
	$data_return = array(
		'code' => '0',
		'msg' => '',
		'count' => $total,
		'data' => $list_user,
	);
	echo json_encode($data_return);
	exit;


} else if ($operation == 'status_com') {
	$uid = $_GPC['uid'];
	$s_status = $_GPC['status'];

	if ($uid == '' || $s_status == '') {
		sl_ajax(1, '参数为空');
	}
	if ($s_status > 0) {
		$where_user_com = [
			'uniacid' => $_W['uniacid'],
			'id_user' => $uid,
		];
		$one = pdo_get(sl_table_name('commission') ,$where_user_com);

		if ($one) {
			$where_user_com = [
				'uniacid' => $_W['uniacid'],
				'id_user' => $uid,
			];
			$rst = pdo_update(sl_table_name('commission'), ['status'=>$s_status], $where_user_com);
		} else {
			$data = [
				'uniacid'     => $_W['uniacid'],
				'id_user'     => $uid,
				'status'      => 1,
				'create_time' => $_W['slwl']['datetime']['now'],
			];
			$rst = pdo_insert(sl_table_name('commission') ,$data);
		}
	}

	if ($rst !== '0') {
		sl_ajax(0, '调整成功！');
	} else {
		sl_ajax(1, '调整失败');
	}
	exit;


} else if ($operation == 'post') {
	$id = intval($_GPC['id']); // uid

	if ($_W['ispost']) {
		$options = $_GPC['options'];

		if ($options['id_user_label']) {
			$ids = array_values($options['id_user_label']);
			$id_label = json_encode($ids);
		}

		try {
			pdo_begin();


			$data = array(
				'nickname' => $_GPC['nickname'],
				'real_name' => $_GPC['real_name'],
				'tel' => $_GPC['tel'],
				'member_level_id' => $_GPC['member_level_id'],
				'id_label' => $id_label,
				'mark' => $_GPC['mark'],
			);
			if ($id) {
				$rst_1 = pdo_update(sl_table_name('user'), $data, ['id'=>$id]);
			}

			// 保存上级分销商
			$id_user_com = $_GPC['agentid']; // 上级ID

			if ($id == $id_user_com) {
				sl_ajax(1, '上级分销商不能是自己');
			}

			if ($id_user_com) {
				// 分销表.start
				$where_user_com = [
					'uniacid' => $_W['uniacid'],
					'id_user' => $id,
				];
				$one_user_com = pdo_get(sl_table_name('commission') ,$where_user_com);

				if ($one_user_com) {
					$where_user_com = [
						'uniacid' => $_W['uniacid'],
						'id_user' => $id,
					];
					$data = [
						'id_com_1' => $id_user_com,
					];
					$rst_2 = pdo_update(sl_table_name('commission'), $data, $where_user_com);
				} else {
					$data = [
						'uniacid'     => $_W['uniacid'],
						'id_user'     => $id,
						'status'      => 1,
						'id_com_1'    => $id_user_com,
						'create_time' => $_W['slwl']['datetime']['now'],
					];
					$rst_2 = pdo_insert(sl_table_name('commission') ,$data);
				}
				// 分销表.end

				// 分销-佣金表.start
				$ids_other = [$id, $id_user_com];

				$where_user_com = [
					'uniacid'    => $_W['uniacid'],
					'id_user IN' => $ids_other,
				];
				$list_user_com = pdo_getall(sl_table_name('commission_brokerage'),$where_user_com);

				if (count($list_user_com) != 2) {
					$ids_user_com = sl_array_column($list_user_com, 'id_user');
					foreach ($ids_other as $key => $value) {
						if (!(in_array($value, $ids_user_com))) {
							$data = [
								'uniacid' => $_W['uniacid'],
								'id_user' => $value,
							];
							$rst_3 = pdo_insert(sl_table_name('commission_brokerage') ,$data);
						}
					}
				}
				// 分销-佣金表.end
			}

			if ($rst_1 !== false && $rst_2 !== false && $rst_3 !== false) {
				pdo_commit();
				sl_ajax(0, '成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '失败');
			}
		} catch (Exception $e) {
			pdo_rollback();
			sl_ajax(1, '失败-'.$e->getMessage());
		}

	}

	$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id, 'delete'=>'0'];
	$one = pdo_get(sl_table_name('user'), $where);

	if ($one) {
		$one['nickname'] = is_json($one['nickname'])?json_decode($one['nickname']):$one['nickname'];

		$where_user_com = [
			'uniacid' => $_W['uniacid'],
			'id_user' => $one['id'],
		];
		$one_user_com = pdo_get(sl_table_name('commission') ,$where_user_com);

		if ($one_user_com && $one_user_com['id_com_1']) {
			$where_user = ['uniacid'=>$_W['uniacid'], 'id'=>$one_user_com['id_com_1'], 'delete'=>'0'];
			$one_agent = pdo_get(sl_table_name('user'), $where_user);
			if ($one_agent) {
				$one_agent['nickname'] =
					is_json($one_agent['nickname'])?json_decode($one_agent['nickname']):$one_agent['nickname'];
			}
		}
	}


	/** 会员等级.start */
	$list_member_level = pdo_getall(sl_table_name('member_level'), ['uniacid'=>$_W['uniacid'],'delete'=>'0']);
	$list_member_level[] = ['id'=>'0', 'name'=>'普通会员'];
	/** 会员等级.end */

	/** 所有标签分组.start */
	$where = ['uniacid'=>$_W['uniacid'], 'delete'=>'0'];
	$order_by = ['id DESC'];
	$list_user_label = pdo_getall(sl_table_name('user_label'), $where, '', '', $order_by);

	if ($list_user_label) {
		$ids_user_label_all = sl_array_column($list_user_label, 'id');
		if ($ids_user_label_all) {
			if ($one['id_label']) {
				$ids_one = json_decode($one['id_label'], TRUE);
				if ($ids_one) {
					foreach ($list_user_label as $key => $value) {
						$list_user_label[$key]['checked'] = 0;
						foreach ($ids_one as $k => $v) {
							if (in_array($v, $ids_user_label_all)) {
								$list_user_label[$key]['checked'] = 1;
								unset($ids_one[$k]);
								break;
							}
						}
					}
				}
			}
		}
	}
	/** 所有标签分组.end */


} else if ($operation == 'set') {
	if ($_W['ispost']) {
		$options = $_GPC['options'];

		if (empty($options['withdraw_min'])) {
			$options['withdraw_min'] = 0;
		}
		$options['withdraw_min'] = $options['withdraw_min'] * 100;

		$data = [];
		$data['setting_value'] = json_encode($options);

		if ($_W['slwl']['set']['set_commission']) {
			$where = [];
			$where = [
				'uniacid'      => $_W['uniacid'],
				'setting_name' => 'set_commission',
			];
			pdo_update(sl_table_name('settings'), $data, $where);
		} else {
			$data['uniacid']      = $_W['uniacid'];
			$data['setting_name'] = 'set_commission';
			$data['addtime']      = $_W['slwl']['datetime']['now'];
			pdo_insert(sl_table_name('settings'), $data);
		}
		sl_ajax(0, '保存成功');
	}

	if ($_W['slwl']['set']['set_commission']) {
		$one_set = $_W['slwl']['set']['set_commission'];
		$one_set['withdraw_min'] = $one_set['withdraw_min'] / 100;
	}


} else if ($operation == 'order_com') {
	$uid = intval($_GPC['id']); // uid

	if ($uid) {
		$pindex = max(1, intval($_GPC['page']));
		$psize = max(10, intval($_GPC['limit']));
		$where = ['uniacid'=>$_W['uniacid'], 'delete'=>0, 'type IN'=>[0,3,4], 'user_id'=>$uid];
		$order_by = ['id DESC'];
		$limit = [$pindex, $psize];
		$list = pdo_getall(sl_table_name('order'), $where, '', '', $order_by, $limit);

		if ($list) {
			$array_week = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
			foreach ($list as $key => $value) {
				$order_info = json_decode($value['order_info'],TRUE);
				$list[$key]['order_info'] = $order_info;
				$list[$key]['create_time_format'] = date('Y-m-d H:i:s', $value['create_time']);

				if ($value['type'] == 0) {
					$list[$key]['course_time_format'] = $array_week[date('w',$order_info['start'])]
														 . ' ' . date('Y-m-d H:i:s', $order_info['start']);
				}

				if ($value['status'] == 1) {
					$list[$key]['statusText'] = '已付款';

				} else if ($value['status'] == 2) {
					$list[$key]['statusText'] = '已完成';

				} else if ($value['status'] == 3) {
					$list[$key]['statusText'] = '请求取消订单';

				} else if ($value['status'] == 4) {
					$list[$key]['statusText'] = '已取消';

				} else if ($value['status'] == 5) {
					$list[$key]['statusText'] = '已拒绝退款';

				}

			}
		}
	}

	sl_jsf_commission_settle(); // 结算
	// sl_ajax(0,$list);
	// exit;


} else if ($operation == 'downline') {
	$uid = intval($_GPC['uid']); // uid


} else if ($operation == 'downline_table') {
	$keyword = $_GPC['keyword'];
	$uid = intval($_GPC['uid']); // uid

	if (empty($uid)) {
		sl_ajax(1, '用户ID不能为空');
	}

	// 只取下线用户.start
	$condition_my_downline = " AND uniacid=:uniacid AND (id_com_1=:id_com OR id_com_2=:id_com OR id_com_3=:id_com) ";
	$params_my_downline = array(':uniacid' => $_W['uniacid'], ':id_com'=>$uid);
	$sql_my_downline = "SELECT * FROM " . sl_table_name('commission', TRUE). ' WHERE 1 ' . $condition_my_downline;
	$list_my_downline = pdo_fetchall($sql_my_downline, $params_my_downline);

	// dump($list_my_downline);
	// 只取下线用户.end

	$ids_com = sl_array_column($list_my_downline, 'id_user');

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid'], 'delete'=>'0', 'id IN'=>$ids_com];
	if ($keyword != '') {
		$keyword = trim($keyword);
		$where['nickname like'] = '%'.$keyword.'%';
	}
	$order_by = ['id DESC'];
	$limit = [$pindex, $psize];
	$list_user = pdo_getall(sl_table_name('user'), $where, '', '', $order_by, $limit);

	if ($list_user) {
		/** 分销表信息.start */
		$ids_com = sl_array_column($list_user, 'id');
		if ($ids_com) {
			$where_com = [
				'uniacid'    => $_W['uniacid'],
				'id_user IN' => $ids_com,
			];
			$list_com = pdo_getall(sl_table_name('commission'), $where_com);

			/** 获取用户的上级用户信息.start */
			$ids_superior = sl_array_column($list_com, 'id_com_1');
			$where_superior = [
				'uniacid' => $_W['uniacid'],
				'id IN'   => $ids_superior,
			];
			$list_user_superior = pdo_getall(sl_table_name('user'), $where_superior, ['id','avatar','nickname','real_name']);
			foreach ($list_user_superior as $key => $value) {
				$list_user_superior[$key]['avatar_url'] = tomedia($value['avatar']);
				$list_user_superior[$key]['name'] = $value['real_name']?$value['real_name']:sl_nickname($value['nickname']);
			}
			foreach ($list_user as $key => $value) {
				$list_user[$key]['id_com'] = 0;
				$list_user[$key]['status_format'] = '未审核';
				foreach ($list_com as $k => $v) {
					if ($value['id'] == $v['id_user']) {
						$list_user[$key]['id_com'] = $v['id_com_1'];
						// 状态
						$list_user[$key]['status_commission'] = $v['status'];
						$list_user[$key]['status_format'] = $v['status']==1?'已审核':'未审核';
						// 加入时间
						$list_user[$key]['time_add_format'] = $v['create_time'];
						break;
					}
				}
			}
			/** 获取用户的上级用户信息.end */
		}
		/** 分销表信息.end */

		/** 我的下线-汇总.start */
		$tb_user = sl_table_name('user', TRUE);
		$tb_com = sl_table_name('commission', TRUE);

		$ids_user = sl_array_column($list_user, 'id');
		if ($ids_user) {
			$flags = implode(',', $ids_user);

			$field = " u.id,u.nickname, ";
			$field .= " (SELECT COUNT(*) FROM {$tb_com} AS c ";
			$field .= " WHERE u.id=c.id_com_1 OR u.id=c.id_com_2 OR u.id=c.id_com_3 ) AS u_count ";
			$sql = "SELECT {$field} FROM {$tb_user} AS u WHERE id IN({$flags}) ";
			$list_my_downline = pdo_fetchall($sql);
		}

		foreach ($list_user as $key => $value) {
			foreach ($list_my_downline as $k => $v) {
				if ($value['id'] == $v['id']) {
					$list_user[$key]['count_downline'] = $v['u_count'];
					break;
				}
			}
		}
		/** 我的下线-汇总.end */

		// 列表信息-拼接
		foreach ($list_user as $k => $v) {
			$list_user[$k]['avatar_url'] = tomedia($v['avatar']);

			/** 用户信息.start */
			$nickname = is_json($v['nickname'])?json_decode($v['nickname']):$v['nickname'];
			$mobile = $v['mobile']?$v['mobile']:'暂无';
			$list_user[$k]['nickname_format'] = $nickname;
			$list_user[$k]['tel_format'] = $mobile;
			/** 用户信息.end */

			/** 上级.start */
			if ($_W['slwl']['set']['site_settings']) {
				$settings = $_W['slwl']['set']['site_settings'];

				$avatar_url = MODULE_URL.'template/public/image/nopic.png';
				if ($settings['logo']) {
					$avatar_url = tomedia($settings['logo']);
				}
			}
			$list_user[$k]['userSuperior'] = ['id'=>0,'nickname'=>'总店','avatar_url'=>$avatar_url];
			foreach ($list_user_superior as $key => $value) {
				if ($v['id_com'] == $value['id']) {
					$list_user[$k]['userSuperior'] = $value;
					break;
				}
			}
			/** 上级.end */
		}
		$total = pdo_getcolumn(sl_table_name('user'), $where, 'COUNT(*)');

	}
	$data_return = array(
		'code' => '0',
		'msg' => '',
		'count' => $total,
		'data' => $list_user,
	);
	echo json_encode($data_return);
	exit;


} else if ($operation == 'brokerage') {


} else if ($operation == 'brokerage_table') {
	$keyword = $_GPC['keyword'];

	$pindex = max(1, intval($_GPC['page']));
	$psize = max(10, intval($_GPC['limit']));
	$where = ['uniacid'=>$_W['uniacid']];
	$order_by = ['status ASC','id DESC'];
	$limit = [$pindex, $psize];
	$list = pdo_getall(sl_table_name('commission_brokerage_log'), $where, '', '', $order_by, $limit);

	if ($list) {
		// 获取用户信息
		$ids_user = sl_array_column($list, 'id_user');

		$where_user = [
			'uniacid' => $_W['uniacid'],
			'id IN'   => $ids_user,
		];
		$list_user = pdo_getall(sl_table_name('user'), $where_user);

		if ($list_user) {
			foreach ($list as $key => $value) {
				foreach ($list_user as $k => $v) {
					if ($value['id_user'] == $v['id']) {
						$name = is_json($v['nickname'])?json_decode($v['nickname']):$v['real_name'];
						$list[$key]['name'] = $name;
						$list[$key]['avatar'] = $v['avatar'];
						$list[$key]['money_format'] = number_format($value['money'] / 100, 2);

						if ($value['status'] == '0') {
							$list[$key]['status_format'] = '待审核';

						} else if ($value['status'] == '1') {
							$list[$key]['status_format'] = '通过申请';

						} else if ($value['status'] == '2') {
							$list[$key]['status_format'] = '拒绝申请';

						} else if ($value['status'] == '3') {
							$list[$key]['status_format'] = '已打款';

						} else if ($value['status'] == '4') {
							$list[$key]['status_format'] = '拒绝打款';

						}

						break;
					}
				}
			}
		}
		// dump($list);
		// exit;
		$total = pdo_count(sl_table_name('commission_brokerage_log'), $where);
	}
	$data_return = array(
		'code' => '0',
		'msg' => '',
		'count' => $total,
		'data' => $list,
	);
	echo json_encode($data_return);
	exit;


} else if ($operation == 'post_brokerage') {
	$id = intval($_GPC['id']); // uid

	if ($_W['ispost']) {
		$data = [
			'status'=>$_GPC['status'],
			'mark'=>$_GPC['mark'],
		];

		$rst = pdo_update(sl_table_name('commission_brokerage_log'), $data, ['id'=>$id]);
		if ($rst !== false) {
			sl_ajax(0, 'ok');
		} else {
			sl_ajax(1, 'err');
		}
	}

	$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id];
	$one = pdo_get(sl_table_name('commission_brokerage_log'), $where);


} else {
	message('请求方式不存在');
}

include $this->template('web/content/commission');

