<?php
namespace app\lib\exception;

class UserCartException extends BaseException{
    public $code = 404;
    public $msg = '购物车空空哒';
    public $errorCode = 60002;
}