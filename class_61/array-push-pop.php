<?php
$arr = ["mina", "raju", "mithu"];

echo"<pre>";
print_r($arr);
echo"</pre>";

#push
array_push($arr, "Dipu", "Rita");

echo"<pre>";
print_r($arr);
echo"</pre>";

#pop
array_pop($arr);
array_pop($arr);

echo"<pre>";
print_r($arr);
echo"</pre>";

#shift
array_shift($arr);

echo"<pre>";
print_r($arr);
echo"</pre>";

#unshift
array_unshift($arr,"faysal","jaber");

echo"<pre>";
print_r($arr);
echo"</pre>";


?>