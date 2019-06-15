<?php


class Index
{
    function __construct($door) {
        $this->door = $door;
        $this->mod = (isset($_GET['mod'])) ? $_GET['mod'] : 'index';
    }


    public $mod;
    public $door;
    public $path;
}