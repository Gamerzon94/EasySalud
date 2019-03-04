<?php

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$id_estado = $_REQUEST["id_estado"];
$id_solicitud = $_REQUEST["id_solicitud"];

$sql = "UPDATE ET_SOLICITUD SET C_ID_ESTADO = '$id_estado' WHERE C_ID_SOLICITUD = '$id_solicitud'";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>