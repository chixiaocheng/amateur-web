<?php
## 应用程序入口 ##
require_once '../common/config.php';
$module = (isset($_GET['app'])) ? $_GET['app'] : '';
//TODO 是否删除下列代码？
if (!is_dir($module)) {
    die("访问的应用程序{$module}不存在！");
}
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