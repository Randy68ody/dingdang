<?php
/**
 * Created by PhpStorm.
 * User: 石鹏飞
 * Date: 2020/1/1
 * Time: 22:20
 * Validate验证器
 */

namespace app\api\validate;
use think\Validate;

class TestValidate extends Validate
{
    protected $rule = [
        'name'=>'require|max:10',
        'email'=>'email',
    ];
}