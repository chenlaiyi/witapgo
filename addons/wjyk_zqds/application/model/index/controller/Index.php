<?php

namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    
    /**
     * 首页页面
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds
     * @param
     *            pid
     */
    
    public function index()
    {
        global $_W;
        
        if(!empty($_W['fans'])){
            if(empty($_W['fans']['nickname']))
            {
                $_W['fans'] = mc_fansinfo($_W['fans']['openid']);
            }
            if(empty($_W['fans']['uid']))
            {
                mc_oauth_userinfo();
            }
            
            
            /* --用户身份记录-- */
            $user_info = array(
                'uid' => $_W['fans']['uid'],
                'nickname' => $_W['fans']['tag']['nickname'],
                'openid' => $_W['fans']['openid'],
                'avatar' => $_W['fans']['tag']['avatar'],
                'uniacid' => $_W['uniacid']
            );
            
            if (!empty($user_info['uid'])) {
            
            
            
                $use = pdo_fetchcolumn("SELECT count(*) FROM " . tablename("wjyk_zqds_user") . " WHERE uniacid = :uniacid AND openid = :openid ", array(
                    ':uniacid' => $_W['uniacid'],
                    ':openid' => $user_info['openid']
                ));
            
                if ( $use <= 0 ) {
            
                    if (input('pid')) {
                        $user_info['pid'] = input('pid');
                    }
            
                    $user_info['createtime'] = time();
            
                    $result =  pdo_insert('wjyk_zqds_user', $user_info);
                    if($result){
                        $id = pdo_insertid();
            
                        $url = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=index&m=wjyk_zqds&pid=".$_W['fans']['uid'];
                        $user_info['qrcode'] = $this->get_qrcode($id,$url, "extension");
            
                        pdo_update('wjyk_zqds_user', $user_info, array(
                            'id' => $id,
                            'uniacid' => $_W['uniacid']
                        ));
                    }
            
                }else{
                    $user = pdo_get('wjyk_zqds_user',array(
                        'uniacid' => $_W['uniacid'],
                        'openid' => $user_info['openid']
                    ));
                    if(empty($user['qrcode'])){
                        
                        $url = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=index&m=wjyk_zqds&pid=".$_W['fans']['uid'];
                        
                        $user_info['qrcode'] = $this->get_qrcode($user['id'],$url, "extension");
            
                        pdo_update('wjyk_zqds_user', $user_info, array(
                            'id' =>  $user['id'],
                            'uniacid' => $_W['uniacid']
                        ));
                    }
                }
                
                $userList = pdo_getall('wjyk_zqds_user', array(
                    'uniacid' => $_W['uniacid'],
                    'is_member' => 1
                ));
                
                $nowTime = time();
                foreach ($userList as $k => $v) {
                    if ($nowTime >= $v['maturity_time']) {
                        pdo_update('wjyk_zqds_user', array(
                            'is_member' => 2
                        ), array(
                            'uniacid' => $_W['uniacid'],
                            'id' => $v['id']
                        ));
                    }
                }
                
            
            
            } else {
                echo "请在微信客户端内访问";
                exit();
                $use = "";
            }
        }
        
        return view('index');
    }
    

    /**
     * 首页信息
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=indexInfo          
     */
    public function indexInfo()
    {
        global $_W;

        
        $cateList= pdo_getall('wjyk_zqds_category',array(
            'uniacid' => $_W['uniacid'],
            'is_display' => 1
        ),array(),'','sort desc');
        
        $noticeList= pdo_fetchall("SELECT * FROM " . tablename("wjyk_zqds_notice") . "WHERE is_display = 1 AND uniacid = :uniacid ORDER BY sort DESC ",array(
            'uniacid' => $_W['uniacid']
        ));

        $bannerList = pdo_getall("wjyk_zqds_banner",array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(empty($bannerList)){
            $bannerList = [];
        }
        
        $set = pdo_get("wjyk_zqds_live_set",array(
            'uniacid' => $_W['uniacid']
        ));
                
        return result(0, 'success', array(
            'bannerList' => $bannerList,
            'cateList' => $cateList,
            'noticeList' => $noticeList,
            'live_pic' => $set['pic_url']
        ));
    }
    
    /**
     * 首页讲师推荐
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=indexTeacher
     */
    public function indexTeacher(){
        global $_W;

        $index_teacher = pdo_fetchall("SELECT * FROM " . tablename("wjyk_zqds_teacher") . "WHERE is_recommend = 1 AND is_status = 2 AND  uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid']
        ));
        
        
        $teacher_list = array();
        
        foreach ( $index_teacher as $key => $value ){
            $teacher_list[$key]['id'] = $value['id'];
            $teacher_list[$key]['name'] = $value['name'];
            $teacher_list[$key]['avatar'] = $value['avatar'];
        }
        
        $teacher_num = count($teacher_list) > 15?15:count($teacher_list);
        $tempArr = array();
        $teacherArr = array();
        
        if ( $teacher_num ){
            $tempArr = array_rand($teacher_list,$teacher_num);//随机取出二维数组的键
        
            if ( is_array($tempArr) ){
                foreach ( $tempArr as $value ){
                    $teacherArr[] = $teacher_list[$value];
                }
            }else{//数量只有一个的时候，array_rand取出来的值不是一个数组
                $teacherArr[] = $teacher_list[$tempArr];
            }
        }
        
        unset($teacher_list,$tempArr);
        
        return result(0, 'success', $teacherArr);
        
        
    }
    
    /**
     * 首页课程推荐
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=indexCourse
     */
    public function indexCourse(){
        global $_W;

        $index_teacher = pdo_fetchall("SELECT * FROM " . tablename("wjyk_zqds_course") . "WHERE is_recommend = 1 AND uniacid = :uniacid ",array(
            'uniacid' => $_W['uniacid']
        ));
        
        
        $teacher_list = array();
        
        foreach ( $index_teacher as $key => $value ){
            $teacher_list[$key]['id'] = $value['id'];
            $teacher_list[$key]['name'] = $value['name'];
            $teacher_list[$key]['cover'] = $value['cover'];
            $teacher_list[$key]['charge'] = $value['charge'];
            $teacher_list[$key]['is_vip'] = $value['is_vip'];
            
            
            $teacher = pdo_get('wjyk_zqds_teacher',array(
                'id' => $value['teacherid'],
                'uniacid' => $_W['uniacid']
            ));
            $teacher_list[$key]['teacherName'] = $teacher['name'];
            $teacher_list[$key]['teacherAvatar'] = $teacher['avatar'];
            
            $chapter = pdo_getall('wjyk_zqds_chapter',array(
                'courseid' => $value['id'],
                'uniacid' => $_W['uniacid']
            ));
            
            if(empty($chapter)){
                $teacher_list[$key]['count'] = 0;
            }else{
                $teacher_list[$key]['count'] = count($chapter);
            }
            
        }
        
        $teacher_num = count($teacher_list) > 2?2:count($teacher_list);
        $tempArr = array();
        $teacherArr = array();
        
        if ( $teacher_num ){
            $tempArr = array_rand($teacher_list,$teacher_num);//随机取出二维数组的键
        
            if ( is_array($tempArr) ){
                foreach ( $tempArr as $value ){
                    $teacherArr[] = $teacher_list[$value];
                }
            }else{//数量只有一个的时候，array_rand取出来的值不是一个数组
                $teacherArr[] = $teacher_list[$tempArr];
            }
        }
        
        unset($teacher_list,$tempArr);
        
        return result(0, 'success', $teacherArr);
    }
    
    /**
     * 直播专场
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=live
     * @param
     *         type  1-直播中  2-历史直播
     * @param
     *         page  页码
     * @param
     *         psize  每页条数            
     */
    public function live(){
        global $_W,$_GPC;
        
        
        $set = pdo_get('wjyk_zqds_live_set',array(
            'uniacid' => $_W['uniacid']
        ));
        
        $config = [
            'accessKeyId' => $set['keyId'],
            'accessKeySecret' => $set['keySecret'],
            'signName' => '',
            'templateCode'=> '',
        ];
        
        include 'Sms.php';
        
        $sms = new \Sms($config);
        
        $liveList = pdo_getall('wjyk_zqds_live',array(
            'uniacid' => $_W['uniacid']
        ));
        foreach ($liveList as $k => $v) {
        
            if(!empty($v['aly_play_domain'])){
        
                $online = $sms->get_online($v['aly_play_domain']);
        
                if (!empty($online['LiveStreamOnlineInfo'])) {
        
                    $onlineList = $online['LiveStreamOnlineInfo'];
        
                    foreach ($onlineList as $key => $value) {
                        
                        if($value['AppName'] == $v['app_name'] && $value['StreamName'] == $v['stream_name']){

                            
                            pdo_update('wjyk_zqds_live',array(
                                'is_status' => 2
                            ),array(
                                'uniacid' => $_W['uniacid'],
                                'id' => $v['id']
                            ));
                        }
                    }
                }
        
            }
        
        }
        
        
        $condition = " uniacid = :uniacid";
        $params[':uniacid'] = $_W['uniacid'];
        
        if(!empty(input('type'))){
            
            if(input('type') == 1){
                $condition .= " AND is_status <= 2 ";
            }else{
                $condition .= " AND is_status = 3 ";
            }
            
        }
        
        
        $nowtime = time();
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_live') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
        
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_live')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
                
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['teacherName'] = $teacher['name'];
                $list[$k]['teacherAvatar'] = $teacher['avatar'];
                            
            }
        }else{
            $list = array();
        }
        
        return result(0, 'success', $list);
    }
    
    /**
     * VIP专享
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=vip
     * @param
     *         page  页码
     * @param
     *         psize  每页条数
     */
    public function vip(){
        global $_W,$_GPC;
    
        $condition = " uniacid = :uniacid AND is_vip = 1";
        $params[':uniacid'] = $_W['uniacid'];
    
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM "  . tablename('wjyk_zqds_course') ."  WHERE ". $condition, $params);
        if ($total) {
            $condition .= " ORDER BY createtime DESC ";
    
            $sql = "SELECT * FROM " . tablename('wjyk_zqds_course')  ."  WHERE ".$condition;
            $list = pdo_fetchall($sql, $params);
            foreach ($list as $k => $v) {
    
                $teacher = pdo_get('wjyk_zqds_teacher',array(
                    'id' => $v['teacherid'],
                    'uniacid' => $_W['uniacid']
                ));
                $list[$k]['teacherName'] = $teacher['name'];
                $list[$k]['teacherAvatar'] = $teacher['avatar'];
    
                $chapter = pdo_getall('wjyk_zqds_chapter',array(
                    'courseid' => $v['id'],
                    'uniacid' => $_W['uniacid']
                ));
    
                if(empty($chapter)){
                    $list[$k]['count'] = 0;
                }else{
                    $list[$k]['count'] = count($chapter);
                }
    
            }
        }else{
            $list = array();
        }
    
            
        return result(0, 'success', $list);
    }
    
    /**
     * 系统设置
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=system
     */
    public function system(){
        global $_W;
        $system = pdo_get('wjyk_zqds_system',array(
            'uniacid' => $_W['uniacid']
        ));
        
        if(!empty($system)){
            
            $integral =  pdo_get('wjyk_zqds_integral',array(
                'uniacid' => $_W['uniacid']
            ));
            
            $system['integral_open'] = $integral['is_open'];
            
            
            $brokerage =  pdo_get('wjyk_zqds_brokerage_set',array(
                'uniacid' => $_W['uniacid']
            ));
            
            $system['brokerage_open'] = $brokerage['is_open'];
        
        
            $banner =  pdo_getall('wjyk_zqds_banner',array(
                'uniacid' => $_W['uniacid']
            ),'',array(),'sort desc');
        
            if(empty($banner)){
                $banner = [];
            }
        
            $system['banner'] = $banner;
        
        }else{
            $system = [];
        }
        return result(0, 'success',$system);
        
    }
    
    /**
     * 助通云-短信验证
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=sendMobile
     *
     * @param
     *            integer telphone(电话号码)
     */
    public function sendMobile()
    {
        global $_W;
        $note = pdo_get('wjyk_zqds_note',array(
            'uniacid' => $_W['uniacid']
        ));
        if($note){
            $smsapi = "http://api.mix2.zthysms.com/v2/sendSms"; // 短信网关
            $user = $note['user']; // 短信平台帐号
            $pass = $note['pass']; // 短信平台密码
            $message = $note['message']; // 短信模板
    
        }else{
            return result(- 1, '请在管理平台设置短信有关信息！');
        }
    
        $number = getRandNumber(1,9,6);
    
        if($note['type'] == 1){
    
    
            $message = str_replace("******",$number,$message);
    
            $url     = $smsapi;
            $tKey     = time();
            $password = md5(md5($pass) . $tKey);
    
            $data     = array(
                'content' => $message, // 要发送的短信内容
                'mobile'  => input('telphone'),
                'username'  => $user, //用户名
                'password'  => $password, //密码
                'tKey'      => $tKey
            );
            $ret = httpPost($url, $data);
            $json = json_decode($ret,true);
            if($json['code'] == 200){
                return result(0, 'success',$number);
            }else{
                return result(-1, $json);
            }
        }else if($note['type'] == 2){
            $config = [
                'accessKeyId' => $note['keyId'],
                'accessKeySecret' => $note['keySecret'],
                'signName' => $note['signName'],
                'templateCode' => $note['templateCode']
            ];
    
            include 'Sms.php';
    
            $sms = new \Sms($config);
            $phone = input('telphone');
    
    
            $status = $sms->send_verify($phone, $number);
            if ($sms->error == 'OK') {
                return result(0, 'success',$number);
            }else{
                return result(- 1, $sms->error);
            }
        }
    
    }
    
    public function get_qrcode($id, $url, $folder)
    {
        // folder = avatars或card
        global $_W, $_GPC;
        require_once IA_ROOT . '/addons/wjyk_zqds/public/pay/example/phpqrcode/qrlib.php';
    
        $errorCorrectionLevel = "L";
        $matrixPointSize = "4.3";
        $margin = "1";
    
        $dir = ATTACHMENT_ROOT . "/images/global/" . $_W['uniacid'] . "/" . $folder;
        if (! file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    
        $path = ATTACHMENT_ROOT . "/images/global/" . $_W['uniacid'] . "/" . $folder . "/" . $id . ".png";
        $paths = $_W['attachurl_local'] . "images/global/" . $_W['uniacid'] . "/" . $folder . "/" . $id . ".png";
    
        \QRcode::png($url, $path, $errorCorrectionLevel, $matrixPointSize, $margin);
    
        return $paths;
    }
    
    
    
    /**
     * 获取jssdk配置
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=get_jssdk
     * @param
     *            url
     */
    public function get_jssdk(){
        global $_W,$_GPC;
        // 获取token
        $token = $this->getAccessToken();
       
         // 获取ticket
        $ticketList = $this->getJsApiTicket($token['accessToken']);
        $ticket = $ticketList['ticket'];
        
        $config = pdo_get('account_wechats',array(
            'uniacid' => $_W['uniacid']
        ));
    
        // 该url为调用jssdk接口的url
        // $url = "http://b72.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_carservice";
        
        if(!empty(input('url'))){
            $url = $_GPC['url'];
        }else{
            $url = '';
        }
        
        
        /* $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if(!empty($_SERVER["HTTP_REFERER"])){
            $url = $_SERVER["HTTP_REFERER"];
        } */
        
        // 生成时间戳
        $timestamp = time();
        // 生成随机字符串
        $nonceStr = $this->createNoncestr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序 j -> n -> t -> u
        $string = "jsapi_ticket=".$ticket."&noncestr=".$nonceStr."&timestamp=".$timestamp."&url=".$url;
        $signature = sha1($string);
                
        $signPackage = array (
            "appId" => $config['key'],
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string,
            "ticket" => $ticket,
            "token" => $token['accessToken']
        );
        echo json_encode($signPackage);
        //return result(0, 'success',$signPackage);
        
    }
    
    /**
     * 图片上传
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_zqds&tp_c=index&tp_a=upload
     * @param
     *           file
     */
    public function upload(){
        global $_W;
        
        $set = pdo_get('wjyk_zqds_upload',array(
            'uniacid' => $_W['uniacid']
        ));
        
        $myfile=$_FILES['file'];
        $filePath = $myfile['tmp_name'];
        
        if($myfile['type']=='video/mp4'){
            $key = 'video'.time().random(4).'.mp4';
        }elseif($myfile['type']=='audio/mp3'){
            $key = 'audio'.time().random(4).'.mp3';
        }else{
            $key = 'png'.time().random(4).'.png';
        }
        
        if(empty($set) || $set['type'] == 1){
        
            $path = IA_ROOT."/attachment/images/".$_W['uniacid']."/uploads/";
            //判断目录存在否，存在给出提示，不存在则创建目录
            if (!is_dir($path)){
                mkdir(iconv("UTF-8", "GBK", $path),0777,true);
            }
            
            $res = move_uploaded_file($filePath, $path . $key);
            if($res){
                $data = $_W['siteroot']."attachment/images/".$_W['uniacid']."/uploads/". $key;
                
                return result(0, "上传成功",$data);
            }
        
        }else if($set['type'] == 2){
            require_once(IA_ROOT . '/framework/library/qiniu/autoload.php');
        
            $myfile = $_FILES['file'];
            $filePath = $myfile['tmp_name'];
        
            if($myfile['type']=='video/mp4'){
                $key = 'video'.time().random(4).'.mp4';
            }elseif($myfile['type']=='audio/mp3'){
                $key = 'audio'.time().random(4).'.mp3';
            }else{
                $key = 'png'.time().random(4).'.png';
            }
        
            $auth = new \Qiniu\Auth($set['accesskey'], $set['secretkey']);
            $bucket= $set['bucket'];
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new \Qiniu\Storage\UploadManager();
        
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            if ($err !== null) {
                return result(-1, "上传失败");
            } else {
                $str = $set['url']. '/'.$ret['key'];
                return result(0, "上传成功",$str);
            }
             
        }
    }

    
    
    
    
    /**
     * 微信支付
     * http://b78.admin168.net/app/index.php?i=1&c=entry&do=index&m=wjyk_service&tp_c=index&tp_a=pay
     * @param
     *            price 金额
     */
    public function pay()
    {
        global $_W;
    
        $openid = $_W['fans']['openid'];
        $price = input('price');
        $payconfig = pdo_get('wjyk_zqds_payconfig',array(
            'uniacid' => $_W['uniacid']
        ));
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $nonce_str = $this->getNonceStr(32);
        if ($_W['ispost']) {
            $send_data = array(
                'appid' => $payconfig['appid'],
                'mch_id' => $payconfig['mchid'],
                'nonce_str' => $nonce_str,
                'body' => "支付",
                'out_trade_no' => time() + 3600,
                'total_fee' => $price * 100,
                'notify_url' => siteUrl('index/index','','app'),
                'spbill_create_ip' => $_W['clientip'],
                'trade_type' => 'JSAPI',
                'attach' => '支付',
                'openid' => $openid
            );
            $sign = $this->MakeSign($send_data, $payconfig['api_key']);
    
            $send_data['sign'] = $sign;
            $result = $this->FromXml($this->wtw_request($url, $this->ToXml($send_data)));
    
            if($result['return_code'] == 'SUCCESS'){
                return result(0, 'success', $this->sign_pay($result));
            }else{
                return result(-1, 'fail',$result);
            }
    
        }
    }
    
    public function sign_pay($arr)
    {
        global $_W, $_GPC;
        $payconfig = pdo_get('wjyk_zqds_payconfig',array(
            'uniacid' => $_W['uniacid']
        ));
        $package = "prepay_id=" . $arr['prepay_id'];
        $signType = "MD5";
        $time = (int) time();
        $array = array(
            'appId' => $payconfig['appid'],
            'nonceStr' => $arr['nonce_str'],
            'package' => $package,
            'signType' => $signType,
            'timeStamp' => (string) $time
        );
        $sign_str = $this->MakeSign($array, $payconfig['api_key']);
    
        $array['paySign'] = $sign_str;
        return $array;
    }

    public function getAccessToken()
    {
        global $_W;
        $config = pdo_get('account_wechats',array(
            'uniacid' => $_W['uniacid']
        ));        
        $appid = $config['key'];
        $appsecret = $config['secret'];
    
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        // 微信返回的信息
        $returnData = json_decode($this->curlHttp($url));
        $resData['accessToken'] = $returnData->access_token;
        $resData['expiresIn'] = $returnData->expires_in;
        $resData['time'] = date("Y-m-d H:i",time());
    
        $res = $resData;
        
        return $res;
    }
    public function curlHttp($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($curl, CURLOPT_TIMEOUT, 500 );
        curl_setopt($curl, CURLOPT_URL, $url );
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    public function getJsApiTicket($accessToken) {
    
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";
        // 微信返回的信息
        $returnData = json_decode($this->curlHttp($url));
    
        $resData['ticket'] = $returnData->ticket;
        $resData['expiresIn'] = $returnData ->expires_in;
        $resData['time'] = date("Y-m-d H:i",time());
        $resData['errcode'] = $returnData->errcode;
    
        return $resData;
    }
    
    // 创建随机字符串
    public function createNoncestr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for($i = 0; $i < $length; $i ++) {
            $str .= substr ( $chars, mt_rand ( 0, strlen ( $chars ) - 1 ), 1 );
        }
        return $str;
    }
    
    /**
     *
     * 产生随机字符串，不长于32位
     *
     * @param int $length
     * @return 产生的随机字符串
     */
    public static function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    
    public function FromXml($xml)
    {
        // 将XML转为array
        // 禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $arr;
    }
    
    public function ToXml($array)
    {
    
        $xml = "<xml>";
        foreach ($array as $key => $val) {
            if ($key != 'body') {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }
    
    public function MakeSign($array, $key)
    {
        // 签名步骤一：按字典序排序参数
        ksort($array);
        $string = $this->ToUrlParams($array);
        // 签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $key;
        // 签名步骤三：MD5加密
        $string = md5($string);
        // 签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
   
    
    public function ToUrlParams($arr)
    {
        $buff = "";
        foreach ($arr as $k => $v) {
            if ($k != "sign" && $v != "" && ! is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
    
        $buff = trim($buff, "&");
        return $buff;
    }
    
    /**
     * [wtw_request description]模版请求
     *
     * @param [type] $url
     *            [description]
     * @param [type] $data
     *            [description]
     * @return [type] [description]
     */
    public function wtw_request($url, $data = null)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        if ($data != null) {
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $info = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            // echo 'Errno:'.curl_getinfo($curl);//捕抓异常
            // dump(curl_getinfo($curl));
        }
        return $info;
    }
    
    

    /**
     * 获取令牌
     */
    public function getToken(){
        return $this->request->token('__token__', 'sha1');
    }


}
