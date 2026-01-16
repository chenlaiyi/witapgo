<?php
error_reporting(0);
require '../../../../../framework/bootstrap.inc.php';
require '../../../../../addons/tapgo_ttv2/defines.php';
require '../../../../../addons/tapgo_ttv2/core/inc/functions.php';
global $_W, $_GPC;

ignore_user_abort(); //忽略关闭浏览器
set_time_limit(0); //永远执行

$uniacids = m('cache')->get('willcloseuniacid','global');

if(empty($uniacids))
{
    return;
}

foreach ($uniacids as $uniacid) {
    if (empty($uniacid)) {
        continue;
    }

    $_W['uniacid'] = $uniacid;

    $time = time();

    $orders = pdo_fetchall("select g.type,o.id from " . tablename('tapgo_tt_order') .
        " o LEFT JOIN".tablename('tapgo_tt_order_goods')." og on og.orderid=o.id
        LEFT JOIN ".tablename('tapgo_tt_goods'). " g on g.id=og.goodsid where  o.uniacid={$_W['uniacid']} and o.isverify=1 and o.paytype<>0 and o.willcloseverifymessage <>1 and g.type=5");



    foreach ($orders as $o) {

            $verify = pdo_fetch(" SELECT * FROM ".tablename('tapgo_tt_verifygoods'). " WHERE orderid={$o['id']}");

            if ($verify['limittype'] == 1 && $verify['used'] != 1){

                if ($verify['limitdate'] - $time <= 86400){
                    m('notice')->sendOrderWillVerifyMessage($o['id'],$verify['limitdate']);
                }else{
                    continue;
                }

            }elseif(/*empty($verify['limitdate']) &&*/ $verify['used'] != 1){

                $endtime = $verify['starttime'] + $verify['limitdays']*86400;

                if ($endtime - $time <= 86400){

                    m('notice')->sendOrderWillVerifyMessage($o['id'],$endtime);
                }

            }
    }
}



