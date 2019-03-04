<script type="text/javascript">function mensajeRegistro(){
	alert("Farmacia eliminada con exito.");
	window.location.href='usuarios.php';
}</script>
<?php
include("../mysql.php");
$con = new Conexion();
$id=$_GET['id'];
eliminarFarmacia($id);
?><script>mensajeRegistro();</script>