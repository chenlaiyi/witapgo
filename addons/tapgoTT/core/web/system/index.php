<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_TapgoTtPage extends SystemPage
{
	public function main()
	{
		header('Location:' . webUrl('system/plugin'));
		exit();
		include $this->template();
	}
}

?>
