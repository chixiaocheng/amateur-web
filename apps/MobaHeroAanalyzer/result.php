<?php

/** 数据库配置 **/
require_once "../../common/db.php"; //数据库账号信息
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($db->connect_error) {
    die('数据库连接错误！');
}

/** 新增数据 **/
if (isset($_GET['act']) and $_GET['act'] == 'add') {
    $hero_name = $_GET['hero'];
    $position_name = $_GET['position'];
    $mark = $_GET['mark'];
    $season = 13;
    $res_position = $db->query("SELECT id FROM moba_hero_analyzer_position WHERE name='$position_name'");
    $row_position = $res_position->fetch_assoc();
    $position = $row_position['id'];
    $res_hero = $db->query("SELECT id FROM moba_hero_analyzer_hero WHERE name='$hero_name' AND position=$position");
    if ($res_hero->num_rows) {
        $row_hero = $res_hero->fetch_assoc();
        $hero = $row_hero['id'];
    } else {
        if ($db->query("INSERT INTO moba_hero_analyzer_hero (name, position, score, max_score, min_score) VALUES ('$hero_name',$position,$mark,$mark,$mark)")) {
            $hero = mysqli_insert_id($db);
        }
    }


    //添加一条record
    $db->query("INSERT INTO moba_hero_analyzer_record (hero, position, mark, season) VALUES ($hero,$position,$mark,$season)");
    //$record = mysqli_insert_id($db);

    //更新英雄分数（去掉最大、最小值）
    $res_record = $db->query("SELECT id,mark FROM moba_hero_analyzer_record WHERE hero=$hero");
    $num = $res_record->num_rows;
    $total_score = 0;
    while ($row_record = $res_record->fetch_assoc()) {
        $total_score += $row_record['mark'];
    }
    if ($num != 1) {
        $res_update_hero = $db->query("SELECT score,max_score,min_score FROM moba_hero_analyzer_hero WHERE id=$hero");
        $row_update_hero = $res_update_hero->fetch_assoc();
        $max_score = $row_update_hero['max_score'];
        $min_score = $row_update_hero['min_score'];
        if ($mark > $max_score) {
            $max_score = $mark;
            $db->query("UPDATE moba_hero_analyzer_hero SET max_score=$mark WHERE id=$hero");
        } elseif ($mark < $min_score) {
            $min_score = $mark;
            $db->query("UPDATE moba_hero_analyzer_hero SET min_score=$mark WHERE id=$hero");
        }
        $new_score = ($num == 2) ? $max_score + 1.5 : ($total_score - $max_score - $min_score) / ($num - 2);
        $db->query("UPDATE moba_hero_analyzer_hero SET score=$new_score WHERE id=$hero");
    } else {
        $mark_score = $mark + 3;
        $db->query("UPDATE moba_hero_analyzer_hero SET score=$mark_score WHERE id=$hero");
    }


    //更新战位分数
    $res_get_hero = $db->query("SELECT score FROM moba_hero_analyzer_hero WHERE position=$position");
    $hero_num = $res_get_hero->num_rows;
    $total_position_score = 0;
    while ($row_get_hero = $res_get_hero->fetch_assoc()) {
        $total_position_score += $row_get_hero['score'];
    }
    $new_position_score = $total_position_score / $hero_num;
    $db->query("UPDATE moba_hero_analyzer_position SET score=$new_position_score WHERE id=$position");
}


/** 查询结果 **/
$data = [];
$res = $db->query("SELECT id,name,score FROM moba_hero_analyzer_position ORDER BY score DESC");
if ($res->num_rows) {
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $data[$i]['p_name'] = $row['name'];
        $data[$i]['p_score'] = $row['score'];
        $res_hero_adv = $db->query("SELECT id,name,score,max_score,min_score FROM moba_hero_analyzer_hero WHERE position={$row['id']} AND score>=0.95*{$row['score']} ORDER BY score DESC");
        if ($res_hero_adv->num_rows) {
            $j = 1;
            while ($row_hero_adv = $res_hero_adv->fetch_assoc()) {
                $data[$i]['hero_adv'][$j]['h_name'] = $row_hero_adv['name'];
                $data[$i]['hero_adv'][$j]['h_score'] = $row_hero_adv['score'];
                $res_hero_adv_num = $db->query("SELECT id FROM moba_hero_analyzer_record WHERE hero={$row_hero_adv['id']}");
                $data[$i]['hero_adv'][$j]['h_num'] = $res_hero_adv_num->num_rows;
                $j++;
            }
        }
        $res_hero_ban = $db->query("SELECT id,name,score,max_score,min_score FROM moba_hero_analyzer_hero WHERE position={$row['id']} AND score<0.95*{$row['score']} ORDER BY score");
        if ($res_hero_ban->num_rows) {
            $j = 1;
            while ($row_hero_ban = $res_hero_ban->fetch_assoc()) {
                $data[$i]['hero_ban'][$j]['h_name'] = $row_hero_ban['name'];
                $data[$i]['hero_ban'][$j]['h_score'] = $row_hero_ban['score'];
                $res_hero_ban_num = $db->query("SELECT id FROM moba_hero_analyzer_record WHERE hero={$row_hero_ban['id']}");
                $data[$i]['hero_ban'][$j]['h_num'] = $res_hero_ban_num->num_rows;
                $j++;
            }
        }
        $i++;
    }
}


/**
 * 显示*/
foreach ($data as $data_key => $data_value) {
    $data_value['p_score']=round($data_value['p_score'], 1);
    echo "<u>{$data_key}【{$data_value['p_name']}】{$data_value['p_score']}分</u><br><b>推荐：";
    if (isset($data_value['hero_adv'])) {
        $i=0;
        foreach ($data_value['hero_adv'] as $adv_hero) {
            $adv_hero['h_score']=round($adv_hero['h_score']);
            echo ($i++)?'、':'';
            echo "{$adv_hero['h_name']}{$adv_hero['h_score']}分 ({$adv_hero['h_num']}次)";
        }
    }
    echo "</b><br>禁用：";
    if (isset($data_value['hero_ban'])) {
        $i=0;
        foreach ($data_value['hero_ban'] as $ban_hero) {
            $ban_hero['h_score']=round($ban_hero['h_score']);
            echo ($i++)?'、':'';
            echo "{$ban_hero['h_name']}{$ban_hero['h_score']}分 ({$ban_hero['h_num']}次)";
        }
    }
    echo "<br><br>";
}
