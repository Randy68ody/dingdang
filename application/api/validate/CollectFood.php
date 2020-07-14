<?php
namespace app\api\validate;

class CollectFood extends BaseValidate {
    protected $rule = [
        'food_id'=>'require|isNotEmpty',
    ];
}