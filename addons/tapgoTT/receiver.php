<?php
if (!(defined('IN_IA'))) {
	exit('Access Denied');
}


require_once IA_ROOT . '/addons/tapgo_ttv2/version.php';
require_once IA_ROOT . '/addons/tapgo_ttv2/defines.php';
require_once TAPGO_TT_INC . 'functions.php';
require_once TAPGO_TT_INC . 'receiver.php';
class TapgottModuleReceiver extends Receiver
{
	public function receive()
	{
		parent::receive();
	}
}


?>