<?php
## 索引/全局入口 ##
include_once "common/config.php";


/**
 ** 获取访问路径并显示 **
 * $act 操作页面
 * $path 文件路径
 */
$act = (isset($_GET['act'])) ? $_GET['act'] : 'index';
if (isset($_GET['app'])) {
    $path = "apps/{$_GET['app']}/$act.php"; //应用
} else if (isset($_GET['applet'])) {
    $path = "applets/{$_GET['applet']}/$act.php"; //小应用
} else {
    $path = "public/$act.php"; //公共
}
if (is_file($path)){
    include_once($path);
}else{
    die('访问错误，文件不存在');
}