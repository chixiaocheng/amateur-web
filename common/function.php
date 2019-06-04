<?php
## 基本函数 ##

/**
 ** 获取GET值 **
 * $key 键名
 * $default 为空补充值
 * $warn 为空时终止并提示(内容)
 * return (未终止)返回键值
 */
function get_def($key, $default = null, $warn = null) {
    $key = (isset($_GET[$key])) ? $_GET[$key] : $default;
    if ($warn and !$key) {
        die($warn);
    }else{
        return $key;
    }
}


/**
 ** 获取POST值 **
 * $key 键名
 * $default 为空补充值
 * $warn 为空时终止并提示(内容)
 * return (未终止)返回键值
 */
function post_def($key, $default = null, $warn = null) {
    $key = (isset($_POST[$key])) ? $_POST[$key] : $default;
    if ($warn and !$key) {
        die($warn);
    }else{
        return $key;
    }
}