<?php

class userModel extends Model {
    public function __init()
    {
        $this->table = 'user';
        $this->fields = [
            "id" => [
                "type" => "int",
                "index" => "PK",
                "size" => 11,
                "is_PK" => true
            ],
            "nom" => [
                "type" => "varchar",
                "size" => 50
            ],
            "prenom" => [
                "type" => "varchar",
                "size" => 50
            ],
            "email" => [
                "type" => "varchar",
                "size" => 100
            ],
            "password" => [
                "type" => "varchar",
                "size" => 255
            ],
            "id_role" => [
                "type" => "int",
                "size" => 11,
                "is_FK" => true,
            ],
        ];
    }

}