<?php
$id = $_REQUEST["Id_pac"];
$id_profesional = $_REQUEST["Id_prof"];
$comentarios = $_REQUEST["comentarios"];
$fecha = $_REQUEST["fecha"];

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "INSERT INTO ET_SOLICITUD(C_ID_USUARIO,C_ID_PROFESIONAL,C_ID_ESTADO,F_FECHA_ATENCION,D_ANOTACIONES_SOLICITUD) VALUES('$id','$id_profesional',1,'$fecha','$comentarios');";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);
?>