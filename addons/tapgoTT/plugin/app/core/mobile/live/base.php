<?php
/*珍贵资源 请勿转卖*/
if (!defined('IN_IA')) {
    exit('Access Denied');
}
require_once TAPGO_TT_PLUGIN . 'app/core/page_mobile.php';

class Base_TapgoTtPage extends AppMobilePage
{

    public $wxliveModel;

    public function __construct()
    {
        parent::__construct();

        $this->wxliveModel = p('wxlive');

        if (!$this->wxliveModel) {
            die(app_error(-1, '系统未安装小程序直播'));
        }
    }

}