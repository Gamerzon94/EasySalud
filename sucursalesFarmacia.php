<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsu = $_COOKIE["idUsu"];
        if(isset($_GET["id"])){
            $idFarmacia = $_GET["id"];
            $auxSucursales = mostrarSucursalesFarmacia($idFarmacia);
        }else{
            header("Location:index.php");
        }
	}
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
        $representante = "5";
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q"></script>
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
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content">
       <?php if(isset($_COOKIE["rol"])){
           if($rol == $farmacia){?>
        <h1>Listado de sucursales</h1>
        <button onclick="window.location.href='nuevaSucursal.php?id=<?php echo $idFarmacia; ?>'">Nueva Sucursal</button>
        <center>
            <table>
                <tr>
                    <td>
                        Nombre
                    </td>
                    <td>
                        Dirección
                    </td>
                    <td>
                        Teléfono
                    </td>
                    <td>
                        Estado
                    </td>
                    <td>
                        Operaciones
                    </td>
                </tr>
                <?php $count = 0;
                while($sucursal = mysqli_fetch_array($auxSucursales)){
                    $count++; ?>
                <tr>
                    <td>
                        <?php echo $sucursal["D_NOMBRE_SUCURSAL"]; ?>
                    </td>
                    <td>
                       <?php echo $sucursal["D_DIRECCION_SUCURSAL"].", ".$sucursal["D_NOMBRE_COMUNA"].", ".$sucursal["D_NOMBRE_REGION"]; ?>
                    </td>
                    <td>
                        <?php echo $sucursal["N_TELEFONO_SUCURSAL"]; ?>
                    </td>
                    <td>
                <?php if($sucursal["L_ACTIVA"] == TRUE){
                    echo "Activa";
                }else{
                    echo "Inactiva";
                } ?>
                    </td>
                    <td WIDTH="20%">
                        <a href="modificarSucursal.php?id=<?php echo $sucursal['C_ID_SUCURSAL'] ?>"><img src="images/edit.png" style="max-width:15%;width:auto;height:auto;" title="Modificar" alt="Modificar"></a>
                        <?php if($sucursal["L_ACTIVA"] == FALSE){ ?>
                    <a href="activarSucursal.php?id=<?php echo $sucursal['C_ID_SUCURSAL'] ?>">Activar Sucursal</a>
                <?php } ?>
                    </td>
                </tr>
                <?php }  if($count == 0){
                    echo "<tr><td colspan = '5'><center>Sin sucursales registradas.</center></td></tr>";
                }?>
            </table>
        </center>
           <?php } }else{ ?>
        <center><h1>No tiene autorización de entrar a esta sección</h1></center>
       <?php }?>
    </div>
    <div class="clear">
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