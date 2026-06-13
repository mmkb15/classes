<?php

$file = fopen("test.txt","a+");
fwrite($file,"Hello world \n");
fclose($file);

// $file = fopen("test.txt","r+");
// echo fgets($file);
// fwrite($file,"Hello BD");
// fclose($file);

?>