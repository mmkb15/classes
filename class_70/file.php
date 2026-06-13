<?php
$file = fopen("test.txt","a+");
fwrite($file, "Hello World \n"); 
fwrite($file, "Hello World 2" . PHP_EOL); 
fclose($file);

// $file = fopen("test.txt","r+");
// echo fgets($file);
// fwrite($file,"Hello World");
// fclose($file);

    

?>