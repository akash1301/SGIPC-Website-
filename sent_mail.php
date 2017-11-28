<?php
require 'PHPMailer/PHPMailerAutoload.php';
session_start();

$sent_email=$_SESSION['mail_id'];
$user_id=$_SESSION['username'];

unset($_SESSION['mail_id']);
unset($_SESSION['username']);

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'sgipckuet001@gmail.com';        // SMTP username
$mail->Password = 'sgipckuet1234'; 		   			// SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('sgipckuet001@gmail.com', 'SGIPC');
$mail->addReplyTo('sgipckuet001@gmail.com', 'SGIPC');
$mail->addAddress($sent_email);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Email Verification from SGIPC</h1>';
$bodyContent .='<p>Dear '.$user_id.',</p>';
$bodyContent .= '<p>Click on the <a href="http://localhost/SGIPC/SGIPC/start.php?userid='.$user_id.'">Link</a> to verify your account</p>';

$mail->Subject = 'Email Verification from SGIPC';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("location:start.php");
}
?>
