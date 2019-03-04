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
        $forma = FALSE;
        $opcion = 0;
        if(isset($_POST['atenciones'])){
            if($_POST['atenciones']=='todas'){
                $auxSolicitudes = solicitudesTodas();
                $auxComunasSolicitudes = contarComunasSolicitudes();
                $forma = TRUE;
                $opcion = 1;
            }else if($_POST['atenciones']=='pen'){
                $auxSolicitudes = solicitudesPendientes();
                $opcion = 2;
            }else if($_POST['atenciones']=='rech'){
                $auxSolicitudes = solicitudesRechazadas();
                $opcion = 3;
            }else if($_POST['atenciones']=='fi'){
                $auxSolicitudes = solicitudesFinalizadas();
                $opcion = 4;
            }else if($_POST['atenciones']=='can'){
                $auxSolicitudes = solicitudesCanceladas();
                $opcion = 5;
            }else{
                header("Location:index.php");
            }
        }else{
            header("Location:index.php");
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
    <script src="js/chartinator.js" ></script>
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
    <div class="blank">
    	<h2>Solicitudes</h2>
    	<div class="blankpage-main">
            <?php if($forma==TRUE){
                $pendientes = 0;
                $rechazadas = 0;
                $finalizadas = 0;
                $canceladas = 0;
                while($solicitudes = mysqli_fetch_array($auxSolicitudes)){
                    if(($solicitudes['C_ID_ESTADO']==1)||($solicitudes['C_ID_ESTADO']==2)||($solicitudes['C_ID_ESTADO']==3)){
                        $pendientes++;
                    }else if($solicitudes['C_ID_ESTADO']==4){
                        $finalizadas++;
                    }else if($solicitudes['C_ID_ESTADO']==5){
                        $canceladas++;
                    }else if($solicitudes['C_ID_ESTADO']==6){
                        $rechazadas++;
                    }
                }
                
                $auxComunasContador = 0;
                $comuna1 = "";
                $comuna2 = "";
                $comuna3 = "";
                $comuna4 = "";
                $comuna5 = "";
                $cantidad1 = 0;
                $cantidad2 = 0;
                $cantidad3 = 0;
                $cantidad4 = 0;
                $cantidad5 = 0;
                while($comunasContar = mysqli_fetch_array($auxComunasSolicitudes)){
                    $auxComunasContador++;
                    if($auxComunasContador == 1){
                        $comuna1 = $comunasContar["D_NOMBRE_COMUNA"];
                        $cantidad1 = $comunasContar["TOTAL"];
                    }else if($auxComunasContador == 2){
                        $comuna2 = $comunasContar["D_NOMBRE_COMUNA"];
                        $cantidad2 = $comunasContar["TOTAL"];
                    }else if($auxComunasContador == 3){
                        $comuna3 = $comunasContar["D_NOMBRE_COMUNA"];
                        $cantidad3 = $comunasContar["TOTAL"];
                    }else if($auxComunasContador == 4){
                        $comuna4 = $comunasContar["D_NOMBRE_COMUNA"];
                        $cantidad4 = $comunasContar["TOTAL"];
                    }else if($auxComunasContador == 5){
                        $comuna5 = $comunasContar["D_NOMBRE_COMUNA"];
                        $cantidad5 = $comunasContar["TOTAL"];
                        break;
                    }
                }
            ?>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Solicitudes', 'Cantidad'],
          ['Pendientes',     <?php echo $pendientes; ?>],
          ['Finalizadas',     <?php echo $finalizadas; ?>],
          ['Rechazadas',     <?php echo $rechazadas; ?>],
          ['Canceladas',     <?php echo $canceladas; ?>]
        ]);

        var options = {
          title: 'Solicitudes',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Comuna', 'Cantidad'],
          ['<?php echo $comuna1; ?>',     <?php echo $cantidad1; ?>],
          ['<?php echo $comuna2; ?>',     <?php echo $cantidad2; ?>],
          ['<?php echo $comuna3; ?>',     <?php echo $cantidad3; ?>],
          ['<?php echo $comuna4; ?>',     <?php echo $cantidad4; ?>],
          ['<?php echo $comuna5; ?>',     <?php echo $cantidad5; ?>]
        ]);

        var options = {
          title: 'Comunas con mas solicitudes',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart2" style="width: 900px; height: 500px;"></div>
    <?php $auxSolicitudes = solicitudesTodas();
                 } ?>
            <table border=\"1\">
                <tr>
                    <td>
                        Usuario solicitante
                    </td>
                    <td>
                        Profesional
                    </td>
                    <td>
                        Comuna - Region
                    </td>
                    <td>
                        Estado
                    </td>
                </tr>
                <?php 
                while($solicitud = mysqli_fetch_array($auxSolicitudes)){?>
                <tr>
                    <td>
                        <?php $auxUsuario = buscarNombrePaciente($solicitud['C_ID_USUARIO']);
                        while($usuario = mysqli_fetch_array($auxUsuario)){
                            echo $usuario['D_NOMBRE_USUARIO']." ".$usuario['D_APELLIDO_USUARIO'];
                            break;
                        }?>
                    </td>
                    <td>
                        <?php $auxProfesional = buscarNombreProfesional($solicitud['C_ID_PROFESIONAL']);
                        while($profesional = mysqli_fetch_array($auxProfesional)){
                            echo $profesional['D_NOMBRE_USUARIO']." ".$profesional['D_APELLIDO_USUARIO'];
                            break;
                        }?>
                    </td>
                    <td>
                        <?php $auxUsuario = buscarNombrePaciente($solicitud['C_ID_USUARIO']);
                        while($usuario = mysqli_fetch_array($auxUsuario)){
                            echo $usuario['D_NOMBRE_COMUNA'].", ".$usuario['D_NOMBRE_REGION'];
                            break;
                        }?>
                    </td>
                    <td>
                       <?php echo $solicitud['D_NOMBRE_ESTADO']; ?>
                    </td>
                </tr>
                <?php }?>
            </table>
                <?php if($opcion==1){
                    ?><a href="generar-pdf.php?todos=1">Descargar pdf</a><?php
                }else if($opcion==2){
                    ?><a href="generar-pdf.php?pen=1">Descargar pdf</a><?php
                }else if($opcion==3){
                    ?><a href="generar-pdf.php?rech=1">Descargar pdf</a><?php
                }else if($opcion==4){
                    ?><a href="generar-pdf.php?fi=1">Descargar pdf</a><?php
                }else if($opcion==5){
                    ?><a href="generar-pdf.php?can=1">Descargar pdf</a><?php
                }?>
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