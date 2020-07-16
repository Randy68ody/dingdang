<?php
namespace app\api\service;

use app\api\model\User as UserModel;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

class UserToken extends Token {
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.appid');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $wxRes = json_encode($result,true);
        if(empty($wxRes)){
            throw new Exception('微信内部错误，获取session_key和openID时异常');
        }else{
            $loginFail = @array_key_exists('errcode',$wxRes);
            if($loginFail){
                $this->processLoginError($wxRes);
            }else{
                return $this->grantToken(json_decode($wxRes,true));
            }
        }
    }

    private function grantToken($wxRes){
        // 获取openid
        // 查看openid是否已经存在
        // 生成令牌,缓存数据,返回客户端
        var_dump($wxRes);exit;
        $openid = $wxRes['openid'];
        $user = UserModel::getByOpenID($openid);
        if($user){
            $uid = $user->id;
        }else{
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxRes,$uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    private function saveToCache($cachedValue){
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = config('setting.topen_expire_in');
        $request = cache($key,$value,$expire_in);
        if(!$request){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

    private function prepareCachedValue($wxRes,$uid){
        $cachedValue = $wxRes;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;//scope作用域，代表接口访问权限
        return $cachedValue;
    }

    private function newUser($openid){
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    private function processLoginError($wxRes){
        throw new WeChatException([
            'msg' => $wxRes['errmsg'],
            'errorCode' => $wxRes[
            'errcode']
        ]);
    }
}