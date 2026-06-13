<?php
class User{
    public $name;
    public $age;
    public function __construct($_name, $_age){
        $this->name = $_name;
        $this->age = $_age;
    }

    public function test(){
        echo "Test form parent class";
    }
}

class Trainee extends User{
    public $course;
    public $year;
    public function __construct($_course, $_year, $_name, $_age=0){
        parent::__construct($_name, $_age);
        $this->course = $_course;
        $this->year = $_year;
    }

    public function info(){
        echo "Name : " . $this->name . "<br>";
        echo "Age : " . $this->age . "<br>";
        echo "Course : " . $this->course . "<br>";
        echo "Year : " . $this->year . "<br>";
    }

}

class Academy extends Trainee{
    public $session;
    public function __construct($_session, $_course, $_year, $_name){
        parent:: __construct($_course, $_year, $_name);
        $this->session = $_session;
    }
}

/* 
$Shahed = new Trainee("WDPF", 2026, "Shahed", 25);
$Mursalin = new Trainee("WDPF", 2026, "Mursalin", 29);

$Shahed->info();
echo "<br>";
$Mursalin->info();
*/

$academy = new Academy(2020, "PHP", 2026, "raju", 25);
$academy->info();
$academy->test();





?>