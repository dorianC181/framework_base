<?php
class roleModel extends model{
    public function __init()
    {
        $this->table = "role";
        $this->fields = [
            "id" => [
                "type" => "int",
                "index" => "PK"
            ],
            "nom" => [
                "type" => "varchar",
                "size" => 50
            ],
            "prénom" => [
                "type" => "varchar",
                "size" => 50
            ],
            "email" => [
                "type" => "varchar",
                "size" => 50
            ],
            "password" => [
                "type" => "varchar",
                "size" => 50
            ]
        ];
    }
}

