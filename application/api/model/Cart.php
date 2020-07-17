<?php
namespace app\api\model;

class Cart extends BaseModel {

    protected $autoWriteTimestamp = true;

    public static function getCartFood($id,$uid){
        $res = self::where('uid',$uid)
            ->where('food_id',$id)
            ->where('uid',$uid)
            ->find();
        return $res;
    }

    public static function getMyCartList($uid){
        $cart_mates = self::alias('c')
            ->join('food_materials fm','fm.id=c.food_id')
            ->field('c.id,c.title,fm.image,c.sales_price,c.market_price,c.total_price,fm.store_id')
            ->where('uid',$uid)
            ->order('create_time','desc')
            ->select()
            ->toArray();
        return $cart_mates;
    }

    public static function delCartPro($ids = ''){
        $res = self::whereIn('id',$ids)
            ->delete();
        return $res;
    }
}