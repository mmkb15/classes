<?php

$arr = [
    1,
    2,
    3,
    4,
    5
];

echo"<pre>";
print_r(array_slice($arr,2,3));
echo"</pre>";


array_splice($arr,2,3,[8]);
echo"<pre>";
print_r($arr);
echo"</pre>";




?>