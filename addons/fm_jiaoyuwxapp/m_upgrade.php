<?php 
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wx_school_wxappset` (
`id` int(10) NOT NULL  AUTO_INCREMENT,
`weid` int(10) NOT NULL,
`schoolid` int(10) NOT NULL   COMMENT '学校ID',
`fromweid` int(10) NOT NULL   COMMENT '所属公众号',
`headtitle` varchar(50) NOT NULL   COMMENT '顶部标题',
`headcolor` varchar(10) NOT NULL   COMMENT '顶部背景颜色',
`headfont` varchar(10) NOT NULL   COMMENT '顶部字体颜色',
`imgname` varchar(50) NOT NULL   COMMENT '图标名',
`loginimg` varchar(1000) NOT NULL   COMMENT '图标地址',
`imgfontcolor` varchar(10) NOT NULL   COMMENT '图标名颜色',
`btnname` varchar(50) NOT NULL   COMMENT '按钮名',
`btncolor` varchar(1000) NOT NULL   COMMENT '按钮框颜色',
`btnfontcolor` varchar(10) NOT NULL   COMMENT '按钮名字体颜色',
`copyright` varchar(1000) NOT NULL   COMMENT '版权',
`copyrightfontcolor` varchar(10) NOT NULL   COMMENT '版权字体颜色',
`loginbgcolor` varchar(10) NOT NULL   COMMENT '背景颜色',
`loginbgimg` varchar(1000) NOT NULL   COMMENT '背景图片',
`bgtype` int(1) NOT NULL   COMMENT '背景模式',
`show_list` tinyint(1) NOT NULL DEFAULT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'id')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `id` int(10) NOT NULL  AUTO_INCREMENT;");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'weid')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `weid` int(10) NOT NULL;");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'schoolid')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `schoolid` int(10) NOT NULL   COMMENT '学校ID';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'fromweid')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `fromweid` int(10) NOT NULL   COMMENT '所属公众号';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'headtitle')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `headtitle` varchar(50) NOT NULL   COMMENT '顶部标题';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'headcolor')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `headcolor` varchar(10) NOT NULL   COMMENT '顶部背景颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'headfont')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `headfont` varchar(10) NOT NULL   COMMENT '顶部字体颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'imgname')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `imgname` varchar(50) NOT NULL   COMMENT '图标名';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'loginimg')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `loginimg` varchar(1000) NOT NULL   COMMENT '图标地址';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'imgfontcolor')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `imgfontcolor` varchar(10) NOT NULL   COMMENT '图标名颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'btnname')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `btnname` varchar(50) NOT NULL   COMMENT '按钮名';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'btncolor')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `btncolor` varchar(1000) NOT NULL   COMMENT '按钮框颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'btnfontcolor')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `btnfontcolor` varchar(10) NOT NULL   COMMENT '按钮名字体颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'copyright')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `copyright` varchar(1000) NOT NULL   COMMENT '版权';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'copyrightfontcolor')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `copyrightfontcolor` varchar(10) NOT NULL   COMMENT '版权字体颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'loginbgcolor')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `loginbgcolor` varchar(10) NOT NULL   COMMENT '背景颜色';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'loginbgimg')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `loginbgimg` varchar(1000) NOT NULL   COMMENT '背景图片';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'bgtype')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `bgtype` int(1) NOT NULL   COMMENT '背景模式';");
 }
}
if(pdo_tableexists('wx_school_wxappset')) {
 if(!pdo_fieldexists('wx_school_wxappset',  'show_list')) {
  pdo_query("ALTER TABLE ".tablename('wx_school_wxappset')." ADD `show_list` tinyint(1) NOT NULL DEFAULT NULL DEFAULT '1';");
 }
}
