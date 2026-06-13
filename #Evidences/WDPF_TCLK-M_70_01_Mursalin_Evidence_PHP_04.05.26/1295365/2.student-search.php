<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2. Student Search</title>
</head>

<body>
    <form method="post">
        <label for="id">Give Student ID</label><br>
        <input type="number" name="id" id="id"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
</body>
</html>

<?php
$students = [
    "1" => [
        "name" => "Fahim",
        "batch" => "68"
    ],
    "2" => [
        "name" => "Khairul",
        "batch" => "70"
    ],
    "3" => [
        "name" => "Jaber",
        "batch" => "69"
    ]
];

class Student
{
    public $id;
    public $name;
    public $batch;

    function __construct($_id)
    {
        global $students;
        $this->id = $_id;
        $this->name = $students[$_id]["name"];
        $this->batch = $students[$_id]["batch"];
        /* echo $this->name;
        echo "<br>";
        echo $this->id;
        echo "<br>";
        echo $this->batch; */
        $this-> info();
    }

    function info() {
        echo "
        <b>Student id:</b> {$this->id}<br>
        <b>Student Name:</b> {$this->name}<br>
        <b>Student Batch:</b> {$this->batch}<br>
        ";
    }
}

if(isset($_POST["submit_btn"])) {
    if(!empty($_POST["id"])){
        $student = new Student($_POST["id"]);
    }
}



?>