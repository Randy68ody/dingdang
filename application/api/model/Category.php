<?php
namespace app\api\model;

class Category extends BaseModel {

    public static function getAllCate($food_or_mate){
        $cates = self::field('id,category_name,weight,image')
            ->where('food_or_mate', $food_or_mate)
            ->select();
        return $cates;
    }

    public static function getCateByName($name = ''){
        $cate_id = self::where('category_name', '=',$name)
            ->value('id');
        return $cate_id;
    }

    public static function getReleFoodsID($id = 0){
        $food_ids = self::where('id',$id)
            ->value('rele_food_id');
        return $food_ids;
    }
//    protected $hidden = ['delete_time','update_time','create_time'];
//
//    public function img(){
//        return $this->belongsTo('image','topic_img_id','id');
//    }
}