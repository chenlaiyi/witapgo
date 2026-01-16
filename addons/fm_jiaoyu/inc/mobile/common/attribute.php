<?php
/**
 * 微教育模块
 *
 * @author CC
 */
    global $_W, $_GPC;
    $weid = $this->weid;
    $from_user = $this->_fromuser;
    $schoolid = intval($_GPC['schoolid']);
    $openid = $_W['openid'];

    
    $istea = false;
    if($_GPC['fztid']){
        $istea = true;
        //查询是否用户登录		
        $userid = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where :schoolid = schoolid And :weid = weid And :openid = openid And :sid = sid", array(':weid' => $weid, ':schoolid' => $schoolid, ':openid' => $openid, ':sid' => 0), 'id');
        $it = pdo_fetch("SELECT * FROM " . tablename($this->table_user) . " where weid = :weid AND id=:id ORDER BY id DESC", array(':weid' => $weid, ':id' => $userid['id']));	
    }else{
        $it = pdo_fetch("SELECT sid FROM " . tablename($this->table_user) . " where id = :id And openid = :openid ", array(':id' => $_SESSION['user'],':openid' => $openid));
    }
    if(!$it){
        session_destroy();
        $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bangding', array('schoolid' => $schoolid));
        header("location:$stopurl");
        exit;
    }
    include $this->template('common/attribute');        
?>