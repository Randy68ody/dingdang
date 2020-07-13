<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //读取器/获取器
    protected function prefixImgUrl($value,$data){
        $finalUrl = $value;
        if($data['from'] == 1)
            $finalUrl = config('setting.img_prefix').$finalUrl;
        return $finalUrl;
    }
}
