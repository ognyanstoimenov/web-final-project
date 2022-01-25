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

<form action="form.php" method="post">
  <label for="email">Email
  </label>
  <input type="email" name="email" required />
  <label for="password">Password</label>
  <input type="password" name="password" required />
  <label for="password">Password Again</label>
  <input type="password_again" name="password_again" required />
  <input type="submit" value="Sign up" />
</form>

</body>
</html>