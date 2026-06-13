<?php
// Numaric / Index Array 
$arr = [
    "Cat",
    "Zoo",
    "Dog",
    "Ball",
    3,
    5,
    3.3,
    -5,
    -5.3,
    "Gun",
];

// Numaric / Index Array print
echo("===== Numaric Array =====");
echo"<pre>";
print_r($arr);
echo"</pre>";

// Numaric array sorts 
sort($arr); #Numaric array sort in ascending order
echo("<br>===== Numaric Array Sort Ascending Order =====");
// array print
echo"<pre>";
print_r($arr);
echo"</pre>";

// Numaric array sorts reverse
rsort($arr); #Numaric array sort in descending order
echo("<br>===== Numaric Array Sort Decending Order =====");
// array print
echo"<pre>";
print_r($arr);
echo"</pre>";



/* #why $arr show this values when $arr variable define previously
$arr = [
    "Bangladesh" => "Dhaka",
    "USA" => "Washingoton",
    "Nepal" => "Kathmandu",
    "Pakistan" => "Islamabad",
    "UK" => "London",
];

sort($arr);
echo"<pre>";
print_r($arr);
echo"</pre>";

 */



// Accosciative Array
$arr_assoc = [
    "Bangladesh" => "Dhaka",
    "USA" => "Washingoton",
    "Nepal" => "Kathmandu",
    "Pakistan" => "Islamabad",
    "UK" => "London",
];

// accosciative array value sort
asort($arr_assoc); #Assocaitive Array sort(value) in Ascending order
echo("<br>===== Associative Array Value Sort Ascending Order =====");
// array print
echo"<pre>";
print_r($arr_assoc);
echo"</pre>";

// accosciative array value sorts reverse
arsort($arr_assoc); #Associtive Array sort(value) in descending order
echo("<br>===== Associative Array Value Sort Descending Order =====");
// array print
echo"<pre>";
print_r($arr_assoc);
echo"</pre>";

// accosciative array key sort
ksort($arr_assoc); #Associtive Array sort(key) in Aescending order
echo("<br>===== Associative Array Key Sort Ascending Order =====");
// array print
echo"<pre>";
print_r($arr_assoc);
echo"</pre>";

// accosciative array key sorts reverse
krsort($arr_assoc); #Associtive Array sort(key) in descending order
echo("<br>===== Associative Array Key Sort Descending Order =====");
// array print
echo"<pre>";
print_r($arr_assoc);
echo"</pre>";





$arr2 = [
    "picture1.jpg",
    "20 picture20.jpg",
    "Picture10.jpg",
    "picture2.jpg",
    "image2.jpg",
    ];

sort($arr2);
echo"<pre>";
print_r($arr2);
echo"</pre>";

natsort($arr2);
echo"<pre>";
print_r($arr2);
echo"</pre>";

natcasesort($arr2);
echo"<pre>";
print_r($arr2);
echo"</pre>";


?>