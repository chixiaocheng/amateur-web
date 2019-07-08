<?php
// TODO
// 0.
$web->act['register'] = function () {
    global $web;
    $ikey=Web::get_GET('ikey');
    $web->data['sss']=123;
};
// 1.未注册 -> 手动授权 -> 返回ikey和资料


$web->act['register'] = function () {
    global $web;
    $ikey=Web::get_GET('ikey');
    $web->data['sss']=123;
};
// 2.已注册未登录 -> 自动授权 -> 返回ikey和资料
$web->act['default'] = function () {
    global $web;
    $web->data['sss']=123;
};
// 3.已注册已登录ikey正确 -> 资料
// 4.已注册已登录ikey错误 -> 自动授权 -> 返回ikey和资料  = 3->2->3
// 5.访问中ikey失效 -> 自动授权 -> 登录成功 -> 更新ikey和资料

/*
 * 小程序验证是否有ikey
 * 
 * 小程序获取手动授权
 * 服务端获得首次授权并新建账号
 * 小程序端接收账号信息
 * 小程序获取自动授权
 * 服务端验证自动授权返回账号信息
 * 小程序更新本地账号信息
 */
