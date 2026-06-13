<?php

$msgMax = "";
$msgMin = "";
if(isset($_POST["submit-btn"])) {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];
    // echo $num1 . "<br>";
    // echo $num2 . "<br>";
    // echo $num3 . "<br>";

    if($num1 > $num2 && $num1 > $num3) {
        $msgMax =  "$num1 is the maximum number";
    } elseif($num2 > $num3) {
        $msgMax =  "$num2 is the maximum number";
    } else {
        $msgMax =  "$num3 is the maximum number";
    }

        if($num1 < $num2 && $num1 < $num3) {
        $msgMin =  "$num1 is the minumum number";
    } elseif($num2 < $num3) {
        $msgMin =  "$num2 is the minumum number";
    } else {
        $msgMin =  "$num3 is the minumum number";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <hr>
    <form action="" method="POST">
        <input type="number" name="num1"><br><br>
        <input type="number" name="num2"><br><br>
        <input type="number" name="num3"><br><br>

        <button type="submit" name="submit-btn">Submit</button>
        <h2><?= $msgMin ?></h2>
        <h2><?= $msgMax ?></h2>
    </form>
    <hr>

</body>
</html>