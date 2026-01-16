<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2020-05-11 16:25:48
 * @LastEditTime: 2020-05-14 16:13:14
 */

global $_GPC, $_W;
$weid              = $_W['uniacid'];
$action            = 'redpacket';
$this1             = 'no4';
$schoolid          = intval($_GPC['schoolid']);
$GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'], $action);
$logo              = pdo_fetch("SELECT logo,title FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
load()->func('tpl');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$tid_global = $_W['tid'];
if($operation == 'display'){
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 15;
    $condition = '';
    if($_GPC['stitle']){
        $conditions = " AND title LIKE '%{$_GPC['title']}%'";
    }
    $list = pdo_fetchall("SELECT * FROM " . GetTableName('welfare') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 1 $conditions ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('welfare') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 1");
    $pager = pagination($total, $pindex, $psize);
}elseif($operation == 'delete'){
    $id     = intval($_GPC['id']);
    $item = pdo_fetch("SELECT id  FROM " . GetTableName('welfare') . " WHERE id = '{$id}'");
    if(empty($item)){
        $this->imessage('抱歉，红包不存在或是已经被删除！', referer(), 'error');
    }
    pdo_delete(GetTableName('welfare',false), array('id' => $id));
    $this->imessage('删除成功!！', referer(), 'success');
}elseif($operation == 'deleteall'){
    $rowcount    = 0;
    $notrowcount = 0;
    foreach($_GPC['idArr'] as $k => $id){
        $id = intval($id);
        if(!empty($id)){
            $item = pdo_fetch("SELECT * FROM " . GetTableName('welfare') . " WHERE id = :id", array(':id' => $id));
            if(empty($item)){
                $notrowcount++;
                continue;
            }else{
				pdo_delete(GetTableName('welfare',false), array('id' => $id));
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
    $item = pdo_fetch("select * from " . GetTableName('welfare') . " where id=:id And weid=:weid And schoolid=:schoolid limit 1", array(":id" => $id, ":weid" => $weid, ':schoolid' => $schoolid));
    $item['thumburl'] = tomedia($item['thumb']);
    $data ['result'] = true;
	$data ['msg'] = "获取成功";
	$data ['data'] = $item;
	die (json_encode($data));
}elseif($operation == 'save'){
    $id = $_GPC['spid'];
    $data = array(
        'weid'          => $weid,
        'schoolid'      => $schoolid,
        'title'         => trim($_GPC['title']),
        'cose'          => trim($_GPC['cose']),
        'maxrange'      => $_GPC['maxrange'],
        'day'           => $_GPC['day'],
        'thumb'         => $_GPC['thumb'],
        'type'          => 1,
        'createtime'    => time(),
    );
    if($id != 0){ //编辑
        $check = pdo_fetch("SELECT id FROM ".GetTableName('welfare')." WHERE id = '{$id}' ");
        if(empty($check)){ //  不存在
            $result['msg'] = '编辑失败，当前红包不存在或是已删除';
        }else{
            pdo_update(GetTableName('welfare',false),$data,array('id'=>$id));
            $result['msg'] = '编辑红包成功！';

        }
    }else { //新增
        pdo_insert(GetTableName('welfare',false),$data);
        $result['msg'] = '新增红包成功！';
    }
    die(json_encode($result));
}elseif($operation == 'record'){
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 15;
    $list = pdo_fetchall("SELECT wl.id,wl.openid,wl.userid,wl.time,wl.usetime,wl.status,w.title as welfaretitle,s.title as sptitle,stu.s_name as usename FROM ".GetTableName('welfarelog')." as wl LEFT JOIN ".GetTableName('welfare')." as w ON wl.welfareid = w.id LEFT JOIN ".GetTableName('special')." as s ON wl.spid = s.id LEFT JOIN ".GetTableName('students')." as stu ON wl.sid = stu.id WHERE wl.schoolid = '{$schoolid}' AND wl.weid = '{$weid}' AND s.marketingtype = 1 ORDER BY wl.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize); 
    foreach ($list as $key => $value) {
        $faninfo = mc_fansinfo($value['openid']);
        $list[$key]['s_name'] = $faninfo['nickname'];
        $list[$key]['icon'] = $faninfo['tag']['avatar'];
        $list[$key]['time'] = $value['time'] ? date("Y-m-d H:i:s",$value['time']): '未领取';
        $list[$key]['usetime'] = $value['usetime'] ? date("Y-m-d H:i:s",$value['usetime']): '未使用';
    }
    $total = pdo_fetchcolumn("SELECT count(wl.id) FROM ".GetTableName('welfarelog')." as wl LEFT JOIN ".GetTableName('special')." as s ON wl.spid = s.id WHERE wl.schoolid = '{$schoolid}' AND wl.weid = '{$weid}' AND s.marketingtype = 1");
    $pager = pagination($total, $pindex, $psize);
}elseif($operation == 'deleteLog'){
    $id     = intval($_GPC['id']);
    $item = pdo_fetch("SELECT id  FROM " . GetTableName('welfarelog') . " WHERE id = '{$id}'");
    if(empty($item)){
        $this->imessage('抱歉，红包记录不存在或是已经被删除！', referer(), 'error');
    }
    pdo_delete(GetTableName('welfarelog',false), array('id' => $id));
    $this->imessage('删除成功!！', referer(), 'success');
}else{
    $this->imessage('请求方式不存在');
}
include $this->template('web/welfare/redpacket');
