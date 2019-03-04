<?php
require("class.phpmailer.php");
require("class.smtp.php");

$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->IsSMTP();                                      // set mailer to

$mail->Host = "mail.easysalud.cl";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "no-responder@easysalud.cl";  // SMTP username
$mail->Password = "EasySalud."; // SMTP password

$mail->From = "no-responder@easysalud.cl";
$mail->FromName = "No Responder Easy Salud";        // remitente
$mail->AddAddress("adrian.gomez@hotmail.cl", "Adrián Humberto Gómez Anríquez");        // destinatario

$mail->AddReplyTo("no-responder@easysalud.cl", "No Responder Easy Salud");    // responder a

$mail->WordWrap = 50;     // set word wrap to 50 characters
$mail->IsHTML(true);     // set email

$mail->Subject = "Bienvenido a Easy Salud";
$mail->Body    = "Bienveinido a Easy Salud <br>Tu codigo de autenticacion es: 123456";
$mail->AltBody = "Bienveinido a Easy Salud Tu codigo de autenticacion es: 123456";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";
?> 