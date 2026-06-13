<?php

$msg = "";
$num = null;
$sum = 0;
if (isset($_GET['submit_btn'])) {

    $num = $_GET["num"] ;

    for ($i = 1; $i <= $num; $i++) {
        $sum += $i;
    }

    $msg = "Sum of 1 to {$num} is {$sum}";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sum of Numbers</title>
</head>

<body>
    <form>
        <label for="num">Enter a Number</label><br>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>

        <h4><?= $msg ?></h4>
    </form>
</body>

</html>