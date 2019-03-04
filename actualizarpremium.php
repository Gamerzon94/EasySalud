<?php
include("mysql.php");
date_default_timezone_set("Chile/Continental");
$hoy = strtotime(date("Y-m-d"));  
$auxPagos = obtenerPagosSucursal();
$auxRepresentante = obtenerRepresentantes();
while($pagos = mysqli_fetch_array($auxPagos)){
    while($representante = mysqli_fetch_array($auxRepresentante)){
        if($pagos["C_ID_USUARIO"]==$representante["C_ID_USUARIO"]){
            $auxSucursales = obtenerSucursalesRepresentante($representante["C_ID_USUARIO"]);
            while($sucursales = mysqli_fetch_array($auxSucursales)){
            if($pagos["C_ID_SUCURSAL"] == $sucursales["C_ID_SUCURSAL"]){
            $fechaVencimiento = strtotime($pagos["F_FECHA_VENCIMIENTO"]);
            if($fechaVencimiento<$hoy){
                actualizarPremiumSucursal($pagos["C_ID_SUCURSAL"]);
            }
        }
        }
        }
    }
    $auxRepresentante = obtenerRepresentantes();
}