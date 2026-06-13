<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail</title>
</head>
<body>
    <form action="send-mail.php" method="post">
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email"><br><br>

        <label for="subject">Subject</label><br>
        <input type="text" name="subject" id="subject"><br><br>
        
        <label for="message">Message</label><br>
        <textarea name="message" id="message"></textarea><br><br>

        <button type="submit" name="send_btn">Send Mail</button>

    </form>

    <h4 style="color:green"><?= $_GET['msg'] ?? ''; ?></h4>
</body>
</html>