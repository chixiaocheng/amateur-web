<?php


class Web
{
    public $data = [];
    public $model;
    public $module;
    public $tpl_type;

    function __construct($module) {
        $this->model = isset($_GET['m']) ? $_GET['m'] : 'index';
        $this->module = $module;
        $this->tpl_type = (isset($_GET['tt'])) ? $_GET['tt'] : Defaults::$tpl_type;
    }

    public function setData($newData) { //推送页面数据
        foreach ($newData as $f_key => $f_value) {
            $this->data[$f_key] = $f_value;
        }
    }

    public function setPage() {
        $path = $this->module . '/template/' . $this->tpl_type . '/' . $this->model . '.tplc'; //已编译模板路径
        if (is_file($path)) {
            $tplc = null; //方便编辑器识别
            require_once $path;
            echo $tplc;
        } else {
            die("页面模板文件{$path}缺失！");
        }
    }
}