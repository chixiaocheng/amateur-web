<?php
## 应用程序入口 ##
require_once '../config.php'; //运行时当前系统路径/apps/index.php
$module = (isset($_GET['id'])) ? $_GET['id'] : '';
$web = new Web($module); //实例化页面类

require_once "{$web->module}/{$web->model}.php";
$web->setPage();