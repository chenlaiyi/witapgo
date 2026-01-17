<?php
/*TapGo 独立版本 - 请勿非法传播*/
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage {

    public function main() {
        global $_W;

        include $this->template();
    }

}
