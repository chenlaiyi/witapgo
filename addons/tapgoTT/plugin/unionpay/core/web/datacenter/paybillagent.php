<?php
/*珍贵资源 请勿转卖*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Paybillagent_TapgoTtPage extends WebPage {

	function main() {
		global $_W,$_GPC;
		if ($_W['ispost']) {
			$starttime = strtotime($_GPC['time']['start']);
			$endtime = strtotime($_GPC['time']['end']);

            $nodetime = strtotime('+3 month',strtotime($_GPC['time']['start']));
            if($endtime>$nodetime){
                $this->message("每次最多只能同步三个月的账单", '', 'error');
            }

            $type = trim($_GPC['type']);
            $datatype = intval($_GPC['dataplatform']);

			//$result = m('updataunipay')->downloadbill($starttime, $endtime, $type, $datatype);
			if (is_error($result)) {
				$this->message($result['message'], '', 'error');
			}
			plog('datacenter.paybillagent.main',"同步对账单");
		}
		if (empty($starttime) || empty($endtime)) {
			$starttime = $endtime = time();
		}
		load()->func('tpl');
		include $this->template();
	}



    /**
     * 同步对账单
     * @param type $type ALL，返回当日所有订单信息，默认值 SUCCESS，返回当日成功支付的订单 REFUND，返回当日退款订单 REVOKED，已撤销的订单
     * @param type $money
     */
    public function downloadbill($starttime, $endtime, $type = 'ALL', $datatype = 0)
    {
        global $_W;
        global $_GPC;
        $dates = array();
        $startdate = date('Ymd', $starttime);
        $enddate = date('Ymd', $endtime);

        if ($startdate == $enddate) {
            $dates = array($startdate);
        }
        else {
            $days = (double) ($endtime - $starttime) / 86400;
            $d = 0;

            while ($d < $days) {
                $dates[] = date('Ymd', strtotime($startdate . ('+' . $d . ' day')));
                ++$d;
            }
        }

        if (empty($dates)) {
            show_message('对账单日期选择错误!', '', 'error');
        }

        list($pay, $payment) = m('common')->public_build();

        if ($payment['is_new'] == 0) {
            $setting = uni_setting($_W['uniacid'], array('payment'));

            if (!is_array($setting['payment'])) {
                return error(1, '没有设定支付参数');
            }

            if (!empty($pay['weixin_sub'])) {
                $wechat = array('appid' => $payment['appid_sub'], 'mchid' => $payment['mchid_sub'], 'sub_appid' => !empty($payment['sub_appid_sub']) ? $payment['sub_appid_sub'] : '', 'sub_mch_id' => $payment['sub_mchid_sub'], 'apikey' => $payment['apikey_sub']);
            }
            else {
                $wechat = $setting['payment']['wechat'];
            }

            $sql = 'SELECT `key`,`secret` FROM ' . tablename('account_wechats') . ' WHERE `uniacid`=:uniacid limit 1';
            $row = pdo_fetch($sql, array(':uniacid' => $_W['uniacid']));
            $wechat['appid'] = $row['key'];
        }
        else {
            $wechat = array('appid' => $payment['sub_appid'], 'mchid' => $payment['sub_mch_id'], 'apikey' => $payment['apikey']);
            $sub_wechat = array('appid' => $payment['appid'], 'mchid' => $payment['mch_id'], 'sub_appid' => !empty($payment['sub_appid']) ? $payment['sub_appid'] : '', 'sub_mch_id' => $payment['sub_mch_id'], 'apikey' => $payment['apikey']);

            switch ($payment['type']) {
                case '1':
                    $wechat = $sub_wechat;
                    break;

                case '3':
                    $wechat = $sub_wechat;
                    break;

                case '4':
                    return error(1, '暂不支持全付通的账单下载');
            }
        }

        $content = '';

        foreach ($dates as $date) {
            $dc = $this->downloadday($date, $wechat, $type);
            if (is_error($dc) || strexists($dc, 'CDATA[FAIL]')) {
                continue;
            }

            if ($datatype) {
                $dc_arr = explode('
', $dc);
                $len = count($dc_arr);
                $num_data = explode(',', $dc_arr[$len - 2]);
                $order_text = explode(',', $dc_arr[$len - 3]);

                foreach ($dc_arr as $key => $value) {
                    if ($key != 0 && $key < $len - 3) {
                        if (!strstr($value, 'tapgo_ttv2')) {
                            $value_arr = explode(',', $value);
                            $ordernum = substr($num_data[0], 1);
                            $ordernum -= 1;
                            $num_data[0] = '`' . $ordernum;
                            $yj_price = substr($num_data[1], 1);
                            $yj_price -= substr($value_arr[12], 1);
                            $num_data[1] = '`' . $yj_price;

                            if ($type == 'ALL') {
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
                            }
                            else if ($type == 'SUCCESS') {
                                $sxf_price = substr($num_data[4], 1);
                                $sxf_price -= substr($value_arr[16], 1);
                                $num_data[4] = '`' . $sxf_price;
                                $order_price = substr($num_data[5], 1);
                                $order_price -= substr($value_arr[18], 1);
                                $num_data[5] = '`' . $order_price;
                                unset($num_data[2]);
                                unset($num_data[3]);
                                unset($num_data[6]);
                                unset($order_text[2]);
                                unset($order_text[3]);
                                unset($order_text[6]);
                            }
                            else {
                                if ($type == 'REFUND') {
                                    $tk_price = substr($num_data[2], 1);
                                    $tk_price -= substr($value_arr[18], 1);
                                    $num_data[2] = '`' . $tk_price;
                                    $czqtk_price = substr($num_data[3], 1);
                                    $czqtk_price -= substr($value_arr[19], 1);
                                    $num_data[3] = '`' . $czqtk_price;
                                    $sxf_price = substr($num_data[4], 1);
                                    $sxf_price -= substr($value_arr[24], 1);
                                    $num_data[4] = '`' . $sxf_price;
                                    $order_price = substr($num_data[5], 1);
                                    $order_price -= substr($value_arr[26], 1);
                                    $num_data[5] = '`' . $order_price;
                                    $sqtk_price = substr($num_data[6], 1);
                                    $sqtk_price -= substr($value_arr[27], 1);
                                    $num_data[6] = '`' . $sqtk_price;
                                }
                            }

                            unset($dc_arr[$key]);
                        }
                    }
                }

                $dc_arr[$len - 2] = implode(',', $num_data);
                $dc_arr[$len - 3] = implode(',', $order_text);
                $dc = implode('
', $dc_arr);
            }

            $content .= $date . ' 账单

';
            $content .= $dc . '

';
        }

        if (empty($content)) {
            return error(-1, '账单为空');
        }

        $content = "\xef\xbb\xbf" . $content;
        $file = time() . '.csv';
        header('Content-type: application/octet-stream ');
        header('Accept-Ranges: bytes ');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Expires: 0 ');
        header('Content-Encoding: UTF8');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0 ');
        header('Pragma: public ');
        exit($content);
    }

}
