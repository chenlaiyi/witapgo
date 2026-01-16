<?php
if(!pdo_fieldexists('wx_school_coursebuy', 'orderid')) {
	pdo_query("ALTER TABLE ".tablename('wx_school_coursebuy')." ADD `orderid` int(10) unsigned NOT NULL COMMENT '归属订单ID';");
}