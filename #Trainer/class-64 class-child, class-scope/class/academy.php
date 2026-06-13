<?php
require_once "user.php";

class Academy extends Trainee{
    public $session;
    public function __construct($_session, $_course, $_year, $_name, $_age){
        parent::__construct($_course, $_year, $_name, $_age);
        $this->session = $_session;
    }
}
?>