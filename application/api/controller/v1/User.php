<?php
namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use app\api\service\Token;
use app\lib\exception\UserException;

class User{
    public function isShop(){
        $uid = Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        return $data = [
            'code' => 201,
            'msg' => 'ok',
            'errorCode' => 0,
            'is_shop' => $user->is_shop
        ];
    }

}
