<?php
namespace app\api\model;

class MateStore extends BaseModel {
    public static function getStores($ids){
        $stores = self::field('id,store_name,store_image')
            ->whereIn('id', $ids)
            ->select()
            ->toArray();
        return $stores;
    }
}