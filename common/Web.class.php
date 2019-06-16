<?php


class Web
{
    function __construct() {
        $this->model = isset($_GET['m']) ? $_GET['m'] : 'index';
        $this->tpl_type = (isset($_GET['tt'])) ? $_GET['tt'] : 'desktop';
    }

    static function getSelf() { //获取当前文件名（不带拓展名）
        $self = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1); //去头
        $self = substr($self, 0, -4); //去尾
        return $self;
    }

    public function getRawTpl() { //获取未编译模板
        $path = 'public/template/' . $this->tpl_type . '/' . Web::getSelf() . '.eg.tpl';
        return file_get_contents($path);
    }

    public function setData($newData) { //推送页面数据
        foreach ($newData as $f_key => $f_value) {
            $this->data[$f_key] = $f_value;
        }
    }

    public function setPage() {
        $tpl = Web::getTpl();
        function getData($value) {
            global $web;
            return $web->data[$value[1]];
        }

        function getDataIf($value) {
            if ($value[1] == 'true' or $value[1] == '1') {
                return $value[2];
            }
            return null;
        }

        $page = preg_replace_callback('/\{\{(.*)\}\}/', "getData", $tpl);
        $page = preg_replace_callback('/<web\sif=\'(.*)\'>(.*\s*.*)<\/web>/', "getDataIf", $page);
        echo $page;
    }

    public $data = [];
    public $model;
    public $tpl_type;
}