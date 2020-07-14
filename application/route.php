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
Route::post('api/:version/collect','api/:version.Food/collect');// 加入/取消 收藏
/* 分类 */
Route::get('api/:version/all_food_category','api/:version.Category/getAllFoodCate');
Route::post('api/:version/search','api/:version.Food/searchFood');

/* 食材 */
Route::post('api/:version/get_all_mates','api/:version.FoodMate/getFoodMate');
Route::post('api/:version/get_mates_by_CID','api/:version.Category/getMateByCateID');
Route::get('api/:version/get_FM_detail/:id','api/:version.FoodMate/getFoodMateDetail'); //食材详情

/* 用户 */
Route::post('api/:version/token/user','api/:version.Token/getToken');


//Route::group('api/:version/product',function (){
//    Route::get('/by_category','api/:version.Product/getAllInCategory');
//    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
//    Route::get('/recent','api/:version.Product/getRecent');
//
//});