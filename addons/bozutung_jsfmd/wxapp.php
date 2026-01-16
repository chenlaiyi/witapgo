<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

require_once IA_ROOT . '/addons/bozutung_jsfmd/defines.php';
require_once SLWL_PATH . 'version.php';
require_once SLWL_INC . 'basic.inc.php';
require_once SLWL_INC . 'functions.inc.php';
require_once SLWL_INC . 'menus.inc.php';
require_once SLWL_INC . 'fun_sys.inc.php'; // 系统-模块
require_once SLWL_INC . 'fun_commission_jsf.inc.php'; // 分销-模块
require_once SLWL_INC . 'fun_tpl_msg.inc.php'; // 模块-模板消息
class Bozutung_jsfmdModuleWxapp extends WeModuleWxapp
{
	/**
	 * save_session_key
	 * @param string $session_key
	 * @return array
	 */
	private function save_session_key($session_key)
	{
		global $_GPC, $_W;

		if (!$session_key) {
			$rst = array(
				'return_code' => '-999999',
				'return_msg'  => 'session_key不存在',
			);
			return $rst;
		}

		$options = array(
			'session_key'=>$session_key,
		);

		$data = array();
		$data['setting_value'] = json_encode($options); // 压缩

		if ($_W['slwl']['set']['set_session_key']) {
			$where['uniacid'] = $_W['uniacid'];
			$where['setting_name'] = 'set_session_key';
			$rst = pdo_update(sl_table_name('settings'), $data, $where);
		} else {
			$data['uniacid'] = $_W['uniacid'];
			$data['setting_name'] = 'set_session_key';
			$data['addtime'] = $_W['slwl']['datetime']['now'];
			$rst = pdo_insert(sl_table_name('settings'), $data);
		}

		if ($rst !== FALSE) {
			$data_bak = array(
				'return_code' => '0',
				'return_msg'  => 'ok',
			);
			return $data_bak;
		} else {
			$data_bak = array(
				'return_code' => '1',
				'return_msg'  => 'err',
			);
			return $data_bak;
		}
	}

	/**
	 * 在课程结束后
	 * 已付款->为已完成
	 */
	private function finishOrder()
	{
		global $_GPC, $_W;
		$tn = sl_table_name('order',TRUE);
		$where = "WHERE status = 1 AND `end` < " . time();
		$orders = pdo_fetchall("SELECT id,status,user_id,paid_money,subtype FROM $tn $where");
		if (empty($orders)) return;

		pdo_query("UPDATE $tn SET status = 2 WHERE id IN (" . implode(',', sl_array_column($orders, 'id')) . ")");

		$rates = pdo_get(sl_table_name('system_settings'), ['uniacid'=>$_W['uniacid']], ['royalty_rate','royalty_rate2']);
		$uidList = array_values(array_unique(sl_array_column($orders, 'user_id')));
		$userRelations = pdo_getall(sl_table_name('user_relation'), ['lower' => $uidList]);
		foreach ($userRelations as $ur) {
			$uidUrMap[$ur['lower']] = $ur;
		}
		foreach ($orders as $item) {
			if ($item['subtype'] != 127) continue;

			$uid = $item['user_id'];
			$ur = $uidUrMap[$uid];

			$upper = $ur['upper'];
			if (empty($upper)) continue;

			$money = $item['paid_money'];
			$c = bcdiv(bcmul($money, $rates['royalty_rate'], 2), 1000, 2);
			self::addCommission($upper, $c, $_W['uniacid'], $item['id']);

			$upperUpper = $ur['upperupper'];
			if (empty($upperUpper)) continue;

			$c = bcdiv(bcmul($money, $rates['royalty_rate2'], 2), 1000, 2);
			self::addCommission($upperUpper, $c, $_W['uniacid'], $item['id']);
		}
	}

	/**
	 * 获取作用于课程排期的锁
	 * @param string $cpid
	 * @return string FileLock
	 */
	private function getCoursePlanLock($cpid)
	{
		require_once IA_ROOT . '/addons/bozutung_jsfmd/Lock.php';
		$path = MODULE_ROOT . '/data/tmp/';
		$filename = 'bozutung_jsfmd_course_plan_' . $cpid;

		return new FileLock($path . $filename);
	}

	/**
	 * 获取作用于用户佣金的锁
	 * @param string $uid
	 * @return string FileLock
	 */
	private function getCommissionLock($uid)
	{
		require_once IA_ROOT . '/addons/bozutung_jsfmd/Lock.php';
		$path = MODULE_ROOT . '/data/tmp/';
		$filename = 'bozutung_jsfmd_commission_' . $uid;
		return new FileLock($path . $filename);
	}

	private function filterCourseList(&$list, $level)
	{
		if (empty($list)) return;

		$tn = sl_table_name('course_member_level');
		foreach ($list as $key => $plan) {
			$all = pdo_getall($tn, ['course_id' => $plan['course_id']]);

			if (!empty($all)) {
				foreach ($all as $value) {
					if ($value['member_level_id'] == $level) {
						continue 2;
					}
				}
				unset($list[$key]);
			}
		}
	}

	private function getZdyOne($uniacid, $key)
	{
		global $_GPC, $_W;

		$unid = ['uniacid'=>$uniacid];
		$zdy = pdo_getcolumn(sl_table_name('system_settings'), $unid, 'zdy');
		if (!empty($zdy)) {
			$zdy = json_decode($zdy, TRUE);
			switch ($key) {
				case 'store_bg_image':
				case 'coach_bg_image':
					$zdy[$key] = tomedia($zdy[$key]);
					break;
			}
		} else $zdy = [];
		return $zdy[$key];
	}

	private function getSystemSettings($uniacid)
	{
		global $_GPC, $_W;

		$unid = ['uniacid'=>$uniacid];
		$settings = pdo_get(sl_table_name('system_settings'), $unid);
		$settings['my_top_bg_image'] = tomedia($settings['my_top_bg_image']);
		$settings['recommend_bg_image'] = tomedia($settings['recommend_bg_image']);
		$settings['training_bg_image'] = tomedia($settings['training_bg_image']);
		$settings['syllabus_bg_image'] = tomedia($settings['syllabus_bg_image']);
		$settings['logo'] = tomedia($settings['logo']);
		if (!empty($settings['zdy'])) {
			$zdy = json_decode($settings['zdy'], TRUE);
			$zdy['store_bg_image'] = tomedia($zdy['store_bg_image']);
			$zdy['coach_bg_image'] = tomedia($zdy['coach_bg_image']);
		} else $zdy = [];
		$settings['zdy'] = $zdy;

		// 会员等级
		$condition = " AND uniacid=:uniacid AND `delete`='0' ";
		$params = [':uniacid'=>$uniacid];
		$list_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('member_level',TRUE) . ' WHERE 1 ' . $condition, $params);

		$list_member_level[] = [
			'id'=>'0',
			'name'=>'普通会员',
		];
		$settings['member_level'] = $list_member_level;

		return $settings;
	}

	private function getInfo($tn, $fields = '*')
	{
		global $_GPC, $_W;
		$res = pdo_fetch("SELECT $fields FROM " . sl_table_name($tn,TRUE)
			. " WHERE (`delete` = 0 OR `delete` IS NULL) AND (id = :id)",
			['id' => $_GPC['id']]);

		sl_ajax(0, $res);
	}

	private function getPayParams($fee, $sn, $user)
	{
		global $_GPC, $_W;

		require_once MODULE_ROOT . "/lib/Common.class.php";
		$sys_id = $_W['uniacid'];
		$app = Common::get_app_info($sys_id);

		define('MY_APPID', $app['appid']);
		define('MY_SECRET', $app['secret']);
		define('MY_MCHID', $app['mchid']);
		define('MY_SIGNKEY', $app['signkey']);

		// 统一下单
		$jsApiParameters = Common::run_pay($user['openid'], $sn, $fee);

		if ($jsApiParameters['return_code']=='SUCCESS') {
			$data_bak = array(
				'code'=>'0',
				'msg'=>'ok',
				'data'=>$jsApiParameters['return_msg']
			);
			return $data_bak;
		} else {
			$data_bak = array(
				'code'=>'1',
				'msg'=>'err',
				'data'=>$jsApiParameters['return_msg']
			);
			return $data_bak;
		}
	}

	private function addCommission($uid, $c, $uniacid, $oid)
	{
		$utn = sl_table_name('user',TRUE);
		$lock = self::getCommissionLock($uid);
		try {
			$lock->lock();
			pdo_insert(sl_table_name('log'), ['uniacid' => $uniacid, 'type' => 4, 'user_id' => $uid,
				'money' => bcmul($c, 100), 'create' => time(), 'order_id' => $oid]);
			pdo_query("UPDATE $utn SET commission = commission + $c WHERE id = $uid");
			$lock->unlock();
		} catch (Exception $e) {
			$lock->unlock();
		}
	}

	private function addBuyCommission($uid, $money, $uniacid, $oid)
	{
		$userRelation = pdo_get(sl_table_name('user_relation'), ['lower' => $uid], ['upper', 'upperupper']);
		if (empty($userRelation)) return;

		$rates = pdo_get(sl_table_name('system_settings'), ['uniacid' => $uniacid], ['royalty_rate', 'royalty_rate2']);

		$upper = $userRelation['upper'];
		$c = bcdiv(bcmul($money, $rates['royalty_rate'], 2), 1000, 2);
		self::addCommission($upper, $c, $uniacid, $oid);

		$upperUpper = $userRelation['upperupper'];
		if (!empty($upperUpper)) {
			$c = bcdiv(bcmul($money, $rates['royalty_rate2'], 2), 1000, 2);
			self::addCommission($upperUpper, $c, $uniacid, $oid);
		}
	}

	private function coupon_data_format($data)
	{
		global $_GPC, $_W;

		$data_bak = [];
		$data_bak['intro']            = $data['intro'];
		$data_bak['thumb']            = $data['thumb'];
		$data_bak['thumb_url']        = tomedia($data['thumb']);
		$data_bak['enough']           = $data['enough'];
		$data_bak['timelimit']        = $data['timelimit'];
		$data_bak['backtype']         = $data['backtype'];
		$data_bak['backmoney']        = $data['backmoney'];
		$data_bak['backmoney_format'] = number_format($data['backmoney'] / 100, 2);
		$data_bak['discount']         = $data['discount'];

		if ($data['timelimit']=='0') {
			if ($data['timedays1'] == '0') {
				$data_bak['use_end_time'] = '无使用期限制';
				$data_bak['usable'] = '1';
			} else {
				try {
					$datetime1 = new DateTime($data['time_start']);
					$datetime2 = new DateTime($data['time_end']);
					// $interval = $datetime1->diff($datetime2);
					// $data_bak['use_end_time'] = $interval->format('有效期 %a 天');
					$data_bak['use_end_time'] = $datetime1->format('Y-m-d').' 至 '.$datetime2->format('Y-m-d');
				} catch (Exception $e) {}
			}
		} else {
			try {
				$datetime1 = new DateTime($data['time_start']);
				$datetime2 = new DateTime($data['time_end']);
				$data_bak['use_end_time'] = $datetime1->format('Y-m-d').' 至 '.$datetime2->format('Y-m-d');
			} catch (Exception $e) {}
		}

		$timestart = strtotime($data['time_start']);
		$timeend = strtotime($data['time_end']);
		// 是否可用
		if ($_W['slwl']['datetime']['timestamp'] > $timestart && $_W['slwl']['datetime']['timestamp'] < $timeend) {
			$data_bak['usable'] = '1';
		} else {
			$data_bak['usable'] = '0';
		}

		return $data_bak;
	}

	public function doPageSl_test()
	{
	}

	// 获取服务器时间和门店信息
	public function doPageSL_getScheduleCfg()
	{
		global $_GPC, $_W;

		$id = $_GPC['id'];

		$data_bak = [
			'timestamp'=>$_W['slwl']['datetime']['timestamp'],
		];

		if ($id) {
			$where = [
				'uniacid' => $_W['uniacid'],
				'id'      => $id,
			];
			$storeInfo = pdo_get(sl_table_name('store'), $where);
			if (empty($storeInfo)) {
				sl_ajax(1, '门店不存在');
			}
			$storeInfo['image'] = tomedia($storeInfo['image']);
			if ($storeInfo['coordinate']) {
				$tmp_coordinate = json_decode($storeInfo['coordinate'], TRUE);
				$storeInfo['coordinate_format'] = $tmp_coordinate;
			}

			$data_bak['store_info'] = $storeInfo;
		}

		sl_ajax(0, $data_bak);
	}

	/**
	 * 获取门店信息
	 */
	public function doPageStoreInfo()
	{
		global $_GPC, $_W;

		$id = $_GPC['id'];

		$where = [
			'uniacid' => $_W['uniacid'],
			'id'      => $id,
		];
		$storeInfo = pdo_get(sl_table_name('store'), $where);
		if (empty($storeInfo)) {
			sl_ajax(1, '门店不存在');
		}

		$storeInfo['image'] = tomedia($storeInfo['image']);

		if ($storeInfo['coordinate']) {
			$tmp_coordinate = json_decode($storeInfo['coordinate'], TRUE);
			$storeInfo['coordinate_format'] = $tmp_coordinate;
		}

		sl_ajax(0, $storeInfo);
	}

	// 获取用户信息
	public function doPageSL_get_user()
	{
		global $_GPC, $_W;

		$ver = $_GPC['ver'];
		$uid = intval($_GPC['uid']);
		if (empty($ver)) { sl_ajax(1, '版本号为空'); }
		if (empty($uid)) { sl_ajax(1, '用户为空'); }

		// 用户信息
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		$user['unlimitedEnd'] = $user['due_time'];
		if ($_W['slwl']['datetime']['timestamp'] > $user['due_time']) {
			$user['unlimitedExpired'] = '1';
		} else {
			$user['unlimitedExpired'] = '0';
		}
		if (!empty($user['member_level_id']))
			$user['memberLevelName'] = pdo_getcolumn(sl_table_name('member_level'), ['id' => $user['member_level_id']], 'name');

		$time = time();
		$sql = "SELECT uc.id,uc.type,uc.left_times,uc.times,mc.course_id,uc.due_time,mc.name FROM "
			. sl_table_name('user_card',TRUE)
			. " AS uc " .
			"LEFT JOIN " . sl_table_name('member_card',TRUE) . " AS mc ON mc.id = uc.card_id " .
			"WHERE uc.user_id = ${user['id']} AND (" .
			"((uc.type = 3 OR uc.type = 5) AND uc.delete='0' AND uc.left_times > 0 AND (uc.due_time IS NULL OR uc.due_time > $time))" .
			") ORDER BY uc.due_time IS NULL,uc.due_time,uc.left_times";
		$user['cards'] = pdo_fetchall($sql);


		if ($user['cards']) {
			// 课程ID
			$flags = '';
			foreach ($user['cards'] as $k => $v) {
				if ($v['course_id']) {
					$flags .= $v['course_id'] . ',';
				}
			}
			$flags = substr($flags, 0, strlen($flags)-1);
			$where = '';
			if ($flags) {
				$where =' AND id IN(' . $flags . ')';
			}

			$condition_course = " AND uniacid=:uniacid ";
			$condition_course .= $where;
			$params_course = array(':uniacid' => $_W['uniacid']);
			$list_course = pdo_fetchall('SELECT * FROM ' . sl_table_name('course',TRUE) . ' WHERE 1 '
				. $condition_course . " ORDER BY id DESC", $params_course);

			if ($list_course) {
				foreach ($user['cards'] as $k => $v) {
					foreach ($list_course as $key => $value) {
						if ($v['course_id'] == $value['id']) {
							$user['cards'][$k]['course'] = $value;
						}
					}
				}
			}
		}

		unset($user['openid']);
		sl_ajax(0, $user);
	}

	// 获取系统设置
	public function doPageSmk_config()
	{
		// sys_config();

		global $_GPC, $_W;

		$store_id = $_GPC['ssid'];

		// 通用设置
		$general = self::getSystemSettings($_W['uniacid']);
		$settings = $general;

		$settings['config'] = [];

		$settings['intro'] = $settings['introduction'];
		unset($settings['introduction']);

		// 获取门店
		$where = ['uniacid'=>$_W['uniacid'], 'id'=>$store_id, 'delete'=>'0'];
		$one_store = pdo_get(sl_table_name('store'), $where);

		if (empty($one_store)) {
			$where = ['uniacid'=>$_W['uniacid'], 'delete'=>'0'];
			$one_store = pdo_get(sl_table_name('store'), $where);
		}
		if ($one_store) {
			$one_store['image'] = tomedia($one_store['image']);
			if ($one_store['coordinate']) {
				$tmp_coordinate = json_decode($one_store['coordinate'], TRUE);
				$one_store['coordinate_format'] = $tmp_coordinate;
			}
			$settings['store'] = $one_store;
		}


		// 获取程序唯一标识
		$sys_id = $_W['uniacid'];
		$account = uni_fetch($sys_id);
		$appid = $account['key'];
		$settings['appid'] = $appid;

		// 系统基本设置
		if ($_W['slwl']['set']['site_settings']) {
			$set_str = $_W['slwl']['set']['site_settings'];

			$set_str['thumb_url'] = tomedia($set_str['thumb']);
			$set_str['logo_url'] = tomedia($set_str['logo']);
			$set_str['consult_img_url'] = tomedia($set_str['consult_img']);
			$set_str['dynamic_img_url'] = tomedia($set_str['dynamic_img']);

			$set_str['server_msg'] = isset($set_str['server_msg'])? $set_str['server_msg']:'0';
			$set_str['consult'] = isset($set_str['consult'])? $set_str['consult']:'0';

			$settings['config'] = $set_str;
		}

		// 版权设置
		$settings['cpright'] = array();
		if ($_W['slwl']['set']['cpright_site_settings']) {
			$set_cp = $_W['slwl']['set']['cpright_site_settings'];

			$set_cp['logo_url'] = tomedia($set_cp['logo']);
		} else {
			$set_cp['cpright_show'] = '0';
		}
		$settings['cpright'] = $set_cp;

		// 颜色
		$settings['color'] = array();
		if ($_W['slwl']['set']['site_color_settings']) {
			$set_color = $_W['slwl']['set']['site_color_settings'];

			if ($set_color['topcolor'] == '') { $set_color['topcolor'] = '#ffffff'; }

			if (empty($set_color['maincolor'])) { $set_color['maincolor'] = '#4a86e8'; }
			if (empty($set_color['subcolor'])) { $set_color['subcolor'] = '#0b5394'; }
			if (empty($set_color['bottomcolor'])) { $set_color['bottomcolor'] = '#ffffff'; }
			if (empty($set_color['bottomfontcolor'])) { $set_color['bottomfontcolor'] = '#333333'; }
			if (empty($set_color['bottomfonthovercolor'])) { $set_color['bottomfonthovercolor'] = '#4a86e8'; }

			$settings['color'] = $set_color;
		} else {
			$settings['color'] = array(
				'topcolor'=>'#ffffff',
				'maincolor'=>'#4a86e8',
				'subcolor'=>'#0b5394',
				'bottomcolor'=>'#ffffff',
				'bottomfontcolor'=>'#333333',
				'bottomfonthovercolor'=>'#4a86e8',
			);
		}

		// 小程序列表
		$condition_mod_wxapp = ' AND uniacid=:uniacid ';
		$params_mod_wxapp = [':uniacid' => $_W['uniacid']];
		$sql_mod_wxapp = "SELECT * FROM " . sl_table_name('mod_wxapp',TRUE). ' WHERE 1 ' . $condition_mod_wxapp;
		$list_mod_wxapp = pdo_fetchall($sql_mod_wxapp, $params_mod_wxapp);

		$settings['wxapp'] = $list_mod_wxapp;

		// 底部导航
		$settings['menus'] = [];
		if ($_W['slwl']['set']['set_menus']) {
			$set_menus = $_W['slwl']['set']['set_menus'];

			if ($set_menus['items']) {
				foreach ($set_menus['items'] as $key => $value) {
					$set_menus['items'][$key]['attachment_format'] = tomedia($value['attachment']);
					$set_menus['items'][$key]['pic_highlight_format'] = tomedia($value['pic_highlight']);
					unset($set_menus['items'][$key]['attachment']);
					unset($set_menus['items'][$key]['pic_highlight']);
				}
			}

			$settings['menus']['items'] = $set_menus['items'];
			$settings['menus']['enabled'] = $set_menus['enabled'];
		} else {
			$settings['menus']['items'] = [];
			$settings['menus']['enabled'] = 0;
		}

		sl_ajax(0, $settings);
	}

	// 微信-创建用户
	public function doPageSmk_create_user()
	{
		global $_GPC, $_W;
		load()->func('communication');

		$code = $_GPC['code'];
		$id_invite = intval($_GPC['invite']); // 邀请人

		$wx_appid   = @$_W['account']['key'];
		$wx_secret  = @$_W['account']['secret'];

		$url = "https://api.weixin.qq.com/sns/jscode2session?appid={$wx_appid}&secret={$wx_secret}";
		$url .= "&js_code={$code}&grant_type=authorization_code";

		$resp = ihttp_request($url);
		$result = @json_decode($resp['content']);

		if (property_exists($result, 'openid')) {
			$openid = $result->openid;
			$session_key = $result->session_key;

			$rst = $this->save_session_key($session_key);
			if ($rst['return_code'] == '1') {
				sl_ajax(1, '保存session_key出错');
			}

			$data = array(
				'uniacid'       => $_W['uniacid'],
				'openid'        => $openid,
				'nickname'      => json_encode($_GPC['nicename']),
				'avatar'        => $_GPC['avatar'],
				// 'province'      => $_GPC['province'],
				// 'city'          => $_GPC['city'],
				'gender'        => $_GPC['gender'],
				'register_time' => $_W['slwl']['datetime']['timestamp'],
				'last_time'     => $_W['slwl']['datetime']['timestamp'],
			);

			$one = pdo_fetch("SELECT * FROM " . sl_table_name('user',TRUE)
				. " where openid=:openid AND uniacid=:uniacid", array(":openid" => $openid, ":uniacid" => $_W['uniacid']));


			if (empty($one)) {
				$nickname_select = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $nickname);
				if ($nickname_select) {
					$nickname_select = trim($nickname_select);
				}
				$data['nickname_select'] = $nickname_select;

				$data['create_time'] = $_W['slwl']['datetime']['now'];
				pdo_insert(sl_table_name('user'), $data);
				$id = pdo_insertid(); // 用户ID

				if ($id_invite) {
					$rst = sl_jsf_commission_post($id, $id_invite); // 添加分销关系

					if ($rst && $rst['code'] != 0) {
						sl_ajax(1, '添加分销关系失败'.$rst['msg']);
					}
				}

				$data['id'] = $id;
				unset($data['openid']);

				$user_one = $data;
			} else {
				unset($one['openid']);
				$user_one = $one;
			}

			$user = pdo_get(sl_table_name('user'), ['id' => $user_one['id']]);
			if (empty($user)) {
				sl_ajax(1, '用户不存在');
			}

			// $user['due_time'] = empty($user['due_time']) ? '' : date('Y-m-d', $user['due_time']);
			$user['unlimitedEnd'] = $user['due_time'];
			if ($_W['slwl']['datetime']['timestamp'] > $user['due_time']) {
				$user['unlimitedExpired'] = '1';
			} else {
				$user['unlimitedExpired'] = '0';
			}
			if (!empty($user['member_level_id']))
				$user['memberLevelName'] = pdo_getcolumn(sl_table_name('member_level'), ['id' => $user['member_level_id']], 'name');

			$time = time();
			$sql = "SELECT uc.id,uc.type,uc.left_times,uc.times,mc.course_id,uc.due_time,mc.name FROM "
				. sl_table_name('user_card',TRUE) . " AS uc " .
				"LEFT JOIN " . sl_table_name('member_card',TRUE) . " AS mc ON mc.id = uc.card_id " .
				"WHERE uc.user_id = {$user['id']} AND (" .
				"((uc.type = 3 OR uc.type = 5) AND uc.left_times > 0 AND (uc.due_time IS NULL OR uc.due_time > $time))" .
				") ORDER BY uc.due_time IS NULL,uc.due_time,uc.left_times";
			$user['cards'] = pdo_fetchall($sql);


			if ($user['cards']) {
				// 课程ID
				$flags = '';
				foreach ($user['cards'] as $k => $v) {
					if ($v['course_id']) {
						$flags .= $v['course_id'] . ',';
					}
				}
				$flags = substr($flags, 0, strlen($flags)-1);
				$where = '';
				if ($flags) {
					$where =' AND id IN(' . $flags . ')';
				}

				$condition_course = " AND uniacid=:uniacid ";
				$condition_course .= $where;
				$params_course = array(':uniacid' => $_W['uniacid']);
				$list_course = pdo_fetchall('SELECT * FROM ' . sl_table_name('course',TRUE) . ' WHERE 1 '
					. $condition_course . " ORDER BY id DESC", $params_course);

				if ($list_course) {
					foreach ($user['cards'] as $k => $v) {
						foreach ($list_course as $key => $value) {
							if ($v['course_id'] == $value['id']) {
								$user['cards'][$k]['course'] = $value;
							}
						}
					}
				}
			}

			$data_update = [
				'last_time'=>$_W['slwl']['datetime']['timestamp'],
			];
			pdo_update(sl_table_name('user'), $data_update, ['id'=>$user['id']]); // 最后访问时间

			unset($user['openid']);
			sl_ajax(0, $user);
		} else {
			sl_ajax(1, '操作失败1');
		}

	}

	// 获取首页数据
	public function doPageSL_index()
	{
		// index_data();

		global $_GPC, $_W;
		$uid = intval($_GPC['uid']);

		$ssid = trim($_GPC['ssid']); // 门店ID

		// 推荐课程
		$tmp_ssid = '%"'.$ssid.'"%';
		$where = [
			'uniacid'         => $_W['uniacid'],
			'recommend >'     => 0,
			'delete'          => 0,
			'store_info LIKE' => $tmp_ssid,
		];
		$order_by = ['recommend DESC','id DESC'];
		$res = pdo_getall(sl_table_name('course'), $where,'', '', $order_by);

		$list_index['quick'] = [];
		if (!empty($res)) {
			$tn = sl_table_name('course_member_level');

			$level = pdo_getcolumn(sl_table_name('user'), ['id'=>$uid], 'member_level_id');
			foreach ($res as $key => &$row) {
				$row['video'] = tomedia($row['video']);
				$row['show_image_format'] = tomedia($row['show_image']);
				$row['video_image_format'] = tomedia($row['video_image']);
				$slides = explode(',', $row['slides']);
				foreach ($slides as &$s) {
					$s = tomedia($s);
				}
				$row['slides'] = $slides;

				$all = pdo_getall($tn, ['course_id' => $row['id']]);
				if (!empty($all)) {
					foreach ($all as $value) {
						if ($value['member_level_id'] == $level) {
							continue 2;
						}
					}
					unset($res[$key]);
				}
			}
			$res = array_values($res);
			$systemIdList = sl_array_column($res, 'system_id');
			$where_id_list = [
				'uniacid' => $_W['uniacid'],
				'id IN'   => $systemIdList,
			];
			$order_by_id_list = ['id DESC'];
			$systems = pdo_getall(sl_table_name('course_system'), $where_id_list,'', '', $order_by_id_list);

			if ($systems) {
				foreach ($systems as $k => $v) {
					$systems[$k]['image_format'] = tomedia($v['image']);
					$systems[$k]['icon_format'] = tomedia($v['icon']);
				}

				foreach ($res as $k => $v) {
					foreach ($systems as $key => $value) {
						if ($v['system_id'] == $value['id']) {
							$res[$k]['course_system'] = $value;
						}
					}
				}
			}

			/** 是否已购买.start */
			$ids_buy = sl_array_column($res, 'id');
			if ($ids_buy) {
				$where_buy = [
					'uniacid'     => $_W['uniacid'],
					'user_id'     => $uid,
					'status'      => '1',
					'type'        => '0',
					'other_id IN' => $ids_buy,
				];
				$list_buy = pdo_getall(sl_table_name('order'), $where_buy);
				if ($list_buy) {
					foreach ($res as $key => $value) {
						$res[$key]['isBuy'] = '0';
						foreach ($list_buy as $k => $v) {
							if ($value['id'] == $v['other_id']) {
								$res[$key]['isBuy'] = '1';
								break;
							}
						}
					}
				} else {
					foreach ($res as $key => $value) {
						$res[$key]['isBuy'] = '0';
					}
				}
			}
			/** 是否已购买.end */
			// $list_index['systems'] = $systems;
		}
		$list_index['courses'] = $res;

		// 快捷菜单
		// if ($_W['slwl']['set']['set_menu_quick']) {
		// 	$set_menu_quick = $_W['slwl']['set']['set_menu_quick'];

		// 	$settings['quick']['items'] = $set_menu_quick['items'];
		// 	$settings['quick']['enabled'] = $set_menu_quick['enabled'];
		// } else {
		// 	$settings['quick']['items'] = array();
		// 	$settings['quick']['enabled'] = 0;
		// }

		// 导航按钮组
		$buttons = [];
		if ($_W['slwl']['set']['set_buttons']) {
			$set_buttons = $_W['slwl']['set']['set_buttons'];

			if ($set_buttons['items']) {
				foreach ($set_buttons['items'] as $key => $value) {
					$set_buttons['items'][$key]['attachment_format'] = tomedia($value['attachment']);
					$set_buttons['items'][$key]['pic_highlight_format'] = tomedia($value['pic_highlight']);
					unset($set_buttons['items'][$key]['attachment']);
					unset($set_buttons['items'][$key]['pic_highlight']);
				}
			}

			$buttons['items'] = $set_buttons['items'];
			$buttons['enabled'] = $set_buttons['enabled'];
			$buttons['rownum'] = $set_buttons['rownum'];
		} else {
			$buttons['items'] = [];
			$buttons['enabled'] = 0;
			$buttons['rownum'] = 4;
		}
		$list_index['buttons'] = $buttons;

		// banner
		$condition_adv = " AND uniacid=:uniacid AND enabled='1' AND store_info LIKE :store_info ";
		$params_adv = [':uniacid' => $_W['uniacid'], ':store_info'=>$tmp_ssid];
		$psize_adv = 10;

		$list_adv = pdo_fetchall('SELECT * FROM ' . sl_table_name('adv',TRUE) . ' WHERE 1 '
			. $condition_adv . ' ORDER BY displayorder DESC, id DESC limit 0,' . $psize_adv, $params_adv);

		if ($list_adv) {
			foreach ($list_adv as $k => $v) {
				$list_adv[$k]['thumb_format'] = tomedia($v['thumb']);
			}
		}
		$list_index['banner'] = $list_adv;

		sl_ajax(0, $list_index);
	}

	/**
	 * 获取教练信息
	 */
	public function doPageCoachInfo()
	{
		global $_GPC, $_W;

		$id = $_GPC['id'];
		$uid = intval($_GPC['uid']);

		$uniacidConArr = ['uniacid'=>$_W['uniacid'],'id'=>$id];
		$coachInfo = pdo_get(sl_table_name('coach'), $uniacidConArr);
		if (empty($coachInfo)) {
			sl_ajax(1, '教练不存在');
		}

		$coachInfo['avatar_format'] = tomedia($coachInfo['avatar']);
		$coachInfo['video_format'] = tomedia($coachInfo['video']);

		if ($uid) {
			$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'balance', 'real_name', 'tel']);
			if ($user) {
				$coachInfo['bought'] = pdo_exists(sl_table_name('private_coach_buy'),
					['coach_id' => $id, 'user_id' => $user['id']]);
			}
		}

		// 订阅消息-模板
		$where = [
			'uniacid'       => $_W['uniacid'],
			'tpl_type'      => 'buy_coach_video',
			'delete_status' => 0,
		];
		$field = ['id', 'tpl_id'];
		$list_tpl = pdo_getall(sl_table_name('tpl_rss'), $where, $field);

		if ($list_tpl) {
			$tmplIds = [];
			foreach ($list_tpl as $key => $value) {
				array_push($tmplIds, $value['tpl_id']);
			}
		}

		$coachInfo['tmplIds'] = $tmplIds;

		sl_ajax(0, $coachInfo);
	}

	/**
	 * 获取课程预约信息
	 */
	public function doPageBookInfo()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$id = $_GPC['id'];
		if (empty($id)) {
			sl_ajax(1, '课程ID不存在');
		}

		$ssid = trim($_GPC['ssid']); // 门店ID
		$tmp_ssid = '%"'.$ssid.'"%';

		$this->finishOrder();

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$uniacidConStr = " cp.uniacid='$sluni' ";
		$cptn = sl_table_name('course_plan',TRUE);
		$catn = sl_table_name('coach',TRUE);
		$stn = sl_table_name('store',TRUE);
		$ctn = sl_table_name('course',TRUE);
		$otn = sl_table_name('order',TRUE);
		$fields = "cp.id, c.id AS cid,c.show_image AS `show`,c.name AS course,cp.price,cp.novice_price," .
			"cp.can_queue, cp.number, cp.left_tip, cp.booked_number, cp.course_id," .
			"cp.start,cp.end,cp.book_end,cp.book_start,o.type,o.subtype,o.other_id,".
			"ca.name AS coach,ca.avatar,ca.simple,ca.id AS coachId," .
			"s.name AS store,s.id AS storeId,c.details_enabled," .
			"o.sn AS sn,o.status,o.id AS oid";
		$sql = "SELECT $fields FROM $cptn AS cp LEFT JOIN $ctn AS c ON cp.course_id = c.id " .
			"LEFT JOIN $catn AS ca ON cp.coach_id = ca.id " .
			"LEFT JOIN $stn AS s ON s.id = cp.store_id " .
			"LEFT JOIN $otn AS o ON o.plan_id = cp.id AND (o.status = 1 OR o.status = 5) AND o.user_id = {$user['id']} " .
			"WHERE cp.id = $id AND $uniacidConStr";
		$planInfo = pdo_fetch($sql);
		if (empty($planInfo)) {
			sl_ajax(1, '课程预约信息不存在');
		}

		$paymentWays = pdo_getall(sl_table_name('course_payment_way'), ['course_id' => $planInfo['cid']]);
		if (empty($paymentWays)) {
			$paymentWays = [0 => TRUE, 1 => TRUE, 2 => TRUE, 3 => TRUE, 5 => TRUE];
		} else {
			$data = [];
			foreach ($paymentWays as $way) {
				$data[$way['payment_way']] = TRUE;
			}
			$paymentWays = $data;
		}

		if ($planInfo['subtype'] == '0') {
			$planInfo['pay_way'] = [
				'id'=>'0',
				'cn'=>'微信或余额支付',
				'balance'=>$user['balance'],
			];

		} else if ($planInfo['subtype'] == '1') {
			$planInfo['pay_way'] = [
				'id'=>'1',
				'cn'=>'时间卡',
				'due_time'=>date('Y-m-d', $user['due_time']),
			];

		} else {
			// if ($planInfo['other_id']) {
			// 	$condition = " AND uniacid=:uniacid AND id=:id ";
			// 	$params = array(':uniacid' => $_W['uniacid'], ':id' => $planInfo['other_id']);
			// 	$one = pdo_fetch('SELECT * FROM ' . sl_table_name('member_card',TRUE) . ' WHERE 1 ' . $condition, $params);

			// 	if (empty($one)) {
			// 		sl_ajax(1, '卡片不存在');
			// 	}
			// 	$planInfo['pay_way'] = [
			// 		'id'=>'2',
			// 		'card_name'=>$one['name'],
			// 		'card_id'=>$one['id'],
			// 	];
			// }
		}

		foreach ($paymentWays as $key => $way) {
			switch ($key) {
				//微信支付
				case 0:
					$paymentWays[$key] = ['balance' => $user['balance']];
					break;

				//时间卡
				case 1:
					if ($user['due_time'] >= $planInfo['end'] && time() <= $planInfo['book_end']) {
						$paymentWays[$key] = ['due_time' => date('Y-m-d', $user['due_time'])];
					} else {
						unset($paymentWays[$key]);
					}
					break;

				//次卡
				case 2:
					if ($user['left_times'] > 0 && time() <= $planInfo['book_end']) {
						$paymentWays[$key] = ['left_times' => $user['left_times']];
					} else {
						unset($paymentWays[$key]);
					}
					break;

				//课程次卡
				case 3:
				//限时次卡
				case 5:
					$card = pdo_fetch("SELECT left_times,id,due_time FROM " . sl_table_name('user_card',TRUE) .
						" WHERE user_id = ${user['id']} AND `type` = $key AND (due_time >= ${planInfo['book_end']} OR due_time IS NULL)" .
						" AND left_times > 0 ORDER BY due_time IS NULL,due_time,left_times");
					if (empty($card)) unset($paymentWays[$key]);
					else {
						$paymentWays[$key] = ['left_times' => $card['left_times'], 'ucid' => $card['id']];
						if ($key == 5) $paymentWays[$key]['due_time'] = date('Y-m-d', $card['due_time']);
					}
					break;
			}
		}
		$planInfo['paymentWays'] = $paymentWays;

		$planInfo['show_format'] = tomedia($planInfo['show']);
		$planInfo['avatar_format'] = tomedia($planInfo['avatar']);
		$planInfo['cname'] = $user['real_name'];
		$planInfo['ctel'] = $user['tel'];
		$planInfo['balance'] = $user['balance'];
		$planInfo['charge_book'] = self::getZdyOne($_W['uniacid'], 'charge_book');

		// 课程
		if ($planInfo['cid']) {
			$condition_course = " AND uniacid=:uniacid AND `delete`='0' AND id=:id ";
			$params_course = array(':uniacid' => $_W['uniacid'], ':id'=>$planInfo['cid']);
			$one_course = pdo_fetch('SELECT * FROM ' . sl_table_name('course',TRUE) . ' WHERE 1 ' . $condition_course, $params_course);

			if ($one_course) {
				$one_course['show_image_format'] = tomedia($one_course['show_image']);
				$planInfo['course'] = $one_course;
			}
		}

		// 教练
		if ($planInfo['coachId']) {
			$condition_coach = " AND uniacid=:uniacid AND `delete`='0' AND id=:id ";
			$params_coach = array(':uniacid' => $_W['uniacid'], ':id'=>$planInfo['coachId']);
			$one_coach = pdo_fetch('SELECT * FROM ' . sl_table_name('coach',TRUE) . ' WHERE 1 ' . $condition_coach, $params_coach);

			if ($one_coach) {
				$one_coach['avatar_format'] = tomedia($one_coach['avatar']);
				$planInfo['coach'] = $one_coach;
			}
		}

		// 门店信息
		if ($planInfo['storeId']) {
			$condition_store = " AND uniacid=:uniacid AND `delete`='0' AND id=:id ";

			$params_store = array(':uniacid' => $_W['uniacid'], ':id'=>$planInfo['storeId']);
			$one_store = pdo_fetch('SELECT * FROM ' . sl_table_name('store',TRUE) . ' WHERE 1 ' . $condition_store, $params_store);

			if ($one_store) {
				$one_store['image_format'] = tomedia($one_store['image']);
				$planInfo['store'] = $one_store;
			}
		}

		// 会员等级.start
		// 获取所有会员等级
		$condition_all_member_level = " AND uniacid=:uniacid AND `delete`='0' ";
		$params_all_member_level = array(':uniacid' => $_W['uniacid']);
		$list_all_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('member_level',TRUE) . ' WHERE 1 '
			. $condition_all_member_level, $params_all_member_level);

		$list_all_member_level[] = [
			'id'=>'0',
			'name'=>'普通会员',
		];


		$condition_member_level = " AND uniacid=:uniacid AND course_id=:course_id ";
		$params_member_level = array(':uniacid' => $_W['uniacid'], ':course_id'=>$planInfo['course_id']);
		$list_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('course_member_level',TRUE) . ' WHERE 1 '
			. $condition_member_level . " ORDER BY id DESC", $params_member_level);

		if ($list_member_level) {
			foreach ($list_member_level as $k => $v) {
				$planInfo['course']['member_level'][] = $v['member_level_id'];
			}
		} else {
			foreach ($list_all_member_level as $key => $value) {
				$planInfo['course']['member_level'][] = $value['id'];
			}
		}
		// 会员等级.end


		// 支付方式.start
		$list_all_payment_way = $_W['slwl']['pay_way'];

		$condition_payment_way = " AND uniacid=:uniacid AND course_id=:course_id ";
		$params_payment_way = array(':uniacid' => $_W['uniacid'], ':course_id'=>$planInfo['course_id']);
		$list_payment_way = pdo_fetchall('SELECT * FROM ' . sl_table_name('course_payment_way',TRUE) . ' WHERE 1 '
			. $condition_payment_way . " ORDER BY id DESC", $params_payment_way);

		if ($list_payment_way) {
			foreach ($list_payment_way as $k => $v) {
				foreach ($list_all_payment_way as $key => $value) {
					if ($v['payment_way'] == $value['id']) {
						$list_payment_way[$k]['way'] = $value['way'];
						break;
					}
				}
			}

			foreach ($list_payment_way as $k => $v) {
				$planInfo['course']['payment_way'][] = $v['way'];
			}
		} else {
			foreach ($list_all_payment_way as $k => $v) {
				$planInfo['course']['payment_way'][] = $v['way'];
			}
		}
		// 支付方式.end

		// 排队数
		$condition_book_queue = " AND uniacid=:uniacid AND plan_id=:plan_id ";
		$params_book_queue = array(':uniacid' => $_W['uniacid'], ':plan_id' => $planInfo['id']);
		$list_book_queue = pdo_fetchall('SELECT id,user_id FROM ' . sl_table_name('book_queue',TRUE) . ' WHERE 1 '
			. $condition_book_queue, $params_book_queue);

		if ($list_book_queue) {
			foreach ($list_book_queue as $k => $v) {
				if ($v['user_id'] == $uid) {
					$planInfo['myQueueID'] = $v['id'];
					break;
				}
			}
		}
		$planInfo['queue_number'] = count($list_book_queue);

		// 订阅消息-模板
		$where = [
			'uniacid'       => $_W['uniacid'],
			'tpl_type IN'      => ['course_reserve', 'course_queue'],
			'delete_status' => 0,
		];
		$field = ['id', 'tpl_id'];
		$list_tpl = pdo_getall(sl_table_name('tpl_rss'), $where, $field);

		if ($list_tpl) {
			$tmplIds = [];
			foreach ($list_tpl as $key => $value) {
				array_push($tmplIds, $value['tpl_id']);
			}
		}

		$planInfo['tmplIds'] = $tmplIds;

		sl_ajax(0, $planInfo);
	}

	/**
	 * 预约付款
	 */
	public function doPagePay2()
	{
		global $_GPC, $_W;

		$ver = $_GPC['ver'];
		$uid = intval($_GPC['uid']);
		if (empty($ver)) { sl_ajax(1, '版本号为空'); }
		if (empty($uid)) { sl_ajax(1, '用户为空'); }

		$ssid = trim($_GPC['ssid']); // 门店ID
		$time = $_W['slwl']['datetime']['timestamp'];

		$param_json = $_GPC['__input']; // 参数

		$cid = ''; // 课程ID
		$ucid = ''; // 卡ID，次卡是用
		$pay_way = ''; // 支付方式
		$real_name = ''; // 真实姓名
		$tel = ''; // 电话
		$coupon_id = ''; // 优惠券ID
		$form_id = ''; // formID

		if ($param_json) {
			$cid = isset($param_json['cid']) ? trim($param_json['cid']) : '';
			$ucid = isset($param_json['ucid']) ? trim($param_json['ucid']) : '';
			$pay_way = isset($param_json['way']) ? trim($param_json['way']) : '';
			$real_name = isset($param_json['name']) ? trim($param_json['name']) : '';
			$tel = isset($param_json['tel']) ? trim($param_json['tel']) : '';
			$coupon_id = isset($param_json['couponId']) ? trim($param_json['couponId']) : '';
			$form_id = isset($param_json['formID']) ? trim($param_json['formID']) : '';
		}

		if (empty($cid)) { sl_ajax(1, '课程ID为空'); }
		if (empty($real_name)) { sl_ajax(1, '姓名不能为空'); }
		if (empty($pay_way)) { sl_ajax(1, '支付方式不能为空'); }
		if (empty($tel)) {
			sl_ajax(1, '电话不能为空');
		} else {
			$g = "/^1[345678]\d{9}$/";
			if (!(preg_match($g, $tel))) {
				sl_ajax(1, '请输入一个合法的手机号');
			}
		}

		// // 查询有没有重复约课
		// $one_order = pdo_get(sl_table_name('course_plan'), ['user_id' => $uid, 'plan_id' => $cid]);
		// if ($one_order) {
		//     # code...
		// }

		// 用户信息
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		// 课表信息
		$course_plan = pdo_get(sl_table_name('course_plan'), array('id' => $cid));

		if ($course_plan['number'] <= $course_plan['booked_number']) {
			sl_ajax(1, '预约已满');
		}
		if ($time >= $course_plan['book_end']) {
			sl_ajax(1, '已经停止约课');
		}

		// 课程信息
		$course = pdo_get(sl_table_name('course'), array('id' => $course_plan['course_id']));
		if (empty($course)) {
			sl_ajax(1, '课程为空');
		}

		$slides = explode(',', $course['slides']);
		foreach ($slides as &$s) {
			$s = tomedia($s);
		}
		$course['slides'] = $slides;
		$course['show_image_format'] = tomedia($course['show_image']);

		// 订单信息
		$order_info = $course_plan;
		$order_info['course'] = $course;
		$order_info['user'] = $user;

		// // 会员等级限定
		// $course_member_level = pdo_getall(sl_table_name('course_member_level'), ['course_id' => $course_plan['course_id']]);
		// if ($course_member_level) {
		// 	$member_level_ok = FALSE;
		// 	foreach ($course_member_level as $key => $value) {
		// 		if ($value['member_level_id'] == $user['member_level_id']) {
		// 			$member_level_ok = TRUE;
		// 			break;
		// 		}
		// 	}
		// 	if (!$member_level_ok) {
		// 		sl_ajax(1, '当前会员等级不能约课，请升级会员等级');
		// 	}
		// }

		// 教练.start
		if ($course_plan['coach_id']) {
			$condition_coach = " AND uniacid=:uniacid AND `delete`='0' AND id=:id ";
			$params_coach = array(':uniacid' => $_W['uniacid'], ':id'=>$course_plan['coach_id']);
			$one_coach = pdo_fetch('SELECT * FROM ' . sl_table_name('coach',TRUE)
				. ' WHERE 1 ' . $condition_coach, $params_coach);

			if ($one_coach) {
				$one_coach['avatar_format'] = tomedia($one_coach['avatar']);
				$order_info['coach'] = $one_coach;
			}
		}
		// 教练.end

		// 门店信息.start
		if ($course_plan['store_id']) {
			$condition_store = " AND uniacid=:uniacid AND `delete`='0' AND id=:id ";

			$params_store = array(':uniacid' => $_W['uniacid'], ':id'=>$course_plan['store_id']);
			$one_store = pdo_fetch('SELECT * FROM ' . sl_table_name('store',TRUE)
				. ' WHERE 1 ' . $condition_store, $params_store);

			if ($one_store) {
				$one_store['image_format'] = tomedia($one_store['image']);

				if ($one_store['coordinate']) {
					$tmp_coordinate = json_decode($one_store['coordinate'], TRUE);
					$one_store['coordinate_format'] = $tmp_coordinate;
				}

				$order_info['store'] = $one_store;
			}
		}
		// 门店信息.end

		// 支付方式.start
		$list_all_payment_way = $_W['slwl']['pay_way'];

		foreach ($list_all_payment_way as $k => $v) {
			if ($v['way'] == $pay_way) {
				$order_info['pay_way'] = $v;
				break;
			}
		}
		// 支付方式.end

		$order_sn = 'SLWL' . $_W['slwl']['datetime']['nowYmdHis'] . str_pad('1', 6, '0', STR_PAD_LEFT);

		$data_update = [];
		if (empty($user['real_name'])) {
			$data_update['real_name'] = $real_name;
		}
		if (empty($user['tel'])) {
			$data_update['tel'] = $tel;
		}
		if ($data_update) {
			pdo_update(sl_table_name('user'), $data_update, ['id' => $uid]);
		}
		$order_info['post'] = ['user'=>$real_name, 'tel'=>$tel];

		// other_id = 课程ID
		$order = [
			'uniacid'     => $_W['uniacid'],
			'user_id'     => $uid,
			'plan_id'     => $cid,
			'create_time' => $time,
			'paid_time'   => $time,
			'type'        => 0,
			'end'         => $course_plan['end'],
			'order_info'  => json_encode($order_info),
			'sn'          => $order_sn,
			'other_id'    => $course['id'],
			'form_id'     => $form_id,
			'store_id'    => $ssid,
		];

		switch ($pay_way) {
			case 'count': // 剩余约课次数
				if ($user['left_times'] < 1) {
					sl_ajax(1, '你的剩余约课次数为0');
				}

				$lock = self::getCoursePlanLock($cid);
				try {
					$lock->lock();
					pdo_begin();
					pdo_insert(sl_table_name('order'), array_merge($order, ['status'=>'1','subtype' => 2]));
					$order_id = pdo_insertid();

					pdo_update(sl_table_name('user'), ['left_times' => $user['left_times'] - 1], ['id' => $user['id']]);

					$data_log = [
						'order_id' => $order_id,
						'type'     => 1,
						'times'    => -1,
						'user_id'  => $user['id'],
						'uniacid'  => $_W['uniacid'],
						'subtype'  => 0,
						'create'   => $time,
					];
					pdo_insert(sl_table_name('log'), $data_log);

					pdo_update(sl_table_name('course_plan'), ['booked_number +='=>'1'], ['id'=>$cid]);

					pdo_commit();
					$lock->unlock();
				} catch (Exception $e) {
					pdo_rollback();
					$lock->unlock();

					sl_ajax(1, '约课更新数据库失败，' . $e->getMessage());
				}
				break;


			case 'unlimited': // 无限次约课权
				if ($user['due_time'] < $course_plan['end']) {
					sl_ajax(1, '你的无限约课到期时间早于该课程的下课时间');
				}

				$lock = self::getCoursePlanLock($cid);

				try {
					$lock->lock();
					pdo_begin();
					pdo_insert(sl_table_name('order'), array_merge($order, ['status'=>'1','subtype'=>'1']));
					$order_id = pdo_insertid();

					pdo_query("UPDATE " . sl_table_name('course_plan',TRUE) . " SET booked_number = booked_number + 1 WHERE id = $cid");
					pdo_commit();
					$lock->unlock();
				} catch (Exception $e) {
					pdo_rollback();
					$lock->unlock();

					sl_ajax(1, '更新数据库失败，' . $e->getMessage());
				}
				break;


			case 'card': // 记次卡

				$leftTimes = pdo_getcolumn(sl_table_name('user_card'), ['id' => $ucid], 'left_times');
				if ($leftTimes < 1) {
					sl_ajax(1, '次卡剩余使用次数为0');
				}

				$lock = self::getCoursePlanLock($cid);
				try {
					$subtype = $_GPC['paymentWay'];
					$lock->lock();
					pdo_begin();
					pdo_insert(sl_table_name('order'), array_merge($order, ['status'=>'1','subtype'=>$subtype, 'other_id'=>$ucid]));
					$order_id = pdo_insertid();

					pdo_update(sl_table_name('user_card'), ['left_times' => $leftTimes - 1], ['id' => $ucid]);

					pdo_insert(sl_table_name('log'), ['order_id' => pdo_insertid(), 'type' => $subtype, 'times' => -1,
						'user_id' => $user['id'], 'uniacid' => $_W['uniacid'], 'subtype' => 0, 'create' => $time,
						'user_card_id' => $ucid]);

					pdo_query("UPDATE " . sl_table_name('course_plan',TRUE) . " SET booked_number = booked_number + 1 WHERE id = $cid");
					pdo_commit();
					$lock->unlock();
				} catch (Exception $e) {
					pdo_rollback();
					$lock->unlock();

					sl_ajax(1, '约课更新数据库失败，' . $e->getMessage());
				}
				break;


			default:
				$fee = $course_plan['price'];

				$discountsCount = 0; // 优惠金额
				// 优惠券
				$one_coupon = []; // 优惠券
				if ($coupon_id) {
					// 我的优惠券
					$condition_coupon_my = " AND uniacid=:uniacid AND user=:user AND id=:id AND status='0' ";
					$params_coupon_my = array(':uniacid' => $_W['uniacid'], ':user'=>$uid, ':id'=>$coupon_id);
					$one_coupon_my = pdo_fetch('SELECT * FROM ' . sl_table_name('coupon_user',TRUE) . ' WHERE 1 ' . $condition_coupon_my, $params_coupon_my);

					if ($one_coupon_my) {
						$condition_coupon = " AND uniacid=:uniacid AND id=:id ";
						$params_coupon = array(':uniacid' => $_W['uniacid'], ':id'=>$one_coupon_my['saleid']);
						$one_coupon = pdo_fetch('SELECT * FROM ' . sl_table_name('coupon',TRUE) . ' WHERE 1 ' . $condition_coupon, $params_coupon);

						if ($one_coupon) {
							if (bcsub($fee, $one_coupon['enough'], 2) < 0) {
								sl_ajax(1, '当前金额不能使用该优惠券');
							}
							if ($one_coupon['backtype'] == '0') {
								$discountsCount = $one_coupon['backmoney'];
							} else if ($one_coupon['backtype'] == '1') {
								$discountsCount = $fee * ((10 - $one_coupon['discount']) / 10);
							}
						} else {
							sl_ajax(1, '优惠券不存在');
						}

						$fee = bcsub($fee, ($discountsCount / 100), 2);
						$couponUsed = TRUE;
					} else {
						sl_ajax(1, '我的优惠券不存在');
					}
				}

				$balance = $user['balance'];

				// 订单添加优惠券信息
				if ($one_coupon) {

					$order_coupon = [];
					if ($one_coupon_my['option_value']) {
						$option = json_decode($one_coupon_my['option_value'], TRUE);
						unset($one_coupon_my['option_value']);
						$tmp_arr_new = array_merge($one_coupon_my, $option);
						$data_format = $this->coupon_data_format($tmp_arr_new);
						$order_coupon = array_merge($one_coupon_my, $data_format);

						$order_info['discount_money'] = $discountsCount;
						$order_info['discount_money_format'] = number_format(($discountsCount / 100), 2);
						// $order_info['from_user'] = $uid;
					}
					$order_info['coupon'] = $order_coupon;
					$order['order_info'] = json_encode($order_info);
				}

				// 余额足够支付
				if ($fee <= $balance) {
					$lock = self::getCoursePlanLock($cid);
					try {
						$lock->lock();
						pdo_begin();

						pdo_insert(sl_table_name('order'), array_merge($order, ['status'=>'1','subtype'=>'0', 'paid_money'=>$fee]));
						$order_id = pdo_insertid();

						$data_log = [
							'order_id' => pdo_insertid(),
							'type'     => 2,
							'money'    => $fee,
							'user_id'  => $uid,
							'uniacid'  => $_W['uniacid'],
							'subtype'  => 0,
							'create'   => $time
						];

						pdo_insert(sl_table_name('log'), $data_log);

						if ($couponUsed) {
							// 修改优惠券状态
							$data_update = array(
								'status'=>'1',
								'price'=>$discountsCount,
							);
							$rst_coupon_my = pdo_update(sl_table_name('coupon_user'), $data_update, ['id'=>$one_coupon_my['id']]);
							if ($rst_coupon_my === FALSE) {
								return result(1, '使用优惠券失败');
							}
						}

						pdo_update(sl_table_name('user'), ['balance'=>$balance - $fee], ['id'=>$uid]);

						pdo_update(sl_table_name('course_plan'), ['booked_number +='=>'1'], ['id'=>$cid]);


						// 分销记录
						$rst = sl_jsf_commission_rebate($uid, $order_id, $fee * 100, 'score');
						if ($rst && $rst['code'] != 0) {
							@putlog('健身房-分销回扣记录', $rst['msg']);
						}

						pdo_commit();
						$lock->unlock();
					} catch (Exception $e) {
						pdo_rollback();
						$lock->unlock();

						sl_ajax(1, '更新数据库失败，' . $e->getMessage());
					}
				} else {
					// 余额不足
					$fee = bcsub($fee, $balance, 2);

					// $tid = date('YmdHis') . substr(md5(rand(10000, 10000000)), 0, 10);

					$rst = self::getPayParams($fee * 100, $order_sn, $user);
					if ($rst['code'] != '0') {
						sl_ajax(1, '生产支付信息失败-' . $rst['msg']);
					}
					$data_bak['payParam'] = json_decode($rst['data'], TRUE);

					try {
						pdo_begin();
						// if ($balance > 0) {
							$data_log = [
								'uniacid' => $_W['uniacid'],
								'user_id' => $uid,
								'type'    => 2,
								'money'   => $balance,
								'subtype' => 0,
								'create'  => $time,
							];
							pdo_insert(sl_table_name('log'), $data_log);
							$data_bak['payParam']['lid'] = pdo_insertid();
						// }

						if ($couponUsed) {
							// 修改优惠券状态
							$data_update = array(
								'status' => '1',
							);
							$rst_coupon_my = pdo_update(sl_table_name('coupon_user'), $data_update, array('id' => $one_coupon_my['id']));
							if ($rst_coupon_my === FALSE) {
								sl_ajax(1, '使用优惠券失败');
							}
						}

						$data_order = [
							'status'       => '0',
							'subtype'      => '127',
							'paid_money'   => $fee,
							'refund_money' => $fee,
						];
						pdo_insert(sl_table_name('order'), array_merge($order, $data_order));
						$order_id = pdo_insertid();

						pdo_update(sl_table_name('user'), ['balance' => 0], ['id' => $uid]);
						pdo_commit();

						$data_bak['payParam']['ordersn'] = $order_sn;

						sl_ajax(0, $data_bak);
					} catch (Exception $e) {
						pdo_rollback();

						sl_ajax(1, '更新数据库失败，' . $e->getMessage());
					}
				}
		}

		// $rst = sl_tpl_send_course_reserve($order_id);
		$course_start = @date("Y-m-d H:i", $course_plan['start']);
		$data_wxrss = [
			'type'   => 'course_reserve',
			'user'   => $user,
			'thing1' => $course['name'],
			'date2'  => $course_start,
			'thing4' => $one_store['name'],
			'thing5' => $one_store['address'],
		];
		sl_rss_send($data_wxrss); // 发送消息

		$data_bak = [
			'id' => $order_id,
			'sn' => $order_sn,
		];


		sl_ajax(0, $data_bak);
	}

	/** 购买课程成功-付款成功后，添加课程预约信息 */
	public function doPageBookCourse2()
	{
		global $_GPC, $_W;
		$uid = intval($_GPC['uid']);
		$userInfo = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($userInfo)) { sl_ajax(1, '用户不存在'); }

		$course_plan_id = intval($_GPC['planId']); // 课表ID
		$lid = $_GPC['lid']; // 日志表ID
		$order_sn = $_GPC['ordersn']; // 订单SN

		if (empty($lid)) { sl_ajax(1, '日志表ID不存在'); }
		if (empty($order_sn)) { sl_ajax(1, '订单sn不存在'); }

		$this->finishOrder();

		$lock = self::getCoursePlanLock($course_plan_id);
		try {
			$order = pdo_get(sl_table_name('order'), ['sn'=>$order_sn]);
			// $one_log = pdo_get(sl_table_name('log'), ['id'=>$lid]);
			$fee = $order['paid_money'];

			if ($order) {
				pdo_begin();
				$lock->lock();

				$data = [];
				$data['status'] = '1';
				$res = pdo_update(sl_table_name('order'), $data, ['sn'=>$order_sn]);

				if ($res) {
					if ($lid) {
						pdo_update(sl_table_name('log'), ['order_id'=>$order['id']], ['id' => $lid]);
					}

					// 分销记录
					$rst = sl_jsf_commission_rebate($uid, $order['paid_money'], $fee * 100, 'score');
					if ($rst && $rst['code'] != 0) {
						@putlog('健身房-分销回扣记录', $rst['msg']);
					}

					pdo_update(sl_table_name('course_plan'), ['booked_number +='=>'1'], ['id'=>$course_plan_id]);

					pdo_commit();
					$lock->unlock();

					// $rst = sl_tpl_send_course_reserve($order['id']);

					$data_bak = [
						'id'=>$order['id'],
						'tpl_msg'=>$rst,
					];

					sl_ajax(0, $data_bak);
				} else {
					pdo_rollback();
					$lock->unlock();

					sl_ajax(1, '更新订单状态失败');
				}
			} else {
				sl_ajax(1, '订单不存在');
			}

		} catch (Throwable $t) {
			pdo_rollback();
			$lock->unlock();

			sl_ajax(1, '失败，发生异常：' . $t->getMessage());
		}
	}

	/** 购买课程失败*/
	public function doPagePaymentFail()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$lid = intval($_GPC['lid']); // 日志表ID
		$order_sn = $_GPC['osn']; // 订单SN
		$coupon_user_id = intval($_GPC['cid']); // 优惠券ID

		if (empty($lid)) { sl_ajax(1, '日志表ID不存在'); }
		if (empty($order_sn)) { sl_ajax(1, '订单ID不存在'); }

		if ($coupon_user_id) {
			pdo_update(
				sl_table_name('coupon_user'),
				['user'=>$uid, 'saleid'=>$coupon_user_id],
				['status' => '0']
			);
		}

		$lhtn = sl_table_name('log');
		$ohtn = sl_table_name('order');
		$log = pdo_get($lhtn, ['id' => $lid]);
		pdo_delete($lhtn, ['id' => $lid]);
		pdo_delete($ohtn, ['sn' => $order_sn]);
		pdo_query("UPDATE " . sl_table_name('user',TRUE) .
			" SET balance = balance + :money WHERE id = $uid", ['money' => $log['money']]);

		sl_ajax(0, 'ok');
	}

	/**
	 * 获取课程列表
	 */
	public function doPageCourseList()
	{
		global $_GPC, $_W;

		$uniacidConArr = ['c.uniacid'=>$_W['uniacid']];
		$ctn = sl_table_name('course',TRUE);
		$cstn = sl_table_name('course_system',TRUE);
		$fields = "c.id AS id,c.name AS name,c.simple AS simple,c.video AS video,c.video_image AS video_image," .
			"cs.name AS systemName,cs.image AS systemImage";
		$sql = "SELECT $fields FROM $ctn AS c LEFT JOIN $cstn AS cs ON c.system_id = cs.id WHERE $uniacidConArr ORDER BY recommend DESC";
		$res = pdo_fetchall($sql);
		if ($res) {
			foreach ($res as &$row) {
				$row['video'] = tomedia($row['video']);
				$row['video_image'] = tomedia($row['video_image']);
			}
		}

		sl_ajax(0, $res);
	}

	/**
	 * 获取推荐的课程列表
	 */
	public function doPageRecommendedCourseList()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$uniacidConArr = " uniacid='$sluni' ";
		$ctn = sl_table_name('course',TRUE);
		$cstn = sl_table_name('course_system',TRUE);
		$sql = "SELECT * FROM $ctn WHERE $uniacidConArr AND recommend > 0 ORDER BY recommend DESC";
		$res = pdo_fetchall($sql);
		$data = array();
		if (!empty($res)) {
			$tn = sl_table_name('course_member_level');
			$level = pdo_getcolumn(sl_table_name('user'), ['openid' => $user['openid']], 'member_level_id');
			foreach ($res as $key => &$row) {
				$row['video'] = tomedia($row['video']);
				$row['video_image'] = tomedia($row['video_image']);
				$slides = explode(',', $row['slides']);
				foreach ($slides as &$s) {
					$s = tomedia($s);
				}
				$row['slides'] = $slides;
				$row['show_image'] = tomedia($row['show_image']);

				$all = pdo_getall($tn, ['course_id' => $row['id']]);
				if (!empty($all)) {
					foreach ($all as $value) {
						if ($value['member_level_id'] == $level) {
							continue 2;
						}
					}
					unset($res[$key]);
				}
			}
			$res = array_values($res);
			$systemIdList = sl_array_column($res, 'system_id');
			$systems = pdo_fetchall("SELECT * FROM $cstn WHERE id IN (" . implode(',', $systemIdList) . ")");
			foreach ($systems as &$s) {
				$s['image'] = tomedia($s['image']);
				$s['icon'] = tomedia($s['icon']);
			}
			$data['systems'] = $systems;
		}
		$data['courses'] = $res;

		sl_ajax(0, $data);
	}

	/**
	 * 获取课程信息
	 */
	public function doPageCourseInfo()
	{
		global $_GPC, $_W;

		$id = $_GPC['id'];

		$ssid = trim($_GPC['ssid']); // 门店ID
		$tmp_ssid = '%"'.$ssid.'"%';

		// 课程表-one
		$condition = " AND uniacid=:uniacid AND id=:id AND store_info LIKE :store_info ";
		$params = [':uniacid'=>$_W['uniacid'], ':id'=>$id, ':store_info'=>$tmp_ssid];
		$one = pdo_fetch('SELECT * FROM ' . sl_table_name('course',TRUE) . ' WHERE 1 ' . $condition, $params);

		if ($one) {
			$one['video']              = tomedia($one['video']);
			$one['show_image_format']  = tomedia($one['show_image']);
			$one['video_image_format'] = tomedia($one['video_image']);

			// 课程列表-one
			$condition_course_plan = " AND uniacid=:uniacid AND course_id=:course_id ";
			$params_course_plan = array(':uniacid' => $_W['uniacid'], ':course_id' =>$one['course_id']);
			$one_course_plan = pdo_fetch('SELECT * FROM ' . sl_table_name('course_plan',TRUE) . ' WHERE 1 '
				. $condition_course_plan, $params_course_plan);

			// 课程体系
			$condition_course_system = " AND uniacid=:uniacid AND id=:id ";
			$params_course_system = array(':uniacid' => $_W['uniacid'], ':id' => $one['system_id']);
			$one_course_system = pdo_fetch('SELECT * FROM ' . sl_table_name('course_system',TRUE) . ' WHERE 1 '
				. $condition_course_system, $params_course_system);

			if ($one_course_system) {
				$one_course_system['image_format'] = tomedia($one_course_system['image']);
				$one_course_system['icon_format'] = tomedia($one_course_system['icon']);
				$one['course_system'] = $one_course_system;
			}

			if ($one['slides']) {
				$slides = explode(',', $one['slides']);
				foreach ($slides as &$item) {
					$item = tomedia($item);
				}
			}
			$one['slides'] = $slides;

			// 会员等级.start
			// 获取所有会员等级
			$condition_all_member_level = " AND uniacid=:uniacid AND `delete`='0' ";
			$params_all_member_level = array(':uniacid' => $_W['uniacid']);
			$list_all_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('member_level',TRUE) . ' WHERE 1 '
				. $condition_all_member_level, $params_all_member_level);

			$list_all_member_level[] = [
				'id'=>'0',
				'name'=>'普通会员',
			];


			$condition_member_level = " AND uniacid=:uniacid AND course_id=:course_id ";
			$params_member_level = array(':uniacid' => $_W['uniacid'], ':course_id'=>$one_course_plan['course_id']);
			$list_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('course_member_level',TRUE) . ' WHERE 1 '
				. $condition_member_level . " ORDER BY id DESC", $params_member_level);

			if ($list_member_level) {
				foreach ($list_member_level as $k => $v) {
					$one['member_level'][] = $v['id'];
				}
			} else {
				foreach ($list_all_member_level as $k => $v) {
					$one['member_level'][] = $v['id'];
				}
			}
			// 会员等级.end


			// 支付方式.start
			$list_all_payment_way = $_W['slwl']['pay_way'];

			$condition_payment_way = " AND uniacid=:uniacid AND course_id=:course_id ";
			$params_payment_way = array(':uniacid' => $_W['uniacid'], ':course_id'=>$one_course_plan['id']);
			$list_payment_way = pdo_fetchall('SELECT * FROM ' . sl_table_name('course_payment_way',TRUE) . ' WHERE 1 '
				. $condition_payment_way . " ORDER BY id DESC", $params_payment_way);

			if ($list_payment_way) {
				foreach ($list_payment_way as $k => $v) {
					foreach ($list_all_payment_way as $key => $value) {
						if ($v['payment_way'] == $value['id']) {
							$list_payment_way[$k]['way'] = $value['way'];
							break;
						}
					}
				}

				foreach ($list_payment_way as $k => $v) {
					$one['payment_way'][] = $v['way'];
				}
			} else {
				foreach ($list_all_payment_way as $k => $v) {
					$one['payment_way'][] = $v['way'];
				}
			}
			// 支付方式.end


			sl_ajax(0, $one);
		} else {
			sl_ajax(1, '课程不存在');
		}
	}

	/**
	 * 获取某个门店特定某一天的所有课程
	 */
	public function doPageStoreDayCoursePlanList()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uid = intval($_GPC['uid']);
		$userInfo = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($userInfo)) {
			sl_ajax(1, '用户不存在');
		}

		$storeId = intval($_GPC['storeId']);
		$uniacidConStr = " cp.uniacid='$sluni' ";

		$cptn = sl_table_name('course_plan',TRUE);
		$catn = sl_table_name('coach',TRUE);
		$stn = sl_table_name('store',TRUE);
		$ctn = sl_table_name('course',TRUE);
		$otn = sl_table_name('order',TRUE);
		$bqtn = sl_table_name('book_queue',TRUE);
		$fields = "cp.*,ca.avatar AS avatar,s.name AS store,s.way,s.id AS storeId,c.delete,c.name AS course,o.id AS orderId,bq.id AS bqid," .
			"s.subway_name AS subway,s.subway_distance AS subwayDistance,s.bus_stop_name AS stop,s.bus_stop_distance AS stopDistance";
		$day = new DateTime();
		$day->setTimestamp(intval($_GPC['day']));
		$day->setTime(0, 0, 0);
		$dayStart = $day->getTimestamp();
		$dayEnd = $dayStart + 24 * 3600;
		$planInfoList = pdo_fetchall("SELECT $fields FROM $cptn AS cp LEFT JOIN $catn AS ca ON cp.coach_id = ca.id " .
			"LEFT JOIN $stn AS s ON s.id = cp.store_id " .
			"LEFT JOIN $ctn AS c ON c.id = cp.course_id " .
			"LEFT JOIN $bqtn AS bq ON bq.plan_id = cp.id " .
			"LEFT JOIN $otn AS o ON o.plan_id = cp.id AND (o.status = 1 OR o.status = 5) AND o.user_id = {$userInfo['id']} " .
			"WHERE $uniacidConStr AND c.delete = 0 AND cp.store_id = $storeId AND start >= $dayStart AND start < $dayEnd ORDER BY start");
		foreach ($planInfoList as &$item) {
			$item['avatar'] = tomedia($item['avatar']);
		}

		self::filterCourseList($planInfoList, $userInfo['member_level_id']);

		if (empty($planInfoList)) {
			$storeInfo = pdo_get(sl_table_name('store'), ['id' => $storeId], ['subway_name', 'name', 'subway_distance', 'id',
				'bus_stop_name', 'bus_stop_distance', 'way']);
			$keys = ['subway_name,subway', 'name,store', 'subway_distance,subwayDistance', 'id,store_id',
				'bus_stop_name,stop', 'bus_stop_distance,stopDistance'];
			foreach ($keys as $k) {
				$ks = explode(',', $k);
				$storeInfo[$ks[1]] = $storeInfo[$ks[0]];
				unset($storeInfo[$ks[0]]);
			}
		}

		$data_bak = [
			'list' => $planInfoList,
			'store' => !empty($planInfoList) ? '' : $storeInfo,
		];
		sl_ajax(0, $data_bak);
	}

	/**
	 * 请求退款
	 */
	public function doPageRequestRefund()
	{
		global $_GPC, $_W;

		$this->finishOrder();

		$condition = !empty($_GPC['id']) && intval($_GPC['id']) > 0 ? ['id' => $_GPC['id']] : ['sn' => $_GPC['sn']];
		$order = pdo_get(sl_table_name('order'), $condition, ['id', 'status', 'type', 'subtype', 'plan_id', 'order_info']);
		if (empty($order)) {
			sl_ajax(1, '课程预约记录不存在');
		}

		if ($order['status'] != 1) {
			sl_ajax(1, '课程预约记录状态错误');
		}

		if ($order['order_info']) {
			$tmp_order = json_decode($order['order_info'], true);

			if ($tmp_order['start'] < time()) {
				sl_ajax(1, '当前时间不能取消订单');
			}
		}

		if ($order['type'] == 0 && $order['subtype'] == 1) {
			$cpid = $order['plan_id'];
			$lock = self::getCoursePlanLock($cpid);
			try {
				$lock->lock();
				pdo_begin();

				pdo_update(sl_table_name('order'), ['status' => 4, 'refund_time' => time()], ['id' => $order['id']]);

				$bn = pdo_getcolumn(sl_table_name('course_plan'), ['id' => $cpid], 'booked_number');
				if ($bn > 0) {
					pdo_update(sl_table_name('course_plan'), ['booked_number' => $bn - 1], ['id' => $cpid]);
				}

				pdo_commit();
				$lock->unlock();
				self::sendBroadcastMsg($cpid);

				$order = pdo_get(sl_table_name('order'), ['id'=>$order['id']]);

				sl_ajax(0, $order['status']); // 返回订单状态
			} catch (Throwable $t) {
				pdo_rollback();

				sl_ajax(1, '请求失败，请稍后重试');
			}
		}

		$res = pdo_update(sl_table_name('order'), array('status' => 3, 'refund_time' => time()), array('id' => $order['id']));
		if ($res !== FALSE) {
			sl_ajax(0, '您的退款请求已经保存');
		}

		sl_ajax(1, '请求失败，请稍后重试');
	}

	/**
	 * 删除预约记录
	 */
	public function doPageRemoveOrder()
	{
		global $_GPC, $_W;

		$this->finishOrder();

		$sn = $_GPC['sn'];
		$res = pdo_update(sl_table_name('order'), array('delete' => 1), array('sn' => $sn));
		if ($res !== FALSE) {
			sl_ajax(0, '删除成功');
		}

		sl_ajax(1, '删除失败');
	}

	public function doPageSystemSettings()
	{
		global $_GPC, $_W;
		return self::result(0, '', self::getSystemSettings($_W['uniacid']));
	}

	/**
	 * 同步用户信息
	 */
	public function doPageSyncUserInfo()
	{
	}

	/**
	 * 获取邀请函页面信息
	 */
	public function doPageInvitationInfo()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uniacidConStr = " o.uniacid='$sluni' ";
		$sn = $_GPC['sn'];
		$otn = sl_table_name('order',TRUE);
		$ctn = sl_table_name('course',TRUE);
		$cptn = sl_table_name('course_plan',TRUE);
		$stn = sl_table_name('store',TRUE);
		$utn = sl_table_name('user',TRUE);
		$fields = 'u.avatar,u.nickname,' .
			'c.name AS course,c.show_image AS showImage,c.id AS cid,' .
			'cp.start,cp.end,cp.id AS planId,' .
			's.name AS store';

		$invitation = pdo_fetch("SELECT $fields FROM $otn AS o " .
			"LEFT JOIN $cptn AS cp ON cp.id = o.plan_id " .
			"LEFT JOIN $ctn AS c ON c.id = cp.course_id " .
			"LEFT JOIN $utn AS u ON u.id = o.user_id " .
			"LEFT JOIN $stn AS s ON s.id = cp.store_id " .
			"WHERE $uniacidConStr AND o.sn = '$sn'");

		if (!empty($invitation)) $invitation['showImage'] = tomedia($invitation['showImage']);

		sl_ajax(0, $invitation);
	}

	public function doPageInvitationInfo2()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uniacidConStr = " o.uniacid='$sluni' ";
		$sn = $_GPC['sn'];
		$otn = sl_table_name('order',TRUE);
		$ctn = sl_table_name('course',TRUE);
		$cptn = sl_table_name('course_plan',TRUE);
		$stn = sl_table_name('store',TRUE);
		$utn = sl_table_name('user',TRUE);
		$fields = 'u.avatar,u.nickname,' .
			'c.name AS course,c.show_image AS showImage,c.id AS cid,' .
			'cp.start,cp.end,cp.id AS planId,' .
			's.name AS store';

		$invitation = pdo_fetch("SELECT $fields FROM $otn AS o " .
			"LEFT JOIN $cptn AS cp ON cp.id = o.plan_id " .
			"LEFT JOIN $ctn AS c ON c.id = cp.course_id " .
			"LEFT JOIN $utn AS u ON u.id = o.user_id " .
			"LEFT JOIN $stn AS s ON s.id = cp.store_id " .
			"WHERE $uniacidConStr AND o.id = :id", ['id' => $sn]);

		if (!empty($invitation)) $invitation['showImage'] = tomedia($invitation['showImage']);

		sl_ajax(0, $invitation);
	}

	/**
	 * 获取首页信息
	 */
	public function doPageHomeInfo()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uniacidConArr = " uniacid='$sluni' ";
		$data = pdo_fetchall("SELECT id,show_image,`name` FROM " . sl_table_name('course',TRUE)
			. " WHERE $uniacidConArr AND (`delete` = 0 OR `delete` IS NULL) AND recommend > 0 "
			. " ORDER BY recommend DESC,id DESC");
		foreach ($data as &$item) {
			$item['show_image'] = tomedia($item['show_image']);
		}

		sl_ajax(0, ['courses' => $data]);
	}

	/**
	 * 获取活动列表，只要没有过期的都返回
	 */
	public function doPageActivityList()
	{
		global $_GPC, $_W;

		$ssid = trim($_GPC['ssid']); // 门店ID
		$tmp_ssid = '%"'.$ssid.'"%';

		$dt = new DateTime();

		$time_start = $dt
			->setTimestamp($_W['slwl']['datetime']['timestamp'])
			->setTime(0, 0, 0)
			->getTimestamp();
		$time_end = $dt
			->setTimestamp($_W['slwl']['datetime']['timestamp'])
			->setTime(23, 59, 59)
			->getTimestamp();

		$condition_activity = " AND uniacid=:uniacid AND `delete`='0' AND `time` >=:timeEnd AND store_info LIKE :store_info ";
		$params_activity = [':uniacid'=>$_W['uniacid'], ':timeEnd'=>$time_start, ':store_info'=>$tmp_ssid];
		$pindex_activity = max(1, intval($_GPC['page']));
		$psize_activity = 10;
		$sql_activity = "SELECT * FROM " . sl_table_name('activity',TRUE) . ' WHERE 1 '
			. $condition_activity . " ORDER BY id DESC LIMIT "
			. ($pindex_activity - 1) * $psize_activity .',' .$psize_activity;
		$list_activity = pdo_fetchall($sql_activity, $params_activity);

		if ($list_activity) {
			foreach ($list_activity as $key => $value) {
				$list_activity[$key]['cover_foramt'] = tomedia($value['cover']);
			}
		}

		sl_ajax(0, $list_activity);
	}

	/**
	 * 获取活动详情
	 */
	public function doPageActivityInfo()
	{
		global $_GPC, $_W;

		$ssid = trim($_GPC['ssid']); // 门店ID
		$tmp_ssid = '%"'.$ssid.'"%';

		$rst = pdo_get(sl_table_name('activity'), ['id'=>$_GPC['id'], 'store_info LIKE'=>$tmp_ssid]);

		if ($rst) {
			$rst['cover_foramt'] = tomedia($rst['cover']);
		}

		sl_ajax(0, $rst);
	}

	/**
	 * 获取优惠券详情
	 */
	public function doPageCouponInfo()
	{
		self::getInfo('coupon');
	}

	/**
	 * 获取优惠券列表
	 */
	public function doPageCouponList()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uid = intval($_GPC['uid']);
		$userInfo = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($userInfo)) {
			sl_ajax(1, '用户不存在');
		}

		$ctn = sl_table_name('coupon',TRUE);
		$utn = sl_table_name('user',TRUE);
		$cutn = sl_table_name('coupon_user',TRUE);
		$time = time();
		$fields = 'c.id,c.minus,c.reach,c.end_time AS end,c.description,c.bg_image,u.id AS uid';
		$uniacidConStr = " c.uniacid='$sluni' ";

		$list = pdo_fetchall("SELECT $fields FROM $ctn AS c "
			. " LEFT JOIN $cutn AS cu ON c.id = cu.coupon_id AND cu.user_id = $uid "
			. " LEFT JOIN $utn AS u ON u.id = cu.user_id "
			. " WHERE c.delete = 0 AND c.max > c.received AND $uniacidConStr "
			. " AND c.end_time > $time ORDER BY minus");
		foreach ($list as &$row) {
			$row['bg_image'] = tomedia($row['bg_image']);
		}

		sl_ajax(0, $list);
	}

	/**
	 * 领取优惠券
	 */
	public function doPageReceiveCoupon()
	{
		global $_GPC, $_W;

		$couponId = $_GPC['cid'];

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		if (pdo_getcolumn(sl_table_name('coupon_user'), ['user_id'=>$uid,'coupon_id'=>$couponId],'id')) {
			sl_ajax(1, '您已领取');
		}

		require_once IA_ROOT . '/addons/bozutung_jsfmd/Lock.php';
		$path = MODULE_ROOT . '/data/tmp/';
		$filename = 'lock_jsfmd_' . $couponId;
		$lock = new FileLock($path . $filename);
		try {
			$lock->lock();
			$coupon = pdo_get(sl_table_name('coupon'), ['id' => $couponId]);
			if ($coupon['max'] <= $coupon['received']) {
				sl_ajax(1, '已达领取上限');
			}

			pdo_begin();
			pdo_update(sl_table_name('coupon'), ['received' => $coupon['received'] + 1], ['id' => $couponId]);
			$res = pdo_insert(sl_table_name('coupon_user'), ['user_id' => $uid, 'coupon_id' => $couponId,
				'receive_time' => time(), 'uniacid' => $_W['uniacid']]);
			pdo_commit();

			sl_ajax(0, $res);
		} finally {
			$lock->unlock();
		}
	}

	/**
	 * 获取教练列表
	 */
	public function doPageCoachList()
	{
		global $_GPC, $_W;

		$ssid = trim($_GPC['ssid']); // 门店ID

		$tmp_ssid = '%"'.$ssid.'"%';
		$where = [
			'uniacid'         => $_W['uniacid'],
			'delete'          => 0,
			'store_info LIKE' => $tmp_ssid,
		];
		$list = pdo_getall(sl_table_name('coach'), $where);

		foreach ($list as &$coach) {
			$coach['avatar_format'] = tomedia($coach['avatar']);
			$coach['video_format'] = tomedia($coach['video']);
			$coach['video_image_format'] = tomedia($coach['video_image']);
		}

		sl_ajax(0, $list);
	}

	/**
	 * 获取私教列表
	 */
	public function doPagePrivateCoachList()
	{
		global $_GPC, $_W;

		$where = [
			'uniacid' => $_W['uniacid'],
			'private' => 1,
			'delete'  => 0,
		];
		$list = pdo_getall(sl_table_name('coach'), $where,
			['id', 'name', 'avatar', 'strong_points', 'course_num_lower']);
		foreach ($list as &$coach) {
			$coach['avatar'] = tomedia($coach['avatar']);
			$coach['times'] = pdo_fetch("SELECT COUNT(*) AS times FROM " . sl_table_name('order',TRUE)
				. " WHERE `type` = 3 AND other_id = ${coach['id']}")['times'];
		}

		sl_ajax(0, $list);
	}

	/**
	 * 获取我的优惠券列表
	 */
	public function doPageMyCouponList()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$typeConStr = '1=1';
		if (!empty($_GPC['used']) && $_GPC['used'] == 1) {
			$typeConStr = "used = 1";
		}
		$uctn = sl_table_name('coupon_user',TRUE);
		$ctn = sl_table_name('coupon',TRUE);
		$fields = 'c.id AS id,c.minus AS minus,c.reach AS reach,c.end_time AS end,'
			. ' c.description AS description,c.bg_image AS bg_image,uc.used AS used ';
		$uniacidConStr = " uc.uniacid='$sluni' ";

		$list = pdo_fetchall("SELECT $fields FROM $uctn AS uc "
			. " LEFT JOIN $ctn AS c ON c.id = uc.coupon_id "
			. " WHERE $uniacidConStr AND uc.used ='0' AND uc.user_id = $uid "
			. " AND $typeConStr ORDER BY c.minus DESC");
		foreach ($list as &$row) {
			$row['bg_image'] = tomedia($row['bg_image']);
		}

		sl_ajax(0, $list);
	}

	/** 预约满以后，进行排队 */
	public function doPageQueueCoursePlan()
	{
		global $_GPC, $_W;

		$form_id = trim($_GPC['formID']); // formid
		$plan_id = trim($_GPC['planId']); // 课表ID

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		// 课表
		$one_course_plan = pdo_get(sl_table_name('course_plan'), ['id' => $plan_id]);
		if (empty($one_course_plan)) {
			sl_ajax(1, '课表不存在');
		}

		// 门店
		$one_store = pdo_get(sl_table_name('store'), ['id' => $one_course_plan['store_id']]);
		if (empty($one_store)) {
			sl_ajax(1, '门店不存在');
		}

		// 课程
		$one_course = pdo_get(sl_table_name('course'), ['id' => $one_course_plan['course_id']]);
		if (empty($one_course)) {
			sl_ajax(1, '课程不存在');
		}

		$course_info = [
			'user'        => $user,
			'course_plan' => $one_course_plan,
			'store'       => $one_store,
			'course'      => $one_course,
		];

		$condition = [
			'uniacid'     => $_W['uniacid'],
			'user_id'     => $user['id'],
			'plan_id'     => $plan_id,
			'store_id'    => $one_store['id'],
			'form_id'     => $form_id,
			'course_info' => json_encode($course_info),
		];
		$bq = pdo_get(sl_table_name('book_queue'), $condition);
		if (empty($bq)) {
			$condition['form_id'] = $form_id;
			$condition['create_time'] = $_W['slwl']['datetime']['now'];

			$rst = pdo_insert(sl_table_name('book_queue'), $condition);
			$id_book_queue = pdo_insertid();

			// sl_tpl_send_queue_reserve($id_book_queue);

			$data_wxrss = [
				'type'              => 'course_queue',
				'user'              => $user,
				'thing1'            => $one_store['name'],
				'thing2'            => $one_course['name'],
				'thing3'            => $one_store['address'],
				'time6'             => $_W['slwl']['datetime']['now'],
				'character_string9' => $rst,
			];
			sl_rss_send($data_wxrss); // 发送消息
		}

		if ($rst !== FALSE) {
			sl_ajax(0, 'ok');
		} else {
			sl_ajax(1, 'err');
		}
	}

	// 门店列表
	public function doPageStoreList()
	{
		global $_GPC, $_W;

		$uniConArr = ['uniacid'=>$_W['uniacid'], 'delete'=>0];
		$order_by = ['sort DESC','id DESC'];
		$list = pdo_getall(sl_table_name('store'), $uniConArr, ['id', 'name', 'image','address'], '', $order_by);
		foreach ($list as &$item) {
			$item['image'] = tomedia($item['image']);
		}

		sl_ajax(0, $list);
	}

	public function doPagePrivateCoachInfo()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'balance', 'real_name', 'tel']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$id = $_GPC['id'];
		$privateCoach = pdo_get(sl_table_name('coach'), ['id' => $id]);
		if (empty($privateCoach)) {
			sl_ajax(1, '私教不存在');
		}

		$privateCoach['avatar'] = tomedia($privateCoach['avatar']);
		$privateCoach['bought'] = pdo_exists(sl_table_name('private_coach_buy'),
			['coach_id' => $id, 'user_id' => $user['id']]);
		$privateCoach['balance'] = $user['balance'];
		$privateCoach['cname'] = $user['real_name'];
		$privateCoach['ctel'] = $user['tel'];

		sl_ajax(0, $privateCoach);
	}

	public function doPageMemberLevelList()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$condition = ['uniacid'=>$_W['uniacid'], 'delete'=>0];

		$list = pdo_getall(sl_table_name('member_level'), $condition, [], '', ['price DESC']);

		foreach ($list as $key => $value) {
			if ($value['id'] == $user['member_level_id']) {
				unset($list[$key]);
				break;
			}
		}

		sl_ajax(0, $list);
	}

	public function doPageMemberCardList()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		// 0—通用时间卡，1—通用次卡，2—储值卡，3—课程次卡（特定课程的次数卡），
		// 4—课程时间卡（特定课程的时间卡），5—限时次卡

		$type = $_GPC['type']; // 会员卡类型

		if ($type == 'unlimited') {
			$where = " AND `type`='0' ";
		}

		if ($type == 'count') {
			$where = " AND `type`='1' ";
		}

		if ($type == 'balance') {
			$where = " AND `type`='2' ";
		}

		if ($type == 'card') {
			$where = " AND (`type`='3' OR `type`='4' OR `type`='5') ";
		}

		$uniConStr = " mc.uniacid='$sluni' ";
		$list = pdo_fetchall("SELECT mc.*,c.name AS course FROM "
			. sl_table_name('member_card',TRUE) . " AS mc "
			. " LEFT JOIN " . sl_table_name('course',TRUE) . " AS c ON c.id = mc.course_id "
			. " WHERE $uniConStr " . $where
			. " AND mc.delete = 0 AND mc.to_sell = 1 ORDER BY sort DESC");

		sl_ajax(0, $list);
	}

	// 购买会员卡
	public function doPageBuyMemberCard()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']); // 用户ID
		$mcid = intval($_GPC['mcid']); // 会员卡ID

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$price = pdo_getcolumn(sl_table_name('member_card'), ['id' => $mcid], 'price');
		if (is_bool($price)) {
			sl_ajax(1, '会员卡不存在');
		}

		$sn = 'SLWL' . $_W['slwl']['datetime']['nowYmdHis'] . str_pad('1', 6, '0', STR_PAD_LEFT);
		$rst = self::getPayParams($price * 100, $sn, $user);

		if ($rst['code'] == '0') {
			$data_bak = json_decode($rst['data'], TRUE);
			$data_bak['sn'] = $sn;
			sl_ajax(0, $data_bak);
		} else {
			sl_ajax(1, $rst['msg']);
		}
	}

	// 购买会员卡-成功
	public function doPageMemberCardBuyDone()
	{
		global $_GPC, $_W;

		$uid     = intval($_GPC['uid']); // 用户ID
		$sn      = trim($_GPC['ordersn']); // 订单SN
		$mcid    = intval($_GPC['mcid']); // 会员卡ID
		$ssid    = trim($_GPC['ssid']); // 门店ID
		$form_id = trim($_GPC['formID']);

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		$card_fields = ['type', 'price', 'time', 'money', 'times'];
		$card = pdo_get(sl_table_name('member_card'), ['id' => $mcid], $card_fields);
		if (is_bool($card)) {
			sl_ajax(1, '会员卡不存在');
		}

		// 获取订单信息
		$where = ['uniacid'=>$_W['uniacid'], 'sn'=>$sn];
		$one = pdo_get(sl_table_name('order'), $where);

		if ($one) {
			sl_ajax(1, '订单已存在');
		}

		$time = time();
		$type = $card['type'];
		$common = [
			'uniacid' => $_W['uniacid'],
			'card_id' => $mcid,
			'user_id' => $uid,
			'type'    => $type,
			'subtype' => 1,
			'create'  => $time,
		];

		// 获取门店信息
		$where_store = ['uniacid'=>$_W['uniacid'], 'id'=>$ssid];
		$one_store = pdo_get(sl_table_name('store'), $where_store);
		if (empty($one_store)) {
			sl_ajax(1, '门店没有启用或已删除');
		}

		try {
			pdo_begin();

			$order_info = [
				'card'  => $card,
				'store' => $one_store,
				'user'  => $user,
			];

			$data = [
				'uniacid'     => $_W['uniacid'],
				'user_id'     => $uid,
				'sn'          => $sn,
				'paid_money'  => $card['price'],
				'type'        => 2,
				'other_id'    => $mcid,
				'create_time' => $time,
				'paid_time'   => $time,
				'status'      => 1,
				'form_id'     => $form_id,
				'order_info'  => json_encode($order_info),
			];
			pdo_insert(sl_table_name('order'), $data);

			$oid = pdo_insertid();
			$ucData = [
				'uniacid'  => $_W['uniacid'],
				'user_id'  => $uid,
				'type'     => $type,
				'card_id'  => $mcid,
				'order_id' => $oid,
			];

			switch ($type) {
				case 0://时间卡
					$dueTime = empty($user['due_time']) ? $time : $user['due_time'];
					if ($dueTime < $time) $dueTime = $time;
					$dueTime = (new DateTime())->setTimestamp($dueTime)->add(new DateInterval("P${card['time']}D"))
						->setTime(23, 59, 59)->getTimestamp();
					pdo_update(sl_table_name('user'), ['due_time' => $dueTime], ['id' => $uid]);

					pdo_insert(sl_table_name('log'), array_merge($common, ['time' => $card['time']]));
					break;

				case 1://次卡
					$times = $card['times'];
					pdo_update(sl_table_name('user'),
						['left_times' => $times + ($user['left_times'] > 0 ? $user['left_times'] : 0)], ['id' => $uid]);

					pdo_insert(sl_table_name('log'), array_merge($common, ['times' => $times]));
					break;

				case 2://储值卡
					$money = $card['money'];
					pdo_update(sl_table_name('user'),
						['balance' => $money + ($user['balance'] > 0 ? $user['balance'] : 0)], ['id' => $uid]);

					pdo_insert(sl_table_name('log'), array_merge($common, ['money' => $money]));
					break;

				case 3://课程次卡
				case 5://限时次卡
					$ucData['times'] = $card['times'];
					$ucData['left_times'] = $card['times'];
					if ($card['time'] > 0) {
						$ucData['due_time'] = (new DateTime())->setTime(23, 59, 59)
							->add(new DateInterval("P${card['time']}D"))->getTimestamp();
					}
					break;
			}
			pdo_insert(sl_table_name('user_card'), $ucData);
			pdo_commit();

			self::addBuyCommission($uid, $card['price'], $_W['uniacid'], $oid);

			sl_ajax(0, 'ok');
		} catch (Exception $e) {
			pdo_rollback();

			sl_ajax(1, '更新会员信息失败,' . $e->getMessage());
		}
	}

	public function doPageUpgradeMemberLevel()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$mlid = intval($_GPC['mlid']);
		$member_card = pdo_get(sl_table_name('member_level'), ['id'=>$mlid], 'price');
		if (empty($member_card)) {
			sl_ajax(1, '会员等级不存在不存在');
		}

		$sn = date('YmdHis') . substr(md5(rand(10000, 10000000)), 0, 10);
		$price_format = $member_card['price'] * 100;
		$rst = self::getPayParams($price_format, $sn, $user);

		if ($rst['code'] == '0') {
			$data_bak = json_decode($rst['data'], TRUE);
			$data_bak['sn'] = $sn;
			sl_ajax(0, $data_bak);
		} else {
			sl_ajax(1, $rst['msg']);
		}
	}

	public function doPageMemberLevelUpgradeDone()
	{
		global $_GPC, $_W;

		$uid  = intval($_GPC['uid']);
		$mlid = intval($_GPC['mlid']);
		$sn   = trim($_GPC['ordersn']);
		$ssid = trim($_GPC['ssid']); // 门店ID
		$form_id = trim($_GPC['formID']);

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		$member_level = pdo_get(sl_table_name('member_level'), ['id' => $mlid]);
		if (is_bool($member_level)) {
			sl_ajax(1, '会员等级不存在');
		}

		// 获取订单信息
		$where = ['uniacid'=>$_W['uniacid'], 'sn'=>$sn];
		$one_order = pdo_get(sl_table_name('order'), $where);

		if ($one_order) {
			sl_ajax(1, '订单已存在');
		}

		$time = time();

		// 获取门店信息
		$where_store = ['uniacid'=>$_W['uniacid'], 'id'=>$ssid];
		$one_store = pdo_get(sl_table_name('store'), $where_store);
		if (empty($one_store)) {
			sl_ajax(1, '门店没有启用或已删除');
		}

		try {
			pdo_begin();

			$order_info = [
				'member_level'  => $member_level,
				'store' => $one_store,
				'user'  => $user,
			];

			$data = [
				'uniacid'     => $_W['uniacid'],
				'user_id'     => $uid,
				'sn'          => $sn,
				'paid_money'  => $member_level['price'],
				'type'        => 1,
				'other_id'    => $mlid,
				'create_time' => $time,
				'paid_time'   => $time,
				'status'      => 1,
				'form_id'     => $form_id,
				'order_info'  => json_encode($order_info),
			];

			pdo_insert(sl_table_name('order'), $data);
			pdo_update(sl_table_name('user'), ['member_level_id' => $mlid], ['id' => $uid]);
			pdo_commit();

			sl_ajax(0, 'ok');
		} catch (Exception $e) {

			sl_ajax(1, '更新会员信息失败,' . $e->getMessage());
		}
	}

	public function doPageMemberInfo()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$user['due_time'] = empty($user['due_time']) ? '' : date('Y-m-d', $user['due_time']);
		if (!empty($user['member_level_id']))
		{
			$user['memberLevelName'] = pdo_getcolumn(sl_table_name('member_level'), ['id' => $user['member_level_id']], 'name');
		}

		$time = time();
		$sql = "SELECT uc.id,uc.type,uc.left_times,uc.due_time,mc.name FROM " . sl_table_name('user_card',TRUE) . " AS uc " .
			"LEFT JOIN " . sl_table_name('member_card',TRUE) . " AS mc ON mc.id = uc.card_id " .
			"WHERE uc.user_id = ${user['id']} AND (" .
			"((uc.type = 3 OR uc.type = 5) AND uc.left_times > 0 AND (uc.due_time IS NULL OR uc.due_time > $time))" .
			") ORDER BY uc.due_time IS NULL,uc.due_time,uc.left_times";
		$user['cards'] = pdo_fetchall($sql);
		$user['member_level'] = self::getZdyOne($_W['uniacid'], 'member_level');

		sl_ajax(0, $user);
	}

	/** 购买私教 */
	public function doPageBuyPrivateCoach()
	{
		global $_GPC, $_W;
		$uhtn = sl_table_name('user');

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		$cid       = trim($_GPC['cid']);
		$real_name = trim($_GPC['name']);
		$tel       = trim($_GPC['tel']);
		$num       = intval($_GPC['number']);
		$form_id   = trim($_GPC['formID']);
		$ssid      = trim($_GPC['ssid']); // 门店ID

		$coach = pdo_get(sl_table_name('coach'), ['id' => $cid]);
		if (empty($coach)) {
			sl_ajax(1, '私教不存在');
		}
		$coach['avatar_format'] = tomedia($coach['avatar']);

		if ($coach['course_num_lower'] > $num) {
			sl_ajax(1, '课时数小于最低课时数' . $coach['course_num_lower']);
		}

		if (empty($real_name)) {
			sl_ajax(1, '姓名不能为空');
		}
		if (empty($tel)) {
			sl_ajax(1, '电话不能为空');
		} else {
			$g = "/^1[34578]\d{9}$/";
			if (preg_match($g, $tel)) {
				$tel = $tel;
			} else {
				sl_ajax(1, '请输入一个合法的手机号');
			}
		}

		if (empty($user['real_name'])) {
			$data_update['real_name'] = $real_name;
			$user['real_name'] = $real_name;
		}
		if (empty($user['tel'])) {
			$data_update['tel'] = $tel;
			$user['tel'] = $tel;
		}
		if ($data_update) {
			pdo_update(sl_table_name('user'), $data_update, ['id' => $uid]);
		}

		$fee = $coach['price'] * $num;
		$balance = $user['balance'];
		$time = time();

		$data_private_coach_buy = [
			'uniacid'    => $_W['uniacid'],
			'user_id'    => $uid,
			'coach_id'   => $cid,
			'time'       => $time,
			'num'        => $num,
			'left_times' => $num,
		];
		pdo_insert(sl_table_name('private_coach_buy'), $data_private_coach_buy);
		$pcbid = pdo_insertid();

		// 获取门店
		if (empty($coach['store_info'])) {
			sl_ajax(1, '服务还没有加入门店，请联系管理员添加');
		}

		$where_store = ['uniacid'=>$_W['uniacid'], 'id'=>$ssid, 'delete'=>'0'];
		$one_store = pdo_get(sl_table_name('store'), $where_store);
		if (empty($one_store)) {
			sl_ajax(1, '门店没有启用或已删除');
		}

		$way = [];
		$order_info = [];
		$order_info['coach']     = $coach;
		$order_info['user']      = $user;
		$order_info['post']      = ['user'=>$real_name, 'tel'=>$tel];
		$order_info['store']     = $one_store;
		$order_info['pcb_money'] = [
			'price'       => $coach['price'],
			'number'      => $num,
			'total_price' => $fee,
			'balance'     => $balance,
		];

		$order_sn = 'SLWL' . $_W['slwl']['datetime']['nowYmdHis'] . str_pad('1', 6, '0', STR_PAD_LEFT);

		//余额足够支付
		if ($fee <= $balance) {
			$way = [
				'way'=>'balance', 'name'=>'余额/微信支付'
			];
			$order_info['pay_way'] = $way;

			try {
				pdo_begin();
				pdo_update($uhtn, ['balance' => $balance - $fee], ['id' => $user['id']]);
				$data = [
					'uniacid'     => $_W['uniacid'],
					'user_id'     => $uid,
					'create_time' => $time,
					'paid_money'  => $fee,
					'other_id'    => $cid,
					'paid_time'   => $time,
					'status'      => 2,
					'type'        => 3,
					'order_info'  => json_encode($order_info),
					'sn'          => $order_sn,
					'form_id'     => $form_id,
					'store_id'    => $ssid,
				];
				pdo_insert(sl_table_name('order'), $data);
				$orderId = pdo_insertid();
				pdo_update(sl_table_name('private_coach_buy'), ['order_id' => $orderId],
					['id' => $pcbid]);

				$data_log = [
					'uniacid'   => $_W['uniacid'],
					'user_id'   => $uid,
					'create'    => $time,
					'type'      => 2,
					'subtype'   => 4,
					'money'     => $fee,
					'order_id'  => $orderId,
					'post_info' => json_encode(['real_name'=>$real_name,'tel'=>$tel], JSON_UNESCAPED_UNICODE),
				];
				pdo_insert(sl_table_name('log'), $data_log);

				// 分销记录
				$rst = sl_jsf_commission_rebate($uid, $orderId, $fee * 100, 'coach');
				if ($rst && $rst['code'] != 0) {
					@putlog('健身房-分销回扣记录', $rst['msg']);
				}

				pdo_commit();

				$data_wxrss = [
					'type'              => 'buy_coach_video',
					'user'              => $user,
					'character_string3' => $order_sn,
					'thing7'           => '购买私教课程-'.$coach['name'].$num.'节',
					'date4'             => $_W['slwl']['datetime']['now'],
					'amount5'           => '￥' . $fee,
				];
				sl_rss_send($data_wxrss); // 发送消息

				$data_bak = [
					'id' => $orderId,
				];

				sl_ajax(0, $data_bak);
			} catch (Exception $e) {
				pdo_rollback();

				sl_ajax(1, '购买私教失败，' . $e->getMessage());
			}
		}

		$fee -= $balance;
		$tid = date('YmdHis') . substr(md5(rand(10000, 10000000)), 0, 10);
		$rst = self::getPayParams($fee * 100, $tid, $user);
		if ($rst['code'] != '0') {
			sl_ajax(1, '生成支付信息失败-' . $rst['msg']);
		}
		$data_bak['payParam'] = json_decode($rst['data'], TRUE);
		$data_bak['payParam']['pcbid'] = $pcbid;

		try {
			pdo_begin();
			pdo_update($uhtn, ['balance' => 0], ['id' => $uid]);

			$data_log = [
				'uniacid'      => $_W['uniacid'],
				'user_id'      => $uid,
				'other_id'     => $cid,
				'type'         => 2,
				'create'       => $time,
				'subtype'      => 4,
				'money'        => $balance,
				'money_wechat' => $fee,
				'post_info'    => json_encode(['real_name'=>$real_name,'tel'=>$tel], JSON_UNESCAPED_UNICODE),
			];
			pdo_insert(sl_table_name('log'), $data_log);
			$data_bak['payParam']['lid'] = pdo_insertid();
			pdo_commit();
		} catch (Exception $e) {
			pdo_rollback();

			sl_ajax(1, '购买私教失败，' . $e->getMessage());
		}

		sl_ajax(0, $data_bak);
	}

	/**
	 * 购买私教失败，退回可能的余额
	 * 可能是用户取消
	 * 也可能是其他
	 */
	public function doPagePrivateCoachBuyFail()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$log_id = intval($_GPC['lid']); // 日志表ID
		$pcb_id = intval($_GPC['pcbid']); // 购买私教ID

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		if (empty($pcb_id)) { sl_ajax(1, '购买私教ID不存在'); }
		if (empty($log_id)) { sl_ajax(1, '日志表ID不存在'); }

		pdo_delete(sl_table_name('private_coach_buy'), ['id' => $_GPC['pcbid']]);

		$lid = intval($_GPC['lid']);
		$lhtn = sl_table_name('log');
		$log = pdo_get($lhtn, ['id' => $lid]);

		pdo_update(sl_table_name('user'), ['balance +='=>$log['money']], ['id'=>$uid]);

		pdo_delete($lhtn, ['id' => $lid]);

		sl_ajax(0, 'ok');
	}

	/** 购买私教成功 */
	public function doPagePrivateCoachBuySuccess()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);


		$time = time();
		$pcbid = $_GPC['pcbid']; // 购买记录ID
		$cid = $_GPC['cid']; // 教练ID
		$lid = $_GPC['lid']; // 日志表ID
		$pcbhtn = sl_table_name('private_coach_buy');

		// 购买私教表
		$one_pcb = pdo_get($pcbhtn, ['id'=>$pcbid]);
		if (empty($one_pcb)) {
			sl_ajax(1, '购买私教不存在');
		}

		// 日志表
		$one_log = pdo_get(sl_table_name('log'), ['id'=>$lid]);
		if (empty($one_pcb)) {
			sl_ajax(1, '购买私教不存在');
		}

		// 私教
		$coach = pdo_get(sl_table_name('coach'), ['id'=>$one_pcb['coach_id']]);
		if (empty($coach)) {
			sl_ajax(1, '私教不存在');
		}

		$fee = pdo_getcolumn(sl_table_name('coach'), ['id' => $cid], 'price');
		$num = pdo_getcolumn($pcbhtn, ['id' => $pcbid], 'num');
		$fee *= $num;
		// if (!empty($lid)) {
		// 	$fee += pdo_getcolumn(sl_table_name('log'), ['id' => $lid], 'money');
		// }

		try {
			pdo_begin();

			$one_log_post = json_decode($one_log['post_info'], TRUE);
			$real_name = '';
			$tel = '';
			if ($one_log_post) {
				$real_name = $one_log_post['real_name'];
				$tel = $one_log_post['tel'];
			}

			$order_info = [];
			$order_info['coach'] = $coach;
			$order_info['user'] = $user;
			$order_info['post'] = ['user'=>$real_name, 'tel'=>$tel];
			$order_info['pcb_money'] = ['price'=>$coach['price'],'number'=>$num,'total_price'=>$fee,'balance'=>$one_log['money']];

			$order_sn = 'SLWL' . $_W['slwl']['datetime']['nowYmdHis'] . str_pad('1', 6, '0', STR_PAD_LEFT);
			$way = ['way'=>'balance', 'name'=>'余额/微信支付'];
			$order_info['pay_way'] = $way;

			$data_order = [
				'user_id'     => $user['id'],
				'create_time' => $time,
				'paid_time'   => $time,
				'paid_money'  => $fee,
				'uniacid'     => $_W['uniacid'],
				'sn'          => $order_sn,
				'status'      => 2,
				'type'        => 3,
				'order_info'  => json_encode($order_info),
				'other_id'    => $cid,
			];

			pdo_insert(sl_table_name('order'), $data_order);
			$order_id = pdo_insertid();

			pdo_update($pcbhtn, ['order_id' => $order_id], ['id' => $pcbid]);
			if (!empty($lid)) {
				pdo_update(sl_table_name('log'),['order_id' => $order_id],['id' => $lid]);
			}

			// 分销记录
			$rst = sl_jsf_commission_rebate($uid, $order_id, $fee * 100, 'coach');
			if ($rst && $rst['code'] != 0) {
				@putlog('健身房-分销回扣记录', $rst['msg']);
			}

			pdo_commit();

			self::addBuyCommission($user['id'], $fee, $_W['uniacid'], $order_id);

			$data_wxrss = [
				'type'              => 'buy_coach_video',
				'user'              => $user,
				'character_string3' => $order_sn,
				'thing7'           => '购买私教课程-'.$coach['name'].$num.'节',
				'date4'             => $_W['slwl']['datetime']['now'],
				'amount5'           => '￥' . $fee,
			];
			sl_rss_send($data_wxrss); // 发送消息

			$data_bak = [
				'id' => $order_id,
			];

			sl_ajax(0, $data_bak);
		} catch (Exception $e) {
			pdo_rollback();

			sl_ajax(1, '购买私教失败，请联系客服，' . $e->getMessage());
		}
	}

	// 签到列表
	public function doPageSignInList()
	{
		global $_GPC, $_W;

		$type = $_GPC['type'];
		$uid = intval($_GPC['uid']);

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		switch ($type) {
			case 'coach':
				$pcbtn = sl_table_name('private_coach_buy',TRUE);
				$ctn = sl_table_name('coach',TRUE);
				$fields = "pcb.id,pcb.order_id,pcb.num,pcb.left_times,c.avatar,c.name,c.id as coach_id,c.wechat,c.tel,c.avatar,c.simple";
				$list = pdo_fetchall("SELECT $fields FROM $pcbtn AS pcb " .
					"LEFT JOIN $ctn AS c ON c.id = pcb.coach_id " .
					"WHERE pcb.user_id = $uid");
					// "WHERE pcb.left_times > 0 AND pcb.user_id = $uid");

				$coach_list = [];

				if ($list) {
					foreach ($list as $key => $value) {
						$list[$key]['avatar_format'] = tomedia($value['avatar']);
					}

					// 签到列表.start
					$day = new DateTime();
					$day->setTimestamp($_W['slwl']['datetime']['timestamp']);
					$day->setTime(0, 0, 0);
					$dayStart = $day->getTimestamp();
					$day->setTime(23, 59, 59);
					$dayEnd = $day->getTimestamp();

					$ids_signin = sl_array_column($list, 'id');

					$where = [
						'uniacid'     => $_W['uniacid'],
						'user_id'     => $uid,
						'type'        => '1',
						'other_id IN' => $ids_signin,
						'time >='     => $dayStart,
						'time <='     => $dayEnd,
					];
					$list_signin = pdo_getall(sl_table_name('sign_in'), $where);
					// 签到列表.end

					$tmp = sl_array_column($list, 'coach_id');
					$term_coach = array_unique($tmp);

					$data_tmp = [];

					if ($term_coach) {
						$coach_id = 0;
						foreach ($term_coach as $key => $value) {
							foreach ($list as $k => $v) {
								if ($value == $v['coach_id']) {
									$v['id'] = $value;
									$data_tmp[$key]['coach'] = $v;
									break;
								}
							}
							foreach ($list as $k => $v) {
								if ($value == $v['coach_id']) {

									$v['status_signin'] = '0';
									foreach ($list_signin as $kk => $vv) {
										if ($v['id'] == $vv['other_id']) {
											$v['status_signin'] = '1';
											break;
										}
									}

									// $one = [
									//     'id'=>$v['id'],
									//     'left_times'=>$v['left_times'],
									// ];
									$data_tmp[$key]['items'][] = $v;
									continue;
								}
							}
						}

						foreach ($data_tmp as $key => $value) {
							$data_bak[] = $value;
						}
					}
				}

				break;

			case 'sc':
				$otn = sl_table_name('order',TRUE);
				$catn = sl_table_name('coach',TRUE);
				$ctn = sl_table_name('course',TRUE);
				$cptn = sl_table_name('course_plan',TRUE);
				$stn = sl_table_name('store',TRUE);
				$fields = "o.id,cp.start,cp.end,cp.end,o.status,c.name AS course,ca.avatar, ";
				$fields .= "s.id as store_id,s.name as store_name,ca.id AS coach_id,ca.name AS coach_name, ";
				$fields .= "cp.id as course_plan_id,c.show_image ";

				$list = pdo_fetchall("SELECT $fields FROM $otn AS o " .
					"LEFT JOIN $cptn AS cp ON cp.id = o.plan_id " .
					"LEFT JOIN $catn AS ca ON ca.id = cp.coach_id " .
					"LEFT JOIN $ctn AS c ON c.id = cp.course_id " .
					"LEFT JOIN $stn AS s ON s.id = cp.store_id " .
					"WHERE (o.type = 0 OR o.type IS NULL) AND o.user_id = $uid ");

				$time_start = (new DateTime())->setTimestamp($_W['slwl']['datetime']['timestamp'])->setTime(0, 0, 0)->getTimestamp();
				$time_end = (new DateTime())->setTimestamp($_W['slwl']['datetime']['timestamp'])->setTime(23, 59, 59)->getTimestamp();

				$ids_signin = sl_array_column($list, 'id');

				$where = [
					'uniacid'     => $_W['uniacid'],
					'user_id'     => $uid,
					'type'        => '0',
					'other_id IN' => $ids_signin,
					'time >='     => $time_start,
					'time <='     => $time_end,
				];
				$list_signin = pdo_getall(sl_table_name('sign_in'), $where);

				if ($list) {
					foreach ($list as $key => $value) {
						$list[$key]['status_signin'] = '0';
						foreach ($list_signin as $k => $v) {
							if ($value['id'] == $v['other_id']) {
								$list[$key]['status_signin'] = '1';
								break;
							}
						}

						if ($value['end'] >= $time_start && $value['end'] <= $time_end) {
							$list[$key]['signin_ok'] = '1';
						} else {
							$list[$key]['signin_ok'] = '0';
						}
						$list[$key]['avatar_format'] = tomedia($value['avatar']);
						$list[$key]['show_image_format'] = tomedia($value['show_image']);
					}
				}

				$data_bak = $list;

				break;

			default:
				sl_ajax(1, '未知的type参数：' . $_GPC['type']);
		}

		sl_ajax(0, $data_bak);
	}

	// 签到
	public function doPageSignIn()
	{
		global $_GPC, $_W;

		$type = $_GPC['type'];
		$id = intval($_GPC['id']); // 购买私教的ID  / 订单ID
		$left = intval($_GPC['left']); // 购买私教的节数

		if (empty($type)) { sl_ajax(1, '类型码不存在'); }

		$putlog = [];
		$putlog['type'] = $type;
		switch ($type) {
			case 'coach':
				$pcbRow = pdo_get(sl_table_name('private_coach_buy'), ['id' => $id], ['user_id', 'left_times']);
				$uid = $pcbRow['user_id'];
				$leftTimes = $pcbRow['left_times'];

				$putlog['private_coach_buy'] = $pcbRow;
				if ($leftTimes < 1 || $left != $leftTimes) {
					sl_ajax(1, '二维码已失效');
				}
				break;

			case 'sc':
				$order = pdo_get(sl_table_name('order'), ['id' => $id], ['id', 'user_id', 'status', 'end']);
				$putlog['order'] = $order;
				switch ($order['status']) {
					case 1:
					case 5:
						if ($order['end'] <= time()) {
							pdo_update(sl_table_name('order'), ['status' => 2], ['id' => $id]);
							sl_ajax(1, '二维码已失效');
						}
						break;

					case 2:
					case 3:
					case 4:
					default:
						sl_ajax(1, '订单状态不存在');
				}
				$uid = $order['user_id'];
				break;
		}

		if (empty($uid)) { sl_ajax(1, '用户不存在'); }

		$data_bak = [];

		try {
			pdo_begin();
			switch ($type) {
				// 私教
				case 'coach':
					$cid = pdo_getcolumn(sl_table_name('private_coach_buy'), ['id' => $id], 'coach_id');

					pdo_query("UPDATE " . sl_table_name('private_coach_buy',TRUE) .
						" SET left_times = left_times - 1 WHERE left_times > 0 AND user_id = $uid AND id = $id");

					$data = [
						'uniacid'  => $_W['uniacid'],
						'user_id'  => $uid,
						'type'     => 1,
						'other_id' => $id,
						'coach_id' => $cid,
						'time'     => $_W['slwl']['datetime']['timestamp'],
					];
					pdo_insert(sl_table_name('sign_in'), $data);

					$coach = pdo_get(sl_table_name('coach'), ['id' => $cid], ['name', 'avatar']);
					$coach['avatar_format'] = tomedia($coach['avatar']);
					$data_bak['coach'] = $coach;

					break;


				// 团课
				case 'sc':
					$field = ' c.id,o.subtype,o.paid_money,c.name,c.show_image,cp.start,cp.end,cp.coach_id ';
					$res = pdo_fetch("SELECT " . $field . " FROM " . sl_table_name('order',TRUE) . " AS o " .
						" LEFT JOIN " . sl_table_name('course_plan',TRUE) . " AS cp ON cp.id = o.plan_id " .
						" LEFT JOIN " . sl_table_name('course',TRUE) . " AS c ON c.id = cp.course_id " .
						"WHERE o.id = $id");
					if ($res['subtype'] == 127) {
						$addCommission = TRUE;
					}

					$coach = pdo_get(sl_table_name('coach'), ['id' => $res['coach_id']], ['id', 'name', 'avatar']);
					$coach['avatar_format'] = tomedia($coach['avatar']);
					$data_bak['coach'] = $coach;

					pdo_update(sl_table_name('order'), ['status' => 2], ['id' => $id]);

					$data = [
						'uniacid'   => $_W['uniacid'],
						'user_id'   => $uid,
						'type'      => 0,
						'other_id'  => $id,
						'course_id' => $res['id'],
						'coach_id'  => $coach['id'],
						'time'      => $_W['slwl']['datetime']['timestamp'],
					];
					pdo_insert(sl_table_name('sign_in'), $data);

					$res['show_image_format'] = tomedia($res['show_image']);

					$data_bak['sc'] = $res;

					break;
				default:
					sl_ajax(1, '课程类型不存在');
			}
			pdo_commit();
			if (!empty($addCommission)) {
				self::addBuyCommission($uid, $res['paid_money'], $_W['uniacid'], $id);
			}

			$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['nickname', 'avatar']);

			$user['nickname'] = sl_nickname($user['nickname']);
			$user['avatar_format'] = tomedia($user['avatar']);
			$data_bak['user'] = $user;

			@putlog('签到', $putlog);


			sl_ajax(0, $data_bak);
		} catch (Exception $e) {
			pdo_rollback();

			@putlog('签到', '签到失败'.$e->getMessage());

			sl_ajax(1, '签到失败.' . $e->getMessage());
		}
	}

	// 签到check
	public function doPageSL_SignInCheck()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$id = intval($_GPC['id']); // 购买私教ID / 约课订单ID
		$type = $_GPC['type'];

		if (empty($type) || ($type!='sc' && $type!='coach')) {
			sl_ajax(1, '类型不能为空');
		}

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$day = new DateTime();
		$day->setTimestamp($_W['slwl']['datetime']['timestamp']);
		$day->setTime(0, 0, 0);
		$dayStart = $day->getTimestamp();
		$day->setTime(23, 59, 59);
		$dayEnd = $day->getTimestamp();


		if ($type == 'sc') {
			$where = [
				'uniacid'  => $_W['uniacid'],
				'user_id'  => $uid,
				'type'     => '0',
				'other_id' => $id,
				'time >='  => $dayStart,
				'time <='  => $dayEnd,
			];
		} else if ($type == 'coach') {
			$where = [
				'uniacid'  => $_W['uniacid'],
				'user_id'  => $uid,
				'type'     => '1',
				'other_id' => $id,
				'time >='  => $dayStart,
				'time <='  => $dayEnd,
			];
		}

		$one = pdo_get(sl_table_name('sign_in'), $where);

		if ($one) {
			if ($type == 'sc') {
				sl_ajax(0, '签到成功');
			} else if ($type == 'coach') {
				$where_coach = [
					'id' => $one['other_id'],
				];
				$one_coach = pdo_get(sl_table_name('private_coach_buy'), $where_coach);
				sl_ajax(0, $one_coach);
			}
		} else {
			sl_ajax(2, '没有签到');
		}
	}

	public function doPageCommissionInfo()
	{
		global $_GPC, $_W;

		$uhtn = sl_table_name('user');
		$uid = pdo_getcolumn($uhtn, ['openid' => $_W['openid']], 'id');
		if (empty($uid)) {
			sl_ajax(1, '用户不存在');
		}
		$lock = self::getCommissionLock($uid);
		try {
			$lock->lock();
			$info = pdo_get($uhtn, ['id' => $uid], ['commission']);
			$lock->unlock();

			sl_ajax(0, $info);
		} catch (Exception$e) {
			$lock->unlock();

			sl_ajax(1, '获取分销信息失败，' . $e->getMessage());
		}
	}

	public function doPageVideoPageInfo()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$vctn = sl_table_name('video_course',TRUE);
		$aUniConStr = " a.uniacid='$sluni' ";
		$bUniConStr = " b.uniacid='$sluni' ";
		$sql = "SELECT a.id,a.category,a.name,a.cover,a.price FROM $vctn AS a WHERE $aUniConStr AND a.delete = 0 AND " .
			"6 > (SELECT COUNT(*) FROM $vctn AS b WHERE $bUniConStr AND b.category = a.category AND a.id < b.id) " .
			"ORDER BY category,id";
		$videoCourseList = pdo_fetchall($sql);
		foreach ($videoCourseList as &$item) {
			$item['cover'] = tomedia($item['cover']);
		}

		$uniConStr = " uniacid='$sluni' ";
		$categoryList = pdo_fetchall("SELECT id,`name`,icon FROM " . sl_table_name('category',TRUE) .
			" WHERE $uniConStr ORDER BY `sort` DESC LIMIT 0,4");
		foreach ($categoryList as &$item) {
			$item['icon'] = tomedia($item['icon']);
		}

		$tohomeList = pdo_fetchall("SELECT id,slides FROM $vctn WHERE $uniConStr AND recommend>'0' ORDER BY recommend DESC LIMIT 0,10");
		foreach ($tohomeList as &$item) {
			$slides = json_decode($item['slides'], TRUE);
			$item['slides'] = empty($slides) ? '' : tomedia($slides[0]);
		}

		$one = [
			'categoryList' => $categoryList,
			'videoCourseList' => $videoCourseList,
			'tohomeList' => $tohomeList,
		];

		sl_ajax(0, $one);
	}

	public function doPageVideoCourseInfo()
	{
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$course = pdo_get(sl_table_name('video_course'), ['id' => $id]);
		$course['priceText'] = bcdiv($course['price'], 100, 2);
		$slides = json_decode($course['slides']);
		foreach ($slides as &$item) {
			$item = tomedia($item);
		}
		$course['slides'] = $slides;
		$videos = pdo_getall(sl_table_name('course_video'), ['course_id' => $id], '', '', ['sequence']);
		foreach ($videos as &$item) {
			$item['cover'] = tomedia($item['cover']);
			$item['url'] = tomedia($item['url']);
		}
		$bought = pdo_getcolumn(sl_table_name('order'), ['type' => 4, 'status' => 2, 'other_id' => $id], 'id');

		$data_bak = [
			'course' => $course,
			'videos' => $videos,
			'bought' => $bought,
		];

		sl_ajax(1, $data_bak);
	}

	public function doPageCategoryVideoCourseList()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$cid = intval($_GPC['id']);
		$uniConStr = " uniacid='$sluni' ";
		$list = pdo_fetchall("SELECT id,`name`,cover,price FROM " . sl_table_name('video_course',TRUE) .
			" WHERE {$uniConStr} AND category = $cid AND `delete` = 0");
		foreach ($list as &$item) {
			$item['cover'] = tomedia($item['cover']);
		}

		sl_ajax(0, $list);
	}

	/**
	 * 购买视频课程
	 * vcid = 视频课程ID
	 * name = 真实姓名
	 * tel = 电话
	 */
	public function doPageBuyVideoCourse()
	{
		global $_GPC, $_W;
		$uid = intval($_GPC['uid']); // 用户ID
		$ssid = intval($_GPC['ssid']); // 门店ID

		$param_json = $_GPC['__input']; // 参数
		$time = $_W['slwl']['datetime']['timestamp'];

		if ($param_json) {
			// 视频课程ID
			$id_video_course = isset($param_json['vcid']) ? trim($param_json['vcid']) : '';
			// 真实姓名
			$real_name = isset($param_json['name']) ? trim($param_json['name']) : '';
			// 电话
			$tel = isset($param_json['tel']) ? trim($param_json['tel']) : '';
			// formID
			$form_id = isset($param_json['formID']) ? trim($param_json['formID']) : '';
		}

		$fee = 0;
		$video_course = pdo_get(sl_table_name('video_course'), ['id'=>$id_video_course]);
		if (empty($video_course)) {
			sl_ajax(1, '视频课程不存在');
		}
		$video_course['price_format'] = number_format($video_course['price'] / 100, 2);
		$video_course['cover_format'] = tomedia($video_course['cover']);


		// if (empty($video_course['price'])) {
		// 	sl_ajax(1, '课程是免费的');
		// }

		// 获取门店
		if (empty($video_course['store_info'])) {
			sl_ajax(1, '服务还没有加入门店，请联系管理员添加');
		}

		$where_store = ['uniacid'=>$_W['uniacid'], 'id'=>$ssid, 'delete'=>'0'];
		$one_store = pdo_get(sl_table_name('store'), $where_store);
		if (empty($one_store)) {
			sl_ajax(1, '门店没有启用或已删除');
		}


		$uhtn = sl_table_name('user');
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		$balance = $user['balance']; // 单位=元

		$fee = $video_course['price'] / 100; // 单位=元

		$order_info = []; // 订单信息

		$order_info['user'] = $user;
		$order_info['video_course'] = $video_course;

		$order_sn = 'SLWL' . $_W['slwl']['datetime']['nowYmdHis'] . str_pad('1', 6, '0', STR_PAD_LEFT);

		if (empty($user['real_name'])) {
			$data_update = ['real_name'=>$real_name];
		}
		if (empty($user['tel'])) {
			$data_update = ['tel'=>$tel];
		}
		if ($data_update) {
			pdo_update(sl_table_name('user'), $data_update, ['id'=>$uid]);
		}
		$order_info['post'] = ['user'=>$real_name, 'tel'=>$tel];
		$order_info['store'] = $one_store;

		// 余额足够支付
		if ($fee <= $balance) {
			$way = [
				'way'=>'balance', 'name'=>'余额/微信支付'
			];
			$order_info['pay_way'] = $way;

			try {
				pdo_begin();
				pdo_update($uhtn, ['balance'=>$balance - $fee], ['id'=>$user['id']]); // 更新用户余额

				$data_instert = [
					'uniacid'     => $_W['uniacid'],
					'user_id'     => $uid,
					'create_time' => $time,
					'paid_money'  => $fee,
					'other_id'    => $id_video_course,
					'paid_time'   => $time,
					'status'      => '2',
					'type'        => '4',
					'order_info'  => json_encode($order_info),
					'sn'          => $order_sn,
					'form_id'     => $form_id,
					'store_id'    => $ssid,
				];
				pdo_insert(sl_table_name('order'), $data_instert);
				$order_id = pdo_insertid();

				pdo_insert(sl_table_name('log'),
					[
						'uniacid'  => $_W['uniacid'],
						'user_id'  => $uid,
						'create'   => $time,
						'type'     => 2,
						'subtype'  => 5,
						'money'    => $fee,
						'order_id' => $order_id,
						'other_id' => $id_video_course,
					]
				);

				// 分销记录
				$rst = sl_jsf_commission_rebate($uid, $order_id, $fee * 100, 'video');
				if ($rst && $rst['code'] != 0) {
					@putlog('健身房-分销回扣记录', $rst['msg']);
				}

				pdo_commit();

				// $rst = sl_tpl_send_buy_video($order_id);

				$data_wxrss = [
					'type'              => 'buy_coach_video',
					'user'              => $user,
					'character_string3' => $order_sn,
					'thing7'           => '购买视频课程-'.$video_course['name'],
					'date4'             => $_W['slwl']['datetime']['now'],
					'amount5'           => '￥' . $fee,
				];
				sl_rss_send($data_wxrss); // 发送消息

				$data_bak = [
					'id' => $order_id,
					'sn' => $order_sn,
				];

				sl_ajax(0, $data_bak);

			} catch (Exception $e) {
				pdo_rollback();

				sl_ajax(1, '购买视频教程失败，' . $e->getMessage());
			}
		}

		// 余额不足
		$fee = bcsub($fee, $balance, 2);

		// $tid = date('YmdHis') . substr(md5(rand(10000, 10000000)), 0, 10);
		$rst = self::getPayParams($fee * 100, $order_sn, $user);
		if ($rst['code'] != '0') {
			sl_ajax(1, '生成支付信息失败-' . $rst['msg']);
		}
		$data_bak['payParam'] = json_decode($rst['data'], TRUE);

		try {
			pdo_begin();
			pdo_update($uhtn, ['balance'=>0], ['id'=>$uid]);

			$data_log = [
				'uniacid'      => $_W['uniacid'],
				'user_id'      => $uid,
				'type'         => 2,
				'create'       => $time,
				'subtype'      => 5,
				'money'        => $balance,
				'money_wechat' => $fee,
				'other_id'     => $id_video_course,
				'post_info'    => json_encode(['real_name'=>$real_name,'tel'=>$tel], JSON_UNESCAPED_UNICODE),
			];
			pdo_insert(sl_table_name('log'), $data_log);
			$data_bak['payParam']['lid'] = pdo_insertid();
			$data_bak['payParam']['ordersn'] = $order_sn;

			pdo_commit();

			sl_ajax(0, $data_bak);
		} catch (Exception $e) {
			pdo_rollback();

			sl_ajax(1, '购买视频课程失败，' . $e->getMessage());
		}

		sl_ajax(0, $data_bak);
	}

	/**
	 * 购买视频课程成功
	 * lid = 日志表ID
	 * ordersn = 订单SN
	 */
	public function doPageBuyVideoCourseSuccess()
	{
		global $_GPC, $_W;
		$uid = intval($_GPC['uid']);
		$time = $_W['slwl']['datetime']['timestamp'];

		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}
		$user['nickname'] = sl_nickname($user['nickname']);

		$lid = $_GPC['lid']; // 日志表ID

		if (empty($lid)) {
			sl_ajax(1, '日志表ID不存在');
		}

		$one_log = pdo_get(sl_table_name('log'), ['id'=>$lid]);
		if (empty($one_log)) {
			sl_ajax(1, '日志表信息不存在');
		}
		$fee = 0;
		$fee = $$one_log['money'] + $one_log['money_wechat'];

		$video_course = pdo_get(sl_table_name('video_course'), ['id'=>$one_log['other_id']]);
		if (empty($video_course)) {
			sl_ajax(1, '视频课程不存在');
		}
		$video_course['price_format'] = number_format($video_course['price'] / 100, 2);
		$video_course['cover_format'] = tomedia($video_course['cover']);

		try {
			pdo_begin();

			$order_info = []; // 订单信息

			$one_log_post = json_decode($one_log['post_info'], TRUE);
			$real_name = '';
			$tel = '';
			if ($one_log_post) {
				$real_name = $one_log_post['real_name'];
				$tel = $one_log_post['tel'];
			}

			$order_info['video_course'] = $video_course;
			$order_info['user'] = $user;
			$order_info['post'] = ['user'=>$real_name, 'tel'=>$tel];

			$order_sn = 'SLWL' . $_W['slwl']['datetime']['nowYmdHis'] . str_pad('1', 6, '0', STR_PAD_LEFT);
			$way = ['way'=>'balance', 'name'=>'余额/微信支付'];
			$order_info['pay_way'] = $way;

			$data_order = [
				'uniacid'     => $_W['uniacid'],
				'user_id'     => $user['id'],
				'create_time' => $time,
				'paid_money'  => $fee,
				'other_id'    => $one_log['other_id'],
				'paid_time'   => $time,
				'status'      => 2,
				'type'        => 4,
				'order_info'  => json_encode($order_info),
				'sn'          => $order_sn,
			];

			// 插入订单
			pdo_insert(sl_table_name('order'), $data_order);
			$order_id = pdo_insertid();

			// 更新日志表订单号
			pdo_update(sl_table_name('log'), ['order_id'=>$order_id], ['id'=>$lid]);

			// 更新视频购买次数
			pdo_update(sl_table_name('video_course'), ['buy_count +='=>'1'], ['id'=>$one_log['other_id']]);

			// 分销记录
			$rst = sl_jsf_commission_rebate($uid, $order_id, $fee * 100, 'video');
			if ($rst && $rst['code'] != 0) {
				@putlog('健身房-分销回扣记录', $rst['msg']);
			}

			pdo_commit();

			$data_wxrss = [
				'type'              => 'buy_coach_video',
				'user'              => $user,
				'character_string3' => $order_sn,
				'thing7'           => '购买视频课程-'.$video_course['name'],
				'date4'             => $_W['slwl']['datetime']['now'],
				'amount5'           => '￥' . $fee,
			];
			sl_rss_send($data_wxrss); // 发送消息

			$data_bak = [
				'id' => $order_id,
			];

			sl_ajax(0, $data_bak);
		} catch (Exception $e) {
			pdo_rollback();

			sl_ajax(1, '购买视频课程失败，请联系客服，' . $e->getMessage());
		}
	}

	/**
	 * 购买视频课程失败
	 * lid = 日志表ID
	 * ordersn = 订单SN
	 */
	public function doPageBuyVideoCourseFail()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$lid = intval($_GPC['lid']); // 日志表ID
		$order_sn = $_GPC['ordersn']; // 订单SN

		if (empty($lid)) { sl_ajax(1, '日志表ID不存在'); }
		if (empty($order_sn)) { sl_ajax(1, '订单ID不存在'); }

		try {
			pdo_begin();

			$log = pdo_get(sl_table_name('log'), ['id'=>$lid]);

			pdo_update(sl_table_name('user'), ['balance +='=>$log['money']], ['id'=>$uid]);

			pdo_delete(sl_table_name('log'), ['id'=>$lid]);
			pdo_commit();

			sl_ajax(0, 'ok');
		} catch (Exception $e) {
			pdo_rollback();

			sl_ajax(1, '购买视频回滚失败，' . $e->getMessage());
		}
	}

	public function doPagePersonalInfo()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		if ($user['id_card_image']) {
			$user['id_card_image_format'] = tomedia($user['id_card_image']);
		}
		if ($user['image']) {
			$user['image_format'] = tomedia($user['image']);
		}

		$zdy = pdo_getcolumn(sl_table_name('system_settings'), ['uniacid' => $_W['uniacid']], 'zdy');

		$data_bak = [
			'user'=>$user,
			'zdy'=>json_decode($zdy, TRUE),
		];

		sl_ajax(0, $data_bak);
	}

	public function doPageSavePersonalInfo()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		// foreach (['tel', 'image', 'phone'] as $k) {
		//     if (!empty($_GPC[$k])) $data[$k] = $_GPC[$k];
		// }
		$data = [];
		$tel       = trim($_GPC['phone']);
		$image     = trim($_GPC['photoSrc']);
		$id_number = trim($_GPC['idNumber']);
		$name      = trim($_GPC['name']);
		$idCard    = trim($_GPC['idImgSrc']);
		$gender    = intval(trim($_GPC['gender']));

		if ($tel) {
			$g = "/^1[34578]\d{9}$/";
			if (preg_match($g, $tel)) {
				$data['tel'] = $tel;
			} else {
				sl_ajax(1, '请输入一个合法的手机号');
			}
		}
		if ($image) {
			$data['image'] = $image;
		}
		if ($id_number) {
			$data['id_no'] = $id_number;
		}
		if ($name) {
			$data['real_name'] = $name;
		}
		if ($idCard) {
			$data['id_card_image'] = $idCard;
		}
		foreach (['height', 'weight', 'waistline', 'thigh', 'bust', 'age'] as $k) {
			$v = $_GPC[$k];
			if ($v > 0) $data[$k] = $v;
		}
		if ($gender) {
			if ($gender >= 0 && $gender < 3) {
				$data['gender'] = $gender;
			}
		}
		if (!empty($data)) {
			pdo_update(sl_table_name('user'), $data, ['id' => $uid]);

			$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
			if (empty($user)) {
				sl_ajax(1, '读取用户信息出错');
			}

			$user['image_format'] = tomedia($user['image']);
			$user['id_card_image_format'] = tomedia($user['id_card_image']);

			sl_ajax(0, $user);
		} else {
			sl_ajax(1, '没有传入数据');
		}
	}

	public function doPageUploadFile()
	{
		global $_GPC, $_W;
		load()->func('file');
		$result = file_upload($_FILES['file']);

		if (is_error($result)) {
			sl_ajax(1, $result['message']);
		}
		file_remote_upload(ATTACHMENT_ROOT . $result['path']);

		sl_ajax(0, $result['path']);
	}

	public function doPageDeleteFile()
	{
		global $_GPC, $_W;
		load()->func('file');
		file_delete($_GPC['file']);

		sl_ajax(0, 'ok');
	}

	/**
	 * 预约记录
	 */
	public function doPageOrderList2()
	{
		global $_GPC, $_W;
		$sluni = $_W['uniacid'];

		$uid = intval($_GPC['uid']);
		$userInfo = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($userInfo)) {
			sl_ajax(1, '用户不存在');
		}

		$this->finishOrder();

		$uniacidConStr = " o.uniacid='$sluni' ";

		$condition_order = " AND uniacid=:uniacid AND user_id=:user_id ";
		$params_order = [':uniacid'=>$_W['uniacid'], ':user_id'=>$uid];
		$pindex_order = max(1, intval($_GPC['page']));
		$psize_order = 10;
		$sql_order = "SELECT * FROM " . sl_table_name('order',TRUE) . ' WHERE 1 '
			. $condition_order . " ORDER BY id DESC LIMIT "
			. ($pindex_order - 1) * $psize_order .',' .$psize_order;
		$list_order = pdo_fetchall($sql_order, $params_order);

		if ($list_order) {
			foreach ($list_order as $key => $value) {
				$list_order[$key]['order_info_format'] = json_decode($value['order_info']);
				unset($list_order[$key]['order_info']);
			}
		}

		sl_ajax(0, $list_order);
	}

	// 获取订单信息
	public function doPageOrderInfo()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']); // 用户ID
		$order_id = trim($_GPC['oid']); // 订单ID

		if (empty($order_id)) {
			sl_ajax(1, '订单号不能为空');
		}

		$user = pdo_get(sl_table_name('user'), ['id'=>$uid], ['id','balance','real_name','tel']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$one_order = pdo_get(sl_table_name('order'), ['id' => $order_id]);

		if (empty($one_order)) {
			sl_ajax(1, '订单不存在');
		}

		$one_log = pdo_get(sl_table_name('log'), ['order_id' => $one_order['id']]);

		$one_order['order_info_format'] = json_decode($one_order['order_info']);
		unset($one_order['order_info']);

		$one_order['one_log'] = $one_log;

		$data_bak = $one_order;

		sl_ajax(0, $data_bak);

	}

	/**
	 * 获取特定某一天的所有课程
	 */
	public function doPageDesignedDayCoursePlanList()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$store_id = intval($_GPC['ssid']); // 门店ID

		$userInfo = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);

		if (empty($userInfo)) {
			sl_ajax(1, '用户不存在');
		}

		$day = new DateTime();
		$day->setTimestamp(empty($_GPC['day'])?$_W['slwl']['datetime']['timestamp']:$_GPC['day']);
		$day->setTime(0, 0, 0);
		$dayStart = $day->getTimestamp();
		$dayEnd = $dayStart + (24 * 3600);

		// 所有教练
		$where = [
			'uniacid' => $_W['uniacid'],
			'user_id' => $uid,
		];
		$list = pdo_getall(sl_table_name('order'), $where);

		$condition_coach = " AND uniacid=:uniacid AND `delete`='0' ";
		$params_coach = array(':uniacid' => $_W['uniacid']);
		$list_coach = pdo_fetchall('SELECT * FROM ' . sl_table_name('coach',TRUE)
			. ' WHERE 1 ' . $condition_coach, $params_coach);

		if ($list_coach) {
			foreach ($list_coach as $k => $v) {
				$list_coach[$k]['avatar_format'] = tomedia($v['avatar']);
			}

			// 所有课程
			$flags = '';
			foreach ($list_coach as $item) {
				$flags .= $item['id'] . ',';
			}
			$flags = substr($flags, 0, strlen($flags)-1);
			if ($flags) {
				$where_course_plan =' AND coach_id IN(' . $flags . ')';
			}

			$condition_course_plan = " AND uniacid=:uniacid AND `delete`='0' AND `start`>=:timeStart AND `start`<:timeEnd ";
			if ($where_course_plan) {
				$condition_course_plan .= $where_course_plan;
			}
			$params_course_plan = [':uniacid'=>$_W['uniacid'], ':timeStart'=>$dayStart, ':timeEnd'=>$dayEnd];
			$pindex_course_plan = max(1, intval($_GPC['page']));
			$psize_course_plan = 1000;
			$sql_course_plan = "SELECT * FROM " . sl_table_name('course_plan',TRUE). ' WHERE 1 '
				. $condition_course_plan . " ORDER BY start ASC LIMIT "
				. ($pindex_course_plan - 1) * $psize_course_plan .',' .$psize_course_plan;
			$list_course_plan = pdo_fetchall($sql_course_plan, $params_course_plan);

			if ($list_course_plan) {
				// 排序，可以报名在前面，报名已截止在下面
				$tmp_arr_1 = [];
				$tmp_arr_2 = [];
				foreach ($list_course_plan as $key => $value) {
					if ($_W['slwl']['datetime']['timestamp'] > $value['book_end']) {
						$tmp_arr_2[] = $value;
					} else {
						$tmp_arr_1[] = $value;
					}
				}

				$list_course_plan = array_merge($tmp_arr_1, $tmp_arr_2);

				foreach ($list_course_plan as $k => $v) {
					foreach ($list_coach as $key => $value) {
						if ($v['coach_id'] == $value['id']) {
							$list_course_plan[$k]['coach'] = $value;
							break;
						}
					}
				}
			}

			// 门店信息
			$flags_store = '';
			foreach ($list_course_plan as $item) {
				$flags_store .= $item['store_id'] . ',';
			}
			$flags_store = substr($flags_store, 0, strlen($flags_store)-1);
			if ($flags_store) {
				$where_store =' AND id IN(' . $flags_store . ')';
			}

			$condition_store = " AND uniacid=:uniacid AND `delete`='0' ";
			if ($where_store) {
				$condition_store .= $where_store;
			}
			$params_store = array(':uniacid' => $_W['uniacid']);
			$list_store = pdo_fetchall('SELECT * FROM ' . sl_table_name('store',TRUE)
				. ' WHERE 1 ' . $condition_store, $params_store);

			if ($list_store) {
				foreach ($list_store as $k => $v) {
					$list_store[$k]['image_format'] = tomedia($v['image']);
				}

				foreach ($list_course_plan as $k => $v) {
					foreach ($list_store as $key => $value) {
						if ($v['store_id'] == $value['id']) {
							$list_course_plan[$k]['store'] = $value;
							break;
						}
					}
				}
			}

			// 课程列表
			$where_course = '';
			$flags_course = '';
			foreach ($list_course_plan as $item) {
				$flags_course .= $item['course_id'] . ',';
			}
			$flags_course = substr($flags_course, 0, strlen($flags_course)-1);
			if ($flags_course) {
				$where_course =' AND id IN(' . $flags_course . ')';
			}

			$condition_course = " AND uniacid=:uniacid AND `delete`='0' ";
			if ($where_course) {
				$condition_course .= $where_course;
			}
			$params_course = array(':uniacid' => $_W['uniacid']);
			$list_course = pdo_fetchall('SELECT * FROM ' . sl_table_name('course',TRUE)
				. ' WHERE 1 ' . $condition_course, $params_course);

			if ($list_course) {
				foreach ($list_course as $k => $v) {
					$list_course[$k]['show_image_format'] = tomedia($v['show_image']);
				}

				foreach ($list_course_plan as $k => $v) {
					$list_course_plan[$k]['del'] = '0';
					foreach ($list_course as $key => $value) {
						if ($v['course_id'] == $value['id']) {
							$list_course_plan[$k]['del'] = '1';
							$list_course_plan[$k]['course'] = $value;
							break;
						}
					}
					if ($list_course_plan[$k]['del'] == '0') {
						unset($list_course_plan[$k]);
					}
				}
			}

			// 订单信息
			$where_order = '';
			$flags_order = '';
			foreach ($list_course_plan as $item) {
				$flags_order .= $item['id'] . ',';
			}
			$flags_order = substr($flags_order, 0, strlen($flags_order)-1);
			if ($flags_order) {
				$where_order =' AND plan_id IN(' . $flags_order . ')';
			}

			$condition_order = " AND uniacid=:uniacid AND `delete`='0' AND `status`>'0' AND user_id=:user_id ";
			if ($where_order) {
				$condition_order .= $where_order;
			}
			$params_order = array(':uniacid' => $_W['uniacid'], ':user_id' => $uid);
			$list_order = pdo_fetchall('SELECT * FROM ' . sl_table_name('order',TRUE)
				. ' WHERE 1 ' . $condition_order, $params_order);

			if ($list_order) {
				foreach ($list_course_plan as $k => $v) {
					foreach ($list_order as $key => $value) {
						if ($v['id'] == $value['plan_id'] && $value['status'] != '3') {
							$list_course_plan[$k]['oid'] = $value['id'];
							$list_course_plan[$k]['order_id'] = $value['id'];
							break;
						}
					}
				}
			}

			// 排队列表
			$flags_book_queue = '';
			foreach ($list_course_plan as $item) {
				$flags_book_queue .= $item['id'] . ',';
			}
			$flags_book_queue = substr($flags_book_queue, 0, strlen($flags_book_queue)-1);
			if ($flags_book_queue) {
				$where_book_queue =' AND plan_id IN(' . $flags_book_queue . ')';
			}

			$condition_book_queue = " AND uniacid=:uniacid AND user_id=:user_id ";
			if ($where_book_queue) {
				$condition_book_queue .= $where_book_queue;
			}
			$params_book_queue = array(':uniacid' => $_W['uniacid'], ':user_id' => $uid);
			$list_book_queue = pdo_fetchall('SELECT * FROM ' . sl_table_name('book_queue',TRUE) . ' WHERE 1 '
				. $condition_book_queue, $params_book_queue);

			if ($list_book_queue) {
				// dump($list_book_queue);
				// exit;
				foreach ($list_course_plan as $k => $v) {
					foreach ($list_book_queue as $key => $value) {
						if ($v['id'] == $value['plan_id']) {
							$list_course_plan[$k]['myQueueID'] = $value['id'];
							break;
						}
					}
				}
			}

			if ($list_course_plan) {
				foreach ($list_course_plan as $k => $v) {
					$list_course_plan[$k]['avatar_format'] = tomedia($v['avatar']);
				}
			}
		} else {
			$list_course_plan = array();
		}

		self::filterCourseList($list_course_plan, $userInfo['member_level_id']);

		if ($list_course_plan) {
			foreach ($list_course_plan as $key => $value) {
				$list_course_plan[$key]['book_start_format'] = date('Y-m-d H:i:s', $value['book_start']);
				$list_course_plan[$key]['book_end_format'] = date('Y-m-d H:i:s', $value['book_end']);
				$list_course_plan[$key]['start_format'] = date('Y-m-d H:i:s', $value['start']);
				$list_course_plan[$key]['end_format'] = date('Y-m-d H:i:s', $value['end']);
			}
		}

		// 会员等级.start
		// 获取所有会员等级
		$condition_all_member_level = " AND uniacid=:uniacid AND `delete`='0' ";
		$params_all_member_level = array(':uniacid' => $_W['uniacid']);
		$list_all_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('member_level',TRUE) . ' WHERE 1 '
			. $condition_all_member_level, $params_all_member_level);

		$list_all_member_level[] = [
			'id'=>'0',
			'name'=>'普通会员',
		];


		$flags_member_level = '';
		foreach ($list_course_plan as $item) {
			$flags_member_level .= $item['course_id'] . ',';
		}
		$flags_member_level = substr($flags_member_level, 0, strlen($flags_member_level)-1);
		if ($flags_member_level) {
			$where_member_level =' AND course_id IN(' . $flags_member_level . ')';
		}
		$condition_member_level = " AND uniacid=:uniacid ";
		if ($where_member_level) {
			$condition_member_level .= $where_member_level;
		}
		$params_member_level = array(':uniacid' => $_W['uniacid']);
		$list_member_level = pdo_fetchall('SELECT * FROM ' . sl_table_name('course_member_level',TRUE) . ' WHERE 1 '
			. $condition_member_level . " ORDER BY id DESC", $params_member_level);

		if ($list_member_level) {
			// list会员等级加入中文
			// foreach ($list_member_level as $k => $v) {
			//     foreach ($list_all_member_level as $key => $value) {
			//         if ($v['member_level_id'] == $value['id']) {
			//             $list_member_level[$k]['name'] = $value['name'];
			//             break;
			//         }
			//     }
			// }

			foreach ($list_course_plan as $k => $v) {
				foreach ($list_member_level as $key => $value) {
					if ($v['course_id'] == $value['course_id']) {
						$list_course_plan[$k]['course']['member_level'][] = $value['id'];
					}
				}
			}
		} else {
			foreach ($list_course_plan as $k => $v) {
				$list_course_plan[$k]['course']['member_level'] = $list_all_member_level;
			}
		}
		// 会员等级.end


		// 支付方式.start
		$list_all_payment_way = $_W['slwl']['pay_way'];

		$flags_payment_way = '';
		foreach ($list_course_plan as $item) {
			$flags_payment_way .= $item['course_id'] . ',';
		}
		$flags_payment_way = substr($flags_payment_way, 0, strlen($flags_payment_way)-1);
		if ($flags_payment_way) {
			$where_payment_way =' AND course_id IN(' . $flags_payment_way . ')';
		}
		$condition_payment_way = " AND uniacid=:uniacid ";
		if ($where_payment_way) {
			$condition_payment_way .= $where_payment_way;
		}
		$params_payment_way = array(':uniacid' => $_W['uniacid']);
		$list_payment_way = pdo_fetchall('SELECT * FROM ' . sl_table_name('course_payment_way',TRUE) . ' WHERE 1 '
			. $condition_payment_way . " ORDER BY id DESC", $params_payment_way);

		if ($list_payment_way) {
			// // list支付方式加入中文
			// foreach ($list_payment_way as $k => $v) {
			//     foreach ($list_all_payment_way as $key => $value) {
			//         if ($v['payment_way'] == $value['way']) {
			//             $list_payment_way[$k]['name'] = $value['name'];
			//             break;
			//         }
			//     }
			// }

			foreach ($list_payment_way as $k => $v) {
				foreach ($list_all_payment_way as $key => $value) {
					if ($v['payment_way'] == $value['id']) {
						$list_payment_way[$k]['way'] = $value['way'];
						break;
					}
				}
			}
			foreach ($list_course_plan as $k => $v) {
				foreach ($list_payment_way as $key => $value) {
					if ($v['course_id'] == $value['course_id']) {
						$list_course_plan[$k]['course']['payment_way'][] = $value['way'];
						break;
					}
				}
			}
		} else {
			foreach ($list_course_plan as $k => $v) {
				$list_course_plan[$k]['course']['payment_way'] = $list_all_payment_way;
			}
		}
		// 支付方式.end

		// 只返回，指定门店的课程
		if ($store_id) {
			foreach ($list_course_plan as $k => $v) {
				if ($v['store_id'] != $store_id) {
					unset($list_course_plan[$k]);
				}
			}
		}

		$list_course_plan = array_values($list_course_plan);

		sl_ajax(0, $list_course_plan);
	}

	/**
	 * 获取指定课程的所有预约计划
	 */
	public function doPageDesignedCoursePlanList()
	{
		global $_GPC, $_W;

		$ssid = trim($_GPC['ssid']); // 门店ID

		$uid = intval($_GPC['uid']);
		$course_id = intval($_GPC['courseID']); // 课程ID

		$user = pdo_get(sl_table_name('user'), ['id' => $uid], ['id', 'member_level_id']);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		// 课程信息
		$one_course = pdo_get(sl_table_name('course'), ['id'=>$course_id]);
		if (empty($one_course)) {
			sl_ajax(1, '课程不存在');
		}
		$one_course['show_image_format'] = tomedia($one_course['show_image']);

		// 列表-课表
		$day = new DateTime();
		$day->setTimestamp(empty($_GPC['day'])?$_W['slwl']['datetime']['timestamp']:$_GPC['day']);
		$day->setTime(0, 0, 0);
		$dayStart = $day->getTimestamp();
		$dayEnd = $dayStart + (24 * 3600 * 7);

		$condition_course_plan = " AND uniacid=:uniacid AND `start`>=:timeStart "
			. " AND `start`<:timeEnd AND course_id=:course_id AND `delete`='0' "
			. " AND store_id =:store_id ";
		$params_course_plan = [
			':uniacid'   => $_W['uniacid'],
			':timeStart' => $dayStart,
			':timeEnd'   => $dayEnd,
			':course_id' => $course_id,
			':store_id'  => $ssid,
		];
		$pindex_course_plan = max(1, intval($_GPC['page']));
		$psize_course_plan = 1000;
		$sql_course_plan = "SELECT * FROM " . sl_table_name('course_plan',TRUE). ' WHERE 1 '
			. $condition_course_plan . " ORDER BY id DESC LIMIT "
			. ($pindex_course_plan - 1) * $psize_course_plan .',' .$psize_course_plan;
		$list_course_plan = pdo_fetchall($sql_course_plan, $params_course_plan);

		if ($list_course_plan) {
			foreach ($list_course_plan as $k => $v) {
				$list_course_plan[$k]['avatar_format'] = tomedia($v['avatar']);

				// 加入课程
				$list_course_plan[$k]['course'] = $one_course;
			}

			// 教练
			$ids_tmp = sl_array_column($list_course_plan, 'coach_id');
			$ids_coach = implode(',', $ids_tmp);
			if ($ids_coach) {
				$list_coach = pdo_fetchall("SELECT * FROM " . sl_table_name('coach',TRUE)
					. " WHERE id IN (" . $ids_coach . ")");

				if ($list_coach) {
					foreach ($list_coach as $k => $v) {
						$list_coach[$k]['avatar_format'] = tomedia($v['avatar']);
					}
					foreach ($list_course_plan as $k => $v) {
						foreach ($list_coach as $key => $value) {
							if ($v['coach_id'] == $value['id']) {
								$list_course_plan[$k]['coach'] = $value;
								break;
							}
						}
					}
				}
			}

			// 门店
			$ids_tmp = sl_array_column($list_course_plan, 'store_id');
			$ids_store = implode(',', $ids_tmp);
			if ($ids_store) {
				$list_store = pdo_fetchall("SELECT * FROM " . sl_table_name('store',TRUE)
					. " WHERE id IN (" . $ids_store . ")");

				if ($list_store) {
					foreach ($list_store as $k => $v) {
						$list_store[$k]['image_format'] = tomedia($v['image']);
					}
					foreach ($list_course_plan as $k => $v) {
						foreach ($list_store as $key => $value) {
							if ($v['store_id'] == $value['id']) {
								$list_course_plan[$k]['store'] = $value;
								break;
							}
						}
					}
				}
			}

			// 订单信息
			$ids_tmp = sl_array_column($list_course_plan, 'id');
			$ids_order = implode(',', $ids_tmp);
			if ($ids_order) {
				$list_order = pdo_fetchall("SELECT * FROM " . sl_table_name('order',TRUE)
					. " WHERE plan_id IN (" . $ids_order . ")");

				if ($list_order) {
					foreach ($list_course_plan as $k => $v) {
						foreach ($list_order as $key => $value) {
							if ($v['id'] == $value['plan_id'] && $value['status'] != '3') {
								$list_course_plan[$k]['oid'] = $value['id'];
								$list_course_plan[$k]['order_id'] = $value['id'];
								break;
							}
						}
					}
				}
			}

			// 排队列表
			$ids_tmp = sl_array_column($list_course_plan, 'id');
			$ids_book_queue = implode(',', $ids_tmp);
			if ($ids_book_queue) {
				$list_book_queue = pdo_fetchall("SELECT * FROM " . sl_table_name('book_queue',TRUE)
					. " WHERE plan_id IN (" . $ids_book_queue . ")");

				if ($list_book_queue) {
					foreach ($list_course_plan as $k => $v) {
						foreach ($list_book_queue as $key => $value) {
							if ($v['id'] == $value['plan_id']) {
								$list_course_plan[$k]['myQueueID'] = $value['id'];
								break;
							}
						}
					}
				}
			}

			self::filterCourseList($list_course_plan, $user['member_level_id']);

			// 会员等级.start
			$where_all_member_level = ['uniacid'=>$_W['uniacid'], 'delete'=>'0'];
			$list_all_member_level = pdo_getall(sl_table_name('member_level'), $where_all_member_level);

			$list_all_member_level[] = [
				'id'=>'0',
				'name'=>'普通会员',
			];

			$ids_tmp = sl_array_column($list_course_plan, 'course_id');
			$ids_member_level = implode(',', $ids_tmp);
			if ($ids_member_level) {
				$list_member_level = pdo_fetchall("SELECT * FROM " . sl_table_name('course_member_level',TRUE)
					. " WHERE course_id IN (" . $ids_member_level . ")");

				if ($list_member_level) {
					// list会员等级加入中文
					// foreach ($list_member_level as $k => $v) {
					//     foreach ($list_all_member_level as $key => $value) {
					//         if ($v['member_level_id'] == $value['id']) {
					//             $list_member_level[$k]['name'] = $value['name'];
					//             break;
					//         }
					//     }
					// }

					foreach ($list_course_plan as $k => $v) {
						foreach ($list_member_level as $key => $value) {
							if ($v['course_id'] == $value['course_id']) {
								$list_course_plan[$k]['course']['member_level'][] = $value['id'];
								break;
							}
						}
					}
				} else {
					foreach ($list_course_plan as $k => $v) {
						$list_course_plan[$k]['course']['member_level'] = $list_all_member_level;
					}
				}
			}
			// 会员等级.end

			// 支付方式.start
			$list_all_payment_way = $_W['slwl']['pay_way'];

			$ids_tmp = sl_array_column($list_course_plan, 'course_id');
			$ids_payment_way = implode(',', $ids_tmp);
			if ($ids_payment_way) {
				$list_payment_way = pdo_fetchall("SELECT * FROM " . sl_table_name('course_payment_way',TRUE)
					. " WHERE course_id IN (" . $ids_payment_way . ")");

				if ($list_payment_way) {
					// // list支付方式加入中文
					// foreach ($list_payment_way as $k => $v) {
					//     foreach ($list_all_payment_way as $key => $value) {
					//         if ($v['payment_way'] == $value['way']) {
					//             $list_payment_way[$k]['name'] = $value['name'];
					//             break;
					//         }
					//     }
					// }

					foreach ($list_payment_way as $k => $v) {
						foreach ($list_all_payment_way as $key => $value) {
							if ($v['payment_way'] == $value['id']) {
								$list_payment_way[$k]['way'] = $value['way'];
								break;
							}
						}
					}
					foreach ($list_course_plan as $k => $v) {
						foreach ($list_payment_way as $key => $value) {
							if ($v['course_id'] == $value['course_id']) {
								$list_course_plan[$k]['course']['payment_way'][] = $value['way'];
								break;
							}
						}
					}
				} else {
					foreach ($list_course_plan as $k => $v) {
						$list_course_plan[$k]['course']['payment_way'] = $list_all_payment_way;
					}
				}
			}

			// 支付方式.end
		}

		sl_ajax(0, $list_course_plan);
	}

	// 新版-优惠券，列表
	public function doPageSL_coupon()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		if ($uid == 0) {
			sl_ajax(1, '用户ID不存在');
		}

		$condition_coupon = " AND uniacid=:uniacid ";
		$params_coupon = array(':uniacid' => $_W['uniacid']);
		$pindex_coupon = max(1, intval($_GPC['page']));
		$psize_coupon = 10;
		$sql_coupon = "SELECT * FROM " . sl_table_name('coupon',TRUE) . ' WHERE 1 '
			. $condition_coupon . " ORDER BY displayorder DESC, id DESC LIMIT "
			. ($pindex_coupon - 1) * $psize_coupon .',' .$psize_coupon;
		$list_sale = pdo_fetchall($sql_coupon, $params_coupon);

		if ($list_sale) {
			foreach ($list_sale as $k => $v) {
				$time = json_decode($v['timedays2'], TRUE);
				if ($time['start']) {
					$list_sale[$k]['timestart'] = $time['start'];
				} else {
					$list_sale[$k]['timestart'] = '';
				}
				if ($time['end']) {
					$list_sale[$k]['timeend'] = $time['end'];
				} else {
					$list_sale[$k]['timeend'] = '';
				}

				if ($v['timelimit']=='0') {
					if ($v['timedays1'] == '0') {
						$list_sale[$k]['use_end_time'] = '无使用期制';
					} else {
						$list_sale[$k]['use_end_time'] = '获得后'.$v['timedays1'].'天有效';
					}
				} else {
					$list_sale[$k]['use_end_time'] = $time['start'].'-'.$time['end'];
					$timeend = strtotime($time['end']);
					if ($_W['slwl']['datetime']['timestamp'] > $timeend) {
						unset($list_sale[$k]);
					}
				}
			}

			$condition_sale_user = ' AND uniacid=:uniacid AND user=:user ';
			$params_sale_user = array(':uniacid' => $_W['uniacid'], ':user'=>$uid);
			$list_sale_user = pdo_fetchall("SELECT * FROM " . sl_table_name('coupon_user',TRUE) . ' WHERE 1 '
				. $condition_sale_user, $params_sale_user);

			foreach ($list_sale as $k => $v) {
				if ($list_sale_user) {
					foreach ($list_sale_user as $key => $value) {
						if ($v['id'] == $value['saleid']) {
							$list_sale[$k]['isreceive'] = '1';
							break;
						}
					}
				} else {
					$list_sale[$k]['isreceive'] = '0';
				}

				$list_sale[$k]['backmoney_format'] = number_format($v['backmoney'] / 100, 0);
			}
		}

		sl_ajax(0, $list_sale);
	}

	// 新版-我的优惠券，列表
	public function doPageSL_coupon_my()
	{
		global $_GPC, $_W;
		$uid = intval($_GPC['uid']);

		if ($uid == 0) {
			sl_ajax(1, '用户ID不存在');
		}

		$operation = $_GPC['op'] ? $_GPC['op'] : 'display';

		if ($operation == 'display') {
			$coupon_type = intval($_GPC['type']); // 0=未使用，1=已使用，2=已过期

			if ($coupon_type == '1') {
				$where =" AND (status='1' OR status='2') ";
			} else if ($coupon_type == '0') {
				$where =" AND (status='0' OR status='2') ";
			} else {
				$where =" AND status='0' ";
			}

			$condition_sale_my = " AND uniacid=:uniacid AND user=:user ";
			$condition_sale_my .= $where;
			$params_sale_my = array(':uniacid' => $_W['uniacid'], ':user' => $uid);
			$pindex_sale_my = max(1, intval($_GPC['page']));
			$psize_sale_my = 10;
			$sql_sale_my = "SELECT * FROM " . sl_table_name('coupon_user',TRUE) . ' WHERE 1 '
				. $condition_sale_my . " ORDER BY id DESC LIMIT " . ($pindex_sale_my - 1) * $psize_sale_my .',' .$psize_sale_my;
			$list_sale_my = pdo_fetchall($sql_sale_my, $params_sale_my);

			if ($list_sale_my) {
				foreach ($list_sale_my as $k => $v) {
					$timeend = strtotime($v['time_end']);

					$option = json_decode($v['option_value'], TRUE);
					unset($v['option_value']);
					$tmp_arr_new = array_merge($v, $option);
					$data_format = $this->coupon_data_format($tmp_arr_new);
					$list_sale_my[$k] = array_merge($v, $data_format);

					// $list_sale_my[$k]['intro'] = $option['intro'];
					// $list_sale_my[$k]['thumb'] = $option['thumb'];
					// $list_sale_my[$k]['thumb_url'] = tomedia($option['thumb']);
					// $list_sale_my[$k]['enough'] = $option['enough'];
					// $list_sale_my[$k]['timelimit'] = $option['timelimit'];
					// $list_sale_my[$k]['backtype'] = $option['backtype'];
					// $list_sale_my[$k]['backmoney'] = $option['backmoney'];
					// $list_sale_my[$k]['backmoney_format'] = number_format($v['backmoney'] / 100, 2);
					// $list_sale_my[$k]['discount'] = $option['discount'];

					// if ($option['timelimit']=='0') {
					// 	if ($option['timedays1'] == '0') {
					// 		$list_sale_my[$k]['use_end_time'] = '无使用期限制';
					// 		$list_sale_my[$k]['usable'] = '1';
					// 	} else {
					// 		$datetime1 = new DateTime($v['time_start']);
					// 		$datetime2 = new DateTime($v['time_end']);
					// 		// $interval = $datetime1->diff($datetime2);
					// 		// $list_sale_my[$k]['use_end_time'] = $interval->format('有效期 %a 天');
					// 		$list_sale_my[$k]['use_end_time'] = $datetime1->format('Y-m-d').' 至 '.$datetime2->format('Y-m-d');
					// 	}
					// } else {
					// 	$datetime1 = new DateTime($v['time_start']);
					// 	$datetime2 = new DateTime($v['time_end']);
					// 	$list_sale_my[$k]['use_end_time'] = $datetime1->format('Y-m-d').' 至 '.$datetime2->format('Y-m-d');
					// }

					// $timestart = strtotime($v['time_start']);
					// // 是否可用
					// if ($_W['slwl']['datetime']['timestamp'] > $timestart && $_W['slwl']['datetime']['timestamp'] < $timeend) {
					// 	$list_sale_my[$k]['usable'] = '1';
					// } else {
					// 	$list_sale_my[$k]['usable'] = '0';
					// }

					if ($_W['slwl']['datetime']['timestamp'] > $timeend) {
						if ($coupon_type == '0') {
							pdo_update(sl_table_name('coupon_user'), array('status' => '2'), array('id' => $v['id']));
							unset($list_sale_my[$k]);
						}
					}
				}
			}

			// foreach ($list_sale_my as $k => $v) {
			// 	$list_sale_my[$k]['backmoney_format'] = number_format($v['backmoney'] / 100, 0);
			// }

			$data_bak = $list_sale_my;

			sl_ajax(0, $data_bak);


		} else if ($operation == 'add') {
			$id = intval($_GPC['id']); // 优惠券的ID

			$condition = ' AND uniacid=:uniacid AND user=:user AND saleid=:saleid ';
			$params = array(':uniacid' => $_W['uniacid'], ':user'=>$uid, ':saleid'=>$id);
			$sale = pdo_fetch("SELECT * FROM " . sl_table_name('coupon_user',TRUE) . ' WHERE 1 ' . $condition, $params);

			if ($sale) {
				sl_ajax(1, '不能重复领取');
			} else {
				$condition_sale = ' AND uniacid=:uniacid AND id=:id ';
				$params_sale = array(':uniacid' => $_W['uniacid'], ':id'=>$id);
				$one_sale = pdo_fetch("SELECT * FROM " . sl_table_name('coupon',TRUE) . ' WHERE 1 ' . $condition_sale, $params_sale);

				if ($one_sale) {
					if ($one_sale['total'] > 0) {
						$data = array(
							'uniacid' => $_W['uniacid'],
							'user'    => $uid,
							'saleid'  => $id,
							'title'   => $one_sale['title'],
							'addtime' => $_W['slwl']['datetime']['now'],
						);
						$data['option_value'] = json_encode(array(
							'intro'       =>$one_sale['intro'],
							'thumb'       =>$one_sale['thumb'],
							'enough'      =>$one_sale['enough'],
							'timelimit'   =>$one_sale['timelimit'],
							'timedays1'   =>$one_sale['timedays1'],
							'timedays2'   =>$one_sale['timedays2'],
							'backtype'    =>$one_sale['backtype'],
							'backmoney'   =>$one_sale['backmoney'],
							'discount'    =>$one_sale['discount'],
							'flbackmoney' =>$one_sale['flbackmoney'],
							'backwhen'    =>$one_sale['backwhen'],
						));
						if ($one_sale['timelimit'] == '0') {
							$data['time_start'] = $_W['slwl']['datetime']['now000000'];
							if ($one_sale['timedays1'] == '0') {
								$data['time_end'] = date('Y-m-d 23:59:59', strtotime('+3650 days', $_W['slwl']['datetime']['timestamp']));
							} else {
								$data['time_end'] = date('Y-m-d 23:59:59', strtotime('+'.$one_sale['timedays1'].' days', $_W['slwl']['datetime']['timestamp']));
							}
						} else {
							$time = json_decode($one_sale['timedays2'], TRUE);
							if ($time['start']) {
								$data['time_start'] = $time['start'];
							} else {
								$data['time_start'] = '';
							}
							if ($time['end']) {
								$data['time_end'] = $time['end'] . ' 23:59:59';
							} else {
								$data['time_end'] = '';
							}
						}
						$rst = pdo_insert(sl_table_name('coupon_user'), $data);

						$rst_2 = pdo_query("UPDATE " . sl_table_name('coupon',TRUE) . " SET total=total-1, receive=receive+1 WHERE id=:id ", array(':id'=>$one_sale['id']));

						if ($rst !== FALSE) {
							if ($rst_2 !== FALSE) {
								sl_ajax(0, '领取成功');
							} else {
								sl_ajax(1, '减少数量出错');
							}
						} else {
							sl_ajax(1, '领取失败');
						}
					} else {
						sl_ajax(1, '没有了下次早点');
					}
				} else {
					sl_ajax(1, '券不存在');
				}
			}
		} else {
			sl_ajax(1, '不存在的方法');
		}
	}

	/**
	 * 获取视频分类-所有(500个)-没有分页
	 */
	public function doPageSL_category()
	{
		global $_GPC, $_W;

		$ssid = trim($_GPC['ssid']); // 门店ID
		$tmp_ssid = '%"'.$ssid.'"%';

		$where = [
			'uniacid'         => $_W['uniacid'],
			'delete'          => 0,
			'store_info LIKE' => $tmp_ssid,
		];
		$order_by = ['sort DESC','id DESC'];
		$limit = [500];
		$video_category = pdo_getall(sl_table_name('category'), $where, '', '', $order_by, $limit);

		if ($video_category) {
			foreach ($video_category as $key => $value) {
				$video_category[$key]['icon_format'] = tomedia($value['icon']);
				unset($video_category[$key]['icon']);
			}
		}

		sl_ajax(0, $video_category);
	}

	/**
	 * 获取指定分类下的10条视频课程
	 * id = 分类ID
	 * page = 分页
	 */
	public function doPageSL_list_video()
	{
		global $_GPC, $_W;
		// $uid = intval($_GPC['uid']);

		$cate_id = $_GPC['id']; // 分类ID
		$pindex = max(1, intval($_GPC['page']));

		if (empty($cate_id)) {
			sl_ajax(1, '分类ID不存在');
		}

		$where = ['uniacid'=>$_W['uniacid'], 'category'=>$cate_id, 'delete'=>'0'];
		$order_by = ['recommend DESC','id DESC'];
		$limit = [$pindex, 10];
		$video_course = pdo_getall(sl_table_name('video_course'), $where, '', '', $order_by, $limit);

		if ($video_course) {
			foreach ($video_course as $key => $value) {
				$video_course[$key]['cover_format'] = tomedia($value['cover']);
				$video_course[$key]['price_format'] = number_format($value['price'] / 100, 2);
				unset($video_course[$key]['cover']);
				unset($video_course[$key]['details']);
			}
		}

		sl_ajax(0, $video_course);
	}

	/**
	 * 取单个视频课程全部信息 + 500 视频列表
	 * id = 视频ID
	 */
	public function doPageSL_one_video()
	{
		global $_GPC, $_W;
		$uid = intval($_GPC['uid']);
		$id = intval($_GPC['id']); // 视频课程ID

		if (empty($id)) { sl_ajax(1, '视频ID不存在'); }

		$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id, 'delete'=>'0'];
		$one_video = pdo_get(sl_table_name('video_course'), $where);

		if ($one_video) {
			$one_video['cover_format'] = tomedia($one_video['cover']);
			$one_video['price_format'] = number_format($one_video['price'] / 100, 2);

			$where_video = ['uniacid'=>$_W['uniacid'], 'course_id'=>$one_video['id'], 'delete'=>'0'];
			$order_by_video = ['id DESC'];
			$limit_video = [500];
			$list_video = pdo_getall(sl_table_name('course_video'), $where_video, '', '', $order_by_video, $limit_video);

			if ($list_video) {
				foreach ($list_video as $key => $value) {
					$list_video[$key]['cover_format'] = tomedia($value['cover']); // 封面
					$list_video[$key]['video_format'] = tomedia($value['url']); //视频


					unset($list_video[$key]['cover']);
					unset($list_video[$key]['url']);
				}
			}

			$one_video['isCollect'] = 0; // 是否已收藏, 0=未收藏
			$one_video['isBuy'] = 0; // 是否已购买,0=未购买
			if ($uid) {
				/** 是否已收藏.start */
				$where_collect = ['uniacid'=>$_W['uniacid'], 'id_user'=>$uid, 'id_resource'=>$id];
				$one_collect = pdo_get(sl_table_name('collect'), $where_collect);

				if ($one_collect) {
					$one_video['isCollect'] = 1;
				}
				/** 是否已收藏.end */

				/** 是否已购买.start */
				$where_buy = ['uniacid'=>$_W['uniacid'], 'user_id'=>$uid, 'other_id'=>$id, 'status'=>'2'];
				$one_buy = pdo_get(sl_table_name('order'), $where_buy);

				if ($one_buy) {
					$one_video['isBuy'] = 1;
				}
				/** 是否已购买.end */
			}

			// 订阅消息-模板
			$where = [
				'uniacid'       => $_W['uniacid'],
				'tpl_type'      => 'buy_coach_video',
				'delete_status' => 0,
			];
			$field = ['id', 'tpl_id'];
			$list_tpl = pdo_getall(sl_table_name('tpl_rss'), $where, $field);

			if ($list_tpl) {
				$tmplIds = [];
				foreach ($list_tpl as $key => $value) {
					array_push($tmplIds, $value['tpl_id']);
				}
			}

			$one_video['tmplIds'] = $tmplIds;

			$one_video['video'] = $list_video;
		}

		sl_ajax(0, $one_video);
	}

	/**
	 * 视频课程-推荐
	 * uid = 用户ID
	 * page = 分页
	 */
	public function doPageSL_video_recommend()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);

		$ssid = trim($_GPC['ssid']); // 门店ID
		$tmp_ssid = '%"'.$ssid.'"%';

		$pindex = max(1, intval($_GPC['page']));

		$where = [
			'uniacid'         => $_W['uniacid'],
			'delete'          => '0',
			'enabled'         => '1',
			'recommend'       => '1',
			'store_info LIKE' => $tmp_ssid,
		];
		$order_by = ['recommend DESC','id DESC'];
		$limit = [$pindex, 10];
		$list_video_course = pdo_getall(sl_table_name('video_course'), $where, '', '', $order_by, $limit);

		if ($list_video_course) {
			foreach ($list_video_course as $key => $value) {
				$list_video_course[$key]['cover_format'] = tomedia($value['cover']);
				$list_video_course[$key]['price_format'] = number_format($value['price'] / 100, 2);
				unset($list_video_course[$key]['cover']);
				unset($list_video_course[$key]['details']);
			}

			if ($uid) {
				/** 是否已购买.start */
				$ids_buy = sl_array_column($list_video_course, 'id');

				if ($ids_buy) {
					$where_buy = [
						'uniacid'     => $_W['uniacid'],
						'user_id'     => $uid,
						'status'      => '2',
						'type'        => '4',
						'other_id IN' => $ids_buy,
					];
					$list_buy = pdo_getall(sl_table_name('order'), $where_buy);

					if ($list_buy) {
						foreach ($list_video_course as $key => $value) {
							$list_video_course[$key]['isBuy'] = '0';
							foreach ($list_buy as $k => $v) {
								if ($value['id'] == $v['other_id']) {
									$list_video_course[$key]['isBuy'] = '1';
									break;
								}
							}
						}
					} else {
						foreach ($list_video_course as $key => $value) {
							$list_video_course[$key]['isBuy'] = '0';
						}
					}
				}
				/** 是否已购买.end */
			}
		}

		sl_ajax(0, $list_video_course);
	}

	/**
	 * 视频课程-我购买过的
	 * uid = 用户ID
	 * page = 分页
	 */
	public function doPageSL_video_my()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		$user = pdo_get(sl_table_name('user'), ['id' => $uid]);
		if (empty($user)) {
			sl_ajax(1, '用户不存在');
		}

		$pindex = max(1, intval($_GPC['page']));

		$where = ['uniacid'=>$_W['uniacid'], 'status >'=>'0'];
		$order_by = ['id DESC'];
		$limit = [$pindex, 10];
		$list_order = pdo_getall(sl_table_name('order'), $where, '', '', $order_by, $limit);

		if ($list_order) {
			$ids_order = sl_array_column($list_order, 'other_id');

			// 视频课程
			$where_vc = ['uniacid'=>$_W['uniacid'], 'id IN'=>$ids_order];
			$order_by_vc = ['id DESC'];
			$limit_vc = [$pindex, 10];
			$list_vc = pdo_getall(sl_table_name('video_course'), $where_vc, '', '', $order_by_vc, $limit_vc);
		} else {
			$list_vc = [];
		}

		sl_ajax(0, $list_vc);
	}

	/**
	 * 视频课程-收藏
	 *
	 * 获取列表----------
	 * uid = 用户ID
	 * page = 分页
	 *
	 * 添加，删除----------
	 * id = 视频课程ID
	 * iscollect = 1=收藏，0=取消收藏
	 */
	public function doPageSL_video_course_collect()
	{
		global $_GPC, $_W;

		$uid = intval($_GPC['uid']);
		if ($uid == 0) {
			sl_ajax(1, '用户ID不存在');
		}

		$operation = $_GPC['op'] ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$pindex = max(1, intval($_GPC['page']));

			$where = ['uniacid'=>$_W['uniacid'], 'id_user'=>$uid];
			$order_by = ['create_time DESC'];
			$limit = [$pindex, 10];
			$list_collect = pdo_getall(sl_table_name('collect'), $where, '', '', $order_by, $limit);

			if ($list_collect) {
				foreach ($list_collect as $key => $value) {
					$list_collect[$key]['price_format'] = number_format($value['price'] / 100, 2);
				}

				$ids_collect = sl_array_column($list_collect, 'id_resource');

				// 视频课程
				$where_vc = ['uniacid'=>$_W['uniacid'], 'id IN'=>$ids_collect];
				$order_by_vc = ['id DESC'];
				$limit_vc = [$pindex, 10];
				$list_vc = pdo_getall(sl_table_name('video_course'), $where_vc, '', '', $order_by_vc, $limit_vc);

				if ($list_vc) {
					foreach ($list_vc as $key => $value) {
						$list_vc[$key]['cover_format'] = tomedia($value['cover']);
						$list_vc[$key]['price_format'] = number_format($value['price'] / 100, 2);
						unset($list_vc[$key]['cover']);
					}
				}

				/** 是否已购买.start */
				$ids_buy = sl_array_column($list_collect, 'id_resource');
				if ($ids_buy) {
					$where_buy = [
						'uniacid'     => $_W['uniacid'],
						'user_id'     => $uid,
						'status'      => '2',
						'type'        => '4',
						'other_id IN' => $ids_buy,
					];
					$list_buy = pdo_getall(sl_table_name('order'), $where_buy);
					if ($list_buy) {
						foreach ($list_vc as $key => $value) {
							$list_vc[$key]['isBuy'] = '0';
							foreach ($list_buy as $k => $v) {
								if ($value['id'] == $v['other_id']) {
									$list_vc[$key]['isBuy'] = '1';
									break;
								}
							}
						}
					}
				}
				/** 是否已购买.end */
			} else {
				$list_vc = [];
			}

			$data_bak = [
				'video_course'=>$list_vc,
			];

			sl_ajax(0, $data_bak);


		} else if ($operation == 'post') {
			$id_video_course = $_GPC['id']; // 视频课程ID
			$is_collect = $data['iscollect'] = $_GPC['iscollect']; // 1=收藏，0=取消收藏

			if (empty($id_video_course)) {
				sl_ajax(1, '资源ID不存在');
			}

			$where_one_collect = [
				'uniacid'     => $_W['uniacid'],
				'id_user'     => $uid,
				'id_resource' => $id_video_course,
			];
			$one_collect = pdo_get(sl_table_name('collect'), $where_one_collect);

			if ($is_collect == '1') {
				if (empty($one_collect)) {
					$data = array(
						'uniacid'     => $_W['uniacid'],
						'id_user'     => $uid,
						'id_resource' => $id_video_course,
						'res_type'    => 'video_course',
						'create_time' => $_W['slwl']['datetime']['now'],
					);
					$rst = pdo_insert(sl_table_name('collect'), $data);

					if ($rst !== FALSE) {
						sl_ajax(0, '成功');
					} else {
						sl_ajax(1, '失败');
					}
				} else {
					sl_ajax(0, '收藏资源已存在');
				}
			} else {
				if (empty($one_collect)) {
					sl_ajax(2, '收藏资源已存在');
				}
				$rst = pdo_delete(sl_table_name('collect'), ['id'=>$one_collect['id']]);

				if ($rst !== FALSE) {
					sl_ajax(0, '成功');
				} else {
					sl_ajax(1, '失败');
				}
			}
		}
	}

	// 单页面-文章-内容
	public function doPageSL_adact_one()
	{
		global $_GPC, $_W;

		$ver = $_GPC['ver'];
		$uid = $_GPC['uid'];
		$id = intval($_GPC['id']);

		$where = ['uniacid'=>$_W['uniacid'], 'id'=>$id, 'enabled'=>'1'];
		$one = pdo_get(sl_table_name('adact'), $where);

		if ($one) {
			$one['thumb_url'] = tomedia($one['thumb']);
			$one['out_thumb_url'] = tomedia($one['out_thumb']);
			$one['addtime'] = strtotime($one['addtime']);
		}

		$data_bak = array(
			'one'=>$one
		);

		sl_ajax(0, $data_bak);
	}



	// 分销-健身房.start
	// 分销-分销中心
	public function doPageSL_jsf_com_center()
	{
		sl_jsf_commission_center();
	}

	// 分销-分销佣金
	public function doPageSL_jsf_com_brokerage()
	{
		sl_jsf_commission_brokerage();
	}
	// 分销佣金-明细
	public function doPageSL_jsf_com_brokerage_log()
	{
		sl_jsf_commission_brokerage_log();
	}
	// 提现-明细
	public function doPageSL_jsf_com_withdraw_log()
	{
		sl_jsf_commission_withdraw_log();
	}
	// 我的下线列表
	public function doPageSL_jsf_my_downline()
	{
		sl_jsf_commission_my_downline();
	}
	// 提现-post
	public function doPageSL_jsf_withdraw_post()
	{
		sl_jsf_withdraw_post();
	}
	// 分销-健身房.end

	// 系统.start
	// 直播列表
	public function doPageSL_live()
	{
		sys_live();
	}
	// 系统.end
}

