<?php
pdo_query("DROP TABLE IF EXISTS `ims_messikefu_adv`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_adv` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) DEFAULT NULL DEFAULT '0',
`advname` varchar(50) DEFAULT NULL,
`link` varchar(255) DEFAULT NULL,
`thumb` varchar(255) DEFAULT NULL,
`displayorder` int(11) DEFAULT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_biaoqian`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_biaoqian` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`kefuopenid` varchar(200) NOT NULL,
`fensiopenid` varchar(200) NOT NULL,
`name` varchar(50) NOT NULL,
`realname` varchar(50) NOT NULL,
`telphone` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_chat`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_chat` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`openid` varchar(100) NOT NULL,
`toopenid` varchar(100) NOT NULL,
`content` varchar(255) NOT NULL,
`time` int(11) NOT NULL,
`nickname` varchar(50) NOT NULL,
`avatar` varchar(200) NOT NULL,
`type` tinyint(1) NOT NULL,
`hasread` tinyint(1) NOT NULL,
`fkid` int(11) NOT NULL,
`yuyintime` smallint(6) NOT NULL,
`hasyuyindu` tinyint(1) NOT NULL,
`isjqr` tinyint(1) NOT NULL,
`fansdel` tinyint(1) NOT NULL,
`kefudel` tinyint(1) NOT NULL,
`isck` tinyint(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_cservice`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_cservice` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`name` varchar(50) NOT NULL,
`ctype` tinyint(1) NOT NULL,
`content` varchar(100) NOT NULL,
`thumb` varchar(255) NOT NULL,
`displayorder` int(11) NOT NULL,
`starthour` smallint(6) NOT NULL,
`endhour` smallint(6) NOT NULL,
`autoreply` varchar(200) NOT NULL,
`isonline` tinyint(1) NOT NULL,
`groupid` int(11) NOT NULL,
`fansauto` text NOT NULL,
`kefuauto` text NOT NULL,
`isautosub` tinyint(1) NOT NULL,
`qrtext` varchar(50) NOT NULL,
`qrcolor` varchar(20) NOT NULL,
`qrbg` varchar(20) NOT NULL,
`iskefuqrcode` tinyint(1) NOT NULL,
`kefuqrcode` varchar(200) NOT NULL,
`ishow` tinyint(1) NOT NULL,
`notonline` varchar(255) NOT NULL,
`lingjie` tinyint(1) NOT NULL,
`typename` varchar(50) NOT NULL,
`isgly` tinyint(1) NOT NULL,
`iszx` tinyint(1) NOT NULL,
`isrealzx` tinyint(1) NOT NULL,
`username` varchar(50) NOT NULL,
`pwd` varchar(50) NOT NULL,
`djkey` varchar(30) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_cservicegroup`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_cservicegroup` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`name` varchar(50) NOT NULL,
`thumb` varchar(255) NOT NULL,
`displayorder` int(11) NOT NULL,
`qrtext` varchar(50) NOT NULL,
`qrbg` varchar(20) NOT NULL,
`qrcolor` varchar(20) NOT NULL,
`cangroup` tinyint(1) NOT NULL,
`typename` varchar(50) NOT NULL,
`ishow` tinyint(1) NOT NULL,
`sanbs` varchar(50) NOT NULL,
`sanremark` varchar(200) NOT NULL,
`bsid` int(11) NOT NULL,
`qrright` int(11) NOT NULL,
`qrbottom` int(11) NOT NULL,
`fid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_fanskefu`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_fanskefu` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`fansopenid` varchar(100) NOT NULL,
`kefuopenid` varchar(100) NOT NULL,
`fansavatar` varchar(200) NOT NULL,
`kefuavatar` varchar(200) NOT NULL,
`fansnickname` varchar(100) NOT NULL,
`kefunickname` varchar(100) NOT NULL,
`lasttime` int(11) NOT NULL,
`notread` int(11) NOT NULL,
`lastcon` varchar(255) NOT NULL,
`kefulasttime` int(11) NOT NULL,
`kefulastcon` varchar(255) NOT NULL,
`kefunotread` int(11) NOT NULL,
`msgtype` smallint(6) NOT NULL,
`kefumsgtype` smallint(6) NOT NULL,
`kefuseetime` int(11) NOT NULL,
`fansseetime` int(11) NOT NULL,
`guanlinum` int(11) NOT NULL,
`ishei` tinyint(1) NOT NULL,
`fansdel` tinyint(1) NOT NULL,
`kefudel` tinyint(1) NOT NULL,
`fszx` tinyint(1) NOT NULL,
`kfzx` tinyint(1) NOT NULL,
`isxcx` tinyint(1) NOT NULL,
`bdopenid` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_group`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_group` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`groupname` varchar(100) NOT NULL,
`thumb` varchar(200) NOT NULL,
`admin` varchar(100) NOT NULL,
`time` int(11) NOT NULL,
`autoreply` varchar(200) NOT NULL,
`quickcon` text NOT NULL,
`isautosub` tinyint(1) NOT NULL,
`cservicegroupid` int(11) NOT NULL,
`lasttime` int(11) NOT NULL,
`maxnum` int(11) NOT NULL,
`isguanzhu` tinyint(1) NOT NULL,
`jinyan` tinyint(1) NOT NULL,
`isshenhe` tinyint(1) NOT NULL,
`autotx` tinyint(1) NOT NULL,
`isdel` tinyint(1) NOT NULL,
`isfs` tinyint(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_groupchat`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_groupchat` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`nickname` varchar(100) NOT NULL,
`avatar` varchar(255) NOT NULL,
`weid` int(11) NOT NULL,
`groupid` int(11) NOT NULL,
`openid` varchar(100) NOT NULL,
`content` varchar(255) NOT NULL,
`time` int(11) NOT NULL,
`type` tinyint(1) NOT NULL,
`yuyintime` smallint(6) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_groupmember`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_groupmember` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`groupid` int(11) NOT NULL,
`openid` varchar(100) NOT NULL,
`nickname` varchar(50) NOT NULL,
`avatar` varchar(255) NOT NULL,
`type` tinyint(1) NOT NULL,
`status` tinyint(1) NOT NULL,
`intime` int(11) NOT NULL,
`lasttime` int(11) NOT NULL,
`notread` int(11) NOT NULL,
`txkaiguan` tinyint(1) NOT NULL,
`isdel` tinyint(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_kefuandcjwt`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_kefuandcjwt` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`kefuid` int(11) NOT NULL,
`wtid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_kefuandgroup`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_kefuandgroup` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`kefuid` int(11) NOT NULL,
`groupid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_pingjia`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_pingjia` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`kefuopenid` varchar(200) NOT NULL,
`fensiopenid` varchar(200) NOT NULL,
`pingtype` tinyint(1) NOT NULL,
`content` varchar(255) NOT NULL,
`time` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_sanchat`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_sanchat` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`sanfkid` int(11) NOT NULL,
`content` varchar(255) NOT NULL,
`time` int(11) NOT NULL,
`type` tinyint(1) NOT NULL,
`openid` varchar(100) NOT NULL,
`yuyintime` smallint(6) NOT NULL,
`hasyuyindu` tinyint(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_sanfanskefu`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_sanfanskefu` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`fansopenid` varchar(100) NOT NULL,
`kefuopenid` varchar(100) NOT NULL,
`fansavatar` varchar(200) NOT NULL,
`kefuavatar` varchar(200) NOT NULL,
`fansnickname` varchar(100) NOT NULL,
`kefunickname` varchar(100) NOT NULL,
`lasttime` int(11) NOT NULL,
`notread` int(11) NOT NULL,
`lastcon` varchar(255) NOT NULL,
`msgtype` smallint(6) NOT NULL,
`seetime` int(11) NOT NULL,
`qudao` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_set`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_set` (
`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`title` varchar(30) NOT NULL,
`istplon` tinyint(1) NOT NULL,
`unfollowtext` text NOT NULL,
`followqrcode` varchar(100) NOT NULL,
`sharetitle` varchar(100) NOT NULL,
`sharedes` varchar(255) NOT NULL,
`sharethumb` varchar(155) NOT NULL,
`kefutplminute` int(11) NOT NULL,
`bgcolor` varchar(10) NOT NULL,
`defaultavatar` varchar(100) NOT NULL,
`fansauto` text NOT NULL,
`kefuauto` text NOT NULL,
`issharemsg` tinyint(1) NOT NULL,
`isautosub` tinyint(1) NOT NULL,
`isshowwgz` tinyint(1) NOT NULL,
`sharetype` tinyint(1) NOT NULL,
`mingan` text NOT NULL,
`temcolor` varchar(50) NOT NULL,
`candel` tinyint(1) NOT NULL,
`copyright` varchar(255) NOT NULL,
`canservicequn` tinyint(1) NOT NULL,
`canfansqun` tinyint(1) NOT NULL,
`isgrouptplon` tinyint(1) NOT NULL,
`grouptplminute` int(11) NOT NULL,
`isgroupon` tinyint(1) NOT NULL,
`footertext1` varchar(50) NOT NULL,
`footertext2` varchar(50) NOT NULL,
`footertext3` varchar(50) NOT NULL,
`footertext4` varchar(50) NOT NULL,
`isqiniu` tinyint(1) NOT NULL,
`qiniuaccesskey` varchar(255) NOT NULL,
`qiniusecretkey` varchar(255) NOT NULL,
`qiniubucket` varchar(255) NOT NULL,
`qiniuurl` varchar(255) NOT NULL,
`httptype` tinyint(1) NOT NULL,
`istxfon` tinyint(1) NOT NULL,
`ishowgroupnum` tinyint(1) NOT NULL,
`chosekefutem` tinyint(1) NOT NULL,
`tulingkey` varchar(100) NOT NULL,
`istulingon` tinyint(1) NOT NULL,
`qdgly` text NOT NULL,
`suiji` tinyint(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_tplmessage_sendlog`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_tplmessage_sendlog` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`tpl_id` int(11) DEFAULT NULL,
`tpl_title` varchar(50) DEFAULT NULL,
`message` text DEFAULT NULL COMMENT '消息内容',
`success` int(11) DEFAULT NULL DEFAULT '0' COMMENT '成功人数',
`fail` int(11) DEFAULT NULL DEFAULT '0' COMMENT '失败人数',
`time` int(11) DEFAULT NULL COMMENT '发送时间',
`uniacid` int(5) DEFAULT NULL,
`type` int(5) DEFAULT NULL DEFAULT '0' COMMENT '消息类型 0为群发 1为个人',
`target` varchar(80) DEFAULT NULL COMMENT '发送对象 type 为0时 是粉丝组 type 为1时是openid',
`status` int(2) DEFAULT NULL DEFAULT '0' COMMENT '状态 0为发送中 1为完成 2为失败',
`error` text DEFAULT NULL COMMENT '错误记录',
`mid` int(11) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_tplmessage_tpllist`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_tplmessage_tpllist` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`tplbh` varchar(50) NOT NULL,
`tpl_id` varchar(80) DEFAULT NULL,
`tpl_title` varchar(20) DEFAULT NULL,
`tpl_key` varchar(500) DEFAULT NULL COMMENT '模板内容key',
`tpl_example` varchar(500) DEFAULT NULL,
`uniacid` int(5) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_wenzhang`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_wenzhang` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`title` varchar(200) NOT NULL,
`des` text NOT NULL,
`views` int(11) NOT NULL,
`addtime` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_xcx`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_xcx` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(11) DEFAULT NULL,
`name` varchar(30) DEFAULT NULL,
`gh_id` varchar(30) DEFAULT NULL,
`appid` varchar(30) DEFAULT NULL,
`secret` varchar(50) DEFAULT NULL,
`token` varchar(50) DEFAULT NULL,
`aeskey` varchar(50) DEFAULT NULL,
`url` varchar(200) DEFAULT NULL,
`access_token` text NOT NULL,
`guoqitime` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_xcxchat`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_xcxchat` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`openid` varchar(100) NOT NULL,
`toopenid` varchar(100) NOT NULL,
`content` text NOT NULL,
`time` int(11) NOT NULL,
`msgtype` varchar(50) NOT NULL,
`fkid` int(11) NOT NULL,
`gh_id` varchar(50) NOT NULL,
`msgid` varchar(50) NOT NULL,
`mediaId` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_xcxcservice`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_xcxcservice` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`name` varchar(50) NOT NULL,
`content` varchar(100) NOT NULL,
`thumb` varchar(255) NOT NULL,
`displayorder` int(11) NOT NULL,
`kefuauto` text NOT NULL,
`isautosub` tinyint(1) NOT NULL,
`xcxid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_xcxfanskefu`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_xcxfanskefu` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`fansopenid` varchar(100) NOT NULL,
`kefuopenid` varchar(100) NOT NULL,
`fansavatar` varchar(200) NOT NULL,
`kefuavatar` varchar(200) NOT NULL,
`fansnickname` varchar(100) NOT NULL,
`kefunickname` varchar(100) NOT NULL,
`lasttime` int(11) NOT NULL,
`notread` int(11) NOT NULL,
`lastcon` varchar(255) NOT NULL,
`msgtype` varchar(30) NOT NULL,
`gh_id` varchar(50) NOT NULL,
`createtime` int(11) NOT NULL,
`sessionfrom` varchar(100) NOT NULL,
`huifunum` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_messikefu_zdhf`;
CREATE TABLE IF NOT EXISTS `ims_messikefu_zdhf` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`title` varchar(200) NOT NULL,
`content` text NOT NULL,
`type` tinyint(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
