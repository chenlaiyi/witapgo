<?php
global $_W,$_GPC;
include_once ROOT_PATH.'qqface.php';		
$openid = $_W['fans']['from_user'];
$ssopenid = $_GPC['ssopenid'];
if($ssopenid != '' && empty($openid)){
	$openid = $ssopenid;
}	
if(empty($openid)){
	$message = '请在微信浏览器中打开！';
	include $this->template('error');
	exit;
}
$cservice = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$openid}'");
if(empty($cservice)){
	$message = '你不是客服身份，请联系管理员查看具体信息！';
	include $this->template('error');
	exit;
}
$toopenid = trim($_GPC['toopenid']);
$hasfanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$toopenid}' AND kefuopenid = '{$openid}'");
if(empty($hasfanskefu)){
	$datafanskefu['weid'] = $_W['uniacid'];
	$datafanskefu['fansopenid'] = $toopenid;
	$datafanskefu['kefuopenid'] = $openid;
	$datafanskefu['kefuavatar'] = tomedia($cservice['thumb']);
	$datafanskefu['kefunickname'] = $cservice['name'];
	$account_api = WeAccount::create();
	$fansinfos = $account_api->fansQueryInfo($toopenid);
	if(empty($fansinfos)){
		$datafanskefu['fansavatar'] = tomedia($this->module['config']['defaultavatar']);
		$datafanskefu['fansnickname'] = '匿名用户';
	}else{
		$datafanskefu['fansavatar'] = $fansinfos['headimgurl'];
		$datafanskefu['fansnickname'] = $fansinfos['nickname'];
	}
	$datafanskefu['intime'] = TIMESTAMP;
	pdo_insert(BEST_FANSKEFU,$datafanskefu);
	$hasfanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$toopenid}' AND kefuopenid = '{$openid}'");
}

//更新头像昵称
if($hasfanskefu['fansnickname'] == '匿名用户' || $hasfanskefu['fansnickname'] == ''){
	$oplen = strlen($hasfanskefu['fansopenid']);
	if($oplen == 28){
		$account_api = WeAccount::create();
		$info = $account_api->fansQueryInfo($hasfanskefu['fansopenid']);
		if($info['subscribe'] == 1){
			$dataupna['fansavatar'] = $info['headimgurl'];
			$dataupna['fansnickname'] = $info['nickname'];
			//更新客服粉丝对应表
			pdo_update(BEST_FANSKEFU,$dataupna,array('id'=>$hasfanskefu['id']));
		}
		$hasfanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$toopenid}' AND kefuopenid = '{$openid}'");
	}
}

if($this->module['config']['zjtype'] == 0){
	$othercservice = pdo_fetchall("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content != '{$openid}' ORDER BY displayorder ASC");
	foreach($othercservice as $k=>$v){
		$kefuandgroup_zj = pdo_fetch("SELECT id FROM ".tablename(BEST_KEFUANDGROUP)." WHERE kefuid = {$v['id']}");
		if(!empty($kefuandgroup_zj)){
			unset($othercservice[$k]);
		}
	}
	$grouplist_zj = pdo_fetchall("SELECT * FROM ".tablename(BEST_CSERVICEGROUP)." WHERE weid = {$_W['uniacid']} AND fid = 0 ORDER BY displayorder ASC");
}else{
	$kefuid = $cservice['id'];
	$group_zj = pdo_fetchall("SELECT groupid FROM ".tablename(BEST_KEFUANDGROUP)." WHERE weid = {$_W['uniacid']} AND kefuid = {$kefuid}");
	$group_zj_arr = [0];
	foreach($group_zj as $k=>$v){
		$group_zj_arr[] = $v['groupid'];
	}
	$group_zj2 = pdo_fetchall("SELECT kefuid FROM ".tablename(BEST_KEFUANDGROUP)." WHERE weid = {$_W['uniacid']} AND groupid in (".implode(",",$group_zj_arr).")");
	$kefuid_arr = [0];
	foreach($group_zj2 as $k=>$v){
		$kefuid_arr[] = $v['kefuid'];
	}
	$othercservice = pdo_fetchall("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND id in (".implode(",",$kefuid_arr).") AND ctype = 1 AND content != '{$openid}' ORDER BY displayorder ASC");
	
	$grouplist_zj = [];
}
$biaoqian = pdo_fetch("SELECT * FROM ".tablename(BEST_BIAOQIAN)." WHERE kefuopenid = '{$openid}' AND fensiopenid = '{$toopenid}'");

$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_CHAT)." WHERE fkid = {$hasfanskefu['id']} AND kefudel = 0");		
$page = intval($_GPC["page"]);
$pindex = max(1, $page);
$psize = 10;
$allpage = ceil($total/$psize)+1;
$nowjl = $total-$pindex*$psize;
if($nowjl < 0){
	$nowjl = 0;
}
$chatcon = pdo_fetchall("SELECT * FROM ".tablename(BEST_CHAT)." WHERE fkid = {$hasfanskefu['id']} AND kefudel = 0 ORDER BY time ASC LIMIT ".$nowjl.",".$psize);
$chatcontime = 0;
foreach($chatcon as $k=>$v){
	if($v['openid'] != $openid){
		$chatcon[$k]['class'] = 'left';
		$chatcon[$k]['avatar'] = $hasfanskefu['fansavatar'];
	}else{
		$chatcon[$k]['class'] = 'right';
		$chatcon[$k]['avatar'] = $hasfanskefu['kefuavatar'];
	}
	
	if(($v['time'] - $chatcontime) > 7200){
		$chatcon[$k]['time'] = $v['time'];
	}else{
		$chatcon[$k]['time'] = '';
	}
	$chatcontime = $v['time'];
	//$chatcon[$k]['content'] = preg_replace_callback('/[\xf0-\xf7].{3}/', function($r) { return '';}, $v['content']);
	$chatcon[$k]['content'] = $this->guolv($v['content']);
	$chatcon[$k]['content'] = qqface_convert_html($chatcon[$k]['content']);
	
	$chatcon[$k]['content'] = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '[无法识别字符]', $chatcon[$k]['content']);
	$regex = '@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))@';
	preg_match_all($regex,$chatcon[$k]['content'],$array2);  
	if(!empty($array2[0]) && ($v['type'] == 1 || $v['type'] == 2)){
		if($v['isjqr'] == 1 || $v['istuwen'] == 1){
			$chatcon[$k]['content'] = htmlspecialchars_decode($v['content']);
		}else{
			foreach($array2[0] as $kk=>$vv){
				if(!empty($vv) && strpos($vv,'https://res.wx.qq.com') === false){
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

$fromid = intval($_GPC['fromid']);
$cityid = intval($_GPC['cityid']);

$kefuauto = pdo_fetchall("SELECT * FROM ".tablename(BEST_KUAIJIE)." WHERE kfid = {$cservice['id']} ORDER BY displayorder DESC");

$goodsmsg = unserialize($hasfanskefu['goodsmsg']);
$goodsid = intval($goodsmsg['gid']);
$qudao = trim($goodsmsg['qudao']);
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
}
if($qudao == 'yz' && $goodsid > 0 && pdo_tableexists('yz_goods')){
	$goodsres = pdo_fetch("SELECT title,thumb,id,price,type FROM ".tablename('yz_goods')." WHERE id = {$goodsid} AND uniacid = {$_W['uniacid']}");
	$goods['title'] = $goodsres['title'];
	$goods['thumb'] = tomedia($goodsres['thumb']);
	$goods['id'] = $goodsres['id'];
	$goods['price'] = $goodsres['price'];
	$goods['url'] = $_W['siteroot'].'addons/yun_shop/?menu=#/goods/'.$goodsid.'?i='.$_W['uniacid'].'&type='.$goodsres['type'];
}
if($qudao == 'juhe' && $goodsid > 0){
	$goodsres = pdo_fetch("SELECT normalprice,thumb_url,title FROM ".tablename('cyyourbest_mgoods')." WHERE id = {$goodsid} AND weid = {$_W['uniacid']}");
	$goods['title'] = $goodsres['title'];
	$thumbs = unserialize($goodsres['thumb_url']);
	$goods['thumb'] = tomedia($thumbs[0]);
	$goods['id'] = $goodsres['id'];
	$goods['price'] = $goodsres['normalprice'];
	$goods['url'] = $_W['siteroot'].'addons/cy163_yourbest/app/#/goods?i='.$_W['uniacid'].'&id='.$goodsid;
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
}
$dataupfk['notread'] = 0;
pdo_update(BEST_FANSKEFU,$dataupfk,array('id'=>$hasfanskefu['id']));

$fangkemsg = unserialize($hasfanskefu['fangke']);
$nowjdnum = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$cservice['content']}' AND nowjd = 1");
include $this->template("newservicechat");
?>