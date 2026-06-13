<?php
$arr = [
    "Japan"     =>  "Tokyo",
    "Bangladesh" => "Dhaka",
    "UK"        => "London",
    "Pakistan"  =>  "Islamabad",
    "Nepal"     => "Khathmundu",
];  

echo "Main Array : <br>";
echo "------------ <br>";
/*
echo "<pre>";
print_r($arr);
echo "</pre>"; 
*/
foreach($arr as $k => $val){
    echo "$k  〰️  $val <br>";
}

echo "<br>Sorted Array : <br>";
echo "------------------ <br>";
ksort($arr);
foreach($arr as $k => $val){
    echo "$k  〰️  $val <br>";
}

/* 
echo "<pre>";
print_r($arr);
echo "</pre>";
 */

?> 