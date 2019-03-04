<?php

$id = $_REQUEST["id"];

$con = mysqli_connect("66.7.198.100","easys83_web","EasySalud2018.","easys83_easysalud");

mysqli_set_charset($con,"utf8");
$sql = "DELETE FROM ET_EQUIPAMIENTO WHERE C_ID_EQUIPAMIENTO = '$id'";

$resul = mysqli_query($con,$sql);

echo json_encode($datos);

mysqli_close($con);

?>