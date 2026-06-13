<?php
function hello(){
    static $x = 0;
    $x++;
    echo $x;
}

hello();
hello();
hello();

?>