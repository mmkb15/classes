<?php

$arr1 = [1, 2, 3];
$arr2 = array(4, 5, 6, 7, 8, 9 , "a", "b", "c", "d", "e", [022, "A-Z", true, false], true, false);

echo "<pre>";
print_r($arr1);
echo"<br>";
print_r($arr2);
echo "</pre>";

echo "\$arr1 Length : " . count($arr1);
echo"<br>";
echo "\$arr2 Length : " . count($arr2);
echo"<br>";
echo "\$arr2 Length to index : " . $arr2[11][1];


?>