<?php
global $_W,$_GPC;
$mapkey = $this->module['config']['mapkey'];
if(empty($_W['fans']['from_user'])){
	if($this->module['config']['wechatview'] == 1){
		$message = '请在微信浏览器内咨询！';
		include $this->template('error');
		exit;
	}
	$ssopenid = trim($_GPC['ssopenid']);
	if($ssopenid != ""){
		$openid = $ssopenid;
	}else{
		$ipurl = "https://apis.map.qq.com/ws/location/v1/ip?ip=".$_W['clientip']."&key=".$mapkey;
		$ipres = file_get_contents($ipurl);
		$ipres = json_decode($ipres,true);
		if(empty($_COOKIE['kflatitude'])){
			$latitude = $ipres['result']['location']['lat'].random(4,1);
			$longitude = $ipres['result']['location']['lng'].random(4,1);
			setcookie("kflatitude",$latitude,time()+3600*24*7);
			setcookie("kflongitude",$longitude,time()+3600*24*7);
		}else{
			$latitude = $_COOKIE['kflatitude'];
			$longitude = $_COOKIE['kflongitude'];
		}
		$jiamistr = $this->get_lang().$this->browse_info().$this->get_os().$latitude.$longitude;
		$openid = md5($jiamistr);
	}
}else{
	$openid = $_W['fans']['from_user'];
}
$toopenid = trim($_GPC['toopenid']);
$cservice = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$toopenid}'");
if(empty($cservice)){
	$autoin = intval($_GPC['autoin']);
	if($autoin == 1 && strlen($toopenid) == 28){
		$account_api = WeAccount::create();
		$c_info = $account_api->fansQueryInfo($toopenid);
		if(!empty($c_info['nickname'])){
			$data_info['weid'] = $_W['uniacid'];
			$data_info['name'] = $c_info['nickname'];
			$data_info['thumb'] = $c_info['headimgurl'];
			$data_info['ctype'] = 1;
			$data_info['content'] = $c_info['openid'];
			$data_info['endhour'] = 24;
			pdo_insert(BEST_CSERVICE,$data_info);
		}
		$cservice = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$toopenid}'");
	}
}
if(empty($cservice)){
	$message = '获取客服信息失败！';
	include $this->template('error');
	exit;
}
$ishei = pdo_fetch("SELECT id FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$openid}' AND ishei = 1");
if(!empty($ishei)){
	$message = '您暂时不能咨询！';
	include $this->template('error');
	exit;
}

if($openid == $toopenid){
	$message = '不能和自己聊天！';
	include $this->template('error');
	exit;
}
if($this->module['config']['bdmodel'] == 1){
	$hasbd = pdo_fetch("SELECT kefuopenid,bdopenid FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$openid}' AND bdopenid != ''");
	if(!empty($hasbd)){
		if($hasbd['bdopenid'] != $toopenid && $cservice['bdchat'] == 0){
			$cservicebd = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$hasbd['bdopenid']}'");
			if(empty($cservicebd)){
				$message = '获取客服信息失败！';
				include $this->template('error');
				exit;
			}
			include $this->template('zhuanshu');
			exit;
		}
	}
}

$fromid = intval($_GPC['fromid']);
$cityid = intval($_GPC['cityid']);

$fields = pdo_fetchall("select * from ".tablename(BEST_LYFIELD)." where weid = {$_W['uniacid']} AND openid='{$cservice['content']}' order by displayorder ASC");
foreach($fields as $k=>$v){
	if($v['neizhi'] != "" && $v['isimg'] == 0){
		$fields[$k]['neizhis'] = explode("|",$v['neizhi']);
		$fields[$k]['isselect'] = 1;
	}else{
		$fields[$k]['isselect'] = 0;
	}
	$fields[$k]['key'] = $k;
}
	
$cjwtlist = pdo_fetchall("SELECT a.* FROM ".tablename(BEST_WENZHANG)." as a,".tablename(BEST_KEFUANDCJWT)." as b WHERE a.weid = {$_W['uniacid']} AND b.kefuid = {$cservice['id']} AND a.id = b.wtid ORDER BY a.paixu DESC");
$hasfanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$openid}' AND kefuopenid = '{$toopenid}'");
if(empty($hasfanskefu)){
	$datafanskefu['weid'] = $_W['uniacid'];
	$datafanskefu['fansopenid'] = $openid;
	$datafanskefu['kefuopenid'] = $cservice['content'];
	if(empty($_W['fans']['from_user'])){
		$datafanskefu['fansavatar'] = tomedia($this->module['config']['defaultavatar']);
		$datafanskefu['fansnickname'] = '游客';
	}else{
		$account_api = WeAccount::create();
		$info = $account_api->fansQueryInfo($openid);
		if($info['subscribe'] == 1){
			$datafanskefu['fansavatar'] = $info['headimgurl'];
			$datafanskefu['fansnickname'] = str_replace('\'', '\'\'',$info['nickname']);
		}else{
			$datafanskefu['fansavatar'] = tomedia($this->module['config']['defaultavatar']);
			$datafanskefu['fansnickname'] = '匿名用户';
		}		
	}
	$datafanskefu['kefuavatar'] = tomedia($cservice['thumb']);
	$datafanskefu['kefunickname'] = $cservice['name'];
	$ipurl = "https://apis.map.qq.com/ws/location/v1/ip?ip=".$_W['clientip']."&key=".$mapkey;
	$ipres = file_get_contents($ipurl);
	$ipres = json_decode($ipres,true);
	$fangkearr = array(
		'lang'=>$this->get_lang(),
		'browse'=>$this->browse_info(),
		'os'=>$this->get_os(),
		'ip'=>$_W['clientip'],
		'laiyuan'=>$_SERVER['HTTP_REFERER'],
		'latitude'=>$ipres['result']['location']['lat'],
		'longitude'=>$ipres['result']['location']['lng'],
		'nation'=>$ipres['result']['ad_info']['nation'],
		'province'=>$ipres['result']['ad_info']['province'],
		'city'=>$ipres['result']['ad_info']['city'],
		'district'=>$ipres['result']['ad_info']['district'],
		'gzhname'=>$_W['account']['name'],
	);
	$datafanskefu['fangke'] = serialize($fangkearr);
	if($this->module['config']['bdmodel'] == 1 && $cservice['beibang'] == 1){
		$hasbd = pdo_fetch("SELECT kefuopenid FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$openid}' AND bdopenid != ''");
		if(empty($hasbd)){
			$datafanskefu['bdopenid'] = $cservice['content'];
		}
	}
	$datafanskefu['intime'] = TIMESTAMP;
	pdo_insert(BEST_FANSKEFU,$datafanskefu);
	$hasfanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$openid}' AND kefuopenid = '{$toopenid}'");
}else{
	$fangkearr = unserialize($hasfanskefu['fangke']);
	if($fangkearr['latitude'] == "" || $fangkearr['ip'] != $_W['clientip']){
		$ipurl = "https://apis.map.qq.com/ws/location/v1/ip?ip=".$_W['clientip']."&key=".$mapkey;
		$ipres = file_get_contents($ipurl);
		$ipres = json_decode($ipres,true);
		$fangkearr = array(
			'lang'=>$this->get_lang(),
			'browse'=>$this->browse_info(),
			'os'=>$this->get_os(),
			'ip'=>$_W['clientip'],
			'laiyuan'=>$_SERVER['HTTP_REFERER'],
			'latitude'=>$ipres['result']['location']['lat'],
			'longitude'=>$ipres['result']['location']['lng'],
			'nation'=>$ipres['result']['ad_info']['nation'],
			'province'=>$ipres['result']['ad_info']['province'],
			'city'=>$ipres['result']['ad_info']['city'],
			'district'=>$ipres['result']['ad_info']['district'],
			'gzhname'=>$_W['account']['name'],
		);
	}else{
		$fangkearr['laiyuan'] = $_SERVER['HTTP_REFERER'];
		$fangkearr['gzhname'] = $_W['account']['name'];
	}
	$datafanskefuup['fangke'] = serialize($fangkearr);
	if($this->module['config']['bdmodel'] == 1 && $cservice['beibang'] == 1){
		$hasbd = pdo_fetch("SELECT kefuopenid FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$openid}' AND bdopenid != ''");
		if(empty($hasbd)){
			$datafanskefuup['bdopenid'] = $cservice['content'];
		}
	}
}

if($cservice['autoreply']){			
	$regex = '@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))@';
	preg_match_all($regex,$cservice['autoreply'],$array2);  
	if(!empty($array2[0])){
		foreach($array2[0] as $kk=>$vv){
			if(!empty($vv)){
				$vvurl = strstr($vv,"http") ? $vv : "http://".$vv;
				$cservice['autoreply'] = str_replace($vv,"<a href='".$vvurl."'>".$vv."</a>",$cservice['autoreply']);
			}
		}
	}
}
$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_CHAT)." WHERE fkid = {$hasfanskefu['id']} AND weid = {$_W['uniacid']} AND fansdel = 0");		
$page = intval($_GPC["page"]);
$pindex = max(1, $page);
$psize = 10;
$allpage = ceil($total/$psize)+1;
$nowjl = $total-$pindex*$psize;
if($nowjl < 0){
	$nowjl = 0;
}
$chatcon = pdo_fetchall("SELECT * FROM ".tablename(BEST_CHAT)." WHERE fkid = {$hasfanskefu['id']} AND weid = {$_W['uniacid']} AND fansdel = 0 ORDER BY time ASC LIMIT ".$nowjl.",".$psize);
$chatcontime = 0;
foreach($chatcon as $k=>$v){
	if($v['openid'] != $openid){
		$chatcon[$k]['class'] = 'left';
		$chatcon[$k]['avatar'] = $hasfanskefu['kefuavatar'];
	}else{
		$chatcon[$k]['class'] = 'right';
		$chatcon[$k]['avatar'] = $hasfanskefu['fansavatar'];
	}
	
	
	if(($v['time'] - $chatcontime) > 7200){
		$chatcon[$k]['time'] = $v['time'];
	}else{
		$chatcon[$k]['time'] = '';
	}
	$chatcontime = $v['time'];
	//$chatcon[$k]['content'] = preg_replace_callback('/[\xf0-\xf7].{3}/', function($r) { return '';}, $v['content']);
	$chatcon[$k]['content'] = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '[无法识别字符]', $v['content']);
	$chatcon[$k]['content'] = $this->guolv($chatcon[$k]['content']);
	$regex = '@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))@';
	preg_match_all($regex,$chatcon[$k]['content'],$array2);  
	if(!empty($array2[0]) && ($v['type'] == 1 || $v['type'] == 2)){
		if($v['isjqr'] == 1 || $v['istuwen'] == 1){
			$chatcon[$k]['content'] = htmlspecialchars_decode($v['content']);
		}else{
			foreach($array2[0] as $kk=>$vv){
				if(!empty($vv)){
					$vvurl = strstr($vv,"http") ? $vv : "http://".$vv;
					$chatcon[$k]['content'] = str_replace($vv,"<a href='".$vvurl."'>".$vv."</a>",$chatcon[$k]['content']);
				}
			}
		}
	}
	
	if($v['type'] == 7){
		$chatcon[$k]['address'] = explode(",",$chatcon[$k]['content']);
	}
}
$fansauto = empty($cservice['fansauto']) ? '' : explode("|",$cservice['fansauto']);
		
$goodsid = intval($_GPC['goodsid']);
$qudao = trim($_GPC['qudao']);
if(empty($goodsid) || empty($qudao)){
	$goodsmsg = unserialize($hasfanskefu['goodsmsg']);
	$goodsid = intval($goodsmsg['gid']);
	$qudao = trim($goodsmsg['qudao']);
}
$isrr = strstr($_SERVER['HTTP_REFERER'],"r=goods.detail");
if($isrr){
	$goodsid = $this->getrrgid($_SERVER['HTTP_REFERER']);
	$qudao = 'renren';
}
$isrr_r = strstr($_SERVER['HTTP_REFERER'],"r=groups.goods");
if($isrr_r){
	$goodsid = $this->getrrgid($_SERVER['HTTP_REFERER']);
	$qudao = 'renren';
}
$isrr2 = strstr($_SERVER['HTTP_REFERER'],"addons/yun_shop");
if($isrr2){
    $yz_member = pdo_fetch("SELECT member_id FROM ".tablename('yz_member')." WHERE yz_openid = '{$_W['fans']['from_user']}' AND uniacid = {$_W['uniacid']}");
    //$yzuid = $_SESSION['Yz-Uid'];
    //yun_shop\app\frontend\modules\member\controllers\MemberHistoryController.php
	//$historyModel->updated_at = time();
    $member_history = pdo_fetch("SELECT id,goods_id FROM ".tablename('yz_member_history')." WHERE member_id = {$yz_member['member_id']} AND uniacid = {$_W['uniacid']} ORDER BY updated_at DESC");
	$goodsid = intval($member_history['goods_id']);
	$qudao = 'yz';
}
if($qudao == 'renren' && $goodsid > 0 && pdo_tableexists('ewei_shop_goods')){
	$goodsres = pdo_fetch("SELECT title,thumb,id,minprice,maxprice,marketprice FROM ".tablename('ewei_shop_goods')." WHERE id = {$goodsid} AND uniacid = {$_W['uniacid']}");
	$goods['title'] = $goodsres['title'];
	$goods['thumb'] = tomedia($goodsres['thumb']);
	$goods['id'] = $goodsres['id'];
	if($goodsres['marketprice'] >= 0){
		$goods['price'] = $goodsres['marketprice'];
	}else{
		$goods['price'] = $goodsres['minprice']." ~ ".$goodsres['maxprice'];
	}
	$goods['url'] = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&m=ewei_shopv2&do=mobile&r=goods.detail&id='.$goodsid;
	$goodsmsg['gid'] = $goodsid;
	$goodsmsg['qudao'] = $qudao;
	$datafanskefuup['goodsmsg'] = serialize($goodsmsg);
}
if($qudao == 'yz' && $goodsid > 0 && pdo_tableexists('yz_goods')){
	$goodsres = pdo_fetch("SELECT title,thumb,id,price,type FROM ".tablename('yz_goods')." WHERE id = {$goodsid} AND uniacid = {$_W['uniacid']}");
	$goods['title'] = $goodsres['title'];
	$goods['thumb'] = tomedia($goodsres['thumb']);
	$goods['id'] = $goodsres['id'];
	$goods['price'] = $goodsres['price'];
	$goods['url'] = $_W['siteroot'].'addons/yun_shop/?menu=#/goods/'.$goodsid.'?i='.$_W['uniacid'].'&type='.$goodsres['type'];
	$goodsmsg['gid'] = $goodsid;
	$goodsmsg['qudao'] = $qudao;
	$datafanskefuup['goodsmsg'] = serialize($goodsmsg);
}
if($qudao == 'juhe' && $goodsid > 0){
	$goodsres = pdo_fetch("SELECT normalprice,thumb_url,title FROM ".tablename('cyyourbest_mgoods')." WHERE id = {$goodsid} AND weid = {$_W['uniacid']}");
	$goods['title'] = $goodsres['title'];
	$thumbs = unserialize($goodsres['thumb_url']);
	$goods['thumb'] = tomedia($thumbs[0]);
	$goods['id'] = $goodsres['id'];
	$goods['price'] = $goodsres['normalprice'];
	$goods['url'] = $_W['siteroot'].'addons/cy163_yourbest/app/#/goods?i='.$_W['uniacid'].'&id='.$goodsid;
	$goodsmsg['gid'] = $goodsid;
	$goodsmsg['qudao'] = $qudao;
	$datafanskefuup['goodsmsg'] = serialize($goodsmsg);
}	
if($qudao == 'szds' && $goodsid > 0){
	include_once ROOT_PATH.'simple_html_dom.php';
    $szdsurl = "https://tingtingke.szds.com/mobile/product/show.php?itemid=".$goodsid;
	$szdshtml = file_get_html($szdsurl);
	$goods['title'] = $szdshtml->find('.title',0)->find('h3',0)->plaintext;
	$goods['price'] = $szdshtml->find('.pintuan_p',0)->find('b',0)->plaintext;
	$goods['price'] = str_replace("￥","",$goods['price']);
	$goods['thumb'] = $szdshtml->find('.mui-slider-item',0)->find('img',0)->src;
	$goods['id'] = $goodsid;
	$goods['url'] = $szdsurl;
	$goodsmsg['gid'] = $goodsid;
	$goodsmsg['qudao'] = $qudao;
	$datafanskefuup['goodsmsg'] = serialize($goodsmsg);
}
$homepage = trim($_GPC['homepage']);
if($qudao == 'szdsmer' && $homepage != ""){
	include_once ROOT_PATH.'simple_html_dom.php';
    $szdsurl = "https://tingtingke.szds.com/index.php?homepage=".$homepage;
	$szdshtml = file_get_html($szdsurl);
	$goods['title'] = $szdshtml->find('.sj',0)->find('.title',0)->plaintext;
	$goods['price'] = "";
	$goods['thumb'] = $szdshtml->find('.mui-slider-item',0)->find('img',0)->src;
	$goods['id'] = $homepage;
	$goods['url'] = $szdsurl;
	$goodsmsg['gid'] = $homepage;
	$goodsmsg['qudao'] = $qudao;
	$datafanskefuup['goodsmsg'] = serialize($goodsmsg);
}
$kefupingfen = pdo_fetch("SELECT * FROM ".tablename(BEST_PINGJIA)." WHERE weid = {$_W['uniacid']} AND fensiopenid = '{$openid}' AND kefuopenid = '{$toopenid}'");


$datafanskefuup['kefunotread'] = 0;
pdo_update(BEST_FANSKEFU,$datafanskefuup,array('id'=>$hasfanskefu['id']));

/*$zd = intval($_GPC['zd']);
if($zd == 1){
	$datazd['gzhqzval2'] = $cservice['gzhqzval2']+1;
	pdo_update(BEST_CSERVICE,$datazd,array('id'=>$cservice['id']));
}*/
//$title = $hasfanskefu['nowjd'] == 0 ? '等待客服接入' : '和'.$cservice['name'].'的对话';
$title = '和'.$cservice['name'].'的对话';
$isonline = $this->kfisonline($cservice);
//$lyon = !$isonline && $cservice['lyon'] == 1 ? true : false;
$lyon = $_GPC['lyon'] == 1 ? true : false;
include $this->template("newchat");
?>