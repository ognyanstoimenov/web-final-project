<?php
class UserService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registerUser($email, $password) {
        $conn = $this->db->getConnection();
        $userTable = $this->db->getUserTableName();
        $sql = "INSERT INTO $userTable (email, password) VALUES (?, ?)";
        $hash = sha1($password);
        $prep = $conn->prepare($sql);
        try {
            return $prep->execute(array($email, $hash));
        }
        catch (PDOException $e) {

        }
    }

    public function loginUser($email, $password)
    {
        # todo;
    }
}

?>