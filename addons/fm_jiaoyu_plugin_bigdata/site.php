<?php
/**
 * fm_jiaoyu_plugin_vis模块微站定义
 *
 * @author 微美科技
 * @author hannibal
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

include 'model.php';
class Fm_jiaoyu_plugin_bigdataModuleSite extends WeModuleSite {


    private function getLogic($_name, $type = "web", $auth = false) {
        global $_W, $_GPC;
        if ($type == 'web') {
            checkLogin ();  //检查登陆
            if($_GPC['schoolid']){

            }
            include_once 'inc/web/' . strtolower ( substr ( $_name, 5 ) ) . '.php';
        } else if ($type == 'mobile') {
            if ($auth) {
                include_once 'inc/func/isauth.php';
            }
           
            include_once 'inc/mobile/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
        } else if ($type == 'func') {
            include_once 'inc/func/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
        }
    }


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

    //==========================web==========================
    public function doWebSchoolbdset() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
    public function doWebBdindex() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    public function doWebBdactivity() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
    public function doWebBdpeople() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
    public function doWebBdcheck() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
    public function doWebBdmoney() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    public function doWebAllschool() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    //==========================mobile==========================
    public function doMobileBdindex() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileSchoolbdset() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileBdactivity() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileBdpeople() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileBdcheck() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileBdmoney() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileAllschool() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileLogin() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }
    public function doMobileLogin_all() {
        $this->getLogic ( __FUNCTION__, 'mobile' );
    }

}