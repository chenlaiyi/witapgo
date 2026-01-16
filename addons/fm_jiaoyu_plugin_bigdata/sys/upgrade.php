<?php
if(!pdo_fieldexists('wx_school_wxpay', $arr['1'])) {
	pdo_query("ALTER TABLE  ".tablename('wx_school_wxpay')." ADD `{$arr['1']}` varchar(30) NOT NULL DEFAULT '0' COMMENT '订单ID' AFTER id;");
}
