<?php
global $_W, $_GPC;
$openid = $_SESSION['openid'];
if(empty($openid)){
	if(!empty($_COOKIE["openid"])){
		$_SESSION['openid'] = $_COOKIE["openid"];
		$_SESSION['cservicename'] = $_COOKIE["cservicename"];
		$_SESSION['cservicavatar'] = $_COOKIE["cservicavatar"];
		$openid = $_SESSION['openid'];
	}else{
		$url = $this->createMobileUrl('kefulogin');
		header("Location:".$url);
	}
}
//var_dump($_W['setting']['remote']['qiniu']);
$op = trim($_GPC['op']);
if($op == 'addchat'){
	$chatcontent = trim($_GPC['content']);
	if(empty($chatcontent)){
		$resArr['error'] = 1;
		$resArr['msg'] = '请输入对话内容！';
		echo json_encode($resArr);
		exit;
	}
	$data['openid'] = $openid;
	//新处理
	$_W['uniacid'] = intval($_GPC['weid']);
	$touser = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND content = '{$data['openid']}'");
	$data['nickname'] = $_SESSION['cservicename'];
	$data['avatar'] = $_SESSION['cservicavatar'];
	$data['toopenid'] = trim($_GPC['toopenid']);
	$data['time'] = TIMESTAMP;
	$data['content'] = $chatcontent;
	$data['weid'] = $_W['uniacid'];
	$data['fkid'] = intval($_GPC['fkid']);
	$data['istuwen'] = intval($_GPC['istuwen']);
	$type = intval($_GPC['type']);
	$data['type'] = $type;
	if($type == 3 || $type == 4){
		$tplcon = $data['nickname'].'给您发送了图片';
	}else{
		if($data['istuwen'] == 0){
			if(strpos($data['content'],'span class=')){
				$tplcon = $data['nickname'].'给您发送了表情';
			}else{
				$tplcon = $data['content'];
			}
		}else{
			$tplcon = $data['nickname'].'给您发送了图文';
		}
	}
	$tplcon = $this->guolv($tplcon);
	$tplcon = preg_replace('/<br\\s*?\/??>/i','',$tplcon);
	pdo_insert(BEST_CHAT,$data);
	$chatid = pdo_insertid();
	
	$fanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE id = {$data['fkid']}");
	if($fanskefu['wherefrom'] == 1){
		if($type == 3 || $type == 4){
			//图片
			$account_api = WeAccount::create();
			$access_token = $account_api->getAccessToken();
			$fileName = time().'.jpg';       
			$source = file_get_contents($chatcontent);
			file_put_contents('../addons/cy163_customerservice/'.$fileName,$source);   
			//$josnimg = array('media' => '@../addons/cy163_customerservice/'.$fileName);
			$imgurl = "http://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=image";
			$imgres = $this->curl_post2($imgurl,'../addons/cy163_customerservice/'.$fileName);	
			unlink('../addons/cy163_customerservice/'.$fileName);			
			$custom = array(
				'touser'=> $fanskefu['fansopenid'],
				'msgtype'=> 'image',
				'image'=> array(
					'media_id'=> $imgres['media_id'],
				)
			);
			$account_api->sendCustomNotice($custom);
		}elseif($type == 5 || $type == 6){
			//语音
		}else{
			//文字
			$custom = array(
				'msgtype' => 'text',
				'text' => array('content' => urlencode($data['content'])),
				'touser' => $fanskefu['fansopenid'],
			);
			$account_api = WeAccount::create();
			$account_api->sendCustomNotice($custom);
		}
	}else{
		$guotime = TIMESTAMP-$fanskefu['kefulasttime'];		
		$kefutplminute = $this->getmoduleconfig('kefutplminute');
		if($guotime > $kefutplminute){
			$tplurl = $this->gettpldomain().'app/'.str_replace("./","",$this->createMobileUrl("chat",array('toopenid'=>$data['openid'])));
			$tplurl = str_replace('cy163_customerservice_plugin_p','cy163_customerservice',$tplurl);		
			$senddata = array(
				'openid'=>$data['toopenid'],
				'url'=>$tplurl,
				'first'=>$tplcon,
				'keyword1'=>$data['nickname'],
			);
			$this->sendtplmsg($senddata);
		}
	}
	
	$dataupfk['kefulastcon'] = $chatcontent;
	$dataupfk['kefulasttime'] = TIMESTAMP;
	$dataupfk['kefumsgtype'] = $type;
	$dataupfk['kefunotread'] = $fanskefu['kefunotread']+1;
	$dataupfk['guanlinum'] = $fanskefu['guanlinum']+1;
	if($fanskefu['nowjd'] > 0){
		$dataupfk['nowjd'] = 2;

		$dataupkefu['nowfkid'] = $fanskefu['id'];
		pdo_update(BEST_CSERVICE,$dataupkefu,array('id'=>$cservice['id']));
	}
	pdo_update(BEST_FANSKEFU,$dataupfk,array('id'=>$data['fkid']));
	$resArr['error'] = 0;
	$resArr['msg'] = '';
	$resArr['content'] = $this->doReplacecon($data['content'],$data['type'],$data['istuwen']);
	$resArr['datetime'] = date("Y-m-d H:i:s",$data['time']);
	$resArr['chatid'] = $chatid;
	echo json_encode($resArr);
	exit;
}elseif($op == 'tuichu'){
	$cservice = pdo_fetch("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE content = '{$openid}' AND ctype = 1");
	if(isset($cservice)){
		$data['isrealzx'] = 0;
		$data['ispczx'] = 0;
		pdo_update(BEST_CSERVICE,$data,array('id'=>$cservice['id']));
	}
	session_unset($_SESSION['openid']);
	session_unset($_SESSION['cservicename']);
	session_unset($_SESSION['cservicavatar']);
	setcookie("openid", "", time()-3600);
	setcookie("cservicename", "", time()-3600);
	setcookie("cservicavatar", "", time()-3600);
	$url = $this->createMobileUrl('kefulogin');
	header("Location:".$url);
}elseif($op == 'gettype'){
	$toopenid = trim($_GPC['toopenid']);
	$isjd = intval($_GPC['isjd']);
	$fanskefu = pdo_fetch("SELECT nowjd FROM ".tablename(BEST_FANSKEFU)." WHERE kefuopenid = '{$openid}' AND fansopenid = '{$toopenid}'");
	if($isjd == $fanskefu['nowjd']){
		$resArr['error'] = 0;
	}else{
		$resArr['error'] = 1;
	}
	$resArr['isjd'] = $fanskefu['nowjd'];
	echo json_encode($resArr,true);
	exit;
}elseif($op == 'tongbu'){
	$toopenid = trim($_GPC['toopenid']);
	$fklast = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$toopenid}'");
	$account_api = WeAccount::create();
	$access_token = $account_api->getAccessToken();
	$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$toopenid."&lang=zh_CN";		
	$response = ihttp_get($url);
	$response = json_decode($response['content'],true);
	if($response['subscribe'] == 1){
		$dataup['fansavatar'] = $response['headimgurl'];
		foreach($fklast as $k=>$v){
			pdo_update(BEST_FANSKEFU,$dataup, array('id' => $v['id']));
		}
		$resArr['message'] = "更新成功！";
		$resArr['error'] = 0;
	}else{
		$resArr['error'] = 1;
		$resArr['message'] = "粉丝未关注公众号，不能同步！";
	}
	echo json_encode($resArr,true);
	exit;
}elseif($op == 'allshare'){
	$_W['uniacid'] = intval($_GPC['weid']);
	$cservice = pdo_fetch("SELECT id,thumb FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND content = '{$openid}'");
	$toopenid = trim($_GPC['toopenid']);
	
	$sharetype = $this->getmoduleconfig('sharetype');
	if($sharetype == 0){
		$allfanskefu = pdo_fetchall("SELECT id FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$toopenid}'");
		$fkids = "(0,";
		foreach($allfanskefu as $k=>$v){
			$fkids .= $v['id'].",";
		}
		$fkids = substr($fkids,0,-1).")";
	}else{
		$allingroup = pdo_fetchall("SELECT groupid FROM ".tablename(BEST_KEFUANDGROUP)." WHERE kefuid = {$cservice['id']}");
		$allingrouparr = array();
		foreach($allingroup as $kk=>$vv){
			$allingrouparr[] = $vv['groupid'];
		}
		$groupcservice = pdo_fetchall("SELECT b.content FROM ".tablename(BEST_KEFUANDGROUP)." as a,".tablename(BEST_CSERVICE)." as b WHERE a.weid = {$_W['uniacid']} AND a.groupid in (".implode(",",$allingrouparr).") AND a.kefuid = b.id AND b.ctype = 1");
		$groupcservicearr = "(";
		foreach($groupcservice as $kk=>$vv){
			$groupcservicearr .= "'".$vv['content']."',";
		}
		$groupcservicearr = substr($groupcservicearr,0,-1).")";
		$allfanskefu = pdo_fetchall("SELECT id FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$toopenid}' AND kefuopenid in {$groupcservicearr}");
		$fkids = "(0,";
		foreach($allfanskefu as $k=>$v){
			$fkids .= $v['id'].",";
		}
		$fkids = substr($fkids,0,-1).")";
	}
	$chatcon = pdo_fetchall("SELECT * FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND fkid in {$fkids} AND kefudel = 0 AND fansdel = 0 ORDER BY time ASC");
	if(!empty($chatcon)){
		$timestamp = TIMESTAMP;
		$html = '<div class="m-message" style="overflow-y:auto;"><ul>';
		foreach($chatcon as $k=>$v){
			$hasfanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE id = {$v['fkid']}");
			if($v['type'] == 3 || $v['type'] == 4){
				$ccc = '<img src="'.$v['content'].'" class="sssbbb" />';
			}elseif($v['type'] == 5 || $v['type'] == 6){
				$ccc = '<div class="concon voiceplay flex" data-con="'.$v['content'].'" data-id="'.$v['id'].'">
									<img src="'.NEWSTATIC_ROOT.'/icon/voice2.png" class="voice2" />
									<div class="flex1"></div>
								</div>';
			}elseif($v['type'] == 7){
				$add_arr = explode(",",$chatcon[$k]['content']);
				$ccc = '<div class="concon toaddress flex">
									<img src="'.NEWSTATIC_ROOT.'/icon/map.png" class="map" />
									<div class="mapadd">'.$add_arr[3].'</div>
								</div>';
			}else{
				$ccc = $v['content'];
			}
				
			$selfdiv = $v['toopenid'] == $toopenid ? '<div class="main self">' : '<div class="main">';
			$selfimg = $v['toopenid'] == $toopenid ? '<img src="'.$hasfanskefu['kefuavatar'].'" class="avatar" alt=""/>' : '<img src="'.$hasfanskefu['fansavatar'].'" class="avatar" alt=""/>';
			$html .= '<li>'.$selfdiv.$selfimg.'
						<div class="text">'.$ccc.'</div>
						</div></li>';
		}
		$html .= '</ul></div>';
		$resArr['error'] = 0;
		$resArr['html'] = $html;
		echo json_encode($resArr,true);
		exit;
	}else{
		$resArr['error'] = 1;
		$resArr['msg'] = '暂无共享记录！';
		echo json_encode($resArr,true);
		exit;
	}
}elseif($op == 'search'){
	$searchtext = trim($_GPC['searchtext']);
	$html = '';
	if(!empty($searchtext)){
		$fanslist = pdo_fetchall("SELECT openid,nickname FROM ".tablename('mc_mapping_fans')." WHERE uniacid = {$_W['uniacid']} AND nickname like '%{$searchtext}%'");
		foreach($fanslist as $k=>$v){
			$fanskf = pdo_fetch("SELECT nowjd FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND fansopenid = '{$v['openid']}'");
			$isjd = empty($fanskf) ? 0 : $fanskf['nowjd'];
			$html .= '<a href="'.$this->createMobileUrl('kefucenter',array('toopenid'=>$v['openid'],'isjd'=>$isjd)).'" style="color:#fff;"><div class="name">'.$v['nickname'].'</div></a>';
		}
	}
	echo $html;
	exit;
}elseif($op == 'mlistmore'){
	$isjd = intval($_GPC['isjd']);
	if($isjd > 0){
		if($isjd == 1){
			$condition = "kefuopenid = '{$openid}' AND nowjd = 1";
		}else{
			$condition = "kefuopenid = '{$openid}' AND nowjd = 2";
		}
		$orderby = "ORDER BY jdtime DESC,notread DESC,lasttime DESC";
	}else{
		$condition = "kefuopenid = '{$openid}' AND (lastcon != '' OR notread > 0) AND kefudel = 0 AND nowjd = 0";
		$orderby = "ORDER BY notread DESC,lasttime DESC";
	}
	
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE ".$condition);
	$pindex = max(1, intval($_GPC['page']));
	$psize = 30;
	$allpage = ceil($total/$psize)+1;
	$limit = " LIMIT ".($pindex - 1)*$psize.",".$psize;
	$fanslist = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE ".$condition." ".$orderby.$limit);
	$html = "";
	foreach($fanslist as $k=>$v){
		$imghtml = $v['fansavatar'] != "" ? '<img src="'.$v['fansavatar'].'" class="avatar">' : '<img src="'.MD_ROOT_Z.'static/xcx.png" class="avatar">';
		$readhtml = $v['notread'] > 0 ? '<span class="notread">'.$v['notread'].'</span>' : '';
		$url = $_W['siteroot'].'app/index.php?i='.$v['weid'].'&c=entry&do=kefucenter&m=cy163_customerservice_plugin_p&toopenid='.$v['fansopenid'].'&isjd='.$isjd.'&weid='.$v['weid'];
		$html .= '<a data-openid="openid'.$v['fansopenid'].'" href="'.$url.'" style="color:#9FA8B1;">
					<li>
						'.$imghtml.'
						<p class="name">'.$v['fansnickname'].'</p>
						'.$readhtml.'
					</li>
					</a>';
	}
	echo $html;
	exit;
}else{
	$weid = intval($_GPC['weid']);
	if($weid != 0){
		$_W['uniacid'] = $weid;
	}
	$voiceon = $this->getmoduleconfig('voiceon');
	
	$isxcx = intval($_GPC['isxcx']);
	$isjd = intval($_GPC['isjd']);
	$toopenid = trim($_GPC['toopenid']);
	if($isxcx == 0){
		if($isjd > 0){
			if($isjd == 1){
				$condition = "kefuopenid = '{$openid}' AND nowjd = 1";
			}else{
				$condition = "kefuopenid = '{$openid}' AND nowjd = 2";
			}
			$orderby = "ORDER BY jdtime DESC,notread DESC,lasttime DESC";
		}else{
			$condition = "kefuopenid = '{$openid}' AND (lastcon != '' OR notread > 0) AND kefudel = 0 AND nowjd = 0";
			$orderby = "ORDER BY notread DESC,lasttime DESC";
		}
		
		$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE ".$condition);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$allpage = ceil($total/$psize)+1;
		$limit = " LIMIT ".($pindex - 1)*$psize.",".$psize;
		$fanslist = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE ".$condition." ".$orderby.$limit);
		foreach($fanslist as $k=>$v){		
			/*$bqres = pdo_fetch("SELECT name FROM ".tablename(BEST_BIAOQIAN)." WHERE kefuopenid = '{$openid}' AND fensiopenid = '{$v['fansopenid']}'");
			if(!empty($bqres)){
				$fanslist[$k]['fansnickname'] = $bqres['name'];
			}*/
			$fanslist[$k]['url'] = $_W['siteroot'].'app/index.php?i='.$v['weid'].'&c=entry&do=kefucenter&m=cy163_customerservice_plugin_p&toopenid='.$v['fansopenid'].'&isjd='.$isjd.'&weid='.$v['weid'];
		}
		
		if(!empty($toopenid)){
			$fanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE kefuopenid = '{$openid}' AND fansopenid = '{$toopenid}'");
			if(empty($fanskefu)){
				$cservice = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$openid}'");
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
				pdo_insert(BEST_FANSKEFU,$datafanskefu);
				$fanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$toopenid}' AND kefuopenid = '{$openid}'");
			}
			//更新头像昵称
			if($fanskefu['fansnickname'] == '匿名用户' || $fanskefu['fansnickname'] == ''){
				$oplen = strlen($fanskefu['fansopenid']);
				if($oplen == 28){
					$account_api = WeAccount::create();
					$info = $account_api->fansQueryInfo($fanskefu['fansopenid']);
					if($info['subscribe'] == 1){
						$dataupna['fansavatar'] = $info['headimgurl'];
						$dataupna['fansnickname'] = $info['nickname'];
						//更新客服粉丝对应表
						pdo_update(BEST_FANSKEFU,$dataupna,array('id'=>$fanskefu['id']));
					}
					$fanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE fansopenid = '{$toopenid}' AND kefuopenid = '{$openid}'");
				}
			}
			$fkid = $fanskefu['id'];
			$chatcon = pdo_fetchall("SELECT * FROM ".tablename(BEST_CHAT)." WHERE fkid = {$fkid} ORDER BY time ASC");
			$chatcontime = 0;
			foreach($chatcon as $k=>$v){
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
			//pdo_update(BEST_FANSKEFU,array('kfzx'=>1,'notread'=>0),array('id'=>$fkid));
			pdo_update(BEST_FANSKEFU,array('notread'=>0),$dataupfk,array('id'=>$fkid));
			
			$fangkemsg = unserialize($fanskefu['fangke']);
			$biaoqian = pdo_fetch("SELECT * FROM ".tablename(BEST_BIAOQIAN)." WHERE kefuopenid = '{$fanskefu['kefuopenid']}' AND fensiopenid = '{$fanskefu['fansopenid']}'");
			
			$goodsid = intval($_GPC['goodsid']);
			$qudao = trim($_GPC['qudao']);
			if(empty($goodsid) || empty($qudao)){
				$goodsmsg = unserialize($fanskefu['goodsmsg']);
				$goodsid = intval($goodsmsg['gid']);
				$qudao = trim($goodsmsg['qudao']);
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
			}
			if($qudao == 'szds' && $goodsid > 0){
              include_once MD_ROOT_Z.'simple_html_dom.php';
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
                include_once MD_ROOT_Z.'simple_html_dom.php';
                $szdsurl = "https://tingtingke.szds.com/index.php?homepage=".$homepage;
                $szdshtml = file_get_html($szdsurl);
                $goods['title'] = $szdshtml->find('.sj',0)->find('.title',0)->plaintext;
                $goods['price'] = "";
                $goods['thumb'] = $szdshtml->find('.mui-slider-item',0)->find('img',0)->src;
                $goods['id'] = $homepage;
                $goods['url'] = $szdsurl;
            }
		}
		$cservice = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$openid}'");		
		$auto = pdo_fetchall("SELECT * FROM ".tablename(BEST_KUAIJIE)." WHERE kfid = {$cservice['id']} ORDER BY displayorder DESC");
	}else{
		$fanslist = pdo_fetchall("SELECT * FROM ".tablename(BEST_XCXFANSKEFU)." WHERE kefuopenid = '{$openid}' AND lastcon != '' ORDER BY notread DESC,lasttime DESC LIMIT 30");
		foreach($fanslist as $kk=>$vv){
			$xcxres = pdo_fetch("SELECT name FROM ".tablename(BEST_XCX)." WHERE gh_id = '{$vv['gh_id']}'");
			$biaoqian = pdo_fetch("SELECT name FROM ".tablename(BEST_BIAOQIAN)." WHERE kefuopenid = '{$vv['kefuopenid']}' AND fensiopenid = '{$vv['fansopenid']}'");
			$vv['fansnickname'] = $vv['fansnickname'] == "" ? "用户" : $vv['fansnickname'];
			if(!empty($biaoqian)){
				$fanslist[$kk]['fansnickname'] = '['.$xcxres['name'].']['.$biaoqian['name'].']'.$vv['fansnickname'];
			}else{
				$fanslist[$kk]['fansnickname'] = '['.$xcxres['name'].']'.$vv['fansnickname'];
			}
			$fanslist[$kk]['url'] = $_W['siteroot'].'app/index.php?i='.$vv['weid'].'&c=entry&do=kefucenter&isxcx=1&m=cy163_customerservice_plugin_p&toopenid='.$vv['fansopenid'].'&isjd='.$isjd.'&weid='.$vv['weid'];
		}
		
		if(!empty($toopenid)){
			include_once MD_ROOT_Z.'qqface.php';
			$cservice = pdo_fetch("SELECT * FROM ".tablename(BEST_XCXCSERVICE)." WHERE weid = {$_W['uniacid']} AND content = '{$openid}'");
			$fanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_XCXFANSKEFU)." WHERE kefuopenid = '{$openid}' AND fansopenid = '{$toopenid}'");
			$xcxres = pdo_fetch("SELECT * FROM ".tablename(BEST_XCX)." WHERE gh_id = '{$fanskefu['gh_id']}'");	

			$fkid = $fanskefu['id'];
			$fkidlist = pdo_fetchall("SELECT id FROM ".tablename(BEST_XCXFANSKEFU)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$fanskefu['fansopenid']}' AND gh_id = '{$fanskefu['gh_id']}'");
			$fkarr = array();
			foreach($fkidlist as $k=>$v){
				$fkarr[] = $v['id'];
			}
			$chatcon = pdo_fetchall("SELECT * FROM ".tablename(BEST_XCXCHAT)." WHERE fkid in (".implode(",",$fkarr).") ORDER BY time ASC");
			$chatcontime = 0;
			foreach($chatcon as $k=>$v){
				if($v['openid'] != $fanskefu['fansopenid']){
					$newfk = pdo_fetch("SELECT kefuavatar FROM ".tablename(BEST_XCXFANSKEFU)." WHERE id = {$v['fkid']}");
					$chatcon[$k]['kefuavatar'] = $newfk['kefuavatar'];
				}else{
					if($fanskefu['fansavatar']){
						$chatcon[$k]['fansavatar'] = $fanskefu['fansavatar'];
					}else{
						$chatcon[$k]['fansavatar'] = MD_ROOT_Z."static/xcx.png";
					}
				}
				if(($v['time'] - $chatcontime) > 7200){
					$chatcon[$k]['time'] = $v['time'];
				}else{
					$chatcon[$k]['time'] = '';
				}
				
				$chatcon[$k]['content'] = qqface_convert_html($chatcon[$k]['content']);
				
				$chatcon[$k]['content'] = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '[无法识别字符]', $chatcon[$k]['content']);
				$regex = '@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))@';
				preg_match_all($regex,$chatcon[$k]['content'],$array2);  
				if(!empty($array2[0]) && $v['msgtype'] == 'text'){
					foreach($array2[0] as $kk=>$vv){
						if(!empty($vv) && strpos($vv,'https://res.wx.qq.com') === false){
							$vvurl = strstr($vv,"http") ? $vv : "http://".$vv;
							$chatcon[$k]['content'] = str_replace($vv,"<a href='".$vvurl."'>".$vv."</a>",$chatcon[$k]['content']);
						}
					}
				}
				
				$chatcontime = $v['time'];
			}
			
			$auto = empty($cservice['kefuauto']) ? '' : explode("|",$cservice['kefuauto']);
			pdo_update(BEST_XCXFANSKEFU,array('notread'=>0),array('id'=>$fanskefu['id']));
			$biaoqian = pdo_fetch("SELECT * FROM ".tablename(BEST_BIAOQIAN)." WHERE kefuopenid = '{$openid}' AND fensiopenid = '{$fanskefu['fansopenid']}'");
		}
	}
	
	$total1 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE kefuopenid = '{$openid}' AND (lastcon != '' OR notread > 0) AND kefudel = 0 AND nowjd = 0");
	$total2 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE kefuopenid = '{$openid}' AND nowjd = 1");
	$total3 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE kefuopenid = '{$openid}' AND nowjd = 2");
	$totalxcx = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('messikefu_xcxfanskefu')." WHERE kefuopenid = '{$openid}' AND lastcon != ''");
	include $this->template('kefucenter');
}
?>