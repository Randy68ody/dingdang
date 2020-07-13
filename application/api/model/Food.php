<?php
namespace app\api\model;

class Food extends BaseModel {
    /*  随机获取三条食品数据  */
    public static function getFoods($limit = 0){
        $foods = self::field('id,title,image')
            ->orderRaw('rand()')
            ->limit($limit)
            ->select();
        return $foods;
    }

    /*  查询食品ByID  */
    public static function getFoodByID($ids){
        $foods = self::field('id,title,image,eg')
            ->whereIn('id',$ids)
            ->select();
        return $foods;
    }

    /*  查询食品ByMateID  */
    public static function getFoodByMateID($mate_id){
        $foods = self::field('id,title,image,eg')
            ->where('use_mate_id','like','%'.$mate_id.'%')
            ->select();
        return $foods;
    }

    /*  获取食品详情  */
    public static function getFoodDetail($id){
        $food = self::with([
            'cookSteps'=>function($query){
                $query->order('order');
            }
        ])
            ->find($id);
        return $food;
    }

    public function cookSteps()
    {
        return $this->hasMany('CookStep','food_id','id');
    }
}