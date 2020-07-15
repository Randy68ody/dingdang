<?php
namespace app\api\controller\v1;

use app\api\model\FoodCollect;
use app\api\model\User as UserModel;
use app\api\validate\CartNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Cart{
    /* 将商品加入购物车 2020.7.15 */
    public function addOrUpdCart(){
        $validate = new CartNew();
        $validate->goCheck();
        $uid = 1; //Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
//        $where = [
//            'food_id' => $dataArray['food_id'],
//            'uid' => $uid
//        ];
//        $userCollect = (new FoodCollect())->where($where)->find();
//        if(!$userCollect){
//            $dataArray['uid'] = $uid;
//            (new FoodCollect())->save($dataArray);
//        }else{
//            (new FoodCollect())->where($where)->delete();
//        }
        return json(new SuccessMessage(),201);
    }
}