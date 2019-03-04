<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
	}
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
        if(isset($_GET[id])){
            $idProfesional = $_GET['id'];
            $esProfesional = verificarProfesional2($idProfesional);
            if($esProfesional==false){
                ?><script type="text/javascript">
	window.location.href='index.php';
</script><?php
            }else{
                $datosProfesional = buscarEquipamiento($idProfesional);
                if(isset($_POST['idProfesional'])){
                            $equip = crearEquipamientoConId($idProfesional, $_POST['equip']);
                            $nombre = $_FILES['imagen']['name'];
                            $exten = explode(".", $nombre);
                            $extension = end($exten);
                            $nombrer = strtolower($nombre);
                            $cd=$_FILES['imagen']['tmp_name'];
                            $ruta = "images/equip/" . $equip.".".$extension;
                            $destino = "images/equip/".$equip.".".$extension;
                            $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

                            if (!empty($resultado)){

                                actualizarImagen($equip, $destino);
                                $datosProfesional = buscarEquipamiento($idProfesional);
                                            }else{

                                                }
                            $datosProfesional = buscarEquipamiento($idProfesional);
                    }
            }
        }else{
            ?><script type="text/javascript">
	window.location.href='index.php';</script><?php 
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
<script type="text/javascript" src="js.js"></script>
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
      <h1>Registro</h1>
          <h1>PASO 4 - Equipamiento</h1>
          En este apartado puede publicar todo el equipo con el que cuenta.
          <center>
              <table>
                  <tr>
                      <td WIDTH="50%">
                          Equipamiento
                      </td>
                      <td WIDTH="50%">
                          Imagen
                      </td>
                  </tr>
                  <?php while($fila = mysqli_fetch_array($datosProfesional)){
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
          </center>
          <button onclick="location.href='registroProfesional5.php?id=<?php echo $idProfesional;?>'">Finalizar registro</button><br/><br/>
          <h1>Ingresar un nuevo equipamiento</h1>
          <form action="" method="post" enctype="multipart/form-data">
              <table>
                  <tr>
                      <td>
                          Nombre del equipamiento:
                      </td>
                      <td>
                          <input type="text" name="equip" id="equip" required>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          Imagen del equipamiento
                      </td>
                      <td>
                          <input type="file" name="imagen" id="imagen" />
                      </td>
                  </tr>
                  <tr>
                      <td colspan="2">
                          <input type="hidden" value="<?php echo $idUsuario;?>" name="idProfesional" id="idProfesional">
                  <center><input type="submit" value="Guardar" name="guardar" id="guardar" placeholder="Guardar"></center>
                      </td>
                  </tr>
              </table>
          </form>
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