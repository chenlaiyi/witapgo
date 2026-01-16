<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$openid = $_W['openid'];
$schoolid = intval($_GPC['schoolid']);
$bj = pdo_fetchall("SELECT sid,sname FROM " . GetTableName('classify') . " where schoolid = :schoolid And type = :type And is_over!=:is_over ORDER BY ssort DESC", array(':type' => 'theclass', ':schoolid' => $schoolid,':is_over'=>"2"));
$nj = pdo_fetchall("SELECT sid,sname FROM " . GetTableName('classify') . " where schoolid = :schoolid And type = :type And is_over!=:is_over ORDER BY ssort DESC", array(':type' => 'semester', ':schoolid' => $schoolid,':is_over'=>"2"));
$bj_str_temp = '0,';
foreach($bj as $key_b=>$value_b){
	$bj_str_temp .=$value_b['sid'].",";
}
$bj_str = trim($bj_str_temp,",");
$nj_str_temp = '0,';
foreach($nj as $key_n=>$value_n){
	$nj_str_temp .=$value_n['sid'].",";
}
$nj_str = trim($nj_str_temp,",");
$school = pdo_fetch("SELECT id,title,logo,spic,tpic,headcolor,tel FROM " . GetTableName('index') . " where id = :id", array(':id' => $schoolid));
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
mload()->model('kc');
$nowtiem = time();
if($operation == "moreCourse"){
	$Ctype = $_GPC['Ctypeid'];
	if($Ctype != -1 ){
		$list_back = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And start < '{$nowtiem}' And is_show = 1 And xq_id = :xq_id ORDER BY ssort DESC , end DESC LIMIT 0,10", array(':xq_id' => $Ctype));
		// $list_back = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And start < '{$nowtiem}' And is_show = 1 And xq_id = :xq_id  And FIND_IN_SET(bj_id,:bj_str) And FIND_IN_SET(xq_id,:nj_str) ORDER BY ssort DESC , end DESC LIMIT 0,10", array(':xq_id' => $Ctype,':bj_str'=>$bj_str,':nj_str'=>$nj_str));
	}elseif($Ctype == -1){
		$list_back = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And start < '{$nowtiem}' And is_show = 1 ORDER BY ssort DESC , end DESC LIMIT 0,10");
	}
	foreach( $list_back as $key => $value ){
		$saleset = pdo_fetch("SELECT price FROM " . GetTableName('kc_saleset') . " WHERE id = :id ", array(':id' => $value['sale_id']));
		$list_back[$key]['nowprice'] = round($value['cose'] - $saleset['price'],2);
		$list_back[$key]['localtion'] = $key ;
		$list_back[$key]['fans_list'] = GetKcStuFans($value['id'],5);
		$list_back[$key]['all_number'] = GetKcContStu($value['id']);
	}
	include $this->template('comtool/sale_kc_list');
}elseif($operation == 'scroll_more'){
	$limit = $_GPC['limit'];
	$Ctype = $_GPC['ctype'] ;
	$page_start = $limit + 1 ;
	if($Ctype != -1 ){
		$list_back = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And start < '{$nowtiem}' And is_show = 1 And xq_id = :xq_id And FIND_IN_SET(bj_id,:bj_str) And FIND_IN_SET(xq_id,:nj_str)  ORDER BY ssort DESC , end DESC LIMIT ".$page_start.",10", array(':xq_id' => $Ctype,':bj_str'=>$bj_str,':nj_str'=>$nj_str));
		foreach( $list_back as $key => $value )	{
			$list_back[$key]['localtion'] = $page_start + $key ;
		}
	}elseif($Ctype == -1){
		$list_back = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And start < '{$nowtiem}' And is_show = 1 And FIND_IN_SET(bj_id,:bj_str) And FIND_IN_SET(xq_id,:nj_str)  ORDER BY ssort DESC , end DESC LIMIT ".$page_start.",10", array(':bj_str'=>$bj_str,':nj_str'=>$nj_str));
		foreach( $list_back as $key => $value )	{
			$saleset = pdo_fetch("SELECT price FROM " . GetTableName('kc_saleset') . " WHERE id = :id ", array(':id' => $value['sale_id']));
			$list_back[$key]['nowprice'] = round($value['cose'] - $saleset['price'],2);
			$list_back[$key]['localtion'] = $page_start + $key;
			$list_back[$key]['fans_list'] = GetKcStuFans($value['id'],5);
			$list_back[$key]['all_number'] = GetKcContStu($value['id'],true);
		}
	}
	include $this->template('comtool/sale_kc_list');
}elseif($operation == "display"){
	$kctitle = pdo_fetchall("SELECT * FROM " . GetTableName('icon') . " where schoolid = {$schoolid} And place = 25  ORDER by id ASC limit 3 ");
	// 查询所有的轮播图片
	$banner = pdo_fetchall("SELECT * FROM " . GetTableName('icon') . " where schoolid = {$schoolid} And place = 20 And status = 1 ORDER by id ASC ");
	// 查询所有精品课程
	$jpkc = pdo_fetchall("SELECT * FROM " . GetTableName('icon') . " where schoolid = {$schoolid} And place = 21 And status = 1 ORDER by id ASC");
	if($jpkc){
		foreach($jpkc as $key => $row){
			if(strstr($row['url'],'&kcid=') || strstr($row['url'],'&id=')){
				$url = strstr($row['url'],'&kcid=') ? explode('&kcid=',$row['url']) : explode('&id=',$row['url']);
				$kcid = $url[1];
				$kcinfo = pdo_fetch("SELECT sale_type,cose,sale_id,maintid FROM " . GetTableName('tcourse') . " where id = :id ", array(':id' => $kcid));
				$saleset = pdo_fetch("SELECT price,endtime FROM " . GetTableName('kc_saleset') . " WHERE id = :id ", array(':id' => $kcinfo['sale_id']));
				$teainfo = pdo_fetch("SELECT tname,thumb FROM " . GetTableName('teachers') . " where id = :id ", array(':id' => $kcinfo['maintid']));
				$jpkc[$key]['tname'] = $teainfo['tname'];
				$jpkc[$key]['thumb'] =!empty($teainfo['thumb'])?tomedia($teainfo['thumb']):tomedia($school['tpic']);
				$jpkc[$key]['cose'] = round($kcinfo['cose'],2);
				$jpkc[$key]['nowprice'] = round($kcinfo['cose'] - $saleset['price'],2);
				$jpkc[$key]['sale_type'] = $kcinfo['sale_type'];
				$jpkc[$key]['fans_list'] = GetKcStuFans($kcid,3);
				$jpkc[$key]['all_number'] = GetKcContStu($kcid,true);
				$jpkc[$key]['endtime'] = $saleset['endtime'] > time() ? true : false ;
			}
		}
	}
	//print_r($jpkc);
	// 查询固定的三个推荐课程
	$kccommend = pdo_fetchall("SELECT * FROM " . GetTableName('icon') . " where schoolid = {$schoolid} And place = 22 And status = 1 ORDER by id ASC ");
	// 查询推荐团购课程
	$kcteam = pdo_fetchall("SELECT * FROM " . GetTableName('icon') . " where schoolid = {$schoolid} And place = 23 And status = 1 ORDER by id ASC ");
	if($kcteam){
		foreach($kcteam as $key => $row){
			if(strstr($row['url'],'&kcid=') || strstr($row['url'],'&id=')){
				$url = strstr($row['url'],'&kcid=') ? explode('&kcid=',$row['url']) : explode('&id=',$row['url']);
				$kcid = $url[1];
				$kcinfo = pdo_fetch("SELECT sale_type,cose,sale_id FROM " . GetTableName('tcourse') . " where id = :id ", array(':id' => $kcid));
				$saleset = pdo_fetch("SELECT price,endtime FROM " . GetTableName('kc_saleset') . " WHERE id = :id ", array(':id' => $kcinfo['sale_id']));
				$kcteam[$key]['cose'] = round($kcinfo['cose'],2);
				$kcteam[$key]['nowprice'] = round($kcinfo['cose'] - $saleset['price'],2);
				$kcteam[$key]['sale_type'] = $kcinfo['sale_type'];
				$kcteam[$key]['fans_list'] = GetKcStuFans($kcid,3);
				$kcteam[$key]['all_number'] = GetKcContStu($kcid,true);
				$kcteam[$key]['endtime'] = $saleset['endtime'] > time() ? true : false ;
			}
		}
	}
	// 查询名师
	$kcteacher = pdo_fetchall("SELECT * FROM " . GetTableName('icon') . " where schoolid = {$schoolid} And place = 24 And status = 1 ORDER by id ASC ");
	$CourseType = pdo_fetchall("SELECT sid,sname FROM " . GetTableName('classify') . " where schoolid = '{$schoolid}' And type = 'semester' ORDER BY ssort DESC ");
	// $list = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And is_show = 1 And FIND_IN_SET(bj_id,'{$bj_str}') And FIND_IN_SET(xq_id,'{$nj_str}') ORDER BY end DESC,ssort DESC LIMIT 0,10");
	$list = pdo_fetchall("SELECT * FROM " . GetTableName('tcourse') . " WHERE schoolid = '{$schoolid}' And is_show = 1 ORDER BY end DESC,ssort DESC LIMIT 0,10");
	foreach($list as $key => $row){
		$saleset = pdo_fetch("SELECT price FROM " . GetTableName('kc_saleset') . " WHERE id = :id ", array(':id' => $row['sale_id']));
		$list[$key]['nowprice'] = round($row['cose'] - $saleset['price'],2);
		$list[$key]['fans_list'] = GetKcStuFans($row['id'],5);
		$list[$key]['all_number'] = GetKcContStu($row['id'],true);
	}
	if (empty($schoolid)) {
		message('没有找到该学校，请联系管理员！');
	}
	include $this->template('common/onlinekc');
}
		
?>
