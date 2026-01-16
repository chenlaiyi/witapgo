<?php
/**
 * lywywl_ztb_plugin_texttoaudio模块定义
 *
 * @author 壹锋源码
 @url https://www.yfphp.cn
 */
defined('IN_IA') or exit('Access Denied');

class lywywl_ztb_plugin_texttoaudioModule extends WeModule {

    public function welcomeDisplay()
    {
        header('location: ' . url('site/entry/plugins_owner', array('m' => 'lywywl_ztb')));
        exit();
    }
}