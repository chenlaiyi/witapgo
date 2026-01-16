<?php
Class Cloud{
	function getText($type){
		global $_W;
		$basic = json_decode(pdo_getcolumn('hcface_setting',array('only'=>'basic'.$_W['uniacid']),array('value')),'true');
		$url = 'http://ai.weimob.top/api/ai';
	    $params = array(
	        'appid' => $basic['appid'],
	        'appkey'=> $basic['appkey'],
	        'type' => $type,
	        'nonstr'=> TIMESTAMP
	    );
	    $params['sign'] = md5($basic['appid'].$basic['appkey'].$params['nonstr']);
	    $res = ihttp_post($url,$params);
		return json_decode($res[content],true);
	}
}