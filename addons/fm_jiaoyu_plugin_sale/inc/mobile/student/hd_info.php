<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
		$schoolid = intval($_GPC['schoolid']);
		$openid = $_W['openid'];
		$op = $_GPC['op'];
		if($op == 'tuan'){
			$word = '拼团';
		}
		if($op == 'zhuli'){
			$word = '助力';
		}
		if($_GPC['userid']){
			$_SESSION['user'] = $_GPC['userid'];
		}
        //查询是否用户登录
		if($_GPC['userid']){
			$_SESSION['user'] = $_GPC['userid'];
		}
		$it = pdo_fetch("SELECT * FROM " . GetTableName('user') . " where id = :id ", array(':id' => $_SESSION['user']));
        if(!empty($it)){
			$school = pdo_fetch("SELECT id,style3,headcolor,is_stuewcode FROM " . tablename($this->table_index) . " where weid = :weid AND id=:id ", array(':weid' => $weid, ':id' => $schoolid));
			$kcinfo = pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " WHERE :id = id", array(':id' => 208));
			
			include $this->template('students/hd_info');
        }else{
			session_destroy();
            $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrls('bangding', array('schoolid' => $schoolid));
			header("location:$stopurl");
        }        
?>