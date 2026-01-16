<?php
/**
 * 微教育模块
 * @author 高贵血迹
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$openid = $_W['openid'];
$schoolid = intval($_GPC['schoolid']);

include $this->template('greencom/guid');
?>