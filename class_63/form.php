<?php





/* echo "<br><br><hr>";
echo isset($_POST["username"]) ? $_POST["username"] : "Username not found";
echo "<br>";
echo "Email : " . $_POST["email"];
echo "<br><hr><br><br>"; */
$email = "";
if(isset($_POST["signup_btn"])) {
    $email = $_POST["email"];
    echo "<br><hr>";
    echo "Email : " . $_POST["username"];
    echo "<br>";
    echo "Email : " . $_POST["email"];
    echo "<br><hr>";

    echo "<br><hr>";
    echo"<pre>";
    print_r($_POST);
    echo"</pre>";
    echo "<hr><br>";

}

/* if(isset($_POST["signup_btn_2"])) {
    echo "<br><hr>";
    echo "Email : " . $_POST["username"];
    echo "<br>";
    echo "Email : " . $_POST["email"];
    echo "<br><hr>";

    echo "<br><hr>";
    echo"<pre>";
    print_r($_POST);
    echo"</pre>";
    echo "<hr><br>";

}
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <hr>
    <form action="" method="POST">
        <label for="username">User Name</label><br>
        <input type="text" name="username" id="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : "" ?>"><br><br> 
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" value="<?= $email ?>"><br><br> 

        <button type="submit" name="signup_btn">Submit</button>
    </form>
    <hr>

<!--     
    <hr>
    <form action="" method="POST">
        <label for="username">User Name</label><br>
        <input type="text" name="username" id="username" value="MK-B15"><br><br> 
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" value="nomail@gmail.com"><br><br> 

        <button type="submit" name="signup_btn_2">Submit</button>
    </form>
    <hr> -->


</body>
</html>