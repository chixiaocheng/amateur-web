<?php
## 确认并获取用户信息 ##

//TODO
$wrong=1; //ikey不存在
$ikey = get_def('ikey', 0);
$res = $db->query("SELECT uid FROM user WHERE ikey=$ikey");
if ($res->num_rows) {
    $row = $res->fetch_assoc();
    $uid = $row['uid'];
} else {
    echo "";
}