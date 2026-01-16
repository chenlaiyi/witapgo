<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2022/3/12
 * Time: 03:03
 */
/**
 * 数据处理类
 * ============================================================================
 * 银联（威富通）对账单数据处理
 * @param $response 对账单数据
 * @return array 返回结果
 * 数据以文本表格的方式返回，第一行为表头,共38个字段。第二行起为明细，字段以","分割，每个字段前面统一加上"`"(Tab键上面)。
 * 最后两行会汇总信息，共6个字段
 * ============================================================================
 *
 */
class DataHandler{

    public static function dealBillResponse($response){

//        $handler = fopen('result.txt','a+');
//        $content = PHP_EOL."================对账单数据===================".PHP_EOL;
//        $flag = fwrite($handler,$content.json_encode($result));
//        //echo '数据条数：'.count($response).PHP_EOL;
//        fclose($handler);

        $result  = array();
        $response = str_replace("`","",$response);
        $response = explode(PHP_EOL, $response);
        $len = count($response);
        //$num_data = explode(',', $dc_arr[$len - 2]);


        foreach ($response as $key=>$val){
            if($key != 0 && $key < $len - 2){
                if(strpos($val, ',') !== false){
                    $data = explode(',', $val);
                    $data[25] = trim($data[25],"%")/100;
                    $data[37] = str_replace(array("/r/n", "/r", "/n", "\r"), "", $data[37]);
                    $data[38] = "机构编号";//"扩展字段4"  替换成 "代理机构编号"
                }
                $result['bill'][] = $data;
            }
            
            if($key != 0 && $key > $len - 2 && $key < $len){
                if(strpos($val, ',') !== false){
                    $result['summary'] = explode(',', $val);
                }
            }
            //$result[] = $data;
        }
        $handler = fopen('result10.txt','a+');
        $content = PHP_EOL."================对账单数据处理结果10===================".PHP_EOL;
        $flag = fwrite($handler,$content.json_encode($result));
        //echo '数据条数：'.count($response).PHP_EOL;
        fclose($handler);
        return $flag;

//
//
//        foreach ($response as $key=>$val){
//            if(strpos($val, ',') !== false){
//                $data = explode(',', $val);
//                array_shift($data); // 删除第一个元素并下标从0开始
//                if(count($data) == 38){ // 处理账单数据
//                    $result['bill'][] = array(
//                        'pay_time'       => $data[0], // 支付时间
//                        'APP_ID'        => $data[1], // app_id
//                        'MCH_ID'        => $data[2], // 商户id
//                        'IMEI'         => $data[4], // 设备号
//                        'order_sn_wx'     => $data[5], // 微信订单号
//                        'order_sn_sh'     => $data[6], // 商户订单号
//                        'user_tag'       => $data[7], // 用户标识
//                        'pay_type'       => $data[8], // 交易类型
//                        'pay_status'      => $data[9], // 交易状态
//                        'bank'         => $data[10], // 付款银行
//                        'money_type'      => $data[11], // 货币种类
//                        'total_amount'     => $data[12], // 总金额
//                        'coupon_amount'    => $data[13], // 代金券或立减优惠金额
//                        'refund_number_wx'   => $data[14], // 微信退款单号
//                        'refund_number_sh'   => $data[15], // 商户退款单号
//                        'refund_amount'    => $data[16], // 退款金额
//                        'coupon_refund_amount' => $data[17], // 代金券或立减优惠退款金额
//                        'refund_type'     => $data[18], // 退款类型
//                        'refund_status'    => $data[19], // 退款状态
//                        'goods_name'      => $data[20], // 商品名称
//                        'service_charge'    => $data[22], // 手续费
//                        'rate'         => $data[23], // 费率
//                    );
//                }
//                if(count($data) == 6){ // 统计数据
//                    $result['summary'] = array(
//                        'order_num'    => $data[0],  // 总交易单数
//                        'turnover'    => $data[1],  // 总交易额
//                        'refund_turnover' => $data[2],  // 总退款金额
//                        'coupon_turnover' => $data[3],  // 总代金券或立减优惠退款金额
//                        'rate_turnover'  => $data[4],  // 手续费总金额
//                    );
//                }
//            }
//        }
//        //Utils::dataRecodes("对账单数据处理结果", $result);
//        //return $result;
//
//        $handler = fopen('result.txt','a+');
//        $content = PHP_EOL."================对账单数据处理结果123===================".PHP_EOL;
//        $flag = fwrite($handler,$content.json_encode($result));
//        //echo '数据条数：'.count($response).PHP_EOL;
//        fclose($handler);
//        return $flag;
    }

    public static function unionPayDownloadBill($response){
        $dc_arr = explode('
', $response);
        $len = count($dc_arr);
        $num_data = explode(',', $dc_arr[$len - 2]);

        foreach ($dc_arr as $key => $value) {
            if ($key != 0 && $key < $len - 3) {
                if (!strstr($value, 'wei1xin')) {
                    $value_arr = explode(',', $value);
                    $ordernum = substr($num_data[0], 1);
                    $ordernum -= 1;
                    $num_data[0] = '`' . $ordernum;
                    $yj_price = substr($num_data[1], 1);
                    $yj_price -= substr($value_arr[12], 1);
                    $num_data[1] = '`' . $yj_price;
                    $tk_price = substr($num_data[2], 1);
                    $tk_price -= substr($value_arr[16], 1);
                    $num_data[2] = '`' . $tk_price;
                    $czqtk_price = substr($num_data[3], 1);
                    $czqtk_price -= substr($value_arr[17], 1);
                    $num_data[3] = '`' . $czqtk_price;
                    $sxf_price = substr($num_data[4], 1);
                    $sxf_price -= substr($value_arr[22], 1);
                    $num_data[4] = '`' . $sxf_price;
                    $order_price = substr($num_data[5], 1);
                    $order_price -= substr($value_arr[24], 1);
                    $num_data[5] = '`' . $order_price;
                    $sqtk_price = substr($num_data[6], 1);
                    $sqtk_price -= substr($value_arr[25], 1);
                    $num_data[6] = '`' . $sqtk_price;
                    unset($dc_arr[$key]);
                }
            }
        }

        $dc_arr[$len - 2] = implode(',', $num_data);
        $dc = implode('
', $dc_arr);
        $content .= '\n================对账单数据处理结果===================\n
';
        $content .= $dc . '

';

        if (empty($content)) {
            return error(-1, '账单为空');
        }

        $content = "\xef\xbb\xbf" . $content;
//        $file = time() . '.csv';
//        header('Content-type: application/octet-stream ');
//        header('Accept-Ranges: bytes ');
//        header('Content-Disposition: attachment; filename=' . $file);
//        header('Expires: 0 ');
//        header('Content-Encoding: UTF8');
//        header('Cache-Control: must-revalidate, post-check=0, pre-check=0 ');
//        header('Pragma: public ');
        exit($content);
    }

}
?>