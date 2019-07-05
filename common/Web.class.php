<?php


class Web
{
    public $data = [];
    public $model;
    public $module;
    public $tpl_type;
    public $act;

    /**
     * 调用已实例化的类
     * @return Web
     */
    static function this() {
        return newClass::single('Web');
    }

    function __construct($module) {
        $this->model = isset($_GET['m']) ? $_GET['m'] : 'index';
        if (!is_file($module . '/' . $this->model . '.php')) {
            die("访问的页面{$module}/{$this->model}不存在！");
        }
        $this->module = $module;
        $this->tpl_type = (isset($_GET['tt'])) ? $_GET['tt'] : Defaults::$tpl_type;
    }

    public function setData($newData) { //推送页面数据
        foreach ($newData as $f_key => $f_value) {
            $this->data[$f_key] = $f_value;
        }
    }

    public function setPage() { //建立页面并显示
        if (isset($_GET['act'])) {
            $this->act[$_GET['act']]();
        }
        $tplc_file = $this->module . '/template/' . $this->tpl_type . '/' . $this->model . '.tplc'; //已编译模板路径
        if (is_file($tplc_file)) {
            $tplc = null; //避免编辑器报错
            require_once $tplc_file;
            echo $tplc;
        } else {
            die("页面模板文件{$tplc_file}缺失！");
        }
    }

    public function setError($code, $msg = null) { //报错并终止运行
        $this->data['code'] = $code;
        $this->data['msg'] = $msg;
        $re_dir = ($this->module != 'public') ? '../' : '';
        $error_tplc = $re_dir . 'public/template/' . $this->tpl_type . '/error.tplc'; //已编译模板路径
        $tplc = null; //避免编辑器报错
        require_once $error_tplc;
        die($tplc);
    }

    public static function get_GET($key, $default = null) {
        //TODO 缺省报错机制
        return (isset($_GET[$key])) ? $_GET[$key] : $default;
    }

    public static function get_POST($key, $default = null) {
        return (isset($_POST[$key])) ? $_POST[$key] : $default;
    }

    public static function get_COOKIE($key, $default = null) {
        return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : $default;
    }
}