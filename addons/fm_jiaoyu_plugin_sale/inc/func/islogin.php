<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2019-12-07 14:45:37
 * @LastEditTime: 2020-06-16 11:38:33
 */ 
/**
 * By it猿工
 */

function isLogin($weid,$schoolid){
    global $_W, $_GPC;
    if($_GPC['noneed'] == 'noneed'){
        return true;
    }
    if(!$_SESSION['pwd']){
        $url = $this->createMobileUrl('login', array('schoolid' => $schoolid));
        header("Location: {$url}");
    }
}
?>