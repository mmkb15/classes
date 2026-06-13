
<?php
/* 
3 Check whether a number is prime or not?

example  7
1,7 exclude 2,3,4,5,6


*/

if(isset($_POST['submit_btn'])){
    $number = $_POST['num'];
    // echo $number;

    $msg = "$number is a prime number.";
    for($i = 2; $i < $number; $i++){
        
        if(($number % $i) === 0){
            $msg = "$number is  not a prime number";
            break;
        }
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Number</title>
</head>
<body>
    <form action="" method="post">
        <label for="num">Number</label>
        <input type="number" name="num" id="num"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <?= $msg ?? ""; ?>
</body>
</html>