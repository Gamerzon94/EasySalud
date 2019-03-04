<?php
	include("config.php");
        include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsuario = $_COOKIE["idUsu"];
        $auxPacientes = cargarPacientes($_COOKIE["idUsu"]);
	}
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
        $regiones = buscarRegion();
        if(isset($_POST['nom'])){
            $nom=$_POST['nom'];
            $ape=$_POST['ape'];
            $com=$_POST['comuna'];
            if($_POST['tel'] == ''){
                $tel=NULL;
            }else{
                $tel=$_POST['tel'];
            }
            $movil=$_POST['cel'];
            $dir=$_POST['dir'];
            $dep=$_POST['dep'];
            if($_POST['genero']=='Masculino'){
                $genero = 'M';
            }else{
                $genero = 'F';
            }
            crearPaciente($idUsuario, $com, $nom, $ape, $tel, $movil, $dir, $dep, $genero);
            $auxPacientes = cargarPacientes($_COOKIE["idUsu"]);
        }
?>
<!DOCTYPE html>
<!--
Template Name: Exative
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html>
<head>
<title><?php echo $Titulo?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script language="javascript">
$(document).ready(function(){
    $("#region").on('change', function () {
        $("#region option:selected").each(function () {
            var id_category = $(this).val();
            $.post("comunas.php", { id_category: id_category }, function(data) {
                $("#comuna").html(data);
            });			
        });
   });
});
</script>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul>
        <li><i class="fa fa-phone"></i> +226963081</li>
        <li><i class="fa fa-envelope-o"></i> info@easysalud.cl</li>
      </ul>
    </div>
    <div class="fl_right">
      <ul>
        <li><a href="index.php"><i class="fa fa-lg fa-home"></i></a></li>
        
        <?php if(isset($_COOKIE["rol"])){
            if($rol == $admin){ ?>
                <li><a href="Admin/index.php">Administración</a></li>
                <li><a href="perfil.php">Mi Perfil</a></li>
                <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
            <?php }else if($rol == $usuario || $rol == $profesional){ ?>
                <li><a href="mensajes.php">Mensajes</a></li>
                <li><a href="solicitudes.php">Solicitudes</a></li>
                <?php if($rol == $usuario){?>
                    <li><a href="pacientes.php">Pacientes</a></li>
                <?php } ?>
                <li><a href="perfil.php">Mi Perfil</a></li>
                <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
            <?php }else if ($rol == $farmacia){?>
                <li><a href="farmacia.php">Mi Perfil</a></li>
                <li><a href="perfil.php">Panel farmacia</a></li>
                <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
            <?php }else if ($rol == $representante){?>
                <li><a href="mensajesFarmacia.php">Mensajes</a></li>
                <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
            <?php } }else{ ?>
            <li><a href="iniciarSesion.php">Iniciar Sesión</a></li>
            <li><a href="registro.php">Registrarse</a></li>
        <?php }?>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.php">Easy Salud</a></h1>
    </div>
    <!-- ################################################################################################ -->
  </header>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
        <?php if(isset($_COOKIE['rol'])){
            if($rol != $usuario){
                ?><h1>Usted no tiene autorización de estar en esta página.</h1><?php
            }else{ ?>
                <h1>Pacientes</h1>
                En este apartado podrá manejar los pacientes que tiene asociados a su cuenta y podrá solicitar profesiones de la salud para ellos.
                <table>
                    <tr>
                        <td>
                            Nombre
                        </td>
                        <td>
                            Telefonos
                        </td>
                        <td>
                            Dirección
                        </td>
                        <td>
                            Sexo
                        </td>
                        <td>
                            Operaciones
                        </td>
                    </tr>
                    <?php while($pacientes = mysqli_fetch_array($auxPacientes)){?>
                    <tr>
                        <td>
                            <?php echo $pacientes["D_NOMBRE_PACIENTE"]." ".$pacientes["D_APELLIDO_PACIENTE"];?>
                        </td>
                        <td>
                            <?php if(($pacientes["N_TELEFONO_PACIENTE"]== 0)&&($pacientes["N_MOVIL_PACIENTE"]== 0)){
                                echo "Sin telefonos registrados.";
                            }else if($pacientes["N_MOVIL_PACIENTE"] == 0){
                                echo $pacientes["N_TELEFONO_PACIENTE"];
                            }else if($pacientes["N_TELEFONO_PACIENTE"]== 0){
                                echo $pacientes["N_MOVIL_PACIENTE"];
                            }else{
                                echo $pacientes["N_TELEFONO_PACIENTE"]." - ".$pacientes["N_MOVIL_PACIENTE"];
                            }?>
                        </td>
                        <td>
                            <?php echo $pacientes["D_DIRECCION_PACIENTE"]." ".$pacientes["S_DEPTO_PACIENTE"]." ".$pacientes["D_NOMBRE_COMUNA"];?>
                        </td>
                        <td>
                            <?php if($pacientes["S_SEXO_PACIENTE"]=='M'){
                                echo "Masculino";
                            }else{
                                echo "Femenino";
                            }?>
                        </td>
                        <td>
                            <a href="editarPaciente.php?id=<?php echo $pacientes["C_ID_PACIENTE"] ?>"><img src="images/edit.png" style="max-width:10%;width:auto;height:auto;" title="Modificar" alt="Modificar"></a>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h1>Nuevo Paciente</h1>
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>
            <label for="name">Nombre <span>*</span></label></td><td>
                                <input type="text" name="nom" id="nom" value="" required></td></tr><tr>
            <td>
            <label for="name">Apellido <span>*</span></label></td><td>
                <input type="text" name="ape" id="ape" value="" required></td></tr><tr>
            <td>
                <label for="name">Región <span>*</span></label></td><td>
            <select name="region" id="region">
			<option value="0">Seleccione región</option>
			<?php while($row = mysqli_fetch_array($regiones)){?>
                            <option value="<?php echo $row['C_ID_REGION']; ?>"><?php echo $row['D_NOMBRE_REGION']; ?></option>
                        <?php }?>
            </select></td></tr><tr>
            <td>
                <label for="name">Comuna <span>*</span></label></td><td>
            <select name="comuna" id="comuna">
			<option value="0">Seleccione comuna</option>
			
            </select></td></tr><tr>
            <td>
            <label for="name">Dirección <span>*</span></label></td><td>
            <input type="text" name="dir" id="dir" value="" required></td></tr>
            <tr><td>
            <label for="name">Depto.</label></td><td>
            <input type="text" name="dep" id="dep" value="" ></td>
                        </tr><tr><td >
            <label for="name">Genero <span>*</span></label></td>
                <td colspan="2">
                    <input type="radio" id="genero" name="genero" value="Masculino" required> Masculino. <input type="radio" id="genero" name="genero" value="Femenino" required> Femenino.
                </td></tr>
                        <tr><td >
            <label for="name">Teléfono</label></td>
                <td colspan="2">
                    <input type="number" name="tel" id="tel" value="">
                </td></tr>
                        <tr><td >
            <label for="name">Móvil <span>*</span></label></td>
                <td colspan="2">
                    <input type="number" name="cel" id="cel" value="" required></td></tr>
                </td></tr>
                        <tr>
                            <td colspan="2">
                        <center><input type="submit" name="Guardar" id="Guardar" value="Guardar"></center>
                            </td>
                        </tr>
                    </table>
                </form>
            <?php }
        }else{
            ?><h1>Usted no tiene autorización de estar en esta página.</h1><?php
        }?>
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="heading">Exative</h6>
      <nav>
        <ul class="nospace">
          <li><a href="#"><i class="fa fa-lg fa-home"></i></a></li>
          <li><a href="#">Acerca de nosotros</a></li>
          <li><a href="#">Contacto</a></li>
          <li><a href="#">Terminos de uso</a></li>
          <li><a href="#">Privacidad</a></li>
          <li><a href="#">Mapa del sitio</a></li>
        </ul>
      </nav>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Contacto</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          Av. Independencia #123, Independencia, Santiago, Chile
          </address>
        </li>
        <li><i class="fa fa-phone"></i> +222222222</li>
        <li><i class="fa fa-envelope-o"></i> info@easysalud.com</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading"></h6>
      
        <fieldset>
          <legend></legend>
          
          
          
        </fieldset>
      
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; <?php echo date("Y"); ?> - Todos los derechos reservados - <a href="index.php"><?php echo $Titulo ?></a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.flexslider-min.js"></script>
</body>
</html>