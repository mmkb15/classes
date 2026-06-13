<?php
class Person {
    private $name;
    protected $age;

/*     public function __get($_pName){
        return $this -> $_pName;
    }
    public function __set($_pName, $_pValue){
        $this -> $_pName = $_pValue;
    }
 */


    public function getAge(){
        return $this -> age;
    }
    public function setAge($_age){
        $this -> age = $_age;
    }


}
/* 
$person = new Person();
$person -> name = "John <br>";
$person -> age = 25;

echo $person -> name;
echo $person -> age;

*/
$person = new Person();
echo $person -> getAge();
$person -> setAge(30);













?>