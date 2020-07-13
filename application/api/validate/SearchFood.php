<?php
namespace app\api\validate;

class SearchFood extends BaseValidate {
    protected $rule = [
        'name'=>'require|isNotEmpty',
    ];
}