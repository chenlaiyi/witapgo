<?php

namespace app\index\controller;

use think\Controller;

class Brokerage extends Controller
{
    
    /**
     * 分销管理
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=brokerage&tp_a=index
     */
    public function index(){
        global $_W;
        
        $result = array();
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $user = pdo_get('wjyk_zqds_user',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $result['brokerage_wait'] = $user['brokerage_wait'];
        
        $result['qrcode'] = $user['qrcode'];
        
        $date = date("Y-m-d",strtotime("-1 day"));

        $yesterday = pdo_fetchcolumn("SELECT IFNULL(SUM(money),0.00) FROM " . tablename('wjyk_zqds_brokerage_log') . " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y-%m-%d') = '{$date}'  AND  uid = :uid  AND uniacid = :uniacid ",array(
            ':uniacid' => $_W['uniacid'],
            ':uid' =>$uid
        ));
        $result['yesterday'] = $yesterday;
        
        if(!empty($user['pid'])){
            $p_user = pdo_get('wjyk_zqds_user', array(
                'uid' => $user['pid'],
                'uniacid' => $_W['uniacid']
            ));
            $result['pUser']  = $p_user['nickname'];
        }else{
            $result['pUser']  = '平台';
        }
         
        return result(0, 'success',$result);
    }
    
    /**
     * 分销设置
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=brokerage&tp_a=set
     */
    public function set(){
        global $_W;
    
        $set = pdo_get("wjyk_zqds_brokerage_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(empty($set)){
            $set = [];
        }
    
        return result(0, 'success',$set);
    }
    
    /**
     * 我的团队
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=brokerage&tp_a=my_team
     * @param
     *         type  1-一级   2-二级  3-三级 
     */
    public function my_team(){
        global $_W,$_GPC;
        
        $type = $_GPC['type'];
        
        if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        }

        $offline = array();
        if($type == 1){
        
            $offline = pdo_getall('wjyk_zqds_user',array(
                'pid' => $uid,
                'uniacid' => $_W['uniacid']
            ));
        
        }elseif($type == 2){
            $userList = pdo_getall('wjyk_zqds_user',array(
                'pid' => $uid,
                'uniacid' => $_W['uniacid']
            ));
        
            foreach ($userList as $k => $v) {
        
                $puser = pdo_getall('wjyk_zqds_user',array(
                    'pid' => $v['uid'],
                    'uniacid' => $_W['uniacid']
                ));
        
                foreach ($puser as $key => $value) {
                    $user = pdo_get('wjyk_zqds_user',array(
                        'uid' => $value['uid'],
                        'uniacid' => $_W['uniacid']
                    ));
        
                    array_push($offline, $user);
                }
            }
        
        }else{
        
            $userList = pdo_getall('wjyk_zqds_user',array(
                'pid' => $uid,
                'uniacid' => $_W['uniacid']
            ));
        
            foreach ($userList as $k => $v) {
        
                $ppuser = pdo_getall('wjyk_zqds_user',array(
                    'pid' => $v['uid'],
                    'uniacid' => $_W['uniacid']
                ));
        
                foreach ($ppuser as $key => $value) {
                    $puser = pdo_getall('wjyk_zqds_user',array(
                        'pid' => $value['uid'],
                        'uniacid' => $_W['uniacid']
                    ));
        
        
                    foreach ($puser as $kk => $vv) {
                        $user = pdo_get('wjyk_zqds_user',array(
                            'uid' => $vv['uid'],
                            'uniacid' => $_W['uniacid']
                        ));
                        array_push($offline, $user);
                    }
                }
            }
        
             
        }
        
        
        foreach ($offline as $k => $v) {
            $offline[$k]['createtime'] = date("Y/m/d",$v['createtime']);
        
        }
        
        
        return result(0, 'success',$offline);
    }
    
    
    /**
     * 我的佣金
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=brokerage&tp_a=log_list
     * @param
     *         yeartime 年份
     * @param
     *         monthtime 月份         
     * @param
     *         page  页码
     * @param
     *         psize  每页条数 
     */
    public function log_list()
    {
        global $_W,$_GPC;
        
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
    
        $condition .= " AND pid = :uid";
        $params[':uid'] = $uid;
        
        if(!empty(input('yeartime'))){
            $yeartime = input('yeartime');
            $condition .= " AND DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y') = '{$yeartime}' ";
        }
        
        if(!empty(input('monthtime'))){
            $monthtime = input('monthtime');
            $condition .= " AND DATE_FORMAT(FROM_UNIXTIME(createtime),'%m') = '{$monthtime}' ";
        }
        
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_brokerage_log') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by createtime desc ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_brokerage_log')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
                
                $user = pdo_get('wjyk_zqds_user',array(
                    'uid' => $v['uid'],
                    'uniacid' => $_W['uniacid']
                ));
                
                $list[$k]['avatar'] = $user['avatar'];
                $list[$k]['nickname'] = $user['nickname'];
                $list[$k]['createtime'] = date("Y-m-d H:i",$v['createtime']);
                
            }
        }else{
            $list = array();
        }
        
        if(!empty(input('yeartime'))){
            $yeartime = input('yeartime');
        }else{
            $yeartime = date("Y",time());
        }
        
        $year = pdo_fetchcolumn("SELECT IFNULL(SUM(money),0.00) FROM " . tablename('wjyk_zqds_brokerage_log') . " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y') = '{$yeartime}' AND pid = :uid  AND uniacid = :uniacid ",array(
            ':uniacid' => $_W['uniacid'],
            ':uid' =>$uid
        ));
        
        if(!empty(input('monthtime'))){
            $date = input('yeartime')."-".input('monthtime');
            $monthtime = input('monthtime');
        }else{
            $date = date("Y-m",time());
            $monthtime = date("m",time());
        }
        
        
        $month = pdo_fetchcolumn("SELECT IFNULL(SUM(money),0.00) FROM " . tablename('wjyk_zqds_brokerage_log') . " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y-%m') = '{$date}' AND pid = :uid  AND uniacid = :uniacid ",array(
            ':uniacid' => $_W['uniacid'],
            ':uid' =>$uid
        ));
        
    
        
        $totalPage = ceil($total / $psize);
    
        return result(0, 'success', array(
            'list' => $list,
            'year' => $year,
            'month' => $month,
            'yeartime' => $yeartime,
            'monthtime' => $monthtime,
            'total' => $total,
            'pindex' => $pindex,
            'psize' => $psize,
            'totalPage' => $totalPage
        ));
    }
    
    /**
     * 提现记录
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=brokerage&tp_a=brokerage_list
     * @param
     *         page  页码
     * @param
     *         psize  每页条数 
     */
    public function brokerage_list()
    {
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
    
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
    
        $condition .= " AND uid = :uid";
        $params[':uid'] = $uid;
    
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_brokerage') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by createtime desc ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_brokerage')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
    
                $user = pdo_get('wjyk_zqds_user',array(
                    'uid' => $v['uid'],
                    'uniacid' => $_W['uniacid']
                ));
    
                $list[$k]['avatar'] = $user['avatar'];
                $list[$k]['nickname'] = $user['nickname'];
                $list[$k]['createtime'] = date("Y-m-d H:i",$v['createtime']);
    
                $list[$k]['text'] = '用户提现';
            }
        }else{
            $list = array();
        }
    
        
        $totalPage = ceil($total / $psize);
    
        return result(0, 'success', array(
            'list' => $list,
            'total' => $total,
            'pindex' => $pindex,
            'psize' => $psize,
            'totalPage' => $totalPage
        ));
    }
    
    /**
     * 提现申请
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=brokerage&tp_a=cashWait
     * @param
     *        brokerage_wait 申请佣金
     * @param
     *        cash_type 1-线下提现到银行卡，2-线上提现到微信  3-提现到余额
     * @param
     *        nickname 姓名
     * @param
     *        telphone 电话
     * @param
     *        bank_name 银行名称     
     * @param
     *        bank_no 银行卡号              
     */
    public function cashWait(){
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        if(empty(input('brokerage_wait'))){
            return result(-1,'申请佣金为空');
        }
        
        $data = array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'cashno' => $this->getTextNo('CA'),
            'brokerage_wait' => input('brokerage_wait'),
            'is_status' => 1,
            'cash_type' => input('cash_type'),
            'nickname' => input('nickname'),
            'telphone' => input('telphone'),
            'bank_name' => input('bank_name'),
            'bank_no' => input('bank_no'),
            'createtime' => time()
        );
        
        $set = pdo_get("wjyk_zqds_brokerage_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if ($set['cash_charge'] != '' || $set['cash_charge'] != 0) {
            $data['cash_charge'] = $set['cash_charge'];
            $data['service_charge'] = round(input('brokerage_wait') * $set['cash_charge'] / 100, 2);
            $data['brokerage_actual'] = input('brokerage_wait') - $data['service_charge'];
        } else {
            $data['service_charge'] = 0;
            $data['brokerage_actual'] = input('brokerage_wait');
        }

        $result = pdo_insert('wjyk_zqds_brokerage',$data);
        
        if ($result) {
            pdo_update('wjyk_zqds_user',array(
                'brokerage_wait -=' => input('brokerage_wait')
            ),array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid']
            ));
            return result(0,'申请成功');
        } else {
            return result(-1,'申请失败');
        }
    }
    
    public function getTextNo($text)
    {
        return $text . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    
    
}
