<?php
require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../models/user.php';
class AuthService {
    private Db $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registerUser($email, $password) : User|false
    {
        $userTable = $this->db->getUserTableName();
        $sql = "INSERT INTO $userTable (email, password) VALUES (?, ?)";
        $this->executeSql($sql, $email, $password);
        return $this->loginUser($email, $password);
    }

    public function loginUser($email, $password) : User|false {
        $userTable = $this->db->getUserTableName();
        $sql = "SELECT * FROM $userTable WHERE email=? and password=?";
        return $this->executeSql($sql, $email, $password);
    }

    private function executeSql($sql, $email, $password) : User|false {
        $conn = $this->db->getConnection();
        $hash = sha1($password);
        $prep = $conn->prepare($sql);
        if(!$prep->execute(array($email, $hash))) {
            throw new PDOException();
        };

        return $prep->fetchObject('User');
    }
}