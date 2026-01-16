<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = $_GPC['schoolid'];
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$school =  pdo_fetch("SELECT tpic,spic,title FROM " . tablename('wx_school_index') . " where weid = '{$weid}' And id = '{$schoolid}'");
$schoolset = pdo_fetch("SELECT bgtitle FROM " . tablename('wx_school_schoolset') . " where weid = '{$weid}' AND schoolid = '{$schoolid}'");
include IA_ROOT.'/addons/fm_jiaoyu_plugin_bigdata/inc/func/islogin.php';

if ($operation == 'display') {
    if(!isset($_GPC['IsApp'])){
        islogin($weid,$schoolid);
    }
    include $this->template ( 'bdmoney' );

}elseif($operation == 'firstdata'){
    /*
     * 支付方式比例
     *
     * */
    $datasets = array(
        'unionpay' => array('name' => '银联支付', 'value' => 0),
        'alipay' => array('name' => '支付宝支付', 'value' => 0),
        'baifubao' => array('name' => '百付宝支付', 'value' => 0),
        'wechat' => array('name' => '微信支付', 'value' => 0),
        'cash' => array('name' => '现金支付', 'value' => 0),
        'credit' => array('name' => '余额支付', 'value' => 0)
    );
    $data = pdo_fetchall("SELECT * FROM " . tablename('wx_school_order') . 'WHERE weid = :weid AND schoolid = :schoolid and status = 2 ', array(':weid' => $weid, ':schoolid' => $schoolid));
    foreach($data as $da) {
        if(in_array($da['pay_type'], array_keys($datasets))) {
            $datasets[$da['pay_type']]['value'] += 1;
        }
    }
    $datasets = array_values($datasets);

    $bd_pay_series = array();
    $bd_pay_series[0]['name'] = '收入金额/元';
    $bd_pay_series[0]['data'] = $datasets;
    $pay_series = SetEchartsData("支付方式收入比例","pie",false,0,$bd_pay_series);


    /*
    * 订单状态管理
    *
    * */

    //未支付
    $non_payment = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_order') . 'WHERE weid = :weid AND schoolid = :schoolid  and status = 1 ', array(':weid' => $weid, ':schoolid' => $schoolid));

    //已支付
    $paid = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_order') . 'WHERE weid = :weid AND schoolid = :schoolid  and status = 2 ', array(':weid' => $weid, ':schoolid' => $schoolid));

    //已退款
    $refunded = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_order') . 'WHERE weid = :weid AND schoolid = :schoolid  and status = 3 ', array(':weid' => $weid, ':schoolid' => $schoolid));

    $pay_status_series[0]['name'] = '订单数';
    $pay_status_series[0]['data'] = array(
        0 => array('name'=>'未支付','value'=>$non_payment['total']),
        1 => array('name'=>'已支付','value'=>$paid['total']),
        2 => array('name'=>'已退款','value'=>$refunded['total']),
    );
    $order_status = SetEchartsData("订单状态比例","pie",false,0,$pay_status_series);


    /*
  * 近三年的收入情况
  *
  * */
    $now_year = strtotime('0 year');
    $first_year = strtotime('-1 year');
    $two_year = strtotime('-2 year');
    $three_year = strtotime('-3 year');

    //去年到今年
    $first_payment = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_order') . 'WHERE weid = :weid  AND schoolid = :schoolid  AND status = 2 AND paytime >= :first_year AND paytime < :now_year', array(':weid' => $weid, ':schoolid' => $schoolid, ':first_year' => $first_year, ':now_year' => $now_year));
    //上一年
    $two_payment = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_order') . 'WHERE weid = :weid  AND schoolid = :schoolid  AND status = 2 AND paytime >= :two_year AND paytime < :first_year', array(':weid' => $weid, ':schoolid' => $schoolid, ':first_year' => $first_year, ':two_year' => $two_year));
    //前两年
    $three_payment = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_order') . 'WHERE weid = :weid  AND schoolid = :schoolid  AND status = 2 AND paytime >= :three_year AND paytime < :two_year', array(':weid' => $weid, ':schoolid' => $schoolid, ':three_year' => $three_year, ':two_year' => $two_year));

    $payment_year_data = array(
        'xaixs' => array(
            0=>date('Y',$three_year).'-'.date('Y',$two_year),
            1=>date('Y',$two_year).'-'.date('Y',$first_year),
            2=>date('Y',$first_year).'-'.date('Y',$now_year),
        ),
        'series' => array(
            0=>$three_payment['total'],
            1=>$two_payment['total'],
            2=>$first_payment['total'],
        ),

    );
    $payment_year_axis = array(
        'xAxis' =>array(
            'name' => '阶段',
            'data' => $payment_year_data['xaixs']
        ),
        'yAxis' =>array(
            'name' => '收入情况',
        ),
    );
    $annual_income[0]['name'] = '年收入';
    $annual_income[0]['data'] = $payment_year_data['series'];
    $now_annual_income = SetEchartsData("年收入比例","line",false,$payment_year_axis,$annual_income);

    /*
    * 按项目划分
    *
    * */
    $pay_ob = pdo_fetchAll("SELECT c.name,count(o.id)as total FROM " . tablename('wx_school_order') . "as o, ". tablename('wx_school_cost'). " as c where c.id = o.costid and o.weid = '{$weid}' And o.schoolid = '{$schoolid}' And o.status = '2' group by c.name");

    foreach ($pay_ob as $k => $v){
        $pay_ob_series[$k]['name'] = $pay_ob[$k]['name'];
        $pay_ob_series[$k]['value'] = $pay_ob[$k]['total'];
    }
    $new_pay_ob_series[0]['name'] = '收入/元';
    $new_pay_ob_series[0]['data'] = $pay_ob_series;
    $pay_ob_series_data = SetEchartsData("项目类型","pie",false,0,$new_pay_ob_series);

    $return_data = array(
        'pay_series' =>$pay_series,
        'order_status' =>$order_status,
        'now_annual_income' =>$now_annual_income,
        'pay_ob_series_data' =>$pay_ob_series_data,
    );
    die(json_encode($return_data));

}elseif($operation == 'real_time_data'){


}
?>