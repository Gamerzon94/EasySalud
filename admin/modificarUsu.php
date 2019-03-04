<script type="text/javascript">function mensajeRegistro(){
	alert("Usuario modificado con exito.");
	window.location.href='usuarios.php';
}</script>
<?php
require("../mysql.php");
$id=$_POST['id'];
$tip=$_POST['tipoUsuario'];
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
modificarUsuario($id,$tip,$run,$nom,$ape,$email,$cla,$com,$tel,$movil,$dir,$dep,$nac);
?><script>mensajeRegistro();</script>