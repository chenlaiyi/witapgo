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
    $schoolset = pdo_fetch("SELECT bgtitle FROM " . tablename('wx_school_schoolset') . " where weid = '{$weid}' AND schoolid = '{$schoolid}'");
    include $this->template ( 'login' );

}elseif($operation == 'dologin'){
    if (!$_GPC ['weid']) {
        die ( json_encode ( array (
            'result' => false,
            'msg' => '非法请求！'
        ) ) );
    }else{
        $data = array();
        $pwd = md5($_GPC['pwd']);
        $res = pdo_fetch("SELECT pwd FROM " . tablename('wx_school_schoolset') . " where weid = '{$_GPC['weid']}' AND schoolid = '{$_GPC ['schoolid']}'");
        if($pwd === $res['pwd']){
            $_SESSION['pwd'] = $pwd;
		    $stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('bdindex', array('i' => $_GPC['weid'],'schoolid' => $schoolid));
			header("location:$stopurl");
        }
        include $this->template ( 'login' );
    }
}
?>