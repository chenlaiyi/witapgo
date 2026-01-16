<?php
/**
 * lywywl_ztb支付宝小程序接口定义
 *
 * @author 维奕网络
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztbModuleAliapp extends WeModuleAliapp {
	public function doPageTest(){
		global $_GPC, $_W;
		// 此处开发者自行处理
		include $this->template('test');
	}
}