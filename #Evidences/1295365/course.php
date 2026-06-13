<?php
require_once('db.php');


$sql = "
select c.*, t.name as teacher from teacher as t, course as c
where c.teacher_id = t.id;
";
$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// print_r($rows);

$result_view = $db->query("select * from vw_course");
$rows_view = $result_view->fetch_all(MYSQLI_ASSOC);
// print_r($rows);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
</head>
<body>

    <h2>View Course list</h2>
    <table border=1 width=500>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qualificaion</th>
            <th>Contact No</th>
        </tr>
    <?php foreach($rows_view as $item) :?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['fee'] ?></td>
            <td><?= $item['teacher'] ?></td>
        </tr>
    <?php endforeach; ?>
    </table>

    <h2>Course list</h2>
    <table border=1 width=500>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qualificaion</th>
            <th>Contact No</th>
        </tr>
    <?php foreach($rows as $item) :?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['fee'] ?></td>
            <td><?= $item['teacher'] ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>