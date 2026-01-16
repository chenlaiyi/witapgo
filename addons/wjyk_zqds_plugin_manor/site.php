<?php
defined('IN_IA') or exit('Access Denied');
class Wjyk_zqds_plugin_manorModuleSite extends WeModuleSite
{    public function doWebManor() {        global $_GPC, $_W;        pdo_update("wjyk_zqds_plugin",array(            'is_open'=> 2
        ),array(            'identifie'=>'wjyk_zqds_plugin_manor'
        ));        message("插件安装成功");    }
}