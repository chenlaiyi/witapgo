<?php
/*
* @Discription:  
* @Author: Hannibal·Lee
* @Date: 2019-09-21 16:15:06
* @LastEditTime: 2020-06-22 12:02:11
*/ 
/**
 * 微教育模块
 *
 * @author CC
 */
global $_W, $_GPC;
$weid = $_W ['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
$schooltype  = $_W['schooltype'];
$obid = 1;
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$it = pdo_fetch("SELECT id,tid,is_allowmsg FROM " . tablename($this->table_user) . " where  weid = :weid And schoolid = :schoolid And openid = :openid And sid = :sid ", array(
	':weid' => $weid,
	':schoolid' => $schoolid,
	':openid' => $openid,
	':sid' => 0
));
$userid = pdo_fetch("SELECT id FROM " . GetTableName('yiheedu_promote_user') . " where tid='{$it['tid']}'")['id'];
$myuserid = $_GPC['myuserid'] ? $_GPC['myuserid'] : $userid;
$school = pdo_fetch("SELECT title,tpic FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id", array(':weid' => $weid, ':id' => $schoolid));
$setName = pdo_fetch("SELECT name FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}'")['name'];
if(!empty($it)){
    if(!$myuserid){
        message('您无权查看当前页面');
    }
    $teacher = pdo_fetch("SELECT u.score,t.tname,(CASE WHEN t.thumb != '' then t.thumb else '{$school['tpic']}' end) as thumb, SUM((CASE WHEN l.type = 2 then l.money else 0 end)) as money FROM " . GetTableName('yiheedu_promote_user') . " as u LEFT JOIN ".GetTableName('teachers')." as t ON t.id = u.tid LEFT JOIN ".GetTableName('yiheedu_score_log')." as l ON l.pu_id = u.id where u.schoolid = :schoolid AND u.id = :id", array(':schoolid' => $schoolid, ':id' => $myuserid));
    if($op == 'getFirstData'){
        if($_GPC['__input']['type'] == 0){
            $condition = " AND type != '2'"; //非提现
        }else{
            $condition = " AND type = '2'"; //提现
        }
        $list = pdo_fetchAll("SELECT money,(CASE WHEN score then score else 0 end) as score,(CASE WHEN type = 1 then '层级返利' WHEN type = 0 then '推广得分' else '提现' end) as score_name,from_unixtime(createtime,'%Y/%m/%d') as createtime,type FROM " . GetTableName('yiheedu_score_log') . " where schoolid = :schoolid AND (pu_id = '{$_GPC['myuserid']}' OR f_id = '{$_GPC['myuserid']}' OR ff_id = '{$_GPC['myuserid']}') $condition", array(':schoolid' => $schoolid));
        $result['list'] = $list;
        die(json_encode($result));
    }
    include $this->template('teacher/yiheedu/score_center');
}else{
    session_destroy();
    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
    header("location:$stopurl");
    exit;
}        
?>