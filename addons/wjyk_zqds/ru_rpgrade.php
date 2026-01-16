<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `uid` varchar(155) NOT NULL,
  `consignee` varchar(155) NOT NULL COMMENT '收货人姓名',
  `consignee_phone` varchar(155) NOT NULL COMMENT '收货人电话',
  `province` varchar(100) NOT NULL COMMENT '省',
  `city` varchar(100) NOT NULL COMMENT '市',
  `county` varchar(100) NOT NULL COMMENT '区',
  `location` varchar(255) NOT NULL COMMENT '省/市/区',
  `detail` varchar(255) NOT NULL COMMENT '详细地址',
  `is_default` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-默认，2-非默认',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收货地址表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本地，2-自制',
  `url` text COMMENT 'url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='背景图表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `b_type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-首页轮播图，2-商城轮播图 3-电影票轮播图  4-CPS轮播图',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本小程序链接，2-外部小程序链接',
  `pic_url` text NOT NULL COMMENT '图片路径',
  `color` varchar(255) NOT NULL COMMENT '背景颜色',
  `url` text NOT NULL COMMENT '跳转链接',
  `appid` varchar(255) NOT NULL COMMENT '小程序id',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='轮播图表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_bottom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `url` text COMMENT '跳转链接',
  `icon` text NOT NULL COMMENT '图标',
  `icon_checked` text NOT NULL COMMENT '选中后图标',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='底部菜单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_brokerage_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `use_count` int(10) DEFAULT '1' COMMENT '使用限制',
  `card_no` varchar(255) DEFAULT NULL COMMENT '编号',
  `label` varchar(255) DEFAULT NULL COMMENT '标签',
  `count` int(10) NOT NULL COMMENT '天数',
  `card` varchar(50) DEFAULT NULL COMMENT '卡密',
  `is_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-未使用  2-已使用',
  `createtime` int(10) NOT NULL,
  `usetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分销卡密表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_brokerage_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `desc` varchar(255) DEFAULT '观看视频广告' COMMENT '描述',
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `type` smallint(1) DEFAULT '1' COMMENT '1-看视频  2-购买vip  3-购买数字商品  4-购买电影  5-购买话费',
  `cps_type` varchar(255) DEFAULT '0' COMMENT '类型 1: 美团外卖   2：美团优选 3：美团分销 4：饿了么 5：多多频道 6：肯德基   7：麦当劳   8：百果园 9：奈雪的茶 10：瑞幸咖啡 11：星巴克 12：喜茶  13：京东  14：滴滴  15-拼多多 16-唯品会  17-淘宝',
  `total` decimal(20,2) NOT NULL COMMENT '订单总额',
  `money` decimal(20,2) NOT NULL COMMENT '金额',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='佣金记录表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_brokerage_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-开启，2-隐藏',
  `is_level` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-一级，2-二级，3-三级',
  `oneLevel` decimal(10,2) DEFAULT '0.00' COMMENT '一级分销比例',
  `twoLevel` decimal(10,2) DEFAULT '0.00' COMMENT '二级分销比例',
  `vip_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '购买VIP分销比例',
  `digital_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '购买数字商品分销比例',
  `film_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '购买电影分销比例',
  `invite_get` decimal(10,2) DEFAULT '0.00' COMMENT '邀请好友得',
  `background` text COMMENT '海报背景图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='佣金设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `serial` varchar(155) NOT NULL COMMENT '序列号/卡密',
  `is_status` smallint(1) NOT NULL DEFAULT '1' COMMENT ' 1-待使用  2-已使用',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品卡密表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '分类名称',
  `text` varchar(20) NOT NULL COMMENT '分类描述',
  `pic_url` text NOT NULL COMMENT '分类图片',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `is_recommend` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-推荐，2-不推荐',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商城分类表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cashno` varchar(50) NOT NULL COMMENT '提现单号',
  `cash_type` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-收款码提现，2-提现到微信',
  `commission_wait` decimal(20,2) NOT NULL COMMENT '申请佣金',
  `commission_actual` decimal(20,2) DEFAULT NULL COMMENT '实际佣金',
  `exchange` varchar(20) DEFAULT NULL COMMENT '兑换比例',
  `cash_charge` varchar(20) DEFAULT NULL COMMENT '提现手续费比例%',
  `service_charge` decimal(20,2) DEFAULT NULL COMMENT '提现手续费金额',
  `pay_qrcode` text COMMENT '收款码',
  `zfb_account` text COMMENT '支付宝账号',
  `is_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-待审核，2-已打款，3-已驳回',
  `createtime` int(10) NOT NULL COMMENT '申请时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提现记录表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_commission_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-开启，2-隐藏',
  `cash_type` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-收款码提现，2-提现到微信',
  `exchange` varchar(20) DEFAULT NULL COMMENT '兑换比例',
  `cash_limit` varchar(20) DEFAULT NULL COMMENT '提现额度',
  `cash_charge` varchar(20) DEFAULT NULL COMMENT '提现手续费',
  `day_count` varchar(20) DEFAULT NULL COMMENT '每日提现次数',
  `day_amount` varchar(20) DEFAULT NULL COMMENT '每日提现数额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_digital_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `pid` varchar(255) NOT NULL COMMENT '分类id',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本小程序链接，2-外部小程序链接  3-看视频',
  `pic_url` text NOT NULL COMMENT '图片路径',
  `url` text NOT NULL COMMENT '跳转链接',
  `appid` varchar(255) NOT NULL COMMENT '小程序id',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数字商品导航表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL COMMENT '门店id',
  `icon` text NOT NULL COMMENT '商品封面图',
  `name` varchar(155) NOT NULL COMMENT '商品名称',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',
  `integral` decimal(10,2) DEFAULT '0.00' COMMENT '积分',
  `deduction` decimal(10,2) DEFAULT '0.00' COMMENT '可抵扣金额',
  `type` smallint(1) DEFAULT '1' COMMENT '1-实物  2-虚拟产品',
  `virtual_type` varchar(155) DEFAULT NULL COMMENT '虚拟商品类型',
  `payment_type` smallint(1) DEFAULT '1' COMMENT '支付方式 1-积分   2-积分+现金  3-现金',
  `pic_url` text NOT NULL COMMENT '图片',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-上架   2-下架',
  `is_recommend` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-推荐，2-不推荐',
  `sold` int(10) NOT NULL DEFAULT '0' COMMENT '已售',
  `inventory` int(10) NOT NULL DEFAULT '0' COMMENT '库存',
  `purchase` int(10) DEFAULT '0' COMMENT '限购数量',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `detail` text COMMENT '详情',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_goods_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `uid` varchar(155) NOT NULL,
  `goodsid` varchar(30) DEFAULT NULL COMMENT '商品id',
  `goods_type` varchar(155) NOT NULL DEFAULT '1' COMMENT '商品类型1-实物  2-虚拟产品',
  `goods_virtual_type` varchar(155) NOT NULL COMMENT '虚拟商品类型',
  `serial` varchar(155) DEFAULT NULL COMMENT '序列号/卡密',
  `goods_name` varchar(155) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `deduction` decimal(10,2) DEFAULT '0.00' COMMENT '抵扣金额',
  `goods_pic` text NOT NULL COMMENT '商品图片',
  `goods_integral` decimal(10,2) NOT NULL COMMENT '商品积分',
  `logno` varchar(30) NOT NULL COMMENT '订单编号',
  `count` int(10) NOT NULL COMMENT '数量',
  `consignee` varchar(155) NOT NULL COMMENT '收货人姓名',
  `consignee_phone` varchar(155) NOT NULL COMMENT '收货人电话',
  `province` varchar(100) NOT NULL COMMENT '(省)',
  `city` varchar(100) NOT NULL COMMENT '（市）',
  `county` varchar(100) NOT NULL COMMENT '（区）',
  `location` varchar(255) NOT NULL COMMENT '省/市/区',
  `detail` varchar(255) NOT NULL COMMENT '详细地址',
  `integral` decimal(10,2) NOT NULL COMMENT '积分',
  `total` decimal(10,2) NOT NULL COMMENT '总价(实付)',
  `express_no` varchar(155) DEFAULT NULL COMMENT '快递编号',
  `express_name` varchar(155) DEFAULT NULL COMMENT '快递公司',
  `payment_type` smallint(1) DEFAULT '1' COMMENT '支付方式 1-积分   2-积分+现金  3-现金',
  `is_status` smallint(1) NOT NULL DEFAULT '1' COMMENT ' 0-已取消 1-待付款  2-待发货  3-待收货  4-已完成（已收货）',
  `remark` text COMMENT '备注',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商城订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_goods_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `top_background` text NOT NULL COMMENT '商城首页背景图',
  `hot` text NOT NULL COMMENT '热门搜索',
  `hot_background` text NOT NULL COMMENT '热销商品背景图',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商城设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `popular_pic` text COMMENT '首页活动图',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_hot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `b_type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-数字商品  2-CPS',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本小程序链接，2-外部小程序链接',
  `pic_url` text NOT NULL COMMENT '图片路径',
  `url` text NOT NULL COMMENT '跳转链接',
  `appid` varchar(255) NOT NULL COMMENT '小程序id',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页热门专区表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_huafei_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '支付金额',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '充值金额',
  `mobile` varchar(100) NOT NULL COMMENT '手机号码',
  `orderid` varchar(100) NOT NULL COMMENT '订单编号',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-慢充，2-快充',
  `is_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-待充值，2-已成功，3-失败  4-已退款',
  `way` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-自动充值   2-手动充值',
  `fail_msg` varchar(100) NOT NULL COMMENT '失败原因',
  `is_member` smallint(1) DEFAULT '0' COMMENT '0-非会员  1-会员',
  `createtime` int(10) NOT NULL,
  `integral` varchar(100) DEFAULT '' COMMENT '抵扣积分',
  `exchange` varchar(100) DEFAULT '' COMMENT '抵扣比例',
  `pay_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-待支付，2-已支付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话费充值记录表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_huafei_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '是否开启   1-开启，2-隐藏',
  `type` varchar(100) DEFAULT '' COMMENT '1-慢充   2-快充',
  `way` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-自动充值   2-手动充值  3-代理充值',
  `app_key` varchar(100) NOT NULL COMMENT '平台编码',
  `app_secret` varchar(100) NOT NULL COMMENT '平台秘钥',
  `appid` varchar(255) DEFAULT NULL COMMENT '代理appid',
  `appsecret` varchar(255) DEFAULT NULL COMMENT '代理appsecret',
  `discount` decimal(10,2) DEFAULT '0.00' COMMENT '慢充充值折扣',
  `quick_discount` decimal(10,2) DEFAULT '0.00' COMMENT '快充充值折扣',
  `not_discount` decimal(10,2) DEFAULT '0.00' COMMENT '非会员慢充充值折扣',
  `not_quick_discount` decimal(10,2) DEFAULT '0.00' COMMENT '非会员快充充值折扣',
  `huafei_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '购买话费分销比例',
  `notice` text COMMENT '提示',
  `createtime` int(10) NOT NULL,
  `discount_open` smallint(1) DEFAULT '2' COMMENT '1-开启  2-关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话费设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `max` int(10) NOT NULL COMMENT '最大金币数',
  `min` int(10) NOT NULL COMMENT '最小金币数',
  `odds` decimal(10,2) DEFAULT '0.00' COMMENT '几率',
  `count` int(10) NOT NULL COMMENT '观看视频数',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_integral_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `cid` varchar(155) NOT NULL COMMENT '下级id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `text` text NOT NULL COMMENT '描述',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-收入，2-支出',
  `condition` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-观看视频  2-分销  3-邀请好友 4-签到 5-后台充值 6-庄园  7-任务中心  8-看新闻  ',
  `createtime` int(10) NOT NULL,
  `order_number` varchar(155) NOT NULL DEFAULT '' COMMENT '支出订单编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分记录表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_didi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 2:已付款 8:已退款',
  `pay_price` varchar(255) DEFAULT '' COMMENT '付款金额',
  `title` varchar(255) DEFAULT '' COMMENT '标题',
  `status` varchar(255) DEFAULT '' COMMENT '1.已预估归因 2.预估订单已推送 3.预估订单推送失败 4.结算提交 5.结算提交失败 6.结算取消 7.结算成功 8.结算失败',
  `is_risk` varchar(255) DEFAULT '' COMMENT '是否被风控 0-否 1-是',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客滴滴打车/加油/货运订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_ele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `tk_create_time` varchar(255) DEFAULT '' COMMENT '订单创建的时间',
  `tk_paid_time` varchar(255) DEFAULT '' COMMENT '订单付款时间',
  `tk_earning_time` varchar(255) DEFAULT '' COMMENT '订单结算时间',
  `trade_id` varchar(255) DEFAULT '' COMMENT '订单号，此订单号唯一',
  `trade_parent_id` varchar(255) DEFAULT '' COMMENT '订单号,此订单号不唯一，和买家后台一致',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `alipay_total_price` varchar(255) DEFAULT '' COMMENT '买家拍下付款的金额',
  `item_img` varchar(255) DEFAULT '' COMMENT '商品图片',
  `tk_status` varchar(255) DEFAULT '' COMMENT '3：订单结算，12：订单付款， 13：订单失效，14：订单成功',
  `refund_tag` varchar(255) DEFAULT '' COMMENT '0: 代表正常 1:代表完成后用户又发起维权，维权订单饿了么将无法结算，固佣金为0',
  `item_title` varchar(255) DEFAULT '' COMMENT '商品标题',
  `click_time` varchar(255) DEFAULT '' COMMENT '通过推广链接达到商品、店铺详情页的点击时间',
  `item_category_name` varchar(255) DEFAULT '' COMMENT '商品所属的根类目，即一级类目的名称',
  `seller_nick` varchar(255) DEFAULT '' COMMENT '店铺名称',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid',
  `type` varchar(255) DEFAULT '' COMMENT '1：外卖 2：生鲜',
  `modified_time` varchar(255) DEFAULT '' COMMENT '更新时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客饿了么订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_heytea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 UNPAID-待支付,DEALING-下单中,ARRIVED-已送达,CANCELED-已取消（超时未支付）,REFUNDED-已退款',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `restaurant_address` varchar(255) DEFAULT '' COMMENT '餐厅地址',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `modify_time` varchar(255) DEFAULT '' COMMENT '订单更新时间',
  `refund_time` varchar(255) DEFAULT '' COMMENT '订单退款变更时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-喜茶订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_jd` (
  `id` varchar(255) NOT NULL DEFAULT '' COMMENT '标记唯一订单行：订单+sku维度的唯一标识',
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `orderId` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `orderTime` varchar(255) DEFAULT '' COMMENT '下单时间',
  `finishTime` varchar(255) DEFAULT '' COMMENT '完成时间',
  `modifyTime` varchar(255) DEFAULT '' COMMENT '更新时间',
  `validCode` varchar(255) DEFAULT '' COMMENT '订单状态 -1：未知,2.无效-拆单,3.无效-取消,4.无效-京东帮帮主订单,5.无效-账号异常,6.无效-赠品类目不返佣,7.无效-校园订单,8.无效-企业订单,9.无效-团购订单,11.无效-乡村推广员下单,13.无效-违规订单,14.无效-来源与备案网址不符,15.待付款,16.已付款,17.已完成（购买用户确认收货）,20.无效-此复购订单对应的首购订单无效,21.无效-云店订单，22. 无效-PLUS会员佣金比例为0',
  `validCodeDesc` varchar(255) DEFAULT '' COMMENT '订单状态 描述',
  `skuId` varchar(255) DEFAULT '' COMMENT '商品ID',
  `skuName` varchar(255) DEFAULT '' COMMENT '商品名称',
  `skuNum` varchar(255) DEFAULT '' COMMENT '商品数量',
  `skuReturnNum` varchar(255) DEFAULT '' COMMENT '商品已退货数量',
  `skuFrozenNum` varchar(255) DEFAULT '' COMMENT '商品售后中数量',
  `price` varchar(255) DEFAULT '' COMMENT '商品单价',
  `subsidy_money` varchar(255) DEFAULT '' COMMENT '额外奖励金额',
  `estimateCosPrice` varchar(255) DEFAULT '' COMMENT '预估计佣金额：由订单的实付金额拆分至每个商品的预估计佣金额，不包括运费，以及京券、东券、E卡、余额等虚拟资产支付的金额。该字段仅为预估值，实际佣金以actualCosPrice为准进行计算',
  `actualCosPrice` varchar(255) DEFAULT '' COMMENT '实际计算佣金的金额。订单完成后，会将误扣除的运费券金额更正。如订单完成后发生退款，此金额会更新',
  `payMonth` varchar(255) DEFAULT '' COMMENT '预估结算时间，订单完成后才会返回，格式：yyyyMMdd，默认：0。表示最新的预估结算日期。当payMonth为当前的未来时间时，表示该订单可结算；当payMonth为当前的过去时间时，表示该订单已结算',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客京东订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_kfc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 UNPAID－未支付（通用），PAYED-已支付（外卖）,WAIT_OUT_MEAL-待出餐（自助），OUT_MEAL-已出餐（自助），WAITING_RECEIVED-商家待接单（外卖），RECEIVED_ORDER-商家已接单（外卖），SENDING-送餐中（外卖），REFUNDED-已退款（通用），COMPLETE-已完成（外卖），FAIL-已失败（通用）',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `update_time` varchar(255) DEFAULT '' COMMENT '订单更新时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-肯德基订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_luckin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 UNPAID-待支付,DEALING-下单中,ARRIVED-已送达,CANCELED-已取消（超时未支付）,REFUNDED-已退款',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `restaurant_address` varchar(255) DEFAULT '' COMMENT '餐厅地址',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `modify_time` varchar(255) DEFAULT '' COMMENT '订单更新时间',
  `refund_time` varchar(255) DEFAULT '' COMMENT '订单退款变更时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-瑞幸咖啡订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_mcdonald` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 FAIL-已失败 OUT_MEAL-已出餐 REFUNDED－已退款 PAYED－已支付 UNPAID－未支付',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `restaurant_address` varchar(255) DEFAULT '' COMMENT '餐厅地址',
  `code` varchar(255) DEFAULT '' COMMENT '取餐码,仅出餐成功有数据,有多个时中间用英文逗号隔开',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `out_meal_time` varchar(255) DEFAULT '' COMMENT '订单出餐成功时间',
  `refund_time` varchar(255) DEFAULT '' COMMENT '订单退款成功时间',
  `update_time` varchar(255) DEFAULT '' COMMENT '订单状态变更时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-麦当劳订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_meituan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `orderid` varchar(255) DEFAULT '' COMMENT '订单ID',
  `paytime` varchar(255) DEFAULT '' COMMENT '订单支付时间',
  `payprice` varchar(255) DEFAULT '' COMMENT '订单支付金额',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `smstitle` varchar(255) DEFAULT '' COMMENT '订单标题',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,渠道方用户唯一标识',
  `quantity` varchar(255) DEFAULT '' COMMENT '退款笔数',
  `refundtime` varchar(255) DEFAULT '' COMMENT '退款时间',
  `money` varchar(255) DEFAULT '' COMMENT '退款金额',
  `refund_money` varchar(255) DEFAULT '' COMMENT '退佣金额',
  `status` varchar(255) DEFAULT '' COMMENT '订单状态(1-已提交（已付款）、8-已完成（确认收货）、9-已退款)',
  `type` varchar(255) DEFAULT '' COMMENT '订单类型（活动名称）4-外卖 6-闪购 8-优选 2-酒店',
  `modtime` varchar(255) DEFAULT '' COMMENT '订单更新时间',
  `year` varchar(255) DEFAULT '' COMMENT '订单所属年份',
  `month` varchar(255) DEFAULT '' COMMENT '订单所属月份',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客美团联盟订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_nayuki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 UNPAID-待支付,DEALING-下单中,ARRIVED-已送达,CANCELED-已取消（超时未支付）,REFUNDED-已退款',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `address` varchar(255) DEFAULT '' COMMENT '餐厅地址',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-奈雪的茶订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_pagoda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 UNPAID-待支付,DEALING-下单中,ARRIVED-已送达,CANCELED-已取消（超时未支付）,REFUNDED-已退款',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `restaurant_address` varchar(255) DEFAULT '' COMMENT '餐厅地址',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `modify_time` varchar(255) DEFAULT '' COMMENT '订单更新时间',
  `refund_time` varchar(255) DEFAULT '' COMMENT '订单退款变更时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-百果园订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_pdd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `goods_name` varchar(255) DEFAULT '' COMMENT '商品名称',
  `goods_thumbnail_url` varchar(255) DEFAULT '' COMMENT '商品图片',
  `goods_quantity` varchar(255) DEFAULT '' COMMENT '商品购买数量',
  `order_amount` varchar(255) DEFAULT '' COMMENT '商品支付金额，单位元',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义参数',
  `order_create_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `order_group_success_time` varchar(255) DEFAULT '' COMMENT '成团时间',
  `order_modify_at` varchar(255) DEFAULT '' COMMENT '最后更新时间',
  `order_pay_time` varchar(255) DEFAULT '' COMMENT '支付时间',
  `order_verify_time` varchar(255) DEFAULT '' COMMENT '审核时间',
  `order_sn` varchar(255) DEFAULT '' COMMENT '订单号',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态： -1 未支付; 0-已支付；1-已成团；2-确认收货；3-审核成功；4-审核失败（不可提现）；5-已经结算；8-非多多进宝商品（无佣金订单）',
  `order_status_desc` varchar(255) DEFAULT '' COMMENT '订单状态描述',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `resource_type` varchar(255) DEFAULT '' COMMENT '频道id 4 :限时秒杀、39997 :充值中心、39996 :百亿补贴、39999 :40000 :领券中心、50005 :火车票',
  `resource_name` varchar(255) DEFAULT '' COMMENT '频道说明',
  `price_compare_status` varchar(255) DEFAULT '' COMMENT '0: 正常 1：比价',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客多多订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_pubmeituan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `orderid` varchar(255) DEFAULT '' COMMENT '订单ID',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `uniqueItemId` varchar(255) DEFAULT '' COMMENT '唯一子订单Id',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `orderPayTime` varchar(255) DEFAULT '' COMMENT '订单支付时间',
  `refundtime` varchar(255) DEFAULT '' COMMENT '退款时间',
  `actualOrderAmount` varchar(255) DEFAULT '' COMMENT '订单实际支付总价格，单位元，保留两位小数',
  `shopName` varchar(255) DEFAULT '' COMMENT '订单名称',
  `orderTypeName` varchar(255) DEFAULT '' COMMENT '订单类型',
  `orderType` varchar(255) DEFAULT '' COMMENT '订单类型 1: 团单 2：代金券 3：买单 4：智能支付 5：扫码支付 6：第三方团单 7：预定 8：范商品 9：外卖 10：酒店 11：闪购 12：门票',
  `itemBizStatus` varchar(255) DEFAULT '' COMMENT '1: 支付成功 2：核销成功 3：结算成功 99：无效订单 999：未知状态',
  `billingDate` varchar(255) DEFAULT '' COMMENT '账期时间',
  `modifyTime` varchar(255) DEFAULT '' COMMENT '最后更新时间',
  `verifyTime` varchar(255) DEFAULT '' COMMENT '核验时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客美团分销联盟订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '是否开启   1-开启，2-隐藏',
  `apikey` varchar(50) NOT NULL COMMENT '聚推客接口秘钥',
  `cps_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '自购分销比例',
  `partner_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '上级分销比例',
  `not_cps_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '非会员自购分销比例',
  `not_partner_rebate` decimal(10,2) DEFAULT '0.00' COMMENT '非会员上级分销比例',
  `jd_top` text COMMENT '京东高佣顶部图',
  `createtime` int(10) NOT NULL,
  `mtyx_top` text COMMENT '美团优选顶部图',
  `pub_id` varchar(50) NOT NULL COMMENT '聚推客身份ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_jtk_spk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `order_no` varchar(255) DEFAULT '' COMMENT '订单号',
  `sid` varchar(255) DEFAULT '' COMMENT '用户uid,自定义跟单参数',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态 UNPAID-待支付,DEALING-下单中,ARRIVED-已送达,CANCELED-已取消（超时未支付）,REFUNDED-已退款',
  `jtk_share_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% （实际佣金比率 = 比例x100）',
  `jtk_share_fee` varchar(255) DEFAULT '' COMMENT '订单返佣金额',
  `product_detail` varchar(255) DEFAULT '' COMMENT '产品名称*单价 元 *数量 份',
  `settle_price` varchar(255) DEFAULT '' COMMENT '结算价格(单位:元)小数点后两位',
  `restaurant_address` varchar(255) DEFAULT '' COMMENT '餐厅地址',
  `pay_time` varchar(255) DEFAULT '' COMMENT '订单支付成功时间',
  `order_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `modify_time` varchar(255) DEFAULT '' COMMENT '订单更新时间',
  `refund_time` varchar(255) DEFAULT '' COMMENT '订单退款变更时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聚推客连锁餐饮-星巴克订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `name` varchar(50) DEFAULT NULL COMMENT '会员名称',
  `month` int(11) DEFAULT '0' COMMENT '月',
  `price` float(11,2) DEFAULT '0.00' COMMENT '价格',
  `integral` float(11,2) DEFAULT '0.00' COMMENT '可用积分',
  `deduction` float(11,2) DEFAULT '0.00' COMMENT '可抵扣金额',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `createtime` int(10) DEFAULT NULL COMMENT '加入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_member_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` smallint(1) DEFAULT '1' COMMENT '1-购买  2-卡密',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `price` float(11,2) DEFAULT '0.00' COMMENT '金额',
  `integral` float(11,2) DEFAULT '0.00' COMMENT '可用积分',
  `deduction` float(11,2) DEFAULT '0.00' COMMENT '可抵扣金额',
  `count` int(10) NOT NULL COMMENT '天数',
  `level_name` varchar(100) NOT NULL COMMENT '会员名称',
  `label` varchar(255) DEFAULT NULL COMMENT '卡密标签',
  `card` varchar(50) DEFAULT NULL COMMENT '卡密',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员充值记录表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_member_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `explain` text COMMENT '会员说明',
  `invite` text COMMENT '邀请玩法',
  `createtime` int(10) DEFAULT NULL COMMENT '加入时间',
  `my_pic` text COMMENT '我的图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_module_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-开启，2-关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块插件表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本小程序链接，2-外部小程序链接  3-看视频',
  `pic_url` text NOT NULL COMMENT '图片路径',
  `url` text NOT NULL COMMENT '跳转链接',
  `appid` varchar(255) NOT NULL COMMENT '小程序id',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页导航表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-开启，2-隐藏',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-助通云，2-阿里云',
  `uniacid` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL COMMENT '短信内容',
  `keyId` varchar(50) NOT NULL,
  `keySecret` varchar(50) NOT NULL,
  `signName` varchar(50) NOT NULL,
  `templateCode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信配置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_payconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` smallint(1) DEFAULT '1' COMMENT '1-微信支付  2-微信支付子商户',
  `service_appid` varchar(50) NOT NULL COMMENT '服务商appid',
  `service_mchid` varchar(50) NOT NULL COMMENT '服务商支付商户号',
  `appid` varchar(50) NOT NULL,
  `mchid` varchar(50) NOT NULL,
  `api_key` varchar(50) NOT NULL,
  `cert` smallint(1) DEFAULT NULL,
  `key` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付配置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `b_type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-首页图片，2-CPS图片',
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本小程序链接，2-外部小程序链接',
  `pic_url` text NOT NULL COMMENT '图片路径',
  `url` text NOT NULL COMMENT '跳转链接',
  `appid` varchar(255) NOT NULL COMMENT '小程序id',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页图片表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `identifie` varchar(255) NOT NULL COMMENT '内容',
  `summary` varchar(255) NOT NULL COMMENT '简介',
  `is_open` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-关闭，2-开启',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='插件表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_popular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `pic_url` text COMMENT '图片路径',
  `url` text COMMENT '跳转链接',
  `appid` varchar(255) NOT NULL COMMENT '小程序id',
  `type` varchar(255) DEFAULT '' COMMENT '类型 ',
  `is_display` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-显示，2-隐藏',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序，数值越高，越在前显示',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页热门活动表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_signin_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-开启，2-隐藏',
  `get` int(10) DEFAULT '0' COMMENT '签到可得',
  `cumsum` int(10) DEFAULT '0' COMMENT '签到累加',
  `max` int(10) DEFAULT '0' COMMENT '签到最大',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='签到设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `logo` text COMMENT '系统logo',
  `name` varchar(100) DEFAULT NULL COMMENT '系统名称',
  `phone` varchar(30) DEFAULT NULL COMMENT '客服电话',
  `integral_name` varchar(100) DEFAULT NULL COMMENT '金币名称',
  `max_integral` int(10) NOT NULL COMMENT '看视频得最大积分',
  `min_integral` int(10) NOT NULL COMMENT '看视频得最小积分',
  `share_pic` text COMMENT '分享图片',
  `share_title` varchar(255) DEFAULT NULL COMMENT '分享标题',
  `index_banner` varchar(255) DEFAULT NULL COMMENT '首页激励广告',
  `notice_banner` varchar(255) DEFAULT NULL COMMENT '公告下方banner广告',
  `bottom_banner` varchar(255) DEFAULT NULL COMMENT '首页底部banner广告',
  `index_grid` varchar(255) DEFAULT NULL COMMENT '首页原生单格子广告',
  `video_banner` varchar(255) DEFAULT NULL COMMENT '视频结束banner广告',
  `cate_banner` varchar(255) DEFAULT NULL COMMENT '分类banner广告',
  `mall_banner` varchar(255) DEFAULT NULL COMMENT '商城首页banner广告',
  `detail_banner` varchar(255) DEFAULT NULL COMMENT '商品详情banner广告',
  `my_banner` varchar(255) DEFAULT NULL COMMENT '我的页面banner广告',
  `help_banner` varchar(255) DEFAULT NULL COMMENT '帮助中心banner广告',
  `brokerage_banner` varchar(255) DEFAULT NULL COMMENT '分销中心banner广告',
  `table_plaque` varchar(255) DEFAULT NULL COMMENT '全局插屏广告',
  `person` int(10) DEFAULT '0' COMMENT '平台参与人数',
  `sent` int(10) DEFAULT '0' COMMENT '平台已发放金币',
  `video_count` int(10) DEFAULT '0' COMMENT '每天可观看视频数量',
  `video_interval` int(10) DEFAULT '5' COMMENT '观看视频间隔',
  `video_notice` varchar(255) DEFAULT NULL COMMENT '观看视频数量上限提示语',
  `index_kan` text COMMENT '首页看视频背景图',
  `index_pai` text COMMENT '首页排行榜背景图',
  `index_tui` text COMMENT '首页分享推广背景图',
  `video_background` text COMMENT '看视频倒计时背景图',
  `ranking` text COMMENT '排行榜顶部背景图',
  `help` text COMMENT '帮助中心',
  `kf_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-开启，2-隐藏',
  `course` text COMMENT '新手教程',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_takeout_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_open` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-开启，2-隐藏',
  `apikey` varchar(50) NOT NULL COMMENT '订单侠接口秘钥',
  `index_meituan` text COMMENT '首页美团背景图',
  `index_elm` text COMMENT '首页饿了么背景图',
  `meituan_pic` text COMMENT '美团详情背景图',
  `meituan_rule` text COMMENT '美团活动规则',
  `elm_pic` text COMMENT '饿了么详情背景图',
  `elm_rule` text COMMENT '饿了么活动规则',
  `sg_pic` text COMMENT '美团闪购详情背景图',
  `sg_rule` text COMMENT '美团闪购活动规则',
  `sc_pic` text COMMENT '饿了么商超详情背景图',
  `sc_rule` text COMMENT '饿了么商超活动规则',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='外卖配置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_task_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号id',
  `is_open` smallint(1) NOT NULL DEFAULT '2' COMMENT '1-开启，2-隐藏',
  `advert_icon` text COMMENT '观看广告图标',
  `advert_name` varchar(255) DEFAULT NULL COMMENT '观看广告文字',
  `advert_count` int(3) DEFAULT '0' COMMENT '每日观看广告数量',
  `advert_integral` int(3) DEFAULT '0' COMMENT '每日观看广告数量可获得金豆',
  `manor_icon` text COMMENT '喂牛图标',
  `manor_name` varchar(255) DEFAULT NULL COMMENT '喂牛文字',
  `manor_count` int(3) DEFAULT '0' COMMENT '每日喂牛次数',
  `manor_integral` int(3) DEFAULT '0' COMMENT '每日喂牛次数可获得金豆',
  `invite_icon` text COMMENT '邀请好友图标',
  `invite_name` varchar(255) DEFAULT NULL COMMENT '邀请好友文字',
  `invite_count` int(3) DEFAULT '0' COMMENT '邀请好友次数',
  `invite_integral` int(3) DEFAULT '0' COMMENT '邀请好友可获得金豆',
  `huafei_icon` text COMMENT '充话费图标',
  `huafei_name` varchar(255) DEFAULT NULL COMMENT '充话费文字',
  `huafei_count` int(3) DEFAULT '0' COMMENT '充话费次数',
  `huafei_integral` int(3) DEFAULT '0' COMMENT '充话费可获得金豆',
  `news_icon` text COMMENT '观看新闻图标',
  `news_name` varchar(255) DEFAULT NULL COMMENT '观看新闻文字',
  `news_count` int(3) DEFAULT '0' COMMENT '观看新闻次数',
  `news_integral` int(3) DEFAULT '0' COMMENT '观看新闻可获得金豆',
  `createtime` int(10) NOT NULL,
  `takeout_desc` varchar(255) NOT NULL COMMENT '外卖描述文字',
  `invite_desc` varchar(255) NOT NULL COMMENT '邀请好友描述文字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务中心配置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1-本地，2-七牛云  3-阿里云  4-腾讯云',
  `accesskey` varchar(255) NOT NULL COMMENT '七牛云accesskey',
  `secretkey` varchar(255) NOT NULL COMMENT '七牛云secretkey',
  `bucket` varchar(255) NOT NULL COMMENT '七牛云bucket',
  `url` varchar(255) NOT NULL COMMENT '七牛云url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='上传配置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(155) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `openid` varchar(155) NOT NULL,
  `balance` decimal(20,2) DEFAULT '0.00' COMMENT '余额',
  `qrcode` text COMMENT '分销二维码',
  `pay_qrcode` text COMMENT '收款码',
  `zfb_account` text COMMENT '支付宝账号',
  `sign_time` varchar(255) NOT NULL COMMENT '上次签到时间',
  `sign_day` int(10) DEFAULT '0' COMMENT '已签到天数',
  `is_member` smallint(1) DEFAULT '0' COMMENT '0非会员',
  `maturity_time` int(10) DEFAULT '0' COMMENT '到期时间',
  `relation_id` varchar(255) NOT NULL DEFAULT '' COMMENT '淘宝渠道id',
  `createtime` int(10) NOT NULL,
  `is_block` smallint(1) DEFAULT '0' COMMENT '0未拉黑  1-已拉黑',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_wxapp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `icon` text COMMENT '图标',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `appid` varchar(255) NOT NULL COMMENT 'appid',
  `path` varchar(255) NOT NULL COMMENT '路径',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='小程序表';

";
pdo_run($sql);
if(!pdo_fieldexists("wjyk_zqds_address", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `uid` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "consignee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `consignee` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "consignee_phone")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `consignee_phone` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "province")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `province` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "city")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `city` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "county")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `county` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "location")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `location` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `detail` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_address", "is_default")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `is_default` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_address", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_address")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_background", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_background")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_background", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_background")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_background", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_background")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_background", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_background")." ADD `url` text;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "b_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `b_type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "color")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `color` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_banner", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_banner")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `url` text;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `icon` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "icon_checked")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `icon_checked` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_bottom", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_bottom")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `pid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "use_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `use_count` int(10) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "card_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `card_no` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "label")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `label` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `count` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "card")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `card` varchar(50);");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "is_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `is_status` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_card", "usetime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_card")." ADD `usetime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "order_number")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `order_number` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `desc` varchar(255) DEFAULT '观看视频广告';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `pid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `type` smallint(1) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "cps_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `cps_type` varchar(255) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "total")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `total` decimal(20,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "money")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `money` decimal(20,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_log")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "is_level")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `is_level` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "oneLevel")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `oneLevel` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "twoLevel")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `twoLevel` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "vip_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `vip_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "digital_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `digital_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "film_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `film_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "invite_get")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `invite_get` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_brokerage_set", "background")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_brokerage_set")." ADD `background` text;");
}
if(!pdo_fieldexists("wjyk_zqds_card", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_card")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_card", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_card")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_card", "goodsid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_card")." ADD `goodsid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_card", "serial")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_card")." ADD `serial` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_card", "is_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_card")." ADD `is_status` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_card", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_card")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `pid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `name` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "text")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `text` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_category", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_category", "is_recommend")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `is_recommend` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_category", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_category", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_category")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "cashno")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `cashno` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "cash_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `cash_type` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "commission_wait")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `commission_wait` decimal(20,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "commission_actual")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `commission_actual` decimal(20,2);");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "exchange")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `exchange` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "cash_charge")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `cash_charge` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "service_charge")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `service_charge` decimal(20,2);");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "pay_qrcode")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `pay_qrcode` text;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "zfb_account")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `zfb_account` text;");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "is_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `is_status` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_commission", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "cash_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `cash_type` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "exchange")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `exchange` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "cash_limit")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `cash_limit` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "cash_charge")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `cash_charge` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "day_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `day_count` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_commission_set", "day_amount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_commission_set")." ADD `day_amount` varchar(20);");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `pid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_digital_navigation", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_digital_navigation")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "categoryid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `categoryid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `icon` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `name` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `integral` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "deduction")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `deduction` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `type` smallint(1) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "virtual_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `virtual_type` varchar(155);");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "payment_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `payment_type` smallint(1) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "is_recommend")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `is_recommend` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "sold")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `sold` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "inventory")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `inventory` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "purchase")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `purchase` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `detail` text;");
}
if(!pdo_fieldexists("wjyk_zqds_goods", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `uid` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goodsid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goodsid` varchar(30);");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goods_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goods_type` varchar(155) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goods_virtual_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goods_virtual_type` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "serial")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `serial` varchar(155);");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goods_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goods_name` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goods_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goods_price` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "deduction")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `deduction` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goods_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goods_pic` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "goods_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `goods_integral` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "logno")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `logno` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `count` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "consignee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `consignee` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "consignee_phone")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `consignee_phone` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "province")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `province` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "city")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `city` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "county")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `county` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "location")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `location` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `detail` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `integral` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "total")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `total` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "express_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `express_no` varchar(155);");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "express_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `express_name` varchar(155);");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "payment_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `payment_type` smallint(1) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "is_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `is_status` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "remark")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `remark` text;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_order", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_order")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_set", "top_background")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_set")." ADD `top_background` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_set", "hot")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_set")." ADD `hot` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_set", "hot_background")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_set")." ADD `hot_background` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_goods_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_goods_set")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_home", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_home")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_home", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_home")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_home", "popular_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_home")." ADD `popular_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_home", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_home")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "b_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `b_type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_hot", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_hot")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "money")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `mobile` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "orderid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `orderid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "is_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `is_status` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "way")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `way` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "fail_msg")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `fail_msg` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "is_member")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `is_member` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `integral` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "exchange")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `exchange` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_log", "pay_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_log")." ADD `pay_status` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `type` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "way")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `way` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "app_key")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `app_key` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "app_secret")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `app_secret` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `appid` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "appsecret")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `appsecret` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "discount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "quick_discount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `quick_discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "not_discount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `not_discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "not_quick_discount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `not_quick_discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "huafei_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `huafei_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "notice")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `notice` text;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_huafei_set", "discount_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_huafei_set")." ADD `discount_open` smallint(1) DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "max")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `max` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "min")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `min` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "odds")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `odds` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `count` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "cid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `cid` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "money")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `money` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "text")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `text` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "condition")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `condition` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_integral_log", "order_number")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_integral_log")." ADD `order_number` varchar(155) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "pay_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `pay_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "title")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "is_risk")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `is_risk` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_didi", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_didi")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "tk_create_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `tk_create_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "tk_paid_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `tk_paid_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "tk_earning_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `tk_earning_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "trade_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `trade_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "trade_parent_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `trade_parent_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "alipay_total_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `alipay_total_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "item_img")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `item_img` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "tk_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `tk_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "refund_tag")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `refund_tag` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "item_title")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `item_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "click_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `click_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "item_category_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `item_category_name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "seller_nick")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `seller_nick` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "modified_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `modified_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_ele", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_ele")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "restaurant_address")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `restaurant_address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "modify_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `modify_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "refund_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `refund_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_heytea", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_heytea")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `id` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "orderId")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `orderId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "orderTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `orderTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "finishTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `finishTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "modifyTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `modifyTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "validCode")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `validCode` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "validCodeDesc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `validCodeDesc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "skuId")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `skuId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "skuName")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `skuName` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "skuNum")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `skuNum` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "skuReturnNum")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `skuReturnNum` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "skuFrozenNum")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `skuFrozenNum` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "subsidy_money")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `subsidy_money` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "estimateCosPrice")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `estimateCosPrice` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "actualCosPrice")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `actualCosPrice` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "payMonth")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `payMonth` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_jd", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_jd")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `update_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_kfc", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_kfc")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "restaurant_address")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `restaurant_address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "modify_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `modify_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "refund_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `refund_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_luckin", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_luckin")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "restaurant_address")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `restaurant_address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "code")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `code` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "out_meal_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `out_meal_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "refund_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `refund_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "update_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `update_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_mcdonald", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_mcdonald")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "orderid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `orderid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "paytime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `paytime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "payprice")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `payprice` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "smstitle")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `smstitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "quantity")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `quantity` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "refundtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `refundtime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "money")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `money` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "refund_money")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `refund_money` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "modtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `modtime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "year")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `year` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "month")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `month` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_meituan", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_meituan")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "address")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_nayuki", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_nayuki")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "restaurant_address")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `restaurant_address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "modify_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `modify_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "refund_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `refund_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pagoda", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pagoda")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "goods_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `goods_name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "goods_thumbnail_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `goods_thumbnail_url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "goods_quantity")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `goods_quantity` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_amount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_amount` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_create_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_create_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_group_success_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_group_success_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_modify_at")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_modify_at` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_verify_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_verify_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_sn")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_sn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "order_status_desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `order_status_desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "resource_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `resource_type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "resource_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `resource_name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "price_compare_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `price_compare_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pdd", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pdd")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "orderid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `orderid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "uniqueItemId")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `uniqueItemId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "orderPayTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `orderPayTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "refundtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `refundtime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "actualOrderAmount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `actualOrderAmount` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "shopName")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `shopName` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "orderTypeName")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `orderTypeName` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "orderType")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `orderType` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "itemBizStatus")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `itemBizStatus` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "billingDate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `billingDate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "modifyTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `modifyTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "verifyTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `verifyTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_pubmeituan", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_pubmeituan")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "apikey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `apikey` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "cps_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `cps_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "partner_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `partner_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "not_cps_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `not_cps_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "not_partner_rebate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `not_partner_rebate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "jd_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `jd_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "mtyx_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `mtyx_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_set", "pub_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_set")." ADD `pub_id` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "order_no")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `order_no` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `sid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "jtk_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `jtk_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "jtk_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `jtk_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "product_detail")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `product_detail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "settle_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `settle_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "restaurant_address")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `restaurant_address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "order_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `order_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "modify_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `modify_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "refund_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `refund_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_jtk_spk", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_jtk_spk")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_member", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_member", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `name` varchar(50);");
}
if(!pdo_fieldexists("wjyk_zqds_member", "month")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `month` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_member", "price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `price` float(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_member", "integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `integral` float(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_member", "deduction")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `deduction` float(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_member", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `sort` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_member", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `type` smallint(1) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `price` float(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `integral` float(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "deduction")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `deduction` float(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `count` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "level_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `level_name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "label")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `label` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "card")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `card` varchar(50);");
}
if(!pdo_fieldexists("wjyk_zqds_member_log", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_log")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_member_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_member_set", "explain")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_set")." ADD `explain` text;");
}
if(!pdo_fieldexists("wjyk_zqds_member_set", "invite")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_set")." ADD `invite` text;");
}
if(!pdo_fieldexists("wjyk_zqds_member_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_set")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("wjyk_zqds_member_set", "my_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_member_set")." ADD `my_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_module_plugin", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_module_plugin")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_module_plugin", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_module_plugin")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_module_plugin", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_module_plugin")." ADD `pid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_module_plugin", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_module_plugin")." ADD `is_open` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "title")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_navigation", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_navigation")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_note", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_note", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "user")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `user` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "pass")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `pass` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "message")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `message` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "keyId")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `keyId` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "keySecret")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `keySecret` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "signName")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `signName` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_note", "templateCode")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_note")." ADD `templateCode` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `type` smallint(1) DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "service_appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `service_appid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "service_mchid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `service_mchid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `appid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "mchid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `mchid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "api_key")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `api_key` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "cert")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `cert` smallint(1);");
}
if(!pdo_fieldexists("wjyk_zqds_payconfig", "key")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_payconfig")." ADD `key` smallint(1);");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "b_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `b_type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_picture", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_picture")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "identifie")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `identifie` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "summary")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `summary` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `is_open` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_plugin", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_plugin")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `pic_url` text;");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `url` text;");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_popular", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_popular")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_signin_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_signin_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_signin_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_signin_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_signin_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_signin_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_signin_set", "get")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_signin_set")." ADD `get` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_signin_set", "cumsum")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_signin_set")." ADD `cumsum` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_signin_set", "max")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_signin_set")." ADD `max` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_system", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "logo")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `logo` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `name` varchar(100);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "phone")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `phone` varchar(30);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "integral_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `integral_name` varchar(100);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "max_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `max_integral` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "min_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `min_integral` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "share_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `share_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "share_title")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `share_title` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "index_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `index_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "notice_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `notice_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "bottom_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `bottom_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "index_grid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `index_grid` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "video_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `video_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "cate_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `cate_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "mall_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `mall_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "detail_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `detail_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "my_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `my_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "help_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `help_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "brokerage_banner")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `brokerage_banner` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "table_plaque")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `table_plaque` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "person")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `person` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_system", "sent")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `sent` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_system", "video_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `video_count` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_system", "video_interval")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `video_interval` int(10) DEFAULT '5';");
}
if(!pdo_fieldexists("wjyk_zqds_system", "video_notice")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `video_notice` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_system", "index_kan")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `index_kan` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "index_pai")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `index_pai` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "index_tui")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `index_tui` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "video_background")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `video_background` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "ranking")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `ranking` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "help")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `help` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "kf_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `kf_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_system", "course")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `course` text;");
}
if(!pdo_fieldexists("wjyk_zqds_system", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_system")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "apikey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `apikey` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "index_meituan")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `index_meituan` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "index_elm")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `index_elm` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "meituan_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `meituan_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "meituan_rule")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `meituan_rule` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "elm_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `elm_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "elm_rule")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `elm_rule` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "sg_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `sg_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "sg_rule")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `sg_rule` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "sc_pic")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `sc_pic` text;");
}
if(!pdo_fieldexists("wjyk_zqds_takeout_set", "sc_rule")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_takeout_set")." ADD `sc_rule` text;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "is_open")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `is_open` smallint(1) NOT NULL DEFAULT '2';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "advert_icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `advert_icon` text;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "advert_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `advert_name` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "advert_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `advert_count` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "advert_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `advert_integral` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "manor_icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `manor_icon` text;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "manor_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `manor_name` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "manor_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `manor_count` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "manor_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `manor_integral` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "invite_icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `invite_icon` text;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "invite_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `invite_name` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "invite_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `invite_count` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "invite_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `invite_integral` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "huafei_icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `huafei_icon` text;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "huafei_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `huafei_name` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "huafei_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `huafei_count` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "huafei_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `huafei_integral` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "news_icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `news_icon` text;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "news_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `news_name` varchar(255);");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "news_count")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `news_count` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "news_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `news_integral` int(3) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "takeout_desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `takeout_desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_task_set", "invite_desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_task_set")." ADD `invite_desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "accesskey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `accesskey` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "secretkey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `secretkey` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "bucket")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `bucket` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_upload", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_upload")." ADD `url` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `pid` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `nickname` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "openid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `openid` varchar(155) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "balance")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `balance` decimal(20,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("wjyk_zqds_user", "qrcode")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `qrcode` text;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "pay_qrcode")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `pay_qrcode` text;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "zfb_account")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `zfb_account` text;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "sign_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `sign_time` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "sign_day")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `sign_day` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_user", "is_member")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `is_member` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_user", "maturity_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `maturity_time` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_user", "relation_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `relation_id` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_user", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_user", "is_block")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_user")." ADD `is_block` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `sort` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "icon")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `icon` text;");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "path")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `path` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_wxapp", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_wxapp")." ADD `createtime` int(10) NOT NULL;");
}
