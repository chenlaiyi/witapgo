<?php
namespace app\index\validate;

use think\Validate;

class Feedback extends Validate
{
    protected $rule = [
        'title|标题'  =>  'require|max:100|token',
        'content|内容' =>  'require|max:250',
    ];

}