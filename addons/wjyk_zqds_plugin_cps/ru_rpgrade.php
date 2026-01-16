<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_cps_mayi_pdd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `uid` int(11) DEFAULT '0' COMMENT 'uid',
  `order_id` varchar(255) DEFAULT '' COMMENT '订单ID',
  `order_sn` varchar(255) DEFAULT '' COMMENT '推广订单编号',
  `p_id` varchar(255) DEFAULT '' COMMENT '推广位ID',
  `type` varchar(255) DEFAULT '' COMMENT '订单推广类型',
  `auth_duo_id` varchar(255) DEFAULT '' COMMENT '多多客工具id',
  `zs_duo_id` varchar(255) DEFAULT '' COMMENT '招商多多客id',
  `custom_parameters` varchar(255) DEFAULT '' COMMENT '自定义参数,用户uid',
  `goods_id` varchar(255) DEFAULT '' COMMENT '商品ID',
  `goods_name` varchar(255) DEFAULT '' COMMENT '商品标题',
  `goods_price` varchar(255) DEFAULT '' COMMENT '订单中sku的单件价格，单位为分',
  `goods_thumbnail_url` varchar(255) DEFAULT '' COMMENT '商品缩略图',
  `goods_quantity` varchar(255) DEFAULT '' COMMENT '购买商品的数量',
  `order_amount` varchar(255) DEFAULT '' COMMENT '实际支付金额，单位为分',
  `promotion_amount` varchar(255) DEFAULT '' COMMENT '佣金金额，单位为分',
  `promotion_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，千分比',
  `order_status` varchar(255) DEFAULT '' COMMENT '订单状态：0-已支付；1-已成团；2-确认收货；3-审核成功；4-审核失败（不可提现）；5-已经结算 ;10-已处罚',
  `order_status_desc` varchar(255) DEFAULT '' COMMENT '订单状态描述',
  `order_create_time` varchar(255) DEFAULT '' COMMENT '订单创建时间',
  `order_pay_time` varchar(255) DEFAULT '' COMMENT '订单支付时间',
  `order_receive_time` varchar(255) DEFAULT '' COMMENT '确认收货时间',
  `order_settle_time` varchar(255) DEFAULT '' COMMENT '订单结算时间',
  `order_verify_time` varchar(255) DEFAULT '' COMMENT '订单审核时间',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='蚂蚁星球-拼多多订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_cps_mayi_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `uid` int(11) DEFAULT '0' COMMENT 'uid',
  `orderSn` varchar(255) DEFAULT '' COMMENT '订单号',
  `newCustomer` varchar(255) DEFAULT '' COMMENT '新老客：0-待定，1-新客，2-老客',
  `channelTag` varchar(255) DEFAULT '' COMMENT '渠道商模式下表示自定义渠道标识；工具商模式下表示pid',
  `statParam` varchar(255) DEFAULT '' COMMENT '自定义统计参数,用户uid',
  `detailList` text COMMENT '商品明细',
  `totalCost` varchar(255) DEFAULT '' COMMENT '订单支付金额:单位元',
  `status` varchar(255) DEFAULT '' COMMENT '订单状态:0-不合格，1-待定，2-已完结',
  `orderTime` varchar(255) DEFAULT '' COMMENT '下单时间 时间戳 ',
  `signTime` varchar(255) DEFAULT '' COMMENT '签收时间',
  `settledTime` varchar(255) DEFAULT '' COMMENT '结算时间',
  `settled` varchar(255) DEFAULT '' COMMENT '订单结算状态 0-未结算,1-已结算',
  `selfBuy` varchar(255) DEFAULT '' COMMENT '是否自推自买 0-否，1-是',
  `orderSubStatusName` varchar(255) DEFAULT '' COMMENT '订单子状态：流转状态-支持状态：（已下单、已付款、已签收、待结算、已结算、已失效）',
  `commission` varchar(255) DEFAULT '' COMMENT '商品总佣金:单位元',
  `afterSaleChangeCommission` varchar(255) DEFAULT '' COMMENT '售后订单佣金变动：仅在订单完结之后发生售后行为时返回',
  `afterSaleChangeGoodsCount` varchar(255) DEFAULT '' COMMENT '售后订单总商品数量变动：仅在订单完结之后发生售后行为时返回',
  `orderSource` varchar(255) DEFAULT '' COMMENT '订单来源',
  `pid` varchar(255) DEFAULT '' COMMENT '推广PID:目前等同于channelTag',
  `isPrepay` varchar(255) DEFAULT '' COMMENT '是否预付订单:0-否，1-是',
  `isSplit` varchar(255) DEFAULT '' COMMENT '订单拆单标识: 0-否，1-是',
  `parentSn` varchar(255) DEFAULT '' COMMENT '订单母单号:订单为拆单子单时返回',
  `orderTrackReason` varchar(255) DEFAULT '' COMMENT '订单归因方式：0-常规推广,1-惊喜红包,2-锁粉,3-超级红包',
  `appKey` varchar(255) DEFAULT '' COMMENT '开发者调用的appKey：当订单是通过开发者API推广成单时返回，其余时候返回为空',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='蚂蚁星球-唯品会订单表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_cps_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
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


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_cps_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'cps首页名称',
  `mayi_apikey` varchar(255) NOT NULL DEFAULT '' COMMENT '蚂蚁星球apikey',
  `ztk_apikey` varchar(255) NOT NULL DEFAULT '' COMMENT '折淘客apikey',
  `ztk_sid` varchar(255) NOT NULL DEFAULT '' COMMENT '折淘客sid',
  `ztk_pid` varchar(255) NOT NULL DEFAULT '' COMMENT '折淘客pid',
  `tianmao_top` text COMMENT '天猫超市顶部图',
  `pdd_top` text COMMENT '拼多多顶部图',
  `ddq_top` text COMMENT '叮咚抢顶部图',
  `vip_top` text COMMENT '唯品会顶部图',
  `pyq_top` text COMMENT '朋友圈顶部图',
  `jkj_top` text COMMENT '9.9顶部图',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='cps设置表';


CREATE TABLE IF NOT EXISTS `ims_wjyk_zqds_cps_ztk_taobao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '所属公众号ID',
  `uid` int(11) DEFAULT '0' COMMENT 'uid',
  `tb_paid_time` varchar(255) DEFAULT '' COMMENT '订单在淘宝拍下付款的时间',
  `tk_paid_time` varchar(255) DEFAULT '' COMMENT '订单付款的时间，该时间同步淘宝，可能会略晚于买家在淘宝的订单创建时间',
  `pay_price` varchar(255) DEFAULT '' COMMENT '买家确认收货的付款金额（不包含运费金额）',
  `pub_share_fee` varchar(255) DEFAULT '' COMMENT '结算预估收入=结算金额*提成。',
  `trade_id` text COMMENT '买家通过购物车购买的每个商品对应的订单编号，此订单编号并未在淘宝买家后台透出',
  `trade_parent_id` text COMMENT '买家在淘宝后台显示的订单编号',
  `tk_order_role` varchar(255) DEFAULT '' COMMENT '二方：佣金收益的第一归属者； 三方：从其他淘宝客佣金中进行分成的推广者',
  `tk_earning_time` varchar(255) DEFAULT '' COMMENT '订单确认收货后且商家完成佣金支付的时间',
  `adzone_id` varchar(255) DEFAULT '' COMMENT '推广位管理下的推广位名称对应的ID，同时也是pid=mm_1_2_3中的“3”这段数字',
  `pub_share_rate` varchar(255) DEFAULT '' COMMENT '从结算佣金中分得的收益比率',
  `refund_tag` varchar(255) DEFAULT '' COMMENT '维权标签，0 含义为非维权 1 含义为维权订单',
  `tk_total_rate` varchar(255) DEFAULT '' COMMENT '提成=收入比率*分成比率。指实际获得收益的比率',
  `item_category_name` varchar(255) DEFAULT '' COMMENT '商品所属的根类目，即一级类目的名称',
  `subsidy_type` varchar(255) DEFAULT '' COMMENT '平台出资方，如天猫、淘宝、或聚划算等',
  `site_name` varchar(255) DEFAULT '' COMMENT '媒体管理下的对应ID的自定义名称',
  `seller_nick` varchar(255) DEFAULT '' COMMENT '掌柜旺旺',
  `seller_shop_title` varchar(255) DEFAULT '' COMMENT '店铺名称',
  `item_id` varchar(255) DEFAULT '' COMMENT '商品id',
  `item_img` varchar(255) DEFAULT '' COMMENT '商品图片',
  `item_title` varchar(255) DEFAULT '' COMMENT '商品标题',
  `item_num` varchar(255) DEFAULT '' COMMENT '商品数量',
  `item_price` varchar(255) DEFAULT '' COMMENT '商品单价',
  `item_link` varchar(255) DEFAULT '' COMMENT '商品链接',
  `tk_status` varchar(255) DEFAULT '' COMMENT '已付款：指订单已付款，但还未确认收货 已收货：指订单已确认收货，但商家佣金未支付 已结算：指订单已确认收货，且商家佣金已支付成功 已失效：指订单关闭/订单佣金小于0.01元，订单关闭主要有：1）买家超时未付款； 2）买家付款前，买家/卖家取消了订单；3）订单付款后发起售中退款成功；3：订单结算，12：订单付款， 13：订单失效，14：订单成功',
  `subsidy_rate` varchar(255) DEFAULT '' COMMENT '平台给与的补贴比率，如天猫、淘宝、聚划算等',
  `subsidy_fee` varchar(255) DEFAULT '' COMMENT '补贴金额=结算金额*补贴比率',
  `income_rate` varchar(255) DEFAULT '' COMMENT '订单结算的佣金比率+平台的补贴比率',
  `total_commission_rate` varchar(255) DEFAULT '' COMMENT '佣金比率',
  `total_commission_fee` varchar(255) DEFAULT '' COMMENT '佣金金额=结算金额*佣金比率',
  `alipay_total_price` varchar(255) DEFAULT '0' COMMENT '买家拍下付款的金额（不包含运费金额）',
  `rebate_status` smallint(1) DEFAULT '0' COMMENT '0-未返佣   1-已返佣',
  `rebate_rate` varchar(255) DEFAULT '' COMMENT '佣金比例，0.1 则代表10% ',
  `rebate_integral` varchar(255) DEFAULT '' COMMENT '订单返佣积分',
  `createtime` int(10) NOT NULL,
  `pid` varchar(255) DEFAULT '' COMMENT '上级id',
  `partner_rebate_rate` varchar(255) DEFAULT '' COMMENT '上级佣金比例，0.1 则代表10% ',
  `partner_rebate_integral` varchar(255) DEFAULT '' COMMENT '上级订单返佣积分',
  `relation_id` varchar(255) DEFAULT '' COMMENT '渠道关系id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='折淘客-淘宝订单表';

";
pdo_run($sql);
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_sn")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_sn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "p_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `p_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "auth_duo_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `auth_duo_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "zs_duo_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `zs_duo_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "custom_parameters")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `custom_parameters` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "goods_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `goods_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "goods_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `goods_name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "goods_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `goods_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "goods_thumbnail_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `goods_thumbnail_url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "goods_quantity")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `goods_quantity` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_amount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_amount` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "promotion_amount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `promotion_amount` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "promotion_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `promotion_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_status_desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_status_desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_create_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_create_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_pay_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_pay_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_receive_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_receive_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_settle_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_settle_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "order_verify_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `order_verify_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_pdd", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_pdd")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "orderSn")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `orderSn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "newCustomer")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `newCustomer` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "channelTag")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `channelTag` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "statParam")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `statParam` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "detailList")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `detailList` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "totalCost")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `totalCost` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "orderTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `orderTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "signTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `signTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "settledTime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `settledTime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "settled")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `settled` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "selfBuy")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `selfBuy` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "orderSubStatusName")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `orderSubStatusName` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "commission")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `commission` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "afterSaleChangeCommission")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `afterSaleChangeCommission` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "afterSaleChangeGoodsCount")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `afterSaleChangeGoodsCount` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "orderSource")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `orderSource` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "isPrepay")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `isPrepay` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "isSplit")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `isSplit` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "parentSn")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `parentSn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "orderTrackReason")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `orderTrackReason` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "appKey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `appKey` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_mayi_vip", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_mayi_vip")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "desc")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `desc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `type` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "pic_url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `pic_url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "url")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `url` text NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "appid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `appid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "is_display")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `is_display` smallint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "sort")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `sort` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_navigation", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_navigation")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "mayi_apikey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `mayi_apikey` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "ztk_apikey")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `ztk_apikey` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "ztk_sid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `ztk_sid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "ztk_pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `ztk_pid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "tianmao_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `tianmao_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "pdd_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `pdd_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "ddq_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `ddq_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "vip_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `vip_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "pyq_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `pyq_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "jkj_top")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `jkj_top` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_set", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_set")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "uid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "tb_paid_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `tb_paid_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "tk_paid_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `tk_paid_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "pay_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `pay_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "pub_share_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `pub_share_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "trade_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `trade_id` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "trade_parent_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `trade_parent_id` text;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "tk_order_role")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `tk_order_role` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "tk_earning_time")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `tk_earning_time` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "adzone_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `adzone_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "pub_share_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `pub_share_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "refund_tag")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `refund_tag` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "tk_total_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `tk_total_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_category_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_category_name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "subsidy_type")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `subsidy_type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "site_name")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `site_name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "seller_nick")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `seller_nick` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "seller_shop_title")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `seller_shop_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_img")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_img` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_title")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_num")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_num` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "item_link")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `item_link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "tk_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `tk_status` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "subsidy_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `subsidy_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "subsidy_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `subsidy_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "income_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `income_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "total_commission_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `total_commission_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "total_commission_fee")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `total_commission_fee` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "alipay_total_price")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `alipay_total_price` varchar(255) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "rebate_status")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `rebate_status` smallint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "pid")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `pid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "partner_rebate_rate")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `partner_rebate_rate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "partner_rebate_integral")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `partner_rebate_integral` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("wjyk_zqds_cps_ztk_taobao", "relation_id")) {
 pdo_query("ALTER TABLE ".tablename("wjyk_zqds_cps_ztk_taobao")." ADD `relation_id` varchar(255) DEFAULT '';");
}
