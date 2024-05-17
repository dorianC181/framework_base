<?php
class roleModel extends Model {

    public function __init()
    {
        $this->table = 'role';
        $this->fields = [
            "id" => [
                "type" => "int",
                "index" => "PK",
                "size" => 11
            ],
            "libelle" => [
                "type" => "varchar",
                "size" => 20
            ]
        ];
    }
}