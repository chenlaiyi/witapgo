<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_type` (`type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_intmall_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `pic_url` varchar(200) NOT NULL DEFAULT '',
  `is_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_is_index` (`is_index`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_intmall_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `product_id` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_intmall_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `is_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `score` int(11) unsigned NOT NULL DEFAULT '0',
  `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `description` text NOT NULL,
  `thumb_url` varchar(200) NOT NULL DEFAULT '',
  `photos_url` text NOT NULL,
  `content` mediumtext NOT NULL,
  `max_num` int(11) unsigned NOT NULL DEFAULT '0',
  `product_num` int(11) unsigned NOT NULL DEFAULT '0',
  `exchange_num` int(11) unsigned NOT NULL DEFAULT '0',
  `click_num` int(11) unsigned NOT NULL DEFAULT '0',
  `admins` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_class_id` (`class_id`) USING BTREE,
  KEY `idx_is_index` (`is_index`) USING BTREE,
  KEY `idx_is_fedex` (`is_fedex`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_title` (`title`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_marketing_team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `invite_code` varchar(20) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_marketing_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `is_manager` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `join_num` int(11) unsigned NOT NULL DEFAULT '0',
  `repost_num` int(11) unsigned NOT NULL DEFAULT '0',
  `get_num` int(11) unsigned NOT NULL DEFAULT '0',
  `buy_num` int(11) unsigned NOT NULL DEFAULT '0',
  `marketing_num` int(11) unsigned NOT NULL DEFAULT '0',
  `fish_code_num` int(11) unsigned NOT NULL DEFAULT '0',
  `praise_click_num` int(11) unsigned NOT NULL DEFAULT '0',
  `share_view_num` int(11) unsigned NOT NULL DEFAULT '0',
  `cut_help_num` int(11) unsigned NOT NULL DEFAULT '0',
  `click_num` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_team_id` (`team_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='活动营销专员';


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_10second` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `winner_types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `winner_starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `winner_endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `set_interval` int(11) unsigned NOT NULL DEFAULT '1',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_join` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_winners` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `appad_types` text NOT NULL,
  `appad_password` text NOT NULL,
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_10second_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `times` int(11) unsigned NOT NULL DEFAULT '0',
  `is_share` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `share_openid` varchar(50) NOT NULL DEFAULT '',
  `share_nickname` varchar(100) NOT NULL DEFAULT '',
  `share_headurl` varchar(200) NOT NULL DEFAULT '',
  `is_winer` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `share_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_9box` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `tmp_id` int(11) unsigned NOT NULL DEFAULT '0',
  `token` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `pic_url` varchar(200) NOT NULL DEFAULT '',
  `start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_case` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `join_num` int(11) unsigned NOT NULL DEFAULT '0',
  `repost_num` int(11) unsigned NOT NULL DEFAULT '0',
  `get_num` int(11) unsigned NOT NULL DEFAULT '0',
  `buy_num` int(11) unsigned NOT NULL DEFAULT '0',
  `click_num` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_join_gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bogus_join_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_repost_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_get_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_buy_gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bogus_buy_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_click_num` int(11) unsigned NOT NULL DEFAULT '0',
  `check_status` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `check_note` text NOT NULL,
  `tel` varchar(20) NOT NULL DEFAULT '',
  `batches_join_code` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_tmp_id` (`tmp_id`) USING BTREE,
  KEY `idx_token` (`token`) USING BTREE,
  KEY `idx_title` (`title`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_is_case` (`is_case`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_activity_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tmp_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_check_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shop_name` varchar(100) NOT NULL,
  `shop_address` varchar(150) NOT NULL,
  `shop_tel` varchar(20) NOT NULL,
  `other_store_id` int(11) NOT NULL DEFAULT '0',
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=547 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_bag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `timer` int(11) unsigned NOT NULL DEFAULT '0',
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_collage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `group_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `group_num` int(11) unsigned NOT NULL DEFAULT '0',
  `open_num` int(11) unsigned NOT NULL DEFAULT '0',
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rebate_node` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `models` int(11) unsigned NOT NULL DEFAULT '1',
  `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `models_qr_content` mediumtext NOT NULL,
  `models_link` varchar(255) NOT NULL DEFAULT '',
  `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `expires_day` int(11) unsigned NOT NULL DEFAULT '0',
  `expires_time` int(11) unsigned NOT NULL DEFAULT '0',
  `is_offline_pay` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_collage_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `invite_id` int(11) unsigned NOT NULL DEFAULT '0',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `is_heads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_number` varchar(50) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `joins` int(11) unsigned NOT NULL,
  `register_data` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_joins` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_pay` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_direct_pay` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `ids_pid` (`pid`) USING BTREE,
  KEY `ids_is_heads` (`is_heads`) USING BTREE,
  KEY `ids_status` (`status`) USING BTREE,
  KEY `idx_invite_id` (`invite_id`) USING BTREE,
  KEY `idx_is_settlement` (`is_settlement`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_cut` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `base_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `total_num` int(11) unsigned NOT NULL DEFAULT '0',
  `goods_num` int(11) unsigned NOT NULL DEFAULT '0',
  `is_base_price_pay` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cut_rule` text NOT NULL,
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `help_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `help_register_field` text NOT NULL,
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `models` int(11) unsigned NOT NULL DEFAULT '1',
  `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `models_qr_content` mediumtext NOT NULL,
  `models_link` varchar(255) NOT NULL DEFAULT '',
  `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `expires_day` int(11) unsigned NOT NULL DEFAULT '0',
  `expires_time` int(11) unsigned NOT NULL DEFAULT '0',
  `is_offline_pay` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cutmaxnum` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_cut_help` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `join_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `area` varchar(50) NOT NULL DEFAULT '',
  `join_openid` varchar(50) NOT NULL,
  `join_nickname` varchar(100) NOT NULL,
  `join_headurl` varchar(200) NOT NULL,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `cut_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `register_data` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `ids_join_id` (`join_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_cut_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `helps` int(11) unsigned NOT NULL DEFAULT '0',
  `invite` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `register_data` text NOT NULL,
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `ids_status` (`status`) USING BTREE,
  KEY `ids_deltime` (`deltime`),
  KEY `idx_openid` (`openid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_eggs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_enroll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_online_pay` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `limit_project_num` int(11) unsigned NOT NULL DEFAULT '1',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_joinlog` int(11) unsigned NOT NULL DEFAULT '1',
  `is_show_buylog` int(11) unsigned NOT NULL DEFAULT '1',
  `is_repeat_buy` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_enroll_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `invite` int(11) NOT NULL,
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=398 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_enroll_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `pic_url` varchar(200) NOT NULL DEFAULT '',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_open_stock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `stock` int(11) unsigned NOT NULL DEFAULT '0',
  `buy_num` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_fish` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `winer_code` text NOT NULL,
  `winer_num` int(11) unsigned NOT NULL DEFAULT '1',
  `max_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `is_show_join` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `is_sms_send` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_fish_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `writecode` varchar(10) NOT NULL DEFAULT '',
  `is_share` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `share_openid` varchar(50) NOT NULL DEFAULT '',
  `share_nickname` varchar(100) NOT NULL DEFAULT '',
  `share_headurl` varchar(200) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_writecode` (`writecode`) USING BTREE,
  KEY `idx_is_share` (`is_share`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_fish_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `share_openid` varchar(50) NOT NULL DEFAULT '',
  `share_nickname` varchar(100) NOT NULL DEFAULT '',
  `share_headurl` varchar(200) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_fish_store` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `industry_id` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `prize` varchar(255) NOT NULL DEFAULT '',
  `logo_url` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `banner_url` text NOT NULL,
  `store_map_list` text NOT NULL,
  `openid` text NOT NULL,
  `writeoff_content` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auditing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cause` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_auditing` (`auditing`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_invite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `invite_openid` varchar(50) NOT NULL,
  `draw_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=358 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_ladder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `heads_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `ladder_price` text NOT NULL,
  `open_num` int(11) unsigned NOT NULL DEFAULT '0',
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rebate_node` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_ladder_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `invite_id` int(11) unsigned NOT NULL DEFAULT '0',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `is_heads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_number` varchar(50) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `joins` int(11) unsigned NOT NULL,
  `register_data` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_joins` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_pid` (`pid`) USING BTREE,
  KEY `ids_is_heads` (`is_heads`) USING BTREE,
  KEY `ids_status` (`status`) USING BTREE,
  KEY `idx_invite_id` (`invite_id`) USING BTREE,
  KEY `idx_is_settlement` (`is_settlement`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_opencard` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_poker` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_praise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `winer_num` int(11) unsigned NOT NULL DEFAULT '1',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `limit_clicks` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_praise_click` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `praise_openid` varchar(50) NOT NULL DEFAULT '',
  `praise_nickname` varchar(100) NOT NULL DEFAULT '',
  `praise_headurl` varchar(200) NOT NULL DEFAULT '',
  `ip` varchar(100) NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_praise_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `praise` int(11) NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_praise` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_prize` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) NOT NULL,
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `enroll_project_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '报名拓客活动项目id',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `number` int(11) unsigned NOT NULL DEFAULT '0',
  `surplus` int(11) NOT NULL,
  `odds` int(11) unsigned NOT NULL DEFAULT '0',
  `create_types` tinyint(1) NOT NULL,
  `score` varchar(255) NOT NULL DEFAULT '',
  `sys` varchar(255) NOT NULL DEFAULT '',
  `money` varchar(255) NOT NULL DEFAULT '',
  `card_id` varchar(255) NOT NULL DEFAULT '',
  `picurl` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `limittypes` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limitnum` int(11) unsigned NOT NULL DEFAULT '0',
  `writeoff_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `content` mediumtext NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL,
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `place` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `voice_store_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_voice_store_id` (`voice_store_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_scratch` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_shake` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `winer_num` int(11) unsigned NOT NULL DEFAULT '1',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `share_content` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `vsit_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vsit_url` varchar(200) NOT NULL DEFAULT '',
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '1',
  `limit_clicks` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `recurring_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_share_view` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `view_openid` varchar(50) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_effective` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_soliciting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `is_open_stock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `stock` int(11) unsigned NOT NULL DEFAULT '0',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `models` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `models_qr_content` mediumtext NOT NULL,
  `models_link` varchar(255) NOT NULL DEFAULT '',
  `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `expires_day` int(11) unsigned NOT NULL DEFAULT '0',
  `expires_time` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_soliciting_money` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `soliciting_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `prize_pool` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `single_prize_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `single_max_prize` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `day_max_prize` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_soliciting_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `invite` int(11) NOT NULL,
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=323 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_survey` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `force_share` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `or_open_invite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_survey_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `answer_data` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `share_openid` varchar(50) NOT NULL DEFAULT '',
  `share_nickname` varchar(100) NOT NULL DEFAULT '',
  `share_headurl` varchar(200) NOT NULL DEFAULT '',
  `invite` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_survey_option` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `question_id` int(11) unsigned NOT NULL DEFAULT '0',
  `content` varchar(200) NOT NULL DEFAULT '',
  `is_custom` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `select_num` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=304 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_survey_question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_tiger` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_union` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_card_get` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_single_store` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_pay_enter_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enter_group_desc` varchar(200) NOT NULL DEFAULT '',
  `enter_group_qrcodeurl` varchar(200) NOT NULL DEFAULT '',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_union_card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `u_store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `writeoff_num` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `use_limit` varchar(50) NOT NULL DEFAULT '',
  `time_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `time_day` int(11) unsigned NOT NULL DEFAULT '0',
  `time_end` int(11) unsigned NOT NULL DEFAULT '0',
  `pic_url` varchar(255) NOT NULL DEFAULT '',
  `is_open_stock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `stock` int(11) unsigned NOT NULL DEFAULT '0',
  `get_num` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `time_begin` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_u_store_id` (`u_store_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_union_cardbag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `u_store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `card_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `use_num` int(11) unsigned NOT NULL DEFAULT '0',
  `writeoff_num` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `use_limit` varchar(50) NOT NULL DEFAULT '',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0',
  `pic_url` varchar(255) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `begin_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_u_store_id` (`u_store_id`) USING BTREE,
  KEY `idx_card_id` (`card_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_union_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `invite` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `register_data` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_union_store` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `industry_id` int(11) unsigned NOT NULL DEFAULT '0',
  `logo_url` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `banner_url` text NOT NULL,
  `store_map_list` text NOT NULL,
  `openid` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auditing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cause` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_auditing` (`auditing`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_union_writeoff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `u_store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `card_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_card_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `admins` varchar(50) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_u_store_id` (`u_store_id`) USING BTREE,
  KEY `idx_card_id` (`card_id`) USING BTREE,
  KEY `idx_user_card_id` (`user_card_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_vote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_video` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_signup` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `signup_start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `signup_end_time` int(11) unsigned NOT NULL DEFAULT '0',
  `gift_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `store_map_list` text NOT NULL,
  `ranking_count` int(11) unsigned NOT NULL DEFAULT '10',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `is_show_declaration` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_fans` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_click` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_success_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `success_ads_content` text NOT NULL,
  `join_show_types` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `notice` varchar(250) NOT NULL,
  `is_verification` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `toady_player_get_click` int(11) unsigned NOT NULL DEFAULT '0',
  `user_give_max_click` int(11) unsigned NOT NULL DEFAULT '0',
  `max_click_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `max_click` int(11) unsigned NOT NULL DEFAULT '0',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `attr_register_field` text NOT NULL,
  `player_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `player_register_field` text NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `group_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `player_get_click` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_vote_blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_vote_click` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `player_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_player_id` (`player_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_vote_fans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `player_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `get_num` int(11) unsigned NOT NULL DEFAULT '0',
  `gift_num` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_player_id` (`player_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_vote_gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `player_id` int(11) unsigned NOT NULL DEFAULT '0',
  `gift_id` int(11) unsigned NOT NULL DEFAULT '0',
  `num` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `pay_number` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `icon_url` varchar(200) NOT NULL DEFAULT '',
  `cartoon_url` varchar(200) NOT NULL DEFAULT '',
  `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `vote` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_player_id` (`player_id`) USING BTREE,
  KEY `idx_gift_id` (`gift_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_pay_number` (`pay_number`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_vote_player` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `number` varchar(20) NOT NULL DEFAULT '',
  `attr_data` text NOT NULL,
  `register_data` text NOT NULL,
  `declaration` varchar(200) NOT NULL,
  `pic_url` varchar(200) NOT NULL DEFAULT '',
  `banner_url` text NOT NULL,
  `video_url` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `openid` text NOT NULL,
  `get_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_get_num` int(11) NOT NULL DEFAULT '0',
  `buy_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_buy_num` int(11) NOT NULL DEFAULT '0',
  `repost_num` int(11) unsigned NOT NULL DEFAULT '0',
  `click_num` int(11) unsigned NOT NULL DEFAULT '0',
  `gift_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `gift_num` int(11) unsigned NOT NULL DEFAULT '0',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auditing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cause` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `fulltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_group_id` (`group_id`) USING BTREE,
  KEY `idx_number` (`number`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_auditing` (`auditing`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_wheel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `models` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost_score` int(11) unsigned NOT NULL DEFAULT '0',
  `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_winners` tinyint(1) NOT NULL,
  `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_field` text NOT NULL,
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `store_map_list` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `max_draw` int(11) NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_whole` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `group_num` int(11) unsigned NOT NULL DEFAULT '0',
  `open_num` int(11) unsigned NOT NULL DEFAULT '0',
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `store_map_list` text NOT NULL,
  `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(200) NOT NULL DEFAULT '',
  `multi_banner_url` text NOT NULL,
  `bg_color` varchar(20) NOT NULL DEFAULT '',
  `audio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `audio_url` varchar(200) NOT NULL DEFAULT '',
  `area_limit` varchar(255) NOT NULL DEFAULT '',
  `share_title` varchar(200) NOT NULL DEFAULT '',
  `share_desc` varchar(200) NOT NULL DEFAULT '',
  `share_thumb` varchar(200) NOT NULL DEFAULT '',
  `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `buy_register_field` text NOT NULL,
  `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `join_register_field` text NOT NULL,
  `buy_is_push` tinyint(1) NOT NULL DEFAULT '0',
  `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '',
  `qr_url` varchar(200) NOT NULL DEFAULT '',
  `qr_content` text NOT NULL,
  `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ads_url` varchar(200) NOT NULL DEFAULT '',
  `ads_link` varchar(255) NOT NULL DEFAULT '',
  `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `effect_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `models` int(11) unsigned NOT NULL DEFAULT '1',
  `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `models_qr_content` mediumtext NOT NULL,
  `models_link` varchar(255) NOT NULL DEFAULT '',
  `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `expires_day` int(11) unsigned NOT NULL DEFAULT '0',
  `expires_time` int(11) unsigned NOT NULL DEFAULT '0',
  `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `appad_types` text NOT NULL,
  `appad_password` text NOT NULL,
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_whole_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `invite_id` int(11) unsigned NOT NULL DEFAULT '0',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `is_heads` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_number` varchar(50) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `ids_pid` (`pid`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `ids_is_heads` (`is_heads`) USING BTREE,
  KEY `ids_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_is_settlement` (`is_settlement`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_obj_whole_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode_url` varchar(200) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `joins` int(11) unsigned NOT NULL,
  `bogus_joins` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `ids_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_order_intmall` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ordernumber` varchar(50) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `total_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `score` int(11) unsigned NOT NULL DEFAULT '0',
  `sys_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `note` text NOT NULL,
  `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fedex_id` int(11) unsigned NOT NULL DEFAULT '0',
  `fedex_name` varchar(20) NOT NULL DEFAULT '',
  `fedex_code` varchar(20) NOT NULL DEFAULT '',
  `fedex_number` varchar(50) NOT NULL DEFAULT '',
  `address_id` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `province` varchar(30) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `county` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `product_id` int(11) unsigned NOT NULL DEFAULT '0',
  `product_title` varchar(100) NOT NULL DEFAULT '',
  `product_thumb` varchar(200) NOT NULL DEFAULT '',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `writecode` varchar(10) NOT NULL DEFAULT '',
  `admins` varchar(50) NOT NULL DEFAULT '',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_ordernumber` (`ordernumber`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_writecode` (`writecode`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_is_settlement` (`is_settlement`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_order_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL,
  `ordernumber` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_ordernumber` (`ordernumber`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_order_obj` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL,
  `ordernumber` varchar(50) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `activity_types` int(11) NOT NULL,
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `detail_id` int(11) unsigned NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `fedex_id` int(11) unsigned NOT NULL DEFAULT '0',
  `fedex_name` varchar(20) NOT NULL DEFAULT '',
  `fedex_code` varchar(20) NOT NULL DEFAULT '',
  `fedex_number` varchar(50) NOT NULL DEFAULT '',
  `address_id` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `province` varchar(30) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `county` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `product_title` varchar(100) NOT NULL DEFAULT '',
  `product_thumb` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_ordernumber` (`ordernumber`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `is_vip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `industry_id` int(11) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `province_code` varchar(6) NOT NULL DEFAULT '',
  `city_code` varchar(6) NOT NULL DEFAULT '',
  `county_code` varchar(6) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `salt` varchar(10) NOT NULL,
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `sms` int(11) unsigned NOT NULL DEFAULT '0',
  `is_show_power` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `loginnum` int(11) unsigned NOT NULL DEFAULT '0',
  `logintime` int(11) unsigned NOT NULL DEFAULT '0',
  `loginip` varchar(200) NOT NULL,
  `remark` varchar(1000) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `default_store_map` text NOT NULL,
  `create_num` int(11) NOT NULL DEFAULT '-1',
  `zucp_ext` varchar(6) NOT NULL,
  `is_invite` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_mobile` (`mobile`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_bill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `detail_id` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `writeoff_num` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `use_limit` varchar(50) NOT NULL DEFAULT '',
  `time_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `time_day` int(11) unsigned NOT NULL DEFAULT '0',
  `time_end` int(11) unsigned NOT NULL DEFAULT '0',
  `pic_url` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_card_writeoff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `card_id` int(11) unsigned NOT NULL DEFAULT '0',
  `draw_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `admins` varchar(50) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `voice_store_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_card_id` (`card_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_voice_store_id` (`voice_store_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_refund` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `withdrawal` varchar(200) NOT NULL DEFAULT '',
  `withdrawal_type` int(11) unsigned NOT NULL DEFAULT '0',
  `withdrawal_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_renew` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paynumber` varchar(50) NOT NULL DEFAULT '',
  `admins` varchar(255) NOT NULL,
  `start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0',
  `day` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `create_num` int(11) NOT NULL DEFAULT '-1',
  `setmeal_id` int(11) unsigned NOT NULL DEFAULT '0',
  `setmeal_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_paynumber` (`paynumber`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_store_staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT '',
  `role` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `power` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(1000) NOT NULL DEFAULT '',
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(20) NOT NULL DEFAULT '',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_uid` (`uid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lvl` tinyint(4) NOT NULL,
  `parent_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `code` (`code`) USING BTREE,
  KEY `lvl` (`lvl`,`parent_code`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3687 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_audio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `audiourl` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `text_content` text NOT NULL,
  `per` int(11) unsigned NOT NULL DEFAULT '0',
  `spd` int(11) unsigned NOT NULL DEFAULT '5',
  `pit` int(11) unsigned NOT NULL DEFAULT '5',
  `vol` int(11) unsigned NOT NULL DEFAULT '5',
  `is_diy` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_class_id` (`class_id`),
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_audio_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_complain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(60) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_effect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `pic_url` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_class_id` (`class_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_effect_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_faq` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_class_id` (`class_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_faq_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `pic_url` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_fedex` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `code` varchar(50) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_festival` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `icon_url` varchar(200) NOT NULL DEFAULT '',
  `cartoon_url` varchar(200) NOT NULL DEFAULT '',
  `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `vote` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_class_id` (`class_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_gift_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_industry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_invest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(60) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(200) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_obj` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `pay_method` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `terminal` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `paynumber` varchar(50) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `mymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_paynumber` (`paynumber`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `config` mediumtext NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_prize_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) NOT NULL,
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `prize_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL,
  `before` text NOT NULL,
  `after` text NOT NULL,
  `ip` varchar(100) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_prize_id` (`prize_id`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_reissue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `draw_id` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `openid` varchar(60) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `desc` varchar(100) NOT NULL DEFAULT '',
  `is_store_sell` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_is_store_sell` (`is_store_sell`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `qrcode` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_setmeal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `service_id` int(11) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `day` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `create_num` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_slide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `types` tinyint(1) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `pic_url` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_sms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_mobile` (`mobile`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_tmp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `obj_types` text NOT NULL,
  `festival` text NOT NULL,
  `industry` text NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `thumb_url` varchar(200) NOT NULL DEFAULT '',
  `resource` varchar(200) NOT NULL DEFAULT '',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `baner_html` text NOT NULL,
  `body_style` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '4000',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `intro` text NOT NULL,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_sys_tmp_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `tmp_id` int(11) unsigned NOT NULL DEFAULT '0',
  `use_num` int(11) unsigned NOT NULL DEFAULT '0',
  `bogus_num` int(11) unsigned NOT NULL DEFAULT '0',
  `token` varchar(50) NOT NULL DEFAULT '',
  `token_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_tmp_id` (`tmp_id`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=350 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(60) NOT NULL DEFAULT '',
  `oauthid` varchar(60) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `area` varchar(100) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `score` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4004 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `province` varchar(30) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `county` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_is_default` (`is_default`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_bill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `detail_id` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(60) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `area` varchar(100) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_draw` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_buy_types` tinyint(3) NOT NULL DEFAULT '0',
  `prize_id` int(11) unsigned NOT NULL DEFAULT '0',
  `writecode` varchar(10) NOT NULL DEFAULT '',
  `types` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL DEFAULT '',
  `score` int(11) unsigned NOT NULL DEFAULT '0',
  `sys` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `card_id` int(11) unsigned NOT NULL DEFAULT '0',
  `card_use_num` int(11) unsigned NOT NULL DEFAULT '0',
  `card_writeoff_num` int(11) unsigned NOT NULL DEFAULT '0',
  `card_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `card_use_limit` varchar(50) NOT NULL DEFAULT '',
  `card_end_time` int(11) unsigned NOT NULL DEFAULT '0',
  `card_pic_url` varchar(255) NOT NULL DEFAULT '',
  `pay_openid` varchar(50) NOT NULL DEFAULT '',
  `pay_nickname` varchar(100) NOT NULL DEFAULT '',
  `pay_headurl` varchar(200) NOT NULL DEFAULT '',
  `pay_number` varchar(50) NOT NULL DEFAULT '',
  `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `mymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `prize_pic_url` varchar(255) NOT NULL DEFAULT '',
  `writeoff_types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordernumber` varchar(50) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `admins` varchar(50) NOT NULL DEFAULT '',
  `register_data` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  `project_id` int(11) unsigned NOT NULL DEFAULT '0',
  `or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `expires_time` int(11) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(100) NOT NULL DEFAULT '',
  `group_qrcode` varchar(255) NOT NULL DEFAULT '',
  `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_receive_types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `voice_store_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_origin_buy_types` (`origin_buy_types`) USING BTREE,
  KEY `idx_writecode` (`writecode`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_pay_openid` (`pay_openid`) USING BTREE,
  KEY `idx_pay_number` (`paymoney`) USING BTREE,
  KEY `idx_writeoff_types` (`writeoff_types`) USING BTREE,
  KEY `idx_ordernumber` (`ordernumber`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE,
  KEY `idx_project_id` (`project_id`) USING BTREE,
  KEY `idx_is_settlement` (`is_settlement`) USING BTREE,
  KEY `idx_is_receive_types` (`is_receive_types`) USING BTREE,
  KEY `idx_voice_store_id` (`voice_store_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2942 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_refund` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_score` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `types` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `activity_types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `detail_id` int(11) unsigned NOT NULL DEFAULT '0',
  `score` int(11) unsigned NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_types` (`types`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_lywywl_ztb_user_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_types` int(11) unsigned NOT NULL DEFAULT '0',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headurl` varchar(200) NOT NULL DEFAULT '',
  `ip` varchar(100) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `deltime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_store_id` (`store_id`) USING BTREE,
  KEY `idx_activity_types` (`activity_types`) USING BTREE,
  KEY `idx_activity_id` (`activity_id`) USING BTREE,
  KEY `idx_origin_team_id` (`origin_team_id`) USING BTREE,
  KEY `idx_origin_id` (`origin_id`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_deltime` (`deltime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=867 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

";
pdo_run($sql);
if(!pdo_fieldexists("lywywl_ztb_attachment", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_attachment", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_attachment", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_attachment", "filename")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `filename` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_attachment", "attachment")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `attachment` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_attachment", "type")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `type` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_attachment", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_attachment")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `pic_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "is_index")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `is_index` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_class", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_class")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "product_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `product_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_collect", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_collect")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "class_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `class_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "is_index")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `is_index` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "paymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "description")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `description` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "thumb_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `thumb_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "photos_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `photos_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "max_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `max_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "product_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `product_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "exchange_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `exchange_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "click_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `click_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "admins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `admins` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_intmall_product", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_intmall_product")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "invite_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `invite_code` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_team", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_team")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "is_manager")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `is_manager` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "join_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `join_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "repost_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `repost_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `get_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "buy_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `buy_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "marketing_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `marketing_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "fish_code_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `fish_code_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "praise_click_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `praise_click_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "share_view_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `share_view_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "cut_help_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `cut_help_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "click_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `click_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_marketing_user", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_marketing_user")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "winner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `winner_types` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "winner_starttime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `winner_starttime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "winner_endtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `winner_endtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "set_interval")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `set_interval` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_show_join")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_show_join` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_show_winners` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "is_open_appad")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "appad_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `appad_types` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "appad_password")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `appad_password` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "times")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `times` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "is_share")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `is_share` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "share_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `share_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "share_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `share_nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "share_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `share_headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "is_winer")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `is_winer` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "share_status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `share_status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_10second_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_10second_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_9box", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_9box")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "tmp_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `tmp_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "token")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `token` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `pic_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `start_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `end_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "is_case")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `is_case` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "join_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `join_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "repost_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `repost_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `get_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "buy_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `buy_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "click_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `click_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_join_gender")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_join_gender` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_join_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_join_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_repost_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_repost_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_get_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_buy_gender")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_buy_gender` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_buy_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_buy_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "bogus_click_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `bogus_click_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "check_status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `check_status` tinyint(1) unsigned NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "check_note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `check_note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "tel")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `tel` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity", "batches_join_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity")." ADD `batches_join_code` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "tmp_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `tmp_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "activity_check_status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `activity_check_status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "activity_status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `activity_status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "shop_name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `shop_name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "shop_address")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `shop_address` varchar(150) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "shop_tel")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `shop_tel` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "other_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `other_store_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "lat")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `lat` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "lng")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `lng` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `start_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `end_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_activity_location", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_activity_location")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `banner_types` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "timer")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `timer` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `is_show_winners` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_bag", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_bag")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "front_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "cost_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "group_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `group_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "group_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `group_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "open_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `open_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "rebate_node")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `rebate_node` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `models` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "models_qr_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "models_qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `models_qr_content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "models_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `models_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "expires_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "expires_day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `expires_day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "expires_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `expires_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_offline_pay")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_offline_pay` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "invite_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `invite_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "pid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `pid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "is_heads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `is_heads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "front_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "pay_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `pay_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "joins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `joins` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "bogus_joins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `bogus_joins` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "is_pay")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `is_pay` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "is_direct_pay")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `is_direct_pay` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_collage_join", "is_settlement")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_collage_join")." ADD `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "cost_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "base_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `base_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "total_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `total_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "goods_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `goods_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_base_price_pay")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_base_price_pay` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "cut_rule")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `cut_rule` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "help_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `help_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "help_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `help_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `models` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "models_qr_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "models_qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `models_qr_content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "models_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `models_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "expires_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "expires_day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `expires_day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "expires_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `expires_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_offline_pay")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_offline_pay` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "cutmaxnum")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `cutmaxnum` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "join_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `join_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "sex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `sex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "area")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `area` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "join_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `join_openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "join_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `join_nickname` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "join_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `join_headurl` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "ip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `ip` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "cut_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `cut_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_help", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_help")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "pid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `pid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "helps")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `helps` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "pay_status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "bogus_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_cut_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_cut_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_eggs", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_eggs")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_online_pay")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_online_pay` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "limit_project_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `limit_project_num` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_show_joinlog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_show_joinlog` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_show_buylog` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_repeat_buy")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_repeat_buy` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `invite` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "bogus_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `pic_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "is_open_stock")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `is_open_stock` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "stock")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `stock` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "buy_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `buy_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_enroll_project", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_enroll_project")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "winer_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `winer_code` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "winer_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `winer_num` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "max_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `max_invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "is_show_join")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `is_show_join` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "is_sms_send")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `is_sms_send` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "writecode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `writecode` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "is_share")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `is_share` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "share_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `share_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "share_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `share_nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "share_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `share_headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_code", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_code")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "share_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `share_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "share_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `share_nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "share_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `share_headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "tel")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `tel` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "industry_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `industry_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "prize")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `prize` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "logo_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `logo_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `openid` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "writeoff_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `writeoff_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "auditing")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `auditing` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "cause")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `cause` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_fish_store", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_fish_store")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "invite_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `invite_openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "draw_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `draw_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `status` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_invite", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_invite")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "front_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "cost_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "heads_discount")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `heads_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "ladder_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `ladder_price` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "open_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `open_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "rebate_node")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `rebate_node` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "invite_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `invite_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "pid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `pid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "is_heads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `is_heads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "front_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "pay_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `pay_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "joins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `joins` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "bogus_joins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `bogus_joins` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_ladder_join", "is_settlement")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_ladder_join")." ADD `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `activity_id` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_opencard", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_opencard")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_poker", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_poker")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "winer_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `winer_num` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `is_sms` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise", "limit_clicks")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise")." ADD `limit_clicks` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "praise_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `praise_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "praise_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `praise_nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "praise_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `praise_headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "ip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `ip` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_click", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_click")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "praise")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `praise` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_praise_join", "bogus_praise")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_praise_join")." ADD `bogus_praise` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `activity_types` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "enroll_project_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `enroll_project_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `name` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "icon")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `icon` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `number` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "surplus")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `surplus` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "odds")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `odds` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "create_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `create_types` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `score` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "sys")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `sys` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `money` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `card_id` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "picurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `picurl` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "limittypes")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `limittypes` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "limitnum")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `limitnum` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "writeoff_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `writeoff_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "or_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "place")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `place` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_prize", "voice_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_prize")." ADD `voice_store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_scratch", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_scratch")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_shake", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_shake")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `models` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "winer_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `winer_num` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "share_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `share_content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "vsit_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `vsit_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "vsit_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `vsit_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "limit_clicks")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `limit_clicks` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share", "recurring_status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share")." ADD `recurring_status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "view_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `view_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_share_view", "is_effective")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_share_view")." ADD `is_effective` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_open_stock")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_open_stock` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "stock")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `stock` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `models` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "models_qr_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "models_qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `models_qr_content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "models_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `models_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "expires_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "expires_day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `expires_day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "expires_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `expires_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_soliciting_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_soliciting_money` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "soliciting_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `soliciting_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "prize_pool")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `prize_pool` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "single_prize_type")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `single_prize_type` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "single_max_prize")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `single_max_prize` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "day_max_prize")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `day_max_prize` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `invite` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "bogus_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_soliciting_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_soliciting_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "force_share")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `force_share` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `is_show_winners` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "or_open_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `or_open_invite` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "answer_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `answer_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "share_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `share_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "share_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `share_nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "share_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `share_headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "bogus_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "question_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `question_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `content` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "is_custom")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `is_custom` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "select_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `select_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_option", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_option")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_survey_question", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_survey_question")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_tiger", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_tiger")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_card_get")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_card_get` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_single_store")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_single_store` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_pay_enter_group")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_pay_enter_group` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "enter_group_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `enter_group_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "enter_group_qrcodeurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `enter_group_qrcodeurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "u_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `u_store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "writeoff_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `writeoff_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "pay_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `pay_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "use_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `use_limit` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "time_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `time_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "time_day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `time_day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "time_end")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `time_end` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `pic_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "is_open_stock")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `is_open_stock` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "stock")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `stock` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `get_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_card", "time_begin")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_card")." ADD `time_begin` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "u_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `u_store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `card_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "use_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `use_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "writeoff_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `writeoff_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "pay_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `pay_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "use_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `use_limit` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `end_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `pic_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_cardbag", "begin_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_cardbag")." ADD `begin_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "bogus_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `bogus_invite` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "tel")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `tel` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "industry_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `industry_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "logo_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `logo_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `openid` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "auditing")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `auditing` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "cause")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `cause` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_store", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_store")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "u_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `u_store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `card_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "user_card_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `user_card_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "admins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `admins` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_union_writeoff", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_union_writeoff")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_video")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_video` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_signup")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_signup` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "signup_start_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `signup_start_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "signup_end_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `signup_end_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "gift_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `gift_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "ranking_count")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `ranking_count` int(11) unsigned NOT NULL DEFAULT '10';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_show_declaration")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_show_declaration` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_show_fans")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_show_fans` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_show_click")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_show_click` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_show_success_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_show_success_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "success_ads_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `success_ads_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "join_show_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `join_show_types` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "notice")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `notice` varchar(250) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_verification")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_verification` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "toady_player_get_click")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `toady_player_get_click` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "user_give_max_click")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `user_give_max_click` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "max_click_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `max_click_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "max_click")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `max_click` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "attr_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `attr_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "player_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `player_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "player_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `player_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "group_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `group_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote", "player_get_click")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote")." ADD `player_get_click` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_blacklist", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_blacklist")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "player_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `player_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_click", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_click")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "player_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `player_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `get_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "gift_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `gift_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_fans", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_fans")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "player_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `player_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "gift_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `gift_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "pay_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `pay_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "icon_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `icon_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "cartoon_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `cartoon_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "paymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "endmoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "vote")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `vote` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_gift", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_gift")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "group_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `group_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `number` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "attr_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `attr_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "declaration")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `declaration` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `pic_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "video_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `video_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `openid` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `get_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "bogus_get_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `bogus_get_num` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "buy_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `buy_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "bogus_buy_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `bogus_buy_num` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "repost_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `repost_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "click_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `click_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "gift_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `gift_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "gift_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `gift_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "auditing")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `auditing` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "cause")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `cause` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_vote_player", "fulltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_vote_player")." ADD `fulltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `models` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "cost_score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `cost_score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "get_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `get_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "is_invite_friend")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `is_invite_friend` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "is_show_winners")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `is_show_winners` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `is_register` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "max_draw")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `max_draw` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_wheel", "invite_limit_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_wheel")." ADD `invite_limit_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "front_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "cost_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "group_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `group_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "open_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `open_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "store_map_list")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `store_map_list` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "banner_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `banner_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `banner_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "multi_banner_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `multi_banner_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "bg_color")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `bg_color` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "audio_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `audio_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "audio_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `audio_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "area_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `area_limit` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `share_title` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "share_desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `share_desc` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "share_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `share_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "buy_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `buy_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "buy_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `buy_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "join_is_register")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `join_is_register` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "join_register_field")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `join_register_field` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "buy_is_push")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `buy_is_push` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "buy_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `buy_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "buy_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `buy_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "draw_is_sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `draw_is_sms` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "draw_sms_tmp")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `draw_sms_tmp` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "qr_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `qr_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `qr_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_show_ads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_show_ads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "ads_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `ads_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "ads_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `ads_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "show_ads_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `show_ads_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "effect_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `effect_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_show_ranking")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_show_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_show_map` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_show_buylog")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_show_buylog` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "models")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `models` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "models_qr_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `models_qr_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "models_qr_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `models_qr_content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "models_link")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `models_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "expires_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `expires_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "expires_day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `expires_day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "expires_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `expires_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_open_appad")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "appad_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `appad_types` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "appad_password")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `appad_password` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "or_open_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `or_open_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole", "is_show_join_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole")." ADD `is_show_join_title` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "invite_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `invite_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "pid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `pid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "is_heads")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `is_heads` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "front_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `front_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "pay_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `pay_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "is_settlement")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_group", "endmoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_group")." ADD `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "qrcode_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `qrcode_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "joins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `joins` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "bogus_joins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `bogus_joins` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "bogus_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `bogus_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_obj_whole_join", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_obj_whole_join")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "ordernumber")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `ordernumber` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "total_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `total_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "sys_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `sys_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "pay_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `pay_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "endmoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "is_fedex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `is_fedex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "fedex_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `fedex_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "fedex_name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `fedex_name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "fedex_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `fedex_code` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "fedex_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `fedex_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "address_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `address_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "username")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `username` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "province")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `province` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "city")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `city` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "county")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `county` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "address")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `address` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "postcode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `postcode` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "product_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `product_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "product_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `product_title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "product_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `product_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "market_price")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "writecode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `writecode` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "admins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `admins` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_intmall", "is_settlement")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_intmall")." ADD `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `types` tinyint(1) unsigned NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "ordernumber")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `ordernumber` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_log", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_log")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `store_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "ordernumber")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `ordernumber` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `activity_types` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "detail_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `detail_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "fedex_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `fedex_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "fedex_name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `fedex_name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "fedex_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `fedex_code` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "fedex_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `fedex_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "address_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `address_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "username")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `username` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "province")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `province` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "city")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `city` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "county")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `county` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "address")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `address` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "postcode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `postcode` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "product_title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `product_title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "product_thumb")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `product_thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_order_obj", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_order_obj")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "is_vip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `is_vip` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "industry_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `industry_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "province_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `province_code` varchar(6) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "city_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `city_code` varchar(6) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "county_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `county_code` varchar(6) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "password")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `password` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "salt")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `salt` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "sms")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `sms` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "is_show_power")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `is_show_power` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "endtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `endtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "loginnum")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `loginnum` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "logintime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `logintime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "loginip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `loginip` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "remark")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `remark` varchar(1000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "config")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `config` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "default_store_map")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `default_store_map` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "create_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `create_num` int(11) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "zucp_ext")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `zucp_ext` varchar(6) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_account", "is_invite")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_account")." ADD `is_invite` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "detail_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `detail_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "balance")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_bill", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_bill")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "writeoff_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `writeoff_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "use_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `use_limit` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "time_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `time_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "time_day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `time_day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "time_end")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `time_end` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `pic_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `card_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "draw_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `draw_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "admins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `admins` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_card_writeoff", "voice_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_card_writeoff")." ADD `voice_store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "withdrawal")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `withdrawal` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "withdrawal_type")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `withdrawal_type` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_refund", "withdrawal_name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_refund")." ADD `withdrawal_name` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "paynumber")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `paynumber` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "admins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `admins` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `start_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `end_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "create_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `create_num` int(11) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "setmeal_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `setmeal_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_renew", "setmeal_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_renew")." ADD `setmeal_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "qrcode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `qrcode` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_store_staff", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_store_staff")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "uid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "username")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `username` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "role")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `role` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "power")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `power` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "remark")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `remark` varchar(1000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "lastvisit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `lastvisit` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "lastip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `lastip` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_admin", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_admin")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_area", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_area")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_area", "code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_area")." ADD `code` varchar(6) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_area", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_area")." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_area", "lvl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_area")." ADD `lvl` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_area", "parent_code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_area")." ADD `parent_code` varchar(6);");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "class_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `class_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "audiourl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `audiourl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "text_content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `text_content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "per")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `per` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "spd")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `spd` int(11) unsigned NOT NULL DEFAULT '5';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "pit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `pit` int(11) unsigned NOT NULL DEFAULT '5';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "vol")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `vol` int(11) unsigned NOT NULL DEFAULT '5';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio", "is_diy")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio")." ADD `is_diy` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_audio_class", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_audio_class")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `openid` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `mobile` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_complain", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_complain")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "class_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `class_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_effect_class", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_effect_class")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "class_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `class_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `pic_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_faq_class", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_faq_class")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "code")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `code` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_fedex", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_fedex")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_festival", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_festival")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_festival", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_festival")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_festival", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_festival")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_festival", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_festival")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_festival", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_festival")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_festival", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_festival")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "class_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `class_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "icon_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `icon_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "cartoon_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `cartoon_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "paymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "endmoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "vote")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `vote` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_gift_class", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_gift_class")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_industry", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_industry")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_industry", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_industry")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_industry", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_industry")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_industry", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_industry")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_industry", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_industry")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_industry", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_industry")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `openid` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "username")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `username` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `mobile` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_invest", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_invest")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_notice", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_notice")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_obj", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_obj")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_obj", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_obj")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_obj", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_obj")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_obj", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_obj")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_obj", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_obj")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_obj", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_obj")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "pay_method")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `pay_method` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "terminal")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `terminal` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "paynumber")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `paynumber` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "paymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "mymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `mymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "endmoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_pay", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_pay")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_plugins", "config")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_plugins")." ADD `config` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `activity_types` int(11) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "prize_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `prize_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `types` tinyint(1) unsigned NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "before")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `before` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "after")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `after` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "ip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `ip` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_prize_log", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_prize_log")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "draw_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `draw_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `openid` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "desc")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `desc` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "is_store_sell")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `is_store_sell` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_reissue", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_reissue")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "qrcode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `qrcode` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_service", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_service")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `name` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "service_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `service_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "content")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "is_hot")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "day")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `day` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_setmeal", "create_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_setmeal")." ADD `create_num` int(11) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `types` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "title")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `pic_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `url` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_slide", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_slide")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `store_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "reason")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `reason` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_sms", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_sms")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "obj_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `obj_types` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "festival")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `festival` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "industry")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `industry` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `name` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "thumb_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `thumb_url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "resource")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `resource` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "baner_html")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `baner_html` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "body_style")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `body_style` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "sort")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `sort` int(11) unsigned NOT NULL DEFAULT '4000';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "intro")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `intro` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "tmp_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `tmp_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "use_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `use_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "bogus_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `bogus_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "token")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `token` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "token_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `token_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_sys_tmp_data", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_sys_tmp_data")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `openid` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "oauthid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `oauthid` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "sex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `sex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "area")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `area` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_account", "origin_activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_account")." ADD `origin_activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "username")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `username` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "province")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `province` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "city")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `city` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "county")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `county` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "address")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `address` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "postcode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `postcode` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "is_default")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_address", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_address")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "detail_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `detail_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "balance")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_bill", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_bill")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `openid` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "sex")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `sex` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "area")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `area` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `mobile` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_blacklist", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_blacklist")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "origin_buy_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `origin_buy_types` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "prize_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `prize_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "writecode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `writecode` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `types` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `name` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "sys")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `sys` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_use_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_use_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_writeoff_num")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_writeoff_num` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_use_limit")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_use_limit` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_end_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_end_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "card_pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `card_pic_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "pay_openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `pay_openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "pay_nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `pay_nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "pay_headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `pay_headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "pay_number")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `pay_number` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "paymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `paymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "mymoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `mymoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "endmoney")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `endmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "prize_pic_url")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `prize_pic_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "writeoff_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `writeoff_types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "ordernumber")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `ordernumber` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "admins")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `admins` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "register_data")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `register_data` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "project_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `project_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "or_rebate2")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `or_rebate2` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "expires_time")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `expires_time` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "group_name")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `group_name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "group_qrcode")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `group_qrcode` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "is_settlement")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `is_settlement` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "is_receive_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `is_receive_types` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_draw", "voice_store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_draw")." ADD `voice_store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "money")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "status")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `updatetime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_refund", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_refund")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `types` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `activity_types` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "detail_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `detail_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "score")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `score` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_score", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_score")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `uniacid` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "store_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `store_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "activity_types")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `activity_types` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "activity_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `activity_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "origin_team_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `origin_team_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "origin_id")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `origin_id` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "openid")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `nickname` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "headurl")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `headurl` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "ip")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `ip` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "note")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `note` text NOT NULL;");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("lywywl_ztb_user_share", "deltime")) {
 pdo_query("ALTER TABLE ".tablename("lywywl_ztb_user_share")." ADD `deltime` int(11) unsigned NOT NULL DEFAULT '0';");
}
