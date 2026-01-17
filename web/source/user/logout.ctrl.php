<?php
/**
 * [TapGo E-commerce System] Copyright (c) 2025 TapGo Team
 * Independent E-commerce Platform
 * @website https://w.itapgo.com
 */
defined('IN_IA') or exit('Access Denied');
isetcookie('__session', '', -10000);
isetcookie('__iscontroller', '', -10000);
isetcookie('__uniacid', '', -10000);
$forward = $_GPC['forward'];
if (empty($forward)) {
	$forward = $_W['siteroot'];
}

header('Location:' . $forward);