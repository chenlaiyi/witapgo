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
$city   = pdo_fetchall("SELECT * FROM " . tablename('wx_school_area') . " where weid = '{$weid}' And type = 'city' ORDER BY ssort DESC");
$area   = pdo_fetchall("SELECT * FROM " . tablename('wx_school_area') . " where weid = '{$weid}' And type = '' ORDER BY ssort DESC");
$outthis = MODULE_URL;
$schooltype = pdo_fetchall("SELECT * FROM " . tablename('wx_school_type') . " where weid = '{$weid}' ORDER BY ssort DESC");
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($myadmin['schoolid']){
    $urls = $_W['siteroot'] .'web/'.$this->createWebUrl('start', array('schoolid' => $myadmin['schoolid']));
    header("location:$urls");
    exit;
}
if ($operation == 'display') {

    

    $starttime   = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $endtime     = $starttime + 86399;
    $zrstarttime = $starttime - 86399;
    $conditions  = " AND createtime > '{$starttime}' AND createtime < '{$endtime}'";
    $conditionss = " AND createtime > '{$zrstarttime}' AND createtime < '{$starttime}'";

    if (!empty($_GPC['keyword'])) {
        $condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
    }
    if (!empty($_GPC['areaid'])) {
        $areaid = $_GPC['areaid'];
        $condition .= " AND areaid = '{$areaid}'";
    }
    if (!empty($_GPC['typeid'])) {
        $typeid = $_GPC['typeid'];
        $condition .= " AND typeid = '{$typeid}'";
    }
    $pindex = max(1, intval($_GPC['page']));
    $psize = 10;
    if($_W['isfounder'] || $_W['role'] == 'owner') {
        $where = "WHERE weid = '{$weid}'";
    }else{
        $uid = $_W['user']['uid'];
        $where = "WHERE weid = '{$weid}' And uid = '{$uid}' And is_show = 1 ";
    }
    $where1 = "WHERE weid = '{$weid}' And schoolid = '{$id}'";
    $schoollist = pdo_fetchall("SELECT id,title,typeid,cityid,areaid,logo,address,tel FROM " . tablename('wx_school_index') . " $where $condition   order by ssort desc,id desc LIMIT " . ($pindex - 1) * $psize . ",{$psize}");

    if (!empty($schoollist)) {
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('wx_school_index') . " $where $condition");
        $pager = pagination($total, $pindex, $psize);
    }
    $versionfile = IA_ROOT . '/addons/fm_jiaoyu/inc/func/auth2.php';
    require $versionfile;
    foreach($schoollist as $key => $row){
        $shoptype         = pdo_fetch("SELECT name FROM " . tablename('wx_school_type') . " where weid = :weid And id = :id", array(':weid' => $weid,':id' => $row['typeid']));
        $citys            = pdo_fetch("SELECT name FROM " . tablename('wx_school_area') . " where weid = :weid And id = :id", array(':weid' => $weid,':id' => $row['cityid']));
        $quyu             = pdo_fetch("SELECT name FROM " . tablename('wx_school_area') . " where weid = :weid And id = :id", array(':weid' => $weid,':id' => $row['areaid']));
        $school_other_set = pdo_fetch("SELECT is_bigdata FROM " . tablename('wx_school_schoolset') . " where weid = :weid And schoolid = :schoolidid", array(':weid' => $weid,':schoolidid' => $row['id']));
        $schoollist[$key]['leixing']    = $shoptype['name'];
        $schoollist[$key]['city']       = $citys['name'];
        $schoollist[$key]['qujian']     = $quyu['name'];
        $schoollist[$key]['is_bigdata'] = !empty($school_other_set['is_bigdata'])?$school_other_set['is_bigdata']:0;
    }
    //var_dump($schoollist);
    include $this->template ( 'web/schoolbdset' );
}elseif($operation == 'GetAllSet'){
    $schoollist = pdo_fetchall("SELECT id,title FROM " .GetTableName('index'). " WHERE weid = '{$weid}' ORDER BY id ASC ");

    $bdall_info = pdo_fetch("SELECT bdall_pwdus,bdall_title,bdall_in_school,bdall_centerpoint,bdall_shorturl FROM ".GetTableName('set')." WHERE  weid = '{$weid}'  ");
    
    //处理短地址
    if(empty($bdall_info['bdall_shorturl'])){
        $long_url = $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&do=login_all&m=fm_jiaoyu_plugin_bigdata';
        $account_api = WeAccount::create();
        $result = $account_api->long2short($long_url);
        $bdall_info['bdall_shorturl'] = $result['short_url'];
        pdo_update(GetTableName('set',false), array('bdall_shorturl' => $bdall_info['bdall_shorturl']), array('weid' => $weid));
    }else{
        $bdall_info['bdall_shorturl'] = $bdall_info['bdall_shorturl'];
    }
    //处理标题
    if(empty($bdall_info['bdall_title'])){
        $bdall_info['bdall_title'] = "汇总大数据平台";
        pdo_update(GetTableName('set',false), array('bdall_title' => $bdall_info['bdall_title']), array('weid' => $weid));
    }
    //处理密码
    if(empty($bdall_info['bdall_pwdus'])){
        $bdall_info['bdall_pwdus'] = "123456";
        pdo_update(GetTableName('set',false), array('bdall_pwdus' => $bdall_info['bdall_pwdus']), array('weid' => $weid));
    }

    //处理展示中心坐标
    if(empty($bdall_info['bdall_centerpoint'])){
        $default = pdo_fetch("SELECT lat,lng FROM ".GetTableName('index')." WHERE weid = '{$weid}' ORDER BY id ");
        $bdall_info['bdall_centerpoint'] = json_encode(array(
            'lat' => $default['lat'],
            'lng' => $default['lng']
        ));
        $bdall_info['centerpoint'] = array(
            'lat' => $default['lat'],
            'lng' => $default['lng']
        );
        pdo_update(GetTableName('set',false), array('bdall_centerpoint' => $bdall_info['bdall_centerpoint']), array('weid' => $weid));
    }else{
        $bdall_info['centerpoint'] = json_decode($bdall_info['bdall_centerpoint'],true);
    }
    //处理统计学校
    if(empty($bdall_info['bdall_in_school'])){
        $sl = pdo_fetchall("SELECT id FROM ".GetTableName('index')." WHERE weid = '{$weid}' ");
        $sls = '';
        foreach($sl as $r){
            $sls .= $r['id'].',';
        }
        $sls = trim($sls,',');
        $bdall_info['bdall_in_school'] = $sls;
        pdo_update(GetTableName('set',false), array('bdall_in_school' => $bdall_info['bdall_in_school']), array('weid' => $weid));
    }
    include $this->template ( 'web/bdset_bot' );
}elseif($operation == 'SetAllSet'){
    $ckslist = $_GPC['ckslist'];
    $title   = $_GPC['bdalltitle'];
    $pwd     = $_GPC['bdallpwd'];
    $centerpoint = $_GPC['centerpoint'];
    $insert = array(
        'bdall_title'  => $title,
        'bdall_pwdus'  => $pwd,
        'bdall_centerpoint' => json_encode($centerpoint),
        'bdall_in_school' => implode(",",$ckslist)
    );
    pdo_update(GetTableName('set',false),$insert,array('weid'=>$weid));
    die(json_encode(array(
        'status' => 200,
        'msg' => '修改成功'
    )));
}elseif($operation == 'change_schoolbdset'){
    $schoolid = $_GPC['id'];
    $is_bigdata = $_GPC['is_bigdata'];
    $check = pdo_fetch("SELECT * FROM " . tablename('wx_school_schoolset') . " where weid = :weid And schoolid = :schoolidid", array(':weid' => $weid,':schoolidid' => $schoolid));
    if(!empty($check)){
        pdo_update('wx_school_schoolset',array('is_bigdata'=>$is_bigdata),array('weid'=>$weid,'schoolid'=>$schoolid));
    }elseif(empty($check)){
        $insert_data = array(
          'weid'        =>$weid,
          'schoolid'    => $schoolid,
          'is_bigdata'  => $is_bigdata
        );
        pdo_insert('wx_school_schoolset',$insert_data);
    }
    $result['status'] = 'success';
    $result['status'] = '修改成功';
    die(json_encode($result));
}elseif($operation == 'getbdpwd'){
    if (! $_GPC ['weid']) {
        die ( json_encode ( array (
            'result' => false,
            'msg' => '非法请求！'
        ) ) );
    }else{
        $data = array();
        $res = pdo_fetch("SELECT pwd,short_url,bgtitle FROM " . tablename('wx_school_schoolset') . " where weid = '{$_GPC['weid']}' AND schoolid = '{$_GPC ['schoolid']}' ORDER BY id DESC");

        if(empty($res['short_url'])){
            $long_url      = $_W['siteroot'] . 'app/index.php?i=' . $_GPC ['weid'] . '&c=entry&schoolid=' . $_GPC ['schoolid'] . '&do=login&m=fm_jiaoyu_plugin_bigdata';
            $account_api = WeAccount::create();
            $result = $account_api->long2short($long_url);
            $data['short_url'] = $result['short_url'];
            pdo_update('wx_school_schoolset', array('short_url' => $data['short_url']), array('schoolid' => $_GPC ['schoolid']));
        }else{
            $data['short_url'] = $res['short_url'];
        }
        $data ['pwd'] = $res['pwd'];
        $data ['bgtitle'] = $res['bgtitle'];
        $data ['schoolid'] = $_GPC ['schoolid'];
        $data ['result'] = true;
        die ( json_encode ( $data ) );

    }
}elseif($operation == 'setbdpwd'){
    if (! $_GPC ['weid']) {
        die ( json_encode ( array (
            'result' => false,
            'msg' => '非法请求！'
        ) ) );
    }else{
        $data = array();
        $pwd = md5($_GPC['pwd']);
        $bgtitle = htmlspecialchars($_GPC['bgtitle']);
        $schoolid = $_GPC['schoolid'];
        $weid = $_GPC['weid'];
        pdo_update('wx_school_schoolset',array('pwd'=>$pwd,'bgtitle'=>$bgtitle),array('weid'=>$weid,'schoolid'=>$schoolid));
        $data ['result'] = true;
        $data['mes'] = '修改成功';
        die ( json_encode ( $data ) );
     }
}
?>