<?php
namespace app\lib\exception;

class OperationFailureException extends BaseException {
    public $code = 404;
    public $msg = '操作失败';
    public $errorCode = 60001;
}