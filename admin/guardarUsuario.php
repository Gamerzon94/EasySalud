<script type="text/javascript">function mensajeRegistro(){
	alert("Usuario registrado con exito.");
	window.location.href='usuarios.php';
}</script>
<?php
include("../mysql.php");
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
if($_POST['genero']=='Masculino'){
    $genero = 'M';
}else{
    $genero = 'F';
}
$ran = mt_rand(1000,9999);
if(verificarRut($run)==true){
    ?><script type="text/javascript">
	alert("El Run o Pasaporte ya esta registrado.");
	window.location.href='usuarios.php';</script><?php
}else{
if(verificarEmail($email)==true){
    ?><script type="text/javascript">
	alert("El Email ya esta registrado.");
	window.location.href='usuarios.php';</script><?php
}
}
crearUsuario($tip,$run,$nom,$ape,$email,$cla,$com,$tel,$movil,$dir,$dep,$nac,$genero);
?><script>mensajeRegistro();</script>