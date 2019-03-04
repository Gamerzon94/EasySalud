<!DOCTYPE HTML>
<?php
include("../mysql.php");
date_default_timezone_set("Chile/Continental");
$hoy = date("d-m-Y");  
$auxBoleta = boletaSucursal($id);
?>
<html lang ="es">
    <head>
        <meta charset="UTF-8" />
        <title>Generar PDFs con PHP</title>
        <style type="text/css">
            #cabecera h1{
                float:left;
                display: block;
            }
            #cabecera img{
                float: right;
            }
        </style>
    </head>
    <body>
        <div id="cabecera">
        <img src="../images/easysalud.jpg" style="max-width:15%;width:auto;height:auto;"/>
        <h1>Boleta</h1>
        </div>
        A continuación se listan los detalles del pago.<br>
    <br>
    <br>
        <?php while($pagos = mysqli_fetch_array($auxBoleta)){ ?>
            Folio: F-<?php echo $pagos["C_ID_PAGO"]; ?>.<br/>
            Plan: <?php $auxPlan = cargarPlanEspecifico($pagos["C_ID_PLAN"]);
            while($plan = mysqli_fetch_array($auxPlan)){
                echo $plan["D_NOMBRE_PLAN"].".<br/>"."Duración: ".$plan["C_DURACION"]; 
                if(($plan['L_TIPO']=='dia')&&($plan['C_DURACION']==1)){
                                    echo "Día.";
                                }else if($plan['L_TIPO']=='dia'){
                                    echo " Días.";
                                }else if(($plan['L_TIPO']=='mes')&&($plan['C_DURACION']==1)){
                                    echo " Mes.";
                                }else if($plan['L_TIPO']=='mes'){
                                    echo " Meses.";
                                }else if(($plan['L_TIPO']=='ano')&&($plan['C_DURACION']==1)){
                                    echo " Año.";
                                }else if($plan['L_TIPO']=='ano'){
                                    echo " Años.";
                                }?>.<br/>
            Monto: $<?php echo $plan["C_VALOR"].".-<br/>";
            } ?>
            Fecha de pago: <?php echo $pagos["F_FECHA_REGISTRO"]; ?>.
        <?php }?>
    <br/>
    <br/>
    Boleta generada a las: <?php echo  date ("H:i",time()) ?> el <?php  echo $hoy ?>.
    </body>
</html>