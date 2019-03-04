<script type="text/javascript">function mensajeRegistro(){
	alert("Usuario eliminado con exito.");
	window.location.href='usuarios.php';
}</script>
<?php
include("../mysql.php");
$id=$_GET['id'];
eliminarUsuario($id);
?><script>mensajeRegistro();</script>