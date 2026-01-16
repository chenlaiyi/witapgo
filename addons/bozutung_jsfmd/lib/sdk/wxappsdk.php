<?php
class WXAPPSDK {
	private $app_id;
	private $app_secret;

	public function __construct($app_id, $app_secret)
	{
		$this->app_id = $app_id;
		$this->app_secret = $app_secret;

		$this->path = IA_ROOT . '/data/tpl/wxappjson/';
		$this->checkdir($this->path);
	}

	public function getAccessToken()
	{
		$file = $this->path . $this->app_id . ".json";
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->app_id}&secret={$this->app_secret}";

		if (!file_exists($file)) {
			$this->fileWrite($file, '');
		}

		$data = json_decode(file_get_contents($file));
		if(empty($data) || !property_exists($data, 'expire_time') || $data->expire_time < time()){
			$res = json_decode($this->httpGet($url));
			$access_token = $res->access_token;
			if ($access_token) {
				$data = new stdClass();
				$data->expire_time = time() + 7000;
				$data->access_token = $access_token;

				$this->fileWrite($file, $data);
			}
		} else {
			$access_token = $data->access_token;
		}
		return $access_token;
	}

	protected function checkdir($path)
	{
		if (!file_exists($path)) {
			mkdir($path, 0775);
		}
	}

	/**
	 * 写文件操作
	 * @param  object $fileAddress 文件路径
	 * @param  res    $data        数据，一般是数组
	 * @return string              返回写入的字符数，出现错误时则返回 FALSE
	 */
	protected function fileWrite($fileAddress, $data)
	{
		$fp = fopen($fileAddress, "w");

		$data_type = gettype($data);
		if ($data_type == 'string') {
			$rst = fwrite($fp, $data);
		} else if ($data_type == 'object' || $data_type == 'array') {
			$rst = fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE));
		} else {
			return FALSE;
		}
		fclose($fp);
		return $rst;
	}

	/**
	 * get请求
	 * @param  string $url 请求URL
	 * @return res         资源
	 */
	protected function httpGet($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_URL, $url);

		$res = curl_exec($curl);
		curl_close($curl);

		return $res;
	}

	/**
	 * post请求
	 * @param  string $url  请求URL
	 * @param  array  $data post数据
	 * @return res          资源
	 */
	protected function httpPost($url, $data)
	{

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //要求结果保存到字符串中还是输出到屏幕上

		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

		$res = curl_exec($curl);
		curl_close($curl);

		return $res;
	}

	/**
	 * 发送HTTP请求
	 * @param string $url 请求地址
	 * @param string $refererUrl 请求来源地址
	 * @param array $data 发送数据
	 * @param string $contentType
	 * @param string $timeout
	 * @param string $proxy
	 * @return boolean
	 */
	protected function sl_http_request($url, $data, $refererUrl = '', $contentType = 'application/json', $timeout = 30, $proxy = false)
	{
		$ch = null;
		if($data) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HEADER,0 );
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			if ($refererUrl) {
				curl_setopt($ch, CURLOPT_REFERER, $refererUrl);
			}
			if($contentType) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:'.$contentType));
			}
			if(is_string($data)){
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			} else {
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			}
		} else {
			if(is_string($data)) {
				$real_url = $url. (strpos($url, '?') === false ? '?' : ''). $data;
			} else {
				$real_url = $url. (strpos($url, '?') === false ? '?' : ''). http_build_query($data);
			}

			$ch = curl_init($real_url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:'.$contentType));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			if ($refererUrl) {
				curl_setopt($ch, CURLOPT_REFERER, $refererUrl);
			}
		}

		if($proxy) {
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
		// 关闭https验证
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		$ret = curl_exec($ch);
		$info = curl_getinfo($ch);
		$contents = array(
			'httpInfo' => array(
				'send' => $data,
				'url' => $url,
				'ret' => $ret,
				'http' => $info,
			)
		);
		curl_close($ch);
		return $ret;
	}

	/**
	 * 模板-列表
	 * @return object 微信返回的信息
	 */
	public function templates_list($offset=0, $count=10)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/cgi-bin/wxopen/template/list?access_token={$access_token}";

		$post_data = [
			'offset' => $offset,
			'count'  => $count,
		];
		$json_data = json_encode($post_data);
		$rst = json_decode($this->httpPost($url, $json_data), true);

		return $rst;
	}

	/**
	 * 模板-添加
	 * @param  array $data 两个对象
	 *                     id              =>模板库ID，如：AT0104
	 *                     keyword_id_list =>模板关键字列表，如：[1,2,13]
	 * @return object      微信返回的json对象
	 */
	public function templates_add($data)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/wxaapi/newtmpl/addtemplate?access_token={$access_token}";

		$post_data = [
			'tid'       => $data['tid'],
			'kidList'   => $data['kidList'],
			'sceneDesc' => $data['sceneDesc'],
		];

		$json_data = json_encode($post_data);

		$rst = json_decode($this->sl_http_request($url, $json_data), true);

		return $rst;
	}

	/**
	 * 模板-删除
	 * @param  string $template_id 公众帐号下模板消息ID，如：Dyvp3-Ff0cnail_CDSzk1fIc6-9lOkxsQE7exTJbwUE
	 * @return object              微信返回的json对象
	 */
	public function templates_delete($template_id)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/wxaapi/newtmpl/deltemplate?access_token={$access_token}";

		$post_data = [
			'priTmplId' => $template_id,
		];

		$json_data = json_encode($post_data);

		$res = json_decode($this->sl_http_request($url, $json_data), true);

		return $res;
	}

	// 发送模板消息
	public function templates_send($ds)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token={$access_token}";

		$json_data = json_encode($ds);

		$rst = json_decode($this->httpPost($url, $json_data), true);

		return $rst;
	}

}
