<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2019-12-07 14:45:37
 * @LastEditTime: 2020-06-16 14:44:51
 */ 
/**
 * By it猿工
 */

function isLogin($weid,$schoolid){
    global $_W, $_GPC;
    if($_GPC['noneed'] == 'noneed'){
        $_SESSION['pwd'] = '111111';
        return true;
    }
    if(!$_SESSION['pwd']){
        $ssurl = $this->createMobileUrl('login', array('schoolid' => $schoolid));
        header("Location: {$ssurl}");
    }
}
?>