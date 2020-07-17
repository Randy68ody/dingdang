<?php

namespace app\lib\exception;

class ErrorException extends BaseException
{
    public $code = 500;
    public $msg = 'error';
    public $errorCode = 50000;
}