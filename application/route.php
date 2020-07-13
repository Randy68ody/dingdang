<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
/* 摇一摇 */
Route::get('api/:version/access_to_food','api/:version.Food/accessToFood');//获取食物
Route::get('api/:version/food_detail/:id','api/:version.Food/foodDetail');//食物详情

/* 分类 */
Route::get('api/:version/all_food_category','api/:version.Category/getAllFoodCate');
Route::post('api/:version/search','api/:version.Food/searchFood');

/* 食材 */
Route::post('api/:version/get_all_mates','api/:version.FoodMate/getFoodMate');
Route::post('api/:version/get_mates_by_CID','api/:version.Category/getMateByCateID');

/* ------------------------------------------------------------------- */
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

Route::group('api/:version/product',function (){
    Route::get('/by_category','api/:version.Product/getAllInCategory');
    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
    Route::get('/recent','api/:version.Product/getRecent');

});

Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

Route::post('api/:version/token/user','api/:version.Token/getToken');

Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');
