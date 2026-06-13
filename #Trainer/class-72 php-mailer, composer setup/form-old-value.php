<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="text" name="user" 
        value="<?php echo $_GET['user'] ?? ''; ?>">
        <input type="submit">
    </form>
</body>
</html>