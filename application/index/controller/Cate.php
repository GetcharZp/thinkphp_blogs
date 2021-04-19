<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/17
 * Time: 14:30
 */

namespace app\index\controller;


use think\Db;

class Cate extends Base
{
    private $name;
    private function has()
    {
        $cate = Db::name('cate')->where('name', $this->name)->find();
        if (!empty($cate)) {
            return true;
        }
        return false;
    }

    public function index()
    {
        $cates = Db::name('cate')->where('delete_time', 'null')->order('update_time DESC')->paginate(20);
        return $this->fetch('index', ['cates' => $cates]);
    }

    public function add()
    {
        $name = input('post.name');
        $this->name = $name;
        if (!$this->has()) {
            Db::name('cate')->insert(array(
                'name' => $name,
                'create_time' => time(),
                'update_time' => time(),
            ));
            return json(['code' => 200, 'msg' => '分类新增成功']);
        }
        return json(['code' => 60405, 'msg' => '分类名已存在']);
    }

    public function delete()
    {
        $id = input('get.id');
        $cate = Db::name('cate')->field('num')->where('id', $id)->find();
        if ($cate['num'] > 0) {
            return json(['code' => 60403, 'msg' => '该分类已被使用']);
        }
        Db::name('cate')->where('id', $id)->update([
            'delete_time' => time(),
            'update_time' => time(),
        ]);
        return json(['code' => 200, 'msg' => '删除成功']);
    }

    public function edit()
    {
        $id = input('post.id');
        $name = input('post.name');
        $this->name = $name;
        if (!$this->has()) {
            Db::name('cate')->where('id', $id)->update(array(
                'name' => $name,
                'update_time' => time(),
            ));
            return json(['code' => 200, 'msg' => '分类编辑成功']);
        }
        return json(['code' => 60405, 'msg' => '分类名已存在']);
    }
}