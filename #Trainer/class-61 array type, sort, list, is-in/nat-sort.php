<?php
$arr = ["picture1.jpg", "image20.jpg", "picture10.jpg", "Picture2.jpg"];
echo "<pre>";
print_r($arr);
echo "</pre>";

natsort($arr);  // case sensitive
echo "<pre>";
print_r($arr);
echo "</pre>";

natcasesort($arr);  // case insensitive
echo "<pre>";
print_r($arr);
echo "</pre>";

?>