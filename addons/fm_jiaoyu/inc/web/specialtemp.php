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
$kclist = pdo_fetchAll("SELECT tc.id,tc.name,c.sname as kmname FROM " . tablename($this->table_tcourse) . " as tc , ".GetTableName('classify')." as c where tc.schoolid = {$schoolid} and c.sid = tc.km_id ORDER BY id DESC");
$showformHtml = false;
$hasoperateacher = pdo_fetch("SELECT id FROM ".GetTableName('special')." WHERE schoolid = '{$schoolid}' AND FIND_IN_SET('{$tid_global}',tidstr) ");
if($_W['isfounder'] || $_W['role'] == 'owner' || $hasoperateacher){
    $showformHtml = true;
}
if($operation == 'display'){
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 15;
    $condition = '';
    if($_GPC['name']){
        $condition = " AND title LIKE '%{$_GPC['name']}%'";
    }
    $templist = pdo_fetchall("SELECT * FROM " . GetTableName('specialtemp') ." WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . GetTableName('specialtemp') . " WHERE weid = '{$weid}' AND schoolid ={$schoolid}");
    $pager = pagination($total, $pindex, $psize);
}elseif($operation == 'post'){
    mload()->model('tea');
    $list = getalljsfzallteainfo($schoolid,0,$schooltype);
    $list2 = getalljsfzallteainfo_nofz($schoolid,$schooltype);
    $item = pdo_fetch("select * from " . GetTableName('specialtemp') . " where id=:id And weid=:weid And schoolid=:schoolid limit 1", array(":id" => $_GPC['id'], ":weid" => $weid, ':schoolid' => $schoolid));
    $tidstr = $item['tidstr'] ? $item['tidstr'] : '';
    if($tidstr){
        $teachers = pdo_fetchall("SELECT tname FROM ".GetTableName('teachers')." WHERE FIND_IN_SET(id,'{$tidstr}') ");
        $teachers = arrayToString($teachers);
    }
}elseif($operation == 'GetSpContainerList'){
    $id = $_GPC['id'];
    $content = pdo_fetch("SELECT content FROM ".GetTableName('specialtemp')." WHERE id = '{$id}' ")['content'];
    if(!empty($content)){
        $result['data'] = json_decode($content,true);
        $result['status'] = true;
        $result['msg'] = '获取成功';
    }else {
        $result['status'] = false;
        $result['msg'] = '模板不存在或是已删除';
    }
    die(json_encode($result));
}elseif($operation == 'save'){
    $id = $_GPC['id'];
    $check = pdo_fetch("SELECT id FROM ".GetTableName('specialtemp')." WHERE id = '{$id}' ");
    if($_GPC['tidstr']){
        $tidstr = trim($_GPC['tidstr'],',');
    }
    if(!empty($check)){
        $spdata = array(
            'weid'         => $weid,
            'schoolid'     => $schoolid,
            'createtime' => time(),
            'content' => json_encode($_GPC['content']),
            'tidstr' => $tidstr
        );
        pdo_insert(GetTableName('special',false), $spdata);
        $result['status'] = true;
        $result['type'] = 1;
        $result['msg'] = '制作成功';
    }else {
        $data = array(
            'schoolid' => $schoolid,
            'weid' => $weid,
            'createtime' => time(),
            'title' => $_GPC['title'],
            'thumb' => $_GPC['thumb'],
            'tidstr' => $tidstr,
            'content' => json_encode($_GPC['content']),
        );
        pdo_insert(GetTableName('specialtemp',false),$data);
        $result['status'] = true;
        $result['type'] = 0;
        $result['msg'] = '模板库创建成功';
    }
    die(json_encode($result));
}elseif($operation == 'delete'){
    $id     = intval($_GPC['id']);
    $item = pdo_fetch("SELECT id  FROM " . GetTableName('specialtemp') . " WHERE id = '{$id}'");
    if(empty($item)){
        $this->imessage('抱歉，模板不存在或是已经被删除！', referer(), 'error');
    }
    pdo_delete(GetTableName('specialtemp',false), array('id' => $id));
    $this->imessage('删除成功！', referer(), 'success');
}else{
    $this->imessage('请求方式不存在');
}
include $this->template('web/specialtemp');
