<?php
session_start();
// $_SESSION["user_id"] = 1;
// unset($_SESSION['user_id']);
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
}

$pass = "123";
$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
if(isset($_POST['login'])){
    if(password_verify($_POST['password'], $hash_pass)){
        $_SESSION['user_id'] = 1;
        header("Location: dashboard.php");
    }else{
        $error = "Invalid Password";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username"><br><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
    </form>
    <p style="color: red;"><?= $error ?? '' ?></p>
</body>
</html>