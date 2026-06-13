<?php

$data = [4, 4, -4, -1, 0, -8, 0, 45, 9, 79];
$positive = 0;
$negative = 0;
$zero = 0;
$sum = 0;

for ($i = 0; $i < count($data); $i++) {
    if ($data[$i] > 0) {
        $positive++;
    } elseif ($data[$i] < 0) {
        $negative++;
    } else {
        $zero++;
    }
    $sum += $data[$i];
}

echo "Positive Numbers: " . $positive . '<br>';
echo "Negative Numbers: " . $negative . '<br>';
echo "Zoro: " . $zero . '<br>';
echo "Sum: " . $sum . '<br>';
