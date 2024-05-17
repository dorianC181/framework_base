<?php

class Requester {
    private $sql;
    private $table; 
    private $fields;
    private $params = [];
    private $relations = [];

    public function __construct($t, $f) {
        $this->table = $t;
        $this->fields = $f;
    }

    public function select($fields = "*") {
        $this->sql = "SELECT ";

        if(is_array($fields)) {
            foreach($fields as $v) {
                $this->sql .= $v.', ';
            }
            $this->sql = substr($this->sql, 0, -2);
        } else {
            $this->sql .= $fields;
        }        

        return $this;
    }

    public function from($table = "") {
        $this->sql .= " FROM ";

        if($table != "") {
            $this->table = $table;
        }

        if(is_array($table)) {
            foreach($table as $t) {
                $this->sql .= $t.', ';
            }
            $this->sql = substr($this->sql, 0, -2);
        } else {
            $this->sql .= $this->table;
        }
        
        return $this;
    }
    private function setParams($k, $v) 
    {
        $this->params = [$k => $v];
    }

    public function getParams() {
        return $this->params;
    }

    public function getPrimaryKey()
    {
        foreach($this->fields as $k => $v) {
            if(isset($v["is_PK"]) && $v["is_PK"]) {
                return $k;
            }
        }
    }

    public function where($cond) {
        $this->sql .= " WHERE ";
        $count = 0;
        if(is_array($cond)) {
            foreach($cond as $k => $v) {
                if( $count > 0) {
                    $this->sql .= " AND ".$k." = :".$k;
                } else {
                    $this->sql .= $k." = :".$k;
                }
                $count++;
            }
        } else {
            $pk = $this->getPrimaryKey();
            $this->setParams($pk, $cond);
            $this->sql .= $pk." = :".$pk;
        }
        return $this;

    }

    public function join($relation) {
        $this->sql .= " INNER JOIN ";
        $this->relations = $relation;   
        $this->sql .= $relation["relation"]." ON ".$this->table.".".$relation["field"]." = ".$relation["relation"].".id";
        return $this;
    }

    public function update() {
        $this->sql = "UPDATE ".$this->table. " SET ";
        $fields = array_keys($this->fields);
        $fields = $this->removePK($fields);
        foreach($fields as $f) {
            $this->sql .= $f." = :".$f.", ";
        }
        $this->sql = substr($this->sql, 0, -2);

        $this->where($this->getPrimaryKey());
        return $this;
    }

    public function insert() {
        $this->sql = "INSERT INTO ".$this->table. " (";
        
        $fields = array_keys($this->fields);
        $fields = $this->removePK($fields);
        $values = "";

        foreach($fields as $f) {
            $this->sql .= $f.", ";
            $values .= ":".$f.", ";
        }
        
        $this->sql = substr($this->sql, 0, -2);
        $values = substr($values, 0, -2);
        $this->sql .= ") VALUES (".$values.")";

        return $this;
    }

    public function delete() {
        $this->sql = "DELETE ";
        
        return $this;
    }

    public function getRequest() {
        return $this->sql;
    }

    private function removePK($fields) 
    {
        $pk = $this->getPrimaryKey();
        $rem = null;
        foreach($fields as $k => $f) {
            if($f == $pk) {
                $rem = $k;
                unset($fields[$k]);
                break;
            }
        }

       return $fields;
    }
}