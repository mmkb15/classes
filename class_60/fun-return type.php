<?php
function add(int $a, int $b): array {
    $sum = $a + $b . "<br>";
    return [$a, $b];
}

/* echo add(1,2);
echo add(43,2); */
echo"<pre>";
print_r(add(1,2));
echo"<br>";
var_dump(add(1,"3"));

echo"</pre>";
?>