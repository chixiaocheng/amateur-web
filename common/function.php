<?php
## 基本函数 ##

/**
 ** 获取GET值 **
 * @param string $key GET键名
 * @param string $default 为空补充值
 * @param string $warn 为空时终止并提示(内容)
 * @return mixed              (未终止)返回键值
 */
function get_def($key, $default = null, $warn = null) {
    $key = (isset($_GET[$key])) ? $_GET[$key] : $default;
    if ($warn and !$key) {
        die($warn);
    } else {
        return $key;
    }
}


/**
 ** 获取POST值 **
 * @param string $key POST键名
 * @param string $default 为空补充值
 * @param string $warn 为空时终止并提示(内容)
 * @return mixed              (未终止)返回键值
 */
function post_def($key, $default = null, $warn = null) {
    $key = (isset($_POST[$key])) ? $_POST[$key] : $default;
    if ($warn and !$key) {
        die($warn);
    } else {
        return $key;
    }
}

//TODO
function template($type, $path) {
    global $client;
    $extension=($client == 'wechat') ? 'json' : 'htm';
    if ($type == 'public') {
        return require_once "E:/PhpstormProjects/amateur-web/public/template/$client/$path.$extension";
    } elseif ($type == 'app') {
        return "";
    }
    return null;
}