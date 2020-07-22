<?php
namespace app\api\model;

class UserAddress extends BaseModel{
    protected $autoWriteTimestamp = true;
//    protected $hidden = ['id','delete_time','user_id'];

    public static function getUserAddress($uid){
        $userAddress = self::where('uid',$uid)
            ->where('is_shops',0)
            ->where('is_default',1)
            ->find();
        return $userAddress;
    }

    public static function getMyAddress($uid){
        $userAddress = self::field('id,name,mobile,province,city,country,detail,is_shops,is_default')
            ->where('uid',$uid)
            ->order('create_time','desc')
            ->select();
        return $userAddress;
    }

    public static function updIsDefault($uid,$id){
        $upd_res = self::update(['is_default'=>1],['uid'=>$uid,'id'=>$id]);
        self::where('uid',$uid)
            ->where('id','<>',$id)
            ->update(['is_default'=>0]);
        return $upd_res;
    }
}