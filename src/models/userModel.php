<?php

class userModel {
    private $dbh;
    private $table = "user";
    private $sql;

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
         $this->stmt->execute();
    }

    private function fetchAll() {
        $this->prepare($this->sql);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}