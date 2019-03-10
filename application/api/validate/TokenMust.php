<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/9
 * Time: 20:40
 */

namespace app\api\validate;


class TokenMust extends BaseValidate
{
    protected $rule = [
        'token' => 'require|isNotEmpty'
    ];
}