<?php
$arr = ["a", "b", 1, 2];
$str = "str";

echo is_array($arr) ? "Array" : "Not Array";
echo "<br>";
echo is_array($str) ? "Array" : "Not Array";

echo "<br>";
echo "<hr>";

echo in_array("a", $arr) ? "Found" : "Not Found";
echo "<br>";
echo in_array("e", $arr) ? "Found" : "Not Found";

echo "<br>";



?>
