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
$school =  pdo_fetch("SELECT tpic,spic,title FROM " . tablename('wx_school_index') . " where weid = '{$weid}' And id = '{$schoolid}'");
$schoolset = pdo_fetch("SELECT bgtitle FROM " . tablename('wx_school_schoolset') . " where weid = '{$weid}' AND schoolid = '{$schoolid}'");
if ($operation == 'display') {

//    echo '<pre>';
//    print_r($new_finish_class);die;
    include $this->template ( 'web/bdpeople' );

}elseif($operation == 'firstdata'){


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



    //老师年龄分布
    $year = strtotime("0 year");
    $year1 =  strtotime("-30 year");
    $year2 =  strtotime("-40 year");
    $year3 =  strtotime("-50 year");
    $year4 =  strtotime("-60 year");
    //老师的年龄
    $tea_age = pdo_fetch("SELECT count(birthdate) AS total FROM " . tablename('wx_school_teachers') . " where weid = :weid", array(':weid' => $weid)); //所有总数
    $tea_age1 = pdo_fetch("SELECT count(birthdate) AS total FROM " . tablename('wx_school_teachers') . " where weid = :weid AND (birthdate between $year1 AND $year)", array(':weid' => $weid)); //小于30岁的
    $tea_age2 = pdo_fetch("SELECT count(birthdate) AS total FROM " . tablename('wx_school_teachers') . " where weid = :weid AND (birthdate between $year2 AND $year1)", array(':weid' => $weid)); //30-40
    $tea_age3 = pdo_fetch("SELECT count(birthdate) AS total FROM " . tablename('wx_school_teachers') . " where weid = :weid AND (birthdate between $year3 AND $year2)", array(':weid' => $weid));//40-50
    $tea_age4 = pdo_fetch("SELECT count(birthdate) AS total FROM " . tablename('wx_school_teachers') . " where weid = :weid AND (birthdate between $year4 AND $year3)", array(':weid' => $weid));//50-60
    $tea_age5 = pdo_fetch("SELECT count(birthdate) AS total FROM " . tablename('wx_school_teachers') . " where weid = :weid AND (birthdate <$year4)", array(':weid' => $weid));//60以上
    $tea_age_data = array(
        'xaixs' => array(
            0=>'30岁以下',
            1=>'30岁到40岁',
            2=>'40岁到50岁',
            3=>'50岁到60岁',
            4=>'60岁以上',
        ),
        'series' => array(
            0=>$tea_age1['total'],
            1=>$tea_age2['total'],
            2=>$tea_age3['total'],
            3=>$tea_age4['total'],
            4=>$tea_age5['total'],
        ),

    );
    $tea_age_axis = array(
        'xAxis' =>array(
            'name' => '阶段',
            'data' => $tea_age_data['xaixs']
        ),
        'yAxis' =>array(
            'name' => '人数',
        ),
    );
    $tea_age_series = array();
    $tea_age_series[0]['name'] = '人数';
    $tea_age_series[0]['data'] = $tea_age_data['series'];
    $tea_age = SetEchartsData("教师年龄分布","bar",false,$tea_age_axis,$tea_age_series);



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





    //教师分组与人数统计
    $jsfz     = pdo_fetchAll("SELECT c.sname,count(t.id) as total FROM " . tablename('wx_school_classify') . "as c LEFT JOIN ". tablename('wx_school_teachers'). "as t ON c.sid = t.fz_id WHERE c.weid = '{$weid}' And c.type = 'jsfz' And c.schoolid = {$schoolid} group by c.sname ORDER BY c.sid ASC, ssort DESC",array(),'sid');

    $bd_jsfz = array();
    $bd_jsfz[0]['name'] = '教师分组与人数统计';
    foreach ($jsfz as $k => $v){
        $xaixs[$k] = $jsfz[$k]['sname'];
        $series[$k]= $jsfz[$k]['total'];
    }
    $bd_jsfz_data = array(
        'xaixs' => $xaixs,
        'series' => $series,
    );
    $bd_jsfz_axis = array(
        'xAxis' =>array(
            'name' => '分组',
            'data' => $bd_jsfz_data['xaixs']
        ),
        'yAxis' =>array(
            'name' => '人数',
        ),
    );
    $bd_jsfz[0]['name'] = '人数';
    $bd_jsfz[0]['data'] = $bd_jsfz_data['series'];
    $new_bd_jsfz = SetEchartsData("教师分组与人数统计","bar",false,$bd_jsfz_axis,$bd_jsfz);


    /*
     * 学生毕业与未毕业人数统计
     *
     * */
    //已毕业人数
    $finish_class = pdo_fetch("SELECT count(s.id)as total FROM " . tablename('wx_school_classify') . "as c, ". tablename('wx_school_students'). " as s where c.sid = s.bj_id and c.parentid = s.xq_id and c.weid = '{$weid}' And c.type = 'theclass' And c.schoolid = '{$schoolid}' And c.is_over = '2' ORDER BY c.sid ASC");
    //未毕业人数
    $not_finish_class = pdo_fetch("SELECT count(s.id)as total FROM " . tablename('wx_school_classify') . "as c, ". tablename('wx_school_students'). " as s where c.sid = s.bj_id and c.parentid = s.xq_id and c.weid = '{$weid}' And c.type = 'theclass' And c.schoolid = '{$schoolid}' And c.is_over != '2' ORDER BY c.sid ASC");
    $do_finish_class[0]['name'] = '人数';
    $do_finish_class[0]['data'] = array(
        0 => array('name'=>'毕业','value'=>$finish_class['total']),
        1 => array('name'=>'未毕业','value'=>$not_finish_class['total']),
    );
    $new_finish_class = SetEchartsData("学生毕业/未毕业统计","pie",false,0,$do_finish_class);


    //走读生与住校生人数统计
    //走读生
    $day_stu = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_students') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' AND s_type != 2");
    //住校生
    $resident_stu = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_students') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' AND s_type = 2");

    $stu_series_data[0]['name'] = '人数';
    $stu_series_data[0]['data'] = array(
        0 => array('name'=>'走读生','value'=>$day_stu['total']),
        1 => array('name'=>'住校生','value'=>$resident_stu['total']),
    );
    $new_stu_series_data = SetEchartsData("走读生/住校生统计","pie",false,0,$stu_series_data);

    $return_data = array(
        'new_bd_jsfz' =>$new_bd_jsfz,
        'new_finish_class' =>$new_finish_class,
        'new_stu_series_data' =>$new_stu_series_data,
        'stu_nj' => $stu_nj,
        'tea_age' => $tea_age,
        'teasex' => $teasex,
        'stusex' => $stusex
    );

    die(json_encode($return_data));

}elseif($operation == 'real_time_data'){


}
?>