<!DOCTYPE html>
 
<html lang="es">
<head>
 
 
    <meta charset="utf-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Google Maps Localizador</title>
 
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
 
</head>
<body>
 
<strong>Mapa según Dirección</strong>
 
<!-- Datos a buscar -->
<form action="" method="post">
 
    <input type='text' name='direccion' placeholder='Dirección' /><br>
    <input type='text' name='ciudad' placeholder='Ciudad' /><br>
 
     <input type='text' name='provincia' placeholder='Provinvia' /><br>
    <input type='text' name='pais' placeholder='País' /><br>
 
    <input type='submit' value='Buscar' />
</form>
 
<?php include("funciones.php"); ?>
<?php
 
if($_POST){
 
    // Buscamos la latitud, longitud en base a la direccion calle y número, ciudad, país
    $localizar=$_POST['direccion'].", ".$_POST['ciudad'].", ".$_POST['provincia'].", ".$_POST['pais'];
 
     
    $datosmapa = geolocalizar($localizar);
 
 
echo "<br><br><strong></stroing>Consulta: </strong>".$localizar;
 
    // Tomamos los datos que encontro la funcion
    if($datosmapa){
 
        
        $latitud = $datosmapa[0];
 
        $longitud = $datosmapa[1];
        $localizacion = $datosmapa[2];
 
}
}
 
        ?>
        
 
<div id="mapa" ></div>
 
   <script type="text/javascript">
        function init_map() {
 
            var myOptions = {
                zoom: 18,
 
                center: new google.maps.LatLng(<?php echo $latitud; ?>, <?php echo $longitud; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
 
            };
            map = new google.maps.Map(document.getElementById("mapa"), myOptions);
 
            marker = new google.maps.Marker({
                map: map,
 
                position: new google.maps.LatLng(<?php echo $latitud; ?>, <?php echo $longitud; ?>)
            });
 
            infowindow = new google.maps.InfoWindow({
                content: "<?php echo $localizacion; ?>"
 
            });
            google.maps.event.addListener(marker, "click", function () {
 
                infowindow.open(map, marker);
            });
 
            infowindow.open(map, marker);
        }
 
        google.maps.event.addDomListener(window, 'load', init_map);
    </script>
 
</body>
</html>