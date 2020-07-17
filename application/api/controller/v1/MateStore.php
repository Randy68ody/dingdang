<?php
namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use app\api\service\Token;
use app\api\validate\AddressNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class MateStore{

    /* 店铺入驻 2017.7.17 */
    public function shopsIn(){
        $validate = new AddressNew();
        $validate->goCheck();
        //根据Token获取用户数据
        $uid = Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('.post'));
        $userAddress = $user->address();
        $userStore = $user->store();
        $store_data['store_name'] = $dataArray['name'];
        if(!$userAddress){
            $user->address()->save($dataArray);
            $user->store()->save($store_data);
        }else{
            $user->address()->save($dataArray);
            $user->store()->save($store_data);
        }
        return json(new SuccessMessage(),201);


    }
}