<?php
/**
 * lywywl_ztb_plugin_wholegroup模块定义
 *
 * @author 独家制作
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztb_plugin_wholegroup extends WeModule {

    public function welcomeDisplay()
    {
        header('location: ' . url('site/entry/plugins_owner', array('m' => 'lywywl_ztb')));
        exit();
    }
}