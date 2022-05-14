<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/css/login.css" />
    <script src="./../js/login.js"></script>
</head>
<body>
    <div class="loginbox">
        <img src="/../images/login/avatar.png" class="avatar">
        <h1>Login</h1>
        <form action="./../php/loginPHP.php" onsubmit="return formNotFilled(this);" method="post">
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Introduceti username-ul...">
            <p>Parola</p>
            <input type="password" name="password" id="password" placeholder="Introduceti parola..."><br>
            <input type="submit" name="Login" id="Login" value="Login" ><br>
            <a href="/pages/register.php">Nu aveti un cont?</a>
        </form>
    </div>
</body>
</html>