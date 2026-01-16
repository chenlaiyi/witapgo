<?php
    global $_W, $_GPC;
    $weid = $_W ['uniacid'];
    $schoolid = intval($_GPC['schoolid']);
    $openid = $_W['openid'];
    $type = $_GPC['type'];
    $it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where id = :id And openid = :openid ", array(':id' => $_SESSION['user'],':openid' => $openid));
    $school = pdo_fetch("SELECT style2 FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
    $student = pdo_fetch("SELECT s_name,bj_id FROM " . tablename($this->table_students) . " where id = :id AND schoolid = :schoolid ", array(':id' => $it['sid'], ':schoolid' => $schoolid));
    if(!empty($it)){
        if($type == '1'){ //红包
            $title = '我的红包';
        }
        if($type == '2'){ //红包
            $title = '我的优惠券';
        }
        $list = pdo_fetchall("SELECT wf.id,wf.usetime,wf.status,wf.time,w.title,w.cose,w.maxrange,w.day,w.thumb  FROM ".GetTableName('welfarelog')." as wf LEFT JOIN " . GetTableName('welfare') . " as w ON wf.welfareid = w.id WHERE wf.schoolid = '{$schoolid}' AND wf.openid = '{$openid}' AND w.type = '{$type}' ORDER BY w.id DESC ");
        include $this->template($school['style2'].'/mywelfare');
    }else{
        session_destroy();
        $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
        header("location:$stopurl");
        exit;
    }        
?>