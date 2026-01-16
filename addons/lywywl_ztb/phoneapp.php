<?php
/**
 * lywywl_ztb模块APP接口定义
 *
 * @author 维奕网络
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztbModulePhoneapp extends WeModulePhoneapp {
	public function doPageTest(){
		global $_GPC, $_W;
		$errno = 0;
		$message = '返回消息';
		$data = array();
		return $this->result($errno, $message, $data);
	}
}