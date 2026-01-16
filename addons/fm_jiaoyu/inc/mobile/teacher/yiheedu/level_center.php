<?php

/**
 * 微教育模块
 *
 * @author CC
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
mload()->model('tea');
//查询是否用户登录
$it = pdo_fetch("SELECT id,tid,is_allowmsg FROM " . tablename($this->table_user) . " where  weid = :weid And schoolid = :schoolid And openid = :openid And sid = :sid ", array(
    ':weid' => $weid,
    ':schoolid' => $schoolid,
    ':openid' => $openid,
    ':sid' => 0
));

$school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
if (!empty($it)) {
    $kc = pdo_fetch("SELECT (CASE WHEN kc_type then '线上课' else '线下课' end ) as kc_type,name,from_unixtime(start,'%Y/%m/%d') as start,from_unixtime(end,'%Y/%m/%d') as end,thumb FROM ".GetTableName('tcourse')." WHERE schoolid = '{$schoolid}' AND id = '{$_GPC['kc_id']}' ");
    //查看能查看等级层数
    $show_level = pdo_fetch("SELECT show_level FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}' AND weid = '{$weid}' ")['show_level'];
    // $v_child_success = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('yiheedu_share_log')." WHERE kc_id = '{$_GPC['kc_id']}' AND pu_id = '{$v['son_id']}' AND status = 1 ");
    //查看我的上级
    $mySuperior = pdo_fetch("SELECT r.createtime,t.tname,(CASE WHEN t.thumb != '' then t.thumb else '{$school['spic']}' end) as thumb,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 1) as success,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 0) as fail FROM ".GetTableName('yiheedu_promote_relation')." as r LEFT JOIN ".GetTableName('yiheedu_promote_user')." as u ON u.id = r.f_id LEFT JOIN ".GetTableName('teachers')." as t ON t.id = u.tid  WHERE r.pu_id = '{$_GPC['myuserid']}' AND r.kc_id = '{$_GPC['kc_id']}' ");
    if ($show_level > 0) {
        $myChildList = pdo_fetchAll("SELECT r.createtime,t.tname,(CASE WHEN t.thumb != '' then t.thumb else '{$school['spic']}' end) as thumb,r.pu_id as son_id,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 1) as success,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 0) as fail FROM ".GetTableName('yiheedu_promote_relation')." as r LEFT JOIN ".GetTableName('yiheedu_promote_user')." as u ON u.id = r.pu_id LEFT JOIN ".GetTableName('teachers')." as t ON t.id = u.tid WHERE f_id = '{$_GPC['myuserid']}' AND kc_id = '{$_GPC['kc_id']}' ");
        if ($show_level > 1 && count($myChildList) > 0) {
            foreach ($myChildList as $key => $value) {
                $v_child = pdo_fetchAll("SELECT r.createtime,t.tname,(CASE WHEN t.thumb != '' then t.thumb else '{$school['spic']}' end) as thumb,r.pu_id as son_id,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 1) as success,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 0) as fail FROM ".GetTableName('yiheedu_promote_relation')." as r LEFT JOIN ".GetTableName('yiheedu_promote_user')." as u ON u.id = r.pu_id LEFT JOIN ".GetTableName('teachers')." as t ON t.id = u.tid WHERE f_id = '{$value['son_id']}' AND kc_id = '{$_GPC['kc_id']}' ");
                if ($v_child && $show_level > 2) {
                    foreach ($v_child as $k => &$v) {
                        $vv_child = pdo_fetchAll("SELECT r.createtime,t.tname,(CASE WHEN t.thumb != '' then t.thumb else '{$school['spic']}' end) as thumb,r.pu_id as son_id,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 1) as success,(SELECT COUNT(id) FROM ".GetTableName('yiheedu_share_log')." as l WHERE l.pu_id = r.pu_id AND status = 0) as fail FROM ".GetTableName('yiheedu_promote_relation')." as r LEFT JOIN ".GetTableName('yiheedu_promote_user')." as u ON u.id = r.pu_id LEFT JOIN ".GetTableName('teachers')." as t ON t.id = u.tid WHERE f_id = '{$v['son_id']}' AND kc_id = '{$_GPC['kc_id']}' ");
                        $v['child'] = $vv_child;
                    }
                }
                $myChildList[$key]['child'] = $v_child;
            }
        }

    }
    
    include $this->template('teacher/yiheedu/level_center');
} else {
    session_destroy();
    $stopurl = $_W['siteroot'] . 'app/' . $this->createMobileUrl('bangding', array('schoolid' => $schoolid));
    header("location:$stopurl");
}
