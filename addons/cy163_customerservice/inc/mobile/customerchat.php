<?php
global $_W, $_GPC;
$openid = $_W['fans']['from_user'];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
	$condition = "weid = {$_W['uniacid']} AND fansopenid = '{$openid}' AND (kefulastcon != '' OR kefunotread > 0) AND fansdel = 0";
	$orderby = " ORDER BY kefunotread DESC,kefulasttime DESC";
	$psize = 20;
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE ".$condition);
	$allpage = ceil($total/$psize)+1;
	$page = intval($_GPC["page"]);
	$pindex = max(1, $page);
	$chatlist = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE ".$condition.$orderby." LIMIT ".($pindex - 1)*$psize.",".$psize);
	$isajax = intval($_GPC['isajax']);
	if($isajax == 1){
		$html = '';
		foreach($chatlist as $kk=>$vv){
			if($vv['msgtype'] == 4){
				$con = '<span style="color:#900;">[图片消息]</span>';
			}elseif($vv['msgtype'] == 5){
				$con = '<span style="color:green;">[语音消息]</span>';
			}elseif($vv['msgtype'] == 7){
				$con = '<span style="color:#428BCA;">[位置消息]</span>';
			}else{
				$con = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '[无法识别字符]', $vv['lastcon']);
			}
			$mychatbadge = $vv['kefunotread'] > 0 ? '<div class="mychatbadge">'.$vv['kefunotread'].'</div>' : '';
			$html .= '<div class="item flex textellipsis1 fkid'.$vv['id'].'">
						<a href="'.$this->createMobileUrl('chat',array('toopenid'=>$vv['kefuopenid'])).'" class="flex tohref textellipsis1">
							<img src="'.$vv['fansavatar'].'">'.$mychatbadge.'
							<div class="text textellipsis1 flex1">
								<div class="name textellipsis1">'.$vv['kefunickname'].'</div>
								<div class="lastmsg textellipsis1">'.$con.'</div>
							</div>
						</a>
						<div class="timedo">
							<div class="time">'.$this->getChatTimeStr($vv['kefulasttime']).'</div>
							<div class="dodel" data-fkid="'.$vv['id'].'">删除</div>
						</div>
					</div>';
		}
		echo $html;
		exit;
	}
	include $this->template('customerchat');
}elseif($operation == 'delete'){
	$fkid = intval($_GPC['fkid']);
	$fanskefu = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE id = {$fkid}");
	if(empty($fanskefu)){
		$resArr['error'] = 1;
		$resArr['message'] = '不存在该记录！';
		echo json_encode($resArr,true);
		exit;
	}
	$dataup['fansdel'] = 1;
	pdo_update(BEST_CHAT,$dataup,array('fkid'=>$fkid));
	pdo_update(BEST_FANSKEFU,$dataup,array('id'=>$fkid));
	$resArr['error'] = 0;
	$resArr['message'] = '恭喜您，删除聊天记录成功！';
	echo json_encode($resArr,true);
	exit;
}
?>