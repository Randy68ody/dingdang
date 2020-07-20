<?php
namespace app\api\model;

class FoodCollect extends BaseModel {
    protected $autoWriteTimestamp = true;//自动写入create_time

    public static function getMyCollect($uid){
        $my_collect = FoodCollect::alias('fc')
            ->field('fc.id,fc.food_id,f.title,f.image,f.eg')
            ->join('food f','f.id=fc.food_id', 'left')
            ->where('food_collect.uid',$uid)
            ->order('food_collect.create_time','desc')
            ->select();
        return $my_collect;
    }

    public static function delMC($id){
        $res = FoodCollect::where('id',$id)->delete();
        return $res;
    }

    public static function findUserCollect($where = []){
        $food = self::where($where)->find();
        return $food;
    }
}