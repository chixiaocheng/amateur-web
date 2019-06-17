<?php
## 基本配置文件 ##

/** 类加载 **/
spl_autoload_register("newClass::autoload"); //注册类加载函数
class newClass
{
    //自动加载类函数
    static function autoload($className) {
        require_once "$className.class.php";
    }

    /**
     * //单例加载
     * @return DB|Web
     */
    public static function single($className) {
        static $class_list = [];
        if (!$class_list[$className]) {
            $class_list[$className] = new $className;
        }
        return $class_list[$className];
    }
}

/** 初始化页面数据 **/
//error_reporting(0); //是否显示错误

/** 基本函数 **/
require_once "function.php";