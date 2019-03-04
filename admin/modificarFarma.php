<script type="text/javascript">function mensajeRegistro(){
	alert("Farmacia modificada con exito.");
	window.location.href='farmacia.php';
}</script>
<?php
include("../mysql.php");
$id=$_POST['id'];
$nom=$_POST['nom'];
$web=$_POST['web'];
$rep=$_POST['rep'];
modificarFarmacia($id,$nom,$web,$rep);
?><script>mensajeRegistro();</script>