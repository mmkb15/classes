<?php


try{
    
    // if(isset($_GET['name'])){
    //     
    // }else{
    //     throw new Exception("Name not found");
    // }

    // throw new Exception("Name not found");
}catch(Exception $e){
    // echo $e->getMessage();
    // echo "<pre>";
    // print_r($e);
    // echo "<pre>";
}finally{
    echo"<br>Finally";
}


error_reporting(E_ALL);
ini_set('display_errors',0);
ini_set('log_errors',1);
ini_set('error_log','error.log');


//  E_PARSE
echo "HEllo world"; 
$name = "PHP";

// E_WARNING
include("not_found_file.php");
echo "Hello World!";


//E_NOTICE
echo $user; 
$data = ["id" => 1];
echo $data["name"];
?>