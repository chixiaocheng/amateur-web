<?php
## 索引/全局入口 ##

/* 判断终端类型 (存在优先级) */
$client=null;
$plugin=null;
$path=null;
if (isset($_GET['mobile'])) {
    $client= 'mobile';
}else if (isset($_GET['desktop'])) {
    $client= 'desktop';
}else if(isset($_GET['wechat'])){
    $client= "wechat";
}
if (isset($_GET['app'])) {
    $path="/apps/{$_GET['app']}/template/{$client}/{$_GET['mod']}";
}else if (isset($_GET['applet'])){
    $path="/applets/{$_GET['applet']}/template/{$client}/{$_GET['mod']}";
}else{
    $path="/public/template/{$client}/{$_GET['mod']}";
}

echo $path;