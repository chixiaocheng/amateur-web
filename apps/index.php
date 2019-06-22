<?php
## 应用程序入口 ##
require_once '../config.php'; //运行时当前系统路径/apps/index.php
$module = (isset($_GET['app'])) ? $_GET['app'] : '';
$web = new Web($module); //实例化页面类

if ($web->model == 'index') { //首页MODEL
    $web->setData([
        'test' => 'Hello world!',
        'array' => [
            'a' => 'a',
            'b' => 'b'
        ]
    ]);
} else { //其它MODEL
    require_once "{$web->module}/{$web->model}.php";
}
$web->setPage();