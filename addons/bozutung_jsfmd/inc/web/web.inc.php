<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

defined('IN_IA') or exit('Access Denied');

global $_GPC, $_W;
load()->func('tpl');

$sys_id = $_W['uniacid'];
$account = uni_fetch($sys_id);
$app_id = $account['key'];
// $secret = $account['secret'];
unset($account);
// $rst = cache_updatecache();


include $this->template('web/web');
