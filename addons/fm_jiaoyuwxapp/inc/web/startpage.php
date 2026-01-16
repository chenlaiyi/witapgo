<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
global $_GPC, $_W;
$weid = $_W['uniacid'];  
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
	$item = pdo_fetch("SELECT * FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$weid}'");
	if(empty($item['schoolid']) || empty($item['fromweid'])){
		message('抱歉,请你先完成基础设置', $this->createWebUrl('basics', array('op' => 'display')), 'error');
	}	
	if (checksubmit('submit')) {
		$data = array(
			'weid' => $weid,
			'headtitle' => trim($_GPC['headtitle']),
			'headcolor' => trim($_GPC['headcolor']),
			'headfont'  => trim($_GPC['headfont']),
			'imgname' => trim($_GPC['imgname']),
			'loginimg' => trim($_GPC['loginimg']),
			'imgfontcolor' => trim($_GPC['imgfontcolor']),
			'btnname' => trim($_GPC['btnname']),
			'btncolor' => trim($_GPC['btncolor']),
			'btnfontcolor' => trim($_GPC['btnfontcolor']),
			'copyright' => trim($_GPC['copyright']),
			'copyrightfontcolor' => trim($_GPC['copyrightfontcolor']),
			'loginbgcolor' => trim($_GPC['loginbgcolor']),
			'loginbgimg' => trim($_GPC['loginbgimg']),
			'bgtype' => trim($_GPC['bgtype'])
		);	
		if (!empty($item)) {
			pdo_update($this->table_wxappset, $data, array('id' => $item['id']));
		} else {
			pdo_insert($this->table_wxappset, $data);
		}
		message('操作成功！', $this->createWebUrl('startpage', array('op' => 'display')), 'success');
	}
}
include $this->template ( 'web/startpage' );
?>