<?php
$arr1 = ["a",123,true,[1,2,3]];
$arr2 = array("d","e","f","g");

echo "<pre>";
print_r($arr1);
print_r($arr2);
echo "</pre>";

echo count($arr1);
echo "<br>";
echo count($arr2);

echo "<br>";
echo $arr2[3][2];

?>