<?php
$id = $_REQUEST["id"];
$equipo = $_REQUEST["equipo"];


$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");

$sql = "INSERT INTO ET_EQUIPAMIENTO(C_ID_PROFESIONAL,D_EQUIPO) VALUES('$id','$equipo');";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>