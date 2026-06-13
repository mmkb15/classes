<?php

    // include "file1.php"; #one way like echo" " without parenteses;
/*     include ("file1.php");  #another way like echo(" ").....parentheses;
    include ("file2.php");  #another way like echo(" ").....parentheses; 
*/


    // Starnded Way
    include_once ("files/file1.php");  #give warring and execude the code;

    require_once ("files/file2.php");  #five fatal error and stop execude;

    echo "Name : " . $name . "<br>";
    echo "Age : " . $age;





?>