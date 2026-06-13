<?php
if(isset($_POST["submit_checkbox"])){
    // echo "<pre>";
    // print_r($_POST["check"]);
    // echo "</pre>";

    $skill = $_POST["check"] ?? [];
    $num = count($skill);
    if(count($skill) < 1){
        echo "<span style = 'color:red'> Please select at least on skill</span>";
    }else{
        echo "You Selected " . $num . " skill" .($num > 1 ? "s" : "");
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Validation</title>
</head>
<body>
    <form method="post">
        <input type="checkbox" name="check[]" value="1">1 <br>
        <input type="checkbox" name="check[]" value="2">2 <br> 
        <input type="checkbox" name="check[]" value="3">3 <br>
        <input type="checkbox" name="check[]" value="4">4 <br>
        <input type="checkbox" name="check[]" value="5">5 <br>
        <input type="submit" name="submit_checkbox" value="submit">
    </form>
</body>
</html>