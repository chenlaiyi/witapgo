<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage
{
	/**
     * 码科配置参数页面
     * @author Jason
     */
	public function main()
	{
		global $_GPC;
		global $_W;

		if ($_W['ispost']) {
			$data = $_GPC['data'];
			m('common')->updatePluginset(array('makeexpress' => $data));
			$makeModel = new $this->model($data);
			show_json(1);
		}

		$data = m('common')->getPluginset('makeexpress');
		include $this->template();
	}
}

?>
