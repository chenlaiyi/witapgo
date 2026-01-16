<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or die('Access Denied');

require_once IA_ROOT . '/addons/bozutung_jsfmd/defines.php';
require_once SLWL_PATH . 'version.php';
require_once SLWL_INC . 'basic.inc.php';
require_once SLWL_INC . 'functions.inc.php';
require_once SLWL_INC . 'menus.inc.php';
class Bozutung_jsfmdModule extends WeModule
{
	public function welcomeDisplay()
	{
		header('location: ' . webUrl('web'));
		exit();
	}
}

