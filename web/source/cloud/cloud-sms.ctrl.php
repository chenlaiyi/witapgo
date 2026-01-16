<?php
/**
 * [Cloud System] Copyright (c) 2016-2018  微擎互存版 更新授权 QQ: 32663267
 */

defined('IN_IA') or exit('Access Denied');

load()->model('setting');

$dos = array('setsms');
$do = in_array($do, $dos) ? $do : 'setsms';

$_W['page']['title'] = '短信服务 - 短信设置';

if($do == 'setsms'){
	$cloudcfg = $_W['setting']['cloudcfg'];
	$cloud_sms = $_W['setting']['cloudcfg']['cloud_sms_info'];

	if(checksubmit('submit')){
		
		if($_GPC['type'] != 'off'){
			$setting_sms_sign['register'] = '注册绑定';
			$setting_sms_sign['find_password'] = '密码找回';
			$setting_sms_sign['user_expire'] = '用户过期';
			$result = setting_save($setting_sms_sign, 'site_sms_sign');
		}	
		
		if(!empty($_GPC['signs'])){
			$signs = explode('|',$_GPC['signs']);
		}	
	
		$signs = $_GPC['signs'];
		
		$smsinfo = array(
			'type' => $_GPC['type'],
			'signs' => $signs,
			'alisms' => array(
				'accesskey' => $_GPC['alisms']['accesskey'],
				'secret' => $_GPC['alisms']['secret'],
				'sign' => $_GPC['alisms']['sign'],
				'system_tpl' => $_GPC['alisms']['system_tpl'],
				'expire_tpl' => $_GPC['alisms']['expire_tpl'],
				'message_tpl' => $_GPC['alisms']['message_tpl'],
				'global_tpl' => $_GPCP['alisms']['global_tpl']
			),
			'other' => array(
			
			),
		);

		$_W['setting']['cloudcfg']['cloud_sms_info'] =  $smsinfo;
		setting_save($_W['setting']['cloudcfg'], 'cloudcfg');
		itoast('短信配置信息更新成功！', url('cloud/cloud-sms/setsms'), 'success');
	}
	
	//$cloud_sms['signs'] = implode('|' , $cloud_sms['signs'] );
}
template('cloud/cloud-sms');

