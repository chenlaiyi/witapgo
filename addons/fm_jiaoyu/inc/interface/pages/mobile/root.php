<?php
/*
 * @Discription:   mobile  router file
 * @Author: Hannibal·Lee
 * @Date: 2021-01-04 14:35:52
 * @LastEditTime: 2021-02-03 17:45:04
 */

defined('IN_IA') or exit('Access Denied');
$pathRoot = dirname(dirname(dirname(__FILE__))); //指向interface文件夹
require  $pathRoot.'/pages/pagecore.php';

class MobilePage extends PageCore
{
    private function getLogicm($_name, $auth = false, $extraPath = '')
    {
        $this->getLogicRoot($_name, 'mobile', $auth, $extraPath);
    }

    public function doMobileTestlee() {
		    $this->getLogicm ( __FUNCTION__, false,'tests/');
    }
    
    public function doMobileTestChieh() {
        $this->getLogicm ( __FUNCTION__, true,'tests/');
    }

    public function doMobileMobile(){
        global $_GPC,$_W;
        $route = explode(".",$_GPC['r']);
        $fileName = "doMobile".implode("/",$route);
        $this->getLogicm($fileName, 'mobile');
    }
}
