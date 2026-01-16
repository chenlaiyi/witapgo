<?php
/**
 * 微教育小程序模块小程序接口定义
 *
 * @author 微美科技
 * @url 
 */
defined('IN_IA') or exit('Access Denied');
require  'inc/func/core.php';
include 'model.php';
class Fm_jiaoyuwxappModuleWxapp extends WeModuleWxapp {
	public function doPageTest(){
		global $_GPC, $_W;
		$errno = 0;
		$message = '返回消息';
		$data = array();
		return $this->result($errno, $message, $data);
	}
	public function doPageGetareaandtype(){
		global $_GPC, $_W;
		$fromweid = pdo_fetch("SELECT fromweid,schoolid FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$_W['uniacid']}'");
		$type = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_type) . " WHERE weid = '{$fromweid['fromweid']}' ORDER BY id DESC	");
		$city = pdo_fetchall("SELECT id,name FROM " . tablename($this->table_area) . " WHERE weid = '{$fromweid['fromweid']}' AND type='city' ORDER BY id DESC	");
		$area = pdo_fetchall("SELECT id,name,parentid FROM " . tablename($this->table_area) . " WHERE weid = '{$fromweid['fromweid']}' AND type='' ORDER BY id DESC	");
		$arealist = array();
		foreach( $city as $key => $value )
		{
			$city[$key]['area'] =pdo_fetchall("SELECT id,name,parentid FROM " . tablename($this->table_area) . " WHERE weid = '{$fromweid['fromweid']}' AND type='' AND parentid='{$value['id']}' ORDER BY id DESC	"); 
		}
		$data['binding'] =  '../detail/detail?url='.urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$fromweid['fromweid'].'&c=entry&m=fm_jiaoyu&do=binding&openid='.$_W['openid']);
		$data['user'] =  '../detail/detail?url='.urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$fromweid['fromweid'].'&c=entry&m=fm_jiaoyu&do=user&openid='.$_W['openid']);
		$data['myschool'] =  '../detail/detail?url='.urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$fromweid['fromweid'].'&c=entry&m=fm_jiaoyu&do=myschool&openid='.$_W['openid']);
		$data['test'] = str_replace('./','',$this->createMobileUrl('guid', array('id' => $value['costid'], 'schoolid' => $schoolid, 'type' => 1)));	
		$data['openid'] = $_W['openid'];	
		$data['type'] = $type;
		$data['city'] = $city;
		//$data['area'] = $arealist;
		return $this->result(0, $message, $data);
	}

	public function doPageGetschool(){
		global $_GPC, $_W;
		$condition = ' AND is_show = 1 ';
		$pindex = $_GPC ['page'];
		$psize = 9 ;
		$lat = $_GPC['lat'];
		$lng = $_GPC['lng'];
		 
		if(!empty($_GPC['area_id']) && $_GPC['area_id'] != 0){
			$condition .= " AND areaid = '{$_GPC['area_id']}'";
		}
		if(!empty($_GPC['city_id']) && $_GPC['city_id'] != 0 ){
			$condition .= " AND cityid = '{$_GPC['city_id']}'";
		}
		if(!empty($_GPC['star_id']) && $_GPC['star_id'] != 0){
			$condition .= " AND typeid = '{$_GPC['star_id']}'";
		}
			$fromweid = pdo_fetch("SELECT fromweid,schoolid FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$_W['uniacid']}'");
		
		
		if($_GPC['order'] == '1'){
			//$school = pdo_fetchall("SELECT id,title,lat,lng,address,tel,logo,areaid,typeid,cityid FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}' $condition ORDER BY ssort DESC	LIMIT 0 ,"   . $pindex  * $psize);
			//$more = pdo_fetchall("SELECT id FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}' $condition ORDER BY ssort DESC	LIMIT " . $pindex  * $psize . ',' . $psize);
			$school = pdo_fetchall("SELECT id,title,lat,lng,address,tel,logo,areaid,typeid,cityid,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}'   $condition ORDER BY dist ASC ,ssort DESC	LIMIT 0 ,"   . $pindex  * $psize);
			$more = pdo_fetchall("SELECT id,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}'   $condition ORDER BY dist ASC ,id DESC	LIMIT " . $pindex  * $psize . ',' . $psize);
		}elseif($_GPC['order'] == '2'){
			$school = pdo_fetchall("SELECT id,title,lat,lng,address,tel,logo,areaid,typeid,cityid,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}'   $condition ORDER BY dist ASC ,ssort DESC	LIMIT 0 ,"   . $pindex  * $psize);
			$more = pdo_fetchall("SELECT id,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}'   $condition ORDER BY dist ASC ,id DESC	LIMIT " . $pindex  * $psize . ',' . $psize);

		}elseif($_GPC['order'] == '3'){
			$school = pdo_fetchall("SELECT id,title,lat,lng,address,tel,logo,areaid,typeid,cityid,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}'  $condition ORDER BY dist DESC ,ssort DESC	LIMIT 0 ,"   . $pindex  * $psize);
			$more = pdo_fetchall("SELECT id,(lat-'{$lat}') * (lat-'{$lat}') + (lng-'{$lng}') * (lng-'{$lng}') as dist FROM " . tablename($this->table_index) . " WHERE weid = '{$fromweid['fromweid']}'   $condition ORDER BY dist DESC ,ssort DESC	LIMIT " . $pindex  * $psize . ',' . $psize);

		}

		foreach( $school as $key => $value )
		{
			$city = pdo_fetch("SELECT name FROM " . tablename($this->table_area) . " WHERE id = '{$value['cityid']}'  ");
			$area = pdo_fetch("SELECT name FROM " . tablename($this->table_area) . " WHERE id = '{$value['areaid']}' ");
			$type = pdo_fetch("SELECT name FROM " . tablename($this->table_type) . " WHERE id = '{$value['typeid']}' ");
			$lats = $value['lat'];
			$lngs = $value['lng'];
			$gps = Convert_BD09_To_GCJ02($lats,$lngs);
			$school[$key]['juli'] = round(getDistance($lat,$lng,$gps['lat'],$gps['lng'])/1000, 1);;
			$school[$key]['logos'] = tomedia($value['logo'] );
			$school[$key]['location'] = $city['name'].$area['name'];
			$school[$key]['typename'] = $type['name'];
			$school[$key]['schoolid'] = $value['id'];
			$school[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$fromweid['fromweid'].'&c=entry&schoolid='.$value['id'].'&m=fm_jiaoyu&do=detail&openid='.$_W['openid']);
		}
		$data = array();
		$data['datas'] = $school;
		if(!empty($more)){
			$data['more'] = 1;
		}else{
			$data['more'] = 0;
		}
		//$data['area'] = $arealist;

		return $this->result(0, $message,$data);
	}
	
	public function doPageGetdetail(){
		global $_GPC, $_W;
		session_start();
		$data['dos'] = $_SESSION['dos'];
		session_destroy();
		return $this->result(0, '成功111111', $data);
	}
	
	public function doPageGetclor(){
		global $_GPC, $_W;
		$item = pdo_fetch("SELECT headfont,headcolor,headtitle FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$_W['uniacid']}'");
		$fans = pdo_fetch("SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE openid = '{$_W['openid']}' And uniacid = '{$_W['uniacid']}' ");
		$member = pdo_fetch("SELECT nickname,avatar FROM " . tablename('mc_members') . " WHERE uid = '{$fans['uid']}' And uniacid = '{$_W['uniacid']}' ");
		if(!empty($fans['uid']) && !empty($member['nickname'])){
			$data['ismember'] = true;
		}else{
			$data['ismember'] = false;
		}
		$data['title'] = $item['headtitle'];
		$data['headfont'] = $item['headfont'];  //headfontcolor
		$data['headcolor'] = $item['headcolor'];		//headcolor
		return $this->result(0, '成功', $data);
	}
	
	public function doPageGetfooterstu(){
		global $_GPC, $_W;
		$school = pdo_fetch("SELECT id FROM " . tablename($this->table_index) . " WHERE id = '{$_GPC['schoolid']}'");
		if($school['id']){
			$left = pdo_fetchall("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = :schoolid And place = :place And status = :status And ssort < :ssort ORDER by ssort ASC", array(':schoolid' => $school['id'], ':place' => 6, ':status' => 1, ':ssort' => 3));
			foreach ($left as $key => $row) {
				$left[$key]['icon'] = tomedia($row['icon']);
				$left[$key]['ishome'] = false;
				if (preg_match('/(http:\/\/)|(https:\/\/)/i', $row['url'])){
					$left[$key]['url'] = urlencode($row['url']);
				}else{
					if (preg_match('/detail/i', $row['url'])){
						$left[$key]['icon2'] = tomedia($row['icon2']);
						$left[$key]['url'] = '../home/home?schoolid='.$school['id'];
						$left[$key]['ishome'] = true;
					}else{
						$left[$key]['url'] = '../detail/detail?url='.urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/'.str_replace('./','',$row['url']).'&openid='.$_W['openid']);
					}					
				}			
			}
			$right = pdo_fetchall("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = :schoolid And place = :place And status = :status And ssort > :ssort ORDER by ssort ASC", array(':schoolid' => $school['id'], ':place' => 6, ':status' => 1, ':ssort' => 3));
			foreach ($right as $key => $row) {
				$right[$key]['icon'] = tomedia($row['icon']);
				$right[$key]['ishome'] = false;
				if (preg_match('/(http:\/\/)|(https:\/\/)/i', $row['url'])){
					$right[$key]['url'] = urlencode($row['url']);
				}else{
					if (preg_match('/detail/i', $row['url'])){
						$right[$key]['icon2'] = tomedia($row['icon2']);
						$right[$key]['url'] = '../home/home?schoolid='.$school['id'];
						$right[$key]['ishome'] = true;
					}else{
						$right[$key]['url'] = '../detail/detail?url='.urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/'.str_replace('./','',$row['url']).'&openid='.$_W['openid']);
					}
				}			
			}			
			$center = pdo_fetchall("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = :schoolid And place = :place And status = :status ORDER by ssort ASC", array(':schoolid' => $school['id'], ':place' => 7, ':status' => 1));
			foreach ($center as $key => $row) {
				$center[$key]['icon'] = tomedia($row['icon']);
				$center[$key]['ishome'] = false;
				if($row['ssort'] == "1"){
					$center[$key]['order'] = "animCollect";
					$center[$key]['bindtap'] = "collect";
				}
				if($row['ssort'] == "2"){
					$center[$key]['order'] = "animTranspond";
					$center[$key]['bindtap'] = "transpond";
				}
				if($row['ssort'] == "3"){
					$center[$key]['order'] = "animInput";
					$center[$key]['bindtap'] = "input";
				}				
				if (preg_match('/(http:\/\/)|(https:\/\/)/i', $row['url'])){
					$center[$key]['url'] = urlencode($row['url']);
				}else{
					if (preg_match('/detail/i', $row['url'])){
						$center[$key]['icon2'] = tomedia($row['icon2']);
						$center[$key]['url'] = '../home/home?schoolid='.$school['id'];
						$center[$key]['ishome'] = true;
					}else{
						$center[$key]['url'] = '../detail/detail?url='.urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/'.str_replace('./','',$row['url']).'&openid='.$_W['openid']);
					}
				}			
			}
			$icons_10 =  pdo_fetch("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = :schoolid And place = :place  ", array(':schoolid' => $school['id'],':place' => 10));
			$icons_10['icon'] = tomedia($icons_10['icon']);
			$center_icon = false;
			if (preg_match('/bottom_menu_icon_add/i', $icons_10['icon'])){
				$center_icon = true;
			}
			$iconcunt = count($left) + count($right);
			if(count($center) > 0){
				$iconcunt = $iconcunt + 1;
			}
			if($iconcunt>0){
				$data['itemwiht'] = 100/$iconcunt .'%';
			}else{
				$data['itemwiht'] = '100%';
			}
			$data['footercenter'] = $icons_10;
			$data['center'] = $center;
			$data['footleft'] = $left;
			$data['footright'] = $right;
		}
		return $this->result(0, '成功', $data);
	}	

	public function doPageGetschoolhome(){
		global $_GPC, $_W;
		$item = pdo_fetch("SELECT fromweid FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$_W['uniacid']}'");
		$school = pdo_fetch("SELECT id,logo FROM " . tablename($this->table_index) . " WHERE id = '{$_GPC['schoolid']}'");
		if($school['id']){
			$nowtime = time();
			$bannerdata = array();	
			$banners = pdo_fetchall("SELECT * FROM " . tablename($this->table_banners) . " WHERE enabled = 1 AND weid = '{$item['fromweid']}' ORDER BY leixing DESC, displayorder ASC");
			foreach ($banners as $key => $banner) {
				if ($banner['leixing'] == 1) {
					$uniarr = explode(',',$banner['arr']);
					$is = $this->uniarr($uniarr,$school['id']);
					if ($is && $nowtime >= $banner['begintime'] && $nowtime < $banner['endtime']) {
						$bannerdata['bannername'][] = $banner['bannername'];
						$bannerdata['banner'][$key]['link'] = '';
						if (preg_match('/(http:\/\/)|(https:\/\/)/i', $row['url'])){
							$bannerdata['banner'][$key]['link'] = urlencode($banner['link']);
						}
						$bannerdata['banner'][$key]['thumb'] = tomedia($banner['thumb']);
					}
				}else{
					if ($banner['schoolid'] == $school['id']) {
						$bannerdata['bannername'][] = $banner['bannername'];
						$bannerdata['banner'][$key]['link'] = urlencode($banner['link']);
						$bannerdata['banner'][$key]['thumb'] = tomedia($banner['thumb']);
					}
				}
			}			
			$icon = pdo_fetchall("SELECT id,url,name,icon FROM " . tablename($this->table_icon) . " where weid = {$item['fromweid']} AND schoolid= '{$school['id']}' AND status=1 AND place=1 ORDER BY ssort ASC");
			$centericon = array();	
			foreach ($icon as $key => $row) {
				if (preg_match('/(http:\/\/)|(https:\/\/)/i', $row['url'])){
					$centericon[$key]['url'] = urlencode($row['url']);
				}else{
					$centericon[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/'.str_replace('./','',$row['url']).'&openid='.$_W['openid']);
				}
				$centericon[$key]['id'] = $row['id'];
				$centericon[$key]['icon'] = tomedia($row['icon']);
				$centericon[$key]['name'] = $row['name'];
			}
			if(count($centericon) > 4){
				$data['centerheight'] = '200px';
			}else{
				$data['centerheight'] = '100px';
			}			
			$list_jpk = pdo_fetchall("SELECT name,minge,id,schoolid,thumb,cose,OldOrNew FROM " . tablename($this->table_tcourse) . " WHERE schoolid = :schoolid And is_hot = :is_hot And end > :timeEnd ORDER BY  RAND() LIMIT 0,5 ", array(':schoolid'=>$school['id'],'is_hot'=>1,':timeEnd'=>$nowtime));
			foreach($list_jpk as $key => $row){
				$list_jpk[$key]['icon'] = !empty($row['thumb']) ? tomedia($row['thumb']) : tomedia($school['logo']);
				$list_jpk[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$row['schoolid'].'&m=fm_jiaoyu&do=kcinfo&id='.$row['id'].'&openid='.$_W['openid']);
				if($row['minge'] != 0){
					$list_jpk[$key]['renshu'] = $row['minge'].'人班';
				}else{
					$list_jpk[$key]['renshu'] = '无人数限制';
				}
				if($row['OldOrNew'] == 1){
					$list_jpk[$key]['pirce'] = '￥'.$row['cose'].'/首购';
				}else{
					$list_jpk[$key]['pirce'] = '￥'.$row['cose'];
				}
			}
			$list_tuijian = pdo_fetchall("SELECT * FROM " . tablename($this->table_tcourse) . " WHERE schoolid=:schoolid And is_tuijian =:is_tuijian  And end > :timeEnd ORDER BY  RAND() LIMIT 0,3 ", array(':schoolid'=>$school['id'],'is_tuijian'=>1,':timeEnd'=>TIMESTAMP));
			foreach($list_tuijian as $key => $row){
				$list_tuijian[$key]['icon'] = !empty($row['bigimg']) ? tomedia($row['bigimg']) : tomedia($school['logo']);
				$list_tuijian[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$row['schoolid'].'&m=fm_jiaoyu&do=kcinfo&id='.$row['id'].'&openid='.$_W['openid']);
				if($row['minge'] != 0){
					$list_tuijian[$key]['renshu'] = $row['minge'].'人班';
				}else{
					$list_tuijian[$key]['renshu'] = '无人数限制';
				}
				if($row['OldOrNew'] == 1){
					$list_tuijian[$key]['pirce'] = '￥'.$row['cose'].'/首购';
				}else{
					$list_tuijian[$key]['pirce'] = '￥'.$row['cose'];
				}
			}
			$list1 = pdo_fetchall("SELECT id,schoolid,thumb,title,description FROM " . tablename($this->table_news) . " where :schoolid = schoolid And :type = type ORDER BY displayorder DESC LIMIT 0,4", array(
				 ':schoolid' => $school['id'],
				 ':type' => 'article'
				 ));
			foreach($list1 as $key => $row){
				$list1[$key]['icon'] = !empty($row['thumb']) ? tomedia($row['thumb']) : tomedia($school['logo']);
				$list1[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$row['schoolid'].'&m=fm_jiaoyu&do=new&id='.$row['id'].'&openid='.$_W['openid']);
			}
			$list2 = pdo_fetchall("SELECT id,schoolid,thumb,title,description FROM " . tablename($this->table_news) . " where :schoolid = schoolid And :type = type ORDER BY displayorder DESC LIMIT 0,4", array(
				 ':schoolid' => $school['id'],
				 ':type' => 'news'
				 ));
			foreach($list2 as $key => $row){	
				$list2[$key]['icon'] = !empty($row['thumb']) ? tomedia($row['thumb']) : tomedia($school['logo']);
				$list2[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$row['schoolid'].'&m=fm_jiaoyu&do=new&id='.$row['id'].'&openid='.$_W['openid']);
			}
			$list3 = pdo_fetchall("SELECT id,schoolid,thumb,title,description FROM " . tablename($this->table_news) . " where :schoolid = schoolid And :type = type ORDER BY displayorder DESC LIMIT 0,4", array(
				 ':schoolid' => $school['id'],
				 ':type' => 'wenzhang'
				 ));
			foreach($list3 as $key => $row){	
				$list3[$key]['icon'] = !empty($row['thumb']) ? tomedia($row['thumb']) : tomedia($school['logo']);
				$list3[$key]['url'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$row['schoolid'].'&m=fm_jiaoyu&do=new&id='.$row['id'].'&openid='.$_W['openid']);
			}
			$data['morekc'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$school['id'].'&m=fm_jiaoyu&do=kc&openid='.$_W['openid']);		
			$data['xxgglist'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$school['id'].'&m=fm_jiaoyu&do=newslist&op=article&openid='.$_W['openid']);
			$data['xxxwlist'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$school['id'].'&m=fm_jiaoyu&do=newslist&op=news&openid='.$_W['openid']);
			$data['xxwzlist'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$item['fromweid'].'&c=entry&schoolid='.$school['id'].'&m=fm_jiaoyu&do=newslist&op=wenzhang&openid='.$_W['openid']);
			$data['kecheng'] = $list_jpk;
			$data['tuijian'] = $list_tuijian;
			$data['xygg'] = $list1;
			$data['xyxw'] = $list2;
			$data['xywz'] = $list3;
			$data['banners'] = $bannerdata;
			$data['centericon'] = $centericon;
		}
		return $this->result(0, '成功', $data);
	}
	
	public function uniarr($uniarr, $id) {
		foreach ($uniarr as $key => $value) {
			if ($id == $value) {
				return true;
			}
		}
		return false;
	}
	
	public function doPageGetloginpage(){
		global $_GPC, $_W;
		$item = pdo_fetch("SELECT * FROM " . tablename($this->table_wxappset) . " WHERE weid = '{$_W['uniacid']}'");	
		$data['headfont'] = $item['headfont'];  //headfontcolor
		$data['headcolor'] = $item['headcolor'];		//headcolor
		$data['title'] = $item['headtitle'];   //headtitle	
		$data['imgname'] = $item['imgname'];
		$data['imgfontcolor'] = $item['imgfontcolor'];
		$data['loginimg'] = tomedia($item['loginimg']);	
		$data['btnname'] = $item['btnname'];
		$data['btncolor'] = $item['btncolor'];
		$data['openid'] = $_W['openid'];
		$data['btnfontcolor'] = $item['btnfontcolor'];						
		$data['copyright'] = $item['copyright'];
		$data['copyrightfontcolor'] = $item['copyrightfontcolor'];
		if($item['show_list'] == 2){
			$data['url'] = '../list/list';
		}else{
			$data['url'] =  '../home/home?schoolid='.$item['schoolid'];
		}
		$fans = pdo_fetch("SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE openid = '{$_W['openid']}' And uniacid = '{$_W['uniacid']}' ");
		$member = pdo_fetch("SELECT nickname,avatar FROM " . tablename('mc_members') . " WHERE uid = '{$fans['uid']}' And uniacid = '{$_W['uniacid']}' ");
		if(!empty($fans['uid']) && !empty($member['nickname'])){
			$data['ismember'] = true;
		}else{
			$data['ismember'] = false;
		}
		if($item['bgtype'] == 1){
			$data['loginbgcolor'] = $item['loginbgcolor'];	
			$data['bgimg'] = '';	
		}		
		if($item['bgtype'] == 2){
			$data['loginbgcolor'] = '';	
			$data['bgimg'] = tomedia($item['loginbgimg']);	
		}
		return $this->result(0, '成功', $data);
	}
	public function doPageGetorderback(){
		global $_GPC, $_W;
		session_start();
		$dos = $_SESSION['dos'];
		$nowweid = $_SESSION['nowweid'];
		$schoolid = $_SESSION['schoolid'];
		$userid = $_SESSION['userid'];
		$op = $_SESSION['op'];
		if($userid > 0){
			$data['backurl'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$nowweid.'&c=entry&schoolid='.$schoolid.'&m=fm_jiaoyu&do='.$dos.'&userid='.$userid.'&op='.$op);
		}else{
			$data['backurl'] = urlencode('https://'.$_SERVER ['HTTP_HOST'].'/app/index.php?i='.$nowweid.'&c=entry&schoolid='.$schoolid.'&m=fm_jiaoyu&do='.$dos);
		}
		return $this->result(0, '成功111111', $data);
		$_SESSION['dos'] = '';
		$_SESSION['nowweid'] = '';
		$_SESSION['schoolid'] = '';
	}
	public function doPagePay() {
		global $_GPC;
		session_start();
		$_SESSION['dos'] = $_GPC['dos'];
		$_SESSION['nowweid'] = $_GPC['nowweid'];
		$_SESSION['userid'] = $_GPC['userid'];
		$_SESSION['op'] = $_GPC['op'];
		$_SESSION['schoolid'] = $_GPC['schoolid'];
		$wxpayid = $_GPC['orderid'];
		//构造订单信息，此处订单随机生成，业务中应该把此订单入库，支付成功后，根据此订单号更新用户是否支付成功
		$order = array(
			'tid' => $wxpayid,
			'user' => $_W['openid'],
			'fee' => floatval($_GPC['sum']),
			'title' => '校园缴费支付',
		);
		$pay_params = $this->pay($order);
		if (is_error($pay_params)) {
			return $this->result(1, '支付失败，请重试');
		}
		return $this->result(0, '', $pay_params);
	}

	public function payResult($pay_result) {
		global $_W;
		$orderid = $pay_result['tid'];	
		if ($pay_result['result'] == 'success') {
			$log = pdo_fetch("SELECT tag FROM " . tablename('core_paylog') . " where tid = :tid ", array(':tid' => $orderid));
			$tag = iunserializer($log['tag']);
			$uniontid = $tag['transaction_id'];
			pdo_update($this->table_wxpay, array('status' => 2), array('id' => $orderid));
			pdo_update($this->table_order, array('status' => 2, 'uniontid' => $uniontid, 'paytime' => time(), 'paytype' => 1, 'pay_type' => 'wxapp', 'payweid' => $log['uniacid']), array('id' => $orderid));
			$order = pdo_fetch("SELECT * FROM " . GetTableName('order') . " where id = :id ", array(':id' => $orderid));
			mload()->model('pay');
			//商城订单
			if(!empty($order['morderid']) && $order['type'] == 6 ){
				DealMallPayResult($order); 
			}
			//课程订单
			if($order['type'] == 1){
				DealKcPayResult($order);
				if(!empty($order['team_id'])){//处理订单归属队伍 (团购订单需在此处理)
					$team = pdo_fetch("SELECT * FROM " . GetTableName('sale_team') . " where :id = id ", array(':id' => $order['team_id']));
					if(!empty($team)){
						pdo_update(GetTableName('sale_team',false), array('is_sale' => 1), array('id' => $team['id']));
						pdo_update(GetTableName('sale_team',false), array('is_sale' => 1), array('kcid' => $team['kcid'],'userid' => $team['userid']));
						$teamisfull = CheckTemIsFull($team['id']);
						if($teamisfull){
							SetTeamStuStatus($team['masterid'],$order['sale_type']);
						}
					}
					$thisuser = pdo_fetch("SELECT openid FROM " . GetTableName('user') . " where :id = id ", array(':id' => $order['userid']));
					if($order['sale_type'] == 1){
						//$this->sendMobilePttz($order['team_id'],$thisuser['openid']);
					}
					if($order['sale_type'] == 2){
						//$this->sendMobileZltz($order['team_id'],$thisuser['openid']);
					}
				}
				if($order['new_stu'] == 1){//处理新增学生 直接购买的用户解锁
					pdo_update(GetTableName('user',false), array('status' => 0), array('id' => $order['userid']));
					pdo_update(GetTableName('students',false), array('status' => 0), array('id' => $order['sid']));
				}
				//$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 5){//考勤卡续费
				DealKqkfPayResult($order);
				//$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 8){//充值订单
				DealCzPayResult($order);
				//$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 9){//充电桩充值
				DealCdzCzPayResult($order);
				//$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 4){//报名付费
				$sign = pdo_fetch("SELECT name,nj_id FROM " . GetTableName('signup') . " where :id = id", array(':id' => $order['signid']));
				$njinfo = pdo_fetch("SELECT tid FROM " . GetTableName('classify') . " WHERE :sid = sid ", array(':sid' => $sign['nj_id']));
				$njzr = pdo_fetch("SELECT openid FROM " . GetTableName('teachers') . " WHERE :id = id ", array(':id' => $njinfo['tid']));
				if(!empty($njzr)){
					//$this->sendMobileBmshtz($order['signid'], $order['schoolid'], $order['weid'], $njzr['openid'], $sign['name']);
				}			
			}else{
				//$send = $this->sendMobileJfjgtz($order['id']);
			}
			mload()->model('print');
			order_print($order['id']);	
			if($params['chongzhi'] == 'chongzhi'){
				$data_yuelog = array(
					'schoolid' 	=> $order['schoolid'],
					'weid'	   	=> $order['weid'],
					'sid'	   	=> $order['sid'],
					'yue_type' 	=> 2,
					'cost_type' => 2,
					'cost'	   	=> $order['cose'],
					'costtime' 	=> $order['paytime'],
					'orderid'  	=> $order['id'],
					'on_offline' => 1,
					'createtime' => time()
				);
				pdo_insert(GetTableName('yuecostlog'),$data_yuelog);
				$params['from'] = 'return';
			}
		}
		return true;
	}

	public function doPageAddformId(){
		global $_GPC, $_W;
		if($_GPC['formId'] != 'the formId is a mock one'){
			$data = array(
				'weid' 	 	=> $_W['uniacid'],
				'openid' 	=> $_W['openid'],
				'formid' 	=> trim($_GPC['formId']),
				'fromto' 	=> trim($_GPC['content']),
				'creattime' => time()
			);
			pdo_insert($this->table_formid,$data);
			$formid_use = pdo_insertid();
			$data1 = array(
				'weid' 	 	=> $_W['uniacid'],
				'openid' 	=> $_W['openid'],
				'formid_use'=> $formid_use,
				'fromto' 	=> trim($_GPC['content']),
				'btnid' 	=> trim($_GPC['btnid']),
				'creattime' => time()
			);
			pdo_insert($this->table_hothit,$data1);
			$message = '成功';
			$data = 'success';			
		}else{
			$message = '失败';
			$data = 'define';			
		}
		return $this->result(0, $message, $data);
	}
	public $table_assteach = 'wx_school_assteach';
	public $table_classify = 'wx_school_classify';
	public $table_points = 'wx_school_points';
	public $table_pointsrecord = 'wx_school_pointsrecord';
	public $table_address = 'wx_school_address';
	public $table_mall = 'wx_school_mall';
	public $table_mallorder = 'wx_school_mallorder';
	public $table_score = 'wx_school_score';
	public $table_news = 'wx_school_news';
	public $table_index = 'wx_school_index';
	public $table_students = 'wx_school_students';
	public $table_tcourse = 'wx_school_tcourse';
	public $table_teachers = 'wx_school_teachers';
	public $table_area = 'wx_school_area';
    public $table_type = 'wx_school_type';
    public $table_kcbiao = 'wx_school_kcbiao';
	public $table_cook = 'wx_school_cookbook';
	public $table_reply = 'wx_school_reply';
	public $table_banners = 'wx_school_banners';
	public $table_bbsreply = 'wx_school_bbsreply';
	public $table_user = 'wx_school_user';
	public $table_set = 'wx_school_set';
	public $table_leave = 'wx_school_leave';
	public $table_notice = 'wx_school_notice';
	public $table_bjq = 'wx_school_bjq';
	public $table_media = 'wx_school_media';
	public $table_dianzan = 'wx_school_dianzan';
	public $table_order = 'wx_school_order';
    public $table_wxpay = 'wx_school_wxpay';
    public $table_group = 'wx_school_fans_group';
	public $table_qrinfo = 'wx_school_qrcode_info';
	public $table_qrset = 'wx_school_qrcode_set';
	public $table_qrstat = 'wx_school_qrcode_statinfo';
	public $table_cost = 'wx_school_cost';
	public $table_object = 'wx_school_object';
	public $table_signup = 'wx_school_signup';
	public $table_record = 'wx_school_record';
	public $table_checkmac = 'wx_school_checkmac';
	public $table_checklog = 'wx_school_checklog';
	public $table_idcard = 'wx_school_idcard';
	public $table_icon = 'wx_school_icon';
	public $table_timetable = 'wx_school_timetable';
	public $table_zjh = 'wx_school_zjh';
	public $table_zjhset = 'wx_school_zjhset';
	public $table_zjhdetail = 'wx_school_zjhdetail';
	public $table_scset = 'wx_school_shouceset';
	public $table_scicon = 'wx_school_shouceseticon';
	public $table_sc = 'wx_school_shouce';
	public $table_scpy = 'wx_school_shoucepyk';
	public $table_scforxs = 'wx_school_scforxs';
	public $table_allcamera = 'wx_school_allcamera';
	public $table_camerapl = 'wx_school_camerapl';
	public $table_class = 'wx_school_user_class';
	public $table_online = 'wx_school_online';
	public $table_questions = 'wx_school_questions';
	public $table_answers = 'wx_school_answers';
	public $table_ans_remark = 'wx_school_ans_remark';	
	public $table_gongkaike = 'wx_school_gongkaike';
	public $table_gkkpjk = 'wx_school_gkkpjk';
	public $table_gkkpj = 'wx_school_gkkpj';
	public $table_gkkpjbz = 'wx_school_gkkpjbz';
	public $table_groupactivity = 'wx_school_groupactivity';
	public $table_groupsign = 'wx_school_groupsign';
	public $table_todo = 'wx_school_todo';
	public $table_camerask = 'wx_school_camerask';
	public $table_courseorder = 'wx_school_courseorder';
	public $table_cyybeizhu_teacher = 'wx_school_cyybeizhu_teacher';
	public $table_coursebuy = 'wx_school_coursebuy';
	public $table_kcsign = 'wx_school_kcsign';
	public $table_tempstudent = 'wx_school_tempstudent';
	public $table_fzqx = 'wx_school_fzqx';
	public $table_kcpingjia = 'wx_school_kcpingjia';
	public $table_chongzhi = 'wx_school_chongzhi';
		//小程序自身
	public $table_wxappset = 'wx_school_wxappset';	
	public $table_formid = 'wx_school_formid';
	public $table_hothit = 'wx_school_hothit';	
}