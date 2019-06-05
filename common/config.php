<?php
## 基本配置文件 ##

//TODO
class newClass
{
    function M($class_name, $unique = '') {
        static $class_list = [];
        if (!$class_list[$class_name . $unique]) {
            $class_list[$class_name . $unique] = new $class_name;
        }
        return $class_list[$class_name.$unique];
    }
}


/** 数据库配置 **/
require_once "db.php"; //数据库账号信息
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($db->connect_error) {
    die('数据库连接错误！');
}


/** 默认配置 **/
require_once "default.php";


/** 基本函数 **/
require_once "function.php";


/**
 ** 判断终端类型 (存在优先级) **
 * $client 终端类型
 */
$client = $default_client; //默认终端
if (isset($_GET['mobile'])) {
    $client = 'mobile'; //移动版
} else if (isset($_GET['desktop'])) {
    $client = 'desktop'; //桌面版
} else if (isset($_GET['wechat'])) {
    $client = 'wechat'; //微信小程序版
}


/** 获取用户信息 **/
require_once "ikey_check.php";