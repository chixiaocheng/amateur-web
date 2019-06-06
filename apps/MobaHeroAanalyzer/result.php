<?php

/** 数据库配置 **/
require_once "../../common/db.php"; //数据库账号信息
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($db->connect_error) {
    die('数据库连接错误！');
}

/** 查询结果 **/
$res = $db->query("SELECT id,name,score FROM moba_hero_analyzer_position ORDER BY score");
if ($res->num_rows) {
    while ($row = $res->fetch_assoc()) {
        $data[$row['id']] = $row;
        unset($data[$row['id']]['id']);
    }
}

/** 新增数据 **/