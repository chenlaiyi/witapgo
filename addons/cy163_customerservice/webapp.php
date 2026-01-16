<?php
/**
 * 聚合客服 webapp 入口文件
 * @author 爱云资源
 */
defined('IN_IA') or exit('Access Denied');

// 确保表名常量已定义，避免未定义导致 SQL 指向 ims_BEST_* 而报表不存在
if (!defined('BEST_CHAT')) {
	define('BEST_CHAT', 'messikefu_chat');            // 聊天表
	define('BEST_CSERVICE', 'messikefu_cservice');    // 客服表
	define('BEST_CSERVICEGROUP', 'messikefu_cservicegroup'); // 客服组
	define('BEST_BIAOQIAN', 'messikefu_biaoqian');    // 标签
	define('BEST_GROUP', 'messikefu_group');          // 群聊
	define('BEST_GROUPMEMBER', 'messikefu_groupmember'); // 群聊成员
	define('BEST_GROUPCONTENT', 'messikefu_groupchat');  // 群聊内容
	define('BEST_FANSKEFU', 'messikefu_fanskefu');    // 粉丝-客服关系
	define('BEST_ADV', 'messikefu_adv');              // 轮播
	define('BEST_SANFANSKEFU', 'messikefu_sanfanskefu'); // 第三方粉丝客服
	define('BEST_SANCHAT', 'messikefu_sanchat');      // 第三方聊天
	define('BEST_KEFUANDGROUP', 'messikefu_kefuandgroup');
	define('BEST_PINGJIA', 'messikefu_pingjia');
	define('BEST_WENZHANG', 'messikefu_wenzhang');
	define('BEST_ZHUIZONG', 'messikefu_zhuizong');
	define('BEST_LIUYAN', 'messikefu_liuyan');
	define('BEST_KUAIJIE', 'messikefu_kuaijie');
	define('BEST_LYFIELD', 'messikefu_lyfield');
	define('BEST_XCX', 'messikefu_xcx');
	define('BEST_XCXCSERVICE', 'messikefu_xcxcservice');
	define('BEST_XCXFANSKEFU', 'messikefu_xcxfanskefu');
	define('BEST_XCXCHAT', 'messikefu_xcxchat');
	define('BEST_XCXAUTO', 'messikefu_xcxauto');
}

class Cy163_customerserviceModuleWebapp extends WeModuleWebapp {

    public function doPageKefulogin() {
        global $_W, $_GPC;
        
        // 引入移动端客服登录页面
        include $this->module['path'] . 'inc/mobile/kefulogin.php';
    }
    
    public function doPageKefucenter() {
        global $_W, $_GPC;
        
        // 引入移动端客服中心页面
        include $this->module['path'] . 'inc/mobile/kefucenter.php';
    }
    
    public function doPageCustomerchat() {
        global $_W, $_GPC;
        
        // 引入移动端客户聊天页面
        include $this->module['path'] . 'inc/mobile/customerchat.php';
    }
    
    public function doPageQdadmin() {
        global $_W, $_GPC;
        
        // 引入移动端前端管理员页面
        include $this->module['path'] . '/inc/mobile/qdadmin.php';
    }
    
    public function doPageXcxqdadmin() {
        global $_W, $_GPC;
        
        // 引入移动端小程序前端管理员页面
        include $this->module['path'] . '/inc/mobile/xcxqdadmin.php';
    }
    
    public function doPageEchat() {
        global $_W, $_GPC;
        
        // 引入移动端聊天页面
        include $this->module['path'] . '/inc/mobile/echat.php';
    }
    
    public function doPageEservicechat() {
        global $_W, $_GPC;
        
        // 引入移动端客服聊天页面
        include $this->module['path'] . '/inc/mobile/eservicechat.php';
    }
    
    public function doPageSanchat() {
        global $_W, $_GPC;
        
        // 引入移动端三方聊天页面
        include $this->module['path'] . '/inc/mobile/sanchat.php';
    }
    
    public function doPageSearchkefus() {
        global $_W, $_GPC;
        
        // 引入移动端搜索客服页面
        include $this->module['path'] . '/inc/mobile/searchkefus.php';
    }
    
    public function doPageZhuizong() {
        global $_W, $_GPC;
        
        // 引入移动端追踪页面
        include $this->module['path'] . '/inc/mobile/zhuizong.php';
    }
    
    public function doPageDisanfang() {
        global $_W, $_GPC;
        
        // 引入移动端第三方页面
        include $this->module['path'] . '/inc/mobile/disanfang.php';
    }
}
