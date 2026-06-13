<?php
$countries = [
    "Bangladesh" => "Dhaka",
    "India"      => "New Delhi",
    "Pakistan"   => "Islamabad",
    "Sri Lanka"  => "Colombo",
    "Nepal"      => "Kathmandu"
];
echo "Array before sorting";
echo "<pre>";
print_r($countries);
echo "</pre>";

ksort($countries);

echo "<hr>";

echo "Array after sorting";
echo "<pre>";
print_r($countries);
echo "</pre>";
