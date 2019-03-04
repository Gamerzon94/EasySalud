<script type="text/javascript">function mensajeRegistro(){
	alert("Especialidad creada con exito.");
	window.location.href='especialidades.php';
}</script>
<?php
include("../mysql.php");
$nom=$_POST['nom'];
nuevaEspecialidad($nom);
?><script>mensajeRegistro();</script>