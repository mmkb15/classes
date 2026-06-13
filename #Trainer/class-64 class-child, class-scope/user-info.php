<?php
require_once "class/user.php";
$user = new User("Raju", 25);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User Details</h1>
    <p><?php echo $user->info(); ?></p>
</body>
</html>