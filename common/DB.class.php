<?php


class DB extends mysqli
{
    public $table;
    public $mWhere;
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
    public function where($condition) {
        $this->mWhere = $condition;
        return $this;
    }

    /**
     * @param int $num 限制数量
     * @return DB
     */
    public function limit($num) {
        $this->limit = $num;
        return $this;
    }

    /**
     * @param string $sort 排列方式
     * @return DB
     */
    public function order($sort) {
        $this->order = $sort;
        return $this;
    }

    /**
     * @param string $column 需要的键
     * @return array|null 返回一行数据
     */
    public function select($column) {
        $where = ($this->mWhere) ? 'WHERE ' . $this->mWhere : '';
        $order = ($this->order) ? 'ORDER ' . $this->order : '';
        $limit = ($this->limit) ? 'LIMIT ' . $this->limit : '';
        return $this->query("SELECT $column FROM {$this->table} $where $order $limit")->fetch_assoc();
    }

    /**
     * @param string $set 更新的内容
     * @return int 返回影响行数
     */
    public function update($set) {
        $where = ($this->mWhere) ? 'WHERE ' . $this->mWhere : '';
        $this->query("UPDATE {$this->table} SET $set $where");
        return $this->affected_rows;
    }

    /**
     * @param string $key 键名
     * @param string $value 键值
     * @return bool|int
     */
    public function insert($key, $value){
        if ($this->query("INSERT INTO {$this->table} ($key) VALUES ($value)")){
            return $this->insert_id;
        }
        return false;
    }

    /**
     * @param $where
     * @return int
     */
    public function delete($where){
        $this->query("DELETE FROM {$this->table} WHERE $where");
        return $this->affected_rows;
    }
}
