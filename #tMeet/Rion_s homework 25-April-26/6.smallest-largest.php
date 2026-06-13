<?php

$data = [4, 4, -4, -1, 0, -8, 0, 45, 9, 79];
$smallest = $data[0];
$largest = $data[0];
$sum = 0;

for ($i = 0; $i < count($data); $i++) {
    if ($data[$i] > $largest) {
        $largest = $data[$i];
    } elseif ($data[$i] < $smallest) {
        $smallest = $data[$i];
    }
    $sum += $data[$i];
}

echo "Smallest Number: " . $smallest . '<br>';
echo "Largest Number: " . $largest . '<br>';
echo "Sum: " . $sum . '<br>';
