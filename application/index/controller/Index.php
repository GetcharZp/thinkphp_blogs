<?php
namespace app\index\controller;


use think\Db;

class Index extends Base
{
    public function index()
    {
        $articles = Db::name('article')
            ->field('id, title, description')
            ->whereNull('delete_time')
            ->order('update_time DESC')
            ->paginate(10);
        return $this->fetch('index', ['articles' => $articles]);
    }

    public function detail()
    {
        $id = input('get.id');
        Db::name('article')->where('id', $id)->setInc('num');
        $article = Db::name('article')->where('id', $id)->find();
        return $this->fetch('detail', ['article' => $article]);
    }
}
