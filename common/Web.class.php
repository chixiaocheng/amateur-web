<?php


class Web
{
    public $data = [];
    public $model;
    public $module;
    public $tpl_type;

    function __construct($module) {
        $this->model = isset($_GET['m']) ? $_GET['m'] : 'index';
        if (!is_file($module.'/'.$this->model.'.php')) {
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
        $tplc_file = $this->module . '/template/' . $this->tpl_type . '/' . $this->model . '.tplc'; //已编译模板路径
        if (is_file($tplc_file)) {
            $tplc = null; //避免编辑器报错
            require_once $tplc_file;
            echo $tplc;
        } else {
            die("页面模板文件{$tplc_file}缺失！");
        }
    }

    public function setError(){ //报错并终止运行
        //TODO 模板
        $error_tplc = 'public/template/' . $this->tpl_type . '/error.tplc'; //已编译模板路径
        $tplc = null; //避免编辑器报错
        require_once $error_tplc;
        die($tplc);
    }
}