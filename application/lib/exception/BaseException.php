<?php
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception {
    public $code = 400;//HTTP状态码
    public $msg = '参数错误';//错误信息
    public $errorCode = 10000;//自定义错误码

    public function __construct($param = []){
        if(!is_array($param)){
            throw new Exception('参数必须是数组');
        }
        if (array_key_exists('code',$param)){
            $this->code = $param['code'];
        }
        if (array_key_exists('msg',$param)){
            $this->msg = $param['msg'];
        }
        if (array_key_exists('errorCode',$param)){
            $this->msg = $param['errorCode'];
        }
    }
}