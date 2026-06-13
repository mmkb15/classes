<?php
$arr = ["Apple","Cat","Dog","Elephant","Fish","Ball"];
echo "<pre>";
print_r(array_reverse($arr));
echo "</pre>";
$arr2 = [
    "a" => "Apple",
    "b" => "Ball",
    "c" => "Cat",
    "d" => "Dog",
    "e" => "Elephant",
    "f" => "Fish"
    ];
echo "<pre>";
print_r(array_flip($arr2));
echo "</pre>";
echo "<pre>";
print_r(array_flip($arr));
echo "</pre>";

?>