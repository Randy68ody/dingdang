<?php
namespace app\lib\exception;

class SearchFoodException extends \app\lib\exception\BaseException {
    public $code = 404;
    public $msg = '无此商品，请试试其他关键字吧';
    public $errorCode = 20001;
}