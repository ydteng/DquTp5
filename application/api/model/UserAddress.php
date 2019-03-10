<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/3
 * Time: 13:50
 */

namespace app\api\model;


use app\lib\exception\MissException;

class UserAddress extends BaseModel
{
    public function province()
    {
        return $this->hasOne('Provinces','id','province_id');
    }

    public function school()
    {
        return $this->hasOne('School','id','school_id');
    }


}