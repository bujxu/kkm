<?php

namespace app\api\controller\v1;

use app\api\model\Good as GoodModel;
use \app\api\service\Upload as UploadService;
use app\api\service\Token as TokenService;
use app\api\service\Good as GoodService;
use app\api\model\UserAddress;
use \think\Db;

class Good
{
    public function getGoodInfo()
    {
        $id = input('get.good_id');
        $goodInfo = GoodService::getGoodInfo($id);

        return $goodInfo;
    }

    public function shoppingCartDelete()
    {
        $id = input('post.shoppingCartId');
        $userId = TokenService::getCurrentUid();

        GoodService::shoppingCartDelete($id);
        return self::getShoppingCart();
    }

    public function shoppingCartAdd()
    {
        $content = input('get.');
        $userId = TokenService::getCurrentUid();
        $result = GoodService::shoppingCartAdd($userId, $content);

        return $result;
    }

    public function getShoppingCart()
    {
        $userId = TokenService::getCurrentUid();
        $address = UserAddress::where(['user_id' => $userId, 'status' => 'DEFAULT'])->find();
        if ($address != null)
        {
            $address = $address->toArray();
        }
        return ['shoppingCart' => GoodService::getShoppingCart($userId), 'address' => $address];
    }

    public function getCategory()
    {
        $userId = TokenService::getCurrentUid();
        return GoodService::getCategoryInfo();
    }

    public function goodCategoryCreate()
    {
        // $id = input('get.good_id');
        $content = input('post.');
        $categoryId = GoodService::goodCategoryCreate($content);

        return $categoryId;
    }

    public function goodCategoryEdit()
    {
        GoodService::goodCategoryEdit();
        return;
    }
    // public function getGroupUsers($groupId='')
    // {
    //     // (new GroupUsersGet)->goCheck();
    //     $result = GroupModel::getGroupUsers($groupId);
        
    //     return $result;
    // }

    public function uploadImage()
    {
        $result = UploadService::uploadPicture();

        return $result;
    }

    public function userUploadAdd()
    {
        $content = input('post.');

        $userId = TokenService::getCurrentUid();
        $GoodId = GoodService::createGood($userId, $content);

        return array('error' => 0);
    }

    public function userUploadModify()
    {
        // $images = json_decode(input('post.images'), true);
        $content = input('post.');

        GoodService::userUploadModify($content);

        return array('error' => 0);
    }

    // public function userUploadDel()
    // {
    //     $commitId = input('get.commitId');
    //     CommitService::deleteCommit($commitId);
    // }
    public function getImageUrl($val)
    {
        $imageUrl = [];
        $imageDetailUrl = [];
        foreach ($val as $value) {
            if ($value["detail_image"] == 0)
            {
                array_push($imageUrl,$value['image']['url']);
            }
            else
            {
                array_push($imageDetailUrl,$value['image']['url']);
            }
        }
        
        return array($imageUrl, $imageDetailUrl);
    }
    public function getImageId($val)
    {
        $imageId = [];
        $imageDetailId = [];
        foreach ($val as $value) {
            if ($value["detail_image"] == 0)
            {
                array_push($imageId,$value['image']['id']);
            }
            else
            {
                array_push($imageDetailId,$value['image']['id']);
            }
        }
        
        return array($imageId, $imageDetailId);
    }
    public function goodList()
    {
        $userId = TokenService::getCurrentUid();
        $goodList = GoodService::getGoodByUserId($userId);
        $imagesTemp = array_column($goodList, 'good_images');

        for ($index = 0; $index < count($imagesTemp); $index++) {
            // array_push($goodList[$index], self::getImageUrl($imagesTemp[$index]));
            $goodList[$index]['imageUrl'] =  self::getImageUrl($imagesTemp[$index]);
            $goodList[$index]['imageId'] = self::getImageId($imagesTemp[$index]);
            // $goodList[$index]['goodCategory'] = unserialize($goodList[$index]['goodCategory']);
        }
        
        return array('good_list' => $goodList);
    }

    public function getGoodShareQCode()
    {
        $goodId = input('get.goodId');
        return GoodService::getGoodShareQCode($goodId);
    }

    public function goodDelete()
    {
        $id = input('get.id');
        GoodService::deleteGood($id);
    }
    // public function goodList()
    // {
    //     $userId = TokenService::getCurrentUid();
    //     $result = GoodService::where(['user_id' => $userId])->select()->toArray();
    //     return $images;
    // }

}