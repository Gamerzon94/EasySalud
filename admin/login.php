<?php
	include("../config.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
	}
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
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
</head>
<body>	
<?php if(isset($_COOKIE["rol"])){ 
    if( $rol == $admin) {
        header('Location: index.php');
    }else if ($rol == $usuario) {?>
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
    <?php }}else{ ?>
    <div class="login-page">
        <div class="login-main">  	
             <div class="login-head">
                                    <h1>Easy Salud Administración</h1>
                            </div>
                            <div class="login-block">
                                    <form action="iniciar.php" method="post">
                                            <input type="text" name="usuario" placeholder="Usuario" required="">
                                            <input type="password" name="pass" class="lock" placeholder="Contraseña" required="">
                                            <div class="forgot-top-grids">
                                                    <div class="clearfix"> </div>
                                            </div>
                                            <input type="submit" name="Iniciar Sesion" value="Iniciar Sesión">
                                    </form>
                                    <h5><a href="../index.php">Volver al inicio</a></h5>
                            </div>
          </div>
    </div>
    <?php }?>
<!--inner block end here-->
<!--copy rights start here-->
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
</body>
</html>