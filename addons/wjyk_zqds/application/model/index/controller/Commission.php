<?php

namespace app\index\controller;

use think\Controller;

class Commission extends Controller
{
    
    
    
    /**
     * 提现设置
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=commission&tp_a=commission_set
     */
    public function commission_set(){
        global $_W;
        
        $set = pdo_get("wjyk_zqds_commission_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(empty($set)){
            $set = [];
        }
    
        return result(0, 'success',$set);
    }
    
    
    /**
     * 提现申请
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=commission&tp_a=cashWait
     * @param
     *        commission_wait 申请佣金
     * @param
     *        cash_type 1-线下提现到银行卡，2-线上提现到微信 3-余额
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
        
        $data = array(
            'uid' => $uid,
            'uniacid' => $_W['uniacid'],
            'cashno' => $this->getTextNo('CA'),
            'commission_wait' => input('commission_wait'),
            'pay_type' => 0,
            'is_status' => 1,
            'cash_type' => input('cash_type'),
            'nickname' => input('nickname'),
            'telphone' => input('telphone'),
            'bank_name' => input('bank_name'),
            'bank_no' => input('bank_no'),
            'createtime' => time()
        );
        
        $set = pdo_get("wjyk_zqds_commission_set",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if ($set['cash_charge'] != '' || $set['cash_charge'] != 0) {
            $data['cash_charge'] = $set['cash_charge'];
            $data['service_charge'] = round(input('commission_wait') * $set['cash_charge'] / 100, 2);
            $data['commission_actual'] = input('commission_wait') - $data['service_charge'];
        } else {
            $data['service_charge'] = 0;
            $data['commission_actual'] = input('commission_wait');
        }
        
        $result = pdo_insert('wjyk_zqds_commission',$data);
        
        if ($result) {
            pdo_update('wjyk_zqds_user',array(
                'balance' => 0
            ),array(
                'uid' => $uid,
                'uniacid' => $_W['uniacid']
            ));
            return result(0,'申请成功');
        } else {
            return result(-1,'申请失败');
        }
    }
    
    /**
     * 提现列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=commission&tp_a=commission_log
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function commission_log()
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
    
    public function getTextNo($text)
    {
        return $text . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    
    
}
