<?php

if(isset($_POST["submit_btn"])){
    $num = $_POST["num"];
    $multi = 1;
    for($i = 1; $i <= $num; $i++){
        $multi *= $i;
    }
    $msg = "Factorial of $num is $multi";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>
<body>
    <h3>Give number for find out Factorial</h3>
    <form action="" method="post">
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <h3><?= $msg ?? ""; ?></h3>
</body>
</html>