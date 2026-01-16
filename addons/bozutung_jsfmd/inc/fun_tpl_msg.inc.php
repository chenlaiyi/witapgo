<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

if(!defined('IN_IA')) { exit('Access Denied'); }

// 小程序 订阅消息关键词从 1 开始----------------------------------------------------------------------

/** 获取小程序服务端API对象
 * @return res json对象
 */
function sl_get_wxappsdk()
{
	global $_GPC, $_W;

	$wx_appid   = @$_W['account']['key'];
	$wx_secret  = @$_W['account']['secret'];

	require_once MODULE_ROOT . "/lib/sdk/wxappsdk.php";
	$wxappsdk = new WXAPPSDK($wx_appid, $wx_secret);

	return $wxappsdk;
}

/** 订阅消息-列表
 *  */
function sl_tpl_list()
{
	global $_GPC, $_W;

	$wxappsdk = sl_get_wxappsdk();
	$rst = $wxappsdk->templates_list();

	return $rst;
}

/** 订阅消息-删除-单个删除
 * @param  int    $id_tpl_rss 模板表ID
 * @return res                json对象
 */
function sl_rss_delete($id_tpl_rss)
{
	global $_GPC, $_W;

	if (empty($id_tpl_rss)) {
		$data_bak = [
			'code' => 1,
			'msg'  => '失败-参数为空',
		];
		return $data_bak;
	}

	$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id_tpl_rss];
	$one = pdo_get(sl_table_name('tpl_rss'), $where);

	if ($one) {
		$wxappsdk = sl_get_wxappsdk();
		$rst = $wxappsdk->templates_delete($one['tpl_id']);

		if ($rst && $rst['errcode'] == 0) {
			$data_bak = [
				'code' => 0,
				'data' => $rst,
			];
		} else {
			$data_bak = [
				'code' => $rst['errcode'],
				'msg'  => "失败-{$rst['errmsg']}",
			];
		}
	} else {
		$data_bak = [
			'code' => 1,
			'msg'  => '对象不存在',
		];
	}
	return $data_bak;
}

/** 订阅消息-添加
 *
 * @param string $type 类型，如reserve_remind
 * @return void
 */
function sl_rss_add($type)
{
	global $_GPC, $_W;

	if (empty($type)) {
		$data_bak = [
			'code' => 1,
			'msg'  => '参数为空',
		];
		return $data_bak;
	}

	// 模板参数.start
		$tpl_type = '';
		$tpl_data = [];
		if ($type == 'course_queue') {
			$tpl_type = $type;

			// 排队到号通知 - 体育场馆服务
			// 1 = 商家名称
			// 2 = 课程名称
			// 3 = 商家地址
			// 6 = 叫号时间
			// 9 = 您的排号
			$tpl_data = [
				'tid'       => '2879',
				'kidList'   => [1, 2, 3, 6, 9],
				'sceneDesc' => '课程排队提醒',
			];

		} else if ($type == 'course_reserve') {
			$tpl_type = $type;

			// 课程预约成功提醒-体育场馆服务
			// 1 = 课程名称
			// 2 = 课程时间
			// 4 = 门店
			// 5 = 地点
			$tpl_data = [
				'tid'       => '784',
				'kidList'   => [1, 2, 4, 5],
				'sceneDesc' => '课程预约成功提醒',
			];

		} else if ($type == 'buy_coach_video') {
			$tpl_type = $type;

			// 订单支付成功通知-体育场馆服务
			// 3 = 订单编号
			// 7 = 场次信息
			// 4 = 支付时间
			// 5 = 订单金额
			$tpl_data = [
				'tid'       => '1662',
				'kidList'   => [3, 7, 4, 5],
				'sceneDesc' => '购买私教-视频通知',
			];


		} else {
			$data_bak = [
				'code' => 1,
				'msg'  => '参数类型不合法',
			];
			return $data_bak;
		}
	// 模板参数.end

	$where = [
		'uniacid'       => $_W['uniacid'],
		'tpl_type'      => $tpl_type,
		'delete_status' => 0,
	];
	$one = pdo_get(sl_table_name('tpl_rss'), $where);

	if (empty($one)) {
		$wxappsdk = sl_get_wxappsdk();

		$rst = $wxappsdk->templates_add($tpl_data);

		if ($rst && $rst['errcode'] == 0) {
			$data_bak = [
				'code' => 0,
				'data' => [
					'template_id' => $rst['priTmplId'],
					'kidList'     => $tpl_data['kidList'],
				],
			];
		} else {
			$data_bak = [
				'code' => 1,
				'msg'  => '失败-'.$rst['errmsg'],
			];
		}
	} else {
		$data_bak = [
			'code' => 1,
			'msg'  => '通知类型已存在',
		];
	}
	return $data_bak;
}

/** 订阅消息-发送
 *
 * @param object $user		用户
 * @param string $data		类型，如reserve_remind
 * @return object			json对象
 */
function sl_rss_send($data)
{
	global $_GPC, $_W;

	if (empty($data)) {
		$data_bak = [
			'code' => 1,
			'msg'  => '参数为空',
		];
		return $data_bak;
	}

	$nickname = sl_nickname($data['user']['nickname']);

	// 模板参数.start
		$tpl_type = '';
		$tpl_data = [];

		// 排队预约通知
		if ($data['type'] == 'course_queue') {
			$tpl_type = $data['type'];

			$tpl_data = [
				'page' => '^orders',
				'data' => [
					'thing1'            => ['value' => $data['thing1']],
					'thing2'            => ['value' => $data['thing2']],
					'thing3'            => ['value' => $data['thing3']],
					'time6'             => ['value' => $data['time6']],
					'character_string9' => ['value' => $data['character_string9']],
				],
			];


		// 课程预约通知
		} else if ($data['type'] == 'course_reserve') {
			$tpl_type = $data['type'];

			$tpl_data = [
				'page' => '^orders',
				'data' => [
					'thing1' => ['value' => $data['thing1']],
					'date2'  => ['value' => $data['date2']],
					'thing4' => ['value' => $data['thing4']],
					'thing5' => ['value' => $data['thing5']],
				],
			];


		// 购买私教-视频通知
		} else if ($data['type'] == 'buy_coach_video') {
			$tpl_type = $data['type'];

			$tpl_data = [
				'page' => '^orders',
				'data' => [
					'character_string3' => ['value' => $data['character_string3']],
					'thing7'            => ['value' => $data['thing7']],
					'date4'             => ['value' => $data['date4']],
					'amount5'           => ['value' => $data['amount5']],
				],
			];


		} else {
			$data_bak = [
				'code' => 1,
				'msg'  => '参数类型不合法',
			];
			return $data_bak;
		}
	// 模板参数.end

	$where = [
		'uniacid'       => $_W['uniacid'],
		'tpl_type'      => $tpl_type,
		'delete_status' => 0,
	];
	$one = pdo_get(sl_table_name('tpl_rss'), $where);

	if ($one) {
		$tpl_data['touser'] = $data['user']['openid'];
		$tpl_data['template_id'] = $one['tpl_id'];
		$tpl_data['miniprogram_state'] = 'developer'; // 测试
		// $tpl_data['miniprogram_state'] = 'trial'; // 体验
		// $tpl_data['miniprogram_state'] = 'formal'; // 生产（默认）

		$json_send = json_encode($tpl_data);

		$wxappsdk = sl_get_wxappsdk();
		$rst = $wxappsdk->templates_send($tpl_data);

		$json_return = json_encode($rst);

		$data_send = [
			'uniacid'     => $_W['uniacid'],
			'user_id'     => $data['user']['id'],
			'send_info'   => $json_send,
			'return_info' => $json_return,
			'create_time' => $_W['slwl']['datetime']['now'],
		];
		pdo_insert(sl_table_name('tpl_rss_log'), $data_send);

		if ($rst && $rst['errcode'] == 0) {
			$data_bak = [
				'code' => 0,
				'data' => 'ok',
			];
		} else {
			$data_bak = [
				'code' => $rst['errcode'],
				'msg'  => '失败-'.$rst['errmsg'],
			];
		}
	} else {
		$data_bak = [
			'code' => 1,
			'msg'  => '模板对象不存在',
		];
	}
	return $data_bak;
}





// 公众号 ----------------------------------------------------------------------

/** 获取公众号服务端API对象
 * @return res json对象
 */
function sl_get_wx_sdk()
{
	global $_GPC, $_W;

	$wx_public = $_W['slwl']['set']['set_wx_public'];

	if (empty($wx_public)) {
		return [];
	}

	$setting = $_W['slwl']['set']['set_wx_public'];

	$wx_appid  = @trim($setting['appid']);
	$wx_secret = @trim($setting['appsecret']);

	require_once MODULE_ROOT . "/lib/sdk/jssdk.php";
	$jssdk = new JSSDK($wx_appid, $wx_secret);

	return $jssdk;
}

/** 预约-添加
 * @return object 微信返回的json对象
 */
function sl_tpl_add_reserve()
{
	global $_GPC, $_W;

	$where = [
		'uniacid'       => $_W['uniacid'],
		'tpl_type'      => 'reserve_remind',
		'delete_status' => 0,
	];
	$one = pdo_get(sl_table_name('tpl_wxmsg'), $where);

	if (empty($one)) {
		$wx_sdk = sl_get_wx_sdk();

		// 模板库中模板的编号，有“TM**”和“OPENTMTM**”等形式
		// 预约提醒通知
		$data_tpl = [
			'template_id_short' => 'OPENTM401993764',
		];
		$rst = $wx_sdk->templates_add($data_tpl);

		if ($rst && $rst['errcode'] == 0) {
			$data_bak = [
				'code' => 0,
				'data' => [
					'template_id' => $rst['template_id'],
				],
			];
		} else {
			$data_bak = [
				'code' => 1,
				'msg'  => '失败-'.$rst['errmsg'],
			];
		}
	} else {
		$data_bak = [
			'code' => 1,
			'msg'  => '通知类型已存在',
		];
	}
	return $data_bak;
}

/** 预约-删除
 * @return object 微信返回的json对象
 */
function sl_tpl_del_reserve($data)
{
	global $_GPC, $_W;

	$where = [
		'uniacid' => $_W['uniacid'],
		'id'      => $data,
	];
	$one = pdo_get(sl_table_name('tpl_wxmsg'), $where);

	if ($one) {
		$wx_sdk = sl_get_wx_sdk();

		$data_tpl = [
			'template_id' => $one['tpl_id'],
		];
		$rst = $wx_sdk->templates_delete($data_tpl);

		if ($rst && $rst['errcode'] == 0) {
			$data_bak = [
				'code' => 0,
				'msg'  => 'ok',
			];
		} else {
			$data_bak = [
				'code' => 1,
				'msg'  => '失败-'.$rst['errmsg'],
			];
		}
	} else {
		$data_bak = [
			'code' => 1,
			'msg'  => '通知不存在',
		];
	}
	return $data_bak;
}

/** 预约-发送
 * @param  object  $data  信息
 * @return res            json对象
 */
function sl_tpl_send_reserve($data)
{
	global $_GPC, $_W;

	// 模板
	$where = [
		'uniacid'       => $_W['uniacid'],
		'tpl_type'      => 'reserve_remind',
		'delete_status' => 0,
	];
	$one = pdo_get(sl_table_name('tpl_wxmsg'), $where);

	// 小程序
	// $wx_appid = @$_W['account']['key'];
	// $pagepath = 'pages/subscribe-detail/subscribe-detail';
	// 	'miniprogram' => [
	// 			"appid"    => $wx_appid,
	// 			"pagepath" => $pagepath,
	// 		],

	if ($one) {
		$data = [
			'touser'      => $one['touser'],
			'template_id' => $one['tpl_id'],
			'data'        => [
				'first'    => ['value' => '您有新的预约，请即时处理', 'color' => '#173177'],
				'keyword1' => ['value' => $data['name']],
				'keyword2' => ['value' => $data['mobile']],
				'keyword3' => ['value' => $data['datetime']],
			],
		];

		$json_send = json_encode($data);

		$wx_sdk = sl_get_wx_sdk();
		$rst = $wx_sdk->templates_send($data);

		$json_return = json_encode($rst);

		$data_send = [
			'uniacid'     => $_W['uniacid'],
			'user_id'     => $data['id'],
			'send_info'   => $json_send,
			'return_info' => $json_return,
			'create_time' => $_W['slwl']['datetime']['now'],
		];
		pdo_insert(sl_table_name('tpl_rss_log'), $data_send);

		if ($rst && $rst['errcode'] == 0) {
			$data_bak = [
				'code' => 0,
				'data' => 'ok',
			];
		} else {
			$data_bak = [
				'code' => $rst['errcode'],
				'msg'  => '失败-'.$rst['errmsg'],
			];
		}
	} else {
		$data_bak = [
			'code' => 1,
			'msg'  => '模板对象不存在',
		];
	}
	return $data_bak;
}
