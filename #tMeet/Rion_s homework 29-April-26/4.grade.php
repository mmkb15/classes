<?php

$msg = "";
if (isset($_GET['submit_btn'])) {

    $num = isset($_GET["num"]) ? $_GET["num"] : null;

    if ($num > 100 || $num < 0) {
        $msg = "Enter valid marks";
    } else {
        if ($num >= 90) {
            $msg = "A";
        } elseif ($num >= 80) {
            $msg = "B";
        } elseif ($num >= 70) {
            $msg = "C";
        } else {
            $msg = "F";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade</title>
</head>

<body>
    <form>
        <label for="num">Enter your marks</label><br>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>

        <h4><?= $msg ?></h4>
    </form>
</body>

</html>