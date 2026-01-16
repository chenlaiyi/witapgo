<?php
/**
 * 支付接口调测例子
 * ================================================================
 * index 进入口，方法中转
 * submitOrderInfo 提交订单信息
 * queryOrder 查询订单
 * 
 * ================================================================
 */
require('Utils.class.php');
require('config/config.php');
require('class/RequestHandler.class.php');
require('class/ClientResponseHandler.class.php');
require('class/PayHttpClient.class.php');
require('class/DataHandler.class.php');

Class Request{
    private $resHandler = null;
    private $reqHandler = null;
    private $pay = null;
    private $cfg = null;
    
    public function __construct(){
        $this->Request();
    }

    public function Request(){
        $this->resHandler = new ClientResponseHandler();
        $this->reqHandler = new RequestHandler();
        $this->pay = new PayHttpClient();
        $this->cfg = new Config();

        $this->reqHandler->setGateUrl($this->cfg->C('url'));

        $sign_type = $this->cfg->C('sign_type');
        
        if ($sign_type == 'MD5') {
            $this->reqHandler->setKey($this->cfg->C('key'));
            $this->resHandler->setKey($this->cfg->C('key'));
            $this->reqHandler->setSignType($sign_type);
        } else if ($sign_type == 'RSA_1_1' || $sign_type == 'RSA_1_256') {
            $this->reqHandler->setRSAKey($this->cfg->C('private_rsa_key'));
            $this->resHandler->setRSAKey($this->cfg->C('public_rsa_key'));
            $this->reqHandler->setSignType($sign_type);
        }
    }
    
    public function index(){
        $this->submitOrderInfo();
    }
    
    public function submitOrderInfo(){
        $this->reqHandler->setReqParams($_POST,array('method'));
        $date = $this->reqHandler->getParameter('bill_date');
        $mchId = $this->reqHandler->getParameter('mch_id');
        $key = $this->reqHandler->getParameter('key');
        $this->reqHandler->setParameter('bill_date', str_replace('-', '', $date));
        // $this->reqHandler->setParameter('service','unified.trade.micropay');//接口类型：unified.trade.micropay
        // $this->reqHandler->setParameter('mch_id',$this->cfg->C('mchId'));//必填项，商户号，由威富通分配
        //$this->reqHandler->setParameter('notify_url',$this->cfg->C('notify_url'));
        $this->reqHandler->setParameter('mch_id',$mchId);//必填项，商户号，由威富通分配
        $this->reqHandler->setParameter('key',$key);//机构密钥
        $this->reqHandler->setParameter('version',$this->cfg->C('version'));
        // $this->reqHandler->setParameter('device_info', '商户已有商城网站用户通过消息或扫描二维码在微信内打开网页');
        // $this->reqHandler->setParameter('limit_credit_pay', '1');
        $this->reqHandler->setParameter('sign_type',$this->cfg->C('sign_type'));
        $this->reqHandler->setParameter('nonce_str',mt_rand(time(),time()+rand()));//随机字符串，必填项，不长于 32 位

/*        $alipay = '[{"goods_id" : "8054489", "goods_name" : "特惠", "quantity" : 1, "price" : 0.01}]';
        $wechat = '{"receipt_id" : "643738", "goods_detail" : [{"goods_id" : "8054489", "goods_name" : "特惠", "quantity" : 1, "price" : 1, "goods_category" : "保健品", "show_url" : "https://gss3.bdstatic.com/7Po3dSag_xI4khGkpoWK1HF6hhy/baike/s%3D220/sign=855e2cef0dd79123e4e093769d365917/3b292df5e0fe9925f3ef15b735a85edf8cb17171.jpg"}]}';
        $this->reqHandler->setParameter('goods_detail', $wechat);
        echo $this->reqHandler->getParameter('goods_detail');*/

        $this->reqHandler->createSign();//创建签名
        
        $data = Utils::toXml($this->reqHandler->getAllParameters());
        echo $data . "\n\n";
        Utils::dataRecodes($date . "请求数据", $data);
        
        $this->pay->setReqContent($this->reqHandler->getGateURL(),$data);
        if($this->pay->call()){
            $content = $this->pay->getResContent();
            echo $content;
            Utils::dataRecodes($date . "对账单数据", $content);
            DataHandler::dealBillResponse($content);
        }else{
            echo json_encode(array('status'=>500,'msg'=>'Response Code:'.$this->pay->getResponseCode().' Error Info:'.$this->pay->getErrInfo()));
        }
    }
}

$req = new Request();
$req->index();
?>