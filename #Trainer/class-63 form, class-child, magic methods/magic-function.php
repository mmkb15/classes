<?php
class User{
    // public string $name;
    // public int $age;
    // public function __construct(string $_name, int $_age){
    public $name;
    public $age;
    public function __construct($_name, $_age){
        $this->name = $_name;
        $this->age = $_age;
        echo "Construct called <br>";
    }
    function __toString(){
        echo "ToString called <br>";
        return $this->name . " " . $this->age;
    }
    public function __destruct()
    {
        echo "Destruct called <br>";
    }
    function test(){
        echo "Hello";
    }
}
$user = new User("Raju", 25);
echo $user;
unset($user);
// echo $user->name;
// echo $user->age;
// $user->test();

?>