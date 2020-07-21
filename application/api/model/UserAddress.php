<?php
namespace app\api\model;

class UserAddress extends BaseModel{
    protected $autoWriteTimestamp = true;
    protected $hidden = ['id','delete_time','user_id'];

    public static function getUserAddress($uid){
        $userAddress = self::where('uid',$uid)
            ->where('is_shops',0)
            ->where('is_default',1)
            ->find();
        return $userAddress;
    }
}