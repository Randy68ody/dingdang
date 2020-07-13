<?php
namespace app\lib\exception;

class CategoryException extends BaseException{
    public $code = 404;
    public $msg = '指定分类不存在，请检查分类ID';
    public $errorCode = 30001;
}