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
include IA_ROOT.'/addons/fm_jiaoyu_plugin_bigdata/inc/func/islogin.php';
if ($operation == 'display') {
    if(!isset($_GPC['IsApp'])){
        islogin($weid,$schoolid);
    }
    //班级圈消息
    $lastbjq = pdo_fetchall("SELECT uid,shername,createtime,content,isopen,bj_id1,msgtype FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' And type = 0  AND isopen = '0' ORDER BY createtime DESC LIMIT 0,6");
    foreach ($lastbjq as $index => $row) {
        $member = pdo_fetch("SELECT avatar FROM " . tablename ( 'mc_members' ) . " where uniacid = :uniacid And uid = :uid ORDER BY uid ASC", array(':uniacid' => $weid, ':uid' => $row['uid']));
        $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $row['bj_id1']));
        $lastbjq[$index]['bjname'] = $bj['sname'];
        $lastbjq[$index]['avatar'] = $member['avatar'];
    }
    $lasttime = time();

    //校园动态
    $lasttz = pdo_fetchall("SELECT * FROM ".tablename('wx_school_notice')." WHERE weid = '{$weid}' And schoolid = '{$schoolid}' ORDER BY createtime DESC LIMIT 0,6");
    foreach($lasttz as $key => $row){
        $bj = pdo_fetch("SELECT sname FROM " . tablename('wx_school_classify') . " WHERE sid = :sid", array(':sid' => $row['bj_id']));
        $ls = pdo_fetch("SELECT thumb,tname FROM " . tablename('wx_school_teachers') . " WHERE id = :id", array(':id' => $row['tid']));
        $lasttz[$key]['bjname'] = $bj['sname'];
        $lasttz[$key]['thumb'] = $ls['thumb']?$ls['thumb']:$school['tpic'];
        $lasttz[$key]['tname'] = $ls['tname'];

    }



    include $this->template ( 'bdactivity' );

}elseif($operation == 'firstdata'){
    /*
        * 班级圈信息统计
        */
    $photo = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' And msgtype = 1 ORDER BY createtime DESC ");

    $voice = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' And msgtype = 2 ORDER BY createtime DESC ");

    $video = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' And msgtype = 3 ORDER BY createtime DESC ");

    $share = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' And msgtype = 4 ORDER BY createtime DESC ");

    $bjq_series = array();
    $bjq_series[0]['name'] = '次数';
    $bjq_seriesdata = array(
        0 =>array('name'=>'图文','value'=>$photo['total']),
        1 =>array('name'=>'语音','value'=>$voice['total']),
        2 =>array('name'=>'视频','value'=>$video['total']),
        3 =>array('name'=>'分享','value'=>$share['total']),
    );

    $bjq_series[0]['data'] = $bjq_seriesdata;
    $new_bjq_data = SetEchartsData("班级圈信息统计","pie",false,0,$bjq_series);
    /*
    *   作业通知统计
    */
    //班级通知
    $classtz = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_notice') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' And type = 1 ORDER BY createtime DESC");

    //校园群发
    $schooltz = pdo_fetch('SELECT count(id) as total FROM ' . tablename('wx_school_notice') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' And type = 2 ORDER BY createtime DESC");

    //作业统计
    $worktz = pdo_fetch('SELECT count(id) as total FROM ' . tablename('wx_school_notice') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' And type = 3 ORDER BY createtime DESC");

    $tz_series = array();
    $tz_series[0]['name'] = '次数';
    $tz_seriesdata = array(
        0 =>array('name'=>'班级通知','value'=>$classtz['total']),
        1 =>array('name'=>'校园群发','value'=>$schooltz['total']),
        2 =>array('name'=>'作业统计','value'=>$worktz['total']),
    );

    $tz_series[0]['data'] = $tz_seriesdata;
    $new_tz_data = SetEchartsData("作业通知统计","pie",false,0,$tz_series);

    /*
     * 文章统计
     */
    //校园公告
    $article = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_news') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' And type = 'article' ORDER BY createtime DESC");

    //校园新闻
    $news = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_news') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' And type = 'news' ORDER BY createtime DESC");

    //精选文章
    $wenzhang = pdo_fetch("SELECT count(id) as total FROM " . tablename('wx_school_news') . " WHERE weid = '{$weid}' And schoolid = '{$schoolid}' And type = 'wenzhang' ORDER BY createtime DESC");

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



    //交互功能使用率
    $bjq = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_bjq') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  ");
    $bm = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_signup') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  ");
    $xc = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_media') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' And type = 2  ");
    $tz = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_notice') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}'  ");
    $ly = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' And isliuyan = 2 And isfrist = 1  ");
    $qj = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_school_leave') . " WHERE weid = '{$weid}' AND schoolid = '{$schoolid}' And isliuyan = 0  ");

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



    $return_data = array(
        'new_bjq_data' =>$new_bjq_data,
        'new_tz_data' =>$new_tz_data,
        'new_news_data' =>$new_news_data,
        'jhgn' =>$jhgn,
    );
    die(json_encode($return_data));
}elseif($operation == 'real_time_data'){
    $schoolid = $_GPC['schoolid'];
    $lasttime = $_GPC['lasttime']; //测试最后一次访问日期
    $nowtime = time(); //测试当前日期
    $result = array();
    //校园动态
    $lasttz = pdo_fetch("SELECT bj_id,tid,ismobile,tname,title,createtime,type FROM ".tablename('wx_school_notice')." WHERE weid = '{$weid}' And schoolid = '{$schoolid}' AND (createtime BETWEEN {$lasttime} AND {$nowtime}) ORDER BY createtime DESC");
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
    }

    //班级圈
    $lastbjq  = pdo_fetch("SELECT uid,shername,createtime,content,isopen,bj_id1,msgtype FROM " . tablename('wx_school_bjq') . " where schoolid = '{$schoolid}' And weid = '{$weid}' AND (createtime BETWEEN {$lasttime} AND {$nowtime}) AND isopen = '0' And type = 0 ORDER BY createtime DESC");
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
    }

    $result['lasttime'] =$nowtime;
    die(json_encode($result));
}
?>