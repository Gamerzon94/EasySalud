<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsuario = $_COOKIE["idUsu"];
	}
	$admin = "1";
	$usuarios1 = "2";
        $profesional = "3";
        $farmacia = "4";
        $usuario = buscarPerfil($idUsuario);
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
      <h1>Perfil</h1>
      <?php while($filas = mysqli_fetch_array($usuario)){ ?>
      <table>
          <tr>
              <td>
                  Nombre: <?php echo $filas['D_NOMBRE_USUARIO']." ".$filas['D_APELLIDO_USUARIO'];?>
              </td>
              <td>
                  Correo: <?php echo $filas['D_EMAIL_USUARIO'];?>
              </td>
          </tr>
          <tr>
              <td>
                  Dirección: <?php echo $filas['D_DIRECCION_USUARIO']." ".$filas['S_DEPTO_USARIO'].", ".$filas['D_NOMBRE_COMUNA'];?>
              </td>
              <td>
                  Telefono(s): <?php 
                  if(($filas['N_TELEFONO_USUARIO']==0)&&($filas['N_MOVIL_USUARIO']==0)){
                      echo "Sin telefonos Registrados.";
                  }else if($filas['N_TELEFONO_USUARIO']==0){
                      echo $filas['N_MOVIL_USUARIO'];
                  }else if($filas['N_MOVIL_USUARIO']==0){
                      echo $filas['N_TELEFONO_USUARIO'];
                  }else{
                    echo $filas['N_TELEFONO_USUARIO']." - ".$filas['N_MOVIL_USUARIO'];
                  }?>
              </td>
          </tr>
          <tr>
              <td>
                  Fecha de nacimiento: <?php echo $filas['F_FECHA_NACIMIENTO'];?>
              </td>
              <td>
                  Tipo de usuario: <?php echo $filas['D_TIPO_USUARIO'];?>
              </td>
          </tr>
          <tr>
              <td colspan="2">
          <center><br/><button onclick="location.href='editarPerfil.php?id=<?php echo $filas['C_ID_USUARIO'];?>'">Modificar mi perfil</button> <br/> <button onclick="location.href='eliminarPerfil.php'">Solicitar eliminacion de mi perfil</button></center>
              </td>
          </tr>
      </table>
          <?php } 
          if($rol == $profesional){
              $auxIdProfesional = buscarIdProfesional($idUsuario);
          while($auxidUsuario = mysqli_fetch_array($auxIdProfesional)){
              $idProfesional = $auxidUsuario['C_ID_PROFESIONAL'];
          $datosProfesional = mostrarProfesional($auxidUsuario['C_ID_PROFESIONAL']);
          $datosEquipamiento = buscarEquipamiento($auxidUsuario['C_ID_PROFESIONAL']);
          break;
          }
          $auxProfesional = mostrarProfesionalesEspecifico($idProfesional);
          while($profesional = mysqli_fetch_array($auxProfesional)){
             ?> Tipo de cuenta: <?php if($profesional['L_PREMIUM']==FALSE){ ?> Estandar, puedes actualizar a Premium haciendo <a href="premium.php">click aquí.</a> <?php }else{ ?> <font color='gold'>Premium</font>, muchas gracias por ser parte de Easy Salud.<?php } 
          }?>
             <h1>Estudios</h1>
      <table>
                  <tr>
                      <td>
                          Institucion
                      </td>
                      <td>
                          Nivel de estudio
                      </td>
                      <td>
                          Titulo
                      </td>
                      <td>
                          Especialidad
                      </td>
                  </tr>
                  <?php while($fila = mysqli_fetch_array($datosProfesional)){
                      ?>
                  <tr>
                      <td>
                          <?php echo $fila['D_NOMBRE_INSTITUCION'];?>
                      </td>
                      <td>
                          <?php echo $fila['D_NOMBRE_NIVEL_ESTUDIOS'];?>
                      </td>
                      <td>
                          <?php echo $fila['D_TITULO'];?>
                      </td>
                      <td>
                          <?php echo $fila['D_ESPECIALIDAD'];?>
                      </td>
                  </tr>
                  <?php } ?>
              </table>
      <button onclick="location.href='modificarEstudios.php?id=<?php echo $idProfesional;?>'">Modificar Estudios</button>
      <br/><br/><h1>Equipamiento</h1>
      <table>
                  <tr>
                      <td WIDTH="50%">
                          Equipamiento
                      </td>
                      <td WIDTH="50%">
                          Imagen
                      </td>
                  </tr>
                  <?php while($fila = mysqli_fetch_array($datosEquipamiento)){
                      ?>
                  <tr>
                      <td WIDTH="50%">
                         <?php echo $fila['D_EQUIPO']; ?>
                      </td>
                      <td WIDTH="50%">
                          <?php if($fila['D_IMAGEN']=='0'){
                              echo "Sin imagen disponible";
                          }else{ ?>
                            <center><img src="<?php echo $fila['D_IMAGEN']; ?>" style="max-width:10%;width:auto;height:auto;"></center>
                          <?php } ?>
                            
                      </td>
                  </tr>
                  <?php } ?>
              </table>
      <button onclick="location.href='modificarEquipamiento.php?id=<?php echo $idProfesional;?>'">Modificar Equipamiento</button>
          <?php } 
          }else{?>
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