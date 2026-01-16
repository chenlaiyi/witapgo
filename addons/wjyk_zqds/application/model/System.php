<?php
namespace app\model;

use think\Model;

/**
 * 系统设置表模型
 * @package app\model
 */
class System extends Model
{
    protected $table = 'ims_wjyk_service_system';
    
    /**
     * 数据表主键id
     *
     * @var string
     */
    protected $pk = "id";

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $updateTime = false;

}
