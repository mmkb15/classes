<?php
$arr = [
    "Japan"         => "Tokyo",
    "America"       => "New York",
    "England"       => "London",
    "Bangladesh"    => "Dhaka",
    "Pakistan"      => "Islamabad"
];
echo "Main Array: <br>";
echo "-----------------<br>";
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
foreach($arr as $k => $val){
    echo "$k => $val <br>";
}

ksort($arr);
echo "<br>Sorted Array: <br>";
echo "-----------------<br>";
foreach($arr as $k => $val){
    echo "$k => $val <br>";
}

?>