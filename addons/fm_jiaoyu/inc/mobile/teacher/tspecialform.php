<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
$schooltype  = $_W['schooltype'];
$operation = $_GPC['op'] ?  $_GPC['op'] : 'display';
//查询是否用户登录		
$userid = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where :schoolid = schoolid And :weid = weid And :openid = openid And :sid = sid", array(':weid' => $weid, ':schoolid' => $schoolid, ':openid' => $openid, ':sid' => 0), 'id');
$it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where weid = :weid AND id=:id ORDER BY id DESC", array(':weid' => $weid, ':id' => $userid['id']));	
$tid_global = $it['tid'];
$school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ORDER BY ssort DESC", array(':weid' => $weid, ':id' => $schoolid));
$teachers = pdo_fetch("SELECT * FROM " . tablename($this->table_teachers) . " where weid = :weid AND id = :id", array(':weid' => $weid, ':id' => $it['tid']));	
if($operation == 'display'){
    $list = pdo_fetchall("SELECT sf.id,sf.tid,sf.openid,sf.createtime,sf.status,sf.cltime,t.tname FROM " . GetTableName('special') . " as sp , " . GetTableName('saleform') . " as sf LEFT JOIN " . GetTableName('teachers') . " as t ON t.id = sf.tid WHERE FIND_IN_SET('{$teachers['id']}',sp.tidstr) AND sf.spid = sp.id AND sp.weid = '{$weid}' AND sp.schoolid = '{$schoolid}' ORDER BY sf.id LIMIT 0,20");
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
        $list[$index]['cltime'] = date("Y-m-d H:i",$row['cltime']);
    }

    include $this->template(''.$school['style3'].'/tspecialform');	
}elseif($operation == 'scroll_more'){
    $limit = $_GPC['limit'];
    $Ctype = $_GPC['LiData']['ctype'] ;
    $page_start = $limit + 1 ;
    $list = pdo_fetchall("SELECT sf.id,sf.tid,sf.openid,sf.createtime,sf.status,sf.cltime,t.tname FROM " . GetTableName('special') . " as sp , " . GetTableName('saleform') . " as sf LEFT JOIN " . GetTableName('teachers') . " as t ON t.id = sf.tid WHERE FIND_IN_SET('{$teachers['id']}',sp.tidstr) AND sf.spid = sp.id AND sp.weid = '{$weid}' AND sp.schoolid = '{$schoolid}' ORDER BY sf.id LIMIT ".$page_start.",20");
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
        $list[$index]['cltime'] = date("Y-m-d H:i",$row['cltime']);
        $list[$index]['location'] = $index + $page_start;
    }
    include $this->template('comtool/tspecialform');
    exit;
}elseif($operation == 'getinfo'){
    $saleform = pdo_fetch("SELECT content,status FROM " . GetTableName('saleform') . " WHERE schoolid = '{$schoolid}' AND id = '{$_GPC['id']}'");
    $content =unserialize($saleform['content']);
    $result['data'] = $content;
    $result['status'] = $saleform['status'];
    die(json_encode($result));
}elseif($operation == 'save'){
    $data = array(
        'tid' => $teachers['id'],
        'status' => 1,
        'cltime' => time(),
    );
    pdo_update(GetTableName('saleform',false),$data,array('id'=>$_GPC['id']));
    $result['msg'] = '已处理完成';
    $result['status'] = true;
    die(json_encode($result));
}
if(empty($userid['id'])){
    session_destroy();
    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
    header("location:$stopurl");
}		
?>