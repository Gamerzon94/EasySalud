<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($_SERVER['HTTP_CLIENT_IP'])){ //Verificar la ip compartida de internet
$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ //verificar si la ip fue provista por un proxy
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
$ip = $_SERVER['REMOTE_ADDR'];
}
echo $ip;
?>
<!doctype>
<html>
    <head>
        <title>Prueba de mapa</title>
    </head>
    <body>
        <input type="button" onclick="init()" value="Mostrar mapa">
        <div id="map" style="width: 500px; height: 400px;"></div>
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            var map;
            var marker;
            function init(){
                var mapOptions ) {
                    center: new google.maps.LatLng(41.6556891,,-08775525),
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map"),mapOptions);
                var place = new google.maps.LatLng(41.6556891,-0.8775525);
                market = new google.maps.Marker({
                position: place,
                map: map
            });
            }
            </script>
    </body>
</html>