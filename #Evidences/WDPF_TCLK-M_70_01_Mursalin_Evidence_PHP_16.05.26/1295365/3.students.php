<?php

$student_arr = [
    "Mursalin" => "35",
    "Masum" => "75",
    "Rion" => "90",
    "Safi" => "70",
    "Jaber" => "80",
]





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3. Students Result</title>
</head>
<body>
    <table border="1" width =300;>
        <tr>
            <th>Name</th>
            <th>Score</th>
        </tr>
        <?php foreach($student_arr as $name => $score) : ?>
            <tr>
                <td><?= $name;?></td>
                <td><?= $score;?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<br>
    <p>Student Name : <?= array_search(max($student_arr),$student_arr); ?></p>
    <p>Highest Mark : <?= max($student_arr); ?></p>
</body>
</html>