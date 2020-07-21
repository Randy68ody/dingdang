<?php
namespace app\api\validate;

class CartNew extends BaseValidate {
    protected $rule = [
        'food_id' => 'isPositiveInteger|isNotEmpty',
        'num' => 'require|isNotEmpty'
    ];
}