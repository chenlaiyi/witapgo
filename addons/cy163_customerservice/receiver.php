<?php
// Simple receiver to satisfy module checker and allow future event handling
defined('IN_IA') or exit('Access Denied');
class Cy163_customerserviceModuleReceiver extends WeModuleReceiver {
    public function receive() {
        // 当前模块未使用被动消息，这里留空即可
        return true;
    }
}
