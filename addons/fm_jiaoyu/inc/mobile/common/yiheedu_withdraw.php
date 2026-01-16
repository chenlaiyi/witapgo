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
$id = $_GPC['id'];
$school = pdo_fetch("SELECT title,tpic,spic FROM ".GetTableName('index')." WHERE id = {$schoolid} ");
$userid = pdo_fetchAll("SELECT id FROM ".GetTableName('user')." WHERE openid = '{$openid}' AND schoolid = '{$schoolid}' ");
if($userid){
    $set = pdo_fetch("SELECT * FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}'");
    $user = pdo_fetch("SELECT * FROM ".GetTableName('yiheedu_promote_user')." WHERE schoolid = '{$schoolid}' AND id = '{$_GPC['myuserid']}' ");
    if($user['tid']){ //老师
        $user['thumb'] = tomedia(pdo_fetch("SELECT (CASE WHEN thumb != '' then thumb else '{$school['tpic']}' end) as thumb,tname FROM ".GetTableName('teachers')." WHERE id = '{$user['tid']}' ")['thumb']);
    }else{
        $user['thumb'] = tomedia(pdo_fetch("SELECT (CASE WHEN icon != '' then icon else '{$school['spic']}' end) as icon FROM ".GetTableName('students')." WHERE id = '{$user['sid']}' ")['icon']);
    }
    $datestart = strtotime(date("Ymd",time()));
    $dateend = $datestart+86399;
    //今日已经提现次数
    $day_withdraw_num = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('yiheedu_score_log')." WHERE pu_id = '{$_GPC['myuserid']}' AND schoolid = '{$schoolid}' AND (createtime BETWEEN $datestart AND $dateend) ");
    $allow_day_withdraw = $set['day_max'] > $day_withdraw_num ? true : false;
    //总的提现次数
    $all_withdraw_num = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('yiheedu_score_log')." WHERE pu_id = '{$_GPC['myuserid']}' AND schoolid = '{$schoolid}'");
    $allow_all_withdraw = $set['max'] > $all_withdraw_num ? true : false;

    $taocan = pdo_fetchall("SELECT * FROM ".GetTableName('yiheedu_rule')." WHERE schoolid = '{$schoolid}'");
    include $this->template('greencom/yiheedu_withdraw');
}else{
    session_destroy();
    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
    header("location:$stopurl");
    exit;
}
?>