<?php

namespace app;
class CountLine
{
    public $line = 0;

    function __construct($dir) {
        $this->c_opendir($dir);
    }

    function c_opendir($dir) {
        if ($_opendir = @opendir($dir)) {
            while ($a = readdir($_opendir)) {
                if ($a != '.' and $a != '..' and $a != '.idea' and $a != '.git' and is_dir($dir . '/' . $a)) {
                    $this->c_opendir($dir . '/' . $a);
                } else if (substr($a, -4) == '.php') {
                    $str = file_get_contents($dir . '/' . $a) . "\n";
                    $this->line += $this->count($str);
                }
            }
        }
    }

    function count($str) {
        $str = preg_replace_callback_array(['/\<\?php(\r|\n)+/' => function () {
            return "\n";
        }, '/\/\/(.*?\s*?.*?)(\r|\n)+/' => function () {
            return "\n";
        }, '/#(.*?\s*?.*?)(\r|\n)+/' => function () {
            return "\n";
        }, '/\/\*(.*?\s*?.*?)\*\//' => function () {
            return "\n";
        }, '/(\r|\n)(\r|\n)+/' => function () { //空行
            return "\n";
        }], $str);
        return substr_count($str, "\n");
    }
}

$dir = '../../../amateur-web'; //主目录
$count = new CountLine($dir);
echo $count->line;