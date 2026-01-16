<?php
require '../../framework/bootstrap.inc.php';
require './inc/class/WxpayService.class.php';
require './inc/class/AllinpayService.class.php';
require './inc/function/functions.php';
require './inc/function/time.func.php';
include './inc/class/Hashids.class.php';
include './inc/function/packet.func.php';

header('Content-type:text/html; Charset=utf-8');

$input = file_get_contents('php://input');
$obj = isimplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);
$data = json_decode(json_encode($obj), true);

if (empty($data)) {
    $result = array(
        'return_code' => 'FAIL',
        'return_msg' => ''
    );
    echo array2xml($result);
    exit;
}
if ($data['return_code'] != 'SUCCESS') {
    $result = array(
        'return_code' => 'FAIL',
        'return_msg' => '回调失败'
    );
    echo array2xml($result);
    exit;
}

$wechat = pdo_fetch("SELECT * FROM " . tablename("account_wechats") . " WHERE `key`='" . $data['appid'] . "' ");
if (empty($wechat)) {
    $result = array(
        'return_code' => 'FAIL',
        'return_msg' => '未能找到相关公众号'
    );
    echo array2xml($result);
    exit;
}
$_W['uniacid'] = $wechat['uniacid'];
$module = pdo_get('uni_account_modules', array('module' => 'lywywl_ztb', 'uniacid' => $wechat['uniacid']));
if (empty($module)) {
    $result = array(
        'return_code' => 'FAIL',
        'return_msg' => '未能找到相关配置'
    );
    echo array2xml($result);
    exit;
}
$config = iunserializer($module['settings']);
$config = $config['ztb'];

//解密req_info  然后Tolist  md5商户支付密钥
$res = openssl_decrypt(base64_decode($data['req_info']), 'AES-256-ECB', md5($config['password']), OPENSSL_RAW_DATA, '');
$reg_info = json_decode(json_encode(simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
$paynumber = $reg_info['out_trade_no'];
$recharge = pdo_get('lywywl_ztb_sys_pay', array('deltime' => 0, 'paynumber' => $paynumber));

if (empty($recharge)) {
    if (!empty($_POST['cusorderid'])) {
        echo "error";
    } else {
        $result = array(
            'return_code' => 'FAIL',
            'return_msg' => ''
        );
        echo array2xml($result);
    }
    exit;
}

if ($recharge['types'] == 3) {
    //活动支付
    if (intval($recharge['status']) == 1) {
        $dataarr = explode(",", $recharge['data']);
        $token = $dataarr[0];
        $store_id = $recharge['store_id'];
        $uniacid = $recharge['uniacid'];

        //活动详情
        $activity = pdo_get(ztbNopreTable('obj_activity'), array('deltime' => 0, 'status' => 1, 'uniacid' => $recharge['uniacid'], 'store_id' => $store_id, 'token' => $token));
        if (!empty($activity)) {
            //红包拓客
            if ($activity['activity_types'] == 2) {
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];
                //溯源用户
                if (!empty($origin_id)) {
                    $originModel = pdo_get('lywywl_ztb_marketing_user', array('id' => $origin_id, 'activity_id' => $activity['id'], 'uniacid' => $uniacid));
                }
                $object = pdo_get(ztbNopreTable('obj_soliciting'), array('deltime' => 0, 'activity_id' => $activity['id']));
                //查询订单
                $user_doaw_model = pdo_get(ztbNopreTable('user_draw'), array('uniacid' => $recharge['uniacid'], 'store_id' => $store_id, 'activity_id' => $activity['id'], 'pay_number' => $paynumber, 'deltime' => 0));
                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {

                    #region 逻辑处理  更新退款表, 订单表, 溯源信息, 购买数量, 产品库存 ,溯源参与 , 缺少再补

                    //更新退款订单信息
                    pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));

                    //更新退款回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'deltime' => 0, 'status' => 0,));
                    pdo_update(ztbTable('user_reimburse', false), array('status' => 1, "veto_note" => "同意退款", 'updatetime' => time()), array('id' => $reimburseModel['id']));

                    //获取用户信息
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));

                    //更新活动购买数量
                    pdo_update(ztbTable('obj_activity', false), array('buy_num -=' => 1), array('id' => $activity['id']));

                    //更新产品库存
                    if ($object['is_open_stock'] == 1) {
                        pdo_update(ztbTable('obj_soliciting', false), array('stock +=' => 1,), array('id' => $object['id']));
                    }
                    //更新溯源参与
                    if (!empty($user_doaw_model['origin_id'])) {
                        pdo_update(ztbNopreTable('marketing_user'), array('marketing_num -=' => 1), array('id' => $origin_id));
                    }

                    //更改参与记录 退款申请状态 简略版
                    pdo_update(ztbNopreTable('obj_soliciting_join'),array('is_refund' => 2),array('openid' => $recharge['openid'],'activity_id' => $activity['id'],'uniacid' => $uniacid,'store_id' => $store_id));

                    #endregion

                    #region 财务操作

                    if (floatval($recharge['paymoney']) > 0) {
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $openid;
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] = $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $groupUserModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = TIMESTAMP;
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion 
                    
                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_soliciting_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_soliciting_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion

                }
            }

            //联盟拓客 
            if ($activity['activity_types'] == 3) {
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];
                //溯源用户
                if (!empty($origin_id)) {
                    $originModel = pdo_get('lywywl_ztb_marketing_user', array('id' => $origin_id, 'activity_id' => $activity['id'], 'uniacid' => $uniacid));
                }
                $object = pdo_get(ztbNopreTable('obj_union'), array('deltime' => 0, 'activity_id' => $activity['id']));
                //查询订单
                $user_doaw_model = pdo_get(ztbNopreTable('user_draw'), array('uniacid' => $recharge['uniacid'], 'store_id' => $store_id, 'activity_id' => $activity['id'], 'pay_number' => $paynumber, 'deltime' => 0));
                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {

                    #region 逻辑处理  更新退款表, 订单表, 溯源信息, 购买数量, 产品库存 ,溯源参与 , 缺少再补

                    //更新退款订单信息
                    pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));

                    //更新退款回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'deltime' => 0, 'status' => 0));
                    pdo_update(ztbTable('user_reimburse', false), array('status' => 1, "veto_note" => "同意退款", 'updatetime' => time()), array('id' => $reimburseModel['id']));

                    //获取用户信息
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));

                    //更新活动购买数量
                    pdo_update(ztbTable('obj_activity', false), array('buy_num -=' => 1), array('id' => $activity['id']));

                    //更新产品库存
                    if ($object['is_open_stock'] == 1) {
                        pdo_update(ztbTable('obj_union', false), array('stock +=' => 1,), array('id' => $object['id']));
                    }
                    //更新溯源参与
                    if (!empty($user_doaw_model['origin_id'])) {
                        pdo_update(ztbNopreTable('marketing_user'), array('marketing_num -=' => 1), array('id' => $origin_id));
                    }
                    //更改参与记录 退款申请状态 简略版
                    pdo_update(ztbNopreTable('obj_union_join'),array('is_refund' => 2),array('openid' => $recharge['openid'],'activity_id' => $activity['id'],'uniacid' => $uniacid,'store_id' => $store_id));

                    #endregion

                    #region 财务操作

                    if (floatval($recharge['paymoney']) > 0) {

                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $openid;
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] = $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $groupUserModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = TIMESTAMP;
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion 

                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_union_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_union_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion

                }
            }

            //助力砍价
            if ($activity['activity_types'] == 15) {

                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];
                //溯源用户
                if (!empty($origin_id)) {
                    $originModel = pdo_get('lywywl_ztb_marketing_user', array('id' => $origin_id, 'activity_id' => $activity['id'], 'uniacid' => $uniacid));
                }
                $object = pdo_get(ztbNopreTable('obj_cut'), array('deltime' => 0, 'activity_id' => $activity['id']));
                //查询订单 并且更改状态
                $user_doaw_model = pdo_get(ztbNopreTable('user_draw'), array('uniacid' => $recharge['uniacid'], 'store_id' => $store_id, 'activity_id' => $activity['id'], 'pay_number' => $paynumber, 'deltime' => 0));
                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {

                    #region 逻辑处理  
                    pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));
                    //更新退款订单回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'status' => 0, 'deltime' => 0));
                    //同意退款申请
                    pdo_update(ztbTable('user_reimburse', false), array('status' => 1, "veto_note" => "同意退款", 'updatetime' => time()), array('id' => $reimburseModel['id']));
                    //获取用户信息                                                                                                                
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));
                    //活动购买数量
                    pdo_update(ztbTable('obj_activity', false), array('buy_num -=' => 1), array('id' => $activity['id']));
                    //更新产品库存
                    if ($object['is_open_stock'] == 1) {
                        //更新产品库存
                        pdo_update(ztbTable('obj_cut', false), array('goods_num +=' => 1,), array('id' => $object['id']));
                    }
                    //更新溯源参与
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable('marketing_user'), array('marketing_num -=' => 1), array('id' => $origin_id));
                    }
                    //更改参与记录 退款申请状态 简略版
                    pdo_update(ztbNopreTable('obj_cut_join'),array('is_refund' => 2),array('openid' => $recharge['openid'],'activity_id' => $activity['id'],'uniacid' => $uniacid,'store_id' => $store_id));
                    #endregion 

                    #region 财务操作
                    if (floatval($recharge['paymoney']) > 0) {

                        //更新用户信息
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] =  $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = time();
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion

                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_cut_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_cut_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion

                }
            }
            //经典拼团 两个订单 
            if ($activity['activity_types'] == 16) {
                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];
                //溯源用户
                if (!empty($origin_id)) {
                    $originModel = pdo_get('lywywl_ztb_marketing_user', array('id' => $origin_id, 'activity_id' => $activity['id'], 'uniacid' => $uniacid));
                }
                $object = pdo_get(ztbNopreTable('obj_collage'), array('deltime' => 0, 'activity_id' => $activity['id']));

                //查询订单 并且更改状态
                $user_doaw_model = pdo_get(
                    ztbNopreTable('user_draw'),
                    array(
                        'uniacid' =>  $uniacid,
                        'store_id' => $store_id,
                        'activity_id' => $activity['id'],
                        'pay_number' => $paynumber,
                        'deltime' => 0,
                        'is_refund' => 1
                    )
                );

                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {
                    #region 逻辑处理

                    //退款订单回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'status' => 0, 'deltime' => 0));

                    //单独付款
                    if (explode(",", $recharge["data"])[3] == 1) {
                        //标记尾款退款
                        pdo_update(ztbNopreTable('user_reimburse'), array('is_balance_refund' => 1, 'is_deposit_refund' => 1, 'updatetime' => TIMESTAMP, 'status' => 1, 'veto_note' => "同意退款"), array('id' => $reimburseModel['id']));
                        //更改订单状态
                        pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $model['id']));
                    } else {
                        //标记尾款退款
                        pdo_update(ztbNopreTable('user_reimburse'), array('is_balance_refund' => 1,  "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                        if ($reimburseModel['is_deposit_refund'] == 1) {
                            //更改退款申请状态
                            pdo_update(ztbNopreTable('user_reimburse'), array('status' => 1, "veto_note" => "同意退款", "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                            //更改订单状态
                            pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));
                        }
                    }
                    //获取用户信息                                                                                                                
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));
                    #endregion 

                    #region 财务操作
                    if (floatval($recharge['paymoney']) > 0) {
                        //更新用户信息
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] = $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = time();
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion

                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_collage_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_collage_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion
                }
                //参与记录, 定金
                $groupUserJoin = pdo_get(ztbNopreTable('obj_collage_join'), array('uniacid' =>   $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'deltime' => 0, 'openid' => $recharge['openid']));

                if (!empty($groupUserJoin)  &&  $groupUserJoin['is_refund'] == 1) {
                    #region 逻辑处理

                    //获取退款信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'openid' => $recharge['openid'], 'deltime' => 0));

                    pdo_update(ztbTable('obj_collage_join', false), array('is_refund' => 2), array('id' => $groupUserJoin['id']));
                    //标记定金退款
                    pdo_update(ztbNopreTable('user_reimburse'), array('is_deposit_refund' => 1,  "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                    if ($reimburseModel['is_balance_refund'] == 1) {
                        //更改退款申请状态
                        pdo_update(ztbNopreTable('user_reimburse'), array('status' => 1, "veto_note" => "同意退款", "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                        //更改订单状态
                        pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $reimburseModel['orderid']));
                    }

                    //获取用户信息                                                                                                                
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));
                    #endregion 

                    #region 财务操作
                    if (floatval($recharge['paymoney']) > 0) {

                        //更新用户信息
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的定金退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] = $groupUserJoin['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = time();
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion
                    
                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】定金退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_collage_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】定金退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_collage_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion

                }
            }
            //阶梯拼团 可能一个或者两个订单
            if ($activity['activity_types'] == 17) {
                $object = pdo_get(ztbNopreTable('obj_ladder'), array('deltime' => 0, 'activity_id' => $activity['id']));
                //查询订单 并且更改状态
                $user_doaw_model = pdo_get(ztbNopreTable('user_draw'), array('uniacid' =>  $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'pay_number' => $paynumber, 'deltime' => 0));
                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {
                    #region 逻辑处理

                    //退款订单回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'status' => 0, 'deltime' => 0));
                    //标记尾款退款
                    pdo_update(ztbNopreTable('user_reimburse'), array('is_balance_refund' => 1,  "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                    if ($reimburseModel['is_deposit_refund'] == 1) {
                        //更改退款申请状态
                        pdo_update(ztbNopreTable('user_reimburse'), array('status' => 1, "veto_note" => "同意退款", "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                        //更改订单状态
                        pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));
                    }
                    //获取用户信息                                                                                                                
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));
                    #endregion 

                    #region 财务操作
                    if ($recharge['paymoney'] > 0) {
                        //更新用户信息
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] = $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = time();
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion

                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_ladder_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_ladder_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion

                }
                //参与记录, 定金
                $groupUserJoin = pdo_get(ztbNopreTable('obj_ladder_join'), array('uniacid' =>  $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'deltime' => 0, 'openid' => $recharge['openid']));
                if (!empty($groupUserJoin)  &&  $groupUserJoin['is_refund'] == 1) {
                    #region 逻辑处理
                    pdo_update(ztbTable('obj_ladder_join', false), array('is_refund' => 2), array('id' => $groupUserJoin['id']));

                    //更新退款订单回调信息

                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'openid' => $recharge['openid'], 'deltime' => 0));
                    //标记定金退款
                    pdo_update(ztbNopreTable('user_reimburse'), array('is_deposit_refund' => 1,  "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                    if ($reimburseModel['is_balance_refund'] == 1) {
                        //更改退款申请状态
                        pdo_update(ztbNopreTable('user_reimburse'), array('status' => 1, "veto_note" => "同意退款", "updatetime" => TIMESTAMP), array('id' => $reimburseModel['id']));
                        //更改订单状态
                        pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $reimburseModel['orderid']));
                    }
                    //获取用户信息                                                                                                                
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));

                    #endregion 

                    #region 财务操作

                    if ($recharge['paymoney'] > 0) {
                        //更新用户信息
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的定金退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] = $groupUserJoin['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = time();
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion

                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】定金退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_ladder_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】定金退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_ladder_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion

                }
            }
            //报名拓客
            if ($activity['activity_types'] == 20) {

                $join_id = $dataarr[1];
                $origin_id = $dataarr[2];

                //溯源用户
                if (!empty($origin_id)) {
                    $originModel = pdo_get('lywywl_ztb_marketing_user', array('id' => $origin_id, 'activity_id' => $activity['id'], 'uniacid' => $uniacid));
                }
                $project_id = $dataarr[3];
                //获取报名项目
                $project_model = pdo_get('lywywl_ztb_obj_enroll_project', array('id' => $project_id));
                $object = pdo_get(ztbNopreTable('obj_enroll'), array('deltime' => 0, 'activity_id' => $activity['id']));

                //查询订单 并且更改状态 
                $user_doaw_model = pdo_get(ztbNopreTable('user_draw'), array('uniacid' => $recharge['uniacid'], 'store_id' => $store_id, 'activity_id' => $activity['id'], 'pay_number' => $paynumber, 'deltime' => 0));
                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {

                    #region 逻辑处理
                    pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));
                    //更新退款订单回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'deltime' => 0, 'status' => 0));
                    pdo_update(ztbTable('user_reimburse', false), array('status' => 1, "veto_note" => "同意退款", 'updatetime' => time()), array('id' => $reimburseModel['id']));

                    //获取用户信息
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));

                    if (!empty($join_id)) {
                        //获取参与信息
                        $joinModel = pdo_get(ztbTable('obj_enroll_join', false), array('uniacid' => $uniacid, 'id' => $join_id));
                         //标记参与表退款成功
                         pdo_update(ztbTable('obj_enroll_join', false), array('is_refund' => 2), array('id' => $join_id));
                    }
                    
                    //更新溯源直销
                    if (!empty($origin_id)) {
                        if ($joinModel['openid'] == $originModel['openid']) {
                            pdo_update(ztbNopreTable('marketing_user'), array('buy_num -=' => 1), array('id' => $origin_id));
                        }
                    }
                    //更新报名人数
                    pdo_update(ztbTable('obj_activity', false), array('buy_num -=' => 1), array('id' => $activity['id']));
                    //更新剩余名额
                    if ($project_model['is_open_stock'] == 1) {
                        pdo_update(ztbTable('obj_enroll_project', false), array('stock +=' => 1,), array('id' => $project_model['id']));
                    }
                    //更新项目销量
                    pdo_update(ztbTable('obj_enroll_project', false), array('buy_num -=' => 1), array('id' => $project_model['id']));
                    //更新溯源参与
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable('marketing_user'), array('marketing_num -=' => 1), array('id' => $origin_id));
                    }
                    #endregion

                    #region 资金变动

                    if (floatval($recharge['paymoney']) > 0) {
                        //更新用户信息
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] =  $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = time();
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion
                    
                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_enroll_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_enroll_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion
                }
            }
            //全民拼团  仅支付一次
            if ($activity['activity_types'] == 21) {
                $join_id = $dataarr[1];
                $pid = $dataarr[2];
                $origin_id = $dataarr[3];

                //溯源用户
                if (!empty($origin_id)) {
                    $originModel = pdo_get('lywywl_ztb_marketing_user', array('id' => $origin_id, 'activity_id' => $activity['id'], 'uniacid' => $uniacid));
                }
                $object = pdo_get(ztbNopreTable('obj_whole'), array('deltime' => 0, 'activity_id' => $activity['id']));
                //查询订单 并且更改状态
                $user_doaw_model = pdo_get(ztbNopreTable('user_draw'), array('uniacid' => $recharge['uniacid'], 'store_id' => $store_id, 'activity_id' => $activity['id'], 'pay_number' => $paynumber, 'deltime' => 0));
                if (!empty($user_doaw_model)  &&  $user_doaw_model['is_refund'] == 1) {

                    #region 逻辑操作

                    //订单表处理
                    pdo_update(ztbTable('user_draw', false), array('is_refund' => 2, 'updatetime' => time()), array('id' => $user_doaw_model['id']));
                    //更新退款订单回调信息
                    $reimburseModel = pdo_get(ztbNopreTable('user_reimburse'), array('uniacid' => $uniacid, 'store_id' => $store_id, 'activity_id' => $activity['id'], 'orderid' => $user_doaw_model['id'], 'status' => 0, 'deltime' => 0));
                    //同意退款申请
                    pdo_update(ztbTable('user_reimburse', false), array('status' => 1, "veto_note" => "同意退款", 'updatetime' => time()), array('id' => $reimburseModel['id']));

                    //获取用户信息                                                                                                                
                    $userModel = pdo_get(ztbTable('user_account', false), array('uniacid' => $uniacid, 'store_id' => $store_id, 'deltime' => 0, 'openid' => $recharge['openid']));

                    #region 参与表处理
                    $join_model = pdo_get(ztbNopreTable('obj_whole_join'), array('uniacid' => $uniacid, 'activity_id' => $activity['id'], 'openid' => $userModel['openid'], 'deltime' => 0));

                    if ($join_model) {
                        //标记参与表退款成功
                        pdo_update(ztbTable('obj_whole_join', false), array('is_refund' => 2), array('id' => $join_model['id']));
                    }
                    #endregion

                    #region  成团表处理

                    //退款人
                    $join_group_model = pdo_get(ztbNopreTable('obj_whole_group'), array('uniacid' => $uniacid, 'activity_id' => $activity['id'], 'openid' => $userModel['openid'], 'deltime' => 0));

                    if ($join_group_model && $join_group_model['is_refund'] == 1) {
                        //标记参团表退款成功
                        pdo_update(ztbTable('obj_whole_group', false), array('is_refund' => 2), array('id' => $join_group_model['id']));
                    }

                    #endregion

                    //更新溯源直销
                    if (!empty($origin_id)) {
                        if ($joinModel['openid'] == $originModel['openid']) {
                            pdo_update(ztbNopreTable('marketing_user'), array('buy_num -=' => 1), array('id' => $origin_id));
                        }
                    }
                    //活动购买数量
                    pdo_update(ztbTable('obj_activity', false), array('buy_num -=' => 1), array('id' => $activity['id']));
                    #endregion 

                    #region 资金变动

                    if (floatval($recharge['paymoney']) > 0) {
                        $note = "尊敬的会员" . $userModel['nickname'] . ",您对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";
                        $storenote = "会员[" . $userModel['nickname'] . "]对活动：(" . $activity['title'] . ")的退款于" . date('Y-m-d H:i:s', time()) . "交易成功,金额:" . floatval($recharge['paymoney']) . "元。";

                        //添加用户资金流水
                        $userBillModel = array();
                        $userBillModel['uniacid'] = $uniacid;
                        $userBillModel['store_id'] = $store_id;
                        $userBillModel['openid'] = $userModel['openid'];
                        $userBillModel['nickname'] = $userModel['nickname'];
                        $userBillModel['headurl'] = $userModel['headurl'];
                        $userBillModel['types'] = 6;
                        $userBillModel['detail_id'] =  $user_doaw_model['id'];
                        $userBillModel['money'] = floatval($recharge['paymoney']);
                        $userBillModel['balance'] = pdo_getcolumn(ztbNopreTable('user_account'), array('id' => $userModel['id']), 'money');
                        $userBillModel['note'] = $note;
                        $userBillModel['createtime'] = TIMESTAMP;
                        pdo_insert(ztbNopreTable('user_bill'), $userBillModel);
                    }
                    #endregion
                    
                    #region 通知消息
                    $storeModel = pdo_get(ztbNopreTable('store_account'), array('uniacid' => $uniacid, 'id' => $store_id));
                    //商家模板消息通知
                    if ($config['check_notify_pushtmp'] && $storeModel['openid']) {
                        if (isFollow($storeModel['openid'], $uniacid)) {
                            $postdata = array(
                                'first' => array(
                                    'value' => "{$storeModel['name']}，您的活动有新的退款",
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => '退款审核通过',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => date('Y-m-d H:i:s', TIMESTAMP),
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                                    'color' => '#173177'
                                )
                            );
                            //链接地址
                            $domain = substr($_W['siteroot'], 0, -19);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_whole_pay&m=lywywl_ztb&aid={$activity['id']}";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $template_id = $config['check_notify_pushtmp'];
                            $result = sendTplNotice($uniacid, $storeModel['openid'], $postdata, $template_id, $url);
                        }
                    }

                    //发送微信订阅通知 审核结果通知
                    if ($config['checknotifypushtmp_sub'] && $storeModel['openid']) {
                        $touser = $storeModel['openid'];
                        $template_id = $config['checknotifypushtmp_sub'];
                        $postdata = array(
                            'thing6' => array(
                                'value' => "活动名称【{$activity['title']}】,用户【" . $userModel['nickname'] . "】退款" . $recharge['paymoney'] . '元',
                            ),
                            'phrase1' => array(
                                'value' => '退款审核通过',
                            ),
                            'date3' => array(
                                'value' => date('Y-m-d H:i:s', TIMESTAMP),
                            )
                        );
                        //链接地址
                        $domain = substr($_W['siteroot'], 0, -19);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.obj_whole_pay&m=lywywl_ztb&aid={$activity['id']}";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                    #endregion
                }
            }
        }
    }
}
