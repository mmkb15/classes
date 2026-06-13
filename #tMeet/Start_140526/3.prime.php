<?php

/* 
3 Check whether a number is prime or not?

example  7
1,7 exclude 2,3,4,5,6





*/

if (isset($_POST["submit_btn"])) {
    $num = $_POST['num'];
    // echo $num;

    // $is_prime = null;

    // for ($i = 2; $i < $num; $i++) {
    //     if ($num % $i === 0) {
    //         $is_prime = false;
    //         break;
    //     } else {
    //         $is_prime = true;
    //     }
    // }

    // if ($is_prime) {
    //     $msg = "$num is prime";
    // } else {
    //     $msg = "$num is not prime";
    // }

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