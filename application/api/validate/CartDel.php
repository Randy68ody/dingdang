<?php

namespace app\api\validate;

class CartDel extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|isNotEmpty',
    ];
}