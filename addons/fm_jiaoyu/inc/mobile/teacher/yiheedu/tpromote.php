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
//查询是否用户登录
$it = pdo_fetch("SELECT tid FROM " . GetTableName('user') . " where schoolid = :schoolid And openid = :openid And sid = :sid ", array(':schoolid' => $schoolid,':openid' => $openid,':sid' => 0));
if(!empty($it)){
    $promote_level = pdo_fetch("SELECT promote_level FROM ".GetTableName('yiheedu_set')." WHERE schoolid = '{$schoolid}' ")['promote_level'];
    //查询当前老师层级
    // pdo_fetch("SELECT f.f_id as f_id,ff.f_id as ff_id,fff.f_id as fff_id FROM ".GetTableName('yiheedu_promote_relation')." as f LEFT JOIN ".GetTableName('yiheedu_promote_relation')." as ff ON f.f_id = ff.pu_id LEFT JOIN ".GetTableName('yiheedu_promote_relation')." as fff ON ff.f_id = fff.pu_id WHERE f.schoolid = '{$order['schoolid']}' AND f.pu_id = '{$order['shareuserid']}' AND f.kc_id = '{$order['kcid']}' ");
    //查询出当前老师的唯一身份
    $pu_id = pdo_fetch("SELECT id FROM ".GetTableName('yiheedu_promote_user')." WHERE schoolid = '{$schoolid}' AND tid = '{$it['tid']}' ")['id'];
    //查询当前老师推广的所有课程
    $list = pdo_fetchall("SELECT r.id,r.pu_id,r.kc_id,t.name,t.start,t.end,t.is_try,t.thumb,t.kc_type FROM ".GetTableName('yiheedu_promote_relation')." as r LEFT JOIN ".GetTableName('tcourse')." as t ON t.id = r.kc_id WHERE r.schoolid = '{$schoolid}' AND r.pu_id = '{$pu_id}' ");
    foreach ($list as $key => $value) {
        $i = 0;
        $level1 = pdo_fetch("SELECT f_id FROM ".GetTableName('yiheedu_promote_relation')." WHERE pu_id = '{$value['pu_id']}' AND kc_id = '{$value['kc_id']}' AND f_id != 0 ");
        if($level1){
            $i++;
        }
        $level2 = pdo_fetch("SELECT f_id FROM ".GetTableName('yiheedu_promote_relation')." WHERE pu_id = '{$level1['f_id']}' AND kc_id = '{$value['kc_id']}' AND f_id != 0 ");
        if($level2){
            $i++;
        }
        $level3 = pdo_fetch("SELECT f_id FROM ".GetTableName('yiheedu_promote_relation')." WHERE pu_id = '{$level2['f_id']}' AND kc_id = '{$value['kc_id']}' AND f_id != 0 ");
        if($level3){
            $i++;
        }
        if($promote_level > $i){
            $list[$key]['promote_level'] = true;
        }else{
            $list[$key]['promote_level'] = false;
        }
        if(!$value['name']){
            unset($list[$key]);
        }
    }
	include $this->template('teacher/yiheedu/tpromote');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}
?>