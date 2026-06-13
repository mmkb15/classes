<?php
$arr = [
    "Apple",
    "Pencil",
    "Ball",
    "Gun",
];

echo"<pre>";
print_r($arr);
echo"</pre>";

usort($arr, function($a, $b) {
    return strlen($a) - strlen($b);
        #        (Apple)5     -     (Pencil)6 => -1; 
        #        (Pencil)6    -     (Ball)4 => 2; 
        #        (Ball)4      -     (Gun)3 => 1; 
});

echo"<pre>";
print_r($arr);
echo"</pre>";



?>