<?php
/* 
1	Write a program in PHP which will validate a login registration system using form                                      

•	User name must be between 4 to 8 digit
•	must be ‘@’ symbol


- create login form(input,submit)
- take the input and save it to a varibale and test it...1st check is form here


Syntax
strpos(string,find,start)




 */
// echo'<pre>';
// print_r($_POST);
// echo '</pre>';

if(isset($_POST['submit_btn'])){
    $username = $_POST['username'];
    // echo $username;
    // var_dump(strpos($username,'@') === false);
    // var_dump(strlen($username) < 4);
    if(strpos($username,'@') === false){    #strpos(string,find,start)
        $msg = '<p style="color:red;">Username must be ‘@’ symbol</p>';
    }elseif(strlen($username) < 4 || strlen($username) > 8){
        $msg = '<p style="color:red;">Username must be between 4 to 8 digit</p>';
    }else {
        $msg = '<p style="color:green;">Username Valid<p>';
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
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username"><br><br>
        <button type="submit" name="submit_btn">Submit</button>
    </form>
    <?= $msg ?? "";?>
</body>
</html>