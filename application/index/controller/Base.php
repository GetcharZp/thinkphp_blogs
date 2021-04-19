<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/6
 * Time: 20:00
 */

namespace app\index\controller;


use think\Controller;
use think\Db;

class Base extends Controller
{
    protected function _initialize()
    {
        $conf = Db::name('conf')->find(array('id' => 1));
        session('conf', $conf);
    }
}