<?php
/**
 * 微教育模块
 * 
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$action = 'school';
$title  = '学校管理';
$url    = $this->createWebUrl($action, array('op' => 'display'));
$schooltype = pdo_fetchall("SELECT * FROM " . tablename('wx_school_type') . " where weid = '{$weid}' ORDER BY ssort DESC");
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$item = pdo_fetch("SELECT id,bd_set,sms_use_times,baidumapapi,bdall_title,bdall_centerpoint,bdall_in_school FROM " . GetTableName('set') . " WHERE weid = :weid ",array(':weid' => $weid));
$sclist = $item['bdall_in_school'];
$AllPoint = pdo_fetchall("SELECT lng as y,lat as x , id as schoolid FROM ".GetTableName('index')." WHERE  weid = '{$weid}'  and id IN ({$sclist}) ");


if( $_SERVER['HTTP_HOST'] == "manger.weimeizhan.com" || $_SERVER['HTTP_HOST'] == 'wx.cqznl.cn'){
    $keep_MC = true;
}else{
    $keep_MC = false;
}

if ($operation == 'display') {
    //中心坐标点
    $cpoint = json_decode($item['bdall_centerpoint'],true);
    //教师总数
    $jszj = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_teachers') . " WHERE weid = '{$weid}' and schoolid IN ({$sclist}) ");
    $ybjs = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_user') . " WHERE weid = '{$weid}' AND sid = 0 and schoolid IN ({$sclist}) ");
     //学生总数
     $allstu  = pdo_fetchcolumn("select COUNT(*) FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}' and schoolid IN ({$sclist}) ");
     //已绑学生数
     $ybstu  = pdo_fetchcolumn("select COUNT(id) FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}' and  ( own != '0' or mom != '0' or dad != '0' or other != '0' ) and schoolid IN ({$sclist})  ");
     //总收入
     $allmoney = pdo_fetchcolumn("SELECT sum(cose) FROM " . tablename('wx_school_order') . "WHERE weid = '{$weid}' AND schoolid IN ({$sclist}) and status = 2 ");

    //校园动态
    $lasttz = pdo_fetchall("SELECT * FROM ".tablename('wx_school_notice')." WHERE weid = '{$weid}' And schoolid IN ({$sclist}) ORDER BY createtime DESC LIMIT 3,15");
    foreach($lasttz as $key => $row){
        $school = pdo_fetch("SELECT tpic,title,issale FROM ".GetTableName('index')." WHERE id = '{$row['schoolid']}' ");
        if($school['issale'] == 1){ //培训模式
            $bj = pdo_fetch("SELECT name as sname FROM " . GetTableName('tcourse') . " WHERE id = :id", array(':id' => $row['kc_id']));
        }else{ //公立模式
            $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $row['bj_id']));
        }
       
        $ls = pdo_fetch("SELECT thumb,tname FROM " . tablename('wx_school_teachers') . " WHERE id = :id", array(':id' => $row['tid']));
        $lasttz[$key]['bjname'] = $bj['sname'];
        $lasttz[$key]['thumb'] = $ls['thumb']?$ls['thumb']:$school['tpic'];
        $lasttz[$key]['tname'] = $ls['tname'];
        $lasttz[$key]['school'] = $school['title'];
        $lasttz[$key]['issale'] = $school['issale'];
        $lasttz[$key]['scolor'] = $school['issale'] == 1 ? "#9a860aa1" : "#0a9a84a1";

    }
    $lastxxtzid = $lasttz[0]['id']?$lasttz[0]['id']:0;
    include $this->template ( 'web/allschool' );
}elseif($operation == 'firstdata'){
    //教师总数
    $jszj = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_teachers') . " WHERE weid = '{$weid}'");
    //已绑教师
    $ybjs = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_user') . " WHERE weid = '{$weid}' AND sid = 0");
    //学生总数
    $allstu  = pdo_fetchcolumn("select COUNT(*) FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}'");
    //已绑学生数
    $ybstu  = pdo_fetchcolumn("select COUNT(id) FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}' and  ( own != '0' or mom != '0' or dad != '0' or other != '0' ) ");
    /*
     * 学校区域统计 
     *
     * */
    $schoollist = pdo_fetchAll("SELECT a.name,count(i.id) as total FROM " . tablename('wx_school_index') . "as i, ". tablename('wx_school_area'). " as a where i.areaid = a.id and i.weid = '{$weid}' group by i.areaid ");
    foreach ($schoollist as $k => $v){
        $school_series[$k]['name'] = $schoollist[$k]['name'];
        $school_series[$k]['value'] = $schoollist[$k]['total'];
    }
    $school_series_data[0]['name'] = '数量';
    $school_series_data[0]['data'] = $school_series;
    $new_school_series_data = SetEchartsData("学校数量","pie",false,0,$school_series_data);
  
    
    /*
     * 学校课程统计
     *
     * */
    $kc = pdo_fetchAll("SELECT i.title,count(t.id) as total FROM " . tablename('wx_school_index') . "as i left join ". tablename('wx_school_tcourse'). " as t on  i.id = t.schoolid where i.weid = '{$weid}' group by i.title");
    foreach ($kc as $k => $v){
        $kc_series[$k]['name'] = $kc[$k]['title'];
        $kc_series[$k]['value'] = $kc[$k]['total'];
    }
    $kc_series_data[0]['name'] = '课程';
    $kc_series_data[0]['data'] = $kc_series;
    $new_kc_series_data = SetEchartsData("课程统计","pie",false,0,$kc_series_data);

    /*
     * 考勤卡统计
     *
     * */
    $kqk = pdo_fetchAll("SELECT i.title,count(c.id) as total FROM " . tablename('wx_school_index') . "as i left join ". tablename('wx_school_idcard'). " as c  on  i.id = c.schoolid where i.weid = '{$weid}' group by i.title");
    foreach ($kqk as $k => $v){
        $kqk_series[$k]['name'] = $kqk[$k]['title'];
        $kqk_series[$k]['value'] = $kqk[$k]['total'];
    }
    $kqk_series_data[0]['name'] = '数量';
    $kqk_series_data[0]['data'] = $kqk_series;
    $new_kqk_series_data = SetEchartsData("考勤卡","pie",false,0,$kqk_series_data);

    /*
     * 学校类型统计
     *
     * */
    $shoptype = pdo_fetchAll("SELECT t.name,count(i.id) as total FROM " . tablename('wx_school_index') . "as i, ". tablename('wx_school_type'). " as t where i.typeid = t.id and i.weid = '{$weid}' group by i.typeid");
    foreach ($schoollist as $k => $v){
        $shoptype_series[$k]['name'] = $shoptype[$k]['name'];
        $shoptype_series[$k]['value'] = $shoptype[$k]['total'];
    }
    $shoptype_series_data[0]['name'] = '类型';
    $shoptype_series_data[0]['data'] = $shoptype_series;
    $new_shoptype_series_data = SetEchartsData("学校类型","pie",false,0,$shoptype_series_data);

    /*
     * 学校人数统计
     *
     * */
    $TSCount= array(
        'AllTeaNum' => $jszj,
        'AllStuNum' => $allstu,
        'TeaBDNum' => $ybjs,
        'StuBDNum' => $ybstu,
    );

    $stusexcount  = pdo_fetch("select sum(case when sex='1' then 1 else 0 end) as boy ,sum(case when sex != '1' then 1 else 0 end) as girl FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}' AND schoolid IN ({$sclist})  ");
    $stusex_series = array();
    $stusex_series[0]['name'] = '人数';
    $stusex_seriesdata = array();
    $stusex_seriesdata[0]['name'] = '男生';
    $stusex_seriesdata[0]['value'] = $stusexcount['boy'];
    $stusex_seriesdata[1]['name'] = '女生';
    $stusex_seriesdata[1]['value'] = $stusexcount['girl'];
    $stusex_series[0]['data'] = $stusex_seriesdata;
    $stusex = SetEchartsData("学生性别比例","pie",true,0,$stusex_series);

    //教师性别比例
    $teasexcount  = pdo_fetch("select sum(case when sex='1' then 1 else 0 end) as male ,sum(case when sex != '1' then 1 else 0 end) as female FROM ".tablename('wx_school_teachers')." WHERE weid = '{$weid}' AND schoolid IN ({$sclist})   ");
    $teasex_series = array();
    $teasex_series[0]['name'] = '人数';
    $teasex_seriesdata = array();
    $teasex_seriesdata[0]['name'] = '男性';
    $teasex_seriesdata[1]['name'] = '女性';
    $teasex_seriesdata[0]['value'] = $teasexcount['male'];
    $teasex_seriesdata[1]['value'] = $teasexcount['female'];
    $teasex_series[0]['data'] = $teasex_seriesdata;
    $teasex = SetEchartsData("教师性别比例","pie",true,0,$teasex_series);

 /*    //交互功能使用率
    $bjq = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_bjq') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist})   ");
    $bm = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_signup') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist})   ");
    $xc = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_media') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist})  And type = 2  ");
    $tz = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_notice') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist})   ");
    $ly = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist})  And isliuyan = 2 And isfrist = 1  ");
    $qj = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist})  And isliuyan = 0  ");

    $jhgn_series_data = array(
        0 => array('name' => '班级圈', 'value' => $bjq),
        1 => array('name' => '通知公告', 'value' => $tz),
        2 => array('name' => '在线留言', 'value' => $ly),
        3 => array('name' => '相册', 'value' => $xc),
        4 => array('name' => '在线请假', 'value' => $qj)
    );

    $jhgn_series = array();
    $jhgn_series[0]['name'] = '次数';
    $jhgn_series[0]['data'] = $jhgn_series_data;
    $jhgn = SetEchartsData("交互功能使用比例","pie",false,0,$jhgn_series);
 */

    $nowday = strtotime(date("Y-m-d",time()));
    $tiwennum = [];
    for($i=13;$i>=0;$i--){
        $first= $nowday-$i*86400;
        $last = $nowday-$i*86400 + 86399;
        //当日体温测量人数
        $AllCount = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('yqdk') . " WHERE weid = '{$weid}' AND (createtime BETWEEN '{$first}' AND '{$last}') AND schoolid IN ({$sclist})");
        //当日体温正常人数
        $normal = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('yqdk') . " WHERE weid = '{$weid}' AND (createtime BETWEEN '{$first}' AND '{$last}') AND (tiwen BETWEEN '35.5' AND '37.5') AND schoolid IN ({$sclist})");
         
        $tiwennum[$i]['createdate'] = date("d日",$first);
        $tiwennum[$i]['normal'] = $normal;
        $tiwennum[$i]['notnormal'] = $AllCount - $normal;
    }
    $createdate = array_values(array_column($tiwennum,'createdate'));//每天的日期
    $newnormal = array_values(array_column($tiwennum,'normal'));//每天打卡总人数
    $newnotnormal = array_values(array_column($tiwennum,'notnormal'));//每天打卡总人数

    $payment_year_data = array(
        'xaixs' => $createdate,
        'series' => $newnormal,
        'series1' => $newnotnormal
    );
    $payment_year_axis = array(
        'xAxis' =>array(
            'name' => '日期',
            'data' => $payment_year_data['xaixs']
        ),
        'yAxis' =>array(
            0=>array('name' => '人数'),
            1=>array('name' => '比例:%'),
        ),
    );
    $annual_income[0]['name'] = '正常数';
    $annual_income[0]['data'] = $payment_year_data['series'];
    $annual_income[0]['color'] = "#54ade680";
    $annual_income[1]['name'] = '不正常数';
    $annual_income[1]['data'] = $payment_year_data['series1'];
    $annual_income[1]['color'] = "red";
    $jhgn = SetEchartsData("14日体温统计","duline",false,$payment_year_axis,$annual_income);
 /*
     * 文章统计
     */
    //校园公告
    $article = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_news') . " WHERE weid = '{$weid}' And schoolid IN ({$sclist}) And type = 'article' ORDER BY createtime DESC");

    //校园新闻
    $news = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_news') . " WHERE weid = '{$weid}' And schoolid IN ({$sclist}) And type = 'news' ORDER BY createtime DESC");

    //精选文章
    $wenzhang = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_news') . " WHERE weid = '{$weid}' And schoolid IN ({$sclist}) And type = 'wenzhang' ORDER BY createtime DESC");

    $new_news_total = array(
        array(
            '0'=>'校园公告',
            '1'=>'校园新闻',
            '2'=>'精选文章',
        ),
        array(
            '0'=>$article['total'],
            '1'=>$news['total'],
            '2'=>$wenzhang['total'],
        ),
    );
    $news_series = array();
    $news_series[0]['name'] = '次数';
    $news_seriesdata = array(
        0 =>array('name'=>'校园公告','value'=>$article['total']),
        1 =>array('name'=>'校园新闻','value'=>$news['total']),
        2 =>array('name'=>'精选文章','value'=>$wenzhang['total']),
    );

    $news_series[0]['data'] = $news_seriesdata;
    $new_news_data = SetEchartsData("文章统计","pie",false,0,$news_series);




    $return_data = array(
  
        'middleNum' => $TSCount,
        'AllPoint' => $AllPoint,
        'teasex' => $teasex,
        'stusex' => $stusex,
        'jhgn' =>$jhgn,
        'new_news_data' =>$new_news_data,



    );
    die(json_encode($return_data));


}elseif($operation == 'GetSchoolInfo'){
    $schoolid = $_GPC['schoolid'];
    $result['SchInfo'] = pdo_fetch("SELECT address,tel,title,logo,issale FROM ".GetTableName('index')." WHERE id = '{$schoolid}' ");
    $result['stuc']  = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('students')." WHERE schoolid = '{$schoolid}' ");
    $result['teac']  = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('teachers')." WHERE schoolid = '{$schoolid}' ");


    $todaystart = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $todayend = $todaystart + 86399;
    $Tcheck = pdo_fetchcolumn("SELECT count(distinct tid) FROM ".GetTableName('checklog')." WHERE schoolid = '{$schoolid}' and tid != 0 and sid = 0 and createtime > '{$todaystart}' and createtime < '{$todayend}' and leixing = 1 ");
    $Scheck = pdo_fetchcolumn("SELECT count(distinct sid) FROM ".GetTableName('checklog')." WHERE schoolid = '{$schoolid}' and tid = 0 and sid != 0 and createtime > '{$todaystart}' and createtime < '{$todayend}' and sc_ap = 0 and isconfirm = 1 and leixing = 1  ");

    $result['SchInfo']['logo'] = tomedia($result['SchInfo']['logo']);
    $result['SchInfo']['schooltype'] = $result['SchInfo']['issale'] == 1 ? '培训模式' : '公立模式';

    $result['SchInfo']['Tcheck'] = $Tcheck;
    $result['SchInfo']['Scheck'] = $Scheck;
    $result['SchInfo']['tpre'] = $result['teac'] == 0 ? 0 : round($Tcheck / $result['teac'] ,2) + '%' ;
    $result['SchInfo']['spre'] = $result['stuc'] == 0 ? 0 : round($Scheck / $result['stuc'] ,2) + '%';
    die(json_encode($result));
}elseif($operation == 'ajaxdata'){
    $todaystart = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $todayend = $todaystart + 86399;
    $lastxxtzid = $_GPC['xxtzid'];
    //校园动态
    $lasttz = pdo_fetch("SELECT id,bj_id,tid,ismobile,tname,title,createtime,type,schoolid,kc_id FROM ".tablename('wx_school_notice')." WHERE weid = '{$weid}' And schoolid IN ({$sclist}) and id > '{$lastxxtzid}' ORDER BY id ASC ");
    if(!empty($lasttz)){
        $result['lasttz']['check'] = true;
        $school = pdo_fetch("SELECT tpic,title,issale FROM ".GetTableName('index')." WHERE id = '{$lasttz['schoolid']}' ");
        if($school['issale'] == 1){ //培训模式
            $bj = pdo_fetch("SELECT name as sname FROM " . GetTableName('tcourse') . " WHERE id = :id", array(':id' => $lasttz['kc_id']));
        }else{ //公立模式
            $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $lasttz['bj_id']));
        }
        $ls = pdo_fetch("SELECT thumb FROM " . tablename('wx_school_teachers') . " WHERE id = :id", array(':id' => $lasttz['tid']));
        $lasttz['bjname'] = $bj['sname'] ? $bj['sname'] : '' ;
        $thumb= $ls['thumb']?$ls['thumb']:$school['tpic'];
        $lasttz['thumb'] = tomedia($thumb);
        $lasttz['school'] = $school['title'];
        $lasttz['issale'] = $school['issale'];
        $lasttz['scolor'] = $school['issale'] == 1 ? "#9a860aa1" : "#0a9a84a1";
        $lasttz['createtime'] = date("Y-m-d H:i",$lasttz['createtime']);
        $result['lasttz']['data'] = $lasttz;
    }else{
        $result['lasttz']['check'] = false;
        $result['lasttz']['data']['id'] = $lastxxtzid;
    }
    $tea_check_count =  pdo_fetchcolumn("SELECT COUNT(distinct tid) FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist}) and  leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid = 0 and tid != 0  AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");
    $stu_check_count =  pdo_fetchcolumn("SELECT COUNT(distinct sid) FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid IN ({$sclist}) and  leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid != 0 and tid = 0  AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");
    $allmoney = pdo_fetchcolumn("SELECT sum(cose) FROM " . tablename('wx_school_order') . "WHERE weid = '{$weid}' AND schoolid IN ({$sclist}) and status = 2 ");
    $result['tea_check_today'] =str_pad($tea_check_count,5,"0",STR_PAD_LEFT);
    $result['stu_check_today'] =str_pad($stu_check_count,5,"0",STR_PAD_LEFT);
    $result['allmoney'] = $allmoney;

    //TODO:
    // 返回 今日 正常、异常、发热人数


    die(json_encode($result));
}elseif($operation == 'getschoolcheck'){
    $schoollist = pdo_fetchall("SELECT id,title FROM ".GetTableName('index')." WHERE id IN ({$sclist}) ");
    foreach ($schoollist as $key => $value) {
        $todaystart = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $todayend = $todaystart + 86399;
        $StuCount  = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('students')." WHERE schoolid = '{$value['id']}' ");
        $TeaCount  = pdo_fetchcolumn("SELECT count(id) FROM ".GetTableName('teachers')." WHERE schoolid = '{$value['id']}' ");
        $Tcheck = pdo_fetchcolumn("SELECT count(distinct tid) FROM ".GetTableName('checklog')." WHERE schoolid = '{$value['id']}' and tid != 0 and sid = 0 and createtime > '{$todaystart}' and createtime < '{$todayend}' and leixing = 1 ");
        $Scheck = pdo_fetchcolumn("SELECT count(distinct sid) FROM ".GetTableName('checklog')." WHERE schoolid = '{$value['id']}' and tid = 0 and sid != 0 and createtime > '{$todaystart}' and createtime < '{$todayend}' and sc_ap = 0 and isconfirm = 1 and leixing = 1  ");
        $schoollist[$key]['1'] = $Tcheck ;
        $schoollist[$key]['2'] = $TeaCount;
        $schoollist[$key]['11'] = $Scheck ;
        $schoollist[$key]['22'] = $StuCount;
        $schoollist[$key]['tpre'] = $TeaCount == 0 ? 0 :  round($Tcheck / $TeaCount ,2) + '%' ;
        $schoollist[$key]['spre'] =$StuCount == 0 ? 0 : round($Scheck / $StuCount ,2) + '%';
    }
    die(json_encode($schoollist));
}elseif($operation == 'GetMcData'){
    $schoolid = $_GPC['schoolid'];
    $nowday = strtotime(date("Y-m-d",time())); //今日
    $yesterday = strtotime(date("Y-m-d",strtotime("-1 day"))); //昨日
    if($keep_MC){
        //当日正常体温
        $zc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid IN ({$sclist}) AND createdate = '{$nowday}' AND ( (tiwen BETWEEN '35.5' AND '37.5') or tiwen < '1')");

        //昨日正常体温
        $yzc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid IN ({$sclist}) AND createdate = '{$yesterday}' AND ( (tiwen BETWEEN '35.5' AND '37.5') or tiwen < '1')");
        //当日发热体温
        $fr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid IN ({$sclist}) AND createdate = '{$nowday}' AND (tiwen < '35.5' OR tiwen > '37.5') and tiwen > '0' ");

        //当日发热体温
        $yfr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid IN ({$sclist}) AND createdate = '{$yesterday}' AND (tiwen < '35.5' OR tiwen > '37.5') and tiwen > '0' ");

        //当日异常人数(体温或口腔)
        $yc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid IN ({$sclist}) AND createdate = '{$nowday}' AND (((tiwen < '35.5' OR tiwen > '37.5') and tiwen > '0' ) OR mouth = 2)");

        //当日异常人数(体温或口腔)
        $yyc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid IN ({$sclist}) AND createdate = '{$yesterday}' AND (((tiwen < '35.5' OR tiwen > '37.5') and tiwen > '0' ) OR mouth = 2)");

        $result = array(
            'zc' => $zc, //正常人数
            'fr' => $fr, //发热人数
            'yc' => $yc, //异常人数
        );
    }else{
        $nowdayend = $nowday + 86399;
        $yesterdayend = $yesterday + 86399;
        /**************************************体温检测数据***************************************/
        //当日正常体温
        $zc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid IN ({$sclist}) AND (createtime BETWEEN $nowday AND $nowdayend) AND ((temperature BETWEEN '35.5' AND '37.5') or temperature < '1' )");
        //昨日正常体温
        $yzc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid IN ({$sclist}) AND (createtime BETWEEN $yesterday AND $yesterdayend) AND ((temperature BETWEEN '35.5' AND '37.5') or temperature < '1' )");

        //当日发热体温
        $fr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid IN ({$sclist}) AND (createtime BETWEEN $nowday AND $nowdayend) AND (temperature < '35.5' OR temperature > '37.5') and temperature > '0'");
        //昨日发热体温
        $yfr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid IN ({$sclist}) AND (createtime BETWEEN $yesterday AND $yesterdayend) AND (temperature < '35.5' OR temperature > '37.5') and temperature > '0' ");
        /**************************************体温检测数据***************************************/

        $result = array(
            'zc' => $zc, //正常人数
            'fr' => $fr, //发热人数
        );
    }
    
    die(json_encode($result));
}
?>