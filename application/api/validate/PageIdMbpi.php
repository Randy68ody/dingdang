<?php
namespace app\api\validate;

class PageIdMbpi extends BaseValidate
{
    protected $rule = [
        'page' => 'require|isNotEmpty'
    ];
    protected $message = [
        'page' => '页码必须是正整数'
    ];
}