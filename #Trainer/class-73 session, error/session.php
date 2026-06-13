<?php
session_start();
$_SESSION['id'] = 10;
$_SESSION['name'] = "Mina";
$_SESSION['age'] = "12";

// unset($_SESSION['id']);
// session_unset();

session_destroy();
?>