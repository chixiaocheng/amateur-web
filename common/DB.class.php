<?php


class DB extends mysqli
{
    function __construct() {
        parent::__construct($host = 'localhost', $username = 'amateur', $passwd = '1234567890', $dbname = 'amateur', $port = null, $socket = null);
        if ($this->connect_error) {
            die('数据库连接错误！');
        }
    }
}