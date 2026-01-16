<?php

namespace app\common\controller;

use think\Controller;

class common extends Controller
{

    private $uniacid;


    public function initialize()
    {
        global $_W;
        $this->setUniacid($_W["uniacid"]);
    }


    /**
     * @return mixed
     */
    protected function getUniacid()
    {
        return $this->uniacid;
    }

    /**
     * @param mixed $uniacid
     */
    protected function setUniacid($uniacid)
    {
        $this->uniacid = $uniacid;
    }



    public function getJson($code = 0, $msg = '', $data = ''){
        echo json([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ]);
    }



}
