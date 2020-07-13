<?php
namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\api\model\FoodMaterials;
use app\api\validate\IdMbpi;
use app\lib\exception\CategoryException;

class Category{

    const IS_FOOD_CATE = 1;
    public static function getAllFoodCate(){
        $cates = CategoryModel::getAllCate(self::IS_FOOD_CATE);
        return $cates;
    }

    /* 通过食材分类获取食材 2020.7.10 */
    public function getMateByCateID(){
        $validata = new IdMbpi();
        $validata->goCheck();
        $post_data = $validata->getDataByRule(input('post.'));
        $mates = FoodMaterials::getMatesByCateID($post_data['id']);
        if($mates->isEmpty()) throw new CategoryException();
        return $mates;
    }

}