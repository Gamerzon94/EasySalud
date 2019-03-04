<!DOCTYPE HTML>
<?php
include("../mysql.php");
date_default_timezone_set("Chile/Continental");
$hoy = date("d-m-Y");  
$resultado = mostrarUsuarios();
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
        Se listan a continuacion los usuarios registrados en el sistema.<br>
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
					Tipo
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
                                    Estado Cuenta
                                </td>
			</tr>
                        <?php
			while($filas = mysqli_fetch_array($resultado)){ ?>
				<tr>
				<td><?php echo $filas['S_RUN_USUARIO'] ?></td>
				<td><?php echo $filas['D_NOMBRE_USUARIO'] ?></td>
				<td><?php echo $filas['D_APELLIDO_USUARIO'] ?></td>
				<td><?php echo $filas['D_NOMBRE_COMUNA'] ?></td>
				<td><?php echo $filas['D_TIPO_USUARIO'] ?></td>
				<td><?php echo $filas['D_EMAIL_USUARIO'] ?></td>
				<td><?php echo $filas['D_DIRECCION_USUARIO'] ?></td>
                                <td><?php if(($filas['N_TELEFONO_USUARIO']==0)&&($filas['N_MOVIL_USUARIO']==0)){
                      echo "Sin telefonos Registrados.";
                  }else if($filas['N_TELEFONO_USUARIO']==0){
                      echo $filas['N_MOVIL_USUARIO'];
                  }else if($filas['N_MOVIL_USUARIO']==0){
                      echo $filas['N_TELEFONO_USUARIO'];
                  }else{
                    echo $filas['N_TELEFONO_USUARIO']."<br/>".$filas['N_MOVIL_USUARIO'];
                  } ?></td>
                                <td><?php echo $filas['D_ESTADO_CUENTA'] ?></td>
                </tr>
			<?php } ?>
		</table>
    <br/>
    <br/>
    Reporte generado a las: <?php echo  date ("H:i",time()) ?> el <?php  echo $hoy ?>
    </body>
</html>