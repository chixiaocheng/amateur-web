<?php

class Tpl
{
    function __construct() {
    }

    function getTypeNum($type) {
        $arr_type_num = [
            'desktop' => 0,
            'mobile' => 1,
            'wechat' => 2
        ];
        return $arr_type_num[$type];
    }

    function getTpl($type, $model) {
        DB::table('tpl');
        echo $type . $model;
    }

    /**
     * 模板实例化编译
     * 全部编译成单引号
     * @param string $tpl
     * @return string
     */
    public static function compile($tpl) {
        $tplc = '<?php $tplc=\'' . $tpl;
        //$tplc = str_replace(':', '\:', $tplc);
        $tplc = preg_replace_callback_array(['/<web if=(\'|\")([\s\S]*?)(\'|\")>([\s\S]*?)<\/web>/' => function ($e) { //编译if-else
            return "'.(('$e[2])?($e[4]):()).'";
        }, '//' => function ($e) { //编译foreach

        }, '/\{\{([\s\S]*?)\}\}/' => function ($e) { //编译data
            return "'.\$this->data['{$e[1]}'].'";
        }], $tplc);
        $tplc .= "'";
        echo $tplc;
        return $tplc;
    }


}