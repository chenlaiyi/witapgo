<?php
/*
 * @Discription:  
 * @Author: Hannibal·Lee
 * @Date: 2020-02-22 21:09:50
 * @LastEditTime: 2020-03-26 11:25:28
 */
/**
 * 微教育模块
 *
 * @author it猿工
 * @author Hannibal
 */


function SetEchartsData($title,$type,$is_hole = false,$axis,$series){
    $result = array();
    switch ($type){
        case "bar":
            $result['title'] = $title;
            $result['type'] =array($type);
            $result['axis'] = $axis;
            $result['series'] = $series;
            $result['trigger'] = 'axis';
            $result['ShowYaxis'] = true;
            break;
        case "dubar":
            $result['title'] = $title;
            $result['type'] =array("bar","bar");
            $result['axis'] = $axis;
            $result['series'] = $series;
            $result['trigger'] = 'axis';
            $result['DoubleYaxis'] = true;
            $result['ShowYaxis'] = true;
            break;
        case "line":
            $result['title'] = $title;
            $result['type'] =array($type);
            $result['axis'] = $axis;
            $result['series'] = $series;
            $result['trigger'] = 'axis';
            $result['ShowYaxis'] = true;
            break;
        case "duline":
            $result['title'] = $title;
            $result['type'] =array('line','line');
            $result['axis'] = $axis;
            $result['series'] = $series;
            $result['trigger'] = 'axis';
            $result['ShowYaxis'] = true;
            break;
        case "pie":
            $result['is_hole'] = $is_hole;
            $result['title'] = $title;
            $result['type'] =array($type);
            $result['legend'] =array(
                'show'=>true,
                'right'=>10,
                'orient'=>"vertical"
            );
            $result['series'] = $series;
            $result['trigger'] = 'item';
            break;
        case "rabar":
            break;
    }
    return $result;
};






/**
 * 转换实际表名
 *
 * @param [type] $tablename
 * @param boolean $isFront 是否带前缀
 * @return  string
 */
function GetTableName($tablename , $isFront = true  ){
    if($isFront == true){
        if(empty($GLOBALS['_W']['config']['db']['master'])) {
            return "`{$GLOBALS['_W']['config']['db']['tablepre']}wx_school_{$tablename}`";
        }
        return "`{$GLOBALS['_W']['config']['db']['master']['tablepre']}wx_school_{$tablename}`";
    }elseif($isFront == false ){
        return "wx_school_{$tablename}";
    }
}



function getoauthurl(){
	$oauthurl = $_SERVER ['HTTP_HOST'];
	return $oauthurl;
}

function keep_MC(){
    $oauthurl = getoauthurl();
	if( $oauthurl == "manger.weimeizhan.com" || $oauthurl == 'weixin.cqznl.com' || $oauthurl == 'wx.cqznl.cn')
		return 1;
	else
		return 0;
}




?>