<?php
## 基本配置文件 ##

/**
 ** 数据库配置 **
 */
include_once "db.php"; //数据库账号信息
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($db->connect_error) {
    die('数据库连接错误！');
}


/**
 ** 默认配置 **
 */
$default_client = 'mobile'; //默认终端