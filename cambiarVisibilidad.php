<?php
include("mysql.php");?>
<?php if((isset($_GET['id']))&&(isset($_GET['action']))){
    $idProfesional = $_GET['id'];
    if($_GET['action']==1){
        desactivarVisibilidad($idProfesional);
        header('Location:solicitudes.php');
    }else{ 
        if(isset($_POST["Guardar"])){
            if($_POST['opDir']=='si'){
                $auxId = buscarIdUsuario($_GET["id"]);
                while($aux2 = mysqli_fetch_array($auxId)){
                    $idUsuario = $aux2["C_ID_USUARIO"];
                    break;
                }
                $auxPerfil = buscarPerfil($idUsuario);
                while($perfil = mysqli_fetch_array($auxPerfil)){
                    $dir = $perfil["D_DIRECCION_USUARIO"];
                    $com = $perfil["D_NOMBRE_COMUNA"];
                    $reg = $perfil["D_NOMBRE_REGION"];
                    $direccion = $dir.", ".$com.", ".$reg.", Chile";
                    $direccion2 = str_replace(" ","+",$direccion);
                    $url = "";
                        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$direccion2."+View,+CA&key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q";
                            echo $url."<br>";
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
                    actualizarCoordenadas($_GET["id"],$latitud,$longitud);
                    break;
                }
            }else{
                $dir = $_POST["dir"];
                $com = $_POST["comuna"];
                actualizarDireccionProfesional($_GET["id"],$dir,$com);
                $auxPerfil = obtenerDireccionProfesional($_GET["id"]);
                while($perfil = mysqli_fetch_array($auxPerfil)){
                    $dir = $perfil["D_DIRECCION_DISPONIBILIDAD"];
                    $com = $perfil["D_NOMBRE_COMUNA"];
                    $reg = $perfil["D_NOMBRE_REGION"];
                    $direccion = $dir.", ".$com.", ".$reg.", Chile";
                    $direccion2 = str_replace(" ","+",$direccion);
                    $url = "";
                        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$direccion2."+View,+CA&key=AIzaSyDggqy7dU1ZcbTcoqibVuZ0-ZMnq0iHg3Q";
                            echo $url."<br>";
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
                    actualizarCoordenadas($_GET["id"],$latitud,$longitud);
                    break;
                }
            }
        }
        activarVisibilidad($idProfesional);
        header('Location:solicitudes.php');
    }
}else{
    header('Location:index.php');
}