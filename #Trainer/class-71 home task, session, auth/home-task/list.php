<?php
require "files/student.class.php";
// echo __DIR__;
$s = new Student();
$data = $s->showAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <a href="create.php">New Student</a>
        | 
        <a href="list.php">Students List</a>
        | 
        <a href="search.php">Find Student</a>
    </nav>
    <h3>Student List</h3>
    <table border="1" width="400">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Batch</th>
        </tr>
        <?php echo $data ?? ""; ?>
    </table>
</body>
</html>