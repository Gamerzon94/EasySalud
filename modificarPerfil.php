<script type="text/javascript">function mensajeRegistro(){
	alert("Usuario modificado con exito.");
	window.location.href='perfil.php';
}</script>
<?php
include("mysql.php");
$id=$_POST['id'];
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
modificarUsuario($id,$email,$cla,$com,$tel,$movil,$dir,$dep);
?><script>mensajeRegistro();</script>