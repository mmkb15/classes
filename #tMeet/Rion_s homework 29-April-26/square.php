<?php
$msg = "";

if (isset($_GET['submit_btn'])) {

    $num = $_GET["num"];

    for ($i = 1; $i <= $num; $i++) {
        if ($i == $num) {
            $msg .= $i ** 2;
        } else {
            $msg .= $i ** 2 . ',';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Square</title>
</head>

<body>
    <form>
        <label for="num">Enter a Number</label><br>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Get Square</button>

        <h4><?= $msg ?></h4>
    </form>
</body>

</html>