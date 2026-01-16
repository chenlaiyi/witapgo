<?php
/**
 * 微教育小程序模块微站定义
 *
 * @author 微美科技
 * @url 
 */
defined('IN_IA') or exit('Access Denied');
require  'inc/func/core.php';
include 'model.php';
class Fm_jiaoyuwxappModuleSite extends Core {
		
	private function getLogic($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		if ($type == 'web') {
			checkLogin ();  //检查登陆
			include_once 'inc/web/' . strtolower ( substr ( $_name, 5 ) ) . '.php';
		} else if ($type == 'mobile') {
			include_once 'inc/mobile/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
		} else if ($type == 'func') {
			include_once 'inc/func/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
		}
	}	

	private function getLogicmc($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		if ($type == 'mobile') {
			include_once 'inc/mobile/common/' . strtolower ( substr ( $_name, 8 ) ) . '.php';	
		}
	}
	
	public function doMobileGuid() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doWebBasics() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebStartpage() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebIndexajax() {
		include_once 'inc/web/indexajax.php';
	}	

	public function doMobileIndexajax() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}	
}