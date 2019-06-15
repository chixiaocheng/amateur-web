<?php
## 公共程序入口 ##
require_once 'common/config.php'; //运行时当前系统路径(根目录)/index.php

if (isset($_GET['mod'])) {
    $mod = $_GET['mod'];
    require_once "public/$mod.php";
} else {
    $web->setData([
        'test' => 'Hello world!'
    ]);
    echo $web->data['test'];
}

$web->setPage();