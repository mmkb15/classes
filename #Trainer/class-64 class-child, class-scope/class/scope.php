<?php
class User{
    public $name;
    public $age;
    protected $address = "Dhaka";
    private $password = "1234";
    static $country = "Bangladesh";

    public function __construct($_name, $_age){
        // echo "Constructor method called";
        $this->name = $_name;
        $this->age = $_age;
    }
    final function test(){
        echo "Test from parent class";
    }
    public static function checkAge($_age=0){
        // if(User::$age >= 18){
        if($_age >= 18){
            return "You are eligible to vote";
        }else{
            return "You are not eligible to vote";
        }
    }
    function info(){
        return "Name: " . $this->name . "<br>Age: " . $this->age . "<br>";
    }
}
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
        echo "Address: " . $this->address . "<br>";
        // echo "Password: " . $this->password . "<br>";
    }
    // public function test(){
    //     echo "Test from child class";
    // }
}

// $user = new User("Raju", 25);
// // $user->password;
// $user->test();
// echo $user->checkAge();

$trainee = new Trainee("PHP", 2022, "Raju", 25);
// $trainee->info();
// echo $trainee->address;
$trainee->test();

// function show(){
//     echo "Show function called";
// }
// show();

// const PI = 3.14;
// define("PI", 3.14);

// echo User::checkAge(65);
// echo User::$country;

?>