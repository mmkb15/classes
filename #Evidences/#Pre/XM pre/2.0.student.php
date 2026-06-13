<?php
/* 
2.Create a class named student where fields are id, name, batch and one method result which will take id as parameter and search the corresponding result from a file and print result. Must use constructor to initialize the data and print a result.                                             1. create a class using three properties (done)
    2. use constructer for properties (done)
    3. create an form
    4. add a method for searching student fron file
     4.1 select file
     4.2 search if any id mathes
     4.3 show the detail of matched id 
    5. create an instance
    
*/

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
        // echo $_id;
        $file = fopen("student.csv", "r");
        // var_dump(fgetcsv($file));
        // print_r(fgetcsv($file));
        // var_dump(fgetcsv($file));
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