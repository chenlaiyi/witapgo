<?php
/*
 * @Discription: mobile/student router file
 * @Author: Hannibal·Lee
 * @Date: 2021-01-04 12:06:50
 * @LastEditTime: 2021-02-01 11:23:11
 */

defined('IN_IA') or exit('Access Denied');
require 'common.php';

class MobileStudent extends MobileCommon
{
    private function getLogicms($_name, $auth = true, $extraPath = '')
    {
        mload()->model('read');
        $unread = check_unread($_SESSION['user']);
        session_start();
        $extraPath = 'student/'.$extraPath;
        $this->getLogicRoot($_name, 'mobile', $auth, $extraPath);
    }


    public function doMobileMobile_s(){
        global $_GPC,$_W;
        $route = explode(".",$_GPC['r']);
        $fileName = "doMobile".implode("/",$route);
        $this->getLogicms($fileName);
    }

    /********keep_yiheedu()******/
    public function doMobileSpromote() {
        $this->getLogicms ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileSpromoteInfo() {
        $this->getLogicms ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileSpromoteInfo_log() {
        $this->getLogicms ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileSscore_Center() {
        $this->getLogicms ( __FUNCTION__, true , 'yiheedu/');
    }
    /********keep_yiheedu()******/
    
}
