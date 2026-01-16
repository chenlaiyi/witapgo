<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
require TAPGO_TT_PLUGIN . 'merch/core/inc/page_merch.php';
class Index_TapgoTtPage extends MerchWebPage 
{
	public function main() 
	{
		global $_W;
		$this->model->CheckPlugin('creditshop');
		if (mcv('creditshop')) 
		{
			header('location: ' . webUrl('creditshop/goods'));
		}
		include $this->template('creditshop/goods');
	}
}
?>