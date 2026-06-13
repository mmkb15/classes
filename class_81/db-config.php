<?php
#syntx
//  new mysqli(host, username, password, database);

// standrad way ...use for project
/* 
// #local 
// define("DB_HOST", "localhost");
// define("DB_USER", "root");
// define("DB_PASS", "");
// define("DB_NAME", "round_70");



// #local 
// define("DB_HOST", "abc.com");
// define("DB_USER", "round_70");
// define("DB_PASS", "123456789");
// define("DB_NAME", "round_70");


$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 */





// easy way ...use only for exam
$db = new mysqli("localhost", "root", "", "round_70");


if($db->connect_error){
    die("<h2 style='color:red'>Connection Failed</h2>") . $db->connect_error;
}
/* else{
    echo "<h2 style='color:green'>Connected Successfully</h2>";
}
 */
?>