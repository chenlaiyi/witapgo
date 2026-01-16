<?php
error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/tapgo_ttv2/defines.php';
require '../../../../../addons/tapgo_ttv2/core/inc/functions.php';
global $_W;
global $_GPC;
ignore_user_abort();
set_time_limit(0);
plugin_run('seckill::deleteSeckill');

?>
