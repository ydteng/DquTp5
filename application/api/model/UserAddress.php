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
    protected $hidden = ['province_id','school_id','create_time','update_time','delete_time'];
    public function province()
    {
        return $this->hasOne('Provinces','id','province_id');
    }

    public function school()
    {
        return $this->hasOne('School','id','school_id');
    }


}