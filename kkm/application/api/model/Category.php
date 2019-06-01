<?php
namespace app\api\model;

class Category extends BaseModel
{
    protected $hidden = [
        'delete_time', 'update_time', 'create_time'
    ];
    
    public function image()
    {
        return $this->hasOne('Image', 'id', 'image');
    }

    public static function getCategoryInfo()
    {
        return self::with(['image'])->select()->toArray();
    }


}