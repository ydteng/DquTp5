<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/11
 * Time: 10:30
 */

namespace app\api\service;


class Order
{
    public static function makeOrderNum(){
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $timestamp = $strPol[rand(0,25)].date('Ymd',time()).'2'.rand(11111111,99999999);
        return $timestamp;
    }
}