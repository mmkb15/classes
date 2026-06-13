<?php
/* 
8 Find out Factorial
example 5

1x2x3x4x5 = 120
5x4x3x2x1 = 120
0x82323123 = 0;

$num = 5;
$i=1 $multi=1 1x1 = 1
$i=2 $multi=1 2x1 = 2
$i=3 $multi=2 3x2 = 6
$i=4 $multi=6 4x6 = 24
$i=5 $multi=24 5x24 = 120

*/
/* 
if(isset($_POST['submit_btn'])){
    $num = $_POST['num'];
    // echo $num;

    $multi = 1;

    for($i = 1; $i <= $num; $i++){
        $multi *= $i;
    }
    $msg = "$num factorial is $multi";

}

 */

if(isset($_POST['submit_btn'])){
    $num = $_POST['num'];
    // echo $num;

    $multi = 1;
    $str = "";

    for($i = 1; $i <= $num; $i++){
        if($i == $num){
            $str = $str . $i;
        }else{
            $str = $str . $i . " x ";
        }
        $multi *= $i;
    }
    $msg = "$num factorial is $str = $multi";

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>
<body>
    <form action="" method="post">
        <label for="num">Enter a number for Calculate Factorial</label><br>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <?= $msg ?? ""?>
</body>
</html>