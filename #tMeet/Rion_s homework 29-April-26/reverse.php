<?php

$msg = "";
if (isset($_GET['submit_btn'])) {

    $num = (string) $_GET["num"];

    $msg = strrev($num);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reverse Number</title>
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