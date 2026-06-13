<?php
$pyramid1 = "";
$pyramid2 = "";
$pyramid3 = "";

if (isset($_GET['submit_btn'])) {

    $num = $_GET["num"];

    for ($i = 1; $i <= $num; $i++) {
        for ($j = 0; $j <= $num; $j++) {
            $pyramid1 .= "*";
        }
        $pyramid1 .= "<br>";
    }

    for ($i = 1; $i <= $num; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            $pyramid2 .= "*";
        }
        $pyramid2 .= "<br>";
    }

    for ($i = $num; $i > 0; $i--) {
        for ($j = 1; $j <= $i; $j++) {
            $pyramid3 .= "*";
        }
        $pyramid3 .= "<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pyramid</title>
</head>

<body>
    <form>
        <label for="num">Enter a Number</label><br>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">See Stars</button>
        <div style="display: flex; gap: 40px;">
            <p><?= $pyramid1 ?></p>
            <p><?= $pyramid2 ?></p>
            <p><?= $pyramid3 ?></p>
        </div>

    </form>
</body>

</html>