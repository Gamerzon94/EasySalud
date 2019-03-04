<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsuario = $_COOKIE["idUsu"];
	}
	$admin = "1";
	$usuario1 = "2";
        $profesional = "3";
        $farmacia = "4";
        $usuario = buscarPerfil($idUsuario);
        $region = buscarRegion();
        $comuna = cargarComuna(); 
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
<script type="text/javascript" src="javascript.js"></script>
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
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

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
      <!-- ################################################################################################ -->
        <?php if(isset($_COOKIE["rol"])){ ?>
      <h1>Modificar Perfil</h1>
      <?php while($filas = mysqli_fetch_array($usuario)){ ?>
      <form action="modificarPerfil.php" method="post" onsubmit="return validar();">
            <table><tr><td>
                        <input type="hidden" id="id" name="id" value="<?php echo $filas['C_ID_USUARIO'];?>">
                        <input type="hidden" id="tipoUsuario" name="tipoUsuario" value="<?php echo $filas['C_ID_TIPO_USUARIO'];?>">
            <label for="name">RUN / Pasaporte <span>*</span></label></td><td>
            <?php echo $filas['S_RUN_USUARIO'];?></td>
            <td>
            <label for="name">Nombre <span>*</span></label></td><td>
            <input type="text" name="nom" id="nom" value="<?php echo $filas['D_NOMBRE_USUARIO'];?>" size="20" required></td></tr>
            <tr><td>
            <label for="name">Apellido <span>*</span></label></td><td>
            <input type="text" name="ape" id="ape" value="<?php echo $filas['D_APELLIDO_USUARIO'];?>" size="20" required></td>
            <td>
            <label for="name">Region <span>*</span></label></td><td>
            <select name="region" id="region">
			<option value="0">Seleccione region</option>
			<?php while($auxRegion = mysqli_fetch_array($region)){
                            if($auxRegion['C_ID_REGION'] == $filas['C_ID_REGION']){?>
                            <option value="<?php echo $auxRegion['C_ID_REGION']; ?>" selected="selected"><?php echo $auxRegion['D_NOMBRE_REGION']; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $auxRegion['C_ID_REGION']; ?>"><?php echo $auxRegion['D_NOMBRE_REGION']; ?></option>
                        <?php } }?>
                                </select></td></tr>
            <tr><td>
            <label for="name">Comuna <span>*</span></label></td><td>
            <select name="comuna" id="comuna">
			<option value="0">Seleccione comuna</option>
			<?php while($auxComuna = mysqli_fetch_array($comuna)){
                            if($auxComuna['C_ID_COMUNA'] == $filas['C_ID_COMUNA']){?>
                            <option value="<?php echo $auxComuna['C_ID_COMUNA']; ?>" selected="selected"><?php echo $auxComuna['D_NOMBRE_COMUNA']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $auxComuna['C_ID_COMUNA']; ?>"><?php echo $auxComuna['D_NOMBRE_COMUNA']; ?></option>
                        <?php } }?>
                                </select></td>
            <td>
            <label for="name">Dirección <span>*</span></label></td><td>
            <input type="text" name="dir" id="dir" value="<?php echo $filas['D_DIRECCION_USUARIO'];?>" size="20" required></td></tr>
            <tr><td>
            <label for="name">Depto.</label></td><td>
            <input type="text" name="dep" id="dep" value="<?php echo $filas['S_DEPTO_USARIO'];?>" size="20"></td>
            <td>
            <label for="name">Email <span>*</span></label></td><td>
            <input type="text" name="email" id="email" value="<?php echo $filas['D_EMAIL_USUARIO'];?>" size="20" required></td></tr>
            <tr><td>
            <label for="name">Confirmar Email <span>*</span></label></td><td>
            <input type="text" name="email2" id="email2" value="<?php echo $filas['D_EMAIL_USUARIO'];?>" size="20" required></td>
            <td>
            <label for="name">Fecha de nacimiento <span>*</span></label></td><td>
            <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $filas['F_FECHA_NACIMIENTO'];?>" size="20" required></td></tr>
            <tr><td>
            <label for="name">Telefono </label></td><td>
            <input type="number" name="tel" id="tel" value="<?php echo $filas['N_TELEFONO_USUARIO'];?>" size="20" ></td>
            <td>
            <label for="name">Movil <span>*</span></label></td><td>
            <input type="number" name="cel" id="cel" value="<?php echo $filas['N_MOVIL_USUARIO'];?>" size="20" required></td></tr>
            <tr><td>
            <label for="name">Contraseña <span>*</span></label></td><td>
            <input type="password" name="cla" id="cla" value="<?php echo $filas['D_CLAVE_USUARIO'];?>" size="20" required></td>
            <td>
            <label for="name">Confirmar contraseña <span>*</span></label></td><td>
            <input type="password" name="cla2" id="cla2" value="<?php echo $filas['D_CLAVE_USUARIO'];?>" size="20" required></td></tr>
            <tr><td align=right colspan="2"><input type="submit" name="submit" value="Modificar perfil"></td><td colspan="2"><input type="reset" value="Limpiar"></td></tr></table>
                 
        </form>
      <?php } }else{?>
      <center><h1>Debe iniciar sesión para ver esta pagina</h1></center>
        <?php }?>
      </div>
      <!-- ################################################################################################ -->
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