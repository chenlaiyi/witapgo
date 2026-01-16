<?php
/**
 * fm_jiaoyu_plugin_sale模块微站定义
 *
 * @author 微美科技
 * @url 
 */
defined('IN_IA') or exit('Access Denied');
class Fm_jiaoyu_plugin_saleModuleSite extends WeModuleSite {
	
	// ====================== func====================
	public function doMobileAuth() {
		include_once 'inc/func/auth.php';
	}
	public function doMobileIndexajax() {
		include_once 'inc/mobile/indexajax.php';
	}
	function createMobileUrls($do, $query = array(), $noredirect = true) {//返回主模块路径
		global $_W;
		$query['do'] = $do;
		$query['m'] = 'fm_jiaoyu';
		return murl('entry', $query, $noredirect);
	}
	
	function createWebUrls($do, $query = array()) {//返回主模块路径
		$query['do'] = $do;
		$query['m'] = 'fm_jiaoyu';
		return wurl('site/entry', $query);
	}
	
}