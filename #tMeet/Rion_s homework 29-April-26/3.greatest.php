<?php

$msg = "";
if (isset($_GET['submit_btn'])) {

    $num1 = $_GET["num1"];
    $num2 = $_GET["num2"];
    $num3 = $_GET["num3"];

    if ($num1 >  $num2 and $num1 > $num3) {
        $msg = "{$num1} is the greatest";
    } elseif ($num2 > $num3) {
        $msg = "{$num2} is the greatest";
    } else {
        $msg = "{$num3} is the greatest";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greatest</title>
</head>

<body>
    <form>
        <label for="num">Enter 3 Numbers</label><br>
        <input type="number" name="num1" id="num"><br><br>
        <input type="number" name="num2" id="num"><br><br>
        <input type="number" name="num3" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>

        <h4><?= $msg ?></h4>
    </form>
</body>

</html>