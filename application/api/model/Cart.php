<?php
namespace app\api\model;

class Cart extends BaseModel {
    public static function getCartFood($id,$uid){
        $res = self::where('uid',$uid)
            ->where('food_id',$id)
            ->where('uid',$uid)
            ->find();
        return $res;
    }
}