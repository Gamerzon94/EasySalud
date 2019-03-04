<script type="text/javascript">function mensajeRegistro(){
	alert("Especialidad eliminada con exito.");
	window.location.href='especialidades.php';
}</script>
<?php
include("../mysql.php");
$id=$_GET['id'];
eliminarEspecialidad($id);
?><script>mensajeRegistro();</script>