<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/switch.css">
</head>
<body>
<div class="content">
    <form id="registerForm" action="form.php" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" required /><br>
    <label for="password">Password</label>
    <input type="password" name="password" required /><br>
    <label for="password">Password Again</label>
    <input type="password" name="password_again" required /><br>
    <input type="hidden" name="REGISTER"/>
    <input type="submit" value="Sign up" />
    </form>

    <form id="loginForm" action="form.php" method="post" style="display: none">
        <label for="email">Email
        </label>
        <input type="email" name="email" required /><br>
        <label for="password">Password</label>
        <input type="password" name="password" required /><br>
        <input type="submit" value="Sign in" />
        <input type="hidden" name="LOGIN"/>
    </form>

    Do you have an account?
    <label class="switch">
        <input type="checkbox" id="loginSwitch">
        <span class="slider round"></span>
    </label>
</div>

<script src="./js/main.js"></script>
</body>
</html>
