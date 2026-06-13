<?php
session_start();
// const PASS = "123";
// define("PASSWORD", "123");
$pass = "123";
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
// echo $hashed_pass;
if(isset($_POST['login'])){    
    if(password_verify($_POST['pass'], $hashed_pass)){
        echo "Password is valid";
        $_SESSION['username'] = $_POST['user'];
    }else{
        echo "Password is not valid";
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
    <h3>Login</h3>
    <form action="" method="POST">
        <input type="text" name="user" placeholder="Username"><br>
        <input type="password" name="pass" placeholder="Password"><br><br>
        <input type="submit" value="Login" name="login">
    </form>
</body>
</html>