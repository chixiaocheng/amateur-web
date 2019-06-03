<?php
## 基本配置文件 ##

/**
 ** 数据库配置 **
 */
require_once "db.php"; //数据库账号信息
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($db->connect_error) {
    die('数据库连接错误！');
}


/** 默认配置 **/
require_once "default.php";


/** 基本函数 **/
require_once "function.php";


/** 获取用户信息 **/
require_once "get_user.php";