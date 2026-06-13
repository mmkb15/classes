<?php

if(isset($_POST["login_btn"])){
    $username = $_POST["username"];
    // echo $username;
    //   var_dump(strpos($username,"@")) ; 

    if(empty($username)){
        $msg = "Username is empty <br>";
    }elseif(strlen($username) < 4 && strlen($username) > 8){
        $msg = "Username must be between 4 to 8 character<br>";
    }elseif(strpos($username,"@") === false){
        $msg = "Username must contain @ symbol<br>";
    }else{
        $msg= "Logged in Successfully<br>";
    }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Username</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" placeholder="@mursalin" value="<?= $_POST['username'] ?? '' ?>"><br>
        <?= $msg ?? "" ?><br>

        <!-- <label for="password">Password</label><br>
        <input type="password" name="password" id="password" value="154286"> <br><br> -->

        <button type="submit" name="login_btn">Login</button>
    </form>
</body>
</html>