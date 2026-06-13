<?php

/* 
1	Write a program in PHP which will validate a login registration system using form                                      

•	User name must be between 4 to 8 digit
•	must be ‘@’ symbol

1. create a login form(username field, submit) done
2. take the input (done)
3. save the input into a variable (done)
4. check the input length (done)
5. check the @ symbol  (done)
6. display a valid message

@dfasdf // 0 
df@asdf // 2
dfasdf // false

0 == false //true

0 === false // false

*/


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
if (isset($_POST["submit_btn"])) {
    $username = $_POST['username'];
    echo $username;
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
        <input type="text" name="username" id="username"><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <?= $msg ?? ""; ?>
</body>

</html>