<?php
/*
 * @Discription:  mobile/cmomon  router file
 * @Author: Hannibal·Lee
 * @Date: 2021-01-04 15:31:06
 * @LastEditTime: 2021-01-07 10:06:00
 */


defined('IN_IA') or exit('Access Denied');
require 'root.php';

class MobileCommon extends MobilePage
{
    private function getLogicmc($_name, $auth = false, $extraPath = '')
    {
        mload()->model('read');
        $unread = check_unread($_SESSION['user']);
        session_start();
        $extraPath = 'common/'.$extraPath;
        $this->getLogicRoot($_name, 'mobile', $auth, $extraPath);
    }

    public function doMobileYiheedu_form()
    {
        $this->getLogicmc(__FUNCTION__, true);
    }
    public function doMobileYiheedu_withdraw()
    {
        $this->getLogicmc(__FUNCTION__, true);
    }
}
