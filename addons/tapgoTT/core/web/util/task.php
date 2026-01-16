<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Task_TapgoTtPage extends WebPage
{
	public function main()
	{
		$this->runTasks();
	}
}

?>
