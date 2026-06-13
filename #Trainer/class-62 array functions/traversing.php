<?php
$arr = [
    "a" => "Apple",
    "b" => "Ball",
    "c" => "Cat",
    "d" => "Dog",
    "e" => "Elephant",
    "f" => "Fish",
    ];

// echo key($arr)."<br>";
// echo current($arr)."<br>";
echo next($arr)."<br>";
echo next($arr)."<br>";
// echo current($arr)."<br>";
echo prev($arr)."<br>";
echo end($arr)."<br>";
echo end($arr)."<br>";
echo reset($arr)."<br>";
echo current($arr)."<br>";

echo sizeof($arr)."<br>";

?>