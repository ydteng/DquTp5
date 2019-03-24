<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/24
 * Time: 13:10
 */

namespace app\api\service;


class TimeOut
{
    /**
     * @最好不要把三个超时函数合并，分开更灵活。
     */
    //发单超过24小时无人接取，订单失败
    public static function orderTimeOut($orders){
        foreach ($orders as $key => $value) {
            $startTime = $orders[$key]->create_time;
            $endTime = date('Y-m-d H:i:s');
            $hour = floor((strtotime($endTime)-strtotime($startTime))/3600);
            $status = $orders[$key]->status;
            if($hour >= 24 && $status == 2000){
                $orders[$key]->status = 1000;
                $orders[$key]->save(['status' => 1000]);
            }
        }
    }
    //接单方确认订单，发单方未确定完成，24小时订单失效，订单状态码由4000变为5001
    public static function userTimeOut($orders){

    }

    //发单方确认订单，接单方未确定完成，24小时订单完成，订单状态码由4001变为5000
    public static function pickerTimeOut($orders){

    }
}