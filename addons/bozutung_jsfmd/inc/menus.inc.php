<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

if(!defined('IN_IA')) { exit('Access Denied'); }

global $_GPC, $_W;

$mod_menu = [
	'basic'=>[
		'mod'=>'0',
		'title'=>'系统管理',
		'items'=>[
			'basic/set'=>['title'=>'基本设置', 'url'=>webUrl('',['do'=>'basic/set']), 'show'=>TRUE],
			'systemSettings'=>['title'=>'通用设置', 'url'=>webUrl('systemSettings'), 'show'=>TRUE],
			'basic/buttons'=>['title'=>'导航按钮组', 'url'=>webUrl('',['do'=>'basic/buttons']), 'show'=>TRUE],
			'basic/menus'=>['title'=>'底部导航', 'url'=>webUrl('',['do'=>'basic/menus']), 'show'=>TRUE],
			'basic/cpright'=>['title'=>'版权设置', 'url'=>webUrl('',['do'=>'basic/cpright']), 'show'=>TRUE],
		]
	],
	'module'=>[
		'mod'=>'0',
		'title'=>'组件管理',
		'items'=>[
			'module/adv'       => ['title'=>'轮播图', 'url'=>webUrl('',['do'=>'module/adv']), 'show'=>TRUE],
			'module/adact'     => ['title'=>'单页面', 'url'=>webUrl('',['do'=>'module/adact']), 'show'=>TRUE],
			'module/mod_wxapp' => ['title'=>'跳转小程序', 'url'=>webUrl('',['do'=>'module/mod_wxapp']), 'show'=>TRUE],
			'module/coupon'    => ['title'=>'优惠券', 'url'=>webUrl('',['do'=>'module/coupon']), 'show'=>TRUE],
			'module/tpl_msg'   => ['title'=>'消息提醒', 'url'=>webUrl('',['do'=>'module/tpl_msg']), 'show'=>TRUE],
			'module/live'      => ['title'=>'小程序直播', 'url'=>webUrl('',['do'=>'module/live']), 'show'=>TRUE],
		]
	],
	'content'=>[
		'mod'=>'0',
		'title'=>'内容管理',
		'items'=>[
			'content/store'      => ['title'=>'门店', 'url'=>webUrl('',['do'=>'content/store']), 'show'=>TRUE],
			'coachList'          => ['title'=>'教练/老师', 'url'=>webUrl('coachList'), 'show'=>TRUE],
			'courseList'         => ['title'=>'课程', 'url'=>webUrl('courseList'), 'show'=>TRUE],
			'activityList'       => ['title'=>'活动管理', 'url'=>webUrl('activityList'), 'show'=>TRUE],
			'bookQueue'          => ['title'=>'排队预约', 'url'=>webUrl('bookQueue'), 'show'=>TRUE],
			'membership'         => ['title'=>'会员', 'url'=>webUrl('membership'), 'show'=>TRUE],
			'content/order'      => ['title'=>'订单', 'url'=>webUrl('',['do'=>'content/order']), 'show'=>TRUE],
			'content/commission' => ['title'=>'分销管理', 'url'=>webUrl('',['do'=>'content/commission']), 'show'=>TRUE],

			'addCoursePlan'   => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addCourse'       => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addCourseSystem' => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addCategory'     => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addActivity'     => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addCoupon'       => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addCoach'        => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addStore'        => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addCourseVideo'  => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addMemberLevel'  => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addMemberCard'   => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'addVideoCourse'  => ['title'=>'添加视频课程', 'url'=>webUrl(''), 'show'=>false],

			'editCoursePlan'   => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editCourse'       => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editCourseSystem' => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editCategory'     => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editActivity'     => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editCoupon'       => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editCoach'        => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editStore'        => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editCourseVideo'  => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editMemberLevel'  => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editMemberCard'   => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editVideoCourse'  => ['title'=>'编辑视频课程', 'url'=>webUrl(''), 'show'=>false],

			'courseVideoList'       => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'coursePaymentWayList'  => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'courseMemberLevelList' => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'receivedCouponList'    => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'userMemberCardList'    => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],

			'addPrivateCoach' => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'giveMemberCard'  => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'incDecBalance'   => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'incDecTimes'     => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'incDecDueTime'   => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
			'editUser'        => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],

			'refund' => ['title'=>'tmp', 'url'=>webUrl(''), 'show'=>false],
		]
	],
	'other'=>[
		'mod'=>'0',
		'title'=>'其他设置',
		'items'=>[
			'other/upwxapp'=>['title'=>'上传小程序', 'url'=>webUrl('',['do'=>'other/upwxapp']), 'show'=>TRUE],
			// 'other/sdata'=>['title'=>'数据初始化', 'url'=>webUrl('sdata',['do'=>'other/sdata']), 'show'=>TRUE],
			'other/auth'=>['title'=>'系统授权', 'url'=>webUrl('',['do'=>'other/auth']), 'show'=>TRUE],
			'other/upgrade'=>['title'=>'系统修复', 'url'=>webUrl('',['do'=>'other/upgrade']), 'show'=>TRUE],
			'other/group'=>['title'=>'权限组', 'url'=>webUrl('',['do'=>'other/group']), 'show'=>TRUE],
			'gongdang'=>['title'=>'提交工单', 'url'=>'http://kf.q14.cn/forum.php?mod=forumdisplay&fid=37', 'show'=>TRUE, 'target'=>'_blank'],
			'other/oplog'=>['title'=>'操作日志', 'url'=>webUrl('',['do'=>'other/oplog']), 'show'=>false, 'target'=>'_self'],
		]
	],
	'system'=>[
		'mod'=>'0',
		'title'=>'系统',
		'items'=>[
			'system/dialoglink' => ['title'=>'选择连接', 'url'=>webUrl('',['do'=>'system/dialoglink']), 'show'=>false],
			'system/dialogfont' => ['title'=>'选择图标', 'url'=>webUrl('',['do'=>'system/dialogfont']), 'show'=>false],
			'system/dialoguser' => ['title'=>'选择用户', 'url'=>webUrl('',['do'=>'system/dialoguser']), 'show'=>false],
		]
	],
];

$first_mod = '0';
if ($_W['role'] == 'founder') {
	foreach ($mod_menu as $k => $v) {
		if (array_key_exists($_GPC['do'], $v['items'])) {
			$mod_menu[$k]['mod'] = '1';
			$first_mod = '1';
			break;
		}
	}
} else {
	// 非创初始人，删除[其他设置菜单].start
	unset($mod_menu['other']);
	// 非创初始人，删除[其他设置菜单].end

	$where_admin = ['uniacid'=>$_W['uniacid'], 'mp_user_id'=>$_W['uid']];
	$one_admin = pdo_get(sl_table_name('admin'), $where_admin);

	$auth_menu = [];
	if ($one_admin) {
		$where_admin_role = ['uniacid'=>$_W['uniacid'], 'id'=>$one_admin['group_id']];
		$one_admin_role = pdo_get(sl_table_name('admin_role'), $where_admin_role);

		if ($one_admin_role && $one_admin_role['auth_menu']) {
			$tmp = json_decode($one_admin_role['auth_menu'], TRUE);

			if ($tmp) {
				$auth_menu = $tmp;
			}
		}
	}

	// 删除没有权限的菜单，没有配置不删除
	if ($auth_menu) {
		foreach ($mod_menu as $k => $v) {
			$tmp_menu = [];
			foreach ($v['items'] as $key => $value) {
				if (!(in_array($key, $auth_menu))) {
					unset($mod_menu[$k]['items'][$key]);
				}
			}

			if (array_key_exists($_GPC['do'], $v['items'])) {
				$mod_menu[$k]['mod'] = '1';
				$first_mod = '1';
			}
		}
	}
	// else {
	// 	foreach ($mod_menu as $key => $value) {
	// 		unset($mod_menu[$key]);
	// 	}
	// }
}

// 删除显示属性为 false 的菜单
if ($mod_menu) {
	foreach ($mod_menu as $key => $value) {
		if ($value['items']) {
			foreach ($value['items'] as $k => $v) {
				if (!($v['show'])) {
					unset($mod_menu[$key]['items'][$k]);
				}
			}
		}
	}
}

// 删除没有子项的菜单
foreach ($mod_menu as $key => $value) {
	if (empty($value['items'])) {
		unset($mod_menu[$key]);
	}
}

// web页时展开第一个菜单列表项
if ($first_mod == '0') {
	if ($mod_menu) {
		foreach ($mod_menu as $k => $v) {
			$mod_menu[$k]['mod'] = '1';
			break;
		}
	}
}

$_W['menus_array']['left'] = $mod_menu;

// -----------------------------------------------------------------------------

// top菜单
$mod_menu_top = [
	'top'=>[
		'mod'=>'0',
		'title'=>'项部菜单',
		'items'=>[
			'web'           => ['title'=>'首页', 'url'=>webUrl('web'), 'show'=>TRUE],
			'courseList'    => ['title'=>'课程', 'url'=>webUrl('courseList'), 'show'=>TRUE],
			'activityList'  => ['title'=>'活动管理', 'url'=>webUrl('activityList'), 'show'=>TRUE],
			'module/coupon' => ['title'=>'优惠券', 'url'=>webUrl('',['do'=>'module/coupon']), 'show'=>TRUE],
			'coachList'     => ['title'=>'教练/老师', 'url'=>webUrl('coachList'), 'show'=>TRUE],
			'content/store' => ['title'=>'门店', 'url'=>webUrl('',['do'=>'content/store']), 'show'=>TRUE],
			'bookQueue'     => ['title'=>'排队预约', 'url'=>webUrl('bookQueue'), 'show'=>TRUE],
			'membership'    => ['title'=>'会员', 'url'=>webUrl('membership'), 'show'=>TRUE],
			'content/order' => ['title'=>'订单', 'url'=>webUrl('',['do'=>'content/order']), 'show'=>TRUE],
			'other/upwxapp' => ['title'=>'上传小程序', 'url'=>webUrl('',['do'=>'other/upwxapp']), 'show'=>TRUE],
		]
	],
];

if ($_W['role'] != 'founder') {
	foreach ($mod_menu_top as $k => $v) {
		foreach ($v['items'] as $key => $value) {
			if ($key != 'web' && $key != 'other/upwxapp') {
				if (!(in_array($key, $auth_menu))) {
					unset($mod_menu_top[$k]['items'][$key]);
				}
			}
		}
	}
}

$_W['menus_array']['top'] = $mod_menu_top['top'];

// 工单
// $gongdang =
// 	webUrl('module/manage-system/module_detail', [
// 		'name'=>'bozutung_jsfmd',
// 		'support'=>'',
// 		'type'=>'1',
// 		'tdsourcetag'=>'s_pctim_aiomsg'
// 	]);
