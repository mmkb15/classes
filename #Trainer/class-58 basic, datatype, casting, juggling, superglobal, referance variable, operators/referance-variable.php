<?php
    $var1 = 10;
    $var2 =& $var1;
    $var3 =& $var2;
    $var2 = 20;
    $var1 = 30;

    echo $var3;

?>