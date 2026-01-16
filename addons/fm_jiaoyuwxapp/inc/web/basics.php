<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
	global $_GPC, $_W;
	$weid = $_W['uniacid'];  
	$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
	$version = checkvers();
	if ($operation == 'display') {
		$fromid = pdo_fetchall("SELECT uniacid,name FROM " . tablename('account_wechats') . " ORDER BY acid ASC");
		$item = pdo_fetch("SELECT * FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$weid}'");
		if($item['schoolid']){
			$school = pdo_fetch("SELECT id,title,weid FROM " . tablename($this->table_index) . " WHERE id = '{$item['schoolid']}'");		
		}
		if (checksubmit('submit')) {
			if (!empty($item)) {
				$schools = pdo_fetch("SELECT weid FROM " . tablename($this->table_index) . " WHERE id = '{$_GPC['schoolid']}'");
				if($schools['weid'] != $item['fromweid']){
					//message('抱歉,你只能切换同一关联公众号下的学校', $this->createWebUrl('basics', array('op' => 'display')), 'error');
				}
			}			
			$data = array(
				'weid' => $weid,
				'show_list' => trim($_GPC['show_list']),
				'fromweid' => trim($_GPC['fromweid']),
				'schoolid' => trim($_GPC['schoolid']),
				
			);	
			if (!empty($item)) {
				pdo_update($this->table_wxappset, $data, array('id' => $item['id']));
			} else {
				pdo_insert($this->table_wxappset, $data);
			}
			message('操作成功！', $this->createWebUrl('basics', array('op' => 'display')), 'success');
		}
	}
   include $this->template ( 'web/basics' );
?>