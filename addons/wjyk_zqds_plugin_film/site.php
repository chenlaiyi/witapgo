<?php
defined('IN_IA') or exit('Access Denied');
class Wjyk_zqds_plugin_filmModuleSite extends WeModuleSite
{    public function doWebFilm() {        global $_GPC, $_W;        pdo_update("wjyk_zqds_plugin",array(            'is_open'=> 2
        ),array(            'identifie'=>'wjyk_zqds_plugin_film'
        ));        message("插件安装成功");    }
}