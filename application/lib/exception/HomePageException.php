<?php
namespace app\lib\exception;

class HomePageException extends BaseException {
    public $code = 404;
    public $msg = '首页走丢了~~(>_<)~~';
    public $errorCode = 30001;
}