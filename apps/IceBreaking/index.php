<?php
## 破冰活动 ##
require_once "../../config.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
function set_html($title, $body) {
    echo <<<DDDX
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
        <title>2018级土木工程系-真心话大爆炸</title>
        <link rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/2.0.0/css/frozen.css"/>
    </head>
    <body ontouchstart>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1>{$title}</h1>
    </header>
    <section class="ui-container">{$body}</section>
    </body>
</html>

DDDX;
}


if (isset($_COOKIE['ikey']) or $act=='login') {
    if ($act=='login'){
        if (isset($_POST['name']) and isset($_POST['password'])){
            $name=$_POST['name'];
            $password=$_POST['password'];
            $ikey=DB::table('ice_breaking')->where("name='$name' and password='$password'")->select('ikey');
            if ($ikey){
                echo $ikey;
            }
        }else{
            $url=urlencode("http://amateur.web/apps/IceBreaking/index.php?tips=姓名或密码不存在");
            header("Location: $url");
            exit();
        }
        $title = 's';
        $body=<<<DDDX
DDDX;
        set_html($title, $body);
    }else{
        $ikey = $_COOKIE['ikey'];
    }
} else {
    $title = '登录账号';
    $tips=isset($_GET['tips'])?$_GET['tips']:'若无法登录请联系管理员！';
    $body = <<<DDDX
<div class="demo-item">
<div class="ui-tooltips-cnt ui-border-b">
                    <i></i>若无法登录请联系管理员！</a>
                </div>
        <div class="demo-block">
            <div class="ui-form ui-border-t">
                <form action="?act=login" method="post">
                <input name="act" value="login" style="display: none;">
                    <div class="ui-form-item ui-border-b">
                        <label>
                            姓名
                        </label>
                        <input name="name" type="text" placeholder="以分班数据表为准">
                    </div>
                    <div class="ui-form-item ui-border-b">
                        <label>
                            密码
                        </label>
                        <input name="password" type="password" placeholder="初始密码为123456">
                    </div>
                    <div class="ui-btn-wrap">
                        <button class="ui-btn-lg ui-btn-primary">
                            进入活动主页
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
DDDX;
    set_html($title, $body);
}
