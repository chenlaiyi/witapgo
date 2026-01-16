<?php
/**
 * tapgoTT模块定义
 *
 * @author TapGoTT
 * @url http://www.tapgo.cn/
 */
defined('IN_IA') or exit('Access Denied');

// 修改为正确的版本文件路径
require_once __DIR__ . '/version.php';

class TapgottModule extends WeModule {

    public function welcomeDisplay() {
        header('location: ' . $this->createWebUrl('shop'));
        exit;
    }
    
    public function settingsDisplay($settings) {
        global $_W, $_GPC;
        
        if ($_W['ispost']) {
            $data = array();
            $this->saveSettings($data);
            message('保存成功!', 'refresh');
        }
        
        include $this->template('setting');
    }

}


?>