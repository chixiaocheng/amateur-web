<?php


class Web
{
    static function getSelf() {
        $self = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1); //去头
        $self = substr($self, 0, -4); //去头
        return $self;
    }

    static function getTpl() {
        return (isset($_GET['tpl'])) ? $_GET['tpl'] : 'desktop';
    }

    public function setData($newData) {
        foreach ($newData as $f_key => $f_value) {
            $this->data[$f_key] = $f_value;
        }
    }

    public function setPage() {
        $path = 'public/template/' . Web::getTpl() . '/' . Web::getSelf() . '.tpl';
        $tpl = file_get_contents($path);
        function getData($value) {
            global $web;
            return $web->data[$value[1]];
        }
        function getDataIf($value) {
            if ($value[1]=='true' or $value[1]=='1'){
                return $value[2];
            }
            return null;
        }

        $page = preg_replace_callback('/\{\{(.*)\}\}/', "getData", $tpl);
        $page = preg_replace_callback('/<web\sif=\'(.*)\'>(.*\s*.*)<\/web>/', "getDataIf", $page);
        echo $page;
    }

    public $data = [];
}