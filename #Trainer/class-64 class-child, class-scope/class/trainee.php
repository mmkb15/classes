<?php
require_once "user.php";

class Trainee extends User{
    public $course;
    public $year;
    public function __construct($_course, $_year, $_name, $_age){
        parent::__construct($_name, $_age);
        $this->course = $_course;
        $this->year = $_year;
    }
    public function info(){
        echo "Name: " . $this->name . "<br>";
        echo "Age: " . $this->age . "<br>";
        echo "Course: " . $this->course . "<br>";
        echo "Year: " . $this->year . "<br>";
    }
    public function test(){
        echo "Test from child class";
    }
}

$trainee = new Trainee("PHP", 2022, "Raju", 25);
$trainee->test();

?>