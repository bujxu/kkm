<?php 

namespace app\api\model;

class Table extends BaseModel
{
    public static function getShopInfo($userId)
    {
        $shopInfo = self::where(['user_id' => $userId])->find();
        if ($shopInfo != null)
            $shopInfo = $shopInfo->toArray();

        return $shopInfo;
    }

    public static function getTableInfo($userId)
    {
        $shopInfo = self::where(['user_id' => $userId])->find();
        if ($shopInfo != null)
            $shopInfo = $shopInfo->toArray();

        return $shopInfo;
    }
}