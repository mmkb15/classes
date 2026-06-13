<?php


$str = "Hello World! Hello Bangalesh";

echo substr($str, 6, 4);
echo "<br>";
echo strlen($str);
echo "<br>";
var_dump(strpos($str, 'h'));
echo "<br>";
var_dump(stripos($str, 'h'));
echo "<br>";
echo str_replace('Hello', 'Hi', $str);
echo "<br>";
echo str_ireplace('bangalesh', 'USA', $str);
echo "<br>";
echo strtolower($str);
echo "<br>";
echo strtoupper($str);
echo "<br>";
echo ucfirst(strtolower($str));
echo "<br>";
echo ucwords(strtolower($str));

$html = htmlspecialchars("<h1 style = 'font-size:2000px'>Waahh 😒</h1>");
echo $html;

?>