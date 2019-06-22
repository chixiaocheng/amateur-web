<?php
## 公共程序入口 ##
require_once 'config.php'; //运行时当前系统路径(根目录)/index.php
$web = new Web('public'); //实例化页面类

if ($web->model == 'index') { //首页MODEL
    $web->setData([
        'test' => 'Hello world!',
        'array'=> [
            'a'=>'a',
            'b'=>'b'
        ]
    ]);
} else { //其它MODEL
    require_once "public/{$web->model}.php";
}
$web->setPage();