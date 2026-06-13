<?php
class Student
{
    public $id;
    public $name;
    public $batch;

    function __construct($_id = "", $_name = "", $_batch = "")
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->batch = $_batch;
    }

    function searchStudent($_id)
    {
        $file = fopen("student.csv", "r");

        while ($row = fgetcsv($file)) {
            if ($_id == $row[0]) {
                return "
                Id: $row[0] <br>
                Name: $row[1] <br>
                Batch: $row[2] <br>
                ";
            }
        }

        fclose($file);
    }
}


if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $student = new Student();
    $msg = $student->searchStudent($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Enter id</label><br>
        <input type="search" name="id"><br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <p><?= $msg ?? "" ?></p>
</body>

</html>