<script type="text/javascript">function mensajeRecuperado(){
	alert("Dentro de poco recibirá un correo con la contraseña actual.");
	window.location.href='index.php';
}
function mensajeError(){
	alert("El email ingresado no se encuentra registrado.");
	window.location.href='index.php';
}</script>
<?php
include './mysql.php';
require("class.phpmailer.php");
require("class.smtp.php");
if(isset($_POST["email"])){
    $email = $_POST["email"];
    $auxCuenta = recuperarClave($email);
    $entro = FALSE;
    while($cuenta = mysqli_fetch_array($auxCuenta)){
        $clave = $cuenta["D_CLAVE_USUARIO"];
        $estado = $cuenta["D_ESTADO_CUENTA"];
        $entro=TRUE;
        break;
    }
    if($entro = TRUE){
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
    $mail->AddAddress($email, $nom." ".$ape);        // destinatario

    $mail->AddReplyTo("no-responder@easysalud.cl", "No Responder Easy Salud");    // responder a

    $mail->WordWrap = 50;     // set word wrap to 50 characters
    $mail->IsHTML(true);     // set email

    $mail->Subject = "Recuperación de contraseña - Easy Salud";
    $mail->Body    = "<h2><img style=\"font-size: 14px; float: right;\" src=\"https://www.easysalud.cl/images/easysalud.jpg\" alt=\"Easy Salud\" width=\"171\" height=\"106\" /></h2>
<h2>&nbsp;</h2>
<h2>Recuperacion de contraseña&nbsp;</h2>
<p>&nbsp;</p>
<p style=\"text-align: justify;\">Hemos recibido una solicitud para recuperar la contrase&ntilde;a de: <a href=\"mailto:".$email."\">".$email."</a>.<br>La contrase&ntilde;a actual es: ".$clave."<br> La cuenta adem&aacute;s se encuentra ".$estado.", ante problemas con la plataforma favor comunicarse a <a href=\"mailto:soporte@easysalud.cl\">soporte@easysalud.cl</a></p>
<p style=\"text-align: justify;\">&nbsp;</p>
<p style=\"text-align: justify;\">Saludos,</p>
<p style=\"text-align: justify;\">Equipo de soporte Easy Salud</p>";
    $mail->AltBody = "Recuperacion de contraseña 


Hemos recibido una solicitud para recuperar la contraseña de: , la contraseña actual es: , la cuenta además se encuentra , ante problemas con la plataforma favor comunicarse a soporte@easysalud.cl


Saludos,

Equipo de soporte Easy Salud";

    if(!$mail->Send())
    {
       echo "Message could not be sent. <p>";
       echo "Mailer Error: " . $mail->ErrorInfo;
       exit;
    }
    ?><script>mensajeRecuperado();</script><?php
    }else{
        ?><script>mensajeError();</script><?php
    }
}else{
    header("Location:index.php");
}