<?php
$arr = [
            ['id' => 1, 'name' => 'Mina', 'batch' => '61'],
            ['id' => 2, 'name' => 'Raju', 'batch' => '62'],
            ['id' => 3, 'name' => 'C', 'batch' => '63'],
            ['id' => 4, 'name' => 'D', 'batch' => '64'],
            ['id' => 5, 'name' => 'E', 'batch' => '65']
        ];
class Student {
    public $id;
    public $name;
    public $batch;
    public function __construct($_id, $_name="", $_batch=""){
        $this->id = $_id;
        $this->name = $_name;
        $this->batch = $_batch;
    }
    public function result($_id){
    global $arr;
       foreach($arr as $item){
        if($item['id'] == $_id){
            $res = "ID: {$item['id']} <br>";
            $res .= "Name: {$item['name']} <br>";
            $res .= "Batch: {$item['batch']} <br>";
            return $res;
        }
       }            
    }
}
?>