<?php
require_once 'class/student.class.php';

if(isset($_POST['student_id'])){
    $id = $_POST['student_id'];
    $student = new Student($id);
    $msg = $student->result($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Student ID</label>
        <input type="search" name="student_id">
        <button type="submit">Search</button>
    </form>
    <?php if(isset($msg)) echo $msg; ?>
</body>
</html>