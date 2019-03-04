<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsuario = $_COOKIE["idUsu"];
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
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
      <h1>Solicitudes </h1>
        <?php if($rol == $usuario){ 
            $atenciones = buscarAtencionesPacientes($idUsuario)?>
      <table>
          <tr>
              <td>
                  Profesional
              </td>
              <td>
                  Estado
              </td>
              <td>
                  Fecha de anteción
              </td>
              <td>
                  Opciones
              </td>
          </tr>
          <?php while($auxAtenciones = mysqli_fetch_array($atenciones)){ ?>
          <tr>
              <td>
                  <?php $auxProfesional = buscarProfesional($auxAtenciones['C_ID_PROFESIONAL']);
                  while($auxProf = mysqli_fetch_array($auxProfesional)){
                      echo $auxProf['D_NOMBRE_USUARIO']." ".$auxProf['D_APELLIDO_USUARIO'];
                  }?>
              </td>
              <td>
                  <?php echo $auxAtenciones['D_NOMBRE_ESTADO'];?>
              </td>
              <td>
                  <?php if(($auxAtenciones['F_HORAS']==0)&&($auxAtenciones['F_MINUTOS']==0)){
                      echo $auxAtenciones['F_FECHA_ATENCION']." a las 00:00 hrs.";
                  }else if ($auxAtenciones['F_HORAS']==0){
                      echo $auxAtenciones['F_FECHA_ATENCION']." a las 00".":".$auxAtenciones['F_MINUTOS']." hrs.";
                  }else if($auxAtenciones['F_MINUTOS']==0){
                      echo $auxAtenciones['F_FECHA_ATENCION']." a las ".$auxAtenciones['F_HORAS'].":00 hrs.";
                  }else{
                      echo $auxAtenciones['F_FECHA_ATENCION']." a las ".$auxAtenciones['F_HORAS'].":".$auxAtenciones['F_MINUTOS']." hrs.";
                  }
                  ?>
              </td>
              <td>
                  <?php echo "<a href=\"detallesAtencion.php?id=".$auxAtenciones['C_ID_SOLICITUD']."\">Detalles</a>&nbsp"; 
                  if($auxAtenciones['C_ID_ESTADO'] == 1 ){
                      echo "<a href=\"atencion.php?id=".$auxAtenciones['C_ID_SOLICITUD']."&accion=2\"><font color='red'>Cancelar</font></a>";
                  }else if($auxAtenciones['C_ID_ESTADO'] == 2){
                      echo "<a href=\"atencion.php?id=".$auxAtenciones['C_ID_SOLICITUD']."&accion=1\"><font color='green'>Confirmar Atención</font></a>&nbsp";
                      echo "<a href=\"atencion.php?id=".$auxAtenciones['C_ID_SOLICITUD']."&accion=2\"><font color='red'>Cancelar</font></a>";
                  }else if($auxAtenciones['C_ID_ESTADO'] == 3){ 
                      echo "<a href=\"atencion.php?id=".$auxAtenciones['C_ID_SOLICITUD']."&accion=2\"><font color='red'>Cancelar</font></a>";
                   }
                   if($auxAtenciones['C_ID_ESTADO'] == 4 ){
                       $count = 0;
                       $auxPuntuacion = obtenerPuntuacionEspecifica($auxAtenciones['C_ID_SOLICITUD']);
                       while($puntuacion = mysqli_fetch_array($auxPuntuacion)){
                           $count++;
                       }
                   if($count==0){
                      echo "<a href=\"puntuacion.php?id=".$auxAtenciones['C_ID_SOLICITUD']."\">Calificar Atención</a>";
                   }
                  }?>
              </td>
          </tr>
        <?php }?>
      </table>
        <?php } 
        if($rol == $profesional){
            $auxId = buscarIdProfesional($idUsuario);
            while($auxIdProf = mysqli_fetch_array($auxId)){
                $idProfesional = $auxIdProf['C_ID_PROFESIONAL'];
                break;
            }
            $datosProfesional = mostrarProfesionalesEspecifico($idProfesional);
            while($auxDatosProfe = mysqli_fetch_array($datosProfesional)){
                if($auxDatosProfe['L_ACTIVO'] == TRUE){ ?>
              Actualmente usted <font color="green">activo</font> y puede recibir solicitudes. <a href="cambiarVisibilidad.php?id=<?php echo $idProfesional?>&action=1">Para cambiar esto haz click aquí.</a><br/>
          <?php }else{ ?>
              Actualmente usted <a href="url"><font color="red">inactivo</font></a> y no puede recibir solicitudes. <a href="activarVisibilidad.php?id=<?php echo $idProfesional?>">Para cambiar esto haz click aquí.</a><br/>
          <?php }
            } ?> <button onclick="location.href='modificarDisponibilidad.php?id=<?php echo $idUsuario;?>'">Modificar Disponibilidad</button>
            <br/><br/><?php $atenciones = buscarAtencionesProfesional($idProfesional); ?>
      <table>
          <tr>
              <td>
                  Paciente
              </td>
              <td>
                  Estado
              </td>
              <td>
                  Fecha
              </td>
              <td>
                  Opciones
              </td>
          </tr>
          <?php while($atencion = mysqli_fetch_array($atenciones)){ ?>
          <tr>
              <td>
                  <?php echo $atencion['D_NOMBRE_USUARIO']." ".$atencion['D_APELLIDO_USUARIO'];?>
              </td>
              <td>
                  <?php echo $atencion['D_NOMBRE_ESTADO'];?>
              </td>
              <td>
                  <?php echo date("d-m-Y",strtotime($atencion['F_FECHA_ATENCION'])). " a las ".$atencion['F_HORAS'].":";
                  if($atencion['F_MINUTOS']==0){
                            echo "00 horas.";
                        }else{
                            echo $atencion['F_MINUTOS']." horas.";
                        }?>
              </td>
              <td>
                  <?php echo "<a href=\"detallesAtencion.php?id=".$atencion['C_ID_SOLICITUD']."\">Detalles</a>&nbsp"; 
                  if($atencion['C_ID_ESTADO'] == 1 ){
                      echo "<a href=\"atencion.php?id=".$atencion['C_ID_SOLICITUD']."&accion=3\"><font color='green'>Aceptar</font></a>&nbsp";
                      echo "<a href=\"atencion.php?id=".$atencion['C_ID_SOLICITUD']."&accion=5\"><font color='red'>Rechazar</font></a>";
                  }else if($atencion['C_ID_ESTADO'] == 2){
                      echo "<a href=\"atencion.php?id=".$atencion['C_ID_SOLICITUD']."&accion=2\"><font color='red'>Cancelar</font></a>";
                  }else if($atencion['C_ID_ESTADO'] == 3){ 
                      echo "<a href=\"atencion.php?id=".$atencion['C_ID_SOLICITUD']."&accion=4\"><font color='green'>Finalizar</font></a>&nbsp";
                      echo "<a href=\"atencion.php?id=".$atencion['C_ID_SOLICITUD']."&accion=2\"><font color='red'>Cancelar</font></a>";
                   } ?>
              </td>
          </tr>
            <?php }?>
      </table>
        <?php } ?>
      <?php }else{?>
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