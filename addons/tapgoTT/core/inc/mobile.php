<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class TapgoTTMobilePage extends Page {
    public function __construct() {
        global $_W;
        
        m('system')->checkUpdate();
        
        $preview = intval($_GPC['preview']);
        $wap = m('common')->getSysset('wap');
        
        if (!empty($wap['open']) && !is_weixin() && empty($preview)) {
            if ($this instanceof MobileLoginPage || $this instanceof PluginMobileLoginPage) {
                if (empty($_W['openid'])) {
                    $_W['openid'] = m('account')->checkLogin();
                }
            } else {
                $_W['openid'] = m('account')->checkOpenid();
            }
        } else {
            if ($preview) {
                $_W['openid'] = "oWmnN4xxxxxxxxxxx";
            }
        }
        
        $member = m('member')->checkMember();
        $_W['mid'] = !empty($member) ? $member['id'] : '';
        $_W['mopenid'] = !empty($member) ? $member['openid'] : '';
        
        $this->model = m('plugin')->loadModel($GLOBALS['_W']['plugin']);
        $this->set = $this->model->getSet();
        
        $this->init();
    }
    
    protected function init() {
        // 子类可以重写此方法
    }
} 