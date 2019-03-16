<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/11
 * Time: 10:13
 */

namespace app\api\model;


use app\lib\exception\MissException;

class Order extends BaseModel
{
    protected $hidden = ['end_point_id','user_id','create_time','update_time','delete_time'];

    public function endPoint()
    {
        return $this->hasOne('UserAddress','user_id','end_point_id');
    }

    public static function getAllOrders($page)
    {
        $orders = self::with('endPoint')->where(['status'=>'1'])
            ->page($page,10)->order('create_time asc')->select();

        myHidden($orders,['status','detail','end_point.user_id']);

        if (!$orders){
            throw new MissException();
        }
        return $orders;
    }


    public static function getUserOrder($page,$uid)
    {
        $orders = self::with('endPoint')->where(['user_id' => $uid])
            ->page($page,10)->order('create_time desc')->select();
        myHidden($orders,['detail','end_point.user_id']);
        if (!$orders){
            throw new MissException();
        }
        return $orders;
    }
}