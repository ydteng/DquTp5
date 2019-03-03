<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
    //Banner
    Route::get('api/v1/banner','api/v1.Banner/getBanner');
    Route::get('api/v1/province','api/v1.Address/getProvince');
    Route::get('api/v1/school/[:id]','api/v1.Address/getSchoolByProID');


    Route::post('api/v1/token/user','api/v1.Token/getToken');
    Route::post('api/v1/token/verify','api/v1.Token/verifyToken');

    Route::post('api/v1/address','api/v1.Address/createOrUpdateAddress');















    Route::get('api/v1/test/[:value]','api/v1.TimeTest/test');


