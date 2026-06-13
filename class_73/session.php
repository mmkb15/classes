<?php
session_start();

$_SESSION['id'] = 1;
$_SESSION['name'] = "Meena";
$_SESSION['age'] = 24;


// unset($_SESSION["name"]);
session_unset();



?>