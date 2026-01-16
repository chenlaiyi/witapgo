<?php
//即刻源码www.jikym.cn
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_activity_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(125) NOT NULL COMMENT '名称',
  `logo` varchar(255) NOT NULL COMMENT '图标',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` int(11) NOT NULL COMMENT '状态',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_sort` (`sort`),
  KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_activity_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `name` varchar(125) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `logo` varchar(255) NOT NULL COMMENT '图标'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `status` int(11) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   KEY `idx_sort` (`sort`)");}
if(!pdo_fieldexists('ims_wlmerchant_activity_category','idx_uniacid_aid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_category')." ADD   KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_activity_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态 1待使用 2已核销',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `activityid` int(11) NOT NULL COMMENT '活动id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `checkcode` varchar(145) NOT NULL COMMENT '验证码',
  `usetimes` int(11) NOT NULL COMMENT '剩余使用次数',
  `usedtime` text NOT NULL COMMENT '核销记录',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `orderid` int(11) DEFAULT NULL COMMENT '订单id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_activity_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `status` int(11) NOT NULL COMMENT '状态 1待使用 2已核销'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','activityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `activityid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `checkcode` varchar(145) NOT NULL COMMENT '验证码'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `usetimes` int(11) NOT NULL COMMENT '剩余使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','usedtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `usedtime` text NOT NULL COMMENT '核销记录'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_record','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_record')." ADD   `orderid` int(11) DEFAULT NULL COMMENT '订单id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_activity_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `activityid` int(11) NOT NULL COMMENT '活动id',
  `name` varchar(32) NOT NULL COMMENT '规格名',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `minnum` int(11) NOT NULL COMMENT '最小人数',
  `maxnum` int(11) NOT NULL COMMENT '最大人数',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '一级佣金',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '二级佣金',
  `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算佣金',
  `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT '会员结算佣金',
  `viparray` text NOT NULL COMMENT '会员减免数组',
  `disarray` text NOT NULL COMMENT '分销佣金数组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_activity_spec','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','activityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `activityid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `name` varchar(32) NOT NULL COMMENT '规格名'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `price` decimal(10,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','minnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `minnum` int(11) NOT NULL COMMENT '最小人数'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','maxnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `maxnum` int(11) NOT NULL COMMENT '最大人数'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '一级佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '二级佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT '会员结算佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `viparray` text NOT NULL COMMENT '会员减免数组'");}
if(!pdo_fieldexists('ims_wlmerchant_activity_spec','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activity_spec')." ADD   `disarray` text NOT NULL COMMENT '分销佣金数组'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_activitylist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商户id',
  `cateid` int(11) NOT NULL COMMENT '分类id',
  `status` int(11) NOT NULL COMMENT '状态 0下架中 1未开始报名 2报名中  3已结束 4被驳回 5待审核',
  `title` varchar(145) NOT NULL COMMENT '活动标题',
  `thumb` varchar(145) NOT NULL COMMENT '图片',
  `activestarttime` int(11) NOT NULL COMMENT '活动开始时间',
  `activeendtime` int(11) NOT NULL COMMENT '活动结束时间',
  `address` varchar(225) NOT NULL COMMENT '活动地址',
  `pv` int(11) NOT NULL COMMENT '活动浏览量',
  `sort` int(11) NOT NULL COMMENT '活动排序',
  `enrollstarttime` int(11) NOT NULL COMMENT '报名开始时间',
  `enrollendtime` int(11) NOT NULL COMMENT '报名结束时间',
  `maxpeoplenum` int(11) NOT NULL COMMENT '活动最大人数',
  `minpeoplenum` int(11) NOT NULL COMMENT '活动最小人数',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '报名费',
  `vipstatus` int(11) NOT NULL COMMENT 'vip设置 0无 1特价 2特供',
  `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip报名费',
  `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip结算价',
  `isdistri` int(11) NOT NULL COMMENT '是否参与分销 1参与 0不参与',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销',
  `threeurl` varchar(225) NOT NULL COMMENT '三方链接',
  `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐',
  `enrolldetail` text NOT NULL COMMENT '报名须知',
  `detail` longtext NOT NULL COMMENT '活动详情',
  `share_title` varchar(32) NOT NULL COMMENT '分享标题',
  `share_desc` varchar(32) NOT NULL COMMENT '分享详情',
  `share_image` varchar(255) NOT NULL COMMENT '分享图片',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `enrollnum` int(11) NOT NULL COMMENT '已经报名人数',
  `viponedismoney` decimal(10,2) NOT NULL COMMENT '一级佣金',
  `viptwodismoney` decimal(10,2) NOT NULL COMMENT '二级佣金',
  `vipthreedismoney` decimal(10,2) NOT NULL COMMENT '三级佣金',
  `addresstype` tinyint(1) NOT NULL COMMENT '0商户店内\n1其他地址',
  `lng` varchar(32) NOT NULL COMMENT '经度',
  `lat` varchar(32) NOT NULL COMMENT '纬度',
  `thumbs` text NOT NULL COMMENT '图集',
  `optionstatus` tinyint(1) NOT NULL COMMENT '是否多规格 0否 1是',
  `diyformid` int(11) NOT NULL COMMENT '自定义表单id',
  `advs` text NOT NULL COMMENT '幻灯片',
  `independent` int(11) NOT NULL COMMENT '是否独立结算 0是 1否',
  `dissettime` int(11) NOT NULL COMMENT '分销订单结算时间 0完成时结算 1支付时结算',
  `posterid` int(11) NOT NULL COMMENT '海报id',
  `onelimit` int(11) NOT NULL COMMENT '每个用户可报名数量',
  `viparray` text NOT NULL COMMENT '会员减免数组',
  `disarray` text NOT NULL COMMENT '分销商佣金数组',
  `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid_status` (`uniacid`,`id`,`status`),
  KEY `idx_sid` (`sid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_activitylist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `cateid` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `status` int(11) NOT NULL COMMENT '状态 0下架中 1未开始报名 2报名中  3已结束 4被驳回 5待审核'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `title` varchar(145) NOT NULL COMMENT '活动标题'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `thumb` varchar(145) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','activestarttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `activestarttime` int(11) NOT NULL COMMENT '活动开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','activeendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `activeendtime` int(11) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `address` varchar(225) NOT NULL COMMENT '活动地址'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `pv` int(11) NOT NULL COMMENT '活动浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `sort` int(11) NOT NULL COMMENT '活动排序'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','enrollstarttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `enrollstarttime` int(11) NOT NULL COMMENT '报名开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','enrollendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `enrollendtime` int(11) NOT NULL COMMENT '报名结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','maxpeoplenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `maxpeoplenum` int(11) NOT NULL COMMENT '活动最大人数'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','minpeoplenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `minpeoplenum` int(11) NOT NULL COMMENT '活动最小人数'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '报名费'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `vipstatus` int(11) NOT NULL COMMENT 'vip设置 0无 1特价 2特供'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip报名费'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip结算价'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与分销 1参与 0不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','threeurl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `threeurl` varchar(225) NOT NULL COMMENT '三方链接'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','bgmusic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','enrolldetail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `enrolldetail` text NOT NULL COMMENT '报名须知'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `detail` longtext NOT NULL COMMENT '活动详情'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `share_title` varchar(32) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `share_desc` varchar(32) NOT NULL COMMENT '分享详情'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `share_image` varchar(255) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','enrollnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `enrollnum` int(11) NOT NULL COMMENT '已经报名人数'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','viponedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `viponedismoney` decimal(10,2) NOT NULL COMMENT '一级佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','viptwodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `viptwodismoney` decimal(10,2) NOT NULL COMMENT '二级佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','vipthreedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `vipthreedismoney` decimal(10,2) NOT NULL COMMENT '三级佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','addresstype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `addresstype` tinyint(1) NOT NULL COMMENT '0商户店内\n1其他地址'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `lng` varchar(32) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `lat` varchar(32) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `thumbs` text NOT NULL COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','optionstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `optionstatus` tinyint(1) NOT NULL COMMENT '是否多规格 0否 1是'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','diyformid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `diyformid` int(11) NOT NULL COMMENT '自定义表单id'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','advs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `advs` text NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','independent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `independent` int(11) NOT NULL COMMENT '是否独立结算 0是 1否'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `dissettime` int(11) NOT NULL COMMENT '分销订单结算时间 0完成时结算 1支付时结算'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','posterid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `posterid` int(11) NOT NULL COMMENT '海报id'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','onelimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `onelimit` int(11) NOT NULL COMMENT '每个用户可报名数量'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `viparray` text NOT NULL COMMENT '会员减免数组'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `disarray` text NOT NULL COMMENT '分销商佣金数组'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','isdistristatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额'");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','idx_uniacid_aid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   KEY `idx_uniacid_aid_status` (`uniacid`,`id`,`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_activitylist','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_activitylist')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `status` int(11) NOT NULL COMMENT '状态 1默认',
  `name` varchar(125) NOT NULL COMMENT '收货人姓名',
  `tel` varchar(125) NOT NULL COMMENT '收货人电话',
  `province` varchar(45) NOT NULL COMMENT '省',
  `city` varchar(45) NOT NULL COMMENT '市',
  `county` varchar(45) NOT NULL COMMENT '县区',
  `detailed_address` text NOT NULL COMMENT '创建时间',
  `addtime` varchar(125) NOT NULL COMMENT '最后更新时间',
  `lng` varchar(32) NOT NULL COMMENT '所在位置经度',
  `lat` varchar(32) NOT NULL COMMENT '所在位置纬度',
  `housenumber` varchar(255) NOT NULL COMMENT '门牌号',
  PRIMARY KEY (`id`),
  KEY `idx_mid_uniacid` (`mid`,`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_address','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_address','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_address','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_address','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_address','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `status` int(11) NOT NULL COMMENT '状态 1默认'");}
if(!pdo_fieldexists('ims_wlmerchant_address','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `name` varchar(125) NOT NULL COMMENT '收货人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_address','tel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `tel` varchar(125) NOT NULL COMMENT '收货人电话'");}
if(!pdo_fieldexists('ims_wlmerchant_address','province')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `province` varchar(45) NOT NULL COMMENT '省'");}
if(!pdo_fieldexists('ims_wlmerchant_address','city')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `city` varchar(45) NOT NULL COMMENT '市'");}
if(!pdo_fieldexists('ims_wlmerchant_address','county')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `county` varchar(45) NOT NULL COMMENT '县区'");}
if(!pdo_fieldexists('ims_wlmerchant_address','detailed_address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `detailed_address` text NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_address','addtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `addtime` varchar(125) NOT NULL COMMENT '最后更新时间'");}
if(!pdo_fieldexists('ims_wlmerchant_address','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `lng` varchar(32) NOT NULL COMMENT '所在位置经度'");}
if(!pdo_fieldexists('ims_wlmerchant_address','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `lat` varchar(32) NOT NULL COMMENT '所在位置纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_address','housenumber')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   `housenumber` varchar(255) NOT NULL COMMENT '门牌号'");}
if(!pdo_fieldexists('ims_wlmerchant_address','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_address','idx_mid_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_address')." ADD   KEY `idx_mid_uniacid` (`mid`,`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `advname` varchar(50) NOT NULL COMMENT '幻灯片名称',
  `link` varchar(255) NOT NULL COMMENT '幻灯片链接',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '幻灯片图片',
  `displayorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1显示',
  `type` int(11) NOT NULL COMMENT '幻灯片类型 -1=首页，1=好店首页，2=卡卷首页，4=抢购首页，6=活动首页，7=团购首页，8=拼团首页，9=砍价首页，10=头条首页，11=名片首页',
  `cateid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid_enabled` (`uniacid`,`aid`,`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_adv','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_adv','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_adv','advname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `advname` varchar(50) NOT NULL COMMENT '幻灯片名称'");}
if(!pdo_fieldexists('ims_wlmerchant_adv','link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `link` varchar(255) NOT NULL COMMENT '幻灯片链接'");}
if(!pdo_fieldexists('ims_wlmerchant_adv','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '幻灯片图片'");}
if(!pdo_fieldexists('ims_wlmerchant_adv','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `displayorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_adv','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `enabled` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_adv','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `type` int(11) NOT NULL COMMENT '幻灯片类型 -1=首页，1=好店首页，2=卡卷首页，4=抢购首页，6=活动首页，7=团购首页，8=拼团首页，9=砍价首页，10=头条首页，11=名片首页'");}
if(!pdo_fieldexists('ims_wlmerchant_adv','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   `cateid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_adv','idx_uniacid_aid_enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_adv')." ADD   KEY `idx_uniacid_aid_enabled` (`uniacid`,`aid`,`enabled`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_aftersale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户mid',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `status` int(11) NOT NULL COMMENT '状态 1申请中 2处理中 3已驳回 4用户取消',
  `orderid` int(11) NOT NULL COMMENT '订单id',
  `orderno` varchar(145) NOT NULL COMMENT '订单号',
  `plugin` varchar(32) NOT NULL COMMENT '商品插件',
  `type` int(11) NOT NULL COMMENT '处理方式 1退款 2换货 3退货退款',
  `checkcodes` varchar(255) NOT NULL COMMENT '核销码编号',
  `reason` text NOT NULL COMMENT '申请原因',
  `detail` text NOT NULL COMMENT '详细描述',
  `reply` text NOT NULL COMMENT '店家回复',
  `thumbs` text NOT NULL COMMENT '上传图集',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `dotime` int(11) NOT NULL COMMENT '操作时间',
  `journal` text NOT NULL COMMENT '日志',
  `num` int(11) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `idx_orderid` (`orderid`),
  KEY `idx_uniacid_status` (`uniacid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_aftersale','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `mid` int(11) NOT NULL COMMENT '用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `status` int(11) NOT NULL COMMENT '状态 1申请中 2处理中 3已驳回 4用户取消'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `orderid` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `plugin` varchar(32) NOT NULL COMMENT '商品插件'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `type` int(11) NOT NULL COMMENT '处理方式 1退款 2换货 3退货退款'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','checkcodes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `checkcodes` varchar(255) NOT NULL COMMENT '核销码编号'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `reason` text NOT NULL COMMENT '申请原因'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `detail` text NOT NULL COMMENT '详细描述'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','reply')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `reply` text NOT NULL COMMENT '店家回复'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `thumbs` text NOT NULL COMMENT '上传图集'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `dotime` int(11) NOT NULL COMMENT '操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','journal')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `journal` text NOT NULL COMMENT '日志'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   `num` int(11) DEFAULT NULL COMMENT '数量'");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_aftersale','idx_orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_aftersale')." ADD   KEY `idx_orderid` (`orderid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_agentadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `openid` varchar(100) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户表id',
  `notice` int(11) NOT NULL COMMENT '通知权限 0无 1有',
  `manage` int(11) NOT NULL COMMENT '管理权限 0无 1有',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `account` varchar(20) NOT NULL COMMENT '代理商员工登录账号',
  `password` varchar(32) NOT NULL COMMENT '代理商员工登录密码',
  `jurisdiction` text NOT NULL COMMENT '代理商员工的操作权限',
  `noticeauthority` text NOT NULL COMMENT '代理商员工接受通知内容权限',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_agentadmin','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `openid` varchar(100) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `mid` int(11) NOT NULL COMMENT '用户表id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','notice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `notice` int(11) NOT NULL COMMENT '通知权限 0无 1有'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','manage')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `manage` int(11) NOT NULL COMMENT '管理权限 0无 1有'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','account')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `account` varchar(20) NOT NULL COMMENT '代理商员工登录账号'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','password')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `password` varchar(32) NOT NULL COMMENT '代理商员工登录密码'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','jurisdiction')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `jurisdiction` text NOT NULL COMMENT '代理商员工的操作权限'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','noticeauthority')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   `noticeauthority` text NOT NULL COMMENT '代理商员工接受通知内容权限'");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_agentadmin','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentadmin')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_agentsetting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `key` varchar(64) NOT NULL COMMENT '设置项目',
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_agentsetting','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_agentsetting','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentsetting','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentsetting','key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD   `key` varchar(64) NOT NULL COMMENT '设置项目'");}
if(!pdo_fieldexists('ims_wlmerchant_agentsetting','value')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD   `value` longtext NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentsetting','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_agentsetting','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentsetting')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_agentusers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `groupid` int(10) unsigned NOT NULL COMMENT '代理分组id',
  `agentname` varchar(64) NOT NULL COMMENT '代理名称',
  `username` varchar(32) NOT NULL COMMENT '代理账号',
  `password` varchar(64) NOT NULL COMMENT '账号密码',
  `salt` varchar(10) NOT NULL COMMENT '加密盐',
  `realname` varchar(32) NOT NULL COMMENT '联系人名称',
  `mobile` varchar(32) NOT NULL COMMENT '联系人电话',
  `status` tinyint(4) NOT NULL COMMENT '代理状态',
  `joindate` int(10) unsigned NOT NULL COMMENT '添加时间',
  `joinip` varchar(15) NOT NULL COMMENT '添加ip',
  `lastvisit` int(10) unsigned NOT NULL COMMENT '上次登录时间',
  `lastip` varchar(15) NOT NULL COMMENT '上次登录ip',
  `remark` varchar(500) NOT NULL COMMENT '备注',
  `starttime` int(10) unsigned NOT NULL COMMENT '有效期开始时间',
  `endtime` int(12) unsigned NOT NULL COMMENT '有效期结束时间',
  `type` tinyint(3) unsigned NOT NULL,
  `percent` varchar(200) NOT NULL COMMENT '提现手续费',
  `cashopenid` varchar(200) NOT NULL COMMENT '打款人openid',
  `allmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总计金额',
  `nowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现有金额',
  `payment_type` tinyint(1) NOT NULL COMMENT '代理商收款方式(1=支付宝，2=微信，3=银行卡)',
  `bank_name` varchar(50) NOT NULL COMMENT '代理商银行卡开户行信息',
  `card_number` varchar(20) NOT NULL COMMENT '代理商银行卡账号信息\n',
  `alipay` varchar(20) NOT NULL COMMENT '代理商支付宝账号信息',
  `bank_username` varchar(20) NOT NULL COMMENT '代理商银行卡开户人的姓名',
  `wxmerchantid` int(11) NOT NULL COMMENT '微信端分账商户id',
  `wxmerchantname` varchar(500) NOT NULL COMMENT '微信端分账商户名称',
  `wxallmid` int(11) NOT NULL COMMENT '微信端分账个人用户mid',
  `appmerchantid` int(11) NOT NULL COMMENT '小程序端分账商户id',
  `appmerchantname` varchar(500) NOT NULL COMMENT '小程序端分账商户名称',
  `appallmid` int(11) NOT NULL COMMENT '小程序端分账用户mid',
  `wxsysalltype` int(11) NOT NULL COMMENT '微信端分账账号类型 1商户 2个人',
  `appsysalltype` int(11) NOT NULL COMMENT '小程序端分账账号类型 1商户 2个人',
  `wxpaysetid` int(11) NOT NULL COMMENT '微信公众号支付信息id',
  `apppaysetid` int(11) NOT NULL COMMENT '微信小程序支付信息id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_status` (`uniacid`,`status`),
  KEY `idx_username` (`username`),
  KEY `idx_starttime` (`starttime`)
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_agentusers','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','groupid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `groupid` int(10) unsigned NOT NULL COMMENT '代理分组id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','agentname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `agentname` varchar(64) NOT NULL COMMENT '代理名称'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `username` varchar(32) NOT NULL COMMENT '代理账号'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','password')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `password` varchar(64) NOT NULL COMMENT '账号密码'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','salt')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `salt` varchar(10) NOT NULL COMMENT '加密盐'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','realname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `realname` varchar(32) NOT NULL COMMENT '联系人名称'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `mobile` varchar(32) NOT NULL COMMENT '联系人电话'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `status` tinyint(4) NOT NULL COMMENT '代理状态'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','joindate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `joindate` int(10) unsigned NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','joinip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `joinip` varchar(15) NOT NULL COMMENT '添加ip'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','lastvisit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `lastvisit` int(10) unsigned NOT NULL COMMENT '上次登录时间'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','lastip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `lastip` varchar(15) NOT NULL COMMENT '上次登录ip'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `remark` varchar(500) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `starttime` int(10) unsigned NOT NULL COMMENT '有效期开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `endtime` int(12) unsigned NOT NULL COMMENT '有效期结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `type` tinyint(3) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','percent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `percent` varchar(200) NOT NULL COMMENT '提现手续费'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','cashopenid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `cashopenid` varchar(200) NOT NULL COMMENT '打款人openid'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','allmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `allmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总计金额'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','nowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `nowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现有金额'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','payment_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `payment_type` tinyint(1) NOT NULL COMMENT '代理商收款方式(1=支付宝，2=微信，3=银行卡)'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','bank_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `bank_name` varchar(50) NOT NULL COMMENT '代理商银行卡开户行信息'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','card_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `card_number` varchar(20) NOT NULL COMMENT '代理商银行卡账号信息\n'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','alipay')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `alipay` varchar(20) NOT NULL COMMENT '代理商支付宝账号信息'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','bank_username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `bank_username` varchar(20) NOT NULL COMMENT '代理商银行卡开户人的姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','wxmerchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `wxmerchantid` int(11) NOT NULL COMMENT '微信端分账商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','wxmerchantname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `wxmerchantname` varchar(500) NOT NULL COMMENT '微信端分账商户名称'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','wxallmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `wxallmid` int(11) NOT NULL COMMENT '微信端分账个人用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','appmerchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `appmerchantid` int(11) NOT NULL COMMENT '小程序端分账商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','appmerchantname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `appmerchantname` varchar(500) NOT NULL COMMENT '小程序端分账商户名称'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','appallmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `appallmid` int(11) NOT NULL COMMENT '小程序端分账用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','wxsysalltype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `wxsysalltype` int(11) NOT NULL COMMENT '微信端分账账号类型 1商户 2个人'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','appsysalltype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `appsysalltype` int(11) NOT NULL COMMENT '小程序端分账账号类型 1商户 2个人'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','wxpaysetid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `wxpaysetid` int(11) NOT NULL COMMENT '微信公众号支付信息id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','apppaysetid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   `apppaysetid` int(11) NOT NULL COMMENT '微信小程序支付信息id'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','idx_uniacid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   KEY `idx_uniacid_status` (`uniacid`,`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers','idx_username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers')." ADD   KEY `idx_username` (`username`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_agentusers_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '分组名称',
  `package` varchar(5000) NOT NULL COMMENT '开启权限',
  `isdefault` int(2) unsigned NOT NULL COMMENT '是否默认',
  `enabled` int(2) unsigned NOT NULL COMMENT '是否开启',
  `createtime` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   `uniacid` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   `name` varchar(50) NOT NULL COMMENT '分组名称'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','package')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   `package` varchar(5000) NOT NULL COMMENT '开启权限'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','isdefault')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   `isdefault` int(2) unsigned NOT NULL COMMENT '是否默认'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   `enabled` int(2) unsigned NOT NULL COMMENT '是否开启'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   `createtime` int(11) unsigned NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_agentusers_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_agentusers_group')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_apirecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sendmid` int(11) NOT NULL COMMENT '发送人mid  -1指系统',
  `sendmobile` varchar(15) NOT NULL COMMENT '发送的手机号',
  `takemid` int(11) NOT NULL COMMENT '获取短信人mid',
  `takemobile` varchar(15) NOT NULL COMMENT '获取短信的手机号',
  `type` smallint(2) NOT NULL COMMENT '类型',
  `remark` varchar(32) NOT NULL COMMENT '备注',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_apirecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','sendmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `sendmid` int(11) NOT NULL COMMENT '发送人mid  -1指系统'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','sendmobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `sendmobile` varchar(15) NOT NULL COMMENT '发送的手机号'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','takemid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `takemid` int(11) NOT NULL COMMENT '获取短信人mid'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','takemobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `takemobile` varchar(15) NOT NULL COMMENT '获取短信的手机号'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `type` smallint(2) NOT NULL COMMENT '类型'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `remark` varchar(32) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_apirecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_apirecord')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_applydistributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '申请人MID',
  `realname` text NOT NULL COMMENT '申请人姓名',
  `mobile` varchar(100) NOT NULL COMMENT '申请人电话',
  `status` int(11) NOT NULL COMMENT '申请状态 0待审核 1已通过 2被驳回',
  `createtime` varchar(145) NOT NULL COMMENT '申请时间',
  `reason` text NOT NULL COMMENT '驳回原因',
  `rank` int(11) NOT NULL COMMENT '申请层级',
  `leadid` int(11) NOT NULL DEFAULT '-1' COMMENT '邀请人id',
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_uniacid_status` (`uniacid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_applydistributor','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `mid` int(11) NOT NULL COMMENT '申请人MID'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','realname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `realname` text NOT NULL COMMENT '申请人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `mobile` varchar(100) NOT NULL COMMENT '申请人电话'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `status` int(11) NOT NULL COMMENT '申请状态 0待审核 1已通过 2被驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `createtime` varchar(145) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `reason` text NOT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','rank')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `rank` int(11) NOT NULL COMMENT '申请层级'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','leadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   `leadid` int(11) NOT NULL DEFAULT '-1' COMMENT '邀请人id'");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_applydistributor','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_applydistributor')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_appointlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL COMMENT '订单id',
  `mid` int(11) NOT NULL COMMENT '用户mid',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `type` int(11) NOT NULL COMMENT '类型 1抢购 2团购 3拼团 5卡券 7砍价 4家政',
  `goodid` int(11) NOT NULL COMMENT '商品id',
  `num` int(11) NOT NULL COMMENT '预约数量',
  `date` varchar(32) NOT NULL COMMENT '日期',
  `starttime` varchar(32) NOT NULL COMMENT '开始时间',
  `endtime` varchar(32) NOT NULL COMMENT '结束时间',
  `status` int(11) NOT NULL COMMENT '预约状态 0申请中 1已预约  2已驳回 3用户已取消 4商户已取消',
  `appointtime` int(11) NOT NULL COMMENT '预约时间',
  `reason` varchar(255) NOT NULL COMMENT '驳回原因',
  `sorderids` varchar(255) NOT NULL COMMENT '核销码id集',
  `orderno` varchar(32) NOT NULL COMMENT '订单编号',
  `dotime` int(11) NOT NULL COMMENT '操作时间',
  `starttimestamp` int(11) NOT NULL COMMENT '开始时间戳',
  `endtimestamp` int(11) NOT NULL COMMENT '结束时间时间戳',
  `remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_appointlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `orderid` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `mid` int(11) NOT NULL COMMENT '用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `type` int(11) NOT NULL COMMENT '类型 1抢购 2团购 3拼团 5卡券 7砍价 4家政'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','goodid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `goodid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `num` int(11) NOT NULL COMMENT '预约数量'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','date')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `date` varchar(32) NOT NULL COMMENT '日期'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `starttime` varchar(32) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `endtime` varchar(32) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `status` int(11) NOT NULL COMMENT '预约状态 0申请中 1已预约  2已驳回 3用户已取消 4商户已取消'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','appointtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `appointtime` int(11) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `reason` varchar(255) NOT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','sorderids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `sorderids` varchar(255) NOT NULL COMMENT '核销码id集'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `orderno` varchar(32) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `dotime` int(11) NOT NULL COMMENT '操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','starttimestamp')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `starttimestamp` int(11) NOT NULL COMMENT '开始时间戳'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','endtimestamp')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `endtimestamp` int(11) NOT NULL COMMENT '结束时间时间戳'");}
if(!pdo_fieldexists('ims_wlmerchant_appointlist','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_appointlist')." ADD   `remark` text NOT NULL COMMENT '备注'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL COMMENT '上级地区的id\n',
  `name` varchar(50) NOT NULL COMMENT '地区名称',
  `visible` tinyint(4) unsigned NOT NULL COMMENT '状态',
  `displayorder` int(11) NOT NULL,
  `level` tinyint(3) unsigned NOT NULL COMMENT '地区级别',
  `lat` varchar(16) NOT NULL COMMENT '经度',
  `lng` varchar(16) NOT NULL COMMENT '纬度',
  `pinyin` varchar(32) NOT NULL COMMENT '拼音',
  `initial` varchar(2) NOT NULL COMMENT '首字母',
  PRIMARY KEY (`id`),
  KEY `idx_visible` (`visible`),
  KEY `idx_pid` (`pid`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=InnoDB AUTO_INCREMENT=620200404 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_area','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_area','pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `pid` int(11) unsigned NOT NULL COMMENT '上级地区的id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_area','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `name` varchar(50) NOT NULL COMMENT '地区名称'");}
if(!pdo_fieldexists('ims_wlmerchant_area','visible')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `visible` tinyint(4) unsigned NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_area','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `displayorder` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_area','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `level` tinyint(3) unsigned NOT NULL COMMENT '地区级别'");}
if(!pdo_fieldexists('ims_wlmerchant_area','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `lat` varchar(16) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_area','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `lng` varchar(16) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_area','pinyin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `pinyin` varchar(32) NOT NULL COMMENT '拼音'");}
if(!pdo_fieldexists('ims_wlmerchant_area','initial')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   `initial` varchar(2) NOT NULL COMMENT '首字母'");}
if(!pdo_fieldexists('ims_wlmerchant_area','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_area','idx_visible')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   KEY `idx_visible` (`visible`)");}
if(!pdo_fieldexists('ims_wlmerchant_area','idx_pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_area')." ADD   KEY `idx_pid` (`pid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_areagroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '地区分组名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_areagroup','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_areagroup')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_areagroup','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_areagroup')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_areagroup','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_areagroup')." ADD   `name` varchar(50) NOT NULL COMMENT '地区分组名称'");}
if(!pdo_fieldexists('ims_wlmerchant_areagroup','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_areagroup')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_areagroup','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_areagroup')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_areagroup','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_areagroup')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_attachment` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uniacid` int(11) NOT NULL,
  `aid` int(10) unsigned DEFAULT '0' COMMENT '代理商id',
  `shop_id` int(10) unsigned DEFAULT '0' COMMENT '商户id',
  `group_id` int(10) DEFAULT '0' COMMENT '文件分组id',
  `name` varchar(255) DEFAULT NULL COMMENT '附件名称',
  `url` varchar(255) NOT NULL COMMENT '图片名称(图片地址)',
  `imagewidth` varchar(10) DEFAULT NULL COMMENT '宽度',
  `imageheight` varchar(10) DEFAULT NULL COMMENT '高度',
  `suffix` char(10) NOT NULL COMMENT '文件后缀',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `mimetype` varchar(100) NOT NULL COMMENT 'mime类型',
  `uploadtime` int(10) DEFAULT NULL COMMENT '上传时间',
  `storage` varchar(100) NOT NULL DEFAULT '0' COMMENT '存储位置：0=本地;1=FTP服务器;2=阿里云;3=七牛云存储;4=腾讯云存储',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_attachment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD 
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `aid` int(10) unsigned DEFAULT '0' COMMENT '代理商id'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','shop_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `shop_id` int(10) unsigned DEFAULT '0' COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','group_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `group_id` int(10) DEFAULT '0' COMMENT '文件分组id'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `name` varchar(255) DEFAULT NULL COMMENT '附件名称'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `url` varchar(255) NOT NULL COMMENT '图片名称(图片地址)'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','imagewidth')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `imagewidth` varchar(10) DEFAULT NULL COMMENT '宽度'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','imageheight')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `imageheight` varchar(10) DEFAULT NULL COMMENT '高度'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','suffix')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `suffix` char(10) NOT NULL COMMENT '文件后缀'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','filesize')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','mimetype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `mimetype` varchar(100) NOT NULL COMMENT 'mime类型'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','uploadtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `uploadtime` int(10) DEFAULT NULL COMMENT '上传时间'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment','storage')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment')." ADD   `storage` varchar(100) NOT NULL DEFAULT '0' COMMENT '存储位置：0=本地;1=FTP服务器;2=阿里云;3=七牛云存储;4=腾讯云存储'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_attachment_group` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  `shop_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '分组类型:1=图片,2=视频,3=文件',
  `name` varchar(50) NOT NULL COMMENT '分组名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_attachment_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment_group')." ADD 
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment_group','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment_group')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_attachment_group','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment_group')." ADD   `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment_group','shop_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment_group')." ADD   `shop_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment_group','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment_group')." ADD   `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '分组类型:1=图片,2=视频,3=文件'");}
if(!pdo_fieldexists('ims_wlmerchant_attachment_group','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attachment_group')." ADD   `name` varchar(50) NOT NULL COMMENT '分组名称'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_attestation_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id\n',
  `mid` int(11) NOT NULL COMMENT '申请人id',
  `storeid` int(11) NOT NULL COMMENT '店铺id',
  `type` tinyint(1) NOT NULL COMMENT '类型 1个人认证 2商户认证',
  `cardnum` varchar(64) NOT NULL COMMENT '身份证号或营业执照号',
  `pic` text NOT NULL COMMENT '素材图片',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL COMMENT '状态 1开启 0关闭',
  `updatetime` int(11) NOT NULL COMMENT '修改时间',
  `checkstatus` int(11) NOT NULL COMMENT '审核状态 1待审核 2已审核 3被驳回',
  `aid` int(11) DEFAULT '0',
  `moreinfo` text NOT NULL COMMENT '更多信息',
  `subjectname` varchar(255) NOT NULL COMMENT '主体名称',
  `atttel` varchar(32) NOT NULL COMMENT '认证电话',
  `remake` varchar(355) NOT NULL COMMENT '驳回原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_attestation_list','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `mid` int(11) NOT NULL COMMENT '申请人id'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `storeid` int(11) NOT NULL COMMENT '店铺id'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `type` tinyint(1) NOT NULL COMMENT '类型 1个人认证 2商户认证'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','cardnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `cardnum` varchar(64) NOT NULL COMMENT '身份证号或营业执照号'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','pic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `pic` text NOT NULL COMMENT '素材图片'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 1开启 0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `updatetime` int(11) NOT NULL COMMENT '修改时间'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','checkstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `checkstatus` int(11) NOT NULL COMMENT '审核状态 1待审核 2已审核 3被驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `aid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','moreinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `moreinfo` text NOT NULL COMMENT '更多信息'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','subjectname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `subjectname` varchar(255) NOT NULL COMMENT '主体名称'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','atttel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `atttel` varchar(32) NOT NULL COMMENT '认证电话'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_list','remake')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_list')." ADD   `remake` varchar(355) NOT NULL COMMENT '驳回原因'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_attestation_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `status` int(11) NOT NULL COMMENT '状态 0未交费 1已缴费',
  `mid` int(11) NOT NULL COMMENT '用户mid',
  `storeid` int(11) NOT NULL COMMENT '商户mid',
  `type` int(11) NOT NULL COMMENT '保证金类型 1个人 2商户',
  `money` decimal(10,2) NOT NULL COMMENT '保证金金额',
  `orderno` varchar(145) NOT NULL COMMENT '订单编号',
  `transid` varchar(145) NOT NULL COMMENT '三方单号',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `paytime` int(11) NOT NULL COMMENT '支付时间',
  `paytype` int(11) NOT NULL COMMENT '支付方式 1余额 2微信 3支付宝',
  `refundflag` int(11) NOT NULL COMMENT '退款标志 1已退款 0未退款',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_attestation_money','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `status` int(11) NOT NULL COMMENT '状态 0未交费 1已缴费'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `mid` int(11) NOT NULL COMMENT '用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `storeid` int(11) NOT NULL COMMENT '商户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `type` int(11) NOT NULL COMMENT '保证金类型 1个人 2商户'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `money` decimal(10,2) NOT NULL COMMENT '保证金金额'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `transid` varchar(145) NOT NULL COMMENT '三方单号'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','paytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `paytime` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `paytype` int(11) NOT NULL COMMENT '支付方式 1余额 2微信 3支付宝'");}
if(!pdo_fieldexists('ims_wlmerchant_attestation_money','refundflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_attestation_money')." ADD   `refundflag` int(11) NOT NULL COMMENT '退款标志 1已退款 0未退款'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_autosettlement_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录id\n',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `type` int(11) NOT NULL COMMENT '类型 1抢购 2拼团 3卡券 4一卡通订单 5掌上信息 6付费入驻  7提现或驳回 8分销付费申请 9商户活动 10团购 -1后台修改',
  `merchantid` int(11) NOT NULL COMMENT '商户id',
  `orderid` int(11) NOT NULL COMMENT '订单id',
  `orderno` varchar(145) NOT NULL COMMENT '订单编号',
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单实际金额',
  `agentmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '代理收入',
  `merchantmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商户结算收入',
  `distrimoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '给分销商的金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `merchantnowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '修改后商户现有金额',
  `agentnowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '修改后代理现有金额',
  `specialstatus` int(11) NOT NULL COMMENT '特殊状态 0正常订单 1过期订单',
  `sharemoney` decimal(10,2) NOT NULL COMMENT '分享分佣金额',
  `checkcode` int(11) NOT NULL COMMENT '结算验证码',
  `salesmoney` decimal(10,2) NOT NULL COMMENT '业务员佣金',
  `sysmoney` decimal(10,2) NOT NULL COMMENT '系统抽佣',
  `allocationtype` int(11) NOT NULL COMMENT '分账方式 0系统平台 1服务商分账',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_merchantid` (`merchantid`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `type` int(11) NOT NULL COMMENT '类型 1抢购 2拼团 3卡券 4一卡通订单 5掌上信息 6付费入驻  7提现或驳回 8分销付费申请 9商户活动 10团购 -1后台修改'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `merchantid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `orderid` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','orderprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单实际金额'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','agentmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `agentmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '代理收入'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','merchantmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `merchantmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商户结算收入'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','distrimoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `distrimoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '给分销商的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','merchantnowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `merchantnowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '修改后商户现有金额'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','agentnowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `agentnowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '修改后代理现有金额'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','specialstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `specialstatus` int(11) NOT NULL COMMENT '特殊状态 0正常订单 1过期订单'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','sharemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `sharemoney` decimal(10,2) NOT NULL COMMENT '分享分佣金额'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `checkcode` int(11) NOT NULL COMMENT '结算验证码'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','salesmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `salesmoney` decimal(10,2) NOT NULL COMMENT '业务员佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','sysmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `sysmoney` decimal(10,2) NOT NULL COMMENT '系统抽佣'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','allocationtype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   `allocationtype` int(11) NOT NULL COMMENT '分账方式 0系统平台 1服务商分账'");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_autosettlement_record','idx_merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_autosettlement_record')." ADD   KEY `idx_merchantid` (`merchantid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL COMMENT '广告名称',
  `link` varchar(255) NOT NULL COMMENT '广告链接',
  `thumb` varchar(255) NOT NULL COMMENT '广告图片',
  `displayorder` int(11) NOT NULL COMMENT '排序',
  `enabled` int(11) NOT NULL COMMENT '状态 1显示 0隐藏',
  `visible_level` varchar(145) NOT NULL COMMENT '1强制推广',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_banner','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_banner','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_banner','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `name` varchar(32) NOT NULL COMMENT '广告名称'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `link` varchar(255) NOT NULL COMMENT '广告链接'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `thumb` varchar(255) NOT NULL COMMENT '广告图片'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `displayorder` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `enabled` int(11) NOT NULL COMMENT '状态 1显示 0隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','visible_level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   `visible_level` varchar(145) NOT NULL COMMENT '1强制推广'");}
if(!pdo_fieldexists('ims_wlmerchant_banner','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_banner','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_banner')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_bargain_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '商品名称',
  `status` int(11) NOT NULL COMMENT '活动状态 0下架中 1未开始 2进行中 3已结束 5待审核 6未通过',
  `cateid` int(11) NOT NULL COMMENT '分类id',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `oldprice` decimal(10,2) NOT NULL COMMENT '商品原价',
  `price` decimal(10,2) NOT NULL COMMENT '商品底价',
  `vipprice` decimal(10,2) NOT NULL COMMENT '会员底价',
  `submitmoneylimit` decimal(10,2) NOT NULL COMMENT '允许提交订单的金额',
  `starttime` int(11) NOT NULL COMMENT '活动开始时间',
  `endtime` int(11) NOT NULL COMMENT '活动结束时间',
  `helplimit` int(11) NOT NULL COMMENT '好友帮砍限制数量',
  `dayhelpcount` int(11) NOT NULL COMMENT '每天帮砍好友人数限制',
  `joinlimit` int(11) NOT NULL COMMENT '参加人数限制',
  `falsejoinnum` int(11) NOT NULL COMMENT '虚拟参与人数',
  `falselooknum` int(11) NOT NULL COMMENT '虚拟浏览量',
  `falsesharenum` int(11) NOT NULL COMMENT '虚拟分享次数',
  `code` varchar(50) NOT NULL COMMENT '商品编号',
  `thumb` varchar(255) NOT NULL COMMENT '海报图片',
  `thumbs` text NOT NULL COMMENT '幻灯片',
  `unit` varchar(45) NOT NULL COMMENT '商品单位',
  `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐',
  `detail` longtext NOT NULL COMMENT '商品详情',
  `rules` text NOT NULL COMMENT '砍价规则',
  `vipstatus` int(11) NOT NULL COMMENT '会员设置',
  `share_image` varchar(255) NOT NULL COMMENT '分享图片',
  `share_title` varchar(1000) NOT NULL COMMENT '分享标题',
  `share_desc` varchar(1000) NOT NULL COMMENT '分享描述',
  `settlementmoney` decimal(10,2) NOT NULL COMMENT '一般结算价格',
  `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT '会员结算价格',
  `isdistri` int(11) NOT NULL COMMENT '是否参与分销',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '普通一级分销金额',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '普通二级分销金额',
  `viponedismoney` decimal(10,2) NOT NULL COMMENT '会员一级分销金额',
  `viptwodismoney` decimal(10,2) NOT NULL COMMENT '会员二级分销金额',
  `userlabel` text NOT NULL COMMENT '用户标签',
  `stock` int(11) NOT NULL COMMENT '商品库存',
  `sort` int(11) NOT NULL COMMENT '商品排序',
  `pv` int(11) NOT NULL COMMENT '真实浏览量',
  `sharenum` int(11) NOT NULL COMMENT '真实分享数',
  `usestatus` int(11) NOT NULL COMMENT '消费方式',
  `expressid` int(11) NOT NULL COMMENT '运费模板id',
  `independent` int(11) NOT NULL COMMENT '独立结算金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许',
  `level` text NOT NULL COMMENT '适用会员等级',
  `onlytimes` int(11) NOT NULL COMMENT '单个用户可以砍价次数',
  `dissettime` int(11) NOT NULL COMMENT '结算时间',
  `diyposter` int(11) NOT NULL COMMENT '自定义海报id',
  `overrefund` tinyint(1) NOT NULL COMMENT '过期退款',
  `cutoffstatus` int(11) NOT NULL COMMENT '消费截止时间方式 1固定时间 2购买后天数',
  `cutofftime` int(11) NOT NULL COMMENT '固定时间',
  `cutoffday` int(11) NOT NULL COMMENT '购买后天数',
  `describe` text NOT NULL COMMENT '购买须知',
  `integral` int(11) NOT NULL COMMENT '赠送积分',
  `creditmoney` decimal(10,2) NOT NULL COMMENT '抵扣金额',
  `appointment` int(11) NOT NULL COMMENT '提前预约',
  `is_indexshow` int(11) NOT NULL COMMENT '是否首页显示',
  `tag` text NOT NULL COMMENT '标签',
  `falseorder` text NOT NULL COMMENT '虚拟订单',
  `communityid` int(11) NOT NULL COMMENT '社群id',
  `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片',
  `is_describe_tip` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)',
  `extension_text` text NOT NULL COMMENT '推广文案',
  `extension_img` text NOT NULL COMMENT '推广图片路径',
  `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式',
  `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)',
  `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `paidid` int(11) NOT NULL COMMENT '支付有礼活动id',
  `usedatestatus` tinyint(1) NOT NULL COMMENT '定时购买 1按星期 2按天数',
  `week` varchar(355) NOT NULL COMMENT '按星期时间',
  `day` varchar(355) NOT NULL COMMENT '按天数时间',
  `viparray` text NOT NULL COMMENT '会员减免数组',
  `disarray` text NOT NULL COMMENT '分销商佣金数组',
  `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id',
  `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额',
  `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启',
  `appointdays` int(11) NOT NULL COMMENT '可预约天数',
  `appointarray` text COMMENT '预约数组',
  `videourl` varchar(255) NOT NULL COMMENT '视频链接',
  `yuecashback` decimal(10,2) NOT NULL COMMENT '普通用户余额返现',
  `vipyuecashback` decimal(10,2) NOT NULL COMMENT '会员余额返现',
  `checkcodeflag` tinyint(2) DEFAULT NULL COMMENT '核销码类型 0系统核销码 1导入核销码',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`),
  KEY `idx_sort` (`sort`),
  KEY `idx_sid` (`sid`),
  KEY `idx_cateid` (`cateid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='砍价商品表';

");

if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `name` varchar(50) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `status` int(11) NOT NULL COMMENT '活动状态 0下架中 1未开始 2进行中 3已结束 5待审核 6未通过'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `cateid` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `oldprice` decimal(10,2) NOT NULL COMMENT '商品原价'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `price` decimal(10,2) NOT NULL COMMENT '商品底价'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `vipprice` decimal(10,2) NOT NULL COMMENT '会员底价'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','submitmoneylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `submitmoneylimit` decimal(10,2) NOT NULL COMMENT '允许提交订单的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `starttime` int(11) NOT NULL COMMENT '活动开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `endtime` int(11) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','helplimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `helplimit` int(11) NOT NULL COMMENT '好友帮砍限制数量'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','dayhelpcount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `dayhelpcount` int(11) NOT NULL COMMENT '每天帮砍好友人数限制'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','joinlimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `joinlimit` int(11) NOT NULL COMMENT '参加人数限制'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','falsejoinnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `falsejoinnum` int(11) NOT NULL COMMENT '虚拟参与人数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','falselooknum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `falselooknum` int(11) NOT NULL COMMENT '虚拟浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','falsesharenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `falsesharenum` int(11) NOT NULL COMMENT '虚拟分享次数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `code` varchar(50) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `thumb` varchar(255) NOT NULL COMMENT '海报图片'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `thumbs` text NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','unit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `unit` varchar(45) NOT NULL COMMENT '商品单位'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','bgmusic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `detail` longtext NOT NULL COMMENT '商品详情'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','rules')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `rules` text NOT NULL COMMENT '砍价规则'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `vipstatus` int(11) NOT NULL COMMENT '会员设置'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `share_image` varchar(255) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `share_title` varchar(1000) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `share_desc` varchar(1000) NOT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `settlementmoney` decimal(10,2) NOT NULL COMMENT '一般结算价格'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT '会员结算价格'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与分销'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '普通一级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '普通二级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','viponedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `viponedismoney` decimal(10,2) NOT NULL COMMENT '会员一级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','viptwodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `viptwodismoney` decimal(10,2) NOT NULL COMMENT '会员二级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','userlabel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `userlabel` text NOT NULL COMMENT '用户标签'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','stock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `stock` int(11) NOT NULL COMMENT '商品库存'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `sort` int(11) NOT NULL COMMENT '商品排序'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `pv` int(11) NOT NULL COMMENT '真实浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','sharenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `sharenum` int(11) NOT NULL COMMENT '真实分享数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','usestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `usestatus` int(11) NOT NULL COMMENT '消费方式'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `expressid` int(11) NOT NULL COMMENT '运费模板id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','independent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `independent` int(11) NOT NULL COMMENT '独立结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','allowapplyre')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `level` text NOT NULL COMMENT '适用会员等级'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','onlytimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `onlytimes` int(11) NOT NULL COMMENT '单个用户可以砍价次数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `dissettime` int(11) NOT NULL COMMENT '结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','diyposter')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `diyposter` int(11) NOT NULL COMMENT '自定义海报id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','overrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `overrefund` tinyint(1) NOT NULL COMMENT '过期退款'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','cutoffstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `cutoffstatus` int(11) NOT NULL COMMENT '消费截止时间方式 1固定时间 2购买后天数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','cutofftime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `cutofftime` int(11) NOT NULL COMMENT '固定时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','cutoffday')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `cutoffday` int(11) NOT NULL COMMENT '购买后天数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `describe` text NOT NULL COMMENT '购买须知'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `integral` int(11) NOT NULL COMMENT '赠送积分'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `creditmoney` decimal(10,2) NOT NULL COMMENT '抵扣金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','appointment')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `appointment` int(11) NOT NULL COMMENT '提前预约'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','is_indexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `is_indexshow` int(11) NOT NULL COMMENT '是否首页显示'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `tag` text NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','falseorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `falseorder` text NOT NULL COMMENT '虚拟订单'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','communityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `communityid` int(11) NOT NULL COMMENT '社群id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','share_wxapp_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','is_describe_tip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `is_describe_tip` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','extension_text')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `extension_text` text NOT NULL COMMENT '推广文案'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','extension_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `extension_img` text NOT NULL COMMENT '推广图片路径'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','pay_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','cash_back')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','return_proportion')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','paidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `paidid` int(11) NOT NULL COMMENT '支付有礼活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `usedatestatus` tinyint(1) NOT NULL COMMENT '定时购买 1按星期 2按天数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `week` varchar(355) NOT NULL COMMENT '按星期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `day` varchar(355) NOT NULL COMMENT '按天数时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `viparray` text NOT NULL COMMENT '会员减免数组'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `disarray` text NOT NULL COMMENT '分销商佣金数组'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','diyformid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','isdistristatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','appointstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','appointdays')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `appointdays` int(11) NOT NULL COMMENT '可预约天数'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','appointarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `appointarray` text COMMENT '预约数组'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','videourl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `videourl` varchar(255) NOT NULL COMMENT '视频链接'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','yuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `yuecashback` decimal(10,2) NOT NULL COMMENT '普通用户余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','vipyuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `vipyuecashback` decimal(10,2) NOT NULL COMMENT '会员余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','checkcodeflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   `checkcodeflag` tinyint(2) DEFAULT NULL COMMENT '核销码类型 0系统核销码 1导入核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','idx_uniacid_aid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   KEY `idx_sort` (`sort`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_activity','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_activity')." ADD   KEY `idx_sid` (`sid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_bargain_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '分类名称',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `sort` int(11) NOT NULL COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页显示 0显示 1隐藏',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_is_show` (`is_show`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='砍价分类表';

");

if(!pdo_fieldexists('ims_wlmerchant_bargain_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   `name` varchar(255) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   `thumb` varchar(255) NOT NULL COMMENT '分类图片'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页显示 0显示 1隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_category','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_category')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_bargain_helprecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `activityid` int(11) NOT NULL COMMENT '活动id',
  `userid` int(11) NOT NULL COMMENT '用户砍价单id',
  `authorid` int(11) NOT NULL COMMENT '发起人id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `bargainprice` decimal(10,2) NOT NULL COMMENT '砍价价格',
  `afterprice` decimal(10,2) NOT NULL COMMENT '砍后价格',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='砍价记录表';

");

if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','activityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `activityid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','userid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `userid` int(11) NOT NULL COMMENT '用户砍价单id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','authorid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `authorid` int(11) NOT NULL COMMENT '发起人id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','bargainprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `bargainprice` decimal(10,2) NOT NULL COMMENT '砍价价格'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','afterprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `afterprice` decimal(10,2) NOT NULL COMMENT '砍后价格'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_helprecord','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_helprecord')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_bargain_userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `activityid` int(11) NOT NULL COMMENT '活动id',
  `merchantid` int(11) NOT NULL COMMENT '商户id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `status` int(11) NOT NULL COMMENT '状态 1进行中 2支付 3已失败',
  `price` decimal(10,2) NOT NULL COMMENT '当前价格',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `updatetime` int(11) NOT NULL COMMENT '修改时间',
  `orderid` int(11) NOT NULL COMMENT '订单表中的订单id',
  `qrcode` int(11) NOT NULL COMMENT '验证码(已弃用)',
  `usetimes` int(11) NOT NULL COMMENT '剩余使用次数(已弃用)',
  `usedtime` text NOT NULL COMMENT '核销详情(已弃用)',
  `expressid` int(11) NOT NULL COMMENT '快递id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_orderid` (`orderid`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='砍价活动表';

");

if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','activityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `activityid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `merchantid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `status` int(11) NOT NULL COMMENT '状态 1进行中 2支付 3已失败'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `price` decimal(10,2) NOT NULL COMMENT '当前价格'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `updatetime` int(11) NOT NULL COMMENT '修改时间'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `orderid` int(11) NOT NULL COMMENT '订单表中的订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `qrcode` int(11) NOT NULL COMMENT '验证码(已弃用)'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `usetimes` int(11) NOT NULL COMMENT '剩余使用次数(已弃用)'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','usedtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `usedtime` text NOT NULL COMMENT '核销详情(已弃用)'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   `expressid` int(11) NOT NULL COMMENT '快递id'");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   KEY `idx_mid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','idx_orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   KEY `idx_orderid` (`orderid`)");}
if(!pdo_fieldexists('ims_wlmerchant_bargain_userlist','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_bargain_userlist')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_browse_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `create_time` varchar(12) NOT NULL COMMENT '第一次浏览时间',
  `updade_time` varchar(12) NOT NULL COMMENT '最近浏览时间',
  `type` tinyint(2) NOT NULL COMMENT '商品类型：1=抢购  2=团购  3=拼团 4=大礼包 5=优惠劵 6=折扣卡 7=砍价商品 8=积分商品',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goods_id` (`goods_id`),
  KEY `idx_type` (`type`),
  KEY `idx_mid` (`mid`),
  KEY `idx_updade_time` (`updade_time`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_browse_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   `goods_id` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   `create_time` varchar(12) NOT NULL COMMENT '第一次浏览时间'");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','updade_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   `updade_time` varchar(12) NOT NULL COMMENT '最近浏览时间'");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   `type` tinyint(2) NOT NULL COMMENT '商品类型：1=抢购  2=团购  3=拼团 4=大礼包 5=优惠劵 6=折扣卡 7=砍价商品 8=积分商品'");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','idx_goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   KEY `idx_goods_id` (`goods_id`)");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_browse_record','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_browse_record')." ADD   KEY `idx_mid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_call` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `aid` int(11) unsigned NOT NULL COMMENT '代理商id',
  `title` varchar(25) NOT NULL COMMENT '集call活动名称',
  `number` smallint(3) unsigned NOT NULL COMMENT '集call的数量',
  `state` tinyint(1) unsigned NOT NULL COMMENT '活动状态(1=开启,2=关闭)',
  `prize_id` int(10) unsigned NOT NULL COMMENT '活动奖品的id',
  `explain` text COMMENT '活动的说明',
  `limit` text COMMENT '活动的限制',
  `receive_time` varchar(11) NOT NULL COMMENT '奖品领取期限',
  `use_time` varchar(11) NOT NULL COMMENT '奖品使用期限',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_state` (`state`),
  KEY `idx_receive_time` (`receive_time`),
  KEY `idx_use_time` (`use_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='集call活动列表';

");

if(!pdo_fieldexists('ims_wlmerchant_call','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_call','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_call','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `aid` int(11) unsigned NOT NULL COMMENT '代理商id'");}
if(!pdo_fieldexists('ims_wlmerchant_call','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `title` varchar(25) NOT NULL COMMENT '集call活动名称'");}
if(!pdo_fieldexists('ims_wlmerchant_call','number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `number` smallint(3) unsigned NOT NULL COMMENT '集call的数量'");}
if(!pdo_fieldexists('ims_wlmerchant_call','state')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `state` tinyint(1) unsigned NOT NULL COMMENT '活动状态(1=开启,2=关闭)'");}
if(!pdo_fieldexists('ims_wlmerchant_call','prize_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `prize_id` int(10) unsigned NOT NULL COMMENT '活动奖品的id'");}
if(!pdo_fieldexists('ims_wlmerchant_call','explain')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `explain` text COMMENT '活动的说明'");}
if(!pdo_fieldexists('ims_wlmerchant_call','limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `limit` text COMMENT '活动的限制'");}
if(!pdo_fieldexists('ims_wlmerchant_call','receive_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `receive_time` varchar(11) NOT NULL COMMENT '奖品领取期限'");}
if(!pdo_fieldexists('ims_wlmerchant_call','use_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   `use_time` varchar(11) NOT NULL COMMENT '奖品使用期限'");}
if(!pdo_fieldexists('ims_wlmerchant_call','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_call','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_call','idx_state')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   KEY `idx_state` (`state`)");}
if(!pdo_fieldexists('ims_wlmerchant_call','idx_receive_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call')." ADD   KEY `idx_receive_time` (`receive_time`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_call_hit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `aid` int(11) unsigned NOT NULL COMMENT '代理商id',
  `mid` int(11) unsigned NOT NULL COMMENT '打call用户的id',
  `list_id` int(10) unsigned NOT NULL COMMENT '已发起的集call活动的id',
  `hit_time` varchar(11) NOT NULL COMMENT '打call的时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_hit_time` (`hit_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='打call信息列表';

");

if(!pdo_fieldexists('ims_wlmerchant_call_hit','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   `aid` int(11) unsigned NOT NULL COMMENT '代理商id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   `mid` int(11) unsigned NOT NULL COMMENT '打call用户的id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','list_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   `list_id` int(10) unsigned NOT NULL COMMENT '已发起的集call活动的id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','hit_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   `hit_time` varchar(11) NOT NULL COMMENT '打call的时间'");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_call_hit','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_hit')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_call_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `aid` int(11) unsigned NOT NULL COMMENT '代理商id',
  `mid` int(11) unsigned NOT NULL COMMENT '发起用户的id',
  `call_id` int(11) unsigned NOT NULL COMMENT '集call活动的id',
  `start_time` int(11) unsigned NOT NULL COMMENT '发起的时间',
  `grant` tinyint(1) NOT NULL DEFAULT '1' COMMENT '奖品是否发放(1=未发放，2=已发放)',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_start_time` (`start_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='已发起集call活动的信息列表';

");

if(!pdo_fieldexists('ims_wlmerchant_call_list','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   `aid` int(11) unsigned NOT NULL COMMENT '代理商id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   `mid` int(11) unsigned NOT NULL COMMENT '发起用户的id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','call_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   `call_id` int(11) unsigned NOT NULL COMMENT '集call活动的id'");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   `start_time` int(11) unsigned NOT NULL COMMENT '发起的时间'");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','grant')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   `grant` tinyint(1) NOT NULL DEFAULT '1' COMMENT '奖品是否发放(1=未发放，2=已发放)'");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_call_list','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_call_list')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_cashback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `plugin` varchar(15) NOT NULL COMMENT '模块信息',
  `status` tinyint(1) NOT NULL COMMENT '是否审核（0=审核中，1=已返现,2=未通过）',
  `money` decimal(10,2) NOT NULL COMMENT '返现金额',
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `create_time` varchar(15) DEFAULT NULL COMMENT '记录时间',
  `refund_money` decimal(10,2) DEFAULT '0.00' COMMENT '因为退款，取消的返现金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_cashback','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','order_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `order_id` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `plugin` varchar(15) NOT NULL COMMENT '模块信息'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `status` tinyint(1) NOT NULL COMMENT '是否审核（0=审核中，1=已返现,2=未通过）'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `money` decimal(10,2) NOT NULL COMMENT '返现金额'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `goods_id` int(11) DEFAULT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `create_time` varchar(15) DEFAULT NULL COMMENT '记录时间'");}
if(!pdo_fieldexists('ims_wlmerchant_cashback','refund_money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_cashback')." ADD   `refund_money` decimal(10,2) DEFAULT '0.00' COMMENT '因为退款，取消的返现金额'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_category_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `isrecommand` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐（已弃用）',
  `description` varchar(500) NOT NULL COMMENT '分类介绍',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `visible_level` int(11) NOT NULL COMMENT '1为首页顶部展示',
  `abroad` varchar(255) NOT NULL COMMENT '设置外部链接',
  `state` int(11) NOT NULL COMMENT '判断是否有外联\n1为有\n0为没有',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=InnoDB AUTO_INCREMENT=2195 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_category_store','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `uniacid` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `aid` int(10) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `name` varchar(50) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `thumb` varchar(255) NOT NULL COMMENT '分类图片'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','parentid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','isrecommand')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `isrecommand` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐（已弃用）'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `description` varchar(500) NOT NULL COMMENT '分类介绍'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','visible_level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `visible_level` int(11) NOT NULL COMMENT '1为首页顶部展示'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','abroad')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `abroad` varchar(255) NOT NULL COMMENT '设置外部链接'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','state')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   `state` int(11) NOT NULL COMMENT '判断是否有外联\n1为有\n0为没有'");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_category_store','idx_enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_category_store')." ADD   KEY `idx_enabled` (`enabled`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_chargelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `name` varchar(225) NOT NULL COMMENT '名称',
  `days` int(11) NOT NULL COMMENT '天数',
  `status` int(11) NOT NULL COMMENT '状态 1启用0禁用',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `audits` int(11) NOT NULL COMMENT '免审核',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销佣金',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销佣金',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销佣金',
  `isdistri` int(11) NOT NULL COMMENT '是否参与分销',
  `sort` int(11) NOT NULL COMMENT '排序',
  `renewstatus` int(11) NOT NULL COMMENT '续费状态 1允许 2不允许',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `authority` text NOT NULL COMMENT '权限',
  `defaultrate` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '默认结算比',
  `release_number` int(11) DEFAULT '0' COMMENT '求职招聘 - 免费发布次数',
  `release_price` decimal(10,2) DEFAULT '0.00' COMMENT '求职招聘 - 每次发布需要支付的金额',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_chargelist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `name` varchar(225) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','days')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `days` int(11) NOT NULL COMMENT '天数'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `status` int(11) NOT NULL COMMENT '状态 1启用0禁用'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `price` decimal(10,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','audits')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `audits` int(11) NOT NULL COMMENT '免审核'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与分销'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','renewstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `renewstatus` int(11) NOT NULL COMMENT '续费状态 1允许 2不允许'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','authority')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `authority` text NOT NULL COMMENT '权限'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','defaultrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `defaultrate` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '默认结算比'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','release_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `release_number` int(11) DEFAULT '0' COMMENT '求职招聘 - 免费发布次数'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','release_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   `release_price` decimal(10,2) DEFAULT '0.00' COMMENT '求职招聘 - 每次发布需要支付的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   KEY `idx_sort` (`sort`)");}
if(!pdo_fieldexists('ims_wlmerchant_chargelist','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_chargelist')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_checkcodelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `checkcode` varchar(32) NOT NULL COMMENT '核销码',
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `plugin` varchar(32) NOT NULL COMMENT '商品所属组件',
  `status` int(11) NOT NULL COMMENT '状态 0未使用 1已使用',
  `orderid` int(11) NOT NULL COMMENT '订单id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD   `checkcode` varchar(32) NOT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD   `plugin` varchar(32) NOT NULL COMMENT '商品所属组件'");}
if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD   `status` int(11) NOT NULL COMMENT '状态 0未使用 1已使用'");}
if(!pdo_fieldexists('ims_wlmerchant_checkcodelist','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_checkcodelist')." ADD   `orderid` int(11) NOT NULL COMMENT '订单id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_citycard_cates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL COMMENT '分类名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0禁用1开启',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   `uniacid` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   `aid` int(10) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   `name` varchar(64) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','parentid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0禁用1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_cates','idx_enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_cates')." ADD   KEY `idx_enabled` (`enabled`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_citycard_collect` (
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `cardid` int(11) NOT NULL COMMENT '名片ID',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `idx_mid` (`mid`),
  KEY `idx_cardid` (`cardid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_citycard_collect','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_collect')." ADD 
  `mid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_collect','cardid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_collect')." ADD   `cardid` int(11) NOT NULL COMMENT '名片ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_collect','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_collect')." ADD   `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_collect','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_collect')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_collect','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_collect')." ADD   KEY `idx_mid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_citycard_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `sort` int(10) unsigned NOT NULL COMMENT '排序，数值越大越靠前',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `logo` varchar(300) NOT NULL COMMENT 'logo',
  `mobile` varchar(16) NOT NULL COMMENT '电话',
  `wechat` varchar(64) NOT NULL COMMENT '微信号',
  `company` varchar(64) NOT NULL COMMENT '公司',
  `branch` varchar(64) NOT NULL COMMENT '部门',
  `position` varchar(64) NOT NULL COMMENT '职位',
  `desc` varchar(500) NOT NULL COMMENT '介绍',
  `address` varchar(300) NOT NULL COMMENT '地址',
  `one_class` int(11) unsigned NOT NULL COMMENT '一级分类',
  `two_class` int(11) unsigned NOT NULL COMMENT '二级分类',
  `show_addr` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '地址0隐藏1显示',
  `show_mobile` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '电话0隐藏1显示',
  `show_wechat` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '微信0隐藏1显示',
  `meal_id` int(11) unsigned NOT NULL COMMENT '套餐ID',
  `meal_endtime` int(11) NOT NULL COMMENT '套餐结束时间',
  `top_is` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '置顶0不置顶1置顶',
  `top_endtime` int(11) NOT NULL COMMENT '置顶到期时间',
  `laud` int(10) unsigned NOT NULL COMMENT '点赞数',
  `pv` int(10) unsigned NOT NULL COMMENT '浏览量',
  `share` int(10) unsigned NOT NULL COMMENT '分享数',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态0禁用1启用',
  `pro_code` int(11) NOT NULL COMMENT '省ID',
  `city_code` int(11) NOT NULL COMMENT '市ID',
  `area_code` int(11) NOT NULL COMMENT '区ID',
  `lng` varchar(16) NOT NULL COMMENT '经度',
  `lat` varchar(16) NOT NULL COMMENT '纬度',
  `createtime` int(11) NOT NULL COMMENT '入驻时间',
  `checkstatus` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态0待审核1审核通过2驳回',
  `laud_user` text COMMENT '点赞用户id信息',
  `paystatus` tinyint(1) NOT NULL COMMENT '支付状态 0未支付 1已支付或不需要支付',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_status` (`status`),
  KEY `idx_pro_code` (`pro_code`),
  KEY `idx_city_code` (`city_code`),
  KEY `idx_area_code` (`area_code`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `aid` int(11) NOT NULL COMMENT '代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `mid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `sort` int(10) unsigned NOT NULL COMMENT '排序，数值越大越靠前'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `name` varchar(64) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `logo` varchar(300) NOT NULL COMMENT 'logo'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `mobile` varchar(16) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','wechat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `wechat` varchar(64) NOT NULL COMMENT '微信号'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','company')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `company` varchar(64) NOT NULL COMMENT '公司'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','branch')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `branch` varchar(64) NOT NULL COMMENT '部门'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','position')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `position` varchar(64) NOT NULL COMMENT '职位'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `desc` varchar(500) NOT NULL COMMENT '介绍'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `address` varchar(300) NOT NULL COMMENT '地址'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','one_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `one_class` int(11) unsigned NOT NULL COMMENT '一级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','two_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `two_class` int(11) unsigned NOT NULL COMMENT '二级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','show_addr')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `show_addr` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '地址0隐藏1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','show_mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `show_mobile` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '电话0隐藏1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','show_wechat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `show_wechat` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '微信0隐藏1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','meal_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `meal_id` int(11) unsigned NOT NULL COMMENT '套餐ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','meal_endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `meal_endtime` int(11) NOT NULL COMMENT '套餐结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','top_is')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `top_is` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '置顶0不置顶1置顶'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','top_endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `top_endtime` int(11) NOT NULL COMMENT '置顶到期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','laud')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `laud` int(10) unsigned NOT NULL COMMENT '点赞数'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `pv` int(10) unsigned NOT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','share')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `share` int(10) unsigned NOT NULL COMMENT '分享数'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `status` tinyint(1) unsigned NOT NULL COMMENT '状态0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','pro_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `pro_code` int(11) NOT NULL COMMENT '省ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','city_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `city_code` int(11) NOT NULL COMMENT '市ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','area_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `area_code` int(11) NOT NULL COMMENT '区ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `lng` varchar(16) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `lat` varchar(16) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `createtime` int(11) NOT NULL COMMENT '入驻时间'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','checkstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `checkstatus` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态0待审核1审核通过2驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','laud_user')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `laud_user` text COMMENT '点赞用户id信息'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','paystatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   `paystatus` tinyint(1) NOT NULL COMMENT '支付状态 0未支付 1已支付或不需要支付'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_sort` (`sort`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_pro_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_pro_code` (`pro_code`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_city_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_city_code` (`city_code`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_lists','idx_area_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_lists')." ADD   KEY `idx_area_code` (`area_code`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_citycard_meals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `sort` int(10) unsigned NOT NULL COMMENT '排序，数值越大越靠前',
  `name` varchar(64) NOT NULL COMMENT '套餐名称',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '套餐金额',
  `day` int(10) unsigned NOT NULL COMMENT '时间期限',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态0禁用1启用',
  `is_free` tinyint(1) unsigned NOT NULL COMMENT '0付费1免费',
  `check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核0无需审核1需要审核',
  `isdistri` tinyint(1) NOT NULL COMMENT '是否参与分销 1参与 0不参与',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销佣金',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销佣金',
  `vipstatus` tinyint(1) DEFAULT NULL COMMENT '会员特权 0无 1会员特价 2会员特供',
  `vipprice` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `aid` int(11) NOT NULL COMMENT '代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `sort` int(10) unsigned NOT NULL COMMENT '排序，数值越大越靠前'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `name` varchar(64) NOT NULL COMMENT '套餐名称'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '套餐金额'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `day` int(10) unsigned NOT NULL COMMENT '时间期限'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `status` tinyint(1) unsigned NOT NULL COMMENT '状态0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','is_free')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `is_free` tinyint(1) unsigned NOT NULL COMMENT '0付费1免费'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','check')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核0无需审核1需要审核'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `isdistri` tinyint(1) NOT NULL COMMENT '是否参与分销 1参与 0不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `vipstatus` tinyint(1) DEFAULT NULL COMMENT '会员特权 0无 1会员特价 2会员特供'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   `vipprice` decimal(10,2) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_meals','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_meals')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_citycard_tops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `sort` int(10) unsigned NOT NULL COMMENT '排序，数值越大越靠前',
  `name` varchar(64) NOT NULL COMMENT '置顶名称',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '置顶金额',
  `day` int(10) unsigned NOT NULL COMMENT '时间期限',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态0禁用1启用',
  `isdistri` tinyint(1) NOT NULL COMMENT '是否参与分销 1参与 0不参与',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销佣金',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销佣金',
  `vipstatus` tinyint(1) NOT NULL COMMENT '会员特权 0无 1会员特价 2会员特供',
  `vipprice` decimal(10,2) NOT NULL COMMENT '会员金额',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `aid` int(11) NOT NULL COMMENT '代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `sort` int(10) unsigned NOT NULL COMMENT '排序，数值越大越靠前'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `name` varchar(64) NOT NULL COMMENT '置顶名称'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '置顶金额'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `day` int(10) unsigned NOT NULL COMMENT '时间期限'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `status` tinyint(1) unsigned NOT NULL COMMENT '状态0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `isdistri` tinyint(1) NOT NULL COMMENT '是否参与分销 1参与 0不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `vipstatus` tinyint(1) NOT NULL COMMENT '会员特权 0无 1会员特价 2会员特供'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   `vipprice` decimal(10,2) NOT NULL COMMENT '会员金额'");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_citycard_tops','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_citycard_tops')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_collect','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_collect')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_collect','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_collect')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_collect','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_collect')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_collect','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_collect')." ADD   `storeid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_collect','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_collect')." ADD   `createtime` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `gid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对应的商品id',
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `sid` int(11) NOT NULL COMMENT '商家ID',
  `parentid` int(11) NOT NULL COMMENT '回复上级ID',
  `pic` varchar(1000) NOT NULL COMMENT '图片',
  `idoforder` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对应的order的id',
  `text` text NOT NULL COMMENT '评价文字',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示 1显示 0不显示',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '评价等级 1好评 2中评 3差评',
  `createtime` varchar(145) NOT NULL DEFAULT '0' COMMENT '评价时间',
  `headimg` varchar(255) NOT NULL COMMENT '评价人头像',
  `nickname` varchar(32) NOT NULL COMMENT '评价人昵称',
  `plugin` varchar(32) NOT NULL COMMENT '插件名称',
  `star` int(11) NOT NULL DEFAULT '0' COMMENT '打分星数',
  `replyone` int(11) NOT NULL DEFAULT '1' COMMENT '店家是否回复 1已回复',
  `checkone` int(11) NOT NULL DEFAULT '1' COMMENT '审核状态 1待审核 2已审核通过 3未通过',
  `true` int(11) NOT NULL DEFAULT '1',
  `replytextone` varchar(1000) NOT NULL COMMENT '店家回复内容',
  `replypicone` varchar(500) NOT NULL COMMENT '店家回复图片',
  `ispic` int(11) NOT NULL DEFAULT '0' COMMENT '是否有图 1有图 0无图',
  `aid` int(11) NOT NULL COMMENT '代理id\n',
  `housekeepflag` tinyint(1) NOT NULL COMMENT '0商户 1个人',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_status` (`status`),
  KEY `idx_level` (`level`),
  KEY `idx_checkone` (`checkone`),
  KEY `idx_ispic` (`ispic`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='价';

");

if(!pdo_fieldexists('ims_wlmerchant_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_comment','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `uniacid` int(11) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','gid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `gid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对应的商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `mid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `sid` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','parentid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `parentid` int(11) NOT NULL COMMENT '回复上级ID'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','pic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `pic` varchar(1000) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','idoforder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `idoforder` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对应的order的id'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','text')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `text` text NOT NULL COMMENT '评价文字'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示 1显示 0不显示'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '评价等级 1好评 2中评 3差评'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `createtime` varchar(145) NOT NULL DEFAULT '0' COMMENT '评价时间'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','headimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `headimg` varchar(255) NOT NULL COMMENT '评价人头像'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `nickname` varchar(32) NOT NULL COMMENT '评价人昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件名称'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','star')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `star` int(11) NOT NULL DEFAULT '0' COMMENT '打分星数'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','replyone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `replyone` int(11) NOT NULL DEFAULT '1' COMMENT '店家是否回复 1已回复'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','checkone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `checkone` int(11) NOT NULL DEFAULT '1' COMMENT '审核状态 1待审核 2已审核通过 3未通过'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','true')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `true` int(11) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','replytextone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `replytextone` varchar(1000) NOT NULL COMMENT '店家回复内容'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','replypicone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `replypicone` varchar(500) NOT NULL COMMENT '店家回复图片'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','ispic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `ispic` int(11) NOT NULL DEFAULT '0' COMMENT '是否有图 1有图 0无图'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `aid` int(11) NOT NULL COMMENT '代理id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','housekeepflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   `housekeepflag` tinyint(1) NOT NULL COMMENT '0商户 1个人'");}
if(!pdo_fieldexists('ims_wlmerchant_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_comment','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_comment','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_comment','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_comment','idx_level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   KEY `idx_level` (`level`)");}
if(!pdo_fieldexists('ims_wlmerchant_comment','idx_checkone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_comment')." ADD   KEY `idx_checkone` (`checkone`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_community` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `communname` varchar(145) NOT NULL COMMENT '社群名称',
  `commundesc` varchar(145) NOT NULL COMMENT '社群描述',
  `communimg` varchar(255) NOT NULL COMMENT '社群图标',
  `communqrcode` varchar(255) NOT NULL COMMENT '社群二维码',
  `systel` varchar(32) NOT NULL COMMENT '客服电话',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `reply` varchar(255) NOT NULL COMMENT '小程序回复内容',
  `media_id` varchar(255) NOT NULL COMMENT '小程序端图片上传后获得的图片id\n',
  `media_endtime` int(11) NOT NULL COMMENT '小程序图片过期时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_community','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_community','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_community','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_community','communname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `communname` varchar(145) NOT NULL COMMENT '社群名称'");}
if(!pdo_fieldexists('ims_wlmerchant_community','commundesc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `commundesc` varchar(145) NOT NULL COMMENT '社群描述'");}
if(!pdo_fieldexists('ims_wlmerchant_community','communimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `communimg` varchar(255) NOT NULL COMMENT '社群图标'");}
if(!pdo_fieldexists('ims_wlmerchant_community','communqrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `communqrcode` varchar(255) NOT NULL COMMENT '社群二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_community','systel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `systel` varchar(32) NOT NULL COMMENT '客服电话'");}
if(!pdo_fieldexists('ims_wlmerchant_community','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_community','reply')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `reply` varchar(255) NOT NULL COMMENT '小程序回复内容'");}
if(!pdo_fieldexists('ims_wlmerchant_community','media_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `media_id` varchar(255) NOT NULL COMMENT '小程序端图片上传后获得的图片id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_community','media_endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   `media_endtime` int(11) NOT NULL COMMENT '小程序图片过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_community','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_community')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_consumption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `status` int(11) NOT NULL COMMENT '状态 0未通知 1已通知',
  `credits` int(11) NOT NULL COMMENT '扣除积分',
  `time` varchar(145) NOT NULL COMMENT '兑换时间',
  `itemCode` int(11) NOT NULL COMMENT '商品编号',
  `actualPrice` decimal(11,2) NOT NULL COMMENT '商品实际价格',
  `description` text COMMENT '详细描述',
  `orderNum` text COMMENT '兑吧订单号',
  `yue` int(11) NOT NULL COMMENT '本次操作后的余额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_consumption','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `uid` int(11) NOT NULL COMMENT '用户uid'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `status` int(11) NOT NULL COMMENT '状态 0未通知 1已通知'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','credits')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `credits` int(11) NOT NULL COMMENT '扣除积分'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `time` varchar(145) NOT NULL COMMENT '兑换时间'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','itemCode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `itemCode` int(11) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','actualPrice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `actualPrice` decimal(11,2) NOT NULL COMMENT '商品实际价格'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `description` text COMMENT '详细描述'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','orderNum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `orderNum` text COMMENT '兑吧订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption','yue')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption')." ADD   `yue` int(11) NOT NULL COMMENT '本次操作后的余额'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_consumption_adv` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `advname` varchar(50) NOT NULL COMMENT '幻灯片名称',
  `link` varchar(255) NOT NULL COMMENT '跳转链接',
  `wxapp_link` varchar(255) NOT NULL COMMENT '小程序链接',
  `thumb` varchar(255) NOT NULL COMMENT '幻灯片图案',
  `displayorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_status` (`status`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='积分商城幻灯片表';

");

if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `uniacid` int(10) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','advname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `advname` varchar(50) NOT NULL COMMENT '幻灯片名称'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `link` varchar(255) NOT NULL COMMENT '跳转链接'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','wxapp_link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `wxapp_link` varchar(255) NOT NULL COMMENT '小程序链接'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `thumb` varchar(255) NOT NULL COMMENT '幻灯片图案'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `displayorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','idx_displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   KEY `idx_displayorder` (`displayorder`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_adv','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_adv')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_consumption_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态 0关闭 1显示',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否推荐 1推荐 0关闭',
  PRIMARY KEY (`id`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_status` (`status`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='积分商城分类表';

");

if(!pdo_fieldexists('ims_wlmerchant_consumption_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `uniacid` int(10) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `name` varchar(50) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `thumb` varchar(255) NOT NULL COMMENT '分类图片'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态 0关闭 1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','advimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `advimg` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','advurl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `advurl` varchar(500) DEFAULT ''");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','isrecommand')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   `isrecommand` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否推荐 1推荐 0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','idx_displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   KEY `idx_displayorder` (`displayorder`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_category','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_category')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_consumption_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `category_id` int(10) NOT NULL COMMENT '分类id',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '商品类型',
  `thumb` varchar(255) NOT NULL COMMENT '商品图片',
  `old_price` varchar(10) NOT NULL COMMENT '商品原价',
  `chance` tinyint(3) unsigned NOT NULL COMMENT '每人共计兑换次数',
  `totalday` tinyint(3) unsigned NOT NULL COMMENT '每天提供份数',
  `use_credit1` varchar(10) NOT NULL DEFAULT '0' COMMENT '需要支付的积分',
  `use_credit2` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '需要支付的金额',
  `description` text NOT NULL COMMENT '商品详情',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1开启 0关闭',
  `credit2` varchar(10) NOT NULL COMMENT '设置的赠送余额',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `redpacket` text NOT NULL COMMENT '红包设置',
  `pv` int(11) NOT NULL COMMENT '浏览量',
  `expressid` int(11) NOT NULL COMMENT '运费模板',
  `isdistri` int(11) NOT NULL COMMENT '是否参与分销 0不参与 1参与',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '自己分销佣金',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销佣金',
  `stock` int(11) NOT NULL COMMENT '库存',
  `vipstatus` int(11) NOT NULL COMMENT '会员类型',
  `vipcredit1` int(11) NOT NULL COMMENT 'vip需要积分',
  `vipcredit2` double(10,2) NOT NULL COMMENT 'vip需要金额',
  `dissettime` int(11) NOT NULL COMMENT '分销结算时间',
  `halfcardid` int(11) NOT NULL COMMENT '一卡通id',
  `advs` text NOT NULL COMMENT '幻灯片',
  `community_id` int(11) NOT NULL COMMENT '社群id',
  `describe` text NOT NULL COMMENT '描述',
  `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数',
  `week` varchar(355) NOT NULL COMMENT '按星期时间',
  `day` varchar(355) NOT NULL COMMENT '按天数时间',
  PRIMARY KEY (`id`),
  KEY `idx_type` (`type`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='积分商城商品表';

");

if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `uniacid` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `title` varchar(50) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','category_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `category_id` int(10) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `type` varchar(20) NOT NULL DEFAULT '' COMMENT '商品类型'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `thumb` varchar(255) NOT NULL COMMENT '商品图片'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','old_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `old_price` varchar(10) NOT NULL COMMENT '商品原价'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','chance')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `chance` tinyint(3) unsigned NOT NULL COMMENT '每人共计兑换次数'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','totalday')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `totalday` tinyint(3) unsigned NOT NULL COMMENT '每天提供份数'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','use_credit1')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `use_credit1` varchar(10) NOT NULL DEFAULT '0' COMMENT '需要支付的积分'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','use_credit2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `use_credit2` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '需要支付的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `description` text NOT NULL COMMENT '商品详情'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1开启 0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','credit2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `credit2` varchar(10) NOT NULL COMMENT '设置的赠送余额'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','redpacket')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `redpacket` text NOT NULL COMMENT '红包设置'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `pv` int(11) NOT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `expressid` int(11) NOT NULL COMMENT '运费模板'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与分销 0不参与 1参与'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '自己分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','stock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `stock` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `vipstatus` int(11) NOT NULL COMMENT '会员类型'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','vipcredit1')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `vipcredit1` int(11) NOT NULL COMMENT 'vip需要积分'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','vipcredit2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `vipcredit2` double(10,2) NOT NULL COMMENT 'vip需要金额'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `dissettime` int(11) NOT NULL COMMENT '分销结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','halfcardid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `halfcardid` int(11) NOT NULL COMMENT '一卡通id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','advs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `advs` text NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','community_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `community_id` int(11) NOT NULL COMMENT '社群id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `describe` text NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `week` varchar(355) NOT NULL COMMENT '按星期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   `day` varchar(355) NOT NULL COMMENT '按天数时间'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_goods','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_goods')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_consumption_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `goodsid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `orderid` int(10) NOT NULL COMMENT '订单id',
  `expressid` int(11) NOT NULL COMMENT '快递id',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间书生',
  `status` int(11) NOT NULL COMMENT '状态 1待发货 2待收货 3已完成 4已退货',
  `integral` int(11) NOT NULL COMMENT '消耗积分',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_goodsid` (`goodsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='兑换记录表';

");

if(!pdo_fieldexists('ims_wlmerchant_consumption_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `uniacid` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `goodsid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `orderid` int(10) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `expressid` int(11) NOT NULL COMMENT '快递id'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间书生'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `status` int(11) NOT NULL COMMENT '状态 1待发货 2待收货 3已完成 4已退货'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `integral` int(11) NOT NULL COMMENT '消耗积分'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   `money` decimal(10,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_consumption_record','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_consumption_record')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_couponlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL COMMENT '代理id',
  `status` int(11) NOT NULL COMMENT '优惠券状态 1启用 0禁用 3已失效 2审核中 4未通过',
  `type` int(11) NOT NULL COMMENT '优惠券类型 1 折扣券 2代金券 3套餐券 4 团购券 5优惠券',
  `is_charge` int(11) NOT NULL COMMENT '是否收费 1收费 0免费',
  `logo` varchar(100) NOT NULL COMMENT '优惠券logo',
  `indeximg` varchar(100) NOT NULL COMMENT '优惠券详情顶部图片',
  `merchantid` int(11) NOT NULL COMMENT '商户id',
  `color` varchar(100) NOT NULL COMMENT '优惠券颜色',
  `title` varchar(145) NOT NULL COMMENT '优惠券标题',
  `sub_title` varchar(145) NOT NULL COMMENT '优惠券小标题',
  `goodsdetail` longtext NOT NULL COMMENT '商品详情',
  `time_type` int(11) NOT NULL COMMENT '时间类型 1.规定时间段 2 领取后限制',
  `starttime` varchar(255) NOT NULL COMMENT '开始时间',
  `endtime` varchar(255) NOT NULL COMMENT '结束时间',
  `deadline` int(11) NOT NULL COMMENT '持续天数',
  `quantity` int(11) NOT NULL COMMENT '库存',
  `surplus` int(11) NOT NULL COMMENT '已售数量',
  `get_limit` int(11) NOT NULL COMMENT '限量',
  `description` text NOT NULL COMMENT '卡券使用须知',
  `usetimes` int(11) NOT NULL COMMENT '使用次数',
  `createtime` varchar(255) NOT NULL COMMENT '创建时间',
  `price` decimal(10,2) NOT NULL COMMENT '收费金额',
  `is_show` int(11) NOT NULL COMMENT '是否列表显示 0显示 1隐藏',
  `vipstatus` int(11) NOT NULL DEFAULT '0' COMMENT 'VIP设置 0无vip限制 1VIP特价 2vip特供',
  `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip价格',
  `is_indexshow` int(11) NOT NULL DEFAULT '1' COMMENT '首页是否显示 0不显示 1显示',
  `indexorder` int(11) NOT NULL COMMENT '排序',
  `dk` int(11) NOT NULL,
  `pv` int(11) NOT NULL COMMENT '关注人数',
  `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销金额',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销金额',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销金额',
  `isdistri` int(11) NOT NULL COMMENT '分销标记 0参与 1不参与',
  `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价格结算金额',
  `viponedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价一级分销金额',
  `viptwodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价二级分销金额',
  `vipthreedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价三级分销金额',
  `userlabel` text NOT NULL COMMENT '用户标记',
  `independent` int(11) NOT NULL COMMENT '是否独立结算',
  `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许',
  `overrefund` tinyint(1) NOT NULL COMMENT '过期退款',
  `level` text NOT NULL COMMENT '会员等级',
  `dissettime` int(11) NOT NULL COMMENT '分佣结算时间',
  `nostoreshow` int(11) NOT NULL COMMENT '商户显示',
  `extflag` int(11) NOT NULL COMMENT '外链标记',
  `extlink` varchar(500) NOT NULL COMMENT '外链地址',
  `extinfo` text NOT NULL COMMENT '外链信息',
  `salesmid` int(11) NOT NULL COMMENT '业务员mid',
  `name` varchar(145) NOT NULL DEFAULT '0' COMMENT 'name方便查询',
  `diyposter` int(11) NOT NULL COMMENT '自定义海报',
  `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `paidid` int(11) NOT NULL COMMENT '支付有礼活动id',
  `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数',
  `week` varchar(355) NOT NULL COMMENT '按星期时间',
  `day` varchar(355) NOT NULL COMMENT '按天数时间',
  `daylimit` int(11) NOT NULL COMMENT '每日限量',
  `viparray` text NOT NULL COMMENT '会员减免数组',
  `disarray` text NOT NULL COMMENT '分销商佣金数组',
  `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量',
  `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额',
  `adv` text COMMENT '幻灯片',
  `wxapp_shareimg` varchar(200) DEFAULT NULL COMMENT '小程序分享图',
  `yuecashback` decimal(10,2) DEFAULT NULL COMMENT '普通用户余额返现',
  `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '会员余额返现',
  `is_describe_tip` tinyint(1) DEFAULT NULL COMMENT '重要提示开关',
  `describe` text COMMENT '重要提示信息',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`),
  KEY `idx_merchantid` (`merchantid`),
  KEY `idx_isindexshow` (`is_indexshow`),
  KEY `idx_is_show` (`is_show`),
  KEY `idx_indexorder` (`indexorder`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_couponlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `status` int(11) NOT NULL COMMENT '优惠券状态 1启用 0禁用 3已失效 2审核中 4未通过'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `type` int(11) NOT NULL COMMENT '优惠券类型 1 折扣券 2代金券 3套餐券 4 团购券 5优惠券'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','is_charge')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `is_charge` int(11) NOT NULL COMMENT '是否收费 1收费 0免费'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `logo` varchar(100) NOT NULL COMMENT '优惠券logo'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','indeximg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `indeximg` varchar(100) NOT NULL COMMENT '优惠券详情顶部图片'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `merchantid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `color` varchar(100) NOT NULL COMMENT '优惠券颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `title` varchar(145) NOT NULL COMMENT '优惠券标题'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','sub_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `sub_title` varchar(145) NOT NULL COMMENT '优惠券小标题'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','goodsdetail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `goodsdetail` longtext NOT NULL COMMENT '商品详情'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','time_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `time_type` int(11) NOT NULL COMMENT '时间类型 1.规定时间段 2 领取后限制'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `starttime` varchar(255) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `endtime` varchar(255) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','deadline')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `deadline` int(11) NOT NULL COMMENT '持续天数'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','quantity')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `quantity` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','surplus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `surplus` int(11) NOT NULL COMMENT '已售数量'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','get_limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `get_limit` int(11) NOT NULL COMMENT '限量'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `description` text NOT NULL COMMENT '卡券使用须知'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `usetimes` int(11) NOT NULL COMMENT '使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `createtime` varchar(255) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `price` decimal(10,2) NOT NULL COMMENT '收费金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `is_show` int(11) NOT NULL COMMENT '是否列表显示 0显示 1隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `vipstatus` int(11) NOT NULL DEFAULT '0' COMMENT 'VIP设置 0无vip限制 1VIP特价 2vip特供'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip价格'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','is_indexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `is_indexshow` int(11) NOT NULL DEFAULT '1' COMMENT '首页是否显示 0不显示 1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','indexorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `indexorder` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','dk')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `dk` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `pv` int(11) NOT NULL COMMENT '关注人数'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `isdistri` int(11) NOT NULL COMMENT '分销标记 0参与 1不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价格结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','viponedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `viponedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价一级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','viptwodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `viptwodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价二级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','vipthreedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `vipthreedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'VIP价三级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','userlabel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `userlabel` text NOT NULL COMMENT '用户标记'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','independent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `independent` int(11) NOT NULL COMMENT '是否独立结算'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','allowapplyre')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','overrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `overrefund` tinyint(1) NOT NULL COMMENT '过期退款'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `level` text NOT NULL COMMENT '会员等级'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `dissettime` int(11) NOT NULL COMMENT '分佣结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','nostoreshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `nostoreshow` int(11) NOT NULL COMMENT '商户显示'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','extflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `extflag` int(11) NOT NULL COMMENT '外链标记'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','extlink')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `extlink` varchar(500) NOT NULL COMMENT '外链地址'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','extinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `extinfo` text NOT NULL COMMENT '外链信息'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','salesmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `salesmid` int(11) NOT NULL COMMENT '业务员mid'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `name` varchar(145) NOT NULL DEFAULT '0' COMMENT 'name方便查询'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','diyposter')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `diyposter` int(11) NOT NULL COMMENT '自定义海报'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','pay_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','paidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `paidid` int(11) NOT NULL COMMENT '支付有礼活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `week` varchar(355) NOT NULL COMMENT '按星期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `day` varchar(355) NOT NULL COMMENT '按天数时间'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','daylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `daylimit` int(11) NOT NULL COMMENT '每日限量'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `viparray` text NOT NULL COMMENT '会员减免数组'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `disarray` text NOT NULL COMMENT '分销商佣金数组'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','alldaylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','isdistristatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `adv` text COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','wxapp_shareimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `wxapp_shareimg` varchar(200) DEFAULT NULL COMMENT '小程序分享图'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','yuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `yuecashback` decimal(10,2) DEFAULT NULL COMMENT '普通用户余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','vipyuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '会员余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','is_describe_tip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `is_describe_tip` tinyint(1) DEFAULT NULL COMMENT '重要提示开关'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   `describe` text COMMENT '重要提示信息'");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','idx_uniacid_aid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','idx_merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   KEY `idx_merchantid` (`merchantid`)");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','idx_isindexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   KEY `idx_isindexshow` (`is_indexshow`)");}
if(!pdo_fieldexists('ims_wlmerchant_couponlist','idx_is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_couponlist')." ADD   KEY `idx_is_show` (`is_show`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_credit2zero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `createtime` varchar(16) NOT NULL,
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_credit2zero','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_credit2zero')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_credit2zero','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_credit2zero')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_credit2zero','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_credit2zero')." ADD   `createtime` varchar(16) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_credit2zero','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_credit2zero')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_creditrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(245) NOT NULL,
  `num` varchar(30) NOT NULL COMMENT '数量',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `transid` varchar(145) NOT NULL COMMENT '三方单号',
  `status` int(11) NOT NULL,
  `paytype` int(2) NOT NULL COMMENT '1微信2后台',
  `ordersn` varchar(145) NOT NULL COMMENT '订单编号',
  `type` int(2) NOT NULL COMMENT '1积分2余额',
  `remark` varchar(145) NOT NULL COMMENT '备注',
  `table` tinyint(4) DEFAULT NULL COMMENT '1微擎2tg',
  `uid` int(11) NOT NULL COMMENT '用户微擎用户表id',
  `mid` int(11) NOT NULL COMMENT '用户智慧城市用户表id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=508 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_creditrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `openid` varchar(245) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `num` varchar(30) NOT NULL COMMENT '数量'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `createtime` varchar(145) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `transid` varchar(145) NOT NULL COMMENT '三方单号'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `status` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `paytype` int(2) NOT NULL COMMENT '1微信2后台'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','ordersn')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `ordersn` varchar(145) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `type` int(2) NOT NULL COMMENT '1积分2余额'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `remark` varchar(145) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','table')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `table` tinyint(4) DEFAULT NULL COMMENT '1微擎2tg'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `uid` int(11) NOT NULL COMMENT '用户微擎用户表id'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   `mid` int(11) NOT NULL COMMENT '用户智慧城市用户表id'");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_creditrecord','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_creditrecord')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_current` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '明细种类 1商户 2代理 3分销商',
  `type` int(11) NOT NULL COMMENT '订单种类 1抢购 2拼团 3卡券 4一卡通订单 5掌上信息 6付费入驻  7提现或驳回 8分销付费申请 9商户活动 10团购 -1后台修改 11在线买单  12砍价 13同城名片 14 大礼包核销结算 140 同城配送 15余额返现',
  `objid` int(11) NOT NULL COMMENT '代理 商户 分销商id',
  `fee` decimal(10,2) NOT NULL COMMENT '变更金额',
  `nowmoney` decimal(10,2) NOT NULL COMMENT '变更后金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `orderid` int(11) NOT NULL COMMENT '订单详情',
  `remark` varchar(255) NOT NULL COMMENT '修改备注',
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_type` (`type`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8 COMMENT='结算明细表';

");

if(!pdo_fieldexists('ims_wlmerchant_current','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_current','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_current','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `status` int(11) NOT NULL COMMENT '明细种类 1商户 2代理 3分销商'");}
if(!pdo_fieldexists('ims_wlmerchant_current','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `type` int(11) NOT NULL COMMENT '订单种类 1抢购 2拼团 3卡券 4一卡通订单 5掌上信息 6付费入驻  7提现或驳回 8分销付费申请 9商户活动 10团购 -1后台修改 11在线买单  12砍价 13同城名片 14 大礼包核销结算 140 同城配送 15余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_current','objid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `objid` int(11) NOT NULL COMMENT '代理 商户 分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_current','fee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `fee` decimal(10,2) NOT NULL COMMENT '变更金额'");}
if(!pdo_fieldexists('ims_wlmerchant_current','nowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `nowmoney` decimal(10,2) NOT NULL COMMENT '变更后金额'");}
if(!pdo_fieldexists('ims_wlmerchant_current','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_current','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `orderid` int(11) NOT NULL COMMENT '订单详情'");}
if(!pdo_fieldexists('ims_wlmerchant_current','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `remark` varchar(255) NOT NULL COMMENT '修改备注'");}
if(!pdo_fieldexists('ims_wlmerchant_current','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_current','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_current','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_current','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_current','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_current','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_current')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_comment_fabulous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL COMMENT '点赞用户id',
  `comment_id` int(11) DEFAULT NULL COMMENT '评论id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_comment_fabulous','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_comment_fabulous')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_comment_fabulous','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_comment_fabulous')." ADD   `mid` int(11) DEFAULT NULL COMMENT '点赞用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_comment_fabulous','comment_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_comment_fabulous')." ADD   `comment_id` int(11) DEFAULT NULL COMMENT '评论id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '发布人id',
  `content` text COMMENT '动态信息',
  `photo` text COMMENT '图片信息',
  `video` varchar(255) DEFAULT NULL COMMENT '视频信息',
  `create_time` int(11) DEFAULT NULL COMMENT '发布时间',
  `pv` int(11) DEFAULT '0' COMMENT '浏览量',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `lng` varchar(20) DEFAULT NULL COMMENT '经度',
  `lat` varchar(20) DEFAULT NULL COMMENT '纬度',
  `status` enum('1','2','3') DEFAULT '1' COMMENT '状态:1=审核中,2=未通过,3=显示中',
  `reason` varchar(255) DEFAULT NULL COMMENT '驳回理由',
  `is_fictitious` enum('1','2') DEFAULT '1' COMMENT '是否为虚拟动态:1=不是,2=是',
  `fictitious_nickname` varchar(20) DEFAULT NULL COMMENT '虚拟动态发布人昵称',
  `fictitious_avatar` varchar(255) DEFAULT NULL COMMENT '虚拟动态发布人头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `mid` int(11) DEFAULT NULL COMMENT '发布人id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `content` text COMMENT '动态信息'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','photo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `photo` text COMMENT '图片信息'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','video')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `video` varchar(255) DEFAULT NULL COMMENT '视频信息'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `pv` int(11) DEFAULT '0' COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `address` varchar(50) DEFAULT NULL COMMENT '地址'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `lng` varchar(20) DEFAULT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `lat` varchar(20) DEFAULT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `status` enum('1','2','3') DEFAULT '1' COMMENT '状态:1=审核中,2=未通过,3=显示中'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `reason` varchar(255) DEFAULT NULL COMMENT '驳回理由'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','is_fictitious')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `is_fictitious` enum('1','2') DEFAULT '1' COMMENT '是否为虚拟动态:1=不是,2=是'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','fictitious_nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `fictitious_nickname` varchar(20) DEFAULT NULL COMMENT '虚拟动态发布人昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic','fictitious_avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic')." ADD   `fictitious_avatar` varchar(255) DEFAULT NULL COMMENT '虚拟动态发布人头像'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_dynamic_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '评论用户',
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `create_time` int(11) DEFAULT NULL COMMENT '评论时间',
  `reply_id` int(11) DEFAULT NULL COMMENT '回复评论的id（为0则无回复关系）',
  `dynamic_id` int(11) DEFAULT NULL COMMENT '动态id',
  `status` enum('1','2','3') DEFAULT '1' COMMENT '审核状态:1=待审核,2=未通过,3=已通过',
  `source` enum('1','2','3') DEFAULT '1' COMMENT '1=公众号（默认）；2=h5；3=小程序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `mid` int(11) DEFAULT NULL COMMENT '评论用户'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `content` varchar(255) DEFAULT NULL COMMENT '评论内容'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '评论时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','reply_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `reply_id` int(11) DEFAULT NULL COMMENT '回复评论的id（为0则无回复关系）'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','dynamic_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `dynamic_id` int(11) DEFAULT NULL COMMENT '动态id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `status` enum('1','2','3') DEFAULT '1' COMMENT '审核状态:1=待审核,2=未通过,3=已通过'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_comment','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_comment')." ADD   `source` enum('1','2','3') DEFAULT '1' COMMENT '1=公众号（默认）；2=h5；3=小程序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_dynamic_fabulous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL COMMENT '点赞用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '点赞时间',
  `dynamic_id` int(11) DEFAULT NULL COMMENT '动态id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_fabulous','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_fabulous')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_fabulous','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_fabulous')." ADD   `mid` int(11) DEFAULT NULL COMMENT '点赞用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_fabulous','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_fabulous')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '点赞时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_dynamic_fabulous','dynamic_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_dynamic_fabulous')." ADD   `dynamic_id` int(11) DEFAULT NULL COMMENT '动态id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `mid_one` int(11) DEFAULT NULL COMMENT '用户id',
  `mid_two` int(11) DEFAULT NULL COMMENT '用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '交换时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_exchange','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_exchange')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_exchange','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_exchange')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_exchange','mid_one')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_exchange')." ADD   `mid_one` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_exchange','mid_two')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_exchange')." ADD   `mid_two` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_exchange','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_exchange')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '交换时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL COMMENT '标签标题',
  `sort` int(11) DEFAULT NULL COMMENT '标签排序',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_label','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_label')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_label','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_label')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_label','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_label')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_label','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_label')." ADD   `title` varchar(20) DEFAULT NULL COMMENT '标签标题'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_label','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_label')." ADD   `sort` int(11) DEFAULT NULL COMMENT '标签排序'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_label','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_label')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_matchmaker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `nickname` varchar(50) DEFAULT NULL COMMENT '红娘昵称',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系方式',
  `wechat_number` varchar(20) DEFAULT NULL COMMENT '微信号',
  `qq_unmber` varchar(15) DEFAULT NULL COMMENT 'qq号',
  `describe` varchar(255) DEFAULT NULL COMMENT '描述信息',
  `qrcode` varchar(255) DEFAULT NULL COMMENT '二维码',
  `status` enum('1','2','3','4') DEFAULT NULL COMMENT '状态:1=待付款,2=待审核,3=已通过,4=未通过',
  `total_commission` decimal(10,2) DEFAULT '0.00' COMMENT '总共赚取的佣金',
  `commission` decimal(10,2) DEFAULT '0.00' COMMENT '可提现佣金',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `create_source` enum('1','2') DEFAULT '1' COMMENT '创建来源:1=用户申请,2=后台创建',
  `reason` varchar(255) DEFAULT NULL COMMENT '驳回原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `nickname` varchar(50) DEFAULT NULL COMMENT '红娘昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `avatar` varchar(255) DEFAULT NULL COMMENT '头像'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','phone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `phone` varchar(20) DEFAULT NULL COMMENT '联系方式'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','wechat_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `wechat_number` varchar(20) DEFAULT NULL COMMENT '微信号'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','qq_unmber')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `qq_unmber` varchar(15) DEFAULT NULL COMMENT 'qq号'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `describe` varchar(255) DEFAULT NULL COMMENT '描述信息'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `qrcode` varchar(255) DEFAULT NULL COMMENT '二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `status` enum('1','2','3','4') DEFAULT NULL COMMENT '状态:1=待付款,2=待审核,3=已通过,4=未通过'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','total_commission')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `total_commission` decimal(10,2) DEFAULT '0.00' COMMENT '总共赚取的佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','commission')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `commission` decimal(10,2) DEFAULT '0.00' COMMENT '可提现佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','create_source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `create_source` enum('1','2') DEFAULT '1' COMMENT '创建来源:1=用户申请,2=后台创建'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker')." ADD   `reason` varchar(255) DEFAULT NULL COMMENT '驳回原因'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_matchmaker_commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `matchmaker_id` int(11) DEFAULT NULL COMMENT '红娘id',
  `type` enum('1','2') DEFAULT NULL COMMENT '类型:1=增加,2=减少',
  `money` decimal(10,2) DEFAULT NULL COMMENT '金额',
  `order_id` int(11) DEFAULT NULL COMMENT 'order订单表的id',
  `reason` varchar(80) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','matchmaker_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `matchmaker_id` int(11) DEFAULT NULL COMMENT '红娘id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `type` enum('1','2') DEFAULT NULL COMMENT '类型:1=增加,2=减少'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `money` decimal(10,2) DEFAULT NULL COMMENT '金额'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','order_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `order_id` int(11) DEFAULT NULL COMMENT 'order订单表的id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `reason` varchar(80) DEFAULT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_matchmaker_commission','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_matchmaker_commission')." ADD   `create_time` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `avatar` varchar(255) NOT NULL COMMENT '头像',
  `real_name` varchar(10) NOT NULL COMMENT '真实姓名',
  `gneder` enum('1','2') NOT NULL DEFAULT '1' COMMENT '性别:1=男,2=女',
  `birth` int(11) DEFAULT NULL COMMENT '出生日期',
  `height` tinyint(3) unsigned DEFAULT NULL COMMENT '身高(cm)',
  `weight` tinyint(3) unsigned DEFAULT NULL COMMENT '体重(kg)',
  `nation` varchar(15) DEFAULT NULL COMMENT '民族',
  `marital_status` enum('1','2','3','4','5','6') DEFAULT '1' COMMENT '婚姻情况:1=未婚,2=离异(无子女),3=离异(有抚养权),4=离异(无抚养权),5=丧偶(无子女),6=丧偶(有子女)',
  `work` varchar(30) DEFAULT NULL COMMENT '工作职务',
  `education` enum('1','2','3','4','5','6','7') DEFAULT '1' COMMENT '学历:1=小学,2=初中,3=高中/中专,4=专科,5=本科,6=硕士,7=博士',
  `current_province` int(11) DEFAULT NULL COMMENT '当前所在城市 - 省',
  `current_city` int(11) DEFAULT NULL COMMENT '当前所在城市 - 市',
  `current_area` int(11) DEFAULT NULL COMMENT '当前所在城市 - 区',
  `hometown_province` int(11) DEFAULT NULL COMMENT '户籍所在城市 - 省',
  `hometown_city` int(11) DEFAULT NULL COMMENT '户籍所在城市 - 市',
  `hometown_area` int(11) DEFAULT NULL COMMENT '户籍所在城市 - 区',
  `lng` varchar(20) DEFAULT NULL COMMENT '当前所在城市 - 经度',
  `lat` varchar(20) DEFAULT NULL COMMENT '当前所在城市 - 纬度',
  `address` varchar(255) DEFAULT NULL COMMENT '当前所在详细地址',
  `registered_residence_type` enum('1','2') DEFAULT NULL COMMENT '户籍类型:1=农业户口,2=非农业户口',
  `income` int(11) DEFAULT NULL COMMENT '月收入(元)',
  `live` enum('1','2','3','4','5','6','7') DEFAULT '1' COMMENT '居住情况:1=自购房(有贷款),2=自购房(无贷款),3=租房(合租),4=租房(整租),5=与父母同住,6=借住亲朋家,7=单位住房',
  `travel` enum('1','2') DEFAULT '1' COMMENT '出行情况:1=未购车,2=已购车',
  `vehicle` varchar(50) DEFAULT NULL COMMENT '车型号',
  `phone` varchar(15) DEFAULT NULL COMMENT '手机',
  `wechat_number` varchar(20) DEFAULT NULL COMMENT '微信号',
  `qq_number` varchar(15) DEFAULT NULL COMMENT 'QQ号',
  `min_age` tinyint(2) DEFAULT NULL COMMENT '择偶要求 - 最小年龄',
  `max_age` tinyint(2) DEFAULT NULL COMMENT '择偶要求 - 最大年龄',
  `min_height` tinyint(3) unsigned DEFAULT NULL COMMENT '择偶要求 - 最小身高',
  `max_height` tinyint(3) unsigned DEFAULT NULL COMMENT '择偶要求 - 最大身高',
  `require_marital_status` enum('1','2','3','4') DEFAULT '1' COMMENT '择偶要求 - 婚姻情况:1=不限,2=未婚,3=离异,4=丧偶',
  `require_education` enum('1','2','3','4','5','6','7','8') DEFAULT NULL COMMENT '择偶要求 - 学历:1=不限,2=小学,3=初中,4=高中/中专,5=专科,6=本科,7=硕士,8=博士',
  `require` varchar(255) DEFAULT NULL COMMENT '择偶要求 - 其他要求',
  `introduce` text COMMENT '自我介绍',
  `label_id` varchar(255) DEFAULT NULL COMMENT '个性标签',
  `photo` text COMMENT '个人照片',
  `video` varchar(255) DEFAULT NULL COMMENT '个人视频',
  `is_open_base` enum('1','2') DEFAULT '1' COMMENT '是否公开基本信息:1=不公开,2=公开',
  `is_open_contact` enum('1','2') DEFAULT '1' COMMENT '是否公开联系方式:1=不公开,2=公开',
  `is_open_photo` enum('1','2') DEFAULT '1' COMMENT '是否允许游客查看照片:1=不允许,2=允许',
  `examine` enum('1','2','3') DEFAULT '1' COMMENT '审核状态:1=待审核,2=未通过,3=已通过/显示中',
  `reason` varchar(255) DEFAULT NULL COMMENT '未通过原因',
  `is_top` enum('1','2') DEFAULT '1' COMMENT '是否置顶:1=未置顶,2=置顶中',
  `top_end_time` int(11) DEFAULT NULL COMMENT '置顶结束时间',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `matchmaker_id` int(11) DEFAULT NULL COMMENT '红娘id',
  `pv` int(11) DEFAULT '0' COMMENT '人气',
  `cover` varchar(255) DEFAULT NULL COMMENT '用户封面图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_member','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `avatar` varchar(255) NOT NULL COMMENT '头像'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','real_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `real_name` varchar(10) NOT NULL COMMENT '真实姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','gneder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `gneder` enum('1','2') NOT NULL DEFAULT '1' COMMENT '性别:1=男,2=女'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','birth')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `birth` int(11) DEFAULT NULL COMMENT '出生日期'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','height')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `height` tinyint(3) unsigned DEFAULT NULL COMMENT '身高(cm)'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','weight')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `weight` tinyint(3) unsigned DEFAULT NULL COMMENT '体重(kg)'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','nation')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `nation` varchar(15) DEFAULT NULL COMMENT '民族'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','marital_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `marital_status` enum('1','2','3','4','5','6') DEFAULT '1' COMMENT '婚姻情况:1=未婚,2=离异(无子女),3=离异(有抚养权),4=离异(无抚养权),5=丧偶(无子女),6=丧偶(有子女)'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','work')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `work` varchar(30) DEFAULT NULL COMMENT '工作职务'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','education')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `education` enum('1','2','3','4','5','6','7') DEFAULT '1' COMMENT '学历:1=小学,2=初中,3=高中/中专,4=专科,5=本科,6=硕士,7=博士'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','current_province')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `current_province` int(11) DEFAULT NULL COMMENT '当前所在城市 - 省'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','current_city')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `current_city` int(11) DEFAULT NULL COMMENT '当前所在城市 - 市'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','current_area')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `current_area` int(11) DEFAULT NULL COMMENT '当前所在城市 - 区'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','hometown_province')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `hometown_province` int(11) DEFAULT NULL COMMENT '户籍所在城市 - 省'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','hometown_city')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `hometown_city` int(11) DEFAULT NULL COMMENT '户籍所在城市 - 市'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','hometown_area')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `hometown_area` int(11) DEFAULT NULL COMMENT '户籍所在城市 - 区'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `lng` varchar(20) DEFAULT NULL COMMENT '当前所在城市 - 经度'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `lat` varchar(20) DEFAULT NULL COMMENT '当前所在城市 - 纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `address` varchar(255) DEFAULT NULL COMMENT '当前所在详细地址'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','registered_residence_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `registered_residence_type` enum('1','2') DEFAULT NULL COMMENT '户籍类型:1=农业户口,2=非农业户口'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','income')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `income` int(11) DEFAULT NULL COMMENT '月收入(元)'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','live')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `live` enum('1','2','3','4','5','6','7') DEFAULT '1' COMMENT '居住情况:1=自购房(有贷款),2=自购房(无贷款),3=租房(合租),4=租房(整租),5=与父母同住,6=借住亲朋家,7=单位住房'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','travel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `travel` enum('1','2') DEFAULT '1' COMMENT '出行情况:1=未购车,2=已购车'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','vehicle')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `vehicle` varchar(50) DEFAULT NULL COMMENT '车型号'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','phone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `phone` varchar(15) DEFAULT NULL COMMENT '手机'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','wechat_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `wechat_number` varchar(20) DEFAULT NULL COMMENT '微信号'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','qq_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `qq_number` varchar(15) DEFAULT NULL COMMENT 'QQ号'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','min_age')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `min_age` tinyint(2) DEFAULT NULL COMMENT '择偶要求 - 最小年龄'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','max_age')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `max_age` tinyint(2) DEFAULT NULL COMMENT '择偶要求 - 最大年龄'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','min_height')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `min_height` tinyint(3) unsigned DEFAULT NULL COMMENT '择偶要求 - 最小身高'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','max_height')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `max_height` tinyint(3) unsigned DEFAULT NULL COMMENT '择偶要求 - 最大身高'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','require_marital_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `require_marital_status` enum('1','2','3','4') DEFAULT '1' COMMENT '择偶要求 - 婚姻情况:1=不限,2=未婚,3=离异,4=丧偶'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','require_education')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `require_education` enum('1','2','3','4','5','6','7','8') DEFAULT NULL COMMENT '择偶要求 - 学历:1=不限,2=小学,3=初中,4=高中/中专,5=专科,6=本科,7=硕士,8=博士'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','require')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `require` varchar(255) DEFAULT NULL COMMENT '择偶要求 - 其他要求'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','introduce')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `introduce` text COMMENT '自我介绍'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','label_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `label_id` varchar(255) DEFAULT NULL COMMENT '个性标签'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','photo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `photo` text COMMENT '个人照片'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','video')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `video` varchar(255) DEFAULT NULL COMMENT '个人视频'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','is_open_base')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `is_open_base` enum('1','2') DEFAULT '1' COMMENT '是否公开基本信息:1=不公开,2=公开'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','is_open_contact')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `is_open_contact` enum('1','2') DEFAULT '1' COMMENT '是否公开联系方式:1=不公开,2=公开'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','is_open_photo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `is_open_photo` enum('1','2') DEFAULT '1' COMMENT '是否允许游客查看照片:1=不允许,2=允许'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','examine')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `examine` enum('1','2','3') DEFAULT '1' COMMENT '审核状态:1=待审核,2=未通过,3=已通过/显示中'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `reason` varchar(255) DEFAULT NULL COMMENT '未通过原因'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','is_top')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `is_top` enum('1','2') DEFAULT '1' COMMENT '是否置顶:1=未置顶,2=置顶中'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','top_end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `top_end_time` int(11) DEFAULT NULL COMMENT '置顶结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `sort` int(11) DEFAULT '1' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','matchmaker_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `matchmaker_id` int(11) DEFAULT NULL COMMENT '红娘id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `pv` int(11) DEFAULT '0' COMMENT '人气'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member','cover')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member')." ADD   `cover` varchar(255) DEFAULT NULL COMMENT '用户封面图片'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_member_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `type` enum('1','2') DEFAULT NULL COMMENT '会员卡类型:1=时限卡,2=次数卡',
  `end_time` int(11) DEFAULT '0' COMMENT '过期时间',
  `frequency` int(11) DEFAULT '0' COMMENT '总次数',
  `create_time` int(11) DEFAULT NULL COMMENT '开卡时间',
  `update_time` int(11) DEFAULT NULL COMMENT '最近续费时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `type` enum('1','2') DEFAULT NULL COMMENT '会员卡类型:1=时限卡,2=次数卡'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `end_time` int(11) DEFAULT '0' COMMENT '过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','frequency')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `frequency` int(11) DEFAULT '0' COMMENT '总次数'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '开卡时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_open','update_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_open')." ADD   `update_time` int(11) DEFAULT NULL COMMENT '最近续费时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_member_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '持卡人id(用户id)',
  `see_id` int(11) DEFAULT NULL COMMENT '查看的用户的id（用户的member_id）',
  `create_time` int(11) DEFAULT NULL COMMENT '查看时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_member_use','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_use')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_use','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_use')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_use','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_use')." ADD   `mid` int(11) DEFAULT NULL COMMENT '持卡人id(用户id)'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_use','see_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_use')." ADD   `see_id` int(11) DEFAULT NULL COMMENT '查看的用户的id（用户的member_id）'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_member_use','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_member_use')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '查看时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `member_id` int(11) DEFAULT NULL COMMENT '相亲会员表id',
  `object_mid` int(11) DEFAULT NULL COMMENT '收藏/浏览对象的mid',
  `object_member_id` int(11) DEFAULT NULL COMMENT '收藏/浏览对象的相亲会员表id',
  `create_time` int(11) DEFAULT NULL COMMENT '收藏/浏览时间',
  `type` enum('1','2') DEFAULT NULL COMMENT '类型:1=收藏,2=浏览历史',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','member_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `member_id` int(11) DEFAULT NULL COMMENT '相亲会员表id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','object_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `object_mid` int(11) DEFAULT NULL COMMENT '收藏/浏览对象的mid'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','object_member_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `object_member_id` int(11) DEFAULT NULL COMMENT '收藏/浏览对象的相亲会员表id'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '收藏/浏览时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_record')." ADD   `type` enum('1','2') DEFAULT NULL COMMENT '类型:1=收藏,2=浏览历史'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '会员卡标题',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '会员卡金额',
  `type` enum('1','2') DEFAULT NULL COMMENT '会员卡类型:1=时限卡,2=次数卡',
  `day` int(11) DEFAULT NULL COMMENT '有效时间（天）',
  `second` int(11) DEFAULT NULL COMMENT '次数',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_vip','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `title` varchar(50) DEFAULT NULL COMMENT '会员卡标题'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `money` decimal(10,2) DEFAULT '0.00' COMMENT '会员卡金额'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `type` enum('1','2') DEFAULT NULL COMMENT '会员卡类型:1=时限卡,2=次数卡'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `day` int(11) DEFAULT NULL COMMENT '有效时间（天）'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','second')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `second` int(11) DEFAULT NULL COMMENT '次数'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dating_vip_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '会员卡名称',
  `type` enum('1','2') DEFAULT '1' COMMENT '会员卡类型:1=时限卡,2=次数卡',
  `day` int(11) DEFAULT '0' COMMENT '天数',
  `frequency` int(11) DEFAULT '0' COMMENT '次数',
  `money` decimal(10,2) DEFAULT NULL COMMENT '订单金额',
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `create_time` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `title` varchar(50) DEFAULT NULL COMMENT '会员卡名称'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `type` enum('1','2') DEFAULT '1' COMMENT '会员卡类型:1=时限卡,2=次数卡'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `day` int(11) DEFAULT '0' COMMENT '天数'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','frequency')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `frequency` int(11) DEFAULT '0' COMMENT '次数'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `money` decimal(10,2) DEFAULT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('ims_wlmerchant_dating_vip_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dating_vip_record')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_delivery_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `detail` longtext NOT NULL COMMENT '详情',
  `price` decimal(10,2) NOT NULL COMMENT '购买价',
  `oldprice` decimal(10,2) NOT NULL COMMENT '市场价',
  `status` int(11) NOT NULL COMMENT '2售卖中 0下架中 待审核=5 未通过=6；已售罄=7 回收站 = 8',
  `thumb` varchar(145) NOT NULL COMMENT 'logo图',
  `thumbs` text NOT NULL COMMENT '图集',
  `cateid` int(11) NOT NULL COMMENT '分类id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `vipstatus` int(11) NOT NULL COMMENT '0无 1会员特价 2会员特供',
  `vipdiscount` decimal(10,2) NOT NULL COMMENT '会员减免金额',
  `sort` int(11) NOT NULL COMMENT '排序',
  `pv` int(11) NOT NULL COMMENT '人气',
  `optionstatus` int(11) NOT NULL COMMENT '规格设置 0无规格 1有规格',
  `deliveryprice` decimal(10,2) NOT NULL COMMENT '额外配送费',
  `share_title` varchar(255) NOT NULL COMMENT '分享标题',
  `share_image` varchar(255) NOT NULL COMMENT '分享图片',
  `share_desc` varchar(255) NOT NULL COMMENT '分享详情',
  `fictitiousnum` int(11) NOT NULL COMMENT '虚拟销量',
  `allstock` int(11) NOT NULL COMMENT '总库存',
  `daystock` int(11) NOT NULL COMMENT '每日库存',
  `creditmoney` decimal(10,2) NOT NULL COMMENT '积分抵扣金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `name` varchar(255) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `detail` longtext NOT NULL COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `price` decimal(10,2) NOT NULL COMMENT '购买价'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `oldprice` decimal(10,2) NOT NULL COMMENT '市场价'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `status` int(11) NOT NULL COMMENT '2售卖中 0下架中 待审核=5 未通过=6；已售罄=7 回收站 = 8'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `thumb` varchar(145) NOT NULL COMMENT 'logo图'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `thumbs` text NOT NULL COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `cateid` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `vipstatus` int(11) NOT NULL COMMENT '0无 1会员特价 2会员特供'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','vipdiscount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `vipdiscount` decimal(10,2) NOT NULL COMMENT '会员减免金额'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `pv` int(11) NOT NULL COMMENT '人气'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','optionstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `optionstatus` int(11) NOT NULL COMMENT '规格设置 0无规格 1有规格'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','deliveryprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `deliveryprice` decimal(10,2) NOT NULL COMMENT '额外配送费'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `share_title` varchar(255) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `share_image` varchar(255) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `share_desc` varchar(255) NOT NULL COMMENT '分享详情'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','fictitiousnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `fictitiousnum` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','allstock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `allstock` int(11) NOT NULL COMMENT '总库存'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','daystock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `daystock` int(11) NOT NULL COMMENT '每日库存'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_activity','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_activity')." ADD   `creditmoney` decimal(10,2) NOT NULL COMMENT '积分抵扣金额'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_delivery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号',
  `sid` int(11) NOT NULL COMMENT '所属店铺',
  `name` varchar(255) NOT NULL COMMENT '分类名称',
  `aid` int(11) NOT NULL COMMENT '所属代理',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态 0关闭 1开启',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_delivery_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD   `uniacid` int(11) NOT NULL COMMENT '所属公众号'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_category','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD   `sid` int(11) NOT NULL COMMENT '所属店铺'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD   `name` varchar(255) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_category','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD   `aid` int(11) NOT NULL COMMENT '所属代理'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_category','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_category','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_category')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0关闭 1开启'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_delivery_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商户id',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `mid` int(11) NOT NULL COMMENT '买家id',
  `specid` int(11) NOT NULL COMMENT '规格id',
  `tid` varchar(32) NOT NULL COMMENT '订单编号',
  `money` decimal(10,2) NOT NULL COMMENT '商品金额',
  `num` int(11) NOT NULL COMMENT '商品数量',
  `status` tinyint(1) NOT NULL COMMENT '订单状态 0未支付 1已支付 2已送达',
  `price` decimal(10,2) NOT NULL COMMENT '原价',
  `vipdiscount` decimal(10,2) NOT NULL COMMENT '会员折扣',
  `deliverymoney` decimal(10,2) NOT NULL COMMENT '额外配送费',
  `dotime` int(11) NOT NULL COMMENT '操作时间',
  `orderid` int(11) NOT NULL COMMENT '父订单id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_delivery_order','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','gid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `gid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `mid` int(11) NOT NULL COMMENT '买家id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','specid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `specid` int(11) NOT NULL COMMENT '规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `tid` varchar(32) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `money` decimal(10,2) NOT NULL COMMENT '商品金额'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `num` int(11) NOT NULL COMMENT '商品数量'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `status` tinyint(1) NOT NULL COMMENT '订单状态 0未支付 1已支付 2已送达'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `price` decimal(10,2) NOT NULL COMMENT '原价'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','vipdiscount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `vipdiscount` decimal(10,2) NOT NULL COMMENT '会员折扣'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','deliverymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `deliverymoney` decimal(10,2) NOT NULL COMMENT '额外配送费'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `dotime` int(11) NOT NULL COMMENT '操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `orderid` int(11) NOT NULL COMMENT '父订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_order','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_order')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_delivery_shopcart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `goodid` int(11) NOT NULL COMMENT '商品id',
  `num` int(11) NOT NULL COMMENT '数量',
  `specid` int(11) NOT NULL COMMENT '规格id',
  `cateid` int(11) NOT NULL COMMENT '商品分类id',
  `createtime` int(11) NOT NULL COMMENT '加入购物车的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','goodid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `goodid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `num` int(11) NOT NULL COMMENT '数量'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','specid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `specid` int(11) NOT NULL COMMENT '规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `cateid` int(11) NOT NULL COMMENT '商品分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_shopcart','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_shopcart')." ADD   `createtime` int(11) NOT NULL COMMENT '加入购物车的时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_delivery_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `name` varchar(255) NOT NULL COMMENT '规格名',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `oldprice` decimal(10,2) NOT NULL COMMENT '原价',
  `sort` int(11) NOT NULL COMMENT '排序',
  `allstock` int(11) NOT NULL COMMENT '总库存',
  `daystock` int(11) NOT NULL COMMENT '每日限量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `name` varchar(255) NOT NULL COMMENT '规格名'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `price` decimal(10,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `oldprice` decimal(10,2) NOT NULL COMMENT '原价'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','allstock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `allstock` int(11) NOT NULL COMMENT '总库存'");}
if(!pdo_fieldexists('ims_wlmerchant_delivery_spec','daystock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_delivery_spec')." ADD   `daystock` int(11) NOT NULL COMMENT '每日限量'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_disapply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '申请状态 1申请中 2代理审核通过 3平台审核通过 4已结算 5代理驳回 6平台驳回',
  `mid` int(11) NOT NULL COMMENT '申请人MID',
  `disid` int(11) NOT NULL COMMENT '申请人代理商ID',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '申请金额',
  `createtime` varchar(145) NOT NULL COMMENT '申请时间',
  `dotime` varchar(145) NOT NULL COMMENT '操作时间',
  `cashstatus` int(11) NOT NULL COMMENT '结算方式 1打款 2手动完成',
  `applymoney` decimal(10,2) DEFAULT '0.00',
  `trade_no` varchar(45) NOT NULL,
  `deletes` tinyint(1) DEFAULT '1' COMMENT '当前数据是否被合并并且删除(1=否2=是)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_disapply','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `status` int(11) NOT NULL COMMENT '申请状态 1申请中 2代理审核通过 3平台审核通过 4已结算 5代理驳回 6平台驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `mid` int(11) NOT NULL COMMENT '申请人MID'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','disid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `disid` int(11) NOT NULL COMMENT '申请人代理商ID'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '申请金额'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `createtime` varchar(145) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `dotime` varchar(145) NOT NULL COMMENT '操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','cashstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `cashstatus` int(11) NOT NULL COMMENT '结算方式 1打款 2手动完成'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','applymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `applymoney` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','trade_no')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `trade_no` varchar(45) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_disapply','deletes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disapply')." ADD   `deletes` tinyint(1) DEFAULT '1' COMMENT '当前数据是否被合并并且删除(1=否2=是)'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_disdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `disorderid` int(11) NOT NULL COMMENT '分销订单id',
  `leadid` int(11) NOT NULL COMMENT '分销商mid',
  `buymid` int(11) NOT NULL COMMENT '下级mid',
  `type` int(11) NOT NULL COMMENT '1收入 2支出',
  `price` decimal(10,2) NOT NULL COMMENT '金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `plugin` varchar(32) NOT NULL COMMENT '插件类型',
  `rank` int(11) NOT NULL COMMENT '订单层级',
  `reason` varchar(128) NOT NULL COMMENT '原因',
  `nowmoney` decimal(10,2) NOT NULL COMMENT '当前金额',
  `checkcode` int(11) NOT NULL COMMENT '核销码',
  `status` tinyint(1) NOT NULL COMMENT '类型 0分销 1业务员',
  `aid` int(11) NOT NULL COMMENT '代理id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_plugin` (`plugin`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_disdetail','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','disorderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `disorderid` int(11) NOT NULL COMMENT '分销订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','leadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `leadid` int(11) NOT NULL COMMENT '分销商mid'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','buymid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `buymid` int(11) NOT NULL COMMENT '下级mid'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `type` int(11) NOT NULL COMMENT '1收入 2支出'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `price` decimal(10,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件类型'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','rank')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `rank` int(11) NOT NULL COMMENT '订单层级'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `reason` varchar(128) NOT NULL COMMENT '原因'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','nowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `nowmoney` decimal(10,2) NOT NULL COMMENT '当前金额'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `checkcode` int(11) NOT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `status` tinyint(1) NOT NULL COMMENT '类型 0分销 1业务员'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_disdetail','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disdetail')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_dislevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL COMMENT '等级名称',
  `onecommission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级佣金比例',
  `twocommission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级佣金比例',
  `threecommission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级佣金比例',
  `upstandard` int(11) NOT NULL COMMENT '升级要求',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `plugin` text NOT NULL COMMENT '适用插件',
  `isdefault` int(11) NOT NULL COMMENT '是否默认',
  `ownstatus` int(11) NOT NULL COMMENT '是否自购返佣',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_isdefault` (`isdefault`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_dislevel','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `name` varchar(45) NOT NULL COMMENT '等级名称'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','onecommission')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `onecommission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','twocommission')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `twocommission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','threecommission')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `threecommission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','upstandard')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `upstandard` int(11) NOT NULL COMMENT '升级要求'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `plugin` text NOT NULL COMMENT '适用插件'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','isdefault')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `isdefault` int(11) NOT NULL COMMENT '是否默认'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','ownstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   `ownstatus` int(11) NOT NULL COMMENT '是否自购返佣'");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_dislevel','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_dislevel')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_disorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '分销结算状态 0不可结算 1可结算 2已结算 3已退款',
  `plugin` varchar(145) DEFAULT NULL COMMENT '订单所属插件',
  `orderid` int(11) DEFAULT NULL COMMENT '订单id',
  `orderprice` decimal(10,2) DEFAULT NULL COMMENT '订单金额',
  `buymid` int(11) DEFAULT NULL COMMENT '购买人id',
  `oneleadid` int(11) DEFAULT NULL COMMENT '一级分销商id',
  `twoleadid` int(11) DEFAULT NULL COMMENT '二级分销商id',
  `threeleadid` int(11) DEFAULT NULL COMMENT '三级分销商id',
  `leadmoney` text COMMENT '分销提成金额',
  `createtime` varchar(145) DEFAULT NULL COMMENT '创建时间',
  `neworderflag` int(11) NOT NULL COMMENT '新订单',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_buymind` (`buymid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_neworderflag` (`neworderflag`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_disorder','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `status` int(11) DEFAULT NULL COMMENT '分销结算状态 0不可结算 1可结算 2已结算 3已退款'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `plugin` varchar(145) DEFAULT NULL COMMENT '订单所属插件'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `orderid` int(11) DEFAULT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','orderprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `orderprice` decimal(10,2) DEFAULT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','buymid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `buymid` int(11) DEFAULT NULL COMMENT '购买人id'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','oneleadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `oneleadid` int(11) DEFAULT NULL COMMENT '一级分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','twoleadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `twoleadid` int(11) DEFAULT NULL COMMENT '二级分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','threeleadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `threeleadid` int(11) DEFAULT NULL COMMENT '三级分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','leadmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `leadmoney` text COMMENT '分销提成金额'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `createtime` varchar(145) DEFAULT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','neworderflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   `neworderflag` int(11) NOT NULL COMMENT '新订单'");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','idx_buymind')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   KEY `idx_buymind` (`buymid`)");}
if(!pdo_fieldexists('ims_wlmerchant_disorder','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_disorder')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_distributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户表id',
  `disflag` int(11) NOT NULL COMMENT '分销商标识 1分销商 0下线 -1失效中',
  `leadid` int(11) NOT NULL COMMENT '上级id -1为直属',
  `dismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '累计佣金',
  `nowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现有佣金',
  `createtime` varchar(45) NOT NULL COMMENT '创建时间',
  `nickname` varchar(145) NOT NULL COMMENT '昵称',
  `realname` varchar(145) NOT NULL COMMENT '真实姓名',
  `mobile` varchar(100) NOT NULL COMMENT '电话',
  `dislevel` int(11) NOT NULL COMMENT '分销商等级',
  `lockflag` int(11) NOT NULL COMMENT '锁死标志 0锁死 1未锁死',
  `expiretime` int(11) NOT NULL COMMENT '过期时间',
  `source` int(11) NOT NULL COMMENT '来源 1后台添加 0用户申请',
  `subnum` int(11) unsigned NOT NULL COMMENT '下级数量',
  `updatetime` varchar(32) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_leadid` (`leadid`),
  KEY `idx_lockflag` (`lockflag`),
  KEY `idx_disflag` (`disflag`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_distributor','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `mid` int(11) NOT NULL COMMENT '用户表id'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','disflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `disflag` int(11) NOT NULL COMMENT '分销商标识 1分销商 0下线 -1失效中'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','leadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `leadid` int(11) NOT NULL COMMENT '上级id -1为直属'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','dismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `dismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '累计佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','nowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `nowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现有佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `createtime` varchar(45) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `nickname` varchar(145) NOT NULL COMMENT '昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','realname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `realname` varchar(145) NOT NULL COMMENT '真实姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `mobile` varchar(100) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','dislevel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `dislevel` int(11) NOT NULL COMMENT '分销商等级'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','lockflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `lockflag` int(11) NOT NULL COMMENT '锁死标志 0锁死 1未锁死'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','expiretime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `expiretime` int(11) NOT NULL COMMENT '过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `source` int(11) NOT NULL COMMENT '来源 1后台添加 0用户申请'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','subnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `subnum` int(11) unsigned NOT NULL COMMENT '下级数量'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   `updatetime` varchar(32) NOT NULL COMMENT '修改时间'");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','idx_leadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   KEY `idx_leadid` (`leadid`)");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','idx_lockflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   KEY `idx_lockflag` (`lockflag`)");}
if(!pdo_fieldexists('ims_wlmerchant_distributor','idx_disflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_distributor')." ADD   KEY `idx_disflag` (`disflag`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_diyform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '商户id',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `info` longtext NOT NULL COMMENT '内容',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '最近编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_diyform','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `sid` int(11) NOT NULL DEFAULT '0' COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `title` varchar(50) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','info')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `info` longtext NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `create_time` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diyform','update_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diyform')." ADD   `update_time` int(11) DEFAULT '0' COMMENT '最近编辑时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_diypage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0' COMMENT '公众号ID',
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '所属代理ID',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '页面的类型 0=所有内容(供开发者查看);1=自定义页面;2=商城首页;3=抢购首页;4=团购首页;',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '页面的名称/页面的标题',
  `data` longtext NOT NULL COMMENT '当前页面的配置数据(base64加密)',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '建立时间',
  `lastedittime` int(11) NOT NULL DEFAULT '0' COMMENT '\n最后编辑时间',
  `preview_image` varchar(100) NOT NULL COMMENT '页面预览效果图片',
  `page_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号页面   2=小程序页面',
  `diymenu` int(11) NOT NULL DEFAULT '0' COMMENT '自定义菜单',
  `diyadv` int(11) NOT NULL DEFAULT '0' COMMENT '自定义广告',
  `is_public` tinyint(1) NOT NULL COMMENT '0=私有页面,1=公共页面',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_lastedittime` (`lastedittime`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='页面信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_diypage','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0' COMMENT '公众号ID'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `aid` int(11) NOT NULL DEFAULT '0' COMMENT '所属代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '页面的类型 0=所有内容(供开发者查看);1=自定义页面;2=商城首页;3=抢购首页;4=团购首页;'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `name` varchar(30) NOT NULL DEFAULT '' COMMENT '页面的名称/页面的标题'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `data` longtext NOT NULL COMMENT '当前页面的配置数据(base64加密)'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '建立时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','lastedittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `lastedittime` int(11) NOT NULL DEFAULT '0' COMMENT '\n最后编辑时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','preview_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `preview_image` varchar(100) NOT NULL COMMENT '页面预览效果图片'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','page_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `page_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号页面   2=小程序页面'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','diymenu')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `diymenu` int(11) NOT NULL DEFAULT '0' COMMENT '自定义菜单'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','diyadv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `diyadv` int(11) NOT NULL DEFAULT '0' COMMENT '自定义广告'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','is_public')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   `is_public` tinyint(1) NOT NULL COMMENT '0=私有页面,1=公共页面'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','idx_lastedittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   KEY `idx_lastedittime` (`lastedittime`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_diypage_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `aid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '固定为1',
  `name` varchar(255) NOT NULL COMMENT '广告名',
  `data` text NOT NULL COMMENT '广告内容',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `lastedittime` int(11) NOT NULL DEFAULT '0' COMMENT '上次修改时间',
  `adv_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号页面   2=小程序页面',
  `is_public` tinyint(1) NOT NULL COMMENT '0=私有广告,1=公共广告',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_lastedittime` (`lastedittime`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='广告信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `type` int(11) NOT NULL DEFAULT '0' COMMENT '固定为1'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `name` varchar(255) NOT NULL COMMENT '广告名'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `data` text NOT NULL COMMENT '广告内容'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','lastedittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `lastedittime` int(11) NOT NULL DEFAULT '0' COMMENT '上次修改时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','adv_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `adv_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号页面   2=小程序页面'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','is_public')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   `is_public` tinyint(1) NOT NULL COMMENT '0=私有广告,1=公共广告'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   KEY `idx_createtime` (`createtime`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_adv','idx_lastedittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_adv')." ADD   KEY `idx_lastedittime` (`lastedittime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_diypage_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(125) NOT NULL COMMENT '名称',
  `data` text NOT NULL COMMENT '内容',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `lastedittime` int(11) NOT NULL COMMENT '上次修改时间',
  `menu_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号菜单   2=小程序菜单',
  `is_public` tinyint(1) DEFAULT NULL COMMENT '0=私有菜单,1=公共菜单',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='菜单信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `name` varchar(125) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `data` text NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','lastedittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `lastedittime` int(11) NOT NULL COMMENT '上次修改时间'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','menu_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `menu_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号菜单   2=小程序菜单'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','is_public')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   `is_public` tinyint(1) DEFAULT NULL COMMENT '0=私有菜单,1=公共菜单'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_menu','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_menu')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_diypage_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0' COMMENT '公众号ID',
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '代理id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '页面的类型页面的类型 1=自定义;2=商城首页;3=会员中心;4=分销中心;5=商品详情页;6=积分商城;7=整点秒杀;8=兑换中心;9=快速购买;99=公用模块''',
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT '模板名称',
  `data` longtext NOT NULL COMMENT '模板页面配置信息',
  `preview` varchar(100) NOT NULL DEFAULT '' COMMENT '预览图片地址',
  `tplid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) NOT NULL DEFAULT '0' COMMENT '模板分类id',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `page_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号模板   2=小程序模板',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_cate` (`cate`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='模板信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0' COMMENT '公众号ID'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `aid` int(11) NOT NULL DEFAULT '0' COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '页面的类型页面的类型 1=自定义;2=商城首页;3=会员中心;4=分销中心;5=商品详情页;6=积分商城;7=整点秒杀;8=兑换中心;9=快速购买;99=公用模块'''");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `name` varchar(25) NOT NULL DEFAULT '' COMMENT '模板名称'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `data` longtext NOT NULL COMMENT '模板页面配置信息'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','preview')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `preview` varchar(100) NOT NULL DEFAULT '' COMMENT '预览图片地址'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','tplid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `tplid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','cate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `cate` int(11) NOT NULL DEFAULT '0' COMMENT '模板分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','deleted')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `deleted` tinyint(3) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','page_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   `page_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号模板   2=小程序模板'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp','idx_cate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp')." ADD   KEY `idx_cate` (`cate`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_diypage_temp_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL COMMENT '模板分类名',
  `aid` int(11) NOT NULL DEFAULT '0',
  `cate_class` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1=公众号模板分类   2=小程序模板分类',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='模板分类信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD   `name` varchar(255) NOT NULL COMMENT '模板分类名'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','cate_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD   `cate_class` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1=公众号模板分类   2=小程序模板分类'");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_diypage_temp_cate','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_diypage_temp_cate')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_draw` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(25) NOT NULL COMMENT '主题,分享主题',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型：1=9宫格，2=16宫格',
  `integral_consume` int(11) NOT NULL DEFAULT '0' COMMENT '用户抽奖次数使用完后继续抽奖需要消耗的积分(0则不消耗积分)',
  `integral_give` int(11) NOT NULL DEFAULT '0' COMMENT '用户分享后其他用户点击时获取的积分(0则不赠送积分)',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态：1=未开启，2=使用中',
  `share_image` varchar(255) DEFAULT NULL COMMENT '顶部图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `start_time` int(11) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(11) DEFAULT NULL COMMENT '结束时间',
  `total_join_times` int(11) DEFAULT NULL COMMENT '总免费参加次数',
  `total_draw_times` int(11) DEFAULT NULL COMMENT '总中奖次数',
  `day_join_times` int(11) DEFAULT NULL COMMENT '每人每天免费参加次数',
  `day_draw_times` int(11) DEFAULT NULL COMMENT '每人每天中奖次数',
  `fictitious_visit` int(11) DEFAULT NULL COMMENT '虚拟参加人数',
  `fictitious_prize` int(11) DEFAULT NULL COMMENT '虚拟中奖人数',
  `fictitious_pv` int(11) DEFAULT NULL COMMENT '虚拟浏览人数',
  `background_image` varchar(255) DEFAULT NULL COMMENT '背景图',
  `background_music` varchar(255) DEFAULT NULL COMMENT '背景音乐',
  `start_image` varchar(255) DEFAULT NULL COMMENT '开始抽奖图片',
  `prize_image` varchar(255) DEFAULT NULL COMMENT '中奖效果图片',
  `not_prize_image` varchar(255) DEFAULT NULL COMMENT '未中奖背景图',
  `use_music` varchar(255) DEFAULT NULL COMMENT '抽奖音效',
  `rule` longtext COMMENT '规则说明',
  `introduce` longtext COMMENT '抽奖介绍',
  `pv` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览人数',
  `bg_color` varchar(10) DEFAULT NULL COMMENT '背景颜色',
  `button_more` varchar(255) DEFAULT NULL COMMENT '获取更多抽奖次数按钮',
  `button_draw` varchar(255) DEFAULT NULL COMMENT '抽奖按钮',
  `button_prize` varchar(255) DEFAULT NULL COMMENT '我的奖品按钮',
  `menu_id` int(11) unsigned DEFAULT '0' COMMENT '自定义装修菜单id',
  `button_color` varchar(32) NOT NULL COMMENT '小按钮颜色',
  `button_shadow` varchar(32) NOT NULL COMMENT '小按钮阴影颜色',
  `poster_bg` varchar(255) DEFAULT NULL COMMENT '海报背景图',
  `wheel_bg` varchar(255) DEFAULT NULL COMMENT '轮盘扇叶背景颜色',
  `share_title` varchar(50) DEFAULT NULL COMMENT '分享标题',
  `share_desc` varchar(255) DEFAULT NULL COMMENT '分享描述',
  `share_img` varchar(255) DEFAULT NULL COMMENT '分享图片',
  `day_parin_times` int(11) DEFAULT NULL COMMENT '每天参与总次数',
  `total_parin_times` int(11) DEFAULT NULL COMMENT '总共参与的总人数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_draw','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_draw','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `title` varchar(25) NOT NULL COMMENT '主题,分享主题'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型：1=9宫格，2=16宫格'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','integral_consume')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `integral_consume` int(11) NOT NULL DEFAULT '0' COMMENT '用户抽奖次数使用完后继续抽奖需要消耗的积分(0则不消耗积分)'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','integral_give')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `integral_give` int(11) NOT NULL DEFAULT '0' COMMENT '用户分享后其他用户点击时获取的积分(0则不赠送积分)'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态：1=未开启，2=使用中'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `share_image` varchar(255) DEFAULT NULL COMMENT '顶部图片'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `start_time` int(11) DEFAULT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `end_time` int(11) DEFAULT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','total_join_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `total_join_times` int(11) DEFAULT NULL COMMENT '总免费参加次数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','total_draw_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `total_draw_times` int(11) DEFAULT NULL COMMENT '总中奖次数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','day_join_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `day_join_times` int(11) DEFAULT NULL COMMENT '每人每天免费参加次数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','day_draw_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `day_draw_times` int(11) DEFAULT NULL COMMENT '每人每天中奖次数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','fictitious_visit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `fictitious_visit` int(11) DEFAULT NULL COMMENT '虚拟参加人数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','fictitious_prize')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `fictitious_prize` int(11) DEFAULT NULL COMMENT '虚拟中奖人数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','fictitious_pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `fictitious_pv` int(11) DEFAULT NULL COMMENT '虚拟浏览人数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','background_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `background_image` varchar(255) DEFAULT NULL COMMENT '背景图'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','background_music')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `background_music` varchar(255) DEFAULT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','start_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `start_image` varchar(255) DEFAULT NULL COMMENT '开始抽奖图片'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','prize_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `prize_image` varchar(255) DEFAULT NULL COMMENT '中奖效果图片'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','not_prize_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `not_prize_image` varchar(255) DEFAULT NULL COMMENT '未中奖背景图'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','use_music')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `use_music` varchar(255) DEFAULT NULL COMMENT '抽奖音效'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','rule')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `rule` longtext COMMENT '规则说明'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','introduce')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `introduce` longtext COMMENT '抽奖介绍'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `pv` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览人数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','bg_color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `bg_color` varchar(10) DEFAULT NULL COMMENT '背景颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','button_more')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `button_more` varchar(255) DEFAULT NULL COMMENT '获取更多抽奖次数按钮'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','button_draw')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `button_draw` varchar(255) DEFAULT NULL COMMENT '抽奖按钮'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','button_prize')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `button_prize` varchar(255) DEFAULT NULL COMMENT '我的奖品按钮'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','menu_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `menu_id` int(11) unsigned DEFAULT '0' COMMENT '自定义装修菜单id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','button_color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `button_color` varchar(32) NOT NULL COMMENT '小按钮颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','button_shadow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `button_shadow` varchar(32) NOT NULL COMMENT '小按钮阴影颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','poster_bg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `poster_bg` varchar(255) DEFAULT NULL COMMENT '海报背景图'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','wheel_bg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `wheel_bg` varchar(255) DEFAULT NULL COMMENT '轮盘扇叶背景颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `share_title` varchar(50) DEFAULT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `share_desc` varchar(255) DEFAULT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','share_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `share_img` varchar(255) DEFAULT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','day_parin_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `day_parin_times` int(11) DEFAULT NULL COMMENT '每天参与总次数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw','total_parin_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw')." ADD   `total_parin_times` int(11) DEFAULT NULL COMMENT '总共参与的总人数'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_draw_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '奖品类型:1=现金红包,2=线上红包,3=积分,4=激活码,5=商品',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id、红包id',
  `goods_plugin` varchar(20) DEFAULT NULL COMMENT '商品类型(英文字符串标识)',
  `sid` int(11) DEFAULT NULL COMMENT '关联商户(仅奖品类型为商品时存在)',
  `get_type` tinyint(1) DEFAULT NULL COMMENT '领取方式：1=发送现金红包，2=增加到余额(仅奖品类型为现金红包时操作)',
  `prize_number` double(10,2) DEFAULT NULL COMMENT '现金红包-金额、积分-奖励积分',
  `code_keyword` varchar(255) DEFAULT NULL COMMENT '激活码关键字',
  `title` varchar(25) NOT NULL COMMENT '奖品名称',
  `image` varchar(255) NOT NULL COMMENT '奖品图片',
  `probability` decimal(10,2) NOT NULL COMMENT '中奖概率(1-100)%',
  `day_number` int(11) NOT NULL DEFAULT '0' COMMENT '每日份数',
  `total_number` int(11) NOT NULL DEFAULT '0' COMMENT '总份数',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态:1=上架，2=下架',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `day_prize` int(11) DEFAULT '0' COMMENT '每人每天可中奖次数',
  `total_prize` int(11) DEFAULT NULL COMMENT '每人总共可中奖次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_draw_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `type` tinyint(1) NOT NULL COMMENT '奖品类型:1=现金红包,2=线上红包,3=积分,4=激活码,5=商品'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `goods_id` int(11) DEFAULT NULL COMMENT '商品id、红包id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','goods_plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `goods_plugin` varchar(20) DEFAULT NULL COMMENT '商品类型(英文字符串标识)'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `sid` int(11) DEFAULT NULL COMMENT '关联商户(仅奖品类型为商品时存在)'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','get_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `get_type` tinyint(1) DEFAULT NULL COMMENT '领取方式：1=发送现金红包，2=增加到余额(仅奖品类型为现金红包时操作)'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','prize_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `prize_number` double(10,2) DEFAULT NULL COMMENT '现金红包-金额、积分-奖励积分'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','code_keyword')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `code_keyword` varchar(255) DEFAULT NULL COMMENT '激活码关键字'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `title` varchar(25) NOT NULL COMMENT '奖品名称'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `image` varchar(255) NOT NULL COMMENT '奖品图片'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','probability')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `probability` decimal(10,2) NOT NULL COMMENT '中奖概率(1-100)%'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','day_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `day_number` int(11) NOT NULL DEFAULT '0' COMMENT '每日份数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','total_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `total_number` int(11) NOT NULL DEFAULT '0' COMMENT '总份数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `status` tinyint(1) DEFAULT '1' COMMENT '状态:1=上架，2=下架'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','day_prize')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `day_prize` int(11) DEFAULT '0' COMMENT '每人每天可中奖次数'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_goods','total_prize')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_goods')." ADD   `total_prize` int(11) DEFAULT NULL COMMENT '每人总共可中奖次数'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_draw_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL,
  `aid` int(11) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '模块类型:1=抽奖,2=...',
  `activity_id` int(11) DEFAULT NULL COMMENT '活动id',
  `mid` int(11) NOT NULL COMMENT '分享用户id',
  `click_mid` int(11) NOT NULL COMMENT '点击用户id',
  `create_time` int(11) NOT NULL COMMENT '点击时间',
  `integral` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '获取的积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_draw_help','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `uniacid` int(11) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `aid` int(11) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '模块类型:1=抽奖,2=...'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','activity_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `activity_id` int(11) DEFAULT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `mid` int(11) NOT NULL COMMENT '分享用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','click_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `click_mid` int(11) NOT NULL COMMENT '点击用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `create_time` int(11) NOT NULL COMMENT '点击时间'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_help','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_help')." ADD   `integral` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '获取的积分'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_draw_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `draw_id` int(11) NOT NULL DEFAULT '0' COMMENT '抽奖活动id',
  `draw_goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '奖品id',
  `probability` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '中奖几率',
  `serial_number` tinyint(2) DEFAULT NULL COMMENT '序号(当前奖品在该活动中的顺序)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_draw_join','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_join')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_draw_join','draw_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_join')." ADD   `draw_id` int(11) NOT NULL DEFAULT '0' COMMENT '抽奖活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_join','draw_goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_join')." ADD   `draw_goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '奖品id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_join','probability')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_join')." ADD   `probability` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '中奖几率'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_join','serial_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_join')." ADD   `serial_number` tinyint(2) DEFAULT NULL COMMENT '序号(当前奖品在该活动中的顺序)'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_draw_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `draw_id` int(11) NOT NULL COMMENT '活动id',
  `draw_goods_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '奖品id（为0则未中奖）',
  `create_time` int(11) DEFAULT NULL COMMENT '抽奖时间',
  `is_get` tinyint(1) DEFAULT '1' COMMENT '是否领取奖品:1=未领取，2=已领取',
  `order_no` varchar(50) NOT NULL COMMENT '订单号',
  `token_id` int(11) NOT NULL COMMENT '激活码id',
  `is_free` tinyint(1) DEFAULT '1' COMMENT '当前抽奖是否为免费抽奖:1=免费,2=使用积分抽奖',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_draw_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','draw_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `draw_id` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','draw_goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `draw_goods_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '奖品id（为0则未中奖）'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '抽奖时间'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','is_get')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `is_get` tinyint(1) DEFAULT '1' COMMENT '是否领取奖品:1=未领取，2=已领取'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','order_no')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `order_no` varchar(50) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','token_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `token_id` int(11) NOT NULL COMMENT '激活码id'");}
if(!pdo_fieldexists('ims_wlmerchant_draw_record','is_free')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_draw_record')." ADD   `is_free` tinyint(1) DEFAULT '1' COMMENT '当前抽奖是否为免费抽奖:1=免费,2=使用积分抽奖'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `merchantid` int(11) NOT NULL COMMENT '商家id',
  `orderid` int(11) NOT NULL COMMENT '订单id',
  `name` varchar(145) NOT NULL COMMENT '收件人姓名',
  `tel` varchar(45) NOT NULL COMMENT '收件人电话',
  `address` text NOT NULL COMMENT '地址',
  `expressprice` decimal(10,2) NOT NULL COMMENT '快递费',
  `expressname` varchar(45) NOT NULL COMMENT '物流名称',
  `expresssn` varchar(45) NOT NULL COMMENT '物流单号',
  `sendtime` varchar(45) NOT NULL COMMENT '发货时间',
  `receivetime` varchar(45) NOT NULL COMMENT '接收时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_orderid` (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_express','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_express','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_express','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_express','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_express','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `merchantid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_express','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `orderid` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_express','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `name` varchar(145) NOT NULL COMMENT '收件人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_express','tel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `tel` varchar(45) NOT NULL COMMENT '收件人电话'");}
if(!pdo_fieldexists('ims_wlmerchant_express','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `address` text NOT NULL COMMENT '地址'");}
if(!pdo_fieldexists('ims_wlmerchant_express','expressprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `expressprice` decimal(10,2) NOT NULL COMMENT '快递费'");}
if(!pdo_fieldexists('ims_wlmerchant_express','expressname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `expressname` varchar(45) NOT NULL COMMENT '物流名称'");}
if(!pdo_fieldexists('ims_wlmerchant_express','expresssn')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `expresssn` varchar(45) NOT NULL COMMENT '物流单号'");}
if(!pdo_fieldexists('ims_wlmerchant_express','sendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `sendtime` varchar(45) NOT NULL COMMENT '发货时间'");}
if(!pdo_fieldexists('ims_wlmerchant_express','receivetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   `receivetime` varchar(45) NOT NULL COMMENT '接收时间'");}
if(!pdo_fieldexists('ims_wlmerchant_express','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_express','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_express_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT '模板名称',
  `expressarray` text NOT NULL COMMENT '详细运费',
  `defaultnum` int(11) NOT NULL COMMENT '默认起始件数',
  `defaultmoney` decimal(10,2) NOT NULL COMMENT '默认起始费用',
  `defaultnumex` int(11) NOT NULL COMMENT '默认增加件数',
  `defaultmoneyex` decimal(10,2) NOT NULL COMMENT '默认增加费用',
  `createtime` varchar(45) NOT NULL COMMENT '创建时间',
  `sid` int(11) NOT NULL COMMENT '运费模板',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_express_template','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `name` varchar(200) NOT NULL COMMENT '模板名称'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','expressarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `expressarray` text NOT NULL COMMENT '详细运费'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','defaultnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `defaultnum` int(11) NOT NULL COMMENT '默认起始件数'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','defaultmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `defaultmoney` decimal(10,2) NOT NULL COMMENT '默认起始费用'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','defaultnumex')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `defaultnumex` int(11) NOT NULL COMMENT '默认增加件数'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','defaultmoneyex')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `defaultmoneyex` decimal(10,2) NOT NULL COMMENT '默认增加费用'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `createtime` varchar(45) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   `sid` int(11) NOT NULL COMMENT '运费模板'");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_express_template','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_express_template')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fabulous` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL COMMENT '点赞用户id',
  `relation_id` int(10) unsigned NOT NULL COMMENT '关联好评表||头条留言表的id',
  `class` tinyint(1) unsigned NOT NULL COMMENT '点赞类别(1=好评点赞,2=头条留言点赞)',
  `times` varchar(11) NOT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`),
  KEY `idx_times` (`times`),
  KEY `idx_relation_id` (`relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='头条留言信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_fabulous','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fabulous','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD   `mid` int(10) unsigned NOT NULL COMMENT '点赞用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_fabulous','relation_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD   `relation_id` int(10) unsigned NOT NULL COMMENT '关联好评表||头条留言表的id'");}
if(!pdo_fieldexists('ims_wlmerchant_fabulous','class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD   `class` tinyint(1) unsigned NOT NULL COMMENT '点赞类别(1=好评点赞,2=头条留言点赞)'");}
if(!pdo_fieldexists('ims_wlmerchant_fabulous','times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD   `times` varchar(11) NOT NULL COMMENT '点赞时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fabulous','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_fabulous','idx_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fabulous')." ADD   KEY `idx_times` (`times`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fightgroup_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `logo` varchar(255) NOT NULL COMMENT '分类图片',
  `listorder` int(11) NOT NULL COMMENT '排序',
  `is_show` int(11) NOT NULL COMMENT '首页显示 0显示 1隐藏',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_listorder` (`listorder`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   `name` varchar(50) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   `logo` varchar(255) NOT NULL COMMENT '分类图片'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','listorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   `listorder` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   `is_show` int(11) NOT NULL COMMENT '首页显示 0显示 1隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_category','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_category')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fightgroup_falsemember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `nickname` varchar(125) NOT NULL,
  `avatar` varchar(445) NOT NULL,
  `createtime` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_fightgroup_falsemember','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_falsemember')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_falsemember','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_falsemember')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_falsemember','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_falsemember')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_falsemember','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_falsemember')." ADD   `nickname` varchar(125) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_falsemember','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_falsemember')." ADD   `avatar` varchar(445) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_falsemember','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_falsemember')." ADD   `createtime` varchar(125) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fightgroup_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态 0未上架 1上架 4已删除 5审核中 6未通过',
  `merchantid` int(11) NOT NULL COMMENT '商家id',
  `name` varchar(145) NOT NULL COMMENT '商品名称',
  `logo` varchar(145) NOT NULL COMMENT '商品logo图片',
  `detail` longtext NOT NULL COMMENT '商品详情',
  `price` decimal(10,2) NOT NULL COMMENT '团购价',
  `aloneprice` decimal(10,2) NOT NULL COMMENT '单买价',
  `oldprice` decimal(10,2) NOT NULL COMMENT '市场价',
  `peoplenum` int(11) NOT NULL COMMENT '组团人数',
  `grouptime` decimal(10,2) NOT NULL COMMENT '组团时间（单位小时）',
  `specstatus` int(11) NOT NULL COMMENT '规格类型 0无规格 1同价格规格 2不同价格规格',
  `specdetail` text NOT NULL COMMENT '规格详情',
  `categoryid` int(11) NOT NULL COMMENT '分类id',
  `tag` text NOT NULL COMMENT '商品标签',
  `stock` int(11) NOT NULL COMMENT '库存',
  `realsalenum` int(11) NOT NULL COMMENT '真实销量',
  `falsesalenum` int(11) NOT NULL COMMENT '虚拟销量',
  `listorder` int(11) NOT NULL COMMENT '商品排序',
  `buylimit` int(11) NOT NULL COMMENT '购买限制',
  `unit` varchar(32) NOT NULL COMMENT '单位',
  `adv` text NOT NULL COMMENT '商品幻灯片',
  `share_image` varchar(145) NOT NULL COMMENT '分享图片',
  `share_title` varchar(145) NOT NULL COMMENT '分享标题',
  `share_desc` text NOT NULL COMMENT '分享描述',
  `usestatus` int(11) NOT NULL COMMENT '消费方式 0到店消费 1快递 2都支持',
  `expressid` int(11) NOT NULL COMMENT '运费模板id',
  `vipdiscount` decimal(10,2) NOT NULL COMMENT 'VIP减免',
  `markid` int(11) NOT NULL COMMENT '营销表id',
  `islimittime` int(11) NOT NULL COMMENT '是否时间限时',
  `limitstarttime` varchar(45) NOT NULL COMMENT '开始时间',
  `limitendtime` varchar(45) NOT NULL COMMENT '结束时间',
  `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销',
  `isdistri` int(11) NOT NULL COMMENT '是否参与分销0参与 1不参与',
  `userlabel` text NOT NULL COMMENT '用户标签',
  `independent` int(11) NOT NULL COMMENT '独立结算开关 0开启 1关闭',
  `pv` int(10) NOT NULL COMMENT '浏览量',
  `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款',
  `cutoffstatus` int(11) NOT NULL COMMENT '截止时间类型',
  `cutofftime` int(11) NOT NULL COMMENT '截止时间',
  `cutoffday` int(11) NOT NULL COMMENT '截止天数',
  `overrefund` tinyint(1) NOT NULL COMMENT '过期退款',
  `dissettime` int(11) NOT NULL COMMENT '佣金结算时间',
  `diyposter` int(11) NOT NULL COMMENT '自定义海报',
  `code` varchar(145) NOT NULL COMMENT '商品编号',
  `describe` text NOT NULL COMMENT '购买须知',
  `appointment` int(11) NOT NULL COMMENT '预约时间',
  `op_one_limit` int(11) NOT NULL COMMENT '单人限购',
  `is_indexshow` int(11) NOT NULL COMMENT '首页显示',
  `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐',
  `integral` int(11) NOT NULL COMMENT '赠送积分\n',
  `creditmoney` decimal(10,2) NOT NULL COMMENT '积分能抵扣的金额',
  `falseorder` text NOT NULL COMMENT '虚拟订单',
  `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT '会员价结算金额',
  `viponedismoney` decimal(10,0) NOT NULL COMMENT '会员价一级分销佣金',
  `viptwodismoney` decimal(10,0) NOT NULL COMMENT '会员价二级分销商佣金',
  `vipstatus` int(11) NOT NULL COMMENT '特权状态 0无 1会员减免 2会员特供',
  `level` text NOT NULL COMMENT '适用等级',
  `communityid` int(11) NOT NULL COMMENT '社群id',
  `is_pool` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启凑团1关闭',
  `is_imitate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0关闭模拟成团1开启',
  `is_com_dis` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0关闭团长优惠1开启',
  `com_dis_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '团长优惠金额',
  `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片',
  `is_describe_tip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)',
  `extension_text` text NOT NULL COMMENT '推广文案',
  `extension_img` text NOT NULL COMMENT '推广图片路径',
  `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式',
  `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)',
  `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `paidid` int(11) NOT NULL COMMENT '支付有礼活动id',
  `usedatestatus` tinyint(1) NOT NULL COMMENT '定时购买 1按星期 2按天数',
  `week` varchar(355) NOT NULL COMMENT '按星期时间',
  `day` varchar(355) NOT NULL COMMENT '按天数时间',
  `daylimit` int(11) NOT NULL COMMENT '每日限量',
  `aloneprice_switch` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许单购(0=允许，1=不允许)',
  `viparray` text NOT NULL COMMENT '会员价减少数组',
  `disarray` text NOT NULL COMMENT '分销商佣金数组',
  `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id',
  `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量',
  `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额',
  `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启',
  `appointdays` int(11) NOT NULL COMMENT '可预约天数',
  `appointarray` text COMMENT '预约数组',
  `videourl` varchar(255) NOT NULL COMMENT '视频链接',
  `is_lucky` tinyint(1) DEFAULT NULL COMMENT '是否为幸运团',
  `luckynum` int(11) DEFAULT NULL COMMENT '幸运人数',
  `luckymoney` decimal(10,2) DEFAULT NULL COMMENT '退款红包',
  `yuecashback` decimal(10,2) DEFAULT NULL COMMENT '普通用户余额返现',
  `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '会员余额返现',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_listorder` (`listorder`),
  KEY `idx_pv` (`pv`),
  KEY `idx_merchantid` (`merchantid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `status` int(11) NOT NULL COMMENT '状态 0未上架 1上架 4已删除 5审核中 6未通过'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `merchantid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `name` varchar(145) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `logo` varchar(145) NOT NULL COMMENT '商品logo图片'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `detail` longtext NOT NULL COMMENT '商品详情'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `price` decimal(10,2) NOT NULL COMMENT '团购价'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','aloneprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `aloneprice` decimal(10,2) NOT NULL COMMENT '单买价'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `oldprice` decimal(10,2) NOT NULL COMMENT '市场价'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','peoplenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `peoplenum` int(11) NOT NULL COMMENT '组团人数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','grouptime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `grouptime` decimal(10,2) NOT NULL COMMENT '组团时间（单位小时）'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','specstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `specstatus` int(11) NOT NULL COMMENT '规格类型 0无规格 1同价格规格 2不同价格规格'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','specdetail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `specdetail` text NOT NULL COMMENT '规格详情'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','categoryid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `categoryid` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `tag` text NOT NULL COMMENT '商品标签'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','stock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `stock` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','realsalenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `realsalenum` int(11) NOT NULL COMMENT '真实销量'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','falsesalenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `falsesalenum` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','listorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `listorder` int(11) NOT NULL COMMENT '商品排序'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','buylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `buylimit` int(11) NOT NULL COMMENT '购买限制'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','unit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `unit` varchar(32) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `adv` text NOT NULL COMMENT '商品幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `share_image` varchar(145) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `share_title` varchar(145) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `share_desc` text NOT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','usestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `usestatus` int(11) NOT NULL COMMENT '消费方式 0到店消费 1快递 2都支持'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `expressid` int(11) NOT NULL COMMENT '运费模板id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','vipdiscount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `vipdiscount` decimal(10,2) NOT NULL COMMENT 'VIP减免'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','markid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `markid` int(11) NOT NULL COMMENT '营销表id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','islimittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `islimittime` int(11) NOT NULL COMMENT '是否时间限时'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','limitstarttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `limitstarttime` varchar(45) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','limitendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `limitendtime` varchar(45) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与分销0参与 1不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','userlabel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `userlabel` text NOT NULL COMMENT '用户标签'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','independent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `independent` int(11) NOT NULL COMMENT '独立结算开关 0开启 1关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `pv` int(10) NOT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','allowapplyre')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','cutoffstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `cutoffstatus` int(11) NOT NULL COMMENT '截止时间类型'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','cutofftime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `cutofftime` int(11) NOT NULL COMMENT '截止时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','cutoffday')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `cutoffday` int(11) NOT NULL COMMENT '截止天数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','overrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `overrefund` tinyint(1) NOT NULL COMMENT '过期退款'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `dissettime` int(11) NOT NULL COMMENT '佣金结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','diyposter')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `diyposter` int(11) NOT NULL COMMENT '自定义海报'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `code` varchar(145) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `describe` text NOT NULL COMMENT '购买须知'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','appointment')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `appointment` int(11) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','op_one_limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `op_one_limit` int(11) NOT NULL COMMENT '单人限购'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','is_indexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `is_indexshow` int(11) NOT NULL COMMENT '首页显示'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','bgmusic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `integral` int(11) NOT NULL COMMENT '赠送积分\n'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `creditmoney` decimal(10,2) NOT NULL COMMENT '积分能抵扣的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','falseorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `falseorder` text NOT NULL COMMENT '虚拟订单'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT '会员价结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','viponedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `viponedismoney` decimal(10,0) NOT NULL COMMENT '会员价一级分销佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','viptwodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `viptwodismoney` decimal(10,0) NOT NULL COMMENT '会员价二级分销商佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `vipstatus` int(11) NOT NULL COMMENT '特权状态 0无 1会员减免 2会员特供'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `level` text NOT NULL COMMENT '适用等级'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','communityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `communityid` int(11) NOT NULL COMMENT '社群id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','is_pool')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `is_pool` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启凑团1关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','is_imitate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `is_imitate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0关闭模拟成团1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','is_com_dis')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `is_com_dis` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0关闭团长优惠1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','com_dis_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `com_dis_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '团长优惠金额'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','share_wxapp_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','is_describe_tip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `is_describe_tip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','extension_text')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `extension_text` text NOT NULL COMMENT '推广文案'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','extension_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `extension_img` text NOT NULL COMMENT '推广图片路径'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','pay_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','cash_back')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','return_proportion')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','paidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `paidid` int(11) NOT NULL COMMENT '支付有礼活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `usedatestatus` tinyint(1) NOT NULL COMMENT '定时购买 1按星期 2按天数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `week` varchar(355) NOT NULL COMMENT '按星期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `day` varchar(355) NOT NULL COMMENT '按天数时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','daylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `daylimit` int(11) NOT NULL COMMENT '每日限量'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','aloneprice_switch')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `aloneprice_switch` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许单购(0=允许，1=不允许)'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `viparray` text NOT NULL COMMENT '会员价减少数组'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `disarray` text NOT NULL COMMENT '分销商佣金数组'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','diyformid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','alldaylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','isdistristatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','appointstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','appointdays')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `appointdays` int(11) NOT NULL COMMENT '可预约天数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','appointarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `appointarray` text COMMENT '预约数组'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','videourl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `videourl` varchar(255) NOT NULL COMMENT '视频链接'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','is_lucky')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `is_lucky` tinyint(1) DEFAULT NULL COMMENT '是否为幸运团'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','luckynum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `luckynum` int(11) DEFAULT NULL COMMENT '幸运人数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','luckymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `luckymoney` decimal(10,2) DEFAULT NULL COMMENT '退款红包'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','yuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `yuecashback` decimal(10,2) DEFAULT NULL COMMENT '普通用户余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','vipyuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '会员余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','idx_listorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   KEY `idx_listorder` (`listorder`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_goods','idx_pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_goods')." ADD   KEY `idx_pv` (`pv`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fightgroup_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '团状态 1组团中 2组团成功 3组团失败',
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `sid` int(11) NOT NULL COMMENT '商家id',
  `neednum` int(11) NOT NULL COMMENT '需要人数',
  `lacknum` int(11) NOT NULL COMMENT '缺少人数',
  `starttime` varchar(145) NOT NULL COMMENT '开团时间',
  `failtime` varchar(145) NOT NULL COMMENT '时间',
  `successtime` varchar(145) NOT NULL COMMENT '组团成功时间',
  `is_lucky` tinyint(1) DEFAULT NULL COMMENT '是否幸运团',
  `luckyorderids` text COMMENT '幸运订单号数组',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_strattime` (`starttime`),
  KEY `idx_goodsid` (`goodsid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `status` int(11) NOT NULL COMMENT '团状态 1组团中 2组团成功 3组团失败'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','neednum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `neednum` int(11) NOT NULL COMMENT '需要人数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','lacknum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `lacknum` int(11) NOT NULL COMMENT '缺少人数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `starttime` varchar(145) NOT NULL COMMENT '开团时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','failtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `failtime` varchar(145) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','successtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `successtime` varchar(145) NOT NULL COMMENT '组团成功时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','is_lucky')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `is_lucky` tinyint(1) DEFAULT NULL COMMENT '是否幸运团'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','luckyorderids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   `luckyorderids` text COMMENT '幸运订单号数组'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_group','idx_strattime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_group')." ADD   KEY `idx_strattime` (`starttime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fightgroup_userecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `qrcode` varchar(145) NOT NULL COMMENT '核销码',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `usetimes` int(11) NOT NULL COMMENT '使用次数',
  `usedtime` text NOT NULL COMMENT '核销详情 type 1扫码核销 2后台核销 3商家核销工具核销 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD   `orderid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD   `qrcode` varchar(145) NOT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD   `createtime` varchar(145) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD   `usetimes` int(11) NOT NULL COMMENT '使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_fightgroup_userecord','usedtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fightgroup_userecord')." ADD   `usedtime` text NOT NULL COMMENT '核销详情 type 1扫码核销 2后台核销 3商家核销工具核销 '");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_formid` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `mid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `form_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '模板id',
  `expiry_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '公众号id',
  `is_used` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已使用',
  `used_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
  `type` tinyint(1) unsigned DEFAULT '1' COMMENT 'id类型：1=小程序模板消息id，2=小程序订阅消息id，3=公众号订阅消息id',
  `temp_type` varchar(20) DEFAULT NULL COMMENT '订单支付成功 = pay；订单发货提醒 = send；售后状态通知 = after_sale；退款成功通知 = refund；订单待付款提醒 = remind；业务处理结果通知 = service\n#核销成功提醒 = write_off；拼团结果通知 = fight；商品下架提醒 = shop；签到成功通知 = sign',
  PRIMARY KEY (`id`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_formid','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `mid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','form_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `form_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '模板id'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','expiry_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `expiry_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `uniacid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','is_used')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `is_used` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已使用'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','used_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `used_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `type` tinyint(1) unsigned DEFAULT '1' COMMENT 'id类型：1=小程序模板消息id，2=小程序订阅消息id，3=公众号订阅消息id'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','temp_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   `temp_type` varchar(20) DEFAULT NULL COMMENT '订单支付成功 = pay；订单发货提醒 = send；售后状态通知 = after_sale；退款成功通知 = refund；订单待付款提醒 = remind；业务处理结果通知 = service\n#核销成功提醒 = write_off；拼团结果通知 = fight；商品下架提醒 = shop；签到成功通知 = sign'");}
if(!pdo_fieldexists('ims_wlmerchant_formid','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_formid')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_fullreduce_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `title` varchar(255) NOT NULL COMMENT '红包标题',
  `status` int(11) NOT NULL COMMENT '状态 0启用 1禁用',
  `sort` int(11) NOT NULL COMMENT '排序',
  `rules` text NOT NULL COMMENT '满减规则',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `title` varchar(255) NOT NULL COMMENT '红包标题'");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `status` int(11) NOT NULL COMMENT '状态 0启用 1禁用'");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','rules')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `rules` text NOT NULL COMMENT '满减规则'");}
if(!pdo_fieldexists('ims_wlmerchant_fullreduce_list','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_fullreduce_list')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_goods_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1抢购 2拼团 3团购',
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `title` varchar(50) NOT NULL COMMENT '规格名称',
  `thumb` varchar(225) NOT NULL COMMENT '规格图',
  `specs` text NOT NULL COMMENT '组合的单项规格id',
  `stock` int(11) NOT NULL COMMENT '库存',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `vipprice` decimal(10,2) NOT NULL COMMENT 'VIP特价',
  `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算金额',
  `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT 'vip结算金额',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销金额',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销金额',
  `threedismoney` decimal(10,2) NOT NULL COMMENT '三级分销金额',
  `viparray` text NOT NULL COMMENT '折扣数组',
  `disarray` text NOT NULL COMMENT '分销数组',
  `uuid` int(11) DEFAULT NULL COMMENT '票付通id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_goods_option','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `type` int(11) NOT NULL COMMENT '1抢购 2拼团 3团购'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `title` varchar(50) NOT NULL COMMENT '规格名称'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `thumb` varchar(225) NOT NULL COMMENT '规格图'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','specs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `specs` text NOT NULL COMMENT '组合的单项规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','stock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `stock` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `price` decimal(10,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `vipprice` decimal(10,2) NOT NULL COMMENT 'VIP特价'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL COMMENT 'vip结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `threedismoney` decimal(10,2) NOT NULL COMMENT '三级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `viparray` text NOT NULL COMMENT '折扣数组'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `disarray` text NOT NULL COMMENT '分销数组'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','uuid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   `uuid` int(11) DEFAULT NULL COMMENT '票付通id'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_goods_option','idx_goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_option')." ADD   KEY `idx_goodsid` (`goodsid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_goods_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `title` varchar(50) NOT NULL COMMENT '规格项',
  `description` tinyint(1) NOT NULL COMMENT '弃用字段',
  `displaytype` tinyint(3) NOT NULL COMMENT '是否显示',
  `content` text NOT NULL COMMENT '规格内容压缩字符串',
  `displayorder` int(11) NOT NULL COMMENT '排序',
  `type` int(11) NOT NULL COMMENT '1 抢购商品',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_goodsid` (`goodsid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_goods_spec','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','goodsid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `goodsid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `title` varchar(50) NOT NULL COMMENT '规格项'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `description` tinyint(1) NOT NULL COMMENT '弃用字段'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','displaytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `displaytype` tinyint(3) NOT NULL COMMENT '是否显示'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `content` text NOT NULL COMMENT '规格内容压缩字符串'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `displayorder` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   `type` int(11) NOT NULL COMMENT '1 抢购商品'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec','idx_displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec')." ADD   KEY `idx_displayorder` (`displayorder`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_goods_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `specid` int(11) NOT NULL COMMENT '父规格id',
  `title` varchar(225) NOT NULL COMMENT '规格名',
  `thumb` varchar(225) NOT NULL COMMENT '规格图',
  `show` int(11) NOT NULL COMMENT '是否显示',
  `displayorder` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_specid` (`specid`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','specid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   `specid` int(11) NOT NULL COMMENT '父规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   `title` varchar(225) NOT NULL COMMENT '规格名'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   `thumb` varchar(225) NOT NULL COMMENT '规格图'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   `show` int(11) NOT NULL COMMENT '是否显示'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   `displayorder` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_goods_spec_item','idx_specid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goods_spec_item')." ADD   KEY `idx_specid` (`specid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_goodshouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商家id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `name` varchar(145) NOT NULL COMMENT '活动名称',
  `code` varchar(145) NOT NULL COMMENT '商品编号',
  `describe` varchar(255) NOT NULL COMMENT '描述',
  `detail` text COMMENT '详情',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '抢购价',
  `oldprice` decimal(10,2) DEFAULT '0.00' COMMENT '原价',
  `vipprice` decimal(10,2) DEFAULT '0.00' COMMENT 'vip价格',
  `num` int(11) NOT NULL COMMENT '限量',
  `levelnum` int(11) NOT NULL COMMENT '剩余数量',
  `endtime` varchar(225) NOT NULL COMMENT '活动结束时间',
  `follow` int(11) NOT NULL COMMENT '关注人数',
  `tag` text COMMENT '标签',
  `share_title` varchar(32) NOT NULL,
  `share_image` varchar(250) DEFAULT NULL,
  `share_desc` varchar(32) NOT NULL,
  `unit` varchar(32) NOT NULL COMMENT '单位',
  `thumb` varchar(145) NOT NULL COMMENT '首页图片',
  `thumbs` text COMMENT '图集',
  `salenum` int(11) NOT NULL COMMENT '销量',
  `displayorder` int(11) NOT NULL COMMENT '排序',
  `stock` int(11) NOT NULL COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_goodshouse','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `name` varchar(145) NOT NULL COMMENT '活动名称'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `code` varchar(145) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `describe` varchar(255) NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `detail` text COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `price` decimal(10,2) DEFAULT '0.00' COMMENT '抢购价'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `oldprice` decimal(10,2) DEFAULT '0.00' COMMENT '原价'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `vipprice` decimal(10,2) DEFAULT '0.00' COMMENT 'vip价格'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `num` int(11) NOT NULL COMMENT '限量'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','levelnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `levelnum` int(11) NOT NULL COMMENT '剩余数量'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `endtime` varchar(225) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','follow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `follow` int(11) NOT NULL COMMENT '关注人数'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `tag` text COMMENT '标签'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `share_title` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `share_image` varchar(250) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `share_desc` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','unit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `unit` varchar(32) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `thumb` varchar(145) NOT NULL COMMENT '首页图片'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `thumbs` text COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','salenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `salenum` int(11) NOT NULL COMMENT '销量'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `displayorder` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_goodshouse','stock')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_goodshouse')." ADD   `stock` int(11) NOT NULL COMMENT '库存'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_groupon_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `sid` int(11) NOT NULL COMMENT '商家id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `name` varchar(145) NOT NULL COMMENT '活动名称【可和仓库的商品名称一致】',
  `code` varchar(145) NOT NULL COMMENT '商品编号',
  `detail` longtext NOT NULL COMMENT '详情',
  `price` decimal(10,2) NOT NULL COMMENT '抢购价',
  `oldprice` decimal(10,2) NOT NULL COMMENT '原价',
  `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip价格',
  `num` int(11) NOT NULL COMMENT '库存',
  `levelnum` int(11) NOT NULL COMMENT '剩余数量',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1进行中2已结束',
  `starttime` varchar(225) NOT NULL COMMENT '活动开始时间',
  `endtime` varchar(225) NOT NULL COMMENT '活动结束时间',
  `follow` int(11) NOT NULL COMMENT '关注人数',
  `tag` text NOT NULL COMMENT '标签',
  `orderinfo` varchar(255) NOT NULL COMMENT '订单信息',
  `share_title` varchar(32) NOT NULL COMMENT '分享标题',
  `share_image` varchar(250) NOT NULL COMMENT '分享图片',
  `share_desc` varchar(250) NOT NULL COMMENT '分享描述',
  `unit` varchar(32) NOT NULL COMMENT '单位',
  `thumb` varchar(145) NOT NULL COMMENT '首页图片',
  `thumbs` text NOT NULL COMMENT '图集',
  `describe` text NOT NULL COMMENT '购买须知',
  `op_one_limit` int(11) NOT NULL COMMENT '单人限购',
  `cutofftime` int(11) NOT NULL COMMENT '截止时间',
  `is_indexshow` int(11) NOT NULL DEFAULT '1' COMMENT '首页是否显示',
  `allsalenum` int(11) NOT NULL COMMENT '虚拟销量',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `cutoffstatus` int(11) NOT NULL COMMENT '截止时间类型',
  `cutoffday` int(11) NOT NULL COMMENT '购买后有效天数',
  `retainage` decimal(10,2) NOT NULL COMMENT '尾款',
  `appointment` int(11) NOT NULL COMMENT '预约小时',
  `integral` int(11) NOT NULL COMMENT '获得积分',
  `pv` int(11) NOT NULL COMMENT '人气',
  `vipstatus` int(11) NOT NULL COMMENT '0无 1会员特价 2会员特供',
  `cateid` int(11) NOT NULL COMMENT '抢购分类ID',
  `specialid` int(11) NOT NULL COMMENT '主题ID',
  `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销',
  `isdistri` int(11) NOT NULL COMMENT '是否参与核销 0参与 1不参与',
  `falseorder` text NOT NULL COMMENT '虚拟订单',
  `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐',
  `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip结算金额',
  `viponedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip一级分销',
  `viptwodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip二级分销',
  `vipthreedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip三级分销',
  `optionstatus` int(11) NOT NULL COMMENT '多规格标记',
  `userlabel` text NOT NULL COMMENT '用户标签',
  `listtag` text NOT NULL COMMENT '列表标签',
  `subtitle` varchar(255) NOT NULL COMMENT '副标题',
  `recommend` int(11) NOT NULL COMMENT '推荐标记',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `sharemoney` decimal(10,2) NOT NULL COMMENT '分享金额',
  `sharestatus` int(11) NOT NULL COMMENT '分享有礼状态',
  `independent` int(11) NOT NULL COMMENT '独立结算开关 0开启 1关闭',
  `falsesalenum` int(11) NOT NULL COMMENT '虚拟销量',
  `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许',
  `usestatus` int(11) NOT NULL COMMENT '使用方式 0到店核销 1快递 2同时支持',
  `expressid` int(11) NOT NULL COMMENT '运费模板',
  `fastpay` int(11) NOT NULL COMMENT '快速致富 0开启 1关闭',
  `overrefund` tinyint(1) NOT NULL COMMENT '过期退款',
  `level` text NOT NULL COMMENT '适用等级',
  `dissettime` int(11) NOT NULL COMMENT '分佣时间',
  `diyposter` int(11) NOT NULL COMMENT '自定义海报ID',
  `creditmoney` decimal(10,0) NOT NULL COMMENT '积分抵扣金额',
  `communityid` int(11) NOT NULL COMMENT '社群id\n',
  `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片',
  `is_describe_tip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)',
  `extension_text` text NOT NULL COMMENT '推广文案',
  `extension_img` text NOT NULL COMMENT '推广图片路径',
  `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式',
  `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)',
  `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `paidid` int(11) NOT NULL COMMENT '支付有礼活动id',
  `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数',
  `week` varchar(355) NOT NULL COMMENT '按星期时间',
  `day` varchar(355) NOT NULL COMMENT '按天数时间',
  `daylimit` int(11) NOT NULL COMMENT '每日限量',
  `viparray` text NOT NULL COMMENT '会员减免数组',
  `disarray` text COMMENT '分销商佣金数组',
  `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id',
  `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量',
  `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额',
  `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启',
  `appointdays` int(11) NOT NULL COMMENT '可预约天数',
  `appointarray` text NOT NULL COMMENT '预约数组',
  `videourl` varchar(255) NOT NULL COMMENT '视频链接',
  `yuecashback` decimal(10,2) NOT NULL COMMENT '普通用户余额返现',
  `vipyuecashback` decimal(10,2) NOT NULL COMMENT '会员余额返现',
  `checkcodeflag` int(11) DEFAULT NULL COMMENT '核销码类型 0系统核销码 1导入核销码',
  `pftid` int(11) DEFAULT NULL COMMENT '票付通id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`),
  KEY `idx_sid` (`sid`),
  KEY `idx_indexshow` (`is_indexshow`),
  KEY `idx_sort` (`sort`),
  KEY `idx_pv` (`pv`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `name` varchar(145) NOT NULL COMMENT '活动名称【可和仓库的商品名称一致】'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `code` varchar(145) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `detail` longtext NOT NULL COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `price` decimal(10,2) NOT NULL COMMENT '抢购价'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `oldprice` decimal(10,2) NOT NULL COMMENT '原价'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip价格'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `num` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','levelnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `levelnum` int(11) NOT NULL COMMENT '剩余数量'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `status` int(11) NOT NULL DEFAULT '1' COMMENT '1进行中2已结束'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `starttime` varchar(225) NOT NULL COMMENT '活动开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `endtime` varchar(225) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','follow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `follow` int(11) NOT NULL COMMENT '关注人数'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `tag` text NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','orderinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `orderinfo` varchar(255) NOT NULL COMMENT '订单信息'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `share_title` varchar(32) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `share_image` varchar(250) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `share_desc` varchar(250) NOT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','unit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `unit` varchar(32) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `thumb` varchar(145) NOT NULL COMMENT '首页图片'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `thumbs` text NOT NULL COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `describe` text NOT NULL COMMENT '购买须知'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','op_one_limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `op_one_limit` int(11) NOT NULL COMMENT '单人限购'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','cutofftime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `cutofftime` int(11) NOT NULL COMMENT '截止时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','is_indexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `is_indexshow` int(11) NOT NULL DEFAULT '1' COMMENT '首页是否显示'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','allsalenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `allsalenum` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','cutoffstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `cutoffstatus` int(11) NOT NULL COMMENT '截止时间类型'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','cutoffday')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `cutoffday` int(11) NOT NULL COMMENT '购买后有效天数'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','retainage')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `retainage` decimal(10,2) NOT NULL COMMENT '尾款'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','appointment')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `appointment` int(11) NOT NULL COMMENT '预约小时'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `integral` int(11) NOT NULL COMMENT '获得积分'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `pv` int(11) NOT NULL COMMENT '人气'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `vipstatus` int(11) NOT NULL COMMENT '0无 1会员特价 2会员特供'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `cateid` int(11) NOT NULL COMMENT '抢购分类ID'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','specialid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `specialid` int(11) NOT NULL COMMENT '主题ID'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与核销 0参与 1不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','falseorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `falseorder` text NOT NULL COMMENT '虚拟订单'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','bgmusic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','viponedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `viponedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip一级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','viptwodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `viptwodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip二级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','vipthreedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `vipthreedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip三级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','optionstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `optionstatus` int(11) NOT NULL COMMENT '多规格标记'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','userlabel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `userlabel` text NOT NULL COMMENT '用户标签'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','listtag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `listtag` text NOT NULL COMMENT '列表标签'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','subtitle')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `subtitle` varchar(255) NOT NULL COMMENT '副标题'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','recommend')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `recommend` int(11) NOT NULL COMMENT '推荐标记'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','sharemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `sharemoney` decimal(10,2) NOT NULL COMMENT '分享金额'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','sharestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `sharestatus` int(11) NOT NULL COMMENT '分享有礼状态'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','independent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `independent` int(11) NOT NULL COMMENT '独立结算开关 0开启 1关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','falsesalenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `falsesalenum` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','allowapplyre')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','usestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `usestatus` int(11) NOT NULL COMMENT '使用方式 0到店核销 1快递 2同时支持'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `expressid` int(11) NOT NULL COMMENT '运费模板'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','fastpay')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `fastpay` int(11) NOT NULL COMMENT '快速致富 0开启 1关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','overrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `overrefund` tinyint(1) NOT NULL COMMENT '过期退款'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `level` text NOT NULL COMMENT '适用等级'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `dissettime` int(11) NOT NULL COMMENT '分佣时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','diyposter')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `diyposter` int(11) NOT NULL COMMENT '自定义海报ID'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `creditmoney` decimal(10,0) NOT NULL COMMENT '积分抵扣金额'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','communityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `communityid` int(11) NOT NULL COMMENT '社群id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','share_wxapp_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','is_describe_tip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `is_describe_tip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','extension_text')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `extension_text` text NOT NULL COMMENT '推广文案'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','extension_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `extension_img` text NOT NULL COMMENT '推广图片路径'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','pay_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','cash_back')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','return_proportion')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','paidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `paidid` int(11) NOT NULL COMMENT '支付有礼活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `week` varchar(355) NOT NULL COMMENT '按星期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `day` varchar(355) NOT NULL COMMENT '按天数时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','daylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `daylimit` int(11) NOT NULL COMMENT '每日限量'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `viparray` text NOT NULL COMMENT '会员减免数组'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `disarray` text COMMENT '分销商佣金数组'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','diyformid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','alldaylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','isdistristatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','appointstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','appointdays')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `appointdays` int(11) NOT NULL COMMENT '可预约天数'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','appointarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `appointarray` text NOT NULL COMMENT '预约数组'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','videourl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `videourl` varchar(255) NOT NULL COMMENT '视频链接'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','yuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `yuecashback` decimal(10,2) NOT NULL COMMENT '普通用户余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','vipyuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `vipyuecashback` decimal(10,2) NOT NULL COMMENT '会员余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','checkcodeflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `checkcodeflag` int(11) DEFAULT NULL COMMENT '核销码类型 0系统核销码 1导入核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','pftid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   `pftid` int(11) DEFAULT NULL COMMENT '票付通id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','idx_uniacid_aid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   KEY `idx_uniacid_aid_status` (`uniacid`,`aid`,`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','idx_indexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   KEY `idx_indexshow` (`is_indexshow`)");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_activity','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_activity')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_groupon_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL COMMENT '分类名',
  `aid` int(11) NOT NULL DEFAULT '0',
  `thumb` varchar(225) NOT NULL COMMENT '分类图片',
  `sort` int(11) NOT NULL COMMENT '排序',
  `parentid` int(10) NOT NULL COMMENT '父分类id',
  `is_show` tinyint(1) DEFAULT '0' COMMENT '首页显示 0显示 1隐藏',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=371 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_groupon_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `name` varchar(255) NOT NULL COMMENT '分类名'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `thumb` varchar(225) NOT NULL COMMENT '分类图片'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','parentid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `parentid` int(10) NOT NULL COMMENT '父分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   `is_show` tinyint(1) DEFAULT '0' COMMENT '首页显示 0显示 1隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_category','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_category')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_groupon_userecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `qrcode` varchar(145) DEFAULT NULL COMMENT '核销码',
  `createtime` varchar(145) DEFAULT NULL COMMENT '创建时间',
  `usetimes` int(11) DEFAULT NULL COMMENT '使用次数',
  `usedtime` text COMMENT '核销详情 type 1扫码核销 2后台核销 3商家核销工具核销 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `orderid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `qrcode` varchar(145) DEFAULT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `createtime` varchar(145) DEFAULT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `usetimes` int(11) DEFAULT NULL COMMENT '使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_groupon_userecord','usedtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_groupon_userecord')." ADD   `usedtime` text COMMENT '核销详情 type 1扫码核销 2后台核销 3商家核销工具核销 '");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_gvccode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `code` int(11) NOT NULL COMMENT '图形码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_gvccode','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_gvccode')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_gvccode','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_gvccode')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_gvccode','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_gvccode')." ADD   `code` int(11) NOT NULL COMMENT '图形码'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcard_qrscan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `cardid` int(11) NOT NULL COMMENT '一卡通或商品id',
  `openid` varchar(50) NOT NULL COMMENT '扫码人openid',
  `scantime` int(11) NOT NULL COMMENT '扫码时间',
  `type` varchar(32) NOT NULL COMMENT '二维码类型',
  `url` varchar(255) NOT NULL COMMENT '链接',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_openid_scantime` (`uniacid`,`openid`,`scantime`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','cardid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   `cardid` int(11) NOT NULL COMMENT '一卡通或商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   `openid` varchar(50) NOT NULL COMMENT '扫码人openid'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','scantime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   `scantime` int(11) NOT NULL COMMENT '扫码时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   `type` varchar(32) NOT NULL COMMENT '二维码类型'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   `url` varchar(255) NOT NULL COMMENT '链接'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_qrscan','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_qrscan')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcard_realcard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `cardid` int(11) NOT NULL COMMENT '购卡ID',
  `days` int(11) NOT NULL COMMENT '包含时长',
  `cardsn` varchar(64) NOT NULL COMMENT '实卡编号',
  `salt` varchar(32) NOT NULL COMMENT '加密盐',
  `status` tinyint(1) unsigned NOT NULL COMMENT '绑定状态 1未绑定 2已绑定',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `bindtime` int(10) NOT NULL COMMENT '绑定时间',
  `remark` varchar(50) NOT NULL COMMENT '场景备注',
  `url` varchar(255) NOT NULL COMMENT '短链',
  `levelid` int(11) NOT NULL COMMENT '匹配等级',
  `icestatus` int(11) NOT NULL COMMENT '冻结状态 1已冻结',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`) USING BTREE,
  KEY `idx_mid` (`cardid`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=5021 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `uniacid` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','cardid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `cardid` int(11) NOT NULL COMMENT '购卡ID'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','days')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `days` int(11) NOT NULL COMMENT '包含时长'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','cardsn')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `cardsn` varchar(64) NOT NULL COMMENT '实卡编号'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','salt')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `salt` varchar(32) NOT NULL COMMENT '加密盐'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `status` tinyint(1) unsigned NOT NULL COMMENT '绑定状态 1未绑定 2已绑定'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `createtime` int(10) unsigned NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','bindtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `bindtime` int(10) NOT NULL COMMENT '绑定时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `remark` varchar(50) NOT NULL COMMENT '场景备注'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `url` varchar(255) NOT NULL COMMENT '短链'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','levelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `levelid` int(11) NOT NULL COMMENT '匹配等级'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','icestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   `icestatus` int(11) NOT NULL COMMENT '冻结状态 1已冻结'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   KEY `idx_uniacid` (`uniacid`) USING BTREE");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   KEY `idx_mid` (`cardid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_realcard','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_realcard')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcard_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '开卡人mid',
  `aid` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL COMMENT '充值金额',
  `howlong` varchar(145) NOT NULL COMMENT '充值五折卡月数',
  `paytime` varchar(145) NOT NULL COMMENT '充值时间',
  `orderno` varchar(145) NOT NULL COMMENT '充值单号',
  `limittime` varchar(145) NOT NULL COMMENT '下次到期时期',
  `status` int(11) NOT NULL COMMENT '0未支付 1已经支付',
  `paytype` int(11) NOT NULL COMMENT '支付方式 1余额 2微信 3支付宝 5小程序',
  `transid` varchar(145) NOT NULL COMMENT '三方订单号',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `issettlement` int(11) NOT NULL DEFAULT '0' COMMENT '是否结算 0未结算 1已结算',
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '开卡类型id',
  `is_vip` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开通vip(已弃用)',
  `disorderid` int(11) NOT NULL DEFAULT '0' COMMENT '分销订单id',
  `todistributor` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开通分销商',
  `cardid` int(11) NOT NULL DEFAULT '0' COMMENT '充值卡号',
  `username` varchar(32) NOT NULL COMMENT '持卡人姓名',
  `paidprid` int(11) NOT NULL COMMENT '支付有礼id',
  `mobile` varchar(20) NOT NULL COMMENT '开卡电话',
  `mototype` varchar(32) NOT NULL COMMENT '车型',
  `platenumber` varchar(32) NOT NULL COMMENT '车牌号',
  `paysetid` int(11) NOT NULL COMMENT '支付商户设置id',
  `allocationtype` int(11) NOT NULL COMMENT '分账方式 0平台系统 1服务商分账',
  `moinfo` text COMMENT '自定义表单内容',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `mid` int(11) NOT NULL COMMENT '开卡人mid'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `price` decimal(10,2) NOT NULL COMMENT '充值金额'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','howlong')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `howlong` varchar(145) NOT NULL COMMENT '充值五折卡月数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','paytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `paytime` varchar(145) NOT NULL COMMENT '充值时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `orderno` varchar(145) NOT NULL COMMENT '充值单号'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','limittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `limittime` varchar(145) NOT NULL COMMENT '下次到期时期'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `status` int(11) NOT NULL COMMENT '0未支付 1已经支付'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `paytype` int(11) NOT NULL COMMENT '支付方式 1余额 2微信 3支付宝 5小程序'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `transid` varchar(145) NOT NULL COMMENT '三方订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `createtime` varchar(145) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','issettlement')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `issettlement` int(11) NOT NULL DEFAULT '0' COMMENT '是否结算 0未结算 1已结算'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','typeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '开卡类型id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','is_vip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `is_vip` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开通vip(已弃用)'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','disorderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `disorderid` int(11) NOT NULL DEFAULT '0' COMMENT '分销订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','todistributor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `todistributor` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开通分销商'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','cardid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `cardid` int(11) NOT NULL DEFAULT '0' COMMENT '充值卡号'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `username` varchar(32) NOT NULL COMMENT '持卡人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','paidprid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `paidprid` int(11) NOT NULL COMMENT '支付有礼id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `mobile` varchar(20) NOT NULL COMMENT '开卡电话'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','mototype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `mototype` varchar(32) NOT NULL COMMENT '车型'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','platenumber')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `platenumber` varchar(32) NOT NULL COMMENT '车牌号'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','paysetid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `paysetid` int(11) NOT NULL COMMENT '支付商户设置id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','allocationtype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `allocationtype` int(11) NOT NULL COMMENT '分账方式 0平台系统 1服务商分账'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','moinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   `moinfo` text COMMENT '自定义表单内容'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_record','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_record')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcard_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `logo` varchar(145) NOT NULL COMMENT '类型logo图',
  `name` varchar(145) NOT NULL COMMENT '类型名称',
  `days` int(11) NOT NULL DEFAULT '0' COMMENT '开卡天数',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '类型金额',
  `status` int(11) NOT NULL COMMENT '状态',
  `num` int(11) NOT NULL COMMENT '可开通次数',
  `aid` int(11) NOT NULL DEFAULT '0',
  `is_vip` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开通VIP（已弃用）',
  `todistributor` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开启分销商',
  `is_hot` int(11) NOT NULL DEFAULT '0' COMMENT '是否热门',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销商佣金',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销商佣金',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销商佣金',
  `isdistri` int(11) NOT NULL COMMENT '是否参加分销 0参加 1不参与',
  `sort` int(11) NOT NULL COMMENT '排序',
  `levelid` int(11) NOT NULL COMMENT '等级id',
  `give_price` decimal(10,0) NOT NULL COMMENT '开通一卡通时赠送的金额',
  `detail` text NOT NULL COMMENT '一卡通的详细信息',
  `qrshow` tinyint(1) NOT NULL COMMENT '仅限扫码进入显示',
  `renew` tinyint(1) NOT NULL COMMENT '是否用于续费 0可以 1不可以',
  `old_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '类型原价',
  `paidid` int(11) NOT NULL COMMENT '支付有礼id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_sort` (`sort`),
  KEY `idx_renew` (`renew`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `logo` varchar(145) NOT NULL COMMENT '类型logo图'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `name` varchar(145) NOT NULL COMMENT '类型名称'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','days')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `days` int(11) NOT NULL DEFAULT '0' COMMENT '开卡天数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '类型金额'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `status` int(11) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `num` int(11) NOT NULL COMMENT '可开通次数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','is_vip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `is_vip` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开通VIP（已弃用）'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','todistributor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `todistributor` int(11) NOT NULL DEFAULT '0' COMMENT '是否同步开启分销商'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','is_hot')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `is_hot` int(11) NOT NULL DEFAULT '0' COMMENT '是否热门'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销商佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销商佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销商佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参加分销 0参加 1不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','levelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `levelid` int(11) NOT NULL COMMENT '等级id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','give_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `give_price` decimal(10,0) NOT NULL COMMENT '开通一卡通时赠送的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `detail` text NOT NULL COMMENT '一卡通的详细信息'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','qrshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `qrshow` tinyint(1) NOT NULL COMMENT '仅限扫码进入显示'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','renew')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `renew` tinyint(1) NOT NULL COMMENT '是否用于续费 0可以 1不可以'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','old_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `old_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '类型原价'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','paidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   `paidid` int(11) NOT NULL COMMENT '支付有礼id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcard_type','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcard_type')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcardlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态 1启用 0禁用 2审核中 3被驳回',
  `merchantid` int(11) NOT NULL COMMENT '商户id',
  `title` varchar(145) NOT NULL COMMENT '商品标题',
  `datestatus` int(11) NOT NULL COMMENT '时间格式 1 星期 2日期 3关闭',
  `week` text NOT NULL COMMENT '五折时间 星期',
  `day` text NOT NULL COMMENT '五折时间 天数',
  `adv` text NOT NULL COMMENT '幻灯片',
  `limit` text NOT NULL COMMENT '限制说明',
  `detail` text NOT NULL COMMENT '商品详细说明',
  `describe` text NOT NULL COMMENT '半价卡使用说明',
  `createtime` varchar(100) NOT NULL COMMENT '创建时间',
  `pv` int(11) NOT NULL COMMENT '浏览次数',
  `discount` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '平时折扣',
  `daily` int(11) NOT NULL DEFAULT '0' COMMENT '平时折扣开关',
  `timeslimit` int(11) NOT NULL COMMENT '五折卡使用次数',
  `usetimes` int(11) NOT NULL COMMENT '次数卡使用次数',
  `activediscount` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '活动折扣',
  `sort` int(11) NOT NULL COMMENT '排序',
  `level` text NOT NULL COMMENT '限制等级',
  `type` int(11) NOT NULL COMMENT '1外链特权',
  `extlink` varchar(500) NOT NULL COMMENT '外链地址',
  `extinfo` text NOT NULL COMMENT '外链信息',
  `starttime` varchar(100) NOT NULL COMMENT '开始时间',
  `endtime` varchar(100) NOT NULL COMMENT '结束时间',
  `timingstatus` int(11) NOT NULL COMMENT '定时参数',
  `levelstatus` tinyint(1) NOT NULL COMMENT '折扣类型',
  `activearray` text NOT NULL COMMENT '折扣数组',
  `dayactarray` text NOT NULL COMMENT '平日折扣数组',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_status` (`status`),
  KEY `idx_daily` (`daily`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `status` int(11) NOT NULL COMMENT '状态 1启用 0禁用 2审核中 3被驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `merchantid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `title` varchar(145) NOT NULL COMMENT '商品标题'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','datestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `datestatus` int(11) NOT NULL COMMENT '时间格式 1 星期 2日期 3关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `week` text NOT NULL COMMENT '五折时间 星期'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `day` text NOT NULL COMMENT '五折时间 天数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `adv` text NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `limit` text NOT NULL COMMENT '限制说明'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `detail` text NOT NULL COMMENT '商品详细说明'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `describe` text NOT NULL COMMENT '半价卡使用说明'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `createtime` varchar(100) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `pv` int(11) NOT NULL COMMENT '浏览次数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','discount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `discount` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '平时折扣'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','daily')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `daily` int(11) NOT NULL DEFAULT '0' COMMENT '平时折扣开关'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','timeslimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `timeslimit` int(11) NOT NULL COMMENT '五折卡使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `usetimes` int(11) NOT NULL COMMENT '次数卡使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','activediscount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `activediscount` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '活动折扣'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `level` text NOT NULL COMMENT '限制等级'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `type` int(11) NOT NULL COMMENT '1外链特权'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','extlink')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `extlink` varchar(500) NOT NULL COMMENT '外链地址'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','extinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `extinfo` text NOT NULL COMMENT '外链信息'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `starttime` varchar(100) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `endtime` varchar(100) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','timingstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `timingstatus` int(11) NOT NULL COMMENT '定时参数'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','levelstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `levelstatus` tinyint(1) NOT NULL COMMENT '折扣类型'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','activearray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `activearray` text NOT NULL COMMENT '折扣数组'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','dayactarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   `dayactarray` text NOT NULL COMMENT '平日折扣数组'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   KEY `idx_sort` (`sort`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardlist','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardlist')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcardmember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL COMMENT '代理id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `expiretime` int(11) NOT NULL COMMENT '五折卡结束时间',
  `createtime` int(11) NOT NULL COMMENT '记录创建时间',
  `disable` int(11) NOT NULL DEFAULT '0' COMMENT '禁用标记 1已禁用 0正常',
  `username` varchar(32) NOT NULL COMMENT '持卡人姓名',
  `levelid` int(11) NOT NULL COMMENT '会员等级',
  `mototype` varchar(32) NOT NULL COMMENT '车型',
  `platenumber` varchar(32) NOT NULL COMMENT '车牌号',
  `from` tinyint(2) NOT NULL COMMENT '0付费开通1激活码2实卡3积分兑换',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_expiretime` (`expiretime`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','expiretime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `expiretime` int(11) NOT NULL COMMENT '五折卡结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `createtime` int(11) NOT NULL COMMENT '记录创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','disable')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `disable` int(11) NOT NULL DEFAULT '0' COMMENT '禁用标记 1已禁用 0正常'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `username` varchar(32) NOT NULL COMMENT '持卡人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','levelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `levelid` int(11) NOT NULL COMMENT '会员等级'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','mototype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `mototype` varchar(32) NOT NULL COMMENT '车型'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','platenumber')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `platenumber` varchar(32) NOT NULL COMMENT '车牌号'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','from')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   `from` tinyint(2) NOT NULL COMMENT '0付费开通1激活码2实卡3积分兑换'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardmember','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardmember')." ADD   KEY `idx_createtime` (`createtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halfcardrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态 1未使用 2已经使用',
  `activeid` int(11) NOT NULL COMMENT '特权活动ID',
  `merchantid` int(11) NOT NULL COMMENT '特权店铺ID',
  `date` varchar(145) NOT NULL COMMENT '优惠日期',
  `qrcode` varchar(145) NOT NULL COMMENT '核销号码',
  `hexiaotime` varchar(45) NOT NULL COMMENT '核销时间',
  `verfmid` int(11) NOT NULL COMMENT '核销人',
  `createtime` varchar(45) NOT NULL COMMENT '创建时间',
  `is_half` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `adx_uniacid` (`uniacid`),
  KEY `adx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `status` int(11) NOT NULL COMMENT '状态 1未使用 2已经使用'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','activeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `activeid` int(11) NOT NULL COMMENT '特权活动ID'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `merchantid` int(11) NOT NULL COMMENT '特权店铺ID'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','date')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `date` varchar(145) NOT NULL COMMENT '优惠日期'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `qrcode` varchar(145) NOT NULL COMMENT '核销号码'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','hexiaotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `hexiaotime` varchar(45) NOT NULL COMMENT '核销时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','verfmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `verfmid` int(11) NOT NULL COMMENT '核销人'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `createtime` varchar(45) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','is_half')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   `is_half` int(11) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halfcardrecord','adx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halfcardrecord')." ADD   KEY `adx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_halflevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL COMMENT '名称',
  `status` int(11) NOT NULL COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `cardimg` varchar(255) NOT NULL COMMENT '卡面图片',
  `creditmoney` decimal(10,2) NOT NULL,
  `dkcredit` int(11) NOT NULL,
  `dkmoney` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_halflevel','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `name` varchar(45) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `status` int(11) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','cardimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `cardimg` varchar(255) NOT NULL COMMENT '卡面图片'");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `creditmoney` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','dkcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `dkcredit` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','dkmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   `dkmoney` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_halflevel','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_halflevel')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_headline_class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `head_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类id，为0时是一级分类',
  `name` varchar(20) NOT NULL COMMENT '分类名称',
  `sort` tinyint(2) unsigned NOT NULL COMMENT '分类排序',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类状态(0=禁用，1=开启)',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '所属代理ID',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='头条分类表';

");

if(!pdo_fieldexists('ims_wlmerchant_headline_class','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','head_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   `head_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类id，为0时是一级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   `name` varchar(20) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   `sort` tinyint(2) unsigned NOT NULL COMMENT '分类排序'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','state')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类状态(0=禁用，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   `aid` int(11) NOT NULL COMMENT '所属代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_headline_class','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_class')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_headline_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hid` int(10) unsigned NOT NULL COMMENT '关联头条信息的id',
  `mid` int(10) unsigned NOT NULL COMMENT '关联用户的id',
  `times` varchar(11) NOT NULL COMMENT '留言时间',
  `text` text NOT NULL COMMENT '留言内容',
  `reply` text NOT NULL COMMENT '作者回复内容',
  `reply_time` varchar(11) NOT NULL COMMENT '作者回复时间',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被查看（0=未被查看  1=已被查看）',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为精选留言（0=不是精选留言  1=是精选留言）',
  `set_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为置顶留言，每条头条只能有一条留言置顶（0=不是置顶留言  1=是置顶留言）',
  PRIMARY KEY (`id`),
  KEY `idx_hid` (`hid`),
  KEY `idx_state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='头条留言信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_headline_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','hid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `hid` int(10) unsigned NOT NULL COMMENT '关联头条信息的id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `mid` int(10) unsigned NOT NULL COMMENT '关联用户的id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `times` varchar(11) NOT NULL COMMENT '留言时间'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','text')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `text` text NOT NULL COMMENT '留言内容'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','reply')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `reply` text NOT NULL COMMENT '作者回复内容'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','reply_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `reply_time` varchar(11) NOT NULL COMMENT '作者回复时间'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','state')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `state` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被查看（0=未被查看  1=已被查看）'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','selected')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为精选留言（0=不是精选留言  1=是精选留言）'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','set_top')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   `set_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为置顶留言，每条头条只能有一条留言置顶（0=不是置顶留言  1=是置顶留言）'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_headline_comment','idx_hid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_comment')." ADD   KEY `idx_hid` (`hid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_headline_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned NOT NULL COMMENT '关联店铺id',
  `one_id` int(10) unsigned NOT NULL COMMENT '关联一级分类的id',
  `two_id` int(10) unsigned NOT NULL COMMENT '关联二级分类的id',
  `author` varchar(30) NOT NULL,
  `author_img` varchar(150) NOT NULL COMMENT '作者头像',
  `title` varchar(60) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `browse` int(10) NOT NULL COMMENT '浏览量',
  `display_img` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `release_time` varchar(11) NOT NULL COMMENT '发布时间',
  `call_id` int(11) NOT NULL COMMENT '关联集call活动的id，没有时为不开启集call活动\n',
  `labels` varchar(100) NOT NULL COMMENT '标签信息',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `goods_id` int(10) unsigned NOT NULL COMMENT '关联商品id',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_plugin` varchar(32) NOT NULL COMMENT '商品类型(rush-抢购商品；groupon-团购商品；wlfightgroup-拼团商品；coupon-卡卷商品；bargain-砍价商品)',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `aid` int(11) NOT NULL COMMENT '所属代理ID',
  `advs` text NOT NULL COMMENT '幻灯片数组',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_aid` (`uniacid`,`aid`),
  KEY `idx_release_time` (`release_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='头条内容表';

");

if(!pdo_fieldexists('ims_wlmerchant_headline_content','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','shop_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `shop_id` int(10) unsigned NOT NULL COMMENT '关联店铺id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','one_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `one_id` int(10) unsigned NOT NULL COMMENT '关联一级分类的id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','two_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `two_id` int(10) unsigned NOT NULL COMMENT '关联二级分类的id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','author')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `author` varchar(30) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','author_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `author_img` varchar(150) NOT NULL COMMENT '作者头像'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `title` varchar(60) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','summary')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `summary` varchar(255) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','browse')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `browse` int(10) NOT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','display_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `display_img` varchar(255) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `content` longtext NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','release_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `release_time` varchar(11) NOT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','call_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `call_id` int(11) NOT NULL COMMENT '关联集call活动的id，没有时为不开启集call活动\n'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','labels')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `labels` varchar(100) NOT NULL COMMENT '标签信息'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号ID'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `goods_id` int(10) unsigned NOT NULL COMMENT '关联商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','goods_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `goods_name` varchar(255) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','goods_plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `goods_plugin` varchar(32) NOT NULL COMMENT '商品类型(rush-抢购商品；groupon-团购商品；wlfightgroup-拼团商品；coupon-卡卷商品；bargain-砍价商品)'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `aid` int(11) NOT NULL COMMENT '所属代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','advs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   `advs` text NOT NULL COMMENT '幻灯片数组'");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_headline_content','idx_uniacid_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_headline_content')." ADD   KEY `idx_uniacid_aid` (`uniacid`,`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_helper_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID\n',
  `uniacid` int(11) NOT NULL,
  `title` varchar(145) NOT NULL COMMENT '问题标题',
  `content` text NOT NULL COMMENT '内容',
  `type` int(11) NOT NULL COMMENT '分类',
  `status` int(1) NOT NULL COMMENT '是否显示',
  `recommend` int(1) NOT NULL COMMENT '是否推荐',
  `sort` int(1) NOT NULL COMMENT '排序',
  `keyword` varchar(32) NOT NULL COMMENT '关键字',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_type_status` (`type`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_helper_question','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID\n'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `title` varchar(145) NOT NULL COMMENT '问题标题'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `content` text NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `type` int(11) NOT NULL COMMENT '分类'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `status` int(1) NOT NULL COMMENT '是否显示'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','recommend')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `recommend` int(1) NOT NULL COMMENT '是否推荐'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `sort` int(1) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','keyword')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   `keyword` varchar(32) NOT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_helper_question','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_question')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_helper_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `img` varchar(300) NOT NULL COMMENT '图片',
  `title` varchar(32) NOT NULL COMMENT '标题',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0关闭 1显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `url` varchar(300) NOT NULL COMMENT '连接',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_status` (`uniacid`,`status`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_helper_slide','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   `img` varchar(300) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   `title` varchar(32) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0关闭 1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   `url` varchar(300) NOT NULL COMMENT '连接'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_helper_slide','idx_uniacid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_slide')." ADD   KEY `idx_uniacid_status` (`uniacid`,`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_helper_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(145) NOT NULL COMMENT '分类名',
  `recommend` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 1推荐',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否开启1开启',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `img` varchar(300) NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_recommend_status` (`recommend`,`status`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_helper_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   `name` varchar(145) NOT NULL COMMENT '分类名'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','recommend')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   `recommend` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 1推荐'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否开启1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   `img` varchar(300) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_helper_type','idx_recommend_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_helper_type')." ADD   KEY `idx_recommend_status` (`recommend`,`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_artificer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `aid` int(11) DEFAULT NULL COMMENT '代理id',
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态 0未启用 1营业中 4被删除 5待审核 6被驳回 3过期 2未支付',
  `name` varchar(32) DEFAULT NULL COMMENT '师傅姓名',
  `gender` tinyint(1) DEFAULT NULL COMMENT '师傅性别 1男性 2女性',
  `detail` text COMMENT '详情',
  `mobile` varchar(32) DEFAULT NULL COMMENT '电话',
  `address` varchar(325) DEFAULT NULL COMMENT '地址',
  `lat` varchar(32) DEFAULT NULL COMMENT '地址纬度',
  `lng` varchar(32) DEFAULT NULL COMMENT '地址经度',
  `tagarray` varchar(325) DEFAULT NULL COMMENT '标签数组',
  `thumbs` text COMMENT '图片数组',
  `casethumbs` text COMMENT '案例图片',
  `reason` varchar(325) DEFAULT NULL COMMENT '驳回原因',
  `thumb` varchar(325) DEFAULT NULL COMMENT '头像',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `endtime` int(11) DEFAULT NULL COMMENT '入驻过期时间',
  `mealid` int(11) DEFAULT NULL COMMENT '入驻类型id',
  `region` varchar(648) DEFAULT NULL COMMENT '服务区域',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `uniacid` int(11) DEFAULT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `aid` int(11) DEFAULT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `status` tinyint(1) DEFAULT NULL COMMENT '状态 0未启用 1营业中 4被删除 5待审核 6被驳回 3过期 2未支付'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `name` varchar(32) DEFAULT NULL COMMENT '师傅姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','gender')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `gender` tinyint(1) DEFAULT NULL COMMENT '师傅性别 1男性 2女性'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `detail` text COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `mobile` varchar(32) DEFAULT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `address` varchar(325) DEFAULT NULL COMMENT '地址'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `lat` varchar(32) DEFAULT NULL COMMENT '地址纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `lng` varchar(32) DEFAULT NULL COMMENT '地址经度'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','tagarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `tagarray` varchar(325) DEFAULT NULL COMMENT '标签数组'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `thumbs` text COMMENT '图片数组'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','casethumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `casethumbs` text COMMENT '案例图片'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `reason` varchar(325) DEFAULT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `thumb` varchar(325) DEFAULT NULL COMMENT '头像'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `endtime` int(11) DEFAULT NULL COMMENT '入驻过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','mealid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `mealid` int(11) DEFAULT NULL COMMENT '入驻类型id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','region')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `region` varchar(648) DEFAULT NULL COMMENT '服务区域'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_artificer','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_artificer')." ADD   `createtime` int(11) DEFAULT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_demand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `status` tinyint(1) NOT NULL COMMENT '状态 0已关闭 1需求中 5待审核 4已删除 6被驳回 3待支付',
  `type` int(11) NOT NULL COMMENT '需求类型id',
  `address` varchar(325) NOT NULL COMMENT '上门地址',
  `lat` varchar(32) NOT NULL COMMENT '上门地址纬度',
  `lng` varchar(32) NOT NULL COMMENT '上门地址经度',
  `visitingtime` int(11) NOT NULL COMMENT '上门时间',
  `detail` varchar(325) NOT NULL COMMENT '描述详情',
  `thumbs` text NOT NULL COMMENT '图集',
  `reason` varchar(325) NOT NULL COMMENT '驳回原因',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `mobile` varchar(32) NOT NULL DEFAULT '0' COMMENT '联系电话',
  `topflag` tinyint(1) NOT NULL COMMENT '置顶标记 0未置顶 1置顶中',
  `updatetime` int(11) NOT NULL COMMENT '刷新时间',
  `topendtime` int(11) NOT NULL COMMENT '置顶过期时间',
  `onetype` int(11) DEFAULT NULL COMMENT '一级分类id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0已关闭 1需求中 5待审核 4已删除 6被驳回 3待支付'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `type` int(11) NOT NULL COMMENT '需求类型id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `address` varchar(325) NOT NULL COMMENT '上门地址'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `lat` varchar(32) NOT NULL COMMENT '上门地址纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `lng` varchar(32) NOT NULL COMMENT '上门地址经度'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','visitingtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `visitingtime` int(11) NOT NULL COMMENT '上门时间'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `detail` varchar(325) NOT NULL COMMENT '描述详情'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `thumbs` text NOT NULL COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `reason` varchar(325) NOT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `mobile` varchar(32) NOT NULL DEFAULT '0' COMMENT '联系电话'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','topflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `topflag` tinyint(1) NOT NULL COMMENT '置顶标记 0未置顶 1置顶中'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `updatetime` int(11) NOT NULL COMMENT '刷新时间'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','topendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `topendtime` int(11) NOT NULL COMMENT '置顶过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_demand','onetype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_demand')." ADD   `onetype` int(11) DEFAULT NULL COMMENT '一级分类id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_meals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `sort` varchar(32) NOT NULL COMMENT '排序',
  `name` varchar(32) NOT NULL COMMENT '套餐名',
  `is_free` tinyint(1) NOT NULL COMMENT '是否免费 0付费 1免费',
  `price` decimal(10,2) NOT NULL COMMENT '入驻金额',
  `day` int(11) NOT NULL COMMENT '入驻天数',
  `check` tinyint(1) NOT NULL COMMENT '是否审核 0免审核 1需要审核',
  `status` tinyint(1) NOT NULL COMMENT '状态 0禁用 1启用',
  `appsettpro` decimal(10,2) DEFAULT '0.00' COMMENT '预约金结算比例',
  `truesettpro` decimal(10,2) DEFAULT '0.00' COMMENT '实价结算比例',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `sort` varchar(32) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `name` varchar(32) NOT NULL COMMENT '套餐名'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','is_free')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `is_free` tinyint(1) NOT NULL COMMENT '是否免费 0付费 1免费'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `price` decimal(10,2) NOT NULL COMMENT '入驻金额'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `day` int(11) NOT NULL COMMENT '入驻天数'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','check')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `check` tinyint(1) NOT NULL COMMENT '是否审核 0免审核 1需要审核'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0禁用 1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','appsettpro')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `appsettpro` decimal(10,2) DEFAULT '0.00' COMMENT '预约金结算比例'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_meals','truesettpro')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_meals')." ADD   `truesettpro` decimal(10,2) DEFAULT '0.00' COMMENT '实价结算比例'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_praise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '评价id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_praise','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_praise')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_praise','cid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_praise')." ADD   `cid` int(11) NOT NULL COMMENT '评价id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_praise','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_praise')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_relation` (
  `type` tinyint(1) NOT NULL COMMENT '关联类型 1服务 2师傅 3商户',
  `objid` int(11) NOT NULL COMMENT '对象id',
  `onelevelid` int(11) NOT NULL COMMENT '一级分类id',
  `twolevelid` int(11) NOT NULL COMMENT '二级分类id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_relation','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_relation')." ADD 
  `type` tinyint(1) NOT NULL COMMENT '关联类型 1服务 2师傅 3商户'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_relation','objid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_relation')." ADD   `objid` int(11) NOT NULL COMMENT '对象id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_relation','onelevelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_relation')." ADD   `onelevelid` int(11) NOT NULL COMMENT '一级分类id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL COMMENT '评论id',
  `smid` int(11) DEFAULT NULL COMMENT '发送人id',
  `amid` int(11) DEFAULT NULL COMMENT '回复人id',
  `content` varchar(255) DEFAULT NULL COMMENT '回复内容',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','cid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `cid` int(11) DEFAULT NULL COMMENT '评论id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','smid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `smid` int(11) DEFAULT NULL COMMENT '发送人id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','amid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `amid` int(11) DEFAULT NULL COMMENT '回复人id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `content` varchar(255) DEFAULT NULL COMMENT '回复内容'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_reply','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_reply')." ADD   `createtime` int(11) DEFAULT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `type` tinyint(1) NOT NULL COMMENT '类型 1商户发布 2个人发布',
  `objid` int(11) NOT NULL COMMENT '发布人id',
  `status` tinyint(1) NOT NULL COMMENT '状态 0下架中 1服务中 5待审核 6被驳回 4被删除',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `pricetype` tinyint(1) NOT NULL COMMENT '金额类型 0无金额 1预约金 2实价',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `salenum` int(11) NOT NULL COMMENT '销量',
  `detail` text NOT NULL COMMENT '详情',
  `createtime` varchar(32) NOT NULL COMMENT '创建时间',
  `reason` varchar(325) NOT NULL COMMENT '驳回原因',
  `appointstatus` tinyint(1) NOT NULL COMMENT '是否开启预约 0关闭 1开启',
  `appointment` int(11) NOT NULL COMMENT '提前预约小时',
  `appointdays` int(11) NOT NULL COMMENT '可预约天数',
  `appointarray` text NOT NULL COMMENT '预约数组',
  `adv` text NOT NULL COMMENT '幻灯片',
  `thumb` varchar(325) NOT NULL COMMENT '缩略图',
  `videourl` varchar(325) NOT NULL COMMENT '视频链接',
  `unit` varchar(32) NOT NULL COMMENT '单位',
  `lng` varchar(32) NOT NULL COMMENT '服务者所在经度',
  `lat` varchar(32) NOT NULL COMMENT '服务者所在纬度',
  `sort` int(11) NOT NULL COMMENT '排序数组',
  `share_image` varchar(325) DEFAULT NULL COMMENT '公众号分享图',
  `share_wxapp_image` varchar(325) DEFAULT NULL COMMENT '小程序分享图',
  `share_title` varchar(100) DEFAULT NULL COMMENT '分享标题',
  `share_desc` varchar(325) DEFAULT NULL COMMENT '分享描述',
  `diyposter` int(11) DEFAULT NULL COMMENT '分享海报id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `type` tinyint(1) NOT NULL COMMENT '类型 1商户发布 2个人发布'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','objid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `objid` int(11) NOT NULL COMMENT '发布人id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0下架中 1服务中 5待审核 6被驳回 4被删除'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `title` varchar(100) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','pricetype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `pricetype` tinyint(1) NOT NULL COMMENT '金额类型 0无金额 1预约金 2实价'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','salenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `salenum` int(11) NOT NULL COMMENT '销量'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `detail` text NOT NULL COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `createtime` varchar(32) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `reason` varchar(325) NOT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','appointstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `appointstatus` tinyint(1) NOT NULL COMMENT '是否开启预约 0关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','appointment')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `appointment` int(11) NOT NULL COMMENT '提前预约小时'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','appointdays')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `appointdays` int(11) NOT NULL COMMENT '可预约天数'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','appointarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `appointarray` text NOT NULL COMMENT '预约数组'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `adv` text NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `thumb` varchar(325) NOT NULL COMMENT '缩略图'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','videourl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `videourl` varchar(325) NOT NULL COMMENT '视频链接'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','unit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `unit` varchar(32) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `lng` varchar(32) NOT NULL COMMENT '服务者所在经度'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `lat` varchar(32) NOT NULL COMMENT '服务者所在纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `sort` int(11) NOT NULL COMMENT '排序数组'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `share_image` varchar(325) DEFAULT NULL COMMENT '公众号分享图'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','share_wxapp_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `share_wxapp_image` varchar(325) DEFAULT NULL COMMENT '小程序分享图'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `share_title` varchar(100) DEFAULT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `share_desc` varchar(325) DEFAULT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_service','diyposter')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_service')." ADD   `diyposter` int(11) DEFAULT NULL COMMENT '分享海报id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_housekeep_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `title` varchar(32) NOT NULL COMMENT '分类标题',
  `status` tinyint(1) NOT NULL COMMENT '类型 0禁用 1启用',
  `sort` int(11) NOT NULL COMMENT '排序',
  `img` varchar(325) NOT NULL COMMENT '图片',
  `onelevelid` int(11) NOT NULL COMMENT '0 一级分类 其他为一级分类id',
  `type` tinyint(1) NOT NULL COMMENT '类型 0普通分类 1导航栏',
  `url` varchar(300) NOT NULL COMMENT '跳转链接',
  `color` varchar(32) NOT NULL COMMENT '颜色',
  `createtime` varchar(32) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `title` varchar(32) NOT NULL COMMENT '分类标题'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `status` tinyint(1) NOT NULL COMMENT '类型 0禁用 1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `img` varchar(325) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','onelevelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `onelevelid` int(11) NOT NULL COMMENT '0 一级分类 其他为一级分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `type` tinyint(1) NOT NULL COMMENT '类型 0普通分类 1导航栏'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `url` varchar(300) NOT NULL COMMENT '跳转链接'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `color` varchar(32) NOT NULL COMMENT '颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_housekeep_type','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_housekeep_type')." ADD   `createtime` varchar(32) DEFAULT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_im` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `send_id` int(11) NOT NULL COMMENT '发送方id',
  `send_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送方类型（1=用户；2=商户）',
  `receive_id` int(11) NOT NULL COMMENT '接收人id',
  `receive_type` tinyint(1) NOT NULL COMMENT '接收人类型（1=用户；2=商户）',
  `create_time` varchar(15) NOT NULL COMMENT '发送时间（建立时间）',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读（0=未读(默认)；1=已读）',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '内容类型:0=文本内容（可带表情），1=图片信息（不可带表情），2=视频信息（不可带表情），3=名片信息（不可带表情），4=简历信息（不可带表情）,5=其他信息(数组)',
  `content` text NOT NULL COMMENT '发送内容',
  `plugin` varchar(10) DEFAULT NULL COMMENT '通讯插件',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_send_id` (`send_id`),
  KEY `idx_receive_id` (`receive_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_im','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_im','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_im','send_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `send_id` int(11) NOT NULL COMMENT '发送方id'");}
if(!pdo_fieldexists('ims_wlmerchant_im','send_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `send_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发送方类型（1=用户；2=商户）'");}
if(!pdo_fieldexists('ims_wlmerchant_im','receive_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `receive_id` int(11) NOT NULL COMMENT '接收人id'");}
if(!pdo_fieldexists('ims_wlmerchant_im','receive_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `receive_type` tinyint(1) NOT NULL COMMENT '接收人类型（1=用户；2=商户）'");}
if(!pdo_fieldexists('ims_wlmerchant_im','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `create_time` varchar(15) NOT NULL COMMENT '发送时间（建立时间）'");}
if(!pdo_fieldexists('ims_wlmerchant_im','is_read')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读（0=未读(默认)；1=已读）'");}
if(!pdo_fieldexists('ims_wlmerchant_im','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '内容类型:0=文本内容（可带表情），1=图片信息（不可带表情），2=视频信息（不可带表情），3=名片信息（不可带表情），4=简历信息（不可带表情）,5=其他信息(数组)'");}
if(!pdo_fieldexists('ims_wlmerchant_im','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `content` text NOT NULL COMMENT '发送内容'");}
if(!pdo_fieldexists('ims_wlmerchant_im','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   `plugin` varchar(10) DEFAULT NULL COMMENT '通讯插件'");}
if(!pdo_fieldexists('ims_wlmerchant_im','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_im','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_im','idx_send_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_im')." ADD   KEY `idx_send_id` (`send_id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_indexset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `key` varchar(32) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='主页设置：排版；魔方';

");

if(!pdo_fieldexists('ims_wlmerchant_indexset','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   `key` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','value')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   `value` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_indexset','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_indexset')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL COMMENT '直播间名称',
  `roomid` int(11) NOT NULL COMMENT '直播间ID',
  `cover_img` varchar(255) NOT NULL COMMENT '直播间背景图链接',
  `share_img` varchar(255) NOT NULL COMMENT '直播间分享图链接',
  `live_status` tinyint(3) NOT NULL COMMENT '直播间状态。101：直播中，102：未开始，103已结束，104禁播，105：暂停，106：异常，107：已过期',
  `start_time` int(11) NOT NULL COMMENT '直播间开始时间',
  `end_time` int(11) NOT NULL COMMENT '直播计划结束时间',
  `anchor_name` varchar(50) NOT NULL COMMENT '主播名',
  `goods_list` text COMMENT '当前直播间相关联的商品列表',
  `is_playback` tinyint(1) NOT NULL DEFAULT '0' COMMENT '当前直播间是否存在回放(0=不存在，1=存在)',
  `is_update` tinyint(1) DEFAULT '0' COMMENT '是否更新数据，0=未更新，1=已更新',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_live','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_live','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_live','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_live','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `name` varchar(50) NOT NULL COMMENT '直播间名称'");}
if(!pdo_fieldexists('ims_wlmerchant_live','roomid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `roomid` int(11) NOT NULL COMMENT '直播间ID'");}
if(!pdo_fieldexists('ims_wlmerchant_live','cover_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `cover_img` varchar(255) NOT NULL COMMENT '直播间背景图链接'");}
if(!pdo_fieldexists('ims_wlmerchant_live','share_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `share_img` varchar(255) NOT NULL COMMENT '直播间分享图链接'");}
if(!pdo_fieldexists('ims_wlmerchant_live','live_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `live_status` tinyint(3) NOT NULL COMMENT '直播间状态。101：直播中，102：未开始，103已结束，104禁播，105：暂停，106：异常，107：已过期'");}
if(!pdo_fieldexists('ims_wlmerchant_live','start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `start_time` int(11) NOT NULL COMMENT '直播间开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_live','end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `end_time` int(11) NOT NULL COMMENT '直播计划结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_live','anchor_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `anchor_name` varchar(50) NOT NULL COMMENT '主播名'");}
if(!pdo_fieldexists('ims_wlmerchant_live','goods_list')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `goods_list` text COMMENT '当前直播间相关联的商品列表'");}
if(!pdo_fieldexists('ims_wlmerchant_live','is_playback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `is_playback` tinyint(1) NOT NULL DEFAULT '0' COMMENT '当前直播间是否存在回放(0=不存在，1=存在)'");}
if(!pdo_fieldexists('ims_wlmerchant_live','is_update')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live')." ADD   `is_update` tinyint(1) DEFAULT '0' COMMENT '是否更新数据，0=未更新，1=已更新'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_live_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL,
  `goods_id` int(11) DEFAULT NULL COMMENT '商品在微信商品库中的id',
  `audit_id` int(11) DEFAULT NULL COMMENT '商品审核单id',
  `audit_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0：未审核，1：审核中，2:审核通过，3审核失败',
  `wl_goods_id` int(11) NOT NULL COMMENT '商品在本平台的id',
  `goods_plugin` varchar(20) NOT NULL COMMENT '商品类型（rush=抢购、groupon=团购、wlfightgroup=拼团、coupon=卡卷、bargain=砍价）',
  `title` varchar(30) NOT NULL COMMENT '商品名称(直播名称)',
  `goods_img` varchar(255) NOT NULL COMMENT '商品预览图片',
  `price_type` tinyint(1) NOT NULL COMMENT '价格类型，1：一口价,2：价格区间,3：显示折扣价',
  `price` double(10,2) NOT NULL,
  `price2` double(10,2) DEFAULT NULL,
  `third_party_tag` tinyint(1) DEFAULT '1' COMMENT '商品来源1、2：表示是为 API 添加商品，否则是直播控制台添加的商品',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_live_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `goods_id` int(11) DEFAULT NULL COMMENT '商品在微信商品库中的id'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','audit_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `audit_id` int(11) DEFAULT NULL COMMENT '商品审核单id'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','audit_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `audit_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0：未审核，1：审核中，2:审核通过，3审核失败'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','wl_goods_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `wl_goods_id` int(11) NOT NULL COMMENT '商品在本平台的id'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','goods_plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `goods_plugin` varchar(20) NOT NULL COMMENT '商品类型（rush=抢购、groupon=团购、wlfightgroup=拼团、coupon=卡卷、bargain=砍价）'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `title` varchar(30) NOT NULL COMMENT '商品名称(直播名称)'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','goods_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `goods_img` varchar(255) NOT NULL COMMENT '商品预览图片'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','price_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `price_type` tinyint(1) NOT NULL COMMENT '价格类型，1：一口价,2：价格区间,3：显示折扣价'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `price` double(10,2) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','price2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `price2` double(10,2) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','third_party_tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   `third_party_tag` tinyint(1) DEFAULT '1' COMMENT '商品来源1、2：表示是为 API 添加商品，否则是直播控制台添加的商品'");}
if(!pdo_fieldexists('ims_wlmerchant_live_goods','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_goods')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_live_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `openid` varchar(50) DEFAULT NULL COMMENT '用户openid  唯一标识',
  `member_role` tinyint(1) DEFAULT NULL COMMENT '具有的身份：0:超级管理员，1:管理员，2:主播，3:运营者',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `account_number` varchar(50) DEFAULT NULL COMMENT '脱敏微信号',
  `is_synchronization` tinyint(1) DEFAULT NULL COMMENT '信息是否同步:0=未同步;1=已经同步',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_live_member','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `nickname` varchar(50) DEFAULT NULL COMMENT '昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `avatar` varchar(255) DEFAULT NULL COMMENT '头像'");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `openid` varchar(50) DEFAULT NULL COMMENT '用户openid  唯一标识'");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','member_role')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `member_role` tinyint(1) DEFAULT NULL COMMENT '具有的身份：0:超级管理员，1:管理员，2:主播，3:运营者'");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','update_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `update_time` int(11) DEFAULT NULL COMMENT '更新时间'");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','account_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `account_number` varchar(50) DEFAULT NULL COMMENT '脱敏微信号'");}
if(!pdo_fieldexists('ims_wlmerchant_live_member','is_synchronization')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_live_member')." ADD   `is_synchronization` tinyint(1) DEFAULT NULL COMMENT '信息是否同步:0=未同步;1=已经同步'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(128) NOT NULL COMMENT '用户token',
  `secret_key` varchar(128) NOT NULL COMMENT '返回token',
  `refresh_time` int(11) NOT NULL COMMENT '刷新时间',
  `end_time` int(11) NOT NULL COMMENT '过期时间',
  PRIMARY KEY (`id`),
  KEY `idx_secret_key` (`secret_key`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_login','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_login')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_login','token')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_login')." ADD   `token` varchar(128) NOT NULL COMMENT '用户token'");}
if(!pdo_fieldexists('ims_wlmerchant_login','secret_key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_login')." ADD   `secret_key` varchar(128) NOT NULL COMMENT '返回token'");}
if(!pdo_fieldexists('ims_wlmerchant_login','refresh_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_login')." ADD   `refresh_time` int(11) NOT NULL COMMENT '刷新时间'");}
if(!pdo_fieldexists('ims_wlmerchant_login','end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_login')." ADD   `end_time` int(11) NOT NULL COMMENT '过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_login','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_login')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_marking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `getcredit` int(11) NOT NULL COMMENT '获得积分',
  `creditmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '积分抵扣比例',
  `deduct` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最多抵扣金额',
  `manydeduct` int(11) NOT NULL COMMENT '允许多件抵扣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_marking','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_marking','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_marking','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_marking','getcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD   `getcredit` int(11) NOT NULL COMMENT '获得积分'");}
if(!pdo_fieldexists('ims_wlmerchant_marking','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD   `creditmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '积分抵扣比例'");}
if(!pdo_fieldexists('ims_wlmerchant_marking','deduct')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD   `deduct` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最多抵扣金额'");}
if(!pdo_fieldexists('ims_wlmerchant_marking','manydeduct')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_marking')." ADD   `manydeduct` int(11) NOT NULL COMMENT '允许多件抵扣'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员ID',
  `uid` int(11) NOT NULL COMMENT '微擎会员id',
  `invid` int(11) NOT NULL COMMENT '邀请人id',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `openid` varchar(32) NOT NULL COMMENT '储存用户公众号的openid',
  `unionid` varchar(32) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `realname` varchar(64) NOT NULL,
  `credit1` decimal(10,2) NOT NULL COMMENT '积分',
  `credit2` decimal(10,2) NOT NULL COMMENT '余额',
  `gender` int(11) NOT NULL,
  `isvip` int(11) NOT NULL DEFAULT '1' COMMENT '会员类型1普通2VIP',
  `vipendtime` int(11) NOT NULL COMMENT '会员到期时间',
  `avatar` varchar(445) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `areaid` int(11) NOT NULL COMMENT '地区ID',
  `aid` int(11) NOT NULL COMMENT '所属代理ID',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '1：VIP1',
  `dealnum` int(11) NOT NULL DEFAULT '0' COMMENT '成交量',
  `dealmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交额',
  `vipstatus` int(11) NOT NULL COMMENT 'VIP状态',
  `lastviptime` varchar(145) NOT NULL DEFAULT '0' COMMENT '上次VIP应该结束时间',
  `vipleveldays` int(11) NOT NULL DEFAULT '0' COMMENT '会员持续天数，每天更新',
  `distributorid` int(11) NOT NULL DEFAULT '0' COMMENT '分销商id',
  `salt` varchar(32) NOT NULL COMMENT '加密盐',
  `registerflag` int(11) NOT NULL COMMENT '注册标记',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `dotime` int(11) NOT NULL COMMENT '最近访问时间',
  `sharemoney` decimal(10,2) NOT NULL COMMENT '分享佣金',
  `sharenowmoney` decimal(10,2) NOT NULL COMMENT '现有分享佣金',
  `wechat_openid` varchar(32) NOT NULL COMMENT '储存用户小程序的openid',
  `webapp_openid` varchar(32) NOT NULL COMMENT '储存用户webapp的openid',
  `bank_name` varchar(50) NOT NULL COMMENT '用户银行卡开户行',
  `card_number` varchar(20) NOT NULL COMMENT '用户的银行卡账号',
  `alipay` varchar(20) NOT NULL COMMENT '用户的支付宝账号',
  `bank_username` varchar(20) NOT NULL COMMENT '用户银行卡开户人的姓名',
  `blackflag` tinyint(1) NOT NULL COMMENT '黑名单 1被加入黑名单',
  `tokey` varchar(32) NOT NULL COMMENT '用户token',
  `wechat_number` varchar(50) NOT NULL COMMENT '用户微信号',
  `wechat_qrcode` varchar(255) NOT NULL COMMENT '用户微信号二维码图片地址',
  `main_browse` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户主页浏览量',
  `main_bgimg` varchar(455) NOT NULL COMMENT '用户主页图片',
  `session_key` varchar(120) NOT NULL COMMENT '用户session_key\n',
  `cash_back_money` decimal(10,2) DEFAULT NULL COMMENT '用户支付返现金额（当前金额不可提现）',
  `protime` int(11) NOT NULL COMMENT '用于记录推送时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_unionid` (`unionid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_mobile` (`mobile`),
  KEY `idx_token` (`tokey`),
  KEY `idx_wechatopenid` (`wechat_openid`)
) ENGINE=InnoDB AUTO_INCREMENT=9913 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_member','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员ID'");}
if(!pdo_fieldexists('ims_wlmerchant_member','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `uid` int(11) NOT NULL COMMENT '微擎会员id'");}
if(!pdo_fieldexists('ims_wlmerchant_member','invid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `invid` int(11) NOT NULL COMMENT '邀请人id'");}
if(!pdo_fieldexists('ims_wlmerchant_member','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号ID'");}
if(!pdo_fieldexists('ims_wlmerchant_member','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `openid` varchar(32) NOT NULL COMMENT '储存用户公众号的openid'");}
if(!pdo_fieldexists('ims_wlmerchant_member','unionid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `unionid` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `nickname` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member','realname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `realname` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member','credit1')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `credit1` decimal(10,2) NOT NULL COMMENT '积分'");}
if(!pdo_fieldexists('ims_wlmerchant_member','credit2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `credit2` decimal(10,2) NOT NULL COMMENT '余额'");}
if(!pdo_fieldexists('ims_wlmerchant_member','gender')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `gender` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member','isvip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `isvip` int(11) NOT NULL DEFAULT '1' COMMENT '会员类型1普通2VIP'");}
if(!pdo_fieldexists('ims_wlmerchant_member','vipendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `vipendtime` int(11) NOT NULL COMMENT '会员到期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `avatar` varchar(445) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `mobile` varchar(15) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `areaid` int(11) NOT NULL COMMENT '地区ID'");}
if(!pdo_fieldexists('ims_wlmerchant_member','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `aid` int(11) NOT NULL COMMENT '所属代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_member','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `level` int(11) NOT NULL DEFAULT '0' COMMENT '1：VIP1'");}
if(!pdo_fieldexists('ims_wlmerchant_member','dealnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `dealnum` int(11) NOT NULL DEFAULT '0' COMMENT '成交量'");}
if(!pdo_fieldexists('ims_wlmerchant_member','dealmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `dealmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交额'");}
if(!pdo_fieldexists('ims_wlmerchant_member','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `vipstatus` int(11) NOT NULL COMMENT 'VIP状态'");}
if(!pdo_fieldexists('ims_wlmerchant_member','lastviptime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `lastviptime` varchar(145) NOT NULL DEFAULT '0' COMMENT '上次VIP应该结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member','vipleveldays')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `vipleveldays` int(11) NOT NULL DEFAULT '0' COMMENT '会员持续天数，每天更新'");}
if(!pdo_fieldexists('ims_wlmerchant_member','distributorid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `distributorid` int(11) NOT NULL DEFAULT '0' COMMENT '分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_member','salt')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `salt` varchar(32) NOT NULL COMMENT '加密盐'");}
if(!pdo_fieldexists('ims_wlmerchant_member','registerflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `registerflag` int(11) NOT NULL COMMENT '注册标记'");}
if(!pdo_fieldexists('ims_wlmerchant_member','password')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `password` varchar(32) NOT NULL COMMENT '密码'");}
if(!pdo_fieldexists('ims_wlmerchant_member','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `dotime` int(11) NOT NULL COMMENT '最近访问时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member','sharemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `sharemoney` decimal(10,2) NOT NULL COMMENT '分享佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_member','sharenowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `sharenowmoney` decimal(10,2) NOT NULL COMMENT '现有分享佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_member','wechat_openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `wechat_openid` varchar(32) NOT NULL COMMENT '储存用户小程序的openid'");}
if(!pdo_fieldexists('ims_wlmerchant_member','webapp_openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `webapp_openid` varchar(32) NOT NULL COMMENT '储存用户webapp的openid'");}
if(!pdo_fieldexists('ims_wlmerchant_member','bank_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `bank_name` varchar(50) NOT NULL COMMENT '用户银行卡开户行'");}
if(!pdo_fieldexists('ims_wlmerchant_member','card_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `card_number` varchar(20) NOT NULL COMMENT '用户的银行卡账号'");}
if(!pdo_fieldexists('ims_wlmerchant_member','alipay')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `alipay` varchar(20) NOT NULL COMMENT '用户的支付宝账号'");}
if(!pdo_fieldexists('ims_wlmerchant_member','bank_username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `bank_username` varchar(20) NOT NULL COMMENT '用户银行卡开户人的姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_member','blackflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `blackflag` tinyint(1) NOT NULL COMMENT '黑名单 1被加入黑名单'");}
if(!pdo_fieldexists('ims_wlmerchant_member','tokey')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `tokey` varchar(32) NOT NULL COMMENT '用户token'");}
if(!pdo_fieldexists('ims_wlmerchant_member','wechat_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `wechat_number` varchar(50) NOT NULL COMMENT '用户微信号'");}
if(!pdo_fieldexists('ims_wlmerchant_member','wechat_qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `wechat_qrcode` varchar(255) NOT NULL COMMENT '用户微信号二维码图片地址'");}
if(!pdo_fieldexists('ims_wlmerchant_member','main_browse')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `main_browse` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户主页浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_member','main_bgimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `main_bgimg` varchar(455) NOT NULL COMMENT '用户主页图片'");}
if(!pdo_fieldexists('ims_wlmerchant_member','session_key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `session_key` varchar(120) NOT NULL COMMENT '用户session_key\n'");}
if(!pdo_fieldexists('ims_wlmerchant_member','cash_back_money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `cash_back_money` decimal(10,2) DEFAULT NULL COMMENT '用户支付返现金额（当前金额不可提现）'");}
if(!pdo_fieldexists('ims_wlmerchant_member','protime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   `protime` int(11) NOT NULL COMMENT '用于记录推送时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_openid` (`openid`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_unionid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_unionid` (`unionid`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_createtime` (`createtime`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_mobile` (`mobile`)");}
if(!pdo_fieldexists('ims_wlmerchant_member','idx_token')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member')." ADD   KEY `idx_token` (`tokey`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_member_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `parentid` int(11) NOT NULL COMMENT '父类优惠券id',
  `status` int(11) NOT NULL COMMENT '卡券状态 1未使用 2已使用 5未支付',
  `type` int(11) NOT NULL COMMENT '优惠券类型 1 折扣券 2代金券 3礼品券 4 团购券 5优惠券',
  `title` varchar(145) NOT NULL COMMENT '优惠券标题',
  `sub_title` varchar(145) NOT NULL COMMENT '优惠券副标题',
  `content` text NOT NULL COMMENT '优惠券内容',
  `description` text NOT NULL COMMENT '使用须知',
  `color` varchar(32) NOT NULL COMMENT '颜色',
  `usetimes` int(11) NOT NULL COMMENT '剩余使用次数',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `usedtime` text NOT NULL COMMENT '使用时间',
  `orderno` varchar(145) NOT NULL COMMENT '订单号',
  `price` decimal(10,2) NOT NULL COMMENT '支付金额',
  `concode` varchar(32) NOT NULL COMMENT '消费码',
  `cutoffnotice` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_member_coupons','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `aid` int(11) NOT NULL COMMENT '代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','parentid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `parentid` int(11) NOT NULL COMMENT '父类优惠券id'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `status` int(11) NOT NULL COMMENT '卡券状态 1未使用 2已使用 5未支付'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `type` int(11) NOT NULL COMMENT '优惠券类型 1 折扣券 2代金券 3礼品券 4 团购券 5优惠券'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `title` varchar(145) NOT NULL COMMENT '优惠券标题'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','sub_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `sub_title` varchar(145) NOT NULL COMMENT '优惠券副标题'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `content` text NOT NULL COMMENT '优惠券内容'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `description` text NOT NULL COMMENT '使用须知'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `color` varchar(32) NOT NULL COMMENT '颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `usetimes` int(11) NOT NULL COMMENT '剩余使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `starttime` int(11) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `endtime` int(11) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','usedtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `usedtime` text NOT NULL COMMENT '使用时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `price` decimal(10,2) NOT NULL COMMENT '支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','concode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `concode` varchar(32) NOT NULL COMMENT '消费码'");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','cutoffnotice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   `cutoffnotice` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_member_coupons','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_coupons')." ADD   KEY `idx_mid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_member_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(145) NOT NULL,
  `name` varchar(145) NOT NULL,
  `days` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `uniacid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1显示',
  `num` int(11) NOT NULL COMMENT '可开通次数',
  `is_half` int(11) NOT NULL,
  `todistributor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_member_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `logo` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `name` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','days')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `days` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `price` decimal(10,2) DEFAULT '0.00'");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `status` int(11) NOT NULL COMMENT '1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `num` int(11) NOT NULL COMMENT '可开通次数'");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','is_half')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `is_half` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_member_type','todistributor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_type')." ADD   `todistributor` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_member_visitor_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_id` int(11) DEFAULT NULL COMMENT '访客的用户id',
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `create_time` varchar(15) DEFAULT NULL COMMENT '第一次访问时间',
  `update_time` varchar(15) DEFAULT NULL COMMENT '最后一次访问时间（最近访问时间）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_member_visitor_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_visitor_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_member_visitor_record','visitor_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_visitor_record')." ADD   `visitor_id` int(11) DEFAULT NULL COMMENT '访客的用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_member_visitor_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_visitor_record')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_member_visitor_record','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_visitor_record')." ADD   `create_time` varchar(15) DEFAULT NULL COMMENT '第一次访问时间'");}
if(!pdo_fieldexists('ims_wlmerchant_member_visitor_record','update_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_member_visitor_record')." ADD   `update_time` varchar(15) DEFAULT NULL COMMENT '最后一次访问时间（最近访问时间）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchant_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商家ID',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `amount` decimal(10,2) NOT NULL COMMENT '交易总金额',
  `updatetime` varchar(45) NOT NULL COMMENT '上次结算时间',
  `no_money` decimal(10,2) NOT NULL COMMENT '目前未结算金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_merchant_account','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_account','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_account','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD   `sid` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_account','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD   `uid` int(11) NOT NULL COMMENT '操作员id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_account','amount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD   `amount` decimal(10,2) NOT NULL COMMENT '交易总金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_account','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD   `updatetime` varchar(45) NOT NULL COMMENT '上次结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_account','no_money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_account')." ADD   `no_money` decimal(10,2) NOT NULL COMMENT '目前未结算金额'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchant_cate` (
  `sid` int(10) unsigned NOT NULL COMMENT '商家ID',
  `onelevel` int(10) unsigned NOT NULL COMMENT '一级分类',
  `twolevel` int(10) unsigned NOT NULL COMMENT '二级分类',
  KEY `idx_sid` (`sid`),
  KEY `idx_onelevel` (`onelevel`),
  KEY `idx_twolevel` (`twolevel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_merchant_cate','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_cate')." ADD 
  `sid` int(10) unsigned NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_cate','onelevel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_cate')." ADD   `onelevel` int(10) unsigned NOT NULL COMMENT '一级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_cate','twolevel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_cate')." ADD   `twolevel` int(10) unsigned NOT NULL COMMENT '二级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_cate','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_cate')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_cate','idx_onelevel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_cate')." ADD   KEY `idx_onelevel` (`onelevel`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchant_money_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商家ID',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '变动金额',
  `createtime` varchar(145) NOT NULL COMMENT '变动时间',
  `orderid` int(11) NOT NULL COMMENT '订单ID',
  `type` int(11) NOT NULL COMMENT '1支付成功2发货成功成为可结算金额3取消发货4商家结算5退款',
  `detail` text COMMENT '详情',
  `plugin` varchar(32) NOT NULL COMMENT '插件名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='商家金额记录';

");

if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `sid` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `money` decimal(10,2) DEFAULT '0.00' COMMENT '变动金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `createtime` varchar(145) NOT NULL COMMENT '变动时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `orderid` int(11) NOT NULL COMMENT '订单ID'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `type` int(11) NOT NULL COMMENT '1支付成功2发货成功成为可结算金额3取消发货4商家结算5退款'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `detail` text COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_money_record','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_money_record')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件名'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchant_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商家id',
  `percent` varchar(32) NOT NULL COMMENT '佣金百分比',
  `commission` varchar(32) NOT NULL COMMENT '佣金',
  `money` varchar(45) NOT NULL COMMENT '本次结算金额',
  `get_money` varchar(32) NOT NULL COMMENT '本次商家得到金额',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `createtime` varchar(45) NOT NULL COMMENT '结算时间',
  `orderno` varchar(145) NOT NULL COMMENT '订单号',
  `plugin` varchar(32) NOT NULL COMMENT '插件名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_merchant_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','percent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `percent` varchar(32) NOT NULL COMMENT '佣金百分比'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','commission')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `commission` varchar(32) NOT NULL COMMENT '佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `money` varchar(45) NOT NULL COMMENT '本次结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','get_money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `get_money` varchar(32) NOT NULL COMMENT '本次商家得到金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `uid` int(11) NOT NULL COMMENT '操作员id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `createtime` varchar(45) NOT NULL COMMENT '结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_merchant_record','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchant_record')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件名'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchantdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL COMMENT '代理id',
  `provinceid` int(11) NOT NULL COMMENT '省ID',
  `areaid` int(11) NOT NULL COMMENT '地区id',
  `distid` int(11) NOT NULL COMMENT '区县id',
  `storename` varchar(64) NOT NULL COMMENT '店铺名称',
  `mobile` varchar(32) NOT NULL COMMENT '联系电话',
  `onelevel` int(11) NOT NULL COMMENT '一级分类',
  `twolevel` int(11) NOT NULL COMMENT '二级分类',
  `logo` varchar(128) NOT NULL COMMENT '店铺logo',
  `introduction` text NOT NULL COMMENT '店铺简介',
  `address` varchar(100) NOT NULL COMMENT '店铺地址',
  `location` varchar(128) NOT NULL,
  `realname` varchar(32) NOT NULL COMMENT '联系人',
  `tel` varchar(20) NOT NULL COMMENT '联系电话',
  `enabled` int(2) NOT NULL COMMENT '商户状态',
  `status` int(2) NOT NULL COMMENT '是否审核通过 0未支付 1待审核 2已审核 3已驳回',
  `groupid` int(11) NOT NULL COMMENT '所属组别',
  `storehours` varchar(255) NOT NULL COMMENT '营业时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `remark` text NOT NULL COMMENT '备注',
  `percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cardsn` varchar(50) NOT NULL,
  `adv` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT '5',
  `bankrid` int(11) NOT NULL DEFAULT '0',
  `listorder` int(11) NOT NULL DEFAULT '0',
  `verkey` varchar(45) NOT NULL DEFAULT '0' COMMENT '核销密码',
  `autocash` int(11) NOT NULL DEFAULT '0' COMMENT '自动打款',
  `audits` int(11) NOT NULL COMMENT '免审核',
  `pv` int(11) NOT NULL COMMENT '人气',
  `tag` varchar(255) NOT NULL COMMENT '标签',
  `allmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '累计金额',
  `nowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现有金额',
  `panorama` varchar(255) NOT NULL COMMENT '店铺全景地址',
  `videourl` varchar(255) NOT NULL COMMENT '店铺视频地址',
  `merqrimg` varchar(128) NOT NULL COMMENT '商户二维码',
  `wxappswitch` int(11) NOT NULL DEFAULT '0' COMMENT '小程序关联码开关',
  `album` text NOT NULL COMMENT '相册',
  `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐',
  `iscommon` tinyint(1) NOT NULL COMMENT '公共商家',
  `settlementrate` decimal(10,2) NOT NULL COMMENT '商品价格结算比',
  `vipsettlementrate` decimal(10,2) NOT NULL COMMENT '商品VIP价格结算比',
  `settlementtext` text NOT NULL COMMENT '新结算比的压缩字符串',
  `payonline` int(11) NOT NULL COMMENT '是否可以在线买单',
  `qrcode` varchar(128) NOT NULL COMMENT '店长二维码',
  `mp4thumb` varchar(128) NOT NULL COMMENT 'mp4封面图',
  `cloudspeaker` text NOT NULL COMMENT '云喇叭设置信息',
  `externallink` varchar(255) NOT NULL COMMENT '外部链接',
  `listshow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '该店铺是否在店铺列表显示0=显示1=隐藏',
  `store_quhao` varchar(11) NOT NULL COMMENT '店铺电话区号',
  `note_quhao` varchar(11) NOT NULL COMMENT '店主手机区号',
  `salesmid` int(11) NOT NULL COMMENT '业务员mid',
  `examineimg` text NOT NULL COMMENT '审核素材',
  `reservestatus` int(11) NOT NULL COMMENT '预留金额类型 0以平台为准 1以商户为准',
  `reservemoney` decimal(10,2) NOT NULL COMMENT '商户预留金额',
  `autostoreqr` tinyint(1) NOT NULL COMMENT '是否自动添加商户二维码',
  `isdiytip` tinyint(1) NOT NULL COMMENT '是否显示自定义内容',
  `describe` varchar(325) NOT NULL COMMENT '商户基本描述',
  `deliveryrate` decimal(10,2) NOT NULL COMMENT '同城配送结算比例',
  `deliverymoney` decimal(10,2) NOT NULL COMMENT '配送费',
  `deliverystatus` tinyint(1) NOT NULL COMMENT '是否开启同城配送',
  `lng` varchar(16) NOT NULL COMMENT '经度',
  `lat` varchar(16) NOT NULL COMMENT '纬度',
  `printing` text NOT NULL COMMENT '打印推送设置信息',
  `deliverydistance` decimal(10,2) NOT NULL COMMENT '配送距离',
  `lowdeliverymoney` decimal(10,2) NOT NULL COMMENT '起送价',
  `deliverydisstatus` int(11) NOT NULL COMMENT '同城配送商品分销状态',
  `onescale` decimal(10,2) NOT NULL COMMENT '同城配送一级佣金比例',
  `twoscale` decimal(10,2) NOT NULL COMMENT '同城配送二级佣金比例',
  `deliverytype` varchar(255) NOT NULL COMMENT '配送方式',
  `makebiguser` int(11) NOT NULL COMMENT '0 否 1 是',
  `paybackstatus` int(11) NOT NULL COMMENT '支付返现',
  `payback` text NOT NULL COMMENT '支付返现比例',
  `onepayonlinescale` decimal(10,2) NOT NULL COMMENT '在线买单一级佣金比例',
  `twopayonlinescale` decimal(10,2) NOT NULL COMMENT '在线买单二级佣金比例',
  `payonlinedisstatus` int(11) NOT NULL COMMENT '在线买单分销状态',
  `expresspricestatus` int(11) NOT NULL COMMENT '同城配送运费计费方式 1商家 2平台',
  `payfullid` int(11) NOT NULL COMMENT '在线买单满减活动id',
  `deliveryfullid` int(11) NOT NULL COMMENT '同城配送满减活动id',
  `posterid` int(11) NOT NULL COMMENT '自定义海报的id',
  `paypaidid` int(11) NOT NULL COMMENT '在线买单支付有礼',
  `deliverypaidid` int(11) NOT NULL COMMENT '同城配送支付有礼',
  `panorama_discount` decimal(10,1) NOT NULL DEFAULT '10.0' COMMENT '商户买单折扣',
  `wxallid` int(11) NOT NULL COMMENT '公众号端支付信息id',
  `appallid` int(11) NOT NULL COMMENT '小程序端支付信息id',
  `payinrate` decimal(10,2) NOT NULL COMMENT '在线买单订单抵扣比例',
  `payintegral` decimal(10,2) NOT NULL COMMENT '在线买单积分抵扣比例',
  `payolsetstatus` tinyint(1) NOT NULL COMMENT '买单金额结算方式 0按实际支付金额结算 1按订单金额计算',
  `delivery_adv` text COMMENT '外卖页面幻灯片',
  `recruit_switch` tinyint(1) DEFAULT '0' COMMENT '是否开启求职招聘功能：0=关闭，1=开启',
  `recruit_nature_id` int(11) DEFAULT NULL COMMENT '企业性质',
  `recruit_scale_id` int(11) DEFAULT NULL COMMENT '企业规模',
  `recruit_industry_id` int(11) DEFAULT NULL COMMENT '企业行业',
  `recruit_adv` text COMMENT '企业幻灯片',
  `third_shop_no` varchar(125) NOT NULL COMMENT '三方商户编号（达达）',
  `third_city_code` varchar(11) NOT NULL COMMENT '三方城市代码(达达)',
  `third_city_name` varchar(32) NOT NULL COMMENT '三方城市名字(达达)',
  `virtual_sales` int(11) DEFAULT '0' COMMENT '虚拟销量',
  `housekeepstatus` tinyint(1) NOT NULL COMMENT '家政服务 0关闭 1开启',
  `proportion` varchar(325) DEFAULT NULL COMMENT '幻灯片比例数组',
  `wxapp_shareimg` varchar(200) DEFAULT NULL COMMENT '小程序分享图',
  `yuecashback` decimal(10,2) DEFAULT NULL COMMENT '同城配送余额返现',
  `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '同城配送会员余额返现',
  `acceptstatus` tinyint(1) DEFAULT NULL COMMENT '接单设置 0自动接单 1手动接单',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_areaid` (`areaid`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COMMENT='商户资料表';

");

if(!pdo_fieldexists('ims_wlmerchant_merchantdata','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','provinceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `provinceid` int(11) NOT NULL COMMENT '省ID'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `areaid` int(11) NOT NULL COMMENT '地区id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','distid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `distid` int(11) NOT NULL COMMENT '区县id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','storename')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `storename` varchar(64) NOT NULL COMMENT '店铺名称'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `mobile` varchar(32) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','onelevel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `onelevel` int(11) NOT NULL COMMENT '一级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','twolevel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `twolevel` int(11) NOT NULL COMMENT '二级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `logo` varchar(128) NOT NULL COMMENT '店铺logo'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','introduction')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `introduction` text NOT NULL COMMENT '店铺简介'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `address` varchar(100) NOT NULL COMMENT '店铺地址'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','location')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `location` varchar(128) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','realname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `realname` varchar(32) NOT NULL COMMENT '联系人'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','tel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `tel` varchar(20) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `enabled` int(2) NOT NULL COMMENT '商户状态'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `status` int(2) NOT NULL COMMENT '是否审核通过 0未支付 1待审核 2已审核 3已驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','groupid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `groupid` int(11) NOT NULL COMMENT '所属组别'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','storehours')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `storehours` varchar(255) NOT NULL COMMENT '营业时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `endtime` int(11) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `remark` text NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','percent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `percent` decimal(10,2) NOT NULL DEFAULT '0.00'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','cardsn')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `cardsn` varchar(50) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `adv` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','score')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `score` int(11) NOT NULL DEFAULT '5'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','bankrid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `bankrid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','listorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `listorder` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','verkey')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `verkey` varchar(45) NOT NULL DEFAULT '0' COMMENT '核销密码'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','autocash')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `autocash` int(11) NOT NULL DEFAULT '0' COMMENT '自动打款'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','audits')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `audits` int(11) NOT NULL COMMENT '免审核'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `pv` int(11) NOT NULL COMMENT '人气'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `tag` varchar(255) NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','allmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `allmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '累计金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','nowmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `nowmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现有金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','panorama')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `panorama` varchar(255) NOT NULL COMMENT '店铺全景地址'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','videourl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `videourl` varchar(255) NOT NULL COMMENT '店铺视频地址'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','merqrimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `merqrimg` varchar(128) NOT NULL COMMENT '商户二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','wxappswitch')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `wxappswitch` int(11) NOT NULL DEFAULT '0' COMMENT '小程序关联码开关'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','album')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `album` text NOT NULL COMMENT '相册'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','bgmusic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','iscommon')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `iscommon` tinyint(1) NOT NULL COMMENT '公共商家'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','settlementrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `settlementrate` decimal(10,2) NOT NULL COMMENT '商品价格结算比'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','vipsettlementrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `vipsettlementrate` decimal(10,2) NOT NULL COMMENT '商品VIP价格结算比'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','settlementtext')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `settlementtext` text NOT NULL COMMENT '新结算比的压缩字符串'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payonline')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payonline` int(11) NOT NULL COMMENT '是否可以在线买单'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `qrcode` varchar(128) NOT NULL COMMENT '店长二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','mp4thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `mp4thumb` varchar(128) NOT NULL COMMENT 'mp4封面图'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','cloudspeaker')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `cloudspeaker` text NOT NULL COMMENT '云喇叭设置信息'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','externallink')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `externallink` varchar(255) NOT NULL COMMENT '外部链接'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','listshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `listshow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '该店铺是否在店铺列表显示0=显示1=隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','store_quhao')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `store_quhao` varchar(11) NOT NULL COMMENT '店铺电话区号'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','note_quhao')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `note_quhao` varchar(11) NOT NULL COMMENT '店主手机区号'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','salesmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `salesmid` int(11) NOT NULL COMMENT '业务员mid'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','examineimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `examineimg` text NOT NULL COMMENT '审核素材'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','reservestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `reservestatus` int(11) NOT NULL COMMENT '预留金额类型 0以平台为准 1以商户为准'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','reservemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `reservemoney` decimal(10,2) NOT NULL COMMENT '商户预留金额'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','autostoreqr')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `autostoreqr` tinyint(1) NOT NULL COMMENT '是否自动添加商户二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','isdiytip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `isdiytip` tinyint(1) NOT NULL COMMENT '是否显示自定义内容'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `describe` varchar(325) NOT NULL COMMENT '商户基本描述'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliveryrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliveryrate` decimal(10,2) NOT NULL COMMENT '同城配送结算比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliverymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliverymoney` decimal(10,2) NOT NULL COMMENT '配送费'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliverystatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliverystatus` tinyint(1) NOT NULL COMMENT '是否开启同城配送'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `lng` varchar(16) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `lat` varchar(16) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','printing')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `printing` text NOT NULL COMMENT '打印推送设置信息'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliverydistance')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliverydistance` decimal(10,2) NOT NULL COMMENT '配送距离'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','lowdeliverymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `lowdeliverymoney` decimal(10,2) NOT NULL COMMENT '起送价'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliverydisstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliverydisstatus` int(11) NOT NULL COMMENT '同城配送商品分销状态'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','onescale')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `onescale` decimal(10,2) NOT NULL COMMENT '同城配送一级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','twoscale')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `twoscale` decimal(10,2) NOT NULL COMMENT '同城配送二级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliverytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliverytype` varchar(255) NOT NULL COMMENT '配送方式'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','makebiguser')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `makebiguser` int(11) NOT NULL COMMENT '0 否 1 是'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','paybackstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `paybackstatus` int(11) NOT NULL COMMENT '支付返现'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payback` text NOT NULL COMMENT '支付返现比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','onepayonlinescale')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `onepayonlinescale` decimal(10,2) NOT NULL COMMENT '在线买单一级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','twopayonlinescale')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `twopayonlinescale` decimal(10,2) NOT NULL COMMENT '在线买单二级佣金比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payonlinedisstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payonlinedisstatus` int(11) NOT NULL COMMENT '在线买单分销状态'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','expresspricestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `expresspricestatus` int(11) NOT NULL COMMENT '同城配送运费计费方式 1商家 2平台'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payfullid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payfullid` int(11) NOT NULL COMMENT '在线买单满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliveryfullid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliveryfullid` int(11) NOT NULL COMMENT '同城配送满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','posterid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `posterid` int(11) NOT NULL COMMENT '自定义海报的id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','paypaidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `paypaidid` int(11) NOT NULL COMMENT '在线买单支付有礼'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','deliverypaidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `deliverypaidid` int(11) NOT NULL COMMENT '同城配送支付有礼'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','panorama_discount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `panorama_discount` decimal(10,1) NOT NULL DEFAULT '10.0' COMMENT '商户买单折扣'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','wxallid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `wxallid` int(11) NOT NULL COMMENT '公众号端支付信息id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','appallid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `appallid` int(11) NOT NULL COMMENT '小程序端支付信息id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payinrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payinrate` decimal(10,2) NOT NULL COMMENT '在线买单订单抵扣比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payintegral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payintegral` decimal(10,2) NOT NULL COMMENT '在线买单积分抵扣比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','payolsetstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `payolsetstatus` tinyint(1) NOT NULL COMMENT '买单金额结算方式 0按实际支付金额结算 1按订单金额计算'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','delivery_adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `delivery_adv` text COMMENT '外卖页面幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','recruit_switch')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `recruit_switch` tinyint(1) DEFAULT '0' COMMENT '是否开启求职招聘功能：0=关闭，1=开启'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','recruit_nature_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `recruit_nature_id` int(11) DEFAULT NULL COMMENT '企业性质'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','recruit_scale_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `recruit_scale_id` int(11) DEFAULT NULL COMMENT '企业规模'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','recruit_industry_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `recruit_industry_id` int(11) DEFAULT NULL COMMENT '企业行业'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','recruit_adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `recruit_adv` text COMMENT '企业幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','third_shop_no')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `third_shop_no` varchar(125) NOT NULL COMMENT '三方商户编号（达达）'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','third_city_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `third_city_code` varchar(11) NOT NULL COMMENT '三方城市代码(达达)'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','third_city_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `third_city_name` varchar(32) NOT NULL COMMENT '三方城市名字(达达)'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','virtual_sales')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `virtual_sales` int(11) DEFAULT '0' COMMENT '虚拟销量'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','housekeepstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `housekeepstatus` tinyint(1) NOT NULL COMMENT '家政服务 0关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','proportion')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `proportion` varchar(325) DEFAULT NULL COMMENT '幻灯片比例数组'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','wxapp_shareimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `wxapp_shareimg` varchar(200) DEFAULT NULL COMMENT '小程序分享图'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','yuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `yuecashback` decimal(10,2) DEFAULT NULL COMMENT '同城配送余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','vipyuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '同城配送会员余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','acceptstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   `acceptstatus` tinyint(1) DEFAULT NULL COMMENT '接单设置 0自动接单 1手动接单'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantdata','idx_enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantdata')." ADD   KEY `idx_enabled` (`enabled`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchantuser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '绑定微信id',
  `storeid` int(11) NOT NULL COMMENT '商户id',
  `name` varchar(64) NOT NULL COMMENT '姓名',
  `mobile` varchar(32) NOT NULL COMMENT '电话',
  `account` varchar(32) NOT NULL COMMENT '账号',
  `salt` varchar(16) NOT NULL COMMENT '加密盐',
  `password` varchar(64) NOT NULL COMMENT '密码',
  `groupid` int(11) NOT NULL COMMENT '所属组别',
  `areaid` varchar(16) NOT NULL COMMENT '区域id',
  `endtime` varchar(32) NOT NULL COMMENT '到期时间',
  `createtime` varchar(32) NOT NULL COMMENT '创建时间',
  `limit` text NOT NULL COMMENT '拥有权限',
  `reject` varchar(300) NOT NULL COMMENT '驳回原因',
  `status` int(2) NOT NULL COMMENT '是否通过审核',
  `enabled` int(2) NOT NULL COMMENT '是否启用 1启用 0禁用',
  `ismain` int(2) NOT NULL COMMENT '1超级管理员2核销员3管理员4业务员',
  `aid` int(11) NOT NULL,
  `alone` tinyint(1) NOT NULL COMMENT '1启用独立佣金0关闭',
  `scale` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '业务员提成比例',
  `manage_store` tinyint(1) NOT NULL COMMENT '1启用管理店铺独立设置0关闭',
  `hasmanage` tinyint(1) NOT NULL COMMENT '1启用管理店铺0关闭',
  `orderwrite` int(11) NOT NULL COMMENT '核销权限 1有0无',
  `viewdata` int(11) NOT NULL COMMENT '查看财务权限 1有 0无',
  `alone_plugin` tinyint(1) NOT NULL COMMENT '是否启用独立适用插件 1开启 0关闭',
  `sales_plugin` text NOT NULL COMMENT '独立适用插件组',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_storeid` (`storeid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_ismain` (`ismain`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COMMENT='代理、商户表';

");

if(!pdo_fieldexists('ims_wlmerchant_merchantuser','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `mid` int(11) NOT NULL COMMENT '绑定微信id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `storeid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `name` varchar(64) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `mobile` varchar(32) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','account')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `account` varchar(32) NOT NULL COMMENT '账号'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','salt')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `salt` varchar(16) NOT NULL COMMENT '加密盐'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','password')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `password` varchar(64) NOT NULL COMMENT '密码'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','groupid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `groupid` int(11) NOT NULL COMMENT '所属组别'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `areaid` varchar(16) NOT NULL COMMENT '区域id'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `endtime` varchar(32) NOT NULL COMMENT '到期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `createtime` varchar(32) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `limit` text NOT NULL COMMENT '拥有权限'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','reject')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `reject` varchar(300) NOT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `status` int(2) NOT NULL COMMENT '是否通过审核'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `enabled` int(2) NOT NULL COMMENT '是否启用 1启用 0禁用'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','ismain')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `ismain` int(2) NOT NULL COMMENT '1超级管理员2核销员3管理员4业务员'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','alone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `alone` tinyint(1) NOT NULL COMMENT '1启用独立佣金0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','scale')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `scale` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '业务员提成比例'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','manage_store')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `manage_store` tinyint(1) NOT NULL COMMENT '1启用管理店铺独立设置0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','hasmanage')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `hasmanage` tinyint(1) NOT NULL COMMENT '1启用管理店铺0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','orderwrite')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `orderwrite` int(11) NOT NULL COMMENT '核销权限 1有0无'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','viewdata')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `viewdata` int(11) NOT NULL COMMENT '查看财务权限 1有 0无'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','alone_plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `alone_plugin` tinyint(1) NOT NULL COMMENT '是否启用独立适用插件 1开启 0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','sales_plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   `sales_plugin` text NOT NULL COMMENT '独立适用插件组'");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','idx_storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   KEY `idx_storeid` (`storeid`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser','idx_ismain')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser')." ADD   KEY `idx_ismain` (`ismain`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_merchantuser_qrlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `codes` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','memberid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   `memberid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','codes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   `codes` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   `status` int(1) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   `createtime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_merchantuser_qrlog','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_merchantuser_qrlog')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `enabled` int(11) NOT NULL,
  `color` varchar(32) NOT NULL,
  `merchantid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_nav','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识'");}
if(!pdo_fieldexists('ims_wlmerchant_nav','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `name` varchar(50) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `link` varchar(255) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `thumb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `displayorder` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `enabled` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `color` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `merchantid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_nav','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   `type` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_nav','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_nav','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_nav','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_nav','idx_enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_nav')." ADD   KEY `idx_enabled` (`enabled`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `enabled` int(11) NOT NULL,
  `createtime` varchar(32) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_notice','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识'");}
if(!pdo_fieldexists('ims_wlmerchant_notice','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `title` varchar(255) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `content` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `enabled` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `createtime` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   `link` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_notice','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_notice','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_notice','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_notice')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_oparea` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `areaid` int(11) NOT NULL,
  `aid` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0禁用1启用',
  `ishot` int(11) NOT NULL COMMENT '0非热门1热门城市',
  `level` int(11) NOT NULL DEFAULT '2',
  `gid` int(11) NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_aid` (`aid`),
  KEY `idx_ishot` (`ishot`)
) ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_oparea','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `areaid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `aid` int(10) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `status` int(11) NOT NULL DEFAULT '1' COMMENT '0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','ishot')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `ishot` int(11) NOT NULL COMMENT '0非热门1热门城市'");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `level` int(11) NOT NULL DEFAULT '2'");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','gid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `gid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_oparea','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oparea')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_oplog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `describe` varchar(225) NOT NULL COMMENT '操作描述',
  `view_url` varchar(225) NOT NULL COMMENT '操作界面url',
  `ip` varchar(32) NOT NULL COMMENT 'IP',
  `data` varchar(1024) NOT NULL COMMENT '操作数据',
  `createtime` varchar(32) NOT NULL COMMENT '操作时间',
  `user` varchar(32) NOT NULL COMMENT '操作员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_oplog','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `describe` varchar(225) NOT NULL COMMENT '操作描述'");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','view_url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `view_url` varchar(225) NOT NULL COMMENT '操作界面url'");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','ip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `ip` varchar(32) NOT NULL COMMENT 'IP'");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `data` varchar(1024) NOT NULL COMMENT '操作数据'");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `createtime` varchar(32) NOT NULL COMMENT '操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_oplog','user')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_oplog')." ADD   `user` varchar(32) NOT NULL COMMENT '操作员'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `sid` int(11) NOT NULL COMMENT '商家id',
  `orderno` varchar(145) NOT NULL COMMENT '订单号',
  `fkid` int(11) NOT NULL COMMENT '商品关联ID',
  `status` int(11) NOT NULL COMMENT '状态 0未支付 1已支付 2已消费 3已完成 4待收货 待消费 5已取消 6待退款 7已退款  8待发货',
  `oprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付金额',
  `num` int(11) NOT NULL COMMENT '购买数量',
  `paytime` varchar(145) NOT NULL COMMENT '支付时间',
  `paytype` int(11) NOT NULL COMMENT '支付方式 1余额 2微信3支付宝',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `remark` text NOT NULL COMMENT '卖家备注',
  `issettlement` int(11) NOT NULL DEFAULT '0' COMMENT '1已结算',
  `plugin` varchar(32) NOT NULL COMMENT '插件',
  `payfor` varchar(32) NOT NULL COMMENT '干什么支付',
  `is_usecard` tinyint(3) NOT NULL COMMENT '1使用优惠',
  `card_type` tinyint(3) NOT NULL COMMENT '优惠类型',
  `card_id` int(3) NOT NULL COMMENT '优惠ID',
  `card_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `transid` varchar(145) NOT NULL COMMENT '微信订单号',
  `buyremark` text NOT NULL COMMENT '买家备注',
  `spec` text NOT NULL COMMENT '规格名',
  `fightstatus` int(11) NOT NULL COMMENT '1=发帖，2=置顶，3=红包\n0=核销 1商户配送 2平台配送\n1=黄页认领 2=黄页查看 3=黄页入驻\n家政：1=服务订单 2=服务者入驻 3=需求发布 4=需求置顶 5=需求刷新 ',
  `fightgroupid` int(11) NOT NULL,
  `expressid` int(11) NOT NULL,
  `recordid` int(11) NOT NULL,
  `refundtime` varchar(145) NOT NULL,
  `applyrefund` int(11) NOT NULL DEFAULT '0' COMMENT '申请退款',
  `applytime` varchar(145) NOT NULL COMMENT '申请退款时间',
  `disorderid` int(11) NOT NULL DEFAULT '0',
  `failtimes` int(11) NOT NULL DEFAULT '0',
  `vipbuyflag` int(11) NOT NULL COMMENT '会员购买表示 1会员购买 0普通购买 ',
  `specid` int(11) NOT NULL COMMENT '规格id',
  `mobile` varchar(32) NOT NULL COMMENT '电话',
  `name` varchar(125) NOT NULL COMMENT '姓名',
  `address` text NOT NULL COMMENT '地址',
  `paidprid` int(11) NOT NULL COMMENT '支付有礼记录id',
  `shareid` int(11) NOT NULL COMMENT '分享有礼记录id',
  `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算金额',
  `goodsprice` decimal(10,2) NOT NULL COMMENT '商品金额',
  `overtime` int(11) NOT NULL COMMENT '标记过期时间',
  `changedispatchprice` decimal(10,2) NOT NULL COMMENT '订单改运费',
  `changeprice` decimal(10,2) NOT NULL COMMENT '订单改价',
  `originalprice` decimal(10,2) NOT NULL COMMENT '改价之前的原始价',
  `estimatetime` int(11) NOT NULL COMMENT '预计过期时间',
  `package` tinyint(2) NOT NULL COMMENT '订单为帖子中的发送红包订单时，这里储存的是红包个数',
  `vip_card_id` int(11) NOT NULL COMMENT '储存用户在购买当前商品时开通的会员卡的id',
  `redisstatus` tinyint(10) NOT NULL COMMENT '退款分销订单状态修改',
  `neworderflag` tinyint(1) NOT NULL COMMENT '新订单标志',
  `reportid` int(11) NOT NULL COMMENT '报表id',
  `settletime` int(11) NOT NULL COMMENT '结算时间',
  `usecredit` decimal(10,2) NOT NULL COMMENT '使用的积分',
  `cerditmoney` decimal(10,2) NOT NULL COMMENT '积分抵扣的金额',
  `canceltime` int(11) NOT NULL COMMENT '预计取消时间',
  `remindtime` int(11) NOT NULL COMMENT '过期提醒时间',
  `cutoffnotice` int(11) NOT NULL COMMENT '是否发送过期通知',
  `com_dis_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '拼团团长优惠信息',
  `salesarray` text NOT NULL COMMENT '业务员数组',
  `redpackid` int(11) NOT NULL COMMENT '使用的红包id',
  `redpackmoney` decimal(10,2) NOT NULL COMMENT '红包减免金额',
  `vipdiscount` decimal(10,2) NOT NULL COMMENT '会员折扣金额',
  `expressprcie` decimal(10,2) NOT NULL COMMENT '配送费',
  `paylogid` int(11) NOT NULL COMMENT 'paylog表中的id',
  `deliverytype` int(11) NOT NULL COMMENT '同城配送收货方式',
  `makeorderno` varchar(145) NOT NULL COMMENT '三方跑腿系统订单号',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `fullreducemoney` decimal(10,2) NOT NULL COMMENT '满减金额',
  `retype` int(11) NOT NULL COMMENT 'v3申请退款渠道 1原路 2余额',
  `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付的余额',
  `paysetid` int(11) NOT NULL COMMENT '支付商户设置id',
  `allocationtype` int(11) NOT NULL COMMENT '分账方式 0平台系统 1服务商分账',
  `drawid` int(11) NOT NULL COMMENT '抽奖记录id',
  `packingmoney` decimal(10,2) NOT NULL COMMENT '同城配送包装费',
  `moinfo` text NOT NULL COMMENT '额外内容',
  `uuaexpressprice` decimal(10,2) NOT NULL COMMENT 'UU的总配送费',
  `redpagstatus` tinyint(1) DEFAULT '0' COMMENT '定制内容 红包返现 1待返现 2已返现',
  `pftinfo` text COMMENT '票付通提交信息',
  `pftorderinfo` text COMMENT '票付通订单信息',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=355 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_order','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号ID'");}
if(!pdo_fieldexists('ims_wlmerchant_order','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_order','fkid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `fkid` int(11) NOT NULL COMMENT '商品关联ID'");}
if(!pdo_fieldexists('ims_wlmerchant_order','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `status` int(11) NOT NULL COMMENT '状态 0未支付 1已支付 2已消费 3已完成 4待收货 待消费 5已取消 6待退款 7已退款  8待发货'");}
if(!pdo_fieldexists('ims_wlmerchant_order','oprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `oprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价'");}
if(!pdo_fieldexists('ims_wlmerchant_order','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `num` int(11) NOT NULL COMMENT '购买数量'");}
if(!pdo_fieldexists('ims_wlmerchant_order','paytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `paytime` varchar(145) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `paytype` int(11) NOT NULL COMMENT '支付方式 1余额 2微信3支付宝'");}
if(!pdo_fieldexists('ims_wlmerchant_order','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `createtime` varchar(145) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `remark` text NOT NULL COMMENT '卖家备注'");}
if(!pdo_fieldexists('ims_wlmerchant_order','issettlement')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `issettlement` int(11) NOT NULL DEFAULT '0' COMMENT '1已结算'");}
if(!pdo_fieldexists('ims_wlmerchant_order','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件'");}
if(!pdo_fieldexists('ims_wlmerchant_order','payfor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `payfor` varchar(32) NOT NULL COMMENT '干什么支付'");}
if(!pdo_fieldexists('ims_wlmerchant_order','is_usecard')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `is_usecard` tinyint(3) NOT NULL COMMENT '1使用优惠'");}
if(!pdo_fieldexists('ims_wlmerchant_order','card_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `card_type` tinyint(3) NOT NULL COMMENT '优惠类型'");}
if(!pdo_fieldexists('ims_wlmerchant_order','card_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `card_id` int(3) NOT NULL COMMENT '优惠ID'");}
if(!pdo_fieldexists('ims_wlmerchant_order','card_fee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `card_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `transid` varchar(145) NOT NULL COMMENT '微信订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_order','buyremark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `buyremark` text NOT NULL COMMENT '买家备注'");}
if(!pdo_fieldexists('ims_wlmerchant_order','spec')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `spec` text NOT NULL COMMENT '规格名'");}
if(!pdo_fieldexists('ims_wlmerchant_order','fightstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `fightstatus` int(11) NOT NULL COMMENT '1=发帖，2=置顶，3=红包\n0=核销 1商户配送 2平台配送\n1=黄页认领 2=黄页查看 3=黄页入驻\n家政：1=服务订单 2=服务者入驻 3=需求发布 4=需求置顶 5=需求刷新 '");}
if(!pdo_fieldexists('ims_wlmerchant_order','fightgroupid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `fightgroupid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_order','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `expressid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_order','recordid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `recordid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_order','refundtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `refundtime` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_order','applyrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `applyrefund` int(11) NOT NULL DEFAULT '0' COMMENT '申请退款'");}
if(!pdo_fieldexists('ims_wlmerchant_order','applytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `applytime` varchar(145) NOT NULL COMMENT '申请退款时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','disorderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `disorderid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_order','failtimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `failtimes` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_order','vipbuyflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `vipbuyflag` int(11) NOT NULL COMMENT '会员购买表示 1会员购买 0普通购买 '");}
if(!pdo_fieldexists('ims_wlmerchant_order','specid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `specid` int(11) NOT NULL COMMENT '规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `mobile` varchar(32) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_order','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `name` varchar(125) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_order','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `address` text NOT NULL COMMENT '地址'");}
if(!pdo_fieldexists('ims_wlmerchant_order','paidprid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `paidprid` int(11) NOT NULL COMMENT '支付有礼记录id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','shareid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `shareid` int(11) NOT NULL COMMENT '分享有礼记录id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','goodsprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `goodsprice` decimal(10,2) NOT NULL COMMENT '商品金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','overtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `overtime` int(11) NOT NULL COMMENT '标记过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','changedispatchprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `changedispatchprice` decimal(10,2) NOT NULL COMMENT '订单改运费'");}
if(!pdo_fieldexists('ims_wlmerchant_order','changeprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `changeprice` decimal(10,2) NOT NULL COMMENT '订单改价'");}
if(!pdo_fieldexists('ims_wlmerchant_order','originalprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `originalprice` decimal(10,2) NOT NULL COMMENT '改价之前的原始价'");}
if(!pdo_fieldexists('ims_wlmerchant_order','estimatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `estimatetime` int(11) NOT NULL COMMENT '预计过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','package')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `package` tinyint(2) NOT NULL COMMENT '订单为帖子中的发送红包订单时，这里储存的是红包个数'");}
if(!pdo_fieldexists('ims_wlmerchant_order','vip_card_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `vip_card_id` int(11) NOT NULL COMMENT '储存用户在购买当前商品时开通的会员卡的id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','redisstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `redisstatus` tinyint(10) NOT NULL COMMENT '退款分销订单状态修改'");}
if(!pdo_fieldexists('ims_wlmerchant_order','neworderflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `neworderflag` tinyint(1) NOT NULL COMMENT '新订单标志'");}
if(!pdo_fieldexists('ims_wlmerchant_order','reportid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `reportid` int(11) NOT NULL COMMENT '报表id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','settletime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `settletime` int(11) NOT NULL COMMENT '结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','usecredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `usecredit` decimal(10,2) NOT NULL COMMENT '使用的积分'");}
if(!pdo_fieldexists('ims_wlmerchant_order','cerditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `cerditmoney` decimal(10,2) NOT NULL COMMENT '积分抵扣的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','canceltime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `canceltime` int(11) NOT NULL COMMENT '预计取消时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','remindtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `remindtime` int(11) NOT NULL COMMENT '过期提醒时间'");}
if(!pdo_fieldexists('ims_wlmerchant_order','cutoffnotice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `cutoffnotice` int(11) NOT NULL COMMENT '是否发送过期通知'");}
if(!pdo_fieldexists('ims_wlmerchant_order','com_dis_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `com_dis_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '拼团团长优惠信息'");}
if(!pdo_fieldexists('ims_wlmerchant_order','salesarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `salesarray` text NOT NULL COMMENT '业务员数组'");}
if(!pdo_fieldexists('ims_wlmerchant_order','redpackid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `redpackid` int(11) NOT NULL COMMENT '使用的红包id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','redpackmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `redpackmoney` decimal(10,2) NOT NULL COMMENT '红包减免金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','vipdiscount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `vipdiscount` decimal(10,2) NOT NULL COMMENT '会员折扣金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','expressprcie')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `expressprcie` decimal(10,2) NOT NULL COMMENT '配送费'");}
if(!pdo_fieldexists('ims_wlmerchant_order','paylogid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `paylogid` int(11) NOT NULL COMMENT 'paylog表中的id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','deliverytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `deliverytype` int(11) NOT NULL COMMENT '同城配送收货方式'");}
if(!pdo_fieldexists('ims_wlmerchant_order','makeorderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `makeorderno` varchar(145) NOT NULL COMMENT '三方跑腿系统订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_order','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','fullreducemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `fullreducemoney` decimal(10,2) NOT NULL COMMENT '满减金额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','retype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `retype` int(11) NOT NULL COMMENT 'v3申请退款渠道 1原路 2余额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','blendcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付的余额'");}
if(!pdo_fieldexists('ims_wlmerchant_order','paysetid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `paysetid` int(11) NOT NULL COMMENT '支付商户设置id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','allocationtype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `allocationtype` int(11) NOT NULL COMMENT '分账方式 0平台系统 1服务商分账'");}
if(!pdo_fieldexists('ims_wlmerchant_order','drawid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `drawid` int(11) NOT NULL COMMENT '抽奖记录id'");}
if(!pdo_fieldexists('ims_wlmerchant_order','packingmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `packingmoney` decimal(10,2) NOT NULL COMMENT '同城配送包装费'");}
if(!pdo_fieldexists('ims_wlmerchant_order','moinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `moinfo` text NOT NULL COMMENT '额外内容'");}
if(!pdo_fieldexists('ims_wlmerchant_order','uuaexpressprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `uuaexpressprice` decimal(10,2) NOT NULL COMMENT 'UU的总配送费'");}
if(!pdo_fieldexists('ims_wlmerchant_order','redpagstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `redpagstatus` tinyint(1) DEFAULT '0' COMMENT '定制内容 红包返现 1待返现 2已返现'");}
if(!pdo_fieldexists('ims_wlmerchant_order','pftinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `pftinfo` text COMMENT '票付通提交信息'");}
if(!pdo_fieldexists('ims_wlmerchant_order','pftorderinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   `pftorderinfo` text COMMENT '票付通订单信息'");}
if(!pdo_fieldexists('ims_wlmerchant_order','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_order','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_order','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   KEY `idx_mid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_order','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_order','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_order')." ADD   KEY `idx_sid` (`sid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `merchantid` int(11) NOT NULL COMMENT '商户id',
  `status` int(11) NOT NULL COMMENT '状态',
  `title` varchar(145) NOT NULL COMMENT '礼包标题',
  `price` int(11) NOT NULL COMMENT '礼包价值',
  `datestatus` int(11) NOT NULL COMMENT '循环周期 1无 2每周 3每月 4每年',
  `usetimes` int(11) NOT NULL COMMENT '周期内使用次数',
  `limit` varchar(225) NOT NULL COMMENT '副标题（使用限制）',
  `timeslimit` int(11) NOT NULL COMMENT '单日提供数量',
  `allnum` int(11) NOT NULL COMMENT '总数量',
  `starttime` int(11) NOT NULL COMMENT '活动开始时间',
  `endtime` int(11) NOT NULL COMMENT '活动结束时间',
  `appointment` int(11) NOT NULL COMMENT '提前预约',
  `integral` int(11) NOT NULL COMMENT '赠送积分',
  `sort` int(11) NOT NULL COMMENT '排序',
  `pv` int(11) NOT NULL COMMENT '人气',
  `describe` text NOT NULL COMMENT '说明',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `timestatus` int(11) NOT NULL COMMENT '开卡时间限制',
  `level` text NOT NULL COMMENT '限制等级',
  `packtimestatus` int(11) NOT NULL COMMENT '活动时间限制',
  `datestarttime` int(11) NOT NULL COMMENT '活动开始时间',
  `dateendtime` int(11) NOT NULL COMMENT '活动结束时间',
  `oplimit` int(11) NOT NULL COMMENT '单人单日使用次数',
  `resetswitch` int(11) NOT NULL COMMENT '重置开关',
  `listshow` int(11) NOT NULL COMMENT '列表显示开关 0显示 1不显示',
  `weeklimit` int(11) NOT NULL COMMENT '单人单周使用次数限制',
  `monthlimit` int(11) NOT NULL COMMENT '单人单月使用次数限制',
  `type` int(11) NOT NULL COMMENT '一般礼包0 外链礼包1',
  `extlink` varchar(255) NOT NULL COMMENT '外部链接',
  `extinfo` text NOT NULL COMMENT '外链信息',
  `storemoney` decimal(10,2) NOT NULL COMMENT '结算给商户的金额',
  `usedatestatus` int(11) NOT NULL COMMENT '是否开启限时使用\n1按星期 2按天数 0关闭',
  `week` text NOT NULL COMMENT '活动时间 按周',
  `day` text NOT NULL COMMENT '活动时间 按月天数',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_listshow` (`listshow`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_package','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_package','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_package','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_package','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `merchantid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_package','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `status` int(11) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_package','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `title` varchar(145) NOT NULL COMMENT '礼包标题'");}
if(!pdo_fieldexists('ims_wlmerchant_package','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `price` int(11) NOT NULL COMMENT '礼包价值'");}
if(!pdo_fieldexists('ims_wlmerchant_package','datestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `datestatus` int(11) NOT NULL COMMENT '循环周期 1无 2每周 3每月 4每年'");}
if(!pdo_fieldexists('ims_wlmerchant_package','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `usetimes` int(11) NOT NULL COMMENT '周期内使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_package','limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `limit` varchar(225) NOT NULL COMMENT '副标题（使用限制）'");}
if(!pdo_fieldexists('ims_wlmerchant_package','timeslimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `timeslimit` int(11) NOT NULL COMMENT '单日提供数量'");}
if(!pdo_fieldexists('ims_wlmerchant_package','allnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `allnum` int(11) NOT NULL COMMENT '总数量'");}
if(!pdo_fieldexists('ims_wlmerchant_package','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `starttime` int(11) NOT NULL COMMENT '活动开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_package','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `endtime` int(11) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_package','appointment')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `appointment` int(11) NOT NULL COMMENT '提前预约'");}
if(!pdo_fieldexists('ims_wlmerchant_package','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `integral` int(11) NOT NULL COMMENT '赠送积分'");}
if(!pdo_fieldexists('ims_wlmerchant_package','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_package','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `pv` int(11) NOT NULL COMMENT '人气'");}
if(!pdo_fieldexists('ims_wlmerchant_package','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `describe` text NOT NULL COMMENT '说明'");}
if(!pdo_fieldexists('ims_wlmerchant_package','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_package','timestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `timestatus` int(11) NOT NULL COMMENT '开卡时间限制'");}
if(!pdo_fieldexists('ims_wlmerchant_package','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `level` text NOT NULL COMMENT '限制等级'");}
if(!pdo_fieldexists('ims_wlmerchant_package','packtimestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `packtimestatus` int(11) NOT NULL COMMENT '活动时间限制'");}
if(!pdo_fieldexists('ims_wlmerchant_package','datestarttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `datestarttime` int(11) NOT NULL COMMENT '活动开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_package','dateendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `dateendtime` int(11) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_package','oplimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `oplimit` int(11) NOT NULL COMMENT '单人单日使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_package','resetswitch')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `resetswitch` int(11) NOT NULL COMMENT '重置开关'");}
if(!pdo_fieldexists('ims_wlmerchant_package','listshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `listshow` int(11) NOT NULL COMMENT '列表显示开关 0显示 1不显示'");}
if(!pdo_fieldexists('ims_wlmerchant_package','weeklimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `weeklimit` int(11) NOT NULL COMMENT '单人单周使用次数限制'");}
if(!pdo_fieldexists('ims_wlmerchant_package','monthlimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `monthlimit` int(11) NOT NULL COMMENT '单人单月使用次数限制'");}
if(!pdo_fieldexists('ims_wlmerchant_package','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `type` int(11) NOT NULL COMMENT '一般礼包0 外链礼包1'");}
if(!pdo_fieldexists('ims_wlmerchant_package','extlink')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `extlink` varchar(255) NOT NULL COMMENT '外部链接'");}
if(!pdo_fieldexists('ims_wlmerchant_package','extinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `extinfo` text NOT NULL COMMENT '外链信息'");}
if(!pdo_fieldexists('ims_wlmerchant_package','storemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `storemoney` decimal(10,2) NOT NULL COMMENT '结算给商户的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_package','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `usedatestatus` int(11) NOT NULL COMMENT '是否开启限时使用\n1按星期 2按天数 0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_package','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `week` text NOT NULL COMMENT '活动时间 按周'");}
if(!pdo_fieldexists('ims_wlmerchant_package','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   `day` text NOT NULL COMMENT '活动时间 按月天数'");}
if(!pdo_fieldexists('ims_wlmerchant_package','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_package','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_package','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_package')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_paidrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `activeid` int(11) NOT NULL COMMENT '活动id',
  `integral` decimal(10,2) NOT NULL COMMENT '赠送积分',
  `couponid` varchar(255) NOT NULL COMMENT '赠送的优惠券id',
  `getcouflag` int(11) NOT NULL COMMENT '领取卡券标记',
  `getcoutime` int(11) NOT NULL COMMENT '领取优惠券时间',
  `codeid` int(11) NOT NULL COMMENT '赠送激活码id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `paytype` int(11) NOT NULL COMMENT '支付方式',
  `price` decimal(10,2) NOT NULL COMMENT '支付价格',
  `img` varchar(255) NOT NULL COMMENT '广告图片',
  `type` int(11) NOT NULL COMMENT '订单类型',
  `orderid` int(11) NOT NULL COMMENT '订单id',
  `redpackid` varchar(255) NOT NULL COMMENT '赠送红包id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='支付有礼记录表';

");

if(!pdo_fieldexists('ims_wlmerchant_paidrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','activeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `activeid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `integral` decimal(10,2) NOT NULL COMMENT '赠送积分'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','couponid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `couponid` varchar(255) NOT NULL COMMENT '赠送的优惠券id'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','getcouflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `getcouflag` int(11) NOT NULL COMMENT '领取卡券标记'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','getcoutime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `getcoutime` int(11) NOT NULL COMMENT '领取优惠券时间'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','codeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `codeid` int(11) NOT NULL COMMENT '赠送激活码id'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `paytype` int(11) NOT NULL COMMENT '支付方式'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `price` decimal(10,2) NOT NULL COMMENT '支付价格'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `img` varchar(255) NOT NULL COMMENT '广告图片'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `type` int(11) NOT NULL COMMENT '订单类型'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `orderid` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','redpackid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   `redpackid` varchar(255) NOT NULL COMMENT '赠送红包id'");}
if(!pdo_fieldexists('ims_wlmerchant_paidrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paidrecord')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_payactive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `orderprice` decimal(10,2) NOT NULL COMMENT '订单金额',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `userstatus` int(11) NOT NULL COMMENT '用户资格 0全部用户 1一卡通会员',
  `orderstatus` int(11) NOT NULL COMMENT '参与方式 0订单金额 1购买商品',
  `status` int(11) NOT NULL COMMENT '状态',
  `rushflag` int(11) NOT NULL COMMENT '抢购标志',
  `grouponflag` int(11) NOT NULL COMMENT '团购标识',
  `fightgroupflag` int(11) NOT NULL COMMENT '拼团标志',
  `couponflag` int(11) NOT NULL COMMENT '卡券标志',
  `halfcardflag` int(11) NOT NULL COMMENT '一卡通标志',
  `chargeflag` int(11) NOT NULL COMMENT '入驻标志',
  `rushids` text NOT NULL COMMENT '抢购商品id集',
  `grouponids` text NOT NULL COMMENT '团购商品id集',
  `fightgroupids` text NOT NULL COMMENT '拼团商品id集',
  `couponids` text NOT NULL COMMENT '卡券商品id集',
  `halfcardids` text NOT NULL COMMENT '一卡通商品id集',
  `chargeids` text NOT NULL COMMENT '付费入驻商品id集',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `integralrate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '赠送积分比例 金额',
  `giftstatus` int(11) NOT NULL COMMENT '赠品 0不赠送 1优惠券 2激活码',
  `giftcouponid` varchar(255) NOT NULL COMMENT '赠券id',
  `codereamrk` text NOT NULL COMMENT '激活码备注',
  `img` varchar(255) NOT NULL COMMENT '图片',
  `getstatus` int(11) NOT NULL COMMENT '0手动领取 1自动发放',
  `advurl` varchar(255) NOT NULL COMMENT '广告链接',
  `payonlineflag` int(11) NOT NULL COMMENT '在线买单',
  `integral` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '赠送积分比例 积分',
  `giftredpack` varchar(255) NOT NULL COMMENT '赠送红包',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='支付有礼活动表';

");

if(!pdo_fieldexists('ims_wlmerchant_payactive','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','orderprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `orderprice` decimal(10,2) NOT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `starttime` int(11) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `endtime` int(11) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','userstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `userstatus` int(11) NOT NULL COMMENT '用户资格 0全部用户 1一卡通会员'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','orderstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `orderstatus` int(11) NOT NULL COMMENT '参与方式 0订单金额 1购买商品'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `status` int(11) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','rushflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `rushflag` int(11) NOT NULL COMMENT '抢购标志'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','grouponflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `grouponflag` int(11) NOT NULL COMMENT '团购标识'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','fightgroupflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `fightgroupflag` int(11) NOT NULL COMMENT '拼团标志'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','couponflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `couponflag` int(11) NOT NULL COMMENT '卡券标志'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','halfcardflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `halfcardflag` int(11) NOT NULL COMMENT '一卡通标志'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','chargeflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `chargeflag` int(11) NOT NULL COMMENT '入驻标志'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','rushids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `rushids` text NOT NULL COMMENT '抢购商品id集'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','grouponids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `grouponids` text NOT NULL COMMENT '团购商品id集'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','fightgroupids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `fightgroupids` text NOT NULL COMMENT '拼团商品id集'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','couponids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `couponids` text NOT NULL COMMENT '卡券商品id集'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','halfcardids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `halfcardids` text NOT NULL COMMENT '一卡通商品id集'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','chargeids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `chargeids` text NOT NULL COMMENT '付费入驻商品id集'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','integralrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `integralrate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '赠送积分比例 金额'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','giftstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `giftstatus` int(11) NOT NULL COMMENT '赠品 0不赠送 1优惠券 2激活码'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','giftcouponid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `giftcouponid` varchar(255) NOT NULL COMMENT '赠券id'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','codereamrk')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `codereamrk` text NOT NULL COMMENT '激活码备注'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `img` varchar(255) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','getstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `getstatus` int(11) NOT NULL COMMENT '0手动领取 1自动发放'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','advurl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `advurl` varchar(255) NOT NULL COMMENT '广告链接'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','payonlineflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `payonlineflag` int(11) NOT NULL COMMENT '在线买单'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `integral` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '赠送积分比例 积分'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','giftredpack')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   `giftredpack` varchar(255) NOT NULL COMMENT '赠送红包'");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_payactive','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payactive')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_payback_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号',
  `rate` decimal(10,2) NOT NULL COMMENT '返现比例',
  `bank` varchar(128) NOT NULL COMMENT '银行名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_payback_bank','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_bank')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_payback_bank','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_bank')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_bank','rate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_bank')." ADD   `rate` decimal(10,2) NOT NULL COMMENT '返现比例'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_bank','bank')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_bank')." ADD   `bank` varchar(128) NOT NULL COMMENT '银行名'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_payback_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `doid` int(11) NOT NULL COMMENT '操作员id',
  `mid` int(11) NOT NULL COMMENT '买家id',
  `plugin` varchar(32) NOT NULL COMMENT '订单所属插件',
  `backmoney` decimal(10,2) NOT NULL COMMENT '返现金额',
  `orderno` varchar(32) NOT NULL COMMENT '订单号',
  `remark` text NOT NULL COMMENT '备注',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `checkcode` int(11) NOT NULL COMMENT '核销码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_payback_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','doid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `doid` int(11) NOT NULL COMMENT '操作员id'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `mid` int(11) NOT NULL COMMENT '买家id'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `plugin` varchar(32) NOT NULL COMMENT '订单所属插件'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','backmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `backmoney` decimal(10,2) NOT NULL COMMENT '返现金额'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `orderno` varchar(32) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `remark` text NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_payback_record','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payback_record')." ADD   `checkcode` int(11) NOT NULL COMMENT '核销码'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_paylog` (
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL COMMENT '支付方式：1=余额；2=微信；3=支付宝；4=货到付款',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `acid` int(10) NOT NULL,
  `openid` varchar(64) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `tid` varchar(128) NOT NULL COMMENT '订单号',
  `fee` decimal(10,2) NOT NULL COMMENT '实际支付金额',
  `status` tinyint(4) NOT NULL COMMENT '0=未支付，1=已支付',
  `module` varchar(50) NOT NULL COMMENT '模块名称',
  `tag` varchar(2000) NOT NULL,
  `is_usecard` tinyint(3) unsigned NOT NULL,
  `card_type` tinyint(3) unsigned NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `card_fee` decimal(10,2) unsigned NOT NULL,
  `encrypt_code` varchar(100) NOT NULL,
  `plugin` varchar(50) NOT NULL COMMENT '插件名',
  `payfor` varchar(145) NOT NULL COMMENT '干什么支付',
  `transaction_id` varchar(100) NOT NULL COMMENT '第三方交易号',
  `pay_order_no` varchar(128) DEFAULT NULL COMMENT '当前订单支付时使用的订单号（退款必须）',
  `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付渠道 1=公众号（默认）；2=h5；3=小程序',
  `mid` varchar(11) NOT NULL COMMENT '购买用户id',
  PRIMARY KEY (`plid`),
  KEY `idx_tid` (`tid`),
  KEY `idx_openid` (`mid`),
  KEY `idx_uniontid` (`uniontid`)
) ENGINE=InnoDB AUTO_INCREMENT=623 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_paylog','plid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD 
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `type` varchar(20) NOT NULL COMMENT '支付方式：1=余额；2=微信；3=支付宝；4=货到付款'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','acid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `acid` int(10) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `openid` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','uniontid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `uniontid` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `tid` varchar(128) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','fee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `fee` decimal(10,2) NOT NULL COMMENT '实际支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `status` tinyint(4) NOT NULL COMMENT '0=未支付，1=已支付'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','module')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `module` varchar(50) NOT NULL COMMENT '模块名称'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `tag` varchar(2000) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','is_usecard')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `is_usecard` tinyint(3) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','card_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `card_type` tinyint(3) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','card_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `card_id` varchar(50) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','card_fee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `card_fee` decimal(10,2) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','encrypt_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `encrypt_code` varchar(100) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `plugin` varchar(50) NOT NULL COMMENT '插件名'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','payfor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `payfor` varchar(145) NOT NULL COMMENT '干什么支付'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','transaction_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `transaction_id` varchar(100) NOT NULL COMMENT '第三方交易号'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','pay_order_no')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `pay_order_no` varchar(128) DEFAULT NULL COMMENT '当前订单支付时使用的订单号（退款必须）'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付渠道 1=公众号（默认）；2=h5；3=小程序'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   `mid` varchar(11) NOT NULL COMMENT '购买用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','plid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   PRIMARY KEY (`plid`)");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','idx_tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   KEY `idx_tid` (`tid`)");}
if(!pdo_fieldexists('ims_wlmerchant_paylog','idx_openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylog')." ADD   KEY `idx_openid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_paylogvfour` (
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(100) NOT NULL COMMENT '第三方交易号',
  `pay_order_no` varchar(128) DEFAULT NULL COMMENT '当前订单支付时使用的订单号（退款必须）',
  `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付渠道 1=公众号（默认）；2=h5；3=小程序',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `mid` varchar(11) NOT NULL COMMENT '购买用户id',
  `tid` varchar(128) NOT NULL COMMENT '订单号',
  `fee` decimal(10,2) NOT NULL COMMENT '实际支付金额',
  `status` tinyint(4) NOT NULL COMMENT '0=未支付，1=已支付',
  `module` varchar(50) NOT NULL COMMENT '模块名称',
  `plugin` varchar(50) NOT NULL COMMENT '插件名',
  `payfor` varchar(145) NOT NULL COMMENT '干什么支付',
  `type` varchar(20) NOT NULL COMMENT '支付方式：1=余额；2=微信；3=支付宝；4=货到付款',
  `encrypt_code` varchar(100) NOT NULL,
  `card_fee` decimal(10,2) unsigned NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `is_usecard` tinyint(3) unsigned NOT NULL,
  `card_type` tinyint(3) unsigned NOT NULL,
  `tag` varchar(2000) NOT NULL,
  `acid` int(10) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `openid` varchar(64) NOT NULL,
  `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付的余额',
  `batchNo` varchar(11) DEFAULT NULL COMMENT '批次号',
  `traceNo` varchar(11) DEFAULT NULL COMMENT '系统跟踪号',
  PRIMARY KEY (`plid`),
  KEY `idx_openid` (`mid`),
  KEY `idx_tid` (`tid`),
  KEY `idx_uniontid` (`uniontid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','plid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD 
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','transaction_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `transaction_id` varchar(100) NOT NULL COMMENT '第三方交易号'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','pay_order_no')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `pay_order_no` varchar(128) DEFAULT NULL COMMENT '当前订单支付时使用的订单号（退款必须）'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付渠道 1=公众号（默认）；2=h5；3=小程序'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `mid` varchar(11) NOT NULL COMMENT '购买用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `tid` varchar(128) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','fee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `fee` decimal(10,2) NOT NULL COMMENT '实际支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `status` tinyint(4) NOT NULL COMMENT '0=未支付，1=已支付'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','module')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `module` varchar(50) NOT NULL COMMENT '模块名称'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `plugin` varchar(50) NOT NULL COMMENT '插件名'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','payfor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `payfor` varchar(145) NOT NULL COMMENT '干什么支付'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `type` varchar(20) NOT NULL COMMENT '支付方式：1=余额；2=微信；3=支付宝；4=货到付款'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','encrypt_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `encrypt_code` varchar(100) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','card_fee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `card_fee` decimal(10,2) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','card_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `card_id` varchar(50) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','is_usecard')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `is_usecard` tinyint(3) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','card_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `card_type` tinyint(3) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `tag` varchar(2000) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','acid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `acid` int(10) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','uniontid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `uniontid` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `openid` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','blendcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付的余额'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','batchNo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `batchNo` varchar(11) DEFAULT NULL COMMENT '批次号'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','traceNo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   `traceNo` varchar(11) DEFAULT NULL COMMENT '系统跟踪号'");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','plid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   PRIMARY KEY (`plid`)");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','idx_openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   KEY `idx_openid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_paylogvfour','idx_tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_paylogvfour')." ADD   KEY `idx_tid` (`tid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL COMMENT '名称',
  `type` tinyint(1) NOT NULL COMMENT '支付类型1微信支付2支付宝支付',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1启用 0 未启用',
  `param` text NOT NULL COMMENT '支付参数',
  `create_time` int(11) NOT NULL,
  `aid` int(11) NOT NULL COMMENT '所属的aid',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_payment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_payment','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_payment','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `name` varchar(32) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_payment','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `type` tinyint(1) NOT NULL COMMENT '支付类型1微信支付2支付宝支付'");}
if(!pdo_fieldexists('ims_wlmerchant_payment','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `status` int(11) NOT NULL DEFAULT '0' COMMENT '1启用 0 未启用'");}
if(!pdo_fieldexists('ims_wlmerchant_payment','param')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `param` text NOT NULL COMMENT '支付参数'");}
if(!pdo_fieldexists('ims_wlmerchant_payment','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `create_time` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_payment','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   `aid` int(11) NOT NULL COMMENT '所属的aid'");}
if(!pdo_fieldexists('ims_wlmerchant_payment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_payment','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_payment')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_perm_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `plugins` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_perm_account','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_perm_account')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_perm_account','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_perm_account')." ADD   `uniacid` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_perm_account','plugins')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_perm_account')." ADD   `plugins` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_perm_account','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_perm_account')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pincode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(32) NOT NULL COMMENT '电话',
  `time` int(11) NOT NULL COMMENT '时间',
  `code` int(11) NOT NULL COMMENT '验证码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pincode','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pincode')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pincode','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pincode')." ADD   `mobile` varchar(32) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_pincode','time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pincode')." ADD   `time` int(11) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('ims_wlmerchant_pincode','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pincode')." ADD   `code` int(11) NOT NULL COMMENT '验证码'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_plugin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '标识',
  `type` varchar(20) NOT NULL COMMENT '类型',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `ability` varchar(255) NOT NULL COMMENT '简介',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_status` (`status`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_plugin','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `name` varchar(100) NOT NULL COMMENT '标识'");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `type` varchar(20) NOT NULL COMMENT '类型'");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `title` varchar(100) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `thumb` varchar(255) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','ability')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `ability` varchar(255) NOT NULL COMMENT '简介'");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','displayorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','idx_name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   KEY `idx_name` (`name`)");}
if(!pdo_fieldexists('ims_wlmerchant_plugin','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_plugin')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `inid` int(11) NOT NULL COMMENT '帖子ID',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','inid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   `inid` int(11) NOT NULL COMMENT '帖子ID'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   `createtime` varchar(145) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_blacklist','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_blacklist')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL COMMENT '代理id',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `tid` int(11) NOT NULL COMMENT '帖子的id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `create_time` varchar(15) DEFAULT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_collection','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_collection')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_collection','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_collection')." ADD   `aid` int(11) DEFAULT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_collection','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_collection')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_collection','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_collection')." ADD   `tid` int(11) NOT NULL COMMENT '帖子的id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_collection','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_collection')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_collection','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_collection')." ADD   `create_time` varchar(15) DEFAULT NULL COMMENT '收藏时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `tid` int(11) NOT NULL COMMENT 'infor表id',
  `content` text NOT NULL,
  `mid` int(11) NOT NULL,
  `createtime` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否审核通过（0=待审核，1=通过，2=未通过）',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_tid` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `tid` int(11) NOT NULL COMMENT 'infor表id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `content` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `createtime` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否审核通过（0=待审核，1=通过，2=未通过）'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_comment','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_comment')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` varchar(32) NOT NULL COMMENT '0 显示，1 审核中 2 不显示 3已删除 5未支付',
  `content` text NOT NULL,
  `img` text NOT NULL,
  `mid` int(11) NOT NULL,
  `top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶 1 置顶 0不置顶',
  `look` int(11) NOT NULL COMMENT '浏览量',
  `likenum` int(11) NOT NULL COMMENT '点赞数',
  `share` int(11) NOT NULL COMMENT '分享数',
  `endtime` varchar(32) NOT NULL COMMENT '结束时间',
  `onetype` int(11) NOT NULL COMMENT '一级分类',
  `type` int(11) NOT NULL COMMENT '二级分类',
  `nickname` varchar(255) NOT NULL COMMENT '联系人姓名',
  `phone` varchar(32) NOT NULL COMMENT '电话',
  `createtime` varchar(32) NOT NULL COMMENT '创建时间',
  `likeids` text COMMENT '点赞人id',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `share_title` varchar(255) DEFAULT NULL COMMENT '分享标题',
  `keyword` text NOT NULL COMMENT '关键词',
  `reason` varchar(255) NOT NULL COMMENT '驳回理由',
  `redpack` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '红包',
  `sredpack` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '剩余红包',
  `package` tinyint(2) NOT NULL COMMENT '红包的个数',
  `redpackstatus` int(11) NOT NULL COMMENT '红包支付状态 0未支付 1已支付',
  `location` varchar(255) NOT NULL COMMENT '定位',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `locastatus` int(11) NOT NULL COMMENT '定位开关 1开启 0关闭',
  `video_link` varchar(255) DEFAULT NULL COMMENT '视频路径',
  `replytime` int(11) NOT NULL COMMENT '最新回复时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_top` (`top`)
) ENGINE=InnoDB AUTO_INCREMENT=991 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `status` varchar(32) NOT NULL COMMENT '0 显示，1 审核中 2 不显示 3已删除 5未支付'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `content` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `img` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','top')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶 1 置顶 0不置顶'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','look')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `look` int(11) NOT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','likenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `likenum` int(11) NOT NULL COMMENT '点赞数'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','share')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `share` int(11) NOT NULL COMMENT '分享数'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `endtime` varchar(32) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','onetype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `onetype` int(11) NOT NULL COMMENT '一级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `type` int(11) NOT NULL COMMENT '二级分类'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `nickname` varchar(255) NOT NULL COMMENT '联系人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','phone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `phone` varchar(32) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `createtime` varchar(32) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','likeids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `likeids` text COMMENT '点赞人id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `avatar` varchar(255) DEFAULT NULL COMMENT '头像'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `share_title` varchar(255) DEFAULT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','keyword')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `keyword` text NOT NULL COMMENT '关键词'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `reason` varchar(255) NOT NULL COMMENT '驳回理由'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','redpack')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `redpack` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '红包'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','sredpack')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `sredpack` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '剩余红包'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','package')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `package` tinyint(2) NOT NULL COMMENT '红包的个数'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','redpackstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `redpackstatus` int(11) NOT NULL COMMENT '红包支付状态 0未支付 1已支付'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','location')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `location` varchar(255) NOT NULL COMMENT '定位'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `address` varchar(255) NOT NULL COMMENT '地址'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','locastatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `locastatus` int(11) NOT NULL COMMENT '定位开关 1开启 0关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','video_link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `video_link` varchar(255) DEFAULT NULL COMMENT '视频路径'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','replytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   `replytime` int(11) NOT NULL COMMENT '最新回复时间'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_informations','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_informations')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT '评论id',
  `smid` int(11) NOT NULL COMMENT '发送人mid',
  `amid` int(11) NOT NULL COMMENT '回复人id',
  `content` varchar(255) NOT NULL COMMENT '帖子内容',
  `createtime` varchar(32) NOT NULL,
  `tid` int(11) NOT NULL COMMENT '帖子id',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否审核通过（0=待审核，1=通过，2=未通过）',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_tid` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','cid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `cid` int(11) NOT NULL COMMENT '评论id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','smid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `smid` int(11) NOT NULL COMMENT '发送人mid'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','amid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `amid` int(11) NOT NULL COMMENT '回复人id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `content` varchar(255) NOT NULL COMMENT '帖子内容'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `createtime` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `tid` int(11) NOT NULL COMMENT '帖子id'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   `status` tinyint(1) DEFAULT '1' COMMENT '是否审核通过（0=待审核，1=通过，2=未通过）'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_reply','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_reply')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `img` varchar(300) NOT NULL,
  `title` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sort` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(300) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `img` varchar(300) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `title` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `status` tinyint(1) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `sort` tinyint(1) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `url` varchar(300) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_slide','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_slide')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_pocket_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 启用',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `img` varchar(300) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '默认 0 为一级分类，否则为一级分类的ID',
  `price` decimal(10,2) NOT NULL COMMENT '付费价格',
  `color` varchar(32) NOT NULL COMMENT '标题颜色',
  `url` varchar(300) NOT NULL COMMENT '链接',
  `isnav` int(11) NOT NULL DEFAULT '0' COMMENT '是否为导航栏',
  `aid` int(11) NOT NULL,
  `keyword` text NOT NULL COMMENT '关键字\n',
  `isdistri` tinyint(1) NOT NULL COMMENT '是否分销0是1否默认开启',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销金额',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销金额',
  `adv` text NOT NULL COMMENT '幻灯片',
  `vipstatus` tinyint(1) NOT NULL COMMENT '会员特权 0无 1特价 2特供',
  `vipprice` decimal(10,2) NOT NULL COMMENT '会员价',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_sort` (`sort`),
  KEY `idx_isnav` (`isnav`)
) ENGINE=InnoDB AUTO_INCREMENT=290 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_pocket_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `title` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 启用'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `img` varchar(300) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `type` int(11) NOT NULL DEFAULT '0' COMMENT '默认 0 为一级分类，否则为一级分类的ID'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `price` decimal(10,2) NOT NULL COMMENT '付费价格'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `color` varchar(32) NOT NULL COMMENT '标题颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','url')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `url` varchar(300) NOT NULL COMMENT '链接'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','isnav')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `isnav` int(11) NOT NULL DEFAULT '0' COMMENT '是否为导航栏'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','keyword')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `keyword` text NOT NULL COMMENT '关键字\n'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `isdistri` tinyint(1) NOT NULL COMMENT '是否分销0是1否默认开启'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销金额'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','adv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `adv` text NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `vipstatus` tinyint(1) NOT NULL COMMENT '会员特权 0无 1特价 2特供'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   `vipprice` decimal(10,2) NOT NULL COMMENT '会员价'");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_pocket_type','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_pocket_type')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_poster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '1商家2抢购3卡券4分销5团购6拼团7砍价8业务员',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `bg` varchar(255) NOT NULL COMMENT '默认背景',
  `data` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `otherbg` text NOT NULL COMMENT '其他背景',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_poster','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_poster','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_poster','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '1商家2抢购3卡券4分销5团购6拼团7砍价8业务员'");}
if(!pdo_fieldexists('ims_wlmerchant_poster','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('ims_wlmerchant_poster','bg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `bg` varchar(255) NOT NULL COMMENT '默认背景'");}
if(!pdo_fieldexists('ims_wlmerchant_poster','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `data` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_poster','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `createtime` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_poster','otherbg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   `otherbg` text NOT NULL COMMENT '其他背景'");}
if(!pdo_fieldexists('ims_wlmerchant_poster','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_poster','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_poster','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_poster')." ADD   KEY `idx_type` (`type`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_puv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `areaid` int(11) NOT NULL COMMENT '地区id',
  `uniacid` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  `uv` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=1601 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_puv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_puv','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD   `areaid` int(11) NOT NULL COMMENT '地区id'");}
if(!pdo_fieldexists('ims_wlmerchant_puv','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puv','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD   `pv` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puv','uv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD   `uv` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puv','date')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD   `date` varchar(20) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puv')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_puvrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `areaid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=13549 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_puvrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   `pv` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','date')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   `date` varchar(20) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   `areaid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_puvrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_puvrecord')." ADD   KEY `uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_qrcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商户ID',
  `qrid` int(10) unsigned NOT NULL,
  `model` tinyint(1) NOT NULL,
  `cardsn` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL COMMENT '加密盐',
  `status` tinyint(1) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `remark` varchar(50) NOT NULL COMMENT '场景备注',
  `type` tinyint(1) NOT NULL COMMENT '0商户二维码1分销二维码2商品关注二维码',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_qrid` (`qrid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_qrcode','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `aid` int(10) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `uniacid` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `sid` int(11) NOT NULL COMMENT '商户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','qrid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `qrid` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','model')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `model` tinyint(1) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','cardsn')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `cardsn` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','salt')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `salt` varchar(32) NOT NULL COMMENT '加密盐'");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `status` tinyint(1) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `createtime` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `remark` varchar(50) NOT NULL COMMENT '场景备注'");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   `type` tinyint(1) NOT NULL COMMENT '0商户二维码1分销二维码2商品关注二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode','idx_qrid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode')." ADD   KEY `idx_qrid` (`qrid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_qrcode_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `num` int(11) NOT NULL,
  `pnum` int(11) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `status` int(2) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `type` int(2) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `num` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','pnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `pnum` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `remark` varchar(100) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_qrcode_apply','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_qrcode_apply')." ADD   `createtime` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL COMMENT '排行榜名称',
  `type` tinyint(1) unsigned NOT NULL COMMENT '类型0用户1商户',
  `orderby` tinyint(1) unsigned NOT NULL COMMENT '排序方式：0=用户积分  1=用户余额  2=用户消费金额\n11=商户人气  12=商户订单数  13=商户营业额',
  `status` tinyint(1) unsigned NOT NULL COMMENT '0=禁用  1=启用',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `number` int(11) NOT NULL DEFAULT '10' COMMENT '排行榜显示数量 默认10',
  `bgimg` varchar(255) NOT NULL COMMENT '页面背景图',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='排行榜信息表';

");

if(!pdo_fieldexists('ims_wlmerchant_rank','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_rank','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rank','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `name` varchar(30) NOT NULL COMMENT '排行榜名称'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `type` tinyint(1) unsigned NOT NULL COMMENT '类型0用户1商户'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','orderby')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `orderby` tinyint(1) unsigned NOT NULL COMMENT '排序方式：0=用户积分  1=用户余额  2=用户消费金额\n11=商户人气  12=商户订单数  13=商户营业额'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `status` tinyint(1) unsigned NOT NULL COMMENT '0=禁用  1=启用'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `number` int(11) NOT NULL DEFAULT '10' COMMENT '排行榜显示数量 默认10'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','bgimg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   `bgimg` varchar(255) NOT NULL COMMENT '页面背景图'");}
if(!pdo_fieldexists('ims_wlmerchant_rank','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_rank','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rank')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_recruit_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '行业名称',
  `pid` int(11) DEFAULT '0' COMMENT '上级行业id',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD   `title` varchar(50) NOT NULL COMMENT '行业名称'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD   `pid` int(11) DEFAULT '0' COMMENT '上级行业id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_industry','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_industry')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_recruit_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '标签标题',
  `type` enum('1','2','3','4','5') DEFAULT NULL COMMENT '标签类型:1=学历要求,2=职位福利,3=经验标签,4=企业规模,5=企业性质',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_recruit_label','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_label','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_label','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_label','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD   `title` varchar(50) NOT NULL COMMENT '标签标题'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_label','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD   `type` enum('1','2','3','4','5') DEFAULT NULL COMMENT '标签类型:1=学历要求,2=职位福利,3=经验标签,4=企业规模,5=企业性质'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_label','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_label','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_label')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_recruit_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '职位名称',
  `industry_pid` int(11) NOT NULL COMMENT '行业id(一级行业id)',
  `industry_id` int(11) NOT NULL COMMENT '行业id(二级行业id)',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_recruit_position','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `title` varchar(50) NOT NULL COMMENT '职位名称'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','industry_pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `industry_pid` int(11) NOT NULL COMMENT '行业id(一级行业id)'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','industry_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `industry_id` int(11) NOT NULL COMMENT '行业id(二级行业id)'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_position','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_position')." ADD   `create_time` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_recruit_recruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '职位名称',
  `industry_pid` int(11) NOT NULL COMMENT '上级行业id',
  `industry_id` int(11) NOT NULL COMMENT '子行业id',
  `position_id` int(11) NOT NULL COMMENT '职位id',
  `recruitment_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '招聘类型:1=个人招聘,2=企业招聘',
  `release_mid` int(11) DEFAULT NULL COMMENT '发布用户id',
  `release_sid` int(11) DEFAULT NULL COMMENT '发布企业id',
  `job_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '工作类型：1=全职，2=兼职',
  `full_type` enum('1','2') DEFAULT NULL COMMENT '全职 - 薪资待遇：1=面议，2=指定',
  `full_salary_min` int(10) DEFAULT '0' COMMENT '全职 - 薪资待遇：最低薪资',
  `full_salary_max` int(10) DEFAULT '0' COMMENT '全职 - 薪资待遇：最高薪资',
  `welfare` varchar(255) DEFAULT NULL COMMENT '全职 - 职位福利',
  `part_type` enum('1','2') DEFAULT NULL COMMENT '兼职 - 薪资类型：1=元/时，2=元/天',
  `part_salary` int(10) DEFAULT '0' COMMENT '兼职 - 薪资金额',
  `part_settlement` enum('1','2','3','4') DEFAULT NULL COMMENT '兼职 - 结算方式：1=日结，2=周结，3=月结，4=完工结算',
  `work_province` int(11) DEFAULT NULL COMMENT '工作区域 - 省',
  `work_city` int(11) DEFAULT NULL COMMENT '工作区域 - 市',
  `work_area` int(11) DEFAULT NULL COMMENT '工作区域 - 区',
  `work_address` varchar(80) NOT NULL COMMENT '工作详细地址',
  `work_lng` varchar(20) NOT NULL COMMENT '经度',
  `work_lat` varchar(20) NOT NULL COMMENT '纬度',
  `contacts` varchar(50) NOT NULL COMMENT '联系人',
  `contact_phone` varchar(18) NOT NULL COMMENT '联系方式',
  `gender` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '性别要求：1=不限，2=男，3=女',
  `age_min` tinyint(2) NOT NULL COMMENT '最小年龄要求',
  `age_max` tinyint(2) NOT NULL COMMENT '最大年龄要求',
  `education_label_id` int(11) DEFAULT '0' COMMENT '学历要求',
  `experience_label_id` int(11) DEFAULT '0' COMMENT '经验要求',
  `status` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '招聘状态：1=待付款，2=审核中，3=未通过，4=招聘中，5=已结束',
  `job_description` text COMMENT '职位描述',
  `create_time` int(11) DEFAULT NULL COMMENT '发布时间',
  `sort` int(11) DEFAULT NULL COMMENT '排序信息',
  `pv` int(11) unsigned DEFAULT '0' COMMENT '浏览量',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '是否置顶:0=未置顶，1=置顶中',
  `top_end_time` int(11) DEFAULT '0' COMMENT '置顶结束时间',
  `people_number` tinyint(2) DEFAULT '1' COMMENT '招聘人数',
  `fictitious_pv` int(11) DEFAULT '0' COMMENT '虚拟浏览量',
  `reason` varchar(255) NOT NULL COMMENT '驳回原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `title` varchar(50) NOT NULL COMMENT '职位名称'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','industry_pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `industry_pid` int(11) NOT NULL COMMENT '上级行业id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','industry_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `industry_id` int(11) NOT NULL COMMENT '子行业id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','position_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `position_id` int(11) NOT NULL COMMENT '职位id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','recruitment_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `recruitment_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '招聘类型:1=个人招聘,2=企业招聘'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','release_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `release_mid` int(11) DEFAULT NULL COMMENT '发布用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','release_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `release_sid` int(11) DEFAULT NULL COMMENT '发布企业id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','job_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `job_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '工作类型：1=全职，2=兼职'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','full_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `full_type` enum('1','2') DEFAULT NULL COMMENT '全职 - 薪资待遇：1=面议，2=指定'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','full_salary_min')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `full_salary_min` int(10) DEFAULT '0' COMMENT '全职 - 薪资待遇：最低薪资'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','full_salary_max')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `full_salary_max` int(10) DEFAULT '0' COMMENT '全职 - 薪资待遇：最高薪资'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','welfare')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `welfare` varchar(255) DEFAULT NULL COMMENT '全职 - 职位福利'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','part_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `part_type` enum('1','2') DEFAULT NULL COMMENT '兼职 - 薪资类型：1=元/时，2=元/天'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','part_salary')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `part_salary` int(10) DEFAULT '0' COMMENT '兼职 - 薪资金额'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','part_settlement')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `part_settlement` enum('1','2','3','4') DEFAULT NULL COMMENT '兼职 - 结算方式：1=日结，2=周结，3=月结，4=完工结算'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','work_province')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `work_province` int(11) DEFAULT NULL COMMENT '工作区域 - 省'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','work_city')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `work_city` int(11) DEFAULT NULL COMMENT '工作区域 - 市'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','work_area')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `work_area` int(11) DEFAULT NULL COMMENT '工作区域 - 区'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','work_address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `work_address` varchar(80) NOT NULL COMMENT '工作详细地址'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','work_lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `work_lng` varchar(20) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','work_lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `work_lat` varchar(20) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','contacts')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `contacts` varchar(50) NOT NULL COMMENT '联系人'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','contact_phone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `contact_phone` varchar(18) NOT NULL COMMENT '联系方式'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','gender')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `gender` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '性别要求：1=不限，2=男，3=女'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','age_min')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `age_min` tinyint(2) NOT NULL COMMENT '最小年龄要求'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','age_max')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `age_max` tinyint(2) NOT NULL COMMENT '最大年龄要求'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','education_label_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `education_label_id` int(11) DEFAULT '0' COMMENT '学历要求'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','experience_label_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `experience_label_id` int(11) DEFAULT '0' COMMENT '经验要求'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `status` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '招聘状态：1=待付款，2=审核中，3=未通过，4=招聘中，5=已结束'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','job_description')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `job_description` text COMMENT '职位描述'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序信息'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `pv` int(11) unsigned DEFAULT '0' COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','is_top')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `is_top` tinyint(1) DEFAULT '0' COMMENT '是否置顶:0=未置顶，1=置顶中'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','top_end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `top_end_time` int(11) DEFAULT '0' COMMENT '置顶结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','people_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `people_number` tinyint(2) DEFAULT '1' COMMENT '招聘人数'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','fictitious_pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `fictitious_pv` int(11) DEFAULT '0' COMMENT '虚拟浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_recruit','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_recruit')." ADD   `reason` varchar(255) NOT NULL COMMENT '驳回原因'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_recruit_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '关联用户id',
  `name` varchar(50) NOT NULL COMMENT '真实姓名',
  `phone` varchar(15) NOT NULL COMMENT '联系方式',
  `avatar` varchar(255) NOT NULL COMMENT '头像',
  `gender` enum('2','3') NOT NULL COMMENT '性别:2=男，3=女',
  `work_status` enum('1','2','3','4','5') NOT NULL COMMENT '上岗状态:1=随时上岗,2=一周之内,3=一月之内,4=考虑中,5=无换岗意向',
  `experience_label_id` int(11) NOT NULL COMMENT '工作经验(0则为无经验)',
  `education_label_id` int(11) NOT NULL COMMENT '最高学历',
  `birth_time` int(11) NOT NULL COMMENT '出生时间，年月日',
  `self_evaluation` text COMMENT '自我评价',
  `industry_pid` int(11) DEFAULT NULL COMMENT '上级行业id',
  `industry_id` int(11) DEFAULT NULL COMMENT '子行业id',
  `expect_position` varchar(30) NOT NULL COMMENT '期望职位',
  `job_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '工作类型：1=全职，2=兼职',
  `expect_salary_min` int(11) NOT NULL COMMENT '期望最低薪资',
  `expect_salary_max` int(11) DEFAULT NULL COMMENT '期望最高薪资',
  `expect_work_province` int(11) DEFAULT NULL COMMENT '期望工作区域 - 省',
  `expect_work_city` int(11) DEFAULT NULL COMMENT '期望工作区域 - 市(0则代表当前省所有区域)',
  `expect_work_area` int(11) DEFAULT NULL COMMENT '期望工作区域 - 区(0则代表当前市所有区域)',
  `work_experience` text COMMENT '工作经历',
  `educational_experience` text COMMENT '教育经历',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `pv` int(11) DEFAULT NULL COMMENT '浏览量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `mid` int(11) NOT NULL COMMENT '关联用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `name` varchar(50) NOT NULL COMMENT '真实姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','phone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `phone` varchar(15) NOT NULL COMMENT '联系方式'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `avatar` varchar(255) NOT NULL COMMENT '头像'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','gender')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `gender` enum('2','3') NOT NULL COMMENT '性别:2=男，3=女'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','work_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `work_status` enum('1','2','3','4','5') NOT NULL COMMENT '上岗状态:1=随时上岗,2=一周之内,3=一月之内,4=考虑中,5=无换岗意向'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','experience_label_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `experience_label_id` int(11) NOT NULL COMMENT '工作经验(0则为无经验)'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','education_label_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `education_label_id` int(11) NOT NULL COMMENT '最高学历'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','birth_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `birth_time` int(11) NOT NULL COMMENT '出生时间，年月日'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','self_evaluation')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `self_evaluation` text COMMENT '自我评价'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','industry_pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `industry_pid` int(11) DEFAULT NULL COMMENT '上级行业id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','industry_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `industry_id` int(11) DEFAULT NULL COMMENT '子行业id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','expect_position')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `expect_position` varchar(30) NOT NULL COMMENT '期望职位'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','job_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `job_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '工作类型：1=全职，2=兼职'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','expect_salary_min')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `expect_salary_min` int(11) NOT NULL COMMENT '期望最低薪资'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','expect_salary_max')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `expect_salary_max` int(11) DEFAULT NULL COMMENT '期望最高薪资'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','expect_work_province')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `expect_work_province` int(11) DEFAULT NULL COMMENT '期望工作区域 - 省'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','expect_work_city')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `expect_work_city` int(11) DEFAULT NULL COMMENT '期望工作区域 - 市(0则代表当前省所有区域)'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','expect_work_area')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `expect_work_area` int(11) DEFAULT NULL COMMENT '期望工作区域 - 区(0则代表当前市所有区域)'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','work_experience')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `work_experience` text COMMENT '工作经历'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','educational_experience')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `educational_experience` text COMMENT '教育经历'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','update_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `update_time` int(11) DEFAULT NULL COMMENT '修改时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_resume','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_resume')." ADD   `pv` int(11) DEFAULT NULL COMMENT '浏览量'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_recruit_submit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `resume_id` int(11) NOT NULL COMMENT '简历id',
  `recruit_id` int(11) NOT NULL COMMENT '招聘信息id',
  `create_time` int(11) NOT NULL COMMENT '投递时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：0=未查看，1=已查看，2=已邀请，3=已完成',
  `interview_time` int(11) DEFAULT NULL COMMENT '邀请面试时间',
  `interview_area` varchar(80) DEFAULT NULL COMMENT '面试地点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','resume_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `resume_id` int(11) NOT NULL COMMENT '简历id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','recruit_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `recruit_id` int(11) NOT NULL COMMENT '招聘信息id'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `create_time` int(11) NOT NULL COMMENT '投递时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `status` tinyint(1) DEFAULT '0' COMMENT '状态：0=未查看，1=已查看，2=已邀请，3=已完成'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','interview_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `interview_time` int(11) DEFAULT NULL COMMENT '邀请面试时间'");}
if(!pdo_fieldexists('ims_wlmerchant_recruit_submit','interview_area')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_recruit_submit')." ADD   `interview_area` varchar(80) DEFAULT NULL COMMENT '面试地点'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_red_envelope` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL COMMENT '关联贴子的id（红包的id）',
  `mid` int(11) NOT NULL COMMENT '领取红包的用户的id',
  `gettime` varchar(12) NOT NULL COMMENT '红包领取时间',
  `money` decimal(10,2) NOT NULL COMMENT '领取红包的金额',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `aid` int(11) NOT NULL COMMENT '代理商id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='红包领取记录表';

");

if(!pdo_fieldexists('ims_wlmerchant_red_envelope','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','pid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   `pid` int(11) unsigned NOT NULL COMMENT '关联贴子的id（红包的id）'");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   `mid` int(11) NOT NULL COMMENT '领取红包的用户的id'");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','gettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   `gettime` varchar(12) NOT NULL COMMENT '红包领取时间'");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   `money` decimal(10,2) NOT NULL COMMENT '领取红包的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   `aid` int(11) NOT NULL COMMENT '代理商id'");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_red_envelope','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_red_envelope')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_redpack_festival` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=下架，1=上架',
  `name` varchar(50) NOT NULL COMMENT '节日名称',
  `label` char(8) NOT NULL COMMENT '红包标签',
  `images` varchar(255) NOT NULL COMMENT '主题图片',
  `color` varchar(255) NOT NULL COMMENT '颜色设置信息',
  `start_time` int(10) unsigned NOT NULL COMMENT '开始时间',
  `end_time` int(10) NOT NULL COMMENT '结束时间',
  `redpack_calss` tinyint(1) NOT NULL DEFAULT '5' COMMENT '2=中秋红包，3=国庆红包，4=圣诞红包，5=新年红包，6=端午红包',
  `aid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=下架，1=上架'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `name` varchar(50) NOT NULL COMMENT '节日名称'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','label')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `label` char(8) NOT NULL COMMENT '红包标签'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','images')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `images` varchar(255) NOT NULL COMMENT '主题图片'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','color')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `color` varchar(255) NOT NULL COMMENT '颜色设置信息'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `start_time` int(10) unsigned NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `end_time` int(10) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','redpack_calss')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `redpack_calss` tinyint(1) NOT NULL DEFAULT '5' COMMENT '2=中秋红包，3=国庆红包，4=圣诞红包，5=新年红包，6=端午红包'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival')." ADD   `aid` int(10) NOT NULL DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_redpack_festival_join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `pack_id` int(11) NOT NULL COMMENT '红包id',
  `festival_id` int(11) NOT NULL COMMENT '节日信息id',
  `limit` tinyint(3) NOT NULL COMMENT '每人可领取的限制',
  `aid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_redpack_festival_join','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival_join')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival_join','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival_join')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival_join','pack_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival_join')." ADD   `pack_id` int(11) NOT NULL COMMENT '红包id'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival_join','festival_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival_join')." ADD   `festival_id` int(11) NOT NULL COMMENT '节日信息id'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival_join','limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival_join')." ADD   `limit` tinyint(3) NOT NULL COMMENT '每人可领取的限制'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_festival_join','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_festival_join')." ADD   `aid` int(10) NOT NULL DEFAULT '0'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_redpack_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `status` tinyint(1) unsigned NOT NULL COMMENT '0未使用1已使用',
  `type` tinyint(1) NOT NULL COMMENT '0自主领取1后台发送2抽奖领取',
  `packid` int(10) unsigned NOT NULL COMMENT '红包ID',
  `start_time` int(10) unsigned NOT NULL COMMENT '开始时间',
  `end_time` int(10) unsigned NOT NULL COMMENT '截止时间',
  `usetime` int(10) unsigned NOT NULL COMMENT '使用时间',
  `orderid` int(10) NOT NULL COMMENT '订单ID',
  `createtime` int(10) unsigned NOT NULL,
  `festival_id` int(11) NOT NULL DEFAULT '0' COMMENT '节日红包id',
  `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '红包领取渠道（1=普通红包领取；2=新人红包领取；3=节日红包领取）',
  `plugin` varchar(125) NOT NULL COMMENT '使用插件',
  `aid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_status` (`status`),
  KEY `idx_packid` (`packid`),
  KEY `idx_endtime` (`end_time`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_redpack_records','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `mid` int(10) unsigned NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `status` tinyint(1) unsigned NOT NULL COMMENT '0未使用1已使用'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `type` tinyint(1) NOT NULL COMMENT '0自主领取1后台发送2抽奖领取'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','packid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `packid` int(10) unsigned NOT NULL COMMENT '红包ID'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `start_time` int(10) unsigned NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `end_time` int(10) unsigned NOT NULL COMMENT '截止时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','usetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `usetime` int(10) unsigned NOT NULL COMMENT '使用时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `orderid` int(10) NOT NULL COMMENT '订单ID'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `createtime` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','festival_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `festival_id` int(11) NOT NULL DEFAULT '0' COMMENT '节日红包id'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '红包领取渠道（1=普通红包领取；2=新人红包领取；3=节日红包领取）'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `plugin` varchar(125) NOT NULL COMMENT '使用插件'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   `aid` int(10) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   KEY `idx_mid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_redpack_records','idx_packid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpack_records')." ADD   KEY `idx_packid` (`packid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_redpacks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(32) NOT NULL COMMENT '昵称',
  `scene` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0自助领取1系统发放',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0下架1上架',
  `full_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '满减限制金额，0无门槛',
  `cut_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `all_count` int(11) NOT NULL COMMENT '红包总数，0无限',
  `limit_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '每人限领数量',
  `usetime_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0固定时间1领取当日2领取次日',
  `usetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '限制时间',
  `usegoods_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0=全平台;1=指定代理;2=指定商家;3=指定商品使用',
  `sort` tinyint(4) NOT NULL COMMENT '排序，数字越大越靠前',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `use_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用开始时间',
  `use_end_time` int(10) unsigned NOT NULL COMMENT '使用截止时间',
  `usetime_day1` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取当日第几天有效',
  `usetime_day2` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取次日第几天有效',
  `use_aids` varchar(255) NOT NULL COMMENT '限使用的代理',
  `use_sids` varchar(255) NOT NULL COMMENT '限使用的商户',
  `aid` int(10) NOT NULL DEFAULT '0',
  `rush_ids` text COMMENT '限使用抢购商品',
  `group_ids` text COMMENT '限使用团购商品',
  `fight_ids` text COMMENT '限使用拼团商品',
  `bargain_ids` text COMMENT '限使用砍价商品',
  `redpack_type` int(11) NOT NULL COMMENT '红包类型 0通用红包 1商品红包 2买单红包',
  PRIMARY KEY (`id`),
  KEY `idx_sort` (`sort`),
  KEY `idx_scene` (`scene`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_redpacks','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `title` varchar(32) NOT NULL COMMENT '昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','scene')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `scene` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0自助领取1系统发放'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0下架1上架'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','full_money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `full_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '满减限制金额，0无门槛'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','cut_money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `cut_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠金额'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','all_count')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `all_count` int(11) NOT NULL COMMENT '红包总数，0无限'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','limit_count')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `limit_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '每人限领数量'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','usetime_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `usetime_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0固定时间1领取当日2领取次日'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','usetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `usetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '限制时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','usegoods_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `usegoods_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0=全平台;1=指定代理;2=指定商家;3=指定商品使用'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `sort` tinyint(4) NOT NULL COMMENT '排序，数字越大越靠前'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `createtime` int(10) unsigned NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','use_start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `use_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','use_end_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `use_end_time` int(10) unsigned NOT NULL COMMENT '使用截止时间'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','usetime_day1')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `usetime_day1` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取当日第几天有效'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','usetime_day2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `usetime_day2` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取次日第几天有效'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','use_aids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `use_aids` varchar(255) NOT NULL COMMENT '限使用的代理'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','use_sids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `use_sids` varchar(255) NOT NULL COMMENT '限使用的商户'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `aid` int(10) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','rush_ids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `rush_ids` text COMMENT '限使用抢购商品'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','group_ids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `group_ids` text COMMENT '限使用团购商品'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','fight_ids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `fight_ids` text COMMENT '限使用拼团商品'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','bargain_ids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `bargain_ids` text COMMENT '限使用砍价商品'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','redpack_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   `redpack_type` int(11) NOT NULL COMMENT '红包类型 0通用红包 1商品红包 2买单红包'");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   KEY `idx_sort` (`sort`)");}
if(!pdo_fieldexists('ims_wlmerchant_redpacks','idx_scene')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_redpacks')." ADD   KEY `idx_scene` (`scene`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_refund_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1手机端2Web端3最后一人退款4部分退款5计划任务退款',
  `payfee` varchar(100) NOT NULL COMMENT '支付金额',
  `paytype` int(3) NOT NULL COMMENT '支付方式：1=余额；2=微信；3=支付宝',
  `refundfee` varchar(100) NOT NULL COMMENT '退还金额',
  `transid` varchar(115) NOT NULL COMMENT '订单编号',
  `refund_id` varchar(115) NOT NULL COMMENT '微信退款单号',
  `refundername` varchar(100) NOT NULL COMMENT '退款人姓名',
  `refundermobile` varchar(100) NOT NULL COMMENT '退款人电话',
  `goodsname` varchar(100) NOT NULL COMMENT '商品名称',
  `createtime` varchar(45) NOT NULL COMMENT '退款时间',
  `status` int(11) NOT NULL COMMENT '0未成功1成功',
  `orderid` varchar(45) NOT NULL COMMENT '订单id',
  `sid` int(11) NOT NULL COMMENT '商家id',
  `remark` text NOT NULL COMMENT '退款备注',
  `plugin` varchar(32) NOT NULL COMMENT '插件名称',
  `errmsg` varchar(445) NOT NULL DEFAULT '0' COMMENT '退款错误信息',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `orderno` varchar(32) NOT NULL COMMENT '订单编号',
  `mid` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_type` (`type`),
  KEY `idx_paytype` (`paytype`),
  KEY `idx_plugin` (`plugin`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_refund_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `type` int(11) NOT NULL COMMENT '1手机端2Web端3最后一人退款4部分退款5计划任务退款'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','payfee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `payfee` varchar(100) NOT NULL COMMENT '支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `paytype` int(3) NOT NULL COMMENT '支付方式：1=余额；2=微信；3=支付宝'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','refundfee')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `refundfee` varchar(100) NOT NULL COMMENT '退还金额'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `transid` varchar(115) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','refund_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `refund_id` varchar(115) NOT NULL COMMENT '微信退款单号'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','refundername')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `refundername` varchar(100) NOT NULL COMMENT '退款人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','refundermobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `refundermobile` varchar(100) NOT NULL COMMENT '退款人电话'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','goodsname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `goodsname` varchar(100) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `createtime` varchar(45) NOT NULL COMMENT '退款时间'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `status` int(11) NOT NULL COMMENT '0未成功1成功'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `orderid` varchar(45) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `remark` text NOT NULL COMMENT '退款备注'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件名称'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','errmsg')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `errmsg` varchar(445) NOT NULL DEFAULT '0' COMMENT '退款错误信息'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `orderno` varchar(32) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','idx_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   KEY `idx_type` (`type`)");}
if(!pdo_fieldexists('ims_wlmerchant_refund_record','idx_paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_refund_record')." ADD   KEY `idx_paytype` (`paytype`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `storeid` int(11) NOT NULL COMMENT '商户id',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `num` int(11) NOT NULL COMMENT '订单数量',
  `status` int(11) NOT NULL COMMENT '0待填充数据 2待结算 1已结算',
  `setttype` int(11) NOT NULL COMMENT '结算时间 0每天 1每周 2每月',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_storeid` (`storeid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_report','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_report','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_report','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `storeid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_report','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `money` decimal(10,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('ims_wlmerchant_report','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_report','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `num` int(11) NOT NULL COMMENT '订单数量'");}
if(!pdo_fieldexists('ims_wlmerchant_report','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `status` int(11) NOT NULL COMMENT '0待填充数据 2待结算 1已结算'");}
if(!pdo_fieldexists('ims_wlmerchant_report','setttype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   `setttype` int(11) NOT NULL COMMENT '结算时间 0每天 1每周 2每月'");}
if(!pdo_fieldexists('ims_wlmerchant_report','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_report','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_report','idx_storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_report')." ADD   KEY `idx_storeid` (`storeid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `limit` text NOT NULL COMMENT '该角色拥有的权限数组',
  `title` varchar(32) NOT NULL COMMENT '角色title',
  `status` int(2) NOT NULL COMMENT '角色是否显示状态：2显示；0、1不显示',
  `type` int(2) NOT NULL COMMENT '角色类型（备用）',
  `createtime` varchar(32) NOT NULL COMMENT '创建时间',
  `updatetime` varchar(32) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色创建表';

");

if(!pdo_fieldexists('ims_wlmerchant_role','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色id'");}
if(!pdo_fieldexists('ims_wlmerchant_role','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_role','limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `limit` text NOT NULL COMMENT '该角色拥有的权限数组'");}
if(!pdo_fieldexists('ims_wlmerchant_role','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `title` varchar(32) NOT NULL COMMENT '角色title'");}
if(!pdo_fieldexists('ims_wlmerchant_role','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `status` int(2) NOT NULL COMMENT '角色是否显示状态：2显示；0、1不显示'");}
if(!pdo_fieldexists('ims_wlmerchant_role','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `type` int(2) NOT NULL COMMENT '角色类型（备用）'");}
if(!pdo_fieldexists('ims_wlmerchant_role','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `createtime` varchar(32) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_role','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_role')." ADD   `updatetime` varchar(32) NOT NULL COMMENT '修改时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_rush_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `sid` int(11) NOT NULL COMMENT '商家id',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `name` varchar(145) NOT NULL COMMENT '活动名称【可和仓库的商品名称一致】',
  `code` varchar(145) NOT NULL COMMENT '商品编号',
  `detail` longtext NOT NULL COMMENT '详情',
  `price` decimal(10,2) NOT NULL COMMENT '抢购价',
  `oldprice` decimal(10,2) NOT NULL COMMENT '原价',
  `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip价格',
  `num` int(11) NOT NULL COMMENT '限量',
  `levelnum` int(11) NOT NULL COMMENT '剩余数量',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '	未开始=1；进行中=2；已结束=3；已下架=4；待审核=5；未通过=6；已抢完=7;回收站 = 8',
  `starttime` varchar(225) NOT NULL COMMENT '活动开始时间',
  `endtime` varchar(225) NOT NULL COMMENT '活动结束时间',
  `follow` int(11) NOT NULL COMMENT '关注人数',
  `tag` text NOT NULL COMMENT '标签',
  `share_title` varchar(250) NOT NULL,
  `share_image` varchar(250) NOT NULL,
  `share_desc` varchar(250) NOT NULL,
  `unit` varchar(32) NOT NULL COMMENT '单位',
  `thumb` varchar(145) NOT NULL COMMENT '首页图片',
  `thumbs` text NOT NULL COMMENT '图集',
  `describe` text NOT NULL COMMENT '购买须知',
  `op_one_limit` int(11) NOT NULL COMMENT '单人限购',
  `cutofftime` int(11) NOT NULL COMMENT '使用截止时间',
  `is_indexshow` int(11) NOT NULL DEFAULT '1' COMMENT '是否首页显示',
  `allsalenum` int(11) NOT NULL COMMENT '虚拟销量',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '设置排序',
  `cutoffstatus` int(11) NOT NULL COMMENT '截止时间类型',
  `cutoffday` int(11) NOT NULL COMMENT '购买后有效天数',
  `retainage` decimal(10,2) NOT NULL COMMENT '尾款',
  `appointment` int(11) NOT NULL COMMENT '预约小时',
  `integral` int(11) NOT NULL COMMENT '获得积分',
  `pv` int(11) NOT NULL COMMENT '人气',
  `vipstatus` int(11) NOT NULL COMMENT '0无 1会员特价 2会员特供',
  `cateid` int(11) NOT NULL COMMENT '抢购分类ID',
  `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销',
  `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销',
  `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销',
  `orderinfo` varchar(255) NOT NULL COMMENT '订单信息',
  `isdistri` int(11) NOT NULL COMMENT '是否参与分销 0参与 1不参与',
  `falseorder` text NOT NULL COMMENT '虚拟订单',
  `specialid` int(11) NOT NULL COMMENT '主题ID',
  `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐',
  `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip结算金额',
  `viponedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip一级分销',
  `viptwodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip二级分销',
  `vipthreedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip三级分销',
  `optionstatus` int(11) NOT NULL COMMENT '多规格标记',
  `userlabel` text NOT NULL COMMENT '用户标签',
  `creditmoney` decimal(10,2) NOT NULL COMMENT '积分能抵扣的金额',
  `sharemoney` decimal(10,2) NOT NULL COMMENT '金额',
  `sharestatus` int(11) NOT NULL COMMENT '分享有礼',
  `independent` int(11) NOT NULL COMMENT '独立结算开关 0开启 1关闭',
  `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许',
  `usestatus` int(11) NOT NULL COMMENT '使用方式 0到店核销 1快递 2同时支持',
  `expressid` int(11) NOT NULL COMMENT '运费模板',
  `fastpay` int(11) NOT NULL COMMENT '快速支付 0开启 1关闭',
  `overrefund` tinyint(1) NOT NULL COMMENT '过期退款 0关闭 1开启',
  `level` text NOT NULL COMMENT '适用等级',
  `dissettime` int(11) NOT NULL COMMENT '结算时间 0订单完成时 1订单支付时',
  `diyposter` int(11) NOT NULL COMMENT '自定义海报ID',
  `communityid` int(11) NOT NULL COMMENT '社群id',
  `lp_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启阶梯价(0=关闭 1=开启)',
  `lp_set` text NOT NULL COMMENT '阶梯价基本设置信息',
  `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片',
  `is_describe_tip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)',
  `extension_text` text NOT NULL COMMENT '推广文案',
  `extension_img` text NOT NULL COMMENT '推广图片路径',
  `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式',
  `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)',
  `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `paidid` int(11) NOT NULL COMMENT '支付有礼活动id',
  `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数',
  `week` varchar(355) NOT NULL COMMENT '按星期时间',
  `day` varchar(355) NOT NULL COMMENT '按天数时间',
  `daylimit` int(11) NOT NULL COMMENT '每日限量',
  `viparray` text NOT NULL COMMENT '会员减免数组',
  `disarray` text NOT NULL COMMENT '分销商佣金数组',
  `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id',
  `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量',
  `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额',
  `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启',
  `appointdays` int(1) NOT NULL COMMENT '可预约天数',
  `appointarray` text NOT NULL COMMENT '预约数组',
  `videourl` varchar(255) NOT NULL COMMENT '顶部视频',
  `monthlimit` int(11) DEFAULT NULL COMMENT '没人每月限量',
  `yuecashback` decimal(10,2) NOT NULL COMMENT '普通用户余额返现',
  `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '会员余额返现',
  `checkcodeflag` int(11) DEFAULT NULL COMMENT '核销码类型 0系统核销码 1导入核销码',
  `pftid` int(11) DEFAULT NULL COMMENT '票付通id',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_rush_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `name` varchar(145) NOT NULL COMMENT '活动名称【可和仓库的商品名称一致】'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `code` varchar(145) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','detail')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `detail` longtext NOT NULL COMMENT '详情'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `price` decimal(10,2) NOT NULL COMMENT '抢购价'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','oldprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `oldprice` decimal(10,2) NOT NULL COMMENT '原价'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','vipprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `vipprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip价格'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `num` int(11) NOT NULL COMMENT '限量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','levelnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `levelnum` int(11) NOT NULL COMMENT '剩余数量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `status` int(11) NOT NULL DEFAULT '1' COMMENT '	未开始=1；进行中=2；已结束=3；已下架=4；待审核=5；未通过=6；已抢完=7;回收站 = 8'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','starttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `starttime` varchar(225) NOT NULL COMMENT '活动开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `endtime` varchar(225) NOT NULL COMMENT '活动结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','follow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `follow` int(11) NOT NULL COMMENT '关注人数'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','tag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `tag` text NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `share_title` varchar(250) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','share_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `share_image` varchar(250) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `share_desc` varchar(250) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','unit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `unit` varchar(32) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `thumb` varchar(145) NOT NULL COMMENT '首页图片'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `thumbs` text NOT NULL COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `describe` text NOT NULL COMMENT '购买须知'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','op_one_limit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `op_one_limit` int(11) NOT NULL COMMENT '单人限购'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','cutofftime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `cutofftime` int(11) NOT NULL COMMENT '使用截止时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','is_indexshow')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `is_indexshow` int(11) NOT NULL DEFAULT '1' COMMENT '是否首页显示'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','allsalenum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `allsalenum` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '设置排序'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','cutoffstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `cutoffstatus` int(11) NOT NULL COMMENT '截止时间类型'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','cutoffday')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `cutoffday` int(11) NOT NULL COMMENT '购买后有效天数'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','retainage')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `retainage` decimal(10,2) NOT NULL COMMENT '尾款'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','appointment')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `appointment` int(11) NOT NULL COMMENT '预约小时'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `integral` int(11) NOT NULL COMMENT '获得积分'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `pv` int(11) NOT NULL COMMENT '人气'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','vipstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `vipstatus` int(11) NOT NULL COMMENT '0无 1会员特价 2会员特供'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','cateid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `cateid` int(11) NOT NULL COMMENT '抢购分类ID'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `settlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `onedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '一级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `twodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '二级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','threedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `threedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '三级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','orderinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `orderinfo` varchar(255) NOT NULL COMMENT '订单信息'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','isdistri')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `isdistri` int(11) NOT NULL COMMENT '是否参与分销 0参与 1不参与'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','falseorder')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `falseorder` text NOT NULL COMMENT '虚拟订单'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','specialid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `specialid` int(11) NOT NULL COMMENT '主题ID'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','bgmusic')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `bgmusic` varchar(255) NOT NULL COMMENT '背景音乐'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','vipsettlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `vipsettlementmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','viponedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `viponedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip一级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','viptwodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `viptwodismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip二级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','vipthreedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `vipthreedismoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'vip三级分销'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','optionstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `optionstatus` int(11) NOT NULL COMMENT '多规格标记'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','userlabel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `userlabel` text NOT NULL COMMENT '用户标签'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','creditmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `creditmoney` decimal(10,2) NOT NULL COMMENT '积分能抵扣的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','sharemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `sharemoney` decimal(10,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','sharestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `sharestatus` int(11) NOT NULL COMMENT '分享有礼'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','independent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `independent` int(11) NOT NULL COMMENT '独立结算开关 0开启 1关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','allowapplyre')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `allowapplyre` int(11) NOT NULL COMMENT '是否允许退款 0允许 1不允许'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','usestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `usestatus` int(11) NOT NULL COMMENT '使用方式 0到店核销 1快递 2同时支持'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `expressid` int(11) NOT NULL COMMENT '运费模板'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','fastpay')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `fastpay` int(11) NOT NULL COMMENT '快速支付 0开启 1关闭'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','overrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `overrefund` tinyint(1) NOT NULL COMMENT '过期退款 0关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','level')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `level` text NOT NULL COMMENT '适用等级'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','dissettime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `dissettime` int(11) NOT NULL COMMENT '结算时间 0订单完成时 1订单支付时'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','diyposter')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `diyposter` int(11) NOT NULL COMMENT '自定义海报ID'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','communityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `communityid` int(11) NOT NULL COMMENT '社群id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','lp_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `lp_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启阶梯价(0=关闭 1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','lp_set')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `lp_set` text NOT NULL COMMENT '阶梯价基本设置信息'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','share_wxapp_image')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `share_wxapp_image` varchar(250) DEFAULT NULL COMMENT '小程序分享图片'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','is_describe_tip')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `is_describe_tip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启购买须知提醒(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','extension_text')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `extension_text` text NOT NULL COMMENT '推广文案'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','extension_img')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `extension_img` text NOT NULL COMMENT '推广图片路径'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','pay_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `pay_type` varchar(255) NOT NULL COMMENT '商品独立支付方式'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','cash_back')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `cash_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启支付返现(0=关闭，1=开启)'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','return_proportion')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `return_proportion` tinyint(3) NOT NULL DEFAULT '0' COMMENT '返现比例（1=100）'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','paidid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `paidid` int(11) NOT NULL COMMENT '支付有礼活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','usedatestatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `usedatestatus` tinyint(2) NOT NULL COMMENT '定时购买 1按星期 2按天数'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','week')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `week` varchar(355) NOT NULL COMMENT '按星期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `day` varchar(355) NOT NULL COMMENT '按天数时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','daylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `daylimit` int(11) NOT NULL COMMENT '每日限量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','viparray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `viparray` text NOT NULL COMMENT '会员减免数组'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','disarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `disarray` text NOT NULL COMMENT '分销商佣金数组'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','diyformid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `diyformid` int(11) NOT NULL DEFAULT '0' COMMENT '自定义表单id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','alldaylimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `alldaylimit` int(11) NOT NULL COMMENT '每天限购总量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','isdistristatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `isdistristatus` tinyint(1) NOT NULL COMMENT '分销设置方式：0 百分比 1固定金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','appointstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `appointstatus` tinyint(1) NOT NULL COMMENT '预约类型：0 关闭 1开启'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','appointdays')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `appointdays` int(1) NOT NULL COMMENT '可预约天数'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','appointarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `appointarray` text NOT NULL COMMENT '预约数组'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','videourl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `videourl` varchar(255) NOT NULL COMMENT '顶部视频'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','monthlimit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `monthlimit` int(11) DEFAULT NULL COMMENT '没人每月限量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','yuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `yuecashback` decimal(10,2) NOT NULL COMMENT '普通用户余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','vipyuecashback')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `vipyuecashback` decimal(10,2) DEFAULT NULL COMMENT '会员余额返现'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','checkcodeflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `checkcodeflag` int(11) DEFAULT NULL COMMENT '核销码类型 0系统核销码 1导入核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','pftid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   `pftid` int(11) DEFAULT NULL COMMENT '票付通id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_activity','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_activity')." ADD   KEY `idx_sid` (`sid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_rush_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `aid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '抢购商品分类排序，从大到小',
  `thumb` varchar(255) NOT NULL COMMENT '抢购商品分类图片',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页显示 0显示 1隐藏',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_is_show` (`is_show`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_rush_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   `name` varchar(255) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '抢购商品分类排序，从大到小'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   `thumb` varchar(255) NOT NULL COMMENT '抢购商品分类图片'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页显示 0显示 1隐藏'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_category','idx_is_show')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_category')." ADD   KEY `idx_is_show` (`is_show`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_rush_follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `actid` int(11) NOT NULL COMMENT '抢购商品ID',
  `sendtime` int(11) NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_sendtime` (`sendtime`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_rush_follows','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','actid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   `actid` int(11) NOT NULL COMMENT '抢购商品ID'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','sendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   `sendtime` int(11) NOT NULL COMMENT '发送时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_follows','idx_sendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_follows')." ADD   KEY `idx_sendtime` (`sendtime`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_rush_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `unionid` varchar(145) NOT NULL COMMENT '用户微信id',
  `openid` varchar(225) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '会员ID',
  `aid` int(11) NOT NULL COMMENT '代理id',
  `sid` int(11) NOT NULL COMMENT '商家id',
  `activityid` int(11) NOT NULL COMMENT '活动id',
  `status` int(11) NOT NULL COMMENT '0未支付 1已支付 2已消费 3已完成 4待收货 待消费 5已取消 6待退款 7已退款 9已过期',
  `orderno` varchar(145) NOT NULL COMMENT '订单号',
  `transid` varchar(145) NOT NULL COMMENT '微信支付ID',
  `price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `mobile` varchar(145) NOT NULL COMMENT '电话',
  `num` int(11) NOT NULL COMMENT '抢购数量',
  `actualprice` decimal(10,2) NOT NULL COMMENT '实际支付',
  `goodscode` varchar(145) NOT NULL COMMENT '商品编号',
  `paytime` varchar(145) NOT NULL COMMENT '支付时间',
  `paytype` int(2) NOT NULL COMMENT '支付方式 1余额 2微信 3支付宝 4货到付款',
  `checkcode` varchar(145) NOT NULL COMMENT '核销码',
  `createtime` varchar(225) NOT NULL COMMENT '创建时间',
  `adminremark` text NOT NULL COMMENT '卖家备注',
  `verfmid` int(11) NOT NULL,
  `verftime` int(11) NOT NULL,
  `issettlement` int(11) NOT NULL DEFAULT '0',
  `cutoffnotice` int(11) NOT NULL,
  `applytime` varchar(145) NOT NULL,
  `refundtime` varchar(145) NOT NULL,
  `applyrefund` int(11) NOT NULL DEFAULT '0',
  `falsename` varchar(145) NOT NULL,
  `falseavatar` varchar(145) NOT NULL,
  `disorderid` int(11) NOT NULL DEFAULT '0' COMMENT '分销订单id\n',
  `username` varchar(255) NOT NULL COMMENT '购买人姓名',
  `address` varchar(255) NOT NULL COMMENT '地址信息',
  `usetimes` int(11) NOT NULL COMMENT '使用次数',
  `usedtime` text NOT NULL COMMENT '核销记录',
  `vipbuyflag` int(11) NOT NULL COMMENT '会员购买表示 1会员购买 0普通购买 ',
  `optionid` int(11) NOT NULL COMMENT '规格id',
  `dkcredit` decimal(10,2) NOT NULL COMMENT '抵扣的积分',
  `dkmoney` decimal(10,2) NOT NULL COMMENT '抵扣的金额',
  `overtime` int(11) NOT NULL COMMENT '标记过期的时间',
  `paidprid` int(11) NOT NULL COMMENT '支付有礼的记录id',
  `shareid` int(11) NOT NULL COMMENT '分享有礼记录id',
  `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算金额',
  `estimatetime` int(11) NOT NULL COMMENT '预计过期时间',
  `changedispatchprice` decimal(10,2) NOT NULL COMMENT '订单改运费',
  `changeprice` decimal(10,0) NOT NULL COMMENT '订单改价',
  `failtimes` int(11) NOT NULL COMMENT '失败次数',
  `expressid` int(11) NOT NULL COMMENT '快递订单号',
  `remark` text NOT NULL COMMENT '买家备注',
  `vip_card_id` int(11) NOT NULL COMMENT '储存用户在购买当前商品时开通的会员卡的id',
  `originalprice` decimal(10,2) NOT NULL COMMENT '改价之前的原始价',
  `redisstatus` tinyint(1) NOT NULL COMMENT '退款分销订单状态修改',
  `neworderflag` tinyint(1) NOT NULL COMMENT '新订单标记',
  `reportid` int(11) NOT NULL COMMENT '报表id',
  `settletime` int(11) NOT NULL COMMENT '结算时间',
  `canceltime` int(11) NOT NULL COMMENT '预计取消时间',
  `remindtime` int(11) NOT NULL COMMENT '过期提醒时间',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '会员优惠金额',
  `salesarray` text NOT NULL COMMENT '业务员数组',
  `redpackid` int(11) NOT NULL COMMENT '使用的红包id',
  `redpackmoney` decimal(10,2) NOT NULL COMMENT '红包减免金额',
  `fullreduceid` int(11) NOT NULL COMMENT '满减活动id',
  `fullreducemoney` decimal(10,2) NOT NULL COMMENT '满减活动减免金额',
  `retype` int(11) NOT NULL COMMENT 'V3申请退款渠道 1原路 2余额',
  `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付的余额',
  `paysetid` int(11) NOT NULL COMMENT '支付商户设置id',
  `allocationtype` int(11) NOT NULL COMMENT '分账方式 0平台系统 1服务商分账',
  `drawid` int(11) NOT NULL COMMENT '抽奖记录id',
  `moinfo` text COMMENT '额外内容',
  `pftinfo` text COMMENT '票付通信息',
  `pftorderinfo` text COMMENT '票付通订单信息',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_status` (`status`),
  KEY `idx_mid` (`mid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_orderno` (`orderno`),
  KEY `idx_activityid` (`activityid`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_rush_order','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','unionid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `unionid` varchar(145) NOT NULL COMMENT '用户微信id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `openid` varchar(225) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `mid` int(11) NOT NULL COMMENT '会员ID'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `aid` int(11) NOT NULL COMMENT '代理id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `sid` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','activityid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `activityid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `status` int(11) NOT NULL COMMENT '0未支付 1已支付 2已消费 3已完成 4待收货 待消费 5已取消 6待退款 7已退款 9已过期'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `transid` varchar(145) NOT NULL COMMENT '微信支付ID'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `price` decimal(10,2) NOT NULL COMMENT '商品价格'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `mobile` varchar(145) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `num` int(11) NOT NULL COMMENT '抢购数量'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','actualprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `actualprice` decimal(10,2) NOT NULL COMMENT '实际支付'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','goodscode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `goodscode` varchar(145) NOT NULL COMMENT '商品编号'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','paytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `paytime` varchar(145) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `paytype` int(2) NOT NULL COMMENT '支付方式 1余额 2微信 3支付宝 4货到付款'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `checkcode` varchar(145) NOT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `createtime` varchar(225) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','adminremark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `adminremark` text NOT NULL COMMENT '卖家备注'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','verfmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `verfmid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','verftime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `verftime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','issettlement')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `issettlement` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','cutoffnotice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `cutoffnotice` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','applytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `applytime` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','refundtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `refundtime` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','applyrefund')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `applyrefund` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','falsename')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `falsename` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','falseavatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `falseavatar` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','disorderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `disorderid` int(11) NOT NULL DEFAULT '0' COMMENT '分销订单id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','username')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `username` varchar(255) NOT NULL COMMENT '购买人姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `address` varchar(255) NOT NULL COMMENT '地址信息'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','usetimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `usetimes` int(11) NOT NULL COMMENT '使用次数'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','usedtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `usedtime` text NOT NULL COMMENT '核销记录'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','vipbuyflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `vipbuyflag` int(11) NOT NULL COMMENT '会员购买表示 1会员购买 0普通购买 '");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','optionid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `optionid` int(11) NOT NULL COMMENT '规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','dkcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `dkcredit` decimal(10,2) NOT NULL COMMENT '抵扣的积分'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','dkmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `dkmoney` decimal(10,2) NOT NULL COMMENT '抵扣的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','overtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `overtime` int(11) NOT NULL COMMENT '标记过期的时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','paidprid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `paidprid` int(11) NOT NULL COMMENT '支付有礼的记录id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','shareid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `shareid` int(11) NOT NULL COMMENT '分享有礼记录id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','settlementmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `settlementmoney` decimal(10,2) NOT NULL COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','estimatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `estimatetime` int(11) NOT NULL COMMENT '预计过期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','changedispatchprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `changedispatchprice` decimal(10,2) NOT NULL COMMENT '订单改运费'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','changeprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `changeprice` decimal(10,0) NOT NULL COMMENT '订单改价'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','failtimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `failtimes` int(11) NOT NULL COMMENT '失败次数'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','expressid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `expressid` int(11) NOT NULL COMMENT '快递订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `remark` text NOT NULL COMMENT '买家备注'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','vip_card_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `vip_card_id` int(11) NOT NULL COMMENT '储存用户在购买当前商品时开通的会员卡的id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','originalprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `originalprice` decimal(10,2) NOT NULL COMMENT '改价之前的原始价'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','redisstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `redisstatus` tinyint(1) NOT NULL COMMENT '退款分销订单状态修改'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','neworderflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `neworderflag` tinyint(1) NOT NULL COMMENT '新订单标记'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','reportid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `reportid` int(11) NOT NULL COMMENT '报表id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','settletime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `settletime` int(11) NOT NULL COMMENT '结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','canceltime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `canceltime` int(11) NOT NULL COMMENT '预计取消时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','remindtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `remindtime` int(11) NOT NULL COMMENT '过期提醒时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','discount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '会员优惠金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','salesarray')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `salesarray` text NOT NULL COMMENT '业务员数组'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','redpackid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `redpackid` int(11) NOT NULL COMMENT '使用的红包id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','redpackmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `redpackmoney` decimal(10,2) NOT NULL COMMENT '红包减免金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','fullreduceid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `fullreduceid` int(11) NOT NULL COMMENT '满减活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','fullreducemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `fullreducemoney` decimal(10,2) NOT NULL COMMENT '满减活动减免金额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','retype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `retype` int(11) NOT NULL COMMENT 'V3申请退款渠道 1原路 2余额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','blendcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付的余额'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','paysetid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `paysetid` int(11) NOT NULL COMMENT '支付商户设置id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','allocationtype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `allocationtype` int(11) NOT NULL COMMENT '分账方式 0平台系统 1服务商分账'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','drawid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `drawid` int(11) NOT NULL COMMENT '抽奖记录id'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','moinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `moinfo` text COMMENT '额外内容'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','pftinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `pftinfo` text COMMENT '票付通信息'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','pftorderinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   `pftorderinfo` text COMMENT '票付通订单信息'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   KEY `idx_mid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_order','idx_orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_order')." ADD   KEY `idx_orderno` (`orderno`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_rush_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(125) NOT NULL COMMENT '题目',
  `thumb` varchar(125) NOT NULL COMMENT '顶部图片',
  `share_title` varchar(255) NOT NULL COMMENT '分享标题',
  `share_desc` varchar(255) NOT NULL COMMENT '分享详情',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `rule` text NOT NULL COMMENT '专题规则',
  `bgcolor` varchar(8) NOT NULL COMMENT '背景颜色',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_rush_special','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `title` varchar(125) NOT NULL COMMENT '题目'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `thumb` varchar(125) NOT NULL COMMENT '顶部图片'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','share_title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `share_title` varchar(255) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','share_desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `share_desc` varchar(255) NOT NULL COMMENT '分享详情'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','rule')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `rule` text NOT NULL COMMENT '专题规则'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','bgcolor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   `bgcolor` varchar(8) NOT NULL COMMENT '背景颜色'");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_rush_special','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_rush_special')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` longtext NOT NULL,
  `v4flag` tinyint(1) NOT NULL COMMENT 'V4的设置项',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_setting','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_setting','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_setting','key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD   `key` varchar(64) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_setting','value')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD   `value` longtext NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_setting','v4flag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD   `v4flag` tinyint(1) NOT NULL COMMENT 'V4的设置项'");}
if(!pdo_fieldexists('ims_wlmerchant_setting','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_setting','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_setting')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_settlement_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '-1系统审核不通过-2代理审核不通过1代理审核中2系统审核中，3系统审核通过，待结算,4已结算给代理,5已结算到商家,6分销商申请提现，7分销提现代理审核通过，8分销提现平台审核通过，9分销提现已结算，10分销提现代理驳回，11分销提现平台驳回；15=红娘提现审核中,16=红娘提现审核通过(待打款),17=红娘提现驳回,18=红娘提现已完成(打款完成)',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1商家提现申请2代理提现申请3分销商申请提现 4用户余额提现 5=红娘提现',
  `sapplymoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '申请结算金额',
  `aapplymoney` decimal(10,2) DEFAULT '0.00' COMMENT '代理申请金额',
  `sgetmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际得到金额',
  `agetmoney` decimal(10,2) DEFAULT '0.00' COMMENT '代理实际得到金额',
  `spercentmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '系统抽成金额',
  `apercentmoney` decimal(10,2) DEFAULT '0.00' COMMENT '代理缴纳佣金',
  `spercent` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '系统抽成比例',
  `apercent` decimal(10,4) DEFAULT '0.0000' COMMENT '代理给系统的抽成比例',
  `applytime` varchar(145) NOT NULL COMMENT '申请时间',
  `updatetime` varchar(145) NOT NULL COMMENT '最后操作时间',
  `settletype` int(11) NOT NULL DEFAULT '0' COMMENT '0未打款；1=手动处理；2=微信打款；3=分销商提现(手动处理)；4=分销商提现（余额到账）；5=红包打款；6=支付宝转账',
  `ids` text COMMENT '申请结算的订单id集',
  `ordernum` int(11) DEFAULT NULL COMMENT '结算订单数',
  `sopenid` varchar(145) NOT NULL COMMENT '收款人openid',
  `aopenid` varchar(145) NOT NULL,
  `type2` int(11) NOT NULL DEFAULT '0',
  `trade_no` varchar(45) NOT NULL COMMENT '商户打款单号',
  `payment_type` tinyint(1) NOT NULL COMMENT '代理商/商户期望的打款方式（1=支付宝，2=微信，3=银行卡,4=余额[仅分销商有余额打款]），5=代理后台申请商家提现',
  `mid` int(11) NOT NULL COMMENT '申请提现的分销商的id',
  `disid` int(11) NOT NULL COMMENT '分销提现申请人的代理商ID',
  `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '渠道 1公众号 3小程序',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_status` (`status`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='商家向代理提出结算申请记录';

");

if(!pdo_fieldexists('ims_wlmerchant_settlement_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `sid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `status` int(11) NOT NULL DEFAULT '0' COMMENT '-1系统审核不通过-2代理审核不通过1代理审核中2系统审核中，3系统审核通过，待结算,4已结算给代理,5已结算到商家,6分销商申请提现，7分销提现代理审核通过，8分销提现平台审核通过，9分销提现已结算，10分销提现代理驳回，11分销提现平台驳回；15=红娘提现审核中,16=红娘提现审核通过(待打款),17=红娘提现驳回,18=红娘提现已完成(打款完成)'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `type` int(11) NOT NULL DEFAULT '0' COMMENT '1商家提现申请2代理提现申请3分销商申请提现 4用户余额提现 5=红娘提现'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','sapplymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `sapplymoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '申请结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','aapplymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `aapplymoney` decimal(10,2) DEFAULT '0.00' COMMENT '代理申请金额'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','sgetmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `sgetmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际得到金额'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','agetmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `agetmoney` decimal(10,2) DEFAULT '0.00' COMMENT '代理实际得到金额'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','spercentmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `spercentmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '系统抽成金额'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','apercentmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `apercentmoney` decimal(10,2) DEFAULT '0.00' COMMENT '代理缴纳佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','spercent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `spercent` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '系统抽成比例'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','apercent')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `apercent` decimal(10,4) DEFAULT '0.0000' COMMENT '代理给系统的抽成比例'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','applytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `applytime` varchar(145) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','updatetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `updatetime` varchar(145) NOT NULL COMMENT '最后操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','settletype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `settletype` int(11) NOT NULL DEFAULT '0' COMMENT '0未打款；1=手动处理；2=微信打款；3=分销商提现(手动处理)；4=分销商提现（余额到账）；5=红包打款；6=支付宝转账'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','ids')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `ids` text COMMENT '申请结算的订单id集'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','ordernum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `ordernum` int(11) DEFAULT NULL COMMENT '结算订单数'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','sopenid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `sopenid` varchar(145) NOT NULL COMMENT '收款人openid'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','aopenid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `aopenid` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','type2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `type2` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','trade_no')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `trade_no` varchar(45) NOT NULL COMMENT '商户打款单号'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','payment_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `payment_type` tinyint(1) NOT NULL COMMENT '代理商/商户期望的打款方式（1=支付宝，2=微信，3=银行卡,4=余额[仅分销商有余额打款]），5=代理后台申请商家提现'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `mid` int(11) NOT NULL COMMENT '申请提现的分销商的id'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','disid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `disid` int(11) NOT NULL COMMENT '分销提现申请人的代理商ID'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '渠道 1公众号 3小程序'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_record','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_record')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_settlement_temporary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '类型 1用户余额提现\n',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `info` text NOT NULL COMMENT '体现信息数组压缩字符串',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_settlement_temporary','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_temporary')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_temporary','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_temporary')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_temporary','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_temporary')." ADD   `type` tinyint(1) NOT NULL COMMENT '类型 1用户余额提现\n'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_temporary','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_temporary')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_settlement_temporary','info')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_settlement_temporary')." ADD   `info` text NOT NULL COMMENT '体现信息数组压缩字符串'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_signmember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `nickname` varchar(32) NOT NULL COMMENT '用户昵称',
  `avatar` varchar(445) NOT NULL COMMENT '用户头像',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `times` int(11) NOT NULL COMMENT '累计(连续)签到天数\n',
  `integral` int(11) NOT NULL COMMENT '积分',
  `record` text NOT NULL COMMENT '详细记录',
  `totaltimes` int(11) NOT NULL COMMENT '总共签到次数',
  `total` text NOT NULL COMMENT '累计记录',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_times` (`times`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=363 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_signmember','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','nickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `nickname` varchar(32) NOT NULL COMMENT '用户昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','avatar')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `avatar` varchar(445) NOT NULL COMMENT '用户头像'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `times` int(11) NOT NULL COMMENT '累计(连续)签到天数\n'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','integral')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `integral` int(11) NOT NULL COMMENT '积分'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','record')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `record` text NOT NULL COMMENT '详细记录'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','totaltimes')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `totaltimes` int(11) NOT NULL COMMENT '总共签到次数'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','total')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   `total` text NOT NULL COMMENT '累计记录'");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   KEY `idx_mid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_signmember','idx_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signmember')." ADD   KEY `idx_times` (`times`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_signreceive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `date` int(11) NOT NULL COMMENT '月份',
  `total` int(11) NOT NULL COMMENT '累计天数',
  `reward` int(11) NOT NULL COMMENT '奖励',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_signreceive','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   `mid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','date')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   `date` int(11) NOT NULL COMMENT '月份'");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','total')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   `total` int(11) NOT NULL COMMENT '累计天数'");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','reward')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   `reward` int(11) NOT NULL COMMENT '奖励'");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_signreceive','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signreceive')." ADD   KEY `idx_mid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_signrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `date` int(11) NOT NULL COMMENT '签到日期',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `reward` int(11) NOT NULL COMMENT '获取积分',
  `sign_class` varchar(20) NOT NULL DEFAULT '0' COMMENT '签到类型',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=455 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_signrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','date')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   `date` int(11) NOT NULL COMMENT '签到日期'");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','reward')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   `reward` int(11) NOT NULL COMMENT '获取积分'");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','sign_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   `sign_class` varchar(20) NOT NULL DEFAULT '0' COMMENT '签到类型'");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_signrecord','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_signrecord')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_smallorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `mid` int(11) NOT NULL COMMENT '用户mid',
  `aid` int(11) NOT NULL COMMENT '代理id\n',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `status` int(11) NOT NULL COMMENT '状态 1待使用 2已结算 3已退款 4申请退款中',
  `plugin` varchar(50) NOT NULL COMMENT '插件名称',
  `orderid` int(11) NOT NULL COMMENT '母订单id',
  `orderno` varchar(50) NOT NULL COMMENT '母订单编号',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `hexiaotime` int(11) NOT NULL COMMENT '核销时间',
  `hexiaotype` int(11) NOT NULL COMMENT '核销方式 1输码 2扫码 3后台 4密码',
  `hxuid` int(11) NOT NULL COMMENT '核销员user表id',
  `settletime` int(11) NOT NULL COMMENT '结算时间',
  `checkcode` varchar(50) NOT NULL COMMENT '核销码',
  `orderprice` decimal(10,2) NOT NULL COMMENT '订单支付金额',
  `settlemoney` decimal(10,2) NOT NULL COMMENT '结算金额',
  `disorderid` int(11) NOT NULL COMMENT '分销订单id',
  `oneleadid` int(11) NOT NULL COMMENT '一级分销商id',
  `twoleadid` int(11) NOT NULL COMMENT '二级分销商id',
  `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销商佣金',
  `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销商佣金',
  `dissettletime` int(11) NOT NULL COMMENT '分销结算时间',
  `refundtime` int(11) NOT NULL COMMENT '退款时间',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `specid` int(11) NOT NULL COMMENT '规格id',
  `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付金额',
  `allocationstatus` int(11) NOT NULL COMMENT '分账状态 0不需要分账 1需要分账但未分账 2已分账',
  `appointstatus` int(11) NOT NULL COMMENT '预约状态 0不需要预约 1 未预约 2预约中  3已预约',
  `appstarttime` int(11) NOT NULL COMMENT '预约开始时间',
  `appendtime` int(11) NOT NULL COMMENT '预约结束时间',
  PRIMARY KEY (`id`),
  KEY `idx_orderid` (`orderid`) USING BTREE,
  KEY `idx_checkcode` (`checkcode`) USING BTREE,
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_orderno` (`orderno`),
  KEY `idx_gid_specid_plugin_status` (`gid`,`specid`,`plugin`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='小订单';

");

if(!pdo_fieldexists('ims_wlmerchant_smallorder','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `mid` int(11) NOT NULL COMMENT '用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `aid` int(11) NOT NULL COMMENT '代理id\n'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `status` int(11) NOT NULL COMMENT '状态 1待使用 2已结算 3已退款 4申请退款中'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `plugin` varchar(50) NOT NULL COMMENT '插件名称'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `orderid` int(11) NOT NULL COMMENT '母订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `orderno` varchar(50) NOT NULL COMMENT '母订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','hexiaotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `hexiaotime` int(11) NOT NULL COMMENT '核销时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','hexiaotype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `hexiaotype` int(11) NOT NULL COMMENT '核销方式 1输码 2扫码 3后台 4密码'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','hxuid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `hxuid` int(11) NOT NULL COMMENT '核销员user表id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','settletime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `settletime` int(11) NOT NULL COMMENT '结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `checkcode` varchar(50) NOT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','orderprice')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `orderprice` decimal(10,2) NOT NULL COMMENT '订单支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','settlemoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `settlemoney` decimal(10,2) NOT NULL COMMENT '结算金额'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','disorderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `disorderid` int(11) NOT NULL COMMENT '分销订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','oneleadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `oneleadid` int(11) NOT NULL COMMENT '一级分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','twoleadid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `twoleadid` int(11) NOT NULL COMMENT '二级分销商id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','onedismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `onedismoney` decimal(10,2) NOT NULL COMMENT '一级分销商佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','twodismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `twodismoney` decimal(10,2) NOT NULL COMMENT '二级分销商佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','dissettletime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `dissettletime` int(11) NOT NULL COMMENT '分销结算时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','refundtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `refundtime` int(11) NOT NULL COMMENT '退款时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','gid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `gid` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','specid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `specid` int(11) NOT NULL COMMENT '规格id'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','blendcredit')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `blendcredit` decimal(10,2) NOT NULL COMMENT '混合支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','allocationstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `allocationstatus` int(11) NOT NULL COMMENT '分账状态 0不需要分账 1需要分账但未分账 2已分账'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','appointstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `appointstatus` int(11) NOT NULL COMMENT '预约状态 0不需要预约 1 未预约 2预约中  3已预约'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','appstarttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `appstarttime` int(11) NOT NULL COMMENT '预约开始时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','appendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   `appendtime` int(11) NOT NULL COMMENT '预约结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','idx_orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   KEY `idx_orderid` (`orderid`) USING BTREE");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','idx_checkcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   KEY `idx_checkcode` (`checkcode`) USING BTREE");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_smallorder','idx_orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smallorder')." ADD   KEY `idx_orderno` (`orderno`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_smstpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '模板名称',
  `type` varchar(32) NOT NULL COMMENT '类型',
  `smstplid` varchar(32) NOT NULL,
  `data` text NOT NULL,
  `status` smallint(2) NOT NULL COMMENT '0禁用1启用',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_smstpl','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `name` varchar(50) NOT NULL COMMENT '模板名称'");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `type` varchar(32) NOT NULL COMMENT '类型'");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','smstplid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `smstplid` varchar(32) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','data')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `data` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `status` smallint(2) NOT NULL COMMENT '0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   `createtime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_smstpl','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_smstpl')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_store_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '商户id',
  `mid` int(11) NOT NULL COMMENT '发布人id',
  `status` int(11) NOT NULL COMMENT '状态 0待审核 1审核通过 2已推送',
  `content` varchar(225) NOT NULL COMMENT '内容',
  `imgs` text NOT NULL COMMENT '图集',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `passtime` int(11) NOT NULL COMMENT '审核时间',
  `sendtime` int(11) NOT NULL COMMENT '发送时间',
  `successnum` int(11) NOT NULL COMMENT '成功人数',
  `supportlist` text NOT NULL COMMENT '点赞列表',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_status` (`status`),
  KEY `idx_aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `mid` int(11) NOT NULL COMMENT '发布人id'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `status` int(11) NOT NULL COMMENT '状态 0待审核 1审核通过 2已推送'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `content` varchar(225) NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','imgs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `imgs` text NOT NULL COMMENT '图集'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','passtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `passtime` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','sendtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `sendtime` int(11) NOT NULL COMMENT '发送时间'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','successnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `successnum` int(11) NOT NULL COMMENT '成功人数'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','supportlist')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   `supportlist` text NOT NULL COMMENT '点赞列表'");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   KEY `idx_sid` (`sid`)");}
if(!pdo_fieldexists('ims_wlmerchant_store_dynamic','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_store_dynamic')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_storefans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `source` int(2) NOT NULL COMMENT '1收藏店铺2挪车卡绑定3店铺二维码',
  `createtime` int(11) NOT NULL,
  `isread` int(11) NOT NULL COMMENT '是否已查看 0未查看 1已查看',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sid` (`sid`),
  KEY `idx_mid_uniacid` (`mid`,`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_storefans','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   `sid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   `source` int(2) NOT NULL COMMENT '1收藏店铺2挪车卡绑定3店铺二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   `createtime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','isread')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   `isread` int(11) NOT NULL COMMENT '是否已查看 0未查看 1已查看'");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_storefans','idx_sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storefans')." ADD   KEY `idx_sid` (`sid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_storeusers_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `package` varchar(5000) NOT NULL,
  `isdefault` int(2) unsigned NOT NULL COMMENT '0非默认1默认',
  `enabled` int(2) unsigned NOT NULL COMMENT '0禁用1启用',
  `createtime` int(11) unsigned NOT NULL,
  `aid` int(11) NOT NULL,
  `authority` text NOT NULL COMMENT '商户权限',
  `chargeid` int(11) NOT NULL COMMENT '匹配付费入驻id',
  `defaultrate` int(11) NOT NULL COMMENT '默认结算比',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `uniacid` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `name` varchar(50) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','package')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `package` varchar(5000) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','isdefault')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `isdefault` int(2) unsigned NOT NULL COMMENT '0非默认1默认'");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `enabled` int(2) unsigned NOT NULL COMMENT '0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `createtime` int(11) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','authority')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `authority` text NOT NULL COMMENT '商户权限'");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','chargeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `chargeid` int(11) NOT NULL COMMENT '匹配付费入驻id'");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','defaultrate')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   `defaultrate` int(11) NOT NULL COMMENT '默认结算比'");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_storeusers_group','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_storeusers_group')." ADD   KEY `idx_aid` (`aid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_subposter_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `invite_id` int(10) unsigned NOT NULL COMMENT '邀请人ID',
  `createtime` int(10) NOT NULL COMMENT '第一次生成的时间',
  `sort` int(10) NOT NULL COMMENT '排序',
  `scan_times` int(10) NOT NULL COMMENT '扫码次数',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_invite_id` (`invite_id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_subposter_log','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   `uniacid` int(10) unsigned NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   `mid` int(10) unsigned NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','invite_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   `invite_id` int(10) unsigned NOT NULL COMMENT '邀请人ID'");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   `createtime` int(10) NOT NULL COMMENT '第一次生成的时间'");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   `sort` int(10) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','scan_times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   `scan_times` int(10) NOT NULL COMMENT '扫码次数'");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   KEY `idx_mid` (`mid`)");}
if(!pdo_fieldexists('ims_wlmerchant_subposter_log','idx_invite_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_subposter_log')." ADD   KEY `idx_invite_id` (`invite_id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_systemnotice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `type` int(11) NOT NULL COMMENT '通知类型 1通知商户抢购已支付 2通知商户其他订单已支付 3通知商户提现信息 4通知商户新加会员 ',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `objid` int(11) NOT NULL COMMENT '对象id： 类型12：订单 3结算记录 4用户id',
  `isread` int(11) NOT NULL COMMENT '是否已阅：0未阅读 1已阅读',
  `createtime` int(11) NOT NULL COMMENT '发送时间',
  `status` int(11) NOT NULL COMMENT '提现通知状态 1通过审核 2被驳回 3已打款',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_systemnotice','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `type` int(11) NOT NULL COMMENT '通知类型 1通知商户抢购已支付 2通知商户其他订单已支付 3通知商户提现信息 4通知商户新加会员 '");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','sid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `sid` int(11) NOT NULL COMMENT '商户id'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','objid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `objid` int(11) NOT NULL COMMENT '对象id： 类型12：订单 3结算记录 4用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','isread')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `isread` int(11) NOT NULL COMMENT '是否已阅：0未阅读 1已阅读'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `createtime` int(11) NOT NULL COMMENT '发送时间'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   `status` int(11) NOT NULL COMMENT '提现通知状态 1通过审核 2被驳回 3已打款'");}
if(!pdo_fieldexists('ims_wlmerchant_systemnotice','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_systemnotice')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `title` varchar(145) NOT NULL COMMENT '标签内容',
  `type` int(11) NOT NULL COMMENT '标签类型 0首页 1抢购 2拼团 3团购',
  `enabled` int(11) NOT NULL COMMENT '0隐藏1显示',
  `sort` int(11) NOT NULL COMMENT '排序',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `content` varchar(255) NOT NULL COMMENT '描述内容',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_aid` (`aid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_tags','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_tags','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_tags','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_tags','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `title` varchar(145) NOT NULL COMMENT '标签内容'");}
if(!pdo_fieldexists('ims_wlmerchant_tags','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `type` int(11) NOT NULL COMMENT '标签类型 0首页 1抢购 2拼团 3团购'");}
if(!pdo_fieldexists('ims_wlmerchant_tags','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `enabled` int(11) NOT NULL COMMENT '0隐藏1显示'");}
if(!pdo_fieldexists('ims_wlmerchant_tags','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_tags','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_tags','content')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   `content` varchar(255) NOT NULL COMMENT '描述内容'");}
if(!pdo_fieldexists('ims_wlmerchant_tags','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_tags','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_tags','idx_aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   KEY `idx_aid` (`aid`)");}
if(!pdo_fieldexists('ims_wlmerchant_tags','idx_enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_tags')." ADD   KEY `idx_enabled` (`enabled`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_taxipay_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `sort` int(11) NOT NULL COMMENT '排序，数字越大越靠前',
  `title` varchar(32) NOT NULL COMMENT '名称',
  `thumb` varchar(255) NOT NULL COMMENT '广告图片',
  `status` tinyint(1) NOT NULL COMMENT '状态0禁用1启用',
  `charg_type` tinyint(1) NOT NULL COMMENT '计费形式0按时长1浏览次数',
  `endtime` int(11) NOT NULL COMMENT '广告到期时间',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总费用',
  `cost_one` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '每人计费',
  `link` varchar(300) NOT NULL COMMENT '跳转链接',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_status` (`uniacid`,`status`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `sort` int(11) NOT NULL COMMENT '排序，数字越大越靠前'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `title` varchar(32) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','thumb')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `thumb` varchar(255) NOT NULL COMMENT '广告图片'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','charg_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `charg_type` tinyint(1) NOT NULL COMMENT '计费形式0按时长1浏览次数'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `endtime` int(11) NOT NULL COMMENT '广告到期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','cost')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总费用'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','cost_one')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `cost_one` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '每人计费'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','link')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   `link` varchar(300) NOT NULL COMMENT '跳转链接'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_adv','idx_uniacid_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_adv')." ADD   KEY `idx_uniacid_status` (`uniacid`,`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_taxipay_advcids` (
  `advid` int(11) NOT NULL COMMENT '广告ID',
  `cid` int(11) NOT NULL COMMENT '公司ID',
  KEY `idx_advid` (`advid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_taxipay_advcids','advid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advcids')." ADD 
  `advid` int(11) NOT NULL COMMENT '广告ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advcids','cid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advcids')." ADD   `cid` int(11) NOT NULL COMMENT '公司ID'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_taxipay_advlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `advid` int(11) NOT NULL COMMENT '广告ID',
  `times` int(11) NOT NULL COMMENT '浏览次数',
  `lasttime` int(11) NOT NULL COMMENT '最近时间',
  `firsttime` int(11) NOT NULL COMMENT '最早时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_advid` (`advid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','advid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   `advid` int(11) NOT NULL COMMENT '广告ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   `times` int(11) NOT NULL COMMENT '浏览次数'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','lasttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   `lasttime` int(11) NOT NULL COMMENT '最近时间'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','firsttime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   `firsttime` int(11) NOT NULL COMMENT '最早时间'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_advlog','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_advlog')." ADD   KEY `idx_mid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_taxipay_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `name` varchar(64) NOT NULL COMMENT '公司名称',
  `province` int(11) NOT NULL COMMENT '省',
  `city` int(11) NOT NULL COMMENT '市',
  `district` int(11) NOT NULL COMMENT '区',
  `address` varchar(300) NOT NULL COMMENT '详细地址',
  `tel` varchar(16) NOT NULL COMMENT '电话',
  `master` int(10) unsigned NOT NULL COMMENT '司机数量',
  `scale` tinyint(3) unsigned NOT NULL COMMENT '抽点比例',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `name` varchar(64) NOT NULL COMMENT '公司名称'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','province')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `province` int(11) NOT NULL COMMENT '省'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','city')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `city` int(11) NOT NULL COMMENT '市'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','district')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `district` int(11) NOT NULL COMMENT '区'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `address` varchar(300) NOT NULL COMMENT '详细地址'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','tel')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `tel` varchar(16) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','master')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `master` int(10) unsigned NOT NULL COMMENT '司机数量'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','scale')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `scale` tinyint(3) unsigned NOT NULL COMMENT '抽点比例'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_company','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_company')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_taxipay_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '平台ID',
  `cid` int(11) NOT NULL COMMENT '所属公司',
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `plate1` varchar(2) NOT NULL COMMENT '省简称',
  `plate2` varchar(1) NOT NULL COMMENT '英文前缀',
  `plate_number` varchar(8) NOT NULL COMMENT '车牌号',
  `name` varchar(32) NOT NULL COMMENT '姓名',
  `mobile` varchar(16) NOT NULL COMMENT '电话',
  `status` tinyint(1) NOT NULL COMMENT '状态0禁用1启用',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `maxpay` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每日最高收款金额',
  `is_maxpay` tinyint(1) NOT NULL COMMENT '0跟随系统1单独设置',
  `cloudspeaker` text NOT NULL COMMENT '云喇叭配置信息',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cid` (`cid`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `uniacid` int(11) NOT NULL COMMENT '平台ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','cid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `cid` int(11) NOT NULL COMMENT '所属公司'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `mid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','plate1')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `plate1` varchar(2) NOT NULL COMMENT '省简称'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','plate2')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `plate2` varchar(1) NOT NULL COMMENT '英文前缀'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','plate_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `plate_number` varchar(8) NOT NULL COMMENT '车牌号'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `name` varchar(32) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `mobile` varchar(16) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','maxpay')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `maxpay` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每日最高收款金额'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','is_maxpay')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `is_maxpay` tinyint(1) NOT NULL COMMENT '0跟随系统1单独设置'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','cloudspeaker')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   `cloudspeaker` text NOT NULL COMMENT '云喇叭配置信息'");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_taxipay_master','idx_cid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_taxipay_master')." ADD   KEY `idx_cid` (`cid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_temporary_orderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderno` varchar(32) NOT NULL COMMENT '订单号',
  `deteletime` int(11) NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_temporary_orderlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_temporary_orderlist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_temporary_orderlist','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_temporary_orderlist')." ADD   `orderno` varchar(32) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('ims_wlmerchant_temporary_orderlist','deteletime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_temporary_orderlist')." ADD   `deteletime` int(11) NOT NULL COMMENT '删除时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_timecardrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `cardid` int(11) NOT NULL COMMENT '一卡通id',
  `activeid` int(11) NOT NULL COMMENT '活动id',
  `merchantid` int(11) NOT NULL COMMENT '店铺id',
  `freeflag` tinyint(2) NOT NULL COMMENT '免费标记',
  `ordermoney` decimal(10,2) NOT NULL COMMENT '订单金额',
  `realmoney` decimal(10,2) NOT NULL COMMENT '实际支付金额',
  `verfmid` int(11) NOT NULL COMMENT '操作店员id',
  `usetime` int(11) NOT NULL COMMENT '使用时间',
  `type` int(11) NOT NULL COMMENT '记录类型 1折扣 2礼包',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `commentflag` int(11) NOT NULL COMMENT '评价标志 1已评价 0未评价',
  `discount` decimal(10,1) NOT NULL COMMENT '折扣比例',
  `undismoney` decimal(10,2) NOT NULL COMMENT '不可优惠金额',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','cardid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `cardid` int(11) NOT NULL COMMENT '一卡通id'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','activeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `activeid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','merchantid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `merchantid` int(11) NOT NULL COMMENT '店铺id'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','freeflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `freeflag` tinyint(2) NOT NULL COMMENT '免费标记'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','ordermoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `ordermoney` decimal(10,2) NOT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','realmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `realmoney` decimal(10,2) NOT NULL COMMENT '实际支付金额'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','verfmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `verfmid` int(11) NOT NULL COMMENT '操作店员id'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','usetime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `usetime` int(11) NOT NULL COMMENT '使用时间'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `type` int(11) NOT NULL COMMENT '记录类型 1折扣 2礼包'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','commentflag')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `commentflag` int(11) NOT NULL COMMENT '评价标志 1已评价 0未评价'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','discount')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `discount` decimal(10,1) NOT NULL COMMENT '折扣比例'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','undismoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   `undismoney` decimal(10,2) NOT NULL COMMENT '不可优惠金额'");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_timecardrecord','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_timecardrecord')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(145) NOT NULL DEFAULT '0.00',
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL DEFAULT '0',
  `days` int(11) NOT NULL COMMENT '时间',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `type` int(11) NOT NULL COMMENT '可生成类型ID',
  `tokentype` int(11) NOT NULL COMMENT '邀请码类型1VIP2五折',
  `typename` varchar(145) NOT NULL COMMENT '可生成类型名称',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0未使用1已使用2已锁定',
  `remark` text NOT NULL,
  `openid` varchar(145) NOT NULL,
  `mid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `levelid` int(11) NOT NULL COMMENT '匹配等级',
  `give_price` decimal(10,0) NOT NULL COMMENT '使用激活码时赠送的金额',
  `caraid` int(11) NOT NULL COMMENT '客户定制，挪车代理',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_number` (`number`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_token','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_token','number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `number` varchar(145) NOT NULL DEFAULT '0.00'");}
if(!pdo_fieldexists('ims_wlmerchant_token','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_token','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `aid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_token','days')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `days` int(11) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('ims_wlmerchant_token','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格'");}
if(!pdo_fieldexists('ims_wlmerchant_token','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `type` int(11) NOT NULL COMMENT '可生成类型ID'");}
if(!pdo_fieldexists('ims_wlmerchant_token','tokentype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `tokentype` int(11) NOT NULL COMMENT '邀请码类型1VIP2五折'");}
if(!pdo_fieldexists('ims_wlmerchant_token','typename')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `typename` varchar(145) NOT NULL COMMENT '可生成类型名称'");}
if(!pdo_fieldexists('ims_wlmerchant_token','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `status` int(11) NOT NULL DEFAULT '0' COMMENT '0未使用1已使用2已锁定'");}
if(!pdo_fieldexists('ims_wlmerchant_token','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `remark` text NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_token','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `openid` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_token','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_token','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `createtime` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_token','levelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `levelid` int(11) NOT NULL COMMENT '匹配等级'");}
if(!pdo_fieldexists('ims_wlmerchant_token','give_price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `give_price` decimal(10,0) NOT NULL COMMENT '使用激活码时赠送的金额'");}
if(!pdo_fieldexists('ims_wlmerchant_token','caraid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   `caraid` int(11) NOT NULL COMMENT '客户定制，挪车代理'");}
if(!pdo_fieldexists('ims_wlmerchant_token','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_token','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_token','idx_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   KEY `idx_number` (`number`)");}
if(!pdo_fieldexists('ims_wlmerchant_token','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token')." ADD   KEY `idx_status` (`status`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_token_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '申请指定类型激活码的id',
  `tokentype` int(11) NOT NULL COMMENT '1VIP2特权',
  `num` int(11) NOT NULL COMMENT '申请生成个数',
  `createtime` varchar(145) NOT NULL COMMENT '申请时间',
  `status` int(11) NOT NULL COMMENT '申请状态',
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_token_apply','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `type` int(11) NOT NULL COMMENT '申请指定类型激活码的id'");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','tokentype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `tokentype` int(11) NOT NULL COMMENT '1VIP2特权'");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `num` int(11) NOT NULL COMMENT '申请生成个数'");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `createtime` varchar(145) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `status` int(11) NOT NULL COMMENT '申请状态'");}
if(!pdo_fieldexists('ims_wlmerchant_token_apply','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_token_apply')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_transfer_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `mid` int(11) NOT NULL COMMENT '用户id',
  `title` varchar(255) NOT NULL COMMENT '活动标题',
  `allnum` int(11) NOT NULL COMMENT '总数',
  `surplus` int(11) NOT NULL COMMENT '剩余数量',
  `money` decimal(10,2) NOT NULL COMMENT '单份金额',
  `allmoney` decimal(10,2) NOT NULL COMMENT '总金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `wechatqrlink` varchar(255) NOT NULL COMMENT '公众号二维码',
  `wxappqrlink` varchar(255) NOT NULL COMMENT '小程序二维码',
  `pageurl` varchar(255) NOT NULL COMMENT '页面链接',
  `is_over` int(11) NOT NULL COMMENT '是否过期 0未过期 1已过期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_transfer_list','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','title')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `title` varchar(255) NOT NULL COMMENT '活动标题'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','allnum')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `allnum` int(11) NOT NULL COMMENT '总数'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','surplus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `surplus` int(11) NOT NULL COMMENT '剩余数量'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `money` decimal(10,2) NOT NULL COMMENT '单份金额'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','allmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `allmoney` decimal(10,2) NOT NULL COMMENT '总金额'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','wechatqrlink')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `wechatqrlink` varchar(255) NOT NULL COMMENT '公众号二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','wxappqrlink')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `wxappqrlink` varchar(255) NOT NULL COMMENT '小程序二维码'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','pageurl')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `pageurl` varchar(255) NOT NULL COMMENT '页面链接'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_list','is_over')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_list')." ADD   `is_over` int(11) NOT NULL COMMENT '是否过期 0未过期 1已过期'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_transfer_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `tid` int(11) NOT NULL COMMENT '活动id',
  `mid` int(11) NOT NULL COMMENT '获取用户id',
  `money` decimal(10,2) NOT NULL COMMENT '获取金额',
  `realname` varchar(32) NOT NULL COMMENT '输入名字',
  `mobile` varchar(32) NOT NULL COMMENT '输入电话',
  `createtime` int(11) NOT NULL COMMENT '领取时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_transfer_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号id'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','tid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `tid` int(11) NOT NULL COMMENT '活动id'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `mid` int(11) NOT NULL COMMENT '获取用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','money')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `money` decimal(10,2) NOT NULL COMMENT '获取金额'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','realname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `realname` varchar(32) NOT NULL COMMENT '输入名字'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `mobile` varchar(32) NOT NULL COMMENT '输入电话'");}
if(!pdo_fieldexists('ims_wlmerchant_transfer_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_transfer_record')." ADD   `createtime` int(11) NOT NULL COMMENT '领取时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_userlabel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(124) NOT NULL COMMENT '标签名称',
  `sort` int(11) NOT NULL COMMENT '标签排序',
  `status` int(11) NOT NULL COMMENT '0禁用1启用',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_sort` (`sort`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_userlabel','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   `name` varchar(124) NOT NULL COMMENT '标签名称'");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   `sort` int(11) NOT NULL COMMENT '标签排序'");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   `status` int(11) NOT NULL COMMENT '0禁用1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   `createtime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel','idx_sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel')." ADD   KEY `idx_sort` (`sort`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_userlabel_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `labelid` int(11) NOT NULL COMMENT '标签ID',
  `mid` int(11) NOT NULL,
  `times` int(11) NOT NULL COMMENT '标记次数',
  `createtime` int(11) NOT NULL,
  `dotime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','labelid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `labelid` int(11) NOT NULL COMMENT '标签ID'");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','times')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `times` int(11) NOT NULL COMMENT '标记次数'");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `createtime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   `dotime` int(11) NOT NULL COMMENT '更新时间'");}
if(!pdo_fieldexists('ims_wlmerchant_userlabel_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_userlabel_record')." ADD   PRIMARY KEY (`id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `type` enum('1','2') DEFAULT '1' COMMENT '发布类型:1=乘客,2=车主',
  `transport_type` enum('1','2','3','4') DEFAULT '1' COMMENT '运输类型:1=载客,2=载货,3=找客,4=找货',
  `people` tinyint(3) unsigned DEFAULT NULL COMMENT '人数/空位',
  `weight` smallint(5) unsigned DEFAULT NULL COMMENT '重量/载重(kg)',
  `frequency` enum('1','2') DEFAULT '1' COMMENT '班次:1=一次,2=每天',
  `start_time` int(11) DEFAULT NULL COMMENT '出发时间',
  `start_province_id` int(11) DEFAULT NULL COMMENT '出发点省id',
  `start_city_id` int(11) DEFAULT NULL COMMENT '出发点市id',
  `start_area_id` int(11) DEFAULT NULL COMMENT '出发点区县id',
  `start_address` varchar(50) DEFAULT NULL COMMENT '出发点 - 详细地址',
  `start_lng` varchar(20) DEFAULT NULL COMMENT '出发点 - 经度',
  `start_lat` varchar(20) DEFAULT NULL COMMENT '出发点 - 纬度',
  `end_province_id` int(11) DEFAULT NULL COMMENT '终点 - 省id',
  `end_city_id` int(11) DEFAULT NULL COMMENT '终点 - 市id',
  `end_area_id` int(11) DEFAULT NULL COMMENT '终点 - 区县id',
  `end_address` varchar(50) DEFAULT NULL COMMENT '终点 - 详细地址',
  `end_lng` varchar(20) DEFAULT NULL COMMENT '终点 - 经度',
  `end_lat` varchar(20) DEFAULT NULL COMMENT '终点 - 纬度',
  `pass_by` varchar(255) DEFAULT NULL COMMENT '途径地点',
  `contacts` varchar(25) DEFAULT NULL COMMENT '联系人',
  `contacts_phone` varchar(25) DEFAULT NULL COMMENT '联系方式',
  `label_id` varchar(255) DEFAULT NULL COMMENT '标签',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) DEFAULT NULL COMMENT '发布时间',
  `pv` int(11) DEFAULT NULL COMMENT '浏览量',
  `status` enum('1','2','3','4','5') DEFAULT '2' COMMENT '状态:1=待付款,2=待审核,3=未通过,4=进行中,5=已完成',
  `reason` varchar(255) DEFAULT NULL COMMENT '驳回原因',
  `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号（默认）；2=h5；3=小程序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_vehicle','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `type` enum('1','2') DEFAULT '1' COMMENT '发布类型:1=乘客,2=车主'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','transport_type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `transport_type` enum('1','2','3','4') DEFAULT '1' COMMENT '运输类型:1=载客,2=载货,3=找客,4=找货'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','people')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `people` tinyint(3) unsigned DEFAULT NULL COMMENT '人数/空位'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','weight')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `weight` smallint(5) unsigned DEFAULT NULL COMMENT '重量/载重(kg)'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','frequency')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `frequency` enum('1','2') DEFAULT '1' COMMENT '班次:1=一次,2=每天'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_time` int(11) DEFAULT NULL COMMENT '出发时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_province_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_province_id` int(11) DEFAULT NULL COMMENT '出发点省id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_city_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_city_id` int(11) DEFAULT NULL COMMENT '出发点市id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_area_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_area_id` int(11) DEFAULT NULL COMMENT '出发点区县id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_address` varchar(50) DEFAULT NULL COMMENT '出发点 - 详细地址'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_lng` varchar(20) DEFAULT NULL COMMENT '出发点 - 经度'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','start_lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `start_lat` varchar(20) DEFAULT NULL COMMENT '出发点 - 纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','end_province_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `end_province_id` int(11) DEFAULT NULL COMMENT '终点 - 省id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','end_city_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `end_city_id` int(11) DEFAULT NULL COMMENT '终点 - 市id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','end_area_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `end_area_id` int(11) DEFAULT NULL COMMENT '终点 - 区县id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','end_address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `end_address` varchar(50) DEFAULT NULL COMMENT '终点 - 详细地址'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','end_lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `end_lng` varchar(20) DEFAULT NULL COMMENT '终点 - 经度'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','end_lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `end_lat` varchar(20) DEFAULT NULL COMMENT '终点 - 纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','pass_by')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `pass_by` varchar(255) DEFAULT NULL COMMENT '途径地点'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','contacts')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `contacts` varchar(25) DEFAULT NULL COMMENT '联系人'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','contacts_phone')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `contacts_phone` varchar(25) DEFAULT NULL COMMENT '联系方式'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','label_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `label_id` varchar(255) DEFAULT NULL COMMENT '标签'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','remarks')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `remarks` varchar(255) DEFAULT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `pv` int(11) DEFAULT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `status` enum('1','2','3','4','5') DEFAULT '2' COMMENT '状态:1=待付款,2=待审核,3=未通过,4=进行中,5=已完成'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','reason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `reason` varchar(255) DEFAULT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle','source')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle')." ADD   `source` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=公众号（默认）；2=h5；3=小程序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_vehicle_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL COMMENT '路线id',
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_vehicle_collection','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_collection')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_collection','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_collection')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_collection','vehicle_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_collection')." ADD   `vehicle_id` int(11) DEFAULT NULL COMMENT '路线id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_collection','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_collection')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_collection','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_collection')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '收藏时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_vehicle_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL COMMENT '路线id',
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '第一次浏览时间',
  `update_time` int(11) DEFAULT NULL COMMENT '最近浏览时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_vehicle_history','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_history')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_history','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_history')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_history','vehicle_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_history')." ADD   `vehicle_id` int(11) DEFAULT NULL COMMENT '路线id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_history','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_history')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_history','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_history')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '第一次浏览时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_history','update_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_history')." ADD   `update_time` int(11) DEFAULT NULL COMMENT '最近浏览时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_vehicle_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL COMMENT '标签名称',
  `is_passenger` enum('1','2') DEFAULT '1' COMMENT '是否适用于载客:1=不适用,2=适用',
  `is_goods` enum('1','2') DEFAULT '1' COMMENT '是否适用于载货:1=不适用,2=适用',
  `are_passenger` enum('1','2') DEFAULT '1' COMMENT '是否适用于找客:1=不适用,2=适用',
  `are_goods` enum('1','2') DEFAULT '1' COMMENT '是否适用于找货:1=不适用,2=适用',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `aid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `name` varchar(30) DEFAULT NULL COMMENT '标签名称'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','is_passenger')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `is_passenger` enum('1','2') DEFAULT '1' COMMENT '是否适用于载客:1=不适用,2=适用'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','is_goods')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `is_goods` enum('1','2') DEFAULT '1' COMMENT '是否适用于载货:1=不适用,2=适用'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','are_passenger')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `are_passenger` enum('1','2') DEFAULT '1' COMMENT '是否适用于找客:1=不适用,2=适用'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','are_goods')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `are_goods` enum('1','2') DEFAULT '1' COMMENT '是否适用于找货:1=不适用,2=适用'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_label','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_label')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_vehicle_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL COMMENT '路线id',
  `mid` int(11) DEFAULT NULL COMMENT '用户id',
  `describe` varchar(255) DEFAULT NULL COMMENT '具体描述',
  `create_time` int(11) DEFAULT NULL COMMENT '举报时间',
  `status` enum('1','2','3') DEFAULT '1' COMMENT '状态:1=待处理,2=处理中,3=已处理',
  `uniacid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','vehicle_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `vehicle_id` int(11) DEFAULT NULL COMMENT '路线id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `mid` int(11) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','describe')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `describe` varchar(255) DEFAULT NULL COMMENT '具体描述'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','create_time')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `create_time` int(11) DEFAULT NULL COMMENT '举报时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `status` enum('1','2','3') DEFAULT '1' COMMENT '状态:1=待处理,2=处理中,3=已处理'");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vehicle_report','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vehicle_report')." ADD   `aid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_verifrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `storeid` int(11) NOT NULL COMMENT '商家ID',
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `plugin` varchar(32) NOT NULL COMMENT '插件',
  `orderid` int(11) NOT NULL COMMENT '订单ID',
  `verifrcode` varchar(32) NOT NULL COMMENT '核销码',
  `verifmid` int(11) NOT NULL COMMENT '核销员ID',
  `verifnickname` varchar(100) NOT NULL COMMENT '核销员昵称',
  `verifmobile` varchar(32) NOT NULL COMMENT '核销员电话',
  `remark` varchar(100) NOT NULL COMMENT '备注',
  `createtime` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL COMMENT '核销数量',
  `orderno` varchar(145) NOT NULL COMMENT '订单编号',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_storeid` (`storeid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_verifrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `aid` int(11) NOT NULL COMMENT '代理ID'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `storeid` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `mid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','plugin')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `plugin` varchar(32) NOT NULL COMMENT '插件'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `orderid` int(11) NOT NULL COMMENT '订单ID'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','verifrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `verifrcode` varchar(32) NOT NULL COMMENT '核销码'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','verifmid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `verifmid` int(11) NOT NULL COMMENT '核销员ID'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','verifnickname')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `verifnickname` varchar(100) NOT NULL COMMENT '核销员昵称'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','verifmobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `verifmobile` varchar(32) NOT NULL COMMENT '核销员电话'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','remark')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `remark` varchar(100) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `createtime` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','type')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `type` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','num')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `num` int(11) NOT NULL COMMENT '核销数量'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   `orderno` varchar(145) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   KEY `idx_uniacid` (`uniacid`)");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','idx_storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   KEY `idx_storeid` (`storeid`)");}
if(!pdo_fieldexists('ims_wlmerchant_verifrecord','idx_mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_verifrecord')." ADD   KEY `idx_mid` (`mid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_vip_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `areaid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `openid` varchar(145) NOT NULL,
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '充值金额',
  `howlong` varchar(145) NOT NULL COMMENT '充值VIP月数',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `paytime` varchar(145) NOT NULL COMMENT '充值时间',
  `orderno` varchar(145) NOT NULL COMMENT '充值单号',
  `limittime` varchar(145) NOT NULL COMMENT '下次会员到期时间',
  `status` int(11) DEFAULT '0' COMMENT '0未支付1已支付',
  `uniacid` int(11) NOT NULL,
  `unionid` varchar(145) NOT NULL,
  `paytype` int(11) NOT NULL,
  `transid` varchar(145) NOT NULL,
  `issettlement` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  `is_half` int(11) NOT NULL,
  `disorderid` int(11) NOT NULL,
  `todistributor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_vip_record','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `mid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','uid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','areaid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `areaid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','openid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `openid` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `price` decimal(10,2) DEFAULT '0.00' COMMENT '充值金额'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','howlong')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `howlong` varchar(145) NOT NULL COMMENT '充值VIP月数'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `createtime` varchar(145) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','paytime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `paytime` varchar(145) NOT NULL COMMENT '充值时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','orderno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `orderno` varchar(145) NOT NULL COMMENT '充值单号'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','limittime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `limittime` varchar(145) NOT NULL COMMENT '下次会员到期时间'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `status` int(11) DEFAULT '0' COMMENT '0未支付1已支付'");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','unionid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `unionid` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','paytype')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `paytype` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','transid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `transid` varchar(145) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','issettlement')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `issettlement` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','typeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `typeid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','is_half')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `is_half` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','disorderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `disorderid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_vip_record','todistributor')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_vip_record')." ADD   `todistributor` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_waittask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `value` text,
  `key` varchar(145) NOT NULL COMMENT '键',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `dotime` int(11) NOT NULL COMMENT '操作时间',
  `finishtime` int(11) NOT NULL COMMENT '完成时间',
  `status` int(11) NOT NULL COMMENT '0未完成 1已完成',
  `important` varchar(145) NOT NULL COMMENT '重要参数',
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_dotime` (`dotime`),
  KEY `idx_key` (`key`),
  KEY `idx_important` (`important`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_waittask','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','value')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `value` text");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `key` varchar(145) NOT NULL COMMENT '键'");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `dotime` int(11) NOT NULL COMMENT '操作时间'");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','finishtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `finishtime` int(11) NOT NULL COMMENT '完成时间'");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `status` int(11) NOT NULL COMMENT '0未完成 1已完成'");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','important')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   `important` varchar(145) NOT NULL COMMENT '重要参数'");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','idx_status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   KEY `idx_status` (`status`)");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','idx_dotime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   KEY `idx_dotime` (`dotime`)");}
if(!pdo_fieldexists('ims_wlmerchant_waittask','idx_key')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_waittask')." ADD   KEY `idx_key` (`key`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_wxapp_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `wxapp_uniacid` int(11) NOT NULL COMMENT '小程序ID',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_wxapp_uniacid` (`wxapp_uniacid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_wxapp_relation','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_wxapp_relation')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_wxapp_relation','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_wxapp_relation')." ADD   `uniacid` int(11) NOT NULL COMMENT '公众号ID'");}
if(!pdo_fieldexists('ims_wlmerchant_wxapp_relation','wxapp_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_wxapp_relation')." ADD   `wxapp_uniacid` int(11) NOT NULL COMMENT '小程序ID'");}
if(!pdo_fieldexists('ims_wlmerchant_wxapp_relation','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_wxapp_relation')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('ims_wlmerchant_wxapp_relation','idx_uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_wxapp_relation')." ADD   KEY `idx_uniacid` (`uniacid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_cates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL COMMENT '分类名称',
  `parentid` int(11) NOT NULL COMMENT '父分类id',
  `sort` int(11) NOT NULL COMMENT '排序',
  `enabled` tinyint(1) NOT NULL COMMENT '状态',
  `claimmoney` decimal(10,2) NOT NULL COMMENT '认领价格',
  `querymoney` decimal(10,2) NOT NULL COMMENT '查看价格',
  `logo` varchar(255) NOT NULL COMMENT '图片链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `name` varchar(64) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','parentid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `parentid` int(11) NOT NULL COMMENT '父分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','enabled')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `enabled` tinyint(1) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','claimmoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `claimmoney` decimal(10,2) NOT NULL COMMENT '认领价格'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','querymoney')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `querymoney` decimal(10,2) NOT NULL COMMENT '查看价格'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_cates','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_cates')." ADD   `logo` varchar(255) NOT NULL COMMENT '图片链接'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_claim_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '认领人的mid',
  `pageid` int(11) NOT NULL COMMENT '黄页id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `paystatus` tinyint(1) NOT NULL COMMENT '支付状态 0未支付 1已支付 2不需要支付 3已退款',
  `status` tinyint(1) NOT NULL COMMENT '审核状态 0待审核 1已审核 2被驳回',
  `orderid` int(11) NOT NULL COMMENT '关联订单id',
  `desc` text NOT NULL COMMENT '认领描述',
  `name` varchar(32) NOT NULL COMMENT '真实名称',
  `mobile` varchar(32) NOT NULL COMMENT '联系电话',
  `rejectreason` varchar(355) NOT NULL COMMENT '驳回原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `mid` int(11) NOT NULL COMMENT '认领人的mid'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','pageid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `pageid` int(11) NOT NULL COMMENT '黄页id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','paystatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `paystatus` tinyint(1) NOT NULL COMMENT '支付状态 0未支付 1已支付 2不需要支付 3已退款'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `status` tinyint(1) NOT NULL COMMENT '审核状态 0待审核 1已审核 2被驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','orderid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `orderid` int(11) NOT NULL COMMENT '关联订单id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `desc` text NOT NULL COMMENT '认领描述'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `name` varchar(32) NOT NULL COMMENT '真实名称'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `mobile` varchar(32) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_claim_lists','rejectreason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_claim_lists')." ADD   `rejectreason` varchar(355) NOT NULL COMMENT '驳回原因'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `pageid` int(11) NOT NULL COMMENT '关联黄页id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_collect','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_collect')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_collect','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_collect')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_collect','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_collect')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_collect','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_collect')." ADD   `mid` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_collect','pageid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_collect')." ADD   `pageid` int(11) NOT NULL COMMENT '关联黄页id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_collect','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_collect')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_correction_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '纠错用户mid',
  `pageid` int(11) NOT NULL COMMENT '黄页id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL COMMENT '状态 0未查看 1已查看',
  `desc` text NOT NULL COMMENT '描述',
  `name` varchar(32) NOT NULL COMMENT '姓名',
  `mobile` varchar(32) NOT NULL COMMENT '联系方式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `mid` int(11) NOT NULL COMMENT '纠错用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','pageid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `pageid` int(11) NOT NULL COMMENT '黄页id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0未查看 1已查看'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `desc` text NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `name` varchar(32) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_correction_lists','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_correction_lists')." ADD   `mobile` varchar(32) NOT NULL COMMENT '联系方式'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '认领的用户mid',
  `storeid` int(11) NOT NULL COMMENT '关联的店铺id',
  `sort` int(11) NOT NULL COMMENT '排序',
  `name` varchar(300) NOT NULL COMMENT '店铺名称',
  `logo` varchar(300) NOT NULL COMMENT '商户logo',
  `mobile` varchar(24) NOT NULL COMMENT '联系电话',
  `thumbs` text NOT NULL COMMENT '商家展示图集',
  `desc` varchar(500) NOT NULL COMMENT '商户简介',
  `address` varchar(300) NOT NULL COMMENT '详细地址',
  `one_class` int(11) NOT NULL COMMENT '一级分类id',
  `two_class` int(11) NOT NULL COMMENT '二级分类id',
  `meal_id` int(11) NOT NULL COMMENT '套餐id',
  `meal_endtime` int(11) NOT NULL COMMENT '有效期结束时间',
  `pv` int(11) NOT NULL COMMENT '浏览量',
  `share` int(11) NOT NULL COMMENT '分享数',
  `status` int(11) NOT NULL COMMENT '状态 0禁用 1启用',
  `checkstatus` int(11) NOT NULL COMMENT '审核状态0待审核 1已审核 2被驳回',
  `paystatus` int(11) NOT NULL COMMENT '支付状态 0未支付 1已支付',
  `pro_code` int(11) NOT NULL COMMENT '省id',
  `city_code` int(11) NOT NULL COMMENT '市id',
  `area_code` int(11) NOT NULL COMMENT '区县id',
  `lng` varchar(16) NOT NULL COMMENT '经度',
  `lat` varchar(16) NOT NULL COMMENT '纬度',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `rejectreason` varchar(335) NOT NULL COMMENT '驳回原因',
  `wechat_number` varchar(32) DEFAULT NULL COMMENT '微信号',
  `wechat_qrcode` varchar(255) DEFAULT NULL COMMENT '微信二维码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `mid` int(11) NOT NULL COMMENT '认领的用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','storeid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `storeid` int(11) NOT NULL COMMENT '关联的店铺id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `name` varchar(300) NOT NULL COMMENT '店铺名称'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','logo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `logo` varchar(300) NOT NULL COMMENT '商户logo'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `mobile` varchar(24) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','thumbs')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `thumbs` text NOT NULL COMMENT '商家展示图集'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `desc` varchar(500) NOT NULL COMMENT '商户简介'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','address')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `address` varchar(300) NOT NULL COMMENT '详细地址'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','one_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `one_class` int(11) NOT NULL COMMENT '一级分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','two_class')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `two_class` int(11) NOT NULL COMMENT '二级分类id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','meal_id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `meal_id` int(11) NOT NULL COMMENT '套餐id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','meal_endtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `meal_endtime` int(11) NOT NULL COMMENT '有效期结束时间'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','pv')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `pv` int(11) NOT NULL COMMENT '浏览量'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','share')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `share` int(11) NOT NULL COMMENT '分享数'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `status` int(11) NOT NULL COMMENT '状态 0禁用 1启用'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','checkstatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `checkstatus` int(11) NOT NULL COMMENT '审核状态0待审核 1已审核 2被驳回'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','paystatus')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `paystatus` int(11) NOT NULL COMMENT '支付状态 0未支付 1已支付'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','pro_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `pro_code` int(11) NOT NULL COMMENT '省id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','city_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `city_code` int(11) NOT NULL COMMENT '市id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','area_code')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `area_code` int(11) NOT NULL COMMENT '区县id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','lng')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `lng` varchar(16) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','lat')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `lat` varchar(16) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','rejectreason')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `rejectreason` varchar(335) NOT NULL COMMENT '驳回原因'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','wechat_number')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `wechat_number` varchar(32) DEFAULT NULL COMMENT '微信号'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_lists','wechat_qrcode')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_lists')." ADD   `wechat_qrcode` varchar(255) DEFAULT NULL COMMENT '微信二维码'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_meals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `name` varchar(64) NOT NULL COMMENT '套餐名称',
  `is_free` tinyint(1) NOT NULL COMMENT '是否免费 0付费 1免费',
  `price` decimal(10,2) NOT NULL COMMENT '入驻金额',
  `day` int(11) NOT NULL COMMENT '入驻天数',
  `check` tinyint(1) NOT NULL COMMENT '是否审核0免审核 1需要审核',
  `status` tinyint(1) NOT NULL COMMENT '状态 0禁用 1启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','sort')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `name` varchar(64) NOT NULL COMMENT '套餐名称'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','is_free')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `is_free` tinyint(1) NOT NULL COMMENT '是否免费 0付费 1免费'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','price')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `price` decimal(10,2) NOT NULL COMMENT '入驻金额'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','day')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `day` int(11) NOT NULL COMMENT '入驻天数'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','check')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `check` tinyint(1) NOT NULL COMMENT '是否审核0免审核 1需要审核'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_meals','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_meals')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0禁用 1启用'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yellowpage_report_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '用户mid',
  `pageid` int(11) NOT NULL COMMENT '黄页id',
  `desc` text NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL COMMENT '状态 0未查看 1已查看',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `name` int(11) NOT NULL COMMENT '姓名',
  `mobile` int(11) NOT NULL COMMENT '电话',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','uniacid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','aid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `aid` int(11) NOT NULL");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','mid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `mid` int(11) NOT NULL COMMENT '用户mid'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','pageid')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `pageid` int(11) NOT NULL COMMENT '黄页id'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','desc')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `desc` text NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','status')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `status` tinyint(1) NOT NULL COMMENT '状态 0未查看 1已查看'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `createtime` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','name')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `name` int(11) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('ims_wlmerchant_yellowpage_report_lists','mobile')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yellowpage_report_lists')." ADD   `mobile` int(11) NOT NULL COMMENT '电话'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wlmerchant_yunsigninlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchantno` varchar(32) DEFAULT NULL COMMENT '商户号',
  `batchNo` varchar(32) DEFAULT NULL COMMENT '批次号',
  `traceNo` varchar(32) DEFAULT NULL COMMENT '当前跟踪号',
  `createtime` varchar(32) DEFAULT NULL COMMENT '时间戳',
  `serinfo` text COMMENT '返回的压缩数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('ims_wlmerchant_yunsigninlist','id')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yunsigninlist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('ims_wlmerchant_yunsigninlist','merchantno')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yunsigninlist')." ADD   `merchantno` varchar(32) DEFAULT NULL COMMENT '商户号'");}
if(!pdo_fieldexists('ims_wlmerchant_yunsigninlist','batchNo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yunsigninlist')." ADD   `batchNo` varchar(32) DEFAULT NULL COMMENT '批次号'");}
if(!pdo_fieldexists('ims_wlmerchant_yunsigninlist','traceNo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yunsigninlist')." ADD   `traceNo` varchar(32) DEFAULT NULL COMMENT '当前跟踪号'");}
if(!pdo_fieldexists('ims_wlmerchant_yunsigninlist','createtime')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yunsigninlist')." ADD   `createtime` varchar(32) DEFAULT NULL COMMENT '时间戳'");}
if(!pdo_fieldexists('ims_wlmerchant_yunsigninlist','serinfo')) {pdo_query("ALTER TABLE ".tablename('ims_wlmerchant_yunsigninlist')." ADD   `serinfo` text COMMENT '返回的压缩数据'");}
