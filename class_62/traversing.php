<?php
$arr = [
    "a" => "Apple",
    "b" => "Ball",
    "c" => "Cat",
    "d" => "Dog",
    "e" => "Elephent",
    "f" => "Flower",
];

echo key($arr) . "<br>";        #a
echo current($arr) . "<br>";    #Apple
echo next($arr) . "<br>";       #Ball
echo next($arr) . "<br>";       #Cat
echo current($arr) . "<br>";    #Cat
echo prev($arr) . "<br>";       #Ball
echo next($arr) . "<br>";       #Cat
echo next($arr) . "<br>";       #Dog
echo next($arr) . "<br>";       #Elephent
echo next($arr) . "<br>";       #Flower
echo next($arr) . "<br>";       #
echo end($arr) . "<br>";        #Flower
echo prev($arr) . "<br>";       #Elephent
echo reset($arr) . "<br>";      #Apple
echo current($arr) . "<br>";    #Apple

?>