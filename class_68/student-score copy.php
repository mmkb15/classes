<?php

$arr = [
    "Dadi" => 40,
    "Raju" => 20,
    "Rina" => 77,
    "Dipu" => 00,
    "Meena" => 100,
    // "Mithu" => 56,
    // "Lali" => 50,
    // "Munmun" => 70,
    "Raita" => 60,
];

$max_socre = max($arr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>
    <table border ="1" cellpadding="6" cellspacing="0" width="200" align= "center">
        <thead>
            <tr align="center">
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arr as $name => $value){
                echo "<tr align='center'>
                    <td>$name</td>
                    <td>$value</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <h2 align=center>Student Name : <?= array_search($max_socre, $arr) ?></h2>
    <h2 align=center>Higest Score is : <?= $max_socre; ?></h2>
</body>
</html>