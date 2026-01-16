<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$kcid = intval($_GPC['kcid']);
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];

//查询是否用户登录
$it = pdo_fetch("SELECT id,tid,is_allowmsg FROM " . GetTableName('user') . " where schoolid = :schoolid And openid = :openid And sid = :sid ", array(':schoolid' => $schoolid, ':openid' => $openid, ':sid' => 0 ));		
if(!empty($it)){
	$school = pdo_fetch("SELECT style3,headcolor,is_stuewcode,spic,tpic FROM " . GetTableName('index') . " where id = :id ", array(':id' => $schoolid));
	$myinfo = pdo_fetch("SELECT tname,thumb FROM " . GetTableName('teachers') . " where id = :id ", array(':id' => $it['tid']));
	$myinfo['thumb'] = $myinfo['thumb']?tomedia($myinfo['thumb']):tomedia($school['tpic']);
	$kcinfo = pdo_fetch("SELECT * FROM " . GetTableName('tcourse') . " where id = :id ", array(':id' => $kcid));
	$ertype = true;
	if($school['is_stuewcode'] == 2){
		$ertype = false;
	}
	
	$allstu = pdo_fetchall("SELECT * FROM " . GetTableName('order') . " where kcid = :kcid And superior_tid = :superior_tid GROUP BY sid  ORDER BY createtime DESC ", array(':kcid' => $kcid,':superior_tid' => $it['tid']));
	$pay = 0;$unpay = 0;$trysign = 0;$notrysign = 0;$haszzkc = 0;
	if(!empty($allstu)){
		$zkstu = array();
		foreach($allstu as $key =>$row){
			$mystu = pdo_fetch("SELECT id,sex,s_name,icon,mobile,ouserid,muserid,duserid,otheruserid,qrcode_id,status,seffectivetime FROM " . GetTableName('students') . " where id = :id  ", array(':id' => $row['sid']));
			if(!empty($mystu)){
				$allstu[$key]['stu'] = $mystu;
				$orderuser = pdo_fetch("SELECT openid,mobile FROM " . GetTableName('user') . " where id = :id ", array(':id' => $row['userid']));
				$user = pdo_fetchall("SELECT id FROM " . GetTableName('user') . " where sid = :sid ORDER BY createtime ASC", array(':sid' => $row['sid']));
				$allstu[$key]['usercount'] = count($user);
				$allstu[$key]['mobile'] = $orderuser['mobile']?$orderuser['mobile']:$mystu['mobile'];
				if(!empty($row['team_id'])){
					$teaminfo = GetTeamBeastInfo($row['team_id']);
					$allstu[$key]['teammuber'] = $teaminfo['allteam'];
					$teamlist = GetTeamList($row['team_id'],true);
					$allstu[$key]['teamlist'] = $teamlist;
				}
				$allstu[$key]['vis'] = false;
				$checkvis = pdo_fetch("SELECT id FROM " . GetTableName('kc_vislog') . " where sid = :sid And kcid = :kcid ", array(':sid' => $row['sid'],':kcid' => $kcid));
				$allstu[$key]['vis'] = !empty($checkvis)?true:false;
				$allstu[$key]['form'] = CheckFansBelong($kcid,$row['userid'],$orderuser['openid']);
				if($row['status'] == 2){
					$pay++;
				}else{
					$unpay++;
				}
				$allstu[$key]['trysign'] = false;
				$allstu[$key]['notrysign'] = false;
				$allstu[$key]['hasZSkc'] = false;
				if($kcinfo['is_try'] == 1){
					$hasSign =  pdo_fetch("SELECT id FROM " . GetTableName('kcsign') . " WHERE sid = :sid And kcid=:kcid And status =2 ", array(':sid' => $row['sid'],':kcid'=> $kcid));
					if(!empty($hasSign)){
						$trysign++;
						$allstu[$key]['trysign'] = true;
					}else{
						$notrysign++;
						$allstu[$key]['notrysign'] = true;
					}
					$hasZSkc = pdo_fetchall("SELECT kcid FROM " . GetTableName('order') . " WHERE sid = '{$row['sid']}' And kcid != '{$kcid}' And status =2 And createtime > '{$row['createtime']}' GROUP BY kcid ");
					if(!empty($hasSign)){
						$nowstu = array();
						foreach($hasZSkc as $i =>$r){
							$checkkc = pdo_fetch("SELECT is_try FROM " . GetTableName('tcourse') . " where id = :id ", array(':id' => $r['kcid']));
							if($checkkc['is_try'] != 1){
								$nowstu[] = $row['sid'];
								if(!in_array($row['sid'],$nowstu)){
									$haszzkc++;
								}
								$allstu[$key]['hasZSkc'] = true;
								$zkstu[$row['sid']][] = $r['kcid'];
							}
						}
					}
				}
			}else{
				unset($allstu[$key]);
			}
		}
	}
	if($zkstu){
		foreach($zkstu as $k =>$item){
			$stuinfo = pdo_fetch("SELECT s_name,icon FROM " . GetTableName('students') . " where id = :id ", array(':id' => $k));
			$zkstu[$k]['name'] = $stuinfo['s_name'];
			$zkstu[$k]['icon'] = $stuinfo['icon']?tomedia($stuinfo['icon']):tomedia($school['spic']);
			foreach($zkstu[$k] as $v){
				$kc =  pdo_fetch("SELECT name FROM " . GetTableName('tcourse') . " where id = :id ", array(':id' => $v['kcid']));
				$zkstu[$k]['kcname'] .= $kc['name'];
			}
		}
	}
	include $this->template('teacher/kcbmlist_zs');
}else{
	session_destroy();
	$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
	header("location:$stopurl");
}        
?>