<?php
namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use app\api\service\Token;
use app\api\validate\AddressNew;
use app\api\validate\IdMbpi;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use app\api\model\MateStore as MateStoreModel;

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
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address();
        $userStore = $user->mateStore();
        $store_data['store_name'] = $dataArray['name'];
        $store_data['mobile'] = $dataArray['mobile'];
        if(!$userAddress){
            $user->address()->save($dataArray);
            $user->mateStore()->save($store_data);
        }else{
            $user->address()->save($dataArray);
            $user->mateStore()->save($store_data);
            $user->where('id',$uid)->update(['is_shop'=>1]);
        }
        return json(new SuccessMessage(),201);
    }
    /* 获取商户下商品 2017.7.28 */
    public function storeFoodMates($id){
        (new IdMbpi())->goCheck();
        $store_info = MateStoreModel::getStores($id);
        if(!$store_info) throw new UserException();
        $store_fm = MateStoreModel::getStoreFoodMates($id);
        if(!$store_fm) $store_fm=[];
        return $store = [
            'store_info' => $store_info,
            'store_fm'=> $store_fm
        ];
    }
}