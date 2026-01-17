<?php
/**
 * [TapGo E-commerce System] Copyright (c) 2025 TapGo Team
 * Independent E-commerce Platform
 * @website https://w.itapgo.com
 */
defined('IN_IA') or exit('Access Denied');
load()->model('miniapp');

$dos = array('version_display');
$do = in_array($do, $dos) ? $do : 'version_display';

if ($do == 'version_display') {
	$version_list = miniapp_version_all($_W['uniacid']);
	template('miniapp/version-display');
}