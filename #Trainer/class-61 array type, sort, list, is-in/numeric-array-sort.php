<?php
$arr = ["Cat", "Zoo", "Dog", "Apple", "Ball", "Gun"];
$arr_num = [101, 2, 11, 1, 50, 1010];
echo "<pre>";
print_r($arr);
echo "</pre>";

sort($arr);     // sort in ascending order
// rsort($arr);     // sort in descending order
rsort($arr_num);     // sort in descending order

echo "<pre>";
print_r($arr);
print_r($arr_num);
echo "</pre>";

?>