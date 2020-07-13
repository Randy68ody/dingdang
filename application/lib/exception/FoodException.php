<?php
namespace app\lib\exception;

class FoodException extends \app\lib\exception\BaseException {
    public $code = 404;
    public $msg = '指定食品不存在，请检查食品ID';
    public $errorCode = 20000;
}