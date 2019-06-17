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

    //单例加载

    /**
     * @param $className string
     * @return object
     */
    public static function only($className) {
        static $class_list = [];
        if (!$class_list[$className]) {
            $class_list[$className] = new $className();
        }
        $_object = $class_list[$className];
        return $_object;
    }
}

/** 初始化页面数据 **/
//error_reporting(0); //是否显示错误

/** 基本函数 **/
require_once "function.php";
$a = newClass::only('DB');
echo $a->quer("");