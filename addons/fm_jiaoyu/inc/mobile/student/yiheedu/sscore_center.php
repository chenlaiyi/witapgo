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
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where id = :id And openid = :openid", array(':id' => $_SESSION['user'],':openid' => $openid));
$school = pdo_fetch("SELECT title,spic FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id", array(':weid' => $weid, ':id' => $schoolid));
$setName = pdo_fetch("SELECT name FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}'")['name'];
if(!empty($it)){
    $userid = pdo_fetch("SELECT id FROM " . GetTableName('yiheedu_promote_user') . " where sid='{$it['sid']}'")['id'];
    $myuserid = $_GPC['myuserid'] ? $_GPC['myuserid'] : $userid;
    if(!$myuserid){
        message('您无权查看当前页面');
    }
    $student = pdo_fetch("SELECT u.score,s.s_name,(CASE WHEN s.icon != '' then s.icon else '{$school['spic']}' end) as icon, SUM((CASE WHEN l.type = 2 then l.money else 0 end)) as money FROM " . GetTableName('yiheedu_promote_user') . " as u LEFT JOIN ".GetTableName('students')." as s ON s.id = u.sid LEFT JOIN ".GetTableName('yiheedu_score_log')." as l ON l.pu_id = u.id where u.schoolid = :schoolid AND u.id = :id", array(':schoolid' => $schoolid, ':id' => $myuserid));
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
    include $this->template('students/yiheedu/sscore_center');
}else{
    session_destroy();
    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
    header("location:$stopurl");
    exit;
}        
?>