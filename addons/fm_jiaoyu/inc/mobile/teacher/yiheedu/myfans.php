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
$school = pdo_fetch("SELECT title,tpic FROM ".GetTableName('index')." WHERE id = {$schoolid} ");
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
//查询是否用户登录
$it = pdo_fetch("SELECT tid FROM " . GetTableName('user') . " where schoolid = :schoolid And openid = :openid And sid = :sid ", array(':schoolid' => $schoolid,':openid' => $openid,':sid' => 0));
if(!empty($it)){
    //课程基本信息
    $kcinfo = pdo_fetch("SELECT (CASE WHEN kc_type then '线上课' else '线下课' end ) as kc_type,name,from_unixtime(start,'%Y/%m/%d') as start,from_unixtime(end,'%Y/%m/%d') as end,thumb FROM ".GetTableName('tcourse')." WHERE schoolid = '{$schoolid}' AND id = '{$_GPC['kc_id']}' ");
    $kcinfo['thumb'] = $kcinfo['thumb'] ? tomedia($kcinfo['thumb']) : tomedia($school['tpic']);
    //推广信息
    if($op == 'getData'){
        $maxid = $_GPC['__input']['maxid'] ? $_GPC['__input']['maxid'] : 0;
        $condition = '';
        if($maxid != 0){
            $condition .= " AND id < '{$maxid}'";
        }
        if($_GPC['__input']['type'] == '1'){ //今天
            $starttime = strtotime(date("Ymd",time()));
            $endtime = $starttime + 86399;
            $condition .= " AND (createtime BETWEEN '{$starttime}' AND '{$endtime}')";
        }elseif($_GPC['__input']['type'] == '2'){ //一周之内
            $starttime = strtotime(date("Ymd",time())) - 7*86400 ;
            $endtime = time();
            $condition .= " AND (createtime BETWEEN '{$starttime}' AND '{$endtime}')";
        }elseif($_GPC['__input']['type'] == '3'){ //一个月以内
            $starttime = strtotime(date("Ymd",time())) - 30*86400;
            $endtime = time();
            $condition .= " AND (createtime BETWEEN '{$starttime}' AND '{$endtime}')";
        }elseif($_GPC['__input']['type'] == '4'){ //三个月之内
            $starttime = strtotime(date("Ymd",time())) - 90*86400;
            $endtime = time();
            $condition .= " AND (createtime BETWEEN '{$starttime}' AND '{$endtime}')";
        }elseif($_GPC['__input']['type'] == '5'){ //半年之内
            $starttime = strtotime(date("Ymd",time())) - 180*86400;
            $endtime = time();
            $condition .= " AND (createtime BETWEEN '{$starttime}' AND '{$endtime}')";
        }elseif($_GPC['__input']['type'] == '6'){ //半年以后
            $starttime = strtotime(date("Ymd",time())) - 181*86400;
            $condition .= " AND createtime <= '{$starttime}'";
        }
        $promote_log = pdo_fetchAll("SELECT fans_openid,status,from_unixtime(createtime,'%Y/%m/%d') as createtime FROM ".GetTableName('yiheedu_share_log')." WHERE schoolid = '{$schoolid}' AND pu_id = '{$_GPC['pu_id']}' AND kc_id = '{$_GPC['kc_id']}' $condition ORDER BY createtime DESC LIMIT 0,6");
        $logList = [];
        foreach ($promote_log as $key => $value) {
            $fans = mc_fansinfo($value['fans_openid'],0,$weid);
            $logList[$key]['icon'] = $fans['avatar'];
            $logList[$key]['nickname'] = $fans['nickname'];
            $logList[$key]['time'] = $value['createtime'];
            $logList[$key]['status'] = $value['status'] == 1 ? '成功' : '失败';
        }
        $result['ScrollAjaxLock'] = $_GPC['__input']['ScrollAjaxLock'];
        $result['status'] = true;
        $result['msg'] = '获取成功';
        $result['data'] = $logList;
        $result['sql'] = $_GPC;
        die(json_encode($result));
    }
    
	include $this->template('teacher/yiheedu/myfans');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}
?>