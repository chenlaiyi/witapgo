<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2017-07-11 11:07:51
 * @LastEditTime: 2020-02-26 10:36:22
 */
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */
global $_W, $_GPC;
$weid = $this->weid;
$from_user = $this->_fromuser;
$schoolid = intval($_GPC['schoolid']);
$openid = $_W['openid'];
$id = $_GPC['id'];
$type = $_GPC['type'] ? $_GPC['type'] : 'sp';
$school = pdo_fetch("SELECT style1,spic FROM " . tablename($this->table_index) . " where id=:id ", array(':id' => $schoolid));
$fans = mc_fansinfo($openid); 
//营销宝信息	
if($type == 'sp'){
    $item = pdo_fetch("SELECT * FROM " . GetTableName('special') . " where :id = id", array(':id' => $id));
    $hasform = pdo_fetch("SELECT id FROM ".GetTableName('saleform')." WHERE openid = '{$openid}' AND spid = '{$id}' ");
    $content = json_decode($item['content'],true);
    $sharetitle = $item['sharetitle'];
    $sharedesc = $item['sharedescription'];
    $shareimgUrl = tomedia($item['shareimg']);
    $links = $_W['siteroot'] .'app/'.$this->createMobileUrl('special', array('schoolid' => $schoolid,'id' => $id,'fxzopenid'=>"{$openid}",'type'=>'sp'));

    //最大分享次数
    $maxnum = pdo_fetch("SELECT maxnum FROM ".GetTableName('special')." WHERE schoolid = '{$_GPC['schoolid']}' AND id = '{$_GPC['id']}' ")['maxnum']; 
    $myclicknum = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('clickrecord')." WHERE fxzopenid = :fxzopenid AND spid = :spid",array(':fxzopenid' => $openid,':spid' => $_GPC['id']));
    if($myclicknum >=$maxnum){
        $diff = 0;
    }else{
        $diff = $maxnum - $myclicknum;
    }
    /******************************通过分享点击进来的用户添加一条点击记录*****************************************/
    if($_GPC['fxzopenid']){
        //判断当前用户是否已经点击
        $hasClick = pdo_fetch("SELECT id FROM ".GetTableName('clickrecord')." WHERE schoolid = :schoolid AND openid = :openid AND spid = :spid ",array(':openid'=>"{$openid}",':schoolid'=>$schoolid,':spid'=>$_GPC['id']));
        $welfareid = pdo_fetch("SELECT shareval FROM ".GetTableName('special')." WHERE schoolid = :schoolid AND id = :id ",array(':schoolid'=>$schoolid,':id'=>$_GPC['id']))['shareval'];
        //新增一条点击记录
        if(empty($hasClick)){
            $data = array(
                'weid' => $weid,
                'schoolid' => $schoolid,
                'createtime' => time(),
                'spid' => $_GPC['id'], //营销宝ID
                'fxzopenid' => $_GPC['fxzopenid'],
                'openid' => $_W['openid'],
                'from' => $_GPC['from'],
            );
            pdo_insert(GetTableName('clickrecord',false),$data);
           
            //获取点击后的次数
            $clicknum = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('clickrecord')." WHERE fxzopenid = :fxzopenid AND spid = :spid",array(':fxzopenid' => $_GPC['fxzopenid'],':spid' => $_GPC['id']));
            $hasLog = pdo_fetch("SELECT id FROM ".GetTableName('welfarelog')." WHERE schoolid = '{$_GPC['schoolid']}' AND openid = '{$_GPC['fxzopenid']}' AND spid = '{$_GPC['id']}' "); 
            if($clicknum >= $maxnum){
                if(empty($hasLog)){
                    // 获取分享者的userid和sid
                    $fxz = pdo_fetch("SELECT id,sid FROM ".GetTableName('user')." WHERE openid = '{$_GPC['fxzopenid']}' AND schoolid = '{$_GPC['schoolid']}' AND weid = '{$weid}' AND tid = 0 ");
                    $logData = array(
                        'weid' => $weid,
                        'schoolid' => $schoolid,
                        'createtime' => time(),
                        'spid' => $_GPC['id'], //营销宝ID
                        'welfareid' => $welfareid,
                        'openid' => $_GPC['fxzopenid'],
                        // 'sid' => $fxz['sid'],
                        'userid' => $fxz['id'],
                        'status' => 0,
                    );
                    pdo_insert(GetTableName('welfarelog',false),$logData);
                }
            }
        }
    }
    /******************************通过分享点击进来的用户添加一条点击记录*****************************************/
}elseif($type == 'kc'){
    //分享课程后续增加    
}
include $this->template(''.$school['style1'].'/special');       
?>