<?php
$arr = [1,2,3,4,5,6];

echo "<pre>";
print_r(array_slice($arr,2,-2));
echo "</pre>";

array_splice($arr,3,0,[7]);
echo "<pre>";
print_r($arr);
echo "</pre>";

?>