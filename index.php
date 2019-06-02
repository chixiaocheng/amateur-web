<?php
## 索引/全局入口 ##
include_once "common/config.php";

/**
 ** 判断终端类型 (存在优先级) **
 * $client 终端类型
 */
if (isset($_GET['mobile'])) {
    $client = 'mobile'; //移动版
} else if (isset($_GET['desktop'])) {
    $client = 'desktop'; //桌面版
} else if (isset($_GET['wechat'])) {
    $client = 'wechat'; //微信小程序版
} else {
    $client = $default_client; //默认终端
}


/**
 ** 判断访问路径 **
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