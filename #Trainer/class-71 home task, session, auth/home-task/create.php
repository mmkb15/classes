<?php
require_once("files/student.class.php");
if(isset($_GET["add_student"])){
    $id = $_GET["id"];
    $name = $_GET["name"];
    $batch = $_GET["batch"];
    // echo "ID: $id,<br> Name: $name,<br> Batch: $batch";
    $s = new Student($id, $name, $batch);
    $msg = $s->save();
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
    <nav>
        <a href="create.php">New Student</a>
        | 
        <a href="list.php">Students List</a>
        | 
        <a href="search.php">Find Student</a>
    </nav>
    <h3>Add new student</h3>
    <h5 style="color:green;"><?php echo $msg ?? ""; ?></h5>
    <form action="" method="GET">
        <label for="id">ID</label><br>
        <input type="text" name="id" id="id"><br><br>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name"><br><br>
        <label for="batch">Batch</label><br>
        <input type="text" name="batch" id="batch"><br><br>
        <button type="submit" name="add_student">Save</button>
    </form>
</body>
</html>