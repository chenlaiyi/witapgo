<?php
namespace app\model;

use think\Model;

/**
 * 反馈表模型
 * @package app\model
 */
class Feedback extends Model
{
    /**
     * 数据表主键id
     *
     * @var string
     */
    protected $pk = "id";

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;



}
