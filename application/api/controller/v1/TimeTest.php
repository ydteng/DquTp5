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

        $temp = BannerInfo::with('img')->select();
        return json($temp);
    }
}