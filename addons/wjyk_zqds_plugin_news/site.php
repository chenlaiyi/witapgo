<?php
defined('IN_IA') or exit('Access Denied');
class Wjyk_zqds_plugin_newsModuleSite extends WeModuleSite
{    public function doWebNews() {        global $_GPC, $_W;        pdo_update("wjyk_zqds_plugin",array(            'is_open'=> 2
        ),array(            'identifie'=>'wjyk_zqds_plugin_news'
        ));        message("插件安装成功");    }
}