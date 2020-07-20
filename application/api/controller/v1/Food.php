<?php
namespace app\api\controller\v1;

use app\api\model\Food as FoodModel;
use app\api\model\Category as CategoryModel;
use app\api\model\FoodCollect;
use app\api\model\FoodMaterials;
use app\api\model\User as UserModel;
use app\api\validate\CollectFood;
use app\api\validate\IdMbpi;
use app\api\validate\SearchFood;
use app\lib\exception\FoodException;
use app\lib\exception\OperationFailureException;
use app\lib\exception\SearchFoodException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use app\api\service\Token;

class Food{

    const LIMIT = 3;
    public function accessToFood(){
        $foods = FoodModel::getFoods(self::LIMIT);
        return $foods;
    }

    public function foodDetail($id){
        (new IdMbpi())->goCheck();

        $food = FoodModel::getFoodDetail($id);
        if(!$food){
            throw new FoodException();
        }else{
            $uid = 1;//Token::getCurrentUid();
            $user = UserModel::get($uid);
            if(!$user){
                throw new UserException();
            }else{
                //查询用户是否收藏此食品
                $where = [
                    'food_id' => $id,
                    'uid' => $uid
                ];
                $userCollect = FoodCollect::findUserCollect($where);
                if($userCollect){
                    $food['is_collect'] = 1;
                }else{
                    $food['is_collect'] = 0;
                }
            }
        }
        return $food;
    }

    public function searchFood(){
        $validata = new SearchFood();
        $validata->goCheck();
        $search_data = $validata->getDataByRule(input('post.'));
        // 按名称获取分类的ID
        $id = CategoryModel::getCateByName($search_data['name']);
        //如果存在，查询相关类别的菜，否则按食材查找
        if($id){
            $food_ids = CategoryModel::getReleFoodsID($id);
            $foods = FoodModel::getFoodByID($food_ids);
            if(!$foods) throw new SearchFoodException();
        }else{
            $mate_id = FoodMaterials::getMateByName($search_data['name']);
            if(!$mate_id) throw new SearchFoodException();
            $foods = FoodModel::getFoodByMateID($mate_id);
        }
        return $foods;

    }


    /* 食品加入/取消收藏 2020.7.13 */
    public function collect(){
        $validate = new CollectFood();
        $validate->goCheck();
        //根据Token获取用户数据
        $uid = Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $where = [
            'food_id' => $dataArray['food_id'],
            'uid' => $uid
        ];
        $userCollect = FoodCollect::findUserCollect($where);
        if(!$userCollect){
            $dataArray['uid'] = $uid;
            (new FoodCollect())->save($dataArray);
            $data['is_collect'] = 1;
        }else{
            (new FoodCollect())->where($where)->delete();
            $data['is_collect'] = 0;
        }
        $data['code'] = 201;
        $data['msg'] = 'ok';
        $data['errorCode'] = 0;
        return $data;
    }

    /* 我的收藏 2020.7.15 */
    public function myCollect(){
        //根据Token获取用户数据
        $uid = Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $userCollect = FoodCollect::getMyCollect($uid);
        return $userCollect;
    }

    /* 删除我的收藏里的商品 2020.7.15 */
    public function delMyCollect($id){
        (new IdMbpi())->goCheck();
        $uid = Token::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $res = FoodCollect::delMC($id);
        if($res) return json(new SuccessMessage(),201);
        else throw new OperationFailureException();
    }
}