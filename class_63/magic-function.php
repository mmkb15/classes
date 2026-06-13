<?php
class User{
    public string $name;
    public int $age;


    public function __construct(string $_name, int $_age= 0){
    $this->name = $_name;
    $this->age = $_age; 
        echo"Construct called <br>";
    }

    public function __toString()
    {
        echo "ToString called <br>";
        return $this->name . " " .$this->age;
    }

    public function destruct()
    {
        echo "Destruct called <br>";
        return "Bye";
    }


};

$user = new User("raju");
echo $user->name;
echo $user->age;





?>