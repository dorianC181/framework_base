<?php 

class Model {

    private $DB_USER = "root";
    private $DB_HOST = "localhost";
    private $DB_PASS = "";
    private $DB_NAME = "framework_base";
    private $DB_PORT = 3306;

    private $dbh;
    private $sql;
    protected $table;
    protected $stmt;
    protected $params = [];
    protected $fields;
    protected $requester;
    protected $relations;

    public function __construct()   
    {
        try {
            $this->dbh = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME.';port='.$this->DB_PORT, $this->DB_USER, $this->DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if(method_exists($this, "__init")) {
            $this->__init();
        }

        $this->requester = new Requester($this->table, $this->fields);
    }

    public function findAll($config = [], $fields = "*")
    {
        $this->requester->select($fields)
            ->from();
            
        if(!empty($config)) {
            $this->requester->join($config);
        }
        return $this->execute(true);
    }

    public function find($cond, $fields = "*")
    {
        $this->requester->select($fields)
            ->from()
            ->where($cond);
        return $this->execute();
        
    }

    public function save($data) {
        if(isset($data[$this->requester->getPrimaryKey()])) {
            return $this->update($data);
        } else {
            return $this->insert($data);
        }
    }

    public function insert($data) 
    {
        $this->requester->insert();
        $this->params = $data;
        $this->execute();
        return $this->dbh->lastInsertId();
    }

    public function update($data) 
    {
        $this->requester->update();
        $this->params = $data;
        $this->execute();
        return $this->stmt->rowCount();
    }

    public function delete($data)
    {
        $this->requester->delete()->from()->where($data);
        $this->execute();
        return $this->stmt->rowCount();
    }

    private function execute($all = false, $mode = PDO::FETCH_ASSOC)
    {
        $this->stmt = $this->dbh->prepare($this->requester->getRequest());
        $this->stmt->execute(empty($this->params)?$this->requester->getParams():$this->params);
        if($all) {  
            return $this->stmt->fetchAll($mode);
        } else {
            return $this->stmt->fetch($mode);
        }
        
    }

}