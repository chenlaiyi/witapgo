<?php

if (!pdo_fieldexists('lywywl_ztb_store_account', 'rec_storeid')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `rec_storeid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '';");
}
if (!pdo_fieldexists('lywywl_ztb_store_account', 'parent_rec_storeid')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `parent_rec_storeid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '';");
}
if (!pdo_fieldexists('lywywl_ztb_store_account', 'promoter_id')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `promoter_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '';");
}
if (!pdo_fieldexists('lywywl_ztb_store_account', 'parent_promoter_id')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `parent_promoter_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '';");
}
if (!pdo_fieldexists('lywywl_ztb_store_account', 'invite_money')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `invite_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '';");
}
if (!pdo_fieldexists('lywywl_ztb_store_account', 'invite_count')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_store_account') . " ADD COLUMN `invite_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '';");
}

if (!pdo_fieldexists('lywywl_ztb_sys_setmeal', 'invite_rebate_money')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_sys_setmeal') . " ADD COLUMN `invite_rebate_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '';");
}
if (!pdo_fieldexists('lywywl_ztb_sys_setmeal', 'invite_rebate2_money')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_sys_setmeal') . " ADD COLUMN `invite_rebate2_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '';");
}

if (!pdo_tableexists('lywywl_ztb_store_invite')) {
    pdo_query("CREATE TABLE ".tablename('lywywl_ztb_store_invite')." (`id` int(11) unsigned NOT NULL AUTO_INCREMENT,`uniacid` int(11) unsigned NOT NULL DEFAULT '0',`store_id` int(11) unsigned NOT NULL DEFAULT '0',`promoter_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '',`invite_storeid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '',`setmeal_id` int(11) NOT NULL DEFAULT '0' COMMENT '',`money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '',`note` text NOT NULL,`or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '',`status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '',`createtime` int(11) unsigned NOT NULL DEFAULT '0',`deltime` int(11) unsigned NOT NULL DEFAULT '0',PRIMARY KEY (`id`) USING BTREE,KEY `idx_uniacid` (`uniacid`) USING BTREE,KEY `idx_store_id` (`store_id`) USING BTREE,KEY `idx_promoter_id` (`promoter_id`) USING BTREE,KEY `idx_invite_storeid` (`invite_storeid`) USING BTREE,KEY `idx_setmeal_id` (`setmeal_id`) USING BTREE,KEY `idx_or_rebate2` (`or_rebate2`) USING BTREE,KEY `idx_status` (`status`) USING BTREE,KEY `idx_deltime` (`deltime`) USING BTREE) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='';");
}

if (!pdo_tableexists('lywywl_ztb_store_promoter')) {
    pdo_query("CREATE TABLE ".tablename('lywywl_ztb_store_promoter')." (`id` int(11) unsigned NOT NULL AUTO_INCREMENT,`uniacid` int(11) unsigned NOT NULL DEFAULT '0',`store_id` int(11) unsigned NOT NULL DEFAULT '0',`openid` varchar(50) NOT NULL DEFAULT '',`name` varchar(20) NOT NULL DEFAULT '',`headurl` varchar(200) NOT NULL DEFAULT '',`mobile` varchar(20) NOT NULL DEFAULT '',`invite_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '',`invite_count` int(11) unsigned NOT NULL DEFAULT '0',`status` tinyint(1) unsigned NOT NULL DEFAULT '1',`updatetime` int(11) unsigned NOT NULL DEFAULT '0',`createtime` int(11) unsigned NOT NULL DEFAULT '0',`deltime` int(11) unsigned NOT NULL DEFAULT '0',`royalty` int(11) unsigned NOT NULL DEFAULT '100',PRIMARY KEY (`id`) USING BTREE,KEY `idx_uniacid` (`uniacid`) USING BTREE,KEY `idx_store_id` (`store_id`) USING BTREE,KEY `idx_openid` (`openid`) USING BTREE,KEY `idx_status` (`status`) USING BTREE,KEY `idx_deltime` (`deltime`) USING BTREE) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='';");
}

?>