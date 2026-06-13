<?php

require_once 'class/student.class.php';

if(isset($_POST["student_id"])){
    $id = $_POST["student_id"];
    $student = new Student($id, "", "");
    $msg = $student->result($id);
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serach</title>
</head>
<body>
    <form action="" method="post">
        <label for="student_id">Student ID : </label>
        <input type="search" name="student_id" id="student_id">
        <button type="submit" name="search_btn">Search</button>
    </form>
    <h3><?= $msg ?? "" ?></h3>
</body>
</html>