<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/2/25
 * Time: 19:34
 */

namespace app\api\model;


use think\Route;

class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid)
    {
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }

    public static function getAddress($id){

        $address = self::with(['address'=>['province','school']])->select($id);
        if(!$address){
            throw new MissException();
        }
        return $address['0']->visible(['address']);
    }


}