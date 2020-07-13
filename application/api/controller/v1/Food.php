<?php
namespace app\api\controller\v1;

use app\api\model\Food as FoodModel;
use app\api\model\Category as CategoryModel;
use app\api\model\FoodMaterials;
use app\api\validate\IdMbpi;
use app\api\validate\SearchFood;
use app\lib\exception\FoodException;
use app\lib\exception\SearchFoodException;

class Food{

    const LIMIT = 3;
    public function accessToFood(){
        $foods = FoodModel::getFoods(self::LIMIT);
        return $foods;
    }

    public function foodDetail($id){
        (new IdMbpi())->goCheck();
        $food = FoodModel::getFoodDetail($id);
        if(!$food) throw new FoodException();
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
}