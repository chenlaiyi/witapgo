<?php
defined('IN_IA') or exit('Access Denied');

class TapgottModuleSite extends WeModuleSite {
    public function __construct() {
        global $_W;
        include_once(IA_ROOT . '/addons/tapgoTT/core/model/TapgoTT.php');
        $this->model = new TapgoTTModel();
    }

    public function doWebShop() {
        global $_W, $_GPC;
        include $this->template('shop/index');
    }

    public function doWebSetting() {
        global $_W, $_GPC;
        
        if ($_W['ispost']) {
            $data = array(
                'shop' => array(
                    'name' => trim($_GPC['shop_name']),
                    'logo' => trim($_GPC['shop_logo']),
                    'desc' => trim($_GPC['shop_desc'])
                )
            );
            $this->model->setConfig('shop', $data);
            message('保存成功!', $this->createWebUrl('setting'), 'success');
        }
        
        $settings = $this->model->getConfig('shop');
        include $this->template('shop/setting');
    }

    public function doMobileIndex() {
        global $_W, $_GPC;
        include $this->template('mobile/index');
    }

    public function doMobileMember() {
        global $_W, $_GPC;
        
        $member = $this->model->getUser($_W['openid']);
        include $this->template('mobile/member');
    }

    public function doMobileGoods() {
        global $_W, $_GPC;
        
        $page = max(1, intval($_GPC['page']));
        $pagesize = 10;
        
        $list = $this->model->getGoodsList(array(), $page, $pagesize);
        include $this->template('mobile/goods');
    }

    public function doMobileCart() {
        global $_W, $_GPC;
        include $this->template('mobile/cart');
    }

    public function doMobileOrder() {
        global $_W, $_GPC;
        include $this->template('mobile/order');
    }

    public function doMobileAjaxAddCart() {
        global $_W, $_GPC;
        
        $goodsid = intval($_GPC['goodsid']);
        $total = max(1, intval($_GPC['total']));
        
        $result = $this->model->addToCart($_W['member']['uid'], $goodsid, $total);
        show_json(1, '添加成功');
    }

    public function doMobileAjaxCreateOrder() {
        global $_W, $_GPC;
        
        $addressid = intval($_GPC['addressid']);
        $goods = $_GPC['goods'];
        
        $orderid = $this->model->createOrder($_W['member']['uid'], $goods['total']);
        show_json(1, array('orderid' => $orderid));
    }
}