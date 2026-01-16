<?php

namespace app\index\controller;

use think\Controller;

class Live extends Controller
{
    /**
     * 直播详情
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=live&tp_a=detail
     * @param
     *            id  直播id  
     */
    public function detail(){
        global $_W;
        
        /* if(empty($_W['fans']['uid'])){
            $uid = 2;
        }else{
            $uid = $_W['fans']['uid'];
        } */
    
        $uid = $_W['fans']['uid'];
        
        $id = input('id');
        
        $live= pdo_get("wjyk_zqds_live",array(
            'uniacid' => $_W['uniacid'],
            'id' => $id
        ));
        
        
        $teacher = pdo_get('wjyk_zqds_teacher',array(
            'id' => $live['teacherid'],
            'uniacid' => $_W['uniacid']
        ));
        $live['teacherName'] = $teacher['name'];
        $live['teacherAvatar'] = $teacher['avatar'];
        $live['teacherIntro'] = $teacher['introduction'];
        
        $focus = pdo_get('wjyk_zqds_focus',array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'teacherid' => $teacher['id']
        ));
        
        if(!empty($focus)){
            $live['focus'] = 1;
        }else{
            $live['focus'] = 0;
        }

        $live['pic_url'] = explode(',',$live['pic_url']);
         
        return result(0, 'success', $live);
    }
    
    
    /**
     * 阿里云回调
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=live&tp_a=aly_callback
     */
    public function aly_callback(){
        global $_W,$_GPC;
        $data = json_decode(file_get_contents("php://input"),true);
        
        
        $set = pdo_get('wjyk_zqds_live_set',array(
            'uniacid' => $_W['uniacid'],
        ));
        
        pdo_update('wjyk_zqds_live',array(
            'video' => "https://".$set['aly_bucket']."/".$data['uri'],
            'is_status' => 3
        ),array(
            'uniacid' => $_W['uniacid'],
            'app_name' => $data['app'],
            'stream_name' => $data['stream']
        ));
        
    }

    
    
    
    /**
     * 礼物列表
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=live&tp_a=gift_list
     */
    public function gift_list(){
        global $_W,$_GPC;

        $condition = " uniacid = :uniacid AND is_display = 1 ";
        $params[':uniacid'] = $_W['uniacid'];
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_gift') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY sort DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_gift')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
        }else{
            $list = array();
        }
    
        return result(0, 'success',$list);
    
    }
    
    /**
     * 送礼
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=live&tp_a=focus
     * @param
     *            teacherid  讲师id
     * @param
     *            pay_type  付款方式 1-余额，2-微信
     * @param
     *            giftid  礼物id
     * @param
     *            count  数量                          
     * @param
     *            total  总价      
     */
    public function focus(){
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
        
        if(input('total') > $user['balance'] ){
            return result(-1,'余额不足');
            exit();
        }
        
        $teacher = pdo_get('wjyk_zqds_teacher',array(
            'id' => input('teacherid'),
            'uniacid' => $_W['uniacid'],
        ));
        
        $teacherUser = pdo_get('wjyk_zqds_user',array(
            'uid' => $teacher['uid'],
            'uniacid' => $_W['uniacid'],
        ));
        
        
        $data = array(
            'presentid' => $uid,
            'uniacid' => $_W['uniacid'],
            'uid' => $teacher['uid'],
            'teacherid' => input('teacherid'),
            'pay_type' => input('pay_type'),
            'giftid' => input('giftid'),
            'count' => input('count'),
            'total' => input('total'),
            'is_status' => 1,
            'createtime' => time()
        );
        
        $result = pdo_insert("wjyk_zqds_gift_log",$data);
        if($result){
            
            if(input('pay_type') == 1){//余额支付
                $log = [
                    'uid' => $uid,
                    'uniacid' => $_W['uniacid'],
                    'money' => input('total'),
                    'type' => 2,
                    'text' => '直播送礼',
                    'createtime' => time()
                ];
                pdo_insert('wjyk_zqds_payment_log',$log);
                
                
                pdo_update('wjyk_zqds_user',array(
                    'balance -='=> input('total')
                ),array(
                    'uid' => $uid,
                    'uniacid' => $_W['uniacid'],
                ));
                
            }
            return result(0,'送礼成功');
        }else{
            return result(-1,'送礼失败');
        }
    
    }
    
    
}

