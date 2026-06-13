<?php
if(isset($_POST['submit'])){
    $num = $_POST['num'];
    $factorial = 1;

    for($i = $num; $i > 1; $i--)
    {
        $factorial *= $i;
    }
    $meg = "Factorial of $num is: $factorial";
}
// task: 5x4x3x2x1 = 120
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Factorial:</h2>
    <form method="POST">
        <input type="number" name="num">
        <button type="submit" name="submit">Submit</button>
    </form>
    <h3><?php echo $meg ?? ""; ?></h3>
</body>
</html>