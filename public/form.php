<?php
require_once __DIR__ . '/../database/authservice.php';
require_once __DIR__ . '/../database/db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if ($_POST) {
    $isRegisterForm = isset($_POST['REGISTER']);
    $isLoginForm = isset($_POST['LOGIN']);
    $isLogoutForm = isset($_POST['LOGOUT']);

    if($isLogoutForm) {
        $_SESSION = array();
        header('Location: main.php');
        exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $userService = new AuthService(Db::getInstance());

    if($isRegisterForm) {
        $password_again = $_POST['password_again'];
        $usr = $userService->registerUser($email, $password);
        if ($usr) {
            login($usr);
        } else {
            header('Location: login.php');
        }
    }

    else if($isLoginForm) { //login
        $usr = $userService->loginUser($email, $password);
        if ($usr) {
            login($usr);
        } else {
            header('Location: login.php');
        }
    }

}

function login($usr) {
    $_SESSION['user'] = $usr;
    header('Location: main.php');
}
