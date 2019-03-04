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
        $profesionalesAtencion = mostrarProfesionales();
        date_default_timezone_set("Chile/Continental");
        $dia = date("N");
        $hoy = getdate();
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
    <style>
#map {
 
        width: 620px;
        height: 400px;
 
        border: #000000 solid 1px;
        margin-top: 10px;
 
      }
    </style>
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q"></script>
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

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded" style="background-image:url('images/maps.jpg');">
  <div class="hoc split clear">
    <section> 
      <!-- ################################################################################################ -->
      <p class="nospace font-xs">Profesionales de la salud</p>
      <h6 class="heading">Mas cerca de ti</h6>
      <p class="btmspace-30">Con Easy Salud puedes buscar profesionales de la salud que estén cerca de ti y busquen atenderte en tu propio domicilio.</p>
      <ul class="fa-ul">
        <li><i class="fa-li fa fa-check-circle"></i> Fácil  de usar.</li>
        <li><i class="fa-li fa fa-check-circle"></i> Disponible en varias plataformas.</li>
        <li><i class="fa-li fa fa-check-circle"></i> Ideal para ti.</li>
      </ul>
      <!-- ################################################################################################ -->
    </section>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="sectiontitle center">
    </div>
    <div class="clear">
      <div class="two_third first">
          <form action="" method="post">
          <table>
              <tr>
                  <td>
                      Buscar Ubicación
                  </td>
              </tr>
              <tr>
                  <td>
                      Dirección <br/> <input type="text" name="dir" id="dir" placeholder="Se recomienda escribir la dirección completa Ej: Almirante Barroso 76, Santiago" size="70" required="">
                  </td>
              </tr>
              <tr>
                  <td>
                      <input type="submit" value="Buscar" name="buscar" id="buscar">
                  </td>
              </tr>
          </table>
          </form>
          <div id="map" ></div>
          <?php
          if(isset($_POST["buscar"])){
              $direccion = $_POST["dir"].", Chile";
          }else{
                $direccion = "Almirante Barroso 76, Santiago , Chile";
          }
                $direccion2 = str_replace(" ","+",$direccion);
                $url = "";
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$direccion2."+View,+CA&key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q";
                $datosjson = "";
                $datosjson = file_get_contents($url);
                $datosmapa = "";
                $datosmapa = json_decode($datosjson, true);
                if($datosmapa['status']='OK'){
                $latitud = "";
                $latitud = $datosmapa['results'][0]['geometry']['location']['lat'];
                $longitud = "";
                $longitud = $datosmapa['results'][0]['geometry']['location']['lng'];
                }else{
                        echo "fallo la geolocalizacion";
                }
      ?>
              <script>
                        var customLabel = {
        Sucursal: {
          label: 'F'
        },
        bar: {
          label: 'B'
        }
      };
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo $latitud?>, lng: <?php echo $longitud ?>},
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow;
                  downloadUrl('XmlSucursales.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var tel = markerElem.getAttribute('tel');
              var web = markerElem.getAttribute('web');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text1 = document.createElement('a');
              text1.textContent = 'Sitio Web';
              text1.href = 'http://' + web;
              infowincontent.appendChild(text1);
              
              var text2 = document.createElement('a');
              text2.textContent = ' Enviar Mensaje';
              text2.href = 'mensajesFarmacia.php?id=' + id;
              infowincontent.appendChild(text2);
              infowincontent.appendChild(document.createElement('br'));

              var tel1 = document.createElement('text');
              tel1.textContent = 'Teléfono: ' + tel;
              infowincontent.appendChild(tel1);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = 'Dirección: ' + address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
                title: name
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
      }
      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q&callback=initMap"
    async defer></script>
        <h1>Profesionales de la salud.</h1>
        <table>
            <tr>
                <td>
                    Profesional
                </td>
                <td>
                    Especialidad
                </td>
                <td>
                    Titulo - Instutución
                </td>
                <td>
                    Opciones
                </td>
            </tr>
        <?php while($filas = mysqli_fetch_array($profesionalesAtencion)){
            if($filas['C_ID_ESTADO_CUENTA'] == '2'){
            $disponibilidad = disponibilidadProfesional($filas['C_ID_USUARIO']);
            echo "<tr><td>".$filas['D_NOMBRE_USUARIO']." ".$filas['D_APELLIDO_USUARIO']."</td>";
            $estudiosProfesional = buscarEstudiosProfesional($filas['C_ID_PROFESIONAL']);
            echo "<td>";
            while($auxEstudios = mysqli_fetch_array($estudiosProfesional)){
               echo $auxEstudios['D_ESPECIALIDAD']."</br>";
            }
            echo "</td>";
            $estudiosProfesional = buscarEstudiosProfesional($filas['C_ID_PROFESIONAL']);
            echo "<td>";
            while($auxEstudios = mysqli_fetch_array($estudiosProfesional)){
               echo $auxEstudios['D_TITULO']."-".$auxEstudios['D_NOMBRE_INSTITUCION']."</br>";
            }
            echo "</td>";
            echo "<td><a href=\"detallesProfesional.php?id=".$filas['C_ID_PROFESIONAL']."\">Detalles&nbsp;</a>";
            if(isset($_COOKIE['rol'])){
                echo "<a href=\"solicitar.php?id=".$filas['C_ID_PROFESIONAL']."\">Solicitar</a></td></tr>";
            }else{
                echo "</td></tr>";
            }
            
            }}
                                    
            ?></table>
        <ul class="nospace group">
          <li class="one_third first">
            <article><a href="#"><i class="icon btmspace-30 fa fa-joomla"></i></a>
              <h6 class="heading font-x1">Cuando lo necesites</h6>
              <p>Nos encargamos de que logres encontrar el profesional que necesites en el momento que lo necesites.</p>
            </article>
          </li>
          <li class="one_third">
            <article><a href="#"><i class="icon btmspace-30 fa fa-braille"></i></a>
              <h6 class="heading font-x1">Facil uso</h6>
              <p>Trabajamos arduamente para tener una plataforma de facil uso y entendimiento, para que no te cueste encontrar un profesional de la salud.</p>
            </article>
          </li>
          <li class="one_third">
            <article><a href="#"><i class="icon btmspace-30 fa fa-modx"></i></a>
              <h6 class="heading font-x1">Donde lo necesites</h6>
              <p>Pudes usar Easy Salud tanto desde tu computador, tablet o celular.</p>
            </article>
          </li>
        </ul>
      </div>
        <div class="one_third"><a href="#"><img class="inspace-10 btmspace-15 borderedbox" src="images/cristalida.jpg" alt=""></a><br>
            <a href="#"><img class="inspace-10 borderedbox" src="images/easysalud.jpg" alt=""></a></div>
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