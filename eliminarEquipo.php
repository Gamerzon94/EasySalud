<?php
	include("mysql.php");
        if(isset($_GET[id])){
            eliminarEquipo($_GET['id']);
            header('Location: modificarEquipamiento.php');
        }else{
            header('Location: index.php');
        }
?>