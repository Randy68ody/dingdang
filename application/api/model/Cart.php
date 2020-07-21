<?php
namespace app\api\model;

class Cart extends BaseModel {

    protected $autoWriteTimestamp = true;
    /* 获取某用户单条数据 */
    public static function getCartFood($id,$uid){
        $res = self::where('uid',$uid)
            ->whereIn('food_id',$id)
            ->find();
        return $res;
    }
    /* 获取某用户多条购物车数据 */
    public static function getCartFoods($ids,$uid){
        $cart_mates = self::alias('c')
            ->join('food_materials fm','fm.id=c.food_id')
            ->field('c.id,c.food_id,c.title,fm.image,c.sales_price,c.market_price,c.total_price,fm.store_id,c.num')
            ->where('c.uid',$uid)
            ->whereIn('c.id',$ids)
            ->order('c.create_time','desc')
            ->select()
            ->toArray();
        return $cart_mates;
    }

    public static function getMyCartList($uid){
        $cart_mates = self::alias('c')
            ->join('food_materials fm','fm.id=c.food_id')
            ->field('c.id,c.food_id,c.title,fm.image,c.sales_price,c.market_price,c.total_price,fm.store_id,c.num')
            ->where('c.uid',$uid)
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

    public static function getUserCartNum($uid){
        $number_data = self::where('uid',$uid)
            ->field('num')
            ->select()
            ->toArray();
        $number = 0;
        foreach ($number_data as $k=>$v) {
            $number += $v['num'];
        }
        return $number;
    }
}