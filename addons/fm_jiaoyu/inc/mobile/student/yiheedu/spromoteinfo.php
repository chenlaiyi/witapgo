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
$school = pdo_fetch("SELECT title FROM ".GetTableName('index')." WHERE id = {$schoolid} ");
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
//查询是否用户登录
$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where id = :id And openid = :openid", array(':id' => $_SESSION['user'],':openid' => $openid));
if(!empty($it)){
    mload()->model('kc');
    //查询出当前老师的唯一身份
    $school = pdo_fetch("SELECT title FROM ".GetTableName('index')." WHERE id = '{$schoolid}'");
    //课程基本信息
    $kcinfo = pdo_fetch("SELECT (CASE WHEN kc_type then '线上课' else '线下课' end ) as kc_type,name,from_unixtime(start,'%Y/%m/%d') as start,from_unixtime(end,'%Y/%m/%d') as end,thumb FROM ".GetTableName('tcourse')." WHERE schoolid = '{$schoolid}' AND id = '{$_GPC['kc_id']}' ");
    //推广信息
    $promoteinfo = pdo_fetch("SELECT count(id) as promote_num, IFNULL (SUM(CASE WHEN status = 1 then 1 else 0 end),0) as buy_num FROM ".GetTableName('yiheedu_share_log')." WHERE schoolid = '{$schoolid}' AND pu_id = '{$_GPC['myuserid']}' AND kc_id = '{$_GPC['kc_id']}' ");
    $promoteinfo['percent'] = $promoteinfo['promote_num'] !=0 ? round($promoteinfo['buy_num'] / $promoteinfo['promote_num']*100,2) : 0;
    //推广记录
    $promote_log = pdo_fetchAll("SELECT fans_openid,score,from_unixtime(createtime,'%Y-%m-%d') as createtime FROM ".GetTableName('yiheedu_share_log')." WHERE schoolid = '{$schoolid}' AND pu_id = '{$_GPC['myuserid']}' AND kc_id = '{$_GPC['kc_id']}' ORDER BY createtime DESC LIMIT 0,10");
    foreach ($promote_log as $key => $value) {
        $fans = mc_fansinfo($value['fans_openid'],0,$weid);
        $promote_log[$key]['avatar'] = $fans['avatar'];
        $promote_log[$key]['nickname'] = $fans['nickname'];
    }
	include $this->template('students/yiheedu/spromoteinfo');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}
?>