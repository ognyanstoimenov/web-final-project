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
session_start();
$user = $_SESSION['user'];
if ($user) {
    echo "Logged in as $user";
}
else {
    header("Location: login.php");
}
?>
</body>
</html>