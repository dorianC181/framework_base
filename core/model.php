<?php

class model {

    private $DB_USER = "root";
    private $DB_HOST = "localhost";
    private $DB_PASS = "";
    private $DB_NAME = "framework_base";
    private $DB_PORT = 3306;

    protected $dbh;
    protected $sql;
    protected $table = "user";
    protected $stmt;
    protected $params = [];
    protected $fields = [];
    protected $requester;

    public function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME.";port=".$this->DB_PORT, $this->DB_USER, $this->DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if(method_exists($this, "__init")) {
            $this->__init();
        }
        $this->requester = new requester($this->table);
    }

    public function findAll($fields = "*")
    {
        $this->requester->select(["nom", "prenom"])
            ->from(5);
            
        /*$this->sql = $this->requester->select(["nom, prenom"])
            ->where(["nom" => "Catric"]);
            $this->sql = $this->requester->select(["nom, prenom"])
                ->where(["nom" => "Catric", "prenom" => "Dorian"]);
            return $this->requester->execute(true); */
    }
    
    public function find($cond)
    {
        $this->resquester->select(["nom", "prenom"])
            ->from(5)
            ->where(["nom" => "Catric"]);
       /* $this->sql = "SELECT * FROM ".$this->table." WHERE ";
        $this->params = $cond;

        foreach ($cond as $key => $value) {
            $this->sql .= $key."=:".$key;
            if(count($cond) > 1) {
                $this->sql .= " AND ";
            }
        }
        $this->sql = substr($this->sql, 0, -4);

        return $this->fetch(); */
    }

    public function insert($data)
    {
        $request = $this->requester->insert($data);

        $this->sql = $request->sql;

        $this->params = $request->params;

        $this->execute();
    }

    public function update($data)
    {
        $this->sql = "UPDATE ".$this->table." SET ";
        $this->params = $data;

        foreach ($data as $key => $value) {
            $this->sql .= $key."=:".$key.", ";
        }
        $this->sql = substr($this->sql, 0, -2);

        $this->execute();
    }

    public function delete($data)
    {
        $request = $this->requester->delete()
            ->from()
            ->where($data);
        $this->sql = $request->sql;

        $this->params = $request->params;

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
}