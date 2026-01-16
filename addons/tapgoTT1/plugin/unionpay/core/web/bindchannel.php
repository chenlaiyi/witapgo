<?php

/*
 * 银联机构
 * wilson
 */
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Bindchannel_EweiShopV2Page extends WebPage {

    function main() {

        global $_W,$_GPC;
        $type = trim($_GPC['type']);
        if(!cv('unionpay.bingchannel.'.$type)){
            $this->message("你没有相应的权限查看");
        }
        $id = intval($_GPC['upid']);
        $profile = m('member')->getMember($id, true);
        $profile_levelname  =   pdo_get('tapgo_tt_commission_level', array('uniacid' => $_W['uniacid'], 'id' => $profile['agentlevel']), array('levelname'));
        $upinfo =  pdo_fetch('select * from ' . tablename('tapgo_tt_unionpay_agent') . ' where upid=:upid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':upid' => $id));
        $uplevel    =   pdo_getall('tapgo_tt_unionpay_level', array('uniacid' => $_W['uniacid']), array('upagentlevel', 'levelname'));
        if(!empty($upinfo)){
            $upagentlevel   =   $upinfo['upagentlevel'];
        }else{
            switch ($profile['agentlevel'])
            {
                case '20':
                    $upagentlevel = '2';
                    break;
                case '21':
                    $upagentlevel = '3';
                    break;
                case '22':
                    $upagentlevel = '4';
                    break;
                case '24':
                    $upagentlevel = '5';
                    break;
                case '23':
                    $upagentlevel = '6';
                    break;
                default:
                    $upagentlevel = '1';
            }
        }


        if ($_W['ispost']) {
            //查询已绑定的机构编号
            $check_channelId = pdo_fetchall("SELECT hnapay_channelId, newland_channelId FROM ".tablename('tapgo_tt_unionpay_agent'). ' where upid<>:upid and uniacid=:uniacid', array(':uniacid' => $_W['uniacid'], ':upid' => $id));

            if($type=='hnapay'){
                foreach ($check_channelId as $k => $v) {
                    if($v['hnapay_channelId'] == $_GPC['hnapay_channelId']){
                        show_json(0, array('message' => '该新生机构编号已存在，请核对后重试'));
                    }
                }

                $data = array(
                    'hnapay_lock'       => trim($_GPC['hnapay_lock']),
                    'hnapay_realname'   => trim($_GPC['hnapay_realname']),
                    'hnapay_channelId'  => trim($_GPC['hnapay_channelId']),
                    'hnapay_secret'     => trim($_GPC['hnapay_secret']),
                    'hnapay_feilv'      => trim($_GPC['hnapay_feilv']),
                    'hnapay_upfeilv'    => trim($_GPC['hnapay_upfeilv']),
                    'hnabilldatetime'   => $profile['agenttime'] ? date('Y-m-d',$profile['agenttime']) : date('Y-m-d',$profile['createtime']),
                );

            }
            if($type=='newland'){
                foreach ($check_channelId as $k => $v) {
                    if($v['newland_channelId'] == $_GPC['newland_channelId']){
                        show_json(0, array('message' => '该新大陆机构编号已存在，请核对后重试'));
                    }
                }

                $data = array(
                    'newland_lock'      => trim($_GPC['newland_lock']),
                    'newland_realname'  => trim($_GPC['newland_realname']),
                    'newland_channelId' => trim($_GPC['newland_channelId']),
                    'newland_secret'    => trim($_GPC['newland_secret']),
                    'newland_feilv'     => trim($_GPC['newland_feilv']),
                    'newland_upfeilv'   => trim($_GPC['newland_upfeilv']),
                    'nlbilldatetime'    => date('Y-m-d',time()),
                );
            }

            $data['upid']           =   $id;
            $data['uniacid']        =   $_W['uniacid'];
            $data['upagentid']      =   $profile['agentid'];
            $data['upagentlevel']   =   trim($_GPC['upagentlevel']);

            if(!empty($upinfo)){
                //更新数据
                pdo_update('tapgo_tt_unionpay_agent', $data, array('upid' => $id));
                $logupid    =   $id;
            }else{
                //插入新记录
                $data['upupdatetime']   =   date("Y-m-d H:i:s" ,time());
                pdo_insert('tapgo_tt_unionpay_agent', $data);
                $logupid = pdo_insertid();
            }
            show_json(1, array('message' => $type.'机构更新成功，UPID：'.$logupid));
        }
        include $this->template();
    }

}
