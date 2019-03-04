<?php
$id = $_REQUEST["id"];
$id_comuna = $_REQUEST["id_comuna"];
$nom_sucursal = $_REQUEST["nom_sucursal"];
$dir_sucursal = $_REQUEST["dir_sucursal"];
$tel_sucursal = $_REQUEST["tel_sucursal"];
$lat = $_REQUEST["lat"];
$lon = $_REQUEST["lon"];

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "INSERT INTO ET_SUCURSAL(C_ID_FARMACIA,C_ID_COMUNA,D_NOMBRE_SUCURSAL,D_DIRECCION_SUCURSAL,N_TELEFONO_SUCURSAL,N_LATITUD,N_LONGITUD) VALUES ('$id','$id_comuna','$nom_sucursal','$dir_sucursal','$tel_sucursal','$lat','$lon');";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>