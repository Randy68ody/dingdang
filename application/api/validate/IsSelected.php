<?php
namespace app\api\validate;

class IsSelected extends BaseValidate {
    protected $rule = [
        'id'=>'require|isPositiveInteger',
        'select'=>'require|isNotEmpty'
    ];
}