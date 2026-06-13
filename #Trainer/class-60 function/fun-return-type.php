<?php
function add(int $a, int $b): array {
    $sum = $a + $b . "<br>";
    return [$a, $b, "text"];
}
function test(): void {
    echo "Hello";
}
// echo add(1, 2);
// echo add("50", 20);

echo "<pre>";
print_r(add(1, 2));
var_dump(add("50", 20));
echo "</pre>";

?>