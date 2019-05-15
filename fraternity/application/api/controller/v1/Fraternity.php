<?php
namespace app\api\controller\v1;

use think\Controller;
use app\api\model\Table as TableModel;
use app\api\model\UserTable as UserTableModel;
use \app\api\service\Token as TokenService;
use \app\api\service\Fraternity as FraternityService;
class Fraternity 
{
    public function createTable()
    {
        $input = input('post.');
        $uid = TokenService::getCurrentUid();
        
        $status = FraternityService::tableCreate($uid, $input);
        
        return $status;
    }
    
    // public function getFraternityInfo()
    // {
    //     $uid = TokenService::getCurrentUid();
    //     $status = FraternityService::getTableInfo($uid);

    //     return $status;
    // }

    public function getFraternityInfo()
    {
        $uid = TokenService::getCurrentUid();
        $tableInfo =  TableModel::all(['user_id' => $uid])->toArray();
        //$userTableInfo = UserTableModel::all(['user_id' => $uid])->toArray();
        $userTableInfo = FraternityService::getUserTableInfoByUsrId($uid);
        return ['tableInfo' => $tableInfo, 'userTableInfo' => $userTableInfo];
    }
    
    public function getTableInfo()
    {
        $tableId = input('get.tableId');
        $uid = TokenService::getCurrentUid();
        FraternityService::joinInFraternity($uid, $tableId);
        $result = TableModel::find(['id' => $tableId]);

        return $result;
    }

}