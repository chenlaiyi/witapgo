<?php
//升级数据表
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `content` text,
  `tel` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `store_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_activity','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','content')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `content` text");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','tel')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `tel` varchar(30) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','cover')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `cover` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_activity','store_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_activity')." ADD   `store_info` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_adact` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `subtitle` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `detail` text,
  `out_thumb` varchar(255) DEFAULT '',
  `out_link` varchar(255) DEFAULT '',
  `enabled` tinyint(4) DEFAULT '0',
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_adact','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `uniacid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','subtitle')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `subtitle` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','thumb')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `thumb` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','detail')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `detail` text");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','out_thumb')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `out_thumb` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','out_link')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `out_link` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `enabled` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_adact','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adact')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_adv` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `displayorder` int(11) DEFAULT '0',
  `advname` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `enabled` tinyint(4) DEFAULT '0',
  `page_url` varchar(255) DEFAULT '',
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_adv','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','advname')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `advname` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','thumb')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `thumb` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `enabled` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','page_url')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `page_url` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_adv','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_adv')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_book_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `form_id` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `course_info` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_book_queue','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','plan_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `plan_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','form_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `form_id` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','openid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `openid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','store_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `store_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','course_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `course_info` text");}
if(!pdo_fieldexists('bozutung_jsfmd_book_queue','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_book_queue')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_category','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_category')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_category')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_category','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_category')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_category','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_category')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_category','icon')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_category')." ADD   `icon` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_category','sort')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_category')." ADD   `sort` int(11) DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_coach` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `simple` text,
  `zizhi` text,
  `speech` text,
  `video` varchar(255) DEFAULT NULL,
  `video_image` varchar(255) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `private` tinyint(4) DEFAULT '0',
  `strong_points` varchar(255) DEFAULT NULL,
  `details` text,
  `price` decimal(10,2) DEFAULT '0.00',
  `course_num_lower` int(11) DEFAULT '0',
  `wechat` varchar(255) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `details_enabled` tinyint(4) DEFAULT '0',
  `store_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_coach','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','avatar')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `avatar` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','simple')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `simple` text");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','zizhi')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `zizhi` text");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','speech')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `speech` text");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','video')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `video` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','video_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `video_image` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','private')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `private` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','strong_points')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `strong_points` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','details')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `details` text");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `price` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','course_num_lower')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `course_num_lower` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','wechat')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `wechat` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','tel')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `tel` varchar(30) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','details_enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `details_enabled` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coach','store_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coach')." ADD   `store_info` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `displayorder` int(11) DEFAULT '0',
  `id_user` varchar(255) DEFAULT '',
  `id_resource` int(11) DEFAULT '0',
  `res_type` varchar(255) DEFAULT '',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_collect','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_collect','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_collect','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_collect','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD   `id_user` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_collect','id_resource')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD   `id_resource` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_collect','res_type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD   `res_type` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_collect','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_collect')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_commission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `id_com_1` int(11) DEFAULT '0',
  `id_com_2` int(11) DEFAULT '0',
  `id_com_3` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_commission','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','id_com_1')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `id_com_1` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','id_com_2')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `id_com_2` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','id_com_3')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `id_com_3` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','status')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `status` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_commission_brokerage` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `money` int(11) DEFAULT '0',
  `money_withdraw` int(11) DEFAULT '0',
  `money_total` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD   `money` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','money_withdraw')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD   `money_withdraw` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','money_total')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD   `money_total` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_commission_brokerage_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `money` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `mark` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD   `money` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','status')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD   `status` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','mark')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD   `mark` text");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_brokerage_log','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_brokerage_log')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_commission_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `id_order` int(11) DEFAULT '0',
  `id_order_user` int(11) DEFAULT '0',
  `money` int(11) DEFAULT '0',
  `type` varchar(255) DEFAULT '',
  `status` tinyint(4) DEFAULT '0',
  `rebate` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_commission_order','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','id_order')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `id_order` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','id_order_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `id_order_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `money` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `type` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','status')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `status` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','rebate')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `rebate` text");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_order','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_order')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_commission_settle_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `money_order` int(11) DEFAULT '0',
  `money_brokerage` int(11) DEFAULT '0',
  `id_order` int(11) DEFAULT '0',
  `info` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','money_order')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `money_order` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','money_brokerage')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `money_brokerage` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','id_order')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `id_order` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `info` text");}
if(!pdo_fieldexists('bozutung_jsfmd_commission_settle_log','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_commission_settle_log')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `end_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `reach` int(11) DEFAULT NULL,
  `minus` int(11) DEFAULT NULL,
  `recommend` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `received` int(11) DEFAULT '0',
  `max` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT '0',
  `type` tinyint(4) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `bg_image` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `intro` varchar(500) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `enough` int(11) DEFAULT '0',
  `timelimit` tinyint(4) DEFAULT '0',
  `timedays1` varchar(255) DEFAULT '',
  `timedays2` varchar(255) DEFAULT '',
  `backtype` tinyint(4) DEFAULT '0',
  `backmoney` int(11) DEFAULT '0',
  `flbackmoney` int(11) DEFAULT NULL,
  `backwhen` tinyint(4) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `receive` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_coupon','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `uniacid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','end_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `end_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `create_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','reach')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `reach` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','minus')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `minus` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','recommend')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `recommend` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','sort')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `sort` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','received')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `received` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','max')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `max` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','discount')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `discount` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `type` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','description')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `description` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `bg_image` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','intro')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `intro` varchar(500) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','thumb')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `thumb` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','enough')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `enough` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','timelimit')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `timelimit` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','timedays1')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `timedays1` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','timedays2')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `timedays2` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','backtype')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `backtype` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','backmoney')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `backmoney` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','flbackmoney')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `flbackmoney` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','backwhen')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `backwhen` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','total')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `total` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','receive')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `receive` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `enabled` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_coupon_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receive_time` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `used_time` int(11) DEFAULT NULL,
  `used` tinyint(4) DEFAULT '0',
  `order_id` int(11) DEFAULT NULL,
  `displayorder` int(11) DEFAULT '0',
  `user` int(11) DEFAULT '0',
  `saleid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `option_value` text,
  `time_start` datetime DEFAULT '2000-01-01 00:00:00',
  `time_end` datetime DEFAULT '2000-01-01 00:00:00',
  `status` tinyint(4) DEFAULT '0',
  `price` int(11) DEFAULT '0',
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','receive_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `receive_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','coupon_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `coupon_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','used_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `used_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','used')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `used` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','order_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `order_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','saleid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `saleid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','option_value')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `option_value` text");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','time_start')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `time_start` datetime DEFAULT '2000-01-01 00:00:00'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','time_end')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `time_end` datetime DEFAULT '2000-01-01 00:00:00'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','status')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `status` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `price` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_coupon_user','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_coupon_user')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `difficulty` tinyint(4) DEFAULT NULL,
  `system_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `novice_price` decimal(10,2) DEFAULT NULL,
  `calorie` tinyint(4) DEFAULT NULL,
  `flexibility` tinyint(4) DEFAULT NULL,
  `heart_lung` tinyint(4) DEFAULT NULL,
  `harmony` tinyint(4) DEFAULT NULL,
  `muscle_endurance` tinyint(4) DEFAULT NULL,
  `muscle_force` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `slides` text,
  `description` text,
  `precautions` text,
  `own_articles` text,
  `simple` varchar(255) DEFAULT '',
  `video` varchar(255) DEFAULT '',
  `show_image` varchar(255) DEFAULT '',
  `video_image` varchar(255) DEFAULT '',
  `recommend` int(11) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `to_home` tinyint(4) DEFAULT '0',
  `details` mediumtext,
  `details_enabled` tinyint(4) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  `calorie_tips` varchar(255) DEFAULT '',
  `store_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_course','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_course','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','number')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `number` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','difficulty')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `difficulty` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','system_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `system_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `price` decimal(10,2) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','novice_price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `novice_price` decimal(10,2) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','calorie')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `calorie` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','flexibility')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `flexibility` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','heart_lung')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `heart_lung` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','harmony')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `harmony` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','muscle_endurance')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `muscle_endurance` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','muscle_force')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `muscle_force` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `name` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course','slides')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `slides` text");}
if(!pdo_fieldexists('bozutung_jsfmd_course','description')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `description` text");}
if(!pdo_fieldexists('bozutung_jsfmd_course','precautions')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `precautions` text");}
if(!pdo_fieldexists('bozutung_jsfmd_course','own_articles')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `own_articles` text");}
if(!pdo_fieldexists('bozutung_jsfmd_course','simple')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `simple` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course','video')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `video` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course','show_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `show_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course','video_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `video_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course','recommend')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `recommend` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course','to_home')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `to_home` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course','details')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `details` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_course','details_enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `details_enabled` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
if(!pdo_fieldexists('bozutung_jsfmd_course','calorie_tips')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `calorie_tips` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course','store_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course')." ADD   `store_info` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_course_member_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `member_level_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_course_member_level','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_member_level')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_course_member_level','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_member_level')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_member_level','course_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_member_level')." ADD   `course_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_member_level','member_level_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_member_level')." ADD   `member_level_id` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_course_payment_way` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `payment_way` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_course_payment_way','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_payment_way')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_course_payment_way','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_payment_way')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_payment_way','course_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_payment_way')." ADD   `course_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_payment_way','payment_way')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_payment_way')." ADD   `payment_way` tinyint(4) DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_course_plan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `booked_number` int(11) DEFAULT '0',
  `number` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL,
  `novice_price` decimal(10,2) DEFAULT NULL,
  `book_end` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `can_queue` tinyint(4) DEFAULT '0',
  `left_tip` tinyint(4) DEFAULT '5',
  `book_start` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_course_plan','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','course_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `course_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','store_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `store_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','coach_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `coach_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','booked_number')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `booked_number` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','number')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `number` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','start')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `start` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','end')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `end` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `price` decimal(10,2) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','novice_price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `novice_price` decimal(10,2) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','book_end')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `book_end` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','training_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `training_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','can_queue')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `can_queue` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','left_tip')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `left_tip` tinyint(4) DEFAULT '5'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_plan','book_start')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_plan')." ADD   `book_start` int(11) DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_course_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `description` text,
  `icon` varchar(255) DEFAULT NULL,
  `bg_color` varchar(255) DEFAULT NULL,
  `detail` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_course_system','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `image` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','description')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `description` text");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','icon')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `icon` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','bg_color')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `bg_color` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','detail')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `detail` text");}
if(!pdo_fieldexists('bozutung_jsfmd_course_system','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_system')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_course_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `sequence` int(11) DEFAULT '1',
  `delete` tinyint(4) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `speaker` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `cover` varchar(255) DEFAULT '',
  `free_time` int(11) DEFAULT '0',
  `time_count` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_course_video','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','course_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `course_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','sequence')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `sequence` int(11) DEFAULT '1'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','speaker')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `speaker` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','url')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `url` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','cover')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `cover` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','free_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `free_time` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','time_count')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `time_count` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_course_video','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_course_video')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_dimension` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_dimension','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_dimension')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_dimension','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_dimension')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_dimension','key')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_dimension')." ADD   `key` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_dimension','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_dimension')." ADD   `name` varchar(255) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `create` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00',
  `type` tinyint(4) DEFAULT '0',
  `subtype` tinyint(4) DEFAULT NULL,
  `time` tinyint(4) DEFAULT NULL,
  `times` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT '',
  `order_id` int(11) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `user_card_id` int(11) DEFAULT NULL,
  `money_wechat` decimal(10,2) DEFAULT '0.00',
  `other_id` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  `post_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_log','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','create')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `create` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','card_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `card_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `money` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `type` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','subtype')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `subtype` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `time` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','times')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `times` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','reason')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `reason` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_log','order_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `order_id` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','user_card_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `user_card_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log','money_wechat')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `money_wechat` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','other_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `other_id` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
if(!pdo_fieldexists('bozutung_jsfmd_log','post_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log')." ADD   `post_info` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_log_refund` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `price` int(11) DEFAULT '0',
  `txt` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_log_refund','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log_refund')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_log_refund','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log_refund')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_log_refund','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log_refund')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_log_refund','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log_refund')." ADD   `price` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_log_refund','txt')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log_refund')." ADD   `txt` text");}
if(!pdo_fieldexists('bozutung_jsfmd_log_refund','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_log_refund')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_member_card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `times` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `details` mediumtext,
  `to_sell` tinyint(4) DEFAULT '1',
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_member_card','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `type` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','times')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `times` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `price` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','sort')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `sort` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `money` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','details')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `details` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','to_sell')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `to_sell` tinyint(4) DEFAULT '1'");}
if(!pdo_fieldexists('bozutung_jsfmd_member_card','course_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_card')." ADD   `course_id` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_member_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `delete` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_member_level','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_level')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_member_level','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_level')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_level','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_level')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_level','icon')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_level')." ADD   `icon` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_member_level','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_level')." ADD   `price` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_member_level','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_member_level')." ADD   `delete` tinyint(4) DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_menu_display_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `display_order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_menu_display_order','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_menu_display_order')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_menu_display_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_menu_display_order')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_menu_display_order','eid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_menu_display_order')." ADD   `eid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_menu_display_order','display_order')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_menu_display_order')." ADD   `display_order` int(11) DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_mod_wxapp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `page_url` varchar(255) DEFAULT '',
  `appid` varchar(255) DEFAULT '',
  `page_page` varchar(255) DEFAULT '',
  `enabled` int(11) DEFAULT '0',
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `uniacid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','displayorder')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `displayorder` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','page_url')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `page_url` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','appid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `appid` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','page_page')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `page_page` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `enabled` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_mod_wxapp','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_mod_wxapp')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_oplogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `op_domain` varchar(255) DEFAULT '',
  `op_user` varchar(255) DEFAULT '',
  `op_type` varchar(255) DEFAULT '',
  `op_txt` text,
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_oplogs','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_oplogs','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_oplogs','op_domain')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD   `op_domain` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_oplogs','op_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD   `op_user` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_oplogs','op_type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD   `op_type` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_oplogs','op_txt')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD   `op_txt` text");}
if(!pdo_fieldexists('bozutung_jsfmd_oplogs','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_oplogs')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `plan_id` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `sn` varchar(255) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `paid_money` decimal(10,2) DEFAULT '0.00',
  `refund_money` decimal(10,2) DEFAULT '0.00',
  `refund_time` int(11) DEFAULT '0',
  `paid_time` int(11) DEFAULT '0',
  `end` int(11) DEFAULT '0',
  `type` tinyint(4) DEFAULT NULL,
  `subtype` tinyint(4) DEFAULT '0',
  `other_id` int(11) DEFAULT NULL,
  `order_info` text,
  `store_id` int(11) DEFAULT '0',
  `form_id` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_order','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `uniacid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `user_id` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','plan_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `plan_id` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `create_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_order','status')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `status` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','sn')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `sn` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_order','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','paid_money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `paid_money` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','refund_money')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `refund_money` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','refund_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `refund_time` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','paid_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `paid_time` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','end')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `end` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `type` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_order','subtype')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `subtype` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','other_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `other_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_order','order_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `order_info` text");}
if(!pdo_fieldexists('bozutung_jsfmd_order','store_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `store_id` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_order','form_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_order')." ADD   `form_id` varchar(255) DEFAULT ''");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_private_coach_buy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `left_times` int(11) DEFAULT NULL,
  `post_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','coach_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `coach_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','order_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `order_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','num')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `num` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','left_times')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `left_times` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_private_coach_buy','post_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_private_coach_buy')." ADD   `post_info` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `setting_name` varchar(255) DEFAULT '',
  `setting_value` longtext,
  `addtime` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_settings','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_settings')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_settings','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_settings')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_settings','setting_name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_settings')." ADD   `setting_name` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_settings','setting_value')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_settings')." ADD   `setting_value` longtext");}
if(!pdo_fieldexists('bozutung_jsfmd_settings','addtime')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_settings')." ADD   `addtime` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_sign_in` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0',
  `other_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_sign_in','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `type` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','other_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `other_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','course_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `course_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_sign_in','coach_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_sign_in')." ADD   `coach_id` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_store` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subway_name` varchar(255) DEFAULT NULL,
  `subway_distance` int(11) DEFAULT NULL,
  `subway_description` text,
  `bus_stop_name` varchar(255) DEFAULT NULL,
  `bus_stop_distance` int(11) DEFAULT NULL,
  `bus_stop_description` text,
  `drive_place` varchar(255) DEFAULT NULL,
  `drive_description` text,
  `way` tinyint(4) DEFAULT '0',
  `lng` double DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  `coordinate` text,
  `store_info` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_store','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_store','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','address')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `address` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `image` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','subway_name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `subway_name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','subway_distance')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `subway_distance` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','subway_description')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `subway_description` text");}
if(!pdo_fieldexists('bozutung_jsfmd_store','bus_stop_name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `bus_stop_name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','bus_stop_distance')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `bus_stop_distance` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','bus_stop_description')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `bus_stop_description` text");}
if(!pdo_fieldexists('bozutung_jsfmd_store','drive_place')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `drive_place` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','drive_description')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `drive_description` text");}
if(!pdo_fieldexists('bozutung_jsfmd_store','way')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `way` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_store','lng')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `lng` double DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','lat')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `lat` double DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_store','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_store','coordinate')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `coordinate` text");}
if(!pdo_fieldexists('bozutung_jsfmd_store','store_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `store_info` text");}
if(!pdo_fieldexists('bozutung_jsfmd_store','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_store')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_system_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `service_term` mediumtext,
  `introduction` mediumtext,
  `refund_tip` varchar(255) DEFAULT '',
  `nb_bg_color` varchar(255) DEFAULT '',
  `nb_word_color` varchar(255) DEFAULT '',
  `syllabus_bg_image` varchar(255) DEFAULT '',
  `training_bg_image` varchar(255) DEFAULT '',
  `recommend_bg_image` varchar(255) DEFAULT '',
  `my_top_bg_image` varchar(255) DEFAULT '',
  `mini_program_name` varchar(255) DEFAULT '',
  `training_service_term` mediumtext,
  `invitation_tip` varchar(255) DEFAULT '',
  `activity_tip` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `copyright` varchar(255) DEFAULT '',
  `tech_tel` varchar(255) DEFAULT '',
  `book_remind_template` text,
  `private_teach_rule` mediumtext,
  `member_rights` mediumtext,
  `sign_in_time` int(11) DEFAULT '15',
  `coach_tip` varchar(255) DEFAULT '',
  `store_tip` varchar(255) DEFAULT '',
  `coach_bg_image` varchar(255) DEFAULT '',
  `store_bg_image` varchar(255) DEFAULT '',
  `royalty_rate` int(11) DEFAULT '1',
  `distribute_rule` mediumtext,
  `royalty_rate2` int(11) DEFAULT '1',
  `home_text` varchar(255) DEFAULT '',
  `private_text` varchar(255) DEFAULT '',
  `store_text` varchar(255) DEFAULT '',
  `me_text` varchar(255) DEFAULT '',
  `zdy` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_system_settings','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','service_term')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `service_term` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','introduction')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `introduction` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','refund_tip')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `refund_tip` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','nb_bg_color')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `nb_bg_color` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','nb_word_color')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `nb_word_color` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','syllabus_bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `syllabus_bg_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','training_bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `training_bg_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','recommend_bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `recommend_bg_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','my_top_bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `my_top_bg_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','mini_program_name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `mini_program_name` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','training_service_term')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `training_service_term` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','invitation_tip')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `invitation_tip` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','activity_tip')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `activity_tip` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','logo')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `logo` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','tel')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `tel` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','copyright')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `copyright` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','tech_tel')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `tech_tel` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','book_remind_template')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `book_remind_template` text");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','private_teach_rule')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `private_teach_rule` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','member_rights')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `member_rights` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','sign_in_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `sign_in_time` int(11) DEFAULT '15'");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','coach_tip')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `coach_tip` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','store_tip')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `store_tip` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','coach_bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `coach_bg_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','store_bg_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `store_bg_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','royalty_rate')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `royalty_rate` int(11) DEFAULT '1'");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','distribute_rule')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `distribute_rule` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','royalty_rate2')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `royalty_rate2` int(11) DEFAULT '1'");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','home_text')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `home_text` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','private_text')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `private_text` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','store_text')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `store_text` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','me_text')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `me_text` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_system_settings','zdy')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_system_settings')." ADD   `zdy` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_tplwx` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `tpl_base_id` varchar(255) DEFAULT '',
  `tpl_base_title` varchar(255) DEFAULT '',
  `tpl_id` varchar(255) DEFAULT '',
  `tpl_type` varchar(255) DEFAULT '',
  `mark` varchar(255) DEFAULT '',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_tplwx','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','tpl_base_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `tpl_base_id` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','tpl_base_title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `tpl_base_title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','tpl_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `tpl_id` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','tpl_type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `tpl_type` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','mark')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `mark` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_tplwx_send_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `form_id` varchar(255) DEFAULT NULL,
  `send_info` text,
  `return_info` text,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','form_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD   `form_id` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','send_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD   `send_info` text");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','return_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD   `return_info` text");}
if(!pdo_fieldexists('bozutung_jsfmd_tplwx_send_log','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_tplwx_send_log')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_training_battalion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` mediumtext,
  `cover` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `early_bird_price` int(11) DEFAULT NULL,
  `min_number` int(11) DEFAULT NULL,
  `max_number` int(11) DEFAULT NULL,
  `booked_number` int(11) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='训练营的教练可以是多个，在课程计划中选择教练';

");

if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `name` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','details')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `details` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','cover')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `cover` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','store_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `store_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `price` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','early_bird_price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `early_bird_price` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','min_number')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `min_number` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','max_number')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `max_number` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','booked_number')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `booked_number` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_training_battalion','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_training_battalion')." ADD   `delete` tinyint(4) DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `openid` varchar(255) DEFAULT '',
  `gender` tinyint(4) DEFAULT '0',
  `last_time` int(11) DEFAULT '0',
  `register_time` int(11) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `member_level_id` int(11) DEFAULT '0',
  `balance` decimal(10,2) DEFAULT '0.00',
  `due_time` int(11) DEFAULT '0',
  `left_times` int(11) DEFAULT '0',
  `real_name` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `commission` decimal(10,2) DEFAULT '0.00',
  `id_no` varchar(255) DEFAULT '',
  `id_card_image` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `waistline` varchar(255) DEFAULT '',
  `height` varchar(255) DEFAULT '',
  `weight` varchar(255) DEFAULT '',
  `thigh` varchar(255) DEFAULT '',
  `bust` varchar(255) DEFAULT '',
  `role` int(11) DEFAULT '0',
  `age` int(11) DEFAULT '0',
  `province` varchar(255) DEFAULT '',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  `mark` text,
  `id_label` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1388 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_user','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_user','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user','nickname')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `nickname` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','avatar')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `avatar` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','openid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `openid` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','gender')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `gender` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','last_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `last_time` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','register_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `register_time` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','member_level_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `member_level_id` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','balance')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `balance` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','due_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `due_time` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','left_times')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `left_times` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','real_name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `real_name` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','tel')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `tel` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','commission')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `commission` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','id_no')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `id_no` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','id_card_image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `id_card_image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','image')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `image` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','waistline')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `waistline` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','height')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `height` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','weight')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `weight` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','thigh')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `thigh` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','bust')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `bust` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','role')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `role` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','age')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `age` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','province')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `province` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
if(!pdo_fieldexists('bozutung_jsfmd_user','mark')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `mark` text");}
if(!pdo_fieldexists('bozutung_jsfmd_user','id_label')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user')." ADD   `id_label` text");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_user_card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `times` int(11) DEFAULT NULL,
  `left_times` int(11) DEFAULT NULL,
  `due_time` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_user_card','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','user_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `user_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','type')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `type` tinyint(4) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','times')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `times` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','left_times')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `left_times` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','due_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `due_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','card_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `card_id` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_card','order_id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_card')." ADD   `order_id` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_user_commission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `id_com_1` int(11) DEFAULT '0',
  `id_com_2` int(11) DEFAULT '0',
  `id_com_3` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_user_commission','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','id_user')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `id_user` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','id_com_1')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `id_com_1` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','id_com_2')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `id_com_2` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','id_com_3')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `id_com_3` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','status')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `status` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_commission','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_commission')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_user_label` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `subtitle` text,
  `thumb` varchar(255) DEFAULT '',
  `enabled` tinyint(4) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_user_label','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD 
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','sort')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `sort` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','title')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `title` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','subtitle')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `subtitle` text");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','thumb')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `thumb` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `enabled` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_user_label','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_label')." ADD   `create_time` datetime DEFAULT '2000-01-01 00:00:00'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_user_relation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `lower` int(11) DEFAULT NULL,
  `upper` int(11) DEFAULT NULL,
  `upperupper` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_user_relation','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_relation')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_user_relation','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_relation')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_relation','lower')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_relation')." ADD   `lower` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_relation','upper')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_relation')." ADD   `upper` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_user_relation','upperupper')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_user_relation')." ADD   `upperupper` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_bozutung_jsfmd_video_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `category` int(11) DEFAULT '0',
  `to_home` int(11) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `cover` varchar(255) DEFAULT '',
  `slides` text,
  `details` mediumtext,
  `intro` text,
  `recommend` int(11) DEFAULT '0',
  `buy_count` int(11) DEFAULT '0',
  `enabled` tinyint(4) DEFAULT '0',
  `create_time` date DEFAULT '2000-01-01',
  `store_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('bozutung_jsfmd_video_course','id')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','uniacid')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','price')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `price` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','category')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `category` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','to_home')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `to_home` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','delete')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `delete` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','name')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `name` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','cover')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `cover` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','slides')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `slides` text");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','details')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `details` mediumtext");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','intro')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `intro` text");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','recommend')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `recommend` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','buy_count')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `buy_count` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','enabled')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `enabled` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','create_time')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `create_time` date DEFAULT '2000-01-01'");}
if(!pdo_fieldexists('bozutung_jsfmd_video_course','store_info')) {pdo_query("ALTER TABLE ".tablename('bozutung_jsfmd_video_course')." ADD   `store_info` text");}
