<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="send-mail.php" method="POSt">
        <label for="">Email</label><br>
        <input type="text" name="email"><br><br>
        <label for="">Subject</label><br>
        <input type="text" name="subject"><br><br>
        <label for="">Message</label><br>
        <textarea name="msg"></textarea><br><br>
        <input type="submit" value="Send Mail">
    </form>
    <h5 style="color:green"><?php echo $_GET['msg'] ?? ""; ?></h5>
</body>
</html>