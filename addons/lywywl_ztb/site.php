<?php
/**
 * lywywl_ztb模块微站定义
 *
 * @author 维奕网络
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztbModuleSite extends WeModuleSite
{
    /**
     * 微信支付回调通知
     * @param $params
     * @return bool|void
     */
    public function payResult($params)
    {
        return false;
    }

    public function __call($name, $arguments) {
        $isWeb = stripos($name, 'doWeb') === 0;
        $isMobile = stripos($name, 'doMobile') === 0;
        if($isWeb || $isMobile) {
            $dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/';
            if($isWeb) {
                $dir .= 'web/';
                $fun = strtolower(substr($name, 5));
            }
            if($isMobile) {
                $dir .= 'mobile/';
                $path =  explode('.',$name);
                if(count($path) == 2)
                {
                    $dir .= strtolower(substr($path[0], 8)) . '/';
                    $fun = strtolower($path[1]);
                }
                else{
                    $fun = strtolower(substr($name, 8));
                }
            }
            $file = $dir . $fun . '.inc.php';
            if(file_exists($file)) {
                require $file;
                exit;
            } else {
                $dir = str_replace("addons", "framework/builtin", $dir);
                $file = $dir . $fun . '.inc.php';
                if(file_exists($file)) {
                    require $file;
                    exit;
                }
            }
        }
        trigger_error("访问的方法 {$name} 不存在.", E_USER_WARNING);
        return null;
    }

    protected function createWebUrl($do, $query = array())
    {
        global $_W, $_GPC;
        $query['do'] = $do;
        $query['m'] = strtolower($this->modulename);

        $url = $_SERVER['REQUEST_URI'];
        if (strexists($url, 'ztb.php')) {
            $url = './ztb.php?';
            $url .= "c=site&";
            $url .= "a=entry&";
            if (!empty($query)) {
                $queryString = http_build_query($query, '', '&');
                $url .= $queryString;
            }
            return $url;
        } else {
            return wurl('site/entry', $query);
        }
    }
}