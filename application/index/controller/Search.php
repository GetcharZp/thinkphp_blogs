<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/19
 * Time: 23:59
 */

namespace app\index\controller;


class Search extends Base
{
    public function index()
    {
        $kw = input('get.kw');
        $hosts = [
            'http://localhost:9200',
        ];
        $client = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
        $params = [
            'index' => 'blogs',
            'body' => [
                'query' => [
                    'match' => [
                        'content' => $kw
                    ]
                ],
                'highlight' => [
                    'fields' => [
                        'content' => new \stdClass(),
                    ],
                    "pre_tags" => "<em style='color: red'>",
                    "post_tags" => '</em>'
                ],
                'size' => 10, // size相当于mysql里面的limit，指定返回的最大数据个数
            ]
        ];
        $response = $client->search($params);
        $articles = $response['hits']['hits'];
        return $this->fetch('index', ['articles' => $articles]);
    }
}