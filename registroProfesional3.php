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
                $datosProfesional = buscarDisponibilidad($idProfesional);
                if(isset($_POST['idProfesional'])){
                            $lunes = 0;
                            $martes = 0;
                            $miercoles = 0;
                            $jueves = 0;
                            $viernes = 0;
                            $sabado = 0;
                            $domingo = 0;
                            if(isset($_POST['dia'])){
                                foreach ($_POST['dia'] as $opcion) {
                                   if($opcion == 'lunes'){
                                       $lunes = 1;
                                   }else if($opcion == 'martes'){
                                       $martes = 1;
                                   }else if($opcion == 'miercoles'){
                                       $miercoles = 1;
                                   }else if($opcion == 'jueves'){
                                       $jueves = 1;
                                   }else if($opcion == 'viernes'){
                                       $viernes = 1;
                                   }else if($opcion == 'sabado'){
                                       $sabado = 1;
                                   }else if($opcion == 'domingo'){
                                       $domingo = 1;
                                   }
                                 }
                            }
                            crearDisponibilidad($idProfesional,$lunes,$martes,$miercoles,$jueves,$viernes,$sabado,$domingo,$_POST['desdeh'],$_POST['desdem'],$_POST['hastah'],$_POST['hastam']);
                            $datosProfesional = buscarDisponibilidad($idProfesional);
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
          <h1>PASO 3 - Disponibilidad</h1>
          En este apartado puede publicar los horarios que desea realizar atención.
          <center>
              <table>
                  <tr>
                      <td>
                          Días de atención
                      </td>
                      <td>
                          Hora de inicio
                      </td>
                      <td>
                          Hora de termino
                      </td>
                  </tr>
                  <?php while($fila = mysqli_fetch_array($datosProfesional)){
                      ?>
                  <tr>
                      <td>
                          <?php if($fila['L_LUNES']==TRUE){
                              echo "Lunes.<br/>";
                          }
                          if($fila['L_MARTES']==TRUE){
                              echo "Martes.<br/>";
                          }
                          if($fila['L_MIERCOLES']==TRUE){
                              echo "Miércoles.<br/>";
                          }
                          if($fila['L_JUEVES']==TRUE){
                              echo "Jueves.<br/>";
                          }
                          if($fila['L_VIERNES']==TRUE){
                              echo "Viernes.<br/>";
                          }
                          if($fila['L_SABADO']==TRUE){
                              echo "Sábado.<br/>";
                          }
                          if($fila['L_DOMINGO']==TRUE){
                              echo "Domingo.";
                          }?>
                      </td>
                      <td>
                          <?php if($fila['F_HORAS_DESDE']==0){
                              echo "00";
                          }else{
                              echo $fila['F_HORAS_DESDE'];
                          }?>:<?php if($fila['F_MINUTOS_DESDE']==0){
                              echo "00";
                          }else{
                              echo $fila['F_MINUTOS_DESDE'];
                          }?>
                      </td>
                      <td>
                          <?php if($fila['F_HORAS_HASTA']==0){
                              echo "00";
                          }else{
                              echo $fila['F_HORAS_HASTA'];
                          }?>:<?php if($fila['F_MINUTOS_HASTA']==0){
                              echo "00";
                          }else{
                              echo $fila['F_MINUTOS_HASTA'];
                          }?>
                      </td>
                  </tr>
                  <?php } ?>
              </table>
          </center>
          <button onclick="location.href='registroProfesional4.php?id=<?php echo $idProfesional;?>'">Siguiente paso</button><br/><br/>
          <h1>Ingresar nueva disponibilidad</h1>
          <form action="" method="post" onsubmit="return validarRegistro()">
              <table>
                  <tr>
                      <td>
                          Días de atención
                      </td>
                      <td>
                          <input type="checkbox" name="dia[]" id="dia[]" value="lunes"> Lunes. <br/>
                          <input type="checkbox" name="dia[]" id="dia[]" value="martes"> Martes. <br/>
                          <input type="checkbox" name="dia[]" id="dia[]" value="miercoles"> Miércoles. <br/>
                          <input type="checkbox" name="dia[]" id="dia[]" value="jueves"> Jueves. <br/>
                          <input type="checkbox" name="dia[]" id="dia[]" value="viernes"> Viernes. <br/>
                          <input type="checkbox" name="dia[]" id="dia[]" value="sabado"> Sábado. <br/>
                          <input type="checkbox" name="dia[]" id="dia[]" value="domingo"> Domingo.
                      </td>
                  </tr>
                  <tr>
                      <td>
                          Hora de inicio
                      </td>
                      <td>
                          <select name="desdeh" id="desdeh">
                        <option value="0">00</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select>:
                    <select name="desdem" id="desdem">
                            <option value="0">00</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                            <option value="46">46</option>
                            <option value="47">47</option>
                            <option value="48">48</option>
                            <option value="49">49</option>
                            <option value="50">50</option>
                            <option value="51">51</option>
                            <option value="52">52</option>
                            <option value="53">53</option>
                            <option value="54">54</option>
                            <option value="55">55</option>
                            <option value="56">56</option>
                            <option value="57">57</option>
                            <option value="58">58</option>
                            <option value="59">59</option>
                    </select> Horas.
                      </td>
                  </tr>
                  <tr>
                      <td>
                          Hora de termino
                      </td>
                      <td>
                          <select name="hastah" id="hastah">
                        <option value="0">00</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select>:
                    <select name="hastam" id="hastam">
                            <option value="0">00</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                            <option value="46">46</option>
                            <option value="47">47</option>
                            <option value="48">48</option>
                            <option value="49">49</option>
                            <option value="50">50</option>
                            <option value="51">51</option>
                            <option value="52">52</option>
                            <option value="53">53</option>
                            <option value="54">54</option>
                            <option value="55">55</option>
                            <option value="56">56</option>
                            <option value="57">57</option>
                            <option value="58">58</option>
                            <option value="59">59</option>
                    </select> Horas.
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