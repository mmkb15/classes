<?php
    $num = 10;
    $str = "50";

    $num = (string) $num; // "10"
    (int) $str; // 10

    var_dump($num);
    echo "<br>";
    var_dump((float) $str);
?>