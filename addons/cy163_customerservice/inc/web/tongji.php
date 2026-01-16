<?php
global $_W, $_GPC;
$cservicelist = pdo_fetchall("SELECT id,content,name,thumb FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 ORDER BY displayorder ASC");
$operation = empty($_GPC['op']) ? 'display' : $_GPC['op'];
if($operation == 'display'){
	$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
	$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	
	$sdefaultDate = date("Y-m-d");
	$first = 1;
	$w = date('w',strtotime($sdefaultDate));
	$week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days'));
	
	$beginThisweek = strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days');
	$endThisweek = strtotime("$week_start +6 days");
	
	$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
	$endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
	
	
	$nowhour = intval(date("H",TIMESTAMP));
	$nowhouradd = $nowhour+1;
	$condition = "weid = {$_W['uniacid']} AND ((iszx = 0 AND (
		(lingjie = 0 AND endhour >= {$nowhouradd} AND starthour <= {$nowhour}) OR 
		(lingjie = 1 AND (starthour < {$nowhouradd} OR endhour > {$nowhour}))
	)";
	$zhouji = date("w");
	if($zhouji == "1" ){
		$condition .= " AND ((day1 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	if($zhouji == "2" ){
		$condition .= " AND ((day2 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	if($zhouji == "3" ){
		$condition .= " AND ((day3 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	if($zhouji == "4" ){
		$condition .= " AND ((day4 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	if($zhouji == "5" ){
		$condition .= " AND ((day5 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	if($zhouji == "6" ){
		$condition .= " AND ((day6 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	if($zhouji == "0" ){
		$condition .= " AND ((day7 = 1 AND isxingqi = 1) OR isxingqi = 0))";
	}
	$condition .= " OR (iszx = 1 AND isrealzx = 1))";
	$alljd = $alltotal = 0;
	foreach($cservicelist as $k=>$v){
		$iszxcservice = pdo_fetch("SELECT id FROM ".tablename(BEST_CSERVICE)." WHERE ".$condition." AND id = {$v['id']}");
		$cservicelist[$k]['online'] = empty($iszxcservice) ? 0 : 1;
		
		$alljd += pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$v['content']}' AND kefulasttime > 0");
		$alltotal += pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND openid = '{$v['content']}'");
		
		$cservicelist[$k]['todaynewnum'] = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND intime > {$beginToday} AND intime < {$endToday} AND kefuopenid = '{$v['content']}'");
		$cservicelist[$k]['todaynewnum'] = empty($cservicelist[$k]['todaynewnum']) ? 0 : $cservicelist[$k]['todaynewnum'];
		
		$cservicelist[$k]['todayjdnum'] = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefulasttime > {$beginToday} AND kefulasttime < {$endToday} AND kefuopenid = '{$v['content']}'");
		$cservicelist[$k]['weekjdnum'] = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefulasttime > {$beginThisweek} AND kefulasttime < {$endThisweek} AND kefuopenid = '{$v['content']}'");
		$cservicelist[$k]['monthjdnum'] = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefulasttime > {$beginThismonth} AND kefulasttime < {$endThismonth} AND kefuopenid = '{$v['content']}'");
		
		
		$toadyhf = pdo_fetchall("SELECT id FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND time > {$beginToday} AND time < {$endToday} AND openid = '{$v['content']}'");
		$cservicelist[$k]['todayhfnum'] = count($toadyhf);
		
		$weekhf = pdo_fetchall("SELECT id FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND time > {$beginThisweek} AND time < {$endThisweek} AND openid = '{$v['content']}'");
		$cservicelist[$k]['weekhfnum'] = count($weekhf);
		
		$monthhf = pdo_fetchall("SELECT id FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND time > {$beginThismonth} AND time < {$endThismonth} AND openid = '{$v['content']}'");
		$cservicelist[$k]['monthhfnum'] = count($monthhf);
	}
}elseif($operation == 'detail'){
	if (empty($starttime) || empty($endtime)) {
		$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endtime = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	}
	if (!empty($_GPC['time'])) {
		$starttime = strtotime($_GPC['time']['start']);
		$endtime = strtotime($_GPC['time']['end']) + 86399;
	}
	foreach($cservicelist as $k=>$v){		
		$cservicelist[$k]['jdnum'] = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefulasttime > {$starttime} AND kefulasttime < {$endtime} AND kefuopenid = '{$v['content']}'");
		$cservicelist[$k]['hfnum'] = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND time > {$starttime} AND time < {$endtime} AND openid = '{$v['content']}'");
	}
}elseif($operation == 'new'){
	$openid = trim($_GPC['openid']);
	$nointimes = pdo_fetchall("SELECT id,intime FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND lasttime > 0 AND intime = 0");
	foreach($nointimes as $k=>$v){
		$firstchat = pdo_fetch("SELECT time FROM ".tablename(BEST_CHAT)." WHERE fkid = {$v['id']} ORDER BY time ASC");
		if(!empty($firstchat)){
			$dataup['intime'] = $firstchat['time'];
			pdo_update(BEST_FANSKEFU,$dataup,array('id'=>$v['id']));
		}
	}
	if (!empty($_GPC['time'])) {
		$stime = strtotime($_GPC['time']['start']." 00:00:00");
		$etime = strtotime($_GPC['time']['end']." 23:59:59");
	}else{
		$stime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$etime = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	}
	$todaynewnum = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND intime > {$stime} AND intime < {$etime} AND kefuopenid = '{$openid}'");
	$todaynewnum = empty($todaynewnum) ? 0 : $todaynewnum;
	$fans = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND intime > {$stime} AND intime < {$etime} AND kefuopenid = '{$openid}' ORDER BY intime ASC");
}
include $this->template('web/tongji');
?>