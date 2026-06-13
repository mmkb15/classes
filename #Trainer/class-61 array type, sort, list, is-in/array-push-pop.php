<?php
$arr = ["Mina","Raju","Mithu"];

echo "<pre>";
print_r($arr);
echo "</pre>";

array_push($arr, "Dhipu","Rita");

echo "<pre>";
print_r($arr);
echo "</pre>";

array_pop($arr);
array_pop($arr);

echo "<pre>";
print_r($arr);
echo "</pre>";

array_shift($arr);

echo "<pre>";
print_r($arr);
echo "</pre>";

array_unshift($arr, "Faysal");

echo "<pre>";
print_r($arr);
echo "</pre>";


?>