<?php
require_once __DIR__ . '/../database/userservice.php';
require_once __DIR__ . '/../database/db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];
    $userService = new UserService(new Db());
    
    if ($userService->registerUser($email, $password)) {
        echo "Sign up successful.";
    } else {
        header('Location: index.php');
        echo "Error";
    }
}
?>