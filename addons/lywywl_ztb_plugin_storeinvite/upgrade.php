<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_invite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `promoter_id` int(11) unsigned NOT NULL DEFAULT '0',
  `invite_storeid` int(11) unsigned NOT NULL DEFAULT '0',
  `setmeal_id` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `note` text NOT NULL,
  `or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_promoter_id` (`promoter_id`) USING BTREE,
  KEY `idx_invite_storeid` (`invite_storeid`) USING BTREE,
  KEY `idx_setmeal_id` (`setmeal_id`) USING BTREE,
  KEY `idx_or_rebate2` (`or_rebate2`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_promoter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `invite_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `invite_count` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `royalty` int(11) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

";
pdo_run($sql);
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
if(!pdo_fieldexists("lywywl_ztb_store_invite", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "promoter_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `promoter_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "invite_storeid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `invite_storeid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "setmeal_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `setmeal_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "or_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_invite", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_invite")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "invite_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `invite_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "invite_count")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `invite_count` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_promoter", "royalty")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_promoter")." ADD `royalty` int(11) unsigned NOT NULL DEFAULT '100';");
}
