<?php
trait Calculate{
    public function add($a, $b){
        return $a + $b;
    }
    public function sub($a, $b){
        return $a - $b;
    }
    public function mul($a, $b){
        return $a * $b;
    }
    public function div($a, $b){
        return $a / $b;
    }
}
trait Operation{
    public function power($a, $b){
        return $a ** $b;
    }
    public function mod($a, $b){
        return $a % $b;
    }
}

class Result {
    use Calculate, Operation;
    // use Operation;

    public $num1;
    public $num2;
}
$result = new Result();
echo $result->MUL(10, 2);
echo "<br>";
echo $result->power(2, 3);
?>