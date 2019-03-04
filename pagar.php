<?php

include './mysql.php';
if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsu = $_COOKIE["idUsu"];
	}
if (isset($_POST["contratar"])) {
    $plan = $_POST["plan"];
    $idSucursal = $_POST["idSucursal"];
    $datosPlan = cargarPlanEspecifico($plan);
} else {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Pagos Easy Salud</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <center><h1>Pagina de pagos</h1></center>
    <form action="guardarPago.php" method="post">
        <input type="hidden" value="<?php echo $plan; ?>" name="plan" id="plan">
        <input type="hidden" value="<?php echo $idSucursal; ?>" name="idSucursal" id="idSucursal">
        <input type="hidden" value="<?php echo $idUsu; ?>" name="idUsu" id="idUsu">
    <?php while($auxPlan = mysqli_fetch_array($datosPlan)){ ?>
        Total a pagar: $<?php echo $auxPlan["C_VALOR"]; ?>.- <br/>
        Detalles: <?php echo $auxPlan['D_NOMBRE_PLAN']."-".$auxPlan['C_DURACION']." "; 
                            if(($auxPlan['L_TIPO']=='dia')&&($auxPlan['C_DURACION']==1)){
                                    echo "Día.";
                                }else if($auxPlan['L_TIPO']=='dia'){
                                    echo " Días.";
                                }else if(($auxPlan['L_TIPO']=='mes')&&($auxPlan['C_DURACION']==1)){
                                    echo " Mes.";
                                }else if($auxPlan['L_TIPO']=='mes'){
                                    echo " Meses.";
                                }else if(($auxPlan['L_TIPO']=='ano')&&($auxPlan['C_DURACION']==1)){
                                    echo " Año.";
                                }else if($auxPlan['L_TIPO']=='ano'){
                                    echo " Años.";
                                }
     } ?>
        <input type="submit" name="Pagar" value="Pagar" id="Pagar">
    </form>
    </body>
</html>
