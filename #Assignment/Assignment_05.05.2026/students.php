<?php

$students = [
    "Raju"    => 49,
    "Meena"    => 100,
    "Mithu"    => 79,
    "Lali"    => 59,
    "Munmun"    => 69,
];

function gradeChekcer($_Score){
    if($_Score >= 80){
        return "A";
    }elseif($_Score >= 70){
        return "B";
    }elseif($_Score >= 60){
        return "C";
    }elseif($_Score >= 50){
        return "D";
    }elseif($_Score < 50 ){
        return "F";
    }
}

$sn = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
</head>
<body>
    <table border=2 cellspacing="0" cellpadding="5" width="400" align="center">
        <tr>
            <th>SL No</th>
            <th>Name</th>
            <th>Score</th>
            <th>Grade</th>
        </tr>
        <?php foreach($students as $student => $score) : ?>
        <tr <?= $score === max($students) ? "style='background:#90EE90; text-align:center'" : "style='text-align:center'" ?>>
            <td><?= ++$sn; ?></td>
            <td><?= $student ?></td>
            <td><?= $score ?></td>
            <td><?= gradeChekcer($score); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>