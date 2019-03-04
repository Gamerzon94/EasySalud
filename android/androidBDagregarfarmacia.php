<?php
$id = $_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$pagina = $_REQUEST["pagina"];

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "INSERT INTO ET_FARMACIA(C_ID_USUARIO,D_NOMBRE_FARMACIA,D_WEB_FARMACIA) VALUES('$id','$nombre','$pagina');";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>