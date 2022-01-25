<?php

class Db
{
    private $connection;

    public function __construct() {
        $host = "localhost";
        $dbname = "webproject";
        $username = "root";
        $password = ""; 

        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function getUserTableName() {
        return "Users";
    }
}

?>