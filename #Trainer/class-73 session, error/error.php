<?php
// try{
//     // echo "Hello";
//     throw new Exception("Name is not set");
// }catch(Exception $e){
//     echo $e->getMessage();
//     echo "<pre>";
//     print_r($e);
//     echo "</pre>";
// }finally{
//     echo "<br>finally";
// }

// function test(int $id, string $name){
//     echo "test";
// }

error_reporting(E_ALL);
// error_reporting(E_WARNING | E_NOTICE | E_PARSE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
// ini_set('error_log', 'error.txt');
ini_set('error_log', 'error.log');

echo $user;

?>