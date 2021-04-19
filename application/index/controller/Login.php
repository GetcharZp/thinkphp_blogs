<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/6
 * Time: 19:59
 */

namespace app\index\controller;


use think\Controller;
use think\Db;

class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $name = input('post.name');
            $password = input('post.password');
            $user = Db::name('user')->where(array('name' => $name, 'password' => $password))->find();
            if (empty($user)) {
                return array("code" => 60404, "msg" => "用户名或密码不正确");
            }
            session('user', $user);
            return array("code" => 200, "msg" => "登录成功");
        }
        return $this->fetch("index");
    }

    public function out()
    {
        session(null);
        return array('code' => 200, 'msg' => '退出登录成功');
    }
}