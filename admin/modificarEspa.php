<script type="text/javascript">function mensajeRegistro(){
	alert("Especialidad modificada con exito.");
	window.location.href='especialidades.php';
}</script>
<?php
include '../mysql.php';
$id=$_POST['id'];
$nom=$_POST['nom'];
modificarEspecialidad($id, $nom);
?><script>mensajeRegistro();</script>