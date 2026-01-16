<?php
/*
 * @Discription:  page router core
 * @Author: Hannibal·Lee
 * @Date: 2021-01-04 15:07:07
 * @LastEditTime: 2021-01-25 17:21:45
 */

defined('IN_IA') or exit('Access Denied');
$PathRoot = dirname(dirname(dirname(__FILE__))); //指向INC文件夹
 include_once  $PathRoot.'/func/core.php';


if (is_file($PathRoot.'/interface/extra/independent.func.php')) {
    include_once $PathRoot.'/interface/extra/independent.func.php';
}

class PageCore extends Core
{
    public function getLogicRoot($_name, $type = "web", $auth = false, $extraPath = '')
    {
        global $_W, $_GPC;
        $RootPath = dirname(dirname(dirname(__FILE__))); //当前文件所处的目录 指向INC文件夹
        $fileName = strtolower(substr($_name, 8)); //默认截8位，web单独判断
        if ($type == 'web') {
            include_once $RootPath.'/func/list.php';
            checkLogin();  //检查登陆
            if ($_GPC['schoolid']) {
                get_language($_GPC['schoolid']);
                $language = $_W['lanconfig'][$_GPC['do']];
            }
            $fileName = strtolower(substr($_name, 5));
        } elseif ($type == 'mobile') {
            get_language($_GPC['schoolid']);
            $language = $_W['lanconfig'][$_GPC['do']];
            if ($auth) {
                include_once $RootPath.'/func/isauth.php';
            }
        }
        $verPath = '';
        if (is_file($RootPath.'/interface/extra/version.config.php')) {
            include_once $RootPath.'/interface/extra/version.config.php';
        }
        if (!is_file("{$RootPath}/{$verPath}{$type}/{$extraPath}{$fileName}.php")) {
            $verPath = '';
        }
        include_once "{$RootPath}/{$verPath}{$type}/{$extraPath}{$fileName}.php";
    }
}
