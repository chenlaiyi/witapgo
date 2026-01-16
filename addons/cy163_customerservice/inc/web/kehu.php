<?php
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
	$cservicelist = pdo_fetchall("SELECT content,name,thumb FROM " . tablename(BEST_CSERVICE) . " WHERE weid = {$_W['uniacid']} AND ctype = 1 ORDER BY displayorder ASC");
	$conditions = "weid = {$_W['uniacid']} AND (lasttime > 0 || kefulasttime > 0)";
	$kefuopenid = trim($_GPC['kefuopenid']);
	if(!empty($kefuopenid)){
		$conditions .= " AND kefuopenid = '{$kefuopenid}'";
	}
	$keyword = trim($_GPC['keyword']);
	if(!empty($keyword)){
		$chats = pdo_fetchall("SELECT fkid FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND content like '%{$keyword}%'");
		$fkids_arr = [];
		foreach($chats as $k=>$v){
			$fkids_arr[] = $v['fkid'];
		}
		if(!empty($fkids_arr)){
			$conditions .= " AND (fansnickname like '%{$keyword}%' OR fansopenid like '%{$keyword}%' OR id in (".implode(",",$fkids_arr)."))";
		}else{
			$conditions .= " AND (fansnickname like '%{$keyword}%' OR fansopenid like '%{$keyword}%')";
		}
	}
	
	if (!empty($_GPC['time'])) {
		$starttime = strtotime($_GPC['time']['start']." 00:00:00");
		$endtime = strtotime($_GPC['time']['end']." 23:59:59");
	}else{
		$starttime = strtotime(date("Y-m-d",strtotime("-1 years",TIMESTAMP))." 00:00:00");
		$endtime = TIMESTAMP;
	}
	/*$conditionschat = "weid = {$_W['uniacid']} AND time > {$starttime} AND time < {$endtime}";
	$allfkid = pdo_fetchall("SELECT fkid FROM ".tablename(BEST_CHAT)." WHERE ".$conditionschat);
	$fkidarr[] = 0;
	foreach($allfkid as $k=>$v){
	    if (!in_array($v['fkid'],$fkidarr)){
	    	$fkidarr[] = $v['fkid'];
	    }
	}
	$conditions .= " AND id in (".implode(",",$fkidarr).")";*/
	
	$conditions .= " AND lasttime > {$starttime} AND lasttime < {$endtime}";
	
	
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE ".$conditions);
	$alltotal = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_CHAT)." WHERE weid = {$_W['uniacid']} AND time > {$starttime} AND time < {$endtime}");
	$psize = 10;
	$allpage = ceil($total/$psize)+1;
	$page = intval($_GPC["page"]);
	$pindex = max(1, $page);
	$list = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE ".$conditions." ORDER BY lasttime DESC LIMIT ".($pindex - 1)*$psize.",".$psize);
	foreach($list as $k=>$v){
		$biaoqianres = pdo_fetch("SELECT * FROM ".tablename(BEST_BIAOQIAN)." WHERE fensiopenid = '{$v['fansopenid']}' AND kefuopenid = '{$v['kefuopenid']}'");
		$list[$k]['name'] = $biaoqianres['name'];
		$list[$k]['realname'] = $biaoqianres['realname'];
		$list[$k]['telphone'] = $biaoqianres['telphone'];
		$list[$k]['chat'] = pdo_fetchall("SELECT * FROM ".tablename(BEST_CHAT)." WHERE fkid = {$v['id']} AND time > {$starttime} AND time < {$endtime} ORDER BY time DESC");
		$list[$k]['lastcon'] = $list[$k]['chat'][0]['content'];
		$list[$k]['msgtype'] = $list[$k]['chat'][0]['msgtype'];
		$list[$k]['lasttime'] = $list[$k]['chat'][0]['time'];
		$list[$k]['zz'] = pdo_fetchall("SELECT * FROM ".tablename(BEST_ZHUIZONG)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$v['fansopenid']}' ORDER BY time DESC");
	}
	$pager = pagination($total, $pindex, $psize);
	if ($_GPC['export'] == 'export') {	
		$fanslistdaochu = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE ".$conditions." ORDER BY lasttime DESC");
		if(empty($fanslistdaochu)){
			message('没有记录不能导出！');
		}else{
			$titlearray = array("会话ID","粉丝OPENID","发送方","接收方","消息时间","消息内容");
			foreach($fanslistdaochu as $k=>$v){
				$chatlist = pdo_fetchall("SELECT * FROM ".tablename(BEST_CHAT)." WHERE fkid = {$v['id']} AND time > {$starttime} AND time < {$endtime} ORDER BY time DESC");
				$data = [];
				foreach ($chatlist as $kk => $vv) {
					$data[$kk]['id'] = $vv['id'];
					$data[$kk]['fansopenid'] = $v['fansopenid'];
					if($v['fansopenid'] == $vv['openid']){
						$data[$kk]['fansnickname'] = $v['fansnickname'];
						$data[$kk]['kefunickname'] = $v['kefunickname'];
					}else{
						$data[$kk]['fansnickname'] = $v['kefunickname'];
						$data[$kk]['kefunickname'] = $v['fansnickname'];
					}
					$data[$kk]['time'] = date("Y-m-d H:i:s",$vv['time']);
					$data[$kk]['con'] = $this->deletehtml($vv['content']);
				}
				$this->exportexcel($data,$titlearray,'','',$filename='客户统计');
			}
			exit();
		}
	}
}elseif ($operation == 'wei') {
	$cservicelist = pdo_fetchall("SELECT content,name,thumb FROM " . tablename(BEST_CSERVICE) . " WHERE weid = {$_W['uniacid']} AND ctype = 1 ORDER BY displayorder ASC");
	$conditions = "weid = {$_W['uniacid']} AND lasttime = 0 AND kefulasttime = 0";
	$kefuopenid = trim($_GPC['kefuopenid']);
	if(!empty($kefuopenid)){
		$conditions .= " AND kefuopenid = '{$kefuopenid}'";
	}
	$keyword = trim($_GPC['keyword']);
	if(!empty($keyword)){
		$conditions .= " AND (fansnickname like '%{$keyword}%' OR fansopenid like '%{$keyword}%')";
	}
	
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename(BEST_FANSKEFU)." WHERE ".$conditions);
	$psize = 10;
	$allpage = ceil($total/$psize)+1;
	$page = intval($_GPC["page"]);
	$pindex = max(1, $page);
	$list = pdo_fetchall("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE ".$conditions." ORDER BY id DESC LIMIT ".($pindex - 1)*$psize.",".$psize);
	$pager = pagination($total, $pindex, $psize);
}elseif ($operation == 'export') {
	$fansopenid = trim($_GPC['fansopenid']);
	$list = pdo_fetchall("SELECT * FROM ".tablename(BEST_ZHUIZONG)." WHERE weid = {$_W['uniacid']} AND fansopenid = '{$fansopenid}' ORDER BY time DESC");
	/* 输入到CSV文件 */
	$html = "\xEF\xBB\xBF";
	/* 输出表头 */
	$filter = array('客服','记录内容','时间');
	foreach ($filter as $key => $title) {
		$html .= $title . "\t,";
	}
	
	foreach ($list as $k => $v) {
		$v['content'] = preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","", $v['content']);
		$html .= "\n";
		$html .= $v['kefuname']. "\t, ";
		$html .= $v['content']. "\t, ";
		$html .= date("Y-m-d H:i:s",$v['time']). "\t, ";
	}
	/* 输出CSV文件 */
	header("Content-type:text/csv");
	header("Content-Disposition:attachment; filename=".$_GPC['fansnickname']."的跟踪记录.csv");
	echo $html;
	exit();
}elseif ($operation == 'deletedu') {
	$id = intval($_GPC['id']);
	$chat = pdo_fetch("SELECT id FROM ".tablename(BEST_CHAT)." WHERE id = {$id}");
	if (empty($chat)) {
		$resarr['error'] = 1;
		$resarr['msg'] = '不存在该聊天记录！';
		echo json_encode($resarr);
		exit();
	}
	pdo_delete(BEST_CHAT,array('id'=>$id));
	$resarr['error'] = 0;
	$resarr['msg'] = '删除成功！';
	echo json_encode($resarr);
	exit();
}elseif ($operation == 'deletedudu') {
	$id = intval($_GPC['id']);
	$zhuizong = pdo_fetch("SELECT id FROM ".tablename(BEST_ZHUIZONG)." WHERE id = {$id}");
	if (empty($zhuizong)) {
		$resarr['error'] = 1;
		$resarr['msg'] = '不存在该记录！';
		echo json_encode($resarr);
		exit();
	}
	pdo_delete(BEST_ZHUIZONG,array('id'=>$id));
	$resarr['error'] = 0;
	$resarr['msg'] = '删除成功！';
	echo json_encode($resarr);
	exit();
}elseif ($operation == 'changecon') {
	$id = intval($_GPC['id']);
	$zhuizong = pdo_fetch("SELECT id FROM ".tablename(BEST_ZHUIZONG)." WHERE id = {$id}");
	if (empty($zhuizong)) {
		$resarr['error'] = 1;
		$resarr['msg'] = '不存在该记录！';
		echo json_encode($resarr);
		exit();
	}
	if (empty($_GPC['content'])) {
		$resarr['error'] = 1;
		$resarr['msg'] = '请填写跟踪内容！';
		echo json_encode($resarr);
		exit();
	}
	$data['content'] = $_GPC['content'];
	pdo_update(BEST_ZHUIZONG,$data,array('id'=>$id));
	$resarr['error'] = 0;
	$resarr['msg'] = '修改跟踪内容成功！';
	echo json_encode($resarr);
	exit();
}elseif ($operation == 'changemsg') {
	$id = intval($_GPC['id']);
	$name = trim($_GPC['name']);
	$realname = trim($_GPC['realname']);
	$telphone = trim($_GPC['telphone']);
	$chat = pdo_fetch("SELECT * FROM ".tablename(BEST_FANSKEFU)." WHERE weid = {$_W['uniacid']} AND id = {$id}");
	$hasbiaoqian = pdo_fetch("SELECT * FROM ".tablename(BEST_BIAOQIAN)." WHERE weid = {$_W['uniacid']} AND fensiopenid = '{$chat['fansopenid']}' AND kefuopenid = '{$chat['kefuopenid']}'");
	if (empty($hasbiaoqian)) {
		$data['weid'] = $_W['uniacid'];
		$data['kefuopenid'] = $chat['kefuopenid'];
		$data['fensiopenid'] = $chat['fansopenid'];
		$data['name'] = $name;
		$data['realname'] = $realname;
		$data['telphone'] = $telphone;
		pdo_insert(BEST_BIAOQIAN,$data);
	}else{
		$data['name'] = $name;
		$data['realname'] = $realname;
		$data['telphone'] = $telphone;
		pdo_update(BEST_BIAOQIAN,$data,array('fensiopenid'=>$chat['fansopenid'],'kefuopenid'=>$chat['kefuopenid']));
	}
	$dataup['ishei'] = intval($_GPC['ishei']);
	$isbd = intval($_GPC['isbd']);
	$dataup['bdopenid'] = $isbd == 1 ? $chat['kefuopenid'] : '';
	pdo_update(BEST_FANSKEFU,$dataup,array('id'=>$id));
	message('操作成功！', referer(), 'success');
}elseif ($operation == 'deletefanskefu') {
	$id = intval($_GPC['id']);
	if (empty($id)) {
		message('抱歉，参数传入错误！');
	}
	$chatlist = pdo_fetchall("SELECT id,content,type FROM ".tablename(BEST_CHAT)." WHERE fkid = {$id}");
	foreach($chatlist as $k=>$v){
		if($v['type'] != 1 && $v['type'] != 2){
			$this->doQiuniudel($v['content']);
		}
		pdo_delete(BEST_CHAT,array('id'=>$v['id']));
	}
	pdo_query("DELETE FROM ".tablename(BEST_FANSKEFU)." WHERE id = {$id}");
	message('删除成功！', referer(), 'success');
}else {
	message('请求方式不存在');
}
include $this->template('web/kehu');
?>