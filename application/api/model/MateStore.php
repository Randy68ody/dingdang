<?php
namespace app\api\model;

class MateStore extends BaseModel {
    public static function getStores($ids){
        $stores = self::field('id,store_name,store_image,mobile')
            ->whereIn('id', $ids)
            ->select()
            ->toArray();
        return $stores;
    }


    public static function getStoreFoodMates($id){
        $food_mates = FoodMaterials::field('id,image,mate_name,market_price,sales_price')
            ->where('store_id',$id)
            ->order('create_time','desc')
            ->select();
        return $food_mates;
    }
}