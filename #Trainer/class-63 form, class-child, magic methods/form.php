<?php
// require_once("library.php");
$email = "";
if(isset($_POST["signup_btn"])){
    $email = $_POST["email"];
    echo $_POST["username"];
    echo $_POST["email"];
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";     
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
    <form action="" method="POST">
        <label>Username</label><br>
        <input type="text" name="username" 
        value="<?= isset($_POST["username"]) ? $_POST["username"] : "";?>"><br><br>
        <label>Email</label><br>
        <input type="text" name="email" 
        value="<?= $email; ?>"><br><br>
        <input type="submit" value="Signup" name="signup_btn">
    </form>
</body>
</html>