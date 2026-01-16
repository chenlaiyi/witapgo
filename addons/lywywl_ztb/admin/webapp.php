<?php
defined('IN_IA') or exit('Access Denied');

class Lywywl_ztbModuleWebapp extends WeModuleWebapp {


    public function __call($name, $arguments) {
        $dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/webapp';
        $function_name = strtolower(substr($name, 6));
        $file = "$dir/{$function_name}.inc.php";
        if(file_exists($file)) {
            require $file;
            exit;
        }
        return null;
    }

    protected function template($filename) {
        global $_W;
        $name = strtolower($this->modulename);
        $defineDir = dirname($this->__define);
        if(defined('IN_SYS')) {
            $source = IA_ROOT . "/web/themes/{$_W['template']}/{$name}/{$filename}.html";
            $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/{$name}/{$filename}.tpl.php";
            if(!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
            }
            if(!is_file($source)) {
                $source = $defineDir . "/template/{$filename}.html";
            }
            if(!is_file($source)) {
                $source = IA_ROOT . "/web/themes/{$_W['template']}/{$filename}.html";
            }
            if(!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
            }
        } else {
            $source = IA_ROOT . "/app/themes/{$_W['template']}/{$name}/{$filename}.html";
            $compile = IA_ROOT . "/data/tpl/app/{$_W['template']}/{$name}/{$filename}.tpl.php";
            if(!is_file($source)) {
                $source = IA_ROOT . "/app/themes/default/{$name}/{$filename}.html";
            }
            if(!is_file($source)) {
                $source = $defineDir . "/template/mobile/{$filename}.html";
            }
            if(!is_file($source)) {
                $source = $defineDir . "/template/webstore/{$filename}.html";
            }
            if(!is_file($source)) {
                $source = IA_ROOT . "/app/themes/{$_W['template']}/{$filename}.html";
            }
            if(!is_file($source)) {
                if (in_array($filename, array('header', 'footer', 'slide', 'toolbar', 'message'))) {
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                } else {
                    $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                }
            }
        }

        if(!is_file($source)) {
            exit("Error: template source '{$filename}' is not exist!");
        }
        $paths = pathinfo($compile);
        $compile = str_replace($paths['filename'], $_W['uniacid'] . '_' . $paths['filename'], $compile);
        if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
            template_compile($source, $compile, true);
        }
        return $compile;
    }




    protected function createWebAppUrl($do, $query = array()) {
        $query['do'] = $do;
        $query['m'] = strtolower($this->modulename);
        return murl('entry/webapp', $query,true);
    }
}