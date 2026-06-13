<?php

$arr = [
    "Musralin" => 42,
    "Shafi" => 38,
    "Masum" => 46,
    "Jaber" => 42,
    "Roksana" => 36
];

$maxMsg = "{}";
$score = array_values($arr);
$hihgestScore = max($score);
$hihgestScorer= array_search($hihgestScore, $arr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Score</th>
        </tr>
        <?php 
         foreach($arr as $name => $score) {
            echo "
            <tr>
            <td>{$name}</td>
            <td>{$score}</td>
            </tr>
            ";
         }
        ?>
    </table>
    <p>Highest score is <?= $hihgestScore ?> by <?=  $hihgestScorer ?></p>
</body>
</html>