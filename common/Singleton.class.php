<?php


class Singleton
{
    protected static $instance;
    //防止在外部进行 实例化   new Single
    protected function __construct()
    {

    }

    public static function getInstance()
    {
        if(self::$instance instanceof self)
        {
            self::$instance =new self;
        }

        return self::$instance;
    }

    //防止被克隆  $b=clone $a
    protected function __clone()
    {

    }
}