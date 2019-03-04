<script type="text/javascript">function mensajeRegistro(){
	alert("Farmacia creada con exito.");
	window.location.href='farmacia.php';
}</script>
<?php
include("../mysql.php");
$id=$_POST['id'];
$nom=$_POST['nom'];
$dir=$_POST['dir'];
$tel=$_POST['tel'];
$comuna=$_POST['comuna'];
if($comuna == 0){
    ?><script type="text/javascript">function mensajeRegistro(){
	alert("Seleccione una comuna.");
	window.location.href='farmacia.php';
}</script><?php
}
$idSucursal = nuevaSucursal($id, $nom, $tel, $dir, $comuna);
$datosSucursal = mostrarSucursalEspecifica($idSucursal);
            while($aux = mysqli_fetch_array($datosSucursal)){
                $direccion = $aux["D_DIRECCION_SUCURSAL"].", ".$aux["D_NOMBRE_COMUNA"].", ".$aux["D_NOMBRE_REGION"].", Chile";
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
                echo $latitud."<br>".$longitud;
                }else{
                        echo "fallo la geolocalizacion";
                }
                actualizarCoordenadasSucursal($idSucursal,$latitud,$longitud);
            }
?><script>mensajeRegistro();</script>