<?php


class User
{
    public $info=[
        'uid'=>0,
        'nickname'=>'游客'
    ];

    function __construct() {
        if (isset($_REQUEST['ikey'])) {
            $ikey = $_REQUEST['ikey'];
            $db = new DB();
            $res = $db->query("SELECT uid,nickname FROM user WHERE ikey='$ikey'");
            if ($res->num_rows) {
                $this->info = $res->fetch_assoc();
            }
        }
    }

}