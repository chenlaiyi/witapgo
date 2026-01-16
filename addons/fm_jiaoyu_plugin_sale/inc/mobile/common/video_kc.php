<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
	global $_W, $_GPC;
	$weid = $_W['uniacid'];
	$schoolid = intval($_GPC['schoolid']);
	$openid = $_W['openid'];
	$kcid = intval($_GPC['kcid']);
	$mastertid = intval($_GPC['mastertid']);
	$masteruid = $_GPC['masteruid']?$_GPC['masteruid']:$openid;//归属粉丝openid默认自己
	$masteruserid = $_GPC['masteruserid'];
	$com_form = $_GPC['com_form']?$_GPC['com_form']:6;//默认无人推广粉丝自己点击
	$zljgtz = array(
		'zltz'   	  	   => trim($_GPC['zltz']),
		'sms_SignName'     => trim($_GPC['zltz_singname']),
		'sms_Code'         => trim($_GPC['zltz_code']),
	);
	mload()->model('stu');
	mload()->model('kc');
	$kcinfo = pdo_fetch("SELECT * FROM " . GetTableName('tcourse') . " WHERE :id = id", array(':id' => $kcid));

	$tuan = check_app('tuan',$weid,$schoolid);$tuiguang = check_app('tuiguang',$weid,$schoolid);$zhuli = check_app('zhuli',$weid,$schoolid);
	if($kcinfo['sale_type'] != 0 || ($tuan||$tuiguang||$zhuli)){
		SetFansInfoByKc($id,$openid,0,$mastertid,$masteruid,$masteruserid,$com_form);
	}
	$user =  get_myallclass_inschool($weid,$openid,$schoolid);
	$school = pdo_fetch("SELECT title,style3,headcolor,is_stuewcode,Is_point,spic,tpic,address,tel,is_chongzhi FROM " . GetTableName('index') . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
	$nowtime = time();
	$saleset = pdo_fetch("SELECT * FROM " . GetTableName('kc_saleset') . " WHERE id = :id ", array(':id' => $kcinfo['sale_id']));
	$tgset = pdo_fetch("SELECT * FROM " . GetTableName('kc_promote') . " WHERE id = :id ", array(':id' => $kcinfo['tg_id']));
	if($tgset['allow_normal'] == 1){//开启了普通粉丝参与推广 显示排名
		$myrank = GetNorFansMyRank($kcid,$openid);
		$myrank = $myrank['myrank'];
	}
	$mystulist = GetStuByOpenid($kcid,$openid,$schoolid);//获取我绑定的学生报名了本课程的队伍的列表 且为参加了队伍的
	$mystucount = count($mystulist);
	if(!empty($kcinfo['tid'])){//设置了授课老师，前端显示
		$teacher_array =  explode(',', $kcinfo['tid']);
		$tid_array = array();
		foreach( $teacher_array as $key => $value )	{
			$teacher = pdo_fetch("SELECT tname,id,thumb FROM " . GetTableName('teachers') . " where id = :id", array(':id' => $value));
			$tid_array[$key]['tname']  = $teacher['tname'];
			$tid_array[$key]['tid']   = $teacher['id'];
			$tid_array[$key]['thumb'] = $teacher['thumb']?tomedia($teacher['thumb']):tomedia($school['tpic']);
		}
	}
	if($kcinfo['kc_type'] ==1){//在线课程显示目录及章节
		if($kcinfo['allow_menu'] == 1){//启用章节
			$menulist = pdo_fetchall("SELECT * FROM " . GetTableName('kc_menu') . " WHERE schoolid = '{$schoolid}' And kcid = '{$kcid}' ORDER BY id ASC ");
			$checkzj = pdo_fetch("SELECT * FROM " . GetTableName('kcbiao') . " WHERE schoolid = '{$schoolid}' And kcid = '{$kcid}' And menu_id = 0 ");
			if($checkzj){
				array_push($menulist,array('name' => '默认章节'));
			}
		}else{
			$menulist = array(array('name' => '课程排课'));
			$condition = " ";
		}
		$number = 1;
		$menunub = 0;
		$nowtime = time();
		foreach($menulist as $k => $item){
			if($kcinfo['allow_menu'] == 1){//启用章节
				$condition = "And menu_id = '{$item['id']}' ";
			}
			$menulist[$k]['list'] = pdo_fetchall("SELECT * FROM " . GetTableName('kcbiao') . " WHERE schoolid = '{$schoolid}' And kcid = '{$kcid}' $condition ORDER BY ssort DESC ");
			foreach($menulist[$k]['list'] as $key => $row){
				$menulist[$k]['list'][$key]['number'] = $number;
				$number ++;
				$menulist[$k]['list'][$key]['already'] = false; //验证是否直播中
				if($row['content_type'] == 1){
					$checktime = $row['sk_start'] - $kcinfo['txtime']*60;
					if($nowtime >= $checktime && $row['sk_end'] > $nowtime){
						$menulist[$k]['list'][$key]['already'] = true;
					}
				}
			}
			$menunub++;
		}
	}else{
		$allkslist = pdo_fetchall("SELECT * FROM " . GetTableName('kcbiao') . " WHERE kcid = :kcid ORDER BY date ASC ", array(':kcid' => $kcid));
		foreach($allkslist as $key => $row){
			$allkslist[$key]['number'] = $key+1;
			$allkslist[$key]['day'] = date('m-d',$row['date']);
			$allkslist[$key]['week'] = date('w',$row['date']);
			$sdinfo = pdo_fetch("SELECT sname FROM " . GetTableName('classify') . " where sid = :sid", array(':sid' => $row['sd_id']));
			$allkslist[$key]['sdname'] = $sdinfo['sname'];
		}
	}
	$pllist = GetKcComment($kcid,'stu');//取出课程评论
	$all_number = GetKcContStu($kcid,true) + $kcinfo['yibao'];//总共报名人数+虚拟报名
	$isover = false;
	if($kcinfo['sale_type'] != 0 && $saleset['endtime'] > time()){
		$isover = true;
	}
	
	

	if($isover && empty($_GPC['teamid'])){//取出所有正在进行的团购
		$allteam = GetAllTeamByKcid($kcid,true);
	}
	if(!empty($_GPC['teamid'])){
		$myteam = GetTeamList($_GPC['teamid'],true);
		$myteamisfull = CheckTemIsFull($_GPC['teamid']);
		$myteaminfo = GetTeamBeastInfo($_GPC['teamid']);
	}
	$fans_list = GetKcStuFans($kcid,5);//随机取5个报名用户头像组成排列
	
	$kcprice_old = $kcinfo['cose'];//课程原价
	$tuanz_price = $isover?$saleset['tuanz_price']:0;//团长优惠
	$zhuli_price = $saleset['price'];//助力优惠
	$tuan_price = $saleset['price'];//团购优惠
	if($kcinfo['sale_type'] == 1){
		$all_dis_price = $tuan_price;//优惠合计
		$salediv = 'tuan';
		$opts = 'tuan';
	}
	if($kcinfo['sale_type'] == 2){
		$all_dis_price = $zhuli_price;//优惠合计
		$salediv = 'rush';
		$opts = 'zhuli';
	}
	if($kcinfo['guigetype'] == 1){
		$guige = pdo_fetchall("SELECT * FROM " . GetTableName('guige') . " WHERE schoolid = '{$schoolid}' And kcid = '{$kcid}' ORDER BY price ASC ");
	}
	if($kcinfo['guigetype'] == 1){
		if($isover){
			$now_price = round($guige[0]['price'] - $all_dis_price,2); //优惠后总价
		}else{
			$now_price = round($kcprice_old ,2);
		}
	}else{
		if($isover){
			$now_price = round($kcprice_old - $all_dis_price,2); //优惠后总价
		}else{
			$now_price = round($kcprice_old ,2);
		}
	}
	$def_sipc = empty($school['spic'])?tomedia($school['spic']): $_W['siteroot'].'/addons/fm_jiaoyu/public/mobile/img/mask_bg2.png';
	$uniacid = !empty($kcinfo['payweid']) ? $kcinfo['payweid'] : $weid ;//必须设定当前课程的支付走向weid
	include $this->template('common/video_kc');		
?>