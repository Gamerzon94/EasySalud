<script type="text/javascript">function mensajeRegistro(){
	alert("Sucursal modificada con exito.");
	window.location.href='farmacia.php';
}</script>
<?php
include("../mysql.php");
$id=$_POST['id'];
$nom=$_POST['nom'];
$dir=$_POST['dir'];
$tel=$_POST['tel'];
$comuna=$_POST['comuna'];
modificarSucursal($id, $nom, $tel, $dir, $comuna);
?><script>mensajeRegistro();</script>