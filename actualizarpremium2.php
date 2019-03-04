<?php
include("mysql.php");
date_default_timezone_set("Chile/Continental");
$hoy = strtotime(date("Y-m-d"));  
$auxPagos = obtenerPagos();
$auxProfesional = obtenerProfesionales();
while($pagos = mysqli_fetch_array($auxPagos)){
    while($profesional = mysqli_fetch_array($auxProfesional)){
        if($pagos["C_ID_USUARIO"]==$profesional["C_ID_USUARIO"]){
            $fechaVencimiento = strtotime($pagos["F_FECHA_VENCIMIENTO"]);
            if($fechaVencimiento<$hoy){
                actualizarPremium($profesional["C_ID_PROFESIONAL"]);
            }
        }
    }
    $auxProfesional = obtenerProfesionales();
}