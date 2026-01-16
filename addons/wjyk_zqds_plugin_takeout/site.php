<?php
defined('IN_IA') or exit('Access Denied');
class Wjyk_zqds_plugin_takeoutModuleSite extends WeModuleSite
{    public function doWebTakeout() {        global $_GPC, $_W;        pdo_update("wjyk_zqds_plugin",array(            'is_open'=> 2
        ),array(            'identifie'=>'wjyk_zqds_plugin_takeout'
        ));        message("插件安装成功");    }
}