<?php
$msg = "";
if (isset($_GET["submit"])) {
    $grade = $_GET["num"];

    if ($grade == "A") {
        $msg = "excellent";
    } elseif ($grade == "B") {
        $msg = "good";
    } elseif ($grade == "C") {
        $msg = "fair";
    } elseif ($grade == "D") {
        $msg = "poor";
    } elseif ($grade == "F") {
        $msg = "failure";
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade</title>
</head>

<body>
    <form>
        <label>Enter Your Grade</label><br>
        <input type="text" name="num" id="num"><br><br>
        <button type="submit" name="submit">Submit</button>
        <p><?= $msg ?></p>
    </form>
</body>

</html>