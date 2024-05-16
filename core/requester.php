<?php
class requester {
    private $table;
    public $sql;
    public $params;

    public function __construct($t) {
        $this->table = $t;
    }
    private function primaryKey() {
        $this->sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$this->table."' AND COLUMN_KEY = 'PRI'";
        return $this;
    }

    public function select($fields = "*") {
        if(is_array($fields)) {
            $this->sql .= "SELECT ";
            foreach($fields as $v)
            {
                $this->sql .= $v.', ';
            }
            $this->sql = substr($this->sql, 0, -2);
        } else {
            $this->sql = "SELECT ".$fields;
        }

        return $this;
    }

    public function from($table = "") {
        if($table != "") {
            $this->table = $table;
        }
        $this->sql .= " FROM ";
        if(is_array($table)) {
            foreach($table as $t)
            {
                $this->sql .= $t.', ';
            }
            $this->sql = substr($this->sql, 0, -2);
        } else {
            $this->sql .= $this->table;
        }

        return $this;
    }
    public function where($cond) {
        $this->sql .= " WHERE ";
        if(is_array($cond)) {
            foreach($cond as $k => $v)
            {
                $this->sql .= $k.' = :'.$k.' AND ';
            }
            $this->sql = substr($this->sql, 0, -4);
        } else {
            $this->sql .= $cond;
        }
        $this->params = $cond;
        return $this;
    }

    public function ijoin() {
        
    }

    public function insert($data) {
        $this->sql = "INSERT INTO ".$this->table." (";
        $this->params = $data;
        $values = "";
        foreach($data as $k => $v) {
            $this->sql .= $k.', ';
            $values .= ':'.$k.', ';
        }
        $this->sql = substr($this->sql, 0, -2).") VALUES (".substr($values, 0, -2).")";

        return $this;
    }

    public function update() {
        $thos->sql = "UPDATE ".$this->table." SET ";
        $this->params = $data;
        foreach($data as $k => $v) {
            $this->sql .= $k.' = '.$v.', ';
        }
        $this->sql = substr($this->sql, 0, -2);

        return $this;
    }

    public function delete() {
        $this->sql = "DELETE ";
        
        return $this;
    }
}