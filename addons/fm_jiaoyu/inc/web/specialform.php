<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
global $_GPC, $_W;

$weid = $_W['uniacid'];
$action = 'special';
$this1 = 'no2';
$GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'],$action);
$schoolid = intval($_GPC['schoolid']);
$logo = pdo_fetch("SELECT logo,title FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
$checkNowTime = strtotime(date("Y-m-d",time()));
$kcall = pdo_fetchall("SELECT * FROM " . tablename($this->table_tcourse) . " where schoolid ='{$schoolid}' and weid = '{$weid}' and end > $checkNowTime ");
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$tid_global = $_W['tid'];
$showformHtml = false;
$hasoperateacher = pdo_fetch("SELECT id FROM ".GetTableName('special')." WHERE schoolid = '{$schoolid}' AND FIND_IN_SET('{$tid_global}',tidstr) ");
if($_W['isfounder'] || $_W['role'] == 'owner' || $hasoperateacher){
    $showformHtml = true;
}
if ($operation == 'display') { //默认
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $list = pdo_fetchall("SELECT sf.*,t.tname FROM " . GetTableName('saleform') . " as sf LEFT JOIN " . GetTableName('teachers') . " as t ON t.id = sf.tid WHERE sf.weid = '{$weid}' AND sf.schoolid = '{$schoolid}' ORDER BY sf.id LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    foreach($list as $index => $row){
        if($row['tid'] == -1){
            $list[$index]['tname'] = '管理员';
        }else{
            $list[$index]['tname'] = $row['status'] == 1 ? $row['tname'] : "未处理";
        }
        $mcinfo = mc_fansinfo($row['openid']);
        $list[$index]['name'] = $mcinfo['nickname'];
        $list[$index]['icon'] = $mcinfo['tag']['avatar'];
        $list[$index]['createtime'] = date("Y-m-d H:i",$row['createtime']);
        $list[$index]['cltime'] = $row['cltime'] ? date("Y-m-d H:i",$row['cltime']) : '未处理';
    }
    $total = pdo_fetchcolumn("SELECT count(id) FROM " . GetTableName('saleform') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'");
    $pager = pagination($total, $pindex, $psize);
} elseif($operation == 'delete'){
    $id = intval($_GPC['id']);
    $schoolid = intval($_GPC['schoolid']);
    pdo_fetch("SELECT * FROM " . GetTableName('saleform') . " WHERE id = :id", array(':id' => $id));
    pdo_delete(GetTableName('saleform',false), array('id' => $id));
    $this->imessage('删除成功！', $this->createWebUrl('saleform', array('op' => 'display', 'schoolid' => $schoolid)), 'success');
} elseif($operation == 'deleteall'){
    $rowcount    = 0;
    $notrowcount = 0;
    foreach($_GPC['idArr'] as $k => $id){
        $id = intval($id);
        if(!empty($id)){
            pdo_delete(GetTableName('saleform',false), array('id' => $id));
            $rowcount++;
        }
    }
    $message = "操作成功！共删除{$rowcount}条数据!";
    $data ['result'] = true;
    $data ['msg'] = $message;
    die (json_encode($data));
} elseif($operation == 'getInfo'){
    $saleform = pdo_fetch("SELECT content,status FROM " . GetTableName('saleform') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND id = '{$_GPC['id']}'");
    $content =unserialize($saleform['content']);
    $result['data'] = $content;
    $result['status'] = $saleform['status'];
    die(json_encode($result));
} elseif($operation == 'save'){
    $tid_global = is_numeric($tid_global) ? $tid_global : -1;
    $data = array(
        'tid' => $tid_global,
        'status' => 1,
        'cltime' => time(),
    );
    pdo_update(GetTableName('saleform',false),$data,array('id'=>$_GPC['id']));
    $result['msg'] = '已处理完成';
    $result['status'] = true;
    die(json_encode($result));
}
include $this->template ( 'web/specialform' );
?>