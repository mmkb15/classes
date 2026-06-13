<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

if(isset($_POST['send_btn'])){
    $emailAddress = $_POST['email'] ;
    $emailSubject = $_POST['subject'] ;
    $emailMessage = $_POST['message'] ;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mustafamursalin75@gmail.com';             //SMTP username
    $mail->Password   = 'jhej iouc mxtk bgzf';                  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mustafamursalin75@gmail.com', 'MK-47');
    // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress($emailAddress);               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailMessage;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("Location: email.php?msg=Email set successfully");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}


