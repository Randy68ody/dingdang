<?php
namespace app\api\model;

class FoodMaterials extends BaseModel {

    public static function getMateByName($name = ''){
        $mate_id = self::where('mate_name',$name)
            ->value('id');
        return $mate_id;
    }

    /* 食材-每日推荐 2020.7.10 */
    public static function getmates($limit = 0){
        $mates = self::field('id,mate_name,image,sales_price,market_price')
            ->orderRaw('rand()')
            ->limit($limit)
            ->select();
        return $mates;
    }
    /* 食材-全部商品 2020.7.10 */
    public static function getAllMates($page = 0,$page_num){
        $config = [
            'page' => $page,
            'list_rows' => $page_num
        ];
        $page_mates = self::field('id,mate_name,image,sales_price,market_price')
            ->paginate($config);
        return $page_mates;
    }
    /* 食材-全部商品 2020.7.10 */
    public static function getMatesByCateID($id){
        $mates = self::field('id,mate_name,image,sales_price,market_price')
            ->where('category_id',$id)
            ->select();
        return $mates;
    }

    public function storeInfo(){
        return $this->hasOne('MateStore','id','store_id');
    }

    public static function getFoodMateDetail($id){
        $foodmate = self::field('id,mate_name,image,content,market_price,sales_price,store_id')
            ->with(['storeInfo'])
            ->find($id);
        return $foodmate;
    }
}