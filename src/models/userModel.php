<?php

class userModel {
    private $dbh;
    private $table = "user";
    private $sql;
    private $stmt;
    private $cond;
    private $data;

    public function __construct()
    {
        $pass = "";
        $user = "root";
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=framework_base', $user, $pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function findAll()
    {
        $this->sql = "SELECT * FROM ".$this->table;
        $result = $this->fetchAll();
        var_dump($result);
    }

    private function prepare() {
        $this->stmt = $this->dbh->prepare($this->sql);
    }

    private function execute() {
         $this->stmt->execute($this->params);
    }

    private function fetchAll($mode = PDO::FETCH_ASSOC) {
        $this->prepare($this->sql);
        $this->execute();
        return $this->stmt->fetchAll($mode);
    }

    public function find($cond)
    {
        $this->sql = "SELECT * FROM ".$this->table." WHERE ";
        $this->params = $cond;
        var_dump($cond);
        foreach ($cond as $key => $value) {
            $this->sql .= $key."=:".$key;
            if(count($cond) > 1) {
                $this->sql .= " AND ";
            }
        }
        $this->sql = substr($this->sql, 0, -4);

        $result = $this->fetch();
        var_dump($result);
    }

    private function fetch($mode = PDO::FETCH_ASSOC) {
        $this->prepare($this->sql);
        $this->execute();
        return $this->stmt->fetch($mode);
    }

    private function executeSave() {
        $this->prepare($this->sql);
        $this->stmt->execute($this->params);
        return $this->stmt->rowCount();
    }

    public function insert($data)
    {
        $this->sql = "INSERT INTO ".$this->table."(";
        $this->params = $data;
        $values = "";
        foreach ($data as $k => $v) {
            $this->sql .= $k.", ";
            $values.= ":".$k.", ";
        }
        $values = substr($values, 0, -2);
        $this->sql = substr($this->sql, 0, -2);
        $this->sql .= ") VALUES(".$values.")";

        echo $this->sql;
        $result = $this->fetch();
        
        return $this->dbh->lastInsertId();
    }

    public function update($data)
    {
        $this->sql = "UPDATE ".$this->table." SET ";
        $this->params = $data;
        $where = "";
        foreach ($data as $k => $v) {
            if($k == "id") {
                $where .= " WHERE ".$k."= :".$k;
            } else {
                $this->sql .= $k."=:".$k.", ";
            }
        }
        $this->sql = substr($this->sql, 0, -2);
        $this->sql .= $where;

        return $result = $this->executeSave();
        }
}