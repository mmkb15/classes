<?php
$arr = ["a","b", 2];
$str = "str";

echo is_array($str) ? "Array" : "Not Array";
echo "<br>";
echo is_array($arr) ? "Array" : "Not Array";

echo "<br>";

echo in_array(2, $arr) ? "Found" : "Not Found";
echo "<br>";
echo in_array("d", $arr) ? "Found" : "Not Found";
?>