<?php
$id = $_REQUEST["id"];

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "SELECT * FROM ET_FARMACIA WHERE C_ID_USUARIO = '$id'";

$datos = Array();

$resul = mysqli_query($con,$sql);

while($row = mysqli_fetch_object($resul))
{
	$datos[] = $row;
}

echo json_encode($datos);

mysqli_close($con);
?>