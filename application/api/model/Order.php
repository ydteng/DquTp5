<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/11
 * Time: 10:13
 */

namespace app\api\model;


use app\lib\exception\MissException;
use app\api\service\TimeOut as TimeOutService;

class Order extends BaseModel
{
    protected $hidden = ['end_point_id','user_id','packer_id','create_time','update_time','delete_time'];

    public function endPoint()
    {
        return $this->hasOne('UserAddress','user_id','end_point_id');
    }

    public static function getReceiverByOrderID($id){
        $receiver = self::where(['id' => $id])->find();
        if (!$receiver){
            throw new MissException();
        }
        $receiverID = $receiver->user_id;
        return $receiverID;
    }

    public static function getAllOrders($page)
    {
        $orders = self::with('endPoint')->where(['status'=>'2000'])
            ->whereTime('create_time','>','-44 days')
            ->page($page,10)->order('create_time asc')->select();
        myHidden($orders,['detail','end_point.id','end_point.nickname','end_point.real_name','end_point.mobile']);
        if (!$orders){
            $orders =[];
        }
        return $orders;
    }


    public static function getUserOrder($page,$uid)
    {
        $orders = self::with('endPoint')->where(['user_id' => $uid])
            ->page($page,10)->order('create_time desc')->select();
        myHidden($orders,['detail','end_point.id','end_point.nickname','end_point.real_name','end_point.mobile']);
        TimeOutService::orderTimeOut($orders);
        if (!$orders){
            throw new MissException();
        }
        return $orders;
    }

    public static function getDetail($id){
        $detail = self::with('endPoint')->where(['id' => $id])->select();
        if (!$detail){
            throw new MissException();
        }
        myHidden($detail,['end_point.id','end_point.nickname','end_point.real_name','end_point.mobile']);
        return $detail;
    }
    //删除订单
    public static function deleteOrder($id){
        $order = self::where(['id' => $id])->find();
        if (!$order){
            throw new MissException();
        }
        $result = $order->delete();
        if (!$result){
            return '删除失败';
        }
        else{
            return '删除成功';
        }
    }
    //修改订单接单人
    public static function setPacker($id,$uid){
        $order = self::with('endPoint')->where(['id' => $id])->select();
        if (!$order){
            throw new MissException();
        }
        $order['0']->save(['packer_id' => $uid]);
        myHidden($order,['user_id','packer_id','end_point.real_name']);
        return $order;
    }
}