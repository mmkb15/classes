<?php
if (isset($_POST["submit_btn"])) {
    $username = $_POST['username'];
    if (strpos($username, "@") === false) {
        $msg = '<p style="color:red;">Username must be ‘@’ symbol</p>';
    } elseif (strlen($username) < 4 || strlen($username) > 8) {
        $msg = '<p style="color:red;">Username must be between 4 to 8 digit</p>';
    } else {
        $msg = '<p style="color:green;">Username is valid</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Username Validation</title>
</head>

<body>
    <form action="" method="post">
        <label for="">Username</label><br>
        <input type="text" name="username" id="username" value="<?= $_POST['username'] ?? "@fahmi" ?>"><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <?= $msg ?? ""; ?>
</body>

</html>