<?php
/*
    echo "<span>PHP Top</span>"," - ", "PHP Top2 <br>";
    echo("New line");
    echo "<br>"." 2546 "."<br>";

    print("Print line1");
    print "Print line";

*/

    #echo "<br>";

    #$arr = ["PHP", "HTML", "CSS", 5465];
    #const PI = 3.1416;

    // echo $arr;
    // echo "<br><br> -------print_r:------- <br>";
    // print_r($arr);
    // echo "<br><br> -------var_dump:------- <br>";
    // var_dump($arr);

    $name = "Mina";
    $age = 25;

    printf("Her name is %s and age is %d.", $name, $age);
    echo "<br>";
    print("Her name is " . $name . " and age is " . 25 . ".");
    echo "<br>";

    $str = sprintf("Her name is %s and age is %d.", $name, $age);

    echo $str;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>HTML section &Pi;</h2>
    <h3><?php //echo "PHP inside HTML"; ?></h3>
    <h3><?= "New PHP inside HTML"; ?></h3>
</body>
</html>

<?= "PHP bottom";?>

<!-- Not recommend -->
<? echo "PHP bottom2";?>