<?php
require_once __DIR__ . '/../database/userservice.php';
require_once __DIR__ . '/../database/db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isRegisterForm = isset($_POST['REGISTER']);
    $userService = new UserService(Db::getInstance());

    if($isRegisterForm) {
        $password_again = $_POST['password_again'];
        if ($userService->registerUser($email, $password)) {
            session_start();
            $_SESSION['user'] = $email;
            header('Location: main.php');
        } else {
            header('Location: login.php');
            echo "Error";
        }
    }

    else { //login
        echo "not implemented";
    }


}
