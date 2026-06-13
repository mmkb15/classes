<?php


$num = 100;

for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0 and $i % 5 === 0) {
        echo "{$i} FizzBuzz<br>";
    } elseif ($i % 3 === 0) {
        echo "{$i} Fizz<br>";
    } elseif ($i % 5 === 0) {
        echo "{$i} Buzz<br>";
    } else {
        echo "{$i}<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fizz Buzz</title>
</head>

<body>

</body>

</html>