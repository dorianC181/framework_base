<?php

class model {

    private $DB_USER = "root";
    private $DB_HOST = "localhost";
    private $DB_PASS = "";
    private $DB_NAME = "framework_base";
    private $DB_PORT = 3306;

    protected $dbh;
    protected $sql;
    protected $table;
    protected $stmt;
    protected $params = [];
    protected $fields = [];

    public function __construct()
    {
        $pass = "";
        $user = "root";
        try {
            $this->dbh = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME.";port=".$this->DB_PORT, $this->DB_USER, $this->DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if(method_exists($this, "__init")) {
            $this->__init();
        }
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM ".$this->table;

        return $this->execute(true);
    }
    
    public function find($cond)
    {
        $this->sql = "SELECT * FROM ".$this->table." WHERE ";
        $this->params = $cond;

        foreach ($cond as $key => $value) {
            $this->sql .= $key."=:".$key;
            if(count($cond) > 1) {
                $this->sql .= " AND ";
            }
        }
        $this->sql = substr($this->sql, 0, -4);

        return $this->fetch();
    }

    public function insert($data)
    {
        $this->sql = "INSERT INTO ".$this->table."(";
        $this->params = $data;
        $values = "";
        foreach ($data as $k => $v) {
            $this->sql .= $k.",";
            $values.= ":".$k.",";
        }
        $this->sql = substr($this->sql, 0, -1).") VALUES (".substr($values, 0, -1).")";

        return $this->fetch();
    }
}

    public function fetch() 
    {
        $this->prepare();
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $this->sql = "UPDATE ".$this->table." SET ";
        $this->params = $data;

        foreach ($data as $k => $v) {
            $this->sql .= $k."=:".$k.",";
        }
        $this->sql = substr($this->sql, 0, -1)." WHERE ";

        foreach ($cond as $key => $value) {
            $this->sql .= $key."=:".$key;
            if(count($cond) > 1) {
                $this->sql .= " AND ";
            }
        }
        $this->sql = substr($this->sql, 0, -4);
    }

    public function delete($cond)
    {
        $this->sql = "DELETE FROM ".$this->table." WHERE ";
    }
        $this->params = $cond;

        foreach ($cond as $key => $value) {
            $this->sql .= $key."=:".$key;
            if(count($cond) > 1) {
                $this->sql .= " AND ";
            }
        
        $this->sql = substr($this->sql, 0, -4);

        $this->prepare();
        $this->execute();
        }

    private function execute($all = false, $mode = PDO::FETCH_ASSOC) {
        $this->stmt = $this->dbh->prepare($this->sql);
        $this->stmt->execute($this->params);
        if($all) {
            return $this->stmt->fetchAll($mode);
        } else {
            return $this->stmt->fetch($mode);
        }
    }

    public function save ($data) {
        $data_key = array_keys($data);
        foreach ($data_key as $k) {
            if( isset($this->fields[$k]['index']) && $this->fields[$k]['index'] == "PK") {
                echo "toto";
                return $this->update($data);
            } else {
                return $this->insert($data);
            }
        }
    }