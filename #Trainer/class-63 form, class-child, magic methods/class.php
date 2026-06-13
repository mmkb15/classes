<?php
class PersonInfo {
    public $name = "John";
    public $age = 25;
    public function info(){
        echo "Name: " . $this->name . "<br>";
        echo "Age: " . $this->age . "<br>";
    }
}
$person = new PersonInfo();
$person->info();
echo $person->age;
$person->name = "Raju";
echo $person->name;
$person->info();


// $arr = [1, 2, 3];
// echo "<pre>";
// print_r($person);
// print_r($arr);
// echo "</pre>";

?>

