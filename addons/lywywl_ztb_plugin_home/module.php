<?php
/**
 * lywywl_ztb_plugin_home模块定义
 *
 * @author 维奕网络
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztb_plugin_homeModule extends WeModule {

    public function welcomeDisplay()
    {
        header('location: ' . url('site/entry/plugins_owner', array('m' => 'lywywl_ztb')));
        exit();
    }
}