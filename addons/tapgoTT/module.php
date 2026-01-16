<?php
/**
 * tapgoTT模块定义
 *
 * @author TapGoTT
 * @url http://www.tapgo.cn/
 */
defined('IN_IA') or exit('Access Denied');

// 修改引入路径，使用当前目录
require_once __DIR__ . '/version.php';
require_once __DIR__ . '/defines.php';
require_once __DIR__ . '/core/inc/functions.php';

class Tapgo_ttModule extends WeModule {
    public function welcomeDisplay() {
        header('location: ' . webUrl());
        exit();
    }
}


?>