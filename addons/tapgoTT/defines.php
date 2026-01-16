<?php
if (!(defined('IN_IA'))) {
	exit('Access Denied');
}


define('TAPGO_TT_DEBUG', false);
!(defined('TAPGO_TT_PATH')) && define('TAPGO_TT_PATH', IA_ROOT . '/addons/tapgoTT/');
!(defined('TAPGO_TT_CORE')) && define('TAPGO_TT_CORE', TAPGO_TT_PATH . 'core/');
!(defined('TAPGO_TT_DATA')) && define('TAPGO_TT_DATA', TAPGO_TT_PATH . 'data/');
!(defined('TAPGO_TT_VENDOR')) && define('TAPGO_TT_VENDOR', TAPGO_TT_PATH . 'vendor/');
!(defined('TAPGO_TT_CORE_WEB')) && define('TAPGO_TT_CORE_WEB', TAPGO_TT_CORE . 'web/');
!(defined('TAPGO_TT_CORE_MOBILE')) && define('TAPGO_TT_CORE_MOBILE', TAPGO_TT_CORE . 'mobile/');
!(defined('TAPGO_TT_CORE_SYSTEM')) && define('TAPGO_TT_CORE_SYSTEM', TAPGO_TT_CORE . 'system/');
!(defined('TAPGO_TT_PLUGIN')) && define('TAPGO_TT_PLUGIN', TAPGO_TT_PATH . 'plugin/');
!(defined('TAPGO_TT_PROCESSOR')) && define('TAPGO_TT_PROCESSOR', TAPGO_TT_CORE . 'processor/');
!(defined('TAPGO_TT_INC')) && define('TAPGO_TT_INC', TAPGO_TT_CORE . 'inc/');
!(defined('TAPGO_TT_URL')) && define('TAPGO_TT_URL', $_W['siteroot'] . 'addons/tapgoTT/');
!(defined('TAPGO_TT_TASK_URL')) && define('TAPGO_TT_TASK_URL', $_W['siteroot'] . 'addons/tapgoTT/core/task/');
!(defined('TAPGO_TT_LOCAL')) && define('TAPGO_TT_LOCAL', '../addons/tapgoTT/');
!(defined('TAPGO_TT_STATIC')) && define('TAPGO_TT_STATIC', TAPGO_TT_URL . 'static/');
!(defined('TAPGO_TT_PREFIX')) && define('TAPGO_TT_PREFIX', 'tapgo_tt_');
define("TAPGO_TT_AUTH_WXAPP","http://www.tapgo.cn/");
define('TAPGO_TT_PLACEHOLDER', '../addons/tapgoTT/static/images/placeholder.png');

?>