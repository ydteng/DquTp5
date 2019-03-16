<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/2/26
 * Time: 21:02
 */

namespace app\api\controller\v1;


use app\api\model\BannerInfo;

class TimeTest
{
    public function test(){
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $timestamp = $strPol[rand(0,25)].date('Ymd',time()).'2'.rand(111111,999999);
        return $timestamp;
    }
}