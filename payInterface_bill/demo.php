<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2022/4/6
 * Time: 22:35
 */


// $XML=<<<XML
// <bank_type><![CDATA[BOC_DEBIT]]></bank_type><cash_fee><![CDATA[2]]></cash_fee><charset><![CDATA[UTF-8]]></charset><coupon_fee><![CDATA[0]]></coupon_fee><device_info><![CDATA[SPAY_IOS]]></device_info><fee_type><![CDATA[CNY]]></fee_type><mch_id><![CDATA[QRA393486610002]]></mch_id><mdiscount><![CDATA[0]]></mdiscount><nonce_str><![CDATA[1649253701248]]></nonce_str><openid><![CDATA[omCqSs-2zB5_U9MVTp0RhlizPNg4]]></openid><out_trade_no><![CDATA[QRA39348661000295131346272807332]]></out_trade_no><out_transaction_id><![CDATA[4200001374202204067247479850]]></out_transaction_id><pay_result><![CDATA[0]]></pay_result><result_code><![CDATA[0]]></result_code><sign><![CDATA[98B0C1A6EB27B15732DB6D6C84746E24]]></sign><sign_type><![CDATA[MD5]]></sign_type><status><![CDATA[0]]></status><time_end><![CDATA[20220406220143]]></time_end><total_fee><![CDATA[2]]></total_fee><trade_type><![CDATA[pay.weixin.micropay]]></trade_type><transaction_id><![CDATA[95516000228681600518161626421038]]></transaction_id><version><![CDATA[2.0]]></version>
// XML;

//$XML="<xml><bank_type><![CDATA[BOC_DEBIT]]></bank_type><cash_fee><![CDATA[2]]></cash_fee><charset><![CDATA[UTF-8]]></charset><coupon_fee><![CDATA[0]]></coupon_fee><device_info><![CDATA[SPAY_IOS]]></device_info><fee_type><![CDATA[CNY]]></fee_type><mch_id><![CDATA[QRA393486610002]]></mch_id><mdiscount><![CDATA[0]]></mdiscount><nonce_str><![CDATA[1649253701248]]></nonce_str><openid><![CDATA[omCqSs-2zB5_U9MVTp0RhlizPNg4]]></openid><out_trade_no><![CDATA[QRA39348661000295131346272807332]]></out_trade_no><out_transaction_id><![CDATA[4200001374202204067247479850]]></out_transaction_id><pay_result><![CDATA[0]]></pay_result><result_code><![CDATA[0]]></result_code><sign><![CDATA[98B0C1A6EB27B15732DB6D6C84746E24]]></sign><sign_type><![CDATA[MD5]]></sign_type><status><![CDATA[0]]></status><time_end><![CDATA[20220406220143]]></time_end><total_fee><![CDATA[2]]></total_fee><trade_type><![CDATA[pay.weixin.micropay]]></trade_type><transaction_id><![CDATA[95516000228681600518161626421038]]></transaction_id><version><![CDATA[2.0]]></version></xml>";
$XML    = file_get_contents("xmldata.txt");
$obj = simplexml_load_string($XML,'SimpleXMLElement', LIBXML_NOCDATA);
$Jsondata = json_encode($obj);
$Arraydata = json_decode($Jsondata, true);
echo json_encode($Arraydata['dataList']['merchant'][49]);
//print_r($Arraydata);