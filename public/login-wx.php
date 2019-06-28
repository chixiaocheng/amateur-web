<?php
$web->data = $_GET;
// TODO
// 1.未注册 -> 手动授权 -> 返回ikey和资料
$web->act['register'] = function () {
    global $web;

};
// 2.已注册未登录 -> 自动授权 -> 返回ikey和资料
// 3.已注册已登录ikey正确 -> 资料
// 4.已注册已登录ikey错误 -> 自动授权 -> 返回ikey和资料
// 5.访问中ikey失效 -> 自动授权 -> 登录成功 -> 更新ikey和资料
