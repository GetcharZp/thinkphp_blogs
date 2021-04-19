<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/18
 * Time: 15:42
 */

namespace app\index\controller;


use think\Db;

class Article extends Base
{
    private $client;
    public function _initialize()
    {
        $hosts = [
            'http://localhost:9200',
        ];
        $this->client = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function index()
    {
        $articles = Db::name('article')
            ->field('id, title, num, create_time')
            ->whereNull('delete_time')
            ->order('update_time DESC')
            ->paginate(20);
        $cates = Db::name('cate')->select();
        return $this->fetch('index', ['articles' => $articles, 'cates' => $cates]);
    }

    public function add()
    {
        $title = input('post.title');
        $cid = input('post.cid');
        $text = input('post.text');
        $content = input('post.content');

        // 保存到MySQL中
        Db::name('article')->insert([
            'uid' => session('user')['id'],
            'cid' => $cid,
            'title' => $title,
            'description' => mb_substr($text, 0, 100),
            'content' => $content,
            'create_time' => time(),
            'update_time' => time(),
        ]);
        $id = Db::name('article')->getLastInsID();
        // 将$text的内容保存到ES中
        $params = [
            'index' => 'blogs',
            'id' => $id,
            'body' => [
                'title' => $title,
                'content' => $text
            ]
        ];
        $this->client->create($params);
        return json(['code' => 200, 'msg' => '文章新增成功']);
    }

    public function delete()
    {
        $id = input('get.id');
        // Mysql 数据软删除
        Db::name('article')->where('id', $id)->update([
            'update_time' => time(),
            'delete_time' => time(),
        ]);
        // ES 数据删除
        $params = [
            'index' => 'blogs',
            'id' => $id,
        ];
        $this->client->delete($params);
        return json(['code' => 200, 'msg' => '删除成功']);
    }

    public function detail()
    {
        $id = input('get.id');
        $article = Db::name('article')->where('id', $id)->find();
        return json(['code' => 200, 'msg' => '数据获取成功', 'article' => $article]);
    }

    public function edit()
    {
        $id = input('post.id');
        $title = input('post.title');
        $cid = input('post.cid');
        $text = input('post.text');
        $content = input('post.content');

        // 保存到MySQL中
        Db::name('article')->where('id', $id)->update([
            'uid' => session('user')['id'],
            'cid' => $cid,
            'title' => $title,
            'description' => mb_substr($text, 0, 100),
            'content' => $content,
            'update_time' => time(),
        ]);
        // 将$text的内容保存到ES中
        $params = [
            'index' => 'blogs',
            'id' => $id,
            'body' => [
                'doc' => [
                    'title' => $title,
                    'content' => $text
                ]
            ]
        ];
        $this->client->update($params);
        return json(['code' => 200, 'msg' => '文章编辑成功']);
    }
}