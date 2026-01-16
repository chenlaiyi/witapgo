<?php
/*珍贵资源 请勿转卖*/
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Sendticket_TapgoTtComModel extends ComModel {


    function getInfo(){
        global $_W,$_GPC;
        $openid = $_W['openid'];

        if(!com('coupon')){
            return false;
        }

        $member =  m('member')->getMember($_W['openid']);
        $condition = ' WHERE uniacid = :uniacid AND openid = :openid';
        $paramso = array(
            ':uniacid' => intval($_W['uniacid']),
            ':openid' => trim($openid),
        );
        $osql = 'SELECT * FROM '.tablename('tapgo_tt_order').$condition;
        $order = pdo_fetchall($osql,$paramso);
      
        if (empty($order)) {

            $sql2 = 'SELECT * FROM '.tablename('tapgo_tt_sendticket').' WHERE uniacid = '.intval($_W['uniacid']);
            $ticket = pdo_fetch($sql2);
            if ($ticket['status'] == 1) {
                if ($ticket['expiration'] == 1) {
                    if (TIMESTAMP > $ticket['endtime']) {
                        $status = array('status' => 0);
                        pdo_update('tapgo_tt_sendticket',$status,array('id' => $ticket['id']));
                        return false;
                    } else {

                        $cpinfo = $this -> getCoupon($ticket['cpid']);

                        if (empty($cpinfo)) {
                            return false;
                        } else {
                            $insert = $this -> insertDraw($openid,$cpinfo);
                            if ($insert) {
                                if(count($cpinfo) == count($cpinfo, 1)){
                                        $status = $this -> sendTicket($openid,$cpinfo['id'],14);
                                        if (!$status) {
                                            return false;
                                        } else {
                                            $cpinfo['did'] = $status;
                                        }
                                }else{
                                    foreach ($cpinfo as $cpk => $cpv) {
                                        $status = $this -> sendTicket($openid,$cpv['id'],14);
                                        if (!$status) {
                                            return false;
                                        } else {
                                            $cpinfo[$cpk]['did'] = $status;
                                        }
                                    }
                                }

                                return $cpinfo;
                            } else {
                                return false;
                            }
                        }
                    }
                } else {
                    $cpinfo = $this -> getCoupon($ticket['cpid']);
                    if (empty($cpinfo)) {
                        return false;
                    } else {
                        $insert = $this -> insertDraw($openid,$cpinfo);
                        if ($insert) {
                            if(count($cpinfo) == count($cpinfo, 1)){
                                $status = $this -> sendTicket($openid,$cpinfo['id'],14);
                                if (!$status) {
                                    return false;
                                } else {
                                    $cpinfo['did'] = $status;
                                }
                            }else{
                                foreach ($cpinfo as $cpk => $cpv) {
                                    $status = $this -> sendTicket($openid,$cpv['id'],14);
                                    if (!$status) {
                                        return false;
                                    } else {
                                        $cpinfo[$cpk]['did'] = $status;
                                    }
                                }
                            }

                            return $cpinfo;
                        } else {
                            return false;
                        }
                    }
                }
            } else if ($ticket['status'] == 0) {
                return false;
            }
        } else {
            return false;
        }

    }


    function getCoupon($cpid){
        global $_W,$_GPC;
        if (strpos($cpid,',')) {
            $cpids = explode(',',$cpid);
        } else {
            $cpids = $cpid;
        }

        if(is_array($cpids)){
            $cpinfo = array();
            foreach ($cpids as $cpk => $cpv) {
                $cpsql = 'SELECT * FROM '.tablename('tapgo_tt_coupon').' WHERE uniacid = '.intval($_W['uniacid']).' AND id = '.intval($cpv);
                $list = pdo_fetch($cpsql);
                if($list['timelimit'] == 1) {
                    if (TIMESTAMP < $list['timeend']) {
                        $cpinfo[$cpk] = $list;
                    }
                }else if($list['timelimit'] == 0){
                    $cpinfo[$cpk] = $list;
                }

            }
            return $cpinfo;
        }else {
            $cpsql = 'SELECT * FROM '.tablename('tapgo_tt_coupon').' WHERE uniacid = '.intval($_W['uniacid']).' AND id = '.intval($cpid);
            $cpinfo = pdo_fetch($cpsql);
            return $cpinfo;
        }
    }




    function sendTicket($openid, $couponid,$gettype=0) {
        global $_W, $_GPC;
 
        $couponlog = array(
            'uniacid' => $_W['uniacid'],
            'openid' => $openid,
            'logno' => m('common')->createNO('coupon_log', 'logno', 'CC'),
            'couponid' => $couponid,
            'status' => 1,
            'paystatus' => -1,
            'creditstatus' => -1,
            'createtime' => time(),
            'getfrom' => 3
        );
        $log = pdo_insert('tapgo_tt_coupon_log', $couponlog);

    
        $data = array(
            'uniacid' => $_W['uniacid'],
            'openid' => $openid,
            'couponid' => $couponid,
            'gettype' => $gettype,
            'gettime' => time()
        );
        $data = pdo_insert('tapgo_tt_coupon_data', $data);
        $did = pdo_insertid();
        if ($log && $data) {
            return $did;
        } else {
            return false;
        }

    }

    function share($money){
        $activity = $this -> activity($money);
        if (!empty($activity)) {
            return true;
        }else{
            return false;
        }
    }

    function activity($money){
        global $_W;
        $sql = 'SELECT * FROM '.tablename('tapgo_tt_sendticket_share').' WHERE uniacid = '.intval($_W['uniacid']).' AND status = 1 AND (enough = '.$money.' OR enough <= '.$money.') AND (expiration = 0 OR (expiration = 1 AND endtime >= '.TIMESTAMP.')) ORDER BY enough DESC,createtime DESC LIMIT 1';
        $activity = pdo_fetch($sql);
        return $activity;
    }

}
