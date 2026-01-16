<?php
defined('IN_IA') or exit('Access Denied');
 
require  'func.php';


class WebPage extends FuncPage
{
    private function getLogic($_name, $auth = false, $extraPath = '')
    {
        $this->getLogicRoot($_name, 'web', $auth, $extraPath);
    }


    public function doWebWeb(){
        global $_GPC,$_W;
        $route = explode(".",$_GPC['r']);
        $fileName = "doWeb".implode("/",$route);
        $this->getLogic($fileName, 'web');
    }


	public function doWebStudents() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

    /************keep_yiheedu()***********/
	//属性管理
	public function doWebAttribute() {
        $this->getLogic ( __FUNCTION__);
    }
    //推广管理
	public function doWebPromoteFans() {
        $this->getLogic ( __FUNCTION__);
	}
    /************keep_yiheedu()***********/
}
