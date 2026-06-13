<?php

// if(isset($_POST["submit"])){
//   $id = $_POST["id"] ?? "";
//   $name = $_POST["name"] ?? "";
//   $batch = $_POST["batch"] ?? "";


//   $file = fopen("files/student.csv", "a+");
//   fputcsv($file, [$id, $name, $batch]);
//   fclose($file);
//   $msg = "<p>
//         ID      :   {$id}<br>
//         Name    :   {$name}<br>
//         Batch   :   {$batch}  
//         </p>";
// }


require_once("files/student.class.php");

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $batch = $_POST["batch"];
    // echo "ID: $id,<br> Name: $name,<br> Batch: $batch";
    $stdCreate = new Student($id, $name, $batch);
    $msg = $stdCreate->save();
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
    <form action="" method="POST">
        <label for="id">ID</label><br>
        <input type="number" name="id" id="id"><br><br>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name"><br><br>
        <label for="batch">Batch</label><br>
        <input type="number" name="batch" id="batch"><br><br>
        <?= $msg ?? "" ?>
        <button type="submit" name="submit">Save</button>
    </form>
</body>
</html>