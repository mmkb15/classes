<?php
$str = 'Hello World! Hello Bangladesh';

echo substr($str, 6, -1);
echo '<br>';
echo strlen($str);
echo '<br>';
var_dump(strpos($str, 'h'));
echo '<br>';
var_dump(stripos($str, 'h'));
echo '<br>';
$newstr = str_ireplace('hello', 'Hi', $str);
$newstr = str_replace('Bangladesh', 'US', $newstr);
echo $newstr;
echo '<br>';
echo strtolower($str);
echo '<br>';
echo strtoupper($str);
echo "<br>";

$html= htmlspecialchars("<h1 style='font-size:2000px'>Hello 💕💕💕💕</h1>");
// $html= htmlentities("<h1 style='font-size:2000px'>Hello 💕💕💕💕</h1>");
echo $html;
echo "<br>";

?>