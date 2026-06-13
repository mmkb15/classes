<?php

interface iTest{
    public function viewInfo();
}

interface iTesTow{
    public function viewInfo();
}

class ChildClass implements iTest, iTesTow {
    public $name = "Mina";
    public $email = "test@mail.com";

    public function viewInfo() {
        echo "Name : $this->name <br> Email : $this->email <br>";
    }

    public function showText() {
        echo "A static Message <br>";
    }
}

$mina = new ChildClass();
$mina -> viewInfo();

?>