<?php

// function defination
function test($text, $text2="") {
    echo "Hello " . $text2 . " " . $text . "<br>";
}

// function calling
test("World", "2026");

// anonymous function / function expression
$funExp = function () {
    echo "Hello BD<br>";
};

$funExp();

?>