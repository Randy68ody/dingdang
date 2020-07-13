<?php
namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\api\model\Food as FoodModel;
use app\api\model\FoodMaterials;
use app\api\validate\IdMbpi;
use app\api\validate\PageIdMbpi;
use app\lib\exception\FoodException;

class FoodMate{

    const IS_MATE_CATE = 2;
    const DAILYSPECIAL_LIMIT = 3;
    const PRODUCT_SHOW_NUM = 2;
    /* 获取食材首页信息 2020.7.10 */
    public function getFoodMate(){
        $validate = new PageIdMbpi();
        $validate->goCheck();
        $page_data = $validate->getDataByRule(input('post.'));
        $home_page_data = array(
            'category' => $this->getMateCate(),
            'recommend' => $this->dailySpecial(),
            'products' => FoodMaterials::getAllMates($page_data['page'],self::PRODUCT_SHOW_NUM)
        );
        return $home_page_data;
    }

    /* 食材首页分类信息 2020.7.10 */
    public function getMateCate(){
        $cates = CategoryModel::getAllCate(self::IS_MATE_CATE);
        return $cates;
    }

    /* 食材每日推荐 2020.7.10 */
    public function dailySpecial(){
        $recom = FoodMaterials::getmates(self::DAILYSPECIAL_LIMIT);

        return $recom;
    }

    /* 食材详情 2020.7.13 */
    public function getFoodMateDetail($id){
        (new IdMbpi())->goCheck();
        $food = FoodMaterials::getFoodMateDetail($id);
        if(!$food) throw new FoodException();
        return $food;
    }
}