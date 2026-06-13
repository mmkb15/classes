<?php
// User defined / Custom sort

$arr = ["Apple", "Pencil", "Ball", "Gun", "Zoo", "Dog"];

echo "<pre>";
print_r($arr);
echo "</pre>";

usort($arr, function($a,$b){
    return strlen($a) - strlen($b);
});

echo "<pre>";
print_r($arr);
echo "</pre>";

?>