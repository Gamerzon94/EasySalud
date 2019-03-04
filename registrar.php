<script type="text/javascript">function mensajeRegistro(){
	alert("Dentro de poco recibirá un correo confirmando el registro.");
	window.location.href='index.php';
}</script>
<?php
include("mysql.php");
require("class.phpmailer.php");
require("class.smtp.php");
$run=$_POST['run'];
$nom=$_POST['nom'];
$ape=$_POST['ape'];
$email=$_POST['email'];
$cla=$_POST['cla'];
$com=$_POST['comuna'];
if($_POST['tel'] == ''){
    $tel=NULL;
}else{
    $tel=$_POST['tel'];
}
$movil=$_POST['cel'];
$dir=$_POST['dir'];
$dep=$_POST['dep'];
$nac=$_POST['fechaNacimiento'];
if($_POST['genero']=='Masculino'){
    $genero = 'M';
}else{
    $genero = 'F';
}
$ran = mt_rand(1000,9999);
if(verificarRut($run)==true){
    ?><script type="text/javascript">
	alert("El Run o Pasaporte ya esta registrado.");
	window.location.href='index.php';</script><?php
}else{
if(verificarEmail($email)==true){
    ?><script type="text/javascript">
	alert("El Email ya esta registrado.");
	window.location.href='index.php';</script><?php
}else{
if(isset($_POST['profesional'])){
    $idUsuNue = crearUsuarioConId($run,$nom,$ape,$email,$cla,$com,$tel,$movil,$dir,$dep,$nac,$ran,$genero,'3');
    ?>
    <script type="text/javascript">
	window.location.href='registroProfesional.php?id=<?php echo $idUsuNue;?>';</script><?php 
}else{
    $idUsuNue = crearUsuarioConId($run,$nom,$ape,$email,$cla,$com,$tel,$movil,$dir,$dep,$nac,$ran,$genero,'2');
    $correSeparado = explode("@",$email);
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

    $mail->Subject = "Bienvenido a Easy Salud";
        $mail->Body    = "<h2><img style=\"font-size: 14px; float: right;\" src=\"https://www.easysalud.cl/images/easysalud.jpg\" alt=\"Easy Salud\" width=\"171\" height=\"106\" /></h2>
<h2>&nbsp;</h2>
<h2>Bienvenido a Easy Salud&nbsp;</h2>
<p>&nbsp;</p>
<p style=\"text-align: justify;\">Se ha registrado el correo: <a href=\"mailto:".$email."\">".$email."</a>.<br>Tu codigo de autenticacion es: ".$ran."<br> <a href=\"https://www.easysalud.cl/activar.php?id=".$ran."&email=".$correSeparado[0]."%40".$correSeparado[1]."\">para activar tu cuenta haz click aqui</a>, ante problemas con la plataforma favor comunicarse a <a href=\"mailto:soporte@easysalud.cl\">soporte@easysalud.cl</a></p>
<p style=\"text-align: justify;\">&nbsp;</p>
<p style=\"text-align: justify;\">Saludos,</p>
<p style=\"text-align: justify;\">Equipo de soporte Easy Salud</p>";
    $mail->AltBody = "Bienveinido a Easy Salud Se ha registrado el correo: ".$email." Tu codigo de autenticacion es: ".$ran." para activar tu cuenta haz click en https://www.easysalud.cl/activar.php?id=".$ran."&email=".$correSeparado[0]."%40".$correSeparado[1]." ante problemas con la plataforma favor comunicarse a soporte@easysalud.cl Saludos, Equipo de soporte Easy Salud";

    if(!$mail->Send())
    {
       echo "Message could not be sent. <p>";
       echo "Mailer Error: " . $mail->ErrorInfo;
       exit;
    }

}
?>
<script>mensajeRegistro();</script><?php
}
}
?>