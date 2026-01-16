<?php
require '../../framework/bootstrap.inc.php';
require './inc/class/AlipayService.class.php';
require './inc/function/functions.php';
include './inc/function/packet.func.php';
header('Content-type:text/html; Charset=utf-8');
$paynumber = $_POST['out_trade_no'];
$recharge = pdo_get('lywywl_ztb_sys_pay', array('deltime' => 0, 'paynumber' => $paynumber));
if (empty($recharge)) {
    echo 'fail';
    exit();
}
$_W['uniacid'] = $recharge['uniacid'];
$module = pdo_get('uni_account_modules', array('module' => 'lywywl_ztb', 'uniacid' => $recharge['uniacid']));
if (empty($module)) {
    echo 'fail';
    exit();
}
$config = iunserializer($module['settings']);
$config = $config['ztb'];

//支付宝公钥，账户中心->密钥管理->开放平台密钥，找到添加了支付功能的应用，根据你的加密类型，查看支付宝公钥
$alipayPublicKey = $config['alipublickey'];
$aliPay = new AlipayService($alipayPublicKey);
//验证签名
$result = $aliPay->rsaCheck($_POST, $_POST['sign_type']);
if ($result === true) {
    //处理你的逻辑，例如获取订单号$_POST['out_trade_no']，订单金额$_POST['total_amount']等
    //程序执行完后必须打印输出“success”（不包含引号）。如果商户反馈给支付宝的字符不是success这7个字符，支付宝服务器会不断重发通知，直到超过24小时22分钟。一般情况下，25小时以内完成8次通知（通知的间隔频率一般是：4m,10m,10m,1h,2h,6h,15h）；
    $paymoney = floatval($_POST['total_amount']);
    if (!empty($recharge)) {

        if ($recharge['types'] == 1) { //续费
            if (floatval($recharge['paymoney']) == $paymoney && intval($recharge['status']) == 0) {
                $setmeal_id = intval($recharge['data']);
                $setmeal = pdo_get('lywywl_ztb_sys_setmeal', array('deltime' => 0, 'id' => $setmeal_id, 'uniacid' => $recharge['uniacid'], 'status' => 1));
                if ($setmeal) {
                    $store = pdo_get('lywywl_ztb_store_account', array('deltime' => 0, 'id' => $recharge['store_id'], 'uniacid' => $recharge['uniacid']));
                    $create_num = $setmeal['create_num'];
                    if ($store['endtime'] >= time() && $store['create_num'] == -1 && $setmeal['create_num'] == -1) {
                        $starttime = $store['endtime'];
                        $endtime = strtotime("+" . $setmeal['day'] . "day", $store['endtime']);
                    }
                    else if($store['endtime'] >= time() && $store['create_num'] > 0 && $setmeal['create_num'] > 0){
                        //如果商家还有剩余创建活动次数并且没有到期，这次续费的套餐不是无限次数，则累加创建活动次数和到期时间
                        $starttime = $store['endtime'];
                        $endtime = strtotime("+".$setmeal['day']."day",$store['endtime']);
                        $create_num = $store['create_num'] + $setmeal['create_num'];
                    }
                    else {
                        $starttime = time();
                        $endtime = strtotime("+" . $setmeal['day'] . "day", time());
                    }

                    //更新订单状态
                    pdo_update('lywywl_ztb_sys_pay', array('status' => 1, 'note' => json_encode($_POST), 'updatetime' => time()), array('id' => $recharge['id'], 'uniacid' => $recharge['uniacid'], 'store_id' => $recharge['store_id']));
                    //减少商家账户余额
                    pdo_update('lywywl_ztb_store_account', array('money -=' => $recharge['mymoney'], 'endtime' => $endtime, 'create_num' => $create_num), array('deltime' => 0, 'id' => $recharge['store_id'], 'uniacid' => $recharge['uniacid']));
                    //添加商家续费记录
                    pdo_insert('lywywl_ztb_store_renew', array(
                        'uniacid' => $recharge['uniacid'],
                        'store_id' => $recharge['store_id'],
                        'types' => 1,
                        'paynumber' => $recharge['paynumber'],
                        'start_time' => $starttime,
                        'end_time' => $endtime,
                        'day' => $setmeal['day'],
                        'create_num' => $setmeal['create_num'],
                        'createtime' => time(),
                        'setmeal_id' => $setmeal['id'],
                    ));
                    $renew_id = pdo_insertid();

                    if ($recharge['mymoney'] > 0) {
                        $store = pdo_get('lywywl_ztb_store_account', array('deltime' => 0, 'id' => $recharge['store_id'], 'uniacid' => $recharge['uniacid']));
                        //添加商户资金流水
                        pdo_insert('lywywl_ztb_store_bill', array(
                            'uniacid' => $recharge['uniacid'],
                            'store_id' => $recharge['store_id'],
                            'types' => 10,
                            'detail_id' => $renew_id,
                            'money' => $recharge['mymoney'],
                            'balance' => $store['money'],
                            'note' => "商户服务续费：" . $recharge['mymoney'] . ",于" . date('Y-m-d H:i:s', time()) . "续费成功，续费方式：余额！",
                            'createtime' => time()
                        ));
                    }

                    //是否开启商家分销插件
                    $plug_storeinvite = getPluginStatus($recharge['uniacid'],'lywywl_ztb_plugin_storeinvite');
                    if($plug_storeinvite){
                        //购买套餐返利
                        storeInviteBusiness($store,$setmeal,$config);
                    }

                    //发送续费微信消息
                    if ($config['renewpushtmp']) {
                        if ($store['openid']) {
                            if (isFollow($store['openid'], $recharge['uniacid'])) {
                                $postdata = array(
                                    'first' => array(
                                        'value' => '您的商户系统已续费成功',
                                        'color' => '#173177'
                                    ),
                                    'keyword1' => array(
                                        'value' => $store['name'],
                                        'color' => '#173177'
                                    ),
                                    'keyword2' => array(
                                        'value' => $setmeal['money'],
                                        'color' => '#173177'
                                    ),
                                    'keyword3' => array(
                                        'value' => $setmeal['day'] . '天，' . date('Y-m-d H:i:s', $starttime) . '至' . date('Y-m-d H:i:s', $endtime),
                                        'color' => '#173177'
                                    ),
                                    'remark' => array(
                                        'value' => '感谢您的使用。',
                                        'color' => '#173177'
                                    )
                                );
                                $template_id = $config['renewpushtmp'];
                                $_W['uniacid'] = $recharge['uniacid'];
                                $result = sendTplNotice('', $store['openid'], $postdata, $template_id, '');
                            }
                        }
                    }
                    //发送微信订阅通知 续费成功通知
                    if ($config['renewpushtmp_sub']) {
                        if ($store['openid']) {
                            $touser = $store['openid'];
                            $template_id = $config['renewpushtmp_sub'];
                            $postdata = array(
                                'thing1' => array(
                                    'value' => '商户['.$store['name'].']续费',
                                ),
                                'time3' => array(
                                    'value' => date('Y-m-d', $starttime) . '~' . date('Y-m-d', $endtime),
                                ),
                                'amount4' => array(
                                    'value' => $setmeal['money'],
                                ),
                            );
                            $result = sendWeixinTemplate($touser, $template_id, $postdata, '');
                        }
                    }
                }
            }
        } else {

            if (floatval($recharge['paymoney']) == $paymoney && intval($recharge['status']) == 0) {
                //更新充值状态
                pdo_update('lywywl_ztb_sys_pay', array('status' => 1, 'note' => json_encode($_POST), 'updatetime' => time()), array('deltime' => 0, 'id' => $recharge['id'], 'uniacid' => $recharge['uniacid'], 'store_id' => $recharge['store_id']));
                //更新商家余额
                pdo_update('lywywl_ztb_store_account', array('money +=' => $recharge['endmoney']), array('deltime' => 0, 'id' => $recharge['store_id'], 'uniacid' => $recharge['uniacid']));

                $store = pdo_get('lywywl_ztb_store_account', array('deltime' => 0, 'id' => $recharge['store_id'], 'uniacid' => $recharge['uniacid']));
                //添加商户资金流水
                pdo_insert('lywywl_ztb_store_bill', array(
                    'uniacid' => $recharge['uniacid'],
                    'store_id' => $recharge['store_id'],
                    'types' => 1,
                    'detail_id' => $recharge['id'],
                    'money' => $recharge['endmoney'],
                    'balance' => $store['money'],
                    'note' => "商户支付宝充值：" . $recharge['endmoney'] . ",于" . date('Y-m-d H:i:s', time()) . "充值成功，充值方式：支付宝！",
                    'createtime' => time()
                ));
                //发送充值微信消息
                if ($config['buypushtmp']) {
                    if ($store['openid']) {
                        if (isFollow($store['openid'], $recharge['uniacid'])) {
                            $postdata = array(
                                'first' => array(
                                    'value' => '尊敬的' . $store['name'] . '，您已经充值成功！',
                                    'color' => '#173177'
                                ),
                                'keyword1' => array(
                                    'value' => $recharge['endmoney'] . '元',
                                    'color' => '#173177'
                                ),
                                'keyword2' => array(
                                    'value' => $store['money'] . '元',
                                    'color' => '#173177'
                                ),
                                'keyword3' => array(
                                    'value' => date('Y-m-d H:i:s', time()),
                                    'color' => '#173177'
                                ),
                                'keyword4' => array(
                                    'value' => '支付宝',
                                    'color' => '#173177'
                                ),
                                'remark' => array(
                                    'value' => '点击进入查看资金明细。',
                                    'color' => '#173177'
                                )
                            );
                            $template_id = $config['buypushtmp'];
                            $_W['uniacid'] = $recharge['uniacid'];
                            $url = __MURL('store.store_bill', array('act' => 'index'), true, true);
                            $url = str_replace("addons/lywywl_ztb/", "", $url);
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $result = sendTplNotice('', $store['openid'], $postdata, $template_id, $url);
                        }
                    }
                }
                //发送微信订阅通知 充值成功提醒
                if ($config['buypushtmp_sub']) {
                    if ($store['openid']) {
                        $touser = $store['openid'];
                        $template_id = $config['buypushtmp_sub'];
                        $postdata = array(
                            'amount2' => array(
                                'value' => $recharge['endmoney'],
                            ),
                            'phrase3' => array(
                                'value' => '支付宝',
                            ),
                            'time4' => array(
                                'value' => date('Y-m-d H:i:s', time()),
                            ),
                            'amount8' => array(
                                'value' => $store['money'],
                            ),
                            'thing9' => array(
                                'value' => '尊敬的' . $store['name'] . '，您已经充值成功！',
                            ),
                        );
                        $url = __MURL('store.store_bill', array('act' => 'index'), true, true);
                        $url = str_replace("addons/lywywl_ztb/", "", $url);
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                    }
                }
            }

        }
    }
    echo 'success';
    exit();
}
echo 'error';
exit();