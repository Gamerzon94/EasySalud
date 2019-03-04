<!DOCTYPE HTML>
<?php
include("../mysql.php");
date_default_timezone_set("Chile/Continental");
$hoy = date("d-m-Y");  
$resultado = obtenerProfesionalesConNombre();
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
        <h1>Reporte de usuarios</h1>
        </div>
        Se listan a continuacion los profesionales registrados en el sistema.<br>
    <br>
    <br>
        <table border=\"1\">
			<tr>
				<td>
					RUT
				</td>
                                <td>
					Nombre
				</td>
				<td>
					Apellido
				</td>
				<td>
					Comuna
				</td>
				<td>
					Email
				</td>
				<td>
					Dirección
				</td>
				<td>
					Teléfono(s)
				</td>
                                <td>
                                    Tipo
                                </td>
				<td>
					Fecha de registro
				</td>
			</tr>
                        <?php
			while($filas = mysqli_fetch_array($resultado)){ ?>
				<tr>
				<td><?php echo $filas['S_RUN_USUARIO'] ?></td>
				<td><?php echo $filas['D_NOMBRE_USUARIO'] ?></td>
				<td><?php echo $filas['D_APELLIDO_USUARIO'] ?></td>
				<td><?php echo $filas['D_NOMBRE_COMUNA'] ?></td>
				<td><?php echo $filas['D_EMAIL_USUARIO'] ?></td>
				<td><?php echo $filas['D_DIRECCION_USUARIO'] ?></td>
                                <td><?php echo $filas['N_TELEFONO_USUARIO']." ".$filas['N_MOVIL_USUARIO'] ?></td>
                                <td><?php if($filas['L_PREMIUM']==TRUE){
                                    echo "Premium";
                                }else{
                                    echo "Normal";
                                } ?></td>
				<td><?php echo $filas['F_FECHA_REGISTRO'] ?></td>
                </tr>
			<?php } ?>
		</table>
    <br/>
    <br/>
    Reporte generado a las: <?php echo  date ("H:i",time()) ?> el <?php  echo $hoy ?>
    </body>
</html>