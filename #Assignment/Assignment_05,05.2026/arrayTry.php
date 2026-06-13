<?php

$arr = [
    "Std_01"    => "40",
    "Std_02"    => "50",
    "Std_03"    => "22",
    "Std_04"    => "50",
];

$max_score = max($arr); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>
    <table border=2 cellspacing="0" cellpadding="5" width="300" align=center>
        <tr>
            <th>Student Name</th>
            <th>Student Score</th>
        </tr>
        <?php foreach($arr as $name => $value): ?>
        <tr>
            <td><?=  $name ?></td>
            <td><?=  $value ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
    <h3>Height Mark <?= $max_score; ?></h3>
    <h3>Height Mark  get<?= array_search($max_score, $arr);?></h3>
</body>
</html>