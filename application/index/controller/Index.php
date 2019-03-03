<?php

namespace app\index\controller;


use think\Log;

class Index extends \think\Controller
{
    public function index()
    {
        $url = 'http://dqu.com';
        $this->assign('url',$url);
        return view('index');
    }
}
