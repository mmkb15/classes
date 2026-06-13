<?php
/* 
7	Create a program that reads a grade, A, B, C, D or F and then print “excellent,” “good,” “fair,” “poor,” or “failure.” Use the else if structure.  

*/



if(isset($_POST['submit_btn'])){
    $sel_grade = $_POST['grade'];
    $grade = strtoupper(trim($sel_grade));

    // echo $grade;

    if($grade == 'A'){
        $msg = 'Excellent';
    }
    elseif($grade == 'B'){
        $msg = 'Good';
    }
    elseif($grade == 'C'){
        $msg = 'Fair';
    }
    elseif($grade == 'D'){
        $msg = 'Poor';
    }
    elseif($grade == 'F'){
        $msg = 'Failure';
    }else{
        $msg = 'Invalid Grade! Please enter A, B, C, D or F only.';
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Result Finder</title>
</head>
<body>
    <form action="" method="post">
        <label for="grade">Enter Your Grade (A, B, C, D or F):</label><br>
        <input type="text" name="grade" id="grade" maxlength="1" style="text-transform:uppercase;" required><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <h3><?= $msg ?? ""; ?></h3>
</body>