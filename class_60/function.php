<?php

function hello($arg1, $arg2 = ""){
    echo "Hello " . $arg2 . " " . $arg1  . "........"; // Hello 2026 World
}

// function calling
hello("World ", "2026");



?>