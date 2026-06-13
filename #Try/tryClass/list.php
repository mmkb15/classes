<?php
$file = fopen("files/student.csv", "r");

$table_rows_html = "";
while ($student_row = fgetcsv($file)) {
    $table_rows_html .= "
    <tr>
       <td>{$student_row[0]}</td>
       <td>{$student_row[1]}</td>
       <td>{$student_row[2]}</td>
    </tr>
     ";
}
fclose($file);

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
        <?= $table_rows_html ?>
    </table>
</body>
</html>