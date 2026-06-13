<?php


// echo $_GET["email"];

/* 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "post method";
}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "get method";
}else{
    echo "No method found";
}

*/
$username_error = "";
$email_error = "";
$msg = "";

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    echo "<br>";
    $email =  $_POST["email"];

    $reg_username = "/^[a-zA-Z@]{4,8}$/"; 
    $reg_email = "/^[a-zA-Z-0-9._]{3,60}[@]{1}[a-zA-Z-0-9-]{2,20}[.]{1}[a-zA-Z]{2,20}$/";

    if(!preg_match($reg_username, $username)){
        $username_error = "Username is not valid";
    }else{
        $msg = "";
    }

    if(!preg_match($reg_email, $email)){
        $email_error =  "Email is not valid";
    }else{
        $msg = "";
    }
    
    if($username_error == "" && $email_error == ""){
        $msg = "Form Submitted Successfully";
    }

    // var_dump(preg_match($reg_email, $email));

    // if(preg_match($reg_email, $email) === 0){
    //     echo "Email is not valid";
    // }
    // if(!preg_match($reg_email, $email) === 1){
    //     echo "Email is not valid";
    // }

    // if((bool) preg_match($reg_email, $email) === false){
    //     echo "Email is not valid";
    // }
    // if((bool) !preg_match($reg_email, $email) === true){
    //     echo "Email is not valid";
    // }


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <style>
        .error-text{
            color : red;
        }
        .success-text{
            color : green;
        }
    </style>
</head>
<body>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $username ?? "Mursalin" ?>">
        <br>
        <span class="error-text"><?=  $username_error ?? ""; ?></span>
        <br>
        <span class="error-text"></span>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $email ?? "Mursalin@gmail.com" ?>">
        <br>
        <span class="error-text"><?=  $email_error ?? ""; ?></span>
        <br>

        <input type="submit" name="submit">
        <h3 class="success-text"><?= $msg ?? ""; ?></h3>
    </form>
</body>
</html>