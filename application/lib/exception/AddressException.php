<?php
namespace app\lib\exception;

class AddressException extends BaseException{
    public $code = 404;
    public $msg = '该用户暂无默认收货地址，请填写';
    public $errorCode = 60003;
}