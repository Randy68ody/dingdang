<?php
namespace app\api\validate;

class IsSelected extends BaseValidate {
    protected $rule = [
        'store_id'=>'require|isPositiveInteger',
        'id'=>'require|isNotEmpty',
        'select'=>'require|isNotEmpty'
    ];
}