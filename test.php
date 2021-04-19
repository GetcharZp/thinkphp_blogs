<?php

require_once 'vendor/autoload.php';

$hosts = [
    'http://localhost:9200',
];
$client = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();

// 高亮搜索Demo
$params = [
    'index' => 'blogs',
    'body' => [
        'query' => [
            'match' => [
                'content' => '函数'
            ]
        ],
        'highlight' => [
            'fields' => [
                'content'=> new \stdClass(),
            ]
        ],
        'size' => 2, // size相当于mysql里面的limit，指定返回的最大数据个数
    ]
];
$response = $client->search($params);
print_r($response);


// 数据新增
//$params = [
//    'index' => 'blogs',
//    'id' => 3,
//    'body' => [
//        'content' => '新增测试'
//    ]
//];
//$response = $client->create($params);
//print_r($response);


// 数据更新
//$params = [
//    'index' => 'blogs',
//    'id' => 3,
//    'body' => [
//        'doc' => [
//            'content' => 'elasticSearch-PHP 更新 3'
//        ]
//    ]
//];
//$response = $client->update($params);
//print_r($response);


// 文档删除
//$param = [
//    'index' => 'blogs',
//    'id' => 3,
//];
//$response = $client->delete($param);
//print_r($response);


// 根据ID获取文档内容
//$params = [
//    'index' => 'blogs',
//    'id'    => 1
//];
//
//$response = $client->get($params);
//print_r($response);


