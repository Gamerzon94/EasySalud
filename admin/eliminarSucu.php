<script type="text/javascript">function mensajeRegistro(){
	alert("Sucursal eliminada con exito.");
	window.location.href='sucursales.php';
}</script>
<?php
include("../mysql.php");
$con = new Conexion();
$id=$_GET['id'];
eliminarSucursal($id);
?><script>mensajeRegistro();</script>