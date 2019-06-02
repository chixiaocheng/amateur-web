<?php
## 用户信息 ##
//TODO
include_once "../common/config.php";
$res = $db->query("SELECT nickname FROM user WHERE id=1");
$row = $res->fetch_assoc();
var_dump($row);

