<?php


// Localhost
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hospital_db');



// Hosting
// define('DB_HOST', 'localhost');
// define('DB_USER', 'u752250113_hospital_db');
// define('DB_PASS', 'pasS@8888');
// define('DB_NAME', 'u752250113_hospital_db');



$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_error){
    die("Connection Failed : " . $db->connect_error);
}
// else {
//     echo "Connection Successfull";
// }

?>