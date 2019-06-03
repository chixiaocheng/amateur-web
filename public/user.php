<?php
## 用户信息 ##
//TODO 先完成这个
include_once "../common/config.php";
$res = $db->query("SELECT nickname FROM user WHERE uid=1");
$row = $res->fetch_assoc();
var_dump($row);

