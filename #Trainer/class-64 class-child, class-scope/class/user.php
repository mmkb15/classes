<?php
class User{
    public $name;
    public $age;
    public function __construct($_name, $_age){
        // echo "Constructor method called";
        $this->name = $_name;
        $this->age = $_age;
    }
    function test(){
        echo "Test from parent class";
    }
    public function checkAge(){
        if($this->age >= 18){
            return "You are eligible to vote";
        }else{
            return "You are not eligible to vote";
        }
    }
    function info(){
        return "Name: " . $this->name . "<br>Age: " . $this->age . "<br>";
    }
}

new User("Raju", 25);

?>