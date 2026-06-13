<?php
class Student{
    public $id;
    public $name;
    public $batch;
    function __construct($_id=null, $_name="", $_batch=""){
        $this->id = $_id;
        $this->name = $_name;
        $this->batch = $_batch;
    }    
    function showAll(){
        $file = fopen(__DIR__ . "/student.csv", "r");
        $html = "";
        while($row = fgetcsv($file)){
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
            $html .= "<tr>";
            $html .= "<td>$row[0]</td>";
            $html .= "<td>$row[1]</td>";
            $html .= "<td>$row[2]</td>";
            $html .= "</tr>";
        }
        fclose($file);
        return $html;
    }
    function save(){
        $file = fopen(__DIR__ . "/student.csv", "a+");
        fputcsv($file, [$this->id, $this->name, $this->batch]);
        fclose($file);
        return "Data saved successfully!";
    }
    function result($_id){
        $file = fopen(__DIR__ . "/student.csv", "r");        
        while($row = fgetcsv($file)){
            if($row[0] == $_id){
                return "ID: $row[0],<br>Name: $row[1],<br>Batch: $row[2]";
            }
        }
        fclose($file);
        return "Data not found!";
    }
}

// $s = new Student();
// echo $s->showAll();
?>