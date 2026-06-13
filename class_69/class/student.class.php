<?php

$std_arr = [
    ["id" => 1, "name" => "Rafi", "batch"   => "60"],
    ["id" => 2, "name" => "Meena", "batch"  => "70"],
    ["id" => 3, "name" => "Jaber", "batch"  => "80"],
];


class Student{
    public $id;
    public $name;
    public $batch;
    public function __construct($_id, $_name="", $_batch=0){
        $this->id   = $_id;
        $this->name = $_name;
        $this->batch= $_batch;
    }
    public function result($_id){
        global $std_arr;
        foreach($std_arr as $item){
            print_r($item);
            if($item['id'] == $_id){
                $res     = "ID: {$item['id']}<br>";
                $res    .= "Name: {$item['name']}<br>";
                $res    .= "Batch: {$item['batch']}<br>";
                return $res;
            }
        }
    }
}




?>