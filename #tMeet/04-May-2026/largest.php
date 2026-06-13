<?php

if(isset($_GET['submit'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $num3 = $_GET['num3'];

    $msg = "";
    if($num1 > $num2 && $num1 > $num3) {
        $msg = "{$num1} is the largest";
    } elseif ($num2 > $num3) {
        $msg = "{$num2} is the largest";
    } else {
        $msg = "{$num3} is the largest";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime</title>
</head>
<body>
    <form>
        <label>Enter a number</label><br>
        <input type="number" name="num1"><br><br>
        <input type="number" name="num2"><br><br>
        <input type="number" name="num3"><br><br>
        <button type="submit" name="submit">Submit</button>
        <p><?= $msg ?? ""; ?></p>
    </form>
</body>
</html>