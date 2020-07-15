<?php
namespace app\api\controller\v1;

use app\api\model\FoodMaterials;
use app\api\model\User as UserModel;
use app\api\validate\CartNew;
use app\lib\exception\FoodException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserCartException;
use app\lib\exception\UserException;
use app\api\model\Cart as CartModel;

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
        $post_data = $validate->getDataByRule(input('post.'));

        $food_mate = FoodMaterials::getFoodMateDetail($post_data['food_id']);
        if(!$food_mate) throw new FoodException();
        else{
            $post_data['uid'] = $uid;
            $post_data['title'] = $food_mate['mate_name'];
            $post_data['sales_price'] = $food_mate['sales_price'];
            $post_data['market_price'] = $food_mate['market_price'];
            $post_data['total_price'] = $post_data['num'] * $food_mate['sales_price'];
            $res = CartModel::getCartFood($post_data['food_id'],$uid);
            if($res){
                $post_data['num'] = intval($post_data['num']) + intval($res['num']);
                $post_data['total_price'] = $post_data['num'] * $food_mate['sales_price'];
                (new CartModel())
                    ->where('food_id',$post_data['food_id'])
                    ->where('uid',$uid)
                    ->update($post_data);
            }else{
                (new CartModel())->save($post_data);
            }
        }
        return json(new SuccessMessage(),201);
    }

    /* 购物车列表 2020.7.15 */
    public function myCartList(){
        $uid = 1; //Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $cart_mates = CartModel::getMyCartList($uid);
        if(!$cart_mates) throw new UserCartException();
        return $cart_mates;
    }
}