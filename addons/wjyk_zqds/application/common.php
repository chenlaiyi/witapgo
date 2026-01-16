<?php
// 应用公共文件
// 跳转类型function getSkipType(){        global $_W;        $data = array(        array(            'id'=>5,            'name'=> '美团外卖',        ),array(            'id'=>6,            'name'=> '美团商超',        )/* ,array(            'id'=>33,            'name'=> '美团优选1.99促销',        ),array(            'id'=>44,            'name'=> '美团秒杀活动',        ) */,array(            'id'=>7,            'name'=> '美团优选',        ),array(            'id'=>8,            'name'=> '美团酒店',        ),array(            'id'=>9,            'name'=> '美团闪购活动',        ),array(            'id'=>77,            'name'=> '美团闪购优惠券',        ),array(            'id'=>88,            'name'=> '美团周末特价',        ),array(            'id'=>10,            'name'=> '饿了么外卖',        ),array(            'id'=>11,            'name'=> '饿了么生鲜',        ),array(            'id'=>12,            'name'=> '拼多多话费充值',        ),array(            'id'=>13,            'name'=> '拼多多限时秒杀',        ),array(            'id'=>14,            'name'=> '拼多多百亿补贴',        ),array(            'id'=>15,            'name'=> '拼多多领券中心',        ),array(            'id'=>17,            'name'=> '滴滴打车',        ),array(            'id'=>18,            'name'=> '滴滴加油',        ),array(            'id'=>19,            'name'=> '滴滴货运',        )    );        $chwlPlugin = pdo_get('wjyk_zqds_module_plugin', array(        'uniacid' => $_W['uniacid'],        'pid' => 7    ));    if($chwlPlugin['is_open'] == 1){        array_push($data, array(            'id'=>66,            'name'=> '美团吃喝玩乐',        ));    }            return $data;}
function result($errno, $message, $data = '') {
    exit(json_encode(array(
        'errno' => $errno,
        'message' => $message,
        'data' => $data,
    )));
}

function getPayNo($text){
    return  $text . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

function get_qrcode($id, $url, $folder)
{
    // folder = avatars或card
    global $_W, $_GPC;

    $set = pdo_get('wjyk_zqds_upload',array(
        'uniacid' => $_W['uniacid']
    ));

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

    if(empty($set) || $set['type'] == 1){

        return $paths;
    }else if($set['type'] == 2){
        require_once(IA_ROOT . '/framework/library/qiniu/autoload.php');
        $auth = new \Qiniu\Auth($set['accesskey'], $set['secretkey']);
        // 要上传的空间
        // 生成上传 Token
        $token = $auth->uploadToken($set['bucket']);
        // 要上传文件的本地路径
        // 上传到七牛后保存的文件名
        $key = "opz".time().rAND(999,9999).".png";
        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new \Qiniu\Storage\UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $path);
        if ($err !== null) {
            return $paths;
        } else {
            $paths = $set['url']. '/'.$ret['key'];
            unlink($path);
            return $paths;
        }
    }
}




function getNoncestr($length = 10) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for($i = 0; $i < $length; $i ++) {
        $str .= substr ( $chars, mt_rand ( 0, strlen ( $chars ) - 1 ), 1 );
    }
    return $str;
}

function get_app_name($type){
    $danhao = date('Ymd') . str_pad(mt_rAND(1, 99999), 5, '0', STR_PAD_LEFT);
    if($type==1){
        $str = "NXCBHUIHETAPGHIZHVUYUANWTGKXBZBHGHSDFMDMVPAESYPSIYJKVJYXZWAGKH";
    }else{
        $str = "AKDKJGIADSJOTIMMXCNVCKJKGOPDAYKKYWETKHEYJHJVHKNYKJKVZMQLYAOJOY";
    }
    //1.获取字符串的长度
    $length = strlen($str) - 1;
    //2.字符串截取开始位置
    $start = rAND(0, $length);
    return substr($str, $start, 3).$danhao;
}


function push_url($push_domain,$push_key,$expireTime,$appName,$streamName){
    $push_url = '';
    // 未开启鉴权Key的情况下
    if ($push_key == '') {
        $push_url = 'rtmp://' . $push_domain . '/' . $appName . '/' . $streamName;
        return $push_url;
    }
    $timeStamp = time() + $expireTime;
    $sstring = '/' . $appName . '/' . $streamName . '-' . $timeStamp . '-0-0-' . $push_key;
    $md5hash = md5($sstring);
    $push_url = 'rtmp://' . $push_domain . '/' . $appName . '/' . $streamName . '?auth_key=' . $timeStamp . '-0-0-' . $md5hash;
    //        echo "推流地址：" . $push_url . "\r\n";
    return $push_url;
}

function play_url($play_domain,$play_key,$expireTime,$appName,$streamName){
    //未开启鉴权Key的情况下
    if($play_key==''){
        $hls_play_url = 'http://'.$play_domain.'/'.$appName.'/'.$streamName.'.m3u8';
    }else{
        $timeStamp = time() + $expireTime;

        $hls_sstring = '/'.$appName.'/'.$streamName.'.m3u8-'.$timeStamp.'-0-0-'.$play_key;
        $hls_md5hash = md5($hls_sstring);
        $hls_play_url = 'http://'.$play_domain.'/'.$appName.'/'.$streamName.'.m3u8?auth_key='.$timeStamp.'-0-0-'.$hls_md5hash;
    }

    return $hls_play_url;
}


function getRandNumber($start,$end,$length){
    //初始化变量为0
    $connt = 0;
    //建一个新数组
    $temp = array();
    while($connt < $length){
        //在一定范围内随机生成一个数放入数组中
        $temp[] = mt_rand($start, $end);
        //$data = array_unique($temp);
        //去除数组中的重复值用了“翻翻法”，就是用array_flip()把数组的key和value交换两次。这种做法比用 array_unique() 快得多。
        $data = array_flip(array_flip($temp));
        //将数组的数量存入变量count中
        $connt = count($data);
    }
    //为数组赋予新的键名
    shuffle($data);
    //数组转字符串
    $str=implode(",", $data);
    //替换掉逗号
    $number=str_replace(',', '', $str);
    return $number;
}

function httpPost($url, $data) { // 模拟提交数据函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8'
    )); //类型为json
    $result = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Error POST' . curl_error($curl);
    }
    curl_close($curl); // 关键CURL会话
    return $result; // 返回数据
}

function wtw_request($url, $data = null)
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

if (!function_exists('siteUrl')) {
    /**
     * 生成url
     * @param string $url 路由地址,类似于tp5的url()函数的第一个参数 如：index/index/hello
     * @param string $vars 路由参数
     * @param string $weDoor 微擎入口 web-Web端入口,app-App端入口
     * @return array|string
     */
    function siteUrl($url = '', $vars = '', $weDoor = '')
    {
        global $_GPC, $_W;
        if(empty($weDoor)){
            $baseUrl = request()->baseUrl(true);
            if(isset($_GPC["i"])){
                list($i,$c,$a) = [$_W["uniacid"],"entry","site"];
            }else{
                list($c,$a) = ["site","entry"];
            }
        }else{
            $baseUrl = request()->domain() . "/" . $weDoor."/index.php";
            if ("app" == $weDoor) {
                list($i,$c,$a) = [$_W["uniacid"],"entry","site"];
            } else {
                list($c,$a) = ["site","entry"];
            }
        }

        $url = array_filter(explode('/', $url));
        if (empty($url)) {
            list($do, $tpC, $tpA) = array($_GPC["do"], $_GPC["tp_c"], $_GPC["tp_a"]);
        } else {
            switch (count($url)) {
                case 1:
                    list($do, $tpC, $tpA) = array($_GPC["do"], $_GPC["tp_c"], $url[0]);
                    break;
                case 2:
                    list($do, $tpC, $tpA) = array($_GPC["do"], $url[0], $url[1]);
                    break;
                case 3:
                    list($do, $tpC, $tpA) = $url;
                    break;
            }
        }
        $url = $baseUrl . '?m=' . MODULE_NAME . "&";
        if (!empty($c)) {
            $url .= "c={$c}&";
        }
        if (!empty($a)) {
            $url .= "a={$a}&";
        }
        if (!empty($i)) {
            $url .= "i={$i}&";
        }
        if (!empty($do)) {
            $url .= "do={$do}&";
        }
        if (!empty($tpC)) {
            $url .= "tp_c={$tpC}&";
        }
        if (!empty($tpA)) {
            $url .= "tp_a={$tpA}";
        }
        if (!empty($vars)) {
            $queryString = http_build_query($vars, '', '&');
            $url .="&".$queryString;
        }
        return $url;
    }
}


/**
 * 微擎版权信息
 * @return string
 */
function weCopyright(){
    global  $_W;
    $html = '<div class="copyright">';
    if(!isset($_W['setting']['copyright']['footerleft'])||empty($_W['setting']['copyright']['footerleft'])){
        $html .='Powered by <a href="http://www.we7.cc"><b>微擎</b></a> v'.IMS_VERSION.' © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>';
    }else{
        $html .= $_W['setting']['copyright']['footerleft'];
    }
    $html .= ' </div>';
    if(isset($_W['setting']['copyright']['icp'])&&!empty($_W['setting']['copyright']['icp'])){
        $html .='<div>备案号：<a href="http://www.miitbeian.gov.cn" target="_blank">'.$_W['setting']['copyright']['icp'].'</a></div>';
    }
    return $html;
}









