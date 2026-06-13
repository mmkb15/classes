<?php

$srt = "Hello World 2026";

$arr = explode("l", $srt); #He  o Wor  d 2026

echo"<pre>";
print_r($arr);
echo"</pre>";

$newstr = implode("😢", $arr); #He,,o Wor,d 2026
echo $newstr;


$arr2 =range("a","k",3); # range(string|int|float $start, string|int|float $end, int|float $step = 1): array 
echo"<pre>";
print_r($arr2);
echo"</pre>";

echo implode('💕', range('a', 'i'));

echo'<br>';
$arr_assoc = [
    "a" => "hello",
    "b" => "Ball",
];

echo array_key_exists("a", $arr_assoc) ? "Found":"Not Found";


$keys = array_keys($arr_assoc);
echo"<pre>";
print_r($keys);
echo"</pre>";

$values = array_values($arr_assoc);
echo"<pre>";
print_r($values);
echo"</pre>";

?>
