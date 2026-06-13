<?php
$arr_assoc = [
    "USA"           => "Washington",
    "Bangladesh"    => "Dhaka",
    "Japan"         => "Tokyo",
    "Nepal"         => "Kathmandu",
    "Pakistan"      => "Islamabad",
    "UK"            => "London",
];
echo "<pre>";
print_r($arr_assoc);
echo "</pre>";

// ksort($arr_assoc);     // sort in ascending order
krsort($arr_assoc);     // sort in descending order

echo "<pre>";
print_r($arr_assoc);
echo "</pre>";

?>