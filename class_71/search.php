<?php


require_once("files/student.class.php");

if(isset($_POST["id"])){
    echo $_POST["id"];
    $search = new Student();
    $result = $search->result($_POST["id"]);

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
    <h3>Find student by ID</h3>
    <form action="" method="post">
        <input type="search" name="id" id="id">
        <button type="submit">Search</button>
    </form>
    <?= $result ?? "";  ?>
</body>
</html>