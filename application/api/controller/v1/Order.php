<?php
/**
 * Created by PhpStorm.
 * User: TenYoDun
 * Date: 2019/3/5
 * Time: 16:18
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\model\User as UserModel;
use app\api\model\Order as OrderModel;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\validate\PagingParameter;
use app\lib\exception\UserException;

class Order
{
    public function PlaceOrder()
    {
        $validate = new OrderPlace();
        $validate->goCheck();
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user){
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));

        $dataArray['end_point_id'] = $uid;
        $dataArray['order_num'] = OrderService::makeOrderNum();

        $user->order()->save($dataArray);
        return json(['order_num' => $dataArray['order_num']],201);
    }
    public function getUserOrder()
    {
        (new PagingParameter())->goCheck();
        $page = request()->param('page');
        $uid = TokenService::getCurrentUid();

        $orders = OrderModel::getUserOrder($page,$uid);
        if (!$orders){
            throw new MissException();
        }
        return $orders;
    }

    public function getAllOrder()
    {
        (new PagingParameter())->goCheck();
        //为了让require验证规则起作用，所以没有在函数里面传至，要不tp5会I先检测有没有传值，报id参数错误的错
        $page = request()->param('page');
        $uid = TokenService::getCurrentUid();
        if (!$uid){
            throw new UserException();
        }
        $orders = OrderModel::getAllOrders($page);
        return $orders;


    }

    public function getOrderDetail(){
        (new PagingParameter())->goCheck();
        //为了让require验证规则起作用，所以没有在函数里面传至，要不tp5会I先检测有没有传值，报id参数错误的错
        $id = request()->param('page');
        $uid = TokenService::getCurrentUid();

    }
}