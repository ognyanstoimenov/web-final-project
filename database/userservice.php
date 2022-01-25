<?php
class UserService {
    private Db $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registerUser($email, $password) : bool {
        $userTable = $this->db->getUserTableName();
        $sql = "INSERT INTO $userTable (email, password) VALUES (?, ?)";
        return $this->executeSql($sql, $email, $password);
    }

    public function loginUser($email, $password) : bool {
        $userTable = $this->db->getUserTableName();
        $sql = "SELECT * FROM $userTable WHERE email=? and password=?";
        return $this->executeSql($sql, $email, $password);
    }

    private function executeSql($sql, $email, $password) : bool {
        $conn = $this->db->getConnection();
        $hash = sha1($password);
        $prep = $conn->prepare($sql);
        try {
            return $prep->execute(array($email, $hash));
        }
        catch (PDOException) {
            return false;
        }
    }
}