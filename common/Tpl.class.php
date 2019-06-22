<?php

//TODO
//增
//删
//改
//查
class Tpl
{
    function __construct() {
    }

    private function getTypeNum($type) {
        $arr_type_num = [
            'desktop' => 0,
            'mobile' => 1,
            'wechat' => 2
        ];
        return $arr_type_num[$type];
    }

    function getTpl($type, $model) {
        $type_num = $this->getTypeNum($type);
        $res = $this->query("SELECT * FROM tpl WHERE type=$type_num AND model='$model' ");
        if ($res->num_rows) {
            var_dump($res->fetch_assoc());
        }
    }
}