<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Index_TapgoTtPage extends PluginWebPage {
    function main() {
        header('location: '.webUrl('polyapi/set'));
    }




}