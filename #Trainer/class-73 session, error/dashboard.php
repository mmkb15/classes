<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}
if(isset($_POST['logout'])){
    session_unset();
    header("Location: login.php");
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
    <nav>
        <a href="dashboard.php">Dashboard</a> | 
        <a href="report.php">Report</a> | 
        <form method="POST" style="display: inline-block;">
            <input type="submit" name="logout" value="Logout">
        </form>
    </nav>
    <h1>Dashboard Page</h1>
</body>
</html>