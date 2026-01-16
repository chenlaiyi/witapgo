<?php
if (!(defined('IN_IA'))) {
	exit('Access Denied');
}


require_once IA_ROOT . '/addons/tapgo_ttv2/version.php';
require_once IA_ROOT . '/addons/tapgo_ttv2/defines.php';
require_once TAPGO_TT_INC . 'functions.php';
require_once TAPGO_TT_INC . 'processor.php';
require_once TAPGO_TT_INC . 'plugin_model.php';
require_once TAPGO_TT_INC . 'com_model.php';
class TapgottModuleProcessor extends Processor
{
	public function respond()
	{
		return parent::respond();
	}
}


?>