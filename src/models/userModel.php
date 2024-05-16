<?php
class userModel extends model {
    public function __init(){
        $this->table = "user";
        $this->fields = [
            "ID" => [
                "type" => "int",
                "index" => "PK",
                "size" => 11
            ],"nom" => [
                "type" => "varchar",
                "size" => 50
            ],"prenom" => [
                "type" => "varchar",
                "size" => 50
            ],"email" => [
                "type" => "varchar",
                "size" => 50
            ],"password" => [
                "type" => "varchar",
                "size" => 50
            ]
        ];
    }
}