<?php
interface iTest1 {
    public function viewInfo();
    public function viewInfo2();
}
interface iTest2 {
    public function showText();
}
class ParentClass {
    public $address = "Dhaka";
}

class ChildClass extends ParentClass implements iTest1, iTest2 {
    public $name = "Mina";
    public $email = "T7oP5@example.com";
    private $is_active = true;

    public function viewInfo() {
        $status = $this->is_active ? "Active" : "Inactive";
        echo "Name: $this->name <br> Email: $this->email <br> Status: $status <br>";
    }
    public function viewInfo2() {
        echo "View Info 2 $this->is_active <br>";
    }
    public function showText() {
        echo "A static Message <br>";
    }
}

$child = new ChildClass();
$child->name = "Faysal";
$child->viewInfo();
$child->viewInfo2();
$child->showText();
echo $child->address;
?>