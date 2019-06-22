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

    }
}