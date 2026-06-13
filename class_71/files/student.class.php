<?php
class Student{
    public $id;
    public $name;
    public $batch;

    function __construct($_id = null, $_name = "", $_batch = ""){
        $this->id       = $_id;
        $this->name     = $_name;
        $this->batch    = $_batch;
    }

    function showAll(){
        $file = fopen(__DIR__ . "/student.csv","r");
        $html = "";
        while($row = fgetcsv($file)){
            $html .="<tr>";
            $html .="<td>{$row[0]}</td>";
            $html .="<td>{$row[1]}</td>";
            $html .="<td>{$row[2]}</td>";
            $html .="</tr>";
        }
        return $html;
    }

    function save(){
        $file = fopen(__DIR__ . "/student.csv", "a+");
        fputcsv($file, [$this->id, $this->name, $this->batch]);
        fclose($file);
        return "<p style='color:green'>Data Saved Successfully!<p>
                Id : {$this->id}<br>
                Name : {$this->name}<br>
                Batch : {$this->batch}<br>
                
                ";
    }

    function result($_id){
        $file = fopen(__DIR__ . "/student.csv", "r");
        while($row = fgetcsv($file)){
            if($row[0] == $_id){
                return 
                "
                ID: {$row[0]} <br>
                Name: {$row[1]} <br>
                Batch: {$row[2]} <br>
                ";
            }
        }
        fclose($file);
        return "Data Not Found";
    }
    
}

// echo __DIR__;
?>