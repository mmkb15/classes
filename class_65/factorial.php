<?php
$msg = "";
// if(isset($_GET["submit"])){
//     $num = $_GET["num"];
//     echo $num;
//     $sum = 1;

//     for($i = 1; $i <= $num; $i++){
//         $sum *= $i;
//         if ($i == $num) {
//             $msg .= $i;
//         } else {
//             $msg .= $i . "x";
//         }
//     }
//     $msg .= "= " . $sum;
// }

echo $_POST["num"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>
<body>
    <h2>Factorial</h2>
    <form method="POST">
        <label>Type a Number</label>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>