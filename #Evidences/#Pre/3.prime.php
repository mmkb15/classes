<?php
if (isset($_POST["submit_btn"])) {
    $num = $_POST['num'];
    $msg = "$num is prime";
    for ($i = 2; $i < $num; $i++) {
        if ($num % $i === 0) {
            $msg = "$num is not prime";
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
    <title>Username Validation</title>
</head>

<body>
    <form action="" method="post">
        <label for="">Enter a number</label><br>
        <input type="number" name="num" id="num"><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <?= $msg ?? ""; ?>
</body>

</html>