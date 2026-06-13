<?php
// echo $_GET['email'];
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     echo "post method";

// }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
//     echo "get method";
// }
if(isset($_POST["form_email"])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $reg_email = "/^[a-zA-Z0-9._]{3,60}[@]{1}[a-zA-Z0-9-]{2,20}[.]{1}[a-zA-Z]{2,6}$/";

    if(empty($username)){
        $username_error = "Username is required";
    }elseif(strlen($username) < 4 || strlen($username) > 8){
        $username_error = "Username must be between 4 to 8 characters";
    }elseif(strpos($username, "@") == false){
        $username_error = "Username must contain @ sign";
    }else{
        $username_error = "";
    }

    // var_dump(preg_match($reg_email, $email));

    if(preg_match($reg_email, $email) === 0){
        $email_error = "Email is not valid";
    }else{
        $email_error = "";
    }

    if($email_error == "" && $username_error == ""){
        $msg = "Form submitted successfully";
    }

}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error-text{
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST">
        <label>Username</label><br>
        <input type="text" name="username" value="<?php echo $username ?? ""; ?>">        
        <div class="error-text"><?= $username_error ?? "";?></div><br>

        <label>Email</label><br>
        <input type="text" name="email" value="<?php echo $email ?? "asia@mail.com"; ?>">
        <div class="error-text"><?= $email_error ?? ""; ?></div><br>

        <input type="submit" name="form_email" value="Submit">
        <h3 style="color: green;"><?php echo $msg ?? ""; ?></h3>
    </form>
</body>
</html>