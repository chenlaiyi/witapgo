<?php
/*珍贵资源 请勿转卖*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Datatransfer_EweiShopV2Page extends WebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$item = pdo_fetch('select dt.*,w.name from ' . tablename('tapgo_tt_datatransfer') . ' dt left join ' . tablename('account_wechats') . ' w on w.uniacid = dt.touniacid where dt.fromuniacid =:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
		$senduniacid = $_GPC['acid'];
		$isopen = $_GPC['isopen'];

		if ($_W['ispost']) {
			if (!empty($isopen)) {
				pdo_delete('tapgo_tt_datatransfer', array('fromuniacid' => $_W['uniacid']));
				show_json(1, array('url' => referer()));
			}

			$data = array('fromuniacid' => $_W['uniacid'], 'touniacid' => $senduniacid, 'status' => 1);
			pdo_insert('tapgo_tt_datatransfer', $data);
			$tables = array('tapgo_tt_category', 'tapgo_tt_carrier', 'tapgo_tt_adv', 'tapgo_tt_feedback', 'tapgo_tt_form', 'tapgo_tt_form_category', 'tapgo_tt_gift', 'tapgo_tt_goods', 'tapgo_tt_goods_comment', 'tapgo_tt_goods_group', 'tapgo_tt_goods_label', 'tapgo_tt_goods_labelstyle', 'tapgo_tt_goods_option', 'tapgo_tt_goods_param', 'tapgo_tt_goods_spec', 'tapgo_tt_goods_spec_item', 'tapgo_tt_member_address', 'tapgo_tt_member_printer', 'tapgo_tt_member_printer_template', 'tapgo_tt_member_group', 'tapgo_tt_member_level', 'tapgo_tt_member_log', 'mc_credits_record', 'tapgo_tt_commission_apply', 'tapgo_tt_commission_bank', 'tapgo_tt_commission_level', 'tapgo_tt_commission_log', 'tapgo_tt_commission_rank', 'tapgo_tt_commission_repurchase', 'tapgo_tt_commission_shop', 'tapgo_tt_order', 'tapgo_tt_order_comment', 'tapgo_tt_order_goods', 'tapgo_tt_order_peerpay', 'tapgo_tt_order_peerpay_payinfo', 'tapgo_tt_order_refund');

			foreach ($tables as $table) {
				pdo_update($table, array('uniacid' => $senduniacid), array('uniacid' => $_W['uniacid']));
			}

			show_json(1, array('url' => referer()));
		}

		include $this->template();
	}
}

?>
