<?php
if (!pdo_tableexists('lywywl_ztb_sys_rategroup')) {  
	pdo_query("CREATE TABLE ".tablename('lywywl_ztb_sys_rategroup')."(`id` int(11) unsigned NOT NULL AUTO_INCREMENT,`uniacid` int(11) unsigned NOT NULL DEFAULT '0',`name` varchar(20) NOT NULL DEFAULT '',`pay_rate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',`recharge_rate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',`status` tinyint(1) unsigned NOT NULL DEFAULT '0',`bak` varchar(500) NOT NULL DEFAULT '',`updatetime` int(11) unsigned NOT NULL DEFAULT '0',`createtime` int(11) unsigned NOT NULL DEFAULT '0',`deltime` int(11) unsigned NOT NULL DEFAULT '0',PRIMARY KEY (`id`) USING BTREE,KEY `idx_uniacid` (`uniacid`) USING BTREE,KEY `idx_status` (`status`) USING BTREE,KEY `idx_deltime` (`deltime`) USING BTREE) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;");
}
if (!pdo_fieldexists('lywywl_ztb_store_account', 'rate_group_id')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `rate_group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '';");
}
?>

