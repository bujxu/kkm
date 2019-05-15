<?php

namespace app\api\service;
use \think\Db;
use app\api\model\Table as TableModel;
use app\api\model\UserTable as UserTableModel;

class Fraternity
{
    public static function tableCreate($userId, $content)
    {   
        Db::startTrans();
        try
        {
            if ($content['id'] != null)
            {
                $table = TableModel::where(['id' => $content['id']])->find();
            }
            else 
            {
                $table = new TableModel();
            }
            $table->user_id = $userId;
            $table->number = $content['number'];
            $table->amountOfMoney = $content['amountOfMoney'];
            $table->timeInterval = $content['timeInterval'];
            $table->phoneNumber = $content['phoneNumber'];
            $table->bank = $content['bank'];
            $table->bankNumber = $content['bankNumber'];
            $table->dateArray = $content['dateArray'];
            $table->commentArray = $content['commentArray'];
            $table->numberArray = $content['numberArray'];
            $table->moneyOfFraternity = $content['moneyOfFraternity'];
            $table->nameArray = $content['nameArray'];
            $table->theme = $content['theme'];
            $table->time = $content['time'];
            $table->save();
            
            // $userShop = new UserShopModel();
            // $userShop->user_id = $userId;
            // $userShop->shop_id = $shop->id;
            // $userShop->save();

            return $table->id;
        }
        catch (Exception $ex)
        {
            Db::rollback();
            throw $ex;
        }

    }

    public static function joinInFraternity ($uid, $tableId)
    {
        $result = UserTableModel::find(['user_id' => $uid, 'table_id' => $tableId]);
        if ($result != null)
        {
            return;
        }
        Db::startTrans();
        try
        {
            $userTable = new UserTableModel();
            $userTable->user_id = $uid;

            $userTable->table_id = $tableId;
            $userTable->save();
            
            // $userShop = new UserShopModel();
            // $userShop->user_id = $userId;
            // $userShop->shop_id = $shop->id;
            // $userShop->save();

            return $userTable->id;
        }
        catch (Exception $ex)
        {
            Db::rollback();
            throw $ex;
        }
    }

    public static function getUserTableInfoByUsrId($userId)
    {
        return UserTableModel::getTableInfo($userId);
    }

    public static function getTableInfo($userId)
    {
        $tableInfo = TableModel::getTableInfo($userId);

    }
 
}