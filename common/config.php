<?php
## 基本配置文件 ##

/* 数据库配置 */
include_once "db.php"; //数据库账号信息
$db = new mysqli($db_host, $db_username, $db_password);
