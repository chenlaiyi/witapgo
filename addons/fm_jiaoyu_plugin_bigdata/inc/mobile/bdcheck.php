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
include IA_ROOT.'/addons/fm_jiaoyu_plugin_bigdata/inc/func/islogin.php';
$school =  pdo_fetch("SELECT tpic,spic,title FROM " . tablename('wx_school_index') . " where weid = '{$weid}' And id = '{$schoolid}'");
$schoolset = pdo_fetch("SELECT bgtitle FROM " . tablename('wx_school_schoolset') . " where weid = '{$weid}' AND schoolid = '{$schoolid}'");


$bgShowInfo = pdo_fetch("SELECT bgshowinfo FROM " . tablename('wx_school_schoolset') . " where schoolid = '{$_GPC ['schoolid']}'")['bgshowinfo'];
$bgShowInfo = unserialize($bgShowInfo);

if ($operation == 'display') {
    if(!isset($_GPC['IsApp'])){
        islogin($weid,$schoolid);
    }
    $lasttime = time();
    $njchecklog = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 'semester' AND is_over = 1 ORDER BY ssort DESC ,sid DESC ");
    $lastkq = pdo_fetchall("SELECT * FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND isconfirm = '1' and sc_ap = 0 ORDER BY createtime DESC LIMIT 0,8");
    foreach($lastkq as $index =>$row){
        $idcard = pdo_fetch("SELECT pname FROM " . tablename('wx_school_idcard') . " WHERE idcard = '{$row['cardid']}' ");

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
        $lastkq[$index]['pname'] = $idcard['pname'];

    }



    include $this->template ( 'bdcheck' );

}elseif($operation == 'firstdata'){
    /*
     *  卡绑定统计
     */
    //学生绑定卡
    $stu_ka= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_idcard') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND sid >= 1 ORDER BY sid DESC ");

    //老师绑定卡
    $tea_ka= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_idcard') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND tid >= 1 ORDER BY sid DESC ");

    //未绑定卡
    $no_bind_ka= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_idcard') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND sid < 1 AND tid < 1 ORDER BY sid DESC ");


    $bd_series = array();
    $bd_series[0]['name'] = '人数';
    $bd_seriesdata = array();
    $bd_seriesdata[0]['name'] = '老师绑定';
    $bd_seriesdata[0]['value'] = $tea_ka['total'];
    $bd_seriesdata[1]['name'] = '学生绑定';
    $bd_seriesdata[1]['value'] = $stu_ka['total'];
    $bd_seriesdata[2]['name'] = '未绑定';
    $bd_seriesdata[2]['value'] = $no_bind_ka['total'];
    $bd_series[0]['data'] = $bd_seriesdata;
    $bing_ka = SetEchartsData("卡绑定情况统计","pie",false,0,$bd_series);


    /*
     * 签到比例
     */
    //微信签到
    $checklog_wx= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND checktype = 2 ORDER BY sid DESC ");

    //设备签到
    $checklog_sb= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND checktype = 1 ORDER BY sid DESC ");

    $kq_series = array();
    $kq_series[0]['name'] = '人数';
    $kq_seriesdata = [];
    $kq_seriesdata[0]['name'] = '微信签到';
    $kq_seriesdata[0]['value'] = $checklog_wx['total'];
    $kq_seriesdata[1]['name'] = '设备签到';
    $kq_seriesdata[1]['value'] = $checklog_sb['total'];
    $kq_series[0]['data'] = $kq_seriesdata;
    $kq_check = SetEchartsData("签到比例","pie",false,0,$kq_series);

    /*
     * 请假管理
     *
     * */
    //老师请假
    $tea_qj= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND status = 1  AND sid = 0 AND tid != 0 AND isliuyan != 1");

    //学生请假
    $stu_qj= pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND status = 1 AND sid != 0 AND tid = 0 AND isliuyan != 1");

    $qj_series = array();
    $qj_series[0]['name'] = '人数';
    $qj_seriesdata = [];
    $qj_seriesdata[0]['name'] = '老师请假';
    $qj_seriesdata[0]['value'] = $tea_qj['total'];
    $qj_seriesdata[1]['name'] = '学生请假';
    $qj_seriesdata[1]['value'] = $stu_qj['total'];
    $qj_series[0]['data'] = $qj_seriesdata;
    $qj_check = SetEchartsData("请假比例","pie",false,0,$qj_series);


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


    $return_data = array(
        'bing_ka' =>$bing_ka,
        'kq_check' =>$kq_check,
        'qj_check' =>$qj_check,
        'njchecktoday' =>$njchecktoday,

    );
    die(json_encode($return_data));

}elseif($operation == 'real_time_data'){
    $schoolid = $_GPC['schoolid'];
    $lasttime = $_GPC['lasttime']; //测试最后一次访问日期
    $nowtime = time(); //测试当前日期
    $result = array();
    //考勤记录
    $lastkq = pdo_fetch("SELECT id,sid,tid,bj_id,createtime,checktype,type,schoolid,cardid,macid FROM " . tablename('wx_school_checklog') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND isconfirm = '1' nad sc_ap = 0 AND (createtime BETWEEN {$lasttime} AND {$nowtime}) ORDER BY createtime DESC");
    if(!empty($lastkq)){
        $idcard = pdo_fetch("SELECT pname FROM " . tablename('wx_school_idcard') . " WHERE idcard = '{$lastkq['cardid']}' ");
        $mac = pdo_fetch("SELECT name FROM " . tablename('wx_school_checkmac') . " WHERE schoolid = '{$lastkq['schoolid']}' And id = '{$lastkq['macid']}' ");
        $result['lastkq']['check'] = true;
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
        $lastkq[$index]['mac'] =$mac['name'];
        $lastkq[$index]['pname'] = $idcard['pname'];
        $result['lastkq']['data'] = $lastkq;
    }else{
        $result['lastkq']['check'] = false;
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
    $njchecktoday_series = array();
    $njchecktoday_series[0]['name'] = '人数';
    $njchecktoday_series[0]['data'] = $njchecktoday_series_in;
    $njchecktoday = SetEchartsData("年级今日出勤","bar",false,$njchecktoday_axis,$njchecktoday_series);
    $result['njchecktoday'] =$njchecktoday;
    $result['lasttime'] =$nowtime;
    die(json_encode($result));
}elseif($operation = 'get_class_check'){
    if($_GPC['nj_id']) {
        $njid = $_GPC['nj_id'];
    } else {
        $frnjid = pdo_fetch("SELECT sid FROM " . tablename('wx_school_classify') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' AND type = 'semester' AND is_over = 1 ORDER BY ssort DESC ,sid DESC ");
        $njid = $frnjid['sid'];
    }
    $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $end = $start + 86399;
    if(!empty($_GPC['addtime'])) {
        $starttime = strtotime($_GPC['start']);
        $endtime = strtotime($_GPC['end']) + 86399;
        $condition3 .= " AND createtime > '{$starttime}' AND createtime < '{$endtime}'";
        $day = timediff($starttime,$endtime);
        $day_num =  $day['day']+1;
    } else {
        $condition3 .= " AND createtime > '{$start}' AND createtime < '{$end}'";
        $condition5 .= " AND ( (startime1 < '{$start}' AND endtime1 > '{$end}') OR ( startime1 > '{$start}' AND startime1 < '{$end}') OR ( endtime1 > '{$start}' AND endtime1 < '{$end}'))";
    }

    $allthisbj = pdo_fetchall("SELECT sid,sname FROM " . tablename('wx_school_classify') . " WHERE parentid = '{$njid}' ORDER BY ssort DESC ,sid DESC ");
    $allthisbjsname = array();
    $njcqzssss = array();
    $bjkqbl = array();
    $bjzrss = array();
    if($day_num){
        $days = array();
        $daykey = array();
        for($i = 0; $i < $day_num; $i++){
            $keys = date('Y-m-d', $starttime + 86400 * $i);
            $days[$keys] = 0;
            $daykey[$keys] = 0;
        }
        foreach($allthisbj as $index => $v){
            $bjzrs = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wx_school_students') . " WHERE schoolid = :schoolid And bj_id = :bj_id", array(':schoolid' => $schoolid, ':bj_id' => $v['sid']));
            $allbjqksm = pdo_fetchall("SELECT sid,createtime FROM " . tablename('wx_school_checklog') . " WHERE bj_id = '{$v['sid']}' AND leixing = 1 AND isconfirm = 1  $condition3 ");
            $bjqksm = 0;
            foreach($allbjqksm as $da) {
                $key = date('Y-m-d', $da['createtime']);
                if(in_array($key, array_keys($days))) {
                    if(!in_array($da['sid'], $daykey[$key])) {
                        $daykey[$key] = $da['sid'];
                        $bjqksm++;
                    }
                }
            }
            $bjzrss[] = $bjzrs;
            $njcqzssss[] =  $bjqksm;
            $bjkqbl[] =  round($bjqksm/($bjzrs*$day_num)*100,2);
            $allthisbjsname[] = $v['sname'];
        }
    }else{
        foreach($allthisbj as $index => $v){
            $bjzrs = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wx_school_students') . " WHERE schoolid = :schoolid And bj_id = :bj_id", array(':schoolid' => $schoolid, ':bj_id' => $v['sid']));
            $bjqksm = pdo_fetchcolumn("SELECT COUNT(distinct sid) FROM " . tablename('wx_school_checklog') . " WHERE bj_id = '{$v['sid']}' AND leixing = 1 AND isconfirm = 1  $condition3 ");
            $njcqzssss[] =  $bjqksm;
            $allthisbjsname[] = $v['sname'];
            $bjkqbl[] =  round($bjqksm/$bjzrs*100,2);
        }
    }
    $data['allthisbj'] = $allthisbjsname;

    $njchecktoday_axis = array(
        'xAxis' =>array(
            'name' => '班级',
            'data' => $allthisbjsname
        ),
        'yAxis' =>array(
            0=>array('name' => '人数','min'=> 0),
            1=>array('name' => '比例:%',' min'=> 0,'max'=>100),
        ),
    );

    $njchecktoday_series[0]['name'] = '人数';
    $njchecktoday_series[0]['data'] = $njcqzssss;
    $njchecktoday_series[1]['name'] = '比例';
    $njchecktoday_series[1]['data'] = $bjkqbl;
    $njchecktoday = SetEchartsData("班级今日出勤","dubar",false,$njchecktoday_axis,$njchecktoday_series);
    $data['bjcqzs'] = $njcqzssss;
    $data['bjkqbl'] = $bjkqbl;

    die ( json_encode ( $njchecktoday ) );
}
?>