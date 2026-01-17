<?php
/**
 * [TapGo E-commerce] 点点商城 - 核心模块
 * Copyright (c) 2025 TapGo Team
 * Independent E-commerce Platform
 * @website https://w.itapgo.com
 */
if (!(defined('IN_IA'))) {
	exit('Access Denied');
}


require_once IA_ROOT . '/addons/ewei_shopv2/version.php';
require_once IA_ROOT . '/addons/ewei_shopv2/defines.php';
require_once EWEI_SHOPV2_INC . 'functions.php';
class Ewei_shopv2Module extends WeModule
{
	public function welcomeDisplay()
	{
		header('location: ' . webUrl());
		exit();
	}
}


?>
