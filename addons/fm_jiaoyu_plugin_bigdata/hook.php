<?php
/**
 * 微教育访问申请插件定义
 *
 * @author 微美科技
 * @url
 */
defined('IN_IA') or exit('Access Denied');
define('MODULE_ROOT', IA_ROOT.'/addons/fm_jiaoyu/');
class Fm_jiaoyu_plugin_bigdataModuleHook extends WeModuleHook {
	// 载入逻辑方法
	private function getLogic($_name, $type = "web", $array, $auth = false) {
		global $_W;
		$_GPC = $array['gpc'];
		$usertype = $array['usertype'];
		$_W['schooltype'] = $array['schooltype'];
		$goto = $_GPC['goto'];
		if ($type == 'web') {
			checkLogin ();  //检查登陆
			include_once './fm_jiaoyu/inc/func/list.php';
			include_once 'inc/web/' . $goto . '.php';
		} else if ($type == 'mobile') {
			$language = $_W['lanconfig'][$goto];
			if ($usertype == 'common') {
				include_once 'inc/mobile/common/' . $goto . '.php';
			} else if ($usertype == 'teacher') {
				include_once 'inc/mobile/teacher/' . $goto . '.php';
			} else if ($usertype == 'student') {
				include_once 'inc/mobile/student/' . $goto . '.php';
			}
		}
	}
	// ====================== web====================
    public function hookWebHookweb($array) {
        $this->getLogic ( __FUNCTION__, 'web' ,$array);
    }
	// ====================== mobile=================
	public function hookMobileHookmobile($array) {
		$this->getLogic ( __FUNCTION__, 'mobile' ,$array, true);
	}


    public function doWebSchoolbdset($array) {
        $this->getLogic ( __FUNCTION__, 'web' ,$array);
    }

	function createMobileUrls($do, $query = array(), $noredirect = true) {
		global $_W;
		$query['do'] = $do;
		$query['m'] = 'fm_jiaoyu';
		return murl('entry', $query, $noredirect);
	}
	
	function createWebUrls($do, $query = array()) {
		$query['do'] = $do;
		$query['m'] = 'fm_jiaoyu';
		return wurl('site/entry', $query);
	}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
public $table_assteach = 'wx_school_assteach';
public $table_classify = 'wx_school_classify';
public $table_points = 'wx_school_points';
public $table_pointsrecord = 'wx_school_pointsrecord';
public $table_address = 'wx_school_address';
public $table_mall = 'wx_school_mall';
public $table_mallorder = 'wx_school_mallorder';
public $table_score = 'wx_school_score';
public $table_news = 'wx_school_news';
public $table_index = 'wx_school_index';
public $table_students = 'wx_school_students';
public $table_tcourse = 'wx_school_tcourse';
public $table_teachers = 'wx_school_teachers';
public $table_area = 'wx_school_area';
public $table_type = 'wx_school_type';
public $table_kcbiao = 'wx_school_kcbiao';
public $table_cook = 'wx_school_cookbook';
public $table_reply = 'wx_school_reply';
public $table_banners = 'wx_school_banners';
public $table_bbsreply = 'wx_school_bbsreply';
public $table_user = 'wx_school_user';
public $table_set = 'wx_school_set';
public $table_leave = 'wx_school_leave';
public $table_notice = 'wx_school_notice';
public $table_bjq = 'wx_school_bjq';
public $table_media = 'wx_school_media';
public $table_dianzan = 'wx_school_dianzan';
public $table_order = 'wx_school_order';
public $table_wxpay = 'wx_school_wxpay';
public $table_group = 'wx_school_fans_group';
public $table_qrinfo = 'wx_school_qrcode_info';
public $table_qrset = 'wx_school_qrcode_set';
public $table_qrstat = 'wx_school_qrcode_statinfo';
public $table_cost = 'wx_school_cost';
public $table_object = 'wx_school_object';
public $table_signup = 'wx_school_signup';
public $table_record = 'wx_school_record';
public $table_checkmac = 'wx_school_checkmac';
public $table_checklog = 'wx_school_checklog';
public $table_idcard = 'wx_school_idcard';
public $table_icon = 'wx_school_icon';
public $table_timetable = 'wx_school_timetable';
public $table_zjh = 'wx_school_zjh';
public $table_zjhset = 'wx_school_zjhset';
public $table_zjhdetail = 'wx_school_zjhdetail';
public $table_scset = 'wx_school_shouceset';
public $table_scicon = 'wx_school_shouceseticon';
public $table_sc = 'wx_school_shouce';
public $table_scpy = 'wx_school_shoucepyk';
public $table_scforxs = 'wx_school_scforxs';
public $table_allcamera = 'wx_school_allcamera';
public $table_camerapl = 'wx_school_camerapl';
public $table_class = 'wx_school_user_class';
public $table_online = 'wx_school_online';
public $table_questions = 'wx_school_questions';
public $table_answers = 'wx_school_answers';
public $table_ans_remark = 'wx_school_ans_remark';	
public $table_gongkaike = 'wx_school_gongkaike';
public $table_gkkpjk = 'wx_school_gkkpjk';
public $table_gkkpj = 'wx_school_gkkpj';
public $table_gkkpjbz = 'wx_school_gkkpjbz';
public $table_groupactivity = 'wx_school_groupactivity';
public $table_groupsign = 'wx_school_groupsign';
public $table_todo = 'wx_school_todo';
public $table_camerask = 'wx_school_camerask';
public $table_courseorder = 'wx_school_courseorder';
public $table_cyybeizhu_teacher = 'wx_school_cyybeizhu_teacher';
public $table_coursebuy = 'wx_school_coursebuy';
public $table_kcsign = 'wx_school_kcsign';
public $table_tempstudent = 'wx_school_tempstudent';
public $table_fzqx = 'wx_school_fzqx';
public $table_kcpingjia = 'wx_school_kcpingjia';
public $table_chongzhi = 'wx_school_chongzhi';
public $table_checkdateset = 'wx_school_checkdateset';
public $table_checkdatedetail = 'wx_school_checkdatedetail';
public $table_checktimeset = 'wx_school_checktimeset';
public $table_apartment = 'wx_school_apartment';
public $table_aproom = 'wx_school_aproom';
public $table_booksborrow = 'wx_school_booksborrow';
public $table_help = 'wx_school_helps';
public $table_printer = 'wx_school_printer';
public $table_print_log = 'wx_school_print_log';
public $table_printset = 'wx_school_printset';
public $table_teascore = 'wx_school_teascore';
public $table_lanset = 'wx_school_language';
public $table_buzhulog = 'wx_school_buzhulog';
public $table_yuecostlog = 'wx_school_yuecostlog';
public $table_upsence = 'wx_school_upsence';
public $table_teasencefiles = 'wx_school_teasencefiles';
public $table_visitors = 'wx_school_visitors';
}