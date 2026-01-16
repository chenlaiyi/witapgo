<?php
/**
 * lywywl_ztb模块定义
 *
 * @author 维奕网络
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztbModule extends WeModule {

	public function welcomeDisplay()
	{
		header('location: ' . url('site/entry/home', array('m' => 'lywywl_ztb')));
		exit();
	}
}