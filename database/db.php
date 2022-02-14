<?php

class Db
{
    private PDO $connection;
    private static ?Db $instance = null;

    private function __construct() {
        $host = "localhost";
        $dbname = "webproject";
        $username = "root";
        $password = "";
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        } catch (PDOException $e) {
            echo "";
        }
    }

    public static function getInstance(): Db
    {
        if (self::$instance == null) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function getUserTableName(): string
    {
        return "Users";
    }

    public function getLectureTableName(): string
    {
        return "Lectures";
    }

    public function getCourseTableName()
    {
        return "Courses";
    }
}

