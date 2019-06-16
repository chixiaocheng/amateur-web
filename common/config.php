<?php
## 基本配置文件 ##

/** 类加载 **/
spl_autoload_register("newClass::autoload",); //注册类加载函数
class newClass
{
    //自动加载类函数
    static function autoload($className) {
        require_once "$className.class.php";
    }

    //单例加载
    static function only($className, $feature = '') { //避免构造函数重复执行等
        static $class_list = [];
        if (!array_key_exists($className . $feature, $class_list)) {
            $class_list[$className . $feature] = new $className;
        }
        return $class_list[$className . $feature];
    }
}

/** 初始化页面数据 **/
//error_reporting(0); //是否显示错误



/** 基本函数 **/
require_once "function.php";
