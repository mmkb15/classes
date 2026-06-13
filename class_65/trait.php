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
    // use Opertaion;

    public $num1;
    public $num2;
}

$result = new Result();

echo $result->add(5, 5);
echo "<br>";

echo $result->sub(5, 5);
echo "<br>";

echo $result->mul(5, 5);
echo "<br>";

echo $result->div(5, 5);
echo "<br>";

echo $result->power(5, 5);
echo "<br>";

echo $result->mod(5, 5);
echo "<br>";











?>