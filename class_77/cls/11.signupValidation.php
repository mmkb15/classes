<?php

if(isset($_POST['signup'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $Mpass = $_POST['Mpass'];
    $email_regex = '/^[a-zA-Z0-9._]{2,50}[@]{1}[a-zA-Z0-9-]{2,20}[.]{1}[a-zA-Z]{2,6}$/';


if($email == ""){
    $emailErr = "Email is required";
}elseif(!preg_match($email_regex, $email)){
    $emailErr = "Email is not Valid";
}else{
    $emailErr = "";
}

if($pass == ""){
    $passErr = "Password is required";
}elseif(strlen($pass) < 8){
    $passErr = "Password must be at least 8 characters";
}else{
        $passErr = "";
    }

if($Mpass == ""){
    $MpassErr = "Confirm Password is required";
}elseif( $Mpass != $pass){
    $MpassErr = "Password and Confirm Password does not match";
}else{
    $MpassErr = "";
}

if($emailErr == "" && $passErr == "" && $Mpass ){
    $msg = "<p style='color:green';>Registration Successful</p>";
}


}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up Validation</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>

<form method="POST">
    <label for="email">Email</label><br>
    <input type="text" name="email" id="email" value="<?= $email ?? "mursalin@gmail.com";?>"><br>
    <div class="error"><?= $emailErr ?? "" ?></div>
    <br><br>

    <label for="pass">Password</label><br>
    <input type="password" name="pass" id="pass" value="<?= $pass ?? "123456789";?>"><br>
    <div class="error"><?= $passErr ?? "";?></div>
    <br><br>

    <label for="Mpass">Confirm Password</label><br>
    <input type="password" name="Mpass" id="Mpass" value="<?= $Mpass ?? "123456789";?>"><br>
    <div class="error"><?= $MpassErr ?? "";?></div>
    
    <br><br>

    <button type="submit" name="signup">Sign Up</button><br>
    <?= $msg ?? ""?>


</form>
    
</body>
</html>