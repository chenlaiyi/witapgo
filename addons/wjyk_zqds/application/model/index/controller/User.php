<?php

namespace app\index\controller;

use think\Controller;

class User extends Controller
{

    /**
     * 个人信息
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=user_info
     */
    public function user_info()
    {
        global $_W;
        
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
        
        
        $collect = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_collect"). " WHERE uid = :uid AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $user['collectCount'] = $collect;
        
        $focus = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_focus"). " WHERE uid = :uid AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $user['focusCount'] = $focus;
        
        $history = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("wjyk_zqds_view_history"). " WHERE uid = :uid AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $user['historyCount'] = $history;
        
        
        
        if(!empty($user['maturity_time'])){
            $user['maturity_time'] = date('Y-m-d',$user['maturity_time']);
        }
        
        $date = date('Y-m-d',time());
        
        $integral = pdo_fetch("SELECT * FROM ".tablename("wjyk_zqds_integral_log"). " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y-%m-%d') = '{$date}'  AND type = 1 AND uid = :uid AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        if(!empty($integral)){
            $user['integralFlag'] = 1;
        }else{
            $user['integralFlag'] = 0;
        }
        
        $teacher = pdo_get('wjyk_zqds_teacher',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        if(!empty($teacher)){
            $user['flag'] = 1;
            $user['teacherid'] = $teacher['id'];
            $user['teacherstatus'] = $teacher['is_status'];
        }else{
            $user['flag'] = 0;
            $user['teacherid'] = '';
            $user['teacherstatus'] = '';
        }
        
        $set = pdo_get('wjyk_zqds_integral',array(
            'uniacid' => $_W['uniacid'],
        ));
        
        if(empty($set['get'])){
            $user['get'] = 0;
        }else{
            $user['get'] = $set['get'];
        }
         
        return result(0, 'success',$user);
    }
    
    /**
     * 扣除余额
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=balance_pay
     * @param
     *         money  金额
     */
    public function balance_pay(){
        global $_W,$_GPC;
        
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
        
        if(input('money') > $user['balance'] ){
            return result(-1,'余额不足');
            exit();
        }
        
        $result = pdo_update('wjyk_zqds_user',array(
            'balance -='=> input('money')
        ),array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
        ));

        if($result){
            
            $log = [
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
                'money' => input('money'),
                'type' => 2,
                'text' =>'购买课程',
                'createtime' => time()
            ];
            pdo_insert('wjyk_zqds_payment_log',$log);
            
            return result(0,'扣除成功');
        }else{
            return result(-1,'扣除失败');
        }

    }
    
    /**
     * 我的课程
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=my_course
     */
    public function my_course(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
        
        $condition = " c.uniacid = :uniacid AND co.uniacid = :uniacid ";
        $params[':uniacid'] = $_W['uniacid'];
        
        $condition .= " AND c.uid = :uid";
        $params[':uid'] = $uid;
        
        
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_order') ." AS c LEFT JOIN " . tablename('wjyk_zqds_course')  ." AS co ON c.courseid = co.id  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by c.createtime desc ";
        
            $sql = "SELECT co.* FROM " . tablename('wjyk_zqds_order')  ." AS c LEFT JOIN " . tablename('wjyk_zqds_course')  ." AS co ON c.courseid = co.id  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            
            foreach ( $list as $key => $value ){
            
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $value['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$key]['teacherName'] = $teacher['name'];
                $list[$key]['teacherAvatar'] = $teacher['avatar'];
            
                $chapter = pdo_getall('wjyk_zqds_chapter',array(
                    'courseid' => $value['id'],
                    'uniacid' => $_W['uniacid']
                ));
            
                if(empty($chapter)){
                    $list[$key]['count'] = 0;
                }else{
                    $list[$key]['count'] = count($chapter);
                }
                
                $mark = 0;
                
                
                foreach ( $chapter as $k => $v ){
                    
                    $process = pdo_get('wjyk_zqds_process',array(
                        'id' => $v['id'],
                        'uid' => $uid,
                        'uniacid' => $_W['uniacid']
                    ));
                    
                    if(!empty($process)){
                       $mark += 1;
                    }
                }
                
                if($mark > 1){
                    $list[$key]['condition'] = 1;
                    
                    if(count($chapter)>0){
                        
                        $round = round($mark / count($chapter),2);
                        
                        
                        $list[$key]['process'] = $round *100;
                    }
                    
                    
                }else{
                    $list[$key]['condition'] = 0;
                    
                    $list[$key]['process'] = 0;
                }
            
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
     * 签到
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=sign_in
     */
    public function sign_in(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $set = pdo_get('wjyk_zqds_integral',array(
            'uniacid' => $_W['uniacid'],
        ));
        
        
        if($set['is_open'] == 1){
            $data = array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
                'type' => 1,
                'integral' => $set['get'],
                'createtime' => time()
            );
            
            $result = pdo_insert("wjyk_zqds_integral_log",$data);
            if($result){
                
                pdo_update('wjyk_zqds_user',array(
                    'integral +='=>$set['get']
                ),array(
                    'uid' => $uid,
                    'uniacid' => $_W['uniacid'],
                ));
                
                return result(0,'签到成功');
            }else{
                return result(-1,'签到失败');
            }
        }else{
            return result(-1,'签到未开启');
        }
        
    }
    
    
    
    
    /**
     * 收藏列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=collect_list
     * @param
     *         page  页码
     * @param
     *         psize  每页条数 
     */
    public function collect_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
        
        $condition = " c.uniacid = :uniacid AND co.uniacid = :uniacid ";
        $params[':uniacid'] = $_W['uniacid'];
        
        $condition .= " AND c.uid = :uid";
        $params[':uid'] = $uid;
        
        
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_collect') ." AS c LEFT JOIN " . tablename('wjyk_zqds_course')  ." AS co ON c.courseid = co.id  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by c.createtime desc ";
        
            $sql = "SELECT co.* FROM " . tablename('wjyk_zqds_collect')  ." AS c LEFT JOIN " . tablename('wjyk_zqds_course')  ." AS co ON c.courseid = co.id  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            
            foreach ( $list as $key => $value ){
            
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $value['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$key]['teacherName'] = $teacher['name'];
                $list[$key]['teacherAvatar'] = $teacher['avatar'];
            
                $chapter = pdo_getall('wjyk_zqds_chapter',array(
                    'courseid' => $value['id'],
                    'uniacid' => $_W['uniacid']
                ));
            
                if(empty($chapter)){
                    $list[$key]['count'] = 0;
                }else{
                    $list[$key]['count'] = count($chapter);
                }
            
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
     * 关注列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=focus_list
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function focus_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
    
        $condition = " c.uniacid = :uniacid AND co.uniacid = :uniacid ";
        $params[':uniacid'] = $_W['uniacid'];
    
        $condition .= " AND c.uid = :uid";
        $params[':uid'] = $uid;
    
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_focus') ." AS c LEFT JOIN " . tablename('wjyk_zqds_teacher')  ." AS co ON c.teacherid = co.id  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by c.createtime desc ";
    
            $sql = "SELECT co.* FROM " . tablename('wjyk_zqds_focus')  ." AS c LEFT JOIN " . tablename('wjyk_zqds_teacher')  ." AS co ON c.teacherid = co.id  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
            
                $courseList = pdo_getall('wjyk_zqds_course',array(
                    'teacherid' => $v['id'],
                    'uniacid' => $_W['uniacid']
                ),array(
                    'id',
                    'cover',
                    'name'
                ));
            
                $list[$k]['courseList'] = $courseList;
            
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
     * 历史记录列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=history_list
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function history_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
    
        $condition = " c.uniacid = :uniacid AND co.uniacid = :uniacid ";
        $params[':uniacid'] = $_W['uniacid'];
    
        $condition .= " AND c.uid = :uid";
        $params[':uid'] = $uid;
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_view_history') ." AS c LEFT JOIN " . tablename('wjyk_zqds_course')  ." AS co ON c.courseid = co.id  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by c.createtime desc ";
    
            $sql = "SELECT co.* FROM " . tablename('wjyk_zqds_view_history')  ." AS c LEFT JOIN " . tablename('wjyk_zqds_course')  ." AS co ON c.courseid = co.id  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            foreach ( $list as $key => $value ){
            
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $value['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$key]['teacherName'] = $teacher['name'];
                $list[$key]['teacherAvatar'] = $teacher['avatar'];
            
                $chapter = pdo_getall('wjyk_zqds_chapter',array(
                    'courseid' => $value['id'],
                    'uniacid' => $_W['uniacid']
                ));
            
                if(empty($chapter)){
                    $list[$key]['count'] = 0;
                }else{
                    $list[$key]['count'] = count($chapter);
                }
            
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
     * 我的账单
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=my_bill
     */
    public function my_bill()
    {
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $result = array();
    
        $user = pdo_get('wjyk_zqds_user',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid
        ));
        
        $result['balance'] = $user['balance'];
        
        $date = date("Y-m-d",strtotime("-1 day"));

        $yesterday = pdo_fetchcolumn("SELECT IFNULL(SUM(money),0.00) FROM " . tablename('wjyk_zqds_payment_log') . " WHERE DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y-%m-%d') = '{$date}'  AND  uid = :uid  AND uniacid = :uniacid AND type = 1 ",array(
            ':uniacid' => $_W['uniacid'],
            ':uid' => $uid
        ));
        $result['yesterday'] = $yesterday;
        
        $all = pdo_fetchcolumn("SELECT IFNULL(SUM(money),0.00) FROM " . tablename('wjyk_zqds_payment_log') . " WHERE uid = :uid  AND uniacid = :uniacid AND type = 1 ",array(
            ':uniacid' => $_W['uniacid'],
            ':uid' => $uid
        ));
        $result['all'] = $all;
         
        return result(0, 'success',$result);
    }
    
    /**
     * 账单列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=bill_list
     * @param
     *         type  1-收入  2-支出
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function bill_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
    
        $condition = " uniacid = :uniacid ";
        $params[':uniacid'] = $_W['uniacid'];
    
        $condition .= " AND uid = :uid";
        $params[':uid'] = $uid;
        
        if(!empty(input('type'))){
            $condition .= " AND type = :type";
            $params[':type'] = input('type');
        }
    
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_payment_log') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by createtime desc ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_payment_log')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
            
            foreach ($list as $k => $v) {
                $list[$k]['createtime'] = date("Y-m-d H:i",$v['createtime']);
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
     * 充值信息
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=recharge_list
     */
    public function recharge_list()
    {
        global $_W;
    
        $list = pdo_getall('wjyk_zqds_recharge',array(
            'uniacid' => $_W['uniacid']
        ),array(),'','sort desc');
         
        return result(0, 'success',$list);
    }
    
    
    
    /**
     * 立即充值
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=recharge
     * @param
     *        money 金额
     * @param
     *        actual 实付  
     */
    public function recharge()
    {
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $log = array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'logno' => getPayNo('RE'),
            'money' => input('money'),
            'actual' => input('actual'),
            'rechargetype' => 1,
            'createtime' => time()
        );
        $result = pdo_insert('wjyk_zqds_recharge_log',$log);
    
        if(!empty($result)){
            
            $log = [
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
                'money' => input('money'),
                'type' => 1,
                'text' =>'充值',
                'createtime' => time()
            ];
            pdo_insert('wjyk_zqds_payment_log',$log);
            
            pdo_update('wjyk_zqds_user',array(
                'balance +='=> input('money')
            ),array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid'],
            ));
            
            $system = pdo_get('wjyk_zqds_system', array(
                'uniacid' => $_W['uniacid']
            ));
            
            $user = pdo_get('wjyk_zqds_user', array(
                'uniacid' => $_W['uniacid'],
                'uid' => $uid
            ));
            
            if (!empty($system['rechargeTemplate'])) {
            
                $data = array(
                    'first' => array(
                        'value' => "您好，您已成功完成余额充值！",
                        'color' => '#ff510'
                    ),
                    'keyword1' => array(
                        'value' => input('money')."元",
                        'color' => '#ff510'
                    ),
                    'keyword2' => array(
                        'value' => date('Y-m-d H:i:s', $log['createtime']),
                        'color' => '#ff510'
                    ),
                    'keyword3' => array(
                        'value' => $user['balance']."元",
                        'color' => '#ff510'
                    ),
                    'remark' => array(
                        'value' => $system['rechargeRemark'],
                        'color' => '#ff510'
                    )
                );
                $account_api = \WeAccount::create();
                $url = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=index&m=wjyk_zqds&wxref=mp.weixin.qq.com#/pages/user/balance/balance";
                $account_api->sendTplNotice($user['openid'], $system['rechargeTemplate'], $data,$url);
            }
            
            return result(0, '充值成功');
        }else{
            return result(-1, '充值失败');
        }
    }
    
    /**
     * 积分记录
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=integral_list
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function integral_list(){
        global $_W,$_GPC;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
    
        $pindex = max(1, intval(input('page')));
        $psize = empty(input('psize')) ? 10 : intval(input('psize'));
    
        $condition = " uniacid = :uniacid ";
        $params[':uniacid'] = $_W['uniacid'];
    
        $condition .= " AND uid = :uid";
        $params[':uid'] = $uid;
    
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_integral_log') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " order by createtime desc ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_integral_log')  ."  WHERE ".$condition. "  LIMIT " . ($pindex - 1) * $psize . ',' . $psize ;
            $list = pdo_fetchall($sql, $params);
    
            foreach ($list as $k => $v) {
                $list[$k]['createtime'] = date("Y-m-d H:i",$v['createtime']);
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
     * 会员中心
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=member_index
     */
    public function member_index()
    {
        global $_W;
        
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
        
        if(!empty($user['maturity_time'])){
            $user['maturity_time'] = date('Y-m-d',$user['maturity_time']);
        }
    
        $list = pdo_getall('wjyk_zqds_member',array(
            'uniacid' => $_W['uniacid']
        ),array(),'','sort desc');
        
        if(empty($list)){
            $list = [];
        }
        
        
        $set = pdo_get("wjyk_zqds_member_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(empty($set)){
            $set = [];
        }else{
            $set['right'] = htmlspecialchars_decode(html_entity_decode($set['right']));
        }
         
        return result(0, 'success',array(
            'list' => $list,
            'set' => $set,
            'user' => $user
        ));
    }
    
    /**
     * 立即开通/续费
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=user&tp_a=membership
     * @param
     *        month 月份
     * @param
     *        money 金额  
     */
    public function membership()
    {
        global $_W,$_GPC;
        
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
        
        $interval = intval($_GPC['month']);
        
        if(!empty($user['maturity_time'])){
            $maturity_time = strtotime("+{$interval} month", $user['maturity_time']);
        }else{
            $maturity_time = strtotime("+{$interval} month", time());
        }
        
        $result = pdo_update('wjyk_zqds_user',array(
            'maturity_time' => $maturity_time,
            'is_member' => 1
        ), array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid']
        ));
        if(!empty($result)){
        
            $log = array(
                'uniacid' => $_W['uniacid'],
                'uid' => $uid,
                'month' => $_GPC['month'],
                'money' => $_GPC['money'],
                'createtime' => time()
            );
            pdo_insert('wjyk_zqds_member_log',$log);
        
            if($user['is_member'] == 0){
                return result(0, '开通成功');
            }else{
                return result(0, '续费成功');
            }
        }else{
            if($user['is_member'] == 0){
                return result(-1, '开通失败');
            }else{
                return result(0, '续费失败');
            }
        }
    }
    
}
