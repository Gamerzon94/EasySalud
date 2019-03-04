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
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $perfil = buscarPerfil($idUsuario);
        }else{
            header("Location:index.php");
        }
        $link = buscarRegion();
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
<script type="text/javascript">function desactivarCampos(){
    document.getElementById("region").disabled = true;
    document.getElementById("comuna").disabled = true;
    document.getElementById("dir").disabled = true;
}

function activarCampos(){
    document.getElementById("region").disabled = false;
    document.getElementById("comuna").disabled = false;
    document.getElementById("dir").disabled = false;
}

function validarDireccion(){
    var region = document.getElementById("region").selectedIndex;
    var comuna = document.getElementById("comuna").selectedIndex;
    var direccion = document.getElementById("dir").value;
    var opDir=document.getElementsByName("opDir");
    var resultado = "";
    for(var i=0;i<opDir.length;i++){
        if(opDir[i].checked){
            resultado=opDir[i].value;
        }
    }
    if(resultado == 'no'){
        if(region == 0){
            alert("Seleccione una region");
            return false;
        }
        if((direccion == '') || (direccion == ' ')){
            alert("Debe escribir una dirección");
            return false;
        }
    }
}</script>
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
<body id="top" onload="desactivarCampos()">
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
      <h1>Activar visibilidad</h1>
      <p style="text-align: justify;">Aquí puede seleccionar si desea usar la ubicación de su perfil o una nueva ubicación como punto de referencia de atenciones.</p>
      <?php while($auxPerfil = mysqli_fetch_array($perfil)){ ?>
      <form action="cambiarVisibilidad.php?id=<?php echo $id?>&action=2" method="post" onsubmit="return validarDireccion();">
          <input type="hidden" id="idProfesional" name="idProfesional" value="<?php echo $id; ?>">
          <input type="hidden" id="action" name="action" value="2">
          <table>
              <tr>
                  <td>
                      ¿Usar dirección almacenada?
                  </td>
                  <td>
                      <input type="radio" id="opDir" name="opDir" value="si" onclick="desactivarCampos()" required="" checked> Si. <input type="radio" id="opDir" name="opDir" value="no" onclick="activarCampos()" required=""> No.
                  </td>
              </tr>
              <tr>
                  <td>
                      Región:
                  </td>
                  <td>
                      <select name="region" id="region">
			<option value="0" selected="true"  disabled="disabled">Seleccione región</option>
			<?php while($row = mysqli_fetch_array($link)){
                            if($row['C_ID_REGION'] == $auxPerfil["C_ID_REGION"]){?>
                        <option value="<?php echo $row['C_ID_REGION']; ?>" selected><?php echo $row['D_NOMBRE_REGION']; ?></option>
                            <?php }else{ ?> 
                                <option value="<?php echo $row['C_ID_REGION']; ?>"><?php echo $row['D_NOMBRE_REGION']; ?></option>
                            <?php } }?>
                                </select>
                  </td>
              </tr>
              <tr>
                  <td>
                      Comuna:
                  </td>
                  <td>
                      <select name="comuna" id="comuna">
			<option value="0" selected="true"  disabled="disabled">Seleccione comuna</option>
			
                                </select>
                  </td>
              </tr>
              <tr>
                  <td>
                      Dirección
                  </td>
                  <td>
                      <input type="text" name="dir" id="dir" value="<?php echo $auxPerfil["D_DIRECCION_USUARIO"]; ?>">
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
              <center><input type="submit" value="Guardar" id="Guardar" name="Guardar"></center>
                  </td>
              </tr>
          </table>
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