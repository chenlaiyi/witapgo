<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_xc_beauty_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `address` longtext COMMENT '地址',
  `map` longtext COMMENT '地址',
  `content` longtext COMMENT '地址',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COMMENT='地址';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(50) DEFAULT NULL COMMENT '电话',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `map` longtext COMMENT '地址',
  `content` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `status` int(11) DEFAULT '-1' COMMENT '状态（-1审核中1审核通过2失败3失败已阅）',
  `createtime` datetime DEFAULT NULL COMMENT '申请时间',
  `applytime` datetime DEFAULT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`,`applytime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='审核';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `title` varchar(255) DEFAULT NULL COMMENT '副标题',
  `bimgt` varchar(255) DEFAULT NULL COMMENT '上背景图',
  `bimgb` varchar(255) DEFAULT NULL COMMENT '下背景图',
  `down_status` int(11) DEFAULT '-1' COMMENT '满立减',
  `down_title` varchar(50) DEFAULT NULL COMMENT '小标题',
  `order_status` int(11) DEFAULT '-1' COMMENT '下单送券',
  `order_title` varchar(50) DEFAULT NULL COMMENT '小标题',
  `pay_type` int(11) DEFAULT '-1' COMMENT '充值优惠',
  `pay_title` varchar(255) DEFAULT NULL COMMENT '小标题',
  `content` longtext,
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `backcolor` varchar(50) DEFAULT NULL COMMENT '背景色',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='新人专区';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_area_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '1' COMMENT '类型（1满立减2送券3充值优惠）',
  `simg` varchar(255) DEFAULT NULL COMMENT '图标',
  `amount` varchar(50) DEFAULT NULL COMMENT '满足金额',
  `price` varchar(50) DEFAULT NULL COMMENT '减去金额',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `order_num` int(11) DEFAULT NULL COMMENT '完成顺序',
  `order_type` int(11) DEFAULT '1' COMMENT '完成奖励（1优惠券2兑换券）',
  `coupon` int(11) DEFAULT NULL COMMENT '优惠券',
  `service` int(11) DEFAULT NULL COMMENT '商品',
  `service_end` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`cid`,`type`,`status`,`sort`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='礼包内容';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_area_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `cid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '类型（1满立减2送券3充值优惠）',
  `simg` varchar(255) DEFAULT NULL COMMENT '图标',
  `amount` decimal(10,2) DEFAULT NULL COMMENT '满足金额',
  `price` decimal(10,2) DEFAULT NULL COMMENT '减去金额',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `order_num` int(11) DEFAULT NULL COMMENT '完成顺序',
  `order_type` int(11) DEFAULT '1' COMMENT '完成奖励（1优惠券2兑换券）',
  `coupon` int(11) DEFAULT NULL COMMENT '优惠券',
  `service` int(11) DEFAULT NULL COMMENT '商品',
  `service_end` datetime DEFAULT NULL,
  `prize` int(11) DEFAULT '-1' COMMENT '领取状态（-1未领取1领取）',
  `status` int(11) DEFAULT '-1' COMMENT '状态（-1未完成1已完成）',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`cid`,`type`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='礼包记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext COMMENT '详情',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `type` int(11) DEFAULT NULL COMMENT '类型（1普通文章2优惠活动文章）',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `btn` varchar(255) DEFAULT NULL COMMENT '按钮文字',
  `link_type` int(11) DEFAULT '1' COMMENT '模式',
  `color` varchar(50) DEFAULT NULL COMMENT '按钮颜色',
  `simg` varchar(255) DEFAULT NULL COMMENT '图标',
  `sub_title` varchar(255) DEFAULT NULL COMMENT '副标题',
  `cid` int(11) DEFAULT NULL COMMENT '分类',
  `bimg` varchar(255) DEFAULT NULL COMMENT '封面',
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `lr_padding` varchar(50) DEFAULT NULL COMMENT '左右边距',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文章';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `type` int(11) DEFAULT '1' COMMENT '1首页2直播页',
  `bimg` varchar(255) DEFAULT NULL COMMENT '图片',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `appid` varchar(255) DEFAULT NULL COMMENT '小程序id',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='轮播图';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_birth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `coupon_status` int(11) DEFAULT '-1' COMMENT '优惠券',
  `coupon` longtext COMMENT '优惠券',
  `score_status` int(11) DEFAULT '-1' COMMENT '积分',
  `score` int(11) DEFAULT NULL COMMENT '积分',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`name`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='生日';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `type` int(11) DEFAULT NULL COMMENT '类型（1购买2赠送）',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',
  `amount` decimal(10,2) DEFAULT '0.00' COMMENT '充值金额',
  `status` int(11) DEFAULT '-1' COMMENT '状态（-1未使用1已使用2已赠送）',
  `send_openid` varchar(50) DEFAULT NULL COMMENT '赠送用户id',
  `send_id` int(11) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='充值卡';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '1' COMMENT '1店员2门店',
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='二维码';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `xkey` varchar(50) DEFAULT NULL COMMENT '关键字',
  `content` longtext COMMENT '内容',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`xkey`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='配置';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `plan_date` varchar(50) DEFAULT NULL COMMENT '时间',
  `order` int(11) DEFAULT '0' COMMENT '订单量',
  `amount` varchar(50) DEFAULT NULL COMMENT '金额',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `store` int(11) DEFAULT '-1' COMMENT '门店',
  `type` int(11) DEFAULT '1' COMMENT '类型（1月份2日期）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COMMENT='统计';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `name` varchar(50) DEFAULT NULL COMMENT '优惠价格',
  `condition` varchar(50) DEFAULT NULL COMMENT '满足条件',
  `times` longtext COMMENT '有效期',
  `total` int(11) DEFAULT '-1' COMMENT '总量',
  `type` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `score` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT '-1' COMMENT '限定门店使用',
  `mall_status` int(11) DEFAULT '-1' COMMENT '限定商品使用',
  `mall` int(11) DEFAULT NULL COMMENT '商品',
  `limit_get` varchar(50) DEFAULT NULL COMMENT '每人限领',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='优惠券';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_discuss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '产品id',
  `score` int(11) DEFAULT NULL COMMENT '评价（1满意2一般3不满意）',
  `content` longtext COMMENT '详情',
  `imgs` longtext COMMENT '图片集',
  `tip` int(11) DEFAULT '-1' COMMENT '匿名',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `type` int(11) DEFAULT '1' COMMENT '类型（1服务项目2技师）',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_discuss_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '产品id',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`pid`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论日志';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `service` int(11) DEFAULT NULL COMMENT '商品',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`end_time`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='兑换券';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '团长',
  `pid` int(11) DEFAULT NULL COMMENT '产品id',
  `team` longtext COMMENT '队伍',
  `status` int(11) DEFAULT '-1' COMMENT '状态（-1拼团中1成功2失败）',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `failtime` varchar(50) DEFAULT NULL COMMENT '失败天数',
  `total` int(11) DEFAULT '0' COMMENT '人数',
  `team_total` int(11) DEFAULT '0' COMMENT '团队人数',
  `group_public` int(11) DEFAULT '1' COMMENT '团购公开',
  `kind` varchar(50) DEFAULT NULL COMMENT '参数',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`pid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='团购';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `anchor_avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `anchor_name` varchar(50) DEFAULT NULL COMMENT '作者名',
  `roomid` int(11) DEFAULT NULL COMMENT '房间',
  `share_img` varchar(255) DEFAULT NULL COMMENT '封面',
  `cover_img` varchar(255) DEFAULT NULL COMMENT '背景图',
  `media_url` varchar(255) DEFAULT NULL COMMENT '直播地址',
  `goods` longtext COMMENT '商品',
  `service` longtext COMMENT '服务项目',
  `mall` longtext COMMENT '商品',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`name`,`anchor_name`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='直播回放';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '日期',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`plan_date`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='日志';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '日期',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`plan_date`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登录日志';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_mall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `title` varchar(255) DEFAULT NULL COMMENT '副标题',
  `cid` int(11) DEFAULT NULL COMMENT '分类',
  `simg` varchar(255) DEFAULT NULL COMMENT '封面',
  `bimg` longtext,
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `format` longtext COMMENT '多规格',
  `sold` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `content` longtext COMMENT '详情',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `type` int(11) DEFAULT NULL COMMENT '分销方法',
  `level_one` varchar(50) DEFAULT NULL COMMENT '一级分销',
  `level_two` varchar(50) DEFAULT NULL COMMENT '二级分销',
  `level_three` varchar(50) DEFAULT NULL COMMENT '三级分销',
  `kucun` int(11) DEFAULT '-1' COMMENT '库存',
  `store_type` int(11) DEFAULT '1' COMMENT '类型（1商城2积分商城）',
  `score` int(11) DEFAULT NULL COMMENT '积分数',
  `live_status` int(11) DEFAULT '-1' COMMENT '直播热销',
  `buy_limit` varchar(50) DEFAULT NULL COMMENT '每人限购',
  `sale_status` int(11) DEFAULT '1' COMMENT '会员折扣',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`,`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商城';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_moban_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `nickname` varchar(500) DEFAULT NULL COMMENT '呢称',
  `status` int(11) DEFAULT '-1' COMMENT '-1未使用  1已使用',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `ident` varchar(50) DEFAULT NULL COMMENT '标识',
  `headimgurl` varchar(500) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='绑定模版消息用户';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `simg` varchar(255) DEFAULT NULL COMMENT '图片',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `type` int(11) DEFAULT '1' COMMENT '位置（1首页2个人中心）',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='自定义导航';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT NULL COMMENT '门店',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '日期',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预约时间';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_online_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '发送者用户id',
  `type` int(11) DEFAULT NULL COMMENT '类型1文本2图片',
  `content` longtext COMMENT '内容',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `duty` int(11) DEFAULT '1' COMMENT '身份1客户2客服',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`type`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='客服记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_onlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `member` int(11) DEFAULT NULL COMMENT '未读条数',
  `type` int(11) DEFAULT NULL COMMENT '类型',
  `content` longtext COMMENT '内容',
  `updatetime` varchar(50) DEFAULT NULL COMMENT '更新时间',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`createtime`,`member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='客服';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `nick` varchar(255) DEFAULT NULL COMMENT '昵称',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `wx_out_trade_no` varchar(50) DEFAULT NULL COMMENT '微信订单号',
  `pid` int(11) DEFAULT NULL COMMENT '产品id',
  `kind` varchar(255) DEFAULT NULL COMMENT '种类',
  `total` int(11) DEFAULT NULL COMMENT '数量',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '预约时间',
  `userinfo` longtext COMMENT '用户信息',
  `amount` varchar(50) DEFAULT NULL COMMENT '应付款',
  `o_amount` varchar(50) DEFAULT NULL COMMENT '实付款',
  `status` int(11) DEFAULT '-1' COMMENT '支付状态（-1待支付1已支付2退款',
  `use` int(11) DEFAULT '-1' COMMENT '使用',
  `discuss` int(11) DEFAULT '-1' COMMENT '评论',
  `pay_type` int(11) DEFAULT NULL COMMENT '支付方式（1微信支付2余额支付）',
  `content` longtext COMMENT '备注',
  `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id',
  `coupon_price` varchar(50) DEFAULT NULL COMMENT '优惠价格',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `canpay` varchar(50) DEFAULT NULL COMMENT '余额支付',
  `wxpay` varchar(50) DEFAULT NULL COMMENT '微信支付',
  `refund_content` longtext COMMENT '退款理由',
  `refund_status` int(11) DEFAULT '-1' COMMENT '退款状态',
  `order_type` int(11) DEFAULT '1' COMMENT '1购买2充值3团购',
  `money` varchar(50) DEFAULT NULL COMMENT '钱包',
  `score` int(11) DEFAULT NULL COMMENT '获得积分数',
  `discount` varchar(50) DEFAULT NULL COMMENT '折扣',
  `group` int(11) DEFAULT NULL COMMENT '团购id',
  `one_openid` varchar(50) DEFAULT NULL COMMENT '一级推荐人',
  `one_amount` varchar(50) DEFAULT NULL COMMENT '一级佣金',
  `two_openid` varchar(50) DEFAULT NULL COMMENT '二级推荐人',
  `two_amount` varchar(50) DEFAULT NULL COMMENT '二级佣金',
  `three_openid` varchar(50) DEFAULT NULL COMMENT '三级推荐人',
  `three_amount` varchar(50) DEFAULT NULL COMMENT '三级佣金',
  `store` int(11) DEFAULT NULL COMMENT '门店',
  `member` int(11) DEFAULT NULL COMMENT '店员',
  `gift` varchar(50) DEFAULT NULL COMMENT '赠送金额',
  `charge_id` varchar(255) DEFAULT NULL,
  `service_type` int(11) DEFAULT NULL COMMENT '服务方式（1上门服务2到店服务）',
  `can_use` int(11) DEFAULT '1' COMMENT '使用次数',
  `is_use` int(11) DEFAULT '0' COMMENT '已使用',
  `buy_type` int(11) DEFAULT '1' COMMENT '买单方式（1自助付款2商家待扣）',
  `recharge_type` int(11) DEFAULT '1' COMMENT '充值方式（1会员充值2管理员充值）',
  `recharge_openid` varchar(50) DEFAULT NULL COMMENT '待充的用户id',
  `price` decimal(10,2) DEFAULT NULL COMMENT '单价',
  `flash` int(11) DEFAULT '-1' COMMENT '限时抢购',
  `flash_price` decimal(10,2) DEFAULT NULL COMMENT '抢购价格',
  `failtime` datetime DEFAULT NULL COMMENT '失效时间',
  `failstatus` int(11) DEFAULT '1' COMMENT '失效处理状态',
  `wq_out_trade_no` varchar(50) DEFAULT NULL,
  `he_log` longtext COMMENT '核销记录',
  `can_member` int(11) DEFAULT '1' COMMENT '预约人数',
  `member_discuss` int(11) DEFAULT '-1' COMMENT '人员评论',
  `callback1` longtext COMMENT '短信回调',
  `callback2` longtext COMMENT '打印回调',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `pei_type` int(11) DEFAULT '1' COMMENT '配送方式（1商家配送2自提）',
  `admin` varchar(50) DEFAULT NULL COMMENT '下单openid',
  `prize` int(11) DEFAULT NULL COMMENT '新人礼品',
  `prize_fee` varchar(50) DEFAULT NULL COMMENT '减去金额',
  `exchange` int(11) DEFAULT '-1' COMMENT '兑换券',
  `start_time` varchar(50) DEFAULT NULL COMMENT '开始时间',
  `end_time` varchar(50) DEFAULT NULL COMMENT '结束时间',
  `package` int(11) DEFAULT NULL COMMENT '套餐',
  `group_public` int(11) DEFAULT '1' COMMENT '团购是否公开（-1不公开1公开）',
  `format_index` int(11) DEFAULT '-1',
  `store_openid` varchar(50) DEFAULT NULL COMMENT '店长用户id',
  `store_fee` varchar(50) DEFAULT NULL COMMENT '店长提成',
  `store_fee_status` int(11) DEFAULT '-1' COMMENT '提成状态（-1未提1已提）',
  `member_openid` varchar(50) DEFAULT NULL COMMENT '店员用户id',
  `member_fee` varchar(50) DEFAULT NULL COMMENT '店员提成',
  `member_fee_status` int(11) DEFAULT '-1' COMMENT '提成状态（-1未提1已提）',
  `applytime` datetime DEFAULT NULL COMMENT '核销时间',
  `refundtime` datetime DEFAULT NULL COMMENT '退款时间',
  `admin_openid` varchar(50) DEFAULT NULL COMMENT '子管理员用户id',
  `admin_fee` varchar(50) DEFAULT NULL COMMENT '子管理员提成',
  `admin_fee_status` int(11) DEFAULT '-1' COMMENT '提成状态（-1未提1已提）',
  `plan_start` datetime DEFAULT NULL COMMENT '预约开始时间',
  `plan_end` datetime DEFAULT NULL COMMENT '预约结束时间',
  `yu_check` int(11) DEFAULT '-1' COMMENT '预约审核（-1不审核1需要审核）',
  `yu_check_result` int(11) DEFAULT '-1' COMMENT '预约结果（-1未处理1通过2拒绝）',
  `yu_check_content` longtext COMMENT '备注信息',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `tmpl` longtext COMMENT '订阅消息',
  `code` varchar(255) DEFAULT NULL COMMENT '核销二维码',
  `refund_amount` decimal(10,2) DEFAULT NULL COMMENT '退款金额',
  `date_type` int(11) DEFAULT '1' COMMENT '1默认时间2技师时间',
  `schedule_date` varchar(50) DEFAULT NULL COMMENT '预约日期',
  `schedule_start` varchar(50) DEFAULT NULL COMMENT '开始时间',
  `schedule_end` varchar(50) DEFAULT NULL COMMENT '结束时间',
  `service_fee` decimal(10,2) DEFAULT '0.00' COMMENT '技师服务费',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`out_trade_no`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=3189 DEFAULT CHARSET=utf8 COMMENT='订单';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_order_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `store` int(11) DEFAULT NULL COMMENT '门店',
  `store_name` varchar(50) DEFAULT NULL COMMENT '门店名称',
  `store_data` longtext COMMENT '门店数据',
  `service` int(11) DEFAULT NULL COMMENT '项目',
  `service_name` varchar(255) DEFAULT NULL COMMENT '项目名称',
  `service_data` longtext COMMENT '项目数据',
  `type` int(11) DEFAULT NULL COMMENT '类型（1服务项目2门店项目3商品）',
  `admin` int(11) DEFAULT NULL COMMENT '1后台2管理员3子管理员4店长5店员',
  `admin_name` varchar(255) DEFAULT NULL COMMENT '昵称',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`out_trade_no`,`store`,`service`,`type`,`admin`,`createtime`,`admin_name`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='核销记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `pid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `service` int(11) DEFAULT NULL COMMENT '服务项目',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `member` int(11) DEFAULT '0' COMMENT '总次数',
  `is_member` int(11) DEFAULT '0' COMMENT '已使用次数',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `store_status` int(11) DEFAULT '1' COMMENT '门店状态',
  `store` longtext COMMENT '门店',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `fee` decimal(10,2) DEFAULT NULL COMMENT '门店提成',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`out_trade_no`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='套餐详情';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `simg` varchar(255) DEFAULT NULL COMMENT '封面',
  `bimg` longtext COMMENT '图片',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',
  `service` longtext COMMENT '服务项目',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `content` longtext COMMENT '详情',
  `store_status` int(11) DEFAULT '1' COMMENT '门店状态',
  `store` longtext COMMENT '门店',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `time_type` int(11) DEFAULT '1' COMMENT '时间方式（1固定时间2时间周期）',
  `plan_date` int(11) DEFAULT '1' COMMENT '使用周期',
  `type` int(11) DEFAULT NULL COMMENT '分销方法',
  `level_one` varchar(50) DEFAULT NULL COMMENT '一级分销',
  `level_two` varchar(50) DEFAULT NULL COMMENT '二级分销',
  `level_three` varchar(50) DEFAULT NULL COMMENT '三级分销',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='套餐';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_package_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `out_trade_no` varchar(50) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `service` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `store` int(11) DEFAULT NULL COMMENT '门店',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `user_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `user_mobile` varchar(50) DEFAULT NULL COMMENT '电话',
  `member` varchar(50) DEFAULT NULL COMMENT '核销人',
  `content` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`pid`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='使用记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_pai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `interval` varchar(50) DEFAULT NULL COMMENT '时间间隔',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `midflytime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='排班';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_pai_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `weeknum` int(11) DEFAULT NULL COMMENT '1-7，表示周一到周天',
  `time1start` varchar(50) DEFAULT NULL COMMENT '开始时间',
  `time1end` varchar(50) DEFAULT NULL,
  `time2start` varchar(50) DEFAULT NULL,
  `time2end` varchar(50) DEFAULT NULL,
  `time3start` varchar(50) DEFAULT NULL,
  `time3end` varchar(50) DEFAULT NULL,
  `time4start` varchar(50) DEFAULT NULL,
  `time4end` varchar(255) DEFAULT NULL,
  `time5start` varchar(50) DEFAULT NULL,
  `time5end` varchar(50) DEFAULT NULL,
  `time6start` varchar(50) DEFAULT NULL,
  `time6end` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`pid`,`status`,`createtime`,`weeknum`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='排班详情';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_pick_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配货分类';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_pick_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `pid` longtext COMMENT '产品',
  `total` int(11) DEFAULT '0' COMMENT '数量',
  `amount` decimal(10,2) DEFAULT '0.00' COMMENT '总价',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_pick_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL COMMENT '分类',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',
  `unit` varchar(50) DEFAULT NULL COMMENT '单位',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配货';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '1' COMMENT '1取号',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件权限';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_prize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '类型',
  `cid` int(11) DEFAULT NULL COMMENT '优惠券',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `simg` varchar(255) DEFAULT NULL COMMENT '图片',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `times` int(11) DEFAULT '0' COMMENT '概率',
  `member` int(11) DEFAULT '-1' COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`type`,`status`,`sort`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='奖品';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_rotate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `times` int(11) DEFAULT '0' COMMENT '签到次数',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '签到日期',
  `status` int(11) DEFAULT '-1' COMMENT '是否已抽奖',
  `rotated` int(11) DEFAULT '0' COMMENT '抽奖次数',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='抽奖';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_rotate_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '优惠券id',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `type` int(11) DEFAULT '1' COMMENT '类型',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `cid` int(11) DEFAULT NULL COMMENT '奖品id',
  `code` varchar(255) DEFAULT NULL COMMENT '核销二维码',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='抽奖记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `status` int(11) DEFAULT '1' COMMENT '1获得2消费',
  `score` varchar(50) DEFAULT NULL COMMENT '积分',
  `over` varchar(50) DEFAULT NULL COMMENT '剩余积分',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `get_openid` varchar(50) DEFAULT NULL COMMENT '(被)赠送用户id',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_score_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` varchar(50) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `service` int(11) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL COMMENT '积分',
  `member` int(11) DEFAULT NULL COMMENT '数量',
  `address` longtext COMMENT '地址',
  `pei_type` int(11) DEFAULT NULL COMMENT '配送方式（1商家配送2自提）',
  `content` longtext COMMENT '备注',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `simg` varchar(255) DEFAULT NULL COMMENT '封面',
  `usetime` datetime DEFAULT NULL COMMENT '核销时间',
  `code` varchar(255) DEFAULT NULL COMMENT '核销二维码',
  `use_type` int(11) DEFAULT NULL COMMENT '核销方式（1后台2管理端）',
  `store` int(11) DEFAULT NULL COMMENT '门店',
  `store_name` varchar(255) DEFAULT NULL COMMENT '门店名称',
  `store_data` longtext COMMENT '门店数据',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='兑换记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `cid` int(11) DEFAULT NULL COMMENT '分类',
  `simg` varchar(255) DEFAULT NULL COMMENT '封面',
  `bimg` longtext COMMENT '图片',
  `price` varchar(50) DEFAULT NULL COMMENT '价格',
  `o_price` varchar(50) DEFAULT NULL COMMENT '原价',
  `kind` longtext COMMENT '种类',
  `discuss` int(11) DEFAULT '0' COMMENT '评价总人数',
  `discuss_total` int(11) DEFAULT '0' COMMENT '评价总数',
  `good_total` int(11) DEFAULT '0' COMMENT '满意总数',
  `middle_total` int(11) DEFAULT '0' COMMENT '一般总数',
  `bad_total` int(11) DEFAULT '0' COMMENT '不满意总数',
  `content` longtext COMMENT '详情',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `group_status` int(11) DEFAULT '-1' COMMENT '团购状态',
  `group_price` varchar(50) DEFAULT NULL COMMENT '团购价格',
  `group_total` int(11) DEFAULT '0' COMMENT '团购数',
  `group_limit` int(11) DEFAULT NULL COMMENT '团购限制天数',
  `group_index` int(11) DEFAULT '-1' COMMENT '团购首页显示',
  `group_number` int(11) DEFAULT NULL COMMENT '团购人数',
  `type` int(11) DEFAULT NULL COMMENT '分销方法',
  `level_one` varchar(50) DEFAULT NULL COMMENT '一级分销',
  `level_two` varchar(50) DEFAULT NULL COMMENT '二级分销',
  `level_three` varchar(50) DEFAULT NULL COMMENT '三级分销',
  `store_status` int(11) DEFAULT '1' COMMENT '门店状态',
  `store` longtext COMMENT '适用门店',
  `home` int(11) DEFAULT '1' COMMENT '家',
  `shop` int(11) DEFAULT '1' COMMENT '店',
  `service_time` varchar(50) DEFAULT NULL COMMENT '服务时间',
  `can_use` int(11) DEFAULT '1' COMMENT '核销次数',
  `sold` int(11) DEFAULT '0' COMMENT '已售数',
  `content_type` int(11) DEFAULT '1' COMMENT '详情模式',
  `content2` longtext COMMENT '详情2',
  `parameter` longtext COMMENT '参数',
  `flash_status` int(11) DEFAULT '-1' COMMENT '限时状态',
  `flash_price` decimal(10,2) DEFAULT '0.00' COMMENT '抢购价格',
  `flash_start` datetime DEFAULT NULL COMMENT '开始时间',
  `flash_end` datetime DEFAULT NULL COMMENT '结束时间',
  `flash_member` int(11) DEFAULT NULL COMMENT '库存',
  `flash_index` int(11) DEFAULT '-1' COMMENT '首页显示',
  `flash_order` int(11) DEFAULT '0' COMMENT '每人限买单数',
  `flash_shu` int(11) DEFAULT '0' COMMENT '每单限购数',
  `sale_status` int(11) DEFAULT '-1' COMMENT '折扣状态',
  `group_stock` int(11) DEFAULT '-1' COMMENT '团购库存',
  `group_head_status` int(11) DEFAULT '-1' COMMENT '团长优惠',
  `group_head_price` varchar(50) DEFAULT NULL COMMENT '团长优惠价格',
  `share_title` varchar(255) DEFAULT NULL COMMENT '分享标题',
  `share_img` varchar(255) DEFAULT NULL COMMENT '分享图片',
  `group_order` int(11) DEFAULT '-1' COMMENT '团购每单限量',
  `group_orders` int(11) DEFAULT '-1' COMMENT '团购每人限量',
  `group_public` int(11) DEFAULT '-1' COMMENT '团购公开功能',
  `store_fee` varchar(50) DEFAULT NULL COMMENT '提成金额',
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `service_times` int(11) DEFAULT NULL COMMENT '服务时长',
  `date_type` int(11) DEFAULT '1' COMMENT '预约时间（1默认2技师）',
  `group_index_price` varchar(50) DEFAULT NULL COMMENT '团购首页原价显示名称',
  `date_interval` int(11) DEFAULT '1' COMMENT '时间间隔（1有2无）',
  `reserve` int(11) DEFAULT NULL COMMENT '门店项目关联',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`cid`,`status`,`sort`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='列表';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_service_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `bimg` varchar(255) DEFAULT NULL COMMENT '图片',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `index` int(11) DEFAULT '-1' COMMENT '首页显示',
  `type` int(11) DEFAULT '1' COMMENT '类型（1服务项目2商城）',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='分类';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `amount` varchar(50) DEFAULT NULL COMMENT '金额',
  `level` int(11) DEFAULT NULL COMMENT '等级',
  `status` int(11) DEFAULT '1' COMMENT '状态（-1等待1成功2失败）',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`createtime`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分销订单';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '产品id',
  `total` int(11) DEFAULT '0' COMMENT '数量',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`pid`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `type` int(11) DEFAULT NULL COMMENT '类型（1阿里云2聚合数据3模板消息）',
  `accesskeyid` varchar(50) DEFAULT NULL COMMENT 'AccessKeyId',
  `accesskeysecret` varchar(50) DEFAULT NULL COMMENT 'AccessKeySecret',
  `sign` varchar(50) DEFAULT NULL COMMENT '短信签名',
  `code` varchar(50) DEFAULT NULL COMMENT '模版CODE',
  `appkey` varchar(50) DEFAULT NULL COMMENT 'APPKEY',
  `tpl_id` varchar(50) DEFAULT NULL COMMENT '短信模板ID',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机号',
  `topcolor` varchar(50) DEFAULT NULL COMMENT '模板内容字体',
  `template_example` longtext,
  `template_name` varchar(50) DEFAULT NULL,
  `template_id` varchar(50) DEFAULT '',
  `template_data` longtext,
  `userlist` longtext,
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`type`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信配置';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_sms_birth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '生日',
  `smsback` longtext COMMENT '结果',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`plan_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='生日提醒发送记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `simg` varchar(255) DEFAULT NULL COMMENT '图标',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `address` longtext COMMENT '地址',
  `map` longtext COMMENT '地址',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '营业时间',
  `content` longtext COMMENT '详情',
  `code` varchar(255) DEFAULT NULL COMMENT '买单二维码',
  `sms` varchar(50) DEFAULT NULL COMMENT '短信接收手机号',
  `machine_code` varchar(255) DEFAULT NULL COMMENT '打印机终端号',
  `msign` varchar(255) DEFAULT NULL COMMENT '打印机终端密钥',
  `sn` varchar(255) DEFAULT NULL COMMENT '打印机编号',
  `print_status` int(11) DEFAULT '-1' COMMENT '打印状态',
  `bimg` varchar(255) DEFAULT NULL COMMENT '封面',
  `code2` varchar(255) DEFAULT NULL COMMENT '二维码',
  `store_manager` varchar(50) DEFAULT NULL COMMENT '提成店长',
  `store_fee` varchar(50) DEFAULT NULL COMMENT '提成金额',
  `userlist` longtext COMMENT '绑定用户',
  `store_admin` varchar(50) DEFAULT NULL COMMENT '提成子管理员',
  `store_admin_fee` varchar(50) DEFAULT NULL COMMENT '提成金额',
  `distance_status` int(11) DEFAULT '-1' COMMENT '上门服务限制距离',
  `distance` varchar(50) DEFAULT NULL COMMENT '距离',
  `sms_refund` int(11) DEFAULT NULL COMMENT '申请退款通知',
  `sms_birth` int(11) DEFAULT NULL COMMENT '生日提醒',
  `sms_birth_user` longtext COMMENT '生日提醒接收用户',
  `content_type` int(11) DEFAULT '1' COMMENT '详情类型（1图文2编辑器）',
  `content2` longtext COMMENT '详情',
  `cell_status` int(11) DEFAULT '-1' COMMENT '联系我',
  `cell_id` varchar(255) DEFAULT NULL,
  `take_status` int(11) DEFAULT '-1' COMMENT '挂号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='门店管理';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_store_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `type` int(11) DEFAULT NULL COMMENT '类型（1收入2支出）',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `amount` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `pid` varchar(50) DEFAULT NULL COMMENT '关联id',
  `username` varchar(50) DEFAULT NULL COMMENT '微信账号',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号码',
  `wx_out_trade_no` varchar(50) DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`type`,`pid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='提成记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_store_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `simg` varchar(255) DEFAULT NULL COMMENT '头像',
  `cid` int(11) DEFAULT '0' COMMENT '店面',
  `task` varchar(255) DEFAULT NULL COMMENT '职称',
  `service` longtext COMMENT '服务项目',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `tag` varchar(255) DEFAULT NULL COMMENT '标签',
  `content` longtext COMMENT '个人简介',
  `zan` int(11) DEFAULT '0' COMMENT '点赞人数',
  `discuss` int(11) DEFAULT '0' COMMENT '评论数',
  `pai_status` int(11) DEFAULT '-1' COMMENT '单双周状态',
  `pai1` int(11) DEFAULT NULL COMMENT '排版',
  `pai2` int(11) DEFAULT NULL COMMENT '排版2',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `bimg` longtext COMMENT '作品',
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `shop` int(11) DEFAULT '1',
  `home` int(11) DEFAULT '1',
  `zuo_pin` longtext COMMENT '作品',
  `store_manager` varchar(50) DEFAULT NULL COMMENT '提成店员',
  `buy_fee` varchar(50) DEFAULT NULL COMMENT '买单提成',
  `buy_code` varchar(255) DEFAULT NULL COMMENT '买单二维码',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `store` longtext,
  `userlist` longtext COMMENT '绑定用户',
  `service_fee` decimal(10,2) DEFAULT '0.00' COMMENT '服务费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='店员管理';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_store_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `price` varchar(50) DEFAULT NULL COMMENT '价格',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `home` int(11) DEFAULT '1' COMMENT '上门服务',
  `shop` int(11) DEFAULT '1' COMMENT '到店服务',
  `can_use` int(11) DEFAULT '1' COMMENT '核销次数',
  `member` varchar(50) DEFAULT NULL COMMENT '抵扣预约人数',
  `sale_status` int(11) DEFAULT '-1' COMMENT '折扣功能',
  `service_times` int(11) DEFAULT NULL COMMENT '服务时间',
  `date_type` int(11) DEFAULT '1' COMMENT '预约时间（1默认2技师）',
  `date_interval` int(11) DEFAULT '1' COMMENT '时间间隔（1有2无）',
  `simg` varchar(255) DEFAULT NULL COMMENT '封面',
  `bimg` longtext COMMENT '轮播图',
  `content` longtext COMMENT '详情',
  `take_status` int(11) DEFAULT '-1' COMMENT '取号',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`sort`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='门店服务';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_take_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT NULL COMMENT '门店',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '日期',
  `code` int(11) DEFAULT NULL COMMENT '号码',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`store`,`plan_date`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='取号号码';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_take_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `store` varchar(50) DEFAULT NULL COMMENT '门店',
  `store_name` varchar(255) DEFAULT NULL COMMENT '门店名称',
  `store_data` longtext COMMENT '门店数据',
  `service` int(11) DEFAULT NULL COMMENT '项目',
  `service_name` varchar(255) DEFAULT NULL COMMENT '项目名称',
  `service_data` longtext COMMENT '项目数据',
  `code` int(11) DEFAULT NULL COMMENT '号码',
  `service_times` int(11) DEFAULT NULL COMMENT '服务时间',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `status` int(11) DEFAULT '1' COMMENT '状态（-1取消1排队中2呼叫中3服务中4过号5完成）',
  `cancel_result` varchar(255) DEFAULT NULL COMMENT '取消原因',
  `cancel_content` varchar(255) DEFAULT NULL COMMENT '详细原因',
  `cancel_time` datetime DEFAULT NULL COMMENT '取消时间',
  `start_time` datetime DEFAULT NULL COMMENT '服务开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '服务结束时间',
  `member` int(11) DEFAULT NULL COMMENT '服务技师',
  `member_name` varchar(50) DEFAULT NULL COMMENT '技师名称',
  `member_data` longtext COMMENT '技师数据',
  `content` varchar(255) DEFAULT NULL COMMENT '备注',
  `tmpl` longtext COMMENT '模板消息',
  `call_times` int(11) DEFAULT '0' COMMENT '呼叫次数',
  `call_status` int(11) DEFAULT '-1' COMMENT '叫号状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`store`,`service`,`code`,`status`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='取号';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `week` int(11) DEFAULT NULL COMMENT '星期',
  `content` longtext COMMENT '详情',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='预约时间';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_times_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `member` int(11) DEFAULT NULL COMMENT '人员',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '日期',
  `total` int(11) DEFAULT '0' COMMENT '已预约数量',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `date_type` int(11) DEFAULT '1' COMMENT '1默认时间2技师时间',
  `schedule_date` varchar(50) DEFAULT NULL COMMENT '预约日期',
  `schedule_start` varchar(50) DEFAULT NULL COMMENT '开始时间',
  `schedule_end` varchar(50) DEFAULT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 COMMENT='预约时间记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_user_birth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '生日礼包id',
  `birth_data` longtext COMMENT '数据',
  `plan_date` varchar(50) DEFAULT NULL COMMENT '生日',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`pid`,`plan_date`,`createtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户生日礼包领取记录';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_user_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `cid` int(11) DEFAULT NULL COMMENT '优惠券id',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户优惠券';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `nick` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `money` varchar(50) DEFAULT '0' COMMENT '余额',
  `card` int(11) DEFAULT '-1' COMMENT '会员卡状态（-1未激活1激活）',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `password` varchar(50) DEFAULT NULL COMMENT '支付密码',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `score` int(11) DEFAULT '0' COMMENT '积分',
  `share` varchar(50) DEFAULT NULL COMMENT '推荐人openid',
  `level_one` int(11) DEFAULT '0' COMMENT '一级数量',
  `level_two` int(11) DEFAULT '0' COMMENT '二级数量',
  `level_three` int(11) DEFAULT '0' COMMENT '三级数量',
  `share_amount` varchar(50) DEFAULT '0' COMMENT '累计佣金',
  `share_o_amount` varchar(50) DEFAULT '0' COMMENT '可提现佣金',
  `share_t_amount` varchar(50) DEFAULT '0' COMMENT '已提现佣金',
  `share_empty` varchar(50) DEFAULT '0' COMMENT '无效佣金',
  `shop` int(11) DEFAULT '-1' COMMENT '店铺管理',
  `store` int(11) DEFAULT NULL COMMENT '绑定门店',
  `shop_id` int(11) DEFAULT NULL COMMENT '子管理员门店id',
  `card_name` varchar(50) DEFAULT NULL COMMENT '会员等级',
  `card_price` varchar(50) DEFAULT NULL COMMENT '会员折扣',
  `card_amount` decimal(10,2) DEFAULT '0.00' COMMENT '消费金额',
  `code` varchar(255) DEFAULT NULL COMMENT '二维码',
  `prize` int(11) DEFAULT '-1' COMMENT '新人礼包',
  `store_fee` decimal(10,2) DEFAULT '0.00' COMMENT '门店提成',
  `sub_type` int(11) DEFAULT NULL,
  `sub_store` longtext,
  `line` int(11) DEFAULT '-1' COMMENT '客服',
  `opentime` datetime DEFAULT NULL COMMENT '激活时间',
  `admin_fee` decimal(10,2) DEFAULT '0.00' COMMENT '子管理员提成',
  `order_fee` decimal(10,2) DEFAULT '0.00' COMMENT '虚拟消费金额',
  `birth` varchar(50) DEFAULT NULL COMMENT '生日',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=3172 DEFAULT CHARSET=utf8 COMMENT='用户信息';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pay_type` int(11) DEFAULT '1' COMMENT '提现方式（1微信2支付宝）',
  `username` varchar(50) DEFAULT NULL COMMENT '账号',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `amount` varchar(50) DEFAULT NULL COMMENT '金额',
  `money` varchar(50) DEFAULT NULL COMMENT '余额',
  `status` int(11) DEFAULT '-1' COMMENT '状态（-1待处理1成功2失败）',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  `order_type` int(11) DEFAULT '1' COMMENT '提现类型(1余额提现2佣金提现)',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `wx_out_trade_no` varchar(50) DEFAULT NULL COMMENT '微信订单号',
  `content` longtext COMMENT '错误详情',
  `fee` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`openid`,`createtime`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提现申请';


CREATE TABLE IF NOT EXISTS `ims_xc_beauty_zan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '技师id',
  `status` int(11) DEFAULT '-1' COMMENT '状态',
  `createtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`pid`,`status`,`createtime`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COMMENT='点赞记录';

";
pdo_run($sql);
if(!pdo_fieldexists("xc_beauty_address", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_address", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_address", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_address", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_address", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_address", "address")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `address` longtext;");
}
if(!pdo_fieldexists("xc_beauty_address", "map")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `map` longtext;");
}
if(!pdo_fieldexists("xc_beauty_address", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_address", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_address", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_address")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_apply", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_apply", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_apply", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_apply", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_apply", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_apply", "address")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `address` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_apply", "map")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `map` longtext;");
}
if(!pdo_fieldexists("xc_beauty_apply", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `content` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_apply", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_apply", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_apply", "applytime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_apply")." ADD `applytime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_area", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_area", "bimgt")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `bimgt` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_area", "bimgb")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `bimgb` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_area", "down_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `down_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_area", "down_title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `down_title` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `order_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_area", "order_title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `order_title` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area", "pay_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `pay_type` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_area", "pay_title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `pay_title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_area", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_area", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_area", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `createtime` timestamp DEFAULT 'CURRENT_TIMESTAMP';");
}
if(!pdo_fieldexists("xc_beauty_area", "backcolor")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area")." ADD `backcolor` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_area_item", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_area_item", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `start_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_item", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `end_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_item", "order_num")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `order_num` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "order_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `order_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_area_item", "coupon")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `coupon` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_item", "service_end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `service_end` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_item", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_area_item", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_area_item", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_item")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_area_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `amount` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `price` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `start_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_log", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `end_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_log", "order_num")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `order_num` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "order_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `order_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_area_log", "coupon")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `coupon` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_area_log", "service_end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `service_end` datetime;");
}
if(!pdo_fieldexists("xc_beauty_area_log", "prize")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `prize` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_area_log", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_area_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_area_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_article", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_article", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_article", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_article", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_article", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_article", "link")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `link` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "btn")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `btn` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "link_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `link_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_article", "color")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `color` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_article", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "sub_title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `sub_title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_article", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `bimg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_article", "lr_padding")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_article")." ADD `lr_padding` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_banner", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_banner", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_banner", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_banner", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_banner", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `bimg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_banner", "link")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `link` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_banner", "appid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `appid` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_banner", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_banner", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_banner", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_banner")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_birth", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_birth", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_birth", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_birth", "coupon_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `coupon_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_birth", "coupon")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `coupon` longtext;");
}
if(!pdo_fieldexists("xc_beauty_birth", "score_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `score_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_birth", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `score` int(11);");
}
if(!pdo_fieldexists("xc_beauty_birth", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_birth", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_birth", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_birth")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_card", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_card", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_card", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_card", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_card", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_card", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `amount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_card", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_card", "send_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `send_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_card", "send_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `send_id` int(11);");
}
if(!pdo_fieldexists("xc_beauty_card", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_card")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_code", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_code", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_code", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_code", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_code", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_code", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_code", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_code")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_config", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_config")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_config", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_config")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_config", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_config")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_config", "xkey")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_config")." ADD `xkey` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_config", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_config")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_count", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_count", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_count", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_count", "order")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `order` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_count", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_count", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_count", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `store` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_count", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_count")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_coupon", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_coupon", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `title` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "condition")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `condition` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `times` longtext;");
}
if(!pdo_fieldexists("xc_beauty_coupon", "total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `total` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_coupon", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_coupon", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_coupon", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_coupon", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `score` int(11);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `store` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_coupon", "mall_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `mall_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_coupon", "mall")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `mall` int(11);");
}
if(!pdo_fieldexists("xc_beauty_coupon", "limit_get")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_coupon")." ADD `limit_get` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_discuss", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_discuss", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_discuss", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_discuss", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_discuss", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `score` int(11);");
}
if(!pdo_fieldexists("xc_beauty_discuss", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_discuss", "imgs")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `imgs` longtext;");
}
if(!pdo_fieldexists("xc_beauty_discuss", "tip")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `tip` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_discuss", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_discuss", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_discuss", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_discuss_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_discuss_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_discuss_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_discuss_log", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss_log")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_discuss_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_discuss_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_exchange", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_exchange", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_exchange", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_exchange", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_exchange", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_exchange", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `end_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_exchange", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_exchange")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_group", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_group", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_group", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_group", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_group", "team")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `team` longtext;");
}
if(!pdo_fieldexists("xc_beauty_group", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_group", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_group", "failtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `failtime` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_group", "total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_group", "team_total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `team_total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_group", "group_public")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `group_public` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_group", "kind")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_group")." ADD `kind` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_live", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_live", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_live", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_live", "anchor_avatar")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `anchor_avatar` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_live", "anchor_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `anchor_name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_live", "roomid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `roomid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_live", "share_img")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `share_img` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_live", "cover_img")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `cover_img` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_live", "media_url")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `media_url` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_live", "goods")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `goods` longtext;");
}
if(!pdo_fieldexists("xc_beauty_live", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `service` longtext;");
}
if(!pdo_fieldexists("xc_beauty_live", "mall")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `mall` longtext;");
}
if(!pdo_fieldexists("xc_beauty_live", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_live", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_live", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_live")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_log", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_log")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_login_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_login_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_login_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_login_log")." ADD `uniacid` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_login_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_login_log")." ADD `openid` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_login_log", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_login_log")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_login_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_login_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_mall", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_mall", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_mall", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_mall", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_mall", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_mall", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_mall", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `bimg` longtext;");
}
if(!pdo_fieldexists("xc_beauty_mall", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `price` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_mall", "format")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `format` longtext;");
}
if(!pdo_fieldexists("xc_beauty_mall", "sold")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `sold` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_mall", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_mall", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_mall", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_mall", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_mall", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_mall", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_mall", "level_one")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `level_one` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_mall", "level_two")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `level_two` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_mall", "level_three")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `level_three` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_mall", "kucun")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `kucun` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_mall", "store_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `store_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_mall", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `score` int(11);");
}
if(!pdo_fieldexists("xc_beauty_mall", "live_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `live_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_mall", "buy_limit")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `buy_limit` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_mall", "sale_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_mall")." ADD `sale_status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `nickname` varchar(500);");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "ident")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `ident` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_moban_user", "headimgurl")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_moban_user")." ADD `headimgurl` varchar(500);");
}
if(!pdo_fieldexists("xc_beauty_nav", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_nav", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_nav", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_nav", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_nav", "link")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `link` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_nav", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_nav", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_nav", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_nav", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_nav")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_online", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_online", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_online", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_online", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_online", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_online", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_online_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_online_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_online_log", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_online_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_online_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_online_log", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_online_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_online_log", "duty")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_online_log")." ADD `duty` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_onlines", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_onlines", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_onlines", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_onlines", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `member` int(11);");
}
if(!pdo_fieldexists("xc_beauty_onlines", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_onlines", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_onlines", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `updatetime` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_onlines", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_onlines")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_order", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "nick")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `nick` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "wx_out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `wx_out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "kind")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `kind` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order", "total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `total` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "userinfo")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `userinfo` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "o_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `o_amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "use")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `use` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "discuss")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `discuss` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "pay_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `pay_type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "coupon_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `coupon_id` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "coupon_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `coupon_price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "canpay")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `canpay` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "wxpay")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `wxpay` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "refund_content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `refund_content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "refund_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `refund_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "order_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `order_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "money")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `money` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `score` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "discount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `discount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "group")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `group` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "one_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `one_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "one_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `one_amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "two_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `two_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "two_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `two_amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "three_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `three_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "three_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `three_amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `member` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "gift")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `gift` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "charge_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `charge_id` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order", "service_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `service_type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "can_use")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `can_use` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "is_use")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `is_use` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_order", "buy_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `buy_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "recharge_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `recharge_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "recharge_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `recharge_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `price` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_order", "flash")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `flash` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "flash_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `flash_price` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_order", "failtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `failtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "failstatus")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `failstatus` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "wq_out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `wq_out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "he_log")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `he_log` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "can_member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `can_member` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "member_discuss")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `member_discuss` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "callback1")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `callback1` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "callback2")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `callback2` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order", "pei_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `pei_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "admin")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `admin` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "prize")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `prize` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "prize_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `prize_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "exchange")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `exchange` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `start_time` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `end_time` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "package")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `package` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order", "group_public")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `group_public` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "format_index")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `format_index` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "store_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `store_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "store_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `store_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "store_fee_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `store_fee_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "member_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `member_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "member_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `member_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "member_fee_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `member_fee_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "applytime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `applytime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "refundtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `refundtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "admin_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `admin_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "admin_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `admin_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "admin_fee_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `admin_fee_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "plan_start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `plan_start` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "plan_end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `plan_end` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order", "yu_check")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `yu_check` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "yu_check_result")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `yu_check_result` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_order", "yu_check_content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `yu_check_content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "tmpl")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `tmpl` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order", "refund_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `refund_amount` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_order", "date_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `date_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order", "schedule_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `schedule_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "schedule_start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `schedule_start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "schedule_end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `schedule_end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order", "service_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order")." ADD `service_fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_order_check", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_order_check", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "store_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `store_name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "store_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `store_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order_check", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "service_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `service_name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "service_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `service_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order_check", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "admin")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `admin` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "admin_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `admin_name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order_check", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_check")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `member` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "is_member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `is_member` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `start_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `end_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "store_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `store_status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `store` longtext;");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_order_detail", "fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_order_detail")." ADD `fee` decimal(10,2);");
}
if(!pdo_fieldexists("xc_beauty_package", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_package", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_package", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_package", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `bimg` longtext;");
}
if(!pdo_fieldexists("xc_beauty_package", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_package", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `service` longtext;");
}
if(!pdo_fieldexists("xc_beauty_package", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `start_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_package", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `end_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_package", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_package", "store_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `store_status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_package", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `store` longtext;");
}
if(!pdo_fieldexists("xc_beauty_package", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_package", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_package", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_package", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_package", "time_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `time_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_package", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `plan_date` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_package", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_package", "level_one")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `level_one` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package", "level_two")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `level_two` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package", "level_three")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package")." ADD `level_three` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_package_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_package_log", "user_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `user_name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "user_mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `user_mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `member` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `content` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_package_log", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_package_log")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_pai", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_pai", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pai", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai", "interval")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `interval` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_pai", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_pai", "midflytime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai")." ADD `midflytime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "weeknum")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `weeknum` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time1start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time1start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time1end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time1end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time2start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time2start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time2end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time2end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time3start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time3start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time3end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time3end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time4start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time4start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time4end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time4end` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time5start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time5start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time5end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time5end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time6start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time6start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "time6end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `time6end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_pai_detail", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pai_detail")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_pick_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_class")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_pick_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_class")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pick_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_class")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pick_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_class")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_pick_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_class")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_pick_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_class")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `pid` longtext;");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `amount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_pick_order", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_order")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "unit")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `unit` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_pick_service", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_pick_service")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_plugin", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_plugin")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_plugin", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_plugin")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_plugin", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_plugin")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_plugin", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_plugin")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_prize", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_prize", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_prize", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_prize", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_prize", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_prize", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_prize", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_prize", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_prize", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_prize", "times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `times` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_prize", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_prize")." ADD `member` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_rotate", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_rotate", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_rotate", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_rotate", "times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `times` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_rotate", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_rotate", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_rotate", "rotated")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate")." ADD `rotated` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_rotate_log", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_rotate_log")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_score", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_score", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `title` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_score", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `score` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score", "over")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `over` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_score", "get_openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score")." ADD `get_openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_score_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `uniacid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "service_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `service_name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `score` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `member` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "address")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `address` longtext;");
}
if(!pdo_fieldexists("xc_beauty_score_log", "pei_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `pei_type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_score_log", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_score_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_score_log", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "usetime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `usetime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_score_log", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "use_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `use_type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "store_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `store_name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_score_log", "store_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_score_log")." ADD `store_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_service", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_service", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `bimg` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "o_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `o_price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "kind")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `kind` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "discuss")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `discuss` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "discuss_total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `discuss_total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "good_total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `good_total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "middle_total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `middle_total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "bad_total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `bad_total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_service", "group_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "group_total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_limit")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_limit` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "group_index")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_index` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_number")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_number` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "level_one")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `level_one` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "level_two")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `level_two` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "level_three")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `level_three` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "store_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `store_status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `store` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "home")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `home` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "shop")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `shop` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "service_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `service_time` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "can_use")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `can_use` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "sold")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `sold` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "content_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `content_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "content2")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `content2` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "parameter")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `parameter` longtext;");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_start` datetime;");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_end` datetime;");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_member` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_index")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_index` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_order")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_order` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "flash_shu")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `flash_shu` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service", "sale_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `sale_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_stock")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_stock` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_head_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_head_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_head_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_head_price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `share_title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_service", "share_img")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `share_img` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_service", "group_order")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_order` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_orders")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_orders` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_public")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_public` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service", "store_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `store_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_service", "service_times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `service_times` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service", "date_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `date_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "group_index_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `group_index_price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service", "date_interval")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `date_interval` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service", "reserve")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service")." ADD `reserve` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service_class", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_service_class", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_service_class", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_service_class", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `bimg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_service_class", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_service_class", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_service_class", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_service_class", "index")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `index` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_service_class", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_service_class")." ADD `type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_share", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_share", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_share", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_share", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_share", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_share", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_share", "level")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `level` int(11);");
}
if(!pdo_fieldexists("xc_beauty_share", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_share", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_share")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_shop", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_shop", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_shop", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_shop", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_shop", "total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_shop", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_shop", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_shop")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_sms", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_sms", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_sms", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_sms", "accesskeyid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `accesskeyid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "accesskeysecret")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `accesskeysecret` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "sign")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `sign` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `code` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "appkey")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `appkey` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "tpl_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `tpl_id` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `mobile` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_sms", "topcolor")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `topcolor` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "template_example")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `template_example` longtext;");
}
if(!pdo_fieldexists("xc_beauty_sms", "template_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `template_name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms", "template_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `template_id` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists("xc_beauty_sms", "template_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `template_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_sms", "userlist")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `userlist` longtext;");
}
if(!pdo_fieldexists("xc_beauty_sms", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_sms", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_sms_birth", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms_birth")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_sms_birth", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms_birth")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_sms_birth", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms_birth")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms_birth", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms_birth")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_sms_birth", "smsback")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms_birth")." ADD `smsback` longtext;");
}
if(!pdo_fieldexists("xc_beauty_sms_birth", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_sms_birth")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_store", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_store", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "address")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `address` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store", "map")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `map` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_store", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_store", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "sms")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `sms` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "machine_code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `machine_code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "msign")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `msign` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "sn")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `sn` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "print_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `print_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `bimg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "code2")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `code2` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "store_manager")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `store_manager` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "store_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `store_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "userlist")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `userlist` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store", "store_admin")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `store_admin` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "store_admin_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `store_admin_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "distance_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `distance_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store", "distance")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `distance` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store", "sms_refund")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `sms_refund` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store", "sms_birth")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `sms_birth` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store", "sms_birth_user")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `sms_birth_user` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store", "content_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `content_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store", "content2")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `content2` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store", "cell_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `cell_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store", "cell_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `cell_id` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store", "take_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store")." ADD `take_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `title` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `amount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `pid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "username")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `username` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "wx_out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `wx_out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store_fee", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_fee")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `cid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "task")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `task` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `service` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "tag")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `tag` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "zan")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `zan` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "discuss")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `discuss` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "pai_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `pai_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "pai1")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `pai1` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "pai2")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `pai2` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "title")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `title` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `bimg` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "shop")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `shop` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "home")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `home` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_member", "zuo_pin")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `zuo_pin` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "store_manager")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `store_manager` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "buy_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `buy_fee` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "buy_code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `buy_code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_member", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `store` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "userlist")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `userlist` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_member", "service_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_member")." ADD `service_fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_store_service", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_service", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_service", "price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_service", "sort")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_store_service", "home")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `home` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "shop")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `shop` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "can_use")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `can_use` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `member` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_store_service", "sale_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `sale_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "service_times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `service_times` int(11);");
}
if(!pdo_fieldexists("xc_beauty_store_service", "date_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `date_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "date_interval")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `date_interval` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_store_service", "simg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `simg` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_store_service", "bimg")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `bimg` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_service", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_store_service", "take_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_store_service")." ADD `take_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_take_code", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_code")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_take_code", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_code")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_code", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_code")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_code", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_code")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_take_code", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_code")." ADD `code` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_code", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_code")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `openid` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `store` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "store_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `store_name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "store_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `store_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "service")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `service` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "service_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `service_name` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "service_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `service_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `code` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "service_times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `service_times` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_take_number", "cancel_result")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `cancel_result` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "cancel_content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `cancel_content` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "cancel_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `cancel_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "start_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `start_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `end_time` datetime;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `member` int(11);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "member_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `member_name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "member_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `member_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `content` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_take_number", "tmpl")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `tmpl` longtext;");
}
if(!pdo_fieldexists("xc_beauty_take_number", "call_times")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `call_times` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_take_number", "call_status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `call_status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_take_number", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_take_number")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_times", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_times", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_times", "week")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times")." ADD `week` int(11);");
}
if(!pdo_fieldexists("xc_beauty_times", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_times", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_times", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_times_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_times_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_times_log", "member")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `member` int(11);");
}
if(!pdo_fieldexists("xc_beauty_times_log", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_times_log", "total")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_times_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_times_log", "date_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `date_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_times_log", "schedule_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `schedule_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_times_log", "schedule_start")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `schedule_start` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_times_log", "schedule_end")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_times_log")." ADD `schedule_end` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "birth_data")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `birth_data` longtext;");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "plan_date")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `plan_date` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_user_birth", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_birth")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_user_coupon", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_coupon")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_user_coupon", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_coupon")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_user_coupon", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_coupon")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_user_coupon", "cid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_coupon")." ADD `cid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_user_coupon", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_coupon")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_user_coupon", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_user_coupon")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `avatar` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "nick")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `nick` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "money")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `money` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "card")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `card` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "password")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `password` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "score")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `score` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "share")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `share` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "level_one")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `level_one` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "level_two")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `level_two` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "level_three")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `level_three` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "share_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `share_amount` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "share_o_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `share_o_amount` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "share_t_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `share_t_amount` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "share_empty")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `share_empty` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "shop")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `shop` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `store` int(11);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "shop_id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `shop_id` int(11);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "card_name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `card_name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "card_price")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `card_price` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "card_amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `card_amount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "code")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `code` varchar(255);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "prize")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `prize` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "store_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `store_fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "sub_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `sub_type` int(11);");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "sub_store")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `sub_store` longtext;");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "line")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `line` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "opentime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `opentime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "admin_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `admin_fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "order_fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `order_fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_userinfo", "birth")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_userinfo")." ADD `birth` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "pay_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `pay_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "username")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `username` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `mobile` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "name")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "amount")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `amount` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "money")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `money` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `createtime` datetime;");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "order_type")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `order_type` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "wx_out_trade_no")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `wx_out_trade_no` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "content")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `content` longtext;");
}
if(!pdo_fieldexists("xc_beauty_withdraw", "fee")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_withdraw")." ADD `fee` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("xc_beauty_zan", "id")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_zan")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("xc_beauty_zan", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_zan")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_zan", "openid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_zan")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("xc_beauty_zan", "pid")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_zan")." ADD `pid` int(11);");
}
if(!pdo_fieldexists("xc_beauty_zan", "status")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_zan")." ADD `status` int(11) DEFAULT '-1';");
}
if(!pdo_fieldexists("xc_beauty_zan", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("xc_beauty_zan")." ADD `createtime` datetime;");
}
