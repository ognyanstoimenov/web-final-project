<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start();

$user = $_SESSION['user'];
if ($user) {
    header("Location: main.php");
}
else {
    header("Location: login.php");
}
?>

</body>
</html>