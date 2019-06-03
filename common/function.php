<?php
## 基本函数 ##

//TODO
function def_get($key, $default=null) {
    return (isset($_GET[$key])) ? $_GET[$key] : $default;
}