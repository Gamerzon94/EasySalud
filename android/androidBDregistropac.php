<?php

$rut = $_REQUEST["Rut"];
$nom = $_REQUEST["Nombre"];
$ape = $_REQUEST["Apellido"];
$email = $_REQUEST["Email"];
$movil = $_REQUEST["Movil"];
$telefono = $_REQUEST["Telefono"];
$fecha = $_REQUEST["Fecha"];
$comuna = $_REQUEST["Comuna"];
$clave = $_REQUEST["Clave"];
$direccion = $_REQUEST["Direccion"];
$departamento = $_REQUEST["Departamento"];
$sexo = $_REQUEST["Sexo"];
$estado = $_REQUEST["Estado"];
$codigo = $_REQUEST["Codigo"];


$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "INSERT INTO ET_USUARIOS(C_ID_TIPO_USUARIO,C_ID_COMUNA,C_ID_ESTADO_CUENTA,S_RUN_USUARIO,D_NOMBRE_USUARIO,D_APELLIDO_USUARIO,D_EMAIL_USUARIO,N_MOVIL_USUARIO,N_TELEFONO_USUARIO,D_DIRECCION_USUARIO,D_CLAVE_USUARIO,F_FECHA_NACIMIENTO,S_SEXO_USUARIO, S_DEPTO_USARIO, D_CODIGO_USUARIO) VALUES(2,'$comuna','$estado','$rut','$nom','$ape','$email','$movil','$telefono','$direccion','$clave','$fecha','$sexo','$departamento','$codigo');";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>