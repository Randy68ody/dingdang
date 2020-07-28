<?php
namespace  app\lib\exception;

class StoreFMException extends BaseException{
    public $code = 404;
    public $msg = '此商户下无商品，换一个试试吧';
    public $errorCode = 60004;
}