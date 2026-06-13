<?php
class User{
    public $name;
    public $age;
    protected $address = "Dhaka";
    private $password = "1234";
    public function __construct($_name, $_age){
        $this->name = $_name;
        $this->age = $_age;
    }
    // when use final in parent class the child class not overrite this method 
    final function test(){
        echo "Test form parent class<br>";
        echo "Year : " . $this->address . " - form parent class<br>";
        echo "Year : " . $this->password . " - form parent class<br>";
    }

    public static function CheckAge($_age = 0){
        if($_age >= 18){
            return "Your are elagible<br>";
        }else {
            return "Your are not elagible<br>";
        }
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
        echo "Test form parent class<br>";
        echo "Name : " . $this->name . "<br>";
        echo "Age : " . $this->age . "<br>";
        echo "Course : " . $this->course . "<br>";
        echo "Year : " . $this->year . "<br>";
        echo "Year : " . $this->address . " - form child class<br>";
        // echo "Year : " . $this->password . " - form child class<br>";

    }
    // public function test(){
    //     echo "Test form Child class<br>";
    // }

}


/* 

$user->test();
echo"<br>";
$trainee->info();
 */
/* 
$user->passwrod;
$user->address;
$trainee->passwrod;
$trainee->address;

 */
// $trainee = new Trainee("PHP",2022,"Raju", 25);
// $trainee->test();

$user = new User("Raju", 25);
$user->test();
/* 
// by creating instance
$user = new User("Raju", 25);
$user->test();
echo $user->CheckAge(22); //Your are elagible


// Without instance
echo User::CheckAge();       //Your are not elagible
echo User::CheckAge(11);    //Your are not elagible
echo User::CheckAge(111);  //Your are elagible
 */

?>

