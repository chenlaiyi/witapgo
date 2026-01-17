<?php
/**
 * [TapGo E-commerce] 点点商城 - 站点管理
 * Copyright (c) 2025 TapGo Team
 * Independent E-commerce Platform
 * @website https://w.itapgo.com
 */
/*TapGo 独立版本 - 请勿非法传播*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}
if (!function_exists('getIsSecureConnection')) {
    function getIsSecureConnection()
    {
        if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
            return true;
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        }
        return false;
    }
}
if (function_exists('getIsSecureConnection'))
{
    $secure = getIsSecureConnection();
    $http = $secure ? 'https' : 'http';
    $_W['siteroot'] = strexists($_W['siteroot'],'https://') ? $_W['siteroot'] : str_replace('http',$http,$_W['siteroot']);
}
require_once IA_ROOT . '/addons/ewei_shopv2/version.php';
require_once IA_ROOT . '/addons/ewei_shopv2/defines.php';
require_once EWEI_SHOPV2_INC . 'functions.php';
class Ewei_shopv2ModuleSite extends WeModuleSite {

	public function getMenus(){
		global $_W;
		return array(
