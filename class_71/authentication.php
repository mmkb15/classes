<?php


// const PASS = "123";
// define("PASSWORD", "123");
$pass = "123s";
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
echo $hashed_pass;
echo "<br>";
// echo password_hash($pass, PASSWORD_DEFAULT);

if(password_verify($pass, $hashed_pass)){
    echo "Password is Valid";
}else{
    echo "Password is not Valid";   
}


?>