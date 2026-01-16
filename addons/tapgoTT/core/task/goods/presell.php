<?php
error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/tapgo_ttv2/defines.php';
require '../../../../../addons/tapgo_ttv2/core/inc/functions.php';
global $_W;
global $_GPC;
ignore_user_abort();
set_time_limit(0);
$sets = pdo_fetchall('select uniacid from ' . tablename('tapgo_tt_sysset'));
foreach ($sets as $set ) 
{
	$_W['uniacid'] = $set['uniacid'];
	if (empty($_W['uniacid'])) 
	{
		continue;
	}
	$trade = m('common')->getSysset('trade', $_W['uniacid']);
	$goods = pdo_fetchall('select id,preselltimeend,presellover,ispresell from ' . tablename('tapgo_tt_goods') . ' where uniacid = ' . $_W['uniacid'] . ' and ispresell > 0 and deleted = 0 ');
	foreach ($goods as $key => $value ) 
	{
		if (($value['ispresell'] == 1) && ($value['presellover'] == 0) && ($value['preselltimeend'] < time())) 
		{
			$value['status'] = 0;
			pdo_update('tapgo_tt_goods', array('status' => $value['status']), array('id' => $value['id']));
		}
	}
}
?>