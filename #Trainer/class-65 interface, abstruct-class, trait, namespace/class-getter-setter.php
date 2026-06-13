<?php
class Person{
    private $name;
    protected $age;

    // ------ Getter and Setter (magic method) ------
    // public function __get($_pname){
    //     // echo "<p>Getter called</p>";
    //     return $this->$_pname;        
    // }
    // public function __set($_pname, $_pvalue){
    //     // echo "<p>Setter called</p>";
    //     $this->$_pname = $_pvalue;
    // }

    // ------ Getter and Setter (Custom) ------
    public function getAge(){
        return $this->age;
    }
    public function setAge($_age){
        $this->age = $_age;
    }
}
$person = new Person();
// ------ Getter and Setter (magic method) ------
// $person->name = "John";
// $person->age = 25;
// echo $person->name;
// echo "<br>";
// echo $person->age;

// ------ Getter and Setter (Custom) ------
$person->setAge(30);
echo $person->getAge();


?>