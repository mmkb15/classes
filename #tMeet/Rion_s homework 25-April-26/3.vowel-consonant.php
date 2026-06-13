<?php
$str = 'the quick brown fox jumps over the lazy fox';
$vowels = ['a', 'e', 'i', 'o', 'u'];
$consonant = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'];
$vowelCount = 0;
$consonantCount = 0;

for ($i = 0; $i < strlen($str); $i++) {
    if (in_array($str[$i], $vowels)) {
        $vowelCount++;
    } elseif (in_array($str[$i], $consonant)) {
        $consonantCount++;
    }
}
echo "The string is: " . $str . "<br>";
echo "there are " . $vowelCount . " vowels in this sentence" . "<br>";
echo "there are " . $consonantCount . " consonants in this sentence";
