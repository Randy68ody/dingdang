<?php
namespace app\api\model;

class User extends BaseModel{

    protected $autoWriteTimestamp = true;

    public static function getByOpenID($openid){
        $user = self::where('openid',$openid)->find();
        return $user;
    }

    public function collect(){
        return $this->hasMany('FoodCollect','uid','id');
    }

//    public function address(){
//        return $this->hasMany('UserAddress','user_id','id');
//    }


}