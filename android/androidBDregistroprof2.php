<?php
$id = $_REQUEST["Id"];
$id_especialidad = $_REQUEST["Id_especialidad"];
$id_nivel = $_REQUEST["Id_nivel"];
$id_instituciones = $_REQUEST["Id_instituciones"];
$titulo = $_REQUEST["Titulo"];


$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "INSERT INTO ET_PROFESIONAL(C_ID_USUARIO,C_ID_ESPECIALIDAD,C_ID_NIVEL_ESTUDIOS,C_ID_INSTITUCIONES,D_TITULO,D_IMAGEN,L_PREMIUM,L_ACTIVO) VALUES('$id','$id_especialidad','$id_nivel','$id_instituciones','$titulo','enfermeria.png',FALSE,FALSE);";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>