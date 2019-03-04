<?php

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");

$sql = "select * from ET_REGION";

$datos = Array();

$resul = mysqli_query($con,$sql);


while($row = mysqli_fetch_object($resul))
{

	$datos[] = $row;
}


echo json_encode($datos);

mysqli_close($con);

?>

