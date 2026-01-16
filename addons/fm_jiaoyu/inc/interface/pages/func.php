<?php
/*
 * @Discription: func  router file , not used yet
 * @Author: Hannibal·Lee
 * @Date: 2021-01-04 15:11:23
 * @LastEditTime: 2021-01-05 14:49:21
 */
defined('IN_IA') or exit('Access Denied');
require 'mobile/teacher.php';


class FuncPage extends MobileTeacher
{
    private function getLogicf($_name, $auth = false, $extraPath = '')
    {
      $this->getLogicRoot($_name, 'func', $auth, $extraPath);
    }

    
}
