<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_film_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `appid` varchar(255) NOT NULL COMMENT 'appid',
  `appsecret` varchar(255) NOT NULL COMMENT 'appsecret',
  `film_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '购买电影分销比例',
  `key` varchar(100) DEFAULT NULL COMMENT '腾讯地图key',
  `explain` text COMMENT '购票须知',
  `createtime` int(10) NOT NULL,
  `discount_open` smallint(1) DEFAULT '2' COMMENT '1-开启  2-关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='电影设置表';

";
pdo_run($sql);
if(!pdo_fieldexists("wjyk_zqds_film_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "appsecret")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `appsecret` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "film_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `film_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "key")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `key` varchar(100);");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "explain")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `explain` text;");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_film_set", "discount_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_film_set")." ADD `discount_open` smallint(1) DEFAULT '2';");
}
