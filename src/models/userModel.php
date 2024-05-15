<?php

class userModel extends model{

    public function __init()
    {
        $this->table = "user";
    }

    private function prepare() {
        $this->stmt = $this->dbh->prepare($this->sql);
    }

    private function execute() {
        $this->stmt->execute($this->params);
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
    
    public function delete($data)
    {
        $this->sql = "DELETE FROM ".$this->table." WHERE id = :id";
        $this->params = $data;
        $res = $this->fetch();
    }
}