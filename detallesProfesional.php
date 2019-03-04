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
        if(isset($_GET['id'])){
        $profesionalesAtencion = mostrarProfesionalesEspecifico($_GET['id']);
        $idProfesional = $_GET['id'];
        }else{
            header("Location:index.php");
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
        <li><i class="fa fa-phone"></i> +222222222</li>
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
                <li><a href="mensajes.php">Mensajes</a></li>
                <li><a href="solicitudes.php">Solicitudes</a></li>
                <li><a href="perfil.php">Mi Perfil</a></li>
                <li><a href="perfil.php">Panel farmacia</a></li>
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
      <h1>Detalles del profesional</h1>  
      <?php while($filas = mysqli_fetch_array($profesionalesAtencion)){
          $idUsuProfesional = $filas['C_ID_USUARIO'];
          if($filas['D_IMAGEN'] != '0'){
         ?><img src="<?php echo $filas['D_IMAGEN']; ?>" style="max-width:20%;width:auto;height:auto;"><br/><?php
          }
         echo "Nombre: ".$filas['D_NOMBRE_USUARIO']." ".$filas['D_APELLIDO_USUARIO']."<br/>";
         echo "Descripción: ".$filas['D_DESCRIPCION']."<br/>";
         $auxPuntuacion = obtenerPuntcuacion($idProfesional);
         $puntos = 0.0;
         $count = 0;
         while($puntuacion = mysqli_fetch_array($auxPuntuacion)){
             $puntos = $puntos+$puntuacion["N_PUNTAJE"];
             $count++;
         }
         if($count!=0){
         $total = $puntos/$count;
         echo "Puntuacion en base a opiniones: ".$total." (Escala de 1 a 5)";
         }
         echo "Estudios";
         $estudios = buscarEstudiosProfesional($filas['C_ID_PROFESIONAL']);
         $auxEstudios;?>
         <table>
             <tr>
                 <td>
                     Institución
                 </td>
                 <td>
                     Nivel de estudio
                 </td>
                 <td>
                     Especialidad
                 </td>
                 <td>
                     Titulo
                 </td>
             </tr>
             <?php while($auxEstudiosTabla = mysqli_fetch_array($estudios)){ ?>
             <tr>
                 <td>
                     <?php echo $auxEstudiosTabla['D_NOMBRE_INSTITUCION']; ?>
                 </td>
                 <td>
                     <?php echo $auxEstudiosTabla['D_NOMBRE_NIVEL_ESTUDIOS']; ?>
                 </td>
                 <td>
                     <?php echo $auxEstudiosTabla['D_ESPECIALIDAD']; ?>
                 </td>
                 <td>
                     <?php echo $auxEstudiosTabla['D_TITULO']; ?>
                 </td>
             </tr>
             <?php } ?>
         </table>
                      <?php echo "Equipamiento </br>";
                      $auxEqui = 0;
                    $equi = buscarEquipamiento($filas['C_ID_PROFESIONAL']); ?>
                    <table>
                  <tr>
                      <td WIDTH="50%">
                          Equipamiento
                      </td>
                      <td WIDTH="50%">
                          Imagen
                      </td>
                  </tr><?php
                    while($filas2 = mysqli_fetch_array($equi)){
                        $auxEqui++;
                        ?>
                  <tr>
                      <td WIDTH="50%">
                         <?php echo $filas2['D_EQUIPO']; ?>
                      </td>
                      <td WIDTH="50%">
                          <?php if($filas2['D_IMAGEN']=='0'){
                              echo "Sin imagen disponible";
                          }else{ ?>
                            <center><img src="<?php echo $filas2['D_IMAGEN']; ?>" style="max-width:10%;width:auto;height:auto;"></center>
                          <?php } ?>
                            
                      </td>
                  </tr>
            <?php
                       }
                      if($auxEqui==0){?>
                  <tr>
                      <td colspan="2">
                  <center>El profesional no cuenta con equipamiento registrado.</center>
                      </td>
                  </tr>
                      <?php } ?> </table><?php
                    $dis = buscarDisponibilidad($filas['C_ID_PROFESIONAL']);
                    echo "Disponibilidad: <br/>"; ?>
         <table>
             <tr>
                 <td>
                     Días
                 </td>
                 <td>
                     Horario
                 </td>
             </tr>
         <?php
                    while($filas3 = mysqli_fetch_array($dis)){
                        echo "<tr><td>";
                        if($filas3['L_LUNES']==TRUE){
                            echo "&nbsp;&nbsp;-Lunes <br/>";
                        }
                        if ($filas3['L_MARTES']==TRUE){
                            echo "&nbsp;&nbsp;-Martes <br/>";
                        }
                        if ($filas3['L_MIERCOLES']==TRUE){
                            echo "&nbsp;&nbsp;-Miercoles <br/>";
                        }
                        if ($filas3['L_JUEVES']==TRUE){
                            echo "&nbsp;&nbsp;-Jueves <br/>";
                        }
                        if ($filas3['L_VIERNES']==TRUE){
                            echo "&nbsp;&nbsp;-Viernes <br/>";
                        }
                        if ($filas3['L_SABADO']==TRUE){
                            echo "&nbsp;&nbsp;-Sabado <br/>";
                        }
                        if ($filas3['L_DOMINGO']==TRUE){
                            echo "&nbsp;&nbsp;-Domingo <br/>";
                        }
                        echo "</td><td>";
                        echo "Desde las ".$filas3['F_HORAS_DESDE'].":";
                        if($filas3['F_MINUTOS_DESDE']==0){
                            echo "00";
                        }else{
                            echo $filas3['F_MINUTOS_DESDE'];
                        }
                        echo " hasta las ".$filas3['F_HORAS_HASTA'].":";
                         if($filas3['F_MINUTOS_HASTA']==0){
                            echo "00";
                        }else{
                            echo $filas3['F_MINUTOS_HASTA'];
                        }
                        echo " horas.<br/></td></tr>";
                    }
                    ?></table>
      <?php } 
      if(isset($_COOKIE['rol'])){
      ?>
                     
                      <button onclick="location.href='solicitar.php?id=<?php echo $_GET['id'];?>'">Solicitar Profesional</button>
                      <button onclick="location.href='mensajes3.php?id=<?php echo $idUsuProfesional;?>'">Enviar Mensaje</button>
      <?php }else{?>
                      <center><h1>Debe iniciar sesión para poder solicitar una atención</h1></center>         
      <?php }
      $auxPuntuacion = obtenerPuntcuacion($idProfesional);
         $count = 0;?>
                      <h1>Opiniones</h1>
                      <?php
         while($puntuacion = mysqli_fetch_array($auxPuntuacion)){
             $auxDatos = obtenerDatosPersonas($puntuacion["C_ID_USUARIO"]);
                     while($usu = mysqli_fetch_array($auxDatos)){
                         echo "De: ".$usu["D_NOMBRE_USUARIO"]." ".$usu["D_APELLIDO_USUARIO"];
                     }
             echo " Fecha: ".$puntuacion["F_FECHA_REGISTRO"]." Nota: ".$puntuacion["N_PUNTAJE"]."<br/>";
             echo $puntuacion["D_COMENTARIO"]."<br/>";
             $count++;
         }
         
         if($count == 0){
             echo "El profesional no tiene opiniones registradas."; 
                     }?>
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