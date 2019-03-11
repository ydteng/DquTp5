<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/2/25
 * Time: 19:34
 */

namespace app\api\model;


class User extends BaseModel
{
    protected $hidden = ['create_time','update_time','delete_time'];
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
        //$address = $address['0']->visible(['address']);
        $address = $address['0']->hidden([
            'id','openid','score','status','address'=>['province.id','school.id','school.provinceId','school.level','school.city'],

        ]);
        return $address;
    }


}