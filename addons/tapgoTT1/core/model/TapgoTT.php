<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class TapgoTTModel extends WeModuleSite {
    
    /**
     * 获取配置
     */
    public function getConfig($key, $uniacid = 0) {
        global $_W;
        $uniacid = $uniacid ? $uniacid : $_W['uniacid'];
        
        return pdo_get('tapgo_tt_config', array(
            'uniacid' => $uniacid,
            'key' => $key
        ));
    }
    
    /**
     * 设置配置
     */
    public function setConfig($key, $value, $uniacid = 0) {
        global $_W;
        $uniacid = $uniacid ? $uniacid : $_W['uniacid'];
        
        $data = array(
            'uniacid' => $uniacid,
            'key' => $key,
            'value' => $value
        );
        
        $exist = $this->getConfig($key, $uniacid);
        if ($exist) {
            return pdo_update('tapgo_tt_config', $data, array('id' => $exist['id']));
        }
        return pdo_insert('tapgo_tt_config', $data);
    }
    
    /**
     * 创建订单
     */
    public function createOrder($userId, $amount) {
        global $_W;
        
        $data = array(
            'uniacid' => $_W['uniacid'],
            'order_no' => $this->generateOrderNo(),
            'user_id' => $userId,
            'amount' => $amount,
            'status' => 0
        );
        
        pdo_insert('tapgo_tt_orders', $data);
        return pdo_insertid();
    }
    
    /**
     * 生成订单号
     */
    private function generateOrderNo() {
        return date('YmdHis') . rand(1000, 9999);
    }
    
    /**
     * 获取用户信息
     */
    public function getUser($openid) {
        global $_W;
        return pdo_get('tapgo_tt_users', array(
            'uniacid' => $_W['uniacid'],
            'openid' => $openid
        ));
    }
    
    /**
     * 获取商品列表
     */
    public function getGoodsList($where = array(), $page = 1, $pageSize = 10) {
        global $_W;
        $where['uniacid'] = $_W['uniacid'];
        
        $total = pdo_count('tapgo_tt_goods', $where);
        $list = pdo_getslice('tapgo_tt_goods', $where, array($page, $pageSize), $total);
        
        return array(
            'total' => $total,
            'list' => $list
        );
    }
    
    /**
     * 添加购物车
     */
    public function addToCart($userId, $goodsId, $quantity = 1) {
        global $_W;
        
        $exist = pdo_get('tapgo_tt_cart', array(
            'uniacid' => $_W['uniacid'],
            'user_id' => $userId,
            'goods_id' => $goodsId
        ));
        
        if ($exist) {
            return pdo_update('tapgo_tt_cart', array(
                'quantity' => $exist['quantity'] + $quantity,
                'updated_at' => date('Y-m-d H:i:s')
            ), array('id' => $exist['id']));
        }
        
        return pdo_insert('tapgo_tt_cart', array(
            'uniacid' => $_W['uniacid'],
            'user_id' => $userId,
            'goods_id' => $goodsId,
            'quantity' => $quantity
        ));
    }
    
    /**
     * 获取用户优惠券
     */
    public function getUserCoupons($userId, $status = 0) {
        global $_W;
        return pdo_getall('tapgo_tt_user_coupon', array(
            'uniacid' => $_W['uniacid'],
            'user_id' => $userId,
            'status' => $status
        ));
    }
    
    /**
     * 创建退款订单
     */
    public function createRefund($orderId, $userId, $amount, $reason) {
        global $_W;
        
        $data = array(
            'uniacid' => $_W['uniacid'],
            'order_id' => $orderId,
            'user_id' => $userId,
            'refund_no' => 'RF' . date('YmdHis') . rand(1000, 9999),
            'amount' => $amount,
            'reason' => $reason,
            'status' => 0
        );
        
        pdo_insert('tapgo_tt_refund', $data);
        return pdo_insertid();
    }
    
    /**
     * 获取会员等级
     */
    public function getMemberLevel($userId) {
        global $_W;
        $user = $this->getUser($userId);
        if (!$user) return false;
        
        return pdo_get('tapgo_tt_member_level', array(
            'uniacid' => $_W['uniacid'],
            'level' => $user['level']
        ));
    }
    
    /**
     * 更新用户积分
     */
    public function updateCredit($userId, $num, $remark = '') {
        global $_W;
        
        $user = $this->getUser($userId);
        if (!$user) return false;
        
        // 记录积分变动
        $log = array(
            'uniacid' => $_W['uniacid'],
            'user_id' => $userId,
            'num' => $num,
            'operator' => 'system',
            'module' => 'credit',
            'remark' => $remark
        );
        
        pdo_insert('tapgo_tt_credit_log', $log);
        
        // 更新用户积分
        return pdo_update('tapgo_tt_users', array(
            'credit' => $user['credit'] + $num
        ), array('id' => $userId));
    }
    
    /**
     * 创建分销商
     */
    public function createDistributor($userId, $parentId = 0) {
        global $_W;
        
        $exist = pdo_get('tapgo_tt_distributor', array(
            'uniacid' => $_W['uniacid'],
            'user_id' => $userId
        ));
        
        if ($exist) return false;
        
        $data = array(
            'uniacid' => $_W['uniacid'],
            'user_id' => $userId,
            'parent_id' => $parentId,
            'level' => 1,
            'status' => 1
        );
        
        pdo_insert('tapgo_tt_distributor', $data);
        return pdo_insertid();
    }
    
    /**
     * 计算分销佣金
     */
    public function calculateCommission($orderId) {
        global $_W;
        
        $order = pdo_get('tapgo_tt_orders', array(
            'id' => $orderId,
            'uniacid' => $_W['uniacid']
        ));
        
        if (!$order) return false;
        
        $buyer = $this->getUser($order['user_id']);
        if (!$buyer) return false;
        
        // 获取分销关系链
        $distributor = pdo_get('tapgo_tt_distributor', array(
            'user_id' => $buyer['id'],
            'uniacid' => $_W['uniacid']
        ));
        
        if (!$distributor || !$distributor['parent_id']) return false;
        
        // 获取分销商等级及佣金比例
        $level = pdo_get('tapgo_tt_distributor_level', array(
            'uniacid' => $_W['uniacid'],
            'level' => $distributor['level']
        ));
        
        if (!$level) return false;
        
        // 计算佣金
        $commission = $order['amount'] * ($level['commission_rate1'] / 100);
        
        // 记录分销订单
        $data = array(
            'uniacid' => $_W['uniacid'],
            'order_id' => $orderId,
            'user_id' => $buyer['id'],
            'distributor_id' => $distributor['parent_id'],
            'level' => 1,
            'commission' => $commission,
            'status' => 0
        );
        
        pdo_insert('tapgo_tt_distributor_order', $data);
        return true;
    }
} 