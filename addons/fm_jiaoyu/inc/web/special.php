<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2020-05-11 16:25:48
 * @LastEditTime: 2020-05-14 16:13:14
 */

global $_GPC, $_W;
$weid              = $_W['uniacid'];
$action            = 'special';
$this1             = 'no2';
$schoolid          = intval($_GPC['schoolid']);
$GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'], $action);
$logo              = pdo_fetch("SELECT logo,title FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
load()->func('tpl');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$tid_global = $_W['tid'];
$welfare = pdo_fetchAll("SELECT * FROM " . GetTableName('welfare') . " where schoolid = {$schoolid} ORDER BY id DESC");

$showformHtml = false;
$hasoperateacher = pdo_fetch("SELECT id FROM ".GetTableName('special')." WHERE schoolid = '{$schoolid}' AND FIND_IN_SET('{$tid_global}',tidstr) ");
if($_W['isfounder'] || $_W['role'] == 'owner' || $hasoperateacher){
    $showformHtml = true;
}
$kclist = pdo_fetchAll("SELECT tc.id,tc.name,c.sname as kmname FROM " . tablename($this->table_tcourse) . " as tc , ".GetTableName('classify')." as c where tc.schoolid = {$schoolid} and c.sid = tc.km_id ORDER BY id DESC");
if($operation == 'display'){
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 15;
    $list = pdo_fetchall("SELECT s.*,(SELECT count(id) FROM " . GetTableName('clickrecord') ." as c WHERE c.spid = s.id) as clicknum,(SELECT shtime FROM " . GetTableName('sharerecord') ." as sh WHERE sh.spid = s.id) as shtime FROM " . GetTableName('special') . " as s WHERE s.weid = '{$weid}' AND s.schoolid = '{$schoolid}' ORDER BY s.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    foreach ($list as $key => $value) {
        if(time() < $value['start']){
            $list[$key]['status'] = rund_color(0);
            $list[$key]['statusName'] = '未开始';
        }elseif(time() > $value['end']){
            $list[$key]['status'] = rund_color(4);
            $list[$key]['statusName'] = '已结束';
        }else{
            $list[$key]['status'] = rund_color(1);
            $list[$key]['statusName'] = '进行中';
        }
    }
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . GetTableName('special') . " WHERE weid = '{$weid}' AND schoolid ={$schoolid}");

    $pager = pagination($total, $pindex, $psize);
}elseif($operation == 'post'){
    mload()->model('tea');
    $list = getalljsfzallteainfo($schoolid,0,$schooltype);
    $list2 = getalljsfzallteainfo_nofz($schoolid,$schooltype);
    $id = intval($_GPC['id']);
    $item = pdo_fetch("select * from " . GetTableName('special') . " where id=:id And weid=:weid And schoolid=:schoolid limit 1", array(":id" => $id, ":weid" => $weid, ':schoolid' => $schoolid));
    $tidstr = $item['tidstr'] ? $item['tidstr'] : '';
    if($tidstr){
        $teachers = pdo_fetchall("SELECT tname FROM ".GetTableName('teachers')." WHERE FIND_IN_SET(id,'{$tidstr}') ");
        $teachers = arrayToString($teachers);
    }
    if(checksubmit('submit')){
        $data = array(
            'weid'         => intval($weid),
            'schoolid'     => $schoolid,
            'title'         => $_GPC['title'],
            'sharetitle'         => $_GPC['sharetitle'],
            'shareimg'         => $_GPC['shareimg'],
            'sharedescription'         => $_GPC['sharedescription'],
            'createtime' => time(),
        );
        if(!empty($id)){
            pdo_update(GetTableName('special',false), $data, array('id' => $id));
        }else{
            pdo_insert(GetTableName('special',false), $data);
        }
        $this->imessage('操作成功', $this->createWebUrl('special', array('op' => 'display', 'schoolid' => $schoolid)), 'success');
    }
}elseif($operation == 'delete'){
    $id     = intval($_GPC['id']);
    $item = pdo_fetch("SELECT id  FROM " . GetTableName('special') . " WHERE id = '{$id}'");
    if(empty($item)){
        $this->imessage('抱歉，营销宝不存在或是已经被删除！', referer(), 'error');
    }
    pdo_delete(GetTableName('special',false), array('id' => $id));
    $this->imessage('删除成功!！', referer(), 'success');
}elseif($operation == 'deleteall'){
    $rowcount    = 0;
    $notrowcount = 0;
    foreach($_GPC['idArr'] as $k => $id){
        $id = intval($id);
        if(!empty($id)){
            $item = pdo_fetch("SELECT * FROM " . GetTableName('special') . " WHERE id = :id", array(':id' => $id));
            if(empty($item)){
                $notrowcount++;
                continue;
            }else{
				pdo_delete(GetTableName('special',false), array('id' => $id));
				$rowcount++;
			}
        }
    }
	$message = "操作成功！共删除{$rowcount}条数据,{$notrowcount}条数据不能删除!";
	$data ['result'] = true;
	$data ['msg'] = $message;
	die (json_encode($data));
}elseif($operation == 'editSp'){
    $id = intval($_GPC['id']);
    $item = pdo_fetch("select * from " . GetTableName('special') . " where id=:id And weid=:weid And schoolid=:schoolid limit 1", array(":id" => $id, ":weid" => $weid, ':schoolid' => $schoolid));
    $item['shareimgurl'] = tomedia($item['shareimg']);
    $item['start'] = date('Y-m-d',$item['start']);
    $item['end'] = date('Y-m-d',$item['end']);
    $data ['result'] = true;
	$data ['msg'] = "获取成功";
	$data ['data'] = $item;
	die (json_encode($data));
}elseif($operation == 'saveSp'){
    $id = $_GPC['spid'];
    if($_GPC['marketingtype'] == 3){ //赠送积分
        $shareval = $_GPC['sharescore'];
    }elseif($_GPC['marketingtype'] == 1){ //赠送红包
        $shareval = $_GPC['redpacketid'];
    }elseif($_GPC['marketingtype'] == 2){ //赠送优惠券
        $shareval = $_GPC['couponid'];
    }
    $data = array(
        'weid'             => $weid,
        'schoolid'         => $schoolid,
        'title'            => trim($_GPC['title']),
        'sharetitle'       => trim($_GPC['sharetitle']),
        'shareimg'         => $_GPC['shareimg'],
        'sharedescription' => $_GPC['sharedescription'],
        'shareval'     => $shareval,
        'maxnum'           => $_GPC['maxnum'],
        'createtime'       => time(),
        'start'       => strtotime($_GPC['activetime']['start']),
        'end'       => strtotime($_GPC['activetime']['end'])+86399,
        'marketingtype'       => $_GPC['marketingtype']
    );
    // dd($_GPC);
    if($id != 0){ //编辑
        $check = pdo_fetch("SELECT id FROM ".GetTableName('special')." WHERE id = '{$id}' ");
        if(empty($check)){ //  不存在
            $result['msg'] = '编辑失败，当前营销宝不存在或是已删除';
        }else{
            pdo_update(GetTableName('special',false),$data,array('id'=>$id));
            $result['msg'] = '编辑营销宝成功！';

        }
    }else { //新增
        pdo_insert(GetTableName('special',false),$data);
        $result['msg'] = '新增营销宝成功！';
    }
    die(json_encode($result));
}elseif($operation == 'GetKcInfo'){
    $id = $_GPC['id'];
    $kcinfo = pdo_fetch("SELECT id,name,start,end,km_id FROM ".GetTableName('tcourse')." WHERE id = '{$id}' ");
    $km = pdo_fetch("SELECT sname FROM ".GetTableName('classify')." WHERE sid = '{$kcinfo['km_id']}' ")['sname'];
    $coursebuy = pdo_fetchall("SELECT sid FROM ".GetTableName('coursebuy')." WHERE kcid = '{$id}' LIMIT 5 ");
    $buystu = [];
    foreach ($coursebuy as $key => $value) {
        $student = pdo_fetch("SELECT icon FROM ".GetTableName('students')." WHERE id = '{$value['sid']}' "); 
        $buystu[$key] = tomedia($student['icon']);
    }
    $buynum = pdo_fetchcolumn("SELECT count(sid) FROM ".GetTableName('coursebuy')." WHERE kcid = '{$id}'");

    $kcinfo['startdate'] = date("m月d日",$kcinfo['start']);
    $kcinfo['starttime'] = date("H:i",$kcinfo['start']);
    $kcinfo['enddate'] = date("m月d日",$kcinfo['end']);
    $kcinfo['endtime'] = date("H:i",$kcinfo['end']);
    $kcinfo['buynum'] = $buynum;
    $kcinfo['buystu'] = $buystu;
    $kcinfo['km'] = $km;
    $result['data'] = $kcinfo;
    die(json_encode($result));
}elseif($operation == 'GetKcList'){
    $kclist = pdo_fetchAll("SELECT tc.id,tc.name,c.sname as kmname FROM " . tablename($this->table_tcourse) . " as tc , ".GetTableName('classify')." as c where tc.schoolid = {$schoolid} and c.sid = tc.km_id ORDER BY id DESC");
    die(json_encode($kclist));
}elseif($operation == 'save'){
    $id = $_GPC['id'];
    $check = pdo_fetch("SELECT id FROM ".GetTableName('special')." WHERE id = '{$id}' ");
    if(!empty($check)){
        if($_GPC['tidstr']){
            $tidstr = trim($_GPC['tidstr'],',');
        }
        $data = array(
            'content' => json_encode($_GPC['content']),
            'tidstr' => $tidstr
        );
        // dd($data);
        pdo_update(GetTableName('special',false),$data,array('id'=>$id));
        $result['status'] = true;
        $result['msg'] = '保存成功';
    }else {
        // $data = array(
        //     'schoolid' => $schoolid,
        //     'weid' => $weid,
        //     'title' => $_GPC['title'],
        //     'thumb' => $_GPC['thumb'],
        //     'createtime' => time(),
        //     'content' => json_encode($_GPC['content']),
        // );
        // pdo_insert(GetTableName('specialtemp',false),$data);
        $result['status'] = true;
        $result['msg'] = '模板库创建成功';
    }
    die(json_encode($result));
}elseif($operation == 'GetSpContainerList'){
    $id = $_GPC['id'];
    $Data = pdo_fetch("SELECT content,id FROM ".GetTableName('special')." WHERE id = '{$id}' ");
    // var_dump(json_decode($Data['content'],true));
    // die();
    if(!empty($Data)){
        $result['data'] = json_decode($Data['content'],true);
        $result['status'] = true;
        $result['msg'] = '获取成功';
    }else {
        $result['status'] = false;
        $result['msg'] = '营销宝不存在或是已删除';
    }
    die(json_encode($result));
}else{
    $this->imessage('请求方式不存在');
}
include $this->template('web/special');
