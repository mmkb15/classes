<?php
$arr = ["Mina", 12, false];


/* 
$name       = $arr[0];
$age        = $arr[1];
$is_active  = $arr[2];
*/

list($name, $age, $is_active) = $arr;

echo $name;
echo "<br>";
echo $age;
echo "<br>";
echo $is_active ? "Active" : "Inactive";

?>