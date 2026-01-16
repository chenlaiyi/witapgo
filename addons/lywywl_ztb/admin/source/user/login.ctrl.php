<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
define('IN_GW', true);
include IA_ROOT . '/framework/version.inc.php';

if(checksubmit() || $_W['isajax']) {
	_login($_GPC['referer']);
}
$setting = $_W['setting'];

$loginUniacid = $_GPC['uniacid'];
if(empty($loginUniacid))
{
	message('对不起，请通过合法路径登录系统后台！');
}
$modulesSettings = pdo_fetch("SELECT * FROM " . tablename("uni_account_modules") . " WHERE uniacid=:uniacid and `module`='lywywl_ztb' ", array(':uniacid' => $loginUniacid));
if (!empty($modulesSettings)) {
	$config = iunserializer($modulesSettings['settings'])['ztb'];
} else {
	message('对不起，请通过合法路径登录系统后台！');
}

template('user/login');

function _login($forward = '') {
    header("Content-Type: application/json; charset=utf-8");
	global $_GPC, $_W;
	load()->model('user');
	$member = array();
	$username = trim($_GPC['username']);
    pdo_query('DELETE FROM'.tablename('users_failed_login'). ' WHERE lastupdate < :timestamp', array(':timestamp' => TIMESTAMP-300));
    $failed = pdo_get('users_failed_login', array('username' => $username, 'ip' => CLIENT_IP));
    if ($failed['count'] >= 5) {
        exit(json_encode(array("status" => 0, "msg" => "输入密码错误次数超过5次，请在5分钟后再登录！"), JSON_UNESCAPED_UNICODE));
    }

    if(!empty($_W['setting']['copyright']['verifycode'])){
        $verify = trim($_GPC['verify']);
        if (empty($verify)) {
            exit(json_encode(array("status" => 0, "msg" => "请输入验证码"), JSON_UNESCAPED_UNICODE));
        }
        $result = checkcaptcha($verify);
        if (empty($result)) {
            exit(json_encode(array("status" => 0, "msg" => "输入验证码错误"), JSON_UNESCAPED_UNICODE));
        }
    }

	if(empty($username)) {
        exit(json_encode(array("status" => 0, "msg" => "请输入要登录的用户名"), JSON_UNESCAPED_UNICODE));
	}
	$member['username'] = $username;
	$member['password'] = $_GPC['password'];
	if(empty($member['password'])) {
        exit(json_encode(array("status" => 0, "msg" => "请输入密码"), JSON_UNESCAPED_UNICODE));
	}

	$record = user_single($member);
	if(!empty($record)) {
        if ($record['status'] == 1 || $record['status'] == 3) {
            exit(json_encode(array("status" => 0, "msg" => "您的账号正在审核或是已经被系统禁止，请联系网站管理员解决！"), JSON_UNESCAPED_UNICODE));
        }

        $account = pdo_fetch("SELECT * FROM " . tablename("lywywl_ztb_sys_admin") . " WHERE status=1 AND uid=:uid and `deltime`=0 ORDER BY id DESC LIMIT 1", array(':uid' => $record['uid']));
        if (!empty($account)) {
            $_W['uniacid'] = $account['uniacid'];
        } else {
            exit(json_encode(array("status" => 0, "msg" => "您的账号正在审核或是已经被系统禁止，请联系网站管理员解决！"), JSON_UNESCAPED_UNICODE));
        }

		$founders = explode(',', $_W['config']['setting']['founder']);
		$_W['isfounder'] = in_array($record['uid'], $founders);
		if (empty($_W['isfounder'])) {
			if (!empty($record['endtime']) && $record['endtime'] < TIMESTAMP) {
                exit(json_encode(array("status" => 0, "msg" => "您的账号有效期限已过，请联系网站管理员解决！"), JSON_UNESCAPED_UNICODE));
			}
		}
		if (!empty($_W['siteclose']) && empty($_W['isfounder'])) {
            exit(json_encode(array("status" => 0, "msg" => '站点已关闭，关闭原因：' . $_W['setting']['copyright']['reason']), JSON_UNESCAPED_UNICODE));
		}
		$cookie = array();
		$cookie['uid'] = $record['uid'];
		$cookie['lastvisit'] = $record['lastvisit'];
		$cookie['lastip'] = $record['lastip'];
        $cookie['hash'] = !empty($record['hash']) ? $record['hash'] : md5($record['password'] . $record['salt']);
		$session = authcode(json_encode($cookie), 'encode');
		isetcookie('__session', $session, !empty($_GPC['rember']) ? 7 * 86400 : 0, true);
		$status = array();
		$status['uid'] = $record['uid'];
		$status['lastvisit'] = TIMESTAMP;
		$status['lastip'] = CLIENT_IP;
		//判断微擎版本是否大于v2.6.4
		if(IMS_RELEASE_DATE >= 202007230001){
            user_related_update($status['uid'], $status);
        }else{
            user_update($status);
        }

		isetcookie('__uniacid', $_W['uniacid'], 7 * 86400);
		isetcookie('__uid', $record['uid'], 7 * 86400);


        pdo_delete('users_failed_login', array('id' => $failed['id']));
        $data = array(
            'lastvisit' => TIMESTAMP,
            'lastip' => CLIENT_IP,
        );
        pdo_update("lywywl_ztb_sys_admin", $data, array('id' => $account['id']));

        exit(json_encode(array("status" => 1, "msg" => "登录成功，正在为您跳转到管理平台","url"=>url('site/entry/home', array('m' => 'lywywl_ztb'))), JSON_UNESCAPED_UNICODE));
	} else {
		if (empty($failed)) {
			pdo_insert('users_failed_login', array('ip' => CLIENT_IP, 'username' => $username, 'count' => '1', 'lastupdate' => TIMESTAMP));
		} else {
			pdo_update('users_failed_login', array('count' => $failed['count'] + 1, 'lastupdate' => TIMESTAMP), array('id' => $failed['id']));
		}
        exit(json_encode(array("status" => 0, "msg" => "登录失败，请检查您输入的用户名和密码！"), JSON_UNESCAPED_UNICODE));
	}
}