<?php
defined('IN_IA') or exit('Access Denied');
set_time_limit(0);
load()->func('file');

class Auth_WeliamController {

    public function __construct() {
        global $_W;
        if (!$_W['isfounder']) {
            wl_message('无权访问!');
        }
    }

    public function auth() {
        global $_W, $_GPC;
        $auth['status'] = '已授权';
        $auth['number'] = '不限制';
        $auth['version'] = '';
        $auth['endtime'] = '123456';

        include wl_template('cloud/auth');
    }

    public function upgrade() {
        global $_W, $_GPC;
        if ($_W['isajax']) {
            if (file_exists(PATH_MODULE . 'check.php')) {
                wl_json(1, '开发环境禁止更新');
            }

            //获取最新版本的文件
            $files_md5 = Cloud::api_post(array('do' => 'files_md5', 'url' => $_W['siteroot']));
            if ($files_md5['code'] != 0) {
                wl_json($files_md5['code'], $files_md5['message']);
            }

            $files = array();
            if (!empty($files_md5['data'])) {
                foreach ($files_md5['data'] as $file) {
                    $entry = PATH_MODULE . $file['path'];
                    if (!is_file($entry) || md5_file($entry) != $file['md5']) {
                        $files[] = array('path' => $file['path'], 'download' => 0, 'entry' => $entry);
                    }
                }
            }
            if (!empty($files)) {
                file_put_contents(FILES_UP_PATH, json_encode($files));
                wl_json(0, '', ['count' => count($files)]);
            }

            wl_json(1, '已是最新版本，无需进行更新');
        }

        $log = [];
        $update_logs = Cloud::api_post(array('do' => 'get_update_log', 'url' => $_W['siteroot'], 'page' => intval($_GPC['page'])));
        if ($update_logs['code'] == 0) {
            $log = $update_logs['data']['logs'][0];
        }

        include wl_template('cloud/upgrade');
    }

    public function upgrade_download() {
        global $_W, $_GPC;
        if (!file_exists(FILES_UP_PATH)) {
            wl_json(1, '不存在需要更新的文件或更新异常');
        }

        $files = json_decode(file_get_contents(FILES_UP_PATH), true);
        $count_files = count($files);
        //判断是否存在需要更新的文件
        $key = $path = $success = 0;
        foreach ($files as $k => &$f) {
            if (empty($f['download'])) {
                $path = $f['path'];
                $key = $k;
                break;
            } else {
                $success++;
            }
        }

        if (!empty($path)) {
            $files_up = Cloud::api_post(array('do' => 'files_get', 'url' => $_W['siteroot'], 'path' => $path));
            if ($files_up['code'] != 0) {
                wl_json(1, $files_up['message'], array('total' => $count_files, 'success' => $success));
            }

            $content = base64_decode(trim($files_up['data']));
            //根据路径创建目录和文件
            FilesHandle::file_mkdirs(dirname(PATH_MODULE . $path));
            file_put_contents(PATH_MODULE . $path, $content);
            //修改文件下载状态
            $files[$key]['download'] = 1;
            file_put_contents(FILES_UP_PATH, json_encode($files));

            wl_json(0, '', array('total' => $count_files, 'success' => $success + 1));
        } else {
            //更新版本号
            touch(VERSION_PATH);
            pdo_update('modules', array('version' => WELIAM_VERSION), array('name' => MODULE_NAME));
            //删除更新文件列表
            unlink(FILES_UP_PATH);
            wl_json(2, '');
        }
    }

    public function upgrade_db() {
        global $_W, $_GPC;
        $sqlcache = Cache::getCache('upgrade', 'db');
        if (empty($sqlcache)) {
            $sqls = Cloud::auth_db_update();
            $sqlcache = ['total' => count($sqls), 'success' => 0, 'sqls' => $sqls];
        }

        if (!empty($sqlcache['sqls'])) {
            pdo_query($sqlcache['sqls'][0]);
            $sqlcache['success'] = $sqlcache['success'] + 1;
            unset($sqlcache['sqls'][0]);
            $sqlcache['sqls'] = array_values($sqlcache['sqls']);
            Cache::setCache('upgrade', 'db', $sqlcache);

            wl_json(0, '', array('total' => $sqlcache['total'], 'success' => $sqlcache['success']));
        }

        Cache::deleteCache('upgrade', 'db');
        wl_json(1, '');
    }

    public function upgrade_log() {
        global $_W, $_GPC;
        if ($_W['isajax']) {
            $update_logs = Cloud::api_post(array('do' => 'get_update_log', 'url' => $_W['siteroot'], 'page' => intval($_GPC['page'])));
            if ($update_logs['code'] != 0) {
                wl_json(1, $update_logs['message']);
            }
            foreach ($update_logs['data']['logs'] as &$log) {
                $log['content'] = htmlspecialchars_decode($log['content']);
                $log['year']    = date('Y-m' , $log['update_time']);
                $log['day']     = date('d' , $log['update_time']);
                $log['hour']    = date('H:i:s' , $log['update_time']);
            }
            
            wl_json(0, '', $update_logs['data']);
        }
        include wl_template('cloud/upgrade_log');
    }
}
