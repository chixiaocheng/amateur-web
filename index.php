<?php
## 索引/全局入口 ##

/* 判断终端类型 (存在优先级) */
if (isset($_GET['mobile'])) {
    echo 'mobile';
}else if (isset($_GET['desktop'])) {
    echo 'desktop';
}else if(isset($_GET['wechat'])){
    echo "wechat";
}else{
    echo "wrong";
}