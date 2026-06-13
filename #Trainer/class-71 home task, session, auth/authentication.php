<?php
// const PASS = "123";
// define("PASSWORD", "123");
$pass = "123";
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
// echo $hashed_pass;
if(password_verify("1234", $hashed_pass)){
    echo "Password is valid";
}else{
    echo "Password is not valid";
}

?>
