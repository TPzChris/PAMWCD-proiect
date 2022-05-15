<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/css/register.css" />
    <script src="./../js/register.js"></script>
</head>
<body>
    <div class="loginbox">
        <img src="/../images/register/register.png" class="avatar">
        <h1>Register</h1>
        <form action="./../php/registerPHP.php" onsubmit="return formNotFilledOrInvalid(this);" method="post">
            <p>Username</p>
            <input type="text" name="username" placeholder="Introduceti username-ul...">
            <p>Parola</p>
            <input type="password" name="pass1" placeholder="Introduceti parola..."><br>
            <input type="password" name="pass2" placeholder="Introduceti din nou parola..."><br>
            <p>Email</p>
            <input type="text" name="email" placeholder="Introduceti o adresa de email..."><br>
            <input type="submit" name="Register" value="Register"><br>
            <a href="/pages/login.php">Aveti cont?</a>
        </form>
    </div>
</body>
</html>