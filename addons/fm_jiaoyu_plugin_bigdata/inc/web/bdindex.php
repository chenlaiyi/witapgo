<?php
/**
 * 微教育模块
 *
 * @author it猿工
 */
global $_W, $_GPC;
$weid = $_W['uniacid'];
$schoolid = $_GPC['schoolid'];
$action = 'school';
$title  = '学校管理';
$url    = $this->createWebUrl($action, array('op' => 'display'));


if( $_SERVER['HTTP_HOST'] == "manger.weimeizhan.com" && $_SERVER['HTTP_HOST'] == 'wx.cqznl.cn'){
    $keep_MC = true;
}else{
    $keep_MC = false;
}

$city   = pdo_fetchall("SELECT * FROM " . tablename('wx_school_area') . " where weid = '{$weid}' And type = 'city' ORDER BY ssort DESC");
$area   = pdo_fetchall("SELECT * FROM " . tablename('wx_school_area') . " where weid = '{$weid}' And type = '' ORDER BY ssort DESC");
$schooltype = pdo_fetchall("SELECT * FROM " . tablename('wx_school_type') . " where weid = '{$weid}' ORDER BY ssort DESC");
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$school =  pdo_fetch("SELECT tpic,spic,title FROM " . tablename('wx_school_index') . " where weid = '{$weid}' And id = '{$schoolid}'");
$schoolset = pdo_fetch("SELECT bgtitle FROM " . tablename('wx_school_schoolset') . " where weid = '{$weid}' AND schoolid = '{$schoolid}'");
if ($operation == 'display') {

    //校园动态
    $lasttz = pdo_fetchall("SELECT * FROM ".tablename('wx_school_notice')." WHERE weid = '{$weid}' And schoolid = '{$schoolid}' ORDER BY createtime DESC LIMIT 0,4");
    foreach($lasttz as $key => $row){
        $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $row['bj_id']));
        $ls = pdo_fetch("SELECT thumb,tname FROM " . tablename('wx_school_teachers') . " WHERE id = :id", array(':id' => $row['tid']));
        $lasttz[$key]['bjname'] = $bj['sname'];
        $lasttz[$key]['thumb'] = $ls['thumb']?$ls['thumb']:$school['tpic'];
        $lasttz[$key]['tname'] = $ls['tname'];

    }

    $lastxxtzid = $lasttz[0]['id']?$lasttz[0]['id']:0;


    //班级圈消息
    $lastbjq = pdo_fetchall("SELECT id,uid,shername,createtime,content,isopen,bj_id1,msgtype FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' And type = 0  AND isopen = '0' ORDER BY createtime DESC LIMIT 0,4");
    foreach ($lastbjq as $index => $row) {
        $member = pdo_fetch("SELECT avatar FROM " . tablename ( 'mc_members' ) . " where uniacid = :uniacid And uid = :uid ORDER BY uid ASC", array(':uniacid' => $weid, ':uid' => $row['uid']));
        $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $row['bj_id1']));
        $lastbjq[$index]['bjname'] = $bj['sname'];
        $lastbjq[$index]['avatar'] = $member['avatar'];
    }

    $lastbjqid = $lastbjq[0]['id']? $lastbjq[0]['id']:0;

    //考勤
    $lastkq = pdo_fetchall("SELECT * FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND isconfirm = '1' and sc_ap = 0 ORDER BY createtime DESC LIMIT 0,8");
    foreach($lastkq as $index =>$row){
        if(!empty($row['cardid'])){
            $idcard = pdo_fetch("SELECT pname FROM " . tablename('wx_school_idcard') . " WHERE idcard = '{$row['cardid']}' ");

        }

        $mac = pdo_fetch("SELECT name FROM " . tablename('wx_school_checkmac') . " WHERE schoolid = '{$row['schoolid']}' And id = '{$row['macid']}' ");
        if(!empty($row['sid']) && empty($row['tid'])){
            $student = pdo_fetch("SELECT s_name,icon FROM " . tablename('wx_school_students') . " WHERE id = '{$row['sid']}' ");
            $banji = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = '{$row['bj_id']}' ");

            $lastkq[$index]['name'] = $student['s_name'];
            $lastkq[$index]['bjname'] = $banji['sname'];
            $thumb = $student['icon']?$student['icon']:$school['spic'];
            $lastkq[$index]['t_s'] = 'stu';
        }elseif(empty($row['sid']) && !empty($row['tid'])){
            $teacher = pdo_fetch("SELECT tname,fz_id,thumb FROM " . tablename('wx_school_teachers') . " WHERE id = '{$row['tid']}' ");
            $jsfz =  pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = '{$teacher['fz_id']}' ");
            $lastkq[$index]['name'] = $teacher['tname'];
            $lastkq[$index]['bjname'] = '老师';
            $lastkq[$index]['fzname'] = $jsfz['sname'];
            $thumb = $teacher['thumb']?$teacher['thumb']:$school['tpic'];
            $lastkq[$index]['t_s'] = 'tea';
        }

        $lastkq[$index]['thumb'] = $thumb;
        $lastkq[$index]['mac'] =$mac['name'];
        $lastkq[$index]['pname'] = $idcard['pname'] ? $idcard['pname'] : '';

    }
    $first_check = $lastkq[0];
    $lastkqid = $lastkq[0]['id']?$lastkq[0]['id']:0;
    //教师/学生今日实到人数
    $todaystart = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $todayend = $todaystart + 86399;
    $tea_check_count =  pdo_fetchcolumn("SELECT COUNT(distinct tid) FROM " . tablename('wx_school_checklog') . " WHERE  weid = '{$weid}' AND schoolid = '{$schoolid}' and leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid = 0 and tid != 0  AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");

    $stu_check_count =  pdo_fetchcolumn("SELECT COUNT(distinct sid) FROM " . tablename('wx_school_checklog') . " WHERE  weid = '{$weid}' AND schoolid = '{$schoolid}' and leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid != 0 and tid = 0  AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");
    $tea_check_today = str_pad($tea_check_count,5,"0",STR_PAD_LEFT);
    $stu_check_today = str_pad($stu_check_count,5,"0",STR_PAD_LEFT);
    $lasttime = time();

    include $this->template ( 'web/bdindex' );

}elseif($operation == 'firstdata'){
    $nowtime = TIMESTAMP;
    //教师总数
    $jszj = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_teachers') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'");
    //已绑教师
    $ybjs = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_user') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND sid = 0 $condition1");
    //学生总数
    $allstudent  = pdo_fetchAll("select s.id FROM ".tablename('wx_school_students')." s LEFT JOIN " . tablename('wx_school_classify') . " c on s.bj_id = c.sid WHERE s.weid = '{$weid}' AND s.schoolid = '{$schoolid}' AND c.is_over = 1 ");
    $allstu = count($allstudent);
    //学生性别比例
    $stusexcount  = pdo_fetch("select sum(case when sex='1' then 1 else 0 end) as boy ,sum(case when sex != '1' then 1 else 0 end) as girl FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'   ");
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
    $teasexcount  = pdo_fetch("select sum(case when sex='1' then 1 else 0 end) as male ,sum(case when sex != '1' then 1 else 0 end) as female FROM ".tablename('wx_school_teachers')." WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'   ");
    $teasex_series = array();
    $teasex_series[0]['name'] = '人数';
    $teasex_seriesdata = array();
    $teasex_seriesdata[0]['name'] = '男性';
    $teasex_seriesdata[1]['name'] = '女性';
    $teasex_seriesdata[0]['value'] = $teasexcount['male'];
    $teasex_seriesdata[1]['value'] = $teasexcount['female'];
    $teasex_series[0]['data'] = $teasex_seriesdata;
    $teasex = SetEchartsData("教师性别比例","pie",true,0,$teasex_series);

    //已绑学生数
    $ybstu  = pdo_fetchcolumn("select COUNT(id) FROM ".tablename('wx_school_students')." WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  and  ( own != '0' or mom != '0' or dad != '0' or other != '0' ) ");
    //老师年龄分布
 
    $nowday = strtotime(date("Y-m-d",time()));
    $tiwennum = [];
    for($i=13;$i>=0;$i--){
        $first= $nowday-$i*86400;
        $last = $nowday-$i*86400 + 86399;
        //当日体温测量人数
        $AllCount = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('yqdk') . " WHERE weid = '{$weid}' AND (createtime BETWEEN '{$first}' AND '{$last}') AND schoolid = '{$schoolid}'");
        //当日体温正常人数
        $normal = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('yqdk') . " WHERE weid = '{$weid}' AND (createtime BETWEEN '{$first}' AND '{$last}') AND (tiwen BETWEEN '35.5' AND '37.5') AND schoolid = '{$schoolid}'");
         
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

    // //交互功能使用率
    // $bjq = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_bjq') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  ");
    // $bm = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_signup') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  ");
    // $xc = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_media') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' And type = 2  ");
    // $tz = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_notice') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  ");
    // $ly = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' And isliuyan = 2 And isfrist = 1  ");
    // $qj = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' And isliuyan = 0  ");

    // $jhgn_series_data = array(
    //     0 => array('name' => '班级圈', 'value' => $bjq),
    //     1 => array('name' => '通知公告', 'value' => $tz),
    //     2 => array('name' => '在线留言', 'value' => $ly),
    //     3 => array('name' => '相册', 'value' => $xc),
    //     4 => array('name' => '在线请假', 'value' => $qj)
    // );

    // $jhgn_series = array();
    // $jhgn_series[0]['name'] = '次数';
    // $jhgn_series[0]['data'] = $jhgn_series_data;
    // $jhgn = SetEchartsData("交互功能使用比例","pie",false,0,$jhgn_series);

    /**各年级出勤情况**/
    $todaystart = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $todayend = $todaystart + 86399;
    $njchecktoday_xAxis = array();
    $njchecktoday_series_in = array();
    $njchecklog = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 'semester' AND is_over = 1 ORDER BY ssort DESC ,sid DESC ");
        foreach($njchecklog as $key =>$row){
            $njchecktoday_xAxis[] = $row['sname'];
            $njchecklog[$key]['njcqzs'] = 0;
            $allthisbj = pdo_fetchall("SELECT sid FROM " . tablename('wx_school_classify') . " WHERE parentid = '{$row['sid']}' AND is_over = 1 ");
            foreach($allthisbj as $index => $v){
                $bjqksm = pdo_fetchcolumn("SELECT COUNT(distinct sid) FROM " . tablename('wx_school_checklog') . " WHERE bj_id = '{$v['sid']}' AND leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid != 0 AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");
                $njchecklog[$key]['njcqzs'] =  $njchecklog[$key]['njcqzs'] + $bjqksm;
            }
            $njchecktoday_series_in[] = $njchecklog[$key]['njcqzs'];
        }

    $njchecktoday_axis = array(
        'xAxis' =>array(
            'name' => '年级',
            'data' => $njchecktoday_xAxis
        ),
        'yAxis' =>array(
            'name' => '人数',
        ),
    );
    $njchecktoday_series = array();
    $njchecktoday_series[0]['name'] = '人数';
    $njchecktoday_series[0]['data'] = $njchecktoday_series_in;
    $njchecktoday = SetEchartsData("年级今日出勤","bar",false,$njchecktoday_axis,$njchecktoday_series);


   //学生年级分布
    $stu_nj_list = pdo_fetchall("SELECT count(distinct students.id) as stuNum,classify.sname as sname FROM " . tablename('wx_school_students') . " as students, " . tablename('wx_school_classify') . " as classify WHERE students.weid = '{$weid}' AND students.schoolid = '{$schoolid}' and students.xq_id != 0 and students.xq_id = classify.sid and classify.is_over =1 group by students.xq_id ");
    $stu_nj_xAxis = array();
    $stu_nj_series_in = array();
   foreach ($stu_nj_list as $key=>$value){
        $stu_nj_xAxis[]=$value['sname'];
        $stu_nj_series_in[]=$value['stuNum'];
    }

    $stu_nj_axis = array(
        'xAxis' =>array(
            'name' => '年级',
            'data' => $stu_nj_xAxis
        ),
        'yAxis' =>array(
            'name' => '人数',
        ),
    );

    $stu_nj_series = array();
    $stu_nj_series[0]['name'] = '人数';
    $stu_nj_series[0]['data'] = $stu_nj_series_in;
    $stu_nj = SetEchartsData("学生年级分布","bar",false,$stu_nj_axis,$stu_nj_series);




    $TSCount= array(
        'AllTeaNum' => $jszj,
        'AllStuNum' => $allstu,
        'TeaBDNum' => $ybjs,
        'StuBDNum' => $ybstu,
    );
    $return_data = array(
        'stusex' =>$stusex,
        'jhgn' =>$jhgn,
        'teasex' =>$teasex,
        'middleNum' => $TSCount,
        'tea_age' =>$tea_age,
        'stu_nj' => $stu_nj,
        'njchecktoday' => $njchecktoday
    );
    die(json_encode($return_data));


}elseif($operation == 'real_time_data'){
    $schoolid   = $_GPC['schoolid'];
    $lastkqid   = $_GPC['kqid'];
    $lastbjqid  = $_GPC['bjqid'];
    $lastxxtzid = $_GPC['xxtzid'];



    $lasttime = $_GPC['lasttime']; //测试最后一次访问日期

    $nowtime = time(); //测试当前日期
    $testlasttime = $nowtime - 6000;
    $result = array();
    //考勤记录
    $lastkq = pdo_fetch("SELECT id,sid,tid,bj_id,createtime,checktype,type,schoolid,cardid,macid FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' and sc_ap = 0  AND isconfirm = '1' and id > '{$lastkqid}' ORDER BY id ASC ");
    if(!empty($lastkq)){
        $result['lastkq']['check'] = true;
        if(!empty($lastkq['cardid'])){
            $idcard = pdo_fetch("SELECT pname FROM " . tablename('wx_school_idcard') . " WHERE idcard = '{$lastkq['cardid']}' ");

        }
        $mac = pdo_fetch("SELECT name FROM " . tablename('wx_school_checkmac') . " WHERE schoolid = '{$lastkq['schoolid']}' And id = '{$lastkq['macid']}' ");

        if(!empty($lastkq['sid']) && empty($lastkq['tid'])){
            $student = pdo_fetch("SELECT s_name,icon FROM " . tablename('wx_school_students') . " WHERE id = '{$lastkq['sid']}' ");
            $banji = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = '{$lastkq['bj_id']}' ");
            $lastkq['name'] = $student['s_name'];
            $thumb = $student['icon']?$student['icon']:$school['spic'];
            $lastkq['bjname'] = $banji['sname'];
            $lastkq['t_s'] = 'stu';
        }elseif(empty($lastkq['sid']) && !empty($lastkq['tid'])){
            $teacher = pdo_fetch("SELECT tname,thumb,fz_id FROM " . tablename('wx_school_teachers') . " WHERE id = '{$lastkq['tid']}' ");
            $jsfz =  pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = '{$teacher['fz_id']}' ");
            $lastkq['name'] =$teacher['tname'];
            $thumb = $teacher['thumb']?$teacher['thumb']:$school['tpic'];
            $lastkq['bjname'] = '老师';
            $lastkq['fzname'] = $jsfz['sname'];
            $lastkq['t_s'] = 'tea';
        }
        $lastkq['thumb'] = tomedia($thumb);
        $lastkq['createtime'] = date("Y-m-d H:i",$lastkq['createtime']);
        $lastkq['mac'] =$mac['name'];
        $lastkq['pname'] = $idcard['pname'] ? $idcard['pname'] : '';
        $result['lastkq']['data'] = $lastkq;
    }else{
        $result['lastkq']['check'] = false;
        $result['lastkq']['data']['id'] = $lastkqid;
    }
    
    //校园动态
    $lasttz = pdo_fetch("SELECT id,bj_id,tid,ismobile,tname,title,createtime,type FROM ".tablename('wx_school_notice')." WHERE weid = '{$weid}' And schoolid = '{$schoolid}' and id > '{$lastxxtzid}' ORDER BY id ASC ");
    if(!empty($lasttz)){
        $result['lasttz']['check'] = true;
        $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $lasttz['bj_id']));
        $ls = pdo_fetch("SELECT thumb FROM " . tablename('wx_school_teachers') . " WHERE id = :id", array(':id' => $lasttz['tid']));
        $lasttz['bjname'] = $bj['sname'];
        $thumb= $ls['thumb']?$ls['thumb']:$school['tpic'];
        $lasttz['thumb'] = tomedia($thumb);
        $lasttz['createtime'] = date("Y-m-d H:i",$lasttz['createtime']);
        $result['lasttz']['data'] = $lasttz;
    }else{
        $result['lasttz']['check'] = false;
        $result['lasttz']['data']['id'] = $lastxxtzid;
    }

    //班级圈
    $lastbjq  = pdo_fetch("SELECT id,uid,shername,createtime,content,isopen,bj_id1,msgtype FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}'  and id > '{$lastbjqid}' ORDER BY id ASC");
    if(!empty($lastbjq)){
        $result['lastbjq']['check'] = true;
        $member = pdo_fetch("SELECT avatar FROM " . tablename ( 'mc_members' ) . " where uniacid = :uniacid And uid = :uid ORDER BY uid ASC", array(':uniacid' => $weid, ':uid' => $lastbjq['uid']));
        $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $lastbjq['bj_id1']));
        $lastbjq['bjname'] = $bj['sname'];
        $avatar= $member['avatar'];
        $lastbjq['avatar'] = tomedia($avatar);
        $lastbjq['createtime'] = date("Y-m-d H:i",$lastbjq['createtime']);
        $result['lastbjq']['data'] = $lastbjq;
    }else{
        $result['lastbjq']['check'] = false;
        $result['lastbjq']['data']['id'] = $lastbjqid;
    }


    /**各年级出勤情况**/
    $todaystart = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $todayend = $todaystart + 86399;
    $njchecktoday_xAxis = array();
    $njchecktoday_series_in = array();
    $njchecklog = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 'semester' AND is_over = 1 ORDER BY ssort DESC ,sid DESC ");
    foreach($njchecklog as $key =>$row){
        $njchecktoday_xAxis[] = $row['sname'];
        $njchecklog[$key]['njcqzs'] = 0;
        $allthisbj = pdo_fetchall("SELECT sid FROM " . tablename('wx_school_classify') . " WHERE parentid = '{$row['sid']}' AND is_over = 1 ");
        foreach($allthisbj as $index => $v){
            $bjqksm = pdo_fetchcolumn("SELECT COUNT(distinct sid) FROM " . tablename('wx_school_checklog') . " WHERE bj_id = '{$v['sid']}' AND leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid != 0 AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");
            $njchecklog[$key]['njcqzs'] =  $njchecklog[$key]['njcqzs'] + $bjqksm;
        }
        $njchecktoday_series_in[] = $njchecklog[$key]['njcqzs'];
    }
    $njchecktoday_axis = array(
        'xAxis' =>array(
            'name' => '年级',
            'data' => $njchecktoday_xAxis
        ),
        'yAxis' =>array(
            'name' => '人数',
        ),
    );
    $tea_check_count =  pdo_fetchcolumn("SELECT COUNT(distinct tid) FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' and  leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid = 0 and tid != 0  AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");

    $stu_check_count =  pdo_fetchcolumn("SELECT COUNT(distinct sid) FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' and  leixing = 1 AND isconfirm = 1 and sc_ap = 0 and sid != 0 and tid = 0  AND createtime > '{$todaystart}' AND createtime < '{$todayend}'  ");
    $njchecktoday_series = array();
    $njchecktoday_series[0]['name'] = '人数';
    $njchecktoday_series[0]['data'] = $njchecktoday_series_in;
    $njchecktoday = SetEchartsData("年级今日出勤","bar",false,$njchecktoday_axis,$njchecktoday_series);
    $result['njchecktoday'] =$njchecktoday;
    $result['tea_check_today'] =str_pad($tea_check_count,5,"0",STR_PAD_LEFT);
    $result['stu_check_today'] =str_pad($stu_check_count,5,"0",STR_PAD_LEFT);
    $result['lasttime'] =$nowtime;
    die(json_encode($result));

}elseif($operation == 'GetCheckData'){
    $schoolid = $_GPC['schoolid'];
    $nowday = strtotime(date("Y-m-d",time())); //今日
    $yesterday = strtotime(date("Y-m-d",strtotime("-1 day"))); //昨日
    if($keep_MC){
        /**************************************体温检测数据***************************************/
        //当日正常体温
        $zc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$nowday}' AND ((tiwen BETWEEN '35.5' AND '37.5')  or tiwen < '1') AND mouth != 2");
        //昨日正常体温
        // $yzc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$yesterday}' AND (tiwen BETWEEN '35.5' AND '37.5')");

        //当日发热体温
        $fr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$nowday}' AND (tiwen < '35.5' OR tiwen > '37.5') AND tiwen > '0' ");
        //昨日发热体温
        // $yfr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$yesterday}' AND (tiwen < '35.5' OR tiwen > '37.5') AND tiwen > '0'");

        //当日异常人数(体温或口腔)
        $yc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$nowday}' AND (((tiwen < '35.5' OR tiwen > '37.5') AND tiwen > '0') OR mouth = 2)");
        //昨日异常人数(体温或口腔)
        // $yyc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$yesterday}' AND ((tiwen < '35.5' OR tiwen > '37.5') AND tiwen > '0') OR mouth = 2)");
        /**************************************体温检测数据***************************************/

        /**************************************学校检测情况***************************************/

        //获取当前学生学生总人数
        // $AllStu = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('students') . " WHERE schoolid = '{$schoolid}'");
        $allstudent_all  = pdo_fetchAll("select s.id FROM ".tablename('wx_school_students')." s LEFT JOIN " . tablename('wx_school_classify') . " c on s.bj_id = c.sid WHERE s.weid = '{$weid}' AND s.schoolid = '{$schoolid}' AND c.is_over = 1 ");
        $AllStu = count($allstudent_all);
        //获取今日已经检测的学员
        $hascheckstu = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$nowday}'");
        //得出当日未检测的学生人数-及比例
        $nocheckstu = intval($AllStu) - intval($hascheckstu);
        $nocheckbl = round($hascheckstu / $AllStu * 100 ,2) .'%';
        /**************************************学校检测情况***************************************/
        $result = array(
            'zc' => $zc, //正常人数
            'fr' => !empty($fr) ? $fr : 0, //发热人数
            'yc' => !empty($yc) ? $yc : 0, //异常人数
            'nocheckstu' => $nocheckstu, //未检测学员人数
            'nocheckbl' => $nocheckbl,  //未检测学员比例
        );
    }else{
        $nowdayend = $nowday + 86399;
        $yesterdayend = $yesterday + 86399;
        /**************************************体温检测数据***************************************/
        //当日正常体温
        $zc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid = '{$schoolid}' AND (createtime BETWEEN $nowday AND $nowdayend) AND ( (temperature BETWEEN '35.5' AND '37.5') or temperature < '1') ");
        //昨日正常体温
        // $yzc = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid = '{$schoolid}' AND (createtime BETWEEN $yesterday AND $yesterdayend) AND (  (temperature BETWEEN '35.5' AND '37.5') or temperature < '1' ) ");

        //当日发热体温
        $fr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid = '{$schoolid}' AND (createtime BETWEEN $nowday AND $nowdayend) AND (temperature < '35.5' OR temperature > '37.5') AND temperature != '0'");
        //昨日发热体温
        // $yfr = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid = '{$schoolid}' AND (createtime BETWEEN $yesterday AND $yesterdayend) AND (temperature < '35.5' OR temperature > '37.5') AND temperature != '0'");
        /**************************************体温检测数据***************************************/

        /**************************************学校检测情况***************************************/

        //获取当前学生学生总人数
        $AllStu = pdo_fetchcolumn("SELECT count(distinct id) FROM " . GetTableName('students') . " WHERE schoolid = '{$schoolid}'");
        //获取今日已经检测的学员
        $hascheckstu = pdo_fetchcolumn("SELECT count(distinct sid) FROM " . GetTableName('checklog') . " WHERE schoolid = '{$schoolid}' AND (createtime BETWEEN $nowday AND $nowdayend)");
        //得出当日未检测的学生人数-及比例
        $nocheckstu = intval($AllStu) - intval($hascheckstu);
        $nocheckbl = round($hascheckstu / $AllStu * 100 ,2) .'%';
        
        /**************************************学校检测情况***************************************/
        $result = array(
            'zc' => $zc, //正常人数
            'fr' => $fr, //发热人数
            'nocheckstu' => $nocheckstu, //未检测学员人数
            'nocheckbl' => $nocheckbl,  //未检测学员比例
        );
    }
    die(json_encode($result));
}elseif($operation == 'GetNjCheckData'){
    $schoolid = $_GPC['schoolid'];
    $nowday = strtotime(date("Y-m-d",time())); //今日
    $nowdayend = $nowday + 86399; //昨日
    //获取每个年级的信息 AND is_over!= 2
    $nj = pdo_fetchall("SELECT sid,sname FROM ".GetTableName('classify')." WHERE schoolid = '{$schoolid}' AND type = 'semester' AND is_over != 2 ORDER BY sid");
    foreach ($nj as $key => $value) {
        //获取当前年级下的所有班级
        $bjlist = pdo_fetchall("SELECT sid FROM ".GetTableName('classify')." WHERE schoolid = '{$schoolid}' AND type = 'theclass' AND is_over != 2 AND parentid = '{$value['sid']}'");
        $bj_id = arrayToString($bjlist);
        //计算出每个年级下的所有学生数量
        if(!empty($bj_id)){
            //每个年级的学员人数
            $njstucount = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('students') . " WHERE schoolid = '{$schoolid}' AND FIND_IN_SET(bj_id,'{$bj_id}')");
            if($keep_MC){
                //当前时间段检测人数
                $checkcount = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('morningcheck') . " WHERE schoolid = '{$schoolid}' AND createdate = '{$nowday}' AND FIND_IN_SET(bj_id,'{$bj_id}')");
            }else{
                //当前时间段检测人数
                $checkcount = pdo_fetchcolumn("SELECT count(*) FROM " . GetTableName('checklog') . " WHERE schoolid = '{$schoolid}' AND (createtime BETWEEN $nowday AND $nowdayend) AND FIND_IN_SET(bj_id,'{$bj_id}')");
            }
            
            // 当前年级检测比例
            $checkbjbl = round($checkcount / $njstucount * 100 ,2) .'%';
        }
        $nj[$key]['njbl'] = $checkbjbl ? $checkbjbl : '0%';
        $nj[$key]['nowtime'] = date("Y-m-d H:i", time());
    }
    $result['data'] = $nj;
    die(json_encode($result));
}

/*
 * 将多维数组转成字符串
 *
 * */
function arrayToString($arr) {
    if (is_array($arr)){
        return implode(',', array_map('arrayToString', $arr));
    }
    return $arr;
}
?>