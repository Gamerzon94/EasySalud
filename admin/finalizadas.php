<!DOCTYPE HTML>
<?php
include("../mysql.php");
date_default_timezone_set("Chile/Continental");
$hoy = date("d-m-Y");  
$auxSolicitudes = solicitudesFinalizadas();
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
        <h1>Reporte de solicitudes</h1>
        </div>
        Se listan a continuacion las solicitudes que se encuentran en sistema.<br>
    <br>
    <br>
        <table border=\"1\">
                <tr>
                    <td>
                        ID Solicitud
                    </td>
                    <td>
                        Usuario solicitante
                    </td>
                    <td>
                        Profesional
                    </td>
                    <td>
                        Comuna - Region
                    </td>
                    <td>
                        Estado
                    </td>
                </tr>
                <?php while($solicitud = mysqli_fetch_array($auxSolicitudes)){?>
                <tr>
                    <td>
                        <?php echo $solicitud['C_ID_SOLICITUD'];?>
                    </td>
                    <td>
                        <?php $auxUsuario = buscarNombrePaciente($solicitud['C_ID_USUARIO']);
                        while($usuario = mysqli_fetch_array($auxUsuario)){
                            echo $usuario['D_NOMBRE_USUARIO']." ".$usuario['D_APELLIDO_USUARIO'];
                            break;
                        }?>
                    </td>
                    <td>
                        <?php $auxProfesional = buscarNombreProfesional($solicitud['C_ID_PROFESIONAL']);
                        while($profesional = mysqli_fetch_array($auxProfesional)){
                            echo $profesional['D_NOMBRE_USUARIO']." ".$profesional['D_APELLIDO_USUARIO'];
                            break;
                        }?>
                    </td>
                    <td>
                        <?php $auxUsuario = buscarNombrePaciente($solicitud['C_ID_USUARIO']);
                        while($usuario = mysqli_fetch_array($auxUsuario)){
                            echo $usuario['D_NOMBRE_COMUNA'].", ".$usuario['D_NOMBRE_REGION'];
                            break;
                        }?>
                    </td>
                    <td>
                       <?php echo $solicitud['D_NOMBRE_ESTADO']; ?>
                    </td>
                </tr>
                <?php }?>
            </table>
    <br/>
    <br/>
    Reporte generado a las: <?php echo  date ("H:i",time()) ?> el <?php  echo $hoy ?>
    </body>
</html>