<script type="text/javascript">function mensajeRegistro(){
	alert("Farmacia creada con exito.");
	window.location.href='farmacia.php';
}</script>
<?php
include("../mysql.php");
$nom=$_POST['nom'];
$web=$_POST['web'];
$rep=$_POST['rep'];
nuevaFarmacia($nom,$web,$rep);
?><script>mensajeRegistro();</script>