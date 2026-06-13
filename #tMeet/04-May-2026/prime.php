<?php

if(isset($_GET['submit'])) {
    $num = $_GET['num'];
    $msg = "{$num} is Prime number.";
    for ($i = 2; $i < $num; $i++) {
        if ($num % $i === 0) {
            $msg = "{$num} is not Prime number.";
            break;
        }
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
        <input type="number" name="num"><br><br>
        <button type="submit" name="submit">Submit</button>
        <p><?= $msg ?? ""; ?></p>
    </form>
</body>
</html>