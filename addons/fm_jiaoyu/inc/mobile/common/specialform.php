<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
global $_W, $_GPC;
$weid = $_W ['uniacid'];
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
$logid = trim($_GPC['logid']);	
$school = pdo_fetch("SELECT title,style1 FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
$list = pdo_fetchAll("SELECT sf.*,s.title FROM " . GetTableName('saleform') . " as sf LEFT JOIN " . GetTableName('special') . " as s ON sf.spid = s.id WHERE sf.schoolid = '{$schoolid}' AND sf.openid = '{$openid}'");
$newcontent = [];
foreach($list as $key => $row){
    if($row['status'] == 1){
        $list[$key]['tname'] = $row['tid'] == -1 ? "管理员": $row['tname'];
        $list[$key]['cltime'] = date("Y-m-d H:i",$row['cltime']);
    }
    $mcinfo = mc_fansinfo($row['openid']);
    $list[$key]['name'] = $mcinfo['nickname'];
    $list[$key]['icon'] = $mcinfo['tag']['avatar'];
    $list[$key]['createtime'] = date("Y-m-d H:i",$row['createtime']);
    $content= unserialize($row['content']);
    foreach ($content as $k => $value) {
        $title = implode(',',$value['title']);
        
        foreach ($value['content'] as $k1 => $v1) {
            if(is_array($v1)){
                $tempcontent = implode(',',$v1);
            }else{
                $tempcontent = $v1;
            }
        }
        $newcontent[$k] = array(
            'title' => $title,
            'content' => $tempcontent,
        );
    }
    $list[$key]['content'] = $newcontent;
}
include $this->template('common/specialform');
?>