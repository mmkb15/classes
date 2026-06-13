<?php

class PersonInfo {
    public $name = "John";
    public $age = 30;

    public function info(){
        $age =  "Age : " . $this->age . "<br>";
        return $age;
        echo "Name : " . $this->name . "<br>";
    }
}

$person = new PersonInfo();
$person->name = "Raju";
echo $person->info();
echo $person->name ."<br>";

echo "<pre>";
print_r($person);
echo "</pre>";


$arr_assoc = [
    "name"=> "noname",
    "age"=> 45,
];
echo "<pre>";
print_r($arr_assoc);
echo "</pre>";







?>