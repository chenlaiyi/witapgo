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
require_once SLWL_INC . 'fun_commission_jsf.inc.php'; // 分销-模块
require_once SLWL_INC . 'fun_tpl_msg.inc.php'; // 模块-模板消息
class Bozutung_jsfmdModuleSite extends WeModuleSite
{
	public function __construct()
	{
		checklogin();
	}

	public function __call($name, $arguments)
	{
		$isWeb = stripos($name, 'doWeb') === 0;
		$isMobile = stripos($name, 'doMobile') === 0;
		if($isWeb || $isMobile) {
			$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/';
		}
		if($isWeb) {
			$dir .= 'web/';
			$fun = strtolower(substr($name, 5));
		}
		if($isMobile) {
			$dir .= 'mobile/';
			$fun = strtolower(substr($name, 8));
		}
		$file = $dir . $fun . '.inc.php';
		if(file_exists($file)) {
			require_once $file;
			exit;
		} else {
			trigger_error("访问的 {$file} 不存在.", E_USER_WARNING);
			exit;
		}
		trigger_error("访问的方法 {$name} 不存在.", E_USER_WARNING);
		exit;
	}

	private function uniacidConditionStr($feildName, $uniacid)
	{
		global $_W, $_GPC;
		$type = 0; //多用户版
		// $type = 1; //单用户版本
		if ($type == 0) {
			$condition = "({$feildName}={$uniacid} or isNull({$feildName}))";
		}
		if ($type == 1) {
			$condition = "1=1";
		}
		return $condition;
	}

	private function uniacidConditionArray($feildName, $uniacid, $arr = [])
	{
		global $_W, $_GPC;
		$type = 0; //多用户版
		// $type = 1; //单用户版本
		if ($type == 0) {
			$arr[$feildName] = $uniacid;
		}
		return $arr;
	}

	function doWebCoursePaymentWayList()
	{
		global $_W, $_GPC;
		$cid = intval($_GPC['cid']);
		$cpwhtn = sl_table_name('course_payment_way');

		if ($_W['ispost']) {
			try {
				$data = ['uniacid' => $_W['uniacid'], 'course_id' => $cid];
				pdo_begin();
				pdo_delete($cpwhtn, ['course_id' => $cid]);
				if (!empty($_GPC['paymentWays'])) {
					foreach ($_GPC['paymentWays'] as $payment) {
						pdo_insert($cpwhtn, array_merge($data, ['payment_way'=>$payment]));
					}
				}
				pdo_commit();
				sl_ajax(0, '课程支付方式保存成功');
			} catch (Exception $e) {
				pdo_rollback();
				sl_ajax(1, '课程支付方式保存失败');
			}
		}

		$name = pdo_getcolumn(sl_table_name('course'), ['id' => $cid], 'name');
		$paymentList = pdo_getall($cpwhtn, ['course_id' => $cid]);

		$list = $_W['slwl']['pay_way'];

		if (empty($paymentList)) {
			foreach ($list as &$payment) $payment['selected'] = 1;
		} else {
			foreach ($list as &$payment) {
				$way = $payment['id'];
				foreach ($paymentList as $p) {
					if ($p['payment_way'] == $way) {
						$payment['selected'] = 1;
						break;
					}
				}
			}
		}
		include self::template('coursePaymentWayList');
	}

	function doWebCourseMemberLevelList()
	{
		global $_W, $_GPC;
		$cid = intval($_GPC['cid']);
		$cmlhtn = sl_table_name('course_member_level');

		if ($_W['ispost']) {
			try {
				$data = ['uniacid' => $_W['uniacid'], 'course_id' => $cid];
				pdo_begin();
				pdo_delete($cmlhtn, ['course_id' => $cid]);
				if (!empty($_GPC['levels'])) {
					foreach ($_GPC['levels'] as $level) {
						pdo_insert($cmlhtn, array_merge($data, ['member_level_id'=>$level]));
					}
				}
				pdo_commit();
				sl_ajax(0, '课程会员等级限定保存成功');
			} catch (Exception $e) {
				pdo_rollback();
				sl_ajax(1, '课程会员等级限定保存失败');
			}
		}

		$name = pdo_getcolumn(sl_table_name('course'), ['id' => $cid], 'name');
		$where = [
			'uniacid' => $_W['uniacid'],
			'delete'  => 0,
		];
		$list = pdo_getall(sl_table_name('member_level'), $where, ['name','id']);
		$list[] = ['id' => 0, 'name' => '普通会员'];
		$ll = pdo_getall($cmlhtn, ['course_id' => $cid]);
		if (empty($ll)) {
			foreach ($list as &$level) $level['selected'] = 1;
		} else {
			foreach ($list as &$level) {
				$mlid = $level['id'];
				foreach ($ll as $p) {
					if ($p['member_level_id'] == $mlid) {
						$level['selected'] = 1;
						break;
					}
				}
			}
		}
		include self::template('courseMemberLevelList');
	}

	/**
	 * 添加课程
	 */
	public function doWebAddCourse()
	{
		global $_W, $_GPC;

		if ($_W['ispost']) {
			$data = self::getCourseData();
			$data['uniacid'] = $_W['uniacid'];
			$res = pdo_insert(sl_table_name('course'), $data);
			if ($res) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		$courseSystemList = $this->getAll($_W['uniacid'], 'course_system');

		$where = [
			'uniacid' => $_W['uniacid'],
			'delete'  => 0,
		];
		$_W['list_store'] = pdo_getall(sl_table_name('store'), $where);

		include $this->template('addCourse');
	}

	private function getCourseData($edit = FALSE)
	{
		global $_W, $_GPC;
		$data = array();
		$action = $edit ? '编辑' : '添加';
		$sort = $_GPC['recommend'];
		if (intval($sort) < 0) {
			sl_ajax(1, $action . '课程失败，推荐排序必须是非负整数');
		}

		if ($_GPC['slides']) {
			$slides = implode(',', $_GPC['slides']);
		}

		$store_ids = $_GPC['store']; // 门店ID
		if (empty($store_ids)) {
			sl_ajax(1, '门店必需选择一个');
		}

		$data['system_id']        = $_GPC['system_id'];
		$data['recommend']        = $sort;
		$data['difficulty']       = $_GPC['difficulty'];
		$data['description']      = $_GPC['description'];
		$data['precautions']      = $_GPC['precautions'];
		$data['own_articles']     = $_GPC['own_articles'];
		$data['simple']           = $_GPC['simple'];
		$data['video']            = $_GPC['video'];
		$data['slides']           = $slides;
		$data['name']             = $_GPC['course'];
		$data['show_image']       = $_GPC['show'];
		$data['video_image']      = $_GPC['video_image'];
		$data['video']            = $_GPC['video'];
		$data['calorie']          = $_GPC['calorie'];
		$data['calorie_tips']     = $_GPC['calorie_tips'];
		$data['flexibility']      = $_GPC['flexibility'];
		$data['harmony']          = $_GPC['harmony'];
		$data['heart_lung']       = $_GPC['heart_lung'];
		$data['muscle_endurance'] = $_GPC['muscle_endurance'];
		$data['muscle_force']     = $_GPC['muscle_force'];
		$data['details']          = htmlspecialchars_decode($_GPC['details']);
		$data['details_enabled']  = $_GPC['details_enabled'];
		$data['store_info']       = json_encode($store_ids);
		return $data;
	}

	private function getAll($uniacid, $table)
	{
		global $_W, $_GPC;

		$table = sl_table_name($table,TRUE);
		$uniacidConStr = "uniacid='{$uniacid}'";
		return pdo_fetchall("SELECT * FROM $table WHERE (`delete` = 0 OR `delete` IS NULL) AND $uniacidConStr");
	}

	/**
	 * 添加课程体系
	 */
	public function doWebAddCourseSystem()
	{
		global $_W, $_GPC;
		$this->add(
			'course_system',
			'addCourseSystem',
			'courseList',
			'getCourseSystemData',
			'',
			['action' => 'system']
		);
	}

	/**
	 * 简单的添加
	 */
	private function add($table, $tpl, $jmp, $dataFun, $readyFun='', $jmpQuery = [])
	{
		global $_W, $_GPC;

		if ($_W['ispost']) {
			$data = call_user_func_array(array($this, $dataFun), array(FALSE));
			$table = sl_table_name($table);
			$data['uniacid'] = $_W['uniacid'];
			$res = pdo_insert($table, $data);
			if ($res !== FALSE) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		if ($readyFun) $readyFun($_W);
		include self::template($tpl);
	}

	/**
	 * 编辑课程体系
	 */
	public function doWebEditCourseSystem()
	{
		global $_W, $_GPC;
		$this->edit(
			'course_system',
			'editCourseSystem',
			'courseList',
			'getCourseSystemData',
			'',
			['action' => 'system']
		);
	}

	/**
	 * 简单的编辑
	 */
	private function edit($table, $tpl, $jump, $dataFun, $oldDataFun = '', $jmpQuery = [])
	{
		global $_W, $_GPC;
		$id = $_GPC['id'];
		$condition = array('id' => $id);
		$table = sl_table_name($table);
		if ($_W['ispost']) {
			$data = call_user_func_array(array($this, $dataFun), array(TRUE));
			$res = pdo_update($table, $data, $condition);
			if ($res !== FALSE) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		$oldData = pdo_get($table, $condition);
		if ($oldDataFun) {
			$oldDataFun($oldData);
		}
		if ($oldData['coordinate']) {
			$set_coordinate = json_decode($oldData['coordinate'], TRUE);
			$tmp_map = array(
				'lng'=>$set_coordinate['baidu']['lng'],
				'lat'=>$set_coordinate['baidu']['lat'],
			);
		}
		include self::template($tpl);
	}

	/**
	 * 删除课程体系
	 */
	public function doWebDelCourseSystem()
	{
		global $_W, $_GPC;
		$this->deleteItem('course_system', 'courseList', ['action' => 'system']);
	}

	/**
	 * 删除一个表的指定项，并跳转
	 */
	private function deleteItem($tableName, $jumpUrl, $jmpQuery = [], $realDel = FALSE)
	{
		global $_W, $_GPC;
		$id = $_GPC['id'];
		if ($realDel) {
			$res = pdo_delete(sl_table_name($tableName), ['id' => $id]);
		} else {
			$res = pdo_update(sl_table_name($tableName), array('delete' => 1), array('id' => $id));
		}
		if ($res !== FALSE) {
			sl_ajax(0, 'ok');
		} else {
			sl_ajax(1, 'err');
		}
	}

	/**
	 * 添加教练
	 */
	public function doWebAddCoach()
	{
		global $_W, $_GPC;

		self::add('coach', 'addCoach', 'coachList', 'getCoachData',
			function () {
				global $_W, $_GPC;

				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$_W['list_store'] = pdo_getall(sl_table_name('store'), $where);
			}
		);
	}

	/**
	 * 编辑教练
	 */
	public function doWebEditCoach()
	{
		global $_W, $_GPC;

		$this->edit('coach', 'editCoach', 'coachList', 'getCoachData',
			function ($data) {
				global $_W, $_GPC;

				// 所有门店
				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$list_store = pdo_getall(sl_table_name('store'), $where);

				// 门店-当前门店
				$one_store = json_decode($data['store_info'], TRUE);

				if ($one_store && $list_store) {
					foreach ($list_store as $key => $value) {
						$list_store[$key]['checked'] = '0';
						foreach ($one_store as $k => $v) {
							if ($value['id'] == $v) {
								$list_store[$key]['checked'] = '1';
								break;
							}
						}
					}
				}
				$_W['list_store'] = $list_store;
			}
		);
	}

	/**
	 * 删除教练
	 */
	public function doWebDelCoach()
	{
		global $_W, $_GPC;
		$this->deleteItem('coach', 'coachList');
	}

	/**
	 * 删除活动
	 */
	public function doWebDelActivity()
	{
		global $_W, $_GPC;
		$this->deleteItem('activity', 'activityList');
	}

	/**
	 * 添加门店
	 */
	public function doWebAddStore()
	{
		global $_W, $_GPC;
		$this->add('store', 'addStore', 'storeList', 'getStoreData');
	}

	/**
	 * 添加课程计划
	 */
	public function doWebAddCoursePlan()
	{
		global $_W, $_GPC;

		if ($_W['ispost']) {
			$data = self::getCoursePlanData();
			$data['uniacid'] = $_W['uniacid'];
			$res = pdo_insert(sl_table_name('course_plan'), $data);
			if ($res !== FALSE) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		$uniConArray = ['uniacid'=>$_W['uniacid'], 'delete'=>0];
		$courseList = $this->getAll($_W['uniacid'], 'course', $uniConArray, ['id', 'name']);
		$storeList = $this->getAll($_W['uniacid'], 'store', $uniConArray, ['id', 'name']);
		$coachList = $this->getAll($_W['uniacid'], 'coach', $uniConArray, ['id', 'name']);
		include $this->template('addCoursePlan');
	}

	private function getCoursePlanData($edit = FALSE)
	{
		global $_W, $_GPC;
		$start = $_GPC['start'];
		$end = $_GPC['end'];
		$bookStart = $_GPC['book_start'];
		$bookEnd = $_GPC['book_end'];
		$action = $edit ? '编辑' : '添加';
		if ($bookStart > $bookEnd) {
			sl_ajax(1, $action . '失败，预约开始时间必须小于预约截止时间');
		}
		if ($start <= $bookEnd) {
			sl_ajax(1, $action . '失败，开始时间必须大于预约截止时间');
		}
		if ($end <= $start) {
			sl_ajax(1, $action . '失败，结束时间必须大于开始时间');
		}

		$number = intval($_GPC['number']);
		if ($number < 1) {
			sl_ajax(1, $action . '失败，人数必须是正整数');
		}

		$price = floatval($_GPC['price']);
		$data = array();

		$leftTip = $_GPC['left_tip'];
		if (intval($leftTip) < 0) {
			sl_ajax(1, $action . '课程失败，剩余提醒名额是正整数');
		}

		$data['price'] = $price;
		$data['left_tip'] = $leftTip;
		$data['coach_id'] = $_GPC['coach'];
		$data['store_id'] = $_GPC['store'];
		$data['course_id'] = $_GPC['course'];
		$data['can_queue'] = $_GPC['can_queue'];
		$data['number'] = $number;
		$data['start'] = strtotime($_GPC['start']);
		$data['end'] = strtotime($_GPC['end']);
		$data['book_start'] = strtotime($_GPC['book_start']);
		$data['book_end'] = strtotime($_GPC['book_end']);
		return $data;
	}

	private function getDateTime($dt)
	{
		global $_W, $_GPC;
		$format = substr_count($dt, ':') == 1 ? 'Y-m-d H:i' : 'Y-m-d H:i:s';
		return date_create_from_format($format, $dt)->getTimestamp();
	}

	public function doWebDelCoursePlan()
	{
		global $_W, $_GPC;
		$this->deleteItem('course_plan', 'courseList');
	}

	/**
	 * 编辑门店
	 */
	public function doWebEditStore()
	{
		global $_W, $_GPC;
		$this->edit('store', 'editStore', 'storeList', 'getStoreData');
	}

	/**
	 * 编辑课程计划
	 */
	public function doWebEditCoursePlan()
	{
		global $_W, $_GPC;
		$id = $_GPC['id'];
		$condition = ['id' => $id];
		if ($_W['ispost']) {
			$data = self::getCoursePlanData(TRUE);
			$res = pdo_update(sl_table_name('course_plan'), $data, $condition);
			if ($res !== FALSE) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		$oldData = pdo_get(sl_table_name('course_plan'), $condition);
		$uniConArray = ['uniacid'=>$_W['uniacid'], 'delete'=>0];
		$courseList = pdo_getall(sl_table_name('course'), $uniConArray, ['id', 'name']);
		$storeList = pdo_getall(sl_table_name('store'), $uniConArray, ['id', 'name']);
		$coachList = pdo_getall(sl_table_name('coach'), $uniConArray, ['id', 'name']);
		if ($oldData['price'] * 100 < 1) {
			$oldData['price'] = '';
		}
		// if ($oldData['novice_price'] * 100 < 1) {
		// 	$oldData['novice_price'] = '';
		// }
		include self::template('editCoursePlan');
	}

	/**
	 * 删除门店
	 */
	public function doWebDelStore()
	{
		global $_W, $_GPC;
		$this->deleteItem('store', 'storeList');
	}

	/**
	 * 编辑课程
	 */
	public function doWebEditCourse()
	{
		global $_W, $_GPC;

		$id = $_GPC['id'];
		$condition = array('id' => $id);
		if ($_W['ispost']) {
			$data = self::getCourseData(TRUE);
			$res = pdo_update(sl_table_name('course'), $data, $condition);
			if ($res !== FALSE) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		$oldData = pdo_get(sl_table_name('course'), $condition);

		if ($oldData['slides']) {
			$slides = explode(',', $oldData['slides']);
		}

		$courseSystemList = $this->getAll($_W['uniacid'], 'course_system');

		// 所有门店
		$where = [
			'uniacid' => $_W['uniacid'],
			'delete'  => 0,
		];
		$list_store = pdo_getall(sl_table_name('store'), $where);

		// 门店-当前门店
		$one_store = json_decode($oldData['store_info'], TRUE);

		if ($one_store && $list_store) {
			foreach ($list_store as $key => $value) {
				$list_store[$key]['checked'] = '0';
				foreach ($one_store as $k => $v) {
					if ($value['id'] == $v) {
						$list_store[$key]['checked'] = '1';
						break;
					}
				}
			}
		}
		$_W['list_store'] = $list_store;

		include $this->template('editCourse');
	}

	/**
	 * 系统设置
	 */
	function doWebSystemSettings()
	{
		self::systemSettings('systemSettings', function (&$data) {
			global $_W, $_GPC;

			$zdy = pdo_getcolumn(sl_table_name('system_settings'), ['uniacid' => $_W['uniacid']], 'zdy');
			$zdy = empty($zdy) ? [] : json_decode($zdy, TRUE);

			switch ($_GPC['action']) {
				case 'individuation':
					$data['my_top_bg_image'] = $_GPC['my_top_bg_image'];
					$data['recommend_bg_image'] = $_GPC['recommend_bg_image'];
					$data['training_bg_image'] = $_GPC['training_bg_image'];
					$data['syllabus_bg_image'] = $_GPC['syllabus_bg_image'];
					$data['nb_word_color'] = $_GPC['nb_word_color'];
					$data['nb_bg_color'] = $_GPC['nb_bg_color'];
					$data['home_text'] = $_GPC['home_text'];
					$data['private_text'] = $_GPC['private_text'];
					$data['store_text'] = $_GPC['store_text'];
					$data['me_text'] = $_GPC['me_text'];
					$data['activity_tip'] = $_GPC['activity_tip'];
					$data['coach_tip'] = $_GPC['coach_tip'];
					$data['store_tip'] = $_GPC['store_tip'];

					$zdy['video_text'] = $_GPC['video_text'];
					$zdy['home_color'] = $_GPC['home_color'];
					$zdy['coach_bg_image'] = $_GPC['coach_bg_image'];
					$zdy['store_bg_image'] = $_GPC['store_bg_image'];
					$zdy['course_tip'] = $_GPC['course_tip'];
					$zdy['hide_video'] = $_GPC['hide_video'];
					$zdy['book_tip'] = $_GPC['book_tip'];
					$zdy['coach_title'] = $_GPC['coach_title'];
					$zdy['signin_left_title'] = $_GPC['signin_left_title'];
					$data['zdy'] = json_encode($zdy);
					break;

				case 'personal_fields':
					$zdy['waistline'] = $_GPC['waistline'];
					$zdy['height'] = $_GPC['height'];
					$zdy['weight'] = $_GPC['weight'];
					$zdy['thigh'] = $_GPC['thigh'];
					$zdy['bust'] = $_GPC['bust'];
					$zdy['idcard'] = $_GPC['idcard'];
					$zdy['image'] = $_GPC['image'];
					$zdy['tel'] = $_GPC['tel'];
					$zdy['name'] = $_GPC['rname'];
					$zdy['gender'] = $_GPC['gender'];
					$zdy['age'] = $_GPC['age'];
					$zdy['hide_option'] = $_GPC['hide_option'];
					$data['zdy'] = json_encode($zdy);
					break;

				default:
					// $royalty_rate = intval($_GPC['royalty_rate']);
					// if ($royalty_rate < 1) {
					//     sl_ajax(1, '会员卡分销比率是正整数');
					// }
					// $royalty_rate2 = intval($_GPC['royalty_rate2']);
					// if ($royalty_rate2 < 1) {
					//     sl_ajax(1, '会员卡分销比率是正整数');
					// }

					// $data['royalty_rate'] = $royalty_rate;
					// $data['royalty_rate2'] = $royalty_rate2;
					$data['service_term'] = htmlspecialchars_decode($_GPC['service_term']);
					$data['introduction'] = htmlspecialchars_decode($_GPC['introduction']);
					$data['refund_tip'] = $_GPC['refund_tip'];
					$data['invitation_tip'] = $_GPC['invitation_tip'];
					$data['mini_program_name'] = $_GPC['mini_program_name'];
					$data['tel'] = $_GPC['tel'];
					$data['copyright'] = $_GPC['copyright'];
					$data['tech_tel'] = $_GPC['tech_tel'];
					$data['logo'] = $_GPC['logo'];
					$data['private_teach_rule'] = htmlspecialchars_decode($_GPC['private_teach_rule']);
					$data['member_rights'] = htmlspecialchars_decode($_GPC['member_rights']);
					$data['distribute_rule'] = htmlspecialchars_decode($_GPC['distribute_rule']);

					$zdy['charge_book'] = $_GPC['charge_book'];
					$zdy['member_level'] = $_GPC['member_level'];
					$zdy['pay_ios_enabled'] = $_GPC['pay_ios_enabled'];
					$zdy['show_course_price'] = intval($_GPC['show_course_price']);
					$data['zdy'] = json_encode($zdy);
			}
		});
	}

	function doWebEditLeftMenuOrder()
	{
		self::edit('menu_display_order', 'editLeftMenuOrder', 'systemSettings',
			'getLeftMenuOrderData', '', ['action' => 'left_menu_order']);
	}

	private function getLeftMenuOrderData()
	{
		global $_W, $_GPC;
		return ['display_order' => intval($_GPC['display_order'])];
	}

	private function systemSettings($tpl, $dataFun)
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$action = empty($_GPC['action']) ? '' : $_GPC['action'];

		$tn = sl_table_name('system_settings');
		$uniacidConArr = ['uniacid' => $_W['uniacid']];
		$oldData = pdo_get($tn, $uniacidConArr);
		if ($_W['ispost']) {
			$data = [];
			$dataFun($data);
			if (!empty($data['msg'])) {
				sl_ajax(1, '保存失败，' . $data['msg']);
			}
			if (empty($oldData)) {
				$data['uniacid'] = $_W['uniacid'];
				$res = pdo_insert($tn, $data);
			} else {
				$res = pdo_update($tn, $data, $uniacidConArr);
			}
			if ($res !== FALSE) {
				sl_ajax(0, 'ok');
			} else {
				sl_ajax(1, 'err');
			}
		}
		if ($action == 'left_menu_order') {
			$uniConStr = " do.uniacid='$sluni' ";
			$sql = "SELECT mb.eid,do.id,do.display_order,mb.title FROM " . tablename('modules_bindings') . " AS mb " .
				"LEFT JOIN " . sl_table_name('menu_display_order',TRUE) . " AS do ON mb.eid = do.eid AND $uniConStr " .
				"WHERE mb.module = 'bozutung_jsfmd' AND mb.entry = 'menu' ORDER BY do.display_order";
			$list = pdo_fetchall($sql);
			$empty = FALSE;
			foreach ($list as $value) {
				if (is_null($value['id'])) {
					pdo_insert(sl_table_name('menu_display_order'), ['uniacid'=>$_W['uniacid'], 'eid'=>$value['eid']]);
					$empty = TRUE;
				}
			}
			if ($empty) {
				$list = pdo_fetchall($sql);
			}
		}
		$oldData['zdy'] = empty($oldData['zdy']) ? [] : json_decode($oldData['zdy'], TRUE);
		include self::template($tpl);
	}

	/**
	 * 删除课程
	 */
	public function doWebDelCourse()
	{
		global $_W, $_GPC;
		$this->deleteItem('course', 'courseList', ['action' => 'course']);
	}

	/**
	 * 获取课程列表
	 */
	public function doWebCourseList()
	{
		global $_W, $_GPC;
		$action = empty($_GPC['action']) ? '' : $_GPC['action'];
		switch ($action) {
			case 'system':
				self::getList('course_system', 'courseList', '', '', $action);
				break;

			case 'course':
				self::getList('course', 'courseList', '', '', $action);
				break;

			case 'category':
				self::getList('category', 'courseList', '', 'sort DESC', $action);
				break;

			case 'video':
				self::getList('video_course', 'courseList',
					function (&$list) {
						if (empty($list)) return;
						$cidList = array_values(array_unique(sl_array_column($list, 'category')));
						$categoryNames = pdo_getall(sl_table_name('category'), ['id' => $cidList], ['id', 'name']);
						foreach ($list as &$item) {
							$cid = $item['category'];
							foreach ($categoryNames as $category) {
								if ($category['id'] == $cid) {
									$item['category'] = $category['name'];
									break;
								}
							}
						}
						foreach ($list as $key => $value) {
							if ($value['enabled'] == '1') {
								$list[$key]['enabled_format'] = '启用';
							} else {
								$list[$key]['enabled_format'] = '禁用';
							}
						}
					}, '', $action);
				break;

			default:
				self::coursePlanList();
				break;
		}
	}

	function doWebCourseVideoList()
	{
		global $_W, $_GPC;
		$cvid = $_GPC['vcid'];
		$_GPC['course'] = pdo_getcolumn(sl_table_name('video_course'), ['id' => $cvid], 'name');
		self::getList('course_video', 'video_course/courseVideoList', '', 'id DESC', '',
			" AND course_id = $cvid");
	}

	function doWebAddCourseVideo()
	{
		global $_W, $_GPC;
		self::add('course_video', 'video_course/addCourseVideo', 'courseVideoList',
			'getCourseVideoData', '', ['vcid' => $_GPC['vcid']]);
	}

	function doWebEditCourseVideo()
	{
		global $_W, $_GPC;
		self::edit('course_video', 'video_course/editCourseVideo', 'courseVideoList',
			'getCourseVideoData', '', ['vcid' => $_GPC['vcid']]);
	}

	function doWebDelCourseVideo()
	{
		global $_W, $_GPC;
		self::deleteItem('course_video', 'courseVideoList', ['vcid' => $_GPC['vcid']]);
	}

	private function getCourseVideoData($edit)
	{
		global $_W, $_GPC;

		$data = [
			'title' => $_GPC['title_val'],
			'speaker' => $_GPC['speaker'],
			'cover' => $_GPC['cover'],
			'url' => $_GPC['url'],
			'free_time' => $_GPC['free_time'],
			'time_count' => $_GPC['time_count'],
		];
		if (!$edit) $data['course_id'] = $_GPC['vcid'];
		return $data;
	}

	function doWebAddVideoCourse()
	{
		global $_W, $_GPC;

		$where = [
			'uniacid' => $_W['uniacid'],
			'delete'  => 0,
		];
		$_W['list_store'] = pdo_getall(sl_table_name('store'), $where);

		self::add('video_course', 'video_course/addVideoCourse', 'courseList', 'getVideoCourseData',
			function () {
				global $_W, $_GPC;
				$sluni = $_W['uniacid'];

				$uniConStr = "uniacid='$sluni'";
				$_GPC['categoryList'] = pdo_fetchall("SELECT id,name FROM " . sl_table_name('category',TRUE) .
					"  WHERE $uniConStr AND (`delete` = 0 OR `delete` IS NULL)");
			}, ['action' => 'video']);
	}

	function doWebEditVideoCourse()
	{
		global $_W, $_GPC;

		self::edit('video_course', 'video_course/editVideoCourse', 'courseList', 'getVideoCourseData',
			function ($data) {
				global $_W, $_GPC;
				$sluni = $_W['uniacid'];

				$uniConStr = "uniacid='$sluni'";
				$_GPC['categoryList'] = pdo_fetchall("SELECT id,name FROM " . sl_table_name('category',TRUE) .
					"  WHERE $uniConStr AND (`delete` = 0 OR `delete` IS NULL)");

				// 所有门店
				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$list_store = pdo_getall(sl_table_name('store'), $where);

				// 门店-当前门店
				$one_store = json_decode($data['store_info'], TRUE);

				if ($one_store && $list_store) {
					foreach ($list_store as $key => $value) {
						$list_store[$key]['checked'] = '0';
						foreach ($one_store as $k => $v) {
							if ($value['id'] == $v) {
								$list_store[$key]['checked'] = '1';
								break;
							}
						}
					}
				}
				$_W['list_store'] = $list_store;

			}, ['action' => 'video']);
	}

	function doWebDelVideoCourse()
	{
		global $_W, $_GPC;
		self::deleteItem('video_course', 'courseList', ['action' => 'video']);
	}

	private function getVideoCourseData()
	{
		global $_W, $_GPC;
		$price = $_GPC['price'];
		$price = $price * 100;

		$store_ids = $_GPC['store']; // 门店ID
		if (empty($store_ids)) {
			sl_ajax(1, '门店必需选择一个');
		}

		$data_bak = [
			'price'       => $price,
			'name'        => $_GPC['course'],
			'speaker'     => $_GPC['speaker'],
			'intro'       => $_GPC['intro'],
			'category'    => $_GPC['category'],
			'recommend'   => intval($_GPC['recommend']),
			'cover'       => $_GPC['cover'],
			'enabled'     => intval($_GPC['enabled']),
			'details'     => htmlspecialchars_decode($_GPC['details']),
			'create_time' => $_W['slwl']['datetime']['now'],
			'store_info'  => json_encode($store_ids),
		];

		return $data_bak;
	}

	function doWebAddCategory()
	{
		global $_W, $_GPC;
		self::add('category', 'category/addCategory', 'courseList', 'getCategoryData',
			function () {
				global $_W, $_GPC;

				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$_W['list_store'] = pdo_getall(sl_table_name('store'), $where);

			}, ['action' => 'category']);
	}

	function doWebEditCategory()
	{
		global $_W, $_GPC;
		self::edit('category', 'category/editCategory', 'courseList', 'getCategoryData',
			function ($data) {
				global $_W, $_GPC;

				// 所有门店
				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$list_store = pdo_getall(sl_table_name('store'), $where);

				// 门店-当前门店
				$one_store = json_decode($data['store_info'], TRUE);

				if ($one_store && $list_store) {
					foreach ($list_store as $key => $value) {
						$list_store[$key]['checked'] = '0';
						foreach ($one_store as $k => $v) {
							if ($value['id'] == $v) {
								$list_store[$key]['checked'] = '1';
								break;
							}
						}
					}
				}
				$_W['list_store'] = $list_store;

			}, ['action' => 'category']);
	}

	function doWebDelCategory()
	{
		global $_W, $_GPC;
		self::deleteItem('category', 'courseList', ['action' => 'category']);
	}

	private function getCategoryData()
	{
		global $_W, $_GPC;

		$store_ids = $_GPC['store']; // 门店ID
		if (empty($store_ids)) {
			sl_ajax(1, '门店必需选择一个');
		}

		$data_bak = [
			'name'       => $_GPC['category'],
			'icon'       => $_GPC['icon'],
			'sort'       => intval($_GPC['sort']),
			'store_info' => json_encode($store_ids),
		];
		return $data_bak;
	}

	private function getList($tableName, $template, $listFunc = '', $order = '', $action = "", $condition = '')
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$tn = sl_table_name($tableName,TRUE);
		$uniacidStr = "uniacid='$sluni'";

		$where = "{$uniacidStr} AND (`delete`='0' OR `delete` IS NULL)";

		if (!empty($condition)) {
			$where .= $condition;
		}
		$res = pdo_fetchall("SELECT COUNT('id') FROM $tn WHERE $where ORDER BY ID DESC ");

		$total = $res[0]["COUNT('id')"];
		if (!isset($_GPC['page'])) {
			$pageIndex = 1;
		} else {
			$pageIndex = intval($_GPC['page']);
		}
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);
		$startIndex = ($pageIndex - 1) * $pageSize;
		if (empty($order)) {
			$order = 'id DESC';
		}
		$list = pdo_fetchall("SELECT * FROM $tn WHERE $where ORDER BY $order LIMIT $startIndex , $pageSize");
		if ($listFunc) $listFunc($list);
		include $this->template($template);
	}

	private function coursePlanList()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$tn = sl_table_name('course_plan',TRUE);
		$cstb = sl_table_name('course',TRUE);
		$uniacidStr = "op.uniacid='$sluni'";
		$delete = '(op.delete = 0 OR op.delete IS NULL)';
		$dcsids = pdo_fetchall("SELECT id FROM $cstb WHERE `delete`='1' ");
		if ($dcsids) {
			$dcsids = sl_array_column($dcsids, 'id');
		}
		$dcsidsCon = empty($dcsids) ? '1=1' : 'op.course_id NOT IN (' . implode(',', $dcsids) . ')';
		$res = pdo_fetchall("SELECT COUNT(*) FROM $tn AS op WHERE {$uniacidStr} AND $delete AND $dcsidsCon");
		$total = $res[0]["COUNT(*)"];
		$pageIndex = !isset($_GPC['page']) ? 1 : intval($_GPC['page']);
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);
		$startIndex = ($pageIndex - 1) * $pageSize;
		$ctb = sl_table_name('coach',TRUE);
		$stb = sl_table_name('store',TRUE);
		$fields = "op.id,op.start,op.number,op.booked_number,op.can_queue,s.name AS store,c.name AS coach,cs.name AS course,op.end";
		$sql = "SELECT $fields FROM $tn AS op LEFT JOIN $ctb AS c ON op.coach_id = c.id " .
			"LEFT JOIN $cstb AS cs ON op.course_id = cs.id " .
			"LEFT JOIN $stb AS s ON op.store_id = s.id " .
			"WHERE $uniacidStr AND $dcsidsCon AND $delete ORDER BY start DESC LIMIT $startIndex,$pageSize";
		$list = pdo_fetchall($sql);
		$weekdayStrs = ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
		if ($list) {
			foreach ($list as &$row) {
				$row['timeInterval'] = $weekdayStrs[date('w', $row['start'])] . ' ' .
					date('m-d H:i', $row['start']) . '-' . date('H:i', $row['end']);
			}
		}
		include $this->template('courseList');
	}

	/**
	 * 获取教练列表
	 */
	public function doWebCoachList()
	{
		global $_W, $_GPC;
		$this->getList('coach', 'coachList');
	}

	/**
	 * 获取门店列表
	 */
	public function doWebStoreList()
	{
		global $_W, $_GPC;
		// $this->getList('store', 'storeList');

		$pindex = max(1, intval($_GPC['page']));
		$where = ['uniacid'=>$_W['uniacid'], 'delete'=>'0'];
		$order_by = ['sort DESC','id DESC'];
		$limit = [$pindex, 10];
		$list = pdo_getall(sl_table_name('store'), $where, '', '', $order_by, $limit);

		include $this->template('storeList');
	}

	/**
	 * 获取活动列表
	 */
	public function doWebActivityList()
	{
		global $_W, $_GPC;
		$this->getList('activity', 'activityList', function (&$list) {
			foreach ($list as &$row) {
				$row['time'] = date('Y-m-d', $row['time']);
			}
		});
	}

	/**
	 * 添加活动
	 */
	public function doWebAddActivity()
	{
		global $_W, $_GPC;

		$this->add('activity', 'addActivity', 'activityList', 'getActivityData',
			function () {
				global $_W, $_GPC;

				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$_W['list_store'] = pdo_getall(sl_table_name('store'), $where);
			}
		);
	}

	/**
	 * 编辑会员
	 */
	function doWebEditUser()
	{
		global $_W, $_GPC;
		self::edit('user', 'editUser', 'membership', 'getUserData', function ($one) {
			global $_W, $_GPC;

			// 会员等级
			$_GPC['list'] = pdo_getall(sl_table_name('member_level'), ['uniacid'=>$_W['uniacid'],'delete'=>'0']);
			$_GPC['list'][] = ['id'=>'0', 'name'=>'普通会员'];

			// 内容
			$zdy = pdo_getcolumn(sl_table_name('system_settings'), ['uniacid' => $_W['uniacid']], 'zdy');
			$_W['zdy'] = empty($zdy) ? [] : json_decode($zdy, true);

			// 所有标签分组
			$where = ['uniacid'=>$_W['uniacid'], 'delete'=>'0'];
			$order_by = ['id DESC'];
			$list_user_label = pdo_getall(sl_table_name('user_label'), $where, '', '', $order_by);


			if ($list_user_label) {
				$ids_one = @json_decode($one['id_label'], true);

				if ($ids_one) {
					foreach ($list_user_label as $key => $value) {
						$list_user_label[$key]['checked'] = 0;

						if (in_array($value['id'], $ids_one)) {
							$list_user_label[$key]['checked'] = 1;
							continue;
						}
					}
				}
			}
			$_GPC['list_user_label'] = $list_user_label;
		});
	}

	/**
	 * 编辑活动
	 */
	public function doWebEditActivity()
	{
		global $_W, $_GPC;
		$this->edit('activity', 'editActivity', 'activityList', 'getActivityData',
			function ($data) {
				global $_W, $_GPC;

				// 所有门店
				$where = [
					'uniacid' => $_W['uniacid'],
					'delete'  => 0,
				];
				$list_store = pdo_getall(sl_table_name('store'), $where);

				// 门店-当前门店
				$one_store = json_decode($data['store_info'], TRUE);

				if ($one_store && $list_store) {
					foreach ($list_store as $key => $value) {
						$list_store[$key]['checked'] = '0';
						foreach ($one_store as $k => $v) {
							if ($value['id'] == $v) {
								$list_store[$key]['checked'] = '1';
								break;
							}
						}
					}
				}
				$_W['list_store'] = $list_store;
			}
		);
	}

	/**
	 * 获取预约列表
	 */
	private function bookList($exportExcel=0)
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$tn = sl_table_name('order',TRUE);
		$uniacidStr = "o.uniacid='$sluni'";
		$where = "{$uniacidStr} AND (o.delete='0' OR o.delete IS NULL) AND o.status>'0' AND (o.type='0' OR o.type IS NULL)";
		$res = pdo_fetchall("SELECT COUNT('id') FROM $tn AS o WHERE $where");

		if (!empty($_GPC['query'])) {
			$q = $_GPC['query'];
			if (strpos($q, 'query*') !== FALSE) {
				$keyword = ltrim($q, 'query*');
				$where .= " AND o.user_id = '$keyword' ";
			} else {
				$where .= " AND (u.real_name LIKE '%$q%' OR u.nickname LIKE '%$q%' OR u.tel LIKE '%$q%') ";
			}
			$_GET['query'] = $q;
		} else {
			$q = '';
		}

		$total = $res[0]["COUNT('id')"];
		if (!isset($_GPC['page'])) {
			$pageIndex = 1;
		} else {
			$pageIndex = intval($_GPC['page']);
		}
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);
		$startIndex = ($pageIndex - 1) * $pageSize;
		$utb = sl_table_name('user',TRUE);
		$cptb = sl_table_name('course_plan',TRUE);
		$ctb = sl_table_name('coach',TRUE);
		$cstb = sl_table_name('course',TRUE);
		$stb = sl_table_name('store',TRUE);
		$fields = "o.*,cp.start,cp.end,s.name AS store,u.tel,u.real_name,u.nickname,c.name AS coach,cs.name AS course";
		$sql = "SELECT $fields FROM $tn AS o " .
			"LEFT JOIN $cptb AS cp ON o.plan_id = cp.id " .
			"LEFT JOIN $utb AS u ON o.user_id = u.id " .
			"LEFT JOIN $ctb AS c ON cp.coach_id = c.id " .
			"LEFT JOIN $cstb AS cs ON cp.course_id = cs.id " .
			"LEFT JOIN $stb AS s ON cp.store_id = s.id " .
			"WHERE $where ORDER BY id DESC LIMIT $startIndex,$pageSize";
		$list = pdo_fetchall($sql);
		if ($list) {
			foreach ($list as $key => $value) {
				if (is_json($value['nickname'])) {
					$list[$key]['nickname'] = json_decode($value['nickname']);
				}
			}
		}
		$weekdayStrs = ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
		foreach ($list as &$row) {
			$row['courseTime'] = $weekdayStrs[date('w', $row['start'])] . ' ' .
				date('Y-m-d H:i', $row['start']) . '-' . date('H:i', $row['end']);
			$row['time_format'] = date('Y-m-d H:i:s', $row['paid_time']);
			if (!empty($row['refund_time'])) $row['time'] .= '<br>请求取消订单时间：' . date('Y-m-d H:i:s', $row['refund_time']);
			switch ($row['status']) {
				case 1:
					$row['statusText'] = '已付款';
					break;

				case 2:
					$row['statusText'] = '已完成';
					break;

				case 3:
					$row['statusText'] = '请求取消订单';
					break;

				case 4:
					$row['statusText'] = '已取消';
					break;

				case 5:
					$row['statusText'] = '已拒绝退款';
					break;
			}
		}
		if ($exportExcel == '1') {
			return $list;
		}
		include $this->template('orderList');
	}

	// 订单导出Excel
	public function doWebExportOrderListAsExcel()
	{
		global $_W, $_GPC;

		$list = self::bookList('1');
		// dump($list);
		// exit;
		foreach ($list as $k => $v) {
			$user = "昵称：".$v['nickname'];
			$user .= !empty($v['real_name'])?"姓名：".$v['real_name']:'';
			$user .= !empty($v['tel'])?"电话：".$v['tel']:'';
			$list[$k]['user'] = $user;
		}

		require_once MODULE_ROOT . "/lib/PHPExcel/PHPExcel.php";
		require_once MODULE_ROOT . "/lib/PHPExcel/ExcelHelper.php";

		//导出Excel
		$xlsName = '预约记录';
		$xlsCell = array(
			array('store', '门店名'),
			array('user', '用户信息'),
			array('coach', '教练'),
			array('course', '课程'),
			array('courseTime', '上课时间'),
			array('time', '订单时间'),
			array('paid_money', '金额'),
			array('statusText', '状态'),
		);

		$myExcel = new \ExcelHelper();

		// $myExcel->exportExcel($xlsName, $xlsCell, $xlsData);
		$myExcel->exportExcel($xlsName, $xlsCell, $list);

		exit;
	}

	private function getCommissionLock($uid)
	{
		global $_W, $_GPC;
		require_once IA_ROOT . '/addons/bozutung_jsfmd/Lock.php';
		return new FileLock('/tmp/bozutung_jsfmd_commission_' . $uid);
	}

	/**
	 * 在课程结束后
	 * 已付款->为已完成
	 */
	private function finishOrder()
	{
		global $_W, $_GPC;
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

	private function addCommission($uid, $c, $uniacid, $oid)
	{
		global $_W, $_GPC;
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

	/**
	 * 删除预约记录
	 */
	public function doWebDelBookRecord()
	{
		global $_W, $_GPC;
		$this->deleteItem('order', 'orderList');
	}

	function doWebAllowCancelBook()
	{
		global $_W, $_GPC;
		$id = $_GPC['id'];
		$order = pdo_get(sl_table_name('order'), ['id' => $id], ['user_id', 'plan_id', 'other_id']);
		$cpid = $order['plan_id'];
		$subtype = $_GPC['subtype'];

		$lock = self::getCoursePlanLock($cpid);
		try {
			$lock->lock();
			pdo_begin();
			pdo_update(sl_table_name('order'), ['status' => 4], ['id' => $id]);
			$bn = pdo_getcolumn(sl_table_name('course_plan'), ['id' => $order['plan_id']], 'booked_number');
			if ($bn > 0) pdo_update(sl_table_name('course_plan'), ['booked_number' => $bn - 1], ['id' => $order['plan_id']]);
			switch ($subtype) {
				case 2://不限时次卡
					pdo_query("UPDATE " . sl_table_name('user',TRUE) . " SET left_times = left_times + 1 WHERE id = " . $order['user_id']);
					pdo_insert(sl_table_name('log'), ['uniacid' => $_W['uniacid'], 'create' => time(), 'user_id' => $order['user_id'],
						'type' => 1, 'subtype' => 0, 'times' => 1, 'order_id' => $id]);
					break;

				case 3://课程次卡
				case 5://限时次卡
					pdo_query("UPDATE " . sl_table_name('user_card',TRUE) . " SET left_times = left_times + 1 WHERE id = " . $order['other_id']);
					pdo_insert(sl_table_name('log'), ['uniacid' => $_W['uniacid'], 'create' => time(), 'user_id' => $order['user_id'],
						'type' => $subtype, 'subtype' => 0, 'times' => 1, 'order_id' => $id, 'user_card_id' => $order['other_id']]);
					break;
			}
			pdo_commit();
			$lock->unlock();

			sl_ajax(0, '允许取消预约成功');
		} catch (Throwable $t) {
			pdo_rollback();
			$lock->unlock();
			sl_ajax(1, '允许取消预约失败，写数据库错误');
		}
	}

	function doWebUserMemberCardList()
	{
		global $_W, $_GPC;
		$uid = $_GPC['uid'];
		$fields = 'uc.*,mc.name AS card,mc.times AS mtimes,mc.time AS mtime,mc.money';
		$list = pdo_fetchall("SELECT $fields FROM " . sl_table_name('user_card',TRUE) . " AS uc " .
			"LEFT JOIN " . sl_table_name('member_card',TRUE) . " AS mc ON mc.id = uc.card_id " .
			"WHERE uc.delete='0' AND uc.user_id = $uid");
		include self::template('userMemberCardList');
	}

	/**
	 * 删除会员卡
	 */
	public function doWebDelMyMemberCard()
	{
		global $_W, $_GPC;
		$this->deleteItem('user_card', 'userMemberCardList');
	}

	function doWebRefuseCancelBook()
	{
		global $_W, $_GPC;
		$id = $_GPC['id'];

		$order = pdo_get(sl_table_name('order'), array('id' => $id));
		if (empty($order)) {
			sl_ajax(1, '拒绝失败，订单不存在');
		}

		if ($order['status'] != 3) {
			sl_ajax(1, '拒绝失败，订单状态不正确');
		}

		$res = pdo_update(sl_table_name('order'), array('status' => 5), array('id' => $id));
		if ($res !== FALSE) {
			sl_ajax(0, 'ok');
		} else {
			sl_ajax(1, 'err');
		}
	}

	function doWebHelp()
	{
		global $_W, $_GPC;
		include $this->template('help');
	}

	function doWebCouponList()
	{
		global $_W, $_GPC;
		self::getList('coupon', 'couponList', function (&$list) {
			if (empty($list)) return;

			$cidList = sl_array_column($list, 'id');
			$cutn = sl_table_name('coupon_user',TRUE);
			$cuList = pdo_fetchall("SELECT COUNT(id) AS consumed,coupon_id AS cid FROM $cutn" .
				"WHERE used = 1 AND coupon_id IN (" . implode(',', $cidList) . ") GROUP BY coupon_id");
			foreach ($list as &$row) {
				$row['end'] = date('Y-m-d H:i:s', $row['end_time']);
				$cid = $row['id'];
				$row['consumed'] = 0;
				foreach ($cuList as $item) {
					if ($item['cid'] == $cid) {
						$row['consumed'] = $item['consumed'];
						break;
					}
				}
			}
		}, 'id DESC');
	}

	function doWebReceivedCouponList()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$uniacidConStr = "cu.uniacid='$sluni'";
		$cutn = sl_table_name('coupon_user',TRUE);
		$cid = $_GPC['cid'];
		$res = pdo_fetchall("SELECT COUNT('id') FROM $cutn AS cu WHERE $uniacidConStr AND cu.coupon_id = :cid", ['cid' => $cid]);
		$total = $res[0]["COUNT('id')"];
		if (!isset($_GPC['page'])) {
			$pageIndex = 1;
		} else {
			$pageIndex = intval($_GPC['page']);
		}
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);
		$startIndex = ($pageIndex - 1) * $pageSize;
		$utn = sl_table_name('user',TRUE);
		$coupon = pdo_get(sl_table_name('coupon'), ['id' => $cid], ['description', 'end_time']);
		$list = pdo_fetchall("SELECT cu.*,u.nickname FROM $cutn AS cu " .
			"LEFT JOIN $utn AS u ON u.id = cu.user_id " .
			"WHERE $uniacidConStr AND cu.coupon_id = :cid ORDER BY id LIMIT " .
			$startIndex . "," . $pageSize, ['cid' => $cid]);
		$statusText = $coupon['end_time'] <= time() ? '已过期' : '未使用';
		$endtime = date('Y-m-d H:i:s', $coupon['end_time']);
		foreach ($list as &$row) {
			$row['end_time'] = $endtime;
			if ($row['used']) $row['status'] = '已使用';
			else $row['status'] = $statusText;
		}
		include $this->template('receivedCouponList');
	}

	function doWebDelCoupon()
	{
		global $_W, $_GPC;
		self::deleteItem('coupon', 'couponList');
	}

	function doWebAddCoupon()
	{
		global $_W, $_GPC;
		self::add('coupon', 'addCoupon', 'couponList', 'getCouponData');
	}

	function doWebEditCoupon()
	{
		global $_W, $_GPC;
		self::edit('coupon', 'editCoupon', 'couponList', 'getCouponData');
	}

	/**
	 * 删除过期的排队
	 */
	private function delExpiredBookQueue()
	{
		global $_W, $_GPC;

		$bqtn = sl_table_name('book_queue',TRUE);
		$list = pdo_fetchall("SELECT bq.id,cp.id AS cpid FROM $bqtn AS bq " .
			"LEFT JOIN " . sl_table_name('course_plan',TRUE) . " AS cp ON cp.id = bq.plan_id AND cp.end < " . time() .
			" WHERE bq.uniacid = {$_W['uniacid']} ");
		$list = array_filter($list, function ($item) {
			return $item['cpid'];
		});
		$list = array_values(sl_array_column($list, 'id'));
		if (empty($list)) return;
		pdo_query("DELETE FROM $bqtn WHERE id IN (" . implode(',', $list) . ")");
	}

	function doWebAddMemberCard()
	{
		global $_W, $_GPC;
		self::add('member_card', 'addMemberCard', 'membership', 'getMemberCardData',
			function () {
				global $_W, $_GPC;
				$_W['courseList'] = pdo_fetchall("SELECT id,name FROM " . sl_table_name('course',TRUE) .
					" WHERE uniacid = {$_W['uniacid']} AND (`delete` = 0 OR `delete` IS NULL)");
			}, ['action' => 'memberCard']);
	}

	function doWebEditMemberCard()
	{
		global $_W, $_GPC;
		self::edit('member_card', 'editMemberCard', 'membership', 'getMemberCardData',
			function (&$oldData) {
				if ($oldData['type'] != 3) return;
				global $_W, $_GPC;
				$_W['courseList'] = pdo_fetchall("SELECT id,name FROM " . sl_table_name('course',TRUE) .
					" WHERE uniacid = {$_W['uniacid']} AND (`delete` = 0 OR `delete` IS NULL)");
			}, ['action' => 'memberCard']
		);
	}

	function userList()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$tn = sl_table_name('user',TRUE);
		$uniacidStr = "uniacid='$sluni'";

		$delete = ' (`delete` = 0 OR `delete` IS NULL) AND openid != \'\'';
		if (!empty($_GPC['query'])) {
			$q = $_GPC['query'];
			if (strpos($q, 'label*') !== FALSE) {
				$keyword = ltrim($q, 'label*');
				$delete .= " AND id_label LIKE '%\"$keyword\"%' ";
			} else {
				$kwjson = trim(json_encode($q), '"');
				$kwjson = str_replace('\\', '\\\\\\\\', $kwjson);
				$delete .= " AND (
					nickname LIKE '%{$kwjson}%' OR
					real_name LIKE '%{$q}%' OR
					nickname LIKE '%{$q}%' OR
					tel LIKE '%{$q}%' OR
					id_label LIKE '%{$q}%'
				) ";
			}
			$_GET['query'] = $q;
		} else {
			$q = '';
		}

		if (!empty($_GPC['submit'])) unset($_GPC['page']);

		$res = pdo_fetchall("SELECT COUNT('id') FROM $tn WHERE {$uniacidStr} AND $delete");
		// pdo_debug();
		// exit;

		$total = $res[0]["COUNT('id')"];
		if (!isset($_GPC['page'])) {
			$pageIndex = 1;
		} else {
			$pageIndex = intval($_GPC['page']);
		}
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);
		$startIndex = ($pageIndex - 1) * $pageSize;
		$list = pdo_fetchall("SELECT * FROM $tn WHERE {$uniacidStr} AND $delete ORDER BY id DESC LIMIT " . $startIndex . "," . $pageSize);
		if ($list) {
			foreach ($list as $key => $value) {
				if (is_json($value['nickname'])) {
					$list[$key]['nickname'] = json_decode($value['nickname']);
				}
			}
		}

		$mlidList = [];
		foreach ($list as $item) {
			if (!empty($item['member_level_id'])) $mlidList[] = $item['member_level_id'];
		}
		$time = time();
		if (empty($mlidList)) {
			foreach ($list as &$item) {
				$item['memberLevelName'] = '普通会员';
				$item['due_time'] = $item['due_time'] < $time ? '已到期' : date('Y-m-d', $item['due_time']);
			}
		} else {
			$mlList = pdo_fetchall("SELECT id,name FROM " . sl_table_name('member_level',TRUE)
				. " WHERE id IN (" . implode(',', $mlidList) . ")");
			foreach ($list as &$item) {
				$item['due_time'] = $item['due_time'] < $time ? '已到期' : date('Y-m-d', $item['due_time']);

				if (empty($item['member_level_id'])) {
					$item['memberLevelName'] = '普通会员';
				} else {
					foreach ($mlList as $i) {
						if ($i['id'] == $item['member_level_id']) {
							$item['memberLevelName'] = $i['name'];
							break;
						}
					}
				}
			}
		}
		unset($item);

		include $this->template('membership');
	}

	private function signInList()
	{
		global $_W, $_GPC;

		$sitn = sl_table_name('sign_in',TRUE);
		$utn = sl_table_name('user',TRUE);
		$ctn = sl_table_name('course',TRUE);
		$catn = sl_table_name('coach',TRUE);

		$condition = ' AND uniacid=:uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;
		$sql = "SELECT * FROM " . $sitn. ' WHERE 1 '
			. $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize .',' .$psize;

		$list = pdo_fetchall($sql, $params);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . $sitn . ' WHERE 1 ' . $condition, $params);
		$pager = pagination($total, $pindex, $psize);

		if ($list) {
			foreach ($list as $k => $v) {
				$list[$k]['datetime'] = date('Y-m-d H:i', $v['time']);
			}

			// 教练
			$ids_tmp = sl_array_column($list, 'coach_id');
			$ids_coach = array_unique($ids_tmp);
			if ($ids_coach) {
				$list_coach = pdo_getall(sl_table_name('coach'), ['id IN'=>$ids_coach]);

				if ($list_coach) {
					foreach ($list as $k => $v) {
						foreach ($list_coach as $key => $value) {
							if ($v['coach_id'] == $value['id']) {
								$list[$k]['coach_name'] = $value['name'];
								break;
							}
						}
					}
				}
			}

			// 用户信息
			$ids_tmp = sl_array_column($list, 'user_id');
			$ids_user = array_unique($ids_tmp);
			if ($ids_user) {
				$list_user = pdo_getall(sl_table_name('user'), ['id IN'=>$ids_user]);

				if ($list_user) {
					foreach ($list as $k => $v) {
						foreach ($list_user as $key => $value) {
							if ($v['user_id'] == $value['id']) {
								$list[$k]['nickname'] =
									is_json($value['nickname'])?json_decode($value['nickname']):$value['nickname'];
								break;
							}
						}
					}
				}
			}

			// 课程信息
			$ids_tmp = sl_array_column($list, 'course_id');
			$ids_course = array_unique($ids_tmp);
			if ($ids_course) {
				$list_course = pdo_getall(sl_table_name('course'), ['id IN'=>$ids_course]);

				if ($list_course) {
					foreach ($list as $k => $v) {
						foreach ($list_course as $key => $value) {
							if ($v['course_id'] == $value['id']) {
								$list[$k]['course_name'] = $value['name'];
								break;
							}
						}
					}
				}
			}
		}

		$action = 'signIn';
		include self::template('membership');
	}

	function doWebMembership()
	{
		global $_W, $_GPC;
		$action = empty($_GPC['action']) ? '' : $_GPC['action'];
		switch ($action) {
			case 'signIn':
				self::signInList();
				break;

			case 'private':
				self::privateCoachList();
				break;

			case 'level':
				self::getList('member_level', 'membership', '', 'id DESC', $action);
				break;

			case 'memberCard':
				self::getList('member_card', 'membership', function (&$list) {
					foreach ($list as &$item) {
						if (empty($item['course_id'])) continue;
						$item['course'] = pdo_getcolumn(sl_table_name('course'), ['id' => $item['course_id']], 'name');
					}
				}, 'id DESC', $action);
				break;

			case 'log':
				self::userLog();
				break;

			case 'userLabel':
				self::getList('user_label', 'membership', function (&$list) {
					foreach ($list as &$item) {
						$item['user_total'] = pdo_count(sl_table_name('user'), ['id_label like'=>'%"'.$item['id'].'"%']);
					}

				}, 'id DESC', $action);
				break;

			default:
				self::userList();
		}
	}

	function doWebAddUserLabel()
	{
		global $_W, $_GPC;
		self::add('user_label', 'addUserLabel', 'membership', 'getUserLabelData',
			function () {
				global $_W, $_GPC;
				$_W['userLabelList'] = pdo_fetchall("SELECT * FROM " . sl_table_name('user_label',TRUE) .
					" WHERE uniacid = {$_W['uniacid']} AND (`delete` = 0 OR `delete` IS NULL)");
			}, ['action'=>'userLabel']);
	}
	function doWebEditUserLabel()
	{
		global $_W, $_GPC;
		self::edit('user_label', 'editUserLabel', 'membership', 'getUserLabelData',
			function (&$oldData) {
				if ($oldData['type'] != 3) return;
				global $_W, $_GPC;
				$_W['userLabelList'] = pdo_fetchall("SELECT * FROM " . sl_table_name('user_label',TRUE) .
					" WHERE uniacid = {$_W['uniacid']} AND (`delete` = 0 OR `delete` IS NULL)");
			}, ['action'=>'userLabel']);
	}
	function doWebDelUserLabel()
	{
		global $_W, $_GPC;
		self::deleteItem('user_label', 'membership', ['action'=>'userLabel']);
	}

	private function getUserLabelData()
	{
		global $_W, $_GPC;

		$data = [
			'title' => $_GPC['title_value'],
			'subtitle' => $_GPC['subtitle'],
		];
		return $data;
	}


	private function userLog()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$uniConStr = "l.uniacid='$sluni'";
		$start = empty($_GPC['start']) ? date_create()->sub(new DateInterval('P1D')) : date_create_from_format('Y-m-d', $_GPC['start']);
		$start = $start->setTime(0, 0, 0)->getTimestamp();
		$end = empty($_GPC['end']) ? date_create() : date_create_from_format('Y-m-d', $_GPC['end']);
		$end = $end->setTime(0, 0, 0)->getTimestamp();
		if ($start >= $end) {
			sl_ajax(1, '开始时间必须小于结束时间');
		}
		$_GET['start'] = date('Y-m-d', $start);
		$_GET['end'] = date('Y-m-d', $end);

		$ltn = sl_table_name('log',TRUE);
		$typeCon = '((l.subtype = 3 AND l.type IN (0,1,3,5,2)) OR (l.type = 6)) ';
		$res = pdo_fetchall("SELECT COUNT('id') FROM $ltn AS l WHERE $uniConStr AND $typeCon");
		$total = $res[0]["COUNT('id')"];
		if (!isset($_GPC['page'])) {
			$pageIndex = 1;
		} else {
			$pageIndex = intval($_GPC['page']);
		}
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);

		$startIndex = ($pageIndex - 1) * $pageSize;
		$utb = sl_table_name('user',TRUE);
		$mctb = sl_table_name('member_card',TRUE);
		$uctb = sl_table_name('user_card',TRUE);
		$fields = 'u.nickname,mc.name AS card,l.order_id,l.card_id,l.id,l.create,l.times,l.time,l.money,l.type,l.subtype,l.reason';
		$list = pdo_fetchall("SELECT $fields FROM $ltn AS l " .
			"LEFT JOIN $utb AS u ON u.id = l.user_id " .
			"LEFT JOIN $uctb AS uc ON uc.id = l.user_card_id " .
			"LEFT JOIN $mctb AS mc ON mc.id = uc.card_id " .
			"WHERE $uniConStr AND $typeCon ORDER BY l.id DESC LIMIT $startIndex,$pageSize");

		if ($list) {
			foreach ($list as &$row) {
				$row['nickname'] =
					is_json($row['nickname'])?json_decode($row['nickname']):$row['nickname'];

				$type = $row['type'];
				$subtype = $row['subtype'];
				switch ($type) {
					case 0://时间卡
						if ($subtype == 3) {//后台修改
							$time = $row['time'];
							$row['details'] = ($time > 0 ? '后台增加不限次约课时间：' : '后台减去不限次约课时间：') . $time . '天';
						}
						break;

					case 1://不限时次卡
						if ($subtype == 3) {//后台修改
							$times = $row['times'];
							$row['details'] = ($times > 0 ? '后台增加不限时约课次数：' : '后台减去不限时约课次数：') . $times . '次';
						}
						break;

					case 3://课程次卡
					case 5://限时次卡
						if ($subtype == 3) {//后台修改
							$card = pdo_getcolumn(sl_table_name('member_card'), ['id' => $row['card_id']], 'name');
							$row['details'] = '后台增加"' . $card . '"一张';
						}
						break;

					case 2://储值卡
						if ($subtype == 3) {//后台修改
							$money = $row['money'];
							$row['details'] = ($money > 0 ? '后台增加余额：' : '后台减去余额：') . $money . '元';
						}
						break;

					case 6://添加私教
						$coach = pdo_getcolumn(sl_table_name('coach'), ['id' => $row['order_id']], 'name');
						$row['details'] = '后台添加私教：教练—' . $coach . '，课时—' . $row['times'] . '次';
				}
			}
		}
		$action = 'log';
		include self::template('membership');
	}

	function doWebBookQueue()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$action = empty($_GPC['action']) ? '' : $_GPC['action'];

		self::delExpiredBookQueue();

		$uniConStr = "bq.uniacid='$sluni'";
		$list = pdo_fetchall("SELECT u.nickname,bq.id,bq.create_time,c.name AS course,cp.start FROM "
			. sl_table_name('book_queue',TRUE) . " AS bq " .
			"LEFT JOIN " . sl_table_name('user',TRUE) . " AS u ON u.id = bq.user_id " .
			"LEFT JOIN " . sl_table_name('course_plan',TRUE) . " AS cp ON cp.id = bq.plan_id " .
			"LEFT JOIN " . sl_table_name('course',TRUE) . " AS c ON c.id = cp.course_id " .
			"WHERE $uniConStr");
		if ($list) {
			foreach ($list as &$row) {
				$row['nickname'] = is_json($row['nickname'])?json_decode($row['nickname']):$row['nickname'];
			}
		}

		include self::template('bookQueue');
	}

	function doWebDelMemberLevel()
	{
		global $_W, $_GPC;
		self::deleteItem('member_level', 'membership', ['action' => 'level']);
	}

	function doWebAddMemberLevel()
	{
		global $_W, $_GPC;
		self::add('member_level', 'addMemberLevel', 'membership', 'getMemberLevelData', '', ['action' => 'level']);
	}

	function doWebEditMemberLevel()
	{
		global $_W, $_GPC;
		self::edit('member_level', 'editMemberLevel', 'membership', 'getMemberLevelData', '', ['action' => 'level']);
	}

	function doWebDelMemberCard()
	{
		global $_W, $_GPC;
		self::deleteItem('member_card', 'membership', ['action' => 'memberCard']);
	}

	/**
	 * 获取作用于课程排期的锁
	 */
	private function getCoursePlanLock($cpid)
	{
		global $_W, $_GPC;
		require_once IA_ROOT . '/addons/bozutung_jsfmd/Lock.php';
		return new FileLock('/tmp/bozutung_jsfmd_course_plan_' . $cpid);
	}

	function doWebIncDecBalance()
	{
		global $_W, $_GPC;

		$uid = intval($_GPC['uid']);

		if ($_W['ispost']) {
			$delta = intval($_GPC['delta']);
			if ($delta == 0) {
				sl_ajax(1, '增减用户余额失败，增减额度为0');
			}

			$balance = $delta + pdo_getcolumn(sl_table_name('user'), ['id' => $uid], 'balance');
			if ($balance < 0) $balance = 0;

			pdo_begin();
			$res = pdo_update(sl_table_name('user'), ['balance' => $balance], ['id' => $uid]);
			if ($res) {
				$data_log = [
					'uniacid' => $_W['uniacid'],
					'reason' => $_GPC['reason'],
					'money' => $delta,
					'user_id' => $uid,
					'create' => time(),
					'subtype' => 3,
					'type' => 2
				];
				pdo_insert(sl_table_name('log'), $data_log);

				pdo_commit();

				sl_ajax(0, '增减用户余额成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '增减用户余额失败，写数据库失败');
			}
		}
		include self::template('incDecBalance');
	}

	function doWebIncDecTimes()
	{
		global $_W, $_GPC;

		$uid = intval($_GPC['uid']);

		if ($_W['ispost']) {
			$delta = intval($_GPC['delta']);
			if ($delta == 0) {
				sl_ajax(0, '增减用户约课次数，增减额度为0');
			}

			$times = $delta + pdo_getcolumn(sl_table_name('user'), ['id' => $uid], 'left_times');
			if ($times < 0) $times = 0;

			pdo_begin();
			$res = pdo_update(sl_table_name('user'), ['left_times' => $times], ['id' => $uid]);
			if ($res) {
				pdo_insert(sl_table_name('log'), ['uniacid'=>$_W['uniacid'], 'reason'=>$_GPC['reason'], 'times'=>$delta,
					'user_id' => $uid, 'create' => time(), 'subtype' => 3, 'type' => 1]);
				pdo_commit();
				sl_ajax(0, '增减用户约课次数成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '增减用户约课次数失败，写数据库失败');
			}
		}
		include self::template('incDecTimes');
	}

	function doWebIncDecDueTime()
	{
		global $_W, $_GPC;

		$uid = intval($_GPC['uid']);

		if ($_W['ispost']) {
			$delta = intval($_GPC['delta']);
			if ($delta == 0) {
				sl_ajax(1, '增减会员到期时间，增减额度为0');
			}
			if (empty($uid)) {
				sl_ajax(1, '用户不存在');
			}

			$time = $_W['slwl']['datetime']['timestamp'];
			$dueTime = pdo_getcolumn(sl_table_name('user'), ['id' => $uid], 'due_time');
			if ($dueTime < $time) {
				$dueTime = $time;
			}
			if ($delta < 0) {
				$dueTime = (new DateTime())->setTimestamp($dueTime)->setTime(23, 59, 59)
					->sub(new DateInterval("P" . (-$delta) . "D"))->getTimestamp();
			} else {
				$dueTime = (new DateTime())->setTimestamp($dueTime)->setTime(0, 0, 0)
					->add(new DateInterval("P" . $delta . "D"))->getTimestamp();
			}

			pdo_begin();
			$res = pdo_update(sl_table_name('user'), ['due_time' => $dueTime], ['id' => $uid]);
			if ($res) {
				$data_insert = [
					'uniacid' => $_W['uniacid'],
					'reason'  => $_GPC['reason'],
					'time'    => $delta,
					'user_id' => $uid,
					'create'  => time(),
					'subtype' => 3,
					'type'    => 0,
				];
				pdo_insert(sl_table_name('log'), $data_insert);
				pdo_commit();
				sl_ajax(0, '增减会员到期日期成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '增减会员到期日期失败，写数据库失败');
			}
		}
		include self::template('incDecDueTime');
	}

	private function getUserData()
	{
		global $_W, $_GPC;
		$zdy = pdo_getcolumn(sl_table_name('system_settings'), ['uniacid' => $_W['uniacid']], 'zdy');
		$zdy = empty($zdy) ? [] : json_decode($zdy, TRUE);

		$name = $_GPC['real_name'];
		if ($zdy['name'] == 1 && empty($name)) {
			sl_ajax(1, '编辑失败，姓名为空');
		}
		$tel = $_GPC['tel'];
		if ($zdy['tel'] == 1 && empty($tel)) {
			sl_ajax(1, '编辑失败，电话为空');
		}
		$bust = $_GPC['bust'];
		if ($zdy['bust'] == 1 && $bust < 1) {
			sl_ajax(1, '编辑失败，胸围是正整数');
		}
		$height = $_GPC['height'];
		if ($zdy['height'] == 1 && $height < 1) {
			sl_ajax(1, '编辑失败，身高是正整数');
		}
		$weight = $_GPC['weight'];
		if ($zdy['weight'] == 1 && $weight < 1) {
			sl_ajax(1, '编辑失败，体重是正整数');
		}
		$thigh = $_GPC['thigh'];
		if ($zdy['thigh'] == 1 && $thigh < 1) {
			sl_ajax(1, '编辑失败，腿围是正整数');
		}
		$waistline = $_GPC['waistline'];
		if ($zdy['waistline'] == 1 && $waistline < 1) {
			sl_ajax(1, '编辑失败，腰围是正整数');
		}
		$idCardImage = $_GPC['id_card_image'];
		if ($zdy['idcard'] == 1 && empty($idCardImage)) {
			sl_ajax(1, '编辑失败，身份证照片为空');
		}
		$image = $_GPC['image'];
		if ($zdy['image'] == 1 && empty($idCardImage)) {
			sl_ajax(1, '编辑失败，个人照片为空');
		}
		if ($zdy['age'] == 1 && (empty($_GPC['age']) || intval($_GPC['age']) < 0)) {
			sl_ajax(1, '编辑失败，年龄为空或负数');
		}

		$options = $_GPC['options'];
		if ($options) {
			$ids = array_values($options['id_user_label']);
			$id_label = json_encode($ids);
		}

		return [
			'real_name' => $name,
			'id_no' => $_GPC['id_no'],
			'tel' => $tel,
			'member_level_id' => $_GPC['member_level_id'],
			'id_card_image' => $idCardImage,
			'image' => $image,
			'bust' => $bust,
			'height' => $height,
			'weight' => $weight,
			'thigh' => $thigh,
			'waistline' => $waistline,
			'age' => intval($_GPC['age']),
			'gender' => $_GPC['gender'],
			'id_label' => $id_label,
		];
	}

	private function getMemberCardData($edit = FALSE)
	{
		global $_W, $_GPC;
		$action = $edit ? '编辑失败' : '添加失败';
		$type = $_GPC['type'];
		$times = 0;
		$time = 0;
		$price = $_GPC['price'];
		if (!is_numeric($price)) {
			sl_ajax(1, '请输入一个数字');
		}

		switch ($type) {
			case 0://时间卡
				$time = intval($_GPC['time']);
				if ($time < 1) {
					sl_ajax(1, $action . '，时间是正整数');
				}
				break;

			case 1://次卡
				$times = intval($_GPC['times']);
				if ($times < 1) {
					sl_ajax(1, $action . '，次数是正整数');
				}
				break;

			case 2://储值卡
				$money = intval($_GPC['money']);
				if ($money < 1) {
					sl_ajax(1, $action . '，面额是正整数');
				}
				break;

			case 3://课程次卡/限时次卡
			case 5:
				$times = intval($_GPC['times']);
				if ($times < 1) {
					sl_ajax(1, $action . '，次数是正整数');
				}
				if (intval($_GPC['time']) > 0) $time = intval($_GPC['time']);
				break;
		}

		$data = [
			'name' => $_GPC['card'],
			'price' => $price,
			'time' => $time,
			'times' => $times,
			'money' => $money,
			'sort' => intval($_GPC['sort']),
			'details' => htmlspecialchars_decode($_GPC['details']),
			'to_sell' => $_GPC['to_sell'],
		];
		$data['type'] = $type;
		if ($type == 3) {
			$data['course_id'] = $_GPC['course_id'];
		}

		return $data;
	}

	private function getMemberLevelData($edit = FALSE)
	{
		global $_W, $_GPC;
		$price = $_GPC['price'];

		if (!is_numeric($price)) {
			sl_ajax(1, '请输入一个数字');
		}

		$data = [
			'name' => $_GPC['level'],
			'icon' => $_GPC['icon'],
			'price' => $price,
		];
		return $data;
	}

	private function getCouponData($edit = FALSE)
	{
		global $_W, $_GPC;
		$action = $edit ? '编辑失败' : '添加失败';
		$reach = intval($_GPC['reach']);
		if ($reach < 1) {
			sl_ajax(1, $action . ',最低金额是正整数');
		}
		$max = intval($_GPC['max']);
		if ($reach < 1) {
			sl_ajax(1, $action . ',最高领取人数是正整数');
		}
		$sort = intval($_GPC['sort']);
		if ($reach < 0) {
			sl_ajax(1, $action . ',排序是非负整数');
		}
		$recommend = intval($_GPC['recommend']);
		if ($reach < 0) {
			sl_ajax(1, $action . ',推荐度是非负整数');
		}
		$minus = intval($_GPC['minus']);
		if ($minus < 1) {
			sl_ajax(1, $action . ',减去金额是正整数');
		}
		if ($reach <= $minus) {
			sl_ajax(1, $action . ',减去金额必须小于最低金额');
		}
		$data = ['reach' => $reach, 'minus' => $minus, 'recommend' => $recommend, 'sort' => $sort, 'max' => $max,
			'description' => $_GPC['description'], 'bg_image' => $_GPC['bg_image']];
		if (!$edit) {
			$data['create_time'] = time();
		}
		$data['end_time'] = strtotime($_GPC['end_time']);
		return $data;
	}

	private function getActivityData($edit = FALSE)
	{
		global $_W, $_GPC;

		$store_ids = $_GPC['store']; // 门店ID
		if (empty($store_ids)) {
			sl_ajax(1, '门店必需选择一个');
		}

		$data = [];
		$data['name']       = $_GPC['activity'];
		$data['tel']        = $_GPC['tel'];
		$data['time']       = strtotime($_GPC['time']);
		$data['content']    = htmlspecialchars_decode($_GPC['content']);
		$data['cover']      = $_GPC['cover'];
		$data['store_info'] = json_encode($store_ids);
		return $data;
	}

	private function getCoachData($edit = FALSE)
	{
		global $_W, $_GPC;
		$zizhi = $_GPC['zizhi'];
		$action = $edit ? '编辑' : '添加';
		if (empty($zizhi)) {
			sl_ajax(1, $action . ',教练失败，教练资质为空');
		}
		$private = intval($_GPC['private']);
		$price = $_GPC['price'];
		$lower = intval($_GPC['course_num_lower']);
		if ($private > 0 && $lower < 1) {
			sl_ajax(1, $action . ',教练失败，私教起售节数是正数');
		}

		$store_ids = $_GPC['store']; // 门店ID
		if (empty($store_ids)) {
			sl_ajax(1, '门店必需选择一个');
		}

		$data = [];
		$data['name']             = $_GPC['coach'];
		$data['simple']           = $_GPC['simple'];
		$data['zizhi']            = $zizhi;
		$data['avatar']           = $_GPC['avatar'];
		$data['speech']           = $_GPC['speech'];
		$data['video']            = $_GPC['video'];
		$data['private']          = $private;
		$data['details']          = htmlspecialchars_decode($_GPC['details']);
		$data['price']            = $price;
		$data['course_num_lower'] = $lower;
		$data['strong_points']    = $_GPC['strong_points'];
		$data['tel']              = $_GPC['tel'];
		$data['wechat']           = $_GPC['wechat'];
		$data['details_enabled']  = $_GPC['details_enabled'];
		$data['store_info']       = json_encode($store_ids);
		return $data;
	}

	private function getStoreData($edit = FALSE)
	{
		global $_W, $_GPC;
		$subwayDistance = intval($_GPC['subway_distance']);
		if ($subwayDistance < 1) {
			$subwayDistance = 0;
		//    message(($edit ? '编辑' : '添加') . '门店失败，地铁步行距离是正整数', '', 'error');
		}
		$busStopDistance = intval($_GPC['bus_stop_distance']);
		if ($busStopDistance < 1) {
			sl_ajax(1, ($edit ? '编辑' : '添加') . '门店失败，公交步行距离是正整数');
		}
		$map = $_GPC['map'];
		$coordinate = '';
		if ($map['lng'] && $map['lat']) {
			$map_baidu = array('lng'=>$map['lng'], 'lat'=>$map['lat']);
			$map_qq = Convert_BD09_To_GCJ02($map['lat'], $map['lng']);
			$coordinate = array(
				'baidu'=>$map_baidu,
				'qq'=>$map_qq,
			);
		}

		$data = [];
		$data['name']                 = $_GPC['store'];
		$data['sort']                 = $_GPC['sort'];
		$data['image']                = $_GPC['image'];
		$data['address']              = $_GPC['address'];
		$data['subway_name']          = $_GPC['subway_name'];
		$data['subway_distance']      = $subwayDistance;
		$data['subway_description']   = $_GPC['subway_description'];
		$data['bus_stop_name']        = $_GPC['bus_stop_name'];
		$data['bus_stop_distance']    = $busStopDistance;
		$data['bus_stop_description'] = $_GPC['bus_stop_description'];
		$data['drive_place']          = $_GPC['drive_place'];
		$data['drive_description']    = $_GPC['drive_description'];
		$data['way']                  = $_GPC['way'];
		$data['coordinate']           = json_encode($coordinate, JSON_UNESCAPED_UNICODE);
		$data['lng']                  = $_GPC['lng'];
		$data['lat']                  = $_GPC['lat'];
		$data['create_time']          = $_W['slwl']['datetime']['now'];
		return $data;
	}

	private function getCourseSystemData()
	{
		global $_W, $_GPC;
		$data = array();
		$data['description'] = $_GPC['description'];
		$data['detail'] = $_GPC['detail'];
		$data['bg_color'] = $_GPC['bg_color'];
		$data['icon'] = $_GPC['icon'];
		$data['name'] = $_GPC['system'];
		$data['image'] = $_GPC['image'];
		return $data;
	}

	private function privateCoachList()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$uniConStr = "pcb.uniacid='$sluni'";

		$pcbtn = sl_table_name('private_coach_buy',TRUE);
		$utb = sl_table_name('user',TRUE);
		$ctb = sl_table_name('coach',TRUE);
		if (!empty($_GPC['nickname']))
			$userQuery = "pcb.user_id IN (SELECT id FROM $utb AS u WHERE u.nickname LIKE '%" . $_GPC['nickname'] . "%')";
		if (!empty($_GPC['coach']))
			$coachQuery = "pcb.coach_id IN (SELECT id FROM $ctb AS c WHERE c.name LIKE '%" . $_GPC['coach'] . "%')";

		if (!empty($_GPC['submit'])) unset($_GPC['page']);

		if (!empty($userQuery) && !empty($coachQuery)) {
			$countSql = "SELECT COUNT(pcb.id) AS total FROM $pcbtn AS pcb " .
				"WHERE $uniConStr AND $userQuery AND $coachQuery";
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr AND $userQuery AND $coachQuery";
			$_GET['coach'] = $_GPC['coach'];
			$_GET['nickname'] = $_GPC['nickname'];
		} else if (!empty($userQuery)) {
			$countSql = "SELECT COUNT(pcb.id) AS total FROM $pcbtn AS pcb " .
				"WHERE $uniConStr AND $userQuery";
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr AND $userQuery";
			$_GET['nickname'] = $_GPC['nickname'];
		} else if (!empty($coachQuery)) {
			$countSql = "SELECT COUNT(pcb.id) AS total FROM $pcbtn AS pcb " .
				"WHERE $uniConStr AND $coachQuery";
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr AND $coachQuery";
			$_GET['coach'] = $_GPC['coach'];
		} else {
			$countSql = "SELECT COUNT(pcb.id) AS total FROM $pcbtn AS pcb WHERE $uniConStr";
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr";
		}

		$res = pdo_fetchall($countSql);
		$total = $res[0]["total"];
		$pageIndex = !isset($_GPC['page']) ? 1 : intval($_GPC['page']);
		$pageSize = 10;
		$pager = pagination($total, $pageIndex, $pageSize);

		$startIndex = ($pageIndex - 1) * $pageSize;
		$list = pdo_fetchall($listSql . " ORDER BY pcb.id LIMIT $startIndex,$pageSize");

		foreach ($list as $key => $value) {
			$list[$key]['nickname'] = sl_nickname($value['nickname']);
		}

		$action = 'private';
		include self::template('membership');
	}

	function doWebDelPrivateCoach()
	{
		global $_W, $_GPC;
		$res = pdo_query("DELETE FROM " . sl_table_name('private_coach_buy',TRUE) .
			" WHERE left_times = num AND id = ${_GPC['id']}");
		if ($res) {
			sl_ajax(0, '成功');
		} else {
			sl_ajax(1, '失败');
		}
	}

	function doWebAddPrivateCoach()
	{
		global $_W, $_GPC;

		$uid = $_GPC['uid'];
		if ($_W['ispost']) {
			$num = intval($_GPC['num']);
			if ($num < 1) {
				sl_ajax(1, '添加失败，课时数必需正整数');
			}
			$time = time();
			$data = [
				'user_id'    => $uid,
				'coach_id'   => $_GPC['coach_id'],
				'uniacid'    => $_W['uniacid'],
				'time'       => $time,
				'num'        => $num,
				'left_times' => $num
			];
			pdo_begin();
			$res = pdo_insert(sl_table_name('private_coach_buy'), $data);
			if ($res && pdo_insert(sl_table_name('log'), ['user_id'=>$uid, 'order_id'=>$_GPC['coach_id'], 'uniacid'=>$_W['uniacid'],
					'create' => $time, 'times' => $num, 'type' => 6])
			) {
				pdo_commit();
				sl_ajax(0, '成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '失败');
			}
		}
		$uniConArr = ['uniacid'=>$_W['uniacid'], 'private'=>1];
		$uniConArr['delete'] = '0';
		$coachList = pdo_getall(sl_table_name('coach'), $uniConArr, ['id', 'name']);

		include self::template('addPrivateCoach');
	}

	function doWebGiveMemberCard()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$card_id = $_GPC['card_id']; // 会员卡ID
		$uid = intval($_GPC['uid']);

		if (empty($uid)) { sl_ajax(1, '用户不存在'); }

		if ($_W['ispost']) {

			$card = pdo_get(sl_table_name('member_card'), ['id' => $card_id]);
			$type = $card['type'];

			$data = ['user_id' => $uid, 'uniacid' => $_W['uniacid'], 'type' => $type, 'card_id' => $card['id']];
			switch ($type) {
				case 3://课程次卡
				case 5://限时次卡
					$time = intval($card['time']);
					if ($time > 0) {
						$data['due_time'] = (new DateTime())->setTime(23, 59, 59)
							->add(new DateInterval("P{$time}D"))->getTimestamp();
					}
					$data['times'] = $card['times'];
					$data['left_times'] = $card['times'];
					$log = [
						'uniacid' => $_W['uniacid'],
						'user_id' => $uid,
						'card_id' => $card['id'],
						'create' => $_W['slwl']['datetime']['timestamp'],
						'type' => $type,
						'subtype' => 3
					];
					break;
			}
			pdo_begin();
			$res = pdo_insert(sl_table_name('user_card'), $data);
			if ($res && pdo_insert(sl_table_name('log'), $log)) {
				pdo_commit();
				sl_ajax(0, '成功');
			} else {
				pdo_rollback();
				sl_ajax(1, '失败');
			}
		}

		$uniConStr = "uniacid='$sluni'";
		$list = pdo_fetchall("SELECT id,name FROM " . sl_table_name('member_card',TRUE) .
			" WHERE $uniConStr AND `type` IN (3,5) AND (`delete` = 0 OR `delete` IS NULL)");
		include self::template('giveMemberCard');
	}

	protected function template($filename)
	{
		global $_W, $_GPC;
		if (/*$_W['template'] != 'default' &&*/
			$filename == 'myheader'
		) {
			$filename = 'common/header';
		}
		return parent::template($filename);
	}

	function doWebManager()
	{
		global $_W, $_GPC;
		$uid = intval($_GPC['uid']);
		$role = intval($_GPC['role']);

		if ($role == 1) {
			if (pdo_update(sl_table_name('user'), ['role' => 0], ['id' => $uid])) {
				sl_ajax(0, '成功');
			} else {
				sl_ajax(1, '失败');
			}
		}

		if ($role == 0) {
			if (pdo_update(sl_table_name('user'), ['role' => 1], ['id' => $uid])) {
				sl_ajax(0, '成功');
			} else {
				sl_ajax(1, '失败');
			}
		}
		sl_ajax(1, '失败，无效参数');
	}

	function doWebExportMemberAsExcel()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$tn = sl_table_name('user',TRUE);
		$uniacidStr = "uniacid='$sluni'";

		$delete = ' (`delete` = 0 OR `delete` IS NULL) AND openid != \'\'';
		if (!empty($_GPC['query'])) {
			$q = $_GPC['query'];
			$delete .= " AND (real_name LIKE '%$q%' OR nickname LIKE '%$q%' OR tel LIKE '%$q%') ";
		};
		$list = pdo_fetchall("SELECT * FROM $tn WHERE $uniacidStr AND $delete ORDER BY id ");

		$mlidList = [];
		foreach ($list as $item) {
			if (!empty($item['member_level_id'])) $mlidList[] = $item['member_level_id'];
		}
		$time = time();
		if (empty($mlidList)) {
			foreach ($list as &$item) {
				$item['memberLevelName'] = '普通会员';
				$item['due_time'] = $item['due_time'] < $time ? '已到期' : date('Y-m-d', $item['due_time']);
			}
		} else {
			$mlList = pdo_fetchall("SELECT id,name FROM " . sl_table_name('member_level',TRUE)
				. " WHERE id IN (" . implode(',', $mlidList) . ")");
			foreach ($list as &$item) {
				$item['due_time'] = $item['due_time'] < $time ? '已到期' : date('Y-m-d', $item['due_time']);

				if (empty($item['member_level_id'])) {
					$item['memberLevelName'] = '普通会员';
				} else {
					foreach ($mlList as $i) {
						if ($i['id'] == $item['member_level_id']) {
							$item['memberLevelName'] = $i['name'];
							break;
						}
					}
				}
			}
		}

		static::downloadExcel('member.xlsx', function (&$sheet) use ($list) {
			$sheet->getCell('A1')->setValue('ID');
			$sheet->getCell('B1')->setValue('姓名');
			$sheet->getCell('C1')->setValue('电话');
			$sheet->getCell('D1')->setValue('会员详情');
			$rowIndex = 2;
			foreach ($list as $row) {
				$sheet->getCell('A' . $rowIndex)->setValue($row['id']);
				$sheet->getCell('B' . $rowIndex)->setValue($row['real_name']);
				$sheet->getCell('C' . $rowIndex)->setValue($row['tel']);
				$details = '等级：' . $row['memberLevelName'] . "\n" .
					'余额：￥' . $row['balance'] . "\n" .
					'奖金：￥' . $row['commission'] . "\n" .
					'剩余约课次数：' . $row['left_times'] . "\n" .
					'无限约课到期日期：' . $row['due_time'];
				$sheet->getCell('D' . $rowIndex)->setValue($details);
				$sheet->getStyle('D' . $rowIndex)->getAlignment()->setWrapText(TRUE);
				++$rowIndex;
			}
		});
	}

	function doWebExportSignInAsExcel()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$uniConStr = "si.uniacid='$sluni'";

		$today = (new DateTime())->setTime(0, 0, 0);
		$startDate = empty($_GPC['start']) ? date('Y-m-d', ($today->getTimestamp() - 7 * 24 * 60 * 60)) : $_GPC['start'];
		$endDate = empty($_GPC['end']) ? date('Y-m-d') : $_GPC['end'];
		$start = date_create_from_format('Y-m-d', $startDate)->setTime(0, 0, 0)->getTimestamp();
		$end = date_create_from_format('Y-m-d', $endDate)->setTime(0, 0, 0)->getTimestamp();
		$timeWhere = " `time` < $end AND `time` >= $start ";

		$sitn = sl_table_name('sign_in',TRUE);
		$utn = sl_table_name('user',TRUE);
		$ctn = sl_table_name('course',TRUE);
		$catn = sl_table_name('coach',TRUE);
		$fields = 'u.nickname,c.name AS course,ca.name AS coach,si.id,si.time,si.type';
		$list = pdo_fetchall("SELECT $fields FROM $sitn AS si " .
			"LEFT JOIN $utn AS u ON u.id = si.user_id " .
			"LEFT JOIN $ctn AS c ON c.id = si.course_id " .
			"LEFT JOIN $catn AS ca ON ca.id = si.coach_id " .
			"WHERE $uniConStr AND $timeWhere ORDER BY si.id DESC");

		static::downloadExcel('signIn.xlsx', function (&$sheet) use ($list) {
			$sheet->getCell('A1')->setValue('ID');
			$sheet->getCell('B1')->setValue('用户昵称');
			$sheet->getCell('C1')->setValue('类型');
			$sheet->getCell('D1')->setValue('课程');
			$sheet->getCell('E1')->setValue('教练');
			$sheet->getCell('F1')->setValue('签到时间');
			$rowIndex = 2;
			foreach ($list as $row) {
				$type = $row['type'];

				$sheet->getCell('A' . $rowIndex)->setValue($row['id']);
				$sheet->getCell('B' . $rowIndex)->setValue($row['nickname']);
				$sheet->getCell('C' . $rowIndex)->setValue($type == 0 ? '团课' : '私教');
				$sheet->getCell('D' . $rowIndex)->setValue($type == 0 ? $row['course'] : '');
				$sheet->getCell('E' . $rowIndex)->setValue($type == 1 ? $row['coach'] : '');
				$sheet->getCell('F' . $rowIndex)->setValue(date('Y-m-d H:i:s', $row['time']));
				++$rowIndex;
			}
		});
	}

	function doWebExportPrivateAsExcel()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$uniConStr = "pcb.uniacid='$sluni'";

		$pcbtn = sl_table_name('private_coach_buy',TRUE);
		$utb = sl_table_name('user',TRUE);
		$ctb = sl_table_name('coach',TRUE);
		if (!empty($_GPC['nickname']))
			$userQuery = "pcb.user_id IN (SELECT id FROM $utb AS u WHERE u.nickname LIKE '%" . $_GPC['nickname'] . "%')";
		if (!empty($_GPC['coach']))
			$coachQuery = "pcb.coach_id IN (SELECT id FROM $ctb AS c WHERE c.name LIKE '%" . $_GPC['coach'] . "%')";

		if (!empty($_GPC['submit'])) unset($_GPC['page']);

		if (!empty($userQuery) && !empty($coachQuery)) {
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr AND $userQuery AND $coachQuery";
		} else if (!empty($userQuery)) {
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr AND $userQuery";
		} else if (!empty($coachQuery)) {
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr AND $coachQuery";
		} else {
			$listSql = "SELECT u.nickname,c.name AS coach,pcb.id,pcb.num,pcb.left_times FROM $pcbtn AS pcb " .
				"LEFT JOIN $utb AS u ON u.id = pcb.user_id " .
				"LEFT JOIN $ctb AS c ON c.id = pcb.coach_id " .
				"WHERE $uniConStr";
		}

		$list = pdo_fetchall($listSql . " ORDER BY pcb.id");

		static::downloadExcel('private.xlsx', function (&$sheet) use ($list) {
			$sheet->getCell('A1')->setValue('ID');
			$sheet->getCell('B1')->setValue('用户昵称');
			$sheet->getCell('C1')->setValue('教练');
			$sheet->getCell('D1')->setValue('总课时数');
			$sheet->getCell('E1')->setValue('剩余课时数');
			$rowIndex = 2;
			foreach ($list as $row) {
				$sheet->getCell('A' . $rowIndex)->setValue($row['id']);
				$sheet->getCell('B' . $rowIndex)->setValue($row['nickname']);
				$sheet->getCell('C' . $rowIndex)->setValue($row['coach']);
				$sheet->getCell('D' . $rowIndex)->setValue($row['num']);
				$sheet->getCell('E' . $rowIndex)->setValue($row['left_times']);
				++$rowIndex;
			}
		});
	}

	function doWebExportMemberLogAsExcel()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$start = empty($_GPC['start']) ? date_create()->sub(new DateInterval('P1D')) : date_create_from_format('Y-m-d', $_GPC['start']);
		$start = $start->setTime(0, 0, 0)->getTimestamp();
		$end = empty($_GPC['end']) ? date_create() : date_create_from_format('Y-m-d', $_GPC['end']);
		$end = $end->setTime(0, 0, 0)->getTimestamp();
		if ($start >= $end) {
			sl_ajax(1, '开始时间必须小于结束时间');
		}

		$uniConStr = "l.uniacid='$sluni'";
		$ltn = sl_table_name('log',TRUE);
		$typeCon = '((l.subtype = 3 AND l.type IN (0,1,3,5,2)) OR (l.type = 6)) AND l.create < ' . $end . ' AND l.create >= ' . $start;

		$utb = sl_table_name('user',TRUE);
		$mctb = sl_table_name('member_card',TRUE);
		$uctb = sl_table_name('user_card',TRUE);
		$fields = 'u.nickname,mc.name AS card,l.order_id,l.card_id,l.id,l.create,l.times,l.time,l.money,l.type,l.subtype,l.reason';
		$list = pdo_fetchall("SELECT $fields FROM $ltn AS l " .
			"LEFT JOIN $utb AS u ON u.id = l.user_id " .
			"LEFT JOIN $uctb AS uc ON uc.id = l.user_card_id " .
			"LEFT JOIN $mctb AS mc ON mc.id = uc.card_id " .
			"WHERE $uniConStr AND $typeCon ORDER BY l.id DESC");

		static::downloadExcel('11.xlsx', function (&$sheet) use ($list) {
			$sheet->getCell('A1')->setValue('ID');
			$sheet->getCell('B1')->setValue('用户');
			$sheet->getCell('C1')->setValue('时间');
			$sheet->getCell('D1')->setValue('详情');
			$rowIndex = 2;
			foreach ($list as $row) {
				$type = $row['type'];
				$subtype = $row['subtype'];
				$details = '';
				switch ($type) {
					case 0://时间卡-后台修改
						if ($subtype == 3) {
							$time = $row['time'];
							$details = ($time > 0 ? '后台增加不限次约课时间：' : '后台减去不限次约课时间：') . $time . '天';
						}
						break;

					case 1://不限时次卡-后台修改
						if ($subtype == 3) {
							$times = $row['times'];
							$details = ($times > 0 ? '后台增加不限时约课次数：' : '后台减去不限时约课次数：') . $times . '次';
						}
						break;

					case 3://课程次卡-后台修改
					case 5://限时次卡-后台修改
						if ($subtype == 3) {
							$card = pdo_getcolumn(sl_table_name('member_card'), ['id' => $row['card_id']], 'name');
							$details = '后台增加"' . $card . '"一张';
						}
						break;

					case 2://储值卡-后台修改
						if ($subtype == 3) {
							$money = $row['money'];
							$details = ($money > 0 ? '后台增加余额：' : '后台减去余额：') . $money . '元';
						}
						break;

					case 6://添加私教-后台修改
						$coach = pdo_getcolumn(sl_table_name('coach'), ['id' => $row['order_id']], 'name');
						$details = '后台添加私教：教练—' . $coach . '，课时—' . $row['times'] . '次';
				}

				$sheet->getCell('A' . $rowIndex)->setValue($row['id']);
				$sheet->getCell('B' . $rowIndex)->setValue($row['nickname']);
				$sheet->getCell('C' . $rowIndex)->setValue(date('Y-m-d H:i:s', $row['create']));
				$sheet->getCell('D' . $rowIndex)->setValue($details);
				++$rowIndex;
			}
		});
	}

	private static function downloadExcel($downloadFileName, $callback)
	{
		global $_W, $_GPC;
		require_once IA_ROOT . '/addons/' . $_W['current_module']['name'] . '/lib/PHPExcel/PHPExcel.php';
		$excel = new PHPExcel();
		$sheet = $excel->getSheet(0);
		$callback($sheet);
		$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
		$file = '/tmp/' . md5(time());
		$writer->save($file);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename=' . $downloadFileName);
		header('Content-Length: ' . filesize($file));
		echo file_get_contents($file);
		exit(0);
	}

	function doWebCopyCoursePlanToNext()
	{
		global $_W, $_GPC;
		$sluni = $_W['uniacid'];

		$uniConStr = "uniacid='$sluni'";
		$time = $time = (new DateTime())->setTime(0, 0, 0)->getTimestamp();
		$monday = $time - ((date("N", $time) - 1) * 24 * 3600);
		$week = 7 * 24 * 3600;
		$nextMonday = $monday + $week;
		$nnMonday = $nextMonday + $week;
		$lists = pdo_fetchall("SELECT * FROM " . sl_table_name('course_plan',TRUE) .
			" WHERE `delete` = 0 AND $uniConStr AND start >= $monday AND start <$nnMonday ORDER BY start");
		$old = [];
		$next = [];
		foreach ($lists as &$row) {
			if ($row['start'] < $nextMonday) {
				$old[] = $row;
			} else {
				$next[] = $row;
			}
		}

		$htn = sl_table_name('course_plan');
		$copy = 0;
		foreach ($old as &$row) {
			$insert = TRUE;
			foreach ($next as $existRow) {
				if ($row['course_id'] == $existRow['course_id'] &&
					$row['store_id'] == $existRow['store_id'] &&
					$row['coach_id'] == $existRow['coach_id'] &&
					$row['start'] + $week == $existRow['start']
				) {
					$insert = FALSE;
					break;
				}
			}
			if ($insert) {
				unset($row['id']);
				$row['booked_number'] = 0;
				$row['start'] += $week;
				$row['end'] += $week;
				$row['book_end'] += $week;
				$row['book_start'] += $week;
				$rst = pdo_insert($htn, $row);
				if ($rst !== FALSE) {
					$copy += 1;
				} else {
					sl_ajax(1, '失败');
					break;
				}
			}
		}
		if ($copy) {
			sl_ajax(0, '成功');
		} else {
			sl_ajax(1, '没有记录被复制');
		}
	}

}
