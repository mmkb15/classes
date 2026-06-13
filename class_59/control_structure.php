<?php

/* 

    1. Condition
        a. if
        b. if-else
        c. if-elseif-else
        d. switch

    2. Loop
        a. while
        b. do-while
        c. for
        d. foreach

*/

/* ------------Condition---------- */
    // if and else
    $x = 10; 
    if($x > 5){
        echo "X is greater than 5";
    }else {
        echo "X is  less than 5";
    }

echo"<br>==================<br>";
    // if , elseif and else
    $y = 5;
    if($y > 0){
        echo "Y is positive number";
    }elseif($y < 0){
        echo "Y is neative number";
    }else{
        echo "Y is zero";
    }

echo"<br>==================<br>";
    // switch 
    $day = "Friday";

    switch($day){
        case "Sunday":
            echo "First day of the week";
            break;
        
        case "Monday":
            echo "Second day of the week";
            break;
        
        case "Tuesday":
            echo "Thired day of the week";
            break;
        
        case "Wednesday":
            echo "Forth day of the week";
            break;
        
        case "Thrusday":
            echo "Last day of the week";
            break;
        
        case "Friday":
            echo "Weekend the week";
            break;
        
    }

echo"<br>==================<br>";

/* -------------Loop------------ */
    // for
    for($i = 0; $i < 10; $i++){
        // if($i == 5) continue;
        if($i == 5) break;
        echo $i. "<br>";
    }

echo"<br>==================<br>"; 
    // while
    $z = 5;
    while($z > 0){
        echo $z."<br>";
        $z--;
    }
    // echo "<br> $z";

echo"<br>==================<br>";
    // // do while
    do{
        echo "Do while z = ". $z . "<br>";
        $z--;
    }while($z > 0 );

echo"<br>==================<br>";
    // foreach loop
    $arr = array("a","b","c","d","e","f",);

    // only we want value
    foreach( $arr as $v){
        echo $v."<br>";
    }
    echo"<br>==================<br>";
    // when we want key or index number and value
    foreach( $arr as $k => $v){
            echo $k . " : " . $v . "<br>"; 
    }


?>