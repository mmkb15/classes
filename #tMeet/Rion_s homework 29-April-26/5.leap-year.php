<?php

$msg = "";
if (isset($_GET['submit_btn'])) {

    $num = isset($_GET["num"]) ? $_GET["num"] : null;


    if ($num % 4 === 0) {
        if ($num % 400 === 0) {
            $msg = "{$num} is a leap yaer";
        } elseif ($num % 100 === 0) {
            $msg = "{$num} is not a leap yaer";
        } else {
            $msg = "{$num} is a leap yaer";
        }
    } else {
        $msg = "{$num} is not a leap yaer";
    }

    // if ($num % 4 === 0 and $num % 400 === 0) {
    //     $msg = "{$num} is leap year";
    // } elseif ($num % 4 === 0 and $num % 100 === 0){
    //     $msg = "{$num} is not leap yaer";
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leap Year</title>
</head>

<body>
    <form>
        <label for="num">Enter a Year</label><br>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>

        <h4><?= $msg ?></h4>
    </form>
</body>

</html>