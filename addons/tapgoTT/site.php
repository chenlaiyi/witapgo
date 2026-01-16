<?php
defined('IN_IA') or exit('Access Denied');

require_once IA_ROOT . '/addons/tapgoTT/defines.php';
require_once TAPGO_TT_INC . 'functions.php';
require_once TAPGO_TT_INC . 'processor.php';
require_once TAPGO_TT_INC . 'mobile.php';
require_once TAPGO_TT_INC . 'core.php';

class Tapgo_ttModuleSite extends WeModuleSite {
	public function __construct() {
		global $_W;
		
		$this->modulename = 'tapgo_tt';
		$this->moduleversion = '1.0';
		$this->modules = m('common')->getModules();
	}

	public function doMobilePage() {
		global $_W, $_GPC;
		m('route')->run();
	}

	public function doWebPage() {
		global $_W, $_GPC;
		m('route')->run(true);
	}

	public function payResult($params) {
		return m('order')->payResult($params);
	}

	public function getMenus() {
		global $_W;
		return array(
			array(
				'title' => '管理后台',
				'icon' => 'fa fa-shopping-cart',
				'url' => webUrl()
			)
		);
	}
}