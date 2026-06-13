<?php

if(isset($_POST["submit_btn"])){
    $num = $_POST["num"];

    $msg = "$num is a prime number";

    for($i = 2; $i < $num; $i++){
        if($num % $i == 0){
            $msg = "$num is not prime number";
            break;
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3. Prime Number</title>
</head>
<body>
    <form action="" method="post">
        <p>Input a number to check Prime Number </p>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <h3><?= $msg ?? "" ?></h3>
</body>
</html>