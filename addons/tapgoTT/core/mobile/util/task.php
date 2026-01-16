<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Task_TapgoTtPage extends MobilePage
{
	public function main()
	{
		$this->runTasks();
	}
}

?>
