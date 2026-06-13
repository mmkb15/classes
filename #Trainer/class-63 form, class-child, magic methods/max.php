<?php
$msg = "";
if(isset($_POST["submit_btn"])){
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];
    // echo    $num1 . "<br>";
    // echo    $num2 . "<br>";
    // echo    $num3 . "<br>";
    if($num1 > $num2 && $num1 > $num3){
        $msg = $num1 . " is the largest number";
    }
    elseif($num2 > $num1 && $num2 > $num3){
        $msg = $num2 . " is the largest number";
    }
    else{
        $msg = $num3 . " is the largest number";
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
    <form action="" method="POST">
        <input type="number" name="num1" >
        <input type="number" name="num2" >
        <input type="number" name="num3" >
        <input type="submit" name="submit_btn">
    </form>
    <h2><?php echo $msg; ?></h2>
</body>
</html>