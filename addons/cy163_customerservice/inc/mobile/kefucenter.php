<?php
global $_W, $_GPC;
$openid = $_W['fans']['from_user'];
if(empty($openid)){
	header("Location:".$this->createMobileUrl('kefulogin'));
}
$iscservice = pdo_fetch("SELECT * FROM ".tablename(BEST_CSERVICE)." WHERE weid = {$_W['uniacid']} AND ctype = 1 AND content = '{$openid}'");
if(empty($iscservice)){
	$message = '你不是客服！';
	include $this->template('error');
	exit;
}
$op = trim($_GPC['op']);
if($op == ""){
	$total1 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND (lastcon != '' OR notread > 0) AND kefudel = 0 AND nowjd = 0");
	$total2 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND nowjd = 1");
	$total3 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND nowjd = 2");
	$total4 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_LIUYAN)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND readstatus = 0");
	include $this->template('kefucenter');
}elseif($op == 'sxx'){
	if(empty($iscservice)){
		$resArr['error'] = 1;
		$resArr['message'] = '你不是客服！';
		echo json_encode($resArr);
		exit;
	}
	if($iscservice['isrealzx'] == 1){
		$data['isrealzx'] = 0;
	}else{
		$data['isrealzx'] = 1;
	}
	pdo_update(BEST_CSERVICE,$data,array('id'=>$iscservice['id']));
	$resArr['error'] = 0;
	echo json_encode($resArr);
	exit;
}elseif($op == 'search'){
	$nickname = trim($_GPC['nickname']);
	if(empty($nickname)){
		$resArr['error'] = 1;
		$resArr['msg'] = '请输入粉丝昵称搜索！';
		echo json_encode($resArr);
		exit;
	}
	$fensopenids = [];
	$bqres = pdo_fetchall("SELECT fensiopenid FROM ".tablename('messikefu_biaoqian')." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND (name like '%{$nickname}%' OR realname like '%{$nickname}%' OR telphone like '%{$nickname}%')");
	foreach($bqres as $k=>$v){
		$fensopenids[] = "'".$v['fensiopenid']."'";
	}
	$fanskf = pdo_fetchall("SELECT fansnickname,fansopenid,fansavatar FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND kefuopenid = '{$openid}' AND fansopenid in (".implode(",",$fensopenids).")");
	$html = '';
	foreach($fanskf as $k=>$v){
		$html .= '<div class="flex search-item">
						<img src="'.$v['fansavatar'].'" />
						<a href="'.$this->createMobileUrl('servicechat',array('toopenid'=>$v['fansopenid'])).'" class="flex1 flex">
							<span style="color:green;">[标签搜索]</span><span class="flex1">'.$v['fansnickname'].'</span>
						</a>
					</div>';
	}

	$fanslist = pdo_fetchall("SELECT uid,openid,nickname FROM ".tablename('mc_mapping_fans')." WHERE uniacid = {$_W['uniacid']} AND openid != '{$openid}' AND nickname like '%{$nickname}%'");
	foreach($fanslist as $k=>$v){
		$memberres = pdo_fetch("SELECT * FROM ".tablename('mc_members')." WHERE uid = {$v['uid']}");
		$html .= '<div class="flex search-item">
					<img src="'.$memberres['avatar'].'" />
					<a href="'.$this->createMobileUrl('servicechat',array('toopenid'=>$v['openid'])).'" class="flex1 flex">
						<span style="color:green;">[昵称搜索]</span><span class="flex1">'.$v['nickname'].'</span>
					</a>
				</div>';	
	}
	if($html == ""){
		$html = '<div class="nosearchtext">没有搜索到数据~~</div>';
	}
	$resArr['error'] = 0;
	$resArr['html'] = $html;
	echo json_encode($resArr);
	exit;
}
?>