<?php
## 获取用户信息 ##

$ikey = def_get('ikey');
$res = $db->query("SELECT uid FROM user WHERE ikey=$ikey");
if ($res->num_rows) {
    $row=$res->fetch_assoc();
    $uid=$row['uid'];
}else{
    die('登录信息有误');
}