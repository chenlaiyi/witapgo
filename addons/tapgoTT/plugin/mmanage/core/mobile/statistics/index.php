<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

require TAPGO_TT_PLUGIN . 'mmanage/core/inc/page_mmanage.php';
class Index_TapgoTtPage extends MmanageMobilePage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		include $this->template();
	}
}

?>
