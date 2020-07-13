<?php
/**
 * Created by PhpStorm.
 * User: 石鹏飞
 * Date: 2020/1/1
 * Time: 22:43
 */

namespace app\api\validate;

class IdMbpi extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];
    protected $message = [
        'id' => 'id必须是正整数'
    ];
}