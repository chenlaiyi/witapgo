<?php
class JSSDK {
	private $app_id;
	private $app_secret;

	public function __construct($app_id, $app_secret)
	{
		$this->app_id = $app_id;
		$this->app_secret = $app_secret;

		$this->path = IA_ROOT . '/data/tpl/wxjson/';
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
	 * 直播-获取房间
	 * @param  array  $data 获取页数/可选
	 * @return object       返回对象
	 */
	public function get_room($data=[])
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/wxa/business/getliveinfo?access_token={$access_token}";

		if (empty($data)) {
			$data = [
				'start' => 0,
			];
		}

		$post_data = [
			'start' => max(0, $data['start'] == 1 ? 0 : ($data['start'] - 1)),
			'limit' => 100,
		];

		$json_data = json_encode($post_data);

		$rst = json_decode($this->sl_http_request($url, $json_data), true);

		return $rst;
	}

	/**
	 * 二维码-生成
	 *
	 * @param string $scene  场景值ID
	 * @param string $page   生成太阳码URL
	 * @return void
	 */
	public function qrcode_create($scene, $page)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token={$access_token}&is_hyaline=true";

		$post_data = [
			'scene' => $scene,
			'page'  => $page,
		];

		$json_data = json_encode($post_data);
		$stream_data = $this->httpPost($url, $json_data);

		if (!(empty($stream_data))) {
			$json_stream = json_decode($stream_data, true);

			if ($json_stream) {
				$return_data = [
					'code' => '1',
					'msg'  => $json_stream['errcode'].'-'.$json_stream['errmsg'],
				];
				return $return_data;
			}

			$file = $this->get_file_name();
			$file_path = ATTACHMENT_ROOT . $file;

			$this->fileWrite($file_path, $stream_data);

			//图片是否存在
			if(file_exists($file_path))
			{
				$return_data = [
					'code' => '0',
					'data' => $file,
				];
				return $return_data;

			} else {
				$return_data = [
					'code' => '1',
					'msg'  => '生成失败' . $stream_data,
				];
				return $return_data;
			}
		} else {
			$return_data = [
				'code' => '1',
				'msg'  => '生成失败或写入失败' . $stream_data,
			];
			return $return_data;
		}
	}

	/**
	 * 合成头像二维码
	 *
	 * @param string $qrcode    二维码资源
	 * @param string $avatar    头像资源
	 * @return obj              合成后的资源
	 */
	public function create_qrcode_avatar($qrcode, $avatar)
	{
		$qrcode = tomedia($qrcode);
		$avatar = tomedia($avatar);

		$qrcode_file_info = getimagesize($qrcode);
		$src_qrcode_img = null;
		switch ($qrcode_file_info['mime']) {
			case 'image/jpeg':
				$src_qrcode_img = imagecreatefromjpeg($qrcode);
				break;
			case 'image/png':
				$src_qrcode_img = imagecreatefrompng($qrcode);
				break;
			case 'image/gif':
				$src_qrcode_img = imagecreatefromgif($qrcode);
				break;
		}
		if (empty($src_qrcode_img)) {
			$data_bak = [
				'code' => 1,
				'msg'  => 'qrcode只能处理jpg或png或gif图片',
			];
			return $data_bak;
		}

		// 获取太阳码宽度
		$qrcode_w  = $qrcode_file_info[0];
		$qrcode_h  = $qrcode_file_info[1];

		$avatar_file_info = getimagesize($avatar);
		$src_avatar_img = null;
		switch ($avatar_file_info['mime']) {
			case 'image/jpeg':
				$src_avatar_img = imagecreatefromjpeg($avatar);
				break;
			case 'image/png':
				$src_avatar_img = imagecreatefrompng($avatar);
				break;
			case 'image/gif':
				$src_avatar_img = imagecreatefromgif($avatar);
				break;
		}
		if (empty($src_avatar_img)) {
			$data_bak = [
				'code' => 1,
				'msg'  => 'avatar只能处理jpg或png或gif图片',
			];
			return $data_bak;
		}

		// 获取头像宽度
		$avatar_w  = $avatar_file_info[0];
		$avatar_h  = $avatar_file_info[1];

		$create_width = 400; // 生成宽
		$create_height = 400; // 生成高
		$create_avatar_w = 182; // 生成头像宽
		$create_avatar_h = 182; // 生成头像高

		$image = imageCreatetruecolor($create_width, $create_height); // 新建一个真彩色图像
		$color = imagecolorallocate($image, 0, 0, 0); // 为真彩画布创建背景
		// 在 image 图像的坐标 x，y（图像左上角为 0, 0）处用 color 颜色执行区域填充（即与 x, y 点颜色相同且相邻的点都会被填充）
		imagefill($image, 0, 0, $color);
		//复制图片一到真彩画布中（重新取样-获取透明图片）
		imagecopyresampled($image, $src_qrcode_img, 0, 0, 0, 0, $create_width, $create_height, $qrcode_w, $qrcode_h);


		// 生成指定大小的头像
		$image_avatar = imageCreatetruecolor($create_avatar_w, $create_avatar_h); // 新建一个真彩色图像
		$color = imagecolorallocate($image_avatar, 0, 0, 0); // 为真彩画布创建背景
		// 在 image 图像的坐标 x，y（图像左上角为 0, 0）处用 color 颜色执行区域填充（即与 x, y 点颜色相同且相邻的点都会被填充）
		imagefill($image_avatar, 0, 0, $color);
		//复制图片一到真彩画布中（重新取样-获取透明图片）
		imagecopyresampled($image_avatar, $src_avatar_img, 0, 0, 0, 0, $create_avatar_w, $create_avatar_h, $avatar_w, $avatar_h);

		// 生成一个白色的圆
		$image_tmp = imagecreatetruecolor($create_avatar_w, $create_avatar_h); // 新建一个真彩色图像
		$bg = imagecolorallocatealpha($image_tmp, 255, 255, 255, 127); // 127 表示完全透明
		imagefill($image_tmp, 0, 0, $bg); // 区域填充
		$col_ellipse = imagecolorallocate($image, 255, 255, 255);
		imagefilledellipse($image_tmp, $create_avatar_w / 2, $create_avatar_h / 2, $create_avatar_w, $create_avatar_h, $col_ellipse);
		imagecopyresampled($image, $image_tmp, 108, 108, 0, 0, $create_avatar_w, $create_avatar_h, $create_avatar_w, $create_avatar_h);

		// 生成一个圆
		$ellipse_w = 164;
		$ellipse_h = 164;
		$image_tmp = imagecreatetruecolor($ellipse_w, $ellipse_h); // 新建一个真彩色图像
		$bg = imagecolorallocatealpha($image_tmp, 255, 255, 255, 127); // 127 表示完全透明
		imagesavealpha($image_tmp, true); // 设置标记以在保存 PNG 图像时保存完整的 alpha 通道信息
		imagefill($image_tmp, 0, 0, $bg); // 区域填充
		$r = $ellipse_w / 2;
		// 一个点一个点的复制
		for ($x = 0; $x < $ellipse_w; $x++) {
			for ($y = 0; $y < $ellipse_w; $y++) {
				$rgbColor = imagecolorat($image_avatar, $x, $y);
				if (((($x-$r) * ($x-$r) + ($y-$r) * ($y-$r)) < ($r*$r))) {
					imagesetpixel($image_tmp, $x, $y, $rgbColor);
				}
			}
		}
		imagecopyresampled($image, $image_tmp, 118, 118, 0, 0, $ellipse_w, $ellipse_h, $ellipse_w, $ellipse_h);

		$file = $this->get_file_name();
		$file_path = ATTACHMENT_ROOT . $file;
		imagepng($image, $file_path);

		imagedestroy($image_avatar); // 销毁一图像
		imagedestroy($image_tmp); // 销毁一图像
		imagedestroy($image); // 销毁一图像

		//图片是否存在
		if(file_exists($file_path))
		{
			$return_data = [
				'code' => '0',
				'data' => $file,
			];
			return $return_data;

		} else {
			$return_data = [
				'code' => '1',
				'msg'  => '合成头像二维码失败',
			];
			return $return_data;
		}
	}

	// 获取文件名
	protected function get_file_name()
	{
		global $_W;

		$sys_id = $_W['uniacid'];
		$curr_y = date("Y", time());
		$curr_m = date("m", time());

		$qrcode = "qrcode/";
		$tmppath = ATTACHMENT_ROOT . $qrcode;
		$u       = $tmppath . $sys_id . "/";
		$y       = $u . $curr_y . "/";
		$m       = $y . $curr_m . "/";
		$this->checkdir($tmppath);
		$this->checkdir($u);
		$this->checkdir($y);
		$this->checkdir($m);

		//获取毫秒的时间戳
		$time = explode (" ", microtime ());
		$time = substr($time[0], 2, 3);

		$code = $qrcode . $sys_id . "/" . $curr_y . "/" . $curr_m . "/" . 'C' . date('YmdHis', time()) . $time . '.jpg';

		return $code;
	}

	// 发送模板消息
	public function templates_send($data)
	{
		global $_GPC, $_W;

		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";

		$json_data = json_encode($data);

		$res = json_decode($this->httpPost($url, $json_data), true);

		return $res;
	}

	/**
	 * 模板-添加
	 * @param  array $data 对象
	 *                     template_id_short =>模板库ID，如：AT0104
	 * @return object      微信返回的json对象
	 */
	public function templates_add($data)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token={$access_token}";

		$json_data = json_encode($data);

		$res = json_decode($this->httpPost($url, $json_data), true);

		return $res;
	}

	// 删除模板
	public function templates_delete($data)
	{
		$access_token = $this->getAccessToken();

		$url = "https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token={$access_token}";

		$post_data = [
			'template_id' => $data['template_id'],
		];

		$json_data = json_encode($post_data);

		$res = json_decode($this->httpPost($url, $json_data), true);

		return $res;
	}
}
