<?php

return [
    'img_prefix' => 'https://fraterntiy.bujxu.com/fraterntiy/public/static/upload/image/',
    'token_expire_in' => 7200,
    'web_url' => 'https://fraterntiy.bujxu.com/mtjs/', 
    'QRcode' => 'public/static/upload/QRcode/',
    'upload_config' => 
    array (
      'allowExts' => 
      array (
        0 => 'jpg',
        1 => 'gif',
        2 => 'png',
        3 => 'jpeg',
      ),
      'maxSize' => 3145728,
      'savePath' => './static/upload/',
      'autoSub' => true,
      'subType' => 'date',
    )
];