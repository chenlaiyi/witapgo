<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class MakeexpressModel extends PluginModel
{
	private $GET_TOKEN = '%s/addons/make_speed/core/public/index.php/apis/v2/get_token';
	private $API_CREATE_ORDER = '%s/addons/make_speed/core/public/index.php/apis/v2/create_order';
	private $GET_DELIVERY_PRICE = '%s/addons/make_speed/core/public/index.php/apis/v2/get_delivery_price';
	private $API_ORDER_DETAIL = '%s/addons/make_speed/core/public/index.php/apis/v2/get_order_detail';
	private $VERIFY_TOKEN = '%s/addons/make_speed/core/public/index.php/apis/v2/verify_token';
	private $app_id;
	private $token;
	private $selfUrl;
	private $getToken;

	public function __construct($data)
	{
		if (isset($data['url']) && isset($data['app_id']) && isset($data['token'])) {
			$this->selfUrl = $data['url'];
			$this->app_id = $data['app_id'];
			$this->token = $data['token'];
			$this->getToken();
		}
	}

	public function verifyToken($token)
	{
		return $this->request($this->VERIFY_TOKEN, array('token' => $token));
	}

	/**
     * 获取token
     * @return bool|mixed|string
     * @author Jason
     */
	public function getToken()
	{
		global $_W;
		$redis = redis();
		$redisKey = 'ewei_shop_make_express_' . $_W['uniacid'] . '_token';
		$token = $redis->get($redisKey);
		if (empty($token) || !!$this->verifyToken($token)) {
			$request = $this->request($this->GET_TOKEN, array('token' => $this->token, 'appid' => $this->app_id));
			$token = $request['token'];
			$redis->set($redisKey, $token, 86400);
		}

		$this->getToken = $token;
	}

	/**
     * 创建订单
     */
	public function createOrder($data)
	{
		$data['token'] = $this->getToken;
		$this->request($this->API_CREATE_ORDER, $data);
	}

	/**
     * 获取订单详情
     */
	public function getOrderDetail()
	{
	}

	public function getOrderStatus()
	{
	}

	public function getOrderPrice($data)
	{
		$data['token'] = $this->getToken;
		return $this->request($this->GET_DELIVERY_PRICE, $data);
	}

	/**
     * 发送请求
     * @param $url
     * @param $data
     * @return mixed
     * @author Jason
     */
	public function request($url, $data)
	{
		$requestUrl = sprintf($url, $this->selfUrl);
		ksort($data);

		if ($url == $this->GET_DELIVERY_PRICE) {
			$requestUrl .= strpos($requestUrl, '?') ? '&' : '?';
			$params = '';

			foreach ($data as $k => $v) {
				if (is_null($v)) {
					continue;
				}

				$params .= '&' . $k . '=' . $v;
			}

			$params = substr($params, 1);
			$res = ihttp_get($requestUrl . $params)['content'];
		}
		else {
			$res = ihttp_post($requestUrl, $data)['content'];
		}

		$res = json_decode($res, true);

		if ($url == $this->GET_TOKEN) {
			return $res;
		}

		if ($url == $this->API_VERIFY_TOKEN) {
			return $res['isValid'];
		}

		if ($res['error_code'] == 0) {
			return $res['data'];
		}

		return error2($res['msg']);
	}
}

?>
