<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = $_GPC['schoolid'];
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

if ($operation == 'display') {
    $schoolset = pdo_fetch("SELECT bdall_title as bgtitle FROM " . GetTableName('set') . " where weid = '{$weid}' ");
    include $this->template ( 'login_all' );
}elseif($operation == 'dologin'){
    if (!$_GPC ['weid']) {
        die ( json_encode ( array (
            'result' => false,
            'msg' => '非法请求！'
        ) ) );
    }else{
        $schoolset = pdo_fetch("SELECT bdall_title as bgtitle FROM " . GetTableName('set') . " where weid = '{$weid}' ");
        $data = array();
        $pwd = $_GPC['pwd'];
        $res = pdo_fetch("SELECT bdall_pwdus as pwd FROM " . GetTableName('set') .  " where weid = '{$weid}' ");
        if($pwd === $res['pwd']){
            $_SESSION['pwd'] = $pwd;
		    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('allschool', array('i' => $weid));
            header("location:$stopurl");
            die();
        }
        include $this->template ( 'login_all' );
    }
}
?>