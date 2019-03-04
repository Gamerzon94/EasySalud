<?php
	include("mysql.php");
        if(isset($_GET[id])){
            eliminarEstudio($_GET['id']);
            header('Location: modificarEstudios.php');
        }else{
            header('Location: index.php');
        }
?>