<?php
/*
 * @Discription: mobile/teacher  router file
 * @Author: Hannibal·Lee
 * @Date: 2021-01-04 12:06:50
 * @LastEditTime: 2021-02-01 11:22:02
 */
defined('IN_IA') or exit('Access Denied');
require  'student.php';

class MobileTeacher extends MobileStudent
{
    private function getLogicmt($_name, $auth = false, $extraPath = '')
    {
        $extraPath = 'teacher/'.$extraPath;
        $this->getLogicRoot($_name, 'mobile', $auth, $extraPath);
    }

    public function doMobileMobile_t(){
        global $_GPC,$_W;
        $route = explode(".",$_GPC['r']);
        $fileName = "doMobile".implode("/",$route);
        $this->getLogicmt($fileName, true);
    }

    public function doMobileTestmlee()
    {
        $this->getLogicmt(__FUNCTION__, true, 'tests/');
    }

    public function doMobileStulist() {
		  $this->getLogicmt ( __FUNCTION__, true );
    }
    /*****keep_yiheedu****/
    //推广管理
    public function doMobileTpromote() {
      $this->getLogicmt ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileTpromoteInfo() {
      $this->getLogicmt ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileTpromoteInfo_log() {
      $this->getLogicmt ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileLevel_Center() {
      $this->getLogicmt ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileScore_Center() {
      $this->getLogicmt ( __FUNCTION__, true , 'yiheedu/');
    }
    public function doMobileMyFans() {
      $this->getLogicmt ( __FUNCTION__, true , 'yiheedu/');
    }
    /*****keep_yiheedu****/
}
