<?php
require_once "class/user.php";
$user = new User("Raju", 15);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>    
    <h1>Voting Status</h1>
    <h3><?php echo $user->checkAge(); ?></h3>
</body>
</html>