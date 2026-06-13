<?php
if(isset($_POST['submit_checkbox'])) {
    $skill = $_POST["check"] ?? [];
    // echo "<pre>";
    // print_r($_POST["check"]);
    // echo "</pre>";

    $num = count($skill);
    
    if($num < 1) {
        echo "<span style='color:red'>Please select at least one skill</span>";
    }else{
        echo "You selected " . $num . " skill" . ($num > 1 ? "s" : "");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="checkbox" name="check[]" value="1">1
        <input type="checkbox" name="check[]" value="2">2
        <input type="checkbox" name="check[]" value="3">3
        <input type="checkbox" name="check[]" value="4">4
        <input type="checkbox" name="check[]" value="5">5
        <input type="submit" name="submit_checkbox" value="submit">
    </form>
</body>
</html>