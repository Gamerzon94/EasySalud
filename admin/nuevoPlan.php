<?php
	include("../config.php");
	include("../mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
	}
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
        if(isset($_POST["guardar"])){
            $nom = $_POST["nom"];
            $valor = $_POST["valor"];
            $duracion = $_POST["duracion"];
            $duracionSel = $_POST["duracionSel"];
            if($_POST["activo"]=="si"){
                $activo = TRUE;
            }else{
                $activo = FALSE;
            }
            $para = $_POST["para"];
            guardarPlan($nom, $valor, $duracion, $duracionSel, $activo,$para);
            header("Location:planes.php");
        }
?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Administracion <?php echo $Titulo ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
<script src="js/Chart.min.js"></script>
<!--//charts-->
<!-- geo chart -->
    <script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
    <!--<script src="lib/html5shiv/html5shiv.js"></script>-->
     <!-- Chartinator  -->
<!--geo chart-->

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>	
<?php if(isset($_COOKIE["rol"])){ 
    if( $rol == $admin) { ?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									 <a href="index.php"> <h1><?php echo $Titulo ?></h1> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								  </a> 								
							</div>
							<div class="clearfix"> </div>
						 </div>
						 <div class="header-right">
							<div class="profile_details_left"><!--notifications of menu start -->
								
								<div class="clearfix"> </div>
							</div>
							<!--notification menu end -->
							<div class="profile_details">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
												<div class="user-name">
													<p><?php echo $_COOKIE["nomUsu"]." ".$_COOKIE["apeUsu"] ?></p>
													<span>Administrador</span>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="cerrarSesion.php"><i class="fa fa-sign-out"></i> Cerrar Sesión</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">
    <div class="cols-grids panel-widget">
        <h2>Nuevo plan</h2>
        <div class="chute chute-center text-center">
            <div class="row mb40">
                <form action="" method="post">
                    <center><table border="1">
                        <tr>
                            <td>
                                Nombre del plan:
                            </td>
                            <td>
                                <input type="text" name="nom" id="nom" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Valor
                            </td>
                            <td>
                                $<input type="number" name="valor" id="valor" min="1" required>.-
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Duración
                            </td>
                            <td>
                                <input type="number" name="duracion" id="duracion" min="1" required><br/>
                                <select name="duracionSel" id="duracion">
                                    <option value="dia">Días</option>
                                    <option value="mes">Meses</option>
                                    <option value="ano">Años</option>
                                  </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ¿Plan Activo?
                            </td>
                            <td>
                                <input type="radio" name="activo" id="activo" value="si">Sí. <input type="radio" name="activo" id="activo" value="no">No.
                            </td>
                        </tr>
                                                <tr>
                            <td>
                                ¿Para?
                            </td>
                            <td>
                                <input type="radio" name="para" id="para" value="P" required>Profesional de la salud. <input type="radio" name="para" id="para" value="F" required>Farmacia.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                        <center><input type="submit" value="Guardar" id="guardar" name="guardar"></center>
                            </td>
                        </tr>
                    </table>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
        <p>© <?php echo date("Y"). " ". $Titulo; ?> Todos los derechos reservados</p>
	<p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="index.php"><i class="fa fa-tachometer"></i><span>Tablero</span></a></li>
		        <li><a href="usuarios.php"><i class="fa fa-cogs"></i><span>Usuarios</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="usuarios.php">Lista de usuarios</a></li>
		            <li><a href="nuevoUsuario.php">Nuevo usuario</a></li>		            
		          </ul>
		        </li>
		        <li id="menu-comunicacao" ><a href="farmacia.php"><i class="fa fa-book nav_icon"></i><span>Farmacias</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="farmacia.php">Listado de farmacias</a></li>
                            <li><a href="nuevaFarmacia.php">Nueva farmacia</a></li>
		          </ul>
		        </li>
                        <li id="menu-comunicacao" ><a href="especialidades.php"><i class="fa fa-cog"></i><span>Especialidades</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
                              <li><a href="especialidades.php">Listado de especialidades</a></li>
                              <li><a href="nuevaEspecialidad.php">Nueva especialidad</a></li>		            
		          </ul>
		        </li>
                        <li id="menu-comunicacao" ><a href="planes.php"><i class="fa fa-file-text"></i><span>Planes</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
                              <li><a href="planes.php">Listado de planes</a></li>
                              <li><a href="nuevoPlan.php">Nuevo Plan</a></li>      
		          </ul>
		        </li>
                        <li id="menu-comunicacao" ><a href="reportes.php"><i class="fa fa-bar-chart"></i><span>Reportes</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
                              <li><a href="reportes.php">Reporte Solicitudes</a></li>
                              <li><a href="reportesUsuario.php">Reporte Usuarios</a></li>	
                              <li><a href="reportesPremium.php">Reporte Subcripciones</a></li>
                              <li><a href="reportesPagos.php">Reporte Pagos</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
    <?php }else if ($rol == $usuario) {?>
    <div class="login-page">
        <div class="login-main">  	
             <div class="login-head">
                                    <h1>Easy Salud Administración</h1>
                            </div>
                            <div class="login-block">
                                <h1><cebter>No tiene permisos para entrar a esta pagina</cebter></h1>
                                <h5><a href="../index.php">Volver al inicio</a></h5>
                            </div>
          </div>
    </div>
        <div class="copyrights">
        <p>© <?php echo date("Y"). " ". $Titulo; ?> Todos los derechos reservados</p>
	<p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
    </div>	
    <!--COPY rights end here-->

    <!--scrolling js-->
                    <script src="js/jquery.nicescroll.js"></script>
                    <script src="js/scripts.js"></script>
                    <!--//scrolling js-->
    <script src="js/bootstrap.js"> </script>
    <!-- mother grid end here-->
    <?php }else if ($rol == $profesional) { ?>
        <div class="login-page">
            <div class="login-main">  	
                 <div class="login-head">
                                        <h1>Easy Salud Administración</h1>
                                </div>
                                <div class="login-block">
                                    <h1><cebter>No tiene permisos para entrar a esta pagina</cebter></h1>
                                    <h5><a href="../index.php">Volver al inicio</a></h5>
                                </div>
              </div>
        </div>
        <div class="copyrights">
        <p>© <?php echo date("Y"). " ". $Titulo; ?> Todos los derechos reservados</p>
	<p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
    </div>	
    <!--COPY rights end here-->

    <!--scrolling js-->
                    <script src="js/jquery.nicescroll.js"></script>
                    <script src="js/scripts.js"></script>
                    <!--//scrolling js-->
    <script src="js/bootstrap.js"> </script>
    <!-- mother grid end here-->
    <?php }else if ($rol == $farmacia) {?>
        <div class="login-page">
            <div class="login-main">  	
                 <div class="login-head">
                                        <h1>Easy Salud Administración</h1>
                                </div>
                                <div class="login-block">
                                    <h1><cebter>No tiene permisos para entrar a esta pagina</cebter></h1>
                                    <h5><a href="../index.php">Volver al inicio</a></h5>
                                </div>
              </div>
        </div>
        <div class="copyrights">
        <p>© <?php echo date("Y"). " ". $Titulo; ?> Todos los derechos reservados</p>
	<p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
    </div>	
    <!--COPY rights end here-->

    <!--scrolling js-->
                    <script src="js/jquery.nicescroll.js"></script>
                    <script src="js/scripts.js"></script>
                    <!--//scrolling js-->
    <script src="js/bootstrap.js"> </script>
    <!-- mother grid end here-->
    <?php }}else{ header("Location:login.php");}?>
<!--inner block end here-->
<!--copy rights start here-->
</body>
</html>