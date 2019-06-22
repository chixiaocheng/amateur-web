<?php


class DB extends mysqli
{
    public $table;
    public $where;
    public $limit;
    public $order;

    function __construct() {
        parent::__construct('localhost', 'amateur', '1234567890', 'amateur');
        if ($this->connect_error) {
            die('数据库连接错误！');
        }
    }

    /**
     * @param string $name 数据表名
     * @return DB
     */
    static function table($name) {
        $db = newClass::single('DB');
        $db->table = $name;
        return $db;
    }

    /**
     * @param string $condition 索引条件
     * @return DB
     */
    static function where($condition) {
        $db = newClass::single('DB');
        $db->where = $condition;
        return $db;
    }

    /**
     * @param int $num 限制数量
     * @return DB
     */
    static function limit($num) {
        $db = newClass::single('DB');
        $db->limit = $num;
        return $db;
    }

    /**
     * @param string $sort 排列方式
     * @return DB
     */
    static function order($sort) {
        $db = newClass::single('DB');
        $db->order = $sort;
        return $db;
    }


    /**
     * @param string $column 需要的键
     * @return array|null 返回一行数据
     */
    static function select($column) {
        $db = newClass::single('DB');
        $where = ($db->where) ? 'WHERE ' . $db->where : '';
        $order = ($db->order) ? 'ORDER ' . $db->order : '';
        $limit = ($db->limit) ? 'LIMIT ' . $db->limit : '';
        return $db->query("SELECT $column FROM {$db->table} $where $order $limit")->fetch_assoc();
    }

    /**
     * @param string $set 更新的内容
     * @return int 返回影响行数
     */
    static function update($set) {
        $db = newClass::single('DB');
        $where = ($db->where) ? 'WHERE ' . $db->where : '';
        $db->query("UPDATE {$db->table} SET $set $where");
        return $db->affected_rows;
    }

    /**
     * @param $key
     * @param $value
     * @return bool|int
     */
    static function insert($key, $value){
        $db = newClass::single('DB');
        if ($db->query("INSERT INTO {$db->table} ($key) VALUES ($value)")){
            return $db->insert_id;
        }
        return false;
    }

    /**
     * @param $where
     * @return int
     */
    static function delete($where){
        $db = newClass::single('DB');
        $db->query("DELETE FROM {$db->table} WHERE $where");
        return $db->affected_rows;
    }
}
