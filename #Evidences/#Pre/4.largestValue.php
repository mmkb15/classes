<?php

if (isset($_POST['submit_btn'])) {

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];
    $num4 = $_POST['num4'];
    $num5 = $_POST['num5'];

    $largest = $num1;

    if ($num2 > $largest) $largest = $num2;
    if ($num3 > $largest) $largest = $num3;
    if ($num4 > $largest) $largest = $num4;
    if ($num5 > $largest) $largest = $num5;
    $msg = "Largest Number is $largest";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Largest Number Finder</title>
</head>

<body>
    <h2>Find Largest Among Five Numbers</h2>

    <form action="" method="post">
        <label>Number 1 :</label><br>
        <input type="number" name="num1" value="<?= $num1 ?? ""; ?>" required><br><br>

        <label>Number 2 :</label><br>
        <input type="number" name="num2" value="<?= $num2 ?? ""; ?>" required><br><br>

        <label>Number 3 :</label><br>
        <input type="number" name="num3" value="<?= $num3 ?? ""; ?>" required><br><br>

        <label>Number 4 :</label><br>
        <input type="number" name="num4" value="<?= $num4 ?? ""; ?>" required><br><br>

        <label>Number 5 :</label><br>
        <input type="number" name="num5" value="<?= $num5 ?? ""; ?>" required><br><br>

        <button type="submit" name="submit_btn">Find Largest Number</button>
    </form>
    <p><?= $msg ?? "" ?></p>

</body>

</html>