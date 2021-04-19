<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/7
 * Time: 19:46
 */

namespace app\index\controller;


use think\Db;

class Person extends Base
{
    public function index()
    {
        if (request()->isPost()) {
            $name = input('post.name');
            $password = input('post.password');
            $data = session('user');
            $data['name'] = $name;
            $data['password'] = $password;
            Db::name('user')->where('id', session('user')['id'])->update($data);
            session('user', $data);
            return ["code" => 200, "msg" => "修改成功"];
        }
        $user = Db::name('user')->where('id', session('user')['id'])->find();
        return $this->fetch('index', array('user' => $user));
    }
}