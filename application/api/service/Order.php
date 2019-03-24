<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/11
 * Time: 10:30
 */

namespace app\api\service;
use app\api\model\Order as OrderModel;
use app\lib\exception\confirmException;
use think\Exception;

class Order
{
    public static function makeOrderNum(){
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $timestamp = $strPol[rand(0,25)].date('Ymd',time()).'2'.rand(11111111,99999999);
        return $timestamp;
    }

    public static function changStatus($id,$uid){
        /*
         * 改变流程
         * 首先获取订单的接单人id和发单人id
         * 1.如果用户uid和发单人id相同，则在判断接单人是否已经确认订单，如果接单人未确认（即状态码为3000），则改变为4001（发单方确认），
         * 否则改变为完成状态6000
         * 2.如果用户uid和接单人id相同，则在判断发单人是否已经确认订单，如果发单人未确认（即状态码为3000），则改变为4000（接单方确认），
         * 否则改变为完成状态6000
         *
         * */
        $msg = '确认成功';
        $order = OrderModel::get($id);
        $status = $order->status;
        $receiverID = OrderModel::getReceiverByOrderID($id);
        $packerID = OrderModel::getPackerByOrderID($id);
        if ($status == 6000){
            throw new confirmException();
        }
        if ($uid == $receiverID){
            if ($status == 4000){
                $order->save(['status' => 6000]);
                return $msg;
            }
            else{
                $order->save(['status' => 4001]);
                return $msg;
            }
        }
        else if ($uid == $packerID){
            if ($status == 4001){
                $order->save(['status' => 6000]);
                return $msg;
            }else{
                $order->save(['status' => 4000]);
                return $msg;
            }
        }
        else{
            throw new Exception('未知错误，发生于uid与receiverID、packerID比较时');
        }
    }
}