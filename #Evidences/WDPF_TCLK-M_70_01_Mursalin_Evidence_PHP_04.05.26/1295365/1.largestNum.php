<?php

if(isset($_POST["submit_btn"])){
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];

    if($num1 > $num2 && $num1 > $num3){
        $msg = "$num1 is the largest number";
    }elseif($num2 > $num3){
        $msg = "$num2 is the largest number";
    }else{
        $msg = "$num3 is the largest number";
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1. Largest Number</title>
</head>
<body>
    <p>Input numbers to find Largest one</p>
    <form action="" method="post">
        <input type="number" name="num1"><br><br>
        <input type="number" name="num2"><br><br>
        <input type="number" name="num3"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <h3><?= $msg ?? ""; ?></h3>
</body>
</html>