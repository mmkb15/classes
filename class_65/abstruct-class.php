<?php

abstract class test {
    public $name ="Rakibul";
    public function getName() {
        return $this -> name;
    }
    abstract public function getAge();
    abstract public function viewDetails();
}

class Person extends Test{
    public $age = 25;

    public function getAge(){
        echo $this -> age;
    }
    
    public function viewDetails(){
        echo "<br>Name : " . $this -> name . "<br> Age : " . $this -> age . "<br>";
    }

}

$person = new Person();
$person -> getAge();
$person -> viewDetails();
echo $person -> getName();


?>