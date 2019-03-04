<?php
include("mysql.php");?>
<?php if((isset($_GET['id']))&&(isset($_GET['action']))){
    $idProfesional = $_GET['id'];
    if($_GET['action']==1){
        desactivarVisibilidad($idProfesional);
        header('Location:solicitudes.php');
    }else{ 
        activarVisibilidad($idProfesional);
        header('Location:solicitudes.php');
    }
}else{
    header('Location:index.php');
}