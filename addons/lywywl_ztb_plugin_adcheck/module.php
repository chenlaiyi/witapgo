<?php
/**
 * lywywl_ztb_plugin_adcheck模块定义
 *
 * @author 维奕网络
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class lywywl_ztb_plugin_adcheckModule extends WeModule {

    public function welcomeDisplay()
    {
        header('location: ' . url('site/entry/plugins_owner', array('m' => 'lywywl_ztb')));
        exit();
    }
}