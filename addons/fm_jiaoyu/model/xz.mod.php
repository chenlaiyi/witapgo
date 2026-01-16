<?php

mload()->model('snowflake');


function XzPortSendData($port, $sendData)
{
    $url = 'http://yz.kstms.com'.$port;

    $post_data = json_encode($sendData);
    if (empty($url) || empty($post_data)) {
        return false;
    }
    $postUrl = $url;
    $curlPost = $post_data;
    $curl = curl_init();
    if (version_compare(PHP_VERSION, '5.5.0', '>=')) {
        curl_setopt($curl, CURLOPT_URL, $postUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($curl);
    } else {
        curl_setopt($curl, CURLOPT_URL, $postUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($curl);
    }
    CommonWriteLog(array('url' =>$postUrl,'data'=>$curlPost,'result' => $response ), 'PortLog', 'XunZhen');
    return $response;
}

/**
 * 访客通知讯贞
 *
 * @param int $VisId
 *
 * @return void
 */
function XzAddVistorAct($VisId)
{
    $VisInfo = pdo_fetch("SELECT * FROM ".GetTableName('lxvis')." WHERE id = '{$VisId}' ");
    $sid = $VisInfo['sid'];
    $userid = $VisInfo['userid'];
    $schoolid = $VisInfo['schoolid'];
    $weid= $VisInfo['weid'];
    $UserInfo = pdo_fetch("SELECT realname,pard FROM ".GetTableName('user')." WHERE id = '{$userid}' ");
    $studentInfo = pdo_fetch("SELECT s_name FROM ".GetTableName('students')." WHERE id = '{$sid}' ");
    $PardName = array(
        '2' => '母亲',
        '3' => '父亲',
        '4' => '',
        '5' => '家长'
    );

    $checkVIsGroup = pdo_fetch("SELECT sid FROM ".GetTableName('classify')." WHERE type='visgroup' and sname = '访客' and  schoolid = '{$schoolid}' ");
    if (empty($checkVIsGroup)) {
        $insertData = array(
            'weid' => $weid,
            'schoolid' => $schoolid,
            'sname' => '访客',
            'type' => 'visgroup'
        );
        pdo_insert(GetTableName('classify', false), $insertData);
        $VGID = pdo_insertid();
    } else {
        $VGID = $checkVIsGroup['sid'];
    }
    $UserName = $UserInfo['realname'] ? $UserInfo['realname'] : $studentInfo['s_name'].$PardName[$UserInfo['pard']];
    $schoolid = $VisInfo['schoolid'];
    $weid = $VisInfo['weid'];
    $checkmac = pdo_fetch("SELECT macid FROM ".GetTableName('checkmac')." WHERE schoolid = '{$schoolid}' AND macname = 2 ORDER BY id DESC ");
    // $userInfos  = array(
    //     'idCardNum' => '',
    //     'imagePath' => tomedia($VisInfo['thumb']),
    //     'rfid'      => $VisInfo['tempcard'],
    //     'userName'  => $UserName,
    //     'userNo'    => $VisInfo['snowid'],
    //     'userType'  => 3,
    //     'groupNo'   => $VGID,
    //     'groupName' => '访客',
    //     'timeSet'  =>array(
    //         'timeType' => 'date',
    //         'date' => array(
    //             'day' => date("Y-m-d",$VisInfo['starttime']),
    //             'passTime'=>array(
    //                 0 => array(
    //                     'start' => date("H:i",$VisInfo['starttime']),
    //                     'end' => date("H:i",$VisInfo['endtime'])
    //                 )
                   
    //             )
    //         )
    //     )
    // );


    $userInfos  = array(
      'idCardNum' => '',
      'imagePath' => tomedia($VisInfo['thumb']),
      'rfid'      => $VisInfo['tempcard'],
      'userName'  => $UserName,
      'userNo'    => $VisInfo['snowid'],
      'userType'  => 5,
      'groupNo'   => $VGID,
      'groupName' => '访客',
      'timeSet'  =>array(
        array(
          'date'   => date("Y-m-d", $VisInfo['starttime']),
          's_type' => 5,
          'out_in' => 0,
          'start'  => date("H:i", $VisInfo['starttime']),
          'end'    => date("H:i", $VisInfo['endtime'])
        ),
            //   'day' => date("Y-m-d", $VisInfo['starttime']),
            //   'passTime'=>array(
            //       0 => array(
            //           'start' => date("H:i", $VisInfo['starttime']),
            //           'end' => date("H:i", $VisInfo['endtime'])
            //       )
                 
            //   )
            // )
        )
    );

    $sendData['deviceNo']  = $checkmac['macid'];
    $sendData['userInfos'][] = $userInfos;
    CommonWriteLog($sendData, 'xzlog', 'xunzhen');
    $porturl = '/add_users_by_device.do';
    $res = json_decode(XzPortSendData($porturl, $sendData), true);
    return $res;
}

/**
 * 修改时间设置后，向讯贞推送对应的新的时间设置
 *
 * @param [type] $schoolid
 * @param [type] $id
 * @param [type] $opera
 *
 * @return void
 */
function XzGetSetTimeData($schoolid, $id, $opera)
{
    $checkmac = pdo_fetch("SELECT macid FROM ".GetTableName('checkmac')." WHERE schoolid = '{$schoolid}' AND macname = 2 ORDER BY id DESC ");
    if (empty($checkmac['macid'])) {
        return false;
    }

    $checkdateset = pdo_fetch("SELECT * FROM ".GetTableName('checkdateset')." WHERE schoolid = '{$schoolid}' AND id = '{$id}' ");
    $bjlist = pdo_fetchall("SELECT sid FROM ".GetTableName('classify')." WHERE schoolid = '{$schoolid}' AND datesetid = '{$id}' ");
    $nowdate = strtotime(date("Ymd", time()));
    $data = [];
    $datatemp = [];
    if ($opera == 'del') {
        $datatemp[] = array(
            's_type' => 0,
            'out_in' => 0,
            'start'  => '00:00',
            'end'    => '23:59',
        );
 
    } else {
        $date = date("Y-m-j", $nowdate);
        // 取出当天数据是否为特殊设置
        $list = pdo_fetchall("SELECT s_type,start,end,out_in FROM ".GetTableName('checktimeset')." WHERE schoolid = '{$schoolid}' AND date = '{$date}' AND checkdatesetid = '{$id}' ORDER BY id DESC");
        //如果有特殊设置，根据特殊设置的来
        if ($list) {
            $datatemp = $list;
 
        } else { //判断是否属于寒暑假日期范围
            $holiday = pdo_fetch("SELECT id FROM ".GetTableName('checkdatedetail')." WHERE schoolid = '{$schoolid}' AND checkdatesetid = '{$id}' AND ((unix_timestamp(sum_start) <= '{$nowdate}' AND unix_timestamp(sum_end) >= '{$nowdate}') OR (unix_timestamp(win_start) <= '{$nowdate}' AND unix_timestamp(win_end) >= '{$nowdate}'))");
            if ($holiday) { //在假期范围内，则为全天
                $datatemp[] = array(
                    's_type' => 0,
                    'out_in' => 0,
                    'start'  => '00:00',
                    'end'    => '23:59',
                );
 
            } else { //既不是特殊设置，也不是假期
                $nowday = date("w", $nowdate);
                if ($nowday == 5) { //周五
                    $type = '2';
                    if ($checkdateset['friday'] == 1) { //如果启用了周五单独设置
                        $speciallist = pdo_fetchall("SELECT s_type,start,end,out_in FROM ".GetTableName('checktimeset')." WHERE schoolid = '{$schoolid}' AND type = '{$type}' AND checkdatesetid = '{$id}'");
                    } else {
                        $speciallist = pdo_fetchall("SELECT s_type,start,end,out_in FROM ".GetTableName('checktimeset')." WHERE schoolid = '{$schoolid}' AND type = '1' AND checkdatesetid = '{$id}'");
                    }
                } elseif ($nowday == 6) { //周六
                    $type = '3';
                    if ($checkdateset['saturday'] == 1) { //如果启用了周六单独设置
                        $speciallist = pdo_fetchall("SELECT s_type,start,end,out_in FROM ".GetTableName('checktimeset')." WHERE schoolid = '{$schoolid}' AND type = '{$type}' AND checkdatesetid = '{$id}'");
                    }
                } elseif ($nowday == 0) {
                    $type = '4';
                    if ($checkdateset['sunday'] == 1) { //如果启用了周日单独设置
                        $speciallist = pdo_fetchall("SELECT s_type,start,end,out_in FROM ".GetTableName('checktimeset')." WHERE schoolid = '{$schoolid}' AND type = '{$type}' AND checkdatesetid = '{$id}'");
                    }
                } else { //周一至周四
                    $type = '1';
                    $speciallist = pdo_fetchall("SELECT s_type,start,end,out_in FROM ".GetTableName('checktimeset')." WHERE schoolid = '{$schoolid}' AND type = '{$type}' AND checkdatesetid = '{$id}'");
                }
    
                if ($speciallist) { //查出来了就按照查出来的
                    $datatemp = $speciallist;
 
                } else { //没查出来就全天
                    $datatemp[] = array(
                        's_type' => 0,
                        'out_in' => 0,
                        'start'  => '00:00',
                        'end'    => '23:59',
                    );
                }
            }
        }
    }
 
    $TempTimeSet = [];
    foreach ($datatemp as $vt) {
      $TempTimeSet[] = $vt;
    }

    foreach ($bjlist as $key => $value) {
        $datat['classid'] = $value['sid'];
        $datat['timeSet'] = $TempTimeSet;
        $data['list'][] = $datat;
    }
    $data['deviceNo']  = $checkmac['macid'];
    CommonWriteLog('提交数据', 'PortLog', 'XunZhen');
    CommonWriteLog($data, 'PortLog', 'XunZhen');

    $porturl = '/wjy/reset_time_set.do';
    $res = json_decode(XzPortSendData($porturl, $data), true);
    CommonWriteLog('接口返回', 'PortLog', 'XunZhen');
    CommonWriteLog($res, 'PortLog', 'XunZhen');

    return $data;
}
