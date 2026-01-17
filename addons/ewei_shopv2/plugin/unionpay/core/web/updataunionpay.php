<?php
/*TapGo 独立版本 - 请勿非法传播*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Updataunionpay_EweiShopV2Page extends WebPage {

	function main() {
		global $_W,$_GPC;
		if ($_W['ispost']) {
			$starttime = strtotime($_GPC['time']['start']);
			$endtime = strtotime($_GPC['time']['end']);

            $nodetime = strtotime('+3 month',strtotime($_GPC['time']['start']));
            if($endtime>$nodetime){
                $this->message("每次最多只能下载三个月的账单", '', 'error');
            }

            $type = trim($_GPC['type']);
            $datatype = intval($_GPC['datatype']);

			$result = m('finance')->downloadbill($starttime, $endtime, $type, $datatype);
			if (is_error($result)) {
				$this->message($result['message'], '', 'error');
			}
			plog('finance.downloadbill.main',"下载对账单");
		}
		if (empty($starttime) || empty($endtime)) {
			$starttime = $endtime = time();
		}
		load()->func('tpl');
		include $this->template();
	}

}
